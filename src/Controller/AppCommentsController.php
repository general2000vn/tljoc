<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\ORM\Locator\TableLocator;
use Error;
use EmailQueue\EmailQueue;
use Cake\Mailer\Mailer;
use Cake\Core\Configure;

/**
 * AppComments Controller
 *
 * @property \App\Model\Table\AppCommentsTable $AppComments
 * @method \App\Model\Entity\AppComment[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AppCommentsController extends AppController
{
    public const ID_CONF_COMMENT_RECIEVER = 1;
    public function initialize(): void
    {
        parent::initialize();

        //$this->viewBuilder()->setLayout('sash');

        $this->set('menuElement', "sash/left-menu-app-comment");
    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $appComments = $this->AppComments->find('all', ['conditions' => ['ac_status_id <>' => 5 ],
                                                        'contain' => ['AcTypes', 'AcResults', 'AcStatuses']]);

        $this->set(compact('appComments'));
    }

    public function listResolved()
    {
        $appComments = $this->AppComments->find('all', ['conditions' => ['ac_status_id ' => 5 ],
                                                        'contain' => ['AcTypes', 'AcResults', 'AcStatuses']]);

        $this->set(compact('appComments'));
    }

    /**
     * View method
     *
     * @param string|null $id App Comment id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $appComment = $this->AppComments->get($id, [
            'contain' => ['Users','AcModules', 'AcTypes', 'AcResults', 'AcStatuses'],
        ]);

        $acModules = $this->AppComments->AcModules->find('list');
        $acTypes = $this->AppComments->AcTypes->find('list');
        $acStatuses = $this->AppComments->AcStatuses->find('list');
        $acResults = $this->AppComments->AcResults->find('list');
        $url = $this->referer();

        $this->set(compact('appComment', 'acModules', 'acStatuses', 'acTypes', 'acResults', 'url'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $curUserID = $this->Authentication->getIdentity()->get('id');
                
        $appComment = $this->AppComments->newEmptyEntity();
        if ($this->request->is('post')) {
            $appComment = $this->AppComments->patchEntity($appComment, $this->request->getData());
            $appComment->user_id = $curUserID;
            if ($this->AppComments->save($appComment)) {
                $this->Flash->success(__('The app comment has been saved.'));

                //$this->notifyNew($this->Authentication->getIdentity()->get('name'), $this->Authentication->getIdentity()->get('email'), $appComment->id, $appComment->brief);
                $this->myEnqueueNotifyNew($this->Authentication->getIdentity()->get('name'), $this->Authentication->getIdentity()->get('email'), $appComment->id, $appComment->brief);

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The app comment could not be saved. Please, try again.'));
        }
        $acModules = $this->AppComments->AcModules->find('list', ['limit' => 200]);
        $acTypes = $this->AppComments->AcTypes->find('list', ['limit' => 200]);
        $acResults = $this->AppComments->AcResults->find('list', ['limit' => 200]);
        $acStatuses = $this->AppComments->AcStatuses->find('list', ['limit' => 200]);
        $this->set(compact('appComment', 'acModules', 'acTypes', 'acResults', 'acStatuses'));
    }

    /**
     * Edit method
     *
     * @param string|null $id App Comment id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $appComment = $this->AppComments->get($id, [
            'contain' => [],
        ]);

        $user = $this->Authentication->getIdentity();
        $this->set('theUser', $user);
        if ($appComment->user_id != $user->get('id')){
            $this->Flash->warning('You can only edit your own Commnet / Bug Report !');
            $this->redirect(['action' => 'view', $appComment->id]);
        }

        //not at Opened status
        if ($appComment->ac_status_id != 1 ){
            $this->Flash->warning('You can only edit Commnet / Bug Report at Opened stage !');
            $this->redirect(['action' => 'view', $appComment->id]);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $appComment = $this->AppComments->patchEntity($appComment, $this->request->getData());
            if ($this->AppComments->save($appComment)) {
                $this->Flash->success(__('The app comment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The app comment could not be saved. Please, try again.'));
        }
        $users = $this->AppComments->Users->find('list', ['conditions' => ['is_deleted' => false],'order' => ['firstname' => 'ASC', 'lastname' => 'ASC']]);
        $acModules = $this->AppComments->AcModules->find('list', ['limit' => 200]);
        $acTypes = $this->AppComments->AcTypes->find('list', ['limit' => 200]);
        $acResults = $this->AppComments->AcResults->find('list', ['limit' => 200]);
        $acStatuses = $this->AppComments->AcStatuses->find('list', ['limit' => 200]);
        $this->set(compact('appComment', 'users', 'acTypes', 'acResults', 'acStatuses', 'acModules'));
    }

    /**
     * Process method
     *
     * @param string|null $id App Comment id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function process($id = null)
    {
        if (!$this->isAllowed([4])){
            $this->Flash->error('You have no privilege to process comment/bug report !');
            $this->redirect(['action' => 'view', $id]);
        }
        
        $appComment = $this->AppComments->get($id, [
            'contain' => ['Users', 'AcStatuses', 'AcResults'],
        ]);



        if ($this->request->is(['patch', 'post', 'put'])) {
            $appComment = $this->AppComments->patchEntity($appComment, $this->request->getData());
            if ($this->AppComments->save($appComment)) {
                $this->Flash->success(__('The app comment has been saved.'));

                

                $this->myEnqueueNotifyProcess($id);
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The app comment could not be saved. Please, try again.'));
        }
        $users = $this->AppComments->Users->find('list', ['conditions' => ['is_deleted' => false],'order' => ['firstname' => 'ASC', 'lastname' => 'ASC']]);
        $acModules = $this->AppComments->AcModules->find('list', ['limit' => 200]);
        $acTypes = $this->AppComments->AcTypes->find('list', ['limit' => 200]);
        $acResults = $this->AppComments->AcResults->find('list', ['limit' => 200]);
        $acStatuses = $this->AppComments->AcStatuses->find('list', ['limit' => 200]);
        $this->set(compact('appComment', 'users', 'acTypes', 'acResults', 'acStatuses', 'acModules'));
    }

    /**
     * Delete method
     *
     * @param string|null $id App Comment id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $appComment = $this->AppComments->get($id);
        if ($this->AppComments->delete($appComment)) {
            $this->Flash->success(__('The app comment has been deleted.'));
        } else {
            $this->Flash->error(__('The app comment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    */

    private function notifyNew($reporter, $reporter_email, $comment_id, $brief){

        $mailer = new Mailer();

        $mailer->setProfile('eoffice-web');
        $mailer->setTo([Configure::read('admin_email') => 'Super Admin']);
        $mailer->addCc([$reporter_email => $reporter]);
 
        $mailer->setSubject('e-Office: New App comment / bug report.');
        $mailer->viewBuilder()
                ->setTemplate('new_app_comment')
                ;
        
        $mailer->setViewVars(['reporter' => $reporter, 'comment_id' => $comment_id, 'brief' => $brief])
                ->deliver();
        
    }

    private function enqueueNotifyNew($reporter, $reporter_email, $comment_id, $brief){
        $to = [Configure::read('admin_email'), $reporter_email];
        $data = ['reporter' => $reporter, 'comment_id' => $comment_id, 'brief' => $brief];
        $options = [
            'subject' => 'e-Office: New App comment / bug report.',
            'layout' => 'eoffice',
            'template' => 'new_app_comment',
            'format' => 'html',
            'config' => 'eoffice-cli',
            'from_name' => 'e.Office',
            'from_email' => Configure::read('from_email')
        ];

        EmailQueue::enqueue($to, $data, $options);
    }

    private function myEnqueueNotifyNew($reporter, $reporter_email, $comment_id, $brief){
        $confTable = $this->getTableLocator()->get('Configs');
        $reciever_email = $confTable->get($this::ID_CONF_COMMENT_RECIEVER);
        //debug($reciever_email->value);
        
        $to = [$reciever_email->value];
        $cc = [$reporter_email];
        $data = ['reporter' => $reporter, 'comment_id' => $comment_id, 'brief' => $brief];
        $options = [
            'subject' => 'e-Office: New App comment / bug report.',
            'layout' => 'eoffice',
            'template' => 'new_app_comment',
            'format' => 'html',
            'config' => 'eoffice-cli',
            'from_name' => 'e-Office',
            'from_email' => Configure::read('from_email')
        ];

        EmailQueue::enqueue($to, $cc, $data, $options);
    }

    private function myEnqueueNotifyProcess($id){

        $appComment = $this->AppComments->get($id, [
            'contain' => ['Users', 'AcStatuses', 'AcResults'],
        ]);

        $to = [$appComment->user->email];
        $cc = [Configure::read('admin_email')];
        $data = ['comment_id' => $id, 'brief' => $appComment->brief
                , 'result' => $appComment->ac_result->name
                , 'status' => $appComment->ac_status->name];
        $options = [
            'subject' => 'e-Office: New App comment / bug report.',
            'layout' => 'eoffice',
            'template' => 'process_app_comment',
            'format' => 'html',
            'config' => 'eoffice-cli',
            'from_name' => 'e.Office',
            'from_email' => Configure::read('from_email')
        ];

        EmailQueue::enqueue($to, $cc, $data, $options);
    }

    public function testMailQueue(){
        $to = [Configure::read('admin_email'), 'info@hlhvjoc.com.vn'];
        $cc = ['general2000vn@yahoo.com', 'general20001vn@yahoo.com'];
        $data = ['reporter' => Configure::read('admin_email'), 'comment_id' => 1, 'brief' => 'Test MailQueue->enqueue'];
        $options = [
            'subject' => 'subject - Test MailQueue enqueue',
            'layout' => 'eoffice',
            'template' => 'new_app_comment',
            'format' => 'html',
            'config' => 'eoffice-cli',
            'from_name' => 'e.Office',
            'from_email' => Configure::read('from_email')
        ];

        EmailQueue::enqueue($to, $cc, $data, $options);

        $this->redirect($this->referer());
    }
}
