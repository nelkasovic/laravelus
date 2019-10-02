@extends('layouts.app')

@section('content')

<!-- Page Content -->
<div class="content">

    @if (@$role)

    {{-- We are here only if variable is available --}}

    @if (@$action === 'edit' || @$action === 'readonly')

    <form action="{{action('RoleController@update', $id)}}" enctype="multipart/form-data" method="post">
        @csrf

        <input name="_method" type="hidden" value="PATCH">

        <!-- Block Tabs With Options Default Style -->
        <div class="block block-rounded block-themed">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ __('common.Role') }} {{ $role->name }}</h3>
            </div>
            <div class="block-content pb-4">
                <h2 class="content-heading">{{ __('common.Edit') }}</h2>

                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="text-muted mb-0 font-size-sm"
                            for="name"><small>{{ __('common.Name') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('name') ? "is-invalid" : "" }}" id="name" name="name"
                            placeholder="{{ __('common.Name') }}" value="{{ $role->name }}">
                    </div>

                    <div class="col-md-12">
                        <table class="js-table-checkable table table-hover table-vcenter">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 10px; border-top: none;">
                                        <div
                                            class="custom-control custom-checkbox custom-control-primary d-inline-block">
                                            <input type="checkbox" class="custom-control-input" id="check-all"
                                                name="check-all">
                                            <label class="custom-control-label" for="check-all"></label>
                                        </div>
                                    </th>
                                    <th style="border-top: none;">{{ __('common.Name') }}</th>
                                    <th class="d-none d-sm-table-cell text-right" style="border-top: none;">
                                        {{ __('common.DateUpdated') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($permission as $value)
                                <tr>
                                    <td class="text-center">
                                        <div
                                            class="custom-control custom-checkbox custom-control-primary d-inline-block">
                                            <input @if(in_array($value->id, $permissions->pluck('id')->toArray()))
                                            checked @endif type="checkbox" class="custom-control-input" id="permission"
                                            name="permission[]" value="{{ $value->id }}">
                                            <label class="custom-control-label" for="permission"></label>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $value->name }}
                                    </td>

                                    <td class="d-none d-sm-table-cell text-right">
                                        <em
                                            class="font-size-sm text-muted">{{ Carbon::parse($role->updated_at)->format('d.m.Y H:i')}}</em>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

            <div class="block-content block-content-full text-right bg-light">

                <a class="btn btn-warning" href="{{ action('RoleController@index') }}">
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

    @elseif (@$action === 'create')


    <form action="{{action('RoleController@store')}}" enctype="multipart/form-data" method="post">
        @csrf
        <input name="_method" type="hidden" value="POST">

        <!-- Block Tabs With Options Default Style -->
        <div class="block block-rounded block-themed">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ __('common.Role') }}</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-toggle="block-option"
                        data-action="fullscreen_toggle"></button>
                    <button type="button" class="btn-block-option" data-toggle="block-option"
                        data-action="pinned_toggle">
                        <i class="si si-pin"></i>
                    </button>
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle"
                        data-action-mode="demo">
                        <i class="si si-refresh"></i>
                    </button>
                    <button type="button" class="btn-block-option" data-toggle="block-option"
                        data-action="content_toggle"></button>
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="close">
                        <i class="si si-close"></i>
                    </button>
                </div>
            </div>

            <div class="block-content pb-4">
                <h2 class="content-heading">{{ __('common.New') }}</h2>
                <div class="row">

                    <div class="form-group col-md-12">
                        <label class="text-muted mb-0 font-size-sm"
                            for="name"><small>{{ __('common.Name') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('name') ? "is-invalid" : "" }}" id="name" name="name"
                            placeholder="{{ __('common.Name') }}" value="{{ old('name') }}">
                    </div>

                    <div class="col-md-12">
                        <table class="js-table-checkable table table-hover table-vcenter">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 10px;">
                                        <div
                                            class="custom-control custom-checkbox custom-control-primary d-inline-block">
                                            <input type="checkbox" class="custom-control-input" id="check-all"
                                                name="check-all">
                                            <label class="custom-control-label" for="check-all"></label>
                                        </div>
                                    </th>
                                    <th>Name</th>
                                    <th class="d-none d-sm-table-cell text-right">{{ __('common.DateUpdated') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($permission as $value)
                                <tr>
                                    <td class="text-center">
                                        <div
                                            class="custom-control custom-checkbox custom-control-primary d-inline-block">
                                            <input type="checkbox" class="custom-control-input" id="permission"
                                                name="permission[]" value="{{ $value->id }}">
                                            <label class="custom-control-label" for="permission"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="font-w600 mb-1">
                                            {{ $value->name }}
                                        </p>
                                    </td>

                                    <td class="d-none d-sm-table-cell text-right">
                                        <em
                                            class="font-size-sm text-muted">{{ Carbon::parse($role->updated_at)->format('d.m.Y H:i')}}</em>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
            <div class="block-content block-content-full text-right bg-light">


                <a class="btn btn-warning" href="{{ URL::previous() }}">
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

    @if (@$roles)
    <!-- Table Sections (.js-table-sections class is initialized in Helpers.tableToolsSections()) -->
    <div class="block block-rounded block-themed block-fx-pop">

        <div class="block-header block-header-default bg-primary-darker">
            <h3 class="block-title">{{ __('common.Roles') }}</h3>
            <div class="block-options">
                @hasrole('super')
                <a class="btn btn-primary btn-sm" href="{{action('RoleController@create')}}">
                    <i class="si si-plus mr-1"></i> {{ __('common.Role') }} <span
                        class="text-lowercase">{{ __('common.Add') }}</span>
                </a>
                @endhasrole
            </div>
        </div>

        <div class="block-content">
            <div class="row mb-4">
                <div class="col-xl-10"></div>
                <div class="col-xl-2">
                    <form action="{{action('RoleController@index')}}" method="post">
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
                            @sortablelink('name', __('common.Name'))
                        </th>

                        <th class="d-none d-lg-table-cell">
                            @sortablelink('guard_name', __('common.Guard'))
                        </th>
                        <th class="d-none d-xl-table-cell text-right">
                            @sortablelink('updated_at', __('common.DateUpdated'))
                        </th>

                        <th class="text-right d-none d-sm-table-cell">

                        </th>
                    </tr>
                </thead>
                @csrf

                @foreach($roles as $role)
                <tbody class="js-table-sections-header">
                    <tr>
                        <td class="text-center">
                            <i class="fa fa-angle-right text-muted"></i>
                        </td>
                        <td>
                            <div class="py-1 text-capitalize">
                                <a href="{{action('RoleController@show', $role->id)}}">{{ $role->name }}</a>
                            </div>
                        </td>

                        <td class="d-none d-lg-table-cell">

                            <div class="py-1 text-uppercase">
                                {{ $role->guard_name }}
                            </div>
                        </td>
                        <td class="d-none d-xl-table-cell text-right">
                            <div class="py-1">
                                {{ Carbon::parse($role->updated_at)->format('d.m.Y H:i')}}
                            </div>
                        </td>


                        <td class="d-none d-sm-table-cell text-right">

                            @can('update roles')
                            <a href="{{action('RoleController@edit', $role->id)}}" class="btn btn-sm btn-primary">
                                <i class="nav-main-link-icon si si-pencil"></i>
                            </a>
                            @endcan

                            @can('delete roles')
                            <form action="{{action('RoleController@destroy', $role->id)}}" method="post"
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
                        <td colspan="4">
                            <h4>{{ __('common.Permissions') }}</h4>
                            <ul>
                                @foreach($role->permissions as $permission)
                                <li>{{ $permission->name }}</li>
                                @endforeach
                            </ul>

                            <em class="text-muted">{{ Carbon::parse($role->updated_at)->format('d.m.Y H:i')}}</em>
                        </td>
                    </tr>
                </tbody>
                @endforeach
            </table>

        </div>

        @if ($roles->total() > $roles->perPage())
        <div
            class="block-content block-content-full block-content-sm bg-body-light d-flex justify-content-center align-content-center">
            {!! $roles->appends(\Request::except('page'))->render() !!}
        </div>
        @endif
    </div>
    @endif

    <!-- END Table Sections -->
</div>
<!-- END Page Content -->


@endsection