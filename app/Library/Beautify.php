<?php

namespace App\Library;

use App\Models\Management;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Wishlist;
use App\Models\Product;
use App\Library\Account;
use DB;

class Beautify
{

	public function transaction($data){
        // dd($data);
        $transactions = [];

        foreach ($data as $transaction) {

            $transaction->transaction_format_date_time = date("d M, Y", strtotime($transaction->transaction_date_time));
            $transaction_through = NULL;
            $transaction_through_type = NULL;
            $transaction_through_phone = NULL;

            //Find the trasaction through ( Credited through || Debited through). 
            if ($transaction->target_id != null && $transaction->target_id != '') {
                
                if ($transaction->target_type == 'User') {
                    
                    $user = User::where('id', $transaction->target_id)->first();
                    $transaction_through = $user->name;
                    $transaction_through_type = 'User';
                    $transaction_through_phone = $user->phone;
                }
                if ($transaction->target_type == 'Vendor') {
                    
                    $user = Vendor::where('id', $transaction->target_id)->first();
                    $transaction_through = $user->name;
                    $transaction_through_type = 'Vendor';
                    $transaction_through_phone = $user->phone;
                }
                if ($transaction->target_type == 'SO' || $transaction->target_type == 'DO' || $transaction->target_type == 'PO') {
                    
                    $user = Management::where('id', $transaction->target_id)->first();
                    $transaction_through = $user->name;
                    $transaction_through_type = "$transaction->target_type";
                    $transaction_through_phone = $user->phone;
                }
            }
            $transaction->transaction_through = $transaction_through;
            $transaction->transaction_through_type = $transaction_through_type;
            $transaction->transaction_through_phone = $transaction_through_phone;

            //Transaction Title.
            $transaction->title = $this->make_transaction_title($transaction);

            //Format the amount to readable numbers.
            $transaction->amount = number_format($transaction->amount, 2);

            //Remove extra columns.
            unset($transaction->target_id, $transaction->target_type, $transaction->user_id, $transaction->user_type, $transaction->created_at, $transaction->updated_at, $transaction->balance, $transaction->bank_refrence_id);

            //Push the row to the transactions array.
            array_push($transactions, $transaction);
        }
        return $transactions;
    }

    public function my_matches($participants){

        $beutifyData = [];

        foreach ($participants as $data) {

            // dd($data);
            //remove all the unnecessary data.
            // unset($data->password, $data->created_at, $data->updated_at);
            unset($data->created_at, $data->updated_at);

            //replace the docs, images and cities.
            if ($data->user_id != NULL and $data->user_id != "") {
                $data->user_name = DB::table('users')->where('id', $data->user_id)->where('is_active', 'Yes')->where('status', 'Active')->value('username');
                $data->mobileno = DB::table('users')->where('id', $data->user_id)->where('is_active', 'Yes')->where('status', 'Active')->value('mobileno');
            }

            $account = new Account($data->user_id, 'User');
            $balance = $account->balance();

            $data->account_balance = number_format($balance, 2);

            if ($data->game_id != NULL and $data->game_id != "") {
                $data->game_name = DB::table('games')->where('id', $data->game_id)->where('is_active', 'Yes')->where('status', 'Active')->value('name');

                $image = DB::table('games')->where('id', $data->game_id)->where('is_active', 'Yes')->where('status', 'Active')->value('thumbnail_image');
                $thumbnail = NULL;
                if(isset($image))
                {
                    $thumbnail = asset('public/storage/games/thumbnails/'.$image);
                }
                $data->game_thumbnail = $thumbnail;
            }
            if ($data->event_id != NULL and $data->event_id != "") {
                $event_detail = DB::table('events')->where('id', $data->event_id)->where('is_active', 'Yes')->where('status', 'Active')->first();

                $event_detail->event_date = date('d M', strtotime($event_detail->date_and_time));
                $event_detail->event_time = date('h:i A', strtotime($event_detail->date_and_time));

                $data->event_details = $event_detail;
            }

            array_push($beutifyData, $data);
        }
        return $beutifyData;
    }

