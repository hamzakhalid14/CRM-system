<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = ['customer_id', 'status', 'notes', 'follow_up_date'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}