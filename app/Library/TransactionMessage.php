<?php
namespace App\Library;

use App\Models\User;
use App\Models\Vendor;
use App\Models\Management;
use App\Models\Admin;
trait TransactionMessage
{

    public function reffral_message($amount = 0)
    {
        $msg['title'] = "Referral reward received from ".ucfirst($this->user()->name);
        $msg['description'] = number_format($amount, 2).' Rs referral reward credited to your wallet.';
        return $msg;
    }

    public function order_message($amount = 0)
    {
        $msg['title'] = number_format($amount, 2).' Rs received from '.ucfirst($this->user()->name);
        $msg['description'] = number_format($amount, 2)."rupees credited to your wallet for an order.";
        return $msg;
    }

    public function money_received_message($amount = 0)
    {
        $msg['title'] = number_format($amount, 2).' rupees received from '.ucfirst($this->user()->name);
        $msg['description'] = number_format($amount, 2)." rupees credited to your wallet.";
        return $msg;
    }

    public function order_cashback_message($amount = 0)
    {
        $msg['title'] = 'Congrats! Got Cashback.';
        $msg['description'] = number_format($amount, 2).' Rs order cashback credited to your wallet.';
        return $msg;
    }

    public function recharge_cashback_message($amount = 0)
    {
        $msg['title'] = 'Congrats! Got Cashback.';
        $msg['description'] = number_format($amount, 2).' Rs recharge cashback credited to your wallet.';
        return $msg;
    }

    public function profit_share_message($amount = 0)
    { 
        $msg['title'] = 'Profit Share received Form '.ucfirst($this->user()->name);
        
        $msg['description'] = number_format($amount, 2).' Rs profit share credited to your wallet.';
        return $msg;
    }

    public function weekly_profit_share_message($amount = 0)
    {
        $msg['title'] = 'Congrats! Got Profit Share.';
        $msg['description'] = number_format($amount, 2).' Rs weekly profit share credited to your wallet.';
        return $msg;
    }

    public function money_withdrawal_message($amount, $status = 'Accepted')
    {
        $msg['title'] = number_format($amount, 2).' Rs withdrawal Accepted';
        $msg['description'] = 'Your withdrawal request has been proceed';

        if ($status == 'Canceled') {
            
            $msg['title'] = number_format($amount, 2).' Rs withdrawal Canceled';
            $msg['description'] = 'Your have canceled your withdrawal request';
        }

        if ($status == 'Rejected') {
            
            $msg['title'] = number_format($amount, 2).' Rs withdrawal Rejected';
            $msg['description'] = 'Your withdrawal request has rejected';
        }

        return $msg;
    }

    private function user()
    {
       
        $user = NULL;
        if($this->user_type == 'User')
        {
            $user = User::find($this->user_id);
        }
        elseif($this->user_type == 'Vendor')
        {
            $user = Vendor::find( $this->user_id);
        }
        elseif($this->user_type == 'SO' || $this->user_type == 'DO' || $this->user_type == 'PO')
        {
            $user = Management::find($this->user_id);
        }
        elseif($this->user_type == 'Admin')
        {
            $user = Admin::find($this->user_id);
        }
        
        return $user;
    }

}
