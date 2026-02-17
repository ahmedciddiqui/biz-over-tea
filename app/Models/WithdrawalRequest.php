<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawalRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'venture_id',
        'amount',
        'status',
    ];

     protected $attributes = [
        'status' => 'pending',
    ];

     public function user()
    {
        return $this->belongsTo(User::class);
    }

     public function venture()
    {
        return $this->belongsTo(VentureModel::class, 'venture_id');
    }

    public function withdrawalRequests()
    {
        return $this->hasMany(\App\Models\WithdrawalRequest::class, 'venture_id');
    }

}
