<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GetLoan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function users(){
        return $this->belongsTo(User::class,'lender_id');
    }

    public function requests(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function stats(){
        return $this->belongsTo(Stat::class,'status');
    }
}
