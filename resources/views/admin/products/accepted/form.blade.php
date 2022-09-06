@inject('category',App\Models\Category)
@php
$recievedtime=['oneWeek'=>'اسبوع'
                ,'twoWeek'=>'اسبوعين'
                ,'byOrder'=>'بالطلب'];
$categories = $category->whereNull('parent_id')->get();

@endphp
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
        <label for="">التصنيف الرئيسي</label>
        <select class="form-control" name="category_id" id="category_id">
            <option value="" disabled selected>  التصنيف الرئيسي</option>
            @foreach ($categories as $categories)

            <option value="{{$categories->id}}">{{$categories->name}}</option>

            @endforeach

        </select>

        @if ($errors->has('category_id'))
                        <span class="help-block">
                                            <strong style="color: rgb(151, 8, 8)">{{ $errors->first('category_id') }}</strong>
                                        </span>
                    @endif
    </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
        <label for="">التصنيف الفرعي</label>
        <select class="form-control" name="subCategory_id" id="child_id">
            <option value="" disabled selected> اختيار التصنيف الرئيسي اولا</option>

        </select>
        @if ($errors->has('subCategory_id'))
                        <span class="help-block">
                                            <strong style="color: rgb(151, 8, 8)">{{ $errors->first('subCategory_id') }}</strong>
                                        </span>
                    @endif
        </div>
    </div>

</div>


<div class="div">
    <div class="row">
        <div class="col-md-6">
            {!! \App\MyHelper\Field::text('name' , 'اسم المنتج ' ) !!}

        </div>

        <div class="col-md-6">
            {!! \App\MyHelper\Field::number('original_quantity' , ' الكمية ' ) !!}

        </div>
    </div>
    <div class="div">
        <div class="row">
            <div class="col-md-6">
                {!! \App\MyHelper\Field::text('size' , ' المقاسات ' ) !!}

            </div>

            <div class="col-md-6">
                {!! \App\MyHelper\Field::text('material' , ' الخامات ' ) !!}

            </div>
        </div>


</div>
<div class="div">
    <div class="row">
        <div class="col-md-12">
            {!! \App\MyHelper\Field::text('colorName' , ' اسم اللون ' ) !!}
        </div>

       

    </div>
</div>
<div class="div">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>السعر  </label>
                <input type="number" name="price" value="{{$model->price}}" placeholder="السعر"  class="form-control" >
            </div>
            @if ($errors->has('price'))
                        <span class="help-block">
                                            <strong style="color: rgb(151, 8, 8)">{{ $errors->first('price') }}</strong>
                                        </span>
                    @endif
        </div>

            <div class="col-md-6">
                <div class="form-group">
                <label for="">مده التسليم </label>
                <select class="form-control" name="receivedTime" id="category_id">
                    <option value="" disabled selected>   مده التسليم</option>
                    @foreach ($recievedtime as $key=>$value)
                    <option value="{{$key}}">{{$value}}</option>
                    @endforeach
                     </select>
                     @if ($errors->has('receivedTime'))
                        <span class="help-block">
                                            <strong style="color: rgb(151, 8, 8)">{{ $errors->first('receivedTime') }}</strong>
                                        </span>
                    @endif
            </div>
            </div>


    </div>
</div>

<div class="div">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>قيمة الخصم</label>
                <input type="number" name="discountValue" value="{{$model->discountValue}}" placeholder=" قيمة الخصم"  class="form-control">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>نسبه الخصم</label>
                <input type="number" name="discountPercent" value="{{$model->discountPercent}}" placeholder=" نسبه الخصم"  class="form-control">
            </div>
        </div>

</div>





@if(session()->has('error'))
    <div class="alert alert-danger">
        {{session()->get('error')}}
    </div>

@endif
<div class="form-group">
    <label>الوصف</label>
    <textarea class="ckeditor form-control" name="description">{{ $model->description }}  </textarea>
 <br>


{!! \App\MyHelper\Field::fileWithPreview('attachments',__('مرفقات'),true) !!}

        @if(!empty($model->attachment))

            @foreach($model->attachmentRelation()->whereNull('usage')->get() as  $attachment)

                <div class="col-md-3" id="removable{{$attachment->id}}">
                    <div class="text-center"
                         style="width: 100%;color: white;background-color: black;font-size: 3rem;font-weight: bolder;">
                        {{$loop->iteration}}
                    </div>
                    <img src="{{asset($attachment->path)}}" class="img-responsive" alt="">
                    <div class="clearfix"></div>
                    <button id="{{$attachment->id}}" data-token="{{ csrf_token() }}"
                            data-route="{{URL::route('supplier.photo.destroy',$attachment->id)}}"
                            type="button" class="destroy btn btn-danger btn-xs btn-block">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
                <br>
                <br>
            @endforeach
            <div class="clearfix"></div>
            <br>
        @endif
<br>
@push('scripts')
    <script>
        $('#category_id').on('change', function () {
            var child_id = this.value;
            if (child_id != null && child_id != "") {
                $.ajax({
                    url: "{{url('api/v1/child')}}",
                    type: "get",
                    data: {
                        child_id: child_id,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {

                        if (result) {
                            $('#child_id').empty();
                            $('#child_id').append('<option value="">اختر  التصنيف الفرعي</option>');
                            $.each(result, function (index, child) {
                                $("#child_id").append('<option value="' + child.id + '">' + child.name + '</option>');
                            });
                            $("#child_id").trigger('change');
                        } else {
                            $("#child_id").empty();
                            $("#child_id").trigger('change');
                        }
                        }
                    });
                }




        });

    </script>

    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

@endpush
