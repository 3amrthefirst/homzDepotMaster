{!! \App\MyHelper\Field::text('name', 'الاسم ') !!}
{!! \Helper\Field::text('link', 'الرابط') !!}
{!! \App\MyHelper\Field::fileWithPreview('attachments', __('الصورة')) !!}
{!! \Helper\Field::select('type', 'المساحه الاعلانيه الخاصه ب', [
    '0' => 'لوحة الاعلانات',
    '1' => ' الاعلانات الصغيرة اسفل لوحة الاعلانات',
    '2' => 'الفئات',
    '3' => 'اسفل الصفحة',
    '4' => 'منتجات التصنيفات',
]) !!}

<br>
<br>
<br>
<br>
<br>
<br>


@if (!empty($model->attachment))

    @foreach ($model->attachmentRelation()->whereNull('usage')->get()
    as $attachment)
        <div class="col-md-3" id="removable{{ $attachment->id }}">
            <div class="text-center"
                style="width: 100%;color: white;background-color: black;font-size: 3rem;font-weight: bolder;">
                {{ $loop->iteration }}
            </div>
            <img src="{{ asset($attachment->path) }}" class="img-responsive" alt="">
            <div class="clearfix"></div>
            <button id="{{ $attachment->id }}" data-token="{{ csrf_token() }}"
                data-route="{{ URL::route('admin.photo.destroy', $attachment->id) }}" type="button"
                class="destroy btn btn-danger btn-xs btn-block">
                <i class="fa fa-trash"></i>
            </button>
        </div>
        <br>
        <br>
    @endforeach
    <div class="clearfix"></div>
    <br>
@endif
