@extends('templet.temp')

@section('title', 'Login Form')



@section('content')
<div class="card text-white bg-dark mb-3 my-4">
    <div class="card-header">departments</div>
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
                    <th scope="col">name</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($departments as $department)

                    <tr id="{{ $department->id }}" class="">
                        <th scope="row">{{ $department->id }}</th>
                        <td>{{ $department->departmentName }}</td>
                        <td>

                            <button type="button" class="btn btn-primary" id="edit" onclick="onedit('{{ $department->id }}')"
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
                        <label for="departmentName">departmentName</label>
                        <input type="text" class="form-control" id="departmentName">
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
    $(document).ready(function(){
        var url='http://localhost/s2PhpProj/'
        startup();
        $('#add').click(function(){
            document.getElementById('departmentName').value='';
            $('#sAdd').show();
            $('#sEdit').hide();
        });
        $('#sAdd').click(function(){
            sendApi('addDepartment');
            
        });
        $('#sEdit').click(function(){
            sendApi('updateDepartment');
        });
        function sendApi(paraUrl){
            var mfrm = {
                id: document.getElementById('eId').value,
                departmentName: document.getElementById('departmentName').value,
                
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
            $('#a4').addClass('active');
        }
    });
    function onedit(parId)
    {
        document.getElementById('eId').value = parId;
        $('#sAdd').hide();
        $('#sEdit').show();
        document.getElementById('departmentName').value=(document.getElementById(parId).children[1].innerHTML);
        
    }
   
</script>

