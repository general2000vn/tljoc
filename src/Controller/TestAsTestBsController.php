<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * TestAsTestBs Controller
 *
 * @property \App\Model\Table\TestAsTestBsTable $TestAsTestBs
 * @method \App\Model\Entity\TestAsTestB[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TestAsTestBsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['TestAs', 'TestBs'],
        ];
        $testAsTestBs = $this->paginate($this->TestAsTestBs);

        $this->set(compact('testAsTestBs'));
    }

    /**
     * View method
     *
     * @param string|null $id Test As Test B id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $testAsTestB = $this->TestAsTestBs->get($id, [
            'contain' => ['TestAs', 'TestBs'],
        ]);

        $this->set(compact('testAsTestB'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $testAsTestB = $this->TestAsTestBs->newEmptyEntity();
        if ($this->request->is('post')) {
            $testAsTestB = $this->TestAsTestBs->patchEntity($testAsTestB, $this->request->getData());
            if ($this->TestAsTestBs->save($testAsTestB)) {
                $this->Flash->success(__('The test as test b has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The test as test b could not be saved. Please, try again.'));
        }
        $testAs = $this->TestAsTestBs->TestAs->find('list', ['limit' => 200]);
        $testBs = $this->TestAsTestBs->TestBs->find('list', ['limit' => 200]);
        $this->set(compact('testAsTestB', 'testAs', 'testBs'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Test As Test B id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $testAsTestB = $this->TestAsTestBs->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $testAsTestB = $this->TestAsTestBs->patchEntity($testAsTestB, $this->request->getData());
            if ($this->TestAsTestBs->save($testAsTestB)) {
                $this->Flash->success(__('The test as test b has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The test as test b could not be saved. Please, try again.'));
        }
        $testAs = $this->TestAsTestBs->TestAs->find('list', ['limit' => 200]);
        $testBs = $this->TestAsTestBs->TestBs->find('list', ['limit' => 200]);
        $this->set(compact('testAsTestB', 'testAs', 'testBs'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Test As Test B id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $testAsTestB = $this->TestAsTestBs->get($id);
        if ($this->TestAsTestBs->delete($testAsTestB)) {
            $this->Flash->success(__('The test as test b has been deleted.'));
        } else {
            $this->Flash->error(__('The test as test b could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
