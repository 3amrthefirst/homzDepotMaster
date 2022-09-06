<div class="modal fade" id="refund{{$product->id}}" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> طلب مسترجع </h5>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open([

                'url' => url('admin/orders/received/' .$order->id.'/refund/store'),
                'method' => 'post'
            ]) !!}
            <div class="modal-body">
                                <div class="div">
                    <div class="row">
                           <div class="col-md-6">
                                {!! \App\MyHelper\Field::date('date' , 'تاريخ الاسترجاع' ) !!}
    
                            </div>
                            
                        <div class="col-md-6">
                            <label for="name">الاسم</label>
                            <input class="form-control" type="text" name="customerName" placeholder="اسم العميل" value="{{ $order->name }}" readonly>
                        </div>
                      

                     
                    </div>
                <div class="div">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name"> كود المورد
                            </label>
                            <input class="form-control" type="text" name="supplierName" placeholder="كود المورد" value="{{ $product->product->supplier->code }}" readonly>
                            <input hidden  type="text" name="supplierId"  value="{{ $product->product->supplier->id }}" >

                        </div>
                      

                        <div class="col-md-6">
                            <label for="name"> اسم المورد
                            </label>
                            <input class="form-control" type="text" name="supplierName" placeholder="اسم المورد" value="{{ $product->product->supplier->name }}" readonly>
                        </div>
                    </div>

                    <div class="div">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name">العنوان</label>

                                <input class="form-control" type="text" name="address" placeholder=" العنوان" value="{{ $order->address }}" readonly>
                            </div>

                            <div class="col-md-6">
                                {!! \App\MyHelper\Field::number('price' , ' السعر الكلي ' ) !!}

                            </div>
                        </div>
                    </div>
                    <div class="div">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name">المنتج</label>

                                <input class="form-control" type="text" placeholder=" المنتج" value="{{$product->product->name}}" readonly>
                                <input class="form-control" type="hidden" name="product_id"  value="{{$product->product->id}}"  >
                            </div>

                            <div class="col-md-6">
                                <label for="name">الكمية</label>

                                <input class="form-control" type="number" name="quantity" placeholder=" الكمية" min="1" max="{{ $product->quantity }}" >

                            </div>
                        </div>
                    </div>
                    <div class="div">
                        <div class="row">


                            <div class="col-md-6">
                                <label for="name">رقم الهاتف</label>

                                <input class="form-control" type="number" name="phone" placeholder="رقم الهاتف" value="{{ $order->phone }}">

                            </div>
                         
                        </div>
                    </div>

                </div>
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
