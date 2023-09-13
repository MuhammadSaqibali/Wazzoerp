@extends('layouts.admin')
@section('page-title')
{{__('Expenses')}}
@endsection
@push('css-page')
    <style>
        @import url({{ asset('css/font-awesome.css') }});
    
    </style>
@endpush
@push('script-page')
<script type="text/javascript" src="{{ asset('js/html2pdf.bundle.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jszip.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/pdfmake.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/vfs_fonts.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/dataTables.buttons.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/buttons.html5.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/buttons.print.min.js') }}"></script>
<script>
    
    function saveAsPDF() {
        var filename = $('#filename').val();
        var element = document.getElementById('printableArea');
        var opt = {
            margin: 0.3,
            filename: filename,
            image: {
                type: 'jpeg',
                quality: 1
            },
            html2canvas: {
                scale: 2,
                dpi: 192,
                letterRendering: true
            },
            jsPDF: {
                unit: 'in',
                format: 'A3'
            }
        };
        html2pdf().set(opt).from(element).save();

    }

    $(document).ready(function () {
    var filename = $('#filename').val();
    var table = $('#report-dataTable').DataTable({
        dom: 'lBfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: filename,
                exportOptions: {
                    columns: ':not(.d-none)'
                }
            },
            {
                extend: 'pdfHtml5',
                title: filename,
                exportOptions: {
                    columns: ':not(.d-none)'
                }
            },
            {
                extend: 'csvHtml5',
                title: filename,
                exportOptions: {
                    columns: ':not(.d-none)'
                }
            }
        ]
    });
});

