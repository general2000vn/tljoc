<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * DocStatuses Controller
 *
 * @property \App\Model\Table\DocStatusesTable $DocStatuses
 * @method \App\Model\Entity\DocStatus[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DocStatusesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $docStatuses = $this->paginate($this->DocStatuses);

        $this->set(compact('docStatuses'));
    }

    /**
     * View method
     *
     * @param string|null $id Doc Status id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $docStatus = $this->DocStatuses->get($id, [
            'contain' => ['DocIncomings'],
        ]);

        $this->set(compact('docStatus'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $docStatus = $this->DocStatuses->newEmptyEntity();
        if ($this->request->is('post')) {
            $docStatus = $this->DocStatuses->patchEntity($docStatus, $this->request->getData());
            if ($this->DocStatuses->save($docStatus)) {
                $this->Flash->success(__('The doc status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The doc status could not be saved. Please, try again.'));
        }
        $this->set(compact('docStatus'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Doc Status id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $docStatus = $this->DocStatuses->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $docStatus = $this->DocStatuses->patchEntity($docStatus, $this->request->getData());
            if ($this->DocStatuses->save($docStatus)) {
                $this->Flash->success(__('The doc status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The doc status could not be saved. Please, try again.'));
        }
        $this->set(compact('docStatus'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Doc Status id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $docStatus = $this->DocStatuses->get($id);
        if ($this->DocStatuses->delete($docStatus)) {
            $this->Flash->success(__('The doc status has been deleted.'));
        } else {
            $this->Flash->error(__('The doc status could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
