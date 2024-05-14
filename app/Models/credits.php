<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credits extends Model
{
    use HasFactory;
    protected $table = 'credits';
    protected $guarded = [];
    public function sender()
    {
        return $this->belongsTo(senders::class);
    }

    public function currency()
    {
        return $this->belongsTo(currency::class);
    }

}
