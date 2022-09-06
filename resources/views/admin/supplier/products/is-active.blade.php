<div class="modal fade" id="active" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> الموافقة على تفعيل جميع المنتجات</h5>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open([

                'url' => url('admin/suppliers/products/' .$supplier->id.'/active'),
                'method' => 'put'
            ]) !!}
            <div class="modal-body">


            <h3>  هل انت متاكد من تفعيل جميع المنتجات ؟</h3>

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
