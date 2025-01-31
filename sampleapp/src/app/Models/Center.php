<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Center extends Model
{
    /** @use HasFactory<\Database\Factories\CenterFactory> */
    use HasFactory;
    protected $fillable = ['name', 'address', 'phone_number'];

    public function wasteRecords()
    {
        return $this->hasMany(WasteRecord::class);
    }
}
