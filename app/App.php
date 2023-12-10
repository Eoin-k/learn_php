<?php

declare(strict_types = 1);

// Your Code
function getTransactionFiles(string $dirpath): array {
    $files =[];
    foreach(scandir($dirpath) as $file){
        if(is_dir($file)){
            continue;
        }
        $files[] = $dirpath . $file;
        
    }
    return $files;
}

function gettransactions(string $filename): array{
    if (! file_exists($filename)){
        trigger_error('File "' . $filename . '" Does Not Exist. ', E_USER_ERROR);
    }
    $file = fopen($filename, 'r');
    fgetcsv($file);
    $transactions = [];
    while (($transaction = fgetcsv($file)) != false){
        $transactions[] = extractTransactions($transaction);
    }
    return $transactions;
}

function extractTransactions(array $transactionRow): array{
   
    [$date,$check,$description,$amount] = $transactionRow;

    $amount = (float) str_replace(['$', ','],'', $amount);

    return [
        'date' => $date,
        'checkNumber' => $check, 
        'description' => $description,
        'amount' => $amount,
    ];
}

function calculateTotals(array $transactions): array {
    $totals = ['netTotal' => 0, 'totalIncome' => 0, 'totalExpense' => 0];

    foreach($transactions as $transaction){
        $totals['netTotal'] += $transaction['amount'];
        if($transaction['amount'] >= 0) {
            $totals['totalIncome'] += $transaction['amount'];
        } else {
            $totals['totalExpense'] += $transaction['amount'];
        }
    }
    return $totals; 
    
}