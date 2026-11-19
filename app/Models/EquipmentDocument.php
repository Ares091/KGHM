<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentDocument extends Model
{
    use HasFactory;
    protected $table = 't_equipment_doc_supply';
    protected $primaryKey = 'doc_sup_id';
    public $timestamps = false; 

    protected $fillable = [
        'doc_sup_name',
        'doc_sup_number',
        'doc_sup_date',
        'doc_sup_comment',
        'doc_sup_prov_id ',
        'doc_sup_prov_name',
        'doc_sup_import',
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

    public function provider()
    {
        return $this->belongsTo(Provider::class, 'doc_sup_prov_id', 'prov_id');
    }
}
