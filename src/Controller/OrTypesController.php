<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * OrTypes Controller
 *
 * @property \App\Model\Table\OrTypesTable $OrTypes
 * @method \App\Model\Entity\OrType[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OrTypesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $orTypes = $this->paginate($this->OrTypes);

        $this->set(compact('orTypes'));
    }

    /**
     * View method
     *
     * @param string|null $id Or Type id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $orType = $this->OrTypes->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('orType'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $orType = $this->OrTypes->newEmptyEntity();
        if ($this->request->is('post')) {
            $orType = $this->OrTypes->patchEntity($orType, $this->request->getData());
            if ($this->OrTypes->save($orType)) {
                $this->Flash->success(__('The or type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The or type could not be saved. Please, try again.'));
        }
        $this->set(compact('orType'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Or Type id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $orType = $this->OrTypes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $orType = $this->OrTypes->patchEntity($orType, $this->request->getData());
            if ($this->OrTypes->save($orType)) {
                $this->Flash->success(__('The or type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The or type could not be saved. Please, try again.'));
        }
        $this->set(compact('orType'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Or Type id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $orType = $this->OrTypes->get($id);
        if ($this->OrTypes->delete($orType)) {
            $this->Flash->success(__('The or type has been deleted.'));
        } else {
            $this->Flash->error(__('The or type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
