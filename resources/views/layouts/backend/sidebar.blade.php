<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="{{route('admin.index')}}"><span
                        class="brand-logo">
               <img src=" {{$settings->admin_panel_logo}}">
                  <defs>
                    <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                      <stop stop-color="#000000" offset="0%"></stop>
                      <stop stop-color="#FFFFFF" offset="100%"></stop>
                    </lineargradient>
                    <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">
                      <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                      <stop stop-color="#FFFFFF" offset="100%"></stop>
                    </lineargradient>
                  </defs>
                  <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                      <g id="Group" transform="translate(400.000000, 178.000000)">
                        <path class="text-primary" id="Path"
                              d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z"
                              style="fill:currentColor"></path>
                        <path id="Path1"
                              d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z"
                              fill="url(#linearGradient-1)" opacity="0.2"></path>
                        <polygon id="Path-2" fill="#000000" opacity="0.049999997"
                                 points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"></polygon>
                        <polygon id="Path-21" fill="#000000" opacity="0.099999994"
                                 points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"></polygon>
                        <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994"
                                 points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
                      </g>
                    </g>
                  </g>
                </span>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i
                        class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i
                        class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc"
                        data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li @if (Route::current()->getName() === 'admin.index')class="active"@endif><a
                    class="d-flex align-items-center" href="{{route('admin.index')}}"><i
                        data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Home">Home</span></a>
            </li>

            {{---------------------------------------------------------------------------------------------------------}}
            @can('language-list')
            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="flag"></i><span
                        class="menu-title text-truncate" data-i18n="Languages">{{trans('back.languages')}}</span><span
                        class="badge badge-light-danger badge-pill ml-auto mr-1"></span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="{{route('languages.index')}}"><i
                                data-feather="circle"></i><span class="menu-item text-truncate"
                                                             data-i18n="Collapsed Menu">{{trans('back.all_languages')}}</span></a>
                    </li>

                    <li><a class="d-flex align-items-center" href="{{route('languages.create')}}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Layout Boxed">{{trans('back.add_languages')}}</span></a>
                    </li>

                </ul>
            </li>
            @endcan
            {{---------------------------------------------------------------------------------------------------------}}

            {{---------------------------------------------------------------------------------------------------------}}

            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg><span
                        class="menu-title text-truncate" data-i18n="Info">{{trans('back.about_us')}}</span><span
                        class="badge badge-light-danger badge-pill ml-auto mr-1"></span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="{{route('aboutUs.index')}}"><i
                                data-feather="circle"></i><span class="menu-item text-truncate"
                                                                data-i18n="Collapsed Menu">{{trans('back.intro')}}</span></a>
                    </li>

                    <li><a class="d-flex align-items-center" href="{{route('aboutUs.long_term.index')}}"><i
                                data-feather="circle"></i><span class="menu-item text-truncate"
                                                                data-i18n="Collapsed Menu">{{trans('back.long_term')}}</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="{{route('aboutUs.operational.index')}}"><i
                                data-feather="circle"></i><span class="menu-item text-truncate"
                                                                data-i18n="Collapsed Menu">{{trans('back.operational')}}</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="{{route('aboutUs.future.index')}}"><i
                                data-feather="circle"></i><span class="menu-item text-truncate"
                                                                data-i18n="Collapsed Menu">{{trans('back.future')}}</span></a>
                    </li>

                </ul>
            </li>
            {{---------------------------------------------------------------------------------------------------------}}
{{--            @if (Route::current()->getName() === 'admin.index')class="active"@endif--}}
            {{---------------------------------------------------------------------------------------------------------}}

            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><x-bi-briefcase style="color: currentColor"/>
                    <span
                        class="menu-title text-truncate" data-i18n="Languages">{{trans('back.case_studies')}}</span><span
                        class="badge badge-light-danger badge-pill ml-auto mr-1"></span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="{{route('caseStudies.index')}}"><i
                                data-feather="circle"></i><span class="menu-item text-truncate"
                                                                data-i18n="Collapsed Menu">{{trans('back.intro')}}</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="{{route('clients.index')}}"><i
                                data-feather="circle"></i><span class="menu-item text-truncate"
                                                                data-i18n="Collapsed Menu">{{trans('back.clients')}}</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="{{route('studies.index')}}"><i
                                data-feather="circle"></i><span class="menu-item text-truncate"
                                                                data-i18n="Collapsed Menu">{{trans('back.studies')}}</span></a>
                    </li>
                </ul>
            </li>
            {{---------------------------------------------------------------------------------------------------------}}


            {{---------------------------------------------------------------------------------------------------------}}

            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><x-bi-hurricane style="color: currentColor"/>
                    <span
                        class="menu-title text-truncate" data-i18n="Languages">{{trans('back.academy')}}</span><span
                        class="badge badge-light-danger badge-pill ml-auto mr-1"></span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="{{route('academy.index')}}"><i
                                data-feather="circle"></i><span class="menu-item text-truncate"
                                                                data-i18n="Collapsed Menu">{{trans('back.intro')}}</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="{{route('aboutUs.academyCareer.index')}}"><i
                                data-feather="circle"></i><span class="menu-item text-truncate"
                                                                data-i18n="Collapsed Menu">{{trans('back.career')}}</span></a>
                    </li>
                </ul>
            </li>
            {{---------------------------------------------------------------------------------------------------------}}

            {{---------------------------------------------------------------------------------------------------------}}

            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><x-bi-building style="color: currentColor"/>
                    <span
                        class="menu-title text-truncate" data-i18n="Languages">{{trans('back.industries')}}</span><span
                        class="badge badge-light-danger badge-pill ml-auto mr-1"></span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="{{route('industry.index')}}"><i
                                data-feather="circle"></i><span class="menu-item text-truncate"
                                                                data-i18n="Collapsed Menu">{{trans('back.intro')}}</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="{{route('aboutUs.industry.client.index')}}"><i
                                data-feather="circle"></i><span class="menu-item text-truncate"
                                                                data-i18n="Collapsed Menu">{{trans('back.industryClient')}}</span></a>
                    </li>
                </ul>
            </li>
            {{---------------------------------------------------------------------------------------------------------}}

            {{---------------------------------------------------------------------------------------------------------}}

            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><x-bi-stack style="color: currentColor"/>
                    <span
                        class="menu-title text-truncate" data-i18n="Languages">{{trans('back.homepage')}}</span><span
                        class="badge badge-light-danger badge-pill ml-auto mr-1"></span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="{{route('homepage.index')}}"><i
                                data-feather="circle"></i><span class="menu-item text-truncate"
                                                                data-i18n="Collapsed Menu">{{trans('back.intro')}}</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="{{route('aboutUs.services.innovation.index')}}"><i
                                data-feather="circle"></i><span class="menu-item text-truncate"
                                                                data-i18n="Collapsed Menu">{{trans('back.service_innovation')}}</span></a>
                    </li>
                </ul>
            </li>
            {{---------------------------------------------------------------------------------------------------------}}

            {{---------------------------------------------------------------------------------------------------------}}

            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><x-bi-plug-fill style="color: currentColor"/>
                    <span
                        class="menu-title text-truncate" data-i18n="Languages">{{trans('back.services')}}</span><span
                        class="badge badge-light-danger badge-pill ml-auto mr-1"></span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="{{route('service.index')}}"><i
                                data-feather="circle"></i><span class="menu-item text-truncate"
                                                                data-i18n="Collapsed Menu">{{trans('back.service')}}</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="{{route('aboutUs.services.innovation.index')}}"><i
                                data-feather="circle"></i><span class="menu-item text-truncate"
                                                                data-i18n="Collapsed Menu">{{trans('back.service_innovation')}}</span></a>
                    </li>
                </ul>
            </li>
            {{---------------------------------------------------------------------------------------------------------}}
            {{---------------------------------------------------------------------------------------------------------}}

            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><x-bi-columns-gap style="color: currentColor"/>
                    <span
                        class="menu-title text-truncate" data-i18n="Languages">{{trans('back.career')}}</span><span
                        class="badge badge-light-danger badge-pill ml-auto mr-1"></span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="{{route('career.index')}}"><i
                                data-feather="circle"></i><span class="menu-item text-truncate"
                                                                data-i18n="Collapsed Menu">{{trans('back.intro')}}</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="{{route('careerConsulting.index')}}"><i
                                data-feather="circle"></i><span class="menu-item text-truncate"
                                                                data-i18n="Collapsed Menu">{{trans('back.career')}}</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="{{route('resumeUp.index')}}"><i
                                data-feather="circle"></i><span class="menu-item text-truncate"
                                                                data-i18n="Collapsed Menu">{{trans('back.resume')}}</span></a>
                    </li>
                </ul>
            </li>
            {{---------------------------------------------------------------------------------------------------------}}

            {{---------------------------------------------------------------------------------------------------------}}
            @can('news-list')
            <li class=" nav-item"><a class="d-flex align-items-center" href="{{route('news.index')}}"><x-bi-journal-bookmark-fill style="color: currentColor"/>
                    <span
                        class="menu-title text-truncate" data-i18n="Languages">{{trans('back.news')}}</span><span
                        class="badge badge-light-danger badge-pill ml-auto mr-1"></span></a>

            </li>
            @endcan
            {{---------------------------------------------------------------------------------------------------------}}
            {{---------------------------------------------------------------------------------------------------------}}

            <li class=" nav-item"><a class="d-flex align-items-center" href="{{route('events.index')}}"><x-bi-calendar-event style="color: currentColor"/>
                    <span
                        class="menu-title text-truncate" data-i18n="Languages">{{trans('back.events')}}</span><span
                        class="badge badge-light-danger badge-pill ml-auto mr-1"></span></a>
            </li>
            {{---------------------------------------------------------------------------------------------------------}}

            {{---------------------------------------------------------------------------------------------------------}}

            <li class=" nav-item"><a class="d-flex align-items-center" href="{{route('connects.index')}}"><x-bi-link-45deg style="color: currentColor"/>
                    <span
                        class="menu-title text-truncate" data-i18n="Languages">{{trans('back.connect')}}</span><span
                        class="badge badge-light-danger badge-pill ml-auto mr-1"></span></a>

            </li>
            {{---------------------------------------------------------------------------------------------------------}}
            {{---------------------------------------------------------------------------------------------------------}}

            <li class=" nav-item"><a class="d-flex align-items-center" href="{{route('applies.index')}}"><x-bi-mailbox style="color: currentColor"/>
                    <span
                        class="menu-title text-truncate"  data-i18n="Languages">{{trans('back.apply')}}</span><span
                        class="badge badge-light-danger badge-pill ml-auto mr-1"></span></a>

            </li>
            {{---------------------------------------------------------------------------------------------------------}}

            {{---------------------------------------------------------------------------------------------------------}}

            <li class=" nav-item"><a class="d-flex align-items-center" href="{{route('partner.index')}}"><x-bi-share-fill style="color: currentColor"/>
                    <span
                        class="menu-title text-truncate"  data-i18n="Languages">{{trans('back.partners')}}</span><span
                        class="badge badge-light-danger badge-pill ml-auto mr-1"></span></a>

            </li>
            {{---------------------------------------------------------------------------------------------------------}}

            {{---------------------------------------------------------------------------------------------------------}}

            <li class=" nav-item"><a class="d-flex align-items-center" href="{{route('subscriber.index')}}"><x-bi-person-lines-fill style="color: currentColor"/>
                    <span
                        class="menu-title text-truncate"  data-i18n="Languages">{{trans('back.subscribers')}}</span><span
                        class="badge badge-light-danger badge-pill ml-auto mr-1"></span></a>

            </li>
            {{---------------------------------------------------------------------------------------------------------}}


            {{---------------------------------------------------------------------------------------------------------}}

            <li class=" nav-item"><a class="d-flex align-items-center" href="{{route('settings.index')}}"><x-bi-gear style="color: currentColor"/>
                    <span
                        class="menu-title text-truncate"  data-i18n="Languages">{{trans('back.website_settings')}}</span><span
                        class="badge badge-light-danger badge-pill ml-auto mr-1"></span></a>

            </li>
            {{---------------------------------------------------------------------------------------------------------}}

            <li class=" nav-item"><a class="d-flex align-items-center" href="{{route('profile')}}"><x-bi-person-bounding-box style="color: currentColor"/>
                    <span
                        class="menu-title text-truncate"  data-i18n="Languages">{{trans('back.profile')}}</span><span
                        class="badge badge-light-danger badge-pill ml-auto mr-1"></span></a>

            </li>
            {{---------------------------------------------------------------------------------------------------------}}
            {{---------------------------------------------------------------------------------------------------------}}

            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><x-bi-lock-fill style="color: currentColor"/>
                    <span
                        class="menu-title text-truncate" data-i18n="Languages">{{trans('back.role_permission')}}</span><span
                        class="badge badge-light-danger badge-pill ml-auto mr-1"></span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="{{route('users.index')}}"><i
                                data-feather="circle"></i><span class="menu-item text-truncate"
                                                                data-i18n="Collapsed Menu">{{trans('back.manage_users')}}</span></a>
                    </li>
                    @can('role-list')
                    <li><a class="d-flex align-items-center" href="{{route('roles.index')}}"><i
                                data-feather="circle"></i><span class="menu-item text-truncate"
                                                                data-i18n="Collapsed Menu">{{trans('back.manage_roles')}}</span></a>
                    </li>
                    @endcan
                </ul>
            </li>
            {{---------------------------------------------------------------------------------------------------------}}



        </ul>
    </div>
</div>
