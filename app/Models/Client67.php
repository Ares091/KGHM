<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client67 extends Model
{
    use HasFactory;

    protected $table = 't_client_67';

    protected $primaryKey = 'cli_id';

    public $timestamps = false;

    protected $fillable = [
        'cli_name_f',
        'cli_name_i',
        'cli_name_o',
        'cli_name_view',
        'cli_prof',
        'cli_div_id',
        'cli_email',
        'cli_tel_work',
        'cli_tel_work2',
        'cli_tel_mobile',
        'cli_date_born',
        'cli_comment',
        'cli_disable',
        'cli_date_create',
        'cli_date_change',
        'cli_sex',
        'cli_pregnant',
        'cli_sync_1c',
        'cli_sync_1c_code',
        'cli_sync_1c_division_code',
        'cli_sync_1c_apply',
        'cli_sync_1c_is_division_head',
        'cli_sync_1c_category',
        'cli_sync_1c_status',
        'cli_sync_1c_employment_type',
        'cli_sync_1c_hire_date',
        'cli_sync_AD',
        'cli_sync_1c_id',
        'cli_mobile_phone',
        'cli_address',
        'cli_adress_actual',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'cli_disable' => 'boolean',
        'cli_sex' => 'boolean',
        'cli_pregnant' => 'boolean',
        'cli_sync_1c'                => 'boolean',
        'cli_sync_1c_apply'          => 'boolean',
        'cli_sync_1c_is_division_head'=> 'boolean',
        'cli_date_born'              => 'datetime',
        'cli_date_create'            => 'datetime',
        'cli_date_change'            => 'datetime',
        'cli_sync_1c_hire_date'      => 'datetime',
    ];

    /**
     * Get the department that the employee belongs to.
     */
    public function division()
    {
        return $this->belongsTo(CompanyDivision::class, 'cli_div_id', 'div_id');
    }


    // /**
    //  * Get the employee's full name.
    //  */
    // protected function name(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn () => $this->fio,
    //     );
    // }

    // /**
    //  * Get the employee's age.
    //  */
    // protected function age(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn () => $this->date_of_birth ? now()->diffInYears($this->date_of_birth) : null,
    //     );
    // }

    // /**
    //  * Mutator for phone number to ensure proper formatting.
    //  */
    // public function setPhoneNumberMobileAttribute($value)
    // {
    //     $this->attributes['phone_number_mobile'] = preg_replace('/[^0-9+]/', '', $value);
    // }
}



