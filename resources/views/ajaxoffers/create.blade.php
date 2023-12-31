@extends('layouts.app')

@section('content')

<div class="container">

<div class="alert alert-success" id="success-msg" style="display: none;">
   تم الحفظ بنجاح 

</div>
<div class="flex-center position-ref fill-height">
        <div class="content">
            <div class="title m-b-md">
                {{__('messages.Add Your Offers')}}
            </div>

            @if(Session::has('success'))
              <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
              </div>
              @endif
            <br>
            <form method="post" id="offerForm" action="" enctype="multipart/form-data">
                @csrf 
                            {{-- <input name="_token" value="{{csrf_token()}}"> --}}

                            <div class="form-group">
                    <label for="exampleInputName">{{__('messages.choose photo')}} </label>
                    <input type="file" class="form-control" name="photo">
                    
                    <small id="photo_error" class="form-text text-danger"></small>
                   
                </div>            

                <div class="form-group">
                    <label for="exampleInputName">{{__('messages.Offer Name Ar')}} </label>
                    <input type="text" class="form-control" name="name_ar"  placeholder="{{__('messages.Offer Name Ar')}}">
                     
                    <small id="name_ar_error" class="form-text text-danger"></small>
                    
                </div>

                <div class="form-group">
                    <label for="exampleInputName">{{__('messages.Offer Name En')}} </label>
                    <input type="text" class="form-control" name="name_en"  placeholder="{{__('messages.Offer Name En')}}">
                    
                    <small id="name_en_error" class="form-text text-danger"></small>
                    
                </div>


                <div class="form-group">
                    <label for="exampleInputPrice"> {{__('messages.Offer Price')}}</label>
                    <input type="text" class="form-control" name="price"  placeholder="{{__('messages.Offer Price')}}"> 
                   
                    <small id="price_error" class="form-text text-danger"></small>
                    
                </div>

                <div class="form-group">
                    <label for="exampleInputDetail">{{__('messages.Offer Details Ar')}}</label>
                    <input type="text" class="form-control" name="details_ar"  placeholder="{{__('messages.Offer Details Ar')}}">
                    
                    <small id="details_ar_error" class="form-text text-danger"></small>
                    
                </div>


                <div class="form-group">
                    <label for="exampleInputDetail">{{__('messages.Offer Details En')}}</label>
                    <input type="text" class="form-control" name="details_en"  placeholder="{{__('messages.Offer Details En')}}">
                    
                    <small id="details_en_error" class="form-text text-danger"></small>
                    
                </div>


                <button id="save_offer" class="btn btn-primary">{{__('messages.Save Offer')}}</button>

            </form>
        </div>
        </div>

        </div>

 @endsection

 @section('scripts')
   <script>
    $(document).on('click','#save_offer',function(e){
      e.preventDefault();
      $('#photo_error').text('');
      $('#name_ar_error').text('');
      $('#name_en_error').text('');
      $('#price_error').text('');
      $('#details_ar_error').text('');
      $('#details_en_error').text('');

      var formData=new FormData($(offerForm)[0]);
      $.ajax({
        type:'post',
        enctype:'multipart/form-data',
        url:"{{route('ajax.offers.store')}}",
        data:formData,
        processData:false,
        contentType:false,
        cache:false,
        success: function(data){

          if(data.status==true){
            $('#success-msg').show();

          }
             

        }, error: function(rejest){
          var response=$.parseJSON(rejest.responseText);
          $.each(response.errors,function(key,val){
            $("#" + key + "_error").text(val[0]);
          });

        }
      });

    });
      
   </script>

 @endsection