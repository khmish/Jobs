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

                                <a href="">
    
                                    <i class="fas fa-pencil-alt" onclick="onEdit('{{ $user->id }}')"></i>
                                </a>
                                <a href="">
    
                                    <i class="fas fa-power-off" onclick="onActivate('{{ $user->id }}')"></i>
                                </a>
                                <a href="">
    
                                    <i class="fas fa-user-tie" onclick="onaAdmin('{{ $user->id }}')"></i>
                                </a>
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
    $(document).ready(function(){
        var url='http://localhost/s2PhpProj/'
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
                document.getElementById('close').click();
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
    function onEdit(parId)
    {
        
        
    }
   
</script>
