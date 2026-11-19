<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BugReport extends Model
{
    use HasFactory;

    protected $table = 't_client';

    protected $primaryKey = 'cli_id';

    public $timestamps = false;

    protected $fillable = [
        't_br_client_id',
        't_br_master_id',
        't_br_priority',
        't_br_client_mail',
        't_br_client_message',
        't_br_message_send_date',
        't_br_message_type',
        't_br_message_status',
        't_br_message_status',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 't_br_client_id', 'cli_id');
    }

    public function master()
    {
        return $this->belongsTo(User::class, 't_br_master_id', 'u_id');
    }
}
