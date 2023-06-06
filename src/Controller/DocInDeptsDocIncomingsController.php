<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * DocInDeptsDocIncomings Controller
 *
 * @property \App\Model\Table\DocInDeptsDocIncomingsTable $DocInDeptsDocIncomings
 * @method \App\Model\Entity\DocInDeptsDocIncoming[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DocInDeptsDocIncomingsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Departments', 'DocIncomings'],
        ];
        $docInDeptsDocIncomings = $this->paginate($this->DocInDeptsDocIncomings);

        $this->set(compact('docInDeptsDocIncomings'));
    }

    /**
     * View method
     *
     * @param string|null $id Doc In Depts Doc Incoming id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $docInDeptsDocIncoming = $this->DocInDeptsDocIncomings->get($id, [
            'contain' => ['Departments', 'DocIncomings'],
        ]);

        $this->set(compact('docInDeptsDocIncoming'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $docInDeptsDocIncoming = $this->DocInDeptsDocIncomings->newEmptyEntity();
        if ($this->request->is('post')) {
            $docInDeptsDocIncoming = $this->DocInDeptsDocIncomings->patchEntity($docInDeptsDocIncoming, $this->request->getData());
            if ($this->DocInDeptsDocIncomings->save($docInDeptsDocIncoming)) {
                $this->Flash->success(__('The doc in depts doc incoming has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The doc in depts doc incoming could not be saved. Please, try again.'));
        }
        $departments = $this->DocInDeptsDocIncomings->Departments->find('list', ['limit' => 200]);
        $docIncomings = $this->DocInDeptsDocIncomings->DocIncomings->find('list', ['limit' => 200]);
        $this->set(compact('docInDeptsDocIncoming', 'departments', 'docIncomings'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Doc In Depts Doc Incoming id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $docInDeptsDocIncoming = $this->DocInDeptsDocIncomings->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $docInDeptsDocIncoming = $this->DocInDeptsDocIncomings->patchEntity($docInDeptsDocIncoming, $this->request->getData());
            if ($this->DocInDeptsDocIncomings->save($docInDeptsDocIncoming)) {
                $this->Flash->success(__('The doc in depts doc incoming has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The doc in depts doc incoming could not be saved. Please, try again.'));
        }
        $departments = $this->DocInDeptsDocIncomings->Departments->find('list', ['limit' => 200]);
        $docIncomings = $this->DocInDeptsDocIncomings->DocIncomings->find('list', ['limit' => 200]);
        $this->set(compact('docInDeptsDocIncoming', 'departments', 'docIncomings'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Doc In Depts Doc Incoming id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $docInDeptsDocIncoming = $this->DocInDeptsDocIncomings->get($id);
        if ($this->DocInDeptsDocIncomings->delete($docInDeptsDocIncoming)) {
            $this->Flash->success(__('The doc in depts doc incoming has been deleted.'));
        } else {
            $this->Flash->error(__('The doc in depts doc incoming could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
