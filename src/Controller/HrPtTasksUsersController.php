<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * HrPtTasksUsers Controller
 *
 * @property \App\Model\Table\HrPtTasksUsersTable $HrPtTasksUsers
 * @method \App\Model\Entity\HrPtTasksUser[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class HrPtTasksUsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'HrPtTasks'],
        ];
        $hrPtTasksUsers = $this->paginate($this->HrPtTasksUsers);

        $this->set(compact('hrPtTasksUsers'));
    }

    /**
     * View method
     *
     * @param string|null $id Hr Pt Tasks User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $hrPtTasksUser = $this->HrPtTasksUsers->get($id, [
            'contain' => ['Users', 'HrPtTasks'],
        ]);

        $this->set(compact('hrPtTasksUser'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $hrPtTasksUser = $this->HrPtTasksUsers->newEmptyEntity();
        if ($this->request->is('post')) {
            $hrPtTasksUser = $this->HrPtTasksUsers->patchEntity($hrPtTasksUser, $this->request->getData());
            if ($this->HrPtTasksUsers->save($hrPtTasksUser)) {
                $this->Flash->success(__('The hr pt tasks user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The hr pt tasks user could not be saved. Please, try again.'));
        }
        $users = $this->HrPtTasksUsers->Users->find('list', ['limit' => 200]);
        $hrPtTasks = $this->HrPtTasksUsers->HrPtTasks->find('list', ['limit' => 200]);
        $this->set(compact('hrPtTasksUser', 'users', 'hrPtTasks'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Hr Pt Tasks User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $hrPtTasksUser = $this->HrPtTasksUsers->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $hrPtTasksUser = $this->HrPtTasksUsers->patchEntity($hrPtTasksUser, $this->request->getData());
            if ($this->HrPtTasksUsers->save($hrPtTasksUser)) {
                $this->Flash->success(__('The hr pt tasks user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The hr pt tasks user could not be saved. Please, try again.'));
        }
        $users = $this->HrPtTasksUsers->Users->find('list', ['limit' => 200]);
        $hrPtTasks = $this->HrPtTasksUsers->HrPtTasks->find('list', ['limit' => 200]);
        $this->set(compact('hrPtTasksUser', 'users', 'hrPtTasks'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Hr Pt Tasks User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $hrPtTasksUser = $this->HrPtTasksUsers->get($id);
        if ($this->HrPtTasksUsers->delete($hrPtTasksUser)) {
            $this->Flash->success(__('The hr pt tasks user has been deleted.'));
        } else {
            $this->Flash->error(__('The hr pt tasks user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
