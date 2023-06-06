<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * DocCompanies Controller
 *
 * @property \App\Model\Table\DocCompaniesTable $DocCompanies
 * @method \App\Model\Entity\DocCompany[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DocCompaniesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $docCompanies = $this->paginate($this->DocCompanies);

        $this->set(compact('docCompanies'));
    }

    /**
     * View method
     *
     * @param string|null $id Doc Company id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $docCompany = $this->DocCompanies->get($id, [
            'contain' => ['DocIncomings'],
        ]);

        $this->set(compact('docCompany'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $docCompany = $this->DocCompanies->newEmptyEntity();
        if ($this->request->is('post')) {
            $docCompany = $this->DocCompanies->patchEntity($docCompany, $this->request->getData());
            if ($this->DocCompanies->save($docCompany)) {
                $this->Flash->success(__('The doc company has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The doc company could not be saved. Please, try again.'));
        }
        $this->set(compact('docCompany'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Doc Company id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $docCompany = $this->DocCompanies->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $docCompany = $this->DocCompanies->patchEntity($docCompany, $this->request->getData());
            if ($this->DocCompanies->save($docCompany)) {
                $this->Flash->success(__('The doc company has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The doc company could not be saved. Please, try again.'));
        }
        $this->set(compact('docCompany'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Doc Company id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $docCompany = $this->DocCompanies->get($id);
        if ($this->DocCompanies->delete($docCompany)) {
            $this->Flash->success(__('The doc company has been deleted.'));
        } else {
            $this->Flash->error(__('The doc company could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
