<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Vaccinations Controller
 *
 * @property \App\Model\Table\VaccinationsTable $Vaccinations
 * @method \App\Model\Entity\Vaccination[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VaccinationsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $vaccinations = $this->paginate($this->Vaccinations);

        $this->set(compact('vaccinations'));
    }

    /**
     * View method
     *
     * @param string|null $id Vaccination id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $vaccination = $this->Vaccinations->get($id, [
            'contain' => ['Timesheets', 'Users'],
        ]);

        $this->set(compact('vaccination'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $vaccination = $this->Vaccinations->newEmptyEntity();
        if ($this->request->is('post')) {
            $vaccination = $this->Vaccinations->patchEntity($vaccination, $this->request->getData());
            if ($this->Vaccinations->save($vaccination)) {
                $this->Flash->success(__('The vaccination has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vaccination could not be saved. Please, try again.'));
        }
        $this->set(compact('vaccination'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Vaccination id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $vaccination = $this->Vaccinations->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vaccination = $this->Vaccinations->patchEntity($vaccination, $this->request->getData());
            if ($this->Vaccinations->save($vaccination)) {
                $this->Flash->success(__('The vaccination has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vaccination could not be saved. Please, try again.'));
        }
        $this->set(compact('vaccination'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Vaccination id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $vaccination = $this->Vaccinations->get($id);
        if ($this->Vaccinations->delete($vaccination)) {
            $this->Flash->success(__('The vaccination has been deleted.'));
        } else {
            $this->Flash->error(__('The vaccination could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
