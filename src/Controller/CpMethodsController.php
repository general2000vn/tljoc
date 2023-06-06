<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * CpMethods Controller
 *
 * @property \App\Model\Table\CpMethodsTable $CpMethods
 * @method \App\Model\Entity\CpMethod[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CpMethodsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $cpMethods = $this->paginate($this->CpMethods);

        $this->set(compact('cpMethods'));
    }

    /**
     * View method
     *
     * @param string|null $id Cp Method id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cpMethod = $this->CpMethods->get($id, [
            'contain' => ['OrderReqs'],
        ]);

        $this->set(compact('cpMethod'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cpMethod = $this->CpMethods->newEmptyEntity();
        if ($this->request->is('post')) {
            $cpMethod = $this->CpMethods->patchEntity($cpMethod, $this->request->getData());
            if ($this->CpMethods->save($cpMethod)) {
                $this->Flash->success(__('The cp method has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cp method could not be saved. Please, try again.'));
        }
        $this->set(compact('cpMethod'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Cp Method id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cpMethod = $this->CpMethods->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cpMethod = $this->CpMethods->patchEntity($cpMethod, $this->request->getData());
            if ($this->CpMethods->save($cpMethod)) {
                $this->Flash->success(__('The cp method has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cp method could not be saved. Please, try again.'));
        }
        $this->set(compact('cpMethod'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Cp Method id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cpMethod = $this->CpMethods->get($id);
        if ($this->CpMethods->delete($cpMethod)) {
            $this->Flash->success(__('The cp method has been deleted.'));
        } else {
            $this->Flash->error(__('The cp method could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
