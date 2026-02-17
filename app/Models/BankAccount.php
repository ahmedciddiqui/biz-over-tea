<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bank_name',
        'branch_name',
        'account_holder_name',
        'account_number',
        'ifsc_code',
        'is_primary',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
