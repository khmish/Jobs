@extends('templet.temp')

@section('title', 'Register Form')



@section('content')

<div class="card text-white bg-dark  my-4">
    <div class="card-header">Register</div>
    <div class="card-body">
        <div id="errorMsg" class="alert alert-dismissible alert-primary py-3">

            <strong>Oh snap!</strong> <a href="#" class="alert-link">Change a few things up</a>
            <div id="error">

            </div>
        </div>
        <div id="successMsg" class="alert alert-dismissible alert-success">

            <strong>Successful!</strong> <a id='redirect1' class="alert-link">click Here to redirect</a>
            <div id="success">

            </div>
        </div>
        <form action="register" method="POST" enctype="multipart/form-data">
            <fieldset>
                {{-- step 1******************************************************** --}}

                <div id="s1">
                    {{-- pic **************************** --}}
                    <div class="form-group">
                        <label for="exampleInputcity1">User Picture</label>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" name="pic" id="pic" class="custom-file-input" >
                                <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text" id="">Upload</span>
                            </div>
                        </div>

                    </div>

                    {{-- email **************************** --}}
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
                    </div>
                    {{-- name **************************** --}}
                    <div class="form-group">
                        <label for="name">name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter name"> </div>

                         {{-- address **************************** --}}
                    <div class="form-group">
                        <label for="address">address</label>
                        <input type="text" name="address" class="form-control" id="address" placeholder="Enter address"> </div>
                    {{-- birth **************************** --}}
                    <div class="form-group">
                        <label for="birth">brith date</label>
                        <input type="date" name="birth" class="form-control" id="birth" placeholder="Enter birth">
                    </div>
                    {{-- gender *************************** --}}
                    <div class="form-group">
                        <label for="">Gender</label>
                        <select name="Gender" id="gender" class="custom-select">
                            <option selected="" value="0">Gender</option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                        </select>
                    </div>
                    <button type="button" class="btn btn-primary" id="n1">next</button>
                </div>

                {{-- step 2******************************************************** --}}
                {{-- city --}}
                <div id="s2">

                    <div class="form-group">
                        <label for="">City</label>
                        <select name="city" id="city" class="custom-select">
                            <option selected="" value="0">City</option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                        </select>
                    </div>
                    {{-- qualification --}}
                    <div class="form-group">
                        <label for="">Qualification</label>
                        <select name="qualification" id="qualification" class="custom-select">
                            <option selected="" value="0">Qualification</option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                        </select>
                    </div>
                    {{-- department --}}
                    <div class="form-group">
                        <label for="">department</label>
                        <select name="department" id="department" class="custom-select">
                            <option selected="" value="0">department</option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                        </select>
                    </div>
                    {{-- experience --}}
                    <div class="form-group">
                        <label for="">Expericence</label>
                        <select name="experienceYears" id="expericence" class="custom-select">
                            <option selected="" value="0">Expericence</option>
                            <option value="1">5</option>
                            <option value="2">5-10</option>
                            <option value="3">+10</option>
                        </select>
                    </div>
                    <button type="button" class="btn btn-secondary" id="p2">previous</button>
                    <button type="button" class="btn btn-primary" id="n2">next</button>

                </div>

                {{-- step 3******************************************************** --}}

                <div id="s3">

                    <div class="form-group ">
                        <label for="exampleInputPassword1">Password</label>
                        <input name="password" type="password" class="form-control" id="password"
                            placeholder="Password">
                    </div>
                    <div class="form-group ">
                        <label for="exampleInputRePassword1">Re Password</label>
                        <input type="password" class="form-control" id="rePassword" placeholder="re Password">
                    </div>
                    <button type="button" class="btn btn-secondary" id="p3">previous</button>
                    <button type="submit" onsubmit="onsb()" class="btn btn-primary" id="n3">Register</button>
                </div>
            </fieldset>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js">

