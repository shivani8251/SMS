<?php

namespace App\Exports;

use App\Models\MobileListing;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MobileExport implements FromCollection,WithHeadings
{
    protected $id;

     function __construct($id) {
        $this->id = $id;
     }
    /**
    * @return \Illuminate\Support\Collection
    */
   
    public function headings(): array {
        return [
           "ID", "Created At","Unique Id","Username", "Status", "Mobile Number"
        ];
      }

    public function collection()
    {
        $rows = DB::table('mobile_listings as ml')
            ->join('whatsapp_messages as wm', 'ml.send_wp_msgs_id', '=', 'wm.id', 'left')
            ->join('admins as a', 'wm.login_id', '=', 'a.id', 'left')
            ->select('ml.id', 'ml.created_at', 'wm.campaign_unique_id', 'a.username', 'ml.status', 'ml.mobile_no', 'ml.country_code')
            ->where('ml.send_wp_msgs_id', $this->id)
            ->get();

        $lists = array();
        foreach($rows as $key => $row)
        {
            $list = new \stdClass();
            $list->id = ++$key;
            $list->created_at = date('d-m-Y h:i A', strtotime($row->created_at));
            $list->campaign_unique_id = $row->campaign_unique_id;
            $list->username = $row->username;
            $list->status = $row->status;
            $list->mobile_no = $row->country_code.$row->mobile_no;
            $lists[] = $list;
        }
        return collect($lists);
        // return $lists;
    }
}