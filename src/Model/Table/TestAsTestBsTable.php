<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TestAsTestBs Model
 *
 * @property \App\Model\Table\TestAsTable&\Cake\ORM\Association\BelongsTo $TestAs
 * @property \App\Model\Table\TestBsTable&\Cake\ORM\Association\BelongsTo $TestBs
 *
 * @method \App\Model\Entity\TestAsTestB newEmptyEntity()
 * @method \App\Model\Entity\TestAsTestB newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\TestAsTestB[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TestAsTestB get($primaryKey, $options = [])
 * @method \App\Model\Entity\TestAsTestB findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\TestAsTestB patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TestAsTestB[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\TestAsTestB|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TestAsTestB saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TestAsTestB[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\TestAsTestB[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\TestAsTestB[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\TestAsTestB[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class TestAsTestBsTable extends Table
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

        $this->setTable('test_as_test_bs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('TestAs', [
            'foreignKey' => 'test_a_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('TestBs', [
            'foreignKey' => 'test_b_id',
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
        $rules->add($rules->existsIn(['test_a_id'], 'TestAs'), ['errorField' => 'test_a_id']);
        $rules->add($rules->existsIn(['test_b_id'], 'TestBs'), ['errorField' => 'test_b_id']);

        return $rules;
    }
}