</script>

    <script>
         $(document).ready(function(){
            // code to read selected table row cell data (values).
            $(".btnSelect").on('click',function(){
                // alert("hello");
                 var currentRow=$(this).closest("tr");
                 var col1=currentRow.find("td:eq(1)").html();
                 var col2=currentRow.find("td:eq(2)").html();
                 var col3=currentRow.find("td:eq(3)").html();
                 var col4=currentRow.find("td:eq(4)").html()+" "+currentRow.find("td:eq(5)").html();
                 var col5=currentRow.find("td:eq(13)").html()+" "+currentRow.find("td:eq(5)").html();
                 var col_mamount=currentRow.find("td:eq(8)").html()+" "+currentRow.find("td:eq(5)").html();
                 var col7=currentRow.find("td:eq(9)").html();
                 var col8=currentRow.find("td:eq(10)").html();
                 var col9=currentRow.find("td:eq(11)").html();
                 var col10=currentRow.find("td:eq(14)").find("img").attr('src');
                 var data=col1+"\n"+col2+"\n"+col3+"\n"+col4+"\n"+col5+"\n"+col_mamount+"\n"+col7+"\n"+col8+"\n"+col9;
                  $("#date").text(col1);
                  $("#mname").text(col2);
                  $("#category").text(col3);
                  $("#amnt").text(col4);
                  $("#mamnt").text(col5);
                  var col6 = parseInt(col_mamount);
                  var test =  currentRow.find("td:eq(5)").html();
                  $("#tamnt").text(col6 +" "+test)
                  $("#pmode").text(col7);
                  $("#paid").text(col8);
                  $("#description").text(col9);
                  $("#attachment").attr('src', col10);
                  
                  

            });
                        $(".idSelect").on('click',function(){
                 var currentRow=$(this).closest("tr");
                 var col1=currentRow.find("td:eq(0)").html();
                  $("#input").val(col1);
            });
        });




        $(document).ready(function(){
            $(".btnSelect3").on('click',function(){
                var currentRow=$(this).closest("tr");
                var col13=currentRow.find("td:eq(12)").html();
                $("#ide12").val(col13);
            });
        });



        $(document).ready(function(){
        $(".btnSelect1").on('click',function(){
            var currentRow=$(this).closest("tr");

            var col0=currentRow.find("td:eq(0)").html();
            var col1=currentRow.find("td:eq(1)").html();
                 var col2=currentRow.find("td:eq(2)").html();
                 var col3=currentRow.find("td:eq(3)").html();
                 var col4=currentRow.find("td:eq(4)").html();
                 var col5=currentRow.find("td:eq(7)").html();
                 var col7=currentRow.find("td:eq(9)").html();
                 var col8=currentRow.find("td:eq(10)").html();
                 var col9=currentRow.find("td:eq(11)").html();
                 var col10=currentRow.find("td:eq(6)").html();
                 var col11=currentRow.find("td:eq(7)").html();
                 var col12=currentRow.find("td:eq(5)").html();
                 var col13=currentRow.find("td:eq(12)").html();
                 var col14=currentRow.find("td:eq(14)").find("img").attr('src');
                 var col6=col10*col11;

                 var data=col1+"\n"+col2+"\n"+col3+"\n"+col4+"\n"+col5+"\n"+"\n"+col7+"\n"+col8+"\n"+col9;
                 // for edit modal
                 $("#datee").val(col1);
                 $("#merchant").val(col2);
                 $("#categorye").val(col3);
                 if(col3 == 'Software'){
                    $("#categorye").val('1');
                 }else if(col12 == 'Sales'){
                    $("#categorye").val('2');
                 }else{
                    $("#categorye").val('3');
                 }
                 $("#total").val(col6);
                 $("#amount").val(col4);
                 $("#totalamnt1").val(col5);
                 if(col7 == 'Cash'){
                    $("#payment").val('1');
                 }else if(col12 == 'Credit Card'){
                    $("#payment").val('2');
                 }else{
                    $("#payment").val('3');
                 }
                 $("#paide").val(col8);
                 $("#descriptions").val(col9);
                 $("#mile").val(col10);
                 $("#milesamount").val(col11);
                 if(col12 == 'USD'){
                    $("#currency").val('1');
                 }else if(col12 == 'Rs.'){
                    $("#currency").val('2');
                 }else{
                    $("#currency").val('3');
                 }
                 $("#ide").val(col13);
                 $("#attachment1").attr('src', col14);
                 


                //  alert(col13)
                 var mileageValue = col10 ;
                //  alert(mileageValue)

                 if (mileageValue !== "0"){
                    // $('#checkbox1').is(":checked");
                    // $('#checkbox1').attr('checked')
                    $( "#checkbox" ).prop( "checked", true );
                    document.getElementById('enteredmilage').classList.remove('d-none')

                 }else{
                    $( "#checkbox" ).prop( "checked", false );

                    document.getElementById('enteredmilage').classList.add('d-none')
                 
                 }
                 

            });
        });

    </script>
    <script>
  function enablemilage() {

    if ($('.form-check-input').is(":checked")) {
      document.getElementById('enteredmilage').classList.remove('d-none')
    } else {
      document.getElementById('enteredmilage').classList.add('d-none')
    }
  }

  const num1Input = document.getElementById('mile');
  const num2Input = document.getElementById('milesamount');
  const resultSpan = document.getElementById('total');

  function multiplyNumbers() {
    const num1 = parseFloat(num1Input.value);
    const num2 = parseFloat(num2Input.value);
    const result = num1 * num2;
    resultSpan.value = result.toString();
  }
  num1Input.addEventListener('input', multiplyNumbers);
  num2Input.addEventListener('input', multiplyNumbers);
</script>

@endpush

@section('action-button')
@can('create bill')
<div class=" row d-flex justify-content-end">
    <div class="col-2 my-custom-btn">
        <div class="all-button-box">
            <a href="{{ url('addExpense')}}" class="btn btn-xs btn-white btn-icon-only width-auto">
                <i class="fas fa-plus"></i> {{__('Create')}}
            </a>
        </div>
    </div>
    <div class="col-auto my-custom">
        <a href="#" class="action-btn" onclick="saveAsPDF()" data-toggle="tooltip" data-original-title="{{__('Download')}}">
            <span class="btn-inner--icon"><i class="fas fa-download"></i></span>
        </a>
    </div>

