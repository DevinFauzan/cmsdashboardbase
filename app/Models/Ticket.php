<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['name_user','name_tech','subject', 'description', 'created_at', 'product', 'email', 'phone', 'status', 'ticket_id'];
}