</script>
<script>
    $(document).ready(function () {
        setup();

        getlist('getCities', 'city', 'id', 'cityName');
        getlist('getQualification', 'qualification', 'id', 'qualificationTitle');
        getlist('getDepartment', 'department', 'id', 'departmentName');

        $("#s1").show();

        $("#n1").click(function () {
            if (validate1()) {

                setup();
                $("#s2").show();
            }
        });
        $("#n2").click(function () {
            if (validate2()) {

                setup();
                $("#s3").show();
            }
        });
        $("#n3").click(function () {
            if (validate3()) {
                $("#errorMsg").hide();
                return true;

            }
            return false;
        });

        $("#p2").click(function () {
            setup();
            $("#s1").show();


        });
        $("#p3").click(function () {
            setup();
            $("#s2").show();
        });
        $('#redirect1').click(function () {
            
           if(isSaved)
           {
            window.location.replace("loginPage");
           } 
        });
        function onsb() {

            if (validate3()) {
                $("#errorMsg").hide();
                return true;

            }
            return false;

        }

        function setup() {
            $("#s1").hide();
            $("#s2").hide();
            $("#s3").hide();
            $("#errorMsg").hide();
            $("#successMsg").hide();
            isSaved=false;
            document.getElementById("birth").max = "2000-01-01";
            document.getElementById("birth").min = "1960-01-01";
        }

        function validate1() {
            var $emailRegex = /^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/;
            var email = document.getElementById('email');
            var name = document.getElementById('name');
            var birth = document.getElementById('birth');
            var gender = document.getElementById('gender');

            var errTxt = "";

            var error = document.getElementById('error');
            if (!$emailRegex.test(email.value)) {
                errTxt = "<p>invalide Email</p>";
                $('#email').addClass('is-invalid');
            } else {

                $('#email').removeClass('is-invalid');
            }
            if (name.value == "") {
                errTxt += "<p>invalide name</p>";
                $('#name').addClass('is-invalid');
            } else {

                $('#name').removeClass('is-invalid');
            }
            if (new Date('2000/01/01')<=new Date(birth.value)) {
                errTxt += "<p>invalide brith</p>";
                $('#birth').addClass('is-invalid');
            } else {

                $('#birth').removeClass('is-invalid');
            }
            if (gender.value == 0) {
                errTxt += "<p>invalide gender</p>";
                $('#gender').addClass('is-invalid');
            } else {

                $('#gender').removeClass('is-invalid');
            }
            error.innerHTML = errTxt;
            if ($emailRegex.test(email.value) && name.value != "" && (new Date('2000/01/01')>=new Date(birth.value)) &&
                gender.value != 0) {


                return true;
            }
            $("#errorMsg").show();
            return false;
        }

        function validate2() {
            var city = document.getElementById('city');
            var qualification = document.getElementById('qualification');
            var department = document.getElementById('department');
            var expericence = document.getElementById('expericence');

            var errTxt = "";

            var error = document.getElementById('error');
            if (city.value == 0) {
                errTxt = "<p>invalide city</p>";
                $('#city').addClass('is-invalid');
            } else {

                $('#city').removeClass('is-invalid');
            }
            if (qualification.value == 0) {
                errTxt += "<p>invalide qualification</p>";
                $('#qualification').addClass('is-invalid');
            } else {

                $('#qualification').removeClass('is-invalid');
            }
            if ((department.value == 0)) {
                errTxt += "<p>invalide department</p>";
                $('#department').addClass('is-invalid');
            } else {

                $('#department').removeClass('is-invalid');
            }
            if (expericence.value == 0) {
                errTxt += "<p>invalide expericence</p>";
                $('#expericence').addClass('is-invalid');
            } else {

                $('#expericence').removeClass('is-invalid');
            }
            error.innerHTML = errTxt;
            if ((city.value != 0) && qualification.value != 0 && (department.value != 0) &&
                expericence.value != 0) {


                return true;
            }
            $("#errorMsg").show();
            return false;
        }

        function validate3() {
            var $rgxPass = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/;
            var rePassword = document.getElementById('rePassword');
            var password = document.getElementById('password');


            var errTxt = "";

            var error = document.getElementById('error');
            if (!($rgxPass.test(password.value))) {
                errTxt = "<p>invalide password</p>";
                $('#password').addClass('is-invalid');
            } else {

                $('#password').removeClass('is-invalid');
            }
            if (!($rgxPass.test(rePassword.value))) {
                errTxt += "<p>invalide rePassword</p>";
                $('#rePassword').addClass('is-invalid');
            } else {

                $('#rePassword').removeClass('is-invalid');
            }
            if (!(password.value == rePassword.value)) {
                $('#rePassword').addClass('is-invalid');
                $('#password').addClass('is-invalid');
                errTxt += "<p>password not equal re password</p>";
            } else {
                $('#rePassword').removeClass('is-invalid');
                $('#password').removeClass('is-invalid');
            }

            error.innerHTML = errTxt;
            if ($rgxPass.test(rePassword.value) && $rgxPass.test(password.value)) {


                return true;
            }
            $("#errorMsg").show();
            return false;
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
            xhttp.open("GET", urlPara, true);
            xhttp.send();

        }

        // $("#n3").click(function () {

        //     var mfrm = {
        //         pic: document.getElementById('pic').value,
        //         email: document.getElementById('email').value,
        //         name: document.getElementById('name').value,
        //         birth: document.getElementById('birth').value,
        //         Gender: document.getElementById('gender').value,
        //         city: document.getElementById('city').value,
        //         qualification: document.getElementById('qualification').value,
        //         department: document.getElementById('department').value,
        //         experienceYears: document.getElementById('expericence').value,
        //         address:document.getElementById('address').value,
        //         password: document.getElementById('password').value
        //     };
        //     var myJSON = JSON.stringify(mfrm);

        //     var xhttp = new XMLHttpRequest();
        //     xhttp.onreadystatechange = function () {
        //         if (this.readyState == 4 && this.status == 200) {
        //             $("#successMsg").show();
        //             isSaved=true;
        //         }
        //     };
        //     xhttp.open("POST", "register", true);
        //     xhttp.setRequestHeader("enctype", "multipart/form-data");
        //     xhttp.setRequestHeader("Content-type", "application/json");
        //     xhttp.send(myJSON);
        // });



    });
</script>
@endsection