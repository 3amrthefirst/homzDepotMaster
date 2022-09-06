<div class="modal fade" id="addQuantity{{$record->id}}" tabindex="-1" role="dialog"
     aria-labelledby="addquantity{{$record->id}}Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">إضافة كميات</h5>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            
            {!! Form::open([

                'url' => url('supplier/product/addQuantity/'.$record->id),
                'method' => 'POST'
            ]) !!}
            <div class="modal-body">

            <h3 >  اضف الكمية </h3>
            <div class="form-group">
            <input class="form-control" id="quantity" rows="3" name='quantity' type="number" placeholder="الكمية">
            @if ($errors->has('quantity'))
            <span class="help-block">
                <strong style="color: rgb(151, 8, 8)">{{ $errors->first('quantity') }}</strong>
            </span>
        @endif
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">تأكيد</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    إغلاق
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
