<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * HseStats Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\HseStat newEmptyEntity()
 * @method \App\Model\Entity\HseStat newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\HseStat[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\HseStat get($primaryKey, $options = [])
 * @method \App\Model\Entity\HseStat findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\HseStat patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\HseStat[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\HseStat|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\HseStat saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\HseStat[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\HseStat[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\HseStat[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\HseStat[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class HseStatsTable extends Table
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

        $this->setTable('hse_stats');
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
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->date('from_date')
            ->allowEmptyDate('from_date');

        $validator
            ->nonNegativeInteger('lost_time')
            ->requirePresence('lost_time', 'create')
            ->notEmptyString('lost_time');

        $validator
            ->nonNegativeInteger('med_treat_case')
            ->requirePresence('med_treat_case', 'create')
            ->notEmptyString('med_treat_case');

        $validator
            ->nonNegativeInteger('first_aid_case')
            ->requirePresence('first_aid_case', 'create')
            ->notEmptyString('first_aid_case');

        $validator
            ->nonNegativeInteger('fire_explosion')
            ->requirePresence('fire_explosion', 'create')
            ->notEmptyString('fire_explosion');

        $validator
            ->nonNegativeInteger('near_miss')
            ->requirePresence('near_miss', 'create')
            ->notEmptyString('near_miss');

        $validator
            ->nonNegativeInteger('obs_card')
            ->requirePresence('obs_card', 'create')
            ->notEmptyString('obs_card');

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
