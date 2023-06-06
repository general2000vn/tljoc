<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * DashboardPrdYears Controller
 *
 * @property \App\Model\Table\DashboardPrdYearsTable $DashboardPrdYears
 * @method \App\Model\Entity\DashboardPrdYear[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DashboardPrdYearsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->viewBuilder()->setLayout('sash');

        $this->set('menuElement', "sash/left-menu-prd");
        $this->loadComponent('RequestHandler');

        $this->Authentication->allowUnauthenticated(['']);
    }

    

    public function isAuthorized() {
        $curUser = $this->Authentication->getIdentity();

        if (count(array_intersect($curUser->roleIDs, [4,14])) > 0 ) { //only super admin and PRD Stat PIC
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

        $dashboardPrdYears = $this->DashboardPrdYears->find('all', ['order' => 'target_year DESC']);

        $this->set(compact('dashboardPrdYears'));
    }

    /**
     * View method
     *
     * @param string|null $id Dashboard Prd Year id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $dashboardPrdYear = $this->DashboardPrdYears->get($id, [
            'contain' => ['OilFields'],
        ]);

        $this->set(compact('dashboardPrdYear'));
    }

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

        $dashboardPrdYear = $this->DashboardPrdYears->newEmptyEntity();
        if ($this->request->is('post')) {
            $dashboardPrdYear = $this->DashboardPrdYears->patchEntity($dashboardPrdYear, $this->request->getData());
            if ($this->DashboardPrdYears->save($dashboardPrdYear)) {
                $this->Flash->success(__('The Year Target has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The Year Target could not be saved. Please, try again.'));
        }
        
        $this->set(compact('dashboardPrdYear'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Dashboard Prd Year id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $dashboardPrdYear = $this->DashboardPrdYears->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $dashboardPrdYear = $this->DashboardPrdYears->patchEntity($dashboardPrdYear, $this->request->getData());
            if ($this->DashboardPrdYears->save($dashboardPrdYear)) {
                $this->Flash->success(__('The dashboard prd year has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The dashboard prd year could not be saved. Please, try again.'));
        }
       
        $this->set(compact('dashboardPrdYear'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Dashboard Prd Year id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $dashboardPrdYear = $this->DashboardPrdYears->get($id);
        if ($this->DashboardPrdYears->delete($dashboardPrdYear)) {
            $this->Flash->success(__('The dashboard prd year has been deleted.'));
        } else {
            $this->Flash->error(__('The dashboard prd year could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
