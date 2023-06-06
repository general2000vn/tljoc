<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * OrSuppliers Controller
 *
 * @property \App\Model\Table\OrSuppliersTable $OrSuppliers
 * @method \App\Model\Entity\OrSupplier[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OrSuppliersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['OrderReqs'],
        ];
        $orSuppliers = $this->paginate($this->OrSuppliers);

        $this->set(compact('orSuppliers'));
    }

    /**
     * View method
     *
     * @param string|null $id Or Supplier id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $orSupplier = $this->OrSuppliers->get($id, [
            'contain' => ['OrderReqs'],
        ]);

        $this->set(compact('orSupplier'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $orSupplier = $this->OrSuppliers->newEmptyEntity();
        if ($this->request->is('post')) {
            $orSupplier = $this->OrSuppliers->patchEntity($orSupplier, $this->request->getData());
            if ($this->OrSuppliers->save($orSupplier)) {
                $this->Flash->success(__('The or supplier has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The or supplier could not be saved. Please, try again.'));
        }
        $orderReqs = $this->OrSuppliers->OrderReqs->find('list', ['limit' => 200]);
        $this->set(compact('orSupplier', 'orderReqs'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Or Supplier id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $orSupplier = $this->OrSuppliers->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $orSupplier = $this->OrSuppliers->patchEntity($orSupplier, $this->request->getData());
            if ($this->OrSuppliers->save($orSupplier)) {
                $this->Flash->success(__('The or supplier has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The or supplier could not be saved. Please, try again.'));
        }
        $orderReqs = $this->OrSuppliers->OrderReqs->find('list', ['limit' => 200]);
        $this->set(compact('orSupplier', 'orderReqs'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Or Supplier id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $orSupplier = $this->OrSuppliers->get($id);
        if ($this->OrSuppliers->delete($orSupplier)) {
            $this->Flash->success(__('The or supplier has been deleted.'));
        } else {
            $this->Flash->error(__('The or supplier could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
