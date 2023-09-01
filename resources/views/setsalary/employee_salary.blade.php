@extends('layouts.admin')
@section('page-title')
    {{__('Employee Set Salary')}}
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="card min-height-253">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h6 class="mb-0">{{__('Employee Salary')}}</h6>
                                </div>
                                @can('create set salary')
                                    <div class="col text-right">
                                        <a href="#" data-url="{{ route('employee.basic.salary',$employee->id) }}"
                                           data-size="md" data-ajax-popup="true"
                                           data-title="{{__('Set Basic Sallary')}}" data-toggle="tooltip"
                                           data-original-title="{{__('Basic Salary')}}" class="apply-btn">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                @endcan
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="project-info d-flex text-sm">
                                <div class="project-info-inner mr-3 col-3">
                                    <b class="m-0"> {{__('Payslip Type') }} </b>
                                    <div
                                        class="project-amnt pt-1">@if(!empty($employee->salary_type())){{ $employee->salary_type() }}@else
                                            -- @endif</div>
                                </div>
                                <div class="project-info-inner mr-3 col-3">
                                    <b class="m-0"> {{__('Salary Based') }} </b>
                                    <div
                                        class="project-amnt pt-1">@if(!empty($employee->salary_based)){{ ucwords(str_replace("_"," ",$employee->salary_based)) }}@else
                                            -- @endif</div>
                                </div>
                                <div class="project-info-inner mr-3 col-3">
                                    <b class="m-0"> {{__('Payment Method') }} </b>
                                    <div
                                        class="project-amnt pt-1">@if(!empty($employee->salary_payment_method)){{ ucwords(str_replace("_"," ",$employee->salary_payment_method)) }}@else
                                            -- @endif</div>
                                </div>
                                <div class="project-info-inner mr-3 col-3">
                                    <b class="m-0"> {{__('Salary') }} </b>
                                    <div
                                        class="project-amnt pt-1">@if(!empty($employee->salary)){{ \Auth::user()->priceFormat($employee->salary) }}@else
                                            -- @endif</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card  min-height-253">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h6 class="mb-0">{{__('Commission')}}</h6>
                                </div>
                                @can('create commission')
                                    <div class="col text-right">
                                        <a href="#" data-url="{{ route('commissions.create',$employee->id) }}"
                                           data-size="md" data-ajax-popup="true"
                                           data-title="{{__('Create Commission')}}" data-toggle="tooltip"
                                           data-original-title="{{__('Create Commission')}}" class="apply-btn">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                @endcan
                            </div>
                        </div>
                        <div class="table-responsive">
                            @if(!$commissions->isEmpty())
                                <table class="table table-striped mb-0">
                                    <thead>
                                    <tr>
                                        <th>{{__('Employee Name')}}</th>
                                        <th>{{__('Title')}}</th>
                                        <th>{{__('Amount')}}</th>
                                        <th>{{__('Action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($commissions as $commission)
                                        <tr>
                                            <td>{{ !empty($commission->employee())?$commission->employee()->name:'' }}</td>
                                            <td>{{ $commission->title }}</td>
                                            <td>{{ \Auth::user()->priceFormat( $commission->amount) }}</td>
                                            <td class="text-right">
                                                @can('edit commission')
                                                    <a href="#"
                                                       data-url="{{ URL::to('commission/'.$commission->id.'/edit') }}"
                                                       data-size="lg" data-ajax-popup="true"
                                                       data-title="{{__('Edit Commission')}}" class="edit-icon"
                                                       data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i
                                                            class="fas fa-pencil-alt"></i></a>
                                                @endcan
                                                @can('delete commission')
                                                    <a href="#" class="delete-icon" data-toggle="tooltip"
                                                       data-original-title="{{__('Delete')}}"
                                                       data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}"
                                                       data-confirm-yes="document.getElementById('commission-delete-form-{{$commission->id}}').submit();"><i
                                                            class="fas fa-trash"></i></a>
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['commission.destroy', $commission->id],'id'=>'commission-delete-form-'.$commission->id]) !!}
                                                    {!! Form::close() !!}
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="mt-2 text-center">
                                    No Commission Found!
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card  min-height-253">
                        <div class="card-header ">
                            <div class="row">
                                <div class="col">
                                    <h6 class="mb-0">{{__('Allowance')}}</h6>
                                </div>
                                @can('create allowance')
                                    <div class="col text-right">
                                        <a href="#" data-url="{{ route('allowances.create',$employee->id) }}"
                                           data-size="md" data-ajax-popup="true" data-title="{{__('Create Allowance')}}"
                                           data-toggle="tooltip" data-original-title="{{__('Create Allowance')}}"
                                           class="apply-btn">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                @endcan
                            </div>
                        </div>
                        <div class="table-responsive">
                            @if(!$allowances->isEmpty())
                                <table class="table table-striped mb-0">
                                    <thead>
                                    <tr>
                                        <th>{{__('Employee Name')}}</th>
                                        <th>{{__('Allownace Option')}}</th>
                                        <th>{{__('Title')}}</th>
                                        <th>{{__('Amount')}}</th>
                                        <th>{{__('Action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($allowances as $allowance)
                                        <tr>
                                            <td>{{ !empty($allowance->employee())?$allowance->employee()->name:'' }}</td>
                                            <td>{{ !empty($allowance->allowance_option())?$allowance->allowance_option()->name:'' }}</td>
                                            <td>{{ $allowance->title }}</td>
                                            <td>{{  \Auth::user()->priceFormat($allowance->amount) }}</td>
                                            <td>
                                                @can('edit allowance')
                                                    <a href="#"
                                                       data-url="{{ URL::to('allowance/'.$allowance->id.'/edit') }}"
                                                       data-size="lg" data-ajax-popup="true"
                                                       data-title="{{__('Edit Allowance')}}" class="edit-icon"
                                                       data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i
                                                            class="fas fa-pencil-alt"></i></a>
                                                @endcan
                                                @can('delete allowance')
                                                    <a href="#" class="delete-icon" data-toggle="tooltip"
                                                       data-original-title="{{__('Delete')}}"
                                                       data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}"
                                                       data-confirm-yes="document.getElementById('allowance-delete-form-{{$allowance->id}}').submit();"><i
                                                            class="fas fa-trash"></i></a>
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['allowance.destroy', $allowance->id],'id'=>'allowance-delete-form-'.$allowance->id]) !!}
                                                    {!! Form::close() !!}
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="mt-2 text-center">
                                    No Allowance Found!
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card min-height-253">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h6 class="mb-0">{{__('Saturation Deduction')}}</h6>
                                </div>
                                @can('create saturation deduction')
                                    <div class="col text-right">
                                        <a href="#" data-url="{{ route('saturationdeductions.create',$employee->id) }}"
                                           data-size="md" data-ajax-popup="true"
                                           data-title="{{__('Create Saturation Deduction')}}" data-toggle="tooltip"
                                           data-original-title="{{__('Create Saturation Deduction')}}"
                                           class="apply-btn">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                @endcan
                            </div>
                        </div>
                        <div class="table-responsive">
                            @if(!$saturationdeductions->isEmpty())
                                <table class="table table-striped mb-0">
                                    <thead>
                                    <tr>
                                        <th>{{__('Employee Name')}}</th>
                                        <th>{{__('Deduction Option')}}</th>
                                        <th>{{__('Title')}}</th>
                                        <th>{{__('Amount')}}</th>
                                        <th>{{__('Type')}}</th>
                                        <th>{{__('Action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($saturationdeductions as $saturationdeduction)
                                        <tr>
                                            <td>{{ !empty($saturationdeduction->employee())?$saturationdeduction->employee()->name:'' }}</td>
                                            <td>{{ !empty($saturationdeduction->deduction_option())?$saturationdeduction->deduction_option()->name:'' }}</td>
                                            <td>{{ $saturationdeduction->title }}</td>
                                            <td>{{  $saturationdeduction->amount[0]??$saturationdeduction->amount }}</td>
                                            <td>{{  $saturationdeduction->deduction_type[0]??ucwords($saturationdeduction->deduction_type) }}</td>
                                            <td class="text-right">
                                                @can('edit saturation deduction')
                                                    <a href="#"
                                                       data-url="{{ URL::to('saturationdeduction/'.$saturationdeduction->id.'/edit') }}"
                                                       data-size="lg" data-ajax-popup="true"
                                                       data-title="{{__('Edit Saturation Deduction')}}"
                                                       class="edit-icon" data-toggle="tooltip"
                                                       data-original-title="{{__('Edit')}}"><i
                                                            class="fas fa-pencil-alt"></i></a>
                                                @endcan
                                                @can('delete saturation deduction')
                                                    <a href="#" class="delete-icon" data-toggle="tooltip"
                                                       data-original-title="{{__('Delete')}}"
                                                       data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}"
                                                       data-confirm-yes="document.getElementById('deduction-delete-form-{{$saturationdeduction->id}}').submit();"><i
                                                            class="fas fa-trash"></i></a>
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['saturationdeduction.destroy', $saturationdeduction->id],'id'=>'deduction-delete-form-'.$saturationdeduction->id]) !!}
                                                    {!! Form::close() !!}
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="mt-2 text-center">
                                    No Saturation Deduction Found!
                                </div>
                            @endif
                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="card min-height-253">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h6 class="mb-0">{{__('Other Payment')}}</h6>
                                </div>
                                @can('create other payment')
                                    <div class="col text-right">
                                        <a href="#" data-url="{{ route('otherpayments.create',$employee->id) }}"
                                           data-size="md" data-ajax-popup="true"
                                           data-title="{{__('Create Other Payment')}}" data-toggle="tooltip"
                                           data-original-title="{{__('Create Other Payment')}}" class="apply-btn">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                @endcan
                            </div>
                        </div>
                        <div class="table-responsive">
                            @if(!$otherpayments->isEmpty())
                                <table class="table table-striped mb-0">
                                    <thead>
                                    <tr>
                                        <th>{{__('Employee')}}</th>
                                        <th>{{__('Title')}}</th>
                                        <th>{{__('Amount')}}</th>
                                        <th>{{__('Action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($otherpayments as $otherpayment)
                                        <tr>
                                            <td>{{ !empty($otherpayment->employee())?$otherpayment->employee()->name:'' }}</td>
                                            <td>{{ $otherpayment->title }}</td>
                                            <td>{{  \Auth::user()->priceFormat($otherpayment->amount) }}</td>
                                            <td class="text-right">
                                                @can('edit other payment')
                                                    <a href="#"
                                                       data-url="{{ URL::to('otherpayment/'.$otherpayment->id.'/edit') }}"
                                                       data-size="lg" data-ajax-popup="true"
                                                       data-title="{{__('Edit Other Payment')}}" class="edit-icon"
                                                       data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i
                                                            class="fas fa-pencil-alt"></i></a>
                                                @endcan
                                                @can('delete other payment')
                                                    <a href="#" class="delete-icon" data-toggle="tooltip"
                                                       data-original-title="{{__('Delete')}}"
                                                       data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}"
                                                       data-confirm-yes="document.getElementById('payment-delete-form-{{$otherpayment->id}}').submit();"><i
                                                            class="fas fa-trash"></i></a>
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['otherpayment.destroy', $otherpayment->id],'id'=>'payment-delete-form-'.$otherpayment->id]) !!}
                                                    {!! Form::close() !!}
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="mt-2 text-center">
                                    No Other Payment Data Found!
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h6 class="mb-0">{{__('Overtime')}}</h6>
                                </div>
                                @can('create overtime')
                                    <div class="col text-right">
                                        <a href="#" data-url="{{ route('overtimes.create',$employee->id) }}"
                                           data-size="md" data-ajax-popup="true" data-title="{{__('Create Overtime')}}"
                                           data-toggle="tooltip" data-original-title="{{__('Create Overtime')}}"
                                           class="apply-btn">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                @endcan
                            </div>
                        </div>
                        <div class="table-responsive">
                            @if(!$overtimes->isEmpty())
                                <table class="table table-striped mb-0">
                                    <thead>
                                    <tr>
                                        <th>{{__('Employee Name')}}</th>
                                        <th>{{__('Overtime Title')}}</th>
                                        <th>{{__('Number of days')}}</th>
                                        <th>{{__('Hours')}}</th>
                                        <th>{{__('Rate')}}</th>
                                        <th>{{__('Action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($overtimes as $overtime)
                                        <tr>
                                            <td>{{ !empty($overtime->employee())?$overtime->employee()->name:'' }}</td>
                                            <td>{{ $overtime->title }}</td>
                                            <td>{{ $overtime->number_of_days }}</td>
                                            <td>{{ $overtime->hours }}</td>
                                            <td>{{  \Auth::user()->priceFormat($overtime->rate) }}</td>
                                            <td class="text-right">
                                                @can('edit overtime')
                                                    <a href="#"
                                                       data-url="{{ URL::to('overtime/'.$overtime->id.'/edit') }}"
                                                       data-size="lg" data-ajax-popup="true"
                                                       data-title="{{__('Edit OverTime')}}" class="edit-icon"
                                                       data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i
                                                            class="fas fa-pencil-alt"></i></a>
                                                @endcan
                                                @can('delete overtime')
                                                    <a href="#" class="delete-icon" data-toggle="tooltip"
                                                       data-original-title="{{__('Delete')}}"
                                                       data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}"
                                                       data-confirm-yes="document.getElementById('overtime-delete-form-{{$overtime->id}}').submit();"><i
                                                            class="fas fa-trash"></i></a>
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['overtime.destroy', $overtime->id],'id'=>'overtime-delete-form-'.$overtime->id]) !!}
                                                    {!! Form::close() !!}
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="mt-2 text-center">
                                    No Overtime Data Found!
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @if(false)
                    <div class="col-md-6">
                        <div class="card  min-height-253">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col">
                                        <h6 class="mb-0">{{__('Income Tax')}}</h6>
                                    </div>
                                    @if($iTaxes->isEmpty())
                                        <div class="col text-right">
                                            <a href="#" data-url="{{ route('income_tax.create',$employee->id) }}"
                                               data-size="md" data-ajax-popup="true"
                                               data-title="{{__('Create Income Tax')}}" data-toggle="tooltip"
                                               data-original-title="{{__('Create Income Tax')}}" class="apply-btn">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="table-responsive">
                                @if(!$iTaxes->isEmpty())
                                    <table class="table table-striped mb-0">

                                        <tbody>
                                        @foreach ($iTaxes as $loan)
                                            <tr>
                                                <th colspan="3">{{ !empty($loan->employee())?$loan->employee()->name:'' }}</th>
                                            </tr>
                                            <tr>
                                                <th>Min Salary</th>
                                                <th>Max Salary</th>
                                                <th>Tax</th>
                                            </tr>
                                            <tr>
                                                <td>{{$loan->group_1['min_salary'] }}</td>
                                                <td>{{$loan->group_1['max_salary'] }}</td>
                                                <td>{{$loan->group_1['tax_percent'] }}%</td>
                                            </tr>
                                            <tr>
                                                <td>{{$loan->group_2['min_salary'] }}</td>
                                                <td>{{$loan->group_2['max_salary'] }}</td>
                                                <td>{{$loan->group_2['tax_percent'] }}%</td>
                                            </tr>
                                            <tr>
                                                <td>{{$loan->group_3['min_salary'] }}</td>
                                                <td>{{$loan->group_3['max_salary'] }}</td>
                                                <td>{{$loan->group_3['tax_percent'] }}%</td>
                                            </tr>
                                            <tr>
                                                <td>{{$loan->group_4['min_salary'] }}</td>
                                                <td>{{$loan->group_4['max_salary'] }}</td>
                                                <td>{{$loan->group_4['tax_percent'] }}%</td>
                                            </tr>
                                            <tr>
                                                <td>{{$loan->group_5['min_salary'] }}</td>
                                                <td>{{$loan->group_5['max_salary'] }}</td>
                                                <td>{{$loan->group_5['tax_percent'] }}%</td>
                                            </tr>
                                            <tr>
                                                <td>{{$loan->group_6['min_salary'] }}</td>
                                                <td>{{$loan->group_6['max_salary'] }}</td>
                                                <td>{{$loan->group_6['tax_percent'] }}%</td>
                                            </tr>



                                            <td colspan="3" class="text-right">

                                                <a href="#" data-url="{{ URL::to('income_tax/'.$loan->id.'/edit') }}"
                                                   data-size="lg" data-ajax-popup="true"
                                                   data-title="{{__('Edit Income Tax')}}" class="edit-icon"
                                                   data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i
                                                        class="fas fa-pencil-alt"></i></a>

                                                <a href="#" class="delete-icon" data-toggle="tooltip"
                                                   data-original-title="{{__('Delete')}}"
                                                   data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}"
                                                   data-confirm-yes="document.getElementById('itax-delete-form-{{$loan->id}}').submit();"><i
                                                        class="fas fa-trash"></i></a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['income_tax.destroy', $loan->id],'id'=>'itax-delete-form-'.$loan->id]) !!}
                                                {!! Form::close() !!}

                                            </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="mt-2 text-center">
                                        No Income Tax Data Found!
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                <div class="col-md-12">
                    <div class="card  min-height-253">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h6 class="mb-0">{{__('Loan')}}</h6>
                                </div>
                                @can('create loan')
                                    <div class="col text-right">
                                        <a href="#" data-url="{{ route('loans.create',$employee->id) }}" data-size="md"
                                           data-ajax-popup="true" data-title="{{__('Create Loan')}}"
                                           data-toggle="tooltip" data-original-title="{{__('Create Loan')}}"
                                           class="apply-btn">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                @endcan
                            </div>
                        </div>
                        <div class="table-responsive">
                            @if(!$loans->isEmpty())
                                <table class="table table-striped mb-0">
                                    <thead>
                                    <tr>
                                        <th>{{__('Employee')}}</th>
                                        <th>{{__('Installments')}}</th>
                                        <th>{{__('Loan Options')}}</th>
                                        <th>{{__('Title')}}</th>
                                        <th>{{__('Loan Amount')}}</th>
                                        <th>{{__('Loan Type')}}</th>
                                        <th>{{__('Start Date')}}</th>
                                        <th>{{__('End Date')}}</th>
                                        <th>{{__('Action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($loans as $loan)
                                        <tr>
                                            <td>{{ !empty($loan->employee())?$loan->employee()->name:'' }}</td>
                                            <td>{{ucwords(str_replace("_"," ",$loan->loan_installments))}}</td>
                                            <td>{{!empty( $loan->loan_option())? $loan->loan_option()->name:'' }}</td>
                                            <td>{{ $loan->title }}</td>
                                            <td>{{  \Auth::user()->priceFormat($loan->amount) }}</td>
                                            <td>{{  ucwords($loan->loan_type) }}</td>
                                            <td>{{  \Auth::user()->dateFormat($loan->start_date) }}</td>
                                            <td>{{ \Auth::user()->dateFormat( $loan->end_date) }}</td>
                                            <td class="text-right">
                                                @can('edit loan')
                                                    <a href="#" data-url="{{ URL::to('loan/'.$loan->id.'/edit') }}"
                                                       data-size="lg" data-ajax-popup="true"
                                                       data-title="{{__('Edit Loan')}}" class="edit-icon"
                                                       data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i
                                                            class="fas fa-pencil-alt"></i></a>
                                                @endcan
                                                @can('delete loan')
                                                    <a href="#" class="delete-icon" data-toggle="tooltip"
                                                       data-original-title="{{__('Delete')}}"
                                                       data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}"
                                                       data-confirm-yes="document.getElementById('loan-delete-form-{{$loan->id}}').submit();"><i
                                                            class="fas fa-trash"></i></a>
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['loan.destroy', $loan->id],'id'=>'loan-delete-form-'.$loan->id]) !!}
                                                    {!! Form::close() !!}
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="mt-2 text-center">
                                    No Loan Data Found!
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card  min-height-253">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h6 class="mb-0">{{__('Budget')}}</h6>
                                </div>

                                <div class="col text-right">
                                    <a href="#" data-url="{{ route('budget.create',$employee->id) }}" data-size="md"
                                       data-ajax-popup="true" data-title="{{__('Create Budget')}}" data-toggle="tooltip"
                                       data-original-title="{{__('Create Budget')}}" class="apply-btn">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>

                            </div>
                        </div>
                        <div class="table-responsive">
                            @if(!$budgets->isEmpty())
                                <table class="table table-striped mb-0">
                                    <thead>
                                    <tr>
                                        <th>{{__('Employee')}}</th>
                                        <th>{{__('Cost Center')}}</th>
                                        <th>{{__('Funding')}}</th>
                                        <th>{{__('Activity')}}</th>
                                        <th>{{__('Grant')}}</th>
                                        <th>{{__('Functions')}}</th>
                                        <th>{{__('CSOPO')}}</th>
                                        <th>{{__('Donor Report')}}</th>
                                        <th>{{__('Country')}}</th>
                                        <th>{{__('Allocation')}}</th>
                                        <th>{{__('Control')}}</th>
                                        <th>{{__('Action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($budgets as $loan)
                                        <tr>
                                            <td>{{ !empty($loan->employee())?$loan->employee()->name:'' }}</td>
                                            <td>{{$loan->cost_center }}</td>
                                            <td>{{ $loan->funding }}</td>
                                            <td>{{ $loan->activity }}</td>
                                            <td>{{ $loan->grant_ }}</td>
                                            <td>{{ $loan->functions }}</td>
                                            <td>{{ $loan->csopo }}</td>
                                            <td>{{ $loan->donor_report }}</td>
                                            <td>{{ $loan->country }}</td>
                                            <td>{{ $loan->allocation }}%</td>
                                            <td>{{ $loan->control }}</td>
                                            <td class="text-right">

                                                <a href="#" data-url="{{ URL::to('budget/'.$loan->id.'/edit') }}"
                                                   data-size="lg" data-ajax-popup="true"
                                                   data-title="{{__('Edit Budget')}}" class="edit-icon"
                                                   data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i
                                                        class="fas fa-pencil-alt"></i></a>

                                                <a href="#" class="delete-icon" data-toggle="tooltip"
                                                   data-original-title="{{__('Delete')}}"
                                                   data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}"
                                                   data-confirm-yes="document.getElementById('budget-delete-form-{{$loan->id}}').submit();"><i
                                                        class="fas fa-trash"></i></a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['budget.destroy', $loan->id],'id'=>'budget-delete-form-'.$loan->id]) !!}
                                                {!! Form::close() !!}

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="mt-2 text-center">
                                    No Loan Data Found!
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="a_basic_salary" value="{{!empty($employee->salary)?$employee->salary:0}}">
@endsection

