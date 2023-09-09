<?php

namespace App\Library;


use App\Models\Transaction as TransactionTable;
use App\Library\Account;
use App\Library\Notification;
use App\Library\TransactionMessage;
use App\Library\Message;
use App\Library\Sms;

class Transaction
{
    use TransactionMessage;

    //Assign the global and common variables.
    var $user_id, $user_type, $traget_id, $traget_type;

    public function __construct($user_id = '', $user_type = '', $traget_id = '', $traget_type = '')
    {
    	//Transaction Through
        $this->user_id = $user_id;
        $this->user_type = $user_type;

        //Transaction Target
        $this->traget_id = $traget_id;
        $this->traget_type = $traget_type;
    }

    //this function use for credit amount.
    public function credit($amount, $payment_type, $payment_status = 'Pending', $transaction_id = '', $remarks = '', $reference_id ='')
    {
        $account = new Account($this->user_id, $this->user_type);
        $balance = $account->balance();
        $total_balance = floatval($balance) + floatval($amount);

        if ($transaction_id == '') {
            $transaction_id = $this->transactionID($this->user_id);
        }

        //Collect data for transaction table.
        $data['transaction_id'] =  $transaction_id;
        $data['transaction_date_time'] =  date('Y-m-d H:i:s');
        if ($this->user_id != NULL and $this->user_id != '') {
            $data['user_id'] = $this->user_id;
            $data['user_type'] =  $this->user_type;
        }
        if ($this->traget_id != NULL and $this->traget_id != '') {
            $data['target_id'] = $this->traget_id;
            $data['target_type'] = $this->traget_type;
        }
        if ($remarks == '') {
            $remarks = $this->makeRemarks($amount, $payment_type, 'Credit', $this->user_type);
        }
        
        if ($reference_id != NULL && $reference_id != '') {
            $data['bank_refrence_id'] = $reference_id;
        }
        
        $data['payment_type'] = $payment_type;
        $data['trans_type'] = 'Credit';
        $data['amount'] = $amount;
        $data['balance'] =  $total_balance;
        $data['payment_status'] = $payment_status;
        $data['remarks'] = $remarks;
        $data['created_at'] =  date('Y-m-d H:i:s');
        $responce = TransactionTable::create($data);

        if ($payment_status == 'Success') {
            $this->sendNotification($amount, $payment_type);
        }
        if ($payment_status == 'Success' && $this->user_type != 'Admin') {
            $this->sendMobileSMS($amount, $payment_type, $data['created_at']);
        }
        return $responce;
    }

    //this function use for debit amount.
    public function debit($amount, $payment_type, $payment_status = 'Pending', $transaction_id = '', $remarks = '')
    {
        $account = new Account($this->user_id, $this->user_type);
        $balance = $account->balance();
        $total_balance = floatval($balance) - floatval($amount);

        if ($transaction_id == '') {
            $transaction_id = $this->transactionID($this->user_id);
        }

        //Collect data for transaction table.
        $data['transaction_id'] =  $transaction_id;
        $data['transaction_date_time'] =  date('Y-m-d H:i:s');
        if ($this->user_id != NULL and $this->user_id != '') {
            $data['user_id'] = $this->user_id;
            $data['user_type'] =  $this->user_type;
        }
        if ($this->traget_id != NULL and $this->traget_id != '') {
            $data['target_id'] = $this->traget_id;
            $data['target_type'] = $this->traget_type;
        }
        if ($remarks == '') {
            $remarks = $this->makeRemarks($amount, $payment_type, 'Debit', $this->user_type);
        }
        
        $data['payment_type'] = $payment_type;
        $data['trans_type'] = 'Debit';
        $data['amount'] = $amount;
        $data['balance'] =  $total_balance;
        $data['payment_status'] = $payment_status;
        $data['remarks'] = $remarks;
        $data['created_at'] =  date('Y-m-d H:i:s');
        $responce = TransactionTable::create($data);

        if ($payment_status == 'Success' && $this->user_type != 'Admin' && ($payment_type == 'Transfer' || $payment_type == 'Order')) {
            $this->sendMobileSMS($amount, $payment_type, $data['created_at'], 'Debit');
        }

        return $responce;
    }

    //this function use for cancel the transaction.
    public function cancel($amount, $transaction_id, $payment_type, $trans_type, $payment_status = 'Pending')
    {

        $responce =TransactionTable::where('user_id', $this->user_id)->where('user_type', $this->user_type)->where('transaction_id', $transaction_id)
                    ->where('payment_type', $payment_type)->where('trans_type', $trans_type)
                    // ->where('payment_status', $payment_status)
                    ->where('amount', $amount)->update(['payment_status' => 'Canceled', 'updated_at' => date('Y-m-d H:i:s')]);

        return $responce;
    }

    //this function use for success the transaction.
    public function success($amount, $transaction_id, $payment_type, $trans_type, $payment_status = 'Pending', $reference_id = NULL)
    {

        $responce =TransactionTable::where('user_id', $this->user_id)->where('user_type', $this->user_type)->where('transaction_id', $transaction_id)
                    ->where('payment_type', $payment_type)->where('trans_type', $trans_type)
                    // ->where('payment_status', $payment_status)
                    ->where('amount', $amount)->update(['payment_status' => 'Success', 'bank_refrence_id' => $reference_id, 'updated_at' => date('Y-m-d H:i:s')]);

        return $responce;
    }

