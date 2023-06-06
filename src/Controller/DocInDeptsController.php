<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * DocInDepts Controller
 *
 * @property \App\Model\Table\DocInDeptsTable $DocInDepts
 * @method \App\Model\Entity\DocInDept[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DocInDeptsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
        ];
        $docInDepts = $this->paginate($this->DocInDepts);

        $this->set(compact('docInDepts'));
    }

    /**
     * View method
     *
     * @param string|null $id Doc In Dept id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $docInDept = $this->DocInDepts->get($id, [
            'contain' => ['Users', 'DocIncomings'],
        ]);

        $this->set(compact('docInDept'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $docInDept = $this->DocInDepts->newEmptyEntity();
        if ($this->request->is('post')) {
            $docInDept = $this->DocInDepts->patchEntity($docInDept, $this->request->getData());
            if ($this->DocInDepts->save($docInDept)) {
                $this->Flash->success(__('The doc in dept has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The doc in dept could not be saved. Please, try again.'));
        }
        $users = $this->DocInDepts->Users->find('list', ['limit' => 200]);
        $docIncomings = $this->DocInDepts->DocIncomings->find('list', ['limit' => 200]);
        $this->set(compact('docInDept', 'users', 'docIncomings'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Doc In Dept id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $docInDept = $this->DocInDepts->get($id, [
            'contain' => ['DocIncomings'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $docInDept = $this->DocInDepts->patchEntity($docInDept, $this->request->getData());
            if ($this->DocInDepts->save($docInDept)) {
                $this->Flash->success(__('The doc in dept has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The doc in dept could not be saved. Please, try again.'));
        }
        $users = $this->DocInDepts->Users->find('list', ['limit' => 200]);
        $docIncomings = $this->DocInDepts->DocIncomings->find('list', ['limit' => 200]);
        $this->set(compact('docInDept', 'users', 'docIncomings'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Doc In Dept id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $docInDept = $this->DocInDepts->get($id);
        if ($this->DocInDepts->delete($docInDept)) {
            $this->Flash->success(__('The doc in dept has been deleted.'));
        } else {
            $this->Flash->error(__('The doc in dept could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
