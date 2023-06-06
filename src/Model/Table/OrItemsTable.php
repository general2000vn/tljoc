<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\EventInterface;
use ArrayObject;

/**
 * OrItems Model
 *
 * @property \App\Model\Table\OrderReqsTable&\Cake\ORM\Association\BelongsTo $OrderReqs
 *
 * @method \App\Model\Entity\OrItem newEmptyEntity()
 * @method \App\Model\Entity\OrItem newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\OrItem[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OrItem get($primaryKey, $options = [])
 * @method \App\Model\Entity\OrItem findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\OrItem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\OrItem[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\OrItem|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrItem saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrItem[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\OrItem[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\OrItem[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\OrItem[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class OrItemsTable extends Table
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

        $this->setTable('or_items');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('OrderReqs', [
            'foreignKey' => 'order_req_id',
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
            ->scalar('name')
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->nonNegativeInteger('quantity')
            ->requirePresence('quantity', 'create')
            ->notEmptyString('quantity');

        // $validator
        //     ->nonNegativeInteger('price');

        $validator
            ->scalar('code')
            ->maxLength('code', 20)
            ->allowEmptyString('code');

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
        $rules->add($rules->existsIn(['order_req_id'], 'OrderReqs'), ['errorField' => 'order_req_id']);

        return $rules;
    }

    public function beforeMarshal(EventInterface $event, ArrayObject $data, ArrayObject $options)
    {
        if (isset($data['price'])) {
            $data['price'] = str_replace(',', '', $data['price']);

            if ($data['price'] == '') {
                $data['price'] = null;
            }
        }
        

    }
}
