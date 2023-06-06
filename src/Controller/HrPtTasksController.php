<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * HrPtTasks Controller
 *
 * @property \App\Model\Table\HrPtTasksTable $HrPtTasks
 * @method \App\Model\Entity\HrPtTask[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class HrPtTasksController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['HrPTaskStatuses', 'Modifiers', 'HrPts'],
        ];
        $hrPtTasks = $this->paginate($this->HrPtTasks);

        $this->set(compact('hrPtTasks'));
    }

    // public function process($hrPT_id){
    //     $curUser = $this->Authentication->getIdentity();

    //     $hrPt = $this->HrPtTasks->HrPts->get($hrPT_id);

    //     $tasks = $this->HrPtTasks->find('all', ['conditions' => ['hr_pt_id' => $hrPT_id]])
    //         ->contain(['Users'])
    //         ->matching('Users', function ($q) use ($curUser){
    //             return $q->where(['Users.id' => $curUser->id]);})
    //         ->all();

    //     if ($this->request->is(['patch', 'post', 'put'])) {
    //         $posted = $this->request->getData();
    //         $this->set('posted', $posted);
    //         $tasks = $this->HrPtTasks->patchEntities($tasks, $this->request->getData());
    //         // if ($this->HrPtTasks->save($tasks)) {
    //         //     $this->Flash->success(__('The Tasks has been saved.'));

    //         //     return $this->redirect(['controller' => 'HrPtTasks','action' => 'view', $hrPT_id]);
    //         // }
    //         // $this->Flash->error(__('The Tasks could not be saved. Please, try again.'));
    //     }
    //     $staffs = $this->HrPtTasks->Users->find('list', ['conditions' => ['is_deleted' => false]]);

    //     $taskStatuses = $this->HrPtTasks->HrPTaskStatuses->find('list');
    //     $hrPStatuses = $this->HrPtTasks->HrPts->HrPStatuses->find('list', ['limit' => 200]);
    //     $task_entity = $this->HrPtTasks->newEmptyEntity();
    //     $this->set(compact('hrPt', 'tasks', 'staffs',  'hrPStatuses', 'taskStatuses', 'task_entity'));
    // }

    /**
     * View method
     *
     * @param string|null $id Hr Pt Task id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $hrPtTask = $this->HrPtTasks->get($id, [
            'contain' => ['HrPTaskStatuses', 'Modifiers', 'HrPts', 'Users'],
        ]);

        $this->set(compact('hrPtTask'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $hrPtTask = $this->HrPtTasks->newEmptyEntity();
        if ($this->request->is('post')) {
            $hrPtTask = $this->HrPtTasks->patchEntity($hrPtTask, $this->request->getData());
            if ($this->HrPtTasks->save($hrPtTask)) {
                $this->Flash->success(__('The hr pt task has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The hr pt task could not be saved. Please, try again.'));
        }
        $hrPTaskStatuses = $this->HrPtTasks->HrPTaskStatuses->find('list', ['limit' => 200]);
        $modifiers = $this->HrPtTasks->Modifiers->find('list', ['limit' => 200]);
        $hrPts = $this->HrPtTasks->HrPts->find('list', ['limit' => 200]);
        $users = $this->HrPtTasks->Users->find('list', ['limit' => 200]);
        $this->set(compact('hrPtTask', 'hrPTaskStatuses', 'modifiers', 'hrPts', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Hr Pt Task id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $hrPtTask = $this->HrPtTasks->get($id, [
            'contain' => ['Users'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $hrPtTask = $this->HrPtTasks->patchEntity($hrPtTask, $this->request->getData());
            if ($this->HrPtTasks->save($hrPtTask)) {
                $this->Flash->success(__('The hr pt task has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The hr pt task could not be saved. Please, try again.'));
        }
        $hrPTaskStatuses = $this->HrPtTasks->HrPTaskStatuses->find('list', ['limit' => 200]);
        $modifiers = $this->HrPtTasks->Modifiers->find('list', ['limit' => 200]);
        $hrPts = $this->HrPtTasks->HrPts->find('list', ['limit' => 200]);
        $users = $this->HrPtTasks->Users->find('list', ['limit' => 200]);
        $this->set(compact('hrPtTask', 'hrPTaskStatuses', 'modifiers', 'hrPts', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Hr Pt Task id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $hrPtTask = $this->HrPtTasks->get($id);
        if ($this->HrPtTasks->delete($hrPtTask)) {
            $this->Flash->success(__('The hr pt task has been deleted.'));
        } else {
            $this->Flash->error(__('The hr pt task could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
