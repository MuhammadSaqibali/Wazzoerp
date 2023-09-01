<?php

namespace App\Http\Controllers;

use App\DeductionOption;
use App\Employee;
use App\SaturationDeduction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class SaturationDeductionController extends Controller
{
    public function saturationdeductionCreate($id)
    {
        $employee = Employee::find($id);
        $deduction_options = DeductionOption::where('created_by', \Auth::user()->creatorId())->orWhere('created_by', '0')->orderBy('id', 'ASC')->get()->pluck('name', 'id');

        return view('saturationdeduction.create', compact('employee', 'deduction_options'));
    }

    public function store(Request $request)
    {
        if (\Auth::user()->can('create saturation deduction')) {
            $rules = [
                'employee_id' => 'required',
                'deduction_option' => 'required',
                'title' => 'required'
            ];
if($request->deduction_option == "0" || $request->deduction_option == 0)
{
    $rules['min_incom.*'] = ['required'];
//    $rules['max_incom.*'] = ['required'];
    $rules['amount.*'] = ['required'];
//    $rules['deduction_type.*'] = ['required'];
}


            $validator = \Validator::make(
                $request->all(), $rules, [
                    'min_incom.*' => "Min income is required for income tax",
//                    'max_incom.*' => "Max income is required for income tax",
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $saturationdeduction = new SaturationDeduction;
            $min_elig = 0;
            if($request->has('min_elig'))
            {
                $min_elig  = $request->min_elig;
                if(empty($min_elig))
                {
                    $min_elig = 0;
                }
            }
            $saturationdeduction->min_elig = $min_elig;
            $saturationdeduction->employee_id = $request->employee_id;
            $saturationdeduction->deduction_option = $request->deduction_option;
            $saturationdeduction->title = $request->title;
            $saturationdeduction->created_by = \Auth::user()->creatorId();
            $saturationdeduction->amount = $request->amount;
            $saturationdeduction->deduction_type = $request->deduction_type;

//            $saturationdeduction->max_incom = $request->max_incom;
            $saturationdeduction->min_incom = $request->min_incom;

            $saturationdeduction->save();
            return redirect()->back()->with('success', __('SaturationDeduction  successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function show(SaturationDeduction $saturationdeduction)
    {
        return redirect()->route('commision.index');
    }

    public function edit($saturationdeduction)
    {
        $saturationdeduction = SaturationDeduction::find($saturationdeduction);
        if (\Auth::user()->can('edit saturation deduction')) {
            if ($saturationdeduction->created_by == \Auth::user()->creatorId()) {
                $deduction_options = DeductionOption::where('created_by', \Auth::user()->creatorId())->orWhere('id', '0')->orderBy('id', 'ASC')->get()->pluck('name', 'id');

                return view('saturationdeduction.edit', compact('saturationdeduction', 'deduction_options'));
            } else {

                return response()->json(['error' => __('Permission denied.')], 401);
            }
        } else {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function update(Request $request, SaturationDeduction $saturationdeduction)
    {
        if (\Auth::user()->can('edit saturation deduction')) {
            $min_elig = 0;
            if ($saturationdeduction->created_by == \Auth::user()->creatorId()) {
                $rules = [

                    'deduction_option' => 'required',
                    'title' => 'required',

                ];
                if (!empty($request->deduction_option) && $request->deduction_option == 0) {
                    $rules['min_incom.*'] = ['required'];
//                    $rules['max_incom.*'] = ['required'];
                    $rules['amount.*'] = ['required'];
//                    $rules['deduction_type.*'] = ['required'];
                }
                $validator = \Validator::make(
                    $request->all(), $rules, [
                        'min_incom' => "Min income is required for income tax",
                        'max_incom' => "Max income is required for income tax",
                    ]
                );
                if ($validator->fails()) {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }


                $amount = $request->amount;

                if($request->has('min_elig'))
                {
                    $min_elig  = $request->min_elig;
                    if(empty($min_elig))
                    {
                        $min_elig = 0;
                    }
                }
                $saturationdeduction->min_elig = $min_elig;
                $saturationdeduction->deduction_option = $request->deduction_option;
                $saturationdeduction->title = $request->title;
                $saturationdeduction->amount = $amount;
                $saturationdeduction->deduction_type = $request->deduction_type;
                if($request->deduction_option == 0)
                {
//                    $saturationdeduction->max_incom = $request->max_incom;
                    $saturationdeduction->min_incom = $request->min_incom;
                }
                else
                {
//                    $saturationdeduction->max_incom = null;
                    $saturationdeduction->min_incom = null;
                }

                $saturationdeduction->save();

                return redirect()->back()->with('success', __('SaturationDeduction successfully updated.'));
            } else {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function destroy(SaturationDeduction $saturationdeduction)
    {
        if (\Auth::user()->can('delete saturation deduction')) {
            if ($saturationdeduction->created_by == \Auth::user()->creatorId()) {
                $saturationdeduction->delete();

                return redirect()->back()->with('success', __('SaturationDeduction successfully deleted.'));
            } else {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
