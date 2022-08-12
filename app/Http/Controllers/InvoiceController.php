<?php

namespace App\Http\Controllers;

use DB;
use Session;
use App\Models\Invoice;
use App\Models\Item;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('invoices')->get()->toArray();
        return view('invoice', compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->input('action') === "draft")
        {
            $invoice_total = 0;
            $new_invoice = $request->all();
            $invoice = new Invoice();
            $invoice['invoice_id'] = chr(rand(65,90)).chr(rand(65,90)).rand(1000,9999);
            $invoice['createdAt'] = $request->issue_date ? $request->issue_date : null;
            $invoice->description = $request->project_description;
            $invoice->paymentTerms = (int) filter_var($request->payment_terms, FILTER_SANITIZE_NUMBER_INT);
            $payment_date = isset($request->issue_date) ? date('Y-m-d', strtotime($request->issue_date. ' + '.$request->payment_terms)) : NULL ;
            $invoice->paymentDue = isset($payment_date) ? $payment_date : NULL;
            $invoice->clientName = $request->client_name;
            $invoice->clientEmail = $request->client_email;
            $invoice->status = 'draft';
            $invoice->senderAddressStreet = $request->sender_street_address;
            $invoice->senderAddressCity = $request->sender_city;
            $invoice->senderAddressPostCode = $request->sender_post_code;
            $invoice->senderAddressCountry = $request->sender_country;
            $invoice->clientAddressStreet = $request->client_street_address;
            $invoice->clientAddressCity = $request->client_city;
            $invoice->clientAddressPostCode = $request->client_post_code;
            $invoice->clientAddressCountry = $request->client_country;
            $invoice->created_at = date("Y-m-d", strtotime(NOW()));
            $invoice->updated_at = date("Y-m-d", strtotime(NOW()));
            $request_items['name'] = $request->itemname;
            $request_items['qty'] = $request->qty;
            $request_items['price'] = $request->price;
            $request_items['total'] = $request->total;
            if(count($request->itemname)>0)
            {
                for($i=0;$i<count($request['itemname']);$i++)
                {
                    if($request->itemname)
                    {
                        $item = new Item();
                        $item['name'] = $request['itemname'][$i];
                        $item['quantity'] = $request['qty'][$i];
                        $item['price'] = $request['price'][$i];
                        $item['total'] = $request['total'][$i];
                        $invoice_total += $request['total'][$i];
                        $item->save(); 
                        $item_data[$i]['name'] = $item['name'];
                        $item_data[$i]['id'] = $item['id'];
                    }
                }
                $invoice->total = $invoice_total;
                $invoice->save();
                foreach($item_data as $it)
                {
                    $item = Item::where('id',$it['id'])->get(); 
                    $new_item = $item->toArray();
                    $invoice_item = new InvoiceItem();
                    $invoice_item['invoice_id'] = $invoice['invoice_id'];
                    $invoice_item['item_id'] = $it['id'];
                    $invoice_item->save();
                }
            }   
        }
        if($request->input('action') === "save")
        {
            $this->validate($request,[
                'sender_street_address'=>'required|max:8',
                'sender_city'=>'required',
                'sender_post_code'=>'required',
                'sender_country'=>'required',
                'client_street_address'=>'required',
                'client_post_code'=>'required',
                'client_name'=>'required',
                'client_email'=>'required',
                'client_country'=>'required',
                'itemname'=>'required',
                'qty'=>'required',
                'price'=>'required',
                'total'=>'required',
                'project_description'=>'required',
                'payment_terms'=>'required',
                'issue_date'=>'required',

             ]);
            $invoice_total = 0;
            $new_invoice = $request->all();
            $invoice = new Invoice();
            $invoice['invoice_id'] = chr(rand(65,90)).chr(rand(65,90)).rand(1000,9999);
            $invoice['createdAt'] = $request->issue_date ;
            $invoice->description = $request->project_description;
            $invoice->paymentTerms = (int) filter_var($request->payment_terms, FILTER_SANITIZE_NUMBER_INT);
            $payment_date = date('Y-m-d', strtotime($request->issue_date. ' + '.$request->payment_terms));
            $invoice->paymentDue = $payment_date;
            $invoice->clientName = $request->client_name;
            $invoice->clientEmail = $request->client_email;
            $invoice->status = 'pending';
            $invoice->senderAddressStreet = $request->sender_street_address;
            $invoice->senderAddressCity = $request->sender_city;
            $invoice->senderAddressPostCode = $request->sender_post_code;
            $invoice->senderAddressCountry = $request->sender_country;
            $invoice->clientAddressStreet = $request->client_street_address;
            $invoice->clientAddressCity = $request->client_city;
            $invoice->clientAddressPostCode = $request->client_post_code;
            $invoice->clientAddressCountry = $request->client_country;
            $invoice->created_at = date("Y-m-d", strtotime(NOW()));
            $invoice->updated_at = date("Y-m-d", strtotime(NOW()));
            $request_items['name'] = $request->itemname;
            $request_items['qty'] = $request->qty;
            $request_items['price'] = $request->price;
            $request_items['total'] = $request->total;
            
            if(count($request->itemname)>0)
            {
                for($i=0;$i<count($request['itemname']);$i++)
                {
                    if($request->itemname)
                    {
                        $item = new Item();
                        $item['name'] = $request['itemname'][$i];
                        $item['quantity'] = $request['qty'][$i];
                        $item['price'] = $request['price'][$i];
                        $item['total'] = $request['total'][$i];
                        $invoice_total += $request['total'][$i];
                        $item->save(); 
                        $item_data[$i]['name'] = $item['name'];
                        $item_data[$i]['id'] = $item['id'];
                    }
                }
                $invoice->total = $invoice_total;
                $invoice->save();
                foreach($item_data as $it)
                {
                    $item = Item::where('id',$it['id'])->get(); 
                    $new_item = $item->toArray();
                    $invoice_item = new InvoiceItem();
                    $invoice_item['invoice_id'] = $invoice['invoice_id'];
                    $invoice_item['item_id'] = $it['id'];
                    $invoice_item->save();
                }
            }
        }
        $data = DB::table('invoices')->get()->toArray();
       if($invoice_item)
       {
            return view('invoice',compact('data'))->with('success', 'Invoice no. '.$invoice->invoice_id.' succesfully Created');
       }
       else
       {
            return view('invoice',compact('data'))->with('success', 'Draft no.'. $invoice->invoice_id.' is succesfully created ');
       }
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        $invoice_id = $id;
        $invoice = Invoice::where('invoice_id', $id)->get();
        $invoice_data = $invoice->ToArray();
        $data = $invoice_data[0];
        $item_ids[] = InvoiceItem::where('invoice_id', $id)->get();
        foreach($item_ids[0]->toArray() as $items)
        {
            $invoice_items[] = Item::where('id',$items['item_id'])->get()->toArray();
        }
        if(isset($invoice_items) == false)
        {
            $invoice_items = [null];
        }
        return view('view', compact("data","invoice_items"));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoice_id = $id;
        $invoice = Invoice::where('invoice_id', $id)->get();
        $invoice_data = $invoice->ToArray();
        $data = $invoice_data[0];
        $item_ids[] = InvoiceItem::where('invoice_id', $id)->get();
        foreach($item_ids[0]->toArray() as $items)
        {
            $invoice_items[] = Item::where('id',$items['item_id'])->get()->toArray();
        }
        if(isset($invoice_items) == false)
        {
            $invoice_items = [null];
        }

        return view('edit', compact("data","invoice_items"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $invoice_total[] = 0;
        $total = 0;
        $count=0;
        $new_item = [];
        $itemname_count = count($request['itemname']);
        for($i=0;$i<$itemname_count;$i++)
        {
            $last_id = DB::table('items')->latest('id')->first();  
            if(isset($request['itemid'][$i])==false)
            {
                $id = $last_id->id + 1;
                $item = new Item();
                $item['id'] =  $id;
                $item['name'] =  $request['itemname'][$i];
                $item['quantity'] = $request['qty'][$i];
                $item['price'] = $request['price'][$i];
                $item['total'] = $request['total'][$i];
                $item->save(); 
                $new_invoice_item = new InvoiceItem();
                $new_invoice_item['invoice_id'] = $request['invoice_id'];
                $new_invoice_item['item_id'] = $item['id'];
                $new_invoice_item->save();
            }
            else
            {
                $id = $request['itemid'][$i];
            }

        $request_items[$i]['id'] = $id;
        $request_items[$i]['itemname'] = $request['itemname'][$i];
        $request_items[$i]['qty'] = $request['qty'][$i];
        $request_items[$i]['price'] = $request['price'][$i];
        $request_items[$i]['total'] = $request['total'][$i];
        $count= $i;
        }
        if(count($request_items)>0)
        {   
            for($i=0;$i<count($request_items);$i++)
            {
                $items_update = DB::table('items')
                        ->where('id', $request_items[$i]['id'])
                        ->update([
                            'name' => $request_items[$i]['itemname'],
                            'quantity' => $request_items[$i]['qty'],
                            'price' => (float)$request_items[$i]['price'],
                            'total' => (float)$request_items[$i]['total'],
                            'updated_at' => date("Y-m-d", strtotime(NOW()))
                            ]);
            }
        }
            
        foreach($request['total'] as $t)
        {
            $total += $t;
        }
        $payment_date = $request->issue_date ? date('Y-m-d', strtotime($request->issue_date. ' + '.$request->payment_terms)) : null ;
        $invoice_update = Invoice::where('invoice_id',$request['invoice_id'])->update(array(
            'createdAt' => $request->issue_date ,
            'description' => $request->project_description,
            'paymentTerms' => (int) filter_var($request->payment_terms, FILTER_SANITIZE_NUMBER_INT),    
            'paymentDue' => $payment_date ? $payment_date : null,
            'clientName' => $request->client_name,
            'clientEmail' => $request->client_email,
            'status' => 'pending',
            'senderAddressStreet' => $request->sender_street_address,
            'senderAddressCity' => $request->sender_city,
            'senderAddressPostCode' => $request->sender_post_code,
            'senderAddressCountry' => $request->sender_country,
            'clientAddressStreet' => $request->client_street_address,
            'clientAddressCity' => $request->client_city,
            'clientAddressPostCode' => $request->client_post_code,
            'clientAddressCountry' => $request->client_country,
            'created_at' => date("Y-m-d", strtotime(NOW())),
            'updated_at' => date("Y-m-d", strtotime(NOW())),
            'total' => $total
        ));
        if($invoice_update)
        {
            return Redirect::back()->with('success', 'Invoice succesfully Edited');
        }
        else
        {
            return Redirect::back()->with('errors', 'Invoice succesfully Edited');

        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $invoice_id = $id;
        if(isset($id))
        {
            $item_invoice = InvoiceItem::where('invoice_id',$id)->get();
            $ids = $item_invoice->toArray();
            foreach($ids as $id)
            {
               Item::where('id',$id['item_id'])->delete();
            }
            InvoiceItem::where('invoice_id',$id)->delete();
            $invoice = Invoice::where('invoice_id', $id)->delete();
        }

        $data = DB::table('invoices')->get()->toArray();
        if($invoice == 1)
        {
            return view('invoice',compact('data'))->with('success','Invoice ID '.$invoice_id.' was sucessfully deleted');
        }
        else
        {
            return view('invoice',compact('data'))->with('success','<b> Unable to delete Invoice ID </b>'.$invoice_id );
        }

    }


    /**
     * delete Item
     * 
     */
    public function delete_item($id)
    {
        $item = Item::where('id',$id)->delete();
        $invoice = InvoiceItem::where('item_id',$id)->delete();
        if($invoice)
        {
            return Redirect::back()->with('success', 'Item Deleted Successfully');
        }
        else
        {
            return Redirect::back()->with('errors', 'Item cannot not be deleted ');
        }
        
    }



    /**
     * function to mark invoices as paid
     * 
     * @param \App\Models\Invoice  $id
     * 
     */
    public function paid($id)
    {
        if(isset($id))
        {
            $update = Invoice::where('invoice_id',$id)->update(array(
                'status' => 'paid',
                'updated_at' => date("Y-m-d", strtotime(NOW())),
            ));
            if($update)
            {
                $data = DB::table('invoices')->get()->toArray();
                return Redirect::back();
            
            }
        }
    }
        
}
