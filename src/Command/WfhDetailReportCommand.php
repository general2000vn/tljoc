<?php

namespace App\Command;

use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\I18n\FrozenDate;
//use Cake\I18n\FrozenTime;
use Cake\Mailer\Mailer;
use EmailQueue\EmailQueue;
use Cake\Console\ConsoleOptionParser;

class WfhDetailReportCommand extends Command
{
    protected function buildOptionParser(ConsoleOptionParser $parser): ConsoleOptionParser
    {
        $parser
            ->addArgument('friday', [
                'help' => 'YYYY-mm-dd : The date of Friday that you want to generate report'
            ]);

        return $parser;
    }
    
    public function execute(Arguments $args, ConsoleIo $io)
    {
           
        $today = FrozenDate::today();
        
        $friday = $args->getArgument('friday');

        if ($friday != '') {
            $today = new FrozenDate($friday);
        }

        $monday = $today->subDay(4);
        $io->out('----------------------Detail-----------------------------');
        $io->out("From: " . $monday->format('Y-m-d') . "      To: " . $today->format('Y-m-d'));

        $data = $this->getData($monday->format('Y-m-d'), $today->format('Y-m-d'));

        
        //$this->sendEmails($data, $monday->format('Y-m-d'), $today->format('Y-m-d'));
        $this->enqueueEmails($data, $monday->format('Y-m-d'), $today->format('Y-m-d'));
    }

