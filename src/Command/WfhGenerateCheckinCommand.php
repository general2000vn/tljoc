<?php

namespace App\Command;

use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\I18n\FrozenDate;
use Cake\I18n\FrozenTime;
use Cake\Mailer\Mailer;
use Cake\Console\ConsoleOptionParser;

class WfhGenerateCheckinCommand extends Command
{
    protected function buildOptionParser(ConsoleOptionParser $parser): ConsoleOptionParser
    {
        $parser
            ->addArgument('date', [
                'help' => 'YYYY-mm-dd : The date that you want to generate WFH record'
            ]);

        $parser->addOption('leave', ['short' => 'l'
                                    , 'boolean' => true
                                    , 'help' => 'Only generate record for on Leave staff']
                            );

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
        $bLeave = $args->getOption('leave');

        $io->out('Generating Timesheets for: ' . $theDate->format('Y-m-d') . ' ------------------');
        $this->generate($theDate->format('Y-m-d'), $bLeave, $io);
    }

    private function generate($stringDate, $bLeave = false, ConsoleIo $io)
    {

        $UsersTable = $this->getTableLocator()->get('Users');
        $TimesheetsTable = $this->getTableLocator()->get('Timesheets');

        if ($bLeave) {
            $users = $UsersTable->find('all', [
                'fields' => ['id', 'username', 'firstname', 'lastname', 'is_deleted', 'is_active', 'health_id', 'vaccination_id']
                , 'contain' => ['Timesheets' => ['conditions' => ['start_date' => $stringDate]]]
                    
                , 'conditions' => [
                    'is_deleted' => false
                    ,'is_active' => false
                    //,'department_id' => 7                                               
                ], 'order' => ['Users.name' => 'ASC']
            ])->all();
        } else {
            $users = $UsersTable->find('all', [
                                    'fields' => ['id', 'username', 'firstname', 'lastname', 'is_deleted', 'is_active', 'health_id', 'vaccination_id']
                                    , 'contain' => ['Timesheets' => ['conditions' => ['start_date' => $stringDate]]]
                                        
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

            if (empty($user->timesheets)) {
                //$this->Flash->warning($user->name . ' - no timesheet');
                
                $timesheet = $TimesheetsTable->newEmptyEntity();
                $timesheet->user_id = $user->id;
                
                $timesheet->start_date = $stringDate;

                if (!$user->is_active) {
                    //$this->Flash->warning($user->name . ' - on leave');
                    $leave++;
                    $io->out($leave . ' ------------ ' . $user->name . ' on_leave');
                    $timesheet->on_leave = true;
                }

                $aTimesheets[$i] = $timesheet;
                $i++;
                $io->out($i . ' --- ' . $user->name . ' has no record');
            } else {
                //$this->Flash->error($user->name . ' - has timesheet');
            }
        }
        $io->out('Generate records: ' . $i);
        $io->out('Leave:    ' . $leave);
        $TimesheetsTable->saveMany($aTimesheets);
    }
}
