<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * RolesUsers Controller
 *
 * @property \App\Model\Table\RolesUsersTable $RolesUsers
 * @method \App\Model\Entity\RolesUser[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RolesUsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Roles'],
        ];
        $rolesUsers = $this->paginate($this->RolesUsers);

        $this->set(compact('rolesUsers'));
    }

    /**
     * View method
     *
     * @param string|null $id Roles User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $rolesUser = $this->RolesUsers->get($id, [
            'contain' => ['Users', 'Roles'],
        ]);

        $this->set(compact('rolesUser'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $rolesUser = $this->RolesUsers->newEmptyEntity();
        if ($this->request->is('post')) {
            $rolesUser = $this->RolesUsers->patchEntity($rolesUser, $this->request->getData());
            if ($this->RolesUsers->save($rolesUser)) {
                $this->Flash->success(__('The roles user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The roles user could not be saved. Please, try again.'));
        }
        $users = $this->RolesUsers->Users->find('list', ['conditions' => ['is_deleted' => false], 'order' => ['firstname' => 'ASC', 'lastname' => 'ASC']]);
        $roles = $this->RolesUsers->Roles->find('list', ['order' => ['name' => 'ASC']]);
        $this->set(compact('rolesUser', 'users', 'roles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Roles User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $rolesUser = $this->RolesUsers->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rolesUser = $this->RolesUsers->patchEntity($rolesUser, $this->request->getData());
            if ($this->RolesUsers->save($rolesUser)) {
                $this->Flash->success(__('The roles user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The roles user could not be saved. Please, try again.'));
        }
        $users = $this->RolesUsers->Users->find('list', ['conditions' => ['is_deleted' => false], 'order' => ['firstname' => 'ASC', 'lastname' => 'ASC']]);
        $roles = $this->RolesUsers->Roles->find('list');
        $this->set(compact('rolesUser', 'users', 'roles'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Roles User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $rolesUser = $this->RolesUsers->get($id);
        if ($this->RolesUsers->delete($rolesUser)) {
            $this->Flash->success(__('The roles user has been deleted.'));
        } else {
            $this->Flash->error(__('The roles user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
