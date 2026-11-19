<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Session;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 't_a_users';
    protected $primaryKey = 'u_id';
    public $timestamps = false;

    protected $fillable = [
        'u_t_client_id',
        'u_login',
        'u_password',
        'u_email',
        'u_ad_pc_name',
        'u_ad_user_name',
        'u_role',
        'u_sync_AD',
        'u_disabled',
        'u_sync_1c',
        'u_updated_at',
        'u_created_at',
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
        'u_sync_AD' => 'boolean',
        'u_disabled' => 'boolean',
        'u_sync_1c' => 'boolean',

        'u_updated_at' => 'datetime',
        'u_created_at' => 'datetime',
    ];


    /**
     * Get the name of the unique identifier for the user.
     */
    public function getAuthIdentifierName()
    {
        return 'u_login'; // поле для логина
    }

    /**
     * Get the password for the user.
     */
    public function getAuthPassword()
    {
        return $this->u_password;
    }


      public function client()
    {
        return $this->belongsTo(Client::class, 'u_t_client_id', 'cli_id');
    }

    public function updateSessionId($sessionId)
    {
        $this->current_session_id = $sessionId;
        $this->save();
    }

    public function isCurrentSession($sessionId)
    {
        return $this->current_session_id === $sessionId;
    }

    public function getRememberToken() { return $this->remember_token; }

}
