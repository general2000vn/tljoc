<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * TsLocations Controller
 *
 * @property \App\Model\Table\TsLocationsTable $TsLocations
 * @method \App\Model\Entity\TsLocation[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TsLocationsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $tsLocations = $this->paginate($this->TsLocations);

        $this->set(compact('tsLocations'));
    }

    /**
     * View method
     *
     * @param string|null $id Ts Location id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tsLocation = $this->TsLocations->get($id, [
            'contain' => ['Timesheets'],
        ]);

        $this->set(compact('tsLocation'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tsLocation = $this->TsLocations->newEmptyEntity();
        if ($this->request->is('post')) {
            $tsLocation = $this->TsLocations->patchEntity($tsLocation, $this->request->getData());
            if ($this->TsLocations->save($tsLocation)) {
                $this->Flash->success(__('The ts location has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ts location could not be saved. Please, try again.'));
        }
        $this->set(compact('tsLocation'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Ts Location id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tsLocation = $this->TsLocations->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tsLocation = $this->TsLocations->patchEntity($tsLocation, $this->request->getData());
            if ($this->TsLocations->save($tsLocation)) {
                $this->Flash->success(__('The ts location has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ts location could not be saved. Please, try again.'));
        }
        $this->set(compact('tsLocation'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Ts Location id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tsLocation = $this->TsLocations->get($id);
        if ($this->TsLocations->delete($tsLocation)) {
            $this->Flash->success(__('The ts location has been deleted.'));
        } else {
            $this->Flash->error(__('The ts location could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
