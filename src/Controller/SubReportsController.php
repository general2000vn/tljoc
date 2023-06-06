<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * SubReports Controller
 *
 * @property \App\Model\Table\SubReportsTable $SubReports
 * @method \App\Model\Entity\SubReport[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SubReportsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $subReports = $this->paginate($this->SubReports);

        $this->set(compact('subReports'));
    }

    /**
     * View method
     *
     * @param string|null $id Sub Report id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->viewBuilder()->setLayout('sash');
        // $subReport = $this->SubReports->get($id, [
        //     'contain' => [],
        // ]);

        // $this->set(compact('subReport'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $subReport = $this->SubReports->newEmptyEntity();
        if ($this->request->is('post')) {
            $subReport = $this->SubReports->patchEntity($subReport, $this->request->getData());
            if ($this->SubReports->save($subReport)) {
                $this->Flash->success(__('The sub report has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sub report could not be saved. Please, try again.'));
        }
        $this->set(compact('subReport'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Sub Report id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $subReport = $this->SubReports->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $subReport = $this->SubReports->patchEntity($subReport, $this->request->getData());
            if ($this->SubReports->save($subReport)) {
                $this->Flash->success(__('The sub report has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sub report could not be saved. Please, try again.'));
        }
        $this->set(compact('subReport'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Sub Report id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $subReport = $this->SubReports->get($id);
        if ($this->SubReports->delete($subReport)) {
            $this->Flash->success(__('The sub report has been deleted.'));
        } else {
            $this->Flash->error(__('The sub report could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
