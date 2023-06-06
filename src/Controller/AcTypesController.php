<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * AcTypes Controller
 *
 * @property \App\Model\Table\AcTypesTable $AcTypes
 * @method \App\Model\Entity\AcType[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AcTypesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $acTypes = $this->paginate($this->AcTypes);

        $this->set(compact('acTypes'));
    }

    /**
     * View method
     *
     * @param string|null $id Ac Type id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $acType = $this->AcTypes->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('acType'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $acType = $this->AcTypes->newEmptyEntity();
        if ($this->request->is('post')) {
            $acType = $this->AcTypes->patchEntity($acType, $this->request->getData());
            if ($this->AcTypes->save($acType)) {
                $this->Flash->success(__('The ac type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ac type could not be saved. Please, try again.'));
        }
        $this->set(compact('acType'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Ac Type id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $acType = $this->AcTypes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $acType = $this->AcTypes->patchEntity($acType, $this->request->getData());
            if ($this->AcTypes->save($acType)) {
                $this->Flash->success(__('The ac type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ac type could not be saved. Please, try again.'));
        }
        $this->set(compact('acType'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Ac Type id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $acType = $this->AcTypes->get($id);
        if ($this->AcTypes->delete($acType)) {
            $this->Flash->success(__('The ac type has been deleted.'));
        } else {
            $this->Flash->error(__('The ac type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
