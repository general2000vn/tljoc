<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\I18n\FrozenDate;
use App\Model\Table\RolesTable;

/**
 * DocInternals Controller
 *
 * @property \App\Model\Table\DocInternalsTable $DocInternals
 * @method \App\Model\Entity\DocInternal[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DocInternalsController extends AppController
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
        $columns = $this->getColumns($params);
        
        $this->set('columns', $columns);
        $this->set('criteria', $criteria);
        

        $conditions = [
            ['OR' => [
                ['reg_date >=' => $criteria['date_from'], 'reg_date <=' => $criteria['date_to']], ['issued_date >=' => $criteria['date_from'], 'issued_date <=' => $criteria['date_to']]
            ]], ['OR' => [
                'subject LIKE' => '%' . $criteria['search_text'] . '%', 'reg_text LIKE' => '%' . $criteria['search_text'] . '%',  'doc_file LIKE' => '%' . $criteria['search_text'] . '%', 'remark LIKE' => '%' . $criteria['search_text'] . '%'
            ]]
        ];
        $this->set('conditions', $conditions);

        $docInternals = $this->DocInternals->find(
            'all',
            [
                'conditions' => $conditions, 'contain' => [ 'Departments',  'DocInternalTypes', 'DocStatuses', 'DocSecLevels']
            ]
        );

        $dept_id = $criteria['dept_id'];

        if ($dept_id != 0) {
            $docInternals->matching('Departments', function ($q) use ($dept_id) {
                return $q->where(['Departments.id' => $dept_id]);
            });
        }
        

        $deptList = [0 => 'All Departments'];
        $depts = $this->DocInternals->Departments->find('list')->toArray();
        $deptList = array_merge($deptList, $depts);
        $this->set('deptList', $deptList);

        $this->set(compact('docInternals'));
    }

    public function mydoc()
    {
        $curUser = $this->Authentication->getIdentity();

        $params = $this->request->getQueryParams();
        $criteria = $this->getSearchCriteria($params); //default values or based on posted.
        $columns = $this->getColumns($params);
        
        $this->set('columns', $columns);
        $this->set('criteria', $criteria);

        $conditions = [
            ['OR' => ['inputter_id' => $curUser->id, 'originator_id' => $curUser->id]], ['OR' => [
                ['reg_date >=' => $criteria['date_from'], 'reg_date <=' => $criteria['date_to']], ['issued_date >=' => $criteria['date_from'], 'issued_date <=' => $criteria['date_to']]
            ]], ['OR' => [
                'subject LIKE' => '%' . $criteria['search_text'] . '%', 'reg_text LIKE' => '%' . $criteria['search_text'] . '%',  'doc_file LIKE' => '%' . $criteria['search_text'] . '%', 'remark LIKE' => '%' . $criteria['search_text'] . '%'
            ]]
        ];
        $this->set('conditions', $conditions);

        $docInternals = $this->DocInternals->find(
            'all',
            [
                'conditions' => $conditions, 'contain' => [ 'Departments',  'DocInternalTypes', 'DocStatuses', 'DocSecLevels']
            ]
        );

        $dept_id = $criteria['dept_id'];
        
        if ($dept_id != 0) {
            $docInternals->matching('Departments', function ($q) use ($dept_id) {
                return $q->where(['Departments.id' => $dept_id]);
            });
        }

        $curUserID = $curUser->id;
        $deptList = $this->DocInternals->Departments->find('list')->matching('Users', function ($q) use ($curUserID){
            return $q->where(['Users.id' => $curUserID]);
        })->toArray();

        $this->set('deptList', $deptList);

        $this->set(compact('docInternals'));
    }

    public function deptdoc()
    {
        $curUser = $this->Authentication->getIdentity();
        $curDeptID = $curUser->department_id;

        $params = $this->request->getQueryParams();
        $criteria = $this->getSearchCriteria($params); //default values or based on posted.
        $columns = $this->getColumns($params);
        
        
        $this->set('criteria', $criteria);

        $conditions = [
            ['OR' => [
                ['reg_date >=' => $criteria['date_from'], 'reg_date <=' => $criteria['date_to']], ['issued_date >=' => $criteria['date_from'], 'issued_date <=' => $criteria['date_to']]
            ]], ['OR' => [
                'subject LIKE' => '%' . $criteria['search_text'] . '%', 'reg_text LIKE' => '%' . $criteria['search_text'] . '%', 'doc_file LIKE' => '%' . $criteria['search_text'] . '%', 'remark LIKE' => '%' . $criteria['search_text'] . '%'
            ]]
        ];
        //$this->set('conditions', $conditions);

        $docInternals = $this->DocInternals->find(
            'all',
            [
                'conditions' => $conditions, 'contain' => [ 'Departments', 'DocSecLevels', 'DocInternalTypes', 'DocStatuses']
            ]
        );

        $docInternals->matching('Departments', function ($q) use ($curDeptID) {
            return $q->where(['Departments.id' => $curDeptID]);
        });

        $dept_id = $criteria['dept_id'];
        
        if ($dept_id != 0) {
            $docInternals->matching('Departments', function ($q) use ($dept_id) {
                return $q->where(['Departments.id' => $dept_id]);
            });
        }


        $curUserID = $curUser->id;
        $deptList = $this->DocInternals->Departments->find('list')->matching('Users', function ($q) use ($curUserID){
            return $q->where(['Users.id' => $curUserID]);
        })->toArray();

        $this->set('deptList', $deptList);

        $this->set(compact('docInternals'));
    }

    /**
     * View method
     *
     * @param string|null $id Internal Document id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $curUser = $this->Authentication->getIdentity();
        $docInternal = $this->DocInternals->get($id, [
            'contain' => ['DocSecLevels', 'DocInternalTypes', 'DocStatuses',  'Departments', 'Originators', 'Inputters', 'Modifiers'],
        ]);

        if (!$this->canView($curUser, $docInternal)){
            $this->Flash->error('You have no privilege to view the document!');
            $this->redirect(['action'=> 'index']);
        }

        
        $this->set(compact('docInternal'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $curUser = $this->Authentication->getIdentity();

        $docInternal = $this->DocInternals->newEmptyEntity();
        if ($this->request->is('post')) {
            $today = FrozenDate::today();
            $docInternal = $this->DocInternals->patchEntity($docInternal, $this->request->getData());
            $docInternal->inputter_id = $curUser->id;
            $docInternal->modifier_id = $curUser->id;

            if ($this->DocInternals->saveNewDoc($docInternal)) {
                $this->Flash->success(__('The doc outgoing has been saved.'));

                return $this->redirect(['action' => 'edit', $docInternal->id]);
            }
            $this->Flash->error(__('The doc outgoing could not be saved. Please, try again.'));
        }

        $docTypes = $this->DocInternals->DocInternalTypes->find('list', ['limit' => 200]);
        $docCompanies = $this->DocInternals->DocCompanies->find('list', ['limit' => 200]);

        
        $users = $this->DocInternals->Originators->find('list', [
            'conditions' => ['is_deleted' => false], 'order' => ['firstname' => 'ASC', 'lastname' => 'ASC']
        ]);

        //$docCategories = $this->DocInternals->DocCategories->find('list', ['limit' => 200]);
        $docSecLevels = $this->DocInternals->DocSecLevels->find('list', ['limit' => 200]);
        $docStatuses = $this->DocInternals->DocStatuses->find('list', ['limit' => 200]);
        $departments = $this->DocInternals->Departments->find('list', ['limit' => 200]);
        $default_dept_id = $curUser->departments[0]->id;
        
        $this->set(compact('docInternal', 'docTypes',  'users', 'docSecLevels', 'docStatuses', 'departments', 'default_dept_id'));
    }

    public function reserve()
    {
        $curUser = $this->Authentication->getIdentity();

        $docInternal = $this->DocInternals->newEmptyEntity();
        if ($this->request->is('post')) {
            $today = FrozenDate::today();
            $docInternal = $this->DocInternals->patchEntity($docInternal, $this->request->getData());
            $docInternal->inputter_id = $curUser->id;
            $docInternal->modifier_id = $curUser->id;
            $docInternal->is_reserved = true;

            if ($this->DocInternals->exists(['reg_num' => $docInternal->reg_num])) {
                $this->Flash->error(__('The chosen Document Number already exist! Please choose another Number!'));
            }
            else if ($this->DocInternals->saveReserveDoc($docInternal)) {
                $this->Flash->success(__('The Internal Document has been saved.'));

                return $this->redirect(['action' => 'edit', $docInternal->id]);
            } else {
                $this->Flash->error(__('The Internal Document could not be saved. Please, try again.'));
            }
        }

        $docTypes = $this->DocInternals->DocInternalTypes->find('list', ['limit' => 200]);
        $docCompanies = $this->DocInternals->DocCompanies->find('list', ['limit' => 200]);
        
        $users = $this->DocInternals->Originators->find('list', [
            'conditions' => ['is_deleted' => false], 'order' => ['firstname' => 'ASC', 'lastname' => 'ASC']
        ]);

        //$docCategories = $this->DocInternals->DocCategories->find('list', ['limit' => 200]);
        $docSecLevels = $this->DocInternals->DocSecLevels->find('list', ['limit' => 200]);
        $docStatuses = $this->DocInternals->DocStatuses->find('list', ['limit' => 200]);
        $departments = $this->DocInternals->Departments->find('list', ['limit' => 200]);

        
        $this->set(compact('docInternal', 'docTypes',  'users', 'docSecLevels', 'docStatuses', 'departments'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Internal Document id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $curUser = $this->Authentication->getIdentity();
        $docInternal = $this->DocInternals->get($id, [
            'contain' => ['Departments', 'Originators',  'Inputters'],
        ]);

        if (!$this->canEdit($curUser, $docInternal)){
            $this->Flash->error('You have no privilege to edit the Document!');
            $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $docInternal = $this->DocInternals->patchEntity($docInternal, $this->request->getData());

            if ($this->DocInternals->saveEditedDoc($docInternal)) {
                $this->Flash->success(__('The doc outgoing has been saved.'));

                return $this->redirect(['action' => 'view', $docInternal->id]);
                //return;
            } else {
                $this->Flash->error(__('The doc outgoing could not be saved. Please, try again.'));
            }
        }
        $docTypes = $this->DocInternals->DocInternalTypes->find('list', ['limit' => 200]);
        $docCompanies = $this->DocInternals->DocCompanies->find('list', ['limit' => 200]);

        $users = $this->DocInternals->Inputters->find('list', ['conditions' => ['is_deleted' => false]]);

        $docSecLevels = $this->DocInternals->DocSecLevels->find('list', ['limit' => 200]);
        $docStatuses = $this->DocInternals->DocStatuses->find('list', ['limit' => 200]);
        $departments = $this->DocInternals->Departments->find('list', ['limit' => 200]);
        $this->set(compact('docInternal', 'docTypes',   'users', 'docSecLevels', 'docStatuses', 'departments'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Internal Document id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $docInternal = $this->DocInternals->get($id);
        if ($this->DocInternals->delete($docInternal)) {
            $this->Flash->success(__('The Internal Document has been deleted.'));
        } else {
            $this->Flash->error(__('The Internal Document could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function canEdit($user, $docInternal)
    {
        
        //GM, DGM, GM Sec can edit any doc
        if (count(array_intersect($user->roleIDs, [RolesTable::R_GM, RolesTable::R_DGM, RolesTable::R_GM_SEC])) > 0) {
            return true;
        }

        //anyone input a level 1 doc can edit that doc.

        if (($user->id == $docInternal->inputer_id || $user->id == $docInternal->modifier_id)) {
            return true;
        }

        if ( ( $this->DocIncomings->Inputters->inDepartments($user->id, $docInternal)) ){
            //Normal Doc, recipient dept staff can read
            if (($docInternal->doc_sec_level_id == 1)) {
                return true;
            } else if (($docInternal->doc_sec_level_id == 2) && count(array_intersect([RolesTable::R_LM, RolesTable::R_DLM], $user->roleIDs)) > 0) { //user is LM or DLM
                return true;
            }
            
        }
        
        return false;
    }

    public function canView($user, $docInternal)
    {
        //GM, DGM, GM Sec can view any doc
        if (count(array_intersect($user->roleIDs, [2,3,10])) > 0 ) {
            return true;
        }

        //anyone input a level 1 doc can access that doc.

        if (($user->id == $docInternal->inputer_id) || ($user->id == $docInternal->modifier_id) || ($user->id == $docInternal->originator_id)) {
            return true;
        }

        if ( ( $this->DocIncomings->Inputters->inDepartments($user->id, $docInternal)) ){
            //Normal Doc, recipient dept staff can read
            if (($docInternal->doc_sec_level_id == 1)) {
                return true;
            } else if (($docInternal->doc_sec_level_id == 2) && count(array_intersect([RolesTable::R_LM, RolesTable::R_DLM], $user->roleIDs)) > 0) { //user is LM or DLM
                return true;
            }
            
        }
        
        return false;
    }

    public function deleteFile($id = null)
    {
        //$this->request->allowMethod(['post', 'delete']);

        $docInternal = $this->DocInternals->get($id);


        $docInternal->doc_file = null;

        $this->DocInternals->save($docInternal);

        return $this->redirect($this->referer());
    }

    private function getSearchCriteria($posted){
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

        if (isset($posted['date_from']) && ($posted['date_from'] != '')) {
            //$docOutgoings->where(['OR' => ['reg_date >=' => $posted['date_from'], 'issued_date >=' => $posted['date_from']]]);
            $criteria['date_to'] = $posted['date_to'];
        }

        if (isset($posted['search_text']) && ($posted['search_text'] != '')) {
            //$docOutgoings->where(['OR' => ['reg_date >=' => $posted['date_from'], 'issued_date >=' => $posted['date_from']]]);
            $criteria['search_text'] = $posted['search_text'];
        }

        if (isset($posted['dept_id']) && ($posted['dept_id'] != '')) {
            //$docOutgoings->where(['OR' => ['reg_date >=' => $posted['date_from'], 'issued_date >=' => $posted['date_from']]]);
            $criteria['dept_id'] = $posted['dept_id'];
        }
        
        return $criteria;
    }

    private function getColumns($posted){
        
        if (!isset($posted['columns'])){
            $columns['reg_text'] = 1;
            $columns['reg_date'] = 0;
            $columns['issued_date'] = 1;
            $columns['doc_type'] = 1;
            $columns['doc_status'] = 1;
            $columns['department'] = 0;
            $columns['doc_sec_level'] = 0;
            $columns['subject'] = 1;
        } else {
            $columns = $posted['columns'];
        }       

        return $columns;
    }
}
