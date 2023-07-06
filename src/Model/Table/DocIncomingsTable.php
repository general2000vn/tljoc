<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\I18n\FrozenDate;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Model\Entity\DocIncoming;

/**
 * DocIncomings Model
 *
 * @property \App\Model\Table\DocCompaniesTable&\Cake\ORM\Association\BelongsTo $DocCompanies
 * @property \App\Model\Table\PartnersTable&\Cake\ORM\Association\BelongsTo $Partners
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Inputters
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Modifiers
 * @property \App\Model\Table\DocMethodsTable&\Cake\ORM\Association\BelongsTo $DocMethods
 * @property \App\Model\Table\DocStatusesTable&\Cake\ORM\Association\BelongsTo $DocStatuses
 * @property \App\Model\Table\DocTypesTable&\Cake\ORM\Association\BelongsTo $DocTypes
 * @property \App\Model\Table\DocSecLevelsTable&\Cake\ORM\Association\BelongsTo $DocSecLevels
 * @property \App\Model\Table\DocOutgoingsTable&\Cake\ORM\Association\BelongsTo $DocOutgoings
 * @property \App\Model\Table\DepartmentsTable&\Cake\ORM\Association\BelongsToMany $Departments
 *
 * @method \App\Model\Entity\DocIncoming newEmptyEntity()
 * @method \App\Model\Entity\DocIncoming newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\DocIncoming[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DocIncoming get($primaryKey, $options = [])
 * @method \App\Model\Entity\DocIncoming findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\DocIncoming patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DocIncoming[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\DocIncoming|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DocIncoming saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DocIncoming[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DocIncoming[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\DocIncoming[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DocIncoming[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DocIncomingsTable extends Table
{
    const UPLOAD_DIR = 'webroot' . DS . 'uploads' . DS . 'doc_incoming' . DS;

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {


        parent::initialize($config);

        $this->setTable('doc_incomings');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'doc_file' => [
                //'path' => 'webroot{DS}uploads{DS}doc_incoming{DS}',
                'path' => DocIncomingsTable::UPLOAD_DIR,

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

        // $this->belongsTo('DocCompanies', [
        //     'foreignKey' => 'doc_company_id',
        //     'joinType' => 'INNER',
        // ]);

        $this->belongsTo('Partners', [
            'foreignKey' => 'partner_id',
            'joinType' => 'LEFT',
        ]);
        $this->belongsTo('Inputters', [
            'className' => 'Users',
            'foreignKey' => 'inputter_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('DocMethods', [
            'foreignKey' => 'doc_method_id',
            'joinType' => 'LEFT',
        ]);
        $this->belongsTo('DocStatuses', [
            'foreignKey' => 'doc_status_id',
            'joinType' => 'LEFT',
        ]);
        $this->belongsTo('DocTypes', [
            'foreignKey' => 'doc_type_id',
            'joinType' => 'LEFT',
        ]);
        // $this->belongsTo('RelatedDocs', [
        //     'foreignKey' => 'related_doc_id',
        // ]);
        // $this->belongsToMany('DocInDepts', [
        //     'className' => 'DocInDepts',
        //     'joinTable' => 'doc_in_depts_doc_incomings',
        //     'targetForeignKey' => 'doc_in_dept_id',
        //     'foreignKey' => 'doc_incoming_id',
        // ]);

        $this->belongsToMany('Departments', [
            'className' => 'Departments',
            'joinTable' => 'departments_doc_incomings',
            'targetForeignKey' => 'department_id',
            'foreignKey' => 'doc_incoming_id',
        ]);


        $this->belongsTo('Modifiers', [
            'className' => 'Users',
            'foreignKey' => 'modifier_id',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('DocSecLevels', [
            'foreignKey' => 'doc_sec_level_id',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('DocOutgoings', [
            'foreignKey' => 'doc_outgoing_id',
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
            ->integer('partner_id')
            ->requirePresence('partner_id', true);

        $validator
            ->scalar('subject')
            //->maxLength('subject', 50)
            ->requirePresence('subject', true)
            ->notEmptyString('subject');

        $validator
            ->date('reg_date')
            ->requirePresence('reg_date', 'create')
            ->notEmptyDate('reg_date');

        $validator
            ->requirePresence('reg_num', 'create')
            ->notEmptyString('reg_num');

        $validator
            ->scalar('reg_text')
            ->maxLength('reg_text', 25)
            ->requirePresence('reg_text', 'create')
            ->notEmptyString('reg_text');

        $validator
            ->scalar('ref_text')
            ->maxLength('ref_text', 30)
            ->allowEmptyString('ref_text');

        $validator
            ->scalar('contract_num')
            ->maxLength('contract_num', 69)
            ->allowEmptyString('contract_num');

        $validator
            ->date('receiving_date')
            ->allowEmptyDate('reciving_date');

        $validator
            ->scalar('remark')
            ->allowEmptyString('remark');

        //$validator
        //    ->scalar('doc_file')
        //    ->allowEmptyString('doc_file');

        $validator
            ->integer('doc_sec_level_id');

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
        //$rules->add($rules->existsIn(['doc_company_id'], 'DocCompanies'), ['errorField' => 'doc_company_id']);
        $rules->add($rules->existsIn(['partner_id'], 'Partners'), ['errorField' => 'partner_id']);
        $rules->add($rules->existsIn(['inputter_id'], 'Inputters'), ['errorField' => 'user_id']);
        $rules->add($rules->existsIn(['doc_method_id'], 'DocMethods'), ['errorField' => 'doc_method_id']);
        $rules->add($rules->existsIn(['doc_status_id'], 'DocStatuses'), ['errorField' => 'doc_status_id']);
        $rules->add($rules->existsIn(['doc_type_id'], 'DocTypes'), ['errorField' => 'doc_type_id']);
        //$rules->add($rules->existsIn(['related_doc_id'], 'RelatedDocs'), ['errorField' => 'related_doc_id']);
        $rules->add($rules->existsIn(['modifier_id'], 'Modifiers'), ['errorField' => 'modifier_id']);
        $rules->add($rules->existsIn(['doc_sec_level_id'], 'DocSecLevels'), ['errorField' => 'doc_sec_level_id']);

        return $rules;
    }

    /**
     * Generate registration number and save documents
     * application integrity.
     *
     * @param App\Model\Entity\DocIncoming $docIncoming The submitted DocIncoming entity.
     * @return bool True if save successfully
     */
    public function saveNewDoc(DocIncoming $docIncoming)
    {
        $today = FrozenDate::now();
        $docIncoming->reg_date = $today;

        $docNum = 1 + $this->find('all', [
            'fields' => ['id', 'reg_num', 'receive_date', 'reg_date'],
            'conditions' => ['reg_date >=' => $today->format('Y') . '-01-01',
                            'reg_date <=' => $today->format('Y') . '-12-31',
                            'is_reserved' => false,
                            ]
        ])->count();
        
        while ($this->exists(['reg_num' => $docNum])) {
            $docNum ++;
        }

        $docIncoming->reg_num = $docNum;
        $docIncoming->reg_text = 'TL' . '/' .$today->format('y-') . sprintf('%03d', $docIncoming->reg_num)  ;


        if ($this->save($docIncoming)) {
            return true;
        } else {
            return false;
        }
    }

    public function saveReserveDoc(DocIncoming $docIncoming)
    {
        
        $docIncoming->reg_text = 'TL' . '/' . $docIncoming->reg_date->format('y-') . sprintf('%03d', $docIncoming->reg_num)  ;


        if ($this->save($docIncoming)) {
            return true;
        } else {
            return false;
        }
    }

    public function saveEditedDoc(DocIncoming $docIncoming)
    {

        // $company = $this->DocCompanies->get($docIncoming->doc_company_id);
        // $docIncoming->reg_text = 'TL' . '/' .$docIncoming->reg_date->format('Y-') . sprintf('%03d', $docIncoming->reg_num)  ;


        if ($this->save($docIncoming)) {
            
            return true;
        } else {
            return false;
        }
    }

    public function findAJAX($criteria, $limit = 25)
    {
        $results = null;

        if ($criteria != "") {

            $docIncomings = $this->find('all', [
                'fields' => ['id', 'reg_text', 'ref_text', 'subject'], 'conditions' => ['OR' => ['ref_text LIKE' => '%' . $criteria . '%', 'reg_text LIKE' => '%' . $criteria . '%', 'subject LIKE' => '%' . $criteria . '%']], 'limit' => $limit, 'order' => ['reg_date' => 'DESC']
            ]);
            //$results['criteria'] = $criteria;

            $iCount = 0;
            foreach ($docIncomings as $docIncoming) {
                $results[$iCount]['id'] = $docIncoming->id;
                $results[$iCount]['text'] = '[' . $docIncoming->reg_text . '] - [' . $docIncoming->ref_text . '] - ' . $docIncoming->subject;
                $iCount++;
            }
        }

        return $results;
    }
}
