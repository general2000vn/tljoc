<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * UserTitles Controller
 *
 * @property \App\Model\Table\UserTitlesTable $UserTitles
 * @method \App\Model\Entity\UserTitle[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UserTitlesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $userTitles = $this->paginate($this->UserTitles);

        $this->set(compact('userTitles'));
    }

    /**
     * View method
     *
     * @param string|null $id User Title id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userTitle = $this->UserTitles->get($id, [
            'contain' => ['Users'],
        ]);

        $this->set(compact('userTitle'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userTitle = $this->UserTitles->newEmptyEntity();
        if ($this->request->is('post')) {
            $userTitle = $this->UserTitles->patchEntity($userTitle, $this->request->getData());
            if ($this->UserTitles->save($userTitle)) {
                $this->Flash->success(__('The user title has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user title could not be saved. Please, try again.'));
        }
        $this->set(compact('userTitle'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User Title id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userTitle = $this->UserTitles->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userTitle = $this->UserTitles->patchEntity($userTitle, $this->request->getData());
            if ($this->UserTitles->save($userTitle)) {
                $this->Flash->success(__('The user title has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user title could not be saved. Please, try again.'));
        }
        $this->set(compact('userTitle'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User Title id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userTitle = $this->UserTitles->get($id);
        if ($this->UserTitles->delete($userTitle)) {
            $this->Flash->success(__('The user title has been deleted.'));
        } else {
            $this->Flash->error(__('The user title could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
