<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * HrPStatuses Controller
 *
 * @property \App\Model\Table\HrPStatusesTable $HrPStatuses
 * @method \App\Model\Entity\HrPStatus[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class HrPStatusesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $hrPStatuses = $this->paginate($this->HrPStatuses);

        $this->set(compact('hrPStatuses'));
    }

    /**
     * View method
     *
     * @param string|null $id Hr P Status id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $hrPStatus = $this->HrPStatuses->get($id, [
            'contain' => ['HrPts'],
        ]);

        $this->set(compact('hrPStatus'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $hrPStatus = $this->HrPStatuses->newEmptyEntity();
        if ($this->request->is('post')) {
            $hrPStatus = $this->HrPStatuses->patchEntity($hrPStatus, $this->request->getData());
            if ($this->HrPStatuses->save($hrPStatus)) {
                $this->Flash->success(__('The hr p status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The hr p status could not be saved. Please, try again.'));
        }
        $this->set(compact('hrPStatus'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Hr P Status id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $hrPStatus = $this->HrPStatuses->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $hrPStatus = $this->HrPStatuses->patchEntity($hrPStatus, $this->request->getData());
            if ($this->HrPStatuses->save($hrPStatus)) {
                $this->Flash->success(__('The hr p status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The hr p status could not be saved. Please, try again.'));
        }
        $this->set(compact('hrPStatus'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Hr P Status id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $hrPStatus = $this->HrPStatuses->get($id);
        if ($this->HrPStatuses->delete($hrPStatus)) {
            $this->Flash->success(__('The hr p status has been deleted.'));
        } else {
            $this->Flash->error(__('The hr p status could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
