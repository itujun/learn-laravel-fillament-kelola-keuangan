<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['name', 'category_id', 'date', 'amount', 'note', 'image'];
}
