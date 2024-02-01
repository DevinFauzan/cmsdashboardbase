<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'status',
        'is_admin',
        'case_total',
        'password',
        'role',
        'phone'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function updateCaseTotal()
    {
        // Update the case_total based on your logic
        // For example, increment by 1
        $this->update(['case_total' => $this->case_total + 1]);
    }
    public function updateStatus()
    {
        if ($this->case_total === 0) {
            $this->status = 0; // Free
        } elseif ($this->case_total >= 1 && $this->case_total <= 2) {
            $this->status = 1; // Working
        } elseif ($this->case_total >= 3 && $this->case_total <= 5) {
            $this->status = 2; // Busy
        } elseif ($this->case_total > 5) {
            $this->status = 3; // Overload
        }

        $this->save();
    }

    public function getStatusBadgeAttribute()
    {
        $statusColors = [
            0 => 'badge-gradient-success',
            1 => 'badge-gradient-info',
            2 => 'badge-gradient-warning',
            3 => 'badge-gradient-danger',
            4 => 'badge-gradient-danger',
        ];

        return $statusColors[$this->status] ?? 'badge-secondary';
    }

    // UserModel

    public function isTechPerson()
    {
        return $this->role === 'tech_person';
    }

    public function isUser()
    {
        // Assuming you have a 'role' column in your users table
        return $this->role === 'user';
    }

    public function sentMessages()
    {
        return $this->hasMany(Chat::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Chat::class, 'receiver_id');
    }
}
