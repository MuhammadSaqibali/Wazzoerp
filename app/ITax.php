<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ITax extends Model
{
    protected $table = "i_taxes";
    protected $guarded = [];

    protected $casts = [
        'group_1' => 'array',
        'group_2' => 'array',
        'group_3' => 'array',
        'group_4' => 'array',
        'group_5' => 'array',
        'group_6' => 'array',
    ];

    public function employee()
    {
        return $this->hasOne('App\Employee', 'id', 'employee_id')->first();
    }

    /**
     * @param $employee_id
     * @param int $salary
     * @return array
     */
    public static function getIncomeTaxedAmount($employee_id, $salary = 0):array
    {
        $itax = ITax::query()->where('employee_id')->orderByDesc('id')->first();
        $outArray['group'] = null;
        $outArray['taxed_amount'] = 0;
        $outArray['tax'] = 0;
        if (!empty($itax)) {
            $minSalary = 0;

            for($i = 1;$i <=6 ;$i++)
            {
                $key ='group_'.$i;
                $minSalary = $itax->$key['min_salary'];
                $maxSalary = $itax->$key['max_salary'];
                $tax = $itax->$key['tax_percent'];

                if($salary >= $minSalary && $salary <$maxSalary )
                {
                    $outArray['group'] = $key;
                    $outArray['tax'] = $tax;
                    break;
                }

            }

            if(!empty($outArray['group']))
            {
                $taxApplicableAmount = $salary - $minSalary;
                $outArray['taxed_amount'] = (($outArray['tax']/100) * $taxApplicableAmount);
            }
        }
        return $outArray;
    }

}
