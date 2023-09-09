<?php

namespace App\Library;

use App\Models\VendorBussiness as VendorBussinessTable;
use App\Models\Vendor;
use DB;

class VendorBussiness
{

    private $vendor;

    public function __construct($vendor)
    {
        $this->vendor = $vendor;
    }

	public function beautify($vendor = '')
    {

        $bussiness = (!empty($vendor)) ? $vendor->bussiness : $this->vendor->bussiness ;

        //replace the docs, images and cities.
        if ($this->vendor->profile_pic != NULL and $this->vendor->profile_pic != "") {
            $bussiness->logo = url('public/storage/vendor/display_picture').'/'.$this->vendor->profile_pic;
        }else{ $bussiness->logo = url('public/storage/vendor/icons').'/default-store.png'; }

        if ($bussiness->banner != NULL and $bussiness->banner != "") {
            $bussiness->banner = url('public/storage/vendor/banner').'/'.$bussiness->banner;
        }else{ $bussiness->banner = url('public/storage/vendor/icons').'/store-banner.png'; }

        return $bussiness;
    }

    public function create(){

        //Vendor Bussiness Profile SetUp
        $pin = explode(',', $this->vendor->pin);
        $state = DB::table('states')->where('id', $this->vendor->state)->value('name');
        $city = DB::table('cities')->where('id', $this->vendor->city)->value('name');
        $pin = DB::table('zip_codes')->where('id', $pin[0])->value('name');

        $bussinessDATA = [
            'vendor_id' => $this->vendor->id,
            'name' => $this->vendor->name,
            'address' => "$city, $state, $pin",
            'phone' => $this->vendor->phone,
            'alternative_phone' => $this->vendor->phone,
            'about' => 'About Your Bussiness',
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        return (VendorBussinessTable::create($bussinessDATA)) ? $this->beautify(Vendor::find($this->vendor->id)) : false ;
    }
}

