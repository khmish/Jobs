@extends('templet.temp')

@section('title', 'Users')



@section('content')
<div class="card text-white bg-dark mb-3 my-4">
    <div class="card-header">Users</div>
    <div class="card-body">

        <div id="successMsg" class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Well done!</strong> You successfully read <a href="#" class="alert-link">this important alert message</a>.
          </div>
          <div id="errorMsg" class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Oh snap!</strong> <a href="#" class="alert-link">Change a few things up</a> and try submitting again.
          </div>

       
        <table class="table table-light table-hover">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">name</th>
                    <th scope="col">Gender</th>
                    <th scope="col">city</th>
                    <th scope="col">qualification</th>
                    <th scope="col">department</th>
                    <th scope="col">birth</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                
                @foreach($users as $user)
                
                    <tr id="{{ $user->id }}" class="">
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->Gender==1?'Male':'female' }}</td>
                        <td>{{ $user->city1->cityName }}</td>
                        <td>{{ $user->qualification1->qualificationTitle }}</td>
                        <td>{{ $user->department1->departmentName }}</td>
                        <td> {{ Carbon\Carbon::parse($user->birth)->age }}</td>
                        
                        <td>
                            <div class="col">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-cogs"></i> 
                                    </button>
                                    <div class="dropdown-menu">
                                      <a class="dropdown-item" ><i class="fas fa-lock-open" onclick="onEdit('{{ $user->id }}')"> Reset Password</i></a>
                                      <a class="dropdown-item" ><i class="fas fa-power-off" onclick="onActivate('{{ $user->id }}')"> Activate</i></a>
                                      <a class="dropdown-item" ><i class="fas fa-user-tie" onclick="onaAdmin('{{ $user->id }}')"> Admin</i></a>
                                      
                                    </div>
                                  </div>
                                
                            </div>
                            
                            

                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>





@endsection
<script src="https://code.jquery.com/jquery-3.4.1.min.js">

</script>
<script>
    var url='http://localhost/Jobs/';
    $(document).ready(function(){
        var url='http://localhost/Jobs/';
        startup();
        $('#add').click(function(){
            document.getElementById('cityName').value=''
            $('#sAdd').show();
            $('#sEdit').hide();
        });
        $('#sAdd').click(function(){
            sendApi('addCity');
            
        });
        $('#sEdit').click(function(){
            sendApi('updateCity');
        });
        function sendApi(paraUrl){
            var mfrm = {
                id: document.getElementById('eId').value,
                cityName: document.getElementById('cityName').value,
                
            };
            var myJSON = JSON.stringify(mfrm);
            // console.log(myJSON);

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    $('#successMsg').show();
                    $('#errorMsg').hide();
                }
                else{
                    $('#successMsg').hide();
                    $('#errorMsg').show();
                }
                
            };
            xhttp.open("POST", url+paraUrl, true);
            xhttp.setRequestHeader("Content-type", "application/json");
            xhttp.send(myJSON);
        }
        function startup() {
            
            $('#sAdd').show();
            $('#sEdit').show();
            $('#successMsg').hide();
            $('#errorMsg').hide();
            $('#a2').addClass('active');
        }
    });
    function sendApi(paraUrl){
            
            

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    $('#successMsg').show();
                    $('#errorMsg').hide();
                }
                else{
                    $('#successMsg').hide();
                    $('#errorMsg').show();
                }
                
            };
            xhttp.open("GET", url+paraUrl, true);
            xhttp.setRequestHeader("Content-type", "application/json");
            xhttp.send();
        }
    function onEdit(parId)
    {
        // sendApi("activateUser");
        
    }
    function onActivate(parId)
    {
        sendApi("activateUser/"+parId);
        
        
    }
    function onaAdmin(parId)
    {
        sendApi("admin/"+parId);
        
        
    }
   
</script>
