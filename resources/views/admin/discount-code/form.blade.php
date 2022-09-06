@php
$status=['percent'=>'نسبه'
                ,'value'=>'قيمه'];

@endphp
{!! \App\MyHelper\Field::text('code' , 'الكود ' ) !!}
{!! \App\MyHelper\Field::number('value' , 'قيمة او نسبه الخصم  ' ) !!}
{!! \App\MyHelper\Field::number('total_price' , ' (اختياري)اقل سعر للطلب' ) !!}

<div class="col-md-12">
    <div class="form-group">
    <label for=""> حدد استخدام الكود نسبه ام قيمه </label>
    <select class="form-control" name="status" >
        @foreach ($status as $key=>$value)
        <option value="{{$key}}">{{$value}}</option>
        @endforeach
         </select>
         @if ($errors->has('status'))
            <span class="help-block">
                                <strong style="color: rgb(151, 8, 8)">{{ $errors->first('status') }}</strong>
                            </span>
        @endif
</div>
{!! \App\MyHelper\Field::number('max_value' , 'اقصي قيمه للخصم' ) !!}

{!! \App\MyHelper\Field::number('maxUser' , ' عدد المستخدمين المسموح لهم باستخدام الكود' ) !!}



@push('scripts')


@endpush
