<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\AbcCampaign;
use App\Model\Entity\AbcForm;
use App\Model\Entity\AbcStatus;
use App\Model\Entity\Role;
use App\Model\Table\AbcFormStatusesTable;
use App\Model\Table\AbcStatusesTable;
use App\Model\Table\RolesTable;
use App\Model\Table\UsersTable;
use Cake\I18n\FrozenTime;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use EmailQueue\EmailQueue;
use Cake\Core\Configure;

use function PHPUnit\Framework\isNull;

/**
 * AbcForms Controller
 *
 * @property \App\Model\Table\AbcFormsTable $AbcForms
 * @method \App\Model\Entity\AbcForm[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AbcFormsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->viewBuilder()->setLayout('sash');

        $this->set('menuElement', "sash/left-menu-hr");
    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'AbcCanpaigns', 'AbcFormStatuses'],
        ];
        $abcForms = $this->paginate($this->AbcForms);

        $this->set(compact('abcForms'));
    }

    public function my()
    {
        $curUser = $this->Authentication->getIdentity();
        $abcForms = $this->AbcForms->find('all', ['conditions' => ['user_id' => $curUser->id]
                                                ,'contain' => ['AbcCampaigns', 'AbcFormStatuses', 'LastHandlers']
                                        ]);

        $this->set(compact('abcForms'));
    }

    public function myAck()
    {
        $curUser = $this->Authentication->getIdentity();
        $LMs = $this->AbcForms->Users->getAllByRole(RolesTable::R_LM);

        $abcForms = $this->AbcForms->find('all', [
                                                //'conditions' => []
                                                //'handler_id' => $curUser->id
                                                //, 'abc_form_status_id' => AbcFormStatusesTable::S_SUBMITTED
                                                'conditions' => ['AbcCampaigns.abc_status_id' => AbcStatusesTable::S_PROCESSING
                                                                , 'Users.department_id' => $curUser->department_id
                                                                ]
                                                ,'contain' => ['AbcCampaigns', 'AbcFormStatuses', 'Users', 'LastHandlers']
                                                
                                        ])->toArray();
        
        foreach ($LMs as $LM) {
            $lmAbcForm = $this->AbcForms->find('all', ['conditions' => ['user_id' => $LM->id, 'AbcCampaigns.abc_status_id' => AbcStatusesTable::S_PROCESSING]
                                                    ,'contain' => ['AbcCampaigns', 'AbcFormStatuses', 'Users', 'LastHandlers']
                                                    ]
            )->toArray();
            if (count($lmAbcForm) > 0){
                array_push($abcForms, $lmAbcForm[0]);
                
            }
        }
        

        $this->set(compact('abcForms'));
    }

    /**
     * View method
     *
     * @param string|null $id Abc Form id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $abcForm = $this->AbcForms->get($id, ['contain' => ['Users', 'AbcAnswers', 'Handlers']]);

       if (is_null($abcForm)){
           $this->Flash->error('Invalid Annual Business Compliance form !');
           return $this->redirect($this->referer());
       }

       $curUser = $this->Authentication->getIdentity();

       if (($curUser->id != $abcForm->handler_id) && ($curUser->id != $abcForm->user_id) && ($this->AbcForms->Users->hasRoleInList($curUser->id, [4,1,8, 2,3]))){ //super admin, HR, ADM manager, GM, DGM
           $this->Flash->error('You are not authorized to View this Annual Business Compliance form !');
           return $this->redirect($this->referer());
       }

       
       $abcCampaign = $this->AbcForms->AbcCampaigns->get($abcForm->abc_campaign_id, ['contain' => 'AbcQuestions']);

       
              
       $abcFormStatuses = $this->AbcForms->AbcFormStatuses->find('list', ['limit' => 200]);
       $abcCategories = $this->AbcForms->AbcCampaigns->AbcQuestions->AbcCategories->find('all', ['order' => 'vn']);

       $this->set(compact('abcForm', 'abcCampaign', 'abcFormStatuses', 'abcCategories'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $abcForm = $this->AbcForms->newEmptyEntity();
        if ($this->request->is('post')) {
            $abcForm = $this->AbcForms->patchEntity($abcForm, $this->request->getData());
            if ($this->AbcForms->save($abcForm)) {
                $this->Flash->success(__('The abc form has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The abc form could not be saved. Please, try again.'));
        }
        $users = $this->AbcForms->Users->find('list', ['limit' => 200]);
        $abcCanpaigns = $this->AbcForms->AbcCanpaigns->find('list', ['limit' => 200]);
        $abcFormStatuses = $this->AbcForms->AbcFormStatuses->find('list', ['limit' => 200]);
        $this->set(compact('abcForm', 'users', 'abcCanpaigns', 'abcFormStatuses'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Abc Form id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id)
    {
       
       $abcForm = $this->AbcForms->get($id, ['contain' => ['Users', 'AbcAnswers']
                                            , 'conditions' => [
                                                'OR' => [['abc_form_status_id' => AbcFormStatusesTable::S_DRAFT ]
                                                        , ['abc_form_status_id' => AbcFormStatusesTable::S_REJECTED ]]
                                            ]]);

       if (is_null($abcForm)){
           $this->Flash->error('Invalid Annual Business Compliance form !');
           return $this->redirect($this->referer());
       }

       $curUser = $this->Authentication->getIdentity();

       if (($curUser->id != $abcForm->user_id)){
           $this->Flash->error('You are not authorized to fill this Annual Business Compliance form !');
           return $this->redirect($this->referer());
       }

       if (($abcForm->abc_form_status_id == AbcFormStatusesTable::S_INITIATED)){
           
           return $this->redirect(['action' => 'fill', $abcForm->id]);
       }
       
       if (($abcForm->abc_form_status_id != AbcFormStatusesTable::S_DRAFT) && ($abcForm->abc_form_status_id != AbcFormStatusesTable::S_REJECTED)){
           
           return $this->redirect(['action' => 'view', $abcForm->id]);
       }


       $abcCampaign = $this->AbcForms->AbcCampaigns->get($abcForm->abc_campaign_id, ['contain' => 'AbcQuestions']);

       if ($this->request->is(['patch', 'post', 'put'])) {
           $posted = $this->request->getData();
           $posted['justification'] = trim($posted['justification']);
           if ($posted['justification'] == '') {$posted['justification'] = null;}
           $abcForm = $this->AbcForms->patchEntity($abcForm, $posted, ['associated' => ['AbcAnswers']]);
           $abcForm->is_abnormal = false;
            $sQuestion = 'Question: ';
           foreach ($abcForm->abc_answers as $abc_answer){
               $question = $this->AbcForms->AbcCampaigns->AbcQuestions->get($abc_answer->abc_question_id);
               if ($abc_answer->b_value == $question->abnormal){
                   $abc_answer->is_abnormal = true;
                   $abcForm->is_abnormal = true;
                   $sQuestion = $sQuestion . $question->order_code . ', ' ;
               } else {
                   $abc_answer->is_abnormal = false;
               }
           }

           if ($this->AbcForms->save($abcForm, ['associated' => ['AbcAnswers']])){
                if (($abcForm->is_abnormal) && (is_null($abcForm->justification))){
                    $this->Flash->success('You need to provide Justification !');
                    $this->Flash->warning($sQuestion);
                    $this->redirect(['action' => 'edit', $abcForm->id]);
                } else {
                    $this->submit($abcForm, $abcCampaign);
                    $this->Flash->success('You have submitted the Business Compliance form successfully!');
                    $this->redirect(['action' => 'my']);
                }
               
           } else {
               $this->Flash->error('Can not save Business Compliance form!');
               $this->redirect(['action' => 'edit', $abcForm->id]);
           }

           //return $this->redirect(['action' => 'my']);
           $this->set('posted', $posted);
           $this->set('patched', $abcForm);
           return;
           
       }

              
       $abcFormStatuses = $this->AbcForms->AbcFormStatuses->find('list', ['limit' => 200]);
       $abcCategories = $this->AbcForms->AbcCampaigns->AbcQuestions->AbcCategories->find('all', ['order' => 'vn']);

       $this->set(compact('abcForm', 'abcCampaign', 'abcFormStatuses', 'abcCategories'));
    }

    public function acknowledge($id = null)
    {
        
       $abcForm = $this->AbcForms->get($id, ['contain' => ['Users', 'AbcAnswers'], 'conditions' => ['abc_form_status_id' => AbcFormStatusesTable::S_SUBMITTED]]);

       if (is_null($abcForm)){
           $this->Flash->error('Invalid Annual Business Compliance form !');
           return $this->redirect($this->referer());
       }

       $curUser = $this->Authentication->getIdentity();

       if ($curUser->id != $abcForm->handler_id){
           $this->Flash->error('You are not authorized to Acknowledge this Annual Business Compliance form !');
           return $this->redirect($this->referer());
       }

       
       $abcCampaign = $this->AbcForms->AbcCampaigns->get($abcForm->abc_campaign_id, ['contain' => 'AbcQuestions']);

       if ($this->request->is(['patch', 'post', 'put'])) {
        
           
           $abcForm->ack_date = FrozenTime::now();

           if (!is_null($this->request->getData('btnAck'))){
                $abcForm->abc_form_status_id = AbcFormStatusesTable::S_ACKNOWLEDGED;
                
                
           } elseif (!is_null($this->request->getData('btnReject'))){
                $abcForm->abc_form_status_id = AbcFormStatusesTable::S_REJECTED;
                $abcForm->handler_id = $abcForm->user->id;
           }

           //$this->set('posted', $this->request->getData());
           $abcForm->last_handler_id = $curUser->id;


           if ($this->AbcForms->save($abcForm)){
                    $this->AbcForms->AbcCampaigns->checkStatus($abcCampaign);
                    

                    if ($abcForm->abc_form_status_id == AbcFormStatusesTable::S_REJECTED){
                        $this->Flash->success('You have Rejected the Business Compliance form!');
                        $this->notifyReject($abcForm->user, $curUser, $abcForm, $abcCampaign);
                    } elseif ($abcForm->abc_form_status_id == AbcFormStatusesTable::S_ACKNOWLEDGED){
                        $this->Flash->success('You have Acknowledged the Business Compliance form!');
                        $this->notifyAcknowledge($abcForm->user, $curUser, $abcForm, $abcCampaign);
                    }
                    
                    $this->redirect(['action' => 'myAck']);
                
               
           } else {
               $this->Flash->error('Can not Acknowlege the Business Compliance form!');
               $this->redirect(['action' => 'myAck']);
           }

           //return $this->redirect(['action' => 'my']);
           //return;
           
       }

              
       $abcFormStatuses = $this->AbcForms->AbcFormStatuses->find('list', ['limit' => 200]);
       $abcCategories = $this->AbcForms->AbcCampaigns->AbcQuestions->AbcCategories->find('all', ['order' => 'vn']);

       $this->set(compact('abcForm', 'abcCampaign', 'abcFormStatuses', 'abcCategories'));
    }

    private function submit(AbcForm $abcForm, AbcCampaign $abcCampaign){
        $curUser = $this->Authentication->getIdentity();
        $next_handler = null;

         //------ check next approver ------
        if ($this->AbcForms->Users->hasRole($curUser->id, RolesTable::R_GM)){
            $next_handler = $this->AbcForms->Users->getOneByRole(RolesTable::R_DGM);
        } else {
            $dept = $this->AbcForms->Users->Departments->get($curUser->department_id);

            if ($dept->user_id == $curUser->id) { //line manager
            
                $next_handler = $this->AbcForms->Users->getOneByRole(RolesTable::R_GM);
            } else {
                $next_handler = $this->AbcForms->Users->get($dept->user_id);
            }
        }
        

        $abcForm->abc_form_status_id = AbcFormStatusesTable::S_SUBMITTED;
        $abcForm->handler_id = $next_handler->id;
        $abcForm->last_handler_id = $curUser->id;
        $abcForm->submit_date = FrozenTime::now();

        if ($this->AbcForms->save($abcForm)){
            $this->notifySubmission($curUser, $next_handler, $abcForm, $abcCampaign);
        }
        
    }

    private function notifySubmission($user, $handler, $abcForm, $abcCampaign){
        
        $to = [$handler->email];
        $cc = [$user->email];

        $data = ['handler_name' => $handler->name
                ,'staff_name' => $user->name
                ,'period' => $abcCampaign->period
                ,'deadline' => $abcCampaign->deadline
                ,'form_id' =>   $abcForm->id
        ];
        $options = [
            'subject' => 'e-Office: new Annual Business Compliance form waiting for your Acknowledgement',
            'layout' => 'abc',
            'template' => 'abc_submit',
            'format' => 'html',
            'config' => 'eoffice-cli',
            'from_name' => 'e.Office',
            'from_email' => Configure::read('from_email')
        ];

        EmailQueue::enqueue($to, $cc, $data, $options);
    }

    private function notifyAcknowledge($user, $handler, $abcForm, $abcCampaign){
        
        $to = [$user->email];
        $cc = [$handler->email];

        $data = ['handler_name' => $handler->name
                ,'staff_name' => $user->name
                ,'period' => $abcCampaign->period
                ,'ack_time' => $abcForm->ackdate
                ,'form_id' =>   $abcForm->id
        ];
        $options = [
            'subject' => 'e-Office: your Annual Business Compliance form has been acknowledged',
            'layout' => 'abc',
            'template' => 'abc_ack',
            'format' => 'html',
            'config' => 'eoffice-cli',
            'from_name' => 'e.Office',
            'from_email' => Configure::read('from_email')
        ];

        EmailQueue::enqueue($to, $cc, $data, $options);
    }

    private function notifyReject($user, $handler, $abcForm, $abcCampaign){
        
        $to = [$user->email];
        $cc = [$handler->email];

        $data = ['handler_name' => $handler->name
                ,'staff_name' => $user->name
                ,'period' => $abcCampaign->period
                ,'reject_time' => $abcForm->ackdate
                ,'form_id' =>   $abcForm->id
        ];
        $options = [
            'subject' => 'e-Office: your Annual Business Compliance form has been rejected',
            'layout' => 'abc',
            'template' => 'abc_reject',
            'format' => 'html',
            'config' => 'eoffice-cli',
            'from_name' => 'e.Office',
            'from_email' => Configure::read('from_email')
        ];

        EmailQueue::enqueue($to, $cc, $data, $options);
    }

    public function viewGuide($id = null)
    {
        $abcForm = $this->AbcForms->get($id, ['contain' => ['Users']]);
        $abcCampaign = $this->AbcForms->AbcCampaigns->get($abcForm->abc_campaign_id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            return $this->redirect(['action' => 'answer']);
            
        }

        $this->Flash->success('Please read through this Guideline carefully and click confirm button at bottom of the page!');
        
        $abcFormStatuses = $this->AbcForms->AbcFormStatuses->find('list', ['limit' => 200]);
        $this->set(compact('abcForm', 'abcCampaign', 'abcFormStatuses'));
    }

    public function fill($id = null)
    {
        //$abcForm = $this->AbcForms->get($id, ['conditions' => ['abc_form_status_id' => AbcFormStatusesTable::S_DRAFT]]);
        $abcForm = $this->AbcForms->get($id, ['contain' => 'Users']);

        if (is_null($abcForm)){
            $this->Flash->error('Invalid Annual Business Compliance form !');
            return $this->redirect($this->referer());
        }

        if (($abcForm->abc_form_status_id == AbcFormStatusesTable::S_DRAFT)){
            
            return $this->redirect(['action' => 'edit', $id]);
        }
        
        if (($abcForm->abc_form_status_id != AbcFormStatusesTable::S_INITIATED)){
            
            return $this->redirect(['action' => 'view', $id]);
        }

        $curUser = $this->Authentication->getIdentity();

        if (($curUser->id != $abcForm->user_id)){
            $this->Flash->error('You are not authorized to fill this Annual Business Compliance form !');
            //return $this->redirect(['action' => 'my']);
        }


        $abcCampaign = $this->AbcForms->AbcCampaigns->get($abcForm->abc_campaign_id, ['contain' => 'AbcQuestions']);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $posted = $this->request->getData();
            $posted['justification'] = trim($posted['justification']);
            if ($posted['justification'] == '') {$posted['justification'] = null;}
            $abcForm = $this->AbcForms->patchEntity($abcForm, $posted, ['associated' => ['AbcAnswers']]);
            $abcForm->is_abnormal = false;
            $abcForm->abc_form_status_id = AbcFormStatusesTable::S_DRAFT;
            $abcForm->last_handler_id = $curUser->id;

            $sQuestion = 'Question: ';

            foreach ($abcForm->abc_answers as $abc_answer){
                $question = $this->AbcForms->AbcCampaigns->AbcQuestions->get($abc_answer->abc_question_id);
                if ($abc_answer->b_value == $question->abnormal){
                    $abc_answer->is_abnormal = true;
                    $abcForm->is_abnormal = true;
                    $sQuestion = $sQuestion . $question->order_code . ', ' ;
                } else {
                    $abc_answer->is_abnormal = false;
                }
            }

            if ($this->AbcForms->save($abcForm, ['associated' => ['AbcAnswers']])){
                if (($abcForm->is_abnormal) && (is_null($abcForm->justification) || $abcForm->justification == '')){
                    $this->Flash->error('You need to provide Justification!');
                    $this->Flash->warning($sQuestion);
                    
                    $this->redirect(['action' => 'edit', $abcForm->id]);
                } else {
                    $this->submit($abcForm, $abcCampaign);
                    $this->Flash->success('You have submitted the Business Compliance form successfully!');
                    $this->redirect(['action' => 'my']);
                }
               
           } else {
               $this->Flash->error('Can not save Business Compliance form!');
               $this->redirect(['action' => 'my', $abcForm->id]);
           }


            
        }

        if ($this->referer() != Router::url(['controller' => 'AbcForms', 'action' => 'view-guide', $id, '_base' =>false], false)) {
            return $this->redirect(['controller' => 'AbcForms', 'action' => 'viewGuide', $id]);
        }
        
        $abcFormStatuses = $this->AbcForms->AbcFormStatuses->find('list', ['limit' => 200]);
        $abcCategories = $this->AbcForms->AbcCampaigns->AbcQuestions->AbcCategories->find('all', ['order' => 'vn']);

        $this->set(compact('abcForm', 'abcCampaign', 'abcFormStatuses', 'abcCategories'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Abc Form id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $abcForm = $this->AbcForms->get($id);
        if ($this->AbcForms->delete($abcForm)) {
            $this->Flash->success(__('The abc form has been deleted.'));
        } else {
            $this->Flash->error(__('The abc form could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
