<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * DocCategories Controller
 *
 * @property \App\Model\Table\DocCategoriesTable $DocCategories
 * @method \App\Model\Entity\DocCategory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DocCategoriesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $docCategories = $this->paginate($this->DocCategories);

        $this->set(compact('docCategories'));
    }

    /**
     * View method
     *
     * @param string|null $id Doc Category id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $docCategory = $this->DocCategories->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('docCategory'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $docCategory = $this->DocCategories->newEmptyEntity();
        if ($this->request->is('post')) {
            $docCategory = $this->DocCategories->patchEntity($docCategory, $this->request->getData());
            if ($this->DocCategories->save($docCategory)) {
                $this->Flash->success(__('The doc category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The doc category could not be saved. Please, try again.'));
        }
        $this->set(compact('docCategory'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Doc Category id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $docCategory = $this->DocCategories->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $docCategory = $this->DocCategories->patchEntity($docCategory, $this->request->getData());
            if ($this->DocCategories->save($docCategory)) {
                $this->Flash->success(__('The doc category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The doc category could not be saved. Please, try again.'));
        }
        $this->set(compact('docCategory'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Doc Category id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $docCategory = $this->DocCategories->get($id);
        if ($this->DocCategories->delete($docCategory)) {
            $this->Flash->success(__('The doc category has been deleted.'));
        } else {
            $this->Flash->error(__('The doc category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
