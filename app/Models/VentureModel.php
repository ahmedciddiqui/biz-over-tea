<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentureModel extends Model
{
    use HasFactory;

    protected $table ="ventures";
    protected $casts = [
        'images' => 'array',
        'commit_date' => 'date',
    ];

    protected $fillable = [
        'name', 'description', 'funding_goal', 'funds_raised', 'min_investment_ticket', 'status', 'images', 'document', 'max_investment_ticket', 'commit_date', 'one_ticket_amount', 'total_ticket_quantity', 'one_investment_ticket'
    ];


    public function investments()
    {
        return $this->hasMany(Investment::class, 'venture_id');
    }

    public function investmentRequests()
    {
        return $this->hasMany(InvestmentRequest::class ,'venture_id');
    }

    

    
}
