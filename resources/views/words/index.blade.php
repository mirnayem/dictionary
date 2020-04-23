@extends('layouts.app')

@section('content')

 
  
  <div class="row text-center">
    @foreach ($allwords as  $word) 
     <div class="col-lg-4 col-md-6 col-sm-12 d-flex justify-content-between py-1">

      <div class="card" style="width: 18rem;">
      <img class="card-img-top" src="{{$word->image}}" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title text-center">{{$word->name}}</h5>
         
        </div>

        <div class="card-body">

          <audio controls="controls" style="width:220px" class=" justify-content-center">
            <source src="{{ $word->audio}}" type="audio/mpeg">   
          </audio>
          
        </div>
      </div>

    </div>
    <hr>
    @endforeach
  </div>
  
  


      
@endsection