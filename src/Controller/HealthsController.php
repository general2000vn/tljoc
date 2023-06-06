<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Healths Controller
 *
 * @property \App\Model\Table\HealthsTable $Healths
 * @method \App\Model\Entity\Health[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class HealthsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $healths = $this->paginate($this->Healths);

        $this->set(compact('healths'));
    }

    /**
     * View method
     *
     * @param string|null $id Health id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $health = $this->Healths->get($id, [
            'contain' => ['Timesheets', 'Users'],
        ]);

        $this->set(compact('health'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $health = $this->Healths->newEmptyEntity();
        if ($this->request->is('post')) {
            $health = $this->Healths->patchEntity($health, $this->request->getData());
            if ($this->Healths->save($health)) {
                $this->Flash->success(__('The health has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The health could not be saved. Please, try again.'));
        }
        $this->set(compact('health'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Health id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $health = $this->Healths->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $health = $this->Healths->patchEntity($health, $this->request->getData());
            if ($this->Healths->save($health)) {
                $this->Flash->success(__('The health has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The health could not be saved. Please, try again.'));
        }
        $this->set(compact('health'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Health id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $health = $this->Healths->get($id);
        if ($this->Healths->delete($health)) {
            $this->Flash->success(__('The health has been deleted.'));
        } else {
            $this->Flash->error(__('The health could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
