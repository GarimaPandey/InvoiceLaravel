<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Invoice;


class Item extends Model
{ 
    use HasFactory;
    protected $guarded = [
        'id',
        'name',
        'quantity',
        'price',
        'total',
    ];


    public function invoice()
    {
        return $this->belongsToMany(Invoice::class,'invoice_items')->withPivot('item_id','invoice_id');

    }
}
