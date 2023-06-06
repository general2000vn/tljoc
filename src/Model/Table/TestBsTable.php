<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TestBs Model
 *
 * @property \App\Model\Table\TestAsTable&\Cake\ORM\Association\BelongsToMany $TestAs
 *
 * @method \App\Model\Entity\TestB newEmptyEntity()
 * @method \App\Model\Entity\TestB newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\TestB[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TestB get($primaryKey, $options = [])
 * @method \App\Model\Entity\TestB findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\TestB patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TestB[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\TestB|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TestB saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TestB[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\TestB[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\TestB[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\TestB[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class TestBsTable extends Table
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

        $this->setTable('test_bs');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsToMany('TestAs', [
            'foreignKey' => 'test_b_id',
            'targetForeignKey' => 'test_a_id',
            'joinTable' => 'test_as_test_bs',
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
            ->scalar('name')
            ->maxLength('name', 5)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        return $validator;
    }
}
