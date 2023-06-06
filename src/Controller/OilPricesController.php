<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * OilPrices Controller
 *
 * @property \App\Model\Table\OilPricesTable $OilPrices
 * @method \App\Model\Entity\OilPrice[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OilPricesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->viewBuilder()->setLayout('sash');

        $this->set('menuElement', "sash/left-menu-prd");

        $this->loadComponent('RequestHandler');

        $this->Authentication->allowUnauthenticated(['ajaxGetOilPrices']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $oilPrices = $this->paginate($this->OilPrices);

        $this->set(compact('oilPrices'));
    }

    /**
     * View method
     *
     * @param string|null $id Oil Price id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    // public function view($id = null)
    // {
    //     $oilPrice = $this->OilPrices->get($id, [
    //         'contain' => [],
    //     ]);

    //     $this->set(compact('oilPrice'));
    // }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    // public function add()
    // {
    //     $oilPrice = $this->OilPrices->newEmptyEntity();
    //     if ($this->request->is('post')) {
    //         $oilPrice = $this->OilPrices->patchEntity($oilPrice, $this->request->getData());
    //         if ($this->OilPrices->save($oilPrice)) {
    //             $this->Flash->success(__('The oil price has been saved.'));

    //             return $this->redirect(['action' => 'index']);
    //         }
    //         $this->Flash->error(__('The oil price could not be saved. Please, try again.'));
    //     }
    //     $this->set(compact('oilPrice'));
    // }

    /**
     * Edit method
     *
     * @param string|null $id Oil Price id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    // public function edit($id = null)
    // {
    //     $oilPrice = $this->OilPrices->get($id, [
    //         'contain' => [],
    //     ]);
    //     if ($this->request->is(['patch', 'post', 'put'])) {
    //         $oilPrice = $this->OilPrices->patchEntity($oilPrice, $this->request->getData());
    //         if ($this->OilPrices->save($oilPrice)) {
    //             $this->Flash->success(__('The oil price has been saved.'));

    //             return $this->redirect(['action' => 'index']);
    //         }
    //         $this->Flash->error(__('The oil price could not be saved. Please, try again.'));
    //     }
    //     $this->set(compact('oilPrice'));
    // }

    /**
     * Delete method
     *
     * @param string|null $id Oil Price id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    // public function delete($id = null)
    // {
    //     $this->request->allowMethod(['post', 'delete']);
    //     $oilPrice = $this->OilPrices->get($id);
    //     if ($this->OilPrices->delete($oilPrice)) {
    //         $this->Flash->success(__('The oil price has been deleted.'));
    //     } else {
    //         $this->Flash->error(__('The oil price could not be deleted. Please, try again.'));
    //     }

    //     return $this->redirect(['action' => 'index']);
    // }

    public function ajaxGetOilPrices(){
        $oilPrice = $this->OilPrices->find('all')->orderDesc('update_timestamp')->first();
        
        $results = $oilPrice->toArray();

        $this->set('results', $results);
        $this->viewBuilder()->setOption('serialize', ['results']);
    }
}
