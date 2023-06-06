<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * TestBs Controller
 *
 * @property \App\Model\Table\TestBsTable $TestBs
 * @method \App\Model\Entity\TestB[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TestBsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $testBs = $this->paginate($this->TestBs);

        $this->set(compact('testBs'));
    }

    /**
     * View method
     *
     * @param string|null $id Test B id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $testB = $this->TestBs->get($id, [
            'contain' => ['TestAs'],
        ]);

        $this->set(compact('testB'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $testB = $this->TestBs->newEmptyEntity();
        if ($this->request->is('post')) {
            $testB = $this->TestBs->patchEntity($testB, $this->request->getData());
            if ($this->TestBs->save($testB)) {
                $this->Flash->success(__('The test b has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The test b could not be saved. Please, try again.'));
        }
        $testAs = $this->TestBs->TestAs->find('list', ['limit' => 200]);
        $this->set(compact('testB', 'testAs'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Test B id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $testB = $this->TestBs->get($id, [
            'contain' => ['TestAs'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $testB = $this->TestBs->patchEntity($testB, $this->request->getData());
            if ($this->TestBs->save($testB)) {
                $this->Flash->success(__('The test b has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The test b could not be saved. Please, try again.'));
        }
        $testAs = $this->TestBs->TestAs->find('list', ['limit' => 200]);
        $this->set(compact('testB', 'testAs'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Test B id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $testB = $this->TestBs->get($id);
        if ($this->TestBs->delete($testB)) {
            $this->Flash->success(__('The test b has been deleted.'));
        } else {
            $this->Flash->error(__('The test b could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
