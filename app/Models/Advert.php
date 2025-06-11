<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'width', 'height', 'cost', 'image', 'url', 'button_text', 'start_date', 'end_date'
    ];
}
