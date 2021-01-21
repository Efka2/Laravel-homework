<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id'
    ];

    public $timestamps = false;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function isAdmin()
    {
        return $this->role->name === "Admin";
    }

    public function inactiveDays()
    {
        $now = Carbon::now()->toDateTimeString();
        $to = Carbon::createFromFormat('Y-m-d H:s:i', $now);
        $from = Carbon::createFromFormat('Y-m-d H:s:i', $this->login_time);

        $diff_in_days = $from->diffInDays($to);
        return $diff_in_days;
    }

    public function isInactive()
    {
        return ($this->inactiveDays() >= 30) ? true : false;
    }

    public function changeActiveStatus()
    {
        return $this->active = !$this->active;
    }
}
