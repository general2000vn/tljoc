<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Departments Controller
 *
 * @property \App\Model\Table\DepartmentsTable $Departments
 * @method \App\Model\Entity\Department[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DepartmentsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        //$this->viewBuilder()->setLayout('sash');

        $this->set('menuElement', "sash/left-menu-admin");
    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        
        $departments = $this->Departments->find()->where(['Departments.is_deleted' => false])
                                                    ->contain(['ParentDepartments',
                                                                'Managers' => ['fields' => ['id', 'firstname', 'lastname']],
                                                                'Deputies' => ['fields' => ['id', 'firstname', 'lastname']],
                                                                'Secs' => ['fields' => ['id', 'firstname', 'lastname']],
       ]);

        $this->set(compact('departments'));
    }

    /**
     * View method
     *
     * @param string|null $id Department id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $department = $this->Departments->get($id, [
            'contain' => ['Users' => ['fields' => ['id','firstname', 'lastname', 'department_id']], ],
        ]);

        $this->set(compact('department'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $department = $this->Departments->newEmptyEntity();
        if ($this->request->is('post')) {
            $department = $this->Departments->patchEntity($department, $this->request->getData());
            if ($this->Departments->save($department)) {
                $this->Flash->success(__('The department has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The department could not be saved. Please, try again.'));
        }
        $users = $this->Departments->Users->find('list', [
            'conditions' => ['is_deleted' => false], 'order' => ['firstname' => 'ASC', 'lastname' => 'ASC']
        ]);

        $parentDepartments = $this->Departments->ParentDepartments->find('list', ['limit' => 200]);
        $this->set(compact('department', 'parentDepartments', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Department id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $department = $this->Departments->get($id, [
            'contain' => ['Deputies'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $department = $this->Departments->patchEntity($department, $this->request->getData());
            if ($this->Departments->save($department)) {
                $this->Flash->success(__('The department has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The department could not be saved. Please, try again.'));
        }
        $users = $this->Departments->Users->find('list', [
            'conditions' => ['is_deleted' => false], 'order' => ['firstname' => 'ASC', 'lastname' => 'ASC']
        ]);
        $parentDepartments = $this->Departments->ParentDepartments->find('list', ['limit' => 200]);
        $this->set(compact('department', 'parentDepartments', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Department id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post']);
        $department = $this->Departments->get($id);
        $department->is_deleted = true;
        if ($this->Departments->save($department)) {
            $this->Flash->success(__('The department has been deleted.'));
        } else {
            $this->Flash->error(__('The department could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