    private function make_transaction_title($data)
    {
        $title = 'A new transaction';

        if ($data->trans_type == 'Credit') {

            if ($data->payment_type == 'Add Money') {
                $title = 'Add money to wallet';
            }
            if ($data->payment_type == 'Transfer') {
                $title = "Received from $data->transaction_through";
            }
            if ($data->payment_type == 'Order') {
                $title = "Received form $data->transaction_through";
            }
            if ($data->payment_type == 'Order Cashback') {
                $title = "Order Cashback from $data->transaction_through";
            }
            if ($data->payment_type == 'Referral') {
                $title = "Referral reward form $data->transaction_through";
            }
            if ($data->payment_type == 'Profit Share') {
                $title = "Reward Received";
            }
            if ($data->payment_type == 'Membership') {
                $title = "Membership amout received!";
            }
            if ($data->payment_type == 'Withdrawal') {

                $title = 'Withdrawal Money Received';

                if ($data->payment_status == 'Canceled') {
                    $title = "Money Withdrwal canceled!";
                }
            }
        }

        if ($data->trans_type == 'Debit') {

            if ($data->payment_type == 'Transfer') {
                $title = "Paid to $data->transaction_through";
            }
            if ($data->payment_type == 'Order') {
                $title = "Order Paid to $data->transaction_through";
            }
            if ($data->payment_type == 'Membership') {
                $title = "Paid For Membership";
            }
            if ($data->payment_type == 'Withdrawal') {
                $title = "Money Withdrwal from wallet";
            }
        }

        return $title;
    }

    public function managementObj($data){

        unset($data->password, $data->is_active, $data->created_at, $data->updated_at);

        $path = ($data->user_type == 'SO') ? 'state_officer' : ( ($data->user_type == 'DO') ? 'district_officer' : 'pin_officer' );
        if ($data->profile_pic != NULL and $data->profile_pic != "") {
            $data->profile_pic = url('public/storage/'.$path.'/display_picture').'/'.$data->profile_pic;
        }
        if ($data->kyc_doc != NULL and $data->kyc_doc != "") {
            $data->kyc_doc = url('public/storage/'.$path.'/kyc_doc').'/'.$data->kyc_doc;
        }
        if ($data->service_area != NULL and $data->service_area != "") {

            $table = ($data->user_type == 'SO') ? 'states' : ( ($data->user_type == 'DO') ? 'cities' : 'zip_codes' );

            $service_area = '';
            $serviceTable = DB::table($table)->whereIn('id', explode(",", $data->service_area))->get();

            for ($i=0; $i < count($serviceTable) ; $i++) {

                $service_area .= ($i < (count($serviceTable) - 1)) ? $serviceTable[$i]->name.', ' : $serviceTable[$i]->name ;
            }
            $data->service_area = $service_area;
        }
        return $data;
    }

    public function management($management){

        $beutifyData = [];

        foreach ($management as $data) {
            //remove all the unnecessary data.
            unset($data->password, $data->created_at, $data->updated_at);

            //replace the docs, images and cities.
            $path = ($data->user_type == 'SO') ? 'state_officer' : ( ($data->user_type == 'DO') ? 'district_officer' : 'pin_officer' );
	        if ($data->profile_pic != NULL and $data->profile_pic != "") {
	            $data->profile_pic = url('public/storage/'.$path.'/display_picture').'/'.$data->profile_pic;
	        }
	        if ($data->kyc_doc != NULL and $data->kyc_doc != "") {
	            $data->kyc_doc = url('public/storage/'.$path.'/kyc_doc').'/'.$data->kyc_doc;
	        }
	        if ($data->service_area != NULL and $data->service_area != "") {

	            $table = ($data->user_type == 'SO') ? 'states' : ( ($data->user_type == 'DO') ? 'cities' : 'zip_codes' );

	            $service_area = '';
	            $serviceTable = DB::table($table)->whereIn('id', explode(",", $data->service_area))->get();

	            for ($i=0; $i < count($serviceTable) ; $i++) {

	                $service_area .= ($i < (count($serviceTable) - 1)) ? $serviceTable[$i]->name.', ' : $serviceTable[$i]->name ;
	            }
	            $data->service_area = $service_area;
	        }
            
            $account = new Account($data->id, 'DO');
        	$balance = $account->balance();

        	$data->balance = number_format($balance, 2);

            array_push($beutifyData, $data);
        }
        return $beutifyData;
    }

