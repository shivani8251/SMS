<?php

namespace App\Library;


use App\Models\Transaction as TransactionTable;
use App\Library\Account;
use DB;

class UniqTransID

{

    var $user_id, $user_type, $table;
    public function __construct($user_id = '', $user_type = '')
    {
    	//Transaction Through
        $this->user_id = $user_id;
        $this->user_type = $user_type;
        $this->table = $this->getTable();
    }

    public function getNormalID(){

        $IDs = [];
        $trasactionIDs = [];
        foreach ($this->table as $value) {

            if (!in_array($value->transaction_id, $trasactionIDs)) {
                array_push($trasactionIDs, $value->transaction_id);
                array_push($IDs, $value->id);
            }
        }
        return $IDs;
    }

    public function getTransID(){

        $trasactionIDs = [];
        foreach ($this->table as $value) {

            if (!in_array($value->transaction_id, $trasactionIDs)) {
                array_push($trasactionIDs, $value->transaction_id);
            }
        }
        return $trasactionIDs;
    }

    private function getTable(){

        $table = TransactionTable::where('user_id', $this->user_id)->where('user_type', $this->user_type)->orderBy('id', 'asc')->get();
        return $table;
    }

    public function getall(){
        $data = TransactionTable::orderBy('id', 'asc')->get();

        $trasactionIDs = [];
        foreach ($data as $value) {

            if (!in_array($value->transaction_id, $trasactionIDs)) {
                array_push($trasactionIDs, $value->transaction_id);
            }
        }
        return $trasactionIDs;
    }
}

