<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Table\DocIncomingsTable;

use App\Model\Table\DocStatusesTable;
use Cake\I18n\FrozenDate;
use EmailQueue\EmailQueue;
use Cake\Core\Configure;

/**
 * DocIncomings Controller
 *
 * @property \App\Model\Table\DocIncomingsTable $DocIncomings
 * @method \App\Model\Entity\DocIncoming[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DocIncomingsController extends AppController
{
    public const ROLE_GM_SEC_ID = 10;

    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->Authentication->allowUnauthenticated(['ajaxSearch']);

        $this->set('menuElement', "sash/left-menu-das");
    }

    public function blank()
    {
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $params = $this->request->getQueryParams();
        $criteria = $this->getSearchCriteria($params); //default values or based on posted.
        //$columns = $this->getColumns($params);
 
        $this->set('criteria', $criteria);

        $conditions = [
            ['OR' => [
                ['reg_date >=' => $criteria['date_from'], 'reg_date <=' => $criteria['date_to']],
                 ['receiving_date >=' => $criteria['date_from'], 'receiving_date <=' => $criteria['date_to']]
            ]], ['OR' => [
                'subject LIKE' => '%' . $criteria['search_text'] . '%',
                'reg_text LIKE' => '%' . $criteria['search_text'] . '%',
                'ref_text LIKE' => '%' . $criteria['search_text'] . '%',
                'doc_file LIKE' => '%' . $criteria['search_text'] . '%',
                'remark LIKE' => '%' . $criteria['search_text'] . '%'
            ]]
        ];

        $this->set('conditions', $conditions);

        $docIncomings = $this->DocIncomings->find(
            'all',
            [
                'conditions' => $conditions, 'contain' => ['Partners', 'Departments',  'DocTypes', 'DocStatuses']
            ]
        );

        $this->set(compact('docIncomings'));
    }

    private function getSearchCriteria($posted){
        $today = FrozenDate::today();
        $criteria['date_from'] = $today->subDay(30)->format('Y-m-d');
        $criteria['date_to'] = $today->format('Y-m-d');
        $criteria['search_text'] = '';
      
        if (isset($posted['date_from']) && ($posted['date_from'] != '')) {
            //$docOutgoings->where(['OR' => ['reg_date >=' => $posted['date_from'], 'issued_date >=' => $posted['date_from']]]);
            $criteria['date_from'] = $posted['date_from'];
        }

        if (isset($posted['date_to']) && ($posted['date_to'] != '')) {
            //$docOutgoings->where(['OR' => ['reg_date >=' => $posted['date_from'], 'issued_date >=' => $posted['date_from']]]);
            $criteria['date_to'] = $posted['date_to'];
        }

        if (isset($posted['search_text']) && ($posted['search_text'] != '')) {
            //$docOutgoings->where(['OR' => ['reg_date >=' => $posted['date_from'], 'issued_date >=' => $posted['date_from']]]);
            $criteria['search_text'] = $posted['search_text'];
        }
        
        return $criteria;
    }

    public function mydoc()
    {
        $curUser = $this->Authentication->getIdentity();

        $params = $this->request->getQueryParams();
        $criteria = $this->getSearchCriteria($params); //default values or based on posted.
        //$columns = $this->getColumns($params);
 
        $this->set('criteria', $criteria);

        $conditions = [
            'inputter_id' => $curUser->id,
            ['OR' => [
                ['reg_date >=' => $criteria['date_from'], 'reg_date <=' => $criteria['date_to']], ['receiving_date >=' => $criteria['date_from'], 'receiving_date <=' => $criteria['date_to']]
            ]],
            ['OR' => [
                'subject LIKE' => '%' . $criteria['search_text'] . '%',
                'reg_text LIKE' => '%' .$criteria['search_text'] . '%',
                'ref_text LIKE' => '%' . $criteria['search_text'] . '%',
                'doc_file LIKE' => '%'. $criteria['search_text'] . '%',
                'remark LIKE' => '%' . $criteria['search_text'] . '%'
            ]]
        ];
        $this->set('conditions', $conditions);

        $docIncomings = $this->DocIncomings->find(
            'all',
            [
                'conditions' => $conditions, 'contain' => ['Partners', 'Departments',  'DocTypes', 'DocStatuses']
            ]
        );

        $this->set(compact('docIncomings'));
    }
    

    public function deptdoc()
    {
        $curUser = $this->Authentication->getIdentity();
        $curDeptID = $curUser->department_id;

        $params = $this->request->getQueryParams();
        $criteria = $this->getSearchCriteria($params); //default values or based on posted.
        //$columns = $this->getColumns($params);

        $this->set('criteria', $criteria);

        $conditions = [

            ['OR' => [
                ['reg_date >=' => $criteria['date_from'],
                'reg_date <=' => $criteria['date_to']],
                 ['receiving_date >=' => $criteria['date_from'],
                  'receiving_date <=' => $criteria['date_to']]
            ]], ['OR' => [
                'subject LIKE' => '%' . $criteria['search_text'] . '%',
                'reg_text LIKE' => '%' . $criteria['search_text'] . '%',
                'ref_text LIKE' => '%' . $criteria['search_text'] . '%',
                'doc_file LIKE' => '%' . $criteria['search_text'] . '%',
                'remark LIKE' => '%' . $criteria['search_text'] . '%'
            ]]
        ];
        $this->set('conditions', $conditions);

        $docIncomings = $this->DocIncomings->find(
            'all',
            [
                'conditions' => $conditions, 'contain' => ['Partners', 'Departments',  'DocTypes', 'DocStatuses']
            ]
        );

        $docIncomings->matching('Departments', function ($q) use ($curDeptID) {
            return $q->where(['Departments.id' => $curDeptID]);
        });
        $this->set(compact('docIncomings'));
    }

    /**
     * View method
     *
     * @param string|null $id Incoming Document id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $docIncoming = $this->DocIncomings->get($id, [
            'contain' => ['DocOutgoings', 'Partners', 'Modifiers', 'Inputters', 'DocMethods', 'DocStatuses', 'DocTypes', 'Departments'],
        ]);

        $curUser = $this->Authentication->getIdentity();

        if (!$this->canView($curUser, $docIncoming)) {
            $this->Flash->error('You have no privilege to view the Document!');
            $this->redirect($this->referer());
        }

        $referer = $this->referer();
        //$docCompanies = $this->DocIncomings->DocCompanies->find('list', ['limit' => 200]);
        $partners = $this->DocIncomings->Partners->find('list', ['limit' => 200]);

        $inputters = $this->DocIncomings->Inputters->find('list', ['conditions' => ['id' => $docIncoming->inputter_id]]);
        $modifiers = $this->DocIncomings->Modifiers->find('list', ['conditions' => ['id' => $docIncoming->modifier_id]]);

        $departments = $this->DocIncomings->Departments->find('list');

        $secretLevels = $this->DocIncomings->DocSecLevels->find('list', ['limit' => 200]);
        $docMethods = $this->DocIncomings->DocMethods->find('list', ['limit' => 200]);
        $docStatuses = $this->DocIncomings->DocStatuses->find('list', ['limit' => 200]);
        $docTypes = $this->DocIncomings->DocTypes->find('list', ['limit' => 200]);
        $this->set(compact('docIncoming',  'partners',  'docMethods', 'docStatuses', 'docTypes', 'secretLevels', 'referer', 'inputters', 'modifiers', 'departments'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $curUser = $this->Authentication->getIdentity();
        $docIncoming = $this->DocIncomings->newEmptyEntity();
        if ($this->request->is('post')) {

            $docIncoming = $this->DocIncomings->patchEntity($docIncoming, $this->request->getData());
            $docIncoming->inputter_id = $curUser->id;
            $docIncoming->modifier_id = $curUser->id;
            if ($this->DocIncomings->saveNewDoc($docIncoming)) {
                $this->Flash->success(__('The Incoming Document has been saved.'));

                return $this->redirect(['action' => 'edit', $docIncoming->id]);
            }
            $this->Flash->error(__('The Incoming Document could not be saved. Please, try again.'));
        }

        //$docCompanies = $this->DocIncomings->DocCompanies->find('list', ['limit' => 200]);
        $partners = [];
        $departments = $this->DocIncomings->Departments->find('list');

        $secretLevels = $this->DocIncomings->DocSecLevels->find('list', ['limit' => 200]);
        $docMethods = $this->DocIncomings->DocMethods->find('list', ['limit' => 200]);
        $docStatuses = $this->DocIncomings->DocStatuses->find('list', ['limit' => 200]);
        $docTypes = $this->DocIncomings->DocTypes->find('list', ['limit' => 200]);
        //$relatedDocs = $this->DocIncomings->RelatedDocs->find('list', ['limit' => 200]);
        $this->set(compact(
            'docIncoming',
            'partners',
            'docMethods',
            'docStatuses',
            'docTypes',
            'secretLevels',
            'departments'
            //'relatedDocs', 
        ));
    }

    public function reserve()
    {
        $curUser = $this->Authentication->getIdentity();
        $docIncoming = $this->DocIncomings->newEmptyEntity();
        if ($this->request->is('post')) {

            $docIncoming = $this->DocIncomings->patchEntity($docIncoming, $this->request->getData());
            $docIncoming->inputter_id = $curUser->id;
            $docIncoming->modifier_id = $curUser->id;
            $docIncoming->is_reserved = true;

            if ($this->DocIncomings->exists(['reg_num' => $docIncoming->reg_num])) {
                $this->Flash->error(__('The chosen Document Number already exist! Please choose another Number!'));
            } else if ($this->DocIncomings->saveReserveDoc($docIncoming)) {
                $this->Flash->success(__('The Incoming Document has been saved.'));

                return $this->redirect(['action' => 'edit', $docIncoming->id]);
            } else {
                $this->Flash->error(__('The Incoming Document could not be saved. Please, try again.'));
            }
            
        }

        //$docCompanies = $this->DocIncomings->DocCompanies->find('list', ['limit' => 200]);
        $partners = [];
        $departments = $this->DocIncomings->Departments->find('list');

        $secretLevels = $this->DocIncomings->DocSecLevels->find('list', ['limit' => 200]);
        $docMethods = $this->DocIncomings->DocMethods->find('list', ['limit' => 200]);
        $docStatuses = $this->DocIncomings->DocStatuses->find('list', ['limit' => 200]);
        $docTypes = $this->DocIncomings->DocTypes->find('list', ['limit' => 200]);
        //$relatedDocs = $this->DocIncomings->RelatedDocs->find('list', ['limit' => 200]);
        $this->set(compact(
            'docIncoming',
            'partners',
            'docMethods',
            'docStatuses',
            'docTypes',
            'secretLevels',
            'departments'
            //'relatedDocs', 
        ));
    }

    /**
     * Edit method
     *
     * @param string|null $id Incoming Document id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $curUser = $this->Authentication->getIdentity();



        $docIncoming = $this->DocIncomings->get($id, [
            //'contain' => []
            'contain' => ['Partners', 'DocOutgoings', 'DocMethods', 'DocStatuses', 'DocTypes', 'Modifiers', 'Inputters', 'DocSecLevels', 'Departments', 'Inputters', 'Modifiers'],
        ]);

        if (!$this->canEdit($curUser, $docIncoming)) {
            $this->Flash->error('You have no privilege to edit the Document!');
            $this->redirect($this->referer());
        }


        if ($this->request->is(['patch', 'post', 'put'])) {
            $docIncoming = $this->DocIncomings->patchEntity($docIncoming, $this->request->getData());

            if ($this->DocIncomings->saveEditedDoc($docIncoming)) {
                if (($docIncoming->isDirty('doc_status_id') || $docIncoming->isDirty('doc_file')) && ($docIncoming->doc_status_id == DocStatusesTable::S_DISTRIBUTED) && ($docIncoming->has('doc_file'))){
                    $this->notifyRecievers($docIncoming);
                    
                }
                
                $this->Flash->success(__('The Incoming Document has been saved.'));

                return $this->redirect(['action' => 'view', $docIncoming->id]);
            }
            $this->Flash->error(__('The Incoming Document could not be saved. Please, try again.'));
        }
        $inputters = $this->DocIncomings->Inputters->find('list', ['conditions' => ['id' => $docIncoming->inputter_id]]);
        $modifiers = $this->DocIncomings->Modifiers->find('list', ['conditions' => ['id' => $docIncoming->modifier_id]]);

        
        $partners = [];
        if ($docIncoming->has('partner')) {
            $partners[$docIncoming->partner->id] = $docIncoming->partner->name2 . ' - ' . $docIncoming->partner->name;
        }

        $departments = $this->DocIncomings->Departments->find('list');


        $docMethods = $this->DocIncomings->DocMethods->find('list', ['limit' => 200]);
        $docStatuses = $this->DocIncomings->DocStatuses->find('list', ['limit' => 200]);
        $docTypes = $this->DocIncomings->DocTypes->find('list', ['limit' => 200]);
        $secretLevels = $this->DocIncomings->DocSecLevels->find('list');
        $relatedDoc = [];
        if ($docIncoming->has('doc_outgoing')) {
            $relatedDoc[0] = [
                'text' => $docIncoming->doc_outgoing->name, 'value' => $docIncoming->doc_outgoing->id, 'selected' => 'selected'
            ];
        }
        $this->set(compact('docIncoming',  'partners', 'secretLevels', 'docMethods', 'docStatuses', 'docTypes', 'departments', 'inputters', 'modifiers', 'relatedDoc'));
    }

    /**
     * deleteFile method
     *
     * @param string|null $id Incoming Document id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function deleteFile($id = null)
    {

        $docIncoming = $this->DocIncomings->get($id);

        /*
        * Not use this block anymore as added afterSave() into UploadBehavior
        *
        if (!is_null($docIncoming->doc_file) && $docIncoming->doc_file != ''){
            $file = new File(DocIncomingsTable::UPLOAD_DIR . $docIncoming->doc_file);

            if ($file->exists()){
                $file->delete();
                $this->Flash->success('File deleted !');
            }
        } else {
            $this->Flash->success('No uploaded file exist !');
        }
        */

        $docIncoming->doc_file = null;

        $this->DocIncomings->save($docIncoming);

        return $this->redirect($this->referer());
    }


    public function ajaxSearch()
    {
        $criteria = $this->request->getQuery('criteria');

        $results = $this->DocIncomings->findAJAX($criteria);

        $this->set('results', $results);
        $this->viewBuilder()->setOption('serialize', ['results']);
    }

    public function canEdit($user, $docIncoming)
    {
        //GM, DGM, GM Sec can edit any doc
        if (count(array_intersect($user->roleIDs, [2, 3, 10])) > 0) {
            return true;
        }

        //anyone input a level 1 doc can edit that doc.

        if (($user->id == $docIncoming->inputer_id || $user->id == $docIncoming->modifier_id)) {
            return true;
        }

        /*
        $deptIDs = array();
        $i = 0;
        foreach ($docIncoming->departments as $department){
            $deptIDs[$i] = $department->id;
            $i++;
        }

        //Normal Doc, recipient dept staff can read
        if ($i > 0 && $docIncoming->doc_sec_level_id = 1 && in_array($user->department_id, $deptIDs)){
            $result = true;
            return $result;
        }

        //Confidential Doc, recipient dept LM can read
        if ($i > 0 && $docIncoming->doc_sec_level_id = 2 && in_array($user->department_id, $deptIDs) && in_array(5, $user->roleIDs)){
            $result = true;
            return $result;
        }
*/
        return false;
    }

    public function canView($user, $docIncoming)
    {

        //GM, DGM, GM Sec can view any doc
        if (count(array_intersect($user->roleIDs, [2, 3, 10])) > 0) {
            return true;
        }

        //anyone input a level 1 doc can access that doc.

        if (($user->id == $docIncoming->inputer_id || $user->id == $docIncoming->modifier_id)) {
            return true;
        }

        $deptIDs = array();
        $i = 0;
        foreach ($docIncoming->departments as $department) {
            $deptIDs[$i] = $department->id;
            $i++;
        }

        //Normal Doc, recipient dept staff can read
        if (($i > 0) && ($docIncoming->doc_sec_level_id == 1) && in_array($user->department_id, $deptIDs)) {
            return true;
        }

        //Confidential Doc, recipient dept LM, DLM can read
        if (($i > 0) && ($docIncoming->doc_sec_level_id == 2) && in_array($user->department_id, $deptIDs) && (in_array(5, $user->roleIDs) || in_array(6, $user->roleIDs))) {
            return true;
        }

        return false;
    }

    private function notifyRecievers($docIncoming){
        $to = array();
        $data = array();
        $Mans = array();

        foreach ($docIncoming->departments as $department) {
            $LM = $this->DocIncomings->Departments->getLineManager($department->id);
            $DM = $this->DocIncomings->Departments->getDeputyManager($department->id);
            if (!is_null($LM)){
                $Mans[] = $LM;
                $to[] = $LM->email;
            }

            if (!is_null($DM)){
                $Mans[] = $DM;
                $to[] = $DM->email;
            }

        }

        if (count($to) > 0){
            $options = [
                'subject' => '[e.Office DAS] New Incoming Document recieved: ' . $docIncoming->subject,
                'layout' => 'eoffice',
                'template' => 'das_notify_new_incoming_doc',
                'format' => 'html',
                'config' => 'eoffice-cli',
                'from_name' => 'e.Office',
                'from_email' => Configure::read('from_email')
            ];

            $curUser = $this->Authentication->getIdentity();
            $cc = $curUser->email;
            $data['LMs'] = $Mans;
            $data['doc_subject'] = $docIncoming->subject;
            $data['doc_id'] = $docIncoming->id;
            $data['doc_type'] = $docIncoming->doc_type->name;
            $data['doc_sender'] = $docIncoming->partner->name;

            EmailQueue::enqueue($to, $cc, $data, $options);
        }
    }
}
