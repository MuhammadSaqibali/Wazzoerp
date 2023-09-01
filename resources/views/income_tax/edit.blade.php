<div class="card bg-none card-box">
    {{Form::model($loan,array('route' => array('income_tax.update', $loan->id), 'method' => 'PUT')) }}
    {{ Form::hidden('created_by',$loan->created_by, array()) }}
    <div class="card-body p-0">
      <div class="row">
          @for($i = 1;$i<=6;$i++)
              @php
              $key ='group_'.$i;
              @endphp
              <div class="row">
                  <div class="col-md-12">
                      <h4>Group {{$i}}</h4>
                  </div>
                  <div class="form-group col-md-4">
                      {{ Form::label('min_salary', __('Min Salary'),['class'=>'form-control-label']) }}
                      {{ Form::number('group_'.$i.'[min_salary]',null, array('class' => 'form-control ','required'=>'required','value' =>$loan->$key['min_salary'])) }}
                  </div>
                  <div class="form-group col-md-4">
                      {{ Form::label('max_salary', __('Max Salary'),['class'=>'form-control-label']) }}
                      {{ Form::number('group_'.$i.'[max_salary]',null, array('class' => 'form-control ','required'=>'required')) }}
                  </div>
                  <div class="form-group col-md-4">
                      {{ Form::label('tax_percent', __('Tax'),['class'=>'form-control-label']) }}
                      {{ Form::number('group_'.$i.'[tax_percent]',null, array('class' => 'form-control ','required'=>'required','min' =>0,'max' =>100)) }}
                  </div>
              </div>
          @endfor
        <div class="col-12">
            <input type="submit" value="{{__('Update')}}" class="btn-create badge-blue">
            <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>

    </div>
    {{Form::close()}}
</div>