    public function vendors($vendors, $get_type = 'full'){

        $beutifyData = [];

        foreach ($vendors as $data) {
            //remove all the unnecessary data.
            unset($data->device_token, $data->password, $data->created_at, $data->updated_at);

            //replace the docs, images and cities.
            if ($data->profile_pic != NULL and $data->profile_pic != "") {
                $data->profile_pic = url('public/storage/vendor/display_picture').'/'.$data->profile_pic;
            }else{ $data->profile_pic = url('public/storage/vendor/icons').'/default-store.png'; }

            if ($data->qr_code != NULL and $data->qr_code != "") {
                $data->qr_code = url('public/storage/vendor/qrCode').'/'.$data->qr_code;
            }

            //State, City Or Pin IDs.
            $data->state_id = $data->state;
            $data->city_id = $data->city;
            $Pin = explode(',', $data->pin);

            $PinIDs = [];
            foreach ($Pin as $id) {
                
                $PinIDs['id'] = intval($id);
            }
            $data->pin_ids = [$PinIDs];


            if ($data->state != NULL and $data->state != "") {

                $state_names = '';
                $states = DB::table('states')->whereIn('id', explode(",", $data->state))->get();

                for ($i=0; $i < count($states) ; $i++) {

                    $state_names .= ($i < (count($states) - 1)) ? $states[$i]->name.', ' : $states[$i]->name ;
                }
                $data->state = $state_names;
            }

            if ($data->city != NULL and $data->city != "") {

                $cities_name = '';
                $cities = DB::table('cities')->whereIn('id', explode(",", $data->city))->get();

                for ($i=0; $i < count($cities) ; $i++) {

                    $cities_name .= ($i < (count($cities) - 1)) ? $cities[$i]->name.', ' : $cities[$i]->name ;
                }
                $data->city = $cities_name;
            }

            if ($data->pin != NULL and $data->pin != "") {

                $zip_codes = '';
                $pin = DB::table('zip_codes')->whereIn('id', explode(",", $data->pin))->get();

                for ($i=0; $i < count($pin) ; $i++) {

                    $zip_codes .= ($i < (count($pin) - 1)) ? $pin[$i]->name.', ' : $pin[$i]->name ;
                }
                $data->pin = $zip_codes;
            }
            $account = new Account($data->id, 'Vendor');
            $balance = $account->balance();

            $data->balance = number_format($balance, 2);

            if ($get_type == 'short') {
                unset($data->balance, $data->qr_code, $data->refer_id, $data->is_active, $data->percent, $data->user_percent, $data->status, $data->ancestor_id, $data->prime_member);
            }
            array_push($beutifyData, $data);
        }
        return $beutifyData;
    }

    public function vendorOBJ($data, $wishlist = []){

        //Check the user has wishlisted the product.
        $wishlist = json_decode(json_encode($wishlist ,true), true);
        $data->wishlist = 'No';
        $data->add_wishlist = url('/api/v1/add-vendor-wishlist/')."/$data->id";
        $data->remove_wishlist = NULL;
        if (array_key_exists ($data->id, $wishlist)) {
            $data->wishlist = 'Yes';
            $data->remove_wishlist = url('/api/v1/remove-vendor-wishlist/')."/".$wishlist[$data->id];
        }
            
        //remove all the unnecessary data.
        unset($data->password, $data->created_at, $data->updated_at);

        //replace the docs, images and cities.
        if ($data->profile_pic != NULL and $data->profile_pic != "") {
            $data->profile_pic = url('public/storage/vendor/display_picture').'/'.$data->profile_pic;
        }else{ $data->profile_pic = url('public/storage/vendor/icons').'/default-store.png'; }
        if ($data->qr_code != NULL and $data->qr_code != "") {
            $data->qr_code = url('public/storage/vendor/qrCode').'/'.$data->qr_code;
        }
        
        if ($data->state != NULL and $data->state != "") {

            $state_names = '';
            $states = DB::table('states')->whereIn('id', explode(",", $data->state))->get();

            for ($i=0; $i < count($states) ; $i++) {

                $state_names .= ($i < (count($states) - 1)) ? $states[$i]->name.', ' : $states[$i]->name ;
            }
            $data->state = $state_names;
        }

        if ($data->city != NULL and $data->city != "") {

            $cities_name = '';
            $cities = DB::table('cities')->whereIn('id', explode(",", $data->city))->get();

            for ($i=0; $i < count($cities) ; $i++) {

                $cities_name .= ($i < (count($cities) - 1)) ? $cities[$i]->name.', ' : $cities[$i]->name ;
            }
            $data->city = $cities_name;
        }

        if ($data->pin != NULL and $data->pin != "") {

            $zip_codes = '';
            $pin = DB::table('zip_codes')->whereIn('id', explode(",", $data->pin))->get();

            for ($i=0; $i < count($pin) ; $i++) {

                $zip_codes .= ($i < (count($pin) - 1)) ? $pin[$i]->name.', ' : $pin[$i]->name ;
            }
            $data->pin = $zip_codes;
        }
        $account = new Account($data->id, 'Vendor');
        $balance = $account->balance();

        $data->balance = number_format($balance, 2);

        return $data;
    }

