<?php

namespace App\Command;

use App\Model\Entity\HrPTaskStatus;
use App\Model\Table\HrPtsTable;
use App\Model\Table\RolesTable;
use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\I18n\FrozenDate;
use Cake\I18n\FrozenTime;
use Cake\Mailer\Mailer;
use Cake\Console\ConsoleOptionParser;
use Cake\Datasource\ConnectionManager;
use EmailQueue\EmailQueue;
use Cake\Core\Configure;

class HrRemindTasksCommand extends Command
{
    public const T_PENDING = 1;
    public const T_INCOMPLETE = 2;

    protected function buildOptionParser(ConsoleOptionParser $parser): ConsoleOptionParser
    {
        /*$parser
            ->addArgument('date', [
                'help' => 'YYYY-mm-dd : The date that you want to Check Leave WFH record'
            ]);
            
        $parser->addOption('leave', ['short' => 'l'
                                    , 'boolean' => true
                                    , 'help' => 'Only generate record for on Leave staff']
                            );
        */
        return $parser;
    }

    public function execute(Arguments $args, ConsoleIo $io)
    {


        $today = FrozenDate::today();
        

        $HrPtsTable = $this->getTableLocator()->get('HrPts');
        $UsersTable = $this->getTableLocator()->get('Users');



        $incompleteHrPts = $HrPtsTable->findIncompletedTasks();
        $next_remind_date = $today->addDays(HrPtsTable::REMIND_DAY_COUNT);

        for ($i = 0; $i < count($incompleteHrPts); $i++) {
            $to = array();
            $cc = array();
            
            $io->out('Pts ID: ' . $incompleteHrPts[$i]->id);

            for ($j = 0; $j < count($incompleteHrPts[$i]->hr_pt_tasks); $j++) {
                $io->out('Task ID: ' . $incompleteHrPts[$i]->hr_pt_tasks[$j]->id);

                foreach ($incompleteHrPts[$i]->hr_pt_tasks[$j]->users as $user) {
                    $to[] = $user->email;
                    $io->out('Day diff #: ' . $today->diffInDays($incompleteHrPts[$i]->issued_date));

                    if ($today->diffInDays($incompleteHrPts[$i]->issued_date) >= HrPtsTable::CC_LM_DAY_COUNT){
                        $cc[] = $UsersTable->findLineManager($user->id)->email;
                        $io->out('CC LM: ');
                    }   
                    
                }
                
                //$incompleteHrPts[$i]->hr_pt_tasks[$j]->reminding_date = $next_remind_date;
            }

            $incompleteHrPts[$i]->setDirty('hr_pt_tasks', true);

            
            

            if (count($to) > 0) {
                $io->out('Enqueue ' . $j);
                $this->enqueueReminder($incompleteHrPts[$i], $to, $cc, HrRemindTasksCommand::T_INCOMPLETE);
            }

            $io->out(' ');
        }

        $HrPtsTable->saveMany($incompleteHrPts, ['associated' => ['HrPtTasks']]);


        $pendingHrPts = $HrPtsTable->findPendingTasks();
        $next_remind_date = $today->addDays(HrPtsTable::REMIND_PENDING_DAY_COUNT);

        for ($i = 0; $i < count($pendingHrPts); $i++) {
            $to = array();
            $cc = array();

            $io->out('Pts ID: ' . $incompleteHrPts[$i]->id);

            for ($j = 0; $j < count($pendingHrPts[$i]->hr_pt_tasks); $j++) {
                foreach ($pendingHrPts[$i]->hr_pt_tasks[$j]->users as $user) {
                    $to[] = $user->email;
                }

                //$pendingHrPts[$i]->hr_pt_tasks[$j]->reminding_date = $next_remind_date;
                $io->out('Task ID: ' . $incompleteHrPts[$i]->hr_pt_tasks[$j]->id);
            }

            $pendingHrPts[$i]->setDirty('hr_pt_tasks', true);

            if (count($to) > 0) {
                $io->out('Enqueue ' . $j);
                $this->enqueueReminder($pendingHrPts[$i], $to, $cc, HrRemindTasksCommand::T_PENDING);
            }

            $io->out(' ');
        }

        $HrPtsTable->saveMany($pendingHrPts, ['associated' => ['HrPtTasks']]);

    }



    private function enqueueReminder($hrPt, $to, $cc, $type)
    {


        // $data['staff'] = $hrPt->staff->name;
        // $data['last_date'] = $hrPt->last_date;
        // $data['o_last_date'] = $hrPt->o_last_date;
        // $data['pt_id'] = $hrPt->id;
        $data['hrPt'] = $hrPt;

        $UsersTable = $this->getTableLocator()->get('Users');
        $HR_Sup = $UsersTable->getOneByRole(RolesTable::R_HR_SUP);

        $cc[] = $HR_Sup->email;

        switch ($type) {
            case HrRemindTasksCommand::T_INCOMPLETE:
                $options = [
                    'subject' => '[e.Office HR] Remind incomplete tasks for Pre-Termination: ' . $hrPt->staff->name,
                    'layout' => 'eoffice',
                    'template' => 'hr_pt_remind_incomplete_task',
                    'format' => 'html',
                    'config' => 'eoffice-cli',
                    'from_name' => 'e.Office',
                    'from_email' => Configure::read('from_email')
                ];
                break;

            case HrRemindTasksCommand::T_INCOMPLETE:
            default:
                $options = [
                    'subject' => '[e.Office HR] Remind pending tasks for Pre-Termination: ' . $hrPt->staff->name,
                    'layout' => 'eoffice',
                    'template' => 'hr_pt_remind_pending_task',
                    'format' => 'html',
                    'config' => 'eoffice-cli',
                    'from_name' => 'e.Office',
                    'from_email' => Configure::read('from_email')
                ];
                break;
        }


        EmailQueue::enqueue($to, $cc, $data, $options);
    }
}
