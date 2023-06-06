<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\I18n\FrozenDate;
use Cake\ORM\TableRegistry;

/**
 * DashboardPrdDays Controller
 *
 * @property \App\Model\Table\DashboardPrdDaysTable $DashboardPrdDays
 * @method \App\Model\Entity\DashboardPrdDay[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DashboardPrdDaysController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->viewBuilder()->setLayout('sash');

        $this->set('menuElement', "sash/left-menu-prd");
        $this->loadComponent('RequestHandler');

        $this->Authentication->allowUnauthenticated(['ajaxGetYtdCnvTotal', 'ajaxGetYtdTgtTotal','ajaxGetCnvTotal', 'ajaxGetTgtTotal', 'ajaxGetDaily', 'ajaxGetTrend']);
    }

    public function blank() {}

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
        
        $dashboardPrdDays = $this->DashboardPrdDays->find('all', ['order' => 'stat_date DESC']);

        $this->set(compact('dashboardPrdDays'));
    }

    /**
     * View method
     *
     * @param string|null $id Dashboard Prd Day id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $dashboardPrdDay = $this->DashboardPrdDays->get($id, [
            'contain' => ['OilFields'],
        ]);

        $this->set(compact('dashboardPrdDay'));
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

        $dashboardPrdDay = $this->DashboardPrdDays->newEmptyEntity();
        if ($this->request->is('post')) {
            
            $dashboardPrdDay = $this->DashboardPrdDays->patchEntity($dashboardPrdDay, $this->request->getData());
            if ($this->DashboardPrdDays->exists(['stat_date' => $dashboardPrdDay->stat_date])){
                $this->Flash->error(__('Statistic data for that date has been recorded. Please edit that record or change to another date!'));
                return;
            }
            $curUser = $this->Authentication->getIdentity();
            $dashboardPrdDay->user_id = $curUser->id;
            if ($this->DashboardPrdDays->save($dashboardPrdDay)) {
                $this->Flash->success(__('The PRD statistic has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The dashboard prd day could not be saved. Please, try again.'));
        }
        
        $this->set(compact('dashboardPrdDay'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Dashboard Prd Day id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if (!$this->isAuthorized()){
            $this->Flash->error('You are not authorized to access that function!');
            $this->redirect($this->referer());
        }

        $dashboardPrdDay = $this->DashboardPrdDays->get($id, [
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $dashboardPrdDay = $this->DashboardPrdDays->patchEntity($dashboardPrdDay, $this->request->getData());
            //$this->set('posted', $this->request->getData());
            if ($this->DashboardPrdDays->save($dashboardPrdDay)) {
                $this->Flash->success(__('The Dashboard PRD Statistic has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The Dashboard PRD Statistic could not be saved. Please, try again.'));
        }
        
        $this->set(compact('dashboardPrdDay'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Dashboard Prd Day id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    // public function delete($id = null)
    // {
    //     $this->request->allowMethod(['post', 'delete']);
    //     $dashboardPrdDay = $this->DashboardPrdDays->get($id);
    //     if ($this->DashboardPrdDays->delete($dashboardPrdDay)) {
    //         $this->Flash->success(__('The dashboard prd day has been deleted.'));
    //     } else {
    //         $this->Flash->error(__('The dashboard prd day could not be deleted. Please, try again.'));
    //     }

    //     return $this->redirect(['action' => 'index']);
    // }

    public function ajaxGetYtdCnvTotal(){
        $today = FrozenDate::today();
        $from_date = new FrozenDate($today->format('Y-01-01'));

        $ytd_CNV_query = $this->DashboardPrdDays->find('all', ['conditions' => ['stat_date >=' => $from_date->format('Y-m-d'), 'stat_date <=' => $today->format('Y-m-d')]]);
        $ytd_CNV_query->select(['ytd_cum_cnv' => $ytd_CNV_query->func()->sum('oil_rate_cnv')]);
        $ytd_CNV = $ytd_CNV_query->toArray();

        $yearTargetTable = $this->getTableLocator()->get('DashboardPrdYears');
        $yearTarget = $yearTargetTable->find('all', ['conditions' => ['target_year' => $today->format('Y')],'order' => ['target_year']])->first()->toArray();
        
        $results['ytd'] = $ytd_CNV[0]['ytd_cum_cnv'];
        $results['achivement'] = round($ytd_CNV[0]['ytd_cum_cnv']*100 / $yearTarget['cnv_target'],1);

        $this->set('results', $results);
        $this->viewBuilder()->setOption('serialize', ['results']);
    }

    public function ajaxGetYtdTgtTotal(){
        $today = FrozenDate::today();
        $from_date = new FrozenDate($today->format('Y-01-01'));

        $ytd_TGT_query = $this->DashboardPrdDays->find('all', ['conditions' => ['stat_date >=' => $from_date->format('Y-m-d'), 'stat_date <=' => $today->format('Y-m-d')]]);
        $ytd_TGT_query->select(['ytd_cum_tgt' => $ytd_TGT_query->func()->sum('oil_rate_tgt')]);
        $ytd_TGT = $ytd_TGT_query->toArray();


        $yearTargetTable = $this->getTableLocator()->get('DashboardPrdYears');
        $yearTarget = $yearTargetTable->find('all', ['order' => ['target_year']])->first()->toArray();
        
        $results['ytd'] = $ytd_TGT[0]['ytd_cum_tgt'];
        $results['achivement'] = round($ytd_TGT[0]['ytd_cum_tgt']*100 / $yearTarget['tgt_target'],1);


        $this->set('results', $results);
        $this->viewBuilder()->setOption('serialize', ['results']);
    }

    public function ajaxGetCnvTotal(){
        $today = FrozenDate::today();
        

        $total_CNV = $this->DashboardPrdDays->find('all');
        $total_CNV->select(['total_cnv' => $total_CNV->func()->sum('oil_rate_cnv')])->toArray();

        $this->set('results', $total_CNV);
        $this->viewBuilder()->setOption('serialize', ['results']);
    }

    public function ajaxGetTgtTotal(){
        $today = FrozenDate::today();

        $total_TGT = $this->DashboardPrdDays->find('all');
        $total_TGT->select(['total_tgt' => $total_TGT->func()->sum('oil_rate_tgt')])->toArray();

        $this->set('results', $total_TGT);
        $this->viewBuilder()->setOption('serialize', ['results']);
    }

    public function ajaxGetDaily(){
        $prdDaily = $this->DashboardPrdDays->find('all', ['order' => ['stat_date DESC']])->first()->toArray();

        $this->set('results', $prdDaily);
        $this->viewBuilder()->setOption('serialize', ['results']);
    }

    // public function ajaxGetTrend(){
    //     $results = $this->DashboardPrdDays->find('all', ['fields' => ['stat_date', 'oil_rate_cnv', 'oil_rate_tgt'],'order' => ['stat_date DESC'], 'limit' => 14])->toArray();


        
    //     $this->set('results', $results);
    //     $this->viewBuilder()->setOption('serialize', ['results']);
    // }

    public function ajaxGetTrend(){
        $labels = $this->DashboardPrdDays->find('all', ['fields' => ['stat_date'],'order' => ['stat_date DESC'], 'limit' => 14])->toArray();
        $cnvs = $this->DashboardPrdDays->find('all', ['fields' => ['oil_rate_cnv'],'order' => ['stat_date DESC'], 'limit' => 14])->toArray();
        $tgts = $this->DashboardPrdDays->find('all', ['fields' => ['oil_rate_tgt'],'order' => ['stat_date DESC'], 'limit' => 14])->toArray();

        for ($i = count($labels) - 1; $i >= 0 ; $i--){
            $results['labels'][] = $labels[$i]->stat_date;
        }
        for ($i = count($cnvs) - 1; $i >= 0 ; $i--){
            $results['cnv'][] = $cnvs[$i]->oil_rate_cnv;
        }
        for ($i = count($tgts) - 1; $i >= 0 ; $i--){
            $results['tgt'][] = $tgts[$i]->oil_rate_tgt;
        }
        // foreach ($labels as $label ){
        //     $results['labels'][] = $label->stat_date;
        // }
        // foreach ($cnvs as $date => $cnv ){
        //     $results['cnv'][] = $cnv->oil_rate_cnv;
        // }
        // foreach ($tgts as $date => $tgt ){
        //     $results['tgt'][] = $tgt->oil_rate_tgt;
        // }

 

        $this->set('results', $results);
        $this->viewBuilder()->setOption('serialize', ['results']);
    }


    

   

    
}
