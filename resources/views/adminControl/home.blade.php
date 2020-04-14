@extends('templet.temp')

@section('title', 'Jobs')



@section('content')
<div class="card text-white bg-dark mb-3 my-4">
    <div class="card-header">Jobs</div>
    <div class="card-body">

        <div id="successMsg" class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Well done!</strong> You successfully read <a href="#" class="alert-link">this important alert message</a>.
          </div>
          <div id="errorMsg" class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Oh snap!</strong> <a href="#" class="alert-link">Change a few things up</a> and try submitting again.
          </div>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" id="add" data-toggle="modal" data-target="#editModal">
            <i class="fas fa-plus"></i> Add
        </button>
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

                            <button type="button" class="btn btn-primary" id="edit" onclick="onedit('{{ $job->id }}')"
                                data-toggle="modal" data-target="#editModal">
                                <i class="fas fa-pencil-alt"></i> Edit
                            </button>

                            <button type="button" class="btn btn-primary" id="delete">
                                <i class="fas fa-trash"></i> Delete
                            </button>

                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="container">

            {{ $jobs->links() }}
        </div>
    </div>
</div>


<!-- Modal edit---------------------------------------------------------------- -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" name="" id="eId">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title">
                    </div>

                    <div class="form-group">
                        <label for="number">Nubmer</label>
                        <input type="number" class="form-control" id="number">
                    </div>
                    <div class="form-group">
                        <label for="qualification">Qualification</label>
                        <select class="form-control" id="qualification">

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="department">Department</label>
                        <select class="form-control" id="department">

                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="close" data-dismiss="modal">Close</button>
                <button type="button" id="sEdit" class="btn btn-primary">Save changes</button>
                <button type="button" id="sAdd" class="btn btn-primary">add</button>
            </div>
        </div>
    </div>
</div>



@endsection

<script src="https://code.jquery.com/jquery-3.4.1.min.js">

</script>
<script>
    $(document).ready(function () {
        startup();
        function startup() {
            getlist('getQualification', 'qualification', 'id', 'qualificationTitle');
            getlist('getDepartment', 'department', 'id', 'departmentName');
    
            $('#sAdd').show();
            $('#sEdit').show();
            $('#successMsg').hide();
            $('#errorMsg').hide();
            $('#a1').addClass('active');
        }
        $('#add').click(function () {
            document.getElementById('title').value = '';
            document.getElementById('number').value = '';
            $('#sAdd').show();
            $('#sEdit').hide();
        });

       

        function getlist(urlPara, selectorId, idPara, namePara) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                var txtlist = "";
                if (this.readyState == 4 && this.status == 200) {
                    var jsonlist = JSON.parse(this.responseText);
                    // console.log(jsonlist);
                    
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
            xhttp.open("GET", urlPara, true);
            xhttp.send();

        }

        $("#sAdd").click(function () {
            var mfrm = {
                title: document.getElementById('title').value,
                number: document.getElementById('number').value,
                qualification: document.getElementById('qualification').value,
                department: document.getElementById('department').value,

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
            xhttp.open("POST", "addJob", true);
            xhttp.setRequestHeader("Content-type", "application/json");
            xhttp.send(myJSON);
        });
        $("#sEdit").click(function () {
            var mfrm = {
                id: document.getElementById('eId').value,
                title: document.getElementById('title').value,
                number: document.getElementById('number').value,
                qualification: document.getElementById('qualification').value,
                department: document.getElementById('department').value,

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
            xhttp.open("POST", "updateJob", true);
            xhttp.setRequestHeader("Content-type", "application/json");
            xhttp.send(myJSON);
        });
    });

    function onedit(id) {
        document.getElementById('eId').value = id;

        getJobById(id);
        $('#sAdd').hide();
        $('#sEdit').show();
    }

    function getJobById(id) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            var title;
            var number;
            var qualification;
            var department;
            if (this.readyState == 4 && this.status == 200) {
                var jsonlist = JSON.parse(this.responseText);
           
                document.getElementById('title').value = jsonlist["title"];
                document.getElementById('number').value = jsonlist["number"];
                document.getElementById('qualification').value = jsonlist["qualification"];
                document.getElementById('department').value = jsonlist["department"];


            }
        };
        xhttp.open("GET", 'showJob/' + id, true);
        xhttp.send();

    }
</script>