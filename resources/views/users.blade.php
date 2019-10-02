@extends('layouts.app')

@section('content')

<!-- Page Content -->
<div class="content">

    <!-- If edit or create or password -->
    @if (@$user)

    {{-- We are here only if variable user is available --}}

    @if (@$action === 'edit' || @$action === 'readonly')

    <form action="{{action('UserController@update', $id)}}" enctype="multipart/form-data" method="post">
        @csrf

        <input name="_method" type="hidden" value="PATCH">

        <!-- Block Tabs With Options Default Style -->
        <div class="block block-rounded block-themed block-fx-pop">
            <div class="block-header block-header-default bg-primary-dark">
                <h3 class="block-title">{{ $user->description }}</h3>
            </div>
            <div class="block-content pb-4">
                <h2 class="content-heading">{{ __('common.Edit') }}</h2>
                <div class="row">
                    <div class="form-group col-md-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="role"><small>{{ __('common.Role') }}</small></label>
                        <select {{ $action }} class="form-control" id="role" name="role"
                            data-roles="{{ $user->roles }}">
                            <option value="">{{ __('common.Select') }}</option>
                            @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ __('dynamic.'.$role->name) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="name"><small>{{ __('common.Description') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('name') ? "is-invalid" : "" }}" id="name" name="name"
                            placeholder="{{ __('common.Description') }}" value="{{ $user->description }}">
                    </div>


                    <div class="form-group col-md-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="active"><small>{{ __('common.Active') }}</small></label>
                        <select {{ $action }} class="form-control" id="active" name="active">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="" {{ ($user->active == '' ? 'selected':'') }}>{{ __('common.Inactive') }}
                            </option>
                            <option value="1" {{ ($user->active == 1 ? 'selected':'') }}>{{ __('common.Active') }}
                            </option>
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="email"><small>{{ __('common.Email') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('email') ? "is-invalid" : "" }}" id="email"
                            name="email" placeholder="{{ __('common.Email') }}" value="{{ $user->email  }}">
                    </div>
                </div>

            </div>
            <div class="block-content block-content-full text-right bg-light">
                <div class="d-none">
                    <img class="img-avatar" src="{{ url('/images/'.$user->image_url) }}">
                </div>

                <a class="btn btn-warning" href="{{action('UserController@index')}}">
                    <i class="si si-action-undo mr-1"></i>
                    {{ __('common.Close') }}
                </a>
                @if (@$action === 'edit')
                <button type="submit" class="btn btn-primary">
                    <i class="si si-fire mr-1"></i>
                    {{ __('common.Save') }}
                </button>
                @endif
            </div>
        </div>
    </form>

    <!-- END Block Tabs With Options Default Style -->
    @elseif (@$action === 'create')

    <form action="{{action('UserController@store')}}" enctype="multipart/form-data" method="post">
        @csrf
        <input name="_method" type="hidden" value="POST">

        <!-- Block Tabs With Options Default Style -->
        <div class="block block-rounded block-themed block-fx-pop">
            <div class="block-header block-header-default bg-primary-dark">
                <h3 class="block-title">{{ __('common.User') }}</h3>
            </div>
            <div class="block-content pb-4">
                <h2 class="content-heading">{{ __('common.New') }}</h2>
                <div class="row">

                    <div class="form-group col-md-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="role"><small>{{ __('common.Role') }}</small></label>
                        <select {{ $action }} class="form-control" id="role" name="role">
                            <option value="">{{ __('common.Select') }}</option>
                            @foreach ($roles as $role)
                            <option value="$role->name" {{ (old('role') == $role->name ? 'selected':'') }}>
                                {{ $role->description }} ({{ $role->name }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="name"><small>{{ __('common.Description') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('name') ? "is-invalid" : "" }}" id="name" name="name"
                            placeholder="{{ __('common.Description') }}" value="{{ old('name') }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="active"><small>{{ __('common.Active') }}</small></label>
                        <select {{ $action }} class="form-control" id="active" name="active">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="" {{ (old('active') == '' ? 'selected':'') }}>{{ __('common.Inactive') }}
                            </option>
                            <option value="1" {{ (old('active') == 1 ? 'selected':'') }}>{{ __('common.Active') }}
                            </option>
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="phone"><small>{{ __('common.Phone') }}</small></label>
                        <input type="text" class="form-control {{ @$errors->has('phone') ? "is-invalid" : "" }}"
                            id="phone" name="phone" placeholder="{{ __('common.Phone') }}" value="{{ old('phone') }}">
                    </div>
                </div>


            </div>
            <div class="block-content block-content-full text-right bg-light">
                <a class="btn btn-warning" href="{{action('UserController@index')}}">
                    <i class="si si-action-undo mr-1"></i>
                    {{ __('common.Close') }}
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="si si-fire mr-1"></i>
                    {{ __('common.Save') }}
                </button>
            </div>
        </div>
    </form>

    @elseif (@$action === 'reset')
    <form action="{{action('UserController@password', $id)}}" enctype="multipart/form-data" method="post">
        @csrf

        <input name="_method" type="hidden" value="PATCH">

        <!-- Block Tabs With Options Default Style -->
        <div class="block block-rounded block-themed">
            <div class="block-header block-header-default bg-primary-dark">
                <h3 class="block-title">{{ $user->description }}</h3>
            </div>
            <div class="block-content pb-4">
                <h2 class="content-heading">{{ __('common.Password') . ' ' . __('common.Reset') }}</h2>
                <div class="row">

                    <div class="form-group col-md-6">
                        <label class="text-muted mb-0 font-size-sm"
                            for="password"><small>{{ __('common.Password') }}</small></label>
                        <input type="text" class="form-control {{ @$errors->has('password') ? "is-invalid" : "" }}"
                            id="password" name="password" placeholder="{{ __('common.Password') }}"
                            value="{{ old('password') }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label class="text-muted mb-0 font-size-sm"
                            for="password_confirmation"><small>{{ __('common.Password') }}</small></label>
                        <input type="text"
                            class="form-control {{ @$errors->has('password_confirmation') ? "is-invalid" : "" }}"
                            id="password_confirmation" name="password_confirmation"
                            placeholder="{{ __('common.Password') }}" value="{{ old('password_confirmation') }}">
                    </div>
                </div>

            </div>
            <div class="block-content block-content-full text-right bg-light">

                <a class="btn btn-warning" href="{{action('UserController@index')}}">
                    <i class="si si-action-undo mr-1"></i>
                    {{ __('common.Close') }}
                </a>
                @if (@$action === 'reset')
                <button type="submit" class="btn btn-primary">
                    <i class="si si-fire mr-1"></i>
                    {{ __('common.Save') }}
                </button>
                @endif
            </div>
        </div>
    </form>


    @elseif (@$action === 'roles')
    <form action="{{action('UserController@roles', $id)}}" enctype="multipart/form-data" method="post">
        @csrf

        <input name="_method" type="hidden" value="PATCH">

        <!-- Block Tabs With Options Default Style -->
        <div class="block block-rounded block-themed">
            <div class="block-header block-header-default bg-primary-dark" >
                <h3 class="block-title">{{ $user->description }}</h3>
            </div>
            <div class="block-content pb-4">
                <h2 class="content-heading">{{ __('common.Roles') }}</h2>
                <div class="row">
                    <ul>
                        @foreach ($user->getAllPermissions() as $permission)
                        <li>{{ $permission->name }}</li>
                        @endforeach
                    </ul>
                </div>

            </div>
            <div class="block-content block-content-full text-right bg-light">

                <a class="btn btn-warning" href="{{action('UserController@index')}}">
                    <i class="si si-action-undo mr-1"></i>
                    {{ __('common.Close') }}
                </a>

                <button type="submit" class="btn btn-primary">
                    <i class="si si-fire mr-1"></i>
                    {{ __('common.Save') }}
                </button>

            </div>
        </div>
    </form>
    @endif
    @endif

    @if (@$users)
    <!-- Table Sections (.js-table-sections class is initialized in Helpers.tableToolsSections()) -->
    <div class="block block-rounded block-themed block-fx-pop">

        <div class="block-header block-header-default bg-primary-dark">
            <h3 class="block-title">{{ __('common.Users') }}</h3>
            <div class="block-options">
                @can('create users')
                <a class="btn btn-primary btn-sm" href="{{action('UserController@create')}}">
                    <i class="si si-plus mr-1"></i> {{ __('common.User') }} <span
                        class="text-lowercase">{{ __('common.Add') }}</span>
                </a>
                @endcan
            </div>
        </div>

        <div class="block-content">
            <div class="row mb-4">
                <div class="col-xl-4">
                    @can('create users')
                    <select {{ $action }} class="form-control form-control-sm" id="tenant_id" name="tenant_id"
                        title="{{ __('common.Tenant') }}" onchange="this.form.submit()">
                        <option value="">{{ __('common.Select') }}</option>
                        @foreach ($tenants as $tenant)
                        <option value="{{ $tenant->id }}" @if($selected_tenant==$tenant->id) selected
                            @endif>{{ $tenant->name }}</option>
                        @endforeach
                    </select>
                    @endcan
                </div>
                <div class="col-xl-6"></div>
                <div class="col-xl-2">
                    <form action="{{action('UserController@index')}}" method="post">
                        <!-- Pagination -->
                        @include('include.pagination')
                        <!-- Pagination END -->
                    </form>
                </div>
            </div>

            <table class="js-table-sections table table-hover table-vcenter">
                <thead>
                    <tr>
                        <th></th>
                        <th>
                            @sortablelink('name', __('common.Description'))
                        </th>

                        <th>
                            @sortablelink('email', __('common.Email'))
                        </th>
                        <th>
                            @sortablelink('updated_at', __('common.DateUpdated'))
                        </th>

                        <th class="text-right">

                        </th>
                    </tr>
                </thead>
                @csrf

                @foreach($users as $user)
                <tbody class="js-table-sections-header">
                    <tr>
                        <td class="text-center">
                            <i class="fa fa-angle-right text-muted"></i>
                        </td>
                        <td>
                            <div class="py-1">
                                <a href="{{action('UserController@show', $user->id)}}">{{ $user->description }} </a>
                            </div>
                        </td>

                        <td>

                            <div class="py-1">
                                {{ $user->email }}
                            </div>
                        </td>
                        <td>
                            <div class="py-1">
                                {{ Carbon::parse($user->updated_at)->format('d.m.Y H:i')}}
                            </div>
                        </td>


                        <td class="d-none d-sm-table-cell text-right">

                            @can('update users')
                            <a href="{{action('UserController@roles', $user->id)}}" class="btn btn-sm btn-dark">
                                <i class="nav-main-link-icon si si-user"></i>
                            </a>

                            <a href="{{action('UserController@reset', $user->id)}}" class="btn btn-sm btn-warning">
                                <i class="nav-main-link-icon si si-lock"></i>
                            </a>

                            <a href="{{action('UserController@edit', $user->id)}}" class="btn btn-sm btn-primary">
                                <i class="nav-main-link-icon si si-pencil"></i>
                            </a>
                            @endcan

                            @can('delete users')
                            <form action="{{action('UserController@destroy', $user->id)}}" method="post"
                                class="d-inline">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">

                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="nav-main-link-icon si si-trash"></i>
                                </button>
                            </form>
                            @endcan
                        </td>
                    </tr>
                </tbody>
                <tbody class="font-size-sm">
                    <tr>
                        <td class="text-center"></td>
                        <td>
                            <p>{{ $user->description }}</p>
                            <p>{{ __('common.Phone') }}: {{ $user->phone }}, {{ __('common.Mobile') }}:
                                {{ $user->mobile }}, {{ __('common.Fax') }}: {{ $user->fax }}</p>
                        </td>
                        <td>
                            <a href="{{ $user->website }}" target="_blank">{{ $user->website }}</a>
                        </td>
                        <td>
                        </td>
                        <td class="d-none d-sm-table-cell text-right" colspan="10">
                            <em class="text-muted">{{ Carbon::parse($user->updated_at)->format('d.m.Y H:i')}}</em>
                        </td>
                    </tr>

                </tbody>
                @endforeach
            </table>

        </div>

        @if ($users->total() > $users->perPage())
        <div
            class="block-content block-content-full block-content-sm bg-body-light d-flex justify-content-center align-content-center">
            {!! $users->appends(\Request::except('page'))->render() !!}
        </div>
        @endif
    </div>
    @endif

    <!-- END Table Sections -->
</div>
<!-- END Page Content -->


@endsection