<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentType extends Model
{
    use HasFactory;

protected $table = 't_equipment_type';
    protected $primaryKey = 'eqt_id ';

    public $timestamps = false;

    protected $fillable = [
        'eqt_name',
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
    public function equipment ()
    {
        return $this->HasMany(Equipment::class, 'eqt_id', 'eq_type_id');
    }
}
