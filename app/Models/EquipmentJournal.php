<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentJournal extends Model
{
    use HasFactory;
    protected $table = 't_equipment_journal';
    protected $primaryKey = 'eqj_id';
    public $timestamps = false; 

    protected $fillable = [
        'eqj_eq_id',
        'eqj_datetime',
        'eqj_status',
        'eqj_cli_id',
        'eqj_comment ',
   ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // protected $casts = [
    //     'date_create' => 'datetime',
    //     'date_change' => 'datetime',
    // ];

    public function equipment()
    {
        return $this->belongsTo(Equipment::class, 'eqj_eq_id', 'eq_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'eqj_cli_id', 'cli_id');
    }
}
