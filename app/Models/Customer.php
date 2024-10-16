<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'address'];

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }

    public function interactions()
    {
        return $this->hasMany(Interaction::class);
    }
}