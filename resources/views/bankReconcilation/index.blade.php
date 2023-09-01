@extends('layouts.admin')
@section('page-title')
{{__('Bank Reconcilation')}}
@endsection
@push('script-page')
<script type="text/javascript" src="{{ asset('js/html2pdf.bundle.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jszip.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/pdfmake.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/vfs_fonts.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/dataTables.buttons.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/buttons.html5.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/buttons.print.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    var filename = $('#filename').val();

    function saveAsPDF() {
        var element = document.getElementById('printableArea');
        var opt = {
            margin: 0.3,
            filename: filename,
            image: {type: 'jpeg', quality: 1},
            html2canvas: {scale: 4, dpi: 72, letterRendering: true},
            jsPDF: {unit: 'in', format: 'A4'}
        };
        html2pdf().set(opt).from(element).save();

    }

    $(document).ready(function () {
        var filename = $('#filename').val();
        $('#report-dataTable').DataTable({
            dom: 'lBfrtip',
            buttons: [
                {
                    extend: 'excel',
                    title: filename
                },
                {
                    extend: 'pdf',
                    title: filename
                }, {
                    extend: 'csv',
                    title: filename
                }

            ]
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#attachment').on('change', function(e) {
            var file = e.target.files[0];
            if (file) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    var pdfData = e.target.result;
                    var pdfURL = URL.createObjectURL(new Blob([pdfData], { type: 'application/pdf' }));

                    var embedCode = '<embed src="' + pdfURL + '" width="500" height="600" type="application/pdf">';
                    $('#pdfContainer').html(embedCode);
                };

                reader.readAsArrayBuffer(file);
            }
        });
    });
