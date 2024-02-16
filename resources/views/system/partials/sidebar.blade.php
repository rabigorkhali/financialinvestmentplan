<div class="sidebar-wrapper">
    <div class="logo-wrapper d-flex">
        <a href="{{route('home')}}">
            <img class="img-fluid for-light" src="{{asset('uploads/config/')}}/{{ getCmsConfig('cms logo')}}"
                 alt="">
            <img class="img-fluid for-dark" src="{{asset('uploads/config/')}}/{{ getCmsConfig('cms logo')}}"
                 alt="">
            @if(getCmsConfig('cms title'))
                <h3>{{getCmsConfig('cms title')}}</h3>
            @endif
        </a>
        <div class="back-btn">
            <i class="fa fa-angle-left"></i>
        </div>
    </div>
    <div class="logo-icon-wrapper">
        <a href="{{route('home')}}">
            <img class="img-fluid" src="{{ asset('images/logo-icon.png') }}" alt="">
        </a>
    </div>
    <nav class="sidebar-main">
        <div id="sidebar-menu">
            <ul class="sidebar-links" id="simple-bar">
                <li class="back-btn">
                    <a href="{{route('home')}}">
                        <img class="img-fluid" src="{{ asset('images/logo-icon.png') }}" alt="">
                    </a>
                    <div class="mobile-back text-end">
                        <span>Back</span>
                        <i class="fa fa-angle-right ps-2" aria-hidden="true"> </i>
                    </div>
                </li>
                @foreach ($modules as $module)
                    @if (hasPermissionOnModule($module) && showInSideBar($module['showInSideBar'] ?? true))
                        @if ($module['hasSubmodules'])
                            <li class="sidebar-list">
                                <a class="sidebar-link sidebar-title" href="#sidenav{{$loop->index}}">
                                    {!! $module['icon'] ?? '' !!} <span>{{translate($module['name'])}}</span></a>
                                <ul class="sidebar-submenu">
                                    @foreach ($module['submodules'] as $subModule)
                                        @if (hasPermission($subModule['route'], 'get'))
                                            <li>
                                                <a href="{{url(getSystemPrefix().$subModule['route'])}}">{{translate($subModule['name'])}}</a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li class="sidebar-list">
                                <a class="sidebar-link sidebar-title link-nav"
                                   href="{{url(getSystemPrefix().$module['route'])}}">
                                    @if (hasPermission($module['route'], 'get'))
                                        {!! $module['icon'] ?? '' !!} <span>{{translate($module['name'])}} </span>
                                    @endif
                                </a>
                            </li>
                        @endif
                    @endif
                @endforeach
            </ul>

        </div>
    </nav>
</div>
