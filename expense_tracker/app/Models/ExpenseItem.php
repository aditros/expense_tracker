<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpenseItem extends Model
{
    protected $fillable = ['name', 'category_id', 'user_id', 'purchase_time', 'cost'];

    public function category()
    {
        return $this->belongsTo(ExpenseCategory::class);
    }
}