    private function getData(String $from , String $to)
    {
        $data = array();
        $departments = $this->getTableLocator()->get('Departments')->find('all')->toArray();
        $TimesheetsTable = $this->getTableLocator()->get('Timesheets');
        $UsersTable = $this->getTableLocator()->get('Users');
        



        $i = 0;
        foreach ($departments as $department) {
            //$io->out($departments[$i]->name);
            $data[$i]['name'] = $department->name;

            $data[$i]['total'] = $UsersTable->find('all', [
                'fields' => ['id', 'username', 'firstname', 'lastname', 'is_active', 'is_deleted', 'department_id'],
                 'conditions' => ['is_deleted' => false
                                , 'department_id' => $department->id]
            ])->count();

            $data[$i]['leave'] = $TimesheetsTable->find()->select('user_id')
                ->contain(['Users' => ['fields' => ['department_id']]])
                ->where([
                    'Users.department_id' => $department->id, 'start_date >=' => $from, 'start_date <=' => $to
                    //, 'start_time <=' => FrozenTime::now()->format('H:i:s')
                    , 'on_leave' => true
                ])->count();

            $data[$i]['miss'] = $TimesheetsTable->find()->select('user_id')
                ->contain(['Users' => ['fields' => ['department_id']]])
                ->where([
                    'Users.department_id' => $department->id, 'start_date >=' => $from, 'start_date <=' => $to, 'start_time IS NULL', 'on_leave' => false
                    //'Users.department_id' => $departments[$i]->id, 'start_date' => FrozenDate::today()->format('Y-m-d'), 'start_time <=' => FrozenTime::now()->format('H:i:s'), 'on_leave' => false, 'Timesheets.health_id' => 2
                ])->count();

            $data[$i]['WFH'] = $TimesheetsTable->find()->select('user_id')
                ->contain(['Users' => ['fields' => ['department_id']]])
                ->where([
                    'Users.department_id' => $department->id, 'start_date >=' => $from, 'start_date <=' => $to
                    //, 'start_time <=' => FrozenTime::now()->format('H:i:s')
                    , 'ts_location_id' => 1
                ])->count();
            $data[$i]['Office'] = $TimesheetsTable->find()->select('user_id')
                ->contain(['Users' => ['fields' => ['department_id']]])
                ->where([
                    'Users.department_id' => $department->id, 'start_date >=' => $from, 'start_date <=' => $to
                    //, 'start_time <=' => FrozenTime::now()->format('H:i:s')
                    , 'ts_location_id' => 2
                ])->count();
            $data[$i]['Off-Shore'] = $TimesheetsTable->find()->select('user_id')
                ->contain(['Users' => ['fields' => ['department_id']]])
                ->where([
                    'Users.department_id' => $department->id, 'start_date >=' => $from, 'start_date <=' => $to
                    //, 'start_time <=' => FrozenTime::now()->format('H:i:s')
                    , 'ts_location_id' => 3
                ])->count();
                 
            $data[$i]['good'] = $UsersTable->find()->select(['id', 'username', 'health_id', 'vaccination_id'])
                //->contain(['Users' => ['fields' => ['department_id']]])
                ->where([
                    'department_id' => $department->id, 'health_id' => 1, 'is_deleted' => false
                ])->count();
                
            $data[$i]['symtom'] = $UsersTable->find()->select(['id', 'username', 'health_id', 'vaccination_id'])
                //->contain(['Users' => ['fields' => ['department_id']]])
                ->where([
                    'department_id' => $department->id, 'health_id' => 2, 'is_deleted' => false
                ])->count();


            $data[$i]['Fx'] = $UsersTable->find()->select(['id', 'username', 'health_id', 'vaccination_id'])
                //->contain(['Users' => ['fields' => ['department_id']]])
                ->where([
                    'department_id' => $department->id, 'health_id' => 3, 'is_deleted' => false
                ])->count();
              
            $data[$i]['suspected'] = $UsersTable->find()->select(['id', 'username', 'health_id', 'vaccination_id'])
                //->contain(['Users' => ['fields' => ['department_id']]])
                ->where([
                    'department_id' => $department->id, 'health_id' => 4, 'is_deleted' => false
                ])->count();

            $data[$i]['F0'] = $UsersTable->find()->select(['id', 'username', 'health_id', 'vaccination_id'])
                //->contain(['Users' => ['fields' => ['department_id']]])
                ->where([
                    'department_id' => $department->id, 'health_id' => 5, 'is_deleted' => false
                ])->count();
            $data[$i]['NotYet'] = $UsersTable->find()->select(['id', 'username', 'health_id', 'vaccination_id'])
                //->contain(['Users' => ['fields' => ['department_id']]])
                ->where([
                    'department_id' => $department->id, 'vaccination_id' => 1, 'is_deleted' => false
                ])->count();
            $data[$i]['1shot'] = $UsersTable->find()->select(['id', 'username', 'health_id', 'vaccination_id'])
                //->contain(['Users' => ['fields' => ['department_id']]])
                ->where([
                    'department_id' => $department->id, 'vaccination_id' => 2, 'is_deleted' => false
                ])->count();
            $data[$i]['2shot'] = $UsersTable->find()->select(['id', 'username', 'health_id', 'vaccination_id'])
                //->contain(['Users' => ['fields' => ['department_id']]])
                ->where([
                    'department_id' => $department->id, 'vaccination_id' => 3, 'is_deleted' => false
                ])->count();

            $data[$i]['detail'] = $UsersTable->find('all', [
                'fields' => ['id', 'firstname', 'lastname', 'is_deleted', 'is_active', 'department_id']
                , 'contain' => ['Timesheets' => ['conditions' => ['start_date >=' => $from, 'start_date <=' => $to, 'start_time IS NULL', 'on_leave' => false]]]
                    
                , 'conditions' => [
                    'is_deleted' => false
                    //,'is_active' => true
                    ,'department_id' => $department->id                                              
                ], 'order' => ['Users.name' => 'ASC']
            ])->all();

            $i++;
        }

        return $data;
    }

    private function enqueueEmails($data, $from_date, $to_date){
        $UsersTable = $this->getTableLocator()->get('Users');
     
        //$HSE_Man = $UsersTable->getOneByRole(7);
        //$HRs = $UsersTable->getAllByRole(1);
        $ADM_Man = $UsersTable->getOneByRole(8);

        //$mailer->setProfile('WFH');
        
        $to = [$ADM_Man->email];
        //$to = ['thanh@hlhvjoc.com.vn'];
        $cc = ['thanh@hlhvjoc.com.vn'];
        
       
        $emailData = ['data' => $data, 'from_date' => $from_date, 'to_date' => $to_date];
        $options = [
            'subject' => 'WFH Record: Weekly Detail Report',
            'layout' => 'eoffice',
            'template' => 'wfh_weekly_detail_report',
            'format' => 'html',
            'config' => 'eoffice-cli',
            'from_name' => 'e.Office',
            'from_email' => 'e.office@hlhvjoc.com.vn'
        ];

        EmailQueue::enqueue($to, $cc, $emailData, $options);
    }

}
