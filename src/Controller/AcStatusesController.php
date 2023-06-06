<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * AcStatuses Controller
 *
 * @property \App\Model\Table\AcStatusesTable $AcStatuses
 * @method \App\Model\Entity\AcStatus[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AcStatusesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $acStatuses = $this->paginate($this->AcStatuses);

        $this->set(compact('acStatuses'));
    }

    /**
     * View method
     *
     * @param string|null $id Ac Status id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $acStatus = $this->AcStatuses->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('acStatus'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $acStatus = $this->AcStatuses->newEmptyEntity();
        if ($this->request->is('post')) {
            $acStatus = $this->AcStatuses->patchEntity($acStatus, $this->request->getData());
            if ($this->AcStatuses->save($acStatus)) {
                $this->Flash->success(__('The ac status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ac status could not be saved. Please, try again.'));
        }
        $this->set(compact('acStatus'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Ac Status id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $acStatus = $this->AcStatuses->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $acStatus = $this->AcStatuses->patchEntity($acStatus, $this->request->getData());
            if ($this->AcStatuses->save($acStatus)) {
                $this->Flash->success(__('The ac status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ac status could not be saved. Please, try again.'));
        }
        $this->set(compact('acStatus'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Ac Status id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $acStatus = $this->AcStatuses->get($id);
        if ($this->AcStatuses->delete($acStatus)) {
            $this->Flash->success(__('The ac status has been deleted.'));
        } else {
            $this->Flash->error(__('The ac status could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
