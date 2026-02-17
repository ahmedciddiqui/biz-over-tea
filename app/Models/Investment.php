<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'venture_id',
        'ticket',
    ];

    public function investor(){

        return $this->belongsTo(User::class, 'user_id');
    }

    public function venture(){
        return $this->belongsTo(VentureModel::class, 'venture_id');
    }   

    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