@push('script-page')

    <script>
        @php
            $amount_ = $amount__ = $amount___ = 0;
        @endphp
        let basic_salary = {{!empty($employee->salary)?$employee->salary:0}};
        @if(!$allowances->isEmpty())

        @php

            $amount_ =  $allowances->sum('amount');
                if(empty($amount_))
                    {
$amount_ = 0;
                    }
                $amount_ = (float) $amount_;
        @endphp
        @endif

        console.log("op", "{{$amount_}}")

        @if(!$commissions->isEmpty())
        @php

            $amount___ =  $commissions->sum('amount');
                if(empty($amount___))
                    {

                    }
                $amount___ = (float) $amount___;
        @endphp
        @endif
        @if(!$overtimes->isEmpty())
        @php

            $amount__ =  \App\Employee::overtimeCalc($overtimes);
        @endphp
        @endif

        let gross_salary = basic_salary + {{$amount_}};
        basic_salary = basic_salary + {{$amount_}} - {{$totaltaxDeduction}};


        $(document).ready(function () {
            var d_id = $('#department_id').val();
            var designation_id = '{{ $employee->designation_id }}';
            getDesignation(d_id);


            $("#allowance-dataTable").dataTable({
                "columnDefs": [
                    {"sortable": false, "targets": [1]}
                ]
            });

            $("#commission-dataTable").dataTable({
                "columnDefs": [
                    {"sortable": false, "targets": [1]}
                ]
            });

            $("#loan-dataTable").dataTable({
                "columnDefs": [
                    {"sortable": false, "targets": [1]}
                ]
            });

            $("#saturation-deduction-dataTable").dataTable({
                "columnDefs": [
                    {"sortable": false, "targets": [1]}
                ]
            });

            $("#other-payment-dataTable").dataTable({
                "columnDefs": [
                    {"sortable": false, "targets": [1]}
                ]
            });

            $("#overtime-dataTable").dataTable({
                "columnDefs": [
                    {"sortable": false, "targets": [1]}
                ]
            });
        });

        $(document).on('change', 'select[name=department_id]', function () {
            var department_id = $(this).val();
            getDesignation(department_id);
        });

        function getDesignation(did) {
            $.ajax({
                url: '{{route('employee.json')}}',
                type: 'POST',
                data: {
                    "department_id": did, "_token": "{{ csrf_token() }}",
                },
                success: function (data) {
                    $('#designation_id').empty();
                    $('#designation_id').append('<option value="">{{__('Select any Designation')}}</option>');
                    $.each(data, function (key, value) {
                        var select = '';
                        if (key == '{{ $employee->designation_id }}') {
                            select = 'selected';
                        }

                        $('#designation_id').append('<option value="' + key + '"  ' + select + '>' + value + '</option>');
                    });
                }
            });
        }


        $(document).on("change", "#deduction_option", function () {
            checkDeductionOption();
        })
        let row = 1;

        $(document).on("click", ".remove_income_row", function () {
            remove_income_row();
        })
        $(document).on("click", ".insert_income_row", function () {
            insert_income_row();
        })


        function checkDeductionOption() {

            let optionid = $("#deduction_option").val()

            if (optionid == 0) {
                row = parseInt($("#_init_num").val());
                if (row < 5) {

                    let rang_row_length = $(".range_row").length;
                    if (rang_row_length == 0) {
                        row = 1;
                        insert_income_row();
                        row = 2;
                        insert_income_row();
                        row = 3;
                        insert_income_row();
                        row = 4;
                        insert_income_row();
                        row = 5;
                        insert_income_row();
                    } else {
                        if (rang_row_length == 1) {
                            row = 2;
                            insert_income_row();
                        } else if (rang_row_length == 2) {
                            row = 3;
                            insert_income_row();
                            row = 4;
                            insert_income_row();
                            row = 5;
                            insert_income_row();
                        } else if (rang_row_length == 3) {
                            row = 4;
                            insert_income_row();
                            row = 5;
                            insert_income_row();
                        } else if (rang_row_length == 4) {
                            row = 5;
                            insert_income_row();
                        }
                    }


                } else {
                    calculateMaxs(); //  every condtion ma y chaly ga

                }
                $("#income_ranges_panel").show();
                $("._no_income_tax").hide();
                $("._no_income_tax input").attr("required", false)

                $("._no_income_tax select").attr("required", false)
                $("._no_income_tax input").removeAttr("name")
                $("._no_income_tax select").removeAttr("name")

            } else {
                remove_all_income_rows();
                $("#income_ranges_panel").hide();
                $("._no_income_tax").show();
                $("._no_income_tax input").attr("required", true)
                $("._no_income_tax select").attr("required", true)
                $("._no_income_tax input").attr("name", "amount[]")
                $("._no_income_tax select").attr("name", "deduction_type[]")
            }
        }

        $(document).on("keyup", ".range_row input", function () {

            calculateMaxs();
        })

        function calculateMaxs() {
            // basic_salary
            let _index = 0;
            let _vat = 0;
            $(".range_row").each(function () {
                let min_value = 0;

                if ($(this).find(".min_income").val() != '' && $(this).find(".min_income").val() != '') {
                    min_value = parseFloat($(this).find(".min_income").val())
                }

                let min_elig = $("input[name='min_elig']").val()
                // let min_elig  = $("input[name='min_elig']").val()
                if (min_elig == "") {
                    min_elig = 0;
                }
                let max_ = min_elig - min_value;
                if (_index != 0) {

                    $prevRow = $(".range_row").eq((_index - 1));
                    let preMax = $prevRow.find(".max_income").val();
                    let preMin = $prevRow.find(".min_income").val();
                    if (preMax != '') {
                        preMax = parseFloat(preMax);
                    } else {
                        preMax = 0;
                    }
                    if (preMin != '') {
                        preMin = parseFloat(preMin);
                    } else {
                        preMin = 0;
                    }
                    max_ = preMax - min_value;
                }
                $(this).find(".max_income").val(max_)
                let tax_amount_ = 0;
                let tax_percent = 0;
                if ($(this).find(".tax_percent").val() != '' && $(this).find(".tax_percent").val() != '') {
                    tax_percent = parseFloat($(this).find(".tax_percent").val())
                }
                if (($(".range_row").length - 1) == _index) {
                    // last row
                    tax_amount_ = ((max_ * tax_percent) / 100)
                } else {
                    tax_amount_ = ((min_value * tax_percent) / 100)
                }
                _vat = _vat + tax_amount_;
                $(this).find(".tax_amount").val(tax_amount_.toFixed(2))
                _index++;
            });


            $("#vat_text").text(parseFloat(_vat).toFixed(2));
            $("#total_income_text").text(parseFloat(gross_salary - _vat).toFixed(2));
        }

        function insert_income_row() {
            let _length = $(".range_row").length;
            if (_length < 6) {

                $("#income_ranges").append(row_income_html());

            }

            calculateMaxs()
        }

        function remove_income_row() {
            let removeRow = parseInt($(".range_row").length - 1);
            if (removeRow != 0) {
                $(".range_row")[removeRow].remove();
            }
            calculateMaxs()
        }

        function remove_all_income_rows() {
            $("#income_ranges").html(``);
            row = 1;
            calculateMaxs()
        }

        function row_income_html() {
            let html_ = ``;

            if (row == 1) {
                html_ += `

                <div class="col-md-12 ">
                    <div class="form-group">
                        <label>Minimum Eligible Income</label>
<input type="number" min ="0" step="any" class="form-control " readonly value="${basic_salary.toFixed(2)}" name="min_elig" required/>
</div>
</div>

                `;
            }
            html_ += `
            <div data-r="${row}" class="w-100 range_row range_row_${row} row">

                <input type="hidden" name="deduction_type[]" value="percent" >
                <div class="col-md-3 ">
                    <div class="form-group">
                        <label>Min Income</label>
                        <input type="number" min ="0" step="any" class="form-control min_income" name="min_incom[]" required/>
                    </div>
                </div>

                <div class="col-md-3 ">
                    <div class="form-group">
                        <label>Max Income</label>
                        <input type="number" min ="0" step="any" class="form-control max_income" readonly  />
                    </div>
                </div>

                <div class="col-md-3 ">
                    <div class="form-group">
                        <label>Percentage</label>
                        <input type="number" min ="0" step="any" value="0" class="form-control tax_percent" name="amount[]" required/>
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="form-group">
                        <label>Amount</label>
                        <input type="number" value="0" min ="0" step="any" class="form-control tax_amount" readonly />
                    </div>
                </div>

            </div>`;

            if (row == 5) {
                html_ += `
            <div  class="w-100   row">


                <div class="col-md-6 ">
                    Total Taxable Amount
                </div>


                <div class="col-md-6 text-right text-end">
                    <span id="vat_text"></span>
                </div>

            </div>
<div  class="w-100   row">


                <div class="col-md-6 ">
                    Total Income Tax
                </div>


                <div class="col-md-6 text-right text-end">
                    <span id="total_income_text"></span>
                </div>

            </div>

`;
            }

            return html_;
        }

        $(document).on("change", "#a_type", function () {
            allowanceTypeChange()
        })

        function allowanceTypeChange() {
            let a_type = $("#a_type").val();
            if (a_type == "flat") {
                $(".type_amount").addClass("d-none")

                $(".type_amount input").attr('required', false)
                $(".type_amount input").prop('required', false)

                $(".a_amount").attr('readonly', false)
                $(".a_amount").prop('readonly', false)
            } else {
                console.log("remove")
                $(".type_amount").removeClass("d-none")

                $(".type_amount input").attr('required', true)
                $(".type_amount input").prop('required', true)

                $(".a_amount").attr('readonly', true)
                $(".a_amount").prop('readonly', true)
            }
            allowneceChangeAmount();
        }

        $(document).on("keyup", "#type_amount", function () {
            allowneceChangeAmount()
        })

        function allowneceChangeAmount() {
            let sal = $("#a_basic_salary").val()
            let a_type = $("#a_type").val();
            if (a_type != "flat") {
                console.log(sal, $("#type_amount").val());
                $(".a_amount").val(sal * ($("#type_amount").val() / 100))
            }
        }
    </script>
@endpush

