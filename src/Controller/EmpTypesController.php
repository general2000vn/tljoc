<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * EmpTypes Controller
 *
 * @property \App\Model\Table\EmpTypesTable $EmpTypes
 * @method \App\Model\Entity\EmpType[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EmpTypesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->viewBuilder()->setLayout('sash');
        $this->set('menuElement', "sash/left-menu-admin");
    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $empTypes = $this->paginate($this->EmpTypes);

        $this->set(compact('empTypes'));
    }

    /**
     * View method
     *
     * @param string|null $id Emp Type id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $empType = $this->EmpTypes->get($id, [
            'contain' => ['HrPts', 'Users'],
        ]);

        $this->set(compact('empType'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $empType = $this->EmpTypes->newEmptyEntity();
        if ($this->request->is('post')) {
            $empType = $this->EmpTypes->patchEntity($empType, $this->request->getData());
            if ($this->EmpTypes->save($empType)) {
                $this->Flash->success(__('The emp type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The emp type could not be saved. Please, try again.'));
        }
        $this->set(compact('empType'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Emp Type id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $empType = $this->EmpTypes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $empType = $this->EmpTypes->patchEntity($empType, $this->request->getData());
            if ($this->EmpTypes->save($empType)) {
                $this->Flash->success(__('The emp type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The emp type could not be saved. Please, try again.'));
        }
        $this->set(compact('empType'));
    }

    



    /**
     * Delete method
     *
     * @param string|null $id Emp Type id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $empType = $this->EmpTypes->get($id);
        if ($this->EmpTypes->delete($empType)) {
            $this->Flash->success(__('The emp type has been deleted.'));
        } else {
            $this->Flash->error(__('The emp type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
