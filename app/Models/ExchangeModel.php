<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeModel extends Model
{
    use HasFactory;
    protected $table ="exchange";
    protected $fillable=[
            'id',
            'cu_id',
            'type',
            'amount',
            'rate',
            'amount_equal',
            'tra_rasid',
            'tra_bord',
            'status',
            'created_at',
            'updated_at'
    ];
}
