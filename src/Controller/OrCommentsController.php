<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * OrComments Controller
 *
 * @property \App\Model\Table\OrCommentsTable $OrComments
 * @method \App\Model\Entity\OrComment[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OrCommentsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'OrderReqs'],
        ];
        $orComments = $this->paginate($this->OrComments);

        $this->set(compact('orComments'));
    }

    /**
     * View method
     *
     * @param string|null $id Or Comment id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $orComment = $this->OrComments->get($id, [
            'contain' => ['Users', 'OrderReqs'],
        ]);

        $this->set(compact('orComment'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $orComment = $this->OrComments->newEmptyEntity();
        if ($this->request->is('post')) {
            $orComment = $this->OrComments->patchEntity($orComment, $this->request->getData());
            if ($this->OrComments->save($orComment)) {
                $this->Flash->success(__('The or comment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The or comment could not be saved. Please, try again.'));
        }
        $users = $this->OrComments->Users->find('list', ['limit' => 200]);
        $orderReqs = $this->OrComments->OrderReqs->find('list', ['limit' => 200]);
        $this->set(compact('orComment', 'users', 'orderReqs'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Or Comment id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $orComment = $this->OrComments->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $orComment = $this->OrComments->patchEntity($orComment, $this->request->getData());
            if ($this->OrComments->save($orComment)) {
                $this->Flash->success(__('The or comment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The or comment could not be saved. Please, try again.'));
        }
        $users = $this->OrComments->Users->find('list', ['limit' => 200]);
        $orderReqs = $this->OrComments->OrderReqs->find('list', ['limit' => 200]);
        $this->set(compact('orComment', 'users', 'orderReqs'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Or Comment id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $orComment = $this->OrComments->get($id);
        if ($this->OrComments->delete($orComment)) {
            $this->Flash->success(__('The or comment has been deleted.'));
        } else {
            $this->Flash->error(__('The or comment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
