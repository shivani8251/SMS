<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CommonController;
use App\Models\User;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Address;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\Setting;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Scheme;
use App\Models\TaxClass;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderProduct;
use App\Models\OrderScheme;
use App\Models\Payment;
use Auth;
use Session;
use DB;
use Dompdf\Dompdf;
use App\Mail\sendGrid;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{

    public function sendOrderBill($id)
    {
        $order = Order::select("orders.*", "u.full_name", "u.phone_no", "u.email")->join("users as u", "u.id", "=", "orders.user_id", "left")->where("orders.id", $id)->where("orders.is_active", "Active")->where("u.is_active", "Yes")->first();

        if($order)
        {
            $order_id = $order->id;
            $order_user_id = $order->user_id;

            $billingAddress = DB::table("order_addresses as oa")
            ->select("oa.*", "s.state_name", "c.city_name")
            ->join("states as s", "s.id", "=", "oa.state", "left")
            ->join("cities as c", "c.id", "=", "oa.city", "left")
            ->where(function($q) use($order_id, $order_user_id){
                $q->where("oa.is_active", "Yes");
                $q->where("oa.order_id", $order_id);
                $q->where("oa.user_id", $order_user_id);
                $q->where("oa.address_type", "both");
            })
            ->orWhere(function($q2) use($order_id, $order_user_id){
                $q2->where("oa.is_active", "Yes");
                $q2->where("oa.order_id", $order_id);
                $q2->where("oa.user_id", $order_user_id);
                $q2->where("oa.address_type", "billing");
            })
            ->first();

            $shippingAddress = DB::table("order_addresses as oa")
            ->select("oa.*", "s.state_name", "c.city_name")
            ->join("states as s", "s.id", "=", "oa.state", "left")
            ->join("cities as c", "c.id", "=", "oa.city", "left")
            ->where(function($q) use($order_id, $order_user_id){
                $q->where("oa.is_active", "Yes");
                $q->where("oa.order_id", $order_id);
                $q->where("oa.user_id", $order_user_id);
                $q->where("oa.address_type", "both");
            })
            ->orWhere(function($q2) use($order_id, $order_user_id){
                $q2->where("oa.is_active", "Yes");
                $q2->where("oa.order_id", $order_id);
                $q2->where("oa.user_id", $order_user_id);
                $q2->where("oa.address_type", "shipping");
            })
            ->first();

            $products = DB::table("order_products as op")->select("op.*", "cat.category_name")->join("categories as cat", "cat.id", "=", "op.category", "left")->where("op.is_active", "Yes")->where("op.status", "Active")->where("order_id", $order_id)->get();

            foreach($products as $product)
            {
                if(isset($product->thumbnail_image))
                {
                    $image = asset("storage/products/thumbnail_image")."/".$product->thumbnail_image;
                }
                else
                {
                    $image = asset("user_assets/img/noimage.png");
                }
                $product->thumbnail_image = $image;

                if($product->taxable == "Yes")
                {
                    $tax_class = TaxClass::where("id", $product->tax_class)->where("is_active", "Active")->value("tax_class");
                }
                else
                {
                    $tax_class = 0;
                }
                $product->tax_class = $tax_class;
            }

            $totalSchemePrice = 0;
            $orderSchemes = OrderScheme::where("is_active", "Active")->where("order_id", $order_id)->get();
            foreach($orderSchemes as $orderScheme)
            {
                $totalSchemePrice += floatval($orderScheme->scheme_price);
            }

            $output = '<!DOCTYPE html>
            <html lang="en">
              <head>
                <meta charset="utf-8">
                <title>Example 1</title>
                <style>
                    .clearfix:after {
                      content: "";
                      display: table;
                      clear: both;
                    }

                    a {
                      color: #5D6975;
                      text-decoration: underline;
                    }

                    body {
                      position: relative;
                      width: 18cm;  
                      height: 29.7cm; 
                      margin: 0 auto; 
                      color: #001028;
                      background: #FFFFFF; 
                      font-family: Arial, sans-serif; 
                      font-size: 12px; 
                      font-family: Arial;
                      line-height: 17px;
                    }

                    header {
                      padding: 10px 0;
                      margin-bottom: 20px;
                    }

                    #logo {
                      text-align: center;
                      margin-bottom: 10px;
                    }

                    #logo img {
                      width: 90px;
                    }

                    h1 {
                      border-top: 1px solid  #5D6975;
                      border-bottom: 1px solid  #5D6975;
                      color: #5D6975;
                      font-size: 2.4em;
                      line-height: 1.4em;
                      font-weight: normal;
                      text-align: center;
                      margin: 0 0 20px 0;
                      background: url(dimension.png);
                    }

                    #project {
                      float: left;
                    }

                    #project span {
                      color: #5D6975;
                      text-align: center;
                      width: 52px;
                      margin-right: 10px;
                      display: inline-block;
                      font-size: 0.8em;
                    }

                    #company {
                      float: right;
                      text-align: center;
                    }

                    #project div,
                    #company div {
                      white-space: nowrap;        
                    }

                    #company-invoice {
                      float: right;
                    }

                    #company-invoice span {
                      color: #000;
                      text-align: right;
                      margin-right: 10px;
                      display: inline-block;
                      font-size: 1em;
                      font-weight: 500;
                    }

                    #project-invoice {
                      text-align: center;
                    }

                    #project-invoice div,
                    #company-invoice div {
                      white-space: nowrap;        
                    }

                    table {
                      width: 100%;
                      border-collapse: collapse;
                      border-spacing: 0;
                      margin-bottom: 20px;
                    }

                    table tr:nth-child(2n-1) td.products {
                      background: #F5F5F5;
                    }

                    table tr:nth-child(2n-1) td.bill-section {
                      background: #fff;
                    }

                    table th,
                    table td {
                      text-align: left;
                    }

                    table th:last-child,
                    table td:last-child {
                      text-align: right;
                    }

                    table:last-child tr.products-tr {
                      border-bottom: 1px solid #000;
                    }

                    table th {
                      padding: 5px 20px;
                      color: #5D6975;
                      border-bottom: 1px solid #C1CED9;
                      white-space: nowrap;        
                      font-weight: normal;
                    }

                    table .service,
                    table .desc {
                      text-align: left;
                    }

                    table td {
                      padding: 20px;
                      text-align: left;
                    }

                    table td.bill-total {
                      padding: 5px;
                      text-align: left;
                    }

                    table td.bill-total:last-child {
                      padding: 5px;
                      text-align: right;
                    }

                    table td.service,
                    table td.desc {
                      vertical-align: top;
                    }

                    table td.unit,
                    table td.qty,
                    table td.total {
                      font-size: 1.2em;
                    }

                    table td.grand {
                      border-top: 1px solid #5D6975;;
                    }

                    #notices .notice {
                      color: #5D6975;
                      font-size: 1.2em;
                    }

                    footer {
                      color: #5D6975;
                      width: 100%;
                      height: 30px;
                      position: absolute;
                      bottom: 0;
                      border-top: 1px solid #C1CED9;
                      padding: 8px 0;
                      text-align: center;
                    }
                </style>
              </head>
              <body>
                <h1 style="color: #000;">Invoice</h1>
                <header class="clearfix">
                  <div id="project" class="clearfix">
                    <div><h3 style="margin-top: 0px!important; margin-bottom: 5px!important;">'.$shippingAddress->full_name.'<br />'.$shippingAddress->company_name.'</h3></div>
                    <div>'.$shippingAddress->address.'</div>
                    <div>'.$shippingAddress->city_name.'</div>
                    <div>'.$shippingAddress->state_name.'</div>
                    <div><strong>Phone : </strong>'.$shippingAddress->phone_no.'</div>
                    <div><strong>Email : </strong>'.$shippingAddress->email.'</div>
                    <div><strong>GST Number : </strong>'.$shippingAddress->gst_no.'</div>
                  </div>
                  <div id="company-invoice">
                    <div><h3 style="margin-top: 0px!important; margin-bottom: 5px!important;">'.$billingAddress->full_name.'<br />'.$billingAddress->company_name.'</h3></div>
                    <div>'.$billingAddress->address.'</div>
                    <div>'.$billingAddress->city_name.'</div>
                    <div>'.$billingAddress->state_name.'</div>
                    <div><strong>Phone : </strong>'.$billingAddress->phone_no.'</div>
                    <div><strong>Email : </strong>'.$billingAddress->email.'</div>
                    <div><strong>GST Number : </strong>'.$billingAddress->gst_no.'</div>
                  </div>
                  <div id="project-invoice" class="clearfix">
                    <div><span>Invoice Number : </span>'.$order->id.'</div>
                    <div><span>Invoice Date : </span> '.date("d-M-Y").'</div>
                    <div><span>Order Number : </span>'.$order->order_code.'</div>
                    <div><span>Order Date : </span>'.date("d-M-Y", strtotime($order->created_at)).'</div>
                    <div><span>Payment Method : </span>'.$order->payment_method.'</div>
                    <div>&nbsp;</div>
                    <div>&nbsp;</div>
                    <div>&nbsp;</div>
                  </div>
                  
                </header>
                <main>
                  <table>
                    <thead style="background: #000;">
                      <tr>
                        <th style="color: #fff;" class="service">Product</th>
                        <th style="color: #fff;" class="desc">HSN/SAC</th>
                        <th style="color: #fff; text-align: left;">Quantity</th>
                        <th style="color: #fff; text-align: right;">Price</th>
                      </tr>
                    </thead>
                    <tbody>';

                    foreach($products as $product)
                    {
                        $totalProQty = floatval($product->sales_price)*intval($product->order_qty);
                        $totalGstTax = floatval($totalProQty)*(floatval($product->tax_class)/100);

                        $output .= '<tr>
                        <td style="border-bottom: 1px solid #000;" class="products service">'.$product->product_name.'</td>
                        <td style="border-bottom: 1px solid #000;" class="products desc">'.$product->product_code.'</td>
                        <td style="border-bottom: 1px solid #000;" class="products unit">'.$product->order_qty.'</td>
                        <td style="border-bottom: 1px solid #000;" class="products qty"><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span> '.(isset($totalGstTax) ? number_format($totalGstTax, 2) : '0.00').'</td>
                      </tr>';
                    }

                    $output .= '<tr>
                        <td class="bill-section bill-total" colspan="2"></td>
                        <td class="bill-section bill-total">SUBTOTAL</td>
                        <td class="bill-section bill-total"><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span> '.(isset($order->subtotal_price) ? number_format($order->subtotal_price, 2) : '0.00').'</td>
                      </tr>';

                    if($order->coupon_used=="Yes")  
                    {
                      $output .= '<tr>
                        <td class="bill-section bill-total" colspan="2"></td>
                        <td class="bill-section bill-total">Coupon('.$order->coupon_code.')</td>
                        <td class="bill-section bill-total total">- <span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span> '.(isset($order->coupon_price) ? number_format($order->coupon_price, 2) : '0.00').'</td>
                      </tr>';
                    }
                    if($order->total_scheme_price>0)  
                    {
                      $output .= '<tr>
                        <td class="bill-section bill-total" colspan="2"></td>
                        <td class="bill-section bill-total">Schemes</td>
                        <td class="bill-section bill-total total">- <span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span> '.(isset($order->total_scheme_price) ? number_format($order->total_scheme_price, 2) : '0.00').'</td>
                      </tr>';
                    }
                    if($order->shipping_available=="Yes")  
                    {
                      $output .= '<tr>
                        <td class="bill-section bill-total" colspan="2"></td>
                        <td class="bill-section bill-total">Shipping</td>
                        <td class="bill-section bill-total total"><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span> '.(isset($order->shipping_charges) ? number_format($order->shipping_charges, 2) : '0.00').'</td>
                      </tr>';
                    }
                    if(isset($order->gst_type))  
                    {
                        if($order->gst_type=='igst')  
                        {
                            $output .= '<tr>
                            <td class="bill-section bill-total" colspan="2"></td>
                            <td class="bill-section bill-total">IGST ('.$order->total_tax_percent.')</td>
                            <td class="bill-section bill-total total"><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span> '.(isset($order->total_tax_price) ? number_format($order->total_tax_price, 2) : '0.00').'</td>
                            </tr>';
                        }
                        else
                        {
                            $totalTaxPrice = floatval($order->total_tax_price)/2;
                            $output .= '<tr>
                            <td class="bill-section bill-total" colspan="2"></td>
                            <td class="bill-section bill-total">CGST ('.$order->total_tax_percent.')</td>
                            <td class="bill-section bill-total total"><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span> '.(isset($totalTaxPrice) ? number_format($totalTaxPrice, 2) : '0.00').'</td>
                            </tr>';

                            $output .= '<tr>
                            <td class="bill-section bill-total" colspan="2"></td>
                            <td class="bill-section bill-total">SGST ('.$order->total_tax_percent.')</td>
                            <td class="bill-section bill-total total"><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span> '.(isset($totalTaxPrice) ? number_format($totalTaxPrice, 2) : '0.00').'</td>
                            </tr>';
                        }
                    }
                    if($order->delivery_price>0)  
                    {
                      $output .= '<tr>
                        <td class="bill-section bill-total" colspan="2"></td>
                        <td class="bill-section bill-total">Delivery ('.(isset($order->delivery_title) ? $order->delivery_title : "").')</td>
                        <td class="bill-section bill-total total"><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span> '.(isset($order->delivery_price) ? number_format($order->delivery_price, 2) : '0.00').'</td>
                      </tr>';
                    }
                    if($order->payment_tax_price>0)  
                    {
                      $output .= '<tr>
                        <td class="bill-section bill-total" colspan="2"></td>
                        <td style="border-bottom: 2px solid #000;" class="bill-section bill-total">'.(isset($order->payment_method) ? $order->payment_method : "").'</td>
                        <td style="border-bottom: 2px solid #000;" class="bill-section bill-total total"><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span> '.(isset($order->payment_tax_price) ? number_format($order->payment_tax_price, 2) : '0.00').'</td>
                      </tr>';
                    }
                    $output .= '<tr>
                        <td class="bill-section bill-total" colspan="2"></td>
                        <td style="border-bottom: 2px solid #000; font-weight: 900;" class="bill-section bill-total">Total</td>
                        <td style="border-bottom: 2px solid #000;" class="bill-section bill-total total"><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span> '.(isset($order->grand_total_price) ? number_format($order->grand_total_price, 2) : '0.00').'</td>
                      </tr>';

                      $output .= '<tr><td colspan="2">&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>';

                      $output .= '<tr>
                        <td class="bill-section bill-total" colspan="2"></td>
                        <td style="font-weight: 900; font-size: 18px;" class="bill-section bill-total">Payment Method</td>
                        <td style="font-weight: 900; font-size: 18px;" class="bill-section bill-total total">'.(isset($order->payment_method) ? $order->payment_method : 'NA').'</td>
                      </tr>';

                    $output .= '</tbody>
                  </table>

                </main>
                <footer>
                    This is a Computer Generated Invoice
                </footer>
              </body>
            </html>';
            
            $dompdf = new Dompdf();
            $dompdf->loadHtml($output);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $output = $dompdf->output();
            file_put_contents("Invoice-".$order->id.".pdf", $output);
            $fileName = "Invoice-".$order->id.".pdf";

            $data = [
                'name' => $order->full_name,
                'order_code' => $order->order_code,
                'file' => $fileName
            ];
            $to = $order->email;
            Mail::to($to)->send(new SendGrid($data));
            return true;
            // echo "sent email success !";
            
        }
    }
}
