<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OilFields Model
 *
 * @property \App\Model\Table\DashboardPrdDaysTable&\Cake\ORM\Association\HasMany $DashboardPrdDays
 * @property \App\Model\Table\DashboardPrdYearsTable&\Cake\ORM\Association\HasMany $DashboardPrdYears
 *
 * @method \App\Model\Entity\OilField newEmptyEntity()
 * @method \App\Model\Entity\OilField newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\OilField[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OilField get($primaryKey, $options = [])
 * @method \App\Model\Entity\OilField findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\OilField patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\OilField[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\OilField|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OilField saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OilField[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\OilField[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\OilField[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\OilField[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class OilFieldsTable extends Table
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

        $this->setTable('oil_fields');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('DashboardPrdDays', [
            'foreignKey' => 'oil_field_id',
        ]);
        $this->hasMany('DashboardPrdYears', [
            'foreignKey' => 'oil_field_id',
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
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 40)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        return $validator;
    }
}
