<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Table\AbcFormStatusesTable;
use App\Model\Table\AbcStatusesTable;
use App\Model\Table\RolesTable;
use Cake\ORM\Locator\TableLocator;
use Cake\Database\Query;
use EmailQueue\EmailQueue;

/**
 * AbcCampaigns Controller
 *
 * @property \App\Model\Table\AbcCampaignsTable $AbcCampaigns
 * @method \App\Model\Entity\AbcCampaign[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AbcCampaignsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->viewBuilder()->setLayout('sash');

        $this->set('menuElement', "sash/left-menu-hr");
    }

    /**
     * Incomplete method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function incomplete()
    {
        $abcCampaigns = $this->AbcCampaigns->find('all', [
            'contain' => ['AbcStatuses', 'Initiators'], 'conditions' => ['abc_status_id <>' => AbcStatusesTable::S_COMPLETED], 'order' => ['period' => 'DESC']
        ]);

        $this->set(compact('abcCampaigns'));
    }

    public function all()
    {
        $abcCampaigns = $this->AbcCampaigns->find('all', [
            'contain' => ['AbcStatuses', 'Initiators' => ['fields' => ['id', 'firstname', 'lastname']]],
            'order' => ['period' => 'DESC']
        ]);

        $this->set(compact('abcCampaigns'));
    }

    /**
     * Incomplete method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function completed()
    {
        $abcCampaigns = $this->AbcCampaigns->find('all', [
            'contain' => ['AbcStatuses', 'Initiators'], 'conditions' => ['abc_status_id' => AbcStatusesTable::S_COMPLETED], 'order' => ['period' => 'DESC']
        ]);

        $this->set(compact('abcCampaigns'));
    }

    public function stat($id)
    {
        if (!$this->isAllowed([RolesTable::R_DGM, RolesTable::R_GM, RolesTable::R_ADM_MAN, RolesTable::R_HR, RolesTable::R_SADMIN])) {
            $this->Flash->error(__('You are not allowed to access this function!'));
            return $this->redirect($this->referer());
        }

        $curUser = $this->Authentication->getIdentity();
        $iCompleted = 0;
        $iNotStarted = 0;
        $iProcessing = 0;
        $iSubmitted = 0;
        $iNormal = 0;
        $iAbnormal = 0;

        /* --------- Show 2 list of Forms : Completed and Incomplete ---------------- */
        $abcCampaign  = $this->AbcCampaigns->get($id, [
            'contain' => ['AbcForms.Users.Departments','AbcForms.AbcFormStatuses', 'AbcStatuses'],
        ]);

        
        
        foreach ($abcCampaign->abc_forms as $abc_form) {
            //count status
            switch ($abc_form->abc_form_status_id) {
                case AbcFormStatusesTable::S_ACKNOWLEDGED:
                    $iCompleted++;
                    
                    if ($abc_form->is_abnormal) {
                        $iAbnormal++;
                    } else {
                        $iNormal++;
                    }
                    break;
                case AbcFormStatusesTable::S_INITIATED:
                    $iNotStarted++;
                    
                    break;
                case AbcFormStatusesTable::S_SUBMITTED:
                    $iSubmitted++;
                    
                    break;
                default:
                    $iProcessing++;
                    
                    break;
            }
        }
        $this->set(compact('abcCampaign', 'iCompleted', 'iNotStarted', 'iProcessing', 'iSubmitted', 'iNormal', 'iAbnormal'));

        
    }

    /**
     * View method
     *
     * @param string|null $id Abc Campaign id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        if (!$this->isAllowed([RolesTable::R_SADMIN, RolesTable::R_HR, RolesTable::R_ADM_MAN, RolesTable::R_GM, RolesTable::R_DGM])) {
            $this->Flash->error(__('You are not allowed to access this function!'));
            return $this->redirect($this->referer());
        }

        $curUser = $this->Authentication->getIdentity();

        $abcCampaign = $this->AbcCampaigns->get($id, [
            'contain' => ['AbcQuestions'],
        ]);


        $questions = $abcCampaign->abc_questions;
        $abcCategories = $this->AbcCampaigns->AbcQuestions->AbcCategories->find('all');
        $abcStatuses = $this->AbcCampaigns->AbcStatuses->find('list', ['limit' => 200]);
        $this->set(compact('abcCampaign', 'abcCategories', 'abcStatuses', 'questions'));
    }

    public function blank(){}

    public function viewAbcGuide(){}

    public function publish($id = null)
    {
        if (!$this->isAllowed([4, 1])) {
            $this->Flash->error(__('You are not allowed to access this function!'));
            return $this->redirect($this->referer());
        }

        $curUser = $this->Authentication->getIdentity();

        $abcCampaign = $this->AbcCampaigns->get($id, [
            'contain' => ['AbcStatuses', 'AbcForms'],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $posted = $this->request->getData();

            $i = 0;
            $abc['abc_forms'] = array();

            foreach ($posted['staffs'] as $key => $staff_id) {

                $abc['abc_forms'][$i]['user_id'] = $staff_id;
                $abc['abc_forms'][$i]['handler_id'] = $staff_id;
                $abc['abc_forms'][$i]['last_handler_id'] = $curUser->id;
                $abc['abc_forms'][$i]['abc_campaign_id'] = $abcCampaign->id;
                $abc['abc_forms'][$i]['abc_form_status_id'] = AbcFormStatusesTable::S_INITIATED;
                $abc['abc_forms'][$i]['remind_date'] = $abcCampaign->deadline;
                $i++;
            }
            $abcCampaign = $this->AbcCampaigns->patchEntity($abcCampaign, $abc);
            $abcCampaign->abc_status_id = AbcStatusesTable::S_PROCESSING;

            if ($this->AbcCampaigns->save($abcCampaign, ['associated' => ['AbcForms']])) {
                $this->Flash->success(__('The Annual Business Compliance campaign has been published.'));

                $this->notifyPublish($abcCampaign);

                return $this->redirect(['action' => 'incomplete']);
            }
            $this->Flash->error(__('The Annual Business Compliance campaign could not be published. Please contact IT.'));
        }


        $deptTable = $this->getTableLocator()->get('Departments');
        $depts = $deptTable->find('all')
            ->contain('Users', function (Query $q) {
                return $q->select(['id', 'firstname', 'lastname', 'department_id'])
                    ->where(['Users.is_deleted' => false])
                    ->orderAsc('firstname');
            });

        $abcStatuses = $this->AbcCampaigns->AbcStatuses->find('list', ['limit' => 200]);
        $this->set(compact('abcCampaign',  'abcStatuses', 'depts'));
    }

    private function notifyPublish($abcCampaign)
    {

        foreach ($abcCampaign->abc_forms as $abcForm) {

            $user = $this->AbcCampaigns->AbcForms->Users->get($abcForm->user_id);
            $to = [$user->email];
            $cc = [];

            $data = [
                'period' => $abcCampaign->period, 'deadline' => $abcCampaign->deadline, 'username' => $user->name, 'form_id' => $abcForm->id

            ];
            $options = [
                'subject' => 'e-Office: New Annual Business Compliance form waiting to be submitted',
                'layout' => 'abc',
                'template' => 'abc_init',
                'format' => 'html',
                'config' => 'eoffice-cli',
                'from_name' => 'e.Office',
                'from_email' => Configure::read('from_email')
            ];

            EmailQueue::enqueue($to, $cc, $data, $options);
        }
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if (!$this->isAllowed([4, 1])) {
            $this->Flash->error(__('You are not allowed to access this function!'));
            return $this->redirect($this->referer());
        }

        $curUser = $this->Authentication->getIdentity();

        $abcCampaign = $this->AbcCampaigns->newEmptyEntity();
        if ($this->request->is('post')) {
            $abcCampaign = $this->AbcCampaigns->patchEntity($abcCampaign, $this->request->getData(), ['associated' => ['AbcQuestions']]);
            $abcCampaign->initiator_id = $curUser->id;
            $abcCampaign->abc_status_id = AbcStatusesTable::S_DRAFT;
            if ($this->AbcCampaigns->save($abcCampaign, ['associated' => ['AbcQuestions']])) {
                $this->Flash->success(__('The Annual Business Compliance campaign has been saved.'));

                return $this->redirect(['action' => 'view', $abcCampaign->id]);
            }
            $this->Flash->error(__('The Annual Business Compliance campaign could not be saved. Please, try again.'));
            $this->set('posted', $this->request->getData());
            $this->set('patched', $abcCampaign);
        }
        $abcCategories = $this->AbcCampaigns->AbcQuestions->AbcCategories->find('all')->toList();
        $abcStatuses = $this->AbcCampaigns->AbcStatuses->find('list', ['limit' => 200]);
        $this->set(compact('abcCampaign', 'abcStatuses', 'abcCategories'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Abc Campaign id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if (!$this->isAllowed([4, 1])) {
            $this->Flash->error(__('You are not allowed to access this function!'));
            return $this->redirect($this->referer());
        }

        $curUser = $this->Authentication->getIdentity();

        $abcCampaign = $this->AbcCampaigns->get($id, [
            'contain' => ['AbcQuestions'],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $abcCampaign = $this->AbcCampaigns->patchEntity($abcCampaign, $this->request->getData());
            if ($this->AbcCampaigns->save($abcCampaign)) {
                $this->Flash->success(__('The Annual Business Compliance campaign has been saved.'));

                return $this->redirect(['action' => 'view', $id]);
            }
            $this->Flash->error(__('The Annual Business Compliance campaign could not be saved. Please, try again.'));
        }

        $questions = $abcCampaign->abc_questions;
        $abcCategories = $this->AbcCampaigns->AbcQuestions->AbcCategories->find('all');
        $abcStatuses = $this->AbcCampaigns->AbcStatuses->find('list', ['limit' => 200]);
        $this->set(compact('abcCampaign', 'abcCategories', 'abcStatuses', 'questions'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Abc Campaign id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $abcCampaign = $this->AbcCampaigns->get($id);
        if ($this->AbcCampaigns->delete($abcCampaign)) {
            $this->Flash->success(__('The Annual Business Compliance campaign has been deleted.'));
        } else {
            $this->Flash->error(__('The Annual Business Compliance campaign could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
