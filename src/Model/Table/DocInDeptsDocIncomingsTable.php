<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DocInDeptsDocIncomings Model
 *
 * @property \App\Model\Table\DocIncomingsTable&\Cake\ORM\Association\BelongsTo $DocIncomings
 *
 * @method \App\Model\Entity\DocInDeptsDocIncoming newEmptyEntity()
 * @method \App\Model\Entity\DocInDeptsDocIncoming newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\DocInDeptsDocIncoming[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DocInDeptsDocIncoming get($primaryKey, $options = [])
 * @method \App\Model\Entity\DocInDeptsDocIncoming findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\DocInDeptsDocIncoming patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DocInDeptsDocIncoming[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\DocInDeptsDocIncoming|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DocInDeptsDocIncoming saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DocInDeptsDocIncoming[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DocInDeptsDocIncoming[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\DocInDeptsDocIncoming[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DocInDeptsDocIncoming[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class DocInDeptsDocIncomingsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('doc_in_depts_doc_incomings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('DocInDepts', [
            'foreignKey' => 'doc_in_dept_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('DocIncomings', [
            'foreignKey' => 'doc_incoming_id',
            'joinType' => 'INNER',
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
        $rules->add($rules->existsIn(['doc_in_dept_id'], 'DocInDepts'), ['errorField' => 'doc_in_dept_id']);
        $rules->add($rules->existsIn(['doc_incoming_id'], 'DocIncomings'), ['errorField' => 'doc_incoming_id']);

        return $rules;
    }
}
