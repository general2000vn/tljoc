<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */


echo 'Below is WFH Records report from ' .  $from . ' to ' . $to . "\r\n";
echo "- Check-in data unit is (/staff/day).\r\n";
echo "- Health data is data on report date.\r\n";

echo "\n";

echo str_pad('|', 20, " ", STR_PAD_LEFT) . str_pad('Total Staff |', 15, " ", STR_PAD_LEFT) . str_pad('Leave |', 9, " ", STR_PAD_LEFT) . str_pad('No Check-in |', 15, " ", STR_PAD_LEFT)
                    . str_pad('Good Health |', 15, " ", STR_PAD_LEFT) . str_pad('Has Symtom |', 14, " ", STR_PAD_LEFT) . str_pad('Fx Isolated |', 15, " ", STR_PAD_LEFT)
                    . str_pad('F0 Suspected |', 16, " ", STR_PAD_LEFT) . str_pad('F0 Confirmed |', 16, " ", STR_PAD_LEFT)
                    . "\r\n";
foreach ($data as $item){
    echo str_pad($item['name'], 20, " ", STR_PAD_LEFT) 
    . str_pad($item['total'], 15, " ", STR_PAD_LEFT)
    . str_pad($item['leave'], 9, " ", STR_PAD_LEFT)
    . str_pad($item['miss'], 15, " ", STR_PAD_LEFT)
    . str_pad($item['good'], 15, " ", STR_PAD_LEFT)
    . str_pad($item['symtom'], 14, " ", STR_PAD_LEFT)
    . str_pad($item['Fx'], 15, " ", STR_PAD_LEFT)
    . str_pad($item['suspected'], 16, " ", STR_PAD_LEFT)
    . str_pad($item['F0'], 16, " ", STR_PAD_LEFT)
    ."\r\n";
}

?>