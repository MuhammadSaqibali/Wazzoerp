<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = [
        'employee_id',
        'loan_option',
        'title',
        'amount',
        'start_date',
        'end_date',
        'reason',
        'created_by',
        'loan_installments',
        'loan_type'
    ];

    public function employee()
    {
        return $this->hasOne('App\Employee', 'id', 'employee_id')->first();
    }

    public function loan_option()
    {
        return $this->hasOne('App\LoanOption', 'id', 'loan_option')->first();
    }
}
