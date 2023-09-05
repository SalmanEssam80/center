<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function sub_cat()
    {
        return $this->hasMany(Category::class);
    }

    public function main_cat()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }
}
