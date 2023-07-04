<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\CovidTest;
use App\Model\Table\RolesTable;
use Cake\Core\Configure;
use Error;
use Cake\I18n\FrozenDate;

use function PHPUnit\Framework\isNull;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');

        // in a controller beforeFilter or initialize
        // Make view and index not require a logged in user.
        $this->Authentication->allowUnauthenticated(['adminAdd', 'login', 'install', 'ajaxGetBd', 'adminLogin']);
    }



    public function login()
    {

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $origin = $data['origin'];
        } else {
            $origin = $this->Authentication->getLoginRedirect();
        }
        $this->set('origin', $origin); //Must set this for Login View

        //$this->Flash->warning($origin);

        $result = $this->Authentication->getResult();
        // If the user is logged in send them away.
        if ($result->isValid()) {

            $theIdentity = $this->Authentication->getIdentity();
            $this->set('theIdentity', $theIdentity);
            $this->set('theIdentityID', $this->Authentication->getIdentity()->getIdentifier());
            $this->set('theIdentityUsername', $theIdentity->get('username'));

            // $theUser = $this->Users->find('all', ['conditions' => ['username' => $theIdentity->get('username')],
            //                                             'contain' => ['Roles'],
            //                                     ])->first();

            if (!$this->Users->exists(['username' => $theIdentity->get('username')]) && $this->request->is(['patch', 'post', 'put'])) {
                $this->Flash->warning('This is your 1st log on to this system!');
                $theUser = $this->Users->newEmptyEntity();

                $credential = $this->request->getData();

                $LDAPdata = $this->getLDAPData($credential['username'], $credential['password']);

                $theUser = $this->Users->patchEntity($theUser, $this->formatLDAPData($LDAPdata));

                if ($this->Users->save($theUser)) {
                    $this->Flash->success(__('Your account has been created!'));
                } else {
                    $this->Flash->error(__('The system can not create your account. Please contact IT !'));

                    $this->set('patchErrors', $theUser->getErrors());
                    return;
                }
            }

            $theUser = $this->Users->find('all', [
                'conditions' => [
                    'username' => $theIdentity->get('username')
                    //,'is_deleted' => false
                ],
                'contain' => ['Roles'],
            ])->first();

            if (is_null($theUser) || ($theUser->is_deleted == true)) {
                $this->Flash->error(__('Your account has been deactivated! Please contact IT !'));
                $this->Authentication->logout();
                return;
            }

            $theUser->roleIDs = array_values($this->Users->RolesUsers->find('list', ['keyFields' => 'id', 'valueField' => 'role_id', 'conditions' => ['user_id' => $theUser->id]])->toArray());

            $this->Authentication->setIdentity($theUser);

            if (is_null($theUser->department_id)) {
                $this->Flash->error(__('Your account has not been configured to any Department!'));
                $this->Flash->error(__('Please contact IT !'));
                $this->Authentication->logout();
                return;
            }

            // $target = $this->Authentication->getLoginRedirect() ?? '/timesheets/statistic';
            if (is_null($origin)  || $origin == '') {
                $origin =  '/';
            }
            $this->Flash->success('You have logged in successfully!');
            return $this->redirect($origin);
        }

        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error('Invalid username or password');
        }
    }

    public function adminLogin()
    {

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $origin = $data['origin'];

            if ($this->Users->exists(['username' => $data['username']])) {
                $theUser = $this->Users->find('all', [
                    'conditions' => [
                        'username' => $data['username']
                        //,'is_deleted' => false
                    ],
                    'contain' => ['Roles'],
                ])->first();

                $theUser->roleIDs = array_values($this->Users->RolesUsers->find('list', ['keyFields' => 'id', 'valueField' => 'role_id', 'conditions' => ['user_id' => $theUser->id]])->toArray());

                $this->Authentication->setIdentity($theUser);
                $this->redirect(['controller' => 'Users', 'action' => 'editMyProfile']);
            } else {
                $this->Flash->error(__('The username is not exist!'));
                $this->Authentication->logout();
            }

            // $target = $this->Authentication->getLoginRedirect() ?? '/timesheets/statistic';
            if (is_null($origin)  || $origin == '') {
                $origin =  '/';
            }
            $this->set('origin', $origin); //Must set this for Login View
            $this->Flash->success('You have logged in successfully!');
            return $this->redirect($origin);
        } else {
            $origin = $this->Authentication->getLoginRedirect();
        }

        if (is_null($origin)  || $origin == '') {
            $origin =  '/';
        }
        $this->set('origin', $origin); //Must set this for Login View

    }

    private function getLDAPData($username, $password)
    {
        $theLDAP = ldap_connect(Configure::read('LDAP_server'), Configure::read('LDAP_port'));
        ldap_set_option($theLDAP, LDAP_OPT_REFERRALS, 0);
        ldap_set_option($theLDAP, LDAP_OPT_PROTOCOL_VERSION, 3);

        $suffix = Configure::read('LDAP_suffix');
        $attributes = array('givenName', 'sn', 'mail', 'samaccountname', 'dn');
        //$attributes = ['*'];
        //$fullUsername = $username . $suffix;
        //$filter = "(userPrincipalName=$fullUsername)";
        $filter = "(sAMAccountName=$username)";

        //Firstname = 'givenName' = 'Anh'
        //Lastname = 'sn' = 'IT'
        //'department' = 'Administrator/ICT'

        //ldap_bind($theLDAP,$fullUsername,$password);
        //ldap_bind($theLDAP,$adminName . $suffix,$adminPassword);
        ldap_bind($theLDAP, $username . $suffix, $password);
        $result = ldap_search($theLDAP, Configure::read('LDAP_baseDN'), $filter, $attributes);
        $entry = ldap_get_entries($theLDAP, $result);
        ldap_unbind($theLDAP);

        return $entry;
    }

    private function formatLDAPData($entry)
    {
        $user['username'] = $entry[0]['samaccountname']['0'];

        if (isset($entry[0]['givenname']['0'])) {
            $user['firstname'] = $entry[0]['givenname']['0'];
        }

        if (isset($entry[0]['sn']['0'])) {
            $user['lastname'] = $entry[0]['sn']['0'];
        }

        if (isset($entry[0]['mail']['0'])) {
            $user['email'] = $entry[0]['mail']['0'];
        }

        if (isset($entry[0]['dn']['0'])) {
            $user['dn'] = $entry[0]['dn']['0'];
        }

        $user['is_deleted'] = false;
        $user['is_active'] = true;
        $user['name'] =  $user['firstname'] . ' ' . $user['lastname'];
        $this->set('formatted', $user);
        return $user;
    }


    public function logout()
    {
        $this->Authentication->logout();
        $this->Flash->success('You have logged out successfully!');
        return $this->redirect('/');
    }


    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $users = $this->Users->find('all', [

            'conditions' => ['Users.is_deleted' => false],
            //'fields' => ['id', 'username', 'firstname', 'lastname', 'phone', 'mobile', 'email', 'is_active', 'is_deleted', 'department_id', 'group_id'],
            'orders' => ['firstname' => 'ASC', 'lastname' => 'ASC'],
            'contain' => ['Departments', 'Groups']
        ])->all();


        $this->set(compact('users'));
    }

    public function deleted()
    {

        $users = $this->Users->find('all', [

            'conditions' => ['Users.is_deleted' => true],
            'fields' => ['id', 'username', 'firstname', 'lastname', 'phone', 'mobile', 'email', 'is_active', 'is_deleted', 'department_id', 'group_id'],
            'contain' => ['Departments', 'Groups']
        ])->all();


        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        // $user = $this->Users->get($id, [
        //     'contain' => ['Vaccinations', 'Healths', 'Vaccine1', 'Vaccine2','Groups', 'Roles'],
        // ]);

        $user = $this->Users->get($id, [
            'contain' => ['Departments', 'Healths', 'Vaccinations', 'Roles', 'Vaccine1', 'Vaccine2'],

        ]);

        $referer = $this->referer();

        $departments = $this->Users->Departments->find('list', ['limit' => 50]);
        $vaccinations = $this->Users->Vaccinations->find('list')->toArray();
        $vaccines = $this->Users->Vaccine1->find('list')->toArray();
        $healths = $this->Users->Healths->find('list')->toArray();

        $this->set(compact('user', 'departments', 'vaccinations', 'healths', 'vaccines', 'referer'));
    }



    public function blank()
    {
        $this->viewBuilder()->setLayout('sash');
        $this->set('menuElement', "sash/left-menu-admin");

        $curUser = $this->Authentication->getIdentity();

        if (!$this->Users->hasRoleInList($curUser->id, [4])) {
            $this->Flash->error("You are not authorised to access this Module!");
            $this->redirect($this->referer());
        }
    }

    public function setEmpType($id = null)
    {

        $this->viewBuilder()->setLayout('sash');
        $this->set('menuElement', "sash/left-menu-admin");


        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            $postedUsers = array();
            foreach ($data['users'] as $key => $value) {
                $user = $this->Users->get($value, ['fields' => ['id', 'emp_type_id']]);
                $user->emp_type_id = $data['emp_type'];
                $postedUsers[] = $user;
            }

            if ($this->Users->saveMany($postedUsers)) {

                $this->Flash->success(__('Employment Type has been set successfully.'));

                return $this->redirect(['action' => 'set-emp-type']);
            }
            $this->Flash->error(__('The employment type could not be saved. Please, try again.'));
        }

        $users = $this->Users->find('list', ['conditions' => ['is_deleted' => false, 'emp_type_id IS NULL'], 'order' => ['firstname' => 'ASC', 'lastname' => 'ASC']]);
        $empTypes = $this->Users->EmpTypes->find('list');

        $this->set(compact('users', 'empTypes'));
    }

    public function setTitle($id = null)
    {

        $this->viewBuilder()->setLayout('sash');
        $this->set('menuElement', "sash/left-menu-admin");


        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            $postedUsers = array();
            foreach ($data['users'] as $key => $value) {
                $user = $this->Users->get($value, ['fields' => ['id', 'title']]);
                $user->title = $data['title'];
                $postedUsers[] = $user;
            }

            if ($this->Users->saveMany($postedUsers)) {

                $this->Flash->success(__('Employment Type has been set successfully.'));

                return $this->redirect(['action' => 'set-title']);
            }
            $this->Flash->error(__('The employment type could not be saved. Please, try again.'));
        }

        $users = $this->Users->find('list', ['conditions' => ['is_deleted' => false, 'title IS NULL'], 'order' => ['firstname' => 'ASC', 'lastname' => 'ASC']]);


        $this->set(compact('users'));
    }

    /**
     * adminAdd method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function adminAdd()
    {
        $this->viewBuilder()->setLayout('sash');
        $this->set('menuElement', "sash/left-menu-admin");


        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            //$this->set('posted', $this->request->getData());

            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'adminAdd']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $empTypes = $this->Users->EmpTypes->find('list', ['limit' => 200]);
        $groups = $this->Users->Groups->find('list', ['limit' => 200]);
        $departments = $this->Users->Departments->find('list', ['limit' => 200]);

        $this->set(compact('user', 'groups', 'departments', 'empTypes'));
    }

    /**
     * adminAdd method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function install()
    {
        $this->viewBuilder()->setLayout('sash_minimal');
        $this->set('menuElement', "sash/left-menu-admin");


        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            //$this->set('posted', $this->request->getData());


            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));


                $adminRole = $this->Users->Roles->get(RolesTable::R_SADMIN);
                $this->Users->Roles->link($user, [$adminRole]);

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $empTypes = $this->Users->EmpTypes->find('list', ['limit' => 200]);
        $groups = $this->Users->Groups->find('list', ['limit' => 200]);
        $departments = $this->Users->Departments->find('list', ['limit' => 200]);

        $this->set(compact('user', 'groups', 'departments', 'empTypes'));
    }

    public function adminEdit($id)
    {
        $this->viewBuilder()->setLayout('sash');
        $this->set('menuElement', "sash/left-menu-admin");


        $user = $this->Users->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {
        //if ($this->request->is('post')) {
            
            $user = $this->Users->patchEntity($user, $this->request->getData());
            
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'adminEdit', $id]);
                
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
            
        }
        //$profiles = $this->Users->Profiles->find('list', ['limit' => 200]);
        $groups = $this->Users->Groups->find('list', ['limit' => 200]);
        $departments = $this->Users->Departments->find('list', ['limit' => 200]);
        $empTypes = $this->Users->EmpTypes->find('list');

        $this->set(compact('user', 'groups', 'departments', 'empTypes'));
    }

    /**
     * EditMyProfile method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function editMyProfile()
    {
        $user = $this->Users->get($this->Authentication->getIdentity()->get('id'), [
            'contain' => ['Departments', 'Groups'],

        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->saveProfile($user)) {
                $this->Flash->success(__('The user has been saved.'));

                //$user->roleIDs = array_values($this->Users->RolesUsers->find('list', ['keyFields' => 'id', 'valueField' => 'role_id', 'conditions' => ['user_id' => $user->id]])->toArray());
                $this->Authentication->setIdentity($user); //update current login user.

                //return $this->redirect(['action' => 'index']);
                return $this->redirect($this->referer());
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        //$profiles = $this->Users->Profiles->find('list', ['limit' => 200]);

        $vaccinations = $this->Users->Vaccinations->find('list')->toArray();
        $vaccines = $this->Users->Vaccine1->find('list')->toArray();
        $healths = $this->Users->Healths->find('list')->toArray();

        $this->set(compact('user', 'vaccinations', 'healths', 'vaccines'));
    }

    public function editMyVaccine()
    {
        $user = $this->Users->get($this->Authentication->getIdentity()->get('id'), [
            'contain' => ['Healths', 'Vaccinations', 'Vaccine1', 'Vaccine2', 'Vaccine3'],

        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->saveProfile($user)) {
                $this->Flash->success(__('The user has been saved.'));


                //return $this->redirect(['action' => 'index']);
                return $this->redirect($this->referer());
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        //$profiles = $this->Users->Profiles->find('list', ['limit' => 200]);
        $departments = $this->Users->Departments->find('list', ['limit' => 50]);
        $vaccinations = $this->Users->Vaccinations->find('list')->toArray();
        $vaccines = $this->Users->Vaccine1->find('list')->toArray();
        $healths = $this->Users->Healths->find('list')->toArray();

        $this->set(compact('user', 'departments', 'vaccinations', 'healths', 'vaccines'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        $user->is_deleted = true;
        if ($this->Users->save($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function restore($id = null)
    {
        $this->request->allowMethod(['post']);
        $user = $this->Users->get($id);
        $user->is_deleted = false;
        if ($this->Users->save($user)) {
            $this->Flash->success(__('The user has been restored.'));
        } else {
            $this->Flash->error(__('The user could not be restored. Please, try again.'));
        }

        return $this->redirect(['action' => 'deleted']);
    }

    public function rspwd($id = null)
    {
        //$this->checkAuthorised();

        if (is_null($id)) {
            $this->Flash->error(__('Please specify user to be reset password!'));
            return $this->redirect($this->referer());
        }
        //user can only change own password
        $user = $this->Users->get(
            $id,
            ['fields' => ['id', 'username', 'firstname', 'lastname']]
        );
        if (!$user) {
            $this->Flash->error(__('Invalid User!'));
            return $this->redirect($this->referer());
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $posted = $this->request->getData();
            $this->set('posted', $posted);

            if ($posted['password'] == "") {
                $this->Flash->error(__('New password can not be empty.'));

                return $this->redirect($this->referer());
            }

            if ($posted['password'] != $posted['password2']) {
                $this->Flash->error(__('Your confirm password does not match.'));

                return $this->redirect($this->referer());
            }

            $user->password = $posted['password'];

            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user password has been reset!'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('New password could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));

        $this->set('referer', $this->referer());
    }

    public function reportHrUser()
    {
        $users = $this->Users->find('all', [
            //'fields' => ['id', 'firstname', 'lastname', 'email', 'group_id', 'dob', 'mobile', 'id_number', 'id_date', 'id_issuer', 'addr_city', 'addr_district', 'addr_ward', 'addr_detail'],
            'contain' => [
                'Departments'
            ], 'order' => ['firstname' => 'ASC'], 'conditions' => [
                'is_deleted' => false
                //,'Users.id' => 72
            ]
        ]);
        //])->all();

        $this->set(compact('users'));
    }

    public function reportVaccine()
    {
        $curUser = $this->Authentication->getIdentity();
        $permission = $this->checkPermission($curUser->id);

        if ($permission < 2) {
            $this->Flash->error('You dont have privilege to view this report !');
            $this->redirect($this->referer());
        }

        $users = $this->Users->find('all', [ //'fields' => ['id', 'firstname', 'lastname', 'vaccination_id', 'health_id'],
            'contain' => [
                'Vaccinations', 'Healths', 'Vaccine1', 'Vaccine2', 'Vaccine3', 'Vaccine4', 'Departments', 'CovidTests' => function ($q) {
                    return $q->order(['test_date' => 'DESC'])
                        //->limit(1)
                    ;
                }
            ], 'order' => ['firstname' => 'ASC'], 'conditions' => [
                'is_deleted' => false
                //,'Users.id' => 72
            ]
        ]);
        //])->all();

        $this->set(compact('users'));
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

            //full permission , HR, GM, DGM, AM, HSE Leader, HSE staff
            if (in_array($role->role_id, [1, 2, 3, 8, 7, 9]) && ($result < 2)) {
                $result = 2;
            }

            //super admin
            if (in_array($role->role_id, [4]) && ($result < 3)) {
                $result = 3;
            }
        }

        return $result;
    }

    public function editStaffHealth()
    {
        $curUser = $curUser = $this->Authentication->getIdentity();

        //only Super Admin, HSE manager and HSE staff
        if ((count(array_intersect($curUser->roleIDs, [4, 7, 9])) == 0)) {
            $this->Flash->error("You do not have enough privilege to update Staff Health Status!");
            $this->redirect('/');
        }

        $user = $this->Users->newEmptyEntity();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $posted = $this->request->getData();
            $this->set('posted', $posted);

            $user = $this->Users->get($posted['user_id']);
            $user = $this->Users->patchEntity($user, $posted, ['associated' => ['CovidTests']]);
            if ($this->Users->saveProfile($user)) {
                $this->Flash->success(__('The Health Status of staff has been saved.'));

                // return $this->redirect(['action' => 'index']);
                // return $this->redirect($this->referer());
            } else {
                $this->Flash->error(__('Can not save Health Status of staff!'));
            }
            if ($posted['test_date'] != '') {
                $covidTest = $this->Users->CovidTests->newEntity($posted);

                if ($this->Users->CovidTests->save($covidTest)) {
                    $this->Flash->success(__('The Covid Test information of the staff has been saved.'));
                } else {
                    $this->Flash->error(__('Can not save Covid Test information! Please check again.'));
                }
            }
        }

        $staffs = $this->Users->find('list', ['conditions' => ['is_deleted' => false], 'order' => ['firstname' => 'ASC', 'lastname' => 'ASC']]);
        $healths = $this->Users->Healths->find('list');

        $this->set(compact('user', 'healths', 'staffs'));
    }

    public function ajaxGetBd()
    {
        $today = FrozenDate::today();

        $users = $this->Users->find('all', [
            'fields' => ['id', 'firstname', 'lastname', 'title'], 'conditions' => ['is_deleted' => false, 'dob LIKE' => '%' . $today->format('-m-d')]
        ])->toArray();


        $this->set('results', $users);
        $this->viewBuilder()->setOption('serialize', ['results']);
    }
}
