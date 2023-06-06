<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * DocMethods Controller
 *
 * @property \App\Model\Table\DocMethodsTable $DocMethods
 * @method \App\Model\Entity\DocMethod[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DocMethodsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $docMethods = $this->paginate($this->DocMethods);

        $this->set(compact('docMethods'));
    }

    /**
     * View method
     *
     * @param string|null $id Doc Method id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $docMethod = $this->DocMethods->get($id, [
            'contain' => ['DocIncomings'],
        ]);

        $this->set(compact('docMethod'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $docMethod = $this->DocMethods->newEmptyEntity();
        if ($this->request->is('post')) {
            $docMethod = $this->DocMethods->patchEntity($docMethod, $this->request->getData());
            if ($this->DocMethods->save($docMethod)) {
                $this->Flash->success(__('The doc method has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The doc method could not be saved. Please, try again.'));
        }
        $this->set(compact('docMethod'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Doc Method id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $docMethod = $this->DocMethods->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $docMethod = $this->DocMethods->patchEntity($docMethod, $this->request->getData());
            if ($this->DocMethods->save($docMethod)) {
                $this->Flash->success(__('The doc method has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The doc method could not be saved. Please, try again.'));
        }
        $this->set(compact('docMethod'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Doc Method id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $docMethod = $this->DocMethods->get($id);
        if ($this->DocMethods->delete($docMethod)) {
            $this->Flash->success(__('The doc method has been deleted.'));
        } else {
            $this->Flash->error(__('The doc method could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
