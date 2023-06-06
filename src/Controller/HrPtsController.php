<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\HrPStatus;
use App\Model\Entity\HrPt;
use App\Model\Entity\HrPTaskStatus;
use App\Model\Entity\HrPtTask;
use App\Model\Table\HrPStatusesTable;
use App\Model\Table\HrPTaskStatusesTable;
use App\Model\Table\RolesTable;
use Cake\I18n\FrozenDate;
use Cake\ORM\TableRegistry;
use Cake\ORM\Query;
use Cake\Core\Configure;
use Cake\I18n\FrozenTime;

/**
 * HrPts Controller
 *
 * @property \App\Model\Table\HrPtsTable $HrPts
 * @method \App\Model\Entity\HrPt[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class HrPtsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');

        // Configure::write('CakePdf', [
        //     //'engine' => 'CakePdf.TcPdfEngine',
        //     'engine' => 'CakePdf.Tcpdf',
        //     'margin' => [
        //         'bottom' => 15,
        //         'left' => 50,
        //         'right' => 30,
        //         'top' => 45
        //     ],
        //     //'orientation' => 'landscape',
        //     //'download' => true
        // ]);

        $this->viewBuilder()->setLayout('sash');
        $this->set('menuElement', "sash/left-menu-hr");
    }

    public function blank($id = null)
    {
        $testHRS = $this->HrPts->Staffs->getOneByRole(RolesTable::R_HR_SUP);
        $this->set('getOneByRole', $testHRS);

        $testHR = $this->HrPts->Staffs->getAllByRole(RolesTable::R_HR);
        $this->set('getAllByRole', $testHR);
    }

    public function export($id = null)
    {
        //$this->viewBuilder()->setClassName('CakePdf.Pdf');

        $hrPt = $this->HrPts->get($id, [
            'contain' => ['Supervisors',
                        'HrPtTasks' => ['HrPTaskStatuses',
                                        'Users' => ['fields' => ['id', 'firstname', 'lastname', 'email']],
                                        'Modifiers' => ['fields' => ['id', 'firstname', 'lastname', 'email']]],
                        'HrPStatuses'],
        ]);

        //$staffs = $this->HrPts->Staffs->find('list');
        //$status = $this->HrPts->HrPtTasks->HrPTaskStatuses->find('list');

        $this->set(compact('hrPt'));
    }
    
    /**
     * Show all draft Pre-Terminations
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function draft()
    {

        $hrPts = $this->HrPts->find('all', [
            'fields' => ['id', 'last_date', 'hr_p_status_id', 'work_year', 'HrPStatuses.id', 'HrPStatuses.name', 'staff_id', 'Staffs.id', 'Staffs.firstname', 'Staffs.lastname'],
            'contain' => ['HrPStatuses', 'Staffs'],
            'conditions' => ['hr_p_status_id' => 1],
        ])->all();

        $this->set(compact('hrPts'));
    }


    public function index()
    {

        $hrPts = $this->HrPts->find('all', [
            'fields' => ['id', 'last_date', 'o_last_date', 'hr_p_status_id', 'work_year', 'HrPStatuses.id', 'HrPStatuses.name', 'staff_id', 'Staffs.id', 'Staffs.firstname', 'Staffs.lastname'],
            'contain' => ['HrPStatuses', 'Staffs'],
            //'conditions' => ['hr_p_status_id' => 2],

        ]);

        $this->set(compact('hrPts'));
    }

    public function all()
    {

        $hrPts = $this->HrPts->find('all', [
            'fields' => ['id', 'last_date', 'hr_p_status_id', 'work_year', 'HrPStatuses.id', 'HrPStatuses.name', 'staff_id', 'Staffs.id', 'Staffs.name'],
            'contain' => ['HrPStatuses', 'Staffs'],
            //'conditions' => ['hr_p_status_id' => 2],

        ]);

        $this->set(compact('hrPts'));
    }

    //Show all Pre-termination that I have task.
    public function related()
    {
        $curUser = $this->Authentication->getIdentity();
        /*
        $hrPts = $this->HrPts->find('all', [
            'fields' => ['id', 'last_date', 'hr_p_status_id', 'work_year', 'HrPStatuses.id', 'HrPStatuses.name', 'staff_id', 'Staffs.id', 'Staffs.name'],
            'contain' => ['HrPStatuses', 'Staffs', 'HrPtTasks.Users'],
            'conditions' => ['hr_p_status_id <>' => 3],
            ])
            ->matching('HrPtTasks.Users', function ($q) use ($curUser){
                return $q->where(['Users.id' => $curUser->id]);});
                */
        $hrPt_IDs = $this->HrPts->HrPtTasks->find()->select(['hr_pt_id'])->distinct()->where(['hr_p_task_status_id <>' => HrPTaskStatusesTable::S_COMPLETED])
                ->matching('Users', function (Query $q) use ($curUser){
                    return $q->where(['Users.id' => $curUser->id]);})
        ;
        $hrPts = $this->HrPts->find('all', ['contain' => ['Staffs', 'HrPStatuses']
                                    ,'fields' => ['HrPts.id', 'HrPts.last_date', 'Staffs.id', 'Staffs.firstname', 'Staffs.lastname', 'HrPStatuses.id', 'HrPStatuses.name']
                                    ])
                                ->where(['HrPts.id IN' => $hrPt_IDs, 'hr_p_status_id' => HrPStatusesTable::S_PENDING]);

        $this->set(compact('hrPts'));
    }

    public function reporting()
    {

        $hrPts = $this->HrPts->find('all', [
            'fields' => ['id', 'firstname', 'lastname', 'hr_p_status_id', 'work_year', 'HrPStatuses.id', 'HrPStatuses.name'],

            'contain' => ['HrPStatuses'],
            'conditions' => ['hr_p_status_id' => 3],

        ]);

        $this->set(compact('hrPts'));
    }

    public function completed()
    {

        $hrPts = $this->HrPts->find('all', [
            'fields' => ['HrPts.id', 'Staffs.id', 'Staffs.firstname', 'Staffs.lastname', 'last_date','hr_p_status_id', 'work_year', 'HrPStatuses.id', 'HrPStatuses.name'],

            'contain' => ['HrPStatuses', 'Staffs'],
            'conditions' => ['hr_p_status_id' => HrPStatusesTable::S_COMPLETED],

        ]);

        $this->set(compact('hrPts'));
    }

    /**
     * View method
     *
     * @param string|null $id Hr Pt id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        
        if (!($this->isAllowed([RolesTable::R_ADM_MAN, RolesTable::R_HR, RolesTable::R_HR_SUP, RolesTable::R_SADMIN])) ){
            $this->Flash->error('You have no priviledge to view the Pre-Termination data!');
            $this->redirect($this->referer());
        }

        $hrPt = $this->HrPts->get($id, [
            'contain' => ['Supervisors', 'HrPtTasks' => ['HrPTaskStatuses','Users'], 'HrPStatuses'],
        ]);

        $staffs = $this->HrPts->Staffs->find('list');
        $status = $this->HrPts->HrPtTasks->HrPTaskStatuses->find('list');
        $categories = $this->HrPts->HrPtTasks->HrTaskCategories->find('all', ['conditions' => ['is_deleted' => false]])->all();

        $this->set(compact('hrPt', 'staffs', 'status', 'categories'));
        $this->set('PIC12', $hrPt->hr_pt_tasks[11]);
    }

    public function picView($id = null)
    {
        $hrPt = $this->HrPts->get($id, [
            'contain' => ['Supervisors', 'HrPtTasks' => ['HrPTaskStatuses','Users'], 'HrPStatuses'],
        ]);

        $curUser = $this->Authentication->getIdentity();
        
        $tasks = $this->HrPts->HrPtTasks->find('all', ['conditions' => ['hr_pt_id' => $id], 'hr_p_task_status_id !=' => 3])
        ->contain(['Users' => ['fields' => ['id', 'firstname', 'lastname']]])
        ->matching('Users', function ($q) use ($curUser){
            return $q->where(['Users.id' => $curUser->id]);})
        ->all();
        $hrPt->hr_pt_tasks = $tasks;

        if ($tasks->count() == 0) {
            $this->Flash->error('You dont have any task related to this Pre-Termination!');
            $this->redirect($this->referer());
        }

        $staffs = $this->HrPts->Staffs->find('list');
        $status = $this->HrPts->HrPtTasks->HrPTaskStatuses->find('list');

        $taskStatuses = $this->HrPts->HrPtTasks->HrPTaskStatuses->find('list');
        $this->set(compact('hrPt', 'staffs', 'status', 'taskStatuses'));
    }

    public function complete($id = null)
    {
        $hrPt = $this->HrPts->get($id, [
            'contain' => ['HrPtTasks'],
        ]);

        $done = true;
        foreach ($hrPt->hr_pt_tasks as $task) {
            if ($task->hr_p_task_status_id != 3) { //not completed
                $done = false;
                break;
            }
        }

        if ($done) {
            $hrPt->hr_p_status_id = 3;
            if ($this->HrPts->save($hrPt)) {
                $this->Flash->success("Update successful!");
                $this->redirect(['action' => 'view', $hrPt->id]);
            } else {
                $this->Flash->error("Error updating record!");
                $this->redirect(['action' => 'view', $hrPt->id]);
            }
        } else {
            $this->Flash->error("Can not close the case, not all tasks are completed!");
            $this->redirect(['action' => 'view', $hrPt->id]);
        }
    }

    public function publish($id = null)
    {
        $hrPt = $this->HrPts->get($id, [
            'contain' => ['HrPtTasks'],
        ]);

        $hrPt->hr_p_status_id = 2;

        foreach ($hrPt->hr_pt_tasks as $task) {
            $task->reminding_date = FrozenDate::today()->addDays(2);
        }

        $hrPt->setDirty('hr_pt_tasks', true);

        if ($this->HrPts->save($hrPt)) {
            $this->HrPts->notifyPIC($hrPt->id);

            $this->Flash->success("Pre-Termination successfully published!");
            $this->redirect(['action' => 'view', $hrPt->id]);
        } else {
            $this->Flash->error("Error publishing the Pre-Termination!");
            $this->redirect(['action' => 'view', $hrPt->id]);
        }
    }

    public function process($id = null)
    {
        $curUser = $this->Authentication->getIdentity();
        $hrPt = $this->HrPts->get($id);
        $tasks = $this->HrPts->HrPtTasks->find('all', ['conditions' => ['hr_pt_id' => $id], 'hr_p_task_status_id !=' => HrPTaskStatusesTable::S_COMPLETED])
        ->contain(['Users' => ['fields' => ['id', 'firstname', 'lastname',]]])
        ->matching('Users', function ($q) use ($curUser){
            return $q->where(['Users.id' => $curUser->id]);})
        ->all();
        
        $hrPt->hr_pt_tasks = $tasks;

        // if ($tasks->count() == 0) {
        //     $this->Flash->error('You dont have any task related to this Pre-Termination!');
        //     $this->redirect(['controller' => 'AbcCampaigns', 'action' => 'blank']);
        // }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $posted = $this->request->getData();
            

            for ($i = 0 ; $i < count($posted['hr_pt_tasks']); $i++ ){
                if ( (!isset($posted['hr_pt_tasks'][$i]['remark'])) || ($posted['hr_pt_tasks'][$i]['remark'] == '')){
                    $posted['hr_pt_tasks'][$i]['remark'] = null;
                }
                unset($posted['hr_pt_tasks'][$i]['users']); //does not want to patch this to tasks
            }

            $this->set('posted1', $posted);
            
            $bDirty = false;

            $hrPt = $this->HrPts->patchEntity($hrPt, $posted, ['associated' => ['HrPtTasks']]);
            for ($i = 0 ; $i < count($hrPt->hr_pt_tasks); $i++ ){
                if ($hrPt->hr_pt_tasks[$i]->isDirty()){
                    $hrPt->hr_pt_tasks[$i]['modifier_id'] = $curUser->id;
                    
                    if ($hrPt->hr_pt_tasks[$i]['hr_p_task_status_id'] == HrPTaskStatusesTable::S_COMPLETED){
                        
                        $hrPt->hr_pt_tasks[$i]['complete_time'] = FrozenTime::now();
                    }

                    $bDirty = true;
                }
                
            }

            
            
            $hrPt->setDirty('hr_pt_tasks', true);

            if ($this->HrPts->save($hrPt, ['associated' => ['HrPtTasks']])) {
                $this->Flash->success(__('You tasks has been saved.'));

                return $this->redirect(['action' => 'process', $id]);
            } else {
                $this->Flash->error(__('You tasks could not be saved. Please, try again.'));
            }
            
        }

        if ((count($tasks) == 0) && (count(array_intersect($curUser->roleIDs, [RolesTable::R_HR, RolesTable::R_ADM_MAN])) > 0 )){
            $this->redirect(['action' => 'view', $id]);
        }
        
        $staffs = $this->HrPts->Staffs->find('list', ['conditions' => ['is_deleted' => false], 'orders' => ['firstname' => 'ASC', 'lastname' => 'ASC']]);

        $taskStatuses = $this->HrPts->HrPtTasks->HrPTaskStatuses->find('list');
        $hrPStatuses = $this->HrPts->HrPStatuses->find('list', ['limit' => 200]);
        $this->set(compact('hrPt', 'tasks','staffs',  'hrPStatuses', 'taskStatuses'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $curUser = $this->Authentication->getIdentity();

        if (!(count(array_intersect($curUser->roleIDs, [RolesTable::R_SADMIN,RolesTable::R_HR, RolesTable::R_HR_SUP])) > 0)){
            $this->Flash->error('You have no priviledge to create new Pre-Termination!');
            $this->redirect($this->referer());
        }
        
        $hrPt = $this->HrPts->newEmptyEntity();
        if ($this->request->is('post')) {
            $today = FrozenDate::today();
            $posted = $this->request->getData();
            $posted['issued_date'] = $today->format('Y-m-d');

            $userTable = TableRegistry::getTableLocator()->get('Users');
            $user = $userTable->get($posted['staff_id'], [
                'contain' => [
                    'Departments' => ['fields' => ['id', 'name']]
                    ,'EmpTypes' => ['fields' => ['id', 'EmpTypes.name']]
                            ]
                ,'fields' => ['id', 'firstname', 'lastname', 'email']
            ]);
            $this->set('user', $user);

            $posted['name'] = $user->name;
            $posted['department'] = $user->department->name;
            $posted['creator_id'] = $curUser->id;

            $posted['emp_type'] = $user->emp_type->name;
            $posted['hr_p_status_id'] = 1;

            //$posted['hr_pt_tasks'] = $this->generateDefaultTasks();

            $hrPt = $this->HrPts->patchEntity($hrPt, $posted, ['associated' => ['HrPtTasks.Users']]);

            for ($i = 0; $i < count($hrPt->hr_pt_tasks); $i++) {
                $hrPt->hr_pt_tasks[$i]->hr_p_task_status_id = 1;
                //$hrPt->hr_pt_tasks[$i]->reminding_date = $today->addDays(REMIND_DAY_COUNT)->format('Y-m-d');
            }

            //$this->set('posted', $posted);
            //$this->set('patched', $hrPt);

            if ($this->HrPts->save($hrPt, ['associated' => ['HrPtTasks.Users']])) {
                $this->Flash->success(__('The Pre-Termination has been saved.'));
                
                return $this->redirect(['action' => 'view', $hrPt->id]);
            }
            $this->Flash->error(__('The Pre-Termination could not be saved. Please, try again.'));
        }
        $staffs = $this->HrPts->Staffs->find('list', ['conditions' => ['is_deleted' => false], 'order' => ['firstname' => 'ASC', 'lastname' => 'ASC']]);



        $hrPStatuses = $this->HrPts->HrPStatuses->find('list', ['limit' => 200]);
        $this->set(compact('hrPt', 'staffs',  'hrPStatuses'));
    }

    private function generateDefaultTasks()
    {
        $tasks = array();

        $tasks[1] = [
            'description' => 'Name Card', 'hr_p_task_status_id' => 1, 'reminding_date' => FrozenDate::today()->addDay(5),
            'users' => ['_ids' => [154, 145]]
        ];



        return $tasks;
    }

    /**
     * Edit method
     *
     * @param string|null $id Hr Pt id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->isAllowed([RolesTable::R_HR, RolesTable::R_HR_SUP, RolesTable::R_SADMIN]);

        $hrPt = $this->HrPts->get($id, [
            'contain' => ['HrPtTasks.Users'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $posted = $this->request->getData();
            $this->set('posted', $posted);
            $hrPt = $this->HrPts->patchEntity($hrPt, $posted, ['associated' => ['HrPtTasks.Users']]);
            if ($this->HrPts->save($hrPt)) {
                $this->Flash->success(__('The hr pt has been saved.'));

                return $this->redirect(['action' => 'view', $id]);
            }
            $this->Flash->error(__('The hr pt could not be saved. Please, try again.'));
        }
        $staffs = $this->HrPts->Staffs->find('list', ['conditions' => ['is_deleted' => false]]);
        $categories = $this->HrPts->HrPtTasks->HrTaskCategories->find('all', ['conditions' => ['is_deleted' => false]])->all();


        $hrPStatuses = $this->HrPts->HrPStatuses->find('list', ['limit' => 200]);
        $this->set(compact('hrPt', 'staffs',  'hrPStatuses', 'categories'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Hr Pt id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $hrPt = $this->HrPts->get($id);
        if ($this->HrPts->delete($hrPt)) {
            $this->Flash->success(__('The hr pt has been deleted.'));
        } else {
            $this->Flash->error(__('The hr pt could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


}
