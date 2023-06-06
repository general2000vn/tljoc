<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * OrItems Controller
 *
 * @property \App\Model\Table\OrItemsTable $OrItems
 * @method \App\Model\Entity\OrItem[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OrItemsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $orItems = $this->paginate($this->OrItems);

        $this->set(compact('orItems'));
    }

    /**
     * View method
     *
     * @param string|null $id Or Item id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $orItem = $this->OrItems->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('orItem'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $orItem = $this->OrItems->newEmptyEntity();
        if ($this->request->is('post')) {
            $orItem = $this->OrItems->patchEntity($orItem, $this->request->getData());
            if ($this->OrItems->save($orItem)) {
                $this->Flash->success(__('The or item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The or item could not be saved. Please, try again.'));
        }
        $this->set(compact('orItem'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Or Item id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $orItem = $this->OrItems->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $orItem = $this->OrItems->patchEntity($orItem, $this->request->getData());
            if ($this->OrItems->save($orItem)) {
                $this->Flash->success(__('The or item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The or item could not be saved. Please, try again.'));
        }
        $this->set(compact('orItem'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Or Item id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $orItem = $this->OrItems->get($id);
        if ($this->OrItems->delete($orItem)) {
            $this->Flash->success(__('The or item has been deleted.'));
        } else {
            $this->Flash->error(__('The or item could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
