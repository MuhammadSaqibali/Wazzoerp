@extends('layouts.admin')
@section('page-title')
{{__('Add Expense')}}
@endsection
@section('content')
<div class="container ">
  <form class="p-3 mx-auto bg-white w-75 rounded-lg mt-4 " method="post" action="/insert_expence" enctype="multipart/form-data">
    @csrf
    <div class="form-row  px-3">
      <div class="form-group col-md-4">
        <label for="datee" class="form-control-lable">{{__('Expense Date')}}</label>
        <div class="form-icon-user">
          <span><i class="fas fa-calendar"></i></span>
          <input type="text" name="date" id="datee" class="form-control datepicker">
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
                    <input type="file" class="form-control" name="attachment" id="attachment" data-filename="attachment_create" required>
                </label>
                <p class="attachment_create"></p>
            </div>
        </div>

    </div>
    
    <div class="form-row px-3">
      <div class="form-group col-md-6 m-0">
        <label for="category" class="form-control-lable">{{__('Category')}}</label>
        <select name="category" class="form-control select2" id="category">
          @foreach($category as $row)
          <option selected value="{{$row->id}}">{{$row->name}}</option>
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
            <select id="amount" name="currency" class="form-control select2" required>
              <option selected value="1">{{__('USD')}}</option>
              <option value="2">{{__('RS.')}}</option>
              <option value="3">{{__('LE')}}</option>
            </select>
          </div>
        </div>
      </div>
    </div>
    <div class="form-row px-4 my-2">
      <div class="form-check d-flex alighn-center" onchange="enablemilage()">
        <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" style="margin-top: 7px;">
        <label class="form-check-label " for="flexCheckDefault">
          {{__('Add Milage')}}
        </label>
      </div>
    </div>
    <div class="form-row px-3 d-none" id="enteredmilage">
      <div class="form-group col-md-4">
        <label for="mile" class="form-control-lable">{{__('Miles')}}</label>
        <input type="number" class="form-control" value="0" name="mile" id="mile" placeholder="{{__('Enter Miles')}}">
      </div>
      <div class="form-group col-md-4">
        <label for="milesamount" class="form-control-lable">{{__('Enter Amount')}}</label>
        <input type="number" class="form-control" value="0" name="milesamount" id="milesamount" placeholder="{{__('Enter Amount/mile')}}">
      </div>
      <div class="form-group col-md-4">
        <label for="total" class="form-control-lable">{{__('Total Amount/Miles')}}</label>
        <input type="number" class="form-control " value="0" name="total" id="total" placeholder="{{__('NaN')}}" readonly></input>

      </div>
    </div>
    <div class="form-row px-3">
      <div class="form-group col-md-6">
        <label for="payment" class="form-control-lable">{{__('Payment Mode')}}</label>
        <select name="payment" class="form-control select2" name="payment" id="payment">
          <option selected value="1">{{__('Cash')}}</option>
          <option value="2">{{__('Credit Card')}}</option>
          <option value="3">{{__('Debit Card')}}</option>
        </select>
      </div>
      <div class="form-group col-md-6 m-0">
        <label for="paid" class="form-control-lable">{{__('Paid Through')}}</label>
        <select name="paid" class="form-control select2" id="paid">
          @foreach($bank as $row)
          <option selected value="{{$row->holder_name}}">{{$row->holder_name}}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="row px-3">
      <div class="form-group col">
        <label for="description" class="form-control-lable">{{__('Description')}}</label>
        <textarea type="text" class="form-control" name="description" id="description" required></textarea>
        -{{__('This Expense requires description')}}
      </div>
    </div>

    <div class="d-flex justify-content-end">
      <button class="btn btn-danger" type="submit">{{__('Add')}}</button>
    </div>
  </form>
</div>
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
@endsection