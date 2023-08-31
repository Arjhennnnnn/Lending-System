<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getloan(){
        return $this->belongsTo(GetLoan::class,'get_loans_id ');
    }

    public function stats(){
        return $this->belongsTo(Stat::class,'status');
    }
    
}
