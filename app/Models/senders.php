<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Senders extends Model
{
    use HasFactory;
    protected $table = 'senders';
    protected $guarded = [];
}
