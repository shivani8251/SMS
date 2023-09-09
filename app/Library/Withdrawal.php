<?php

namespace App\Library;


use App\Models\Transaction as TransactionTable;
use App\Models\Account as BankDetail;
use App\Library\Account;
use DB;

class Withdrawal

{

    var $user_id, $user_type;
    public function __construct($user_id, $user_type)
    {
    	//Transaction Through
        $this->user_id = $user_id;
        $this->user_type = $user_type;
    }

    public function request($amount, $transaction_id)
    {

        //Get Account Details
        $bankAccount = BankDetail::where('user_id', $this->user_id)->where('user_type', $this->user_type)->where('is_active', 'Yes')->first();

        //Collect data for transaction table.
        $data = [
                'request_number' => $transaction_id,
                'requested_at' => date('Y-m-d H:i:s'),
                'user_id' => $this->user_id,
                'user_type' => $this->user_type,
                'amount' => $amount,
                'account_number' => $bankAccount->number,
                'ifsc_code' => $bankAccount->ifsc,
                'beneficiary_name' => $bankAccount->beneficiary,
                'status' => 'Pending',
                'created_at' => date('Y-m-d H:i:s')
            ];

        $responce = DB::table('transaction_withdrwal_request')->insertGetId($data);
        return $responce;
    }

    public function cancel($withdrawal_id)
    {
        //Get Withdrwal Request Details
        $withdrwal_request = DB::table('transaction_withdrwal_request')->where('id', $withdrawal_id)->where('user_id', $this->user_id)
                    ->where('user_type', $this->user_type)->first();

        //Collect data for transaction table.
        $data = [
                'status' => 'Canceled',
                'updated_at' => date('Y-m-d H:i:s')
            ];

        $responce = DB::table('transaction_withdrwal_request')->where('id', $withdrawal_id)->update($data);
        return $responce;
    }

    public function reject($withdrawal_id)
    {
        //Get Withdrwal Request Details
        $withdrwal_request = DB::table('transaction_withdrwal_request')->where('id', $withdrawal_id)->where('user_id', $this->user_id)
                    ->where('user_type', $this->user_type)->first();

        //Collect data for transaction table.
        $data = [
                'status' => 'Rejected',
                'updated_at' => date('Y-m-d H:i:s')
            ];

        $responce = DB::table('transaction_withdrwal_request')->where('id', $withdrawal_id)->update($data);
        return $responce;
    }

}

