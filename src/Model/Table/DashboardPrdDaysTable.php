<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DashboardPrdDays Model
 *
 * @method \App\Model\Entity\DashboardPrdDay newEmptyEntity()
 * @method \App\Model\Entity\DashboardPrdDay newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\DashboardPrdDay[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DashboardPrdDay get($primaryKey, $options = [])
 * @method \App\Model\Entity\DashboardPrdDay findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\DashboardPrdDay patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DashboardPrdDay[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\DashboardPrdDay|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DashboardPrdDay saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DashboardPrdDay[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DashboardPrdDay[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\DashboardPrdDay[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DashboardPrdDay[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DashboardPrdDaysTable extends Table
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

        $this->setTable('dashboard_prd_days');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
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
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->date('stat_date')
            ->requirePresence('stat_date', 'create')
            ->notEmptyDate('stat_date');

        $validator
            ->nonNegativeInteger('oil_rate_cnv')
            ->requirePresence('oil_rate_cnv', 'create')
            ->notEmptyString('oil_rate_cnv');

        $validator
            ->nonNegativeInteger('oil_rate_tgt')
            ->requirePresence('oil_rate_tgt', 'create')
            ->notEmptyString('oil_rate_tgt');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
