<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Healths Model
 *
 * @property \App\Model\Table\TimesheetsTable&\Cake\ORM\Association\HasMany $Timesheets
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\HasMany $Users
 *
 * @method \App\Model\Entity\Health newEmptyEntity()
 * @method \App\Model\Entity\Health newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Health[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Health get($primaryKey, $options = [])
 * @method \App\Model\Entity\Health findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Health patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Health[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Health|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Health saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Health[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Health[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Health[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Health[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class HealthsTable extends Table
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

        $this->setTable('healths');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Timesheets', [
            'foreignKey' => 'health_id',
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'health_id',
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
            ->maxLength('name', 30)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        return $validator;
    }
}
