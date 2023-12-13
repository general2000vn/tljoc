<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

use Cake\I18n\FrozenDate;
use App\Model\Entity\DocOutgoing;
use Cake\Event\Event;
use Cake\ORM\Entity;
use ArrayObject;
use Cake\Utility\Hash;

/**
 * DocOutgoings Model
 *
 * @property \App\Model\Table\DocTypesTable&\Cake\ORM\Association\BelongsTo $DocTypes
 * 
 * @property \App\Model\Table\DepartmentsTable&\Cake\ORM\Association\BelongsTo $Departments
 * @property \App\Model\Table\PartnersTable&\Cake\ORM\Association\BelongsToMany $Partners
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Originators
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Inputters
 * @property \App\Model\Table\DocCategoriesTable&\Cake\ORM\Association\BelongsTo $DocCategories
 * @property \App\Model\Table\DocMethodsTable&\Cake\ORM\Association\BelongsTo $DocMethods
 * @property \App\Model\Table\DocSecLevelsTable&\Cake\ORM\Association\BelongsTo $DocSecLevels
 * @property \App\Model\Table\DocStatusesTable&\Cake\ORM\Association\BelongsTo $DocStatuses
 * @property \App\Model\Table\DepartmentsTable&\Cake\ORM\Association\BelongsToMany $Departments
 * @property \App\Model\Table\DocIncomingsTable&\Cake\ORM\Association\BelongsTo $DocIncomings
 *
 * @method \App\Model\Entity\DocOutgoing newEmptyEntity()
 * @method \App\Model\Entity\DocOutgoing newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\DocOutgoing[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DocOutgoing get($primaryKey, $options = [])
 * @method \App\Model\Entity\DocOutgoing findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\DocOutgoing patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DocOutgoing[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\DocOutgoing|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DocOutgoing saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DocOutgoing[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DocOutgoing[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\DocOutgoing[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DocOutgoing[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class DocOutgoingsTable extends Table
{
    const UPLOAD_DIR = 'webroot' . DS . 'uploads' . DS . 'doc_outgoing' . DS;

    const DOC_NUM_OFFSET = 333;

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('doc_outgoings');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'doc_file' => [
                //'path' => 'webroot{DS}uploads{DS}doc_incoming{DS}',
                'path' => DocOutgoingsTable::UPLOAD_DIR,

                'nameCallback' => function ($table, $entity, $data, $field, $settings) {
                    $regDate = new FrozenDate($entity->reg_date);
                    
                    return $regDate->format('y-') . sprintf('%04d', $entity->reg_num) . '-' . strtolower($data->getClientFilename());
                },

                'deleteCallback' => function ($path, $entity, $field, $settings) {
                    // When deleting the entity, both the original and the thumbnail will be removed
                    // when keepFilesOnDelete is set to false
                    return [
                        $path . $entity->{$field},
                    ];
                },
                'keepFilesOnDelete' => false,

            ]
        ]);

        $this->belongsTo('DocTypes', [
            'foreignKey' => 'doc_type_id',
            'joinType' => 'LEFT',
        ]);

        // $this->belongsTo('DocCompanies', [
        //     'foreignKey' => 'doc_company_id',
        //     'joinType' => 'INNER',
        // ]);
        
        $this->belongsTo('Departments', [
            'foreignKey' => 'department_id',

            'joinType' => 'INNER',
        ]);
        $this->belongsToMany('Partners', [
            'targetForeignKey' => 'partner_id',
            'foreignKey' => 'doc_outgoing_id',
            'joinTable' => 'doc_outgoings_partners',
            'joinType' => 'LEFT',
        ]);

        $this->belongsTo('Originators', [
            'className' => 'Users',
            'foreignKey' => 'originator_id',
            'joinType' => 'Left',
        ]);
        $this->belongsTo('Inputters', [
            'className' => 'Users',
            'foreignKey' => 'inputter_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Modifiers', [
            'className' => 'Users',
            'foreignKey' => 'modifier_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('DocCategories', [
            'foreignKey' => 'doc_category_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('DocMethods', [
            'foreignKey' => 'doc_method_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('DocSecLevels', [
            'foreignKey' => 'doc_sec_level_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('DocStatuses', [
            'foreignKey' => 'doc_status_id',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('DocIncomings', [
            'foreignKey' => 'doc_incoming_id',
            'joinType' => 'LEFT',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->date('reg_date')
            ->requirePresence('reg_date', 'create')
            ->notEmptyDate('reg_date');

        $validator
            ->scalar('subject')
            //->maxLength('subject', 255)
            ->requirePresence('subject', true)
            ->notEmptyString('subject');

        $validator
            ->scalar('reg_text')
            ->maxLength('reg_text', 20)
            ->requirePresence('reg_text', 'create')
            ->notEmptyString('reg_text');

        $validator
            ->date('issued_date')
            ->allowEmptyDate('issued_date');

        $validator
            ->scalar('contract_no')
            ->maxLength('contract_no', 69)
            ->allowEmptyString('contract_no');
        $validator
            ->scalar('others')
            ->allowEmptyString('others');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['doc_type_id'], 'DocTypes'), ['errorField' => 'doc_type_id']);
        // $rules->add($rules->existsIn(['doc_company_id'], 'DocCompanies'), ['errorField' => 'doc_company_id']);
        $rules->add($rules->existsIn(['department_id'], 'Departments'), ['errorField' => 'department_id']);
        $rules->add($rules->existsIn(['partner_id'], 'Partners'), ['errorField' => 'partner_id']);
        $rules->add($rules->existsIn(['originator_id'], 'Originators'), ['errorField' => 'originator_id']);
        $rules->add($rules->existsIn(['inputter_id'], 'Inputters'), ['errorField' => 'inputter_id']);
        $rules->add($rules->existsIn(['doc_category_id'], 'DocCategories'), ['errorField' => 'doc_category_id']);
        $rules->add($rules->existsIn(['doc_method_id'], 'DocMethods'), ['errorField' => 'doc_method_id']);
        $rules->add($rules->existsIn(['doc_sec_level_id'], 'DocSecLevels'), ['errorField' => 'doc_sec_level_id']);
        $rules->add($rules->existsIn(['doc_status_id'], 'DocStatuses'), ['errorField' => 'doc_status_id']);

        return $rules;
    }

    public function saveNewDoc(DocOutgoing $docOutgoing)
    {
        $today = FrozenDate::now();
        $docOutgoing->reg_date = $today;

        $docNum = DocOutgoingsTable::DOC_NUM_OFFSET + 1 + $this->find('all', [
            'fields' => ['id', 'reg_num',  'reg_date'], 'conditions' => ['reg_date >=' => $today->format('Y') . '-01-01',
                                                                         'reg_date <=' => $today->format('Y') . '-12-31',
                                                                         'is_reserved' => false,
                                                                         'reg_num >' => DocOutgoingsTable::DOC_NUM_OFFSET,
                                                                         ]
        ])->count();
        //$company = $this->DocCompanies->get($docOutgoing->doc_company_id);
        $department = $this->Departments->get($docOutgoing->department_id);

        while ($this->exists(['reg_num' => $docNum])) {
            $docNum ++;
        }

        $docOutgoing->reg_num = $docNum;
        //$docIncoming->reg_text = $today->format('yy-mm-') . str_pad(print($docCount), 4, "0", STR_PAD_LEFT) . '/' . $company->name;
        $docOutgoing->reg_text = 'TL/' . $department->init . '/' . $today->format('y-') . sprintf('%03d', $docOutgoing->reg_num);


        if ($this->save($docOutgoing)) {
            return true;
        } else {
            return false;
        }
    }

    public function saveReserveDoc(DocOutgoing $docOutgoing)
    {
        
        $department = $this->Departments->get($docOutgoing->department_id);

        
        $docOutgoing->reg_text = 'TL/' . $department->init . '/' . $docOutgoing->reg_date->format('y-') . sprintf('%03d', $docOutgoing->reg_num);


        if ($this->save($docOutgoing)) {
            return true;
        } else {
            return false;
        }
    }

    public function saveEditedDoc(DocOutgoing $docOutgoing)
    {

        
        $department = $this->Departments->get($docOutgoing->department_id);

        $docOutgoing->reg_text = 'TL/' . $department->init . '/' . $docOutgoing->reg_date->format('y-') . sprintf('%03d', $docOutgoing->reg_num);


        if ($this->save($docOutgoing)) {
            return true;
        } else {
            return false;
        }
    }

    public function findAJAX($criteria, $limit = 25)
    {
        $results = null;

        if ($criteria != "") {
            $docOutgoings = $this->find('all', [
                'fields' => ['id', 'reg_text', 'subject'], 'conditions' => ['OR' => ['reg_text LIKE' => '%' . $criteria . '%',  'subject LIKE' => '%' . $criteria . '%']], 'limit' => $limit
            ]);
            //$results['criteria'] = $criteria;

            $iCount = 0;
            foreach ($docOutgoings as $docOutgoing) {
                $results[$iCount]['id'] = $docOutgoing->id;
                $results[$iCount]['text'] = $docOutgoing->reg_text . ' - ' . $docOutgoing->subject;
                $iCount++;
            }
        }

        return $results;
    }

    

    
}
