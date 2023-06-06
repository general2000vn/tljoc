<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TestAs Model
 *
 * @property \App\Model\Table\TestBsTable&\Cake\ORM\Association\BelongsToMany $TestBs
 *
 * @method \App\Model\Entity\TestA newEmptyEntity()
 * @method \App\Model\Entity\TestA newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\TestA[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TestA get($primaryKey, $options = [])
 * @method \App\Model\Entity\TestA findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\TestA patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TestA[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\TestA|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TestA saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TestA[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\TestA[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\TestA[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\TestA[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class TestAsTable extends Table
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

        $this->setTable('test_as');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsToMany('TestBs', [
            'foreignKey' => 'test_a_id',
            'targetForeignKey' => 'test_b_id',
            'joinTable' => 'test_as_test_bs',
        ]);

        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'file' => ['path' => 'webroot{DS}uploads{DS}test{DS}'],
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
