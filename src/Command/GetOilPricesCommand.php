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
use Cake\I18n\FrozenTime;

class GetOilPricesCommand extends Command
{
    // protected function buildOptionParser(ConsoleOptionParser $parser): ConsoleOptionParser
    // {
    //     $parser
    //         ->addArgument('friday', [
    //             'help' => 'YYYY-mm-dd : The date of Friday that you want to generate report'
    //         ]);

    //     return $parser;
    // }
    
    public function execute(Arguments $args, ConsoleIo $io)
    {
        
        $data = $this->getPrice();

        $oilPricesTable = $this->getTableLocator()->get('OilPrices');
        $oilPrice = $oilPricesTable->newEmptyEntity();
        $oilPrice->update_date = FrozenDate::today();
        $oilPrice->update_time = FrozenTime::now();
        $oilPrice->update_timestamp = $data['timestamp'];
        $oilPrice->brent = number_format((1 / $data['rates']['BRENTOIL']), 2, '.', '');
        $oilPrice->wti = number_format((1 / $data['rates']['WTIOIL']), 2, '.', '');
        $oilPrice->usd = number_format($data['rates']['VND'], 1, '.', '');

        if ($oilPricesTable->save($oilPrice)){
            $io->out($oilPrice->update_time->format('Y-m-d h:i') . ' Save Oil Price successfully. Brent Oil: ' . $oilPrice->brent);
        } else {
            $io->out(FrozenTime::now()->format('Y-m-d h:i') . ' Error Saving Oil Price');
        }

        $io->out($data['rates']['VND']);
        $io->out($oilPrice->usd);
        

        

    }

    private function getPrice()
    {
        // set API Endpoint and API key 
        $endpoint = 'latest';
        $access_key = 'y9ju4d7tbdegaqc62ty9cn2joakva9rw3nk5ab7ulmgy4qrmathd55m1hu12';

        //https://www.commodities-api.com/api/latest?access_key=1ojwqdl57i309nnbdr6jg9yu30ai4fa7bbt9in9fyw0e6el8pgns202ki3pa&symbols=BRENTOIL,WTIOIL,VND
        
        // Initialize CURL:
        $ch = curl_init('https://www.commodities-api.com/api/'.$endpoint.'?access_key='.$access_key.'&symbols=BRENTOIL,WTIOIL,VND');
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Store the data:
        $json = curl_exec($ch);
        curl_close($ch);

        // Decode JSON response:
        $prices = json_decode($json, true);

        return $prices['data'];
    }

    

   
}
