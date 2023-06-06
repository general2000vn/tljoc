<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CpMethods Model
 *
 * @property \App\Model\Table\OrderReqsTable&\Cake\ORM\Association\HasMany $OrderReqs
 *
 * @method \App\Model\Entity\CpMethod newEmptyEntity()
 * @method \App\Model\Entity\CpMethod newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\CpMethod[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CpMethod get($primaryKey, $options = [])
 * @method \App\Model\Entity\CpMethod findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\CpMethod patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CpMethod[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\CpMethod|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CpMethod saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CpMethod[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\CpMethod[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\CpMethod[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\CpMethod[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class CpMethodsTable extends Table
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

        $this->setTable('cp_methods');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('OrderReqs', [
            'foreignKey' => 'cp_method_id',
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
            ->maxLength('name', 20)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        return $validator;
    }
}
