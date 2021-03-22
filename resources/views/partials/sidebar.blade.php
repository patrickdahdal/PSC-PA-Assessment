@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ route('admin.home') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">@lang('global.app.dashboard')</span>
                </a>
            </li>

            {{-- @can('customers_manage') --}}
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-address-card"></i>
                    <span class="title">@lang('global.customers.title')</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $request->segment(2) == 'customers' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.customers.index') }}">
                            <i class="fa fa-address-card"></i>
                            <span class="title">@lang('global.customers.title')</span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'respondents' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.respondents.index') }}">
                            <i class="fa fa-users"></i>
                            <span class="title">@lang('global.respondents.title')</span>
                        </a>
                    </li>
                </ul>
            </li>
            {{-- @endcan --}}

            {{-- @can('assessments_manage') --}}
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-list"></i>
                    <span class="title">@lang('global.assessments.title')</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $request->segment(2) == 'assessments' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.assessments.index') }}">
                            <i class="fa fa-bar-chart"></i>
                            <span class="title">@lang('global.assessments.title')</span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'questions' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.questions.index') }}">
                            <i class="fa fa-question"></i>
                            <span class="title">@lang('global.questions.title')</span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'answers' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.questions.answers') }}">
                            <i class="fa fa-check"></i>
                            <span class="title">@lang('global.answers.title')</span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'traits' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.traits.index') }}">
                            <i class="fa fa-star"></i>
                            <span class="title">@lang('global.traits.title')</span>
                        </a>
                    </li>
                </ul>
            </li>
            {{-- @endcan --}}

            @can('users_manage')
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-user-plus"></i>
                        <span class="title">@lang('global.user-management.title')</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ $request->segment(2) == 'permissions' ? 'active active-sub' : '' }}">
                            <a href="{{ route('admin.permissions.index') }}">
                                <i class="fa fa-check-square"></i>
                                <span class="title">@lang('global.permissions.title')</span>
                            </a>
                        </li>
                        <li class="{{ $request->segment(2) == 'roles' ? 'active active-sub' : '' }}">
                            <a href="{{ route('admin.roles.index') }}">
                                <i class="fa fa-user-secret"></i>
                                <span class="title">@lang('global.roles.title')</span>
                            </a>
                        </li>
                        <li class="{{ $request->segment(2) == 'users' ? 'active active-sub' : '' }}">
                            <a href="{{ route('admin.users.index') }}">
                                <i class="fa fa-user"></i>
                                <span class="title">@lang('global.users.title')</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan

            <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">Change password</span>
                </a>
            </li>
            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('global.app.logout')</span>
                </a>
            </li>
        </ul>
    </section>
</aside>
{!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
<button type="submit">@lang('global.logout')</button>
{!! Form::close() !!}
