<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * OrderReqsPartners Controller
 *
 * @property \App\Model\Table\OrderReqsPartnersTable $OrderReqsPartners
 * @method \App\Model\Entity\OrderReqsPartner[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OrderReqsPartnersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['OrderReqs', 'Partners'],
        ];
        $orderReqsPartners = $this->paginate($this->OrderReqsPartners);

        $this->set(compact('orderReqsPartners'));
    }

    /**
     * View method
     *
     * @param string|null $id Order Reqs Partner id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $orderReqsPartner = $this->OrderReqsPartners->get($id, [
            'contain' => ['OrderReqs', 'Partners'],
        ]);

        $this->set(compact('orderReqsPartner'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $orderReqsPartner = $this->OrderReqsPartners->newEmptyEntity();
        if ($this->request->is('post')) {
            $orderReqsPartner = $this->OrderReqsPartners->patchEntity($orderReqsPartner, $this->request->getData());
            if ($this->OrderReqsPartners->save($orderReqsPartner)) {
                $this->Flash->success(__('The order reqs partner has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order reqs partner could not be saved. Please, try again.'));
        }
        $orderReqs = $this->OrderReqsPartners->OrderReqs->find('list', ['limit' => 200]);
        $partners = $this->OrderReqsPartners->Partners->find('list', ['limit' => 200]);
        $this->set(compact('orderReqsPartner', 'orderReqs', 'partners'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Order Reqs Partner id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $orderReqsPartner = $this->OrderReqsPartners->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $orderReqsPartner = $this->OrderReqsPartners->patchEntity($orderReqsPartner, $this->request->getData());
            if ($this->OrderReqsPartners->save($orderReqsPartner)) {
                $this->Flash->success(__('The order reqs partner has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order reqs partner could not be saved. Please, try again.'));
        }
        $orderReqs = $this->OrderReqsPartners->OrderReqs->find('list', ['limit' => 200]);
        $partners = $this->OrderReqsPartners->Partners->find('list', ['limit' => 200]);
        $this->set(compact('orderReqsPartner', 'orderReqs', 'partners'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Order Reqs Partner id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $orderReqsPartner = $this->OrderReqsPartners->get($id);
        if ($this->OrderReqsPartners->delete($orderReqsPartner)) {
            $this->Flash->success(__('The order reqs partner has been deleted.'));
        } else {
            $this->Flash->error(__('The order reqs partner could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
