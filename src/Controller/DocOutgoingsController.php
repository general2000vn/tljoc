<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Table\DocOutgoingsTable;
use Cake\I18n\FrozenDate;
use App\Model\Table\RolesTable;
use App\Model\Table\DocSecLevelsTable;
use EmailQueue\EmailQueue;
use Cake\Core\Configure;
use App\Model\Table\DocStatusesTable;

/**
 * DocOutgoings Controller
 *
 * @property \App\Model\Table\DocOutgoingsTable $DocOutgoings
 * @method \App\Model\Entity\DocOutgoing[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DocOutgoingsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->Authentication->allowUnauthenticated(['ajaxSearch']);

        $this->set('menuElement', "sash/left-menu-das");
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $curUser = $this->Authentication->getIdentity();

        if (count(array_intersect($curUser->roleIDs, [RolesTable::R_GM, RolesTable::R_DGM, RolesTable::R_GM_SEC,])) == 0) {
            $this->Flash->error('You have no privilege to view All Documents!');
            $this->redirect(['action' => 'mydoc']);
        }

        $params = $this->request->getQueryParams();
        $criteria = $this->getSearchCriteria($params); //default values or based on posted.
        //$columns = $this->getColumns($params);

        $this->set('criteria', $criteria);

        $conditions = [
            ['OR' => [
                ['reg_date >=' => $criteria['date_from'], 'reg_date <=' => $criteria['date_to']],
                ['issued_date >=' => $criteria['date_from'], 'issued_date <=' => $criteria['date_to']]
            ]],
            ['OR' => [
                'subject LIKE' => '%' . $criteria['search_text'] . '%',
                'reg_text LIKE' => '%' . $criteria['search_text'] . '%',
                'contract_no LIKE' => '%' . $criteria['search_text'] . '%',
                'doc_file LIKE' => '%' . $criteria['search_text'] . '%',
                'remark LIKE' => '%' . $criteria['search_text']  . '%'
            ]]
        ];
        $this->set('conditions', $conditions);

        $docOutgoings = $this->DocOutgoings->find(
            'all',
            [
                'conditions' => $conditions, 'contain' => ['Partners', 'Departments', 'DocSecLevels', 'DocTypes', 'DocStatuses']
            ]
        );

        $dept_id = $criteria['dept_id'];

        if ($dept_id != 0) {
            $docOutgoings->matching('Departments', function ($q) use ($dept_id) {
                return $q->where(['Departments.id' => $dept_id]);
            });
        }


        $deptList = [0 => 'All Departments'];
        $depts = $this->DocOutgoings->Departments->find('list')->toArray();
        $deptList = array_merge($deptList, $depts);
        $this->set('deptList', $deptList);

        $this->set(compact('docOutgoings'));
    }

    private function getSearchCriteria($posted)
    {
        $today = FrozenDate::today();
        $criteria['date_from'] = $today->subDay(30)->format('Y-m-d');
        $criteria['date_to'] = $today->format('Y-m-d');
        $criteria['search_text'] = '';

        $curUser = $this->Authentication->getIdentity();
        $criteria['dept_id'] = $curUser->departments[0]->id;

        if (isset($posted['date_from']) && ($posted['date_from'] != '')) {
            //$docOutgoings->where(['OR' => ['reg_date >=' => $posted['date_from'], 'issued_date >=' => $posted['date_from']]]);
            $criteria['date_from'] = $posted['date_from'];
        }

        if (isset($posted['date_to']) && ($posted['date_to'] != '')) {
            //$docOutgoings->where(['OR' => ['reg_date >=' => $posted['date_from'], 'issued_date >=' => $posted['date_from']]]);
            $criteria['date_to'] = $posted['date_to'];
        }

        if (isset($posted['search_text'])) {
            //$docOutgoings->where(['OR' => ['reg_date >=' => $posted['date_from'], 'issued_date >=' => $posted['date_from']]]);
            $criteria['search_text'] = $posted['search_text'];
        }

        if (isset($posted['dept_id']) && ($posted['dept_id'] != '')) {
            //$docOutgoings->where(['OR' => ['reg_date >=' => $posted['date_from'], 'issued_date >=' => $posted['date_from']]]);
            $criteria['dept_id'] = $posted['dept_id'];
        }

        return $criteria;
    }

    private function getColumns($posted)
    {

        if (!isset($posted['columns'])) {
            $columns['reg_text'] = 1;
            $columns['reg_date'] = 0;
            $columns['issued_date'] = 1;
            $columns['doc_type'] = 1;
            $columns['department'] = 0;
            $columns['doc_status'] = 1;
            $columns['doc_category'] = 0;
            $columns['doc_sec_level'] = 0;
            $columns['subject'] = 1;
        } else {
            $columns = $posted['columns'];
        }

        return $columns;
    }

    public function mydoc()
    {
        $curUser = $this->Authentication->getIdentity();

        $params = $this->request->getQueryParams();
        $criteria = $this->getSearchCriteria($params); //default values or based on posted.
        //$columns = $this->getColumns($params);


        $this->set('criteria', $criteria);

        $conditions = [
            ['OR' => ['inputter_id' => $curUser->id, 'originator_id' => $curUser->id]], ['OR' => [
                ['reg_date >=' => $criteria['date_from'], 'reg_date <=' => $criteria['date_to']], ['issued_date >=' => $criteria['date_from'], 'issued_date <=' => $criteria['date_to']]
            ]], ['OR' => [
                'subject LIKE' => '%' . $criteria['search_text'] . '%', 'reg_text LIKE' => '%' . $criteria['search_text'] . '%', 'contract_no LIKE' => '%' . $criteria['search_text'] . '%', 'doc_file LIKE' => '%' . $criteria['search_text'] . '%', 'remark LIKE' => '%' . $criteria['search_text'] . '%'
            ]]
        ];
        $this->set('conditions', $conditions);

        $docOutgoings = $this->DocOutgoings->find(
            'all',
            [
                'conditions' => $conditions, 'contain' => ['Partners', 'Departments', 'DocSecLevels', 'DocTypes', 'DocStatuses']
            ]
        );

        $dept_id = $criteria['dept_id'];

        if ($dept_id != 0) {
            $docOutgoings->matching('Departments', function ($q) use ($dept_id) {
                return $q->where(['Departments.id' => $dept_id]);
            });
        }

        $curUserID = $curUser->id;
        $deptList = $this->DocOutgoings->Departments->find('list')->matching('Users', function ($q) use ($curUserID) {
            return $q->where(['Users.id' => $curUserID]);
        })->toArray();

        $this->set('deptList', $deptList);

        $this->set(compact('docOutgoings'));
    }

    public function deptdoc()
    {
        $curUser = $this->Authentication->getIdentity();
        $curDeptID = $curUser->department_id;

        $params = $this->request->getQueryParams();
        $criteria = $this->getSearchCriteria($params); //default values or based on posted.

        //$columns = $this->getColumns($params);
        //$this->set('columns', $columns);

        $this->set('criteria', $criteria);

        $conditions = [
            ['OR' => [
                ['reg_date >=' => $criteria['date_from'], 'reg_date <=' => $criteria['date_to']], ['issued_date >=' => $criteria['date_from'], 'issued_date <=' => $criteria['date_to']]
            ]], ['OR' => [
                'subject LIKE' => '%' . $criteria['search_text'] . '%', 'reg_text LIKE' => '%' . $criteria['search_text'] . '%', 'contract_no LIKE' => '%' . $criteria['search_text'] . '%', 'doc_file LIKE' => '%' . $criteria['search_text'] . '%', 'remark LIKE' => '%' . $criteria['search_text'] . '%'
            ]]
        ];
        //$this->set('conditions', $conditions);

        $docOutgoings = $this->DocOutgoings->find(
            'all',
            [
                'conditions' => $conditions, 'contain' => ['Partners', 'Departments', 'DocSecLevels',  'DocTypes', 'DocStatuses']
            ]
        );

        $docOutgoings->matching('Departments', function ($q) use ($curDeptID) {
            return $q->where(['Departments.id' => $curDeptID]);
        });

        $dept_id = $criteria['dept_id'];

        if ($dept_id != 0) {
            $docOutgoings->matching('Departments', function ($q) use ($dept_id) {
                return $q->where(['Departments.id' => $dept_id]);
            });
        }


        $curUserID = $curUser->id;
        $deptList = $this->DocOutgoings->Departments->find('list')->matching('Users', function ($q) use ($curUserID) {
            return $q->where(['Users.id' => $curUserID]);
        })->toArray();

        $this->set('deptList', $deptList);

        $this->set(compact('docOutgoings'));
    }

    /**
     * View method
     *
     * @param string|null $id Outgoing Document id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $curUser = $this->Authentication->getIdentity();
        $docOutgoing = $this->DocOutgoings->get($id, [
            'contain' => ['DocTypes',  'Partners', 'Originators', 'Inputters', 'Modifiers', 'DocMethods', 'DocSecLevels', 'DocStatuses', 'Departments', 'DocIncomings'],
        ]);

        $canView = $this->canView($curUser, $docOutgoing);
        $this->set("canView", $canView);

        if (!$this->canView($curUser, $docOutgoing)) {
            $this->Flash->error('You have no privilege to view the Document!');
            $this->redirect($this->referer());
        }

        $partners = $this->extractPartnersList($docOutgoing->partners);


        $this->set(compact('docOutgoing', 'partners'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $curUser = $this->Authentication->getIdentity();

        $docOutgoing = $this->DocOutgoings->newEmptyEntity();
        if ($this->request->is('post')) {
            $today = FrozenDate::today();
            $docOutgoing = $this->DocOutgoings->patchEntity($docOutgoing, $this->request->getData());
            $docOutgoing->inputter_id = $curUser->id;
            $docOutgoing->modifier_id = $curUser->id;

            $bNotify = false;
            if (($docOutgoing->doc_status_id == DocStatusesTable::S_DISTRIBUTED) && ($docOutgoing->has('doc_file'))) {
                $bNotify = true;
            }

            if ($this->DocOutgoings->saveNewDoc($docOutgoing)) {
                $this->Flash->success(__('The Outgoing Document has been saved.'));

                if ($bNotify) {
                    $docOutgoing = $this->DocOutgoings->get($docOutgoing->id, [
                        //'contain' => []
                        'contain' => ['Partners', 'DocTypes', 'DocSecLevels', 'Departments', 'Inputters', 'Originators'],
                    ]);
                    $this->notifyRecievers($docOutgoing);
                }

                return $this->redirect(['action' => 'edit', $docOutgoing->id]);
            }
            $this->Flash->error(__('The Outgoing Document could not be saved. Please, try again.'));
        }

        $docTypes = $this->DocOutgoings->DocTypes->find('list', ['limit' => 200]);
        //$docCompanies = $this->DocOutgoings->DocCompanies->find('list', ['limit' => 200]);
        $partners = $this->DocOutgoings->Partners->find('list', ['order' => ['name2' => 'ASC']]);
        $originators = $this->DocOutgoings->Originators->find('list', [
            'conditions' => ['is_deleted' => false], 'order' => ['firstname' => 'ASC', 'lastname' => 'ASC']
        ]);

        $default_dept_id = $curUser->departments[0]->id;

        $docCategories = $this->DocOutgoings->DocCategories->find('list', ['limit' => 200]);
        $docMethods = $this->DocOutgoings->DocMethods->find('list', ['limit' => 200]);
        $docSecLevels = $this->DocOutgoings->DocSecLevels->find('list', ['limit' => 200]);
        $docStatuses = $this->DocOutgoings->DocStatuses->find('list', ['limit' => 200]);
        $departments = $this->DocOutgoings->Departments->find('list', ['limit' => 200]);

        $docIncomings = $this->DocOutgoings->DocIncomings->find('list', ['limit' => 10, 'order' => ['reg_date' => 'DESC']]);
        $this->set(compact('docOutgoing', 'docTypes',  'partners', 'originators',  'docCategories', 'docMethods', 'docSecLevels', 'docStatuses', 'departments', 'docIncomings', 'default_dept_id'));
    }

    public function reserve()
    {
        $curUser = $this->Authentication->getIdentity();

        $docOutgoing = $this->DocOutgoings->newEmptyEntity();
        if ($this->request->is('post')) {
            $today = FrozenDate::today();
            $docOutgoing = $this->DocOutgoings->patchEntity($docOutgoing, $this->request->getData());
            $docOutgoing->inputter_id = $curUser->id;
            $docOutgoing->modifier_id = $curUser->id;
            $docOutgoing->is_reserved = true;

            if ($this->DocOutgoings->exists(['reg_num' => $docOutgoing->reg_num])) {
                $this->Flash->error(__('The chosen Document Number already exist! Please choose another Number!'));
            } else if ($this->DocOutgoings->saveReserveDoc($docOutgoing)) {
                $this->Flash->success(__('The Outgoing Document has been saved.'));

                return $this->redirect(['action' => 'edit', $docOutgoing->id]);
            } else {
                $this->Flash->error(__('The Outgoing Document could not be saved. Please, try again.'));
            }
        }

        $docTypes = $this->DocOutgoings->DocTypes->find('list', ['limit' => 200]);
        //$docCompanies = $this->DocOutgoings->DocCompanies->find('list', ['limit' => 200]);
        $partners = $this->DocOutgoings->Partners->find('list', ['order' => ['name2' => 'ASC']]);
        $originators = $this->DocOutgoings->Originators->find('list', [
            'conditions' => ['is_deleted' => false], 'order' => ['firstname' => 'ASC', 'lastname' => 'ASC']
        ]);

        $docCategories = $this->DocOutgoings->DocCategories->find('list', ['limit' => 200]);
        $docMethods = $this->DocOutgoings->DocMethods->find('list', ['limit' => 200]);
        $docSecLevels = $this->DocOutgoings->DocSecLevels->find('list', ['limit' => 200]);
        $docStatuses = $this->DocOutgoings->DocStatuses->find('list', ['limit' => 200]);
        $departments = $this->DocOutgoings->Departments->find('list', ['limit' => 200]);

        $docIncomings = $this->DocOutgoings->DocIncomings->find('list', ['limit' => 10, 'order' => ['reg_date' => 'DESC']]);
        $this->set(compact('docOutgoing', 'docTypes',  'partners', 'originators',  'docCategories', 'docMethods', 'docSecLevels', 'docStatuses', 'departments', 'docIncomings'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Outgoing Document id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $curUser = $this->Authentication->getIdentity();
        $docOutgoing = $this->DocOutgoings->get($id, [
            'contain' => ['Departments', 'Originators', 'DocIncomings', 'Partners', 'Inputters'],
        ]);

        if (!$this->canEdit($curUser, $docOutgoing)) {
            $this->Flash->error('You have no privilege to edit the Document!');
            $this->redirect($this->referer());
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $docOutgoing = $this->DocOutgoings->patchEntity($docOutgoing, $this->request->getData());

            $bNotify = false;
            if (($docOutgoing->isDirty('doc_status_id') || $docOutgoing->isDirty('doc_file')) && ($docOutgoing->doc_status_id == DocStatusesTable::S_DISTRIBUTED) && ($docOutgoing->has('doc_file'))) {
                $bNotify = true;
            }

            if ($this->DocOutgoings->saveEditedDoc($docOutgoing)) {
                $this->Flash->success(__('The Outgoing Document has been saved.'));

                if ($bNotify) {
                    $docOutgoing = $this->DocOutgoings->get($id, [
                        'contain' => ['Departments', 'Originators', 'DocIncomings', 'Partners', 'Inputters', 'DocTypes'],
                    ]);
                    $this->notifyRecievers($docOutgoing);
                }

                return $this->redirect(['action' => 'view', $docOutgoing->id]);
                //return;
            } else {
                $this->Flash->error(__('The Outgoing Document could not be saved. Please, try again.'));
            }
        }
        $docTypes = $this->DocOutgoings->DocTypes->find('list', ['limit' => 200]);
        //$docCompanies = $this->DocOutgoings->DocCompanies->find('list', ['limit' => 200]);

        $partners = $this->extractPartnersList($docOutgoing->partners);


        $relatedDoc = [];
        if ($docOutgoing->has('doc_incoming')) {
            $relatedDoc[0] = [
                'text' => $docOutgoing->doc_incoming->reg_text . ' - ' . $docOutgoing->doc_incoming->subject, 'value' => $docOutgoing->doc_incoming->id, 'selected' => 'selected'
            ];
        }

        $partnersList = [];
        $i = 0;
        foreach ($docOutgoing->partners as $partner) {
            $partnersList[$i] = [
                'text' => $partner->name2 . ' - ' . $partner->name, 'value' => $partner->id, 'selected' => 'selected'
            ];
            $i++;
        }

        $users = $this->DocOutgoings->Inputters->find('list', ['conditions' => ['is_deleted' => false]]);
        $docCategories = $this->DocOutgoings->DocCategories->find('list', ['limit' => 200]);
        $docMethods = $this->DocOutgoings->DocMethods->find('list', ['limit' => 200]);
        $docSecLevels = $this->DocOutgoings->DocSecLevels->find('list', ['limit' => 200]);
        $docStatuses = $this->DocOutgoings->DocStatuses->find('list', ['limit' => 200]);
        $departments = $this->DocOutgoings->Departments->find('list', ['limit' => 200]);
        $this->set(compact('docOutgoing', 'docTypes',  'partners', 'relatedDoc', 'partnersList', 'users', 'docCategories', 'docMethods', 'docSecLevels', 'docStatuses', 'departments'));
    }

    public function deleteFile($id = null)
    {
        //$this->request->allowMethod(['post', 'delete']);

        $docOutgoing = $this->DocOutgoings->get($id);

        /*
        * Not use this part anymore as added afterSave() into UploadBehavior
        *
        if (!is_null($docOutgoing->doc_file) && $docOutgoing->doc_file != '') {
            $file = new File(DocOutgoingsTable::UPLOAD_DIR . $docOutgoing->doc_file);

            if ($file->exists()) {
                $file->delete();
                $this->Flash->success('File deleted !');
            }
        } else {
            $this->Flash->success('No uploaded file exist !');
        }
        */

        $docOutgoing->doc_file = null;

        $this->DocOutgoings->save($docOutgoing);

        return $this->redirect($this->referer());
    }

    public function ajaxSearch()
    {
        $criteria = $this->request->getQuery('criteria');

        $results = $this->DocOutgoings->findAJAX($criteria);

        $this->set('results', $results);
        $this->viewBuilder()->setOption('serialize', ['results']);
    }

    /**
     * extract list of Partners based of this DocOut.
     *
     * @param int $docOutID ID of DocOutgoing.
     * @return array List of partners in format []['id' => 'initial' . 'name']
     */
    private function extractPartnersList($partners)
    {
        $partnersList = [];
        $i = 0;
        foreach ($partners as $partner) {
            $partnersList[$i] = [
                'text' => $partner->name2 . ' - ' . $partner->name, 'value' => $partner->id, 'selected' => 'selected'
            ];
            $i++;
        }

        return $partnersList;
    }

    public function canEdit($user, $docOutgoing)
    {
        //GM, DGM, GM Sec can edit any doc
        if (count(array_intersect($user->roleIDs, [RolesTable::R_GM, RolesTable::R_DGM, RolesTable::R_GM_SEC])) > 0) {
            return true;
        }

        //anyone input a level 1 doc can edit that doc.

        if (($user->id == $docOutgoing->inputer_id || $user->id == $docOutgoing->modifier_id)) {
            return true;
        }

        if (($this->DocOutgoings->Inputters->inDepartments($user->id, [$docOutgoing->department_id]))) {
            //Normal Doc, recipient dept staff can read
            if (($docOutgoing->doc_sec_level_id == 1)) {
                return true;
            } else if (($docOutgoing->doc_sec_level_id == 2) && count(array_intersect([RolesTable::R_LM, RolesTable::R_DLM], $user->roleIDs)) > 0) { //user is LM or DLM
                return true;
            }
        }

        return false;
    }

    public function canView($user, $docOutgoing)
    {

        //GM, DGM, GM Sec can view any doc
        if (count(array_intersect($user->roleIDs, [RolesTable::R_GM, RolesTable::R_DGM, RolesTable::R_GM_SEC])) > 0) {
            return true;
        }

        //anyone input a level 1 doc can access that doc.

        if (($user->id == $docOutgoing->inputer_id || $user->id == $docOutgoing->modifier_id)) {
            return true;
        }

        //Normal Doc, recipient dept staff can read
        if (($this->DocOutgoings->Inputters->inDepartments($user->id, [$docOutgoing->department_id]))) {
            //Normal Doc, recipient dept staff can read
            if (($docOutgoing->doc_sec_level_id == 1)) {
                return true;
            } else if (($docOutgoing->doc_sec_level_id == 2) && count(array_intersect([RolesTable::R_LM, RolesTable::R_DLM], $user->roleIDs)) > 0) { //user is LM or DLM
                return true;
            }
        }

        return false;
    }

    private function notifyRecievers($docOutgoing)
    {
        $emails = array();
        $data = array();
        $recipients = array();

        $GM = $this->DocOutgoings->Inputters->getOneByRole(RolesTable::R_GM);
        $DGM = $this->DocOutgoings->Inputters->getOneByRole(RolesTable::R_DGM);



        $emails[] = $GM->email;
        $emails[] = $DGM->email;

        

        foreach ($docOutgoing->partners as $partner) {
            $recipients[] = $partner->name;
        }

        $options = [
            'subject' => '[TLJOC e-Office] New Outgoing Document: ' . $docOutgoing->subject,
            'layout' => 'eoffice',
            'template' => 'das_notify_new_outgoing_doc',
            'format' => 'html',
            'config' => 'eoffice-cli',
            'from_name' => 'e.Office',
            'from_email' => Configure::read('from_email')
        ];


        $curUser = $this->Authentication->getIdentity();
        $cc = $curUser->email;
        //    $data['people'] = $people;
        $data['doc_subject'] = $docOutgoing->subject;
        $data['doc_id'] = $docOutgoing->id;
        $data['doc_type'] = $docOutgoing->doc_type->name;
        $data['doc_sender'] = $docOutgoing->originator->name;
        $data['doc_dept'] = $docOutgoing->department->name;
        $data['doc_recipient'] = $recipients;

        EmailQueue::enqueue($emails, $cc, $data, $options);
    }
}
