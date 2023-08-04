@extends('layouts.app')

@section('content')

<div class="container">


<div class="flex-center position-ref fill-height">
        <div class="content">
            <div class="title m-b-md">
                المستشفيات
            </div>
            <br>

            <table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Address</th>
      <th scope="col">الإجراءات</th>
    </tr>
  </thead>
  <tbody>
    @if(isset($hospitals) && $hospitals->count()>0)

       @foreach($hospitals as $hospital)
    <tr>
      <th scope="row">{{$hospital -> id}}</th>
      <td>{{$hospital -> name}}</td>
      <td>{{$hospital -> address}}</td>
      <td><a class="btn btn-success" href="{{route('hospital.doctors',$hospital -> id)}}">عرض الأطباء</a>
          <a class="btn btn-danger" href="{{route('hospital.delete',$hospital->id)}}">حذف</a>
    </td>
    </tr>
    @endforeach
    @endif
    
  </tbody>
</table>
        </div>
        </div>

        </div>

 @endsection

 