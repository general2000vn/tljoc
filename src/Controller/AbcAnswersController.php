<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * AbcAnswers Controller
 *
 * @property \App\Model\Table\AbcAnswersTable $AbcAnswers
 * @method \App\Model\Entity\AbcAnswer[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AbcAnswersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['AbcForms', 'AbcQuestions'],
        ];
        $abcAnswers = $this->paginate($this->AbcAnswers);

        $this->set(compact('abcAnswers'));
    }

    /**
     * View method
     *
     * @param string|null $id Abc Answer id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $abcAnswer = $this->AbcAnswers->get($id, [
            'contain' => ['AbcForms', 'AbcQuestions'],
        ]);

        $this->set(compact('abcAnswer'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $abcAnswer = $this->AbcAnswers->newEmptyEntity();
        if ($this->request->is('post')) {
            $abcAnswer = $this->AbcAnswers->patchEntity($abcAnswer, $this->request->getData());
            if ($this->AbcAnswers->save($abcAnswer)) {
                $this->Flash->success(__('The abc answer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The abc answer could not be saved. Please, try again.'));
        }
        $abcForms = $this->AbcAnswers->AbcForms->find('list', ['limit' => 200]);
        $abcQuestions = $this->AbcAnswers->AbcQuestions->find('list', ['limit' => 200]);
        $this->set(compact('abcAnswer', 'abcForms', 'abcQuestions'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Abc Answer id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $abcAnswer = $this->AbcAnswers->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $abcAnswer = $this->AbcAnswers->patchEntity($abcAnswer, $this->request->getData());
            if ($this->AbcAnswers->save($abcAnswer)) {
                $this->Flash->success(__('The abc answer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The abc answer could not be saved. Please, try again.'));
        }
        $abcForms = $this->AbcAnswers->AbcForms->find('list', ['limit' => 200]);
        $abcQuestions = $this->AbcAnswers->AbcQuestions->find('list', ['limit' => 200]);
        $this->set(compact('abcAnswer', 'abcForms', 'abcQuestions'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Abc Answer id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $abcAnswer = $this->AbcAnswers->get($id);
        if ($this->AbcAnswers->delete($abcAnswer)) {
            $this->Flash->success(__('The abc answer has been deleted.'));
        } else {
            $this->Flash->error(__('The abc answer could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
