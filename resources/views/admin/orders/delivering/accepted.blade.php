<div class="modal fade" id="accepted" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> الموافقة على الطلب </h5>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open([

                'url' => url('admin/orders/delivering/accept/' .$order->id),
                'method' => 'put'
            ]) !!}
            <div class="modal-body">


            <h3>  هل انت متاكد من الموافقة على تغيير الحالة الى تم التسليم  ؟</h3>


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
