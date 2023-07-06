<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * DepartmentsUsers Controller
 *
 * @property \App\Model\Table\DepartmentsUsersTable $DepartmentsUsers
 * @method \App\Model\Entity\DepartmentsUser[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DepartmentsUsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Departments'],
        ];
        $departmentsUsers = $this->paginate($this->DepartmentsUsers);

        $this->set(compact('departmentsUsers'));
    }

    /**
     * View method
     *
     * @param string|null $id Departments User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $departmentsUser = $this->DepartmentsUsers->get($id, [
            'contain' => ['Users', 'Departments'],
        ]);

        $this->set(compact('departmentsUser'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $departmentsUser = $this->DepartmentsUsers->newEmptyEntity();
        if ($this->request->is('post')) {
            $departmentsUser = $this->DepartmentsUsers->patchEntity($departmentsUser, $this->request->getData());
            if ($this->DepartmentsUsers->save($departmentsUser)) {
                $this->Flash->success(__('The departments user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The departments user could not be saved. Please, try again.'));
        }
        $users = $this->DepartmentsUsers->Users->find('list', ['limit' => 200]);
        $departments = $this->DepartmentsUsers->Departments->find('list', ['limit' => 200]);
        $this->set(compact('departmentsUser', 'users', 'departments'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Departments User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $departmentsUser = $this->DepartmentsUsers->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $departmentsUser = $this->DepartmentsUsers->patchEntity($departmentsUser, $this->request->getData());
            if ($this->DepartmentsUsers->save($departmentsUser)) {
                $this->Flash->success(__('The departments user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The departments user could not be saved. Please, try again.'));
        }
        $users = $this->DepartmentsUsers->Users->find('list', ['limit' => 200]);
        $departments = $this->DepartmentsUsers->Departments->find('list', ['limit' => 200]);
        $this->set(compact('departmentsUser', 'users', 'departments'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Departments User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $departmentsUser = $this->DepartmentsUsers->get($id);
        if ($this->DepartmentsUsers->delete($departmentsUser)) {
            $this->Flash->success(__('The departments user has been deleted.'));
        } else {
            $this->Flash->error(__('The departments user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
