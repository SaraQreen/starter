@extends('layouts.app')

@section('content')

<div class="container">

<div class="flex-center position-ref fill-height">
        <div class="content">
            <div class="title m-b-md">
                الأطباء
            </div>

            <br>
            
            <table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Title</th>
      <th scope="col">Operation</th>
    </tr>
  </thead>
  <tbody>
  @if(isset($doctors) && $doctors->count()>0)
     @foreach($doctors as $doctor)
    <tr>
      <th scope="row">{{$doctor -> id}}</th>
      <td>{{$doctor -> name}}</td>
      <td>{{$doctor -> title}}</td>
      <td><a href="{{route('doctors.services',$doctor -> id)}}" class="btn btn-primary"> Show Services</a></td>
      
    </tr>
     @endforeach
    @endif
    
  </tbody>
</table>
        </div>
        </div>

        </div>

 @endsection

 