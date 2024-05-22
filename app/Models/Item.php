<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'serial_no',
        'model',
        'description',
        'additional_details',
        'added_by',
        'status',
        'holder',
        'condition',
        'location',
        'date_acquisition',
        'date_added',
        'barcode'
    ];

    public function addedByUser()
    {
        return $this->belongsTo(User::class, 'added_by');
    }
}
