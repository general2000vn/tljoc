<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\I18n\FrozenDate;

/**
 * OilPrices Controller
 *
 * @property \App\Model\Table\OilPricesTable $OilPrices
 * @method \App\Model\Entity\OilPrice[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DashboardsController extends AppController
{
    public $uses = null;

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        // in a controller beforeFilter or initialize
        // Make view and index not require a logged in user.
        $this->Authentication->allowUnauthenticated(['index']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $oilPrices = $this->getTableLocator()->get('OilPrices')->find('all')->orderDesc('update_timestamp')->first();
        $HSEStat = $this->getTableLocator()->get('HseStats')->find('all')->orderDesc('from_date')->first();

        

        $today = FrozenDate::today();
        $dayNum = $today->diffInDays($HSEStat->from_date);

        $users = $this->getTableLocator()->get('Users')->find('all')->where(['dob LIKE' => '%' . $today->format('-m-d')])->toArray();

        $this->set(compact('oilPrices', 'HSEStat', 'users'));
    }

}