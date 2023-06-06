<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * OilFields Controller
 *
 * @property \App\Model\Table\OilFieldsTable $OilFields
 * @method \App\Model\Entity\OilField[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OilFieldsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $oilFields = $this->paginate($this->OilFields);

        $this->set(compact('oilFields'));
    }

    /**
     * View method
     *
     * @param string|null $id Oil Field id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $oilField = $this->OilFields->get($id, [
            'contain' => ['DashboardPrdDays', 'DashboardPrdYears'],
        ]);

        $this->set(compact('oilField'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $oilField = $this->OilFields->newEmptyEntity();
        if ($this->request->is('post')) {
            $oilField = $this->OilFields->patchEntity($oilField, $this->request->getData());
            if ($this->OilFields->save($oilField)) {
                $this->Flash->success(__('The oil field has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The oil field could not be saved. Please, try again.'));
        }
        $this->set(compact('oilField'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Oil Field id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $oilField = $this->OilFields->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $oilField = $this->OilFields->patchEntity($oilField, $this->request->getData());
            if ($this->OilFields->save($oilField)) {
                $this->Flash->success(__('The oil field has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The oil field could not be saved. Please, try again.'));
        }
        $this->set(compact('oilField'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Oil Field id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $oilField = $this->OilFields->get($id);
        if ($this->OilFields->delete($oilField)) {
            $this->Flash->success(__('The oil field has been deleted.'));
        } else {
            $this->Flash->error(__('The oil field could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
