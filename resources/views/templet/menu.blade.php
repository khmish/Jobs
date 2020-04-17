<style>
    .l1:hover {
        background-color: #f15924;
    }
    .l1:pressed {
        background-color: #f15924;
    }
</style>
@if (auth()->check() && auth()->user()->admin==1)
<ul class="nav nav-pills text-white bg-dark flex-column my-4">
    <li class="nav-item">
        <a id="a1" class="nav-link text-white l1  "  href="{{url('homeAdmin')}}"><i class="fas fa-search-dollar"></i> Jobs</a>
    </li>
    <li class="nav-item ">
        <a id="a2" class="nav-link  text-white l1" href="{{url('menu/usersPage')}}"><i class="fas fa-users"></i> Users</a>

    </li>
    <li class="nav-item">
        <a id="a3" class="nav-link text-white l1" href="{{url('menu/citiesPage')}}"><i class="fas fa-globe-asia"></i> Cities</a>
    </li>
    <li class="nav-item">
        <a id="a4" class="nav-link text-white l1" href="{{url('menu/departmentsPage')}}"><i class="fas fa-address-card"></i> Departments</a>
    </li>
    <li class="nav-item">
        <a id="a5" class="nav-link text-white l1" href="{{url('menu/qualificationsPage')}}"><i class="fas fa-graduation-cap"></i> Qualifications</a>
    </li>
    <li class="nav-item">
        <a id="a6" class="nav-link text-white l1" href="{{url('menu/jobUserPage')}}"><i class="fas fa-handshake"></i> Applicants</a>
    </li>
    
</ul>
@endif