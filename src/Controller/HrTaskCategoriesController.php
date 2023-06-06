<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * HrTaskCategories Controller
 *
 * @property \App\Model\Table\HrTaskCategoriesTable $HrTaskCategories
 * @method \App\Model\Entity\HrTaskCategory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class HrTaskCategoriesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $hrTaskCategories = $this->paginate($this->HrTaskCategories);

        $this->set(compact('hrTaskCategories'));
    }

    /**
     * View method
     *
     * @param string|null $id Hr Task Category id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $hrTaskCategory = $this->HrTaskCategories->get($id, [
            'contain' => ['HrPtTasks'],
        ]);

        $this->set(compact('hrTaskCategory'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $hrTaskCategory = $this->HrTaskCategories->newEmptyEntity();
        if ($this->request->is('post')) {
            $hrTaskCategory = $this->HrTaskCategories->patchEntity($hrTaskCategory, $this->request->getData());
            if ($this->HrTaskCategories->save($hrTaskCategory)) {
                $this->Flash->success(__('The hr task category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The hr task category could not be saved. Please, try again.'));
        }
        $this->set(compact('hrTaskCategory'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Hr Task Category id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $hrTaskCategory = $this->HrTaskCategories->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $hrTaskCategory = $this->HrTaskCategories->patchEntity($hrTaskCategory, $this->request->getData());
            if ($this->HrTaskCategories->save($hrTaskCategory)) {
                $this->Flash->success(__('The hr task category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The hr task category could not be saved. Please, try again.'));
        }
        $this->set(compact('hrTaskCategory'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Hr Task Category id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $hrTaskCategory = $this->HrTaskCategories->get($id);
        if ($this->HrTaskCategories->delete($hrTaskCategory)) {
            $this->Flash->success(__('The hr task category has been deleted.'));
        } else {
            $this->Flash->error(__('The hr task category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
