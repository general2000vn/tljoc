<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * DeliAddresses Controller
 *
 * @property \App\Model\Table\DeliAddressesTable $DeliAddresses
 * @method \App\Model\Entity\DeliAddress[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DeliAddressesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $deliAddresses = $this->paginate($this->DeliAddresses);

        $this->set(compact('deliAddresses'));
    }

    /**
     * View method
     *
     * @param string|null $id Deli Address id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $deliAddress = $this->DeliAddresses->get($id, [
            'contain' => ['OrderReqs'],
        ]);

        $this->set(compact('deliAddress'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $deliAddress = $this->DeliAddresses->newEmptyEntity();
        if ($this->request->is('post')) {
            $deliAddress = $this->DeliAddresses->patchEntity($deliAddress, $this->request->getData());
            if ($this->DeliAddresses->save($deliAddress)) {
                $this->Flash->success(__('The deli address has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The deli address could not be saved. Please, try again.'));
        }
        $this->set(compact('deliAddress'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Deli Address id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $deliAddress = $this->DeliAddresses->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $deliAddress = $this->DeliAddresses->patchEntity($deliAddress, $this->request->getData());
            if ($this->DeliAddresses->save($deliAddress)) {
                $this->Flash->success(__('The deli address has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The deli address could not be saved. Please, try again.'));
        }
        $this->set(compact('deliAddress'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Deli Address id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $deliAddress = $this->DeliAddresses->get($id);
        if ($this->DeliAddresses->delete($deliAddress)) {
            $this->Flash->success(__('The deli address has been deleted.'));
        } else {
            $this->Flash->error(__('The deli address could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
