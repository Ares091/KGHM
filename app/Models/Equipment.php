<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $table = 't_equipment';
    protected $primaryKey = 'eq_id';

    public $timestamps = false;

    protected $fillable = [
        'eq_status_id',
        'eq_type_id',
        'eq_name',
        'eq_serial_number',
        'eq_inventory_number',
        'eq_cart_number',
        'eq_div_id',
        'eq_client_id',
        'eq_comment',
        'import_div',
        'import_client',
        'import_type',
        'import_doc',
        'import_comment',
        'date_create',
        'date_change',
        'eq_doc_supply_id ',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_create' => 'datetime',
        'date_change' => 'datetime',
    ];

    /**
     * Get the department that the employee belongs to.
     */
    public function client()
    {
        return $this->belongsTo(Client::class, 'eq_client_id', 'cli_id');
    }

    public function division()
    {
        return $this->belongsTo(CompanyDivision::class, 'eq_div_id', 'div_id');
    }

    public function equipmentStatus()
    {
        return $this->belongsTo(EquipmentStatus::class, 'eq_status_id', 'eqs_id');
    }

    public function equipmentType()
    {
        return $this->belongsTo(EquipmentType::class, 'eq_type_id', 'eqt_id');
    }

}
