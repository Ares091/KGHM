<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyDivision extends Model
{
    use HasFactory;
    
    protected $table = 't_company_division';
    protected $primaryKey = 'div_id';
    public $timestamps = false;

    protected $fillable = [
        'div_parent_id',
        'div_name_full',
        'div_name_short',
        'div_comment',
        'div_disable',
        'div_date_create',
        'div_date_change',
        'div_sync_1c',
        'div_sync_1c_code',
        'div_sync_1c_parent_code',
        'div_sync_1c_apply',
        'div_check_subdivision',
        'div_send_mail_apply',
        'div_lock',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => 'string',
        'department_parent_id' => 'integer',
    ];

    /**
     * Get the parent department.
     */
    public function parent()
    {
        return $this->belongsTo(CompanyDivision::class, 'div_parent_id', 'div_id');
    }

    /**
     * Get the child departments.
     */
    public function children()
    {
        return $this->hasMany(CompanyDivision::class, 'div_parent_id', 'div_id');
    }

    /**
     * Get all employees in this department.
     */
    public function employees()
    {
        return $this->hasMany(Client::class, 'cli_div_id', 'div_id');
    }
    
    

    // Scope для активных записей
    public function scopeActive($query)
    {
        return $query->where(function ($subQ) {
                  $subQ->where('div_name_full', 'ОИТ (учет техники)')
                       ->where('div_sync_1c', 0);
              })
              ->orWhere(function ($subQ) {
                  $subQ->where('div_sync_1c', 1)->where('div_disable', 0);
              });
    }
    // public function scopeActive($query)
    // {
    //     return $query->where('div_sync_1c', 1)->where('div_disable', 0);
    // }


    public function scopeWithParentCondition($query)
    {
        return $query->whereHas('parent', function ($q) {
            $q->where('div_name_full', 'ОИТ (учет техники)')
            ->orWhere('div_sync_1c', 1);
        });
    }

    public function scopeWithSyncRule($query, array $subtreeIds)
    {
        return $query->where('div_disable', 0)
                    ->where(function ($q) use ($subtreeIds) {
                        $q->whereIn('div_id', $subtreeIds)
                        ->where('div_sync_1c', 0)
                        ->orWhereNotIn('div_id', $subtreeIds)
                        ->where('div_sync_1c', 1);
                    });
    }
    
}


