<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DocSecLevels Model
 *
 * @property \App\Model\Table\DocIncomingsTable&\Cake\ORM\Association\HasMany $DocIncomings
 *
 * @method \App\Model\Entity\DocSecLevel newEmptyEntity()
 * @method \App\Model\Entity\DocSecLevel newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\DocSecLevel[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DocSecLevel get($primaryKey, $options = [])
 * @method \App\Model\Entity\DocSecLevel findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\DocSecLevel patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DocSecLevel[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\DocSecLevel|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DocSecLevel saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DocSecLevel[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DocSecLevel[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\DocSecLevel[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DocSecLevel[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class DocSecLevelsTable extends Table
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

        $this->setTable('doc_sec_levels');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('DocIncomings', [
            'foreignKey' => 'doc_sec_level_id',
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
            ->maxLength('name', 15)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('description')
            ->maxLength('description', 255)
            ->allowEmptyString('description');

        return $validator;
    }
}
