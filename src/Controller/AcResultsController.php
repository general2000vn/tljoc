<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * AcResults Controller
 *
 * @property \App\Model\Table\AcResultsTable $AcResults
 * @method \App\Model\Entity\AcResult[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AcResultsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $acResults = $this->paginate($this->AcResults);

        $this->set(compact('acResults'));
    }

    /**
     * View method
     *
     * @param string|null $id Ac Result id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $acResult = $this->AcResults->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('acResult'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $acResult = $this->AcResults->newEmptyEntity();
        if ($this->request->is('post')) {
            $acResult = $this->AcResults->patchEntity($acResult, $this->request->getData());
            if ($this->AcResults->save($acResult)) {
                $this->Flash->success(__('The ac result has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ac result could not be saved. Please, try again.'));
        }
        $this->set(compact('acResult'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Ac Result id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $acResult = $this->AcResults->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $acResult = $this->AcResults->patchEntity($acResult, $this->request->getData());
            if ($this->AcResults->save($acResult)) {
                $this->Flash->success(__('The ac result has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ac result could not be saved. Please, try again.'));
        }
        $this->set(compact('acResult'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Ac Result id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $acResult = $this->AcResults->get($id);
        if ($this->AcResults->delete($acResult)) {
            $this->Flash->success(__('The ac result has been deleted.'));
        } else {
            $this->Flash->error(__('The ac result could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
