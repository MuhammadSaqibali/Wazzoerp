<?php

namespace App;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'dob',
        'gender',
        'phone',
        'address',
        'email',
        'password',
        'employee_id',
        'branch_id',
        'department_id',
        'designation_id',
        'company_doj',
        'documents',
        'account_holder_name',
        'account_number',
        'bank_name',
        'bank_identifier_code',
        'branch_location',
        'tax_payer_id',
        'salary_type',
        'salary',
        'salary_payment_method',
        'salary_based',
        'created_by',
    ];

    public function documents()
    {
        return $this->hasMany('App\EmployeeDocument', 'employee_id', 'employee_id')->get();
    }

    public function salary_type()
    {
        return $this->hasOne('App\PayslipType', 'id', 'salary_type')->pluck('name')->first();
    }

    public function get_net_salary()
    {
        $employee = Employee::where('id', '=', $this->id)->first();
        $basic_salary = (!empty($employee->salary) ? $employee->salary : 0);

        //allowance
        $allowances = Allowance::where('employee_id', '=', $this->id)->get();
        $total_allowance = 0;
        foreach ($allowances as $allowance) {
            $total_allowance = $allowance->amount + $total_allowance;
        }

        //commission
        $commissions = Commission::where('employee_id', '=', $this->id)->get();
        $total_commission = 0;
        foreach ($commissions as $commission) {
            $total_commission = $commission->amount + $total_commission;
        }

        //Loan
        $loans = Loan::where('employee_id', '=', $this->id)->get();
        $total_loan = 0;
        foreach ($loans as $loan) {
            $total_loan = $loan->amount + $total_loan;
        }

        //Saturation Deduction


        $total_saturation_deduction = self::saturation_deduction($this->id, false);

        //OtherPayment
        $other_payments = OtherPayment::where('employee_id', '=', $this->id)->get();
        $total_other_payment = 0;
        foreach ($other_payments as $other_payment) {
            $total_other_payment = $other_payment->amount + $total_other_payment;
        }

        //Overtime
        $over_times = Overtime::where('employee_id', '=', $this->id)->get();
        $total_over_time = 0;
        foreach ($over_times as $over_time) {
            $total_work = $over_time->number_of_days * $over_time->hours;
            $amount = $total_work * $over_time->rate;
            $total_over_time = $amount + $total_over_time;
        }


        //Net Salary Calculate
        $advance_salary = $total_allowance + $total_commission - $total_loan - $total_saturation_deduction + $total_other_payment + $total_over_time;


        $net_salary = $basic_salary + $advance_salary;
//        dd( $net_salary,$basic_salary,$total_allowance + $total_commission - $total_loan - $total_saturation_deduction + $total_other_payment + $total_over_time);
//        $incomeTaxAmountDetail = ITax::getIncomeTaxedAmount($this->id,$employee->salary);
//        return ($net_salary - $incomeTaxAmountDetail['taxed_amount']);

        $net_salary = $net_salary + self::getTaxFreeDeduction($employee);
        return ($net_salary);

    }

    public static function allowance($id)
    {

        //allowance
        $allowances = Allowance::where('employee_id', '=', $id)->get();
        $total_allowance = 0;
        foreach ($allowances as $allowance) {
            $total_allowance = $allowance->amount + $total_allowance;
        }

        $allowance_json = json_encode($allowances);

        return $allowance_json;

    }

    public static function commission($id)
    {
        //commission
        $commissions = Commission::where('employee_id', '=', $id)->get();
        $total_commission = 0;
        foreach ($commissions as $commission) {
            $total_commission = $commission->amount + $total_commission;
        }
        $commission_json = json_encode($commissions);

        return $commission_json;

    }

    public static function loan($id)
    {
        //Loan
        $loans = Loan::where('employee_id', '=', $id)->get();
        $total_loan = 0;
        foreach ($loans as $loan) {
            $total_loan = $loan->amount + $total_loan;
        }
        $loan_json = json_encode($loans);

        return $loan_json;
    }


    public static function deductionWithoutIncomeTax($id)
    {
        $employee = Employee::query()->where('id', $id)->first();
        $deductions = [];
        //Saturation Deduction
        $basic_salary = 0;
        $saturation_deductions = SaturationDeduction::where('employee_id', '=', $id)->where('deduction_option', '!=', '0')->get();
        if (!empty($employee)) {
            $basic_salary = $employee->salary;
        }

        $allowances = Allowance::where('employee_id', $id)->sum('amount');
//        $_basic_salary = (!empty($basic_salary) ? $basic_salary : 0) + (!empty($allowances) ? $allowances : 0);
        $_basic_salary = (!empty($basic_salary) ? $basic_salary : 0);
        // $commissions = Commission::where('employee_id', $id)->sum('amount');
        // $_basic_salary = $_basic_salary + (!empty($commissions) ? $commissions : 0);
        // $overtimes = Overtime::where('employee_id', $id)->get();
        // $_basic_salary = $_basic_salary + self::overtimeCalc($overtimes);


        $total_saturation_deduction = 0;
        foreach ($saturation_deductions as $saturation_deduction) {
//            $basic_salary
            $tmpDeduction = array();
            $tmpDeduction['title'] = $saturation_deduction->title;

            $maxAmount = 0;
            $max_key = -1;
            $max_deduction = 0;
            $_i = 0;

            // $tmp_basic_salary = $saturation_deduction->min_elig;
            $tmp_basic_salary = $_basic_salary;


            if ($saturation_deduction->deduction_option == 0) {
                // ignore income tax

            } else {


                foreach ($saturation_deduction->deduction_type as $key => $deduction_type) {

                    $amount = ($saturation_deduction->amount[$key]);


                    $tmpDeduction['ot']['op'] = $saturation_deduction->deduction_type;
                    // other taxes
                    if ($deduction_type == 'flat') {
                        $tmpDeduction['deduction_type'] = $deduction_type;
                        $tmpDeduction['amount'] = $amount;
                        $total_saturation_deduction += $amount;
                    } else {
                        $tmpDeduction['deduction_type'] = $deduction_type;
                        $total_saturation_deduction += (($amount / 100) * $tmp_basic_salary);
                        $tmpDeduction['amount'] = (($amount / 100) * $tmp_basic_salary);
                    }


                }


            }


            if (isset($tmpDeduction['amount']) && $saturation_deduction->deduction_option != 0) {

                $deductions[] = (object)$tmpDeduction;
            } elseif (!isset($tmpDeduction['amount'])) {

                if ($maxAmount > 0 && $max_key != -1) {
                    $finalAmount = 0;

                    if ($saturation_deduction->deduction_type[$max_key] == "flat") {
                        $subSalary = $max_deduction;
                        $tmpDeduction['deduction_type'] = $saturation_deduction->deduction_type[$max_key];
                        $total_saturation_deduction += $subSalary;
                        $tmpDeduction['amount'] = $subSalary;
                    } else {
                        $subSalary = $basic_salary - $maxAmount;
                        $tmpDeduction['deduction_type'] = $saturation_deduction->deduction_type[$max_key];
                        $total_saturation_deduction += (($max_deduction / 100) * $subSalary);
                        $tmpDeduction['amount'] = (($max_deduction / 100) * $subSalary);
                    }

                    $deductions[] = (object)$tmpDeduction;
                }
            } else {
                $deductions[] = (object)$tmpDeduction;
            }
        }


        return $total_saturation_deduction;


    }


    public static function getTaxFreeDeduction($employee)
    {
        \Log::info("ssss");
        $id = $employee->id;
        $taxFreeDeduction = 0;
        $basic_salary = 0;
        $saturation_deductions = SaturationDeduction::where('employee_id', '=', $id)->get();
        if (!empty($employee)) {
            $basic_salary = $employee->salary;
        }
        foreach ($saturation_deductions as $saturation_deduction) {

            if ($saturation_deduction->deduction_option == -1 || $saturation_deduction->deduction_option == '-1') {
                foreach ($saturation_deduction->deduction_type as $key => $deduction_type) {
                    $amount = ($saturation_deduction->amount[$key]);
                    if ($deduction_type == 'flat') {
                        \Log::info("-here-".$amount);
                        $taxFreeDeduction += $amount;
                    } else {
                        $taxFreeDeduction += (($amount / 100) * $basic_salary);
                    }
                }
            }
        }
        return $taxFreeDeduction;
    }

    public static function saturation_deduction($id, $json = true)
    {
        $employee = Employee::query()->where('id', $id)->first();
        $deductions = [];
        //Saturation Deduction
        $basic_salary = 0;
        $saturation_deductions = SaturationDeduction::where('employee_id', '=', $id)->get();
        if (!empty($employee)) {
            $basic_salary = $employee->salary;
        }

        $allowances = Allowance::where('employee_id', $id)->sum('amount');
        #gross salary
        $_basic_salary = (!empty($basic_salary) ? $basic_salary : 0) + (!empty($allowances) ? $allowances : 0);
        $_basic_salary_ = (!empty($basic_salary) ? $basic_salary : 0);
        // $commissions = Commission::where('employee_id', $id)->sum('amount');
        // $_basic_salary = $_basic_salary + (!empty($commissions) ? $commissions : 0);
        // $overtimes = Overtime::where('employee_id', $id)->get();
        // $_basic_salary = $_basic_salary + self::overtimeCalc($overtimes);


//        $_basic_salary = $_basic_salary - self::deductionWithoutIncomeTax($id);


        $total_saturation_deduction = 0;
        foreach ($saturation_deductions as $saturation_deduction) {
//            $basic_salary
            $tmpDeduction = array();
            $tmpDeduction['title'] = $saturation_deduction->title;

            $maxAmount = 0;
            $max_key = -1;
            $max_deduction = 0;
            $_i = 0;

//            $tmp_basic_salary = $saturation_deduction->min_elig;
            $deductionWithoutIncome = self::deductionWithoutIncomeTax($id);
            $tmp_basic_salary = $_basic_salary - $deductionWithoutIncome;


            if ($saturation_deduction->deduction_option == 0) {
                $deduction_type = "percent";
                $tmpDeduction['amount'] = 0;
                $tmpDeduction['allowances'] = $allowances;
                $tmpDeduction['deductionWithoutIncome'] = $deductionWithoutIncome;
                $tmpDeduction['basic_salary_'] = $_basic_salary_;
                foreach ($saturation_deduction->deduction_type as $key => $deduction_type) {
                    $amount = ($saturation_deduction->amount[$key]);
                    // if ($_basic_salary >= $saturation_deduction->min_elig)

                    // income tax
                    $min_salary = ($saturation_deduction->min_incom[$key]);

                    $max_salary = ($tmp_basic_salary - $min_salary);
                    $tmp_basic_salary = $tmp_basic_salary - $min_salary;

                    $tmpDeduction['it']['op'] = $saturation_deduction->deduction_type;
                    {
                        if ($_i == 4) {
                            $_deduction = ((($max_salary * $amount) / 100));
                            $tmpDeduction['deduction_type'] = $deduction_type;
                            $total_saturation_deduction += $_deduction;
                            $tmpDeduction['amount'] += $_deduction;
                        } else {
                            $_deduction = ((($min_salary * $amount) / 100));
                            $tmpDeduction['deduction_type'] = $deduction_type;
                            $total_saturation_deduction += $_deduction;
                            $tmpDeduction['amount'] += $_deduction;
                        }
                    }

                    $_i++;
                }
                $tmpDeduction['ded__amount'] = $tmpDeduction['amount'];
                $tmpDeduction['gross'] = $_basic_salary;
//                $tmpDeduction['amount'] = $_basic_salary - $tmpDeduction['amount'];
//                $total_saturation_deduction += $tmpDeduction['amount'];
            } else {


                foreach ($saturation_deduction->deduction_type as $key => $deduction_type) {

                    $amount = ($saturation_deduction->amount[$key]);

                    $tmpDeduction['ot']['op'] = $saturation_deduction->deduction_type;
                    // other taxes
                    if ($deduction_type == 'flat') {
                        $tmpDeduction['deduction_type'] = $deduction_type;
                        $tmpDeduction['amount'] = $amount;
                        $total_saturation_deduction += $amount;
                    } else {
                        $tmpDeduction['deduction_type'] = $deduction_type;
                        $total_saturation_deduction += (($amount / 100) * $basic_salary);
                        $tmpDeduction['amount'] = (($amount / 100) * $basic_salary);
                    }


                }


            }


            if (isset($tmpDeduction['amount']) && $saturation_deduction->deduction_option != 0) {

                $deductions[] = (object)$tmpDeduction;
            } elseif (!isset($tmpDeduction['amount'])) {

                if ($maxAmount > 0 && $max_key != -1) {
                    $finalAmount = 0;

                    if ($saturation_deduction->deduction_type[$max_key] == "flat") {
                        $subSalary = $max_deduction;
                        $tmpDeduction['deduction_type'] = $saturation_deduction->deduction_type[$max_key];
                        $total_saturation_deduction += $subSalary;
                        $tmpDeduction['amount'] = $subSalary;
                    } else {
                        $subSalary = $basic_salary - $maxAmount;
                        $tmpDeduction['deduction_type'] = $saturation_deduction->deduction_type[$max_key];
                        $total_saturation_deduction += (($max_deduction / 100) * $subSalary);
                        $tmpDeduction['amount'] = (($max_deduction / 100) * $subSalary);
                    }

                    $deductions[] = (object)$tmpDeduction;
                }
            } else {
                $deductions[] = (object)$tmpDeduction;
            }
        }


        if (!$json) {
            return $total_saturation_deduction;
        }


        return json_encode($deductions);

    }

    public static function other_payment($id)
    {
        //OtherPayment
        $other_payments = OtherPayment::where('employee_id', '=', $id)->get();
        $total_other_payment = 0;
        foreach ($other_payments as $other_payment) {
            $total_other_payment = $other_payment->amount + $total_other_payment;
        }
        $other_payment_json = json_encode($other_payments);

        return $other_payment_json;
    }

    public static function overtime($id)
    {
        //Overtime
        $over_times = Overtime::where('employee_id', '=', $id)->get();
        $total_over_time = 0;
        foreach ($over_times as $over_time) {
            $total_work = $over_time->number_of_days * $over_time->hours;
            $amount = $total_work * $over_time->rate;
            $total_over_time = $amount + $total_over_time;
        }
        $over_time_json = json_encode($over_times);

        return $over_time_json;
    }

    public static function overtimeCalc($over_times)
    {
        $total_over_time = 0;
        foreach ($over_times as $over_time) {
            $total_work = $over_time->number_of_days * $over_time->hours;
            $amount = $total_work * $over_time->rate;
            $total_over_time = $amount + $total_over_time;
        }
        return $total_over_time;
    }

    public static function employee_id()
    {
        $employee = Employee::latest()->first();

        return !empty($employee) ? $employee->id + 1 : 1;
    }

    public function branch()
    {
        return $this->hasOne('App\Branch', 'id', 'branch_id');
    }

    public function department()
    {
        return $this->hasOne('App\Department', 'id', 'department_id');
    }

    public function designation()
    {
        return $this->hasOne('App\Designation', 'id', 'designation_id');
    }

    public function salaryType()
    {
        return $this->hasOne('App\PayslipType', 'id', 'salary_type');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function paySlip()
    {
        return $this->hasOne('App\PaySlip', 'id', 'employee_id');
    }


    public function present_status($employee_id, $data)
    {
        return AttendanceEmployee::where('employee_id', $employee_id)->where('date', $data)->first();
    }

    public function budgets()
    {
        return $this->hasMany('App\Budget', 'id', 'employee_id');
    }

    public function itaxes()
    {
        return $this->hasMany('App\ITax', 'id', 'employee_id');
    }


    public function getAttendance(Carbon $date)
    {
        $out_arr['clock_in'] = $out_arr['clock_out'] = $out_arr['extra_time'] = $out_arr['total_time'] = "00:00:00";
        $out_arr['enable_btn'] = false;
        $out_arr['attendance_id'] = "";
        $attendance = AttendanceEmployee::query()->whereDate('date', $date->toDateString())->where('employee_id', $this->id)->first();
        if (!empty($attendance)) {
            $clock_in = Carbon::parse($attendance->clock_in);
            $clock_out = Carbon::parse($attendance->clock_out);

            $overtime = $attendance->overtime;

            $totalSeconds = $clock_in->diffInSeconds($clock_out);
            if ($overtime != '00:00:00') {
                $arr = explode(':', $overtime);
                $totalSeconds += 3600 * ((int)$arr[0]);
                $totalSeconds += 60 * ((int)$arr[1]);
                $totalSeconds += ((int)$arr[2]);
            }
            $out_arr['attendance_id'] = $attendance->id;
            $out_arr['enable_btn'] = true;
            $out_arr['clock_in'] = $clock_in->toTimeString();
            $out_arr['clock_out'] = $clock_out->toTimeString();
            $out_arr['extra_time'] = $attendance->overtime;
            $total_time = CarbonInterval::seconds($totalSeconds)->cascade();
            $out_arr['total_time'] = $total_time->hours . ':' . $total_time->minutes . ':' . $total_time->seconds;

        }
        return $out_arr;
    }


    public static function zeroPrecedor($i)
    {
        if ($i < 10) {
            $i = '0' . $i;
        }
        return $i;
    }
}