    public function userOBJ($data){

        //remove all the unnecessary data. service_sub_category_icon
        unset($data->is_active, $data->created_at, $data->updated_at);

        //replace the docs, images and cities.
        if ($data->profile_pic != NULL and $data->profile_pic != "") {
            $data->profile_pic = url('public/storage/user/display_picture').'/'.$data->profile_pic;
        }else{ $data->profile_pic = url('public/storage/user/icons').'/default-user.png'; }
        if ($data->qr_code != NULL and $data->qr_code != "") {
            $data->qr_code = url('public/storage/user/qrCode').'/'.$data->qr_code;
        }
        
        if ($data->state != NULL and $data->state != "") {

            $state_names = '';
            $states = DB::table('states')->whereIn('id', explode(",", $data->state))->get();

            for ($i=0; $i < count($states) ; $i++) {

                $state_names .= ($i < (count($states) - 1)) ? $states[$i]->name.', ' : $states[$i]->name ;
            }
            $data->state = $state_names;
        }

        if ($data->city != NULL and $data->city != "") {

            $cities_name = '';
            $cities = DB::table('cities')->whereIn('id', explode(",", $data->city))->get();

            for ($i=0; $i < count($cities) ; $i++) {

                $cities_name .= ($i < (count($cities) - 1)) ? $cities[$i]->name.', ' : $cities[$i]->name ;
            }
            $data->city = $cities_name;
        }

        if ($data->pin != NULL and $data->pin != "") {

            $zip_codes = '';
            $pin = DB::table('zip_codes')->whereIn('id', explode(",", $data->pin))->get();

            for ($i=0; $i < count($pin) ; $i++) {

                $zip_codes .= ($i < (count($pin) - 1)) ? $pin[$i]->name.', ' : $pin[$i]->name ;
            }
            $data->pin = $zip_codes;
        }
        
        $account = new Account($data->id, 'User');
        $balance = $account->balance();

        $data->balance = number_format($balance, 2);

        return $data;
    }

    public function products($products, $request = 'short', $wishlist = []){

        $beutifyData = [];

        foreach ($products as $data) {

            //Check the user has wishlisted the product.
            $wishlist = json_decode(json_encode($wishlist ,true), true);
            $data->wishlist = 'No';
            $data->add_wishlist = url('/api/v1/add-product-wishlist/')."/$data->id";
            $data->remove_wishlist = NULL;
            if (array_key_exists ($data->id, $wishlist)) {
                $data->wishlist = 'Yes';
                $data->remove_wishlist = url('/api/v1/remove-product-wishlist/')."/".$wishlist[$data->id];
            }
            
            //Calculate product discount.
            $data->discount_percent = round((($data->mrp - $data->discount_rate)*100) /$data->mrp).'%';

            //replace the docs, images and cities.
            if ($data->image != NULL and $data->image != "") {
                $data->display_image = url('public/storage/vendor/product/display_image').'/'.$data->image;
            }

            //extra images show only, when user wants product full details.
            if ($request == 'full') {
                //Extra images path set.
                $beutifyImages = [];
                $images = Product::find($data->id)->images;
                if (count($images)) {
                    
                    foreach ($images as $img) {

                        //replace the docs, images and cities.
                        if ($img->name != NULL and $img->name != "") 
                            $img->name = url('public/storage/')."$img->folder/$img->name";
                        
                        //if this image for Product Only.
                        if ($img->image_for == 'Product')
                            //remove all the unnecessary data.
                            unset($img->created_at, $img->image_for, $img->storage, $img->ext, $img->refrance_id, $img->folder);
                            array_push($beutifyImages, $img);
                    }
                }
                $data->images = $beutifyImages;
            }else{
                unset($data->description, $data->mode, $data->code);
            }
            $data->category_name =  DB::table('product_categories')->where('id', $data->category_id)->value('name');
            $data->sub_category_name =  DB::table('product_sub_categories')->where('id', $data->sub_category_id)->value('name');

            //remove all the unnecessary data.
            unset($data->is_active, $data->vendor_id, $data->created_at, $data->updated_at, $data->image);

            array_push($beutifyData, $data);
        }
        return $beutifyData;
    }
}

