<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;
    protected $table = "orders_evaluations";

    protected $fillable = ['order_id', 'client_id','stars','comment'];

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }
}
