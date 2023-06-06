<?php

namespace App\Command;

use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\I18n\FrozenDate;
use Cake\I18n\FrozenTime;
use Cake\Mailer\Mailer;
use Cake\Console\ConsoleOptionParser;
use Cake\Datasource\ConnectionManager;
use DateTime;

class WfhConfirmLeaveCommand extends Command
{
    protected function buildOptionParser(ConsoleOptionParser $parser): ConsoleOptionParser
    {
        $parser
            ->addArgument('date', [
                'help' => 'YYYY-mm-dd : The date that you want to Check Leave WFH record'
            ]);
        /*    
        $parser->addOption('leave', ['short' => 'l'
                                    , 'boolean' => true
                                    , 'help' => 'Only generate record for on Leave staff']
                            );
        */
        return $parser;
    }

    public function execute(Arguments $args, ConsoleIo $io)
    {
               
        $argDate = $args->getArgument('date');

        if ($argDate != '') {
            $theDate = new FrozenDate($argDate);
        } else {
            $theDate = new FrozenDate();
        }

        //$bLeave = $args->getOption('leave');
        $bLeave = true; //only concern about on leave staff

        $io->out('Confirming Leave Check-in for: ' . $theDate->format('Y-m-d') . ' ------------------');
        $this->confirmIHRP($theDate->format('Y-m-d'), $bLeave, $io);
        $this->confirmProfile($theDate->format('Y-m-d'), $bLeave, $io);
    }

    private function confirmProfile($stringDate, $bLeave = true, ConsoleIo $io)
    {

        $UsersTable = $this->getTableLocator()->get('Users');
        $TimesheetsTable = $this->getTableLocator()->get('Timesheets');

        if ($bLeave) {
            $users = $UsersTable->find('all', [
                'fields' => ['id', 'username', 'firstname', 'lastname', 'is_deleted', 'is_active', 'health_id', 'vaccination_id']
                , 'contain' => ['Timesheets' => ['conditions' => ['start_date' => $stringDate, 'start_time IS NULL']]]
                    
                , 'conditions' => [
                    'is_deleted' => false
                    ,'is_active' => false
                    //,'department_id' => 7                                               
                ], 'order' => ['Users.name' => 'ASC']
            ])->all();
        } else {
            $users = $UsersTable->find('all', [
                                    'fields' => ['id', 'username', 'firstname', 'lastname', 'is_deleted', 'is_active', 'health_id', 'vaccination_id']
                                    , 'contain' => ['Timesheets' => ['conditions' => ['start_date' => $stringDate, 'start_time IS NULL']]]
                                        
                                    , 'conditions' => [
                                        'is_deleted' => false //,'id' => 154
                                        //,'department_id' => 7                                               
                                    ], 'order' => ['Users.name' => 'ASC']
            ])->all();
        }
        

        $i = 0;
        $leave = 0;
        $aTimesheets = array();
        foreach ($users as $user) {

            if (!empty($user->timesheets)) {
                //$this->Flash->warning($user->name . ' - no timesheet');
                
                $timesheet = $user->timesheets[0];
                
                if (!$user->is_active) {
                    //$this->Flash->warning($user->name . ' - on leave');
                    $leave++;
                    $io->out($leave . '  ' . $user->name . ' on_leave');
                    $timesheet->on_leave = true;
                }

                $aTimesheets[$i] = $timesheet;
                $i++;
            } else {
                //$this->Flash->error($user->name . ' - has timesheet');
            }
        }
        $io->out('----- Profile On Leave:    ' . $leave);
        $TimesheetsTable->saveMany($aTimesheets);
    }

    private function confirmIHRP($stringDate, $bLeave = false, ConsoleIo $io)
    {

        $UsersTable = $this->getTableLocator()->get('Users');
        $TimesheetsTable = $this->getTableLocator()->get('Timesheets');

        $ihrp = ConnectionManager::get('ihrp');

        // 'SELECT
        //          LD.[DateID]
        //         ,LD.[LeaveRecordID]
        //         ,LD.[LeaveTaken]
        //         ,LD.[StatusRequest]
        //         ,LD.[IsPM]
        //         ,L.LeaveRecordID
        //         ,L.EmpID
        //         ,E.EmailCompany

        $sQuery = 'SELECT
                E.EmailCompany
                FROM [iHRP_HLHV].[dbo].[TS_tblLeaveRecordDetail] LD ,
                [iHRP_HLHV].[dbo].[TS_tblLeaveRecord] L ,
                [iHRP_HLHV].[dbo].[HR_vEmpList] E
                
                WHERE DateID = :theDate
                AND LD.LeaveRecordID = L.LeaveRecordID
                AND L.EmpID = E.EmpID
                AND L.IsApproved = 1
                ORDER BY EmailCompany DESC';

        $emails = $ihrp
        ->execute(
            $sQuery,
            ['theDate' => $stringDate],
            ['theDate' => 'datetime']
        )
        ->fetchAll('assoc');


        $aTimesheets = array();
        $iCount = 0;
        foreach ($emails as $email){
            
            //$io->out( ($iCount + 1) .'  '. $email['EmailCompany']);
            //debug($email);


/*
*/
            $user = $UsersTable->find('all', ['conditions' => ['email' => $email['EmailCompany']]
                                            , 'fields' => ['id', 'firstname', 'lastname',]
                                            , 'contain' => ['Timesheets' => ['conditions' => ['start_date' => $stringDate]]]
                                            , 'order' => ['Users.name' => 'ASC']
                                    ])->first();
            
            $io->out(($iCount + 1) . '  '. $user->name);

            $user->timesheets[0]->on_leave = true;
            $aTimesheets[$iCount] = $user->timesheets[0];

            

            $iCount++;
            
        }

        $TimesheetsTable->saveMany($aTimesheets);
        $io->out('----- iHRp Leave:    ' . $iCount);


        
    }
}
