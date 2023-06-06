<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * OrStatuses Controller
 *
 * @property \App\Model\Table\OrStatusesTable $OrStatuses
 * @method \App\Model\Entity\OrStatus[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OrStatusesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $orStatuses = $this->paginate($this->OrStatuses);

        $this->set(compact('orStatuses'));
    }

    /**
     * View method
     *
     * @param string|null $id Or Status id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $orStatus = $this->OrStatuses->get($id, [
            'contain' => ['OrderReqs'],
        ]);

        $this->set(compact('orStatus'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $orStatus = $this->OrStatuses->newEmptyEntity();
        if ($this->request->is('post')) {
            $orStatus = $this->OrStatuses->patchEntity($orStatus, $this->request->getData());
            if ($this->OrStatuses->save($orStatus)) {
                $this->Flash->success(__('The or status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The or status could not be saved. Please, try again.'));
        }
        $this->set(compact('orStatus'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Or Status id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $orStatus = $this->OrStatuses->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $orStatus = $this->OrStatuses->patchEntity($orStatus, $this->request->getData());
            if ($this->OrStatuses->save($orStatus)) {
                $this->Flash->success(__('The or status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The or status could not be saved. Please, try again.'));
        }
        $this->set(compact('orStatus'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Or Status id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $orStatus = $this->OrStatuses->get($id);
        if ($this->OrStatuses->delete($orStatus)) {
            $this->Flash->success(__('The or status has been deleted.'));
        } else {
            $this->Flash->error(__('The or status could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
