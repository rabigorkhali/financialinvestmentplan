<div class="page-header">
    <div class="header-wrapper row m-0">
        <div class="header-logo-wrapper col-auto p-0">
            <div class="logo-wrapper">
                <a href="{{route('home')}}">
                    <img class="img-fluid" src="{{asset('uploads/config/')}}/{{ getCmsConfig('cms logo')}}" alt="">
                </a>
            </div>
            <div class="toggle-sidebar">
                <div class="status_toggle sidebar-toggle d-flex">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g>
                            <g>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M21.0003 6.6738C21.0003 8.7024 19.3551 10.3476 17.3265 10.3476C15.2979 10.3476 13.6536 8.7024 13.6536 6.6738C13.6536 4.6452 15.2979 3 17.3265 3C19.3551 3 21.0003 4.6452 21.0003 6.6738Z"
                                      stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                      stroke-linejoin="round"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M10.3467 6.6738C10.3467 8.7024 8.7024 10.3476 6.6729 10.3476C4.6452 10.3476 3 8.7024 3 6.6738C3 4.6452 4.6452 3 6.6729 3C8.7024 3 10.3467 4.6452 10.3467 6.6738Z"
                                      stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                      stroke-linejoin="round"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M21.0003 17.2619C21.0003 19.2905 19.3551 20.9348 17.3265 20.9348C15.2979 20.9348 13.6536 19.2905 13.6536 17.2619C13.6536 15.2333 15.2979 13.5881 17.3265 13.5881C19.3551 13.5881 21.0003 15.2333 21.0003 17.2619Z"
                                      stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                      stroke-linejoin="round"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M10.3467 17.2619C10.3467 19.2905 8.7024 20.9348 6.6729 20.9348C4.6452 20.9348 3 19.2905 3 17.2619C3 15.2333 4.6452 13.5881 6.6729 13.5881C8.7024 13.5881 10.3467 15.2333 10.3467 17.2619Z"
                                      stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                      stroke-linejoin="round"></path>
                            </g>
                        </g>
                    </svg>
                </div>
            </div>
        </div>
        <div class="left-side-header col ps-0 d-none d-md-block">

        </div>
        <div class="nav-right col-10 col-sm-6 pull-right right-header p-0">
            <ul class="nav-menus">
                <li>
                    <div class="mode animated backOutRight">
                        <svg class="lighticon" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <g>
                                <g>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M18.1377 13.7902C19.2217 14.8742 16.3477 21.0542 10.6517 21.0542C6.39771 21.0542 2.94971 17.6062 2.94971 13.3532C2.94971 8.05317 8.17871 4.66317 9.67771 6.16217C10.5407 7.02517 9.56871 11.0862 11.1167 12.6352C12.6647 14.1842 17.0537 12.7062 18.1377 13.7902Z"
                                          stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                          stroke-linejoin="round"></path>
                                </g>
                            </g>
                        </svg>
                        <svg class="darkicon" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M17 12C17 14.7614 14.7614 17 12 17C9.23858 17 7 14.7614 7 12C7 9.23858 9.23858 7 12 7C14.7614 7 17 9.23858 17 12Z"></path>
                            <path
                                d="M18.3117 5.68834L18.4286 5.57143M5.57144 18.4286L5.68832 18.3117M12 3.07394V3M12 21V20.9261M3.07394 12H3M21 12H20.9261M5.68831 5.68834L5.5714 5.57143M18.4286 18.4286L18.3117 18.3117"
                                stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </div>
                </li>


                <li class="maximize"><a class="text-dark" href="#" onclick="javascript:toggleFullScreen()">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g>
                                <g>
                                    <path d="M2.99609 8.71995C3.56609 5.23995 5.28609 3.51995 8.76609 2.94995"
                                          stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                          stroke-linejoin="round"></path>
                                    <path
                                        d="M8.76616 20.99C5.28616 20.41 3.56616 18.7 2.99616 15.22L2.99516 15.224C2.87416 14.504 2.80516 13.694 2.78516 12.804"
                                        stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path
                                        d="M21.2446 12.804C21.2246 13.694 21.1546 14.504 21.0346 15.224L21.0366 15.22C20.4656 18.7 18.7456 20.41 15.2656 20.99"
                                        stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path d="M15.2661 2.94995C18.7461 3.51995 20.4661 5.23995 21.0361 8.71995"
                                          stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                          stroke-linejoin="round"></path>
                                </g>
                            </g>
                        </svg>
                    </a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="localeDropDown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{$globalLocale ?? ''}}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="localeDropDown">
                        @foreach (globalLanguages() as $lang)
                            <a href="{{route('set.lang', $lang->language_code ?? '')}}" class="dropdown-item">
                                {{$lang->name??''}} ({{$lang->language_code??''}})
                            </a>
                        @endforeach
                    </div>
                </li>
                <li class="profile-nav onhover-dropdown pe-0 py-0 me-0">
                    <div class="media profile-media">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g>
                                <g>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M9.55851 21.4562C5.88651 21.4562 2.74951 20.9012 2.74951 18.6772C2.74951 16.4532 5.86651 14.4492 9.55851 14.4492C13.2305 14.4492 16.3665 16.4342 16.3665 18.6572C16.3665 20.8802 13.2505 21.4562 9.55851 21.4562Z"
                                          stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                          stroke-linejoin="round"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M9.55849 11.2776C11.9685 11.2776 13.9225 9.32356 13.9225 6.91356C13.9225 4.50356 11.9685 2.54956 9.55849 2.54956C7.14849 2.54956 5.19449 4.50356 5.19449 6.91356C5.18549 9.31556 7.12649 11.2696 9.52749 11.2776H9.55849Z"
                                          stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                          stroke-linejoin="round"></path>
                                    <path
                                        d="M16.8013 10.0789C18.2043 9.70388 19.2383 8.42488 19.2383 6.90288C19.2393 5.31488 18.1123 3.98888 16.6143 3.68188"
                                        stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path
                                        d="M17.4608 13.6536C19.4488 13.6536 21.1468 15.0016 21.1468 16.2046C21.1468 16.9136 20.5618 17.6416 19.6718 17.8506"
                                        stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <ul class="profile-dropdown onhover-show-div">
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-user">
                                <path
                                    d="M12 2C9.79086 2 8 3.79086 8 6C8 8.20914 9.79086 10 12 10C14.2091 10 16 8.20914 16 6C16 3.79086 14.2091 2 12 2Z"></path>
                                <path d="M19 21V19C19 16.2386 15.7614 15 12 15C8.23858 15 5 16.2386 5 19V21"></path>
                            </svg>
                            <span>{{ucwords(authUser()->role->name)}}</span>
                        </li>
                        <li><a href="{{ route('profile') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-edit">
                                    <path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path>
                                    <polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon>
                                </svg>
                                <span>Update Profile </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('profile.change-password-form') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-key-lock">
                                    <path
                                        d="M9 2V4M7 4H11M5 4H3M21 10V22H3V10M18 10V8C18 5.79 16.21 4 14 4 11.79 4 10 5.79 10 8V10M10 10H18M12 14V16M15 16H13M12 16a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"></path>
                                </svg>
                                <span>Change Password</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-log-in">
                                    <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                                    <polyline points="10 17 15 12 10 7"></polyline>
                                    <line x1="15" y1="12" x2="3" y2="12"></line>
                                </svg>
                                <span>Log out</span>
                            </a>
                        </li>
                    </ul>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>

    </div>
</div>
