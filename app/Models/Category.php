<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";
    protected $fillable = ['name_en', 'name_ar', 'created_at', 'updated_at'];
    public $timestamps = true;

    public function scopeSelection($query)
    {
        $lang = app()->getLocale();
        return $query->select(
            'id',
            'name_'.$lang . ' as name',
            'created_at',
            'updated_at'
        );
    }
}
