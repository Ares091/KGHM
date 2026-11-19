<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;
    protected $table = 't_provider';
    protected $primaryKey = 'prov_id  ';

    public $timestamps = false;

    protected $fillable = [
        'prov_name',
        'doc_sup_number',
        'prov_contact_information',
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

    public function EquipmentDocument()
    {
        return $this->hasMany(EquipmentDocument::class, 'prov_id', 'doc_sup_id');
    }

}
