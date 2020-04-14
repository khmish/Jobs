@extends('templet.temp')

@section('title', 'Login Form')



@section('content')
<div class="card text-white bg-dark  my-4" >
    <div class="card-header">login</div>
    <div class="card-body">
        <form action="login" method="POST">
            <fieldset>
              
              
              <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input name="email" type="email" class="form-control" id="exampleInputEmail1"  placeholder="Enter email">
              </div>
              <div class="form-group ">
                <label for="exampleInputPassword1">Password</label>
                <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
              </div>
              
              <button type="submit" class="btn btn-primary">login</button>
            </fieldset>
          </form>
    </div>
  </div>
   
@endsection