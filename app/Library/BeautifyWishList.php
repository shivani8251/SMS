<?php

namespace App\Library;

use App\Library\VendorBussiness as BussinessProfile;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Product;
use DB;

class BeautifyWishList
{

    public function product($data){

        $wishlist = [];

        foreach ($data as $value) {
            
            $product = Product::where('id', $value->product_id)->where('is_active', 'Yes')->first();

            if ($product) {
                    
                $value->product_name = $product->name;
                $value->product_price = $product->price;
                $value->product_brand =  $product->brand;
                $value->display_image = null;
                if ($product->image != NULL and $product->image != "") {
                    $value->display_image = url('public/storage/vendor/product/display_image').'/'.$product->image;
                }
                $value->remove_url = url('/api/v1/remove-product-wishlist/')."/$value->id";
            }
            unset($value->id, $value->user_id, $value->user_type, $value->type, $value->is_active, $value->created_at, $value->vendor_id, $value->service_provider_id);
            array_push($wishlist, $value);
        }
        return $wishlist;
    }
	
    public function vendor($data){

        $wishlist = [];

        foreach ($data as $value) {
            
            $vendor = Vendor::where('id', $value->vendor_id)->where('is_active', 'Yes')->first();

            if ($vendor) {
                
                if ($vendor = Vendor::find($vendor->id)) {
                
                    $bussinessOBJ = new BussinessProfile($vendor);

                    $bussiness = (!isset($vendor->bussiness)) ? $bussinessOBJ->create() : $bussinessOBJ->beautify() ;
                }

                $value->vendor_name = $vendor->name;
                $value->vendor_bussiness_name = $bussiness->name;
                $value->vendor_phone = $bussiness->phone;
                $value->vendor_address = $bussiness->address;
                $value->display_image = $bussiness->banner;

                $value->remove_url = url('/api/v1/remove-vendor-wishlist/')."/$value->id";
            }
            unset($value->id, $value->user_id, $value->user_type, $value->type, $value->is_active, $value->created_at, $value->product_id, $value->service_provider_id);
            array_push($wishlist, $value);
        }
        return $wishlist;
    }

    public function service($data){

        $wishlist = [];

        foreach ($data as $value) {
            
            $serviceUser = User::where('users.id', $value->service_provider_id)->where('users.is_active', 'Yes')
                            ->where('users.provide_service', 'Yes')
                            ->join('user_services', function($join) {
                              $join->on('users.id', '=', 'user_services.user_id');
                            })->select('users.*', 'user_services.service_catgories_id', 'user_services.service_sub_catgories_id', 'user_services.display_name', 'user_services.organization', 'user_services.professions')->first();

            if ($serviceUser) {
                
                $service_catgory_name = $this->service_category_name($serviceUser->service_catgories_id);
                $service_sub_catgory_name = $this->service_sub_category_name($serviceUser->service_sub_catgories_id);

                $value->service_name = $serviceUser->display_name;
                $value->service_category = $service_catgory_name;
                $value->service_sub_category = $service_sub_catgory_name;
                $value->service_organization = $serviceUser->organization;
                $value->display_image = null;
                if ($serviceUser->profile_pic != NULL and $serviceUser->profile_pic != "") {
                    $value->display_image = url('public/storage/user/display_picture').'/'.$serviceUser->profile_pic;
                }else{ $value->display_image = url('public/storage/user/icons').'/default-store.png'; }

                $value->remove_url = url('/api/v1/remove-service-provider-wishlist/')."/$value->id";
            }
            unset($value->id, $value->user_id, $value->user_type, $value->type, $value->is_active, $value->created_at, $value->product_id, $value->vendor_id);
            array_push($wishlist, $value);
        }
        return $wishlist;
    }

    public function service_category_name($service = ''){

        $service_name = '';
        $serviceArray =  ($service!='' && $service!=null) ? explode(',', $service)  : [] ;

        $categoryArray = DB::table('service_categories')->whereIn('id', $serviceArray)->pluck('name');

        for ($j=0; $j < count($categoryArray); $j++) {
            $service_name .= $categoryArray[$j];
            if ($j < (count($categoryArray) - 1)) {
                $service_name .= ',';
            }
        }

        return $service_name;
    }

    public function service_sub_category_name($service = ''){

        $service_name = '';
        $serviceArray =  ($service!='' && $service!=null) ? explode(',', $service)  : [] ;

        $categoryArray = DB::table('service_sub_categories')->whereIn('id', $serviceArray)->pluck('name');

        for ($j=0; $j < count($categoryArray); $j++) {
            $service_name .= $categoryArray[$j];
            if ($j < (count($categoryArray) - 1)) {
                $service_name .= ',';
            }
        }

        return $service_name;
    }
}

