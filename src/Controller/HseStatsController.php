<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\I18n\FrozenDate;

/**
 * HseStats Controller
 *
 * @property \App\Model\Table\HseStatsTable $HseStats
 * @method \App\Model\Entity\HseStat[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class HseStatsController extends AppController
{
    
    public function initialize(): void
    {
        parent::initialize();

        $this->viewBuilder()->setLayout('sash');

        $this->set('menuElement', "sash/left-menu-hse");

        $this->loadComponent('RequestHandler');

        $this->Authentication->allowUnauthenticated(['ajaxGetHseStat']);
    }

    public function blank() {}

    public function isAuthorized() {
        $curUser = $this->Authentication->getIdentity();

        if (count(array_intersect($curUser->roleIDs, [4,9])) > 0 ) { //only super admin and HSE
            return true;
        }

        return false;
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
        ];
        $hseStats = $this->paginate($this->HseStats);

        $this->set(compact('hseStats'));
    }

    /**
     * View method
     *
     * @param string|null $id Hse Stat id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    // public function view($id = null)
    // {
    //     $hseStat = $this->HseStats->get($id, [
    //         'contain' => ['Users'],
    //     ]);

    //     $this->set(compact('hseStat'));
    // }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if (!$this->isAuthorized()){
            $this->Flash->error('You are not authorized to access that function!');
            $this->redirect($this->referer());
        }

        $hseStat = $this->HseStats->newEmptyEntity();
        if ($this->request->is('post')) {
            $curUser = $this->Authentication->getIdentity();

            $hseStat = $this->HseStats->patchEntity($hseStat, $this->request->getData());
            $hseStat->user_id = $curUser->id;
            if ($this->HseStats->save($hseStat)) {
                $this->Flash->success(__('The hse stat has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The hse stat could not be saved. Please, try again.'));
        }
        
        
        $this->set(compact('hseStat'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Hse Stat id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if (!$this->isAuthorized()){
            $this->Flash->error('You are not authorized to access that function!');
            $this->redirect($this->referer());
        }

        $hseStat = $this->HseStats->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $hseStat = $this->HseStats->patchEntity($hseStat, $this->request->getData());
            
            $curUser = $this->Authentication->getIdentity();
            $hseStat->user_id = $curUser->id;

            if ($this->HseStats->save($hseStat)) {
                $this->Flash->success(__('The hse stat has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The hse stat could not be saved. Please, try again.'));
        }
        
        $this->set(compact('hseStat'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Hse Stat id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    // public function delete($id = null)
    // {
    //     $this->request->allowMethod(['post', 'delete']);
    //     $hseStat = $this->HseStats->get($id);
    //     if ($this->HseStats->delete($hseStat)) {
    //         $this->Flash->success(__('The hse stat has been deleted.'));
    //     } else {
    //         $this->Flash->error(__('The hse stat could not be deleted. Please, try again.'));
    //     }

    //     return $this->redirect(['action' => 'index']);
    // }

    public function ajaxGetHseStat(){
        $hseStat = $this->HseStats->find('all')->orderDesc('from_date')->first();
        $today = FrozenDate::today();
        $dayNum = $today->diffInDays($hseStat->from_date);
        
        $results['man_day'] = $dayNum;
        $results['hse_stat'] = $hseStat->toArray();

        $this->set('results', $results);
        $this->viewBuilder()->setOption('serialize', ['results']);
    }
}
