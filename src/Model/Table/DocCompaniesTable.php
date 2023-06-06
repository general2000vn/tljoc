<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DocCompanies Model
 *
 * @property \App\Model\Table\DocIncomingsTable&\Cake\ORM\Association\HasMany $DocIncomings
 *
 * @method \App\Model\Entity\DocCompany newEmptyEntity()
 * @method \App\Model\Entity\DocCompany newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\DocCompany[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DocCompany get($primaryKey, $options = [])
 * @method \App\Model\Entity\DocCompany findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\DocCompany patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DocCompany[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\DocCompany|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DocCompany saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DocCompany[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DocCompany[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\DocCompany[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DocCompany[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class DocCompaniesTable extends Table
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

        $this->setTable('doc_companies');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('DocIncomings', [
            'foreignKey' => 'doc_company_id',
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
            ->maxLength('name', 10)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        return $validator;
    }
}
