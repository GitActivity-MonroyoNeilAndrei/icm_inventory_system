<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'item',
        'issued_to',
        'issued_by',
        'transaction_type',
        'transaction_status',
        'condition'
    ];


    public function Item()
    {
        return $this->belongsTo(Item::class, 'item');
    }

    public function IssuedToUser()
    {
        return $this->belongsTo(User::class, 'issued_to');
    }

    public function IssuedByUser()
    {
        return $this->belongsTo(User::class, 'issued_by');
    }

}
