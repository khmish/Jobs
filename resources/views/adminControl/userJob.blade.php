@extends('templet.temp')

@section('title', 'Login Form')



@section('content')
<div class="card text-white bg-dark mb-3 my-4">
    <div class="card-header">Applicants</div>
    <div class="card-body">

        <div id="successMsg" class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Well done!</strong> You successfully read <a href="#" class="alert-link">this important alert
                message</a>.
        </div>
        <div id="errorMsg" class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Oh snap!</strong> <a href="#" class="alert-link">Change a few things up</a> and try submitting
            again.
        </div>

        <div class="container">
            {{-- department --}}
            <div class="form-group">
                <label for="">department</label>
                <select name="department" id="department" class="custom-select">

                </select>
            </div>
            <button class="btn btn-secondary" onclick="getFilterApi('jobByDepartment', 'POST', document.getElementById('department').value)"> search</button>
        </div>

        <table class="table table-light table-hover">
            <thead>
                <tr>
                    <th scope="col">job id</th>
                    <th scope="col">Title</th>
                    <th scope="col">user id</th>
                    <th scope="col">name</th>
                    <th scope="col">qualification</th>
                    <th scope="col">department</th>
                    <th scope="col">birth</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody id="apiSec">
                @foreach($jobUsers as $jobUser)

                    <tr id="{{ $jobUser->jobID }}-{{ $jobUser->UserID }} " class="">
                        <td>{{ $jobUser->jobID }}</td>
                        <td>{{ $jobUser->job->title }}</td>
                        <td>{{ $jobUser->UserID }}</td>
                        <td>{{ $jobUser->user->name }}</td>
                        <td>{{ $jobUser->user->qualification1->qualificationTitle }}</td>
                        <td>{{ $jobUser->user->department1->departmentName }}</td>
                        <td>{{ Carbon\Carbon::parse($jobUser->user->birth)->age }}</td>

                        <td>



                            <button type="button" class="btn btn-primary" id="delete"
                                onclick="onDelete('{{ $jobUser->jobID }}','{{ $jobUser->UserID }}')">
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
    var url = 'http://localhost/Jobs/'
    getlist('getDepartment', 'department', 'id', 'departmentName');
    $(document).ready(function () {
        var url = 'http://localhost/Jobs/'
        startup();

        $('#sAdd').click(function () {
            sendApi('addQualification');

        });


        function startup() {


            $('#successMsg').hide();
            $('#errorMsg').hide();
            $('#a6').addClass('active');
        }
    });
    var url = 'http://localhost/Jobs/';

    function onDelete(parId1, parId2) {
        console.log(parId1);
        document.getElementById('jobID').value = parId1;
        console.log(parId2);
        document.getElementById('UserID').value = parId2;
        sendApi('deleteApplicant');

    }

    function sendApi(paraUrl) {
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
            } else {
                $('#successMsg').hide();
                $('#errorMsg').show();
            }
            document.getElementById('close').click();
        };
        xhttp.open("POST", url + paraUrl, true);
        xhttp.setRequestHeader("Content-type", "application/json");
        xhttp.send(myJSON);
    }

    function getFilterApi(paraUrl, method, dataPara) {
        var DataApi;
        // paP=document.getElementById('department').value;
        DataApi = {
            id: dataPara,
            name: dataPara,
            departId:dataPara,
        };

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                $('#successMsg').show();
                $('#errorMsg').hide();
                var returnData = JSON.parse(this.responseText);
                console.log(returnData);
                printTable(returnData);
                // document.getElementById('apiSec').innerHTML=this.responseText;
            } else {
                $('#successMsg').hide();
                $('#errorMsg').show();
            }

        };
        xhttp.open(method, url + paraUrl, true);
        xhttp.setRequestHeader("Content-type", "application/json");
        if (dataPara) {
            var dataS = JSON.stringify(DataApi);
            xhttp.send(dataS);
        } else {
            xhttp.send();
        }

    }

    function printTable(params) {
        var txt = '';
        for (const item of params) {
            txt += '<tr id="' + item.UserID + '" class="">'
            txt += '<td>' + item.jobID +'</td>'
            txt += '<td>' + item.Title+'</td>'
            txt += '<td>' + item.UserID+'</td>'
            txt += ' <td>' + item.name+'</td>'
            txt += '<td>' + item.qualification + '</td>'
            txt += '<td>' + item.department + '</td>'
            txt += '<td>' + item.birth + ' </td>'
            txt+='<td><button type="button" class="btn btn-primary" id="delete" onclick="onDelete('+item.jobID+','+item.UserID+')"> <i class="fas fa-trash"></i> Delete</button></td>'
            txt += '</tr>'







        }
        document.getElementById('apiSec').innerHTML = txt;
    }

    function getlist(urlPara, selectorId, idPara, namePara) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            var txtlist = "";
            if (this.readyState == 4 && this.status == 200) {
                var jsonlist = JSON.parse(this.responseText);
                var len = (jsonlist.length);
                for (var i = 0; i < len; i++) {
                    var id = jsonlist[i][idPara];
                    var name = jsonlist[i][namePara];

                    txtlist += "<option value='" + id + "'>" + name +
                        "</option>";

                }

                document.getElementById(selectorId).innerHTML = txtlist;


            }
        };
        xhttp.open("GET", url+urlPara, true);
        xhttp.send();

    }

    function search(params) {
        

    }

</script>
