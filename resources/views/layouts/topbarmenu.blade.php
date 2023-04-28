<!-- BEGIN PAGE TOP -->
<div class="page-top">
    
    <!-- BEGIN TOP NAVIGATION MENU -->
    <div class="top-menu">
        <ul class="nav navbar-nav pull-right">   
            <!-- BEGIN USER LOGIN DROPDOWN -->
            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
            <li class="dropdown dropdown-user">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                    <img src="{{ asset('img/default-user-circle.png') }}" class="img-circle" alt="">  
                    <span class="username">
                        {{ Auth::user()->name }}
                    </span>
                    <i class="fa fa-angle-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-default">
                    <li>
                        <a href="javascript:;" style="cursor: default;">
                            <i class="icon-direction"></i> {{ auth()->user()->cemetery_appellation }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('choice') }}">
                            <i class="icon-refresh"></i> Cementerios
                        </a>
                    </li>
                    <li class="divider"> </li>
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            <i class="icon-logout"></i> Salir 
                        </a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </ul>
            </li>
            <!-- END USER LOGIN DROPDOWN -->
        </ul>
    </div>
    <!-- END TOP NAVIGATION MENU -->
</div>
<!-- END PAGE TOP -->