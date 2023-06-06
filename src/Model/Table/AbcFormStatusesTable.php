<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AbcFormStatuses Model
 *
 * @method \App\Model\Entity\AbcFormStatus newEmptyEntity()
 * @method \App\Model\Entity\AbcFormStatus newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\AbcFormStatus[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AbcFormStatus get($primaryKey, $options = [])
 * @method \App\Model\Entity\AbcFormStatus findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\AbcFormStatus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AbcFormStatus[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\AbcFormStatus|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AbcFormStatus saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AbcFormStatus[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\AbcFormStatus[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\AbcFormStatus[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\AbcFormStatus[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class AbcFormStatusesTable extends Table
{
    const S_INITIATED = 1;
    const S_DRAFT = 2;
    const S_SUBMITTED = 3;
    const S_ACKNOWLEDGED = 4;
    const S_REJECTED = 5;

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('abc_form_statuses');
        $this->setDisplayField('name');
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
            ->scalar('name')
            ->maxLength('name', 15)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        return $validator;
    }
}
