<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * DocOutgoingsPartners Controller
 *
 * @property \App\Model\Table\DocOutgoingsPartnersTable $DocOutgoingsPartners
 * @method \App\Model\Entity\DocOutgoingsPartner[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DocOutgoingsPartnersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['DocOutgoings', 'Partners'],
        ];
        $docOutgoingsPartners = $this->paginate($this->DocOutgoingsPartners);

        $this->set(compact('docOutgoingsPartners'));
    }

    /**
     * View method
     *
     * @param string|null $id Doc Outgoings Partner id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $docOutgoingsPartner = $this->DocOutgoingsPartners->get($id, [
            'contain' => ['DocOutgoings', 'Partners'],
        ]);

        $this->set(compact('docOutgoingsPartner'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $docOutgoingsPartner = $this->DocOutgoingsPartners->newEmptyEntity();
        if ($this->request->is('post')) {
            $docOutgoingsPartner = $this->DocOutgoingsPartners->patchEntity($docOutgoingsPartner, $this->request->getData());
            if ($this->DocOutgoingsPartners->save($docOutgoingsPartner)) {
                $this->Flash->success(__('The doc outgoings partner has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The doc outgoings partner could not be saved. Please, try again.'));
        }
        $docOutgoings = $this->DocOutgoingsPartners->DocOutgoings->find('list', ['limit' => 200]);
        $partners = $this->DocOutgoingsPartners->Partners->find('list', ['limit' => 200]);
        $this->set(compact('docOutgoingsPartner', 'docOutgoings', 'partners'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Doc Outgoings Partner id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $docOutgoingsPartner = $this->DocOutgoingsPartners->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $docOutgoingsPartner = $this->DocOutgoingsPartners->patchEntity($docOutgoingsPartner, $this->request->getData());
            if ($this->DocOutgoingsPartners->save($docOutgoingsPartner)) {
                $this->Flash->success(__('The doc outgoings partner has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The doc outgoings partner could not be saved. Please, try again.'));
        }
        $docOutgoings = $this->DocOutgoingsPartners->DocOutgoings->find('list', ['limit' => 200]);
        $partners = $this->DocOutgoingsPartners->Partners->find('list', ['limit' => 200]);
        $this->set(compact('docOutgoingsPartner', 'docOutgoings', 'partners'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Doc Outgoings Partner id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $docOutgoingsPartner = $this->DocOutgoingsPartners->get($id);
        if ($this->DocOutgoingsPartners->delete($docOutgoingsPartner)) {
            $this->Flash->success(__('The doc outgoings partner has been deleted.'));
        } else {
            $this->Flash->error(__('The doc outgoings partner could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
