<?php

namespace App\Library;


use App\Models\TempTransaction as TempTransactionTable;
use DB;

class TempProfitTransaction

{

    var $traget_type;
    public function __construct($traget_type = '')
    {
        //Transaction Target
        $this->traget_type = $traget_type;
    }

    public function credit($amount, $payment_type, $payment_status = 'Pending', $transaction_id = '', $remarks = '')
    {
        $balance = $this->checkBalance($this->traget_type);
        $total_balance = floatval($balance) + floatval($amount);

        if ($transaction_id == '') {
            $transaction_id = $this->transactionID($this->user_id);
        }

        //Collect data for transaction table.
        $transData['transaction_id'] =  $transaction_id;
        $transData['transaction_date_time'] =  date('Y-m-d H:i:s');
        if ($this->traget_type != NULL and $this->traget_type != '') {
            $transData['target_type'] = $this->traget_type;
        }
        if ($remarks == '') {
            $remarks = $this->makeRemarks($amount, $payment_type, 'Credit', $this->traget_type);
        }
        
        $transData['payment_type'] = $payment_type;
        $transData['trans_type'] = 'Credit';
        $transData['amount'] = $amount;
        $transData['balance'] =  $total_balance;
        $transData['payment_status'] = $payment_status;
        $transData['remarks'] = $remarks;
        $transData['created_at'] =  date('Y-m-d H:i:s');
        $responce = TempTransactionTable::create($transData);
        return $responce;
    }


    private function makeRemarks($amount, $purpose, $trans_type = 'Credit', $traget_type){
 
        $trans_type = ($trans_type == 'Credit') ? 'credited to' : 'debited from' ;
        $remarks = '';
        if ($purpose == 'Add Money') {
            $remarks = '#'.number_format($amount, 2).' rupees '.$trans_type.' temp wallet.';
        }elseif ($purpose == 'Referral') {
            $remarks = '#'.number_format($amount, 2).' rupees referral money '.$trans_type.' temp wallet.';
        }elseif ($purpose == 'Withdrawal' and $trans_type == 'debited from') {
            $remarks = '#'.number_format($amount, 2).' rupees withdrawal request generated.';
            if ($traget_type == 'Admin') {
                $remarks = '#'.number_format($amount, 2).' rupees withdrawal request canceled.';
            }
        }elseif ($purpose == 'Withdrawal' and $trans_type == 'credited to') {
            $remarks = '#'.number_format($amount, 2).' rupees withdrawal request canceled.';
        }elseif ($purpose == 'Order') {
            $remarks = '#'.number_format($amount, 2).' rupees for an order '.$trans_type.' temp wallet.';
        }elseif ($purpose == 'Transfer') {
            $remarks = '#'.number_format($amount, 2).' rupees transfer amount '.$trans_type.' temp wallet.';
        }elseif ($purpose == 'Profit Share') {
            $remarks = '#'.number_format($amount, 2).' rupees profit share '.$trans_type.' temp wallet.';
        }elseif ($purpose == 'Membership') {
            $remarks = '#'.number_format($amount, 2).' rupees membership amount '.$trans_type.' temp wallet.';
        }elseif ($purpose == 'Order Cashback') {
            $remarks = '#'.number_format($amount, 2).' rupees for an order cashback '.$trans_type.' temp wallet.';
        }
        return $remarks; 
    }

    private function checkBalance($traget_type){

        $balance = TempTransactionTable::where('target_type', $traget_type)->where('payment_status', 'Success')->value('balance');
        return ($balance) ? $balance : 0 ;
    }
    private function transactionID($user_id = 0){

        $transaction_id = date("ymd", strtotime(date('Y-m-d'))).$user_id.mt_rand(10,99).time();
        return $transaction_id;
    }

}

