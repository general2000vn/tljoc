<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * OrUploads Controller
 *
 * @property \App\Model\Table\OrUploadsTable $OrUploads
 * @method \App\Model\Entity\OrUpload[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OrUploadsController extends AppController
{
    public function initialize() : void {
        parent::initialize();
        
        //$this->loadComponent('RequestHandler', ['enableBeforeRedirect' => false]);
        $this->loadComponent('RequestHandler');

        // Option B (preferred)
        $this->loadComponent('Ajax.Ajax', [
            'actions' => ['delete'],
            'resolveRedirect' => true,
        ]);

        $this->Authentication->allowUnauthenticated(['ajaxDelete']);
    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['OrderReqs'],
        ];
        $orUploads = $this->paginate($this->OrUploads);

        $this->set(compact('orUploads'));
    }

    /**
     * View method
     *
     * @param string|null $id Or Upload id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $orUpload = $this->OrUploads->get($id, [
            'contain' => ['OrderReqs'],
        ]);

        $this->set(compact('orUpload'));
        
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $orUpload = $this->OrUploads->newEmptyEntity();
        if ($this->request->is('post')) {
            $orUpload = $this->OrUploads->patchEntity($orUpload, $this->request->getData());
            if ($this->OrUploads->save($orUpload)) {
                $this->Flash->success(__('The or upload has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The or upload could not be saved. Please, try again.'));
        }
        $orderReqs = $this->OrUploads->OrderReqs->find('list', ['limit' => 200]);
        $this->set(compact('orUpload', 'orderReqs'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Or Upload id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $orUpload = $this->OrUploads->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $orUpload = $this->OrUploads->patchEntity($orUpload, $this->request->getData());
            if ($this->OrUploads->save($orUpload)) {
                $this->Flash->success(__('The or upload has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The or upload could not be saved. Please, try again.'));
        }
        $orderReqs = $this->OrUploads->OrderReqs->find('list', ['limit' => 200]);
        $this->set(compact('orUpload', 'orderReqs'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Or Upload id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $orUpload = $this->OrUploads->get($id);
        if ($this->OrUploads->delete($orUpload)) {
            $this->Flash->success(__('The or upload has been deleted.'));
        } else {
            $this->Flash->error(__('The or upload could not be deleted. Please, try again.'));
        }

        //return $this->redirect(['action' => 'index']);
    }

    public function ajaxDelete($id = null)
    {
        //$this->request->allowMethod(['post', 'delete']);
        $orUpload = $this->OrUploads->get($id);
        if ($this->OrUploads->delete($orUpload)) {
            $message = __('The OR upload file has been deleted.');
            $result = true;
            
        } else {
            $message = __('The OR upload file could not be deleted. Please, try again.');
            $result = false;
            $this->set(compact('error'));
        }

        $this->set('message', $message);
        $this->set('result', $result);
        $this->viewBuilder()->setOption('serialize', ['message', 'result']);
    }
}
