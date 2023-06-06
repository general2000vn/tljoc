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
class TestFAMsTable extends Table
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

        $this->setTable('dbo.AD.tbl_status');
        $this->setDisplayField('Status_Name');
        $this->setPrimaryKey('Status_ID');
        $this->setConnection('fam');
        

       
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
            ->integer('Status_ID')
            ->allowEmptyString('Status_ID', null, 'create');

        $validator
            ->scalar('Status_Name')
            ->maxLength('Status_Name', 25)
            ->requirePresence('Status_Name', 'create')
            ->notEmptyString('Status_Name');

        return $validator;
    }
}
