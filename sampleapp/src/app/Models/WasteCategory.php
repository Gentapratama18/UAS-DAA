<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WasteCategory extends Model
{
    //
    protected $fillable = ['category_name', 'description'];

    public function wasteRecords()
    {
        return $this->hasMany(WasteRecord::class);
    }
}
