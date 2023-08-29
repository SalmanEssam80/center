<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function Branch(){
        return $this->hasMany(Branch::class);
    }

    public function Manager(){
        return $this->hasOne(Manager::class);
    }
}
