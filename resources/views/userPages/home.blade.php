@extends('templet.temp')

@section('title', 'Register Form')



@section('content')
<div class="card text-white bg-dark mb-3 my-4">
    <div class="card-header">Jobs</div>
    <div class="card-body">

        <table class="table table-light table-hover">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">title</th>
                    <th scope="col">number</th>
                    <th scope="col">qualification</th>
                    <th scope="col">department</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($jobs as $job)
                   
                    <tr id="{{ $job->id }}" class="">
                       <th scope="row">{{ $job->id }}</th>
                       <td>{{ $job->title }}</td>
                       <td>{{ $job->number }}</td>
                       <td>{{ $job->qualification1->qualificationTitle }}</td>
                       <td>{{ $job->department1->departmentName }}</td>
                       <td>
                           <a href="">
                                <i class="fas fa-check"> available</i>
                            </a>
                            
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
    $(document).ready(function () {

        startUpfunc();
        function startUpfunc() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                var txtlist = "";
                if (this.readyState == 4 && this.status == 200) {
                    var jsonlist = JSON.parse(this.responseText);
                    var len = (jsonlist.length);
                    for (var i = 0; i < len; i++) {
                        var id = jsonlist[i]['jobID'];
                       console.log(id);
                       
                        var element=document.getElementById(id);
                        element.classList.add("table-danger");
                        
                        element.children[5].innerHTML="<i class='fas fa-times'> you have applied</i>";
                        
                        
                    }
                    
                        
                    

                }
            };
            xhttp.open("GET", 'getJobsForUser', true);
            xhttp.send();
        }
    });
</script>