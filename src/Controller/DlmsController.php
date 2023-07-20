<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Dlms Controller
 *
 * @property \App\Model\Table\DlmsTable $Dlms
 * @method \App\Model\Entity\Dlm[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DlmsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
        ];
        $dlms = $this->paginate($this->Dlms);

        $this->set(compact('dlms'));
    }

    /**
     * View method
     *
     * @param string|null $id Dlm id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $dlm = $this->Dlms->get($id, [
            'contain' => ['Users', 'Departments'],
        ]);

        $this->set(compact('dlm'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $dlm = $this->Dlms->newEmptyEntity();
        if ($this->request->is('post')) {
            $dlm = $this->Dlms->patchEntity($dlm, $this->request->getData());
            if ($this->Dlms->save($dlm)) {
                $this->Flash->success(__('The dlm has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The dlm could not be saved. Please, try again.'));
        }
        $users = $this->Dlms->Users->find('list', ['limit' => 200]);
        $this->set(compact('dlm', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Dlm id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $dlm = $this->Dlms->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $dlm = $this->Dlms->patchEntity($dlm, $this->request->getData());
            if ($this->Dlms->save($dlm)) {
                $this->Flash->success(__('The dlm has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The dlm could not be saved. Please, try again.'));
        }
        $users = $this->Dlms->Users->find('list', ['limit' => 200]);
        $this->set(compact('dlm', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Dlm id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $dlm = $this->Dlms->get($id);
        if ($this->Dlms->delete($dlm)) {
            $this->Flash->success(__('The dlm has been deleted.'));
        } else {
            $this->Flash->error(__('The dlm could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
