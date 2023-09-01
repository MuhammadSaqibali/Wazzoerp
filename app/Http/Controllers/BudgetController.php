<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Loan;
use App\Budget;
use App\LoanOption;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    public function loanCreate($id)
    {
        $employee = Employee::find($id);
        return view('budget.create', compact('employee'));
    }

    public function store(Request $request)
    {


        $validator = \Validator::make(
            $request->all(), [
                'employee_id' => 'required',
                'cost_center' => 'required',
                'funding' => 'required',
                'activity' => 'required',
                'grant_' => 'required',
                'functions' => 'required',
                'csopo' => 'required',
                'donor_report' => 'required',
                'country' => 'required',
                'allocation' => 'required',
                'control' => 'required',
            ]
        );
        if ($validator->fails()) {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }
        $input = $request->except('_token');
        $input['created_by'] = \Auth::user()->creatorId();
        Budget::create($input);

        return redirect()->back()->with('success', __('Budget  successfully created.'));


    }

    // public function show(Loan $loan)
    // {
    //     return redirect()->route('commision.index');
    // }

    public function edit($loan)
    {
        $loan = Budget::find($loan);

        if ($loan->created_by == \Auth::user()->creatorId()) {
            return view('budget.edit', compact('loan'));
        } else {
            return response()->json(['error' => __('Permission denied.')], 401);
        }

    }

    public function update(Request $request, $loan)
    {


        if ($request->created_by == \Auth::user()->creatorId()) {
            $validator = \Validator::make(
                $request->all(), [


                    'cost_center' => 'required',
                    'funding' => 'required',
                    'activity' => 'required',
                    'grant_' => 'required',
                    'functions' => 'required',
                    'csopo' => 'required',
                    'donor_report' => 'required',
                    'country' => 'required',
                    'allocation' => 'required',
                    'control' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }
            $input = $request->except('_token', '_method');
            Budget::where('id', $loan)->update($input);

            return redirect()->back()->with('success', __('Budget successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

    }

    public function destroy($loan)
    {
        $loan = Budget::where('id', $loan)->first();
        if ($loan->created_by == \Auth::user()->creatorId()) {
            $loan->delete();

            return redirect()->back()->with('success', __('Budget successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

    }
}
