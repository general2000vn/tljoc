<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * TestAs Controller
 *
 * @property \App\Model\Table\TestAsTable $TestAs
 * @method \App\Model\Entity\TestA[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TestAsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $testAs = $this->paginate($this->TestAs);

        $this->set(compact('testAs'));
    }

    /**
     * View method
     *
     * @param string|null $id Test A id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $testA = $this->TestAs->get($id, [
            'contain' => ['TestBs'],
        ]);

        $this->set(compact('testA'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $testA = $this->TestAs->newEmptyEntity();
        if ($this->request->is('post')) {
            $testA = $this->TestAs->patchEntity($testA, $this->request->getData());
            if ($this->TestAs->save($testA)) {
                $this->Flash->success(__('The test a has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The test a could not be saved. Please, try again.'));
        }
        $testBs = $this->TestAs->TestBs->find('list', ['limit' => 200]);
        $this->set(compact('testA', 'testBs'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Test A id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $testA = $this->TestAs->get($id, [
            'contain' => ['TestBs'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $testA = $this->TestAs->patchEntity($testA, $this->request->getData());
            if ($this->TestAs->save($testA)) {
                $this->Flash->success(__('The test a has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The test a could not be saved. Please, try again.'));
        }
        $testBs = $this->TestAs->TestBs->find('list', ['limit' => 200]);
        $this->set(compact('testA', 'testBs'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Test A id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $testA = $this->TestAs->get($id);
        if ($this->TestAs->delete($testA)) {
            $this->Flash->success(__('The test a has been deleted.'));
        } else {
            $this->Flash->error(__('The test a could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
