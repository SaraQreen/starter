@extends('layouts.app')

@section('content')

<div class="alert alert-success" id="success-msg" style="display: none;">
   تم الحذف بنجاح 

</div>

<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">{{__('messages.Offer Name')}}</th>
      <th scope="col">{{__('messages.Offer Price')}}</th>
      <th scope="col">{{__('messages.Offer Details')}}</th>
      <th scope="col">{{__('messages.Offer Photo')}}</th>
      <th scope="col">{{__('messages.Operation')}}</th>
    </tr>
  </thead>
  <tbody>

  @foreach($offers as $offer)
    <tr class="offerRow{{$offer -> id}}">
      <th scope="row">{{$offer -> id}}</th>
      <td>{{$offer -> name}}</td>
      <td>{{$offer -> price}}</td>
      <td>{{$offer -> details}}</td>
      <td>{{$offer ->photo}} </td> 
      <td>
        <a class="btn btn-success" href="{{url('offers/edit/'.$offer -> id)}}">{{__('messages.update')}}</a>
        <a class="btn btn-danger" href="{{route('offers.delete',$offer->id)}}">{{__('messages.delete')}}</a>
        <a class="delete_btn btn btn-danger" href="" offer_id="{{$offer->id}}">حذف أجاكس </a>
        <a class="btn btn-success" href="{{route('ajax.offers.edit',$offer->id)}}">تعديل </a>
      </td>
    </tr>

    @endforeach
    
  </tbody>
</table>


@endsection


@section('scripts')
   <script>
    $(document).on('click','.delete_btn',function(e){
      e.preventDefault();

      var offer_id= $(this).attr('offer_id');

      $.ajax({
        type:'post',
        url:"{{route('ajax.offers.delete')}}",
        data:{
          '_token':"{{csrf_token()}}",
          'id':offer_id,
        },
        success: function(data){

          if(data.status==true){
            $('#success-msg').show();

          }
          $('.offerRow' + data.id).remove();
             

        }, error: function(rejest){

        }
      });

    });
      
   </script>

 @endsection