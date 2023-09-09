<?php

namespace App\Library;

use App\Models\BankAccount;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Management;

use App\Library\BankDetails;

class Payout

{

    var $user_id, $user_type,

    // your api key.
    $api_key = 'rzp_test_b78HuWmhtiyQx7',  

    // your secret key.
    $api_secret = 'pLXry2qDB644A1yVlQMywspr',

    //razorpay account number.
    $rzp_account_number = '2323230017426140';

    public function __construct($user_id, $user_type)
    {
        $this->user_id = $user_id;
        $this->user_type = $user_type;
    }

    public function make($amount = 0, $transaction_id = '', $payment_type = 'Withdrawal', $remarks = '')
    {
        $remarks = ($remarks != '') ? $remarks : $payment_type ;

        $bankAccount = $this->bankAccount();

        $user = $this->user();

        //Validation required fields.
        if (is_numeric($amount) && $amount <= 0) {
            return json_encode(['error' => true, 'message' => 'The minimum payout amount is one rupees!']);
        }

        if ($transaction_id == '' && $transaction_id == null) {
            return json_encode(['error' => true, 'message' => 'Transaction ID required!']);
        }

        if ($bankAccount == null && $bankAccount == '' && !isset($bankAccount)) {
            return json_encode(['error' => true, 'message' => 'Bank account not found!']);
        }

        if ($user == null && $user == '' && !isset($user)) {
            return json_encode(['error' => true, 'message' => 'User not found!']);
        }

        $response = $this->create_payout($amount, $transaction_id, $bankAccount, $user, $remarks);

        $payoutResponce = json_decode($response, true);

        //If new bank account update fund accout id.
        if (isset($payoutResponce['fund_account'])) {

            $this->updateBankAccount($payoutResponce);
        }
        return $response;
    }   

    //This Function create a payout.
    private function create_payout($amount, $transaction_id, $bankAccount, $user, $remarks)
    {
        $amount = floatval($amount)*100;

        //The common data for make a payout.
        $data= [

                    "account_number"=> $this->rzp_account_number, 
                    "currency"=> "INR", 
                    "amount"=> $amount,
                    "mode"=> "NEFT", //NEFT, RTGS, IMPS
                    "purpose"=> "payout", //refund, cashback, payout, salary, utility bill, vendor bill
                    "queue_if_low_balance"=> true,
                    "reference_id"=> $transaction_id, 
                    "narration"=> "OPAN App Fund Transfer", 
                    "notes"=> [
                        "notes_key_1"=> $remarks, 
                    ]
                ];

        //If user already have the rzp_fund_id then quick payout.
        if ($bankAccount->rzp_fund_id != '' && $bankAccount->rzp_fund_id != null) {

            $data += [ "fund_account_id"=> $bankAccount->rzp_fund_id ];

        }
        //If user doesn't have rzp_fund_id then with bank account details.
        else{

            $data += [ 
                    
                    "fund_account"=> [
                        "account_type"=> "bank_account",
                        "bank_account"=> [
                            "name"=> $bankAccount->beneficiary,
                            "ifsc"=> $bankAccount->ifsc,
                            "account_number"=> $bankAccount->number
                        ],
                        "contact"=> [
                            "name"=> $user->name,
                            "email"=> $user->email, //optional
                            "contact"=> $user->phone, //optional
                            "type"=> $this->user_type(), //optional
                        ]
                    ],
                    
                ];
        }

        $dataString = json_encode($data);
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, "https://api.razorpay.com/v1/payouts");
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20); 
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $this->api_key.':'.$this->api_secret);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Accept: application/json', 'Content-Type: application/json')
        );

        return curl_exec($ch); $returnCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE); curl_close($ch);
    }

    public function trasaction_status($payout_id)
    {
        if ($payout_id!='' && $payout_id!=null) {

            $ch = curl_init(); 
            curl_setopt($ch, CURLOPT_URL, "https://api.razorpay.com/v1/transactions?account_number=".$this->rzp_account_number);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20); 
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_USERPWD, $this->api_key.':'.$this->api_secret);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); 
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Accept: application/json', 'Content-Type: application/json')
            );

            $result = curl_exec($ch); $returnCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE); curl_close($ch);
            //convert to array.
            $order = json_decode($result ,true);

            $items = $order['items'];

            foreach ($items as $value) {

                //If payout id match the trasaction id.
                if ($value['source']['id'] == $payout_id) {
                    
                    //return status.   
                    return $value['source']['status'];
                }
            }
        }
        return false;
    }

    //User Type Accept By RazorPay.
    private function user_type()
    {
        //customer, vendor, employee, self
        return ($this->user_type == 'User') ? 'customer' : ( ($this->user_type == 'Vendor') ? 'vendor' : 'employee' ) ;
    }

    //For create object of bank account table.
    private function bankAccount()
    {
        $table = BankAccount::where('user_type', $this->user_type);
        if (ucfirst($this->user_type) != 'Admin') {

            //Admin field is always NULL or Zero.
            $table = $table->where('user_id', $this->user_id);
        }
        //Fetch the latest successfull transaction.
        return $table->where('user_type', $this->user_type)->active()->first();
    }

    //Update bank account fund id.
    private function updateBankAccount($payoutResponce){
        
        $fundID = $payoutResponce['fund_account']['id'];
        $contactID = $payoutResponce['fund_account']['contact_id'];   
        
        $bankDetails = new BankDetails($this->user_id, $this->user_type);
        return $bankDetails->fund_id_update($fundID, $contactID);
    }

    //Get the user.
    private function user()
    {
        return ($this->user_type == 'User') ? User::find($this->user_id) : ( ($this->user_type == 'Vendor') ? Vendor::find($this->user_id) : Management::where(['user_id' => $this->user_id, 'user_type' => $this->user_type])->first() ) ; 
    }
}

