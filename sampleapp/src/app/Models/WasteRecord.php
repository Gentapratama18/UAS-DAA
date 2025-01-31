<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WasteRecord extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'waste_category_id', 'date', 'weight', 'center_id', 'description', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function wasteCategory()
    {
        return $this->belongsTo(WasteCategory::class);
    }

    public function center()
    {
        return $this->belongsTo(Center::class);
    }
}
