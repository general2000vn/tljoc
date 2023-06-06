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
use Cake\Filesystem\File;
use Cake\Filesystem\Folder;
use DateTime;

class FixDasDocFileCommand extends Command
{
    protected function buildOptionParser(ConsoleOptionParser $parser): ConsoleOptionParser
    {
        $parser
            ->addArgument('doc_type', [
                'help' => 'out : for Outgoing' . 'int : for Internal' . 'in : for Incoming'
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
               
        $argType = $args->getArgument('doc_type');

        if (is_null($argType) || $argType == '') {
            $io->out('Missing argument');
            
            return; //must specify type
        }

        
        $this->fix($io, $argType);
        
    }

    private function fix(ConsoleIo $io, String $argType){
        $io->out('Start fixing ....');

        if ($argType == 'in') {
            $io->out('Fix Incoming ...' . WWW_ROOT .  'uploads' . DS . 'doc_incoming' . DS);
            $folder = WWW_ROOT .  'uploads' . DS . 'doc_incoming' . DS;
            $DocTable = $this->getTableLocator()->get('DocIncomings');
        }

        if ($argType == 'out') {
            $io->out('Fix Outgoing ...' . WWW_ROOT .  'uploads' . DS . 'doc_outgoing' . DS);
            $DocTable = $this->getTableLocator()->get('DocOutgoings');
            $folder = WWW_ROOT .  'uploads' . DS . 'doc_outgoing' . DS;
        }

        if ($argType == 'int') {
            $io->out('Fix Internal ...' . WWW_ROOT .  'uploads' . DS . 'doc_internal' . DS);
            $DocTable = $this->getTableLocator()->get('DocInternals');
            $folder = WWW_ROOT .  'uploads' . DS . 'doc_internal' . DS;
        }
        $allDocs = $DocTable->find('all', ['fields' => ['id', 'reg_date','reg_num', 'doc_file']]);
        
        $count = 0;
        $countFixed = 0;
        foreach ($allDocs as $doc){
            $count++;
            //$io->out($doc->doc_file);
            if (!is_null($doc->doc_file) && ($doc->doc_file != "")){
                $sCheck = strval($doc->reg_num) . "-";
                $iLength = strlen($sCheck);
                $posNum = strpos($doc->doc_file, $sCheck);
                $new_doc_file = $doc->reg_date->format('y-') . sprintf('%04d', $doc->reg_num)  . '-' . substr($doc->doc_file, $posNum + $iLength);
                
                
                
                
                if ($doc->doc_file != $new_doc_file){
                    $countFixed++;
                    $io->out('');
                    $io->out('#: '. $countFixed);
                    $io->out('pos: '. $posNum);
                    $io->out('Old: ' . $doc->doc_file);
                    $io->out('New: '. $new_doc_file);
                    if ($this->replaceFile($folder, $doc->doc_file, $new_doc_file, $io)) {
                        $doc->doc_file = $new_doc_file;
                        $DocTable->save($doc);
                    }
                    
                    
                }
                
            }          

        }

        $io->out('');
        $io->out('count: ' . $count);
        $io->out('Fixed: ' . $countFixed);
    }

    private function replaceFile(string $path, string $old, string $new, ConsoleIo $io){
        $io->out('Expecting: ' . $path . $old);

        $oFile = new File($path . $old, false);
        

        if ($oFile->exists()){
            $io->out('Old file exists');
            if ($oFile->copy($path . $new, false)){$io->out('Copied: ' . $path . $new); }
            if ( $oFile->delete()){$io->out('Deleted old file'); }
            
            $io->out('Replaced');
            return true;
        } else {
            $io->out('FILE DOES NOT exist: ' . $oFile->name);
            return false;
        }
    }


    
}
