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
 * OrderReqs Model
 *
 * @property \App\Model\Table\OrTypesTable&\Cake\ORM\Association\BelongsTo $OrTypes
 * @property \App\Model\Table\DocCompaniesTable&\Cake\ORM\Association\BelongsTo $DocCompanies
 * @property \App\Model\Table\DepartmentsTable&\Cake\ORM\Association\BelongsTo $Departments
 * @property \App\Model\Table\CurrenciesTable&\Cake\ORM\Association\BelongsTo $Currencies
 * @property \App\Model\Table\CpMethodsTable&\Cake\ORM\Association\BelongsTo $CpMethods
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Originators
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Handlers
 * @property \App\Model\Table\DeliAddressesTable&\Cake\ORM\Association\BelongsTo $DeliAddresses
 * @property \App\Model\Table\PartnersTable&\Cake\ORM\Association\BelongsTo $SingleSources
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $GroupLeaders
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $DeptLeaders
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $FinVerifiers
 * @property \App\Model\Table\OrStatusesTable&\Cake\ORM\Association\BelongsTo $OrStatuses
 * @property \App\Model\Table\OrItemsTable&\Cake\ORM\Association\HasMany $OrItems
 * @property \App\Model\Table\OrSuppliersTable&\Cake\ORM\Association\HasMany $OrSuppliers
 *
 * @method \App\Model\Entity\OrderReq newEmptyEntity()
 * @method \App\Model\Entity\OrderReq newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\OrderReq[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OrderReq get($primaryKey, $options = [])
 * @method \App\Model\Entity\OrderReq findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\OrderReq patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\OrderReq[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\OrderReq|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrderReq saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrderReq[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\OrderReq[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\OrderReq[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\OrderReq[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OrderReqsTable extends Table
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

        $this->setTable('order_reqs');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('OrTypes', [
            'foreignKey' => 'or_type_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('DocCompanies', [
            'foreignKey' => 'doc_company_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Departments', [
            'foreignKey' => 'department_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Currencies', [
            'foreignKey' => 'currency_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('CpMethods', [
            'foreignKey' => 'cp_method_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Originators', [
            'className' => 'Users',
            'foreignKey' => 'originator_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Handlers', [
            'className' => 'Users',
            'foreignKey' => 'handler_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('DeliAddresses', [
            'foreignKey' => 'deli_address_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('SingleSources', [
            'className' => 'Partners',
            'foreignKey' => 'single_source_id',
        ]);
        $this->belongsTo('GroupLeaders', [
            'className' => 'Users',
            'foreignKey' => 'group_leader_id',
        ]);
        $this->belongsTo('DeptLeaders', [
            'className' => 'Users',
            'foreignKey' => 'dept_leader_id',
        ]);
        $this->belongsTo('FinVerifiers', [
            'className' => 'Users',
            'foreignKey' => 'fin_verifier_id',
        ]);
        $this->belongsTo('OrStatuses', [
            'foreignKey' => 'or_status_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('OrItems', [
            'foreignKey' => 'order_req_id',
            'saveStrategy' => 'replace',
        ]);
        $this->hasMany('OrUploads', [
            'foreignKey' => 'order_req_id',
            //'joinType' => 'LEFT',
            'saveStrategy' => 'replace',
        ]);
        $this->hasMany('OrSuppliers', [
            'foreignKey' => 'order_req_id',
            'saveStrategy' => 'replace',

        ]);

        $this->belongsToMany('Suppliers', [
            'className' => 'Partners',
            'targetForeignKey' => 'partner_id',
            'foreignKey' => 'order_req_id',
            'joinTable' => 'order_reqs_partners',
            'joinType' => 'LEFT',
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
            ->maxLength('name', 250)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('req_num')
            ->maxLength('req_num', 20)
            ->allowEmptyString('req_num');

        $validator
            ->date('submit_date')
            ->allowEmptyDate('submit_date');

        $validator
            ->date('required_date')
            ->allowEmptyDate('required_date');

        $validator
            ->scalar('contract_num')
            ->maxLength('contract_num', 30)
            ->allowEmptyString('contract_num');

        $validator
            ->scalar('budget_code')
            ->maxLength('budget_code', 20)
            ->allowEmptyString('budget_code');

        $validator
            ->scalar('intended_use')
            ->allowEmptyString('intended_use');

        $validator
            ->scalar('justification')
            ->allowEmptyString('justification');

        $validator
            ->dateTime('group_approve_time')
            ->allowEmptyDateTime('group_approve_time');

        $validator
            ->dateTime('dept_approve_time')
            ->allowEmptyDateTime('dept_approve_time');

        $validator
            ->dateTime('fin_approve_time')
            ->allowEmptyDateTime('fin_approve_time');

        $validator
            ->allowEmptyString('est_total');

        $validator
            ->allowEmptyString('exch_rate');

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
        $rules->add($rules->existsIn(['or_type_id'], 'OrTypes'), ['errorField' => 'or_type_id']);
        $rules->add($rules->existsIn(['doc_company_id'], 'DocCompanies'), ['errorField' => 'doc_company_id']);
        $rules->add($rules->existsIn(['department_id'], 'Departments'), ['errorField' => 'department_id']);
        $rules->add($rules->existsIn(['currency_id'], 'Currencies'), ['errorField' => 'currency_id']);
        $rules->add($rules->existsIn(['originator_id'], 'Originators'), ['errorField' => 'originator_id']);
        $rules->add($rules->existsIn(['deli_address_id'], 'DeliAddresses'), ['errorField' => 'deli_address_id']);
        $rules->add($rules->existsIn(['single_source_id'], 'SingleSources'), ['errorField' => 'single_source_id']);
        $rules->add($rules->existsIn(['group_leader_id'], 'GroupLeaders'), ['errorField' => 'group_leader_id']);
        $rules->add($rules->existsIn(['dept_leader_id'], 'DeptLeaders'), ['errorField' => 'dept_leader_id']);
        $rules->add($rules->existsIn(['fin_verifier_id'], 'FinVerifiers'), ['errorField' => 'fin_verifier_id']);
        $rules->add($rules->existsIn(['or_status_id'], 'OrStatuses'), ['errorField' => 'or_status_id']);
        $rules->add($rules->existsIn(['cp_method_id'], 'CpMethods'), ['errorField' => 'cp_method_id']);

        return $rules;
    }

    public function beforeMarshal(EventInterface $event, ArrayObject $data, ArrayObject $options)
    {
        if (isset($data['est_total'])) {
            $data['est_total'] = str_replace(',', '', $data['est_total']);
        }
        if (isset($data['exch_rate'])) {
            $data['exch_rate'] = str_replace(',', '', $data['exch_rate']);
        }
    }
}
