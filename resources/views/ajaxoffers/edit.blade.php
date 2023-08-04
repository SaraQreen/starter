@extends('layouts.app')

@section('content')

<div class="container">

<div class="alert alert-success" id="success-msg" style="display: none;">
   تم التحديث بنجاح 

</div>
<div class="flex-center position-ref fill-height">
        <div class="content">
            <div class="title m-b-md">
                {{__('messages.Edite Your Offers')}}
            </div>

            @if(Session::has('success'))
              <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
              </div>
              @endif
            <br>
            <form method="post" id="offerFormUpdate" action="" enctype="multipart/form-data">
                @csrf 
                            {{-- <input name="_token" value="{{csrf_token()}}"> --}}
                    
                            <div class="form-group">
                    <label for="exampleInputName">{{__('messages.choose photo')}} </label>
                    <input type="file" class="form-control" name="photo">
                    @error('photo') 
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>            

                <div class="form-group">
                    <label for="exampleInputName">{{__('messages.Offer Name Ar')}} </label>
                    <input type="text" class="form-control" name="name_ar" value="{{$offer->name_ar}}"  placeholder="{{__('messages.Offer Name Ar')}}">
                    @error('name_ar') 
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <input type="text" class="form-control" style="display:none;" name="offer_id" value="{{$offer->id}}">

                <div class="form-group">
                    <label for="exampleInputName">{{__('messages.Offer Name En')}} </label>
                    <input type="text" class="form-control" name="name_en" value="{{$offer->name_en}}" placeholder="{{__('messages.Offer Name En')}}">
                    @error('name_en') 
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="exampleInputPrice"> {{__('messages.Offer Price')}}</label>
                    <input type="text" class="form-control" name="price" value="{{$offer->price}}" placeholder="{{__('messages.Offer Price')}}"> 
                    @error('price') 
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputDetail">{{__('messages.Offer Details Ar')}}</label>
                    <input type="text" class="form-control" name="details_ar" value="{{$offer->details_ar}}"  placeholder="{{__('messages.Offer Details Ar')}}">
                    @error('details_ar') 
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="exampleInputDetail">{{__('messages.Offer Details En')}}</label>
                    <input type="text" class="form-control" name="details_en" value="{{$offer->details_en}}"  placeholder="{{__('messages.Offer Details En')}}">
                    @error('details_en') 
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>


                <button id="update_offer" class="btn btn-primary">{{__('messages.Save Offer')}}</button>

            </form>
        </div>
        </div>

        </div>

 @endsection

 @section('scripts')
   <script>
    $(document).on('click','#update_offer',function(e){
      e.preventDefault();

      var formData=new FormData($(offerFormUpdate)[0]);
      $.ajax({
        type:'post',
        enctype:'multipart/form-data',
        url:"{{route('ajax.offers.update')}}",
        data:formData,
        processData:false,
        contentType:false,
        cache:false,
        success: function(data){

          if(data.status==true){
            $('#success-msg').show();

          }
             

        }, error: function(rejest){

        }
      });

    });
      
   </script>

 @endsection