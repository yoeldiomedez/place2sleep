<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <!-- END SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu page-header-fixed page-sidebar-menu-accordion-submenu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            
            <li class="nav-item start
                {{    
                    request()->is('home')
                    ? 'active open' : '' 
                }}
            ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-laptop"></i>
                    <span class="title">Escritorio</span>
                    <span class="arrow 
                        {{   
                            request()->is('home')
                            ? 'open' : '' 
                        }}
                    "></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start {{ request()->is('home') ? 'active open' : '' }}">
                        <a href="{{ route('home') }}" class="nav-link ">
                            <span class="title">Dasboard</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item
                {{    
                    request()->is('cemetery') ||
                    request()->is('deceased') ||
                    request()->is('relative')  
                    ? 'active open' : '' 
                }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-newspaper-o"></i>
                    <span class="title">Administración</span>
                    <span class="arrow 
                    {{   
                        request()->is('cemetery') ||
                        request()->is('deceased') ||
                        request()->is('relative') 
                         ? 'open' : '' 
                    }}">
                </a>
                <ul class="sub-menu">            
                    <li class="nav-item {{ request()->is('deceased') ? 'active open' : '' }}">
                        <a href="{{ route('deceased.index') }}" class="nav-link">
                            <span class="title">Difuntos</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('relative') ? 'active open' : '' }}">
                        <a href="{{ route('relative.index') }}" class="nav-link">
                            <span class="title">Familiares</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('cemetery') ? 'active open' : '' }}">
                        <a href="{{ route('cemetery.index') }}" class="nav-link">
                            <span class="title">Cementerios</span>
                        </a>
                    </li>
                </ul>
            </li>
            
            <li class="nav-item
                {{    
                    request()->is('niche')     ||
                    request()->is('mausoleum') ||
                    request()->is('pavilion')  
                    ? 'active open' : '' 
                }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-bank"></i>
                    <span class="title">Cementerio</span>
                    <span class="arrow 
                    {{  
                        request()->is('niche')     ||
                        request()->is('mausoleum') ||
                        request()->is('pavilion')  
                         ? 'open' : '' 
                    }}">
                </a>
                <ul class="sub-menu">
                    <li class="nav-item {{ request()->is('niche') ? 'active ' : '' }}">
                        <a href="{{ route('niche.index') }}" class="nav-link">
                            <span class="title">Nichos</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('mausoleum') ? 'active open' : '' }}">
                        <a href="{{ route('mausoleum.index') }}" class="nav-link">
                            <span class="title">Mausoleos</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('pavilion') ? 'active open' : '' }}">
                        <a href="{{ route('pavilion.index') }}" class="nav-link">
                            <span class="title">Pabellones</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item
                {{ 
                    request()->is('niches/inhumation') ||
                    request()->is('mausoleums/inhumation')
                    ? 'active open' : '' 
                }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-archive"></i>
                    <span class="title">Inhumaciones</span>
                    <span class="arrow 
                    {{  
                        request()->is('niches/inhumation') ||
                        request()->is('mausoleums/inhumation')
                        ? 'open' : '' 
                    }}">
                </a>
                <ul class="sub-menu">
                    <li class="nav-item {{ request()->is('niches/inhumation') ? 'active' : '' }}">
                        <a href="{{ route('niche.inhumation.index') }}" class="nav-link">
                            <span class="title">Nicho</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('mausoleums/inhumation') ? 'active' : '' }}">
                        <a href="{{ route('mausoleum.inhumation.index') }}" class="nav-link">
                            <span class="title">Mausoleo</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item
                {{ 
                    request()->is('niches/exhumation') ||
                    request()->is('mausoleums/exhumation')
                    ? 'active open' : '' 
                }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-inbox"></i>
                    <span class="title">Exhumaciones</span>
                    <span class="arrow 
                    {{  
                        request()->is('niches/exhumation') ||
                        request()->is('mausoleums/exhumation')
                        ? 'open' : '' 
                    }}">
                </a>
                <ul class="sub-menu">
                    <li class="nav-item {{ request()->is('niches/exhumation') ? 'active' : '' }}">
                        <a href="{{ route('niche.exhumation.index') }}" class="nav-link">
                            <span class="title">Nicho</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('mausoleums/exhumation') ? 'active' : '' }}">
                        <a href="{{ route('mausoleum.exhumation.index') }}" class="nav-link">
                            <span class="title">Mausoleo</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->