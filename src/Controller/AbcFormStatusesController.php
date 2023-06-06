<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * AbcFormStatuses Controller
 *
 * @property \App\Model\Table\AbcFormStatusesTable $AbcFormStatuses
 * @method \App\Model\Entity\AbcFormStatus[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AbcFormStatusesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $abcFormStatuses = $this->paginate($this->AbcFormStatuses);

        $this->set(compact('abcFormStatuses'));
    }

    /**
     * View method
     *
     * @param string|null $id Abc Form Status id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $abcFormStatus = $this->AbcFormStatuses->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('abcFormStatus'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $abcFormStatus = $this->AbcFormStatuses->newEmptyEntity();
        if ($this->request->is('post')) {
            $abcFormStatus = $this->AbcFormStatuses->patchEntity($abcFormStatus, $this->request->getData());
            if ($this->AbcFormStatuses->save($abcFormStatus)) {
                $this->Flash->success(__('The abc form status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The abc form status could not be saved. Please, try again.'));
        }
        $this->set(compact('abcFormStatus'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Abc Form Status id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $abcFormStatus = $this->AbcFormStatuses->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $abcFormStatus = $this->AbcFormStatuses->patchEntity($abcFormStatus, $this->request->getData());
            if ($this->AbcFormStatuses->save($abcFormStatus)) {
                $this->Flash->success(__('The abc form status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The abc form status could not be saved. Please, try again.'));
        }
        $this->set(compact('abcFormStatus'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Abc Form Status id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $abcFormStatus = $this->AbcFormStatuses->get($id);
        if ($this->AbcFormStatuses->delete($abcFormStatus)) {
            $this->Flash->success(__('The abc form status has been deleted.'));
        } else {
            $this->Flash->error(__('The abc form status could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
