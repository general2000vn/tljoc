<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OilPrices Model
 *
 * @method \App\Model\Entity\OilPrice newEmptyEntity()
 * @method \App\Model\Entity\OilPrice newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\OilPrice[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OilPrice get($primaryKey, $options = [])
 * @method \App\Model\Entity\OilPrice findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\OilPrice patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\OilPrice[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\OilPrice|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OilPrice saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OilPrice[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\OilPrice[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\OilPrice[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\OilPrice[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class OilPricesTable extends Table
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

        $this->setTable('oil_prices');
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
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->numeric('brent')
            ->allowEmptyString('brent');

        $validator
            ->numeric('wti')
            ->allowEmptyString('wti');

        $validator
            ->numeric('usd')
            ->allowEmptyString('usd');

        $validator
            ->date('update_date')
            ->requirePresence('update_date', 'create')
            ->notEmptyDate('update_date');

        $validator
            ->time('update_time')
            ->requirePresence('update_time', 'create')
            ->notEmptyTime('update_time');

        $validator
            ->dateTime('update_timestamp')
            ->notEmptyDateTime('update_timestamp');

        return $validator;
    }
}
