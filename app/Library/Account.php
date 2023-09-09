<?php

namespace App\Library;


use App\Models\Transaction;
use DB;

class Account

{

    var $user_id, $user_type, $table;
    public function __construct($user_id, $user_type)
    {
        $this->user_id = $user_id;
        $this->user_type = $user_type;
        $this->table = $this->transactionTable();
    }

    //For check the account balance.
    public function balance()
    {
        $transaction = $this->table->where('payment_status', 'Success')->orderBy('id', 'desc')->first();
        return ($transaction) ? $transaction->balance : 0 ;
    }

    //For transaction logs of account.
    public function logs()
    {
        $transactions = $this->table->where('user_type', $this->user_type)->where('payment_status', 'Success')->orderBy('id', 'desc')->get();
        return $transactions;
    }
    
    public function cashback()
    {
        // dd($this->user_type);
        $transactions = $this->table->where('user_type', $this->user_type)->where('payment_status', 'Success')->whereIn('payment_type', ["Referral", "Order Cashback", "Profit Share"])->get();
        // if ($this->user_type == 'User' || $this->user_type == 'Vendor') {
        //     $transactions = $transactions->orWhere(function($query) {
        //                         $query->where('payment_type', 'Order Cashback');
        //                     });
        // }
        // $transactions = $transactions->orWhere(function($query) {
        //                         $query->where('payment_type', 'Profit Share');
        //                     })->get();
        // dd($transactions );
        $total = 0;
        foreach ($transactions as $value) {
            
            if ($value->trans_type == 'Credit') {
                $total += floatval($value->amount);
            }
            if ($value->trans_type == 'Debit') {
                $total -= floatval($value->amount);
            }
        }
        return  $total;
    }

    //For create object of trasaction table.
    private function transactionTable()
    {
        $table = Transaction::where('user_type', $this->user_type);
        if (ucfirst($this->user_type) != 'Admin') {

            //Admin field is always NULL or Zero.
            $table = $table->where('user_id', $this->user_id);
        }
        //Fetch the latest successfull transaction.
        return $table->where('user_type', $this->user_type);
    }
    
}