    //this function create remarks for the transaction.
    private function makeRemarks($amount, $purpose, $trans_type = 'Credit', $user_type){
 
        $trans_type = ($trans_type == 'Credit') ? 'credited to' : 'debited from' ;
        $remarks = '';
        if ($purpose == 'Add Money') {
            $remarks = '#'.number_format($amount, 2).' rupees '.$trans_type.' wallet.';
        }elseif ($purpose == 'Referral') {
            $remarks = '#'.number_format($amount, 2).' rupees referral reward '.$trans_type.' wallet.';
        }elseif ($purpose == 'Withdrawal' and $trans_type == 'debited from') {
            $remarks = '#'.number_format($amount, 2).' rupees withdrawal request generated.';
            if ($user_type == 'Admin') {
                $remarks = '#'.number_format($amount, 2).' rupees withdrawal request.';
            }
        }elseif ($purpose == 'Withdrawal' and $trans_type == 'credited to') {
            $remarks = '#'.number_format($amount, 2).' rupees withdrawal request canceled.';
            if ($user_type == 'Admin') {
                $remarks = '#'.number_format($amount, 2).' rupees withdrawal request.';
            }
        }elseif ($purpose == 'Order') {
            $remarks = '#'.number_format($amount, 2).' rupees for an order '.$trans_type.' wallet.';
        }elseif ($purpose == 'Transfer') {
            $remarks = '#'.number_format($amount, 2).' rupees transfer amount '.$trans_type.' wallet.';
        }elseif ($purpose == 'Profit Share') {
            $remarks = '#'.number_format($amount, 2).' rupees profit share '.$trans_type.' wallet.';
        }elseif ($purpose == 'Membership') {
            $remarks = '#'.number_format($amount, 2).' rupees membership amount '.$trans_type.' wallet.';
        }elseif ($purpose == 'Order Cashback') {
            $remarks = '#'.number_format($amount, 2).' rupees for an order cashback '.$trans_type.' wallet.';
        }elseif ($purpose == 'GST') {
            $remarks = '#'.number_format($amount, 2).' rupees gst amount '.$trans_type.' wallet.';
        }elseif ($purpose == 'Recharge') {
            $remarks = '#'.number_format($amount, 2).' rupees for recharge '.$trans_type.' wallet.';
        }elseif ($purpose == 'Recharge Cashback') {
            $remarks = '#'.number_format($amount, 2).' rupees for recharge cashback '.$trans_type.' wallet.';
        }
        return $remarks; 
    }

    //Send notification.
    private function sendNotification($amount, $payment_type)
    {

        //Create notification message.
        if ($payment_type == 'Referral') {
            $message = $this->reffral_message($amount);

            //Send Notification.
            $notification = new Notification($this->user_id, $this->user_type);
            return $notification->sendWithPush($message['title'], $message['description']);
        }

        if ($payment_type == 'Order') {
            $message = $this->order_message($amount);

            //Send Notification.
            $notification = new Notification($this->user_id, $this->user_type);
            return $notification->sendWithPush($message['title'], $message['description']);
        }

        if ($payment_type == 'Order Cashback') {
            $message = $this->order_cashback_message($amount);

            //Send Notification.
            $notification = new Notification($this->user_id, $this->user_type);
            return $notification->sendWithPush($message['title'], $message['description']);
        }

        if ($payment_type == 'Recharge Cashback') {
            $message = $this->recharge_cashback_message($amount);

            //Send Notification.
            $notification = new Notification($this->user_id, $this->user_type);
            return $notification->sendWithPush($message['title'], $message['description']);
        }

        if ($payment_type == 'Profit Share') {
            $message = $this->profit_share_message($amount);

            //Send Notification.
            $notification = new Notification($this->user_id, $this->user_type);
            return $notification->sendWithPush($message['title'], $message['description']);
        }
        
        if ($payment_type == 'Transfer') {
            $message = $this->money_received_message($amount);

            //Send Notification.
            $notification = new Notification($this->user_id, $this->user_type);
            return $notification->sendWithPush($message['title'], $message['description']);
        }
        
    }


    //Send notification.
    private function sendMobileSMS($amount, $payment_type, $datetime, $trans_type='Credit')
    {
        $msg = '';
        $message = new Message();

        //generate message for mobile sms.
        if ($payment_type == 'Referral') {
            
            $msg = $message->fund_transfer($amount, 'Referral reward', $datetime);
        }

        if ($payment_type == 'Order') {

            $msg = $message->fund_transfer($amount, 'an Order', $datetime, $trans_type);
        }

        if ($payment_type == 'Order Cashback') {

            $msg = $message->fund_transfer($amount, 'an Order Cashback', $datetime);
        }

        if ($payment_type == 'Profit Share') {

            $msg = $message->fund_transfer($amount, 'Profit Share', $datetime);
        }
        
        if ($payment_type == 'Transfer' && $trans_type = 'Debit') {

            $msg = $message->fund_transfer($amount, 'direct fund transfer', $datetime, $trans_type); 
        }

        if ($payment_type == 'Transfer' && $trans_type = 'Credit') {

            $msg = $message->fund_transfer($amount, 'direct fund received', $datetime, $trans_type); 
        }

        if ($payment_type == 'Recharge') {

            $msg = $message->fund_transfer($amount, 'recharge', $datetime, 'Debit');
        }

        if ($payment_type == 'Recharge Cashback') {

            $msg = $message->fund_transfer($amount, 'recharge cashback', $datetime);
        }

        //SMS template not working..
        // if ($payment_type == 'Add Money') {

        //     $msg = $message->add_money($amount, 'Added To', $datetime);
        // }

        //send sms.
        if ($msg!='') {
            
            $sms = new Sms($this->user()->phone, $msg);
            
            return $sms->send();
        }
        
        return false;
    }

    //Create Transaction ID.
    private function transactionID($user_id = 0){
        // $transaction_id = date("ymd", strtotime(date('Y-m-d'))).$user_id.mt_rand(10,99).time();
        $transaction_id = time().$user_id.mt_rand(10,99);
        return $transaction_id;
    }

}

