<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DocInternalTypes Model
 *
 * @property \App\Model\Table\DocInternalsTable&\Cake\ORM\Association\HasMany $DocInternals
 *
 * @method \App\Model\Entity\DocInternalType newEmptyEntity()
 * @method \App\Model\Entity\DocInternalType newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\DocInternalType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DocInternalType get($primaryKey, $options = [])
 * @method \App\Model\Entity\DocInternalType findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\DocInternalType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DocInternalType[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\DocInternalType|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DocInternalType saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DocInternalType[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DocInternalType[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\DocInternalType[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DocInternalType[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class DocInternalTypesTable extends Table
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

        $this->setTable('doc_internal_types');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('DocInternals', [
            'foreignKey' => 'doc_internal_type_id',
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
            ->maxLength('name', 50)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        return $validator;
    }
}
