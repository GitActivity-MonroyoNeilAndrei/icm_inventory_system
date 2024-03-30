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
        'status',
        'added_by',
        'date_acquisition',
        'date_added'
    ];

    public function addedByUser()
    {
        return $this->belongsTo(User::class, 'added_by');
    }
}
