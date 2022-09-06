<div class="container">
    <div class="row">
        <div class="modal fade p-4" id="address" tabindex="-1" role="dialog"
        aria-labelledby="addressLabel" aria-hidden="true">
         <div class="modal-dialog p-4">
           <div class="modal-content p-4">

                                 <div class="col-md-12 text-center">
                                    <h5> العنوان</h5>
                                 </div>


                           <form action="{{route('address.update')}}" method="post" >
                            @method('put')
                            @csrf
                                    <div class="form-group my-2">
                                        <label for="exampleInputEmail1" class="mb-2">العنوان</label>
                                        <input type="text"  name="address"  class="form-control" value="{{auth()->user()->address}}" aria-describedby="emailHelp" placeholder="إدخل  العنوان ">
                                        @if ($errors->has('address'))
                                        <span class="help-block">
                                                            <strong style="color: #f3b21a"> {{ $errors->first('address') }}</strong>
                                                        </span>
                                    @endif
                                    </div>


                                   <div class="form-group my-2 text-center pt-2">
                                    <button class="btn btn-secondary" type="submit">تاكيد</button>
                                   </div>
                                </form>

             </div>
         </div>
    </div>
    </div>
</div>
