<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DashboardPrdYears Model
 *
 * @method \App\Model\Entity\DashboardPrdYear newEmptyEntity()
 * @method \App\Model\Entity\DashboardPrdYear newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\DashboardPrdYear[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DashboardPrdYear get($primaryKey, $options = [])
 * @method \App\Model\Entity\DashboardPrdYear findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\DashboardPrdYear patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DashboardPrdYear[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\DashboardPrdYear|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DashboardPrdYear saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DashboardPrdYear[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DashboardPrdYear[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\DashboardPrdYear[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DashboardPrdYear[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class DashboardPrdYearsTable extends Table
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

        $this->setTable('dashboard_prd_years');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->requirePresence('target_year', 'create')
            ->notEmptyString('target_year');

        $validator
            ->nonNegativeInteger('cnv_target')
            ->requirePresence('cnv_target', 'create')
            ->notEmptyString('cnv_target');

        $validator
            ->nonNegativeInteger('tgt_target')
            ->requirePresence('tgt_target', 'create')
            ->notEmptyString('tgt_target');

        return $validator;
    }
}
