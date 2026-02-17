<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestmentRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'venture_id',
        'status',
    ];

    public function Investor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function Venture()
    {
        return $this->belongsTo(VentureModel::class,'venture_id');
    }
}
