<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    public $incrementing = false; 
    public $keyType = 'string';

    protected $guarded = [
        'invoice_id',
        'createdAt',
        'paymentDue',
        'description',
        'paymentTerms',
        'clientName',
        'clientEmail',
        'status',
        'senderAddressStreet',
        'senderAddressCity',
        'senderAddressPostCode',
        'senderAddressCountry',
        'clientAddressStreet',
        'clientAddressCity',
        'clientAddressPostCode',
        'clientAddressCountry',
        'total',
    ];

   /**
         * The roles that belong to the Invoice
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
         */
        public function item()
        {
            return $this->belongsToMany(Item::class,'invoice_items')->withPivot('invoice_id','item_id');
        }
}
