<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * AbcQuestions Controller
 *
 * @property \App\Model\Table\AbcQuestionsTable $AbcQuestions
 * @method \App\Model\Entity\AbcQuestion[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AbcQuestionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['AbcCategories'],
        ];
        $abcQuestions = $this->paginate($this->AbcQuestions);

        $this->set(compact('abcQuestions'));
    }

    /**
     * View method
     *
     * @param string|null $id Abc Question id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $abcQuestion = $this->AbcQuestions->get($id, [
            'contain' => ['AbcCategories', 'AbcAnswers'],
        ]);

        $this->set(compact('abcQuestion'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $abcQuestion = $this->AbcQuestions->newEmptyEntity();
        if ($this->request->is('post')) {
            $abcQuestion = $this->AbcQuestions->patchEntity($abcQuestion, $this->request->getData());
            if ($this->AbcQuestions->save($abcQuestion)) {
                $this->Flash->success(__('The abc question has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The abc question could not be saved. Please, try again.'));
        }
        $abcCategories = $this->AbcQuestions->AbcCategories->find('list', ['limit' => 200]);
        $this->set(compact('abcQuestion', 'abcCategories'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Abc Question id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $abcQuestion = $this->AbcQuestions->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $abcQuestion = $this->AbcQuestions->patchEntity($abcQuestion, $this->request->getData());
            if ($this->AbcQuestions->save($abcQuestion)) {
                $this->Flash->success(__('The abc question has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The abc question could not be saved. Please, try again.'));
        }
        $abcCategories = $this->AbcQuestions->AbcCategories->find('list', ['limit' => 200]);
        $this->set(compact('abcQuestion', 'abcCategories'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Abc Question id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $abcQuestion = $this->AbcQuestions->get($id);
        if ($this->AbcQuestions->delete($abcQuestion)) {
            $this->Flash->success(__('The abc question has been deleted.'));
        } else {
            $this->Flash->error(__('The abc question could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
