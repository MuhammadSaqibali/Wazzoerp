<?php

namespace App\Http\Controllers;

use App\Employee;
use App\ITax;

use App\Budget;

use Illuminate\Http\Request;

class ITaxController extends Controller
{
    public function loanCreate($id)
    {
        $employee = Employee::find($id);
        return view('income_tax.create', compact('employee'));
    }

    public function store(Request $request)
    {


        $validator = \Validator::make(
            $request->all(), [
                'employee_id' => 'required',
                'group_1' => ['array'],
                'group_1.*' => ['required'],

                'group_2' => ['array'],
                'group_2.*' => ['required'],

                'group_3' => ['array'],
                'group_3.*' => ['required'],

                'group_4' => ['array'],
                'group_4.*' => ['required'],

                'group_5' => ['array'],
                'group_5.*' => ['required'],

                'group_6' => ['array'],
                'group_6.*' => ['required'],

            ]
        );
        if ($validator->fails()) {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }
        $input = $request->except('_token');
        $input['created_by'] = \Auth::user()->creatorId();
        ITax::create($input);

        return redirect()->back()->with('success', __('Income tax  successfully created.'));


    }

    // public function show(Loan $loan)
    // {
    //     return redirect()->route('commision.index');
    // }

    public function edit($loan)
    {
        $loan = ITax::find($loan);

        if ($loan->created_by == \Auth::user()->creatorId()) {
            return view('income_tax.edit', compact('loan'));
        } else {
            return response()->json(['error' => __('Permission denied.')], 401);
        }

    }

    public function update(Request $request, $loan)
    {


        if ($request->created_by == \Auth::user()->creatorId()) {
            $validator = \Validator::make(
                $request->all(), [

                    'group_1' => ['array'],
                    'group_1.*' => ['required'],

                    'group_2' => ['array'],
                    'group_2.*' => ['required'],

                    'group_3' => ['array'],
                    'group_3.*' => ['required'],

                    'group_4' => ['array'],
                    'group_4.*' => ['required'],

                    'group_5' => ['array'],
                    'group_5.*' => ['required'],

                    'group_6' => ['array'],
                    'group_6.*' => ['required'],
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }
            $input = $request->except('_token', '_method');
            ITax::where('id', $loan)->update($input);

            return redirect()->back()->with('success', __('Income tax successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

    }

    public function destroy($loan)
    {
        $loan = ITax::where('id', $loan)->first();
        if ($loan->created_by == \Auth::user()->creatorId()) {
            $loan->delete();

            return redirect()->back()->with('success', __('Income tax successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

    }
}