</script>
@endpush
@section('content')
<div class="card">
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('pdf.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label for="attachment" class="form-control-lable">{{__('Chose file here')}}</label>
                            <div class="choose-file form-group">
                                <label for="attachment" class="form-control-label">
                                    <div>{{__('Bank Statement')}}</div>
                                    <input type="file" class="form-control"name="pdf_file" accept=".pdf" id="attachment" data-filename="attachment_create" required>
                                </label>
                                <p class="attachment_create"></p>
                            </div>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-danger mt-4">Upload</button>
                    </div>
                </div> 
            </form>  
            <div id="pdfContainer"></div>
        </div>
        <div class="col-md-6">
            @section('action-button')
                <div class="row d-flex justify-content-end">
                    <div class="col">
                        {{ Form::open(array('route' => array('bankReconcilation.index'),'method'=>'get','id'=>'transaction_report')) }}
                        <div class="all-select-box">
                            <div class="btn-box">
                                {{Form::label('start_month',__('Start Month'),['class'=>'text-type'])}}
                                {{Form::month('start_month',isset($_GET['start_month'])?$_GET['start_month']:date('Y-m'),array('class'=>'month-btn form-control'))}}
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="all-select-box">
                            <div class="btn-box">
                                {{Form::label('end_month',__('End Month'),['class'=>'text-type'])}}
                                {{Form::month('end_month',isset($_GET['end_month'])?$_GET['end_month']:date('Y-m', strtotime("-5 month")),array('class'=>'month-btn form-control'))}}
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="all-select-box">
                            <div class="btn-box">
                                {{Form::label('account',__('Account'),['class'=>'text-type'])}}
                                {{ Form::select('account', $account,isset($_GET['account'])?$_GET['account']:'', array('class' => 'form-control select2')) }}
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="all-select-box">
                            <div class="btn-box">
                                {{ Form::label('category', __('Category'),['class'=>'text-type']) }}
                                {{ Form::select('category', $category,isset($_GET['category'])?$_GET['category']:'', array('class' => 'form-control select2')) }}
                            </div>
                        </div>
                    </div>
                    <div class="col-auto my-custom">
                        <a href="#" class="apply-btn" onclick="document.getElementById('transaction_report').submit(); return false;" data-toggle="tooltip" data-original-title="{{__('apply')}}">
                            <span class="btn-inner--icon"><i class="fas fa-search"></i></span>
                        </a>
                        <a href="{{route('bankReconcilation.index')}}" class="reset-btn" data-toggle="tooltip" data-original-title="{{__('Reset')}}">
                            <span class="btn-inner--icon"><i class="fas fa-trash-restore-alt"></i></span>
                        </a>
                        <a href="#" class="action-btn" onclick="saveAsPDF()" data-toggle="tooltip" data-original-title="{{__('Download')}}">
                            <span class="btn-inner--icon"><i class="fas fa-download"></i></span>
                        </a>
                    </div>
                </div>
                {{ Form::close() }}
            @endsection
            <div >
                <div class="row mt-3">
                    <div class="col">
                        <input type="hidden" value="{{$filter['category'].' '.__('Category').' '.__('Transaction').' '.'Report of'.' '.$filter['startDateRange'].' to '.$filter['endDateRange']}}" id="filename">
                        <div class="card p-4 mb-4">
                            <h5 class="report-text gray-text mb-0">{{__('Report')}} :</h5>
                            <h5 class="report-text mb-0">{{__('Transaction Summary')}}</h5>
                        </div>
                    </div>
                    @if($filter['account']!= __('All'))
                        <div class="col">
                            <div class="card p-4 mb-4">
                                <h5 class="report-text gray-text mb-0">{{__('Account')}} :</h5>
                                <h5 class="report-text mb-0">{{$filter['account']}}</h5>
                            </div>
                        </div>
                    @endif
                    @if($filter['category']!= __('All'))
                        <div class="col">
                            <div class="card p-4 mb-4">
                                <h5 class="report-text gray-text mb-0">{{__('Category')}} :</h5>
                                <h5 class="report-text mb-0">{{$filter['category']}}</h5>
                            </div>
                        </div>
                    @endif
                    <div class="col">
                        <div class="card p-4 mb-4">
                            <h5 class="report-text gray-text mb-0">{{__('Duration')}} :</h5>
                            <h5 class="report-text mb-0">{{$filter['startDateRange'].' to '.$filter['endDateRange']}}</h5>
                        </div>
                    </div>
                </div>
        
                <div class="row">
                    @foreach($accounts as $account)
                        <div class="col-xl-3 col-md-6 col-lg-3">
                            <div class="card p-4 mb-4">
                                @if($account->holder_name =='Cash')
                                    <h5 class="report-text gray-text mb-0">{{$account->holder_name}}</h5>
                                @elseif(empty($account->holder_name))
                                    <h5 class="report-text gray-text mb-0">{{__('Stripe / Paypal')}}</h5>
                                @else
                                    <h5 class="report-text gray-text mb-0">{{$account->holder_name.' - '.$account->bank_name}}</h5>
                                @endif
                                <h5 class="report-text mb-0">{{\Auth::user()->priceFormat($account->total)}}</h5>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive pt-4" id="printableArea">
                                <table class="table table-striped mb-0" id="report-dataTable">
                                    <thead>
                                    <tr>
                                        <th>{{__('Date')}}</th>
                                        <th>{{__('Account')}}</th>
                                        <th>{{__('Type')}}</th>
                                        <th>{{__('Category')}}</th>
                                        <th>{{__('Description')}}</th>
                                        <th>{{__('Amount')}}</th>
                                    </tr>
                                    </thead>
        
                                    <tbody>
                                    @foreach ($transactions as $transaction)
                                        <tr>
                                            <td>{{ \Auth::user()->dateFormat($transaction->date)}}</td>
                                            <td>@if ($transaction->account==5)
                                                Custom Expense
                                                @else
                                                    @if(!empty($transaction->bankAccount()) && $transaction->bankAccount()->holder_name=='Cash')
                                                        {{$transaction->bankAccount()->holder_name}}
                                                    @else
                                                        {{!empty($transaction->bankAccount())?$transaction->bankAccount()->bank_name.' '.$transaction->bankAccount()->holder_name:'-'}}
                                                    @endif
                                                @endif
                                            </td>
                                            <td>{{  $transaction->type}}</td>
                                            <td>{{  $transaction->category}}</td>
                                            <td>{{  !empty($transaction->description)?$transaction->description:'-'}}</td>
                                            <td>
                                                @if ($transaction->account==5)
                                                {{\Auth::user()->priceFormat($transaction->amount)}}
                                                @else
                                                    {{\Auth::user()->priceFormat($transaction->amount)}}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
