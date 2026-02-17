<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvitationRequest extends Model
{
    use HasFactory;

    protected $table = 'invitation_requests';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'location',
        'company',
        'role',
        'industry',
        'note',
        'no_of_employee'
    ];
}
