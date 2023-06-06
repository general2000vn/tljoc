<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * HrTaskCategories Model
 *
 * @property \App\Model\Table\HrPtTasksTable&\Cake\ORM\Association\HasMany $HrPtTasks
 *
 * @method \App\Model\Entity\HrTaskCategory newEmptyEntity()
 * @method \App\Model\Entity\HrTaskCategory newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\HrTaskCategory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\HrTaskCategory get($primaryKey, $options = [])
 * @method \App\Model\Entity\HrTaskCategory findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\HrTaskCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\HrTaskCategory[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\HrTaskCategory|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\HrTaskCategory saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\HrTaskCategory[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\HrTaskCategory[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\HrTaskCategory[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\HrTaskCategory[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class HrTaskCategoriesTable extends Table
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

        $this->setTable('hr_task_categories');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('HrPtTasks', [
            'foreignKey' => 'hr_task_category_id',
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

        return $validator;
    }
}
