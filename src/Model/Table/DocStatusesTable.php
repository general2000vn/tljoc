<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DocStatuses Model
 *
 * @property \App\Model\Table\DocIncomingsTable&\Cake\ORM\Association\HasMany $DocIncomings
 *
 * @method \App\Model\Entity\DocStatus newEmptyEntity()
 * @method \App\Model\Entity\DocStatus newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\DocStatus[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DocStatus get($primaryKey, $options = [])
 * @method \App\Model\Entity\DocStatus findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\DocStatus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DocStatus[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\DocStatus|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DocStatus saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DocStatus[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DocStatus[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\DocStatus[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DocStatus[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class DocStatusesTable extends Table
{
    public const S_IN_PROGRESS = 1;
    public const S_DISTRIBUTED = 2;
    public const S_CANCELLED = 3;

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('doc_statuses');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('DocIncomings', [
            'foreignKey' => 'doc_status_id',
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
            ->maxLength('name', 25)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        return $validator;
    }
}
