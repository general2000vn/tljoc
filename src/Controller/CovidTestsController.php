<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Table\RolesTable;
use App\Model\Table\CovidTestsTable;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;




/**
 * CovidTests Controller
 *
 * @property \App\Model\Table\CovidTestsTable $CovidTests
 * @method \App\Model\Entity\CovidTest[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CovidTestsController extends AppController
{
    public $allowRoles = [RolesTable::R_SADMIN,RolesTable::R_HSE, RolesTable::R_HSE_MAN, RolesTable::R_HR, RolesTable::R_ADM_MAN];
    
    public function initialize(): void
    {
        parent::initialize();

        //$this->viewBuilder()->setLayout('sash');

        $this->set('menuElement', "aero/left-menu-covid");
    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $curUser = $this->Authentication->getIdentity();
        
        $covidTests = $this->CovidTests->find('all', ['conditions' => ['user_id' => $curUser->id],
                                                    'order' => ['test_date' => 'DESC']
                        ])->all();

        $this->set(compact('covidTests'));
    }

    /**
     * View method
     *
     * @param string|null $id Covid Test id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $covidTest = $this->CovidTests->get($id, [
            'contain' => ['Users' => ['fields' => ['id', 'firstname', 'lastname', 'department_id']]],
        ]);

        $curUser = $this->Authentication->getIdentity();

        if ((!$this->CovidTests->Users->hasRoleInList($curUser->id, $this->allowRoles)) && ($covidTest->user_id != $curUser->id)){
            $this->Flash->error('You have no privilege to view this Covid-19 Test Result');
            return $this->redirect($this->referer());
        }

        $this->set(compact('covidTest'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $curUser = $this->Authentication->getIdentity();
        $covidTest = $this->CovidTests->newEmptyEntity();
        if ($this->request->is('post')) {
            $covidTest = $this->CovidTests->patchEntity($covidTest, $this->request->getData());
            $covidTest->user_id = $curUser->id;
            if ($this->CovidTests->save($covidTest)) {
                $this->Flash->success(__('The covid test has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The covid test could not be saved. Please, try again.'));
        }
        
        $this->set(compact('covidTest'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Covid Test id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $curUser = $this->Authentication->getIdentity();
        $covidTest = $this->CovidTests->find('all', ['conditions' => ['id' => $id, 'user_id' => $curUser->id]])->first();

        if (is_null($covidTest)){
            $this->Flash->error('Invavlid Covid-19 Test Result ID');
            return $this->redirect($this->referer());
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $covidTest = $this->CovidTests->patchEntity($covidTest, $this->request->getData());
            if ($this->CovidTests->save($covidTest)) {
                $this->Flash->success(__('The covid test has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The covid test could not be saved. Please, try again.'));
        }
        //$users = $this->CovidTests->Users->find('list', ['limit' => 200]);
        $this->set(compact('covidTest'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Covid Test id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        //return $this->redirect(['action' => 'view', $id]);

        $this->request->allowMethod(['post', 'delete']);
        
        $curUser = $this->Authentication->getIdentity();
        $covidTest = $this->CovidTests->find('all', ['conditions' => ['id' => $id, 'user_id' => $curUser->id]])->first();

        if (is_null($covidTest)){
            $this->Flash->error('Invavlid Covid-19 Test Result ID');
            return $this->redirect($this->referer());
        }

        if ($this->CovidTests->delete($covidTest)) {
            $this->Flash->success(__('The covid test has been deleted.'));
        } else {
            $this->Flash->error(__('The covid test could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * deleteFile method
     *
     * @param string|null $id Doc Incoming id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
    */ 
    public function deleteFile($id = null)
    {
        $covidTest = $this->CovidTests->get($id);              

        if (!is_null($covidTest->result_file) && $covidTest->result_file != ''){
            $file = new File(ROOT. DS . CovidTestsTable::UPLOAD_DIR . $covidTest->result_file);
            //$this->Flash->warning(CovidTestsTable::UPLOAD_DIR . $covidTest->result_file);
            if ($file->exists()){
                $file->delete();
                $this->Flash->success('File deleted !');
            }
        } else {
            $this->Flash->success('No uploaded file exist !');
        }

        $covidTest->result_file = null;

        $this->CovidTests->save($covidTest);

        return $this->redirect($this->referer());
    }

    
}
