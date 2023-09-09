<?php

namespace App\Library;


use App\Models\Account as BankDetail;
use DB;

class BankDetails

{

    var $user_id, $user_type, $table;
    public function __construct($user_id, $user_type)
    {
        $this->user_id = $user_id;
        $this->user_type = $user_type;
        $this->table = $this->bankTable();
    }

    //For add bank details.
    public function add($request)
    {
        $data = [
                    'user_id' => $this->user_id,
                    'user_type' => $this->user_type,
                    'bank' => $request->bank_name,
                    'number' => $request->account_number,
                    'ifsc' => $request->ifsc_code,
                    'beneficiary' => $request->beneficiary_name,
                    'rzp_fund_id' => NULL,
                    'rzp_contact_id' => NULL,
                    'created_at' => date('Y-m-d H:i:s'),
                ];
        $responce = BankDetail::create($data);
        if ($responce) {
            unset($responce['user_id']);
            unset($responce['user_type']);
        }
        return $responce;
    }

    //For get bank details.
    public function update($request)
    {
        $data = BankDetail::findOrFail($request->account_id);
        
        $data->updated_at = date('Y-m-d H:i:s');

        if ($request->bank_name != NULL and $request->bank_name != "") {
            $data->bank = $request->bank_name;
        }
        if ($request->account_number != NULL and $request->account_number != "") {
            $data->number = $request->account_number;
        }
        if ($request->ifsc_code != NULL and $request->ifsc_code != "") {
            $data->ifsc = $request->ifsc_code;
        }
        if ($request->beneficiary_name != NULL and $request->beneficiary_name != "") {
            $data->beneficiary = $request->beneficiary_name;
        }

        $data->rzp_fund_id = ($request->rzp_fund_id != NULL and $request->rzp_fund_id != "") ? $request->rzp_fund_id : NULL ;
        $data->rzp_contact_id = ($request->rzp_contact_id != NULL and $request->rzp_contact_id != "") ? $request->rzp_contact_id : NULL ;

        $responce = false;
        if ($data->save()) {
            $responce = BankDetail::findOrFail($request->account_id);
            unset($responce['user_id']);
            unset($responce['user_type']);
        }
        return $responce;
    }
    
    //For get bank details.
    public function fund_id_update($rzp_fund_id, $rzp_contact_id)
    {
        $bankID = $this->table->value('id');
        $data = BankDetail::findOrFail($bankID);
        
        $data->updated_at = date('Y-m-d H:i:s');

        if ($rzp_fund_id != NULL and $rzp_fund_id != "") {
            $data->rzp_fund_id = $rzp_fund_id;
        }
        if ($rzp_contact_id != NULL and $rzp_contact_id != "") {
            $data->rzp_contact_id = $rzp_contact_id;
        }

        if ($responce = $data->save()) {
            return $responce;
        }
        return false;
    }

    //For create object of bank account table.
    private function bankTable()
    {
        $table = BankDetail::where('user_type', $this->user_type);
        if (ucfirst($this->user_type) != 'Admin') {

            //Admin field is always NULL or Zero.
            $table = $table->where('user_id', $this->user_id);
        }
        //Fetch the latest successfull transaction.
        return $table->where('user_type', $this->user_type);
    }
    
}

