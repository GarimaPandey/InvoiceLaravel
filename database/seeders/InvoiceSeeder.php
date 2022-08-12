<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\Item;
use App\Models\InvoiceItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = Storage::disk('local')->get('/json/data.json');
        $decoded_data = json_decode($json,true);

        foreach($decoded_data as $data)
        {
            Invoice::query()->updateOrCreate([
                'invoice_id' => $data['id'],
                'createdAt' => $data['createdAt'],
                'paymentDue' =>$data['paymentDue'],
                'description' => $data['description'],
                'paymentTerms' => $data['paymentTerms'],
                'clientName' =>$data['clientName'],
                'clientEmail' => $data['clientEmail'],
                'status' => $data['status'],
                'senderAddressStreet' => $data['senderAddress']['street'],
                'senderAddressCity' => $data['senderAddress']['city'],
                'senderAddressPostCode' => $data['senderAddress']['postCode'],
                'senderAddressCountry' => $data['senderAddress']['country'],
                'clientAddressStreet' => $data['clientAddress']['street'],
                'clientAddressCity'=> $data['clientAddress']['city'],
                'clientAddressPostCode' => $data['clientAddress']['postCode'],
                'clientAddressCountry' => $data['clientAddress']['country'],
                'total' => $data['total'],
            ]);

            foreach($data['items'] as $item)
            {
                $item = Item::query()->updateOrCreate([
                    'name' => $item['name'],
                    'quantity' => $item['quantity'],
                    'price'=> $item['price'],
                    'total'=> $item['total'],
                ]);
                InvoiceItem::query()->updateOrCreate([
                    'invoice_id' => $data['id'],
                    'item_id' => $item['id'],

                ]);

            }
        }
    }
}
