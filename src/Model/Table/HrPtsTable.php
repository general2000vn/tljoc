<?php

declare(strict_types=1);

namespace App\Model\Table;

use App\Model\Entity\HrPStatus;
use App\Model\Entity\HrPt;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use EmailQueue\EmailQueue;
use Cake\I18n\FrozenDate;
use Cake\Core\Configure;

/**
 * HrPts Model
 *
 * @property \App\Model\Table\StaffsTable&\Cake\ORM\Association\BelongsTo $Staffs
 * @property \App\Model\Table\DepartmentsTable&\Cake\ORM\Association\BelongsTo $Departments
 * @property \App\Model\Table\SupervisorsTable&\Cake\ORM\Association\BelongsTo $Supervisors
 * @property \App\Model\Table\HrPStatusesTable&\Cake\ORM\Association\BelongsTo $HrPStatuses
 * @property \App\Model\Table\HrPtTasksTable&\Cake\ORM\Association\HasMany $HrPtTasks
 *
 * @method \App\Model\Entity\HrPt newEmptyEntity()
 * @method \App\Model\Entity\HrPt newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\HrPt[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\HrPt get($primaryKey, $options = [])
 * @method \App\Model\Entity\HrPt findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\HrPt patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\HrPt[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\HrPt|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\HrPt saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\HrPt[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\HrPt[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\HrPt[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\HrPt[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\HrPt[] findNeedRemindTasks()
 */
