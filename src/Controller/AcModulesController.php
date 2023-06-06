<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * AcModules Controller
 *
 * @property \App\Model\Table\AcModulesTable $AcModules
 * @method \App\Model\Entity\AcModule[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AcModulesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $acModules = $this->paginate($this->AcModules);

        $this->set(compact('acModules'));
    }

    /**
     * View method
     *
     * @param string|null $id Ac Module id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $acModule = $this->AcModules->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('acModule'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $acModule = $this->AcModules->newEmptyEntity();
        if ($this->request->is('post')) {
            $acModule = $this->AcModules->patchEntity($acModule, $this->request->getData());
            if ($this->AcModules->save($acModule)) {
                $this->Flash->success(__('The ac module has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ac module could not be saved. Please, try again.'));
        }
        $this->set(compact('acModule'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Ac Module id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $acModule = $this->AcModules->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $acModule = $this->AcModules->patchEntity($acModule, $this->request->getData());
            if ($this->AcModules->save($acModule)) {
                $this->Flash->success(__('The ac module has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ac module could not be saved. Please, try again.'));
        }
        $this->set(compact('acModule'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Ac Module id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $acModule = $this->AcModules->get($id);
        if ($this->AcModules->delete($acModule)) {
            $this->Flash->success(__('The ac module has been deleted.'));
        } else {
            $this->Flash->error(__('The ac module could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
