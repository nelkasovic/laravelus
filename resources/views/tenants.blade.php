@extends('layouts.app')

@section('content')

<!-- Page Content -->
<div class="content">

    <!-- If edit or create -->
    @if (@$tenant)

    {{-- We are here only if variable client is available --}}

    @if (@$action === 'edit' || @$action === 'readonly')

    <form action="{{action('TenantController@update', $id)}}" enctype="multipart/form-data" method="post">
        @csrf

        <input name="_method" type="hidden" value="PATCH">

        <!-- Block Tabs With Options Default Style -->
        <div class="block block-rounded block-fx-pop block-themed">
            <div class="block-header block-header-default bg-primary-dark">
                <h3 class="block-title">{{ $tenant->name }} {{ $tenant->extension }}</h3>

            </div>
            <div class="block-content pb-4">
                <h2 class="content-heading">{{ __('common.Edit') }}</h2>
                <div class="row">
                    <div class="form-group col-xl-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="type"><small>{{ __('common.Type') }}</small></label>
                        <select class="form-control" id="type" name="type" @if($action==="readonly" ) disabled @endif>
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="person" @if($tenant->type=="person") selected
                                @endif>{{ __('common.Person') }}</option>
                            <option value="company" @if($tenant->type=="company") selected
                                @endif>{{ __('common.Company') }}</option>
                            <option value="institution" @if($tenant->type=="institution") selected
                                @endif>{{ __('common.Institution') }}</option>
                            <option value="association" @if($tenant->type=="association") selected
                                @endif>{{ __('common.Association') }}</option>
                        </select>
                    </div>

                    <div class="form-group col-xl-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="name"><small>{{ __('common.Name') }}</small></label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="{{ __('common.Name') }}" value="{{ $tenant->name }}" {{ $action }}>
                    </div>

                    <div class="form-group col-xl-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="extension"><small>{{ __('common.Extension') }}</small></label>
                        <input type="text" class="form-control" id="extension" name="extension"
                            placeholder="{{ __('common.Name') }}" value="{{ $tenant->extension }}" {{ $action }}>
                    </div>

                    <div class="form-group col-xl-6">
                        <label class="text-muted mb-0 font-size-sm"
                            for="email"><small>{{ __('common.Email') }}</small></label>
                        <input type="text" class="form-control" id="email" name="email"
                            placeholder="{{ __('common.Email') }}" value="{{ $tenant->email }}" {{ $action }}>
                    </div>


                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="phone"><small>{{ __('common.Phone') }}</small></label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            placeholder="{{ __('common.Phone') }}" value="{{ $tenant->phone }}" {{ $action }}>
                    </div>

                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="mobile"><small>{{ __('common.Mobile') }}</small></label>
                        <input type="text" class="form-control" id="mobile" name="mobile"
                            placeholder="{{ __('common.Mobile') }}" value="{{ $tenant->mobile }}" {{ $action }}>
                    </div>

                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="fax"><small>{{ __('common.Fax') }}</small></label>
                        <input type="text" class="form-control" id="fax" name="fax" placeholder="{{ __('common.Fax') }}"
                            value="{{ $tenant->fax }}" {{ $action }}>
                    </div>


                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="website"><small>{{ __('common.Website') }}</small></label>
                        <input type="text" class="form-control" id="website" name="website"
                            placeholder="{{ __('common.Website') }}" value="{{ $tenant->website }}" {{ $action }}>
                    </div>

                    @if($action === "edit")
                    <div class="col-xl-12 form-group">
                        <label class="text-muted mb-0 font-size-sm" for="picture"><small>{{ __('common.Image') }}
                            </small></label>
                        <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                        <input type="file" class="custom-file-input js-custom-file-input-enabled"
                            data-toggle="custom-file-input" id="picture" name="picture"
                            placeholder="{{ __('common.Image') }}" {{ $action }}>
                        <label class="custom-file-label" for="picture"
                            style="margin-left: 14px; margin-right: 14px; top: 24px; ">{{ __('common.Choose') }}</label>
                    </div>
                    @endif
                </div>

            </div>
            <div class="block-content block-content-full text-right bg-light">
                <div class="d-none">
                    <img class="img-avatar" src="{{ url('/images/'.$tenant->picture) }}">
                </div>

                <a class="btn btn-warning" href="{{action('TenantController@index')}}">
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

    <form action="{{action('TenantController@store')}}" enctype="multipart/form-data" method="post">
        @csrf
        <input name="_method" type="hidden" value="POST">

        <!-- Block Tabs With Options Default Style -->
        <div class="block block-rounded block-fx-shadow">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ __('common.Tenant') }}</h3>
            </div>
            <div class="block-content pb-4">
                <h2 class="content-heading">{{ __('common.New') }}</h2>
                <div class="row">
                    <div class="form-group col-md-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="type"><small>{{ __('common.Type') }}</small></label>
                        <select class="form-control" id="type" name="type">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="person" {{ (old('type') == 'person' ? 'selected':'') }}>
                                {{ __('common.Person') }}</option>
                            <option value="company" {{ (old('type') == 'company' ? 'selected':'') }}>
                                {{ __('common.Company') }}</option>
                            <option value="institution" {{ (old('type') == 'institution' ? 'selected':'') }}>
                                {{ __('common.Institution') }}</option>
                            <option value="association" {{ (old('type') == 'association' ? 'selected':'') }}>
                                {{ __('common.Association') }}</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="name"><small>{{ __('common.Name') }}</small></label>
                        <input type="text" class="form-control {{ @$errors->has('name') ? "is-invalid" : "" }}"
                            id="name" name="name" placeholder="{{ __('common.Name') }}" value="{{ old('name') }}">
                    </div>

                    <div class="form-group col-md-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="extension"><small>{{ __('common.Extension') }}</small></label>
                        <input type="text" class="form-control {{ @$errors->has('extension') ? "is-invalid" : "" }}"
                            id="extension" name="extension" placeholder="{{ __('common.Extension') }}"
                            value="{{ old('extension') }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label class="text-muted mb-0 font-size-sm"
                            for="email"><small>{{ __('common.Email') }}</small></label>
                        <input type="text" class="form-control {{ @$errors->has('email') ? "is-invalid" : "" }}"
                            id="email" name="email" placeholder="{{ __('common.Email') }}" value="{{ old('email') }}">
                    </div>

                </div>


            </div>
            <div class="block-content block-content-full text-right bg-light">
                <a class="btn btn-warning" href="{{action('TenantController@index')}}">
                    <i class="si si-action-undo mr-1"></i>
                    {{ __('common.Close') }}
                </a>
                @if($action == 'edit')
             
                @endif

                <button type="submit" class="btn btn-primary">
                    <i class="si si-fire mr-1"></i>
                    {{ __('common.Save') }}
                </button>
            </div>
        </div>
    </form>

    @endif
    @endif

    @if (@$active)
    <!-- Table Sections (.js-table-sections class is initialized in Helpers.tableToolsSections()) -->
    <div class="block block-rounded block-fx-shadow block-themed">

        <div class="block-header block-header-default bg-primary-dark">
            <h3 class="block-title">{{ __('common.Tenants') }} {{ __('common.Active') }} <small>({{ $active->count() }}
                    / {{ $active->total() }})</small></h3>
            <div class="block-options">
                @can('create tenants')
                <a class="btn btn-primary btn-sm" href="{{action('TenantController@create')}}">
                    <i class="si si-plus mr-1"></i> {{ __('common.Tenant') }} <span
                        class="text-lowercase">{{ __('common.Add') }}</span>
                </a>
                @endcan
            </div>
        </div>

        <div class="block-content">

            <div class="row mb-4">
                <div class="col-xl-4">

                </div>
                <div class="col-xl-6"></div>
                <div class="col-xl-2">
                    <form action="{{action('TenantController@index')}}" method="post">
                        <!-- Pagination -->
                        @include('include.pagination')
                        <!-- Pagination END -->
                    </form>
                </div>
            </div>
            <table class="js-table-sections table table-hover table-vcenter">
                <thead>
                    <tr>
                        <th style="width: 30px;"></th>
                        <th>
                            @sortablelink('extension', __('common.Name'))
                        </th>
                        <th style="width: 15%; ">
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
                @foreach($active as $tenant)

                <tbody class="js-table-sections-header">
                    <tr>
                        <td class="text-center">
                            <i class="fa fa-angle-right text-muted"></i>
                        </td>
                        <td>
                            <div class="py-1">
                                <a href="{{action('TenantController@show', $tenant->id)}}">{{ $tenant->name }}
                                    {{ $tenant->extension }}</a>
                            </div>
                        </td>
                        <td>
                            <!--<span class="badge badge-primary">Personal</span>-->
                            <div class="py-1">
                                {{ $tenant->email }}
                            </div>
                        </td>

                        <td>
                            <div class="py-1">
                                {{ Carbon::parse($tenant->updated_at)->format('d.m.Y H:i')}}
                            </div>
                        </td>


                        <td class="d-none d-sm-table-cell text-right">

                            <form action="{{action('TenantController@disable', $tenant->id)}}" method="post"
                                class="d-inline">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <!-- <button type="submit" class="btn btn-danger delete" data-entity="person" data-id="{{ $tenant->id }}" data-name="{{ $tenant->name }} {{ $tenant->extension }}">-->
                                <button type="submit" class="btn btn-sm btn-warning">
                                    <i class="nav-main-link-icon si si-lock"></i>
                                </button>
                            </form>
                            <a href="{{action('TenantController@edit', $tenant->id)}}" class="btn btn-sm btn-primary">
                                <i class="nav-main-link-icon si si-pencil"></i>
                            </a>

                        </td>
                    </tr>
                </tbody>
                <tbody class="font-size-sm">
                    <tr>
                        <td class="text-center"></td>
                        <td colspan="10">
                            <h5>{{ __('common.Contact') }}</h5>
                            <p>
                                {{ __('common.Phone') }}: {{ $tenant->phone }}<br>
                                {{ __('common.Mobile') }}: {{ $tenant->mobile }}<br>
                                {{ __('common.Fax') }}: {{ $tenant->fax }}
                            </p>
                        
                            <p>
                                <a href="{{ $tenant->website }}" target="_blank">{{ $tenant->website }}</a>
                            </p>
                            <p>
                                <em class="text-muted">{{ Carbon::parse($tenant->updated_at)->format('d.m.Y H:i')}}</em>
                            </p>
                        </td>

                    </tr>

                </tbody>
                @endforeach
            </table>

        </div>
        @if ($active->total() > $active->perPage())
        <div
            class="block-content block-content-full block-content-sm bg-body-light d-flex justify-content-center align-content-center">
            {!! $active->appends(\Request::except('page'))->render() !!}
        </div>
        @endif
    </div>
    @endif

    @if (@$inactive)
    <!-- Table Sections (.js-table-sections class is initialized in Helpers.tableToolsSections()) -->
    <div class="block block-rounded block-fx-pop block-themed">

        <div class="block-header block-header-default bg-primary-dark">
            <h3 class="block-title">{{ __('common.Tenants') }} {{ __('common.Inactive') }}
                <small>({{ $inactive->count() }} / {{ $inactive->total() }})</small></h3>
            <div class="block-options">

            </div>
        </div>

        <div class="block-content">

            <table class="js-table-sections table table-hover table-vcenter">
                <thead>
                    <tr>
                        <th style="width: 30px;"></th>
                        <th>
                            @sortablelink('extension', __('common.Name'))
                        </th>
                        <th style="width: 15%;">
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
                @foreach($inactive as $tenant)

                <tbody class="js-table-sections-header">
                    <tr>
                        <td class="text-center">
                            <i class="fa fa-angle-right text-muted"></i>
                        </td>
                        <td>
                            <div class="py-1">
                                <a href="{{action('TenantController@show', $tenant->id)}}">{{ $tenant->name }}
                                    {{ $tenant->extension }}</a>
                            </div>
                        </td>
                        <td>
                            <!--<span class="badge badge-primary">Personal</span>-->
                            <div class="py-1">
                                {{ $tenant->email }}
                            </div>
                        </td>

                        <td>
                            <div class="py-1">
                                {{ Carbon::parse($tenant->updated_at)->format('d.m.Y H:i')}}
                            </div>
                        </td>


                        <td class="d-none d-sm-table-cell text-right">
                            @can('update tenants')
                            <form action="{{action('TenantController@enable', $tenant->id)}}" method="post"
                                class="d-inline">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <!-- <button type="submit" class="btn btn-danger delete" data-entity="person" data-id="{{ $tenant->id }}" data-name="{{ $tenant->name }} {{ $tenant->extension }}">-->
                                <button type="submit" class="btn btn-success">
                                    <i class="nav-main-link-icon si si-lock-open"></i>
                                </button>
                            </form>

                            <a href="{{action('TenantController@edit', $tenant->id)}}" class="btn btn-sm btn-primary">
                                <i class="nav-main-link-icon si si-pencil"></i>
                            </a>
                            @endcan

                            @can('delete tenants')
                            <form action="{{action('TenantController@destroy', $tenant->id)}}" method="post"
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
                        <td colspan="10">
                            <h5>{{ __('common.Contact') }}</h5>
                            <p>
                                {{ __('common.Phone') }}: {{ $tenant->phone }}<br>
                                {{ __('common.Mobile') }}: {{ $tenant->mobile }}<br>
                                {{ __('common.Fax') }}: {{ $tenant->fax }}
                            </p>
        
                            <p>
                                <a href="{{ $tenant->website }}" target="_blank">{{ $tenant->website }}</a>
                            </p>
                            <p>
                                <em class="text-muted">{{ Carbon::parse($tenant->updated_at)->format('d.m.Y H:i')}}</em>
                            </p>
                        </td>

                    </tr>

                </tbody>
                @endforeach
            </table>

        </div>
        @if ($inactive->total() > $inactive->perPage())
        <div
            class="block-content block-content-full block-content-sm bg-body-light d-flex justify-content-center align-content-center">
            {!! $inactive->appends(\Request::except('page'))->render() !!}
        </div>
        @endif
    </div>
    @endif

    <!-- END Table Sections -->
</div>
<!-- END Page Content -->

@endsection