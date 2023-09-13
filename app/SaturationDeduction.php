<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaturationDeduction extends Model
{
    protected $fillable = [
        'employee_id',
        'deduction_option',
        'title',
        'amount',
        'created_by',
        'deduction_type',
        'min_incom',
        'max_incom',
        'min_elig',
    ];

    protected $casts = [
        'min_incom' => 'array',
        'max_incom' => 'array',
        'amount' => 'array',
        'deduction_type' => 'array',
    ];

    public function employee()
    {
        return $this->hasOne('App\Employee', 'id', 'employee_id')->first();
    }

    public function deduction_option()
    {
        return $this->hasOne('App\DeductionOption', 'id', 'deduction_option')->first();
    }
}
