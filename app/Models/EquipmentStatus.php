<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentStatus extends Model
{
    use HasFactory;
    protected $table = 't_equipment_status';
    protected $primaryKey = 'eqs_id';

    public $timestamps = false;

    protected $fillable = [
        'eqs_name',
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

    /**
     * Get the department that the employee belongs to.
     */
    public function equipment()
    {
        return $this->HasMany(Equipment::class, 'eqs_id', 'eq_status_id');
    }

}
