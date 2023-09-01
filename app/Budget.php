<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $table = "budgets";
    protected $fillable = [
        'employee_id',
        'cost_center',
        'funding',
        'activity',
        'grant_',
        'functions',
        'csopo',
        'donor_report',
        'country',
        'allocation',
        'control',
        'created_by',
    ];

    public function employee()
    {
        return $this->hasOne('App\Employee', 'id', 'employee_id')->first();
    }

}
