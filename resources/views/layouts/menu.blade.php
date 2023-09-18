
<li class="nav-item">
    <a href="{{ route('dashboard') }}"
       class="nav-link {{ Request::is('dashsboard') ? 'active' : '' }}">
       <i class="fa fa-chart-pie"></i>       
        <p>Dashboard</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('planta') }}"
       class="nav-link {{ Request::is('planta') ? 'active' : '' }}">

       <i class="fa fa-users" style="color:white"></i>       
        <p>Planta de Personal</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('jubilaciones') }}"
       class="nav-link {{ Request::is('jubilaciones') ? 'active' : '' }}">

       <i class="fa fa-home" style="color:white"></i>       
        <p>Jubilaciones</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('ausentismo') }}"
       class="nav-link {{ Request::is('ausentismo') ? 'active' : '' }}">
       <i class="fa fa-tasks"></i>
        <p>Ausentismo</p>
    </a>
</li>



<li class="nav-item">
    <a href="{{ route('sindicatos' ) }}"
       class="nav-link {{ Request::is('sindicatos') ? 'active' : '' }}">
       <i class="fa fa-table"></i>
       
        <p>Sindicatos</p>
    </a>

</li><li class="nav-item">
    <a href="{{ route('licencias') }}"
       class="nav-link {{ Request::is('licencias') ? 'active' : '' }}">
       <i class="fas fa-user"></i>
        <p>Licencias</p>
    </a>
</li>    



