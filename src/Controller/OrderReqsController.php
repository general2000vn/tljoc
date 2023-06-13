<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\OrderReq;
use App\Model\Entity\OrStatus;
use App\Model\Entity\OrSupplier;
use App\Model\Table\DepartmentsTable;
use App\Model\Table\OrderReqsTable;
use App\Model\Table\OrStatusesTable;
use App\Model\Table\RolesTable;
use Cake\I18n\FrozenTime;
use Cake\ORM\Locator\TableLocator;
use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenDate;
use EmailQueue\EmailQueue;
use Cake\Core\Configure;

/**
 * OrderReqs Controller
 *
 * @property \App\Model\Table\OrderReqsTable $OrderReqs
 * @method \App\Model\Entity\OrderReq[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OrderReqsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');

        $this->viewBuilder()->setLayout('sash');

        $this->set('menuElement', "sash/left-menu-order-requisition");
    }

    public function blank()
    {
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $curUser = $this->Authentication->getIdentity();
        $curDept = $this->OrderReqs->Originators->Departments->get($curUser->department_id);

        $orderReq = $this->OrderReqs->newEmptyEntity();
        $posted = null;
        if ($this->request->is('post')) {
            $posted = $this->request->getData();
            //$posted['est_total'] = str_replace(',', '', $posted['est_total']);
            //$posted['exch_rate'] = str_replace(',', '', $posted['exch_rate']);

            $orderReq = $this->OrderReqs->patchEntity($orderReq, $posted, ['associated' => ['OrItems', 'OrSuppliers', 'OrUploads']]);

            $orderReq->department_id = $curDept->id;
            $orderReq->originator_id = $curUser->id;
            $orderReq->handler_id = $curUser->id;
            $orderReq->or_status_id = OrStatusesTable::S_DRAFT; //default Draft

            if ($this->OrderReqs->save($orderReq, ['associated' => ['OrItems', 'OrSuppliers', 'OrUploads']])) {

                $this->Flash->success(__('The order req has been saved.'));

                return $this->redirect(['action' => 'view', $orderReq->id]);
            }
            $this->Flash->error(__('The order req could not be saved. Please, try again.'));
        }
        $departments = $this->OrderReqs->Departments->find('list', ['limit' => 200]);
        $currencies = $this->OrderReqs->Currencies->find('list', ['limit' => 200]);
        $docCompanies = $this->OrderReqs->DocCompanies->find('list', ['limit' => 200]);

        $deliAddresses = $this->OrderReqs->DeliAddresses->find('list', ['limit' => 200]);
        $suppliers = $this->OrderReqs->SingleSources->find('list');
        $cpMethods = $this->OrderReqs->CpMethods->find('list');

        $orStatuses = $this->OrderReqs->OrStatuses->find('list', ['limit' => 200]);
        $orTypes = $this->OrderReqs->OrTypes->find('list', ['limit' => 200]);
        $staffs = $this->OrderReqs->Originators->find('list', [
            'conditions' => ['is_deleted' => false], 'order' => ['firstname' => 'ASC', 'lastname' => 'ASC']
        ]);

        $this->set(compact('orderReq', 'departments', 'currencies', 'curUser', 'curDept', 'deliAddresses', 'suppliers', 'orStatuses', 'orTypes', 'docCompanies', 'staffs', 'cpMethods', 'posted'));
    }

    public function add2()
    {
        $curUser = $this->Authentication->getIdentity();
        $curDept = $this->OrderReqs->Originators->Departments->get($curUser->department_id);

        $orderReq = $this->OrderReqs->newEmptyEntity();
        $posted = null;
        if ($this->request->is('post')) {
            $posted = $this->request->getData();
            $orderReq = $this->OrderReqs->patchEntity($orderReq, $posted, ['associated' => ['OrItems', 'OrSuppliers', 'OrUploads']]);

            $orderReq->department_id = $curDept->id;
            $orderReq->originator_id = $curUser->id;
            $orderReq->handler_id = $curUser->id;
            $orderReq->or_status_id = OrStatusesTable::S_DRAFT; //default Draft

            if ($this->OrderReqs->save($orderReq, ['associated' => ['OrItems', 'OrSuppliers', 'OrUploads']])) {

                $this->Flash->success(__('The order req has been saved.'));

                return $this->redirect(['action' => 'view', $orderReq->id]);
            }
            $this->Flash->error(__('The order req could not be saved. Please, try again.'));
        }
        $departments = $this->OrderReqs->Departments->find('list', ['limit' => 200]);
        $currencies = $this->OrderReqs->Currencies->find('list', ['limit' => 200]);
        $docCompanies = $this->OrderReqs->DocCompanies->find('list', ['limit' => 200]);

        $deliAddresses = $this->OrderReqs->DeliAddresses->find('list', ['limit' => 200]);
        $suppliers = $this->OrderReqs->SingleSources->find('list');
        $cpMethods = $this->OrderReqs->CpMethods->find('list');

        $orStatuses = $this->OrderReqs->OrStatuses->find('list', ['limit' => 200]);
        $orTypes = $this->OrderReqs->OrTypes->find('list', ['limit' => 200]);
        $staffs = $this->OrderReqs->Originators->find('list', [
            'conditions' => ['is_deleted' => false], 'order' => ['firstname' => 'ASC', 'lastname' => 'ASC']
        ]);

        $this->set(compact('orderReq', 'departments', 'currencies', 'curUser', 'curDept', 'deliAddresses', 'suppliers', 'orStatuses', 'orTypes', 'docCompanies', 'staffs', 'cpMethods', 'posted'));
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $curUser = $this->Authentication->getIdentity();
        $orderReqs = $this->OrderReqs->find('all', [
            'conditions' => ['handler_id' => $curUser->id,
                            //'or_status_id <>' => OrStatusesTable::S_CANCELLED
                            ],
            'contain' => [
                'OrStatuses', 'Originators' => ['fields' => ['id', 'firstname', 'lastname', 'email',  'title']], 'Departments' => ['fields' => ['id', 'name']]

            ]
        ]);

        $this->set(compact('orderReqs'));
    }



    public function dept()
    {
        $curUser = $this->Authentication->getIdentity();

        $today = FrozenDate::today();

        $params = $this->request->getQueryParams();

        $criteria = $this->getSearchCriteria($params); //default values or based on posted.

        if (($curUser->department_id != $criteria['dept_id']) && ($curUser->department_id != DepartmentsTable::D_CP)) {
            $this->Flash->error('You have no privilege to view other Departments\' ORs!');
            $this->redirect(['action' => 'dept']);
        }

        $orderReqs = $this->OrderReqs->find('all', [
            'conditions' => [
                'or_status_id <>' => OrStatusesTable::S_DRAFT,
                'OrderReqs.department_id' =>  $criteria['dept_id'],
                'submit_date >=' => $criteria['date_from'],
                'submit_date <=' => $criteria['date_to'],
            ],
            'contain' => [
                'OrStatuses',
                'Originators' => ['fields' => ['id', 'firstname', 'lastname', 'email',  'title']],

            ]
        ]);

        $departments = $this->OrderReqs->Departments->find('list');

        $this->set(compact('orderReqs', 'departments', 'criteria'));
    }

    public function processing()
    {
        $curUser = $this->Authentication->getIdentity();

        $criteria = $this->request->getQueryParams();



        if (($curUser->department_id != DepartmentsTable::D_CP) && (count(array_intersect($curUser->roleIDs, [RolesTable::R_SADMIN])) > 0)) {
            $this->Flash->error('You have no privilege to view this report!');
            $this->redirect(['action' => 'index']);
        }

        $orderReqs = $this->OrderReqs->find('all', [
            'contain' => [
                'Originators' => ['fields' => ['id', 'firstname', 'lastname', 'email']],
                'OrStatuses',
                'Departments'
            ]
        ]);

        $orderReqs->where(['or_status_id IN' => [OrStatusesTable::S_PROCESSING]]);

        if (isset($criteria['staff_id']) && $criteria['staff_id'] != '') {
            $orderReqs->where([
                'handler_id' =>  $criteria['staff_id']
            ]);
            $this->set('staff_id', $criteria['staff_id']);
        }

        $departments = $this->OrderReqs->Departments->find('list');
        $staffs = $this->OrderReqs->Handlers->find('list', ['conditions' => ['department_id' => DepartmentsTable::D_CP]]);

        $this->set(compact('orderReqs', 'departments', 'staffs'));
    }

    private function getSearchCriteria($posted)
    {
        $today = FrozenDate::today();
        $criteria['date_from'] = $today->format('Y-1-1');
        $criteria['date_to'] = $today->format('Y-m-d');
        $curUser = $this->Authentication->getIdentity();
        $criteria['dept_id'] = $curUser->department_id;

        if (isset($posted['date_from']) && ($posted['date_from'] != '')) {
            $criteria['date_from'] = $posted['date_from'];
        }

        if (isset($posted['date_to']) && ($posted['date_to'] != '')) {
            $criteria['date_to'] = $posted['date_to'];
        }

        if (isset($posted['dept_id'])) {
            $criteria['dept_id'] = $posted['dept_id'];
        }

        return $criteria;
    }


    /**
     * View method
     *
     * @param string|null $id Order Req id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $curUser = $this->Authentication->getIdentity();
        $curDept = $this->OrderReqs->Originators->Departments->get($curUser->department_id);

        $orderReq = $this->OrderReqs->get($id, [
            'contain' => [
                'Departments', 'Currencies', 'OrUploads', 'DeliAddresses',  'OrStatuses', 'OrItems', 'OrSuppliers',
                'Originators' => ['fields' => ['id', 'firstname', 'lastname', 'email',  'title']],
                'GroupLeaders' => ['fields' => ['id', 'firstname', 'lastname', 'email',  'title']],
                'DeptLeaders' => ['fields' => ['id', 'firstname', 'lastname', 'email',  'title']],
            ],
        ]);

        if (($orderReq->department_id != $curUser->department_id) && (count(array_intersect($curUser->roleIDs, [RolesTable::R_GM, RolesTable::R_DGM, RolesTable::R_GM_SEC, RolesTable::R_CP])))) {
            $this->Flash->error('You dont have priviledge to View this Order Requisition!');
            return $this->redirect($this->referer());
        }

        $departments = $this->OrderReqs->Departments->find('list', ['limit' => 200]);
        $currencies = $this->OrderReqs->Currencies->find('list', ['limit' => 200]);
        $docCompanies = $this->OrderReqs->DocCompanies->find('list', ['limit' => 200]);

        $deliAddresses = $this->OrderReqs->DeliAddresses->find('list', ['limit' => 200]);

        $cpMethods = $this->OrderReqs->CpMethods->find('list');

        $orStatuses = $this->OrderReqs->OrStatuses->find('list', ['limit' => 200]);
        
        $this->set(compact('orderReq', 'departments', 'currencies', 'curUser', 'curDept', 'deliAddresses',  'cpMethods', 'orStatuses','docCompanies'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Order Req id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $curUser = $this->Authentication->getIdentity();
        $curDept = $this->OrderReqs->Originators->Departments->get($curUser->department_id);

        $orderReq = $this->OrderReqs->get($id, [
            'contain' => ['OrItems', 'OrSuppliers', 'OrUploads',
                'Departments',
                'Originators' => ['fields' => ['id', 'firstname', 'lastname', 'email', 'title']]
            ],
        ]);

        if (($orderReq->originator_id != $curUser->id) || ($orderReq->or_status_id != OrStatusesTable::S_DRAFT)) {
            $this->Flash->success(__('You not allowed to edit this Order Requisition!'));

            return $this->redirect($this->referer());
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $posted = $this->request->getData();
            $this->set('posted', $posted);

            if (!isset($posted['or_items'])){
                $this->OrderReqs->OrItems->deleteManyOrFail($orderReq->or_items);

            }

            if (!isset($posted['or_suppliers'])){
                $this->OrderReqs->OrSuppliers->deleteManyOrFail($orderReq->or_suppliers);
            }

            if (!isset($posted['or_uploads'])){
                $this->OrderReqs->OrUploads->deleteManyOrFail($orderReq->or_uploads);
            }

            $orderReq = $this->OrderReqs->patchEntity($orderReq, $this->request->getData(), ['associated' => ['OrItems', 'OrSuppliers', 'OrUploads']]);
            if ($this->OrderReqs->save($orderReq, ['associated' => ['OrItems', 'OrSuppliers', 'OrUploads']])) {
                $this->Flash->success(__('The Order Requisition has been saved.'));

                return $this->redirect(['action' => 'view', $orderReq->id]);
            }
            $this->Flash->error(__('The order req could not be saved. Please, try again.'));
        }

        $departments = $this->OrderReqs->Departments->find('list', ['limit' => 200]);
        $currencies = $this->OrderReqs->Currencies->find('list', ['limit' => 200]);
        $docCompanies = $this->OrderReqs->DocCompanies->find('list', ['limit' => 200]);

        $deliAddresses = $this->OrderReqs->DeliAddresses->find('list', ['limit' => 200]);


        $cpMethods = $this->OrderReqs->CpMethods->find('list');

        $orStatuses = $this->OrderReqs->OrStatuses->find('list', ['limit' => 200]);

        $staffs = $this->OrderReqs->Originators->find('list', [
            'conditions' => ['is_deleted' => false], 'order' => ['firstname' => 'ASC', 'lastname' => 'ASC']
        ]);

        $this->set(compact('orderReq', 'departments', 'currencies', 'curUser', 'curDept', 'deliAddresses',  'orStatuses', 'cpMethods', 'docCompanies', 'staffs'));
    }

    public function submit($id = null)
    {
        $curUser = $this->Authentication->getIdentity();
        $curDept = $this->OrderReqs->Originators->Departments->get($curUser->department_id);


        $orderReq = $this->OrderReqs->get($id, ['contain' => [
            'Departments', 'Originators' => ['fields' => ['id', 'firstname', 'lastname', 'email',  'title']], 'GroupLeaders' => ['fields' => ['id', 'firstname', 'lastname', 'email',  'title']], 'DeptLeaders' => ['fields' => ['id', 'firstname', 'lastname', 'email',  'title']]
        ]]);

        if (!is_null($curUser->group_id)) { //
            
            $curGroup = $this->OrderReqs->Originators->Groups->get($curUser->group_id);

            if ($curGroup->leader_id == $curUser->id) { //originator is group leader
                $orderReq->or_status_id = OrStatusesTable::S_DEPT_APPROVING; //group approved
                $orderReq->handler_id = $curDept->user_id;

                //    $orderReq->justification = $orderReq->justification . "   - It's Group leader -> Dept Leader ID: " . $curDept->user_id;
            } else { //group member
                $orderReq->or_status_id = OrStatusesTable::S_GROUP_APPROVING; //submitted
                $orderReq->handler_id = $curGroup->leader_id;

                //    $orderReq->justification = $orderReq->justification . "   - Group Leader ID: " . $curGroup->leader_id;
            }
        } else { //no group, directly to dept level
            $orderReq->or_status_id = OrStatusesTable::S_DEPT_APPROVING; //group approved
            $orderReq->handler_id = $curDept->user_id;

            //$orderReq->justification = $orderReq->justification . "   - No Group  -> Group Leader ID: " . $curDept->user_id;
        }

        $orderReq->submit_date = FrozenDate::now();



        if ($this->OrderReqs->save($orderReq)) {
            $this->notifyUser($orderReq);
            $this->Flash->success(__('The Order Requisition has been submitted.'));

            return $this->redirect(['action' => 'index']);
        } else {
            $this->Flash->error(__('The Order Requisition could not be submitted. Please, try again.'));
            return $this->redirect($this->referer());
        }
    }

    private function isHandler($user, $orderReq)
    {
        if ($user->id != $orderReq->handler_id) {
            $this->Flash->error(__('You do not have the required priviledge to this Order Requisition!'));
            return $this->redirect(['action' => 'index']);
        }
    }

    public function approval($id = null)
    {
        $curUser = $this->Authentication->getIdentity();
        $curDept = $this->OrderReqs->Originators->Departments->get($curUser->department_id);

        if ($this->request->is(['get'])) {
            $orderReq = $this->OrderReqs->get($id, ['contain' => [
                'Departments', 'Originators' => ['fields' => ['id', 'firstname', 'lastname', 'email',  'title']], 'GroupLeaders' => ['fields' => ['id', 'firstname', 'lastname', 'email',  'title']], 'DeptLeaders' => ['fields' => ['id', 'firstname', 'lastname', 'email',  'title']]
            ]]);
            $this->isHandler($curUser, $orderReq);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $posted = $this->request->getData();
            $orderReq = $this->OrderReqs->get($posted['id'], ['contain' => [
                'Departments', 'Originators' => ['fields' => ['id', 'firstname', 'lastname', 'email',  'title']], 'GroupLeaders' => ['fields' => ['id', 'firstname', 'lastname', 'email',  'title']], 'DeptLeaders' => ['fields' => ['id', 'firstname', 'lastname', 'email',  'title']]
            ]]);

            $now = FrozenTime::now();

            $CP_man = $this->OrderReqs->Originators->getOneByRole(RolesTable::R_CP_MAN);
            $extraCC = array();

            if (isset($posted['btnApprove'])) {

                switch ($orderReq->or_status_id) {
                    case OrStatusesTable::S_GROUP_APPROVING:
                        $orderReq->group_approve_time = $now;
                        $orderReq->group_leader_id = $curUser->id;
                        $orderReq->group_comment = $posted['comment'];
                        $orderReq->or_status_id = OrStatusesTable::S_DEPT_APPROVING;
                        $orderReq->handler_id = $curDept->user_id;
                        break;

                    case OrStatusesTable::S_DEPT_APPROVING:

                        $orderReq->dept_approve_time = $now;
                        $orderReq->dept_leader_id = $curUser->id;
                        $orderReq->dept_comment = $posted['comment'];
                        $orderReq->or_status_id = OrStatusesTable::S_ISSUED;

                        $orderReq->req_num = $this->generateNumber($orderReq);

                        $orderReq->handler_id = $CP_man->id;
                        break;


                    default:
                        $this->Flash->error(__('Invalid Order Requisition !'));
                        return $this->redirect($this->referer());
                        break;
                }
            } elseif (isset($posted['btnDisapprove'])) {

                switch ($orderReq->or_status_id) {
                    case OrStatusesTable::S_GROUP_APPROVING:
                        $orderReq->group_approve_time = $now;
                        $orderReq->group_leader_id = $curUser->id;
                        $orderReq->group_comment = $posted['comment'];
                        break;

                    case OrStatusesTable::S_DEPT_APPROVING:

                        $orderReq->dept_approve_time = $now;
                        $orderReq->dept_leader_id = $curUser->id;
                        $orderReq->dept_comment = $posted['comment'];
                        break;
                    default:
                        $this->Flash->error(__('Invalid Order Requisition !'));
                        return $this->redirect($this->referer());
                        break;
                }
                $orderReq->or_status_id = OrStatusesTable::S_DISAPPROVED;
                $orderReq->handler_id = $orderReq->originator_id;
            }


            if ($this->OrderReqs->save($orderReq)) {
                $this->Flash->success(__('The Order Requisition has been Approved.'));
                $this->notifyUser($orderReq);

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The Order Requisition could not be approved. Please, try again.'));
                return $this->redirect(['action' => 'view', $orderReq->id]);
            }
        }

        $this->set(compact('orderReq'));
    }

    //not used for now
    public function cancel($id = null)
    {
        $this->request->allowMethod(['post']);

        $curUser = $this->Authentication->getIdentity();

        $orderReq = $this->OrderReqs->get($id, ['contain' => [
            'Departments',
            'Originators' => ['fields' => ['id', 'firstname', 'lastname', 'email',  'title']],
            'GroupLeaders' => ['fields' => ['id', 'firstname', 'lastname', 'email',  'title']],
            'DeptLeaders' => ['fields' => ['id', 'firstname', 'lastname', 'email',  'title']],
            'Handlers' => ['fields' => ['id', 'firstname', 'lastname', 'email',  'title']]
        ]]);

        if ($orderReq->originator_id != $curUser->id) {
            $this->Flash->error('You do not have previledge to Cancel this Order Requisition');
            $this->redirect($this->referer());
        }

        $orderReq->or_status_id = OrStatusesTable::S_CANCELLED;
        $orderReq->handler_id = $orderReq->originator_id;

        if ($this->OrderReqs->save($orderReq)) {
            $this->Flash->success(__('The Order Requisition has been Cancelled.'));
            $this->notifyUser($orderReq, $orderReq->handler);
            return $this->redirect(['action' => 'index']);
        } else {
            $this->Flash->error(__('The Order Requisition could not be Cancelled. Please contact IT.'));
            return $this->redirect($this->referer());
        }


        $this->set(compact('orderReq'));
    }

    public function assign($id = null)
    {
        $curUser = $this->Authentication->getIdentity();
        //$curDept = $this->OrderReqs->Originators->Departments->get($curUser->department_id);

        $orderReq = $this->OrderReqs->get($id, ['contain' => [
            'Departments', 'Originators' => ['fields' => ['id', 'firstname', 'lastname', 'email',  'title']], 'GroupLeaders' => ['fields' => ['id', 'firstname', 'lastname', 'email',  'title']], 'DeptLeaders' => ['fields' => ['id', 'firstname', 'lastname', 'email',  'title']]
        ]]);

        $this->isHandler($curUser, $orderReq);

        //$roleTable = TableRegistry::getTableLocator()->get('Roles');

        if ($this->request->is(['patch', 'post', 'put'])) {

            $orderReq = $this->OrderReqs->patchEntity($orderReq, $this->request->getData());
            $orderReq->or_status_id = OrStatusesTable::S_PROCESSING;

            if ($this->OrderReqs->save($orderReq)) {
                $this->Flash->success(__('The Order Requisition has been Assigned.'));
                $this->notifyUser($orderReq);

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The Order Requisition could not be Assigned. Please, try again.'));
                return $this->redirect(['action' => 'view', $orderReq->id]);
            }
        }

        $users = $this->OrderReqs->Handlers->find('list', [
            'conditions' => ['is_deleted' => false, 'department_id' => 8], 'order' => ['firstname' => 'ASC', 'lastname' => 'ASC']

        ]);
        $this->set(compact('orderReq', 'users'));
    }

    public function complete($id = null)
    {
        $curUser = $this->Authentication->getIdentity();
        //$curDept = $this->OrderReqs->Originators->Departments->get($curUser->department_id);

        $orderReq = $this->OrderReqs->get($id, ['contain' => [
            'Departments',
            'Originators' => ['fields' => ['id', 'firstname', 'lastname', 'email',  'title']],
            'GroupLeaders' => ['fields' => ['id', 'firstname', 'lastname', 'email',  'title']],
            'DeptLeaders' => ['fields' => ['id', 'firstname', 'lastname', 'email',  'title']]
        ]]);

        $this->isHandler($curUser, $orderReq);

        $orderReq->or_status_id = OrStatusesTable::S_COMPLETED;
        $orderReq->handler_id = $orderReq->originator_id;

        if ($this->OrderReqs->save($orderReq)) {
            $this->Flash->success(__('The Order Requisition has been Completed.'));
            $this->notifyUser($orderReq);

            return $this->redirect(['action' => 'index']);
        } else {
            $this->Flash->error(__('Can not complete the Order Requisition. Please, try again.'));
            return $this->redirect(['action' => 'view', $orderReq->id]);
        }
    }

    public function revise($id = null)
    {
        $curUser = $this->Authentication->getIdentity();
        //$curDept = $this->OrderReqs->Originators->Departments->get($curUser->department_id);

        $orderReq = $this->OrderReqs->get($id);

        $this->isHandler($curUser, $orderReq);

        $orderReq->or_status_id = OrStatusesTable::S_DRAFT; //back to Draft

        //clear approval comment
        $orderReq->group_approve_time = null;
        $orderReq->group_leader_id = null;
        $orderReq->group_comment = null;

        $orderReq->dept_approve_time = null;
        $orderReq->dept_leader_id = null;
        $orderReq->dept_comment = null;

        $orderReq->fin_approve_time = null;
        $orderReq->fin_verifier_id = null;
        $orderReq->fin_comment = null;

        if ($this->OrderReqs->save($orderReq)) {
            $this->Flash->success(__('The Order Requisition has been changed to Draft.'));

            return $this->redirect(['action' => 'edit', $orderReq->id]);
        } else {
            $this->Flash->error(__('Can not complete the Order Requisition. Please, try again.'));
            return $this->redirect(['action' => 'view', $orderReq->id]);
        }
    }

    public function deny($id = null)
    {
        $curUser = $this->Authentication->getIdentity();
        $curDept = $this->OrderReqs->Originators->Departments->get($curUser->department_id);


        $orderReq = $this->OrderReqs->get($id, ['contain' => [
            'Departments', 'Originators' => ['fields' => ['id', 'firstname', 'lastname', 'email',  'title']], 'GroupLeaders' => ['fields' => ['id', 'firstname', 'lastname', 'email',  'title']], 'DeptLeaders' => ['fields' => ['id', 'firstname', 'lastname', 'email',  'title']]
        ]]);

        $this->isHandler($curUser, $orderReq);

        $roleTable = TableRegistry::getTableLocator()->get('Roles');

        if ($this->request->is(['patch', 'post', 'put'])) {
            $now = FrozenTime::now();
            $posted = $this->request->getData();

            $orderReq->or_status_id = OrStatusesTable::S_DISAPPROVED;
            $orderReq->handler_id = $orderReq->originator_id;

            switch ($orderReq->or_status_id) {
                case 2:
                    $orderReq->group_approve_time = $now;
                    $orderReq->group_leader_id = $curUser->id;
                    $orderReq->group_comment = $posted['comment'];

                    break;

                case 3:
                    $orderReq->dept_approve_time = $now;
                    $orderReq->dept_leader_id = $curUser->id;
                    $orderReq->dept_comment = $posted['comment'];

                    break;

                case 4:
                    $orderReq->fin_approve_time = $now;
                    $orderReq->fin_verifier_id = $curUser->id;
                    $orderReq->fin_comment = $posted['comment'];

                    break;

                default:
                    # code...
                    break;
            }


            if ($this->OrderReqs->save($orderReq)) {
                $this->Flash->success(__('The Order Requisition has been Approved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The Order Requisition could not be approved. Please, try again.'));
                return $this->redirect($this->referer());
            }
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Order Req id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    // public function delete($id = null)
    // {
    //     $this->request->allowMethod(['post', 'delete']);
    //     $orderReq = $this->OrderReqs->get($id);

    //     if ($this->OrderReqs->delete($orderReq)) {
    //         $this->Flash->success(__('The order req has been deleted.'));
    //     } else {
    //         $this->Flash->error(__('The order req could not be deleted. Please, try again.'));
    //     }

    //     return $this->redirect(['action' => 'index']);
    // }

    private function generateNumber($orderReq)
    {
        $today = FrozenDate::now();
        $orderReq->reg_date = $today;

        $ORCount = $this->OrderReqs->find('all', [
            'fields' => ['id', 'reg_num', 'or_status_id',  'submit_date'], 'conditions' => [
                'submit_date >=' => $today->format('Y') . '-01-01',
                'submit_date <=' => $today->format('Y') . '-12-31',
                'req_num IS NOT NULL'
            ]
        ])->count();

        $company = $this->OrderReqs->DocCompanies->get($orderReq->doc_company_id);
        $department = $this->OrderReqs->Departments->get($orderReq->department_id);


        //$docIncoming->reg_text = $today->format('yy-mm-') . str_pad(print($docCount), 4, "0", STR_PAD_LEFT) . '/' . $company->name;
        $reg_num = $company->name . '-' . $department->init . '-' .  $today->format('y-') . 'R' .  sprintf('%04d',  1 + $ORCount);

        return $reg_num;
    }

    public function notifyUser($orderReq, $addtionalToPerson = null)
    {
        $originator = $this->OrderReqs->Originators->get($orderReq->originator_id, ['fields' => ['id', 'firstname', 'lastname', 'email',  'title']]);

        $curUser = $this->Authentication->getIdentity();

        $cc = array();
        $to = array();
        $DeptCC = array();
        $to_person = array();

        if (!is_null($orderReq->handler_id)) {
            $handler = $this->OrderReqs->Originators->get($orderReq->handler_id, ['fields' => ['id', 'firstname', 'lastname', 'email',  'title']]);
            $to[] = $handler->email;
            $to_person[] = $handler;
        }

        

        if (!is_null($addtionalToPerson)) {
            $to[] = $addtionalToPerson->email;
            $to_person[] = $addtionalToPerson;
        }

        $cc[] = $curUser->email;
        $cc[] = $originator->email;

        //$to[] = $handler->email;
        //$to_person[] = $handler;
        

        if ($orderReq->has('group_leader')) {
            $DeptCC[] = $orderReq->group_leader->email;
        }
        if ($orderReq->has('dept_leader')) {
            $DeptCC[] = $orderReq->dept_leader->email;
        }

        $options = array();

        switch ($orderReq->or_status_id) {
            case OrStatusesTable::S_GROUP_APPROVING:
                $options2 = [
                    'subject' => '[e.Office C&P] New Order Requisition submitted for Group Approval',
                    'template' => 'or_approval',
                ];
                break;
            case OrStatusesTable::S_DEPT_APPROVING:
                # Group approved
                $options2 = [
                    'subject' => '[e.Office C&P] New Order Requisition submitted for Department Approval',
                    'template' => 'or_approval',
                ];
                break;
            case OrStatusesTable::S_DISAPPROVED:
                $options2 = [
                    'subject' => '[e.Office C&P] Order Requisition is disapproved',
                    'template' => 'or_disapprove',
                ];
                break;
            case OrStatusesTable::S_CANCELLED:
                $options2 = [
                    'subject' => '[e.Office C&P] Order Requisition is cancelled',
                    'template' => 'or_cancel',
                ];
                break;
            case OrStatusesTable::S_ISSUED:
                $options2 = [
                    'subject' => '[e.Office C&P] New Order Requisition submitted to C&P: ' . $orderReq->req_num,
                    'template' => 'or_issue',
                ];
                break;
            case OrStatusesTable::S_PROCESSING:
                $options2 = [
                    'subject' => '[e.Office C&P] New Order Requisition assiged: ' . $orderReq->req_num,
                    'template' => 'or_assign',
                ];
                break;
            case OrStatusesTable::S_COMPLETED:
                $options2 = [
                    'subject' => '[e.Office C&P] Order Requisition has been completed: ' . $orderReq->req_num,
                    'template' => 'or_completed',
                ];
                break;
            default:
                # code...
                break;
        }

        //$options = array_merge($options, $options2);
        $options3 = [
            'layout' => 'eoffice',
            'format' => 'html',
            'config' => 'eoffice-cli',
            'from_name' => 'e.Office',
            'from_email' => Configure::read('from_email'),
            
        ];

        $options = array_merge($options, $options2, $options3);

        if (count($to) > 0) {
            $data = [
                'id' => $orderReq->id,
                'or_name' => $orderReq->name,
                'submit_date' => $orderReq->submit_date,
                'required_date' => $orderReq->required_date,
                'originator_name' => $orderReq->originator->name,
                'department_name' => $orderReq->department->name,
                'req_num' => $orderReq->req_num,
                'to_person' => $to_person
            ];
            EmailQueue::enqueue($to, $cc, $data, $options);
        }

        //debug($data);
        //debug($addtionalToPerson);
        $this->set('options', $options);
    }

    public function test()
    {
        $this->set('menuElement', "sash/left-menu-test-icing-bootstrap");
    }

    public function export($id){

        $this->viewBuilder()->setClassName('CakePdf.Pdf');
        $this->viewBuilder()->setLayout('layout_trung2');
        $this->viewBuilder()->setOption(
            'pdfConfig',
            [
                'orientation' => 'portrait',
                'download' => false,
                'filename' => 'test.pdf'
            ]
        );
        

    }

    public function preview($id){
        $this->viewBuilder()->setLayout('pdf/layout_trung2');

        $curUser = $this->Authentication->getIdentity();
        $curDept = $this->OrderReqs->Originators->Departments->get($curUser->department_id);

        $orderReq = $this->OrderReqs->get($id, [
            'contain' => [
                'Departments', 'Currencies', 'OrUploads', 'DeliAddresses',  'OrStatuses', 'OrItems', 'OrSuppliers', 'CpMethods', 'DocCompanies',
                'Originators' => ['fields' => ['id', 'firstname', 'lastname', 'email',  'title']],
                'GroupLeaders' => ['fields' => ['id', 'firstname', 'lastname', 'email',  'title']],
                'DeptLeaders' => ['fields' => ['id', 'firstname', 'lastname', 'email',  'title']],
            ],
        ]);

        if (($orderReq->department_id != $curUser->department_id) && (count(array_intersect($curUser->roleIDs, [RolesTable::R_GM, RolesTable::R_DGM, RolesTable::R_GM_SEC, RolesTable::R_CP])))) {
            $this->Flash->error('You dont have priviledge to View this Order Requisition!');
            return $this->redirect($this->referer());
        }

        
        
        $this->set(compact('orderReq'));
    }
}