</div>
@endcan
@endsection

@section('content')
<div class="row" id="content">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body py-0 mt-2">
                <div class="table-responsive">
                    <form class="form-row  px-3" action="/filter_expence" method="post">
                        @csrf
                        <div class="form-group col-md-4">
                            <label for="sdate" class="form-control-lable">{{__('Start Date')}}</label>
                            <div class="form-icon-user">
                                <span><i class="fas fa-calendar"></i></span>
                                <input type="text" name="startdate" id="sdate" class="form-control datepicker">
                            </div>
                        </div>
                        <div class="form-group col-md-4 offset-md-1">
                            <label for="edate" class="form-control-lable">{{__('End Date')}}</label>
                            <div class="form-icon-user">
                                <span><i class="fas fa-calendar"></i></span>
                                <input type="text" name="enddate" id="edate" class="form-control datepicker">
                            </div>
                        </div>
                        <div class="form-group offset-md-1 col-md-2">
                            <label for="filter" class="form-control-lable"></label>
                            <div class="form-icon-user">
                                <button class="btn btn-danger form-control" type="submit">Filter</button>
                            </div>
                        </div>
                    </form>
                    <div id="printableArea" class="table-responsive pt-4 container ">
                        <table class="table table-striped mb-0" id="report-dataTable">
                            <thead>
                                <tr>
                                    <th> {{__('Expense Id')}}</th>
                                    <th> {{__('Expense Date')}}</th>
                                    <th> {{__('Merchant Name')}}</th>
                                    <th> {{__('Category')}}</th>
                                    <th  class="d-none" > {{__('Amount')}}</th>
                                    <th  class="d-none" > {{__('Amount')}}</th>
                                    <th  class="d-none" > {{__('Amount')}}</th>
                                    <th  class="d-none" > {{__('Attachment')}}</th>
                                    <th  class="d-none" > {{__('Currency')}}</th>
                                    <th class="d-none" > {{__('Miles')}}</th>
                                    <th class="d-none" > {{__('Amount/Mile')}}</th>
                                    <th>{{__('Total Amount')}}</th>
                                    <th>{{__('Payment Mode')}}</th>
                                    <th class="d-none" >{{__('Paid Through')}}</th>
                                    <th class="d-none" >{{__('Description')}}</th>
                                    <th> {{__('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bills as $bill)
                                <tr>
                                    <td class="Id">

                                        <a href="">#EXPENSE 00{{ $bill->id}}</a>

                                    </td>

                                    <td> {{$bill->date}} </td>

                                    <td>{{$bill->m_name}}</td>
                                    @foreach ($category as $row)
                                    @if($row->id == $bill->c_id)
                                    <td>{{$row->name}}</td>
                                    @endif
                                    @endforeach
                                    <td class="d-none" >{{$bill->amount}}</td>
                                    @if($bill->currency == 1)
                                    <td class="d-none" >USD</td>
                                    @elseif($bill->currency == 2)
                                    <td class="d-none" >Rs.</td>
                                    @elseif($bill->currency == 3)
                                    <td class="d-none" >Le</td>
                                    @endif
                                    <td class="d-none" >{{$bill->mile}}</td>
                                    <td class="d-none" >{{$bill->m_amount}}</td>
                                    <td>{{$bill->totalexp}}
                                    @if($bill->currency == 1)
                                    USD
                                    @elseif($bill->currency == 2)
                                    Rs.
                                    @elseif($bill->currency == 3)
                                    Le.
                                    @endif
                                    </td>
                                    @if($bill->payment_mode == 1)
                                    <td>Cash</td>
                                    @elseif($bill->payment_mode == 2)
                                    <td>Credit Card</td>
                                    @elseif($bill->payment_mode == 3)
                                    <td>Debit Card</td>
                                    @endif
                                    <td class="d-none" >{{$bill->paid_through}}</td>
                                    <td class="d-none" >{{$bill->description}}</td>
                                    <td class="d-none" >
                                        
                                        {{ $bill->id}}
                                        
                                    </td>
                                    <td class="d-none" >{{$bill->totalm_amount}}</td>
                                    <td class="d-none"><img src="{{ asset('uploads/expense/'.$bill->attachment)}}" width="100px;" height="80px">
                                    </td>
                                    <td class="col-2 my-custom-btn">
                                        <div class="-button-box d-flex">
                                            <a href="#" data-size="lg"   data-title="{{__('Bill Detail')}}" class="btnSelect edit-icon bg-success"  type="button"  data-toggle="modal" data-target="#view" data-original-title="{{__('View Detail')}}"><i class="fas fa-eye"></i></a>
                                            <a href="#" data-size="lg" data-title="{{__('Bill Detail')}}" class="edit-icon btnSelect1" type=" button" data-toggle="modal" data-target="#edit" data-original-title="{{__('Edit Detail')}}"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="{{ url('/receipt',$bill->id)}}" data-size="lg"   data-title="{{__('Print Detail')}}" class="btnSelect edit-icon bg-primary"  type="button" data-original-title="{{__('Print Detail')}}"> <i class="fas fa-print"></i></a>
                                            <a href="#" data-size="lg" data-title="{{__('Bill Detail')}}" class="delete-icon btnSelect3" type=" button" data-toggle="modal" data-target="#delete" data-original-title="{{__('Delete Detail')}}"><i class="fas fa-trash"></i></a>
                                           
                                            
                                        </div>
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
<style>
    .hover:hover{
        color: blue;
    }
    #attachment:hover{
        width: 200px;
        height: 600px;
    }
</style>
<!-- Modal -->
<div class="modal fade" id="view" tabindex="-1" role="dialog" aria-labelledby="viewLabel" aria-hidden="true">
    <div class="modal-dialog bg-transparent" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewLabel">View Details</h5>
                <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                    <a class="hover">
                    Close
                    </a>
                <span aria-hidden="true" class="text-dark bg-danger rounded-circle px-2">&times;</span>
                </button>
            </div>
            <div class="modal-body text-dark">
                <div style="display: flex; justify-content:space-between; margin-top:10px; padding: 0px 20px 0px 20px;">
                    <div>
                        <p style=" margin-bottom:0px;">{{__('Attacmnet')}} : </p>
                    </div>
                    <div >
                        <img src="" id="attachment" width="100px;" height="80px" style=" margin-bottom:0px;">
                        
                    </div>
                </div> 
                <div style="display: flex; justify-content:space-between; margin-top:10px; padding: 0px 20px 0px 20px;">
                    <div>
                        <p style=" margin-bottom:0px;">{{__('Expense Date')}} : </p>
                    </div>
                    <div >
                        <p style=" margin-bottom:0px;" id="date"></p>
                    </div>
                </div>
        
                <div style="display: flex; justify-content:space-between; margin-top:10px; padding: 0px 20px 0px 20px;">
                    <div>
                        <p style=" margin-bottom:0px;">{{__('Merchant Name')}} : </p>
                    </div>
                    <div>
                        <p style=" margin-bottom:0px;" id="mname">w</p>
                    </div>
                </div>
                <div style="display: flex; justify-content:space-between; margin-top:10px; padding: 0px 20px 0px 20px;">
                    <div>
                        <p style=" margin-bottom:0px;">{{__('Category')}} : </p>
                    </div>
                    <div>
                        <p style=" margin-bottom:0px;" id="category">b</p>
                    </div>
                </div>
                <p style=" margin-bottom:0px;border-bottom: dashed 2px #000"></p>

                <div style="display: flex; justify-content:space-between; margin-top:10px; padding: 0px 20px 0px 20px;">
                    <div>{{__('Expense Amount')}} : </div>
                    <div  id="amnt">x</div>
                </div>
                <div style="display: flex; justify-content:space-between; margin-top:10px; padding: 0px 20px 0px 20px;">
                    <div>{{__('Milage Expense')}} : </div>
                    <div id="mamnt">y</div>
                </div>
                    <p style=" margin-bottom:0px; border-bottom: dashed 2px #000"></p>
                <div style="display: flex; justify-content:space-between; margin-top:10px; padding: 0px 20px 0px 20px;">
                    <div>
                        <p style=" margin-bottom:0px;">{{__('Total Expense')}} : </p>
                    </div>
                    <div>
                        <p style=" margin-bottom:0px;" id="tamnt">x</p>
                    </div>
                </div>

                <div style="display: flex; justify-content:space-between; margin-top:15px; padding: 0px 20px 0px 20px;">
                    <div>
                        <p style=" margin-bottom:0px;">{{__('Payment Mode')}} : </p>
                    </div>
                
                    <div>
                        <p style=" margin-bottom:0px;" id="pmode">{{__('Debit Card')}}</p>
                    </div>
                </div>
                <div style="display: flex; justify-content:space-between; margin-top:10px; padding: 0px 20px 0px 20px;">
                    <div>
                        <p style=" margin-bottom:0px;">{{__('Payment Through')}} : </p>
                    </div>
                    <div>
                        <p style=" margin-bottom:0px;" id="paid">i</p>
                    </div>
                </div>
                <div style="display: flex; justify-content:space-between; margin-top:10px; padding: 0px 20px 0px 20px;">
                    <div>
                        <p style=" margin-bottom:0px;">{{__('Description')}} : </p>
                    </div>
                    <div>
                        <p style=" margin-bottom:0px;" id="description">i</p>
                    </div>
                </div>
            </div>
        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>\
            </div>
    </div>
</div>


<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="EditLabel" aria-hidden="true">
    <div class="modal-dialog bg-transparent" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EditLabel">Edit Details</h5>
                <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                    <a class="hover">
                    Close
                    </a>
                <span aria-hidden="true" class="text-dark bg-danger rounded-circle px-2">&times;</span>
                </button>
            </div>
            <div class="modal-body text-dark">
                <div class="container ">
                    <form class="p-3 mx-auto bg-white rounded-lg mt-4 " method="post" action="/edit_expence" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row  px-3">
                            <div class="form-group col-md-4">
                                <label for="datee" class="form-control-lable">{{__('Expense Date')}}</label>
                                <div class="form-icon-user">
                                    <span><i class="fas fa-calendar"></i></span>
                                    <input type="text" name="date" id="datee" class="form-control datepicker">
                                    <input type="hidden" name="ide" id="ide" >
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="merchant" class="form-control-lable">{{__('Merchant')}}</label>
                                <input type="text" class="form-control" name="merchant" id="merchant" placeholder="{{__('Enter Merchant Name')}}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="attachment" class="form-control-lable">{{__('Attachment')}}</label>
                                    <div class="choose-file form-group">
                                        <label for="attachment" class="form-control-label">
                                            <div>{{__('Choose file here')}}</div>
                                            <input type="file" class="form-control" name="attachment" id="attachment" data-filename="attachment_create" >
                                        </label>
                                        <p class="attachment_create"></p>
                                        
                                    </div>
                            </div>
                        </div>
                        <div class="form-row px-3">
                                <div class="form-group col-md-6 m-0">
                                    <label for="categorye" class="form-control-lable">{{__('Category')}}</label>
                                    <select name="category" class=" form-control " id="categorye" style="height:38px;border:1px solid lightgrey;border-radius:8px;font-size: 12px; font-weight: bold; color: #898989;padding: 0px 10px;">
                                    @foreach($category as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            <div class="form-group col-md-6 m-0">
                                <label for="amount" class="form-control-lable"> {{__('Amount')}}</label>
                                <div class="row">
                                    <div class="col-md-9 col-sm-8">
                                        <input type="number " class="form-control" name="amount" id="amount" placeholder="{{__('Enter Amount')}}" required>
                                    </div>
                                    <div class="col-md-3 col-sm-4">
                                        <select id="currency" class="selectid" name="currency" style="height:38px;border:1px solid lightgrey;border-radius:8px;font-size: 12px; font-weight: bold; color: #898989;" >
                                        <option value="1">USD</option>
                                        <option value="2">Rs.</option>
                                        <option value="3">Le.</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row px-4 my-2">
                            <div class="form-check d-flex alighn-center" onchange="enablemilage()">
                                <input class="form-check-input" type="checkbox" value="1" id="checkbox" style="margin-top: 7px;">
                                <label class="form-check-label " for="flexCheckDefault">
                                {{__('Add Milage')}}
                                </label>
                            </div>
                        </div>
                        <div class="form-row px-3 d-none" id="enteredmilage">
                            <div class="form-group col-md-4">
                                <label for="mile" class="form-control-lable">{{__('Miles')}}</label>
                                <input type="number" class="form-control" name="mile" id="mile" placeholder="{{__('Enter Miles')}}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="milesamount" class="form-control-lable">{{__('Enter Amount')}}</label>
                                <input type="number" class="form-control" name="milesamount" id="milesamount" placeholder="{{__('Enter Amount/mile')}}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="total" class="form-control-lable">{{__('Total Amount/Miles')}}</label>
                                <input type="number" class="form-control " name="total" id="total" placeholder="{{__('NaN')}}" readonly></input>

                            </div>
                        </div>
                        <div class="form-row px-3">
                            <div class="form-group col-md-6">
                                <label for="payment" class="form-control-lable">{{__('Payment Mode')}}</label>
                                <select name="payment" class="selectid form-control" name="payment" id="payment" style="height:38px;border:1px solid lightgrey;border-radius:8px;font-size: 12px; font-weight: bold; color: #898989;padding: 0px 10px;">
                                <option selected value="1">{{__('Cash')}}</option>
                                <option value="2">{{__('Credit Card')}}</option>
                                <option value="3">{{__('Debit Card')}}</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6 m-0">
                                <label for="paid" class="form-control-lable">{{__('Paid Through')}}</label>
                                <select name="paid" class="form-control" id="paide"style="height:38px;border:1px solid lightgrey;border-radius:8px;font-size: 12px; font-weight: bold; color: #898989;padding: 0px 10px;">
                                @foreach($bank as $row)
                                <option selected value="{{$row->holder_name}}">{{$row->holder_name}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row px-3">
                            <div class="form-group col">
                                <label for="descriptions" class="form-control-lable">{{__('Description')}}</label>
                                <textarea type="text" class="form-control" name="description" id="descriptions" required></textarea>
                                -{{__('This Expense requires description')}}
                            </div>
                        </div>

                        <div class="modal-footer float-right">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Save changes</button>
                        </div>            
                    </form>
                </div>
               
            </div>
        </div>
            
    </div>
</div>

<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="EditLabel" aria-hidden="true">
    <div class="modal-dialog bg-transparent" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EditLabel">Delete Details</h5>
                <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                    <a class="hover">
                    Close
                    </a>
                <span aria-hidden="true" class="text-dark bg-danger rounded-circle px-2">&times;</span>
                </button>
            </div>
            <div class="modal-body text-dark">
                <h4 class="px-3 pb-3">Are you sure you want to delete this data?</h4>
                <form action="/delete" method="post">
                    @csrf
                        <input type="hidden" name="ide12" id="ide12" >
                        <div class="modal-footer float-right">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                </form>
            </div>
        </div>
            
    </div>
</div>


@endsection