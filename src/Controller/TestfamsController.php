<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * TestBs Controller
 *
 * @property \App\Model\Table\TestBsTable $Testfams
 * @method \App\Model\Entity\Testfams[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TestfamsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $testfams = $this->paginate($this->Testfams);

        $this->set(compact('testfams'));
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
        $Testfam = $this->Testfams->get($id, [
           
        ]);

        $this->set(compact('Testfam'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $Testfam = $this->Testfams->newEmptyEntity();
        if ($this->request->is('post')) {
            $Testfam = $this->Testfams->patchEntity($Testfam, $this->request->getData());
            if ($this->TestBs->save($Testfam)) {
                $this->Flash->success(__('The test b has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The test b could not be saved. Please, try again.'));
        }

        $this->set(compact('Testfam'));
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
        $Testfam = $this->Testfams->get($id, [
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $Testfam = $this->Testfams->patchEntity($Testfam, $this->request->getData());
            if ($this->TestBs->save($Testfam)) {
                $this->Flash->success(__('The test b has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The test b could not be saved. Please, try again.'));
        }
        
        $this->set(compact('Testfams'));
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
        $Testfam = $this->Testfams->get($id);
        if ($this->TestBs->delete($Testfam)) {
            $this->Flash->success(__('The test b has been deleted.'));
        } else {
            $this->Flash->error(__('The test b could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
