<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DeliAddresses Model
 *
 * @property \App\Model\Table\OrderReqsTable&\Cake\ORM\Association\HasMany $OrderReqs
 *
 * @method \App\Model\Entity\DeliAddress newEmptyEntity()
 * @method \App\Model\Entity\DeliAddress newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\DeliAddress[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DeliAddress get($primaryKey, $options = [])
 * @method \App\Model\Entity\DeliAddress findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\DeliAddress patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DeliAddress[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\DeliAddress|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DeliAddress saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DeliAddress[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DeliAddress[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\DeliAddress[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DeliAddress[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class DeliAddressesTable extends Table
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

        $this->setTable('deli_addresses');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('OrderReqs', [
            'foreignKey' => 'deli_address_id',
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
            ->maxLength('name', 50)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('address')
            ->requirePresence('address', 'create')
            ->notEmptyString('address');

        $validator
            ->boolean('is_deleted')
            ->notEmptyString('is_deleted');

        $validator
            ->requirePresence('display_order', 'create')
            ->notEmptyString('display_order');

        return $validator;
    }
}
