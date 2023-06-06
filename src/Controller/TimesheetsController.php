<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\I18n\Date;
use Cake\I18n\Time;
use Cake\I18n\FrozenDate;
use Cake\ORM\Query;
use App\Model\Entity\User;
use Cake\Http\FlashMessage;
use Cake\I18n\FrozenTime;
use Cake\Core\Configure;

/**
 * Timesheets Controller
 *
 * @property \App\Model\Table\TimesheetsTable $Timesheets
 * @method \App\Model\Entity\Timesheet[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TimesheetsController extends AppController
{
    const MIN_CHECKIN_TIME = '06:00:00';
    const MAX_CHECKIN_TIME = '12:01:00';
    
    
    public function initialize(): void
    {
        parent::initialize();

        //$this->loadComponent('RequestHandler');


        //$this->viewBuilder()->setLayout('sash');
        $this->set('menuElement', "aero/left-menu-hr");
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {

        $myID = $this->Authentication->getIdentity()->get('id');
        $timesheet = $this->Timesheets->find(
            'all',
            [
                'contain' => ['Vaccinations', 'Healths', 'TsLocations'],
                'conditions' => [
                    
                    'start_date =' => FrozenDate::today()->format('Y-m-d'), 'OR' => ['start_time IS NULL', 'start_time <=' => FrozenTime::now()->addMinute(1)->format('H:i:s')], 'user_id' => $myID
                    
                ]
            ]
        )->first();

        $this->set(compact('timesheet'));
    }

    public function myMonthly()
    {
        //$timesheets = null;
        $now = new FrozenDate('now');
        $criteria['year'] = $now->year;
        $criteria['month'] = $now->month;
        $thisTime = FrozenTime::now();

        if ($this->request->is('post')) {
            $criteria = $this->request->getData();
        }

        $myID = $this->Authentication->getIdentity()->get('id');
        $timesheets = $this->Timesheets->find(
            'all',
            [
                'conditions' => ['MONTH(start_date)' => $criteria['month']
                                , 'Year(start_date)' => $criteria['year']
                                , 'user_id' => $this->Authentication->getIdentity()->get('id')
                                , 'start_date <=' => $now->format('Y-m-d')
                                        
                ]
                , 'contain' => ['Healths', 'Vaccinations', 'TsLocations'],
            ]
        );

        $this->set(compact('timesheets', 'criteria'));
    }

    public function userMonthly($user_id = null)
    {
        if (is_null($user_id)) {
            $this->Flash->error('You need to specify a User ID to view!');
            return $this->redirect($this->referer());
        }
        
        $timesheets = null;
        $curUser = $this->Authentication->getIdentity();
        $now = new FrozenDate('now');
        $criteria['year'] = FrozenDate::now()->year;
        $criteria['month'] = FrozenDate::now()->month;
        //$criteria['user_id'] = $user_id;

        $iPermission = $this->checkPermission($curUser->id);

        //no permission for normal user
        if ($iPermission == 0) {
            $this->Flash->error('You dont have Permission for that action!');
            return $this->redirect($this->referer());
        }

        if ($this->request->is('post')) {
            $criteria = $this->request->getData();

            $user = $this->Timesheets->Users->get($user_id);
            $criteria['department_id'] = $user->department_id;

            //no permission for Line managers of other deparment
            if (($iPermission == 1) && ($curUser->department_id != $criteria['department_id'])) {
                $this->Flash->error('You can not view data of other Departments!');
                return $this->redirect($this->referer());
            }
        }

        $timesheets = $this->Timesheets->find(
            'all',
            [
                'conditions' => ['MONTH(start_date)' => $criteria['month']
                                , 'Year(start_date)' => $criteria['year']
                                , 'start_date <=' => $now->format('Y-m-d') //past day, can be anytime
                                , 'user_id' => $user_id

                ], 'contain' => ['Healths', 'Vaccinations', 'TsLocations'],
            ]
        );

        $user = $this->Timesheets->Users->get($user_id);

        $this->set('timesheets', $timesheets);
        //$this->set(compact('timesheets', 'criteria', 'user'));
        $this->set(compact('criteria', 'user'));
    }

    public function deptDaily($department_id = null)
    {
        $timesheets = null;
        $curUser = $this->Authentication->getIdentity();
        //$this->set('curUser', $curUser);

        $today = FrozenDate::now();
        $criteria['view_date'] = $today->format('Y-m-d');


        if (is_null($department_id)) {
            $criteria['department_id'] = $curUser->get('department_id');
        } else {
            $criteria['department_id'] = $department_id;
        }

        $iPermission = $this->checkPermission($curUser->id);
        //$this->set('permission', $iPermission);

        //no permission for normal user
        if ($iPermission == 0) {
            $this->Flash->error('You dont have Permission for that action!');
            return $this->redirect($this->referer());
        }

        if ($this->request->is('POST')) {
            $posted = $this->request->getData();
           
            $criteria['view_date'] = $posted['view_date'];
            $criteria['department_id'] = $posted['department_id'];


            //no permission for Line managers of other deparment
            if (($iPermission == 1) && ($curUser->department_id != $criteria['departmentid'])) {
                $this->Flash->error('You can not view data of other Departments!');
                return $this->redirect($this->referer());
            }
        }


        $timesheets = $this->Timesheets->find('all', ['contain' => ['Vaccinations', 'Healths','TsLocations', 'Users' => ['fields' => ['firstname', 'lastname', 'id', 'is_active'], 'conditions' => ['department_id' => $criteria['department_id']]]]
                                                ,'conditions' => ['start_date' => $criteria['view_date'], 'start_date <=' => $today->format('Y-m-d') ]
        ]);

        $department = $this->Timesheets->Users->Departments->get($criteria['department_id']);
        $departments = $this->Timesheets->Users->Departments->find('list')->toArray();


        //$this->set(compact( 'criteria', 'departments','department', 'users', 'users1'));                                            
        $this->set(compact('timesheets', 'criteria', 'departments', 'department'));
    }

    public function wholeCompany($department_id = null)
    {
        $timesheets = null;
        $curUser = $this->Authentication->getIdentity();
        $today = FrozenDate::now()->format('Y-m-d');

        $criteria['view_date'] = $today;

        $iPermission = $this->checkPermission($curUser->id);

        //only HR, GM, DGM, AM and Super Admin has access
        if ($iPermission < 2) {
            $this->Flash->error('You dont have enough privilege to view Whole Company WFH report!');
            return $this->redirect($this->referer());
        }

        if ($this->request->is('POST')) {
            $posted = $this->request->getData();
            $theDate = new FrozenDate($posted['view_date']);

            $criteria['view_date'] = $theDate->format('Y-m-d');
        }

        $timesheets = $this->Timesheets->find('all', ['contain' => ['Vaccinations', 'Healths','TsLocations', 'Users' => ['fields' => ['firstname', 'lastname', 'id', 'is_active', 'department_id']]]
                                                ,'conditions' => ['start_date' => $criteria['view_date'], 'start_date <=' => $today ]
                                            ]);
        
        $departments = $this->Timesheets->Users->Departments->find('list')->toArray();

                                                
        $this->set(compact('timesheets', 'criteria', 'departments'));
    }


    private function checkPermission($user_id)
    {
        $result = 0; //denied by default

        $rolesTable = $this->getTableLocator()->get('RolesUsers');
        $roles = $rolesTable->find('all', ['conditions' => ['user_id' => $user_id]]);

        foreach ($roles as $role) {
            //half permission: LM,DLM, need to match another condition
            if (in_array($role->role_id, [5, 6]) && ($result < 1)) {
                $result = 1;
            }

            //full permission , HR, GM, DGM, AM
            if (in_array($role->role_id, [1, 2, 3, 8]) && ($result < 2)) {
                $result = 2;
            }

            //super admin
            if (in_array($role->role_id, [4]) && ($result < 3)) {
                $result = 3;
            }
        }

        return $result;
    }

    /**
     * View method
     *
     * @param string|null $id Timesheet id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $timesheet = $this->Timesheets->get($id, [
            'contain' => ['Users', 'Vaccinations', 'Healths'],
        ]);

        $locations = $this->Timesheets->TsLocations->find('list');

        $this->set(compact('timesheet', 'locations'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $curUser = $this->Authentication->getIdentity();

        
        if ($curUser->is_active != true) {
            $this->Flash->error('You Profile is still marked as On Leave (Inactive). Please change to Working (Active) !');
            return $this->redirect(['controller' => 'Users', 'action' => 'editMyProfile']);
        }


        if (!$this->isInTime()) {
            //isInTime already has Flash error message.
            return $this->redirect(['action' => 'statistic']);
        }

        $timesheet = $this->Timesheets->getTodayRecord($curUser->id);

        if ($timesheet->has('start_time')) {

            $this->Flash->error('You have already checked-in!');
            return $this->redirect(['action' => 'statistic']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {

            $timesheet = $this->Timesheets->patchEntity($timesheet, $this->request->getData());

            $timesheet->user_id = $curUser->id;
            $timesheet->start_date = FrozenDate::now()->format('Y-m-d');
            $timesheet->start_time = FrozenTime::now()->format('H:i:m');
            $timesheet->on_leave = false;


            if ($this->Timesheets->save($timesheet)) {
                $this->Flash->success(__('The Record has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The Record could not be saved. Please, try again.'));
        }

        $timesheet->start_date = FrozenDate::now()->format('Y-m-d');
        $timesheet->start_time = FrozenTime::now()->format('H:i:s');
        $timesheet->addr_detail = $curUser->addr_detail;
        $timesheet->addr_city = $curUser->addr_city;
        $timesheet->addr_ward = $curUser->addr_ward;
        $timesheet->addr_district = $curUser->addr_district;
        $timesheet->vaccination_id = $curUser->vaccination_id;
        $timesheet->health_id = $curUser->health_id;

        $vaccinations = $this->Timesheets->Vaccinations->find('list');
        $healths = $this->Timesheets->Healths->find('list');
        $locations = $this->Timesheets->TsLocations->find('list');

        $this->set(compact('timesheet', 'vaccinations', 'healths', 'locations'));
    }

    public function addForUser()
    {
        $curUserID = $this->Authentication->getIdentity()->get('id');

        if ($this->checkPermission($curUserID) < 3) {
            $this->Flash->error('Invalid action!');
            $this->redirect(['controller' => 'Timesheets', 'action' => 'index']);
        }
        
        $timesheet = $this->Timesheets->newEmptyEntity();

        if ($this->request->is(['post'])) {
            $posted = $this->request->getData();
            $this->set('posted', $posted);

            

            if (is_null($posted['to_date']) || $posted['to_date'] == "") {
                $posted['to_date'] = $posted['start_date'];

                $bRandTime = false;
                //$this->Flash->warning('Null TO DATE');
            } else {
                $bRandTime = true;
            }

            $FStartDate = new FrozenDate($posted['start_date']);
            $FToDate = new FrozenDate($posted['to_date']);
            //$this->set("start", $FStartDate);
            //$this->set('todate', $FToDate);
            $dayNum = $FStartDate->diffInDays($FToDate);
            //$this->set('dayNum', $dayNum);
            
            //get user data
            $user = $this->Timesheets->Users->get($posted['user_id']);
            
            

            for ($i = 0; $i <= $dayNum; $i++) {
                //debug($i);
                $timesheet = $this->Timesheets->newEmptyEntity();
                $timesheet = $this->Timesheets->patchEntity($timesheet, $posted);
               

                $timesheet->start_date = $FStartDate; //start date increased each loop

                if ($bRandTime) {
                    $timesheet->start_time = new Time($posted['start_time']);
                    $min = rand(max(0, $timesheet->start_time->minute - 5) , min(59, $timesheet->start_time->minute + 5) );
                    $sec = rand(0,59);

                    $timesheet->start_time = $timesheet->start_time->minute($min)->second($sec);


                }

                $timesheet->addr_detail = $user->addr_detail;
                $timesheet->addr_city = $user->addr_city;
                $timesheet->addr_district = $user->addr_district;
                $timesheet->addr_ward = $user->addr_ward;
                $timesheet->vaccination_id = $user->vaccination_id;
                $timesheet->health_id = $user->health_id;

                if ($this->Timesheets->save($timesheet)){
                    $this->Flash->warning('Added Check-in for: ' . $user->username . ' on ' . $timesheet->start_date . ' at ' . $timesheet->start_time);
                }
                  
                $FStartDate = $FStartDate->addDay(1);
                
            }
            $this->redirect(['action' => 'addForUser']);
        }

        

        $locations = $this->Timesheets->TsLocations->find('list');
        $vaccinations = $this->Timesheets->Vaccinations->find('list');
        $users = $this->Timesheets->Users->find('list', [
            'conditions' => ['is_deleted' => false],
            'order' => ['firstname' => 'ASC', 'lastname' => 'ASC']
        ]);

        $this->set(compact('timesheet', 'users', 'locations'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Timesheet id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
    */ 
    public function edit($id)
    {        
        $timesheet = $this->Timesheets->get($id, [
            'contain' => [],
        ]);
        $curUser = $this->Authentication->getIdentity();

        if ($timesheet->user_id != $curUser->id){
            $this->Flash->error('You can only update your Check-in record!');
            return $this->redirect($this->referer());
        }

        if ($timesheet->start_time == null){
            $this->Flash->error('You can not edit missed check-in!');
            return $this->redirect($this->referer());
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $timesheet = $this->Timesheets->patchEntity($timesheet, $this->request->getData());
            if ($this->Timesheets->save($timesheet)) {
                $this->Flash->success(__('The Record has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The Record could not be saved. Please, try again.'));
        }

        $vaccinations = $this->Timesheets->Vaccinations->find('list');
        $healths = $this->Timesheets->Healths->find('list');
        $locations = $this->Timesheets->TsLocations->find('list');

        $this->set(compact('timesheet', 'vaccinations', 'healths', 'locations'));
    }
     
    public function close($id)
    {
        $timesheet = $this->Timesheets->get($id, [
            'contain' => [],
        ]);

        $curUser = $this->Timesheets->Users->find('all', ['conditions' => ['id' => $timesheet->user_id], 'fields' => ['firstname', 'lastname', 'vaccination_id', 'health_id']])->first();

        if (!is_null($timesheet->end_date)) {
            $this->Flash->error('Can not change the Record which has been closed!');
            return $this->redirect($this->referer());
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $timesheet = $this->Timesheets->patchEntity($timesheet, $this->request->getData());
            $timesheet->end_date = Date::now();
            $timesheet->end_time = Time::now()->format('H:i:s');
            //$this->set('posted', $this->request->getData());
            if ($this->Timesheets->save($timesheet)) {
                $this->Flash->success(__('The Record has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The Record could not be saved. Please, try again.'));
        }

        $timesheet->end_date = Date::now();
        $timesheet->end_time = Time::now()->format('H:i:s');
        $vaccinations = $this->Timesheets->Vaccinations->find('list');
        $healths = $this->Timesheets->Healths->find('list');

        $this->set(compact('timesheet', 'vaccinations', 'healths', 'curUser'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Timesheet id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
    
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $timesheet = $this->Timesheets->get($id);
        if ($this->Timesheets->delete($timesheet)) {
            $this->Flash->success(__('The Record has been deleted.'));
        } else {
            $this->Flash->error(__('The Record could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
     */
    public function statistic()
    {
        $departments = $this->Timesheets->Users->Departments->find('all', ['fields' => ['id','name']])
            ->toArray();

        $today_text = FrozenDate::today()->format('Y-m-d');

        //foreach ($departments as $department){
        for ($i = 0; $i < count($departments); $i++) {
            $departments[$i]['active'] = $this->Timesheets->find('all', [
                'fields' => ['id', 'user_id'],
                'contain' => ['Users' => ['fields' => ['department_id']]],
                'conditions' => ['Users.department_id' => $departments[$i]->id, 'on_leave' => false, 'start_date' => $today_text]
            ])->count();

            $departments[$i]['leave'] = $this->Timesheets->find('all', [
                'fields' => ['id', 'user_id'],
                'contain' => ['Users' => ['fields' => ['department_id']]],
                'conditions' => ['Users.department_id' => $departments[$i]->id, 'on_leave' => true, 'start_date' => $today_text]
            ])->count();

           

            $departments[$i]['checked'] = $this->Timesheets->find('all', [
                'fields' => ['id', 'user_id'],
                'contain' => ['Users' => ['fields' => ['department_id']]],
                'conditions' => ['Users.department_id' => $departments[$i]->id, 'start_date' => $today_text, 'start_time <=' => FrozenTime::now()->format('H:i:s')]
            ])->count();


         
        }

        $this->set('departments', $departments);
    }

    private function isInTime()
    {
        $CurTime = Time::now();
        //$minTime = new Time(TimesheetsController::MIN_CHECKIN_TIME);
        //$maxTime = new Time(TimesheetsController::MAX_CHECKIN_TIME);
        $minTime = new Time(Configure::read('MIN_CHECKIN_TIME'));
        $maxTime = new Time(Configure::read('MAX_CHECKIN_TIME'));

        // debug($CurTime);
        // debug($maxTime);

        if (($CurTime < $minTime) || ($CurTime > $maxTime)) {
            $this->Flash->error('You can only check-in from ' . $minTime->format('H:i') . ' to ' . $maxTime->format('H:i'));
            return false;
        }

        return true;
    }

    public function generateMissing()
    {

        $curUser = $this->Authentication->getIdentity();

        $iPermission = $this->checkPermission($curUser->id);

        //no permission for normal user
        if ($iPermission != 3) {
            $this->Flash->error('You dont have Permission for that action!');
            return $this->redirect(['action' => 'statistic']);
        }

        $criteria['view_date'] = FrozenDate::now()->format('Y-m-d');


        if ($this->request->is(['patch', 'post', 'put'])) {
            //$this->Flash->success('POST');
            $posted = $this->request->getData();
            $theDate = new FrozenDate($posted['view_date']);

            $criteria['view_date'] = $theDate->format('Y-m-d');

            $users = $this->Timesheets->Users->find('all', [
                'fields' => ['id', 'username', 'firstname', 'lastname', 'is_deleted', 'is_active', 'health_id', 'vaccination_id'], 'contain' => ['Timesheets' => ['conditions' => [
                    'start_date' => $criteria['view_date']
                    //,'Timesheets.start_date' => FrozenDate::now()->format('Y-m-d')
                ]]], 'conditions' => [
                    'is_deleted' => false //,'id' => 154
                    //,'department_id' => 7                                               
                ], 'order' => ['Users.name' => 'ASC']
            ])->all();

            $i = 0;
            $aTimesheets = array();
            foreach ($users as $user) {

                if (empty($user->timesheets)) {
                    //$this->Flash->warning($user->name . ' - no timesheet');
                    $timesheet = $this->Timesheets->newEmptyEntity();
                    $timesheet->user_id = $user->id;
                    $timesheet->health_id = $user->health_id;
                    $timesheet->vaccination_id = $user->vaccination_id;
                    $timesheet->start_date = $criteria['view_date'];

                    if (!$user->is_active) {
                        //$this->Flash->warning($user->name . ' - on leave');
                        $timesheet->on_leave = true;
                    }

                    $aTimesheets[$i] = $timesheet;
                    $i++;
                } else {
                    //$this->Flash->error($user->name . ' - has timesheet');
                }
            }

            $this->Timesheets->saveMany($aTimesheets);

            //$this->redirect($this->referer());

        }

        $users = $this->Timesheets->Users->find('all', [
            'fields' => ['id', 'username', 'firstname', 'lastname', 'is_deleted', 'is_active', 'health_id', 'vaccination_id'], 'contain' => ['Timesheets' => ['conditions' => [
                'start_date' => $criteria['view_date']
                //,'Timesheets.start_date' => FrozenDate::now()->format('Y-m-d')
            ]]], 'conditions' => [
                'is_deleted' => false //,'id' => 154
                //, 'department_id' => 7
            ], 'order' => ['Users.name' => 'ASC']
        ])->all();

        $this->set(compact('criteria', 'users'));
    }
}
