<?php

namespace App\Command;

use App\Model\Table\DocStatusesTable;
use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\I18n\FrozenDate;
use Cake\I18n\FrozenTime;
use Cake\Mailer\Mailer;
use Cake\Console\ConsoleOptionParser;
use Cake\Datasource\ConnectionManager;
use EmailQueue\EmailQueue;

class DasRemindUploadCommand extends Command
{
    const ALLOW_PENDING_DAYS = 14;

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
        $last_allowed_date = $today->subDays(DasRemindUploadCommand::ALLOW_PENDING_DAYS);
        $io->out($last_allowed_date->format('Y-m-d'));

        $DeptTable = $this->getTableLocator()->get('Departments');

        $DocOutTable = $this->getTableLocator()->get('DocOutgoings');
        $DocIntTable = $this->getTableLocator()->get('DocInternals');

        $depts = $DeptTable->find('all', [
            'contain' => ['Managers' => ['fields' => ['Managers.id', 'Managers.firstname', 'Managers.lastname', 'Managers.email']
                ]],
            
        ]);

        foreach ($depts as $dept) {
            $incompleteDocOuts = $DocOutTable->find('all', [
                'contain' => [
                                'Originators' => ['fields' => ['Originators.id', 'Originators.firstname', 'Originators.lastname', 'Originators.email']],
                                'Inputters' => ['fields' => ['Inputters.id', 'Inputters.firstname', 'Inputters.lastname', 'Inputters.email']],
                                'DocStatuses' => ['fields' => ['DocStatuses.id', 'DocStatuses.name']]
                            ],
                'conditions' => [
                    'OR' => [
                        [
                            'doc_status_id' => DocStatusesTable::S_IN_PROGRESS,
                            'DocOutgoings.department_id' => $dept->id,
                            'reg_date <' => $last_allowed_date->format('Y-m-d'),
                        ],
                        [
                            'doc_status_id' => DocStatusesTable::S_DISTRIBUTED,
                            'DocOutgoings.department_id' => $dept->id,
                            'reg_date <' => $last_allowed_date->format('Y-m-d'),
                            'doc_file IS NULL'
                        ]
                    ]

                ]
            ]);


            $incompleteDocInts = $DocIntTable->find('all', [
                'contain' => [
                    'Originators' => ['fields' => ['Originators.id', 'Originators.firstname', 'Originators.lastname', 'Originators.email']],
                    'Inputters' => ['fields' => ['Inputters.id', 'Inputters.firstname', 'Inputters.lastname', 'Inputters.email']],
                    'DocStatuses' => ['fields' => ['DocStatuses.id', 'DocStatuses.name']]
                ],
                'conditions' => [
                    'OR' => [
                        [
                            'doc_status_id' => DocStatusesTable::S_IN_PROGRESS,
                            'DocInternals.department_id' => $dept->id,
                            'reg_date <' => $last_allowed_date->format('Y-m-d'),
                        ],
                        [
                            'doc_status_id' => DocStatusesTable::S_DISTRIBUTED,
                            'DocInternals.department_id' => $dept->id,
                            'reg_date <' => $last_allowed_date->format('Y-m-d'),
                            'doc_file IS NULL'
                        ]
                    ]
                ]
            ]);

            if ($incompleteDocInts->count() > 0 || $incompleteDocOuts->count() > 0) {
                $this->enqueueReminder($dept, $incompleteDocOuts, $incompleteDocInts, $io);
                //$io->out($incompleteDocInts->toArray());
            }
        }
    }

    private function enqueueReminder($dept, $docOuts, $docInts, ConsoleIo $io)
    {
        $to = array();
        $cc = [$dept->manager->email];
        $data['department'] = $dept->name;
        $data['manager'] = $dept->manager->name;
        $data['docOuts'] = array();
        $data['docInts'] = array();

        $options = [
            'subject' => '[e-Office DAS] Remind Pending Documents',
            'layout' => 'eoffice',
            'template' => 'das_remind_pending_doc',
            'format' => 'html',
            'config' => 'eoffice-cli',
            'from_name' => 'e.Office',
            'from_email' => 'e.office@hlhvjoc.com.vn'
        ];

        $io->out();

         foreach ($docOuts as $docOut){
            $doc['id'] = $docOut->id;
            $doc['reg_date'] = $docOut->reg_date->format('Y-m-d');
            $doc['reg_text'] = $docOut->reg_text;
            $doc['subject'] = $docOut->subject;
            $doc['originator'] = $docOut->originator->name;
            $doc['inputter'] = $docOut->inputter->name;
            $doc['status'] = $docOut->doc_status->name;
            $doc['upload']  = $docOut->doc_file?'': 'No';

            $to[] = $docOut->inputter->email;
            $data['docOuts'][] = $doc;
        
        //    $io->out($doc);
         }

         foreach ($docInts as $docInt){
            $doc['id'] = $docInt->id;
            $doc['reg_date'] = $docInt->reg_date;
            $doc['reg_text'] = $docInt->reg_text;
            $doc['subject'] = $docInt->subject;
            $doc['originator'] = $docInt->originator->name;
            $doc['inputter'] = $docInt->inputter->name;
            $doc['status'] = $docInt->doc_status->name;
            $doc['upload']  = $docInt->doc_file?'': 'No';

            $to[] = $docInt->inputter->email;
            $data['docInts'][] = $doc;
        
        //    $io->out($doc);
         }

         //$io->out($data);
        // debug($data);
        EmailQueue::enqueue($to, $cc, $data, $options);
        
    }
}
