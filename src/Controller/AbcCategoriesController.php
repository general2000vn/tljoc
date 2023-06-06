<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * AbcCategories Controller
 *
 * @property \App\Model\Table\AbcCategoriesTable $AbcCategories
 * @method \App\Model\Entity\AbcCategory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AbcCategoriesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $abcCategories = $this->paginate($this->AbcCategories);

        $this->set(compact('abcCategories'));
    }

    /**
     * View method
     *
     * @param string|null $id Abc Category id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $abcCategory = $this->AbcCategories->get($id, [
            'contain' => ['AbcQuestions'],
        ]);

        $this->set(compact('abcCategory'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $abcCategory = $this->AbcCategories->newEmptyEntity();
        if ($this->request->is('post')) {
            $abcCategory = $this->AbcCategories->patchEntity($abcCategory, $this->request->getData());
            if ($this->AbcCategories->save($abcCategory)) {
                $this->Flash->success(__('The abc category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The abc category could not be saved. Please, try again.'));
        }
        $this->set(compact('abcCategory'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Abc Category id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $abcCategory = $this->AbcCategories->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $abcCategory = $this->AbcCategories->patchEntity($abcCategory, $this->request->getData());
            if ($this->AbcCategories->save($abcCategory)) {
                $this->Flash->success(__('The abc category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The abc category could not be saved. Please, try again.'));
        }
        $this->set(compact('abcCategory'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Abc Category id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $abcCategory = $this->AbcCategories->get($id);
        if ($this->AbcCategories->delete($abcCategory)) {
            $this->Flash->success(__('The abc category has been deleted.'));
        } else {
            $this->Flash->error(__('The abc category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
