<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * DocInternalTypes Controller
 *
 * @property \App\Model\Table\DocInternalTypesTable $DocInternalTypes
 * @method \App\Model\Entity\DocInternalType[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DocInternalTypesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $docInternalTypes = $this->paginate($this->DocInternalTypes);

        $this->set(compact('docInternalTypes'));
    }

    /**
     * View method
     *
     * @param string|null $id Doc Internal Type id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $docInternalType = $this->DocInternalTypes->get($id, [
            'contain' => ['DocInternals'],
        ]);

        $this->set(compact('docInternalType'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $docInternalType = $this->DocInternalTypes->newEmptyEntity();
        if ($this->request->is('post')) {
            $docInternalType = $this->DocInternalTypes->patchEntity($docInternalType, $this->request->getData());
            if ($this->DocInternalTypes->save($docInternalType)) {
                $this->Flash->success(__('The doc internal type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The doc internal type could not be saved. Please, try again.'));
        }
        $this->set(compact('docInternalType'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Doc Internal Type id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $docInternalType = $this->DocInternalTypes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $docInternalType = $this->DocInternalTypes->patchEntity($docInternalType, $this->request->getData());
            if ($this->DocInternalTypes->save($docInternalType)) {
                $this->Flash->success(__('The doc internal type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The doc internal type could not be saved. Please, try again.'));
        }
        $this->set(compact('docInternalType'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Doc Internal Type id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $docInternalType = $this->DocInternalTypes->get($id);
        if ($this->DocInternalTypes->delete($docInternalType)) {
            $this->Flash->success(__('The doc internal type has been deleted.'));
        } else {
            $this->Flash->error(__('The doc internal type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
