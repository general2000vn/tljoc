<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\I18n\FrozenDate;

/**
 * Notices Controller
 *
 * @property \App\Model\Table\NoticesTable $Notices
 * @method \App\Model\Entity\Notice[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class NoticesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->viewBuilder()->setLayout('sash');

        $this->set('menuElement', "sash/left-menu-admin");
        $this->loadComponent('RequestHandler');

        $this->Authentication->allowUnauthenticated(['ajaxGetCurrent',]);
    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $today = FrozenDate::today();
        $notices = $this->Notices->find('all', ['conditions' => ['start_date <=' => $today->format('Y-m-d'), 'end_date >=' => $today->format('Y-m-d') ]]);

        $this->set(compact('notices'));
    }

    public function upcoming()
    {
        $today = FrozenDate::today();
        $notices = $this->Notices->find('all', ['conditions' => ['start_date >' => $today->format('Y-m-d') ]]);

        $this->set(compact('notices'));
    }

    public function expired()
    {
        $today = FrozenDate::today();
        $notices = $this->Notices->find('all', ['conditions' => ['end_date <' => $today->format('Y-m-d') ]]);

        $this->set(compact('notices'));
    }

    /**
     * View method
     *
     * @param string|null $id Notice id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $notice = $this->Notices->get($id, [
            'contain' => [],
        ]);

        $referer = $this->referer();

        $this->set(compact('notice', 'referer'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $notice = $this->Notices->newEmptyEntity();
        if ($this->request->is('post')) {
            $notice = $this->Notices->patchEntity($notice, $this->request->getData());
            if ($this->Notices->save($notice)) {
                $this->Flash->success(__('The notice has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The notice could not be saved. Please, try again.'));
        }
        $this->set(compact('notice'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Notice id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $notice = $this->Notices->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $notice = $this->Notices->patchEntity($notice, $this->request->getData());
            if ($this->Notices->save($notice)) {
                $this->Flash->success(__('The notice has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The notice could not be saved. Please, try again.'));
        }
        $this->set(compact('notice'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Notice id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $notice = $this->Notices->get($id);
        if ($this->Notices->delete($notice)) {
            $this->Flash->success(__('The notice has been deleted.'));
        } else {
            $this->Flash->error(__('The notice could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function ajaxGetCurrent(){
        $today = FrozenDate::today();
        $notices = $this->Notices->find('all', ['conditions' => ['start_date <=' => $today->format('Y-m-d'), 'end_date >=' => $today->format('Y-m-d') ]])
                                ->toArray();

        
        $this->set('results', $notices);
        $this->viewBuilder()->setOption('serialize', ['results']);
    }
}
