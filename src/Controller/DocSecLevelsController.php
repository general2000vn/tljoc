<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * DocSecLevels Controller
 *
 * @property \App\Model\Table\DocSecLevelsTable $DocSecLevels
 * @method \App\Model\Entity\DocSecLevel[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DocSecLevelsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $docSecLevels = $this->paginate($this->DocSecLevels);

        $this->set(compact('docSecLevels'));
    }

    /**
     * View method
     *
     * @param string|null $id Doc Sec Level id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $docSecLevel = $this->DocSecLevels->get($id, [
            'contain' => ['DocIncomings'],
        ]);

        $this->set(compact('docSecLevel'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $docSecLevel = $this->DocSecLevels->newEmptyEntity();
        if ($this->request->is('post')) {
            $docSecLevel = $this->DocSecLevels->patchEntity($docSecLevel, $this->request->getData());
            if ($this->DocSecLevels->save($docSecLevel)) {
                $this->Flash->success(__('The doc sec level has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The doc sec level could not be saved. Please, try again.'));
        }
        $this->set(compact('docSecLevel'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Doc Sec Level id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $docSecLevel = $this->DocSecLevels->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $docSecLevel = $this->DocSecLevels->patchEntity($docSecLevel, $this->request->getData());
            if ($this->DocSecLevels->save($docSecLevel)) {
                $this->Flash->success(__('The doc sec level has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The doc sec level could not be saved. Please, try again.'));
        }
        $this->set(compact('docSecLevel'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Doc Sec Level id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $docSecLevel = $this->DocSecLevels->get($id);
        if ($this->DocSecLevels->delete($docSecLevel)) {
            $this->Flash->success(__('The doc sec level has been deleted.'));
        } else {
            $this->Flash->error(__('The doc sec level could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
