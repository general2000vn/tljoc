<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * DocTypes Controller
 *
 * @property \App\Model\Table\DocTypesTable $DocTypes
 * @method \App\Model\Entity\DocType[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DocTypesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $docTypes = $this->paginate($this->DocTypes);

        $this->set(compact('docTypes'));
    }

    /**
     * View method
     *
     * @param string|null $id Doc Type id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $docType = $this->DocTypes->get($id, [
            'contain' => ['DocIncomings'],
        ]);

        $this->set(compact('docType'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $docType = $this->DocTypes->newEmptyEntity();
        if ($this->request->is('post')) {
            $docType = $this->DocTypes->patchEntity($docType, $this->request->getData());
            if ($this->DocTypes->save($docType)) {
                $this->Flash->success(__('The doc type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The doc type could not be saved. Please, try again.'));
        }
        $this->set(compact('docType'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Doc Type id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $docType = $this->DocTypes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $docType = $this->DocTypes->patchEntity($docType, $this->request->getData());
            if ($this->DocTypes->save($docType)) {
                $this->Flash->success(__('The doc type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The doc type could not be saved. Please, try again.'));
        }
        $this->set(compact('docType'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Doc Type id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $docType = $this->DocTypes->get($id);
        if ($this->DocTypes->delete($docType)) {
            $this->Flash->success(__('The doc type has been deleted.'));
        } else {
            $this->Flash->error(__('The doc type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
