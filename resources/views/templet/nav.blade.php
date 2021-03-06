<div class="jumbotron">
    <h1 class="display-3">Hello, world!</h1>
    <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
    <hr class="my-4">
    <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
    <p class="lead">
      <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
    </p>
  </div>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        @guest
            
        <li class="nav-item">
          <a class="nav-link" href="{{url('registerPage')}}">Signup</a>
        </li>
        @endguest
        
      </ul>
      @if (auth()->check()) 

      <form class="form-inline my-lg-0">
        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
          <div class="btn-group" role="group">
            <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
              <a class="dropdown-item" href="{{url('logout')}}">Logout</a>
              <a class="dropdown-item" href="{{url('registerPage')}}">Signup</a>
            <a class="dropdown-item" href="{{url('showUser')}}/{{auth()->id()}}">Info</a>
            </div>
          </div>
          <button type="button" class="btn btn-primary disabled"><i class="fas fa-user"> {{auth()->user()->name}}</i></button>
        </div>
      </form>
      @endif

    </div>
  </nav>