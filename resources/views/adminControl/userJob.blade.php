@extends('templet.temp')

@section('title', 'Login Form')



@section('content')
<div class="card text-white bg-dark mb-3 my-4">
    <div class="card-header">Applicants</div>
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
                    <th scope="col">job id</th>
                    <th scope="col">Title</th>
                    <th scope="col">user id</th>
                    <th scope="col">name</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($jobUsers as $jobUser)

                    <tr id="{{ $jobUser->jobID }}-{{$jobUser->UserID}} " class="">
                        <td>{{ $jobUser->jobID }}</td>
                        <td>{{ $jobUser->job->title }}</td>
                        <td>{{ $jobUser->UserID }}</td>
                        <td>{{ $jobUser->user->name }}</td>
                        <td>

                            

                            <button type="button" class="btn btn-primary" id="delete" onclick="onDelete('{{ $jobUser->jobID }}','{{$jobUser->UserID}}')">
                                <i class="fas fa-trash"></i> Delete
                            </button>

                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


<input type="hidden" name="" id="jobID">
<input type="hidden" name="" id="UserID">

@endsection
<script src="https://code.jquery.com/jquery-3.4.1.min.js">

</script>

<script>
    $(document).ready(function(){
        var url='http://localhost/Jobs/'
        startup();
        
        $('#sAdd').click(function(){
            sendApi('addQualification');
            
        });
       
        
        function startup() {
            
            
            $('#successMsg').hide();
            $('#errorMsg').hide();
            $('#a6').addClass('active');
        }
    });
    var url='http://localhost/Jobs/';
    function onDelete(parId1,parId2)
    { 
        console.log(parId1);
        document.getElementById('jobID').value=parId1;
        console.log(parId2);
        document.getElementById('UserID').value=parId2;
        sendApi('deleteApplicant');
        
    }
    function sendApi(paraUrl){
            var mfrm = {
                jobID: document.getElementById('jobID').value,
                UserID: document.getElementById('UserID').value,
                
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
   
</script>
