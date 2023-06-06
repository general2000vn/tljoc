<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Partners Model
 *
 * @property \App\Model\Table\DocIncomingsTable&\Cake\ORM\Association\HasMany $DocIncomings
 * @property \App\Model\Table\DocOutgoingsTable&\Cake\ORM\Association\BelongsToMany $DocOutgoings
 *
 * @method \App\Model\Entity\Partner newEmptyEntity()
 * @method \App\Model\Entity\Partner newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Partner[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Partner get($primaryKey, $options = [])
 * @method \App\Model\Entity\Partner findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Partner patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Partner[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Partner|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Partner saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Partner[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Partner[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Partner[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Partner[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PartnersTable extends Table
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

        $this->setTable('partners');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('NullText', ['fields' => ['name', 'name2']]);

        $this->belongsTo('Modifiers', [
            'className' => 'Users',
            'foreignKey' => 'modifier_id',
        ]);
        $this->hasMany('DocIncomings', [
            'foreignKey' => 'partner_id',
        ]);
        $this->belongsToMany('DocOutgoings', [
            'foreignKey' => 'partner_id',
            'targetForeignKey' => 'doc_outgoing_id',
            'joinTable' => 'doc_outgoings_partners',
        ]);
        $this->belongsToMany('OrderReqs', [
            'foreignKey' => 'partner_id',
            'targetForeignKey' => 'order_req_id',
            'joinTable' => 'order_reqs_partners',
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
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmptyString('name')
            ->add('name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table'])
            ;

        $validator
            ->scalar('name2')
            ->maxLength('name2', 100)
            ->allowEmptyString('name2')
            ->add('name2', 'unique', ['rule' => 'validateUnique', 'provider' => 'table'])
            ;

        $validator
            ->scalar('contact')
            ->maxLength('contact', 100)
            ->allowEmptyString('contact');

        $validator
            ->scalar('entity_code')
            ->maxLength('entity_code', 5)
            ->allowEmptyString('entity_code');

        $validator
            ->scalar('tax_code')
            ->maxLength('tax_code', 15)
            ->allowEmptyString('tax_code');

        $validator
            ->email('email')
            ->maxLength('phone', 100)
            ->allowEmptyString('email');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 30)
            ->allowEmptyString('phone');

        $validator
            ->scalar('fax')
            ->maxLength('fax', 30)
            ->allowEmptyString('fax');

        $validator
            ->scalar('address1')
            ->maxLength('address1', 70)
            ->allowEmptyString('address1');

        $validator
            ->scalar('address2')
            ->maxLength('address2', 50)
            ->allowEmptyString('address2');

        $validator
            ->scalar('address3')
            ->maxLength('address3', 50)
            ->allowEmptyString('address3');

        $validator
            ->scalar('account_no')
            ->maxLength('account_no', 25)
            ->allowEmptyString('account_no');

        $validator
            ->scalar('account_name')
            ->maxLength('account_name', 100)
            ->allowEmptyString('account_name');

        $validator
            ->scalar('bank_name')
            ->maxLength('bank_name', 70)
            ->allowEmptyString('bank_name');

        $validator
            ->scalar('bank_branch')
            ->maxLength('bank_branch', 40)
            ->allowEmptyString('bank_branch');

        $validator
            ->scalar('bank_code')
            ->maxLength('bank_code', 40)
            ->allowEmptyString('bank_code');

                        

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
        $rules->add($rules->isUnique(['name']), ['errorField' => 'name']);
        $rules->add($rules->isUnique(['name2'],['allowMultipleNulls' => true]), ['errorField' => 'name2']);
        $rules->add($rules->existsIn(['modifier_id'], 'Modifiers'), ['errorField' => 'modifier_id']);

        return $rules;
    }

    public function findAJAX($criteria, $limit = 100)
    {
        $results = null;

        if ($criteria != "") {
            $partners = $this->find('all', [
                'fields' => ['id', 'name', 'name2'], 'conditions' => ['OR' => ['name LIKE' => '%' . $criteria . '%', 'name2 LIKE' => '%' . $criteria . '%']], 'limit' => $limit
            ]);
            

            $iCount = 0;
            foreach ($partners as $partner) {
                $results[$iCount]['id'] = $partner->id;
                $results[$iCount]['text'] = $partner->name2 . ' - ' . $partner->name;
                $iCount++;
            }
        } 

        return $results;
    }
}