class HrPtsTable extends Table
{
    const REMIND_PENDING_DAY_COUNT = 5;
    const REMIND_INCOMPLETE_DAY_COUNT = 2;
    const REMIND_DAY_COUNT = 2;
    const CC_LM_DAY_COUNT = 20;

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {


        parent::initialize($config);

        $this->setTable('hr_pts');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Staffs', [
            'className' => 'Users',
            'foreignKey' => 'staff_id',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('Creators', [
            'className' => 'Users',
            'foreignKey' => 'creator_id',
            'joinType' => 'INNER',
        ]);

        // $this->belongsTo('Departments', [
        //     'foreignKey' => 'department_id',
        //     'joinType' => 'INNER',
        // ]);
        $this->belongsTo('Supervisors', [
            'foreignKey' => 'supervisor_id',
            'className' => 'Users',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('HrPStatuses', [
            'foreignKey' => 'hr_p_status_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('HrPtTasks', [
            'foreignKey' => 'hr_pt_id',
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
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->date('issued_date')
            ->requirePresence('issued_date', 'create')
            ->notEmptyString('issued_date');

        $validator
            ->date('last_date')
            ->requirePresence('last_date', 'create')
            ->notEmptyString('last_date');

        $validator
            ->date('o_last_date')
            ->requirePresence('o_last_date', 'create')
            ->notEmptyString('o_last_date');

        $validator
            ->scalar('position')
            ->maxLength('position', 30)
            ->allowEmptyString('position');

        $validator
            ->scalar('department')
            ->maxLength('department', 20);

        $validator
            ->numeric('work_year')
            ->greaterThanOrEqual('work_year', 0)
            ->requirePresence('work_year', 'create')
            ->notEmptyString('work_year');

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
        $rules->add($rules->existsIn(['staff_id'], 'Staffs'), ['errorField' => 'staff_id']);

        $rules->add($rules->existsIn(['supervisor_id'], 'Supervisors'), ['errorField' => 'supervisor_id']);
        $rules->add($rules->existsIn(['hr_p_status_id'], 'HrPStatuses'), ['errorField' => 'hr_p_status_id']);

        return $rules;
    }

    public function notifyPIC($id)
    {
        $hrPt = $this->get($id, [
            'contain' => [
                'HrPtTasks' => ['Users' => ['fields' => ['id', 'title', 'firstname', 'lastname', 'email']]],
                'Staffs' => ['fields' => ['id', 'title', 'firstname', 'lastname', 'email']],
                'Creators' => ['fields' => ['id', 'title', 'firstname', 'lastname', 'email']]
            ]
        ]);
        //$to = ['thanh@hlhvjoc.com.vn'];
        $to = array();
        $HR_Sup = $this->Staffs->getOneByRole(RolesTable::R_HR_SUP);
        $cc = array();
        $cc[] = $hrPt->creator->email;
        $cc[] = $HR_Sup->email;
        foreach ($hrPt->hr_pt_tasks as $task) {
            if ($task->hr_p_task_status_id != 3) { //incompleted


                foreach ($task->users as $user) {

                    $to[] = $user->email;
                }
            }
        }

        if (count($to) > 0) {
            $data = [
                'title' => $hrPt->staff->title,
                'name' => $hrPt->staff->name,
                'last_date' => $hrPt->last_date,
                'o_last_date' => $hrPt->o_last_date,
                'position' => $hrPt->position,
                'department' => $hrPt->department,
                'emp_type' => $hrPt->emp_type,
                'id' => $hrPt->id
            ];
            $options = [
                'subject' => '[e.Office HR] New task assigned for Pre-Termination: ' . $hrPt->staff->name,
                'layout' => 'eoffice',
                'template' => 'hr_pt_new_task',
                'format' => 'html',
                'config' => 'eoffice-cli',
                'from_name' => 'e.Office',
                'from_email' => Configure::read('from_email')
            ];

            EmailQueue::enqueue($to, $cc, $data, $options);
        }
    }

    public function isComplete($id){
        $task = $this->HrPtTasks->find('all', ['conditions' => ['hr_pt_id' => $id , 'hr_p_task_status_id <>' => HrPTaskStatusesTable::S_COMPLETED]
                                                ,'fields' => ['id', 'hr_pt_id', 'hr_p_task_status_id']
        ])->toArray();

        if (count($task) == 0){
            $this->notifyCompleted($id);
        }
    }

    public function notifyCompleted($id)
    {
        $hrPt = $this->get($id, [
            'contain' => [
                'Creator' => ['fields' => ['id', 'title', 'firstname', 'lastname', 'email']],
                'Staffs' => ['fields' => ['id', 'title', 'firstname', 'lastname', 'email']
                            ,'contain' => ['Departments']
                            ]
            ]
        ]);
        //$to = ['thanh@hlhvjoc.com.vn'];
        $to = array();
        $to[] = $hrPt->creator->email;

        $HR_Sup = $this->Staffs->getOneByRole(RolesTable::R_HR_SUP);
        $cc = array();
        $cc[] = $HR_Sup->email;


        
            $data = [
                'title' => $hrPt->staff->title,
                'staff_name' => $hrPt->staff->name,
                'staff_title' => $hrPt->staff->title,
                'last_date' => $hrPt->last_date,
                'o_last_date' => $hrPt->o_last_date,
                'position' => $hrPt->position,
                'department' => $hrPt->department,
                'emp_type' => $hrPt->emp_type,
                'hrPt_id' => $hrPt->id,
                'creator_name' => $hrPt->creator->name,
                'creator_title' => $hrPt->creator->title
            ];
            $options = [
                'subject' => '[e.Office HR] Pre-Termination has been completed: ' . $hrPt->staff->name,
                'layout' => 'eoffice',
                'template' => 'hr_pt_completed',
                'format' => 'html',
                'config' => 'eoffice-cli',
                'from_name' => 'e.Office',
                'from_email' => Configure::read('from_email')
            ];

            EmailQueue::enqueue($to, $cc, $data, $options);
        
    }

    public function findIncompletedTasks()
    {
        $incompleteHrPTs = $this->find()->where(['hr_p_status_id' => HrPStatusesTable::S_PENDING])
            ->contain('HrPtTasks', function (Query $q1) {
                return $q1
                    ->select(['id', 'hr_p_task_status_id', 'hr_pt_id', 'reminding_date'])
                    ->where(['HrPtTasks.hr_p_task_status_id' => HrPTaskStatusesTable::S_INCOMPLETE, 'reminding_date <=' => FrozenDate::today()->format('Y-m-d')])
                    ->contain('Users', function (Query $q2) {
                        return $q2->select(['id', 'title', 'firstname', 'lastname', 'email']);
                    });
            })
            ->contain('Staffs', function (Query $q2) {
                return $q2->where(['is_deleted' => false])->select(['id', 'title', 'firstname', 'lastname', 'email']);
            });

        return  $incompleteHrPTs->toArray();
    }

    public function findPendingTasks()
    {
        $incompleteHrPTs = $this->find()->where(['hr_p_status_id' => HrPStatusesTable::S_PENDING])
            ->contain('HrPtTasks', function (Query $q1) {
                return $q1
                    ->select(['id', 'hr_p_task_status_id', 'hr_pt_id', 'reminding_date'])
                    ->where(['HrPtTasks.hr_p_task_status_id' => HrPTaskStatusesTable::S_PENDING, 'reminding_date <=' => FrozenDate::today()->format('Y-m-d')])
                    ->contain('Users', function (Query $q2) {
                        return $q2->select(['id', 'title', 'firstname', 'lastname', 'email']);
                    });
            })
            ->contain('Staffs', function (Query $q2) {
                return $q2->where(['is_deleted' => false])->select(['id', 'title', 'firstname', 'lastname', 'email']);
            });

        return  $incompleteHrPTs->toArray();
    }
}
