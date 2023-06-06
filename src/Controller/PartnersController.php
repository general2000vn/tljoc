<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;

/**
 * Partners Controller
 *
 * @property \App\Model\Table\PartnersTable $Partners
 * @method \App\Model\Entity\Partner[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PartnersController extends AppController
{
    
    // public function beforeFilter(EventInterface $event)
    // {
    //     parent::beforeFilter($event);

    //     $curUser = $this->Authentication->getIdentity();
        
    //     if (empty(array_intersect([2, 3, 4, 8, 10, 11] , $curUser->roleIDs))){
    //         $this->Flash->error('You can not access this function!');
    //         $this->redirect($this->referer());
    //     }
    // }

    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->Authentication->allowUnauthenticated(['ajaxSearch']);

        //$this->viewBuilder()->setLayout('sash');
        //$this->viewBuilder()->setLayout('das');
        $this->set('menuElement', "sash/left-menu-das");
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $partners = $this->Partners->find('all', ['fields' => ['id','name','name2', 'contact']]);

        $this->set(compact('partners'));
    }

    /**
     * View method
     *
     * @param string|null $id Partner id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $partner = $this->Partners->get($id);

        $referer = $this->referer();

        $this->set(compact('partner', 'referer'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $partner = $this->Partners->newEmptyEntity();
        if ($this->request->is('post')) {
            $curUser = $this->Authentication->getIdentity();
            $partner = $this->Partners->patchEntity($partner, $this->request->getData());
            $partner->modifier_id = $curUser->id;
            if ($this->Partners->save($partner)) {
                $this->Flash->success(__('The External Entity  has been added.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The External Entity could not be saved. Please, try again.'));
        }
        
        $this->set(compact('partner'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Partner id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $partner = $this->Partners->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $curUser = $this->Authentication->getIdentity();
            $partner = $this->Partners->patchEntity($partner, $this->request->getData());
            $partner->modifier_id = $curUser->id;
            if ($this->Partners->save($partner)) {
                $this->Flash->success(__('The External Entity has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The External Entity could not be saved. Please, try again.'));
        }
        
        $this->set(compact('partner'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Partner id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $curUser = $this->Authentication->getIdentity();
        if (count(array_intersect($curUser->roleIDs, [4])) == 0 ){
            $this->Flash->error('You are not allowed to delete External Entity!');
            return $this->redirect($this->referer());
        }
        $this->request->allowMethod(['post', 'delete']);
        $partner = $this->Partners->get($id);
        if ($this->Partners->delete($partner)) {
            $this->Flash->success(__('The partner has been deleted.'));
        } else {
            $this->Flash->error(__('The partner could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    public function ajaxSearch(){
        $criteria = $this->request->getQuery('criteria');
        
        $results = $this->Partners->findAJAX($criteria);

        $this->set('results', $results);
        $this->viewBuilder()->setOption('serialize', ['results']);
    }
}
