<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OrStatuses Model
 *
 * @property \App\Model\Table\OrderReqsTable&\Cake\ORM\Association\HasMany $OrderReqs
 *
 * @method \App\Model\Entity\OrStatus newEmptyEntity()
 * @method \App\Model\Entity\OrStatus newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\OrStatus[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OrStatus get($primaryKey, $options = [])
 * @method \App\Model\Entity\OrStatus findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\OrStatus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\OrStatus[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\OrStatus|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrStatus saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrStatus[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\OrStatus[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\OrStatus[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\OrStatus[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class OrStatusesTable extends Table
{
    const S_DRAFT = 1;
    const S_GROUP_APPROVING = 2;
    const S_DEPT_APPROVING = 3;
    const S_ISSUED = 4;
    const S_DISAPPROVED = 5;
    const S_PROCESSING = 6;
    const S_COMPLETED = 7;
    const S_CANCELLED = 8;
    
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('or_statuses');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('OrderReqs', [
            'foreignKey' => 'or_status_id',
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
            ->maxLength('name', 20)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->boolean('is_deleted')
            ->notEmptyString('is_deleted');

        $validator
            ->requirePresence('display_order', 'create')
            ->notEmptyString('display_order');

        return $validator;
    }
}
