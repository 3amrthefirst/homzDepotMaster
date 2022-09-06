<div class="modal fade" id="transfer{{$record->id}}" tabindex="-1" role="dialog"
    aria-labelledby="transfer{{$record->id}}Label" aria-hidden="true">
   <div class="modal-dialog" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">اجراء تحويل</h5>
               <button type="button" class="close" data-dismiss="modal"
                       aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>

           
           {!! Form::open([

               'url' =>route('payment.store'),
               'method' => 'POST'
           ]) !!}
           <div class="modal-body">

           <h3 > سيتم تحويل المبلغ للمورد {{$record->name}} </h3>
           <div class="form-group">
            <input type="hidden" class="form-control"  rows="3" name='supplier_id' type="number" value="{{$record->id}}" >

           <input class="form-control" id="amount" rows="3" name='amount' type="number" value="{{$record->net_profit}}" placeholder="الكمية" readonly>
           
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
