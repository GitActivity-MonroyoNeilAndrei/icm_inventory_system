<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'name',
        'category',
        'serial_no',
        'model',
        'description',
        'additional_details',
        'status',
        'added_by',
        'date_acquisition',
        'date_added',
        'csv_file'
    ];
}
