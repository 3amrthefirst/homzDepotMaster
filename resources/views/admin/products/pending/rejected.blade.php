<div class="modal fade" id="rejected" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> رفض منتج</h5>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open([

                'url' => url('admin/products/pending/' .$data->id.'/reject'),
                'method' => 'put'
            ]) !!}
            <div class="modal-body">

            <h3 > هل انت متاكد من عمليه الرفض</h3>
            <div class="form-group">
            <label for="reason"> سبب الرفض</label>
            <textarea class="form-control" id="reason" rows="3" name='reason'></textarea>
            @if ($errors->has('reason'))
                <span class="help-block">
                    <strong>{{ $errors->first('reason') }}</strong>
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
