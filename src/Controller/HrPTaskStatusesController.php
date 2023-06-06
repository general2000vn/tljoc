<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * HrPTaskStatuses Controller
 *
 * @property \App\Model\Table\HrPTaskStatusesTable $HrPTaskStatuses
 * @method \App\Model\Entity\HrPTaskStatus[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class HrPTaskStatusesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $hrPTaskStatuses = $this->paginate($this->HrPTaskStatuses);

        $this->set(compact('hrPTaskStatuses'));
    }

    /**
     * View method
     *
     * @param string|null $id Hr P Task Status id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $hrPTaskStatus = $this->HrPTaskStatuses->get($id, [
            'contain' => ['HrPtTasks'],
        ]);

        $this->set(compact('hrPTaskStatus'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $hrPTaskStatus = $this->HrPTaskStatuses->newEmptyEntity();
        if ($this->request->is('post')) {
            $hrPTaskStatus = $this->HrPTaskStatuses->patchEntity($hrPTaskStatus, $this->request->getData());
            if ($this->HrPTaskStatuses->save($hrPTaskStatus)) {
                $this->Flash->success(__('The hr p task status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The hr p task status could not be saved. Please, try again.'));
        }
        $this->set(compact('hrPTaskStatus'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Hr P Task Status id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $hrPTaskStatus = $this->HrPTaskStatuses->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $hrPTaskStatus = $this->HrPTaskStatuses->patchEntity($hrPTaskStatus, $this->request->getData());
            if ($this->HrPTaskStatuses->save($hrPTaskStatus)) {
                $this->Flash->success(__('The hr p task status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The hr p task status could not be saved. Please, try again.'));
        }
        $this->set(compact('hrPTaskStatus'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Hr P Task Status id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $hrPTaskStatus = $this->HrPTaskStatuses->get($id);
        if ($this->HrPTaskStatuses->delete($hrPTaskStatus)) {
            $this->Flash->success(__('The hr p task status has been deleted.'));
        } else {
            $this->Flash->error(__('The hr p task status could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
