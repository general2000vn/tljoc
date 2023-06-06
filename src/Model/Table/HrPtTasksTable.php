<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use EmailQueue\EmailQueue;

/**
 * HrPtTasks Model
 *
 * @property \App\Model\Table\HrPTaskStatusesTable&\Cake\ORM\Association\BelongsTo $HrPTaskStatuses
 * @property \App\Model\Table\HrTaskCategoriesTable&\Cake\ORM\Association\BelongsTo $HrTaskCategories
 * @property \App\Model\Table\ModifiersTable&\Cake\ORM\Association\BelongsTo $Modifiers
 * @property \App\Model\Table\HrPtsTable&\Cake\ORM\Association\BelongsTo $HrPts
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsToMany $Users
 *
 * @method \App\Model\Entity\HrPtTask newEmptyEntity()
 * @method \App\Model\Entity\HrPtTask newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\HrPtTask[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\HrPtTask get($primaryKey, $options = [])
 * @method \App\Model\Entity\HrPtTask findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\HrPtTask patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\HrPtTask[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\HrPtTask|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\HrPtTask saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\HrPtTask[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\HrPtTask[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\HrPtTask[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\HrPtTask[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class HrPtTasksTable extends Table
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

        $this->setTable('hr_pt_tasks');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('HrPTaskStatuses', [
            'foreignKey' => 'hr_p_task_status_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Modifiers', [
            'className' => 'Users',
            'foreignKey' => 'modifier_id',
            'joinType' => 'LEFT',
        ]);
        $this->belongsTo('HrPts', [
            'foreignKey' => 'hr_pt_id',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('HrTaskCategories', [
            'foreignKey' => 'hr_task_category_id',
            'joinType' => 'INNER',
        ]);

        $this->belongsToMany('Users', [
            'foreignKey' => 'hr_pt_task_id',
            'targetForeignKey' => 'user_id',
            'joinTable' => 'hr_pt_tasks_users',
            'joinType' => 'INNER',
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
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->date('reminding_date')
            ->allowEmptyDate('reminding_date');

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
        $rules->add($rules->existsIn(['hr_p_task_status_id'], 'HrPTaskStatuses'), ['errorField' => 'hr_p_task_status_id']);
        $rules->add($rules->existsIn(['modifier_id'], 'Modifiers'), ['errorField' => 'modifier_id']);
        $rules->add($rules->existsIn(['hr_pt_id'], 'HrPts'), ['errorField' => 'hr_pt_id']);

        return $rules;
    }

    public function extendDeadline($id){
        $remind_interval = 3;
        
        $task = $this->get($id);
        
        
        $task->reminding_date = $task->reminding_date->addDay($remind_interval);
        $this->save($task);
    }
}
