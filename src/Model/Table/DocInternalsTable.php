<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Model\Entity\DocInternal;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\I18n\FrozenDate;

/**
 * DocInternals Model
 *
 * @property \App\Model\Table\DocInternalTypesTable&\Cake\ORM\Association\BelongsTo $DocInternalTypes
 * @property \App\Model\Table\DocStatusesTable&\Cake\ORM\Association\BelongsTo $DocStatuses
 * @property \App\Model\Table\DocCompaniesTable&\Cake\ORM\Association\BelongsTo $DocCompanies
 * @property \App\Model\Table\DepartmentsTable&\Cake\ORM\Association\BelongsTo $Departments
 * @property \App\Model\Table\OriginatorsTable&\Cake\ORM\Association\BelongsTo $Originators
 * @property \App\Model\Table\InputtersTable&\Cake\ORM\Association\BelongsTo $Inputters
 * @property \App\Model\Table\ModifiersTable&\Cake\ORM\Association\BelongsTo $Modifiers
 *
 * @method \App\Model\Entity\DocInternal newEmptyEntity()
 * @method \App\Model\Entity\DocInternal newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\DocInternal[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DocInternal get($primaryKey, $options = [])
 * @method \App\Model\Entity\DocInternal findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\DocInternal patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DocInternal[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\DocInternal|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DocInternal saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DocInternal[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DocInternal[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\DocInternal[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DocInternal[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DocInternalsTable extends Table
{
    const UPLOAD_DIR = 'webroot' . DS . 'uploads' . DS . 'doc_internal' . DS;

    const DOC_NUM_OFFSET = 0;
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('doc_internals');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'doc_file' => [
                //'path' => 'webroot{DS}uploads{DS}doc_incoming{DS}',
                'path' => DocInternalsTable::UPLOAD_DIR,

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

        $this->belongsTo('DocInternalTypes', [
            'foreignKey' => 'doc_internal_type_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('DocStatuses', [
            'foreignKey' => 'doc_status_id',
            'joinType' => 'LEFT',
        ]);
        $this->belongsTo('DocCompanies', [
            'foreignKey' => 'doc_company_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Departments', [
            'foreignKey' => 'department_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Originators', [
            'className' => 'Users',
            'foreignKey' => 'originator_id',
            'joinType' => 'Left',
        ]);
        $this->belongsTo('Inputters', [
            'foreignKey' => 'inputter_id',
            'className' => 'Users',
            'joinType' => 'Left',
        ]);

        $this->belongsTo('DocSecLevels', [
            'foreignKey' => 'doc_sec_level_id',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('Modifiers', [
            'foreignKey' => 'modifier_id',
            'className' => 'Users',
            'joinType' => 'Left',
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
            ->scalar('reg_text')
            ->maxLength('reg_text', 25)
            ->requirePresence('reg_text', 'create')
            ->notEmptyString('reg_text');

        $validator
            ->requirePresence('reg_num', 'create')
            ->notEmptyString('reg_num');

        $validator
            ->date('issued_date')
            ->allowEmptyDate('issued_date');

        // $validator
        //     ->scalar('doc_file')
        //     ->maxLength('doc_file', 255)
        //     ->allowEmptyString('doc_file');

        $validator
            ->scalar('subject')
            ->requirePresence('subject', 'create')
            ->notEmptyString('subject');

        $validator
            ->scalar('remark')
            ->allowEmptyString('remark');

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
        $rules->add($rules->existsIn(['doc_internal_type_id'], 'DocInternalTypes'), ['errorField' => 'doc_internal_type_id']);
        $rules->add($rules->existsIn(['doc_status_id'], 'DocStatuses'), ['errorField' => 'doc_status_id']);
        $rules->add($rules->existsIn(['doc_sec_level_id'], 'DocSecLevels'), ['errorField' => 'doc_sec_level_id']);
   
        $rules->add($rules->existsIn(['department_id'], 'Departments'), ['errorField' => 'department_id']);
        $rules->add($rules->existsIn(['originator_id'], 'Originators'), ['errorField' => 'originator_id']);
        $rules->add($rules->existsIn(['inputter_id'], 'Inputters'), ['errorField' => 'inputter_id']);
        $rules->add($rules->existsIn(['modifier_id'], 'Modifiers'), ['errorField' => 'modifier_id']);

        return $rules;
    }

    public function saveNewDoc(DocInternal $docInternal)
    {
        $today = FrozenDate::now();
        $docInternal->reg_date = $today;

        $docNum = 1 + $this->find('all', [
            'fields' => ['id', 'reg_num', 'doc_company_id',  'reg_date'],
            'conditions' => ['reg_date >=' => $today->format('Y') . '-01-01',
                            'reg_date <=' => $today->format('Y') . '-12-31',
                            'is_reserved' => false,
                            'reg_num >' => DocInternalsTable::DOC_NUM_OFFSET,
                            ]
                ])->count();

        //$company = $this->DocCompanies->get($docInternal->doc_company_id);
        //$department = $this->Departments->get($docInternal->department_id);

        while ($this->exists(['reg_num' => $docNum])) {
            $docNum ++;
        }
        
        $docInternal->reg_num = DocInternalsTable::DOC_NUM_OFFSET + $docNum;
        $docInternal->reg_text = 'INT/' . $today->format('y-') . sprintf('%03d', $docInternal->reg_num);


        if ($this->save($docInternal)) {
            return true;
        } else {
            return false;
        }
    }

    public function saveReserveDoc(DocInternal $docInternal)
    {

        
        $docInternal->reg_text = 'INT/' . $docInternal->reg_date->format('y-') . sprintf('%03d', $docInternal->reg_num);


        if ($this->save($docInternal)) {
            return true;
        } else {
            return false;
        }
    }

    public function saveEditedDoc(DocInternal $docInternal)
    {

        //$company = $this->DocCompanies->get($docInternal->doc_company_id);
        //$department = $this->Departments->get($docInternal->department_id);

        $docInternal->reg_text = 'INT/' . $docInternal->reg_date->format('y-') . sprintf('%03d', $docInternal->reg_num);


        if ($this->save($docInternal)) {
            return true;
        } else {
            return false;
        }
    }

    /*
    public function findAJAX($criteria, $limit = 25)
    {
        $results = null;

        if ($criteria != "") {
            $docInternals = $this->find('all', [
                'fields' => ['id', 'reg_text', 'subject'], 'conditions' => ['OR' => ['reg_text LIKE' => '%' . $criteria . '%',  'subject LIKE' => '%' . $criteria . '%']], 'limit' => $limit
            ]);
            //$results['criteria'] = $criteria;

            $iCount = 0;
            foreach ($docInternals as $docInternal) {
                $results[$iCount]['id'] = $docInternal->id;
                $results[$iCount]['text'] = $docInternal->reg_text . ' - ' . $docInternal->subject;
                $iCount++;
            }
        }

        return $results;
    }
    */

    public function findAJAX($criteria, $limit = 25)
    {
        $results = null;

        if ($criteria != "") {
            $docInternals = $this->find('list', [
                'conditions' => ['OR' => ['reg_text LIKE' => '%' . $criteria . '%',  'subject LIKE' => '%' . $criteria . '%']], 'limit' => $limit
            ]);
            
            $result = $docInternals;
        }

        return $results;
    }

}
