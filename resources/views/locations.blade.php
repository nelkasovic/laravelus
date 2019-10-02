@extends('layouts.app')

@section('content')

<!-- Page Content -->
<div class="content">

    <!-- If edit or create -->
    @if (@$location)

    {{-- We are here only if variable is available --}}

    @if (@$action === 'edit' || @$action === 'readonly')

    <form action="{{action('LocationController@update', [$locationable_id, $locationable_type])}}"
        enctype="multipart/form-data" method="post">
        @csrf

        <input name="_method" type="hidden" value="PATCH">

        <!-- Block Tabs With Options Default Style -->
        <div class="block block-rounded block-themed block-fx-pop">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ $location->street }} {{ $location->street_number }}, {{ $location->city }} @
                    {{ @$location->locationable->name }} {{ @$location->locationable->first_name }}
                    {{ @$location->locationable->last_name }}</h3>
            </div>
            <div class="block-content pb-4">
                <h2 class="content-heading">{{ __('common.Edit') }}</h2>
                <div class="row">
                    <div class="form-group col-md-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="street"><small>{{ __('common.Street') }}</small></label>
                        <input type="text" class="form-control" id="street" name="street"
                            placeholder="{{ __('common.Street') }}" value="{{ $location->street }}" {{ $action }}>
                    </div>

                    <div class="form-group col-md-1">
                        <label class="text-muted mb-0 font-size-sm"
                            for="street_number"><small>{{ __('common.Number') }}</small></label>
                        <input type="text" class="form-control" id="street_number" name="street_number"
                            placeholder="{{ __('common.Number') }}" value="{{ $location->street_number }}"
                            {{ $action }}>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="zip"><small>{{ __('common.Zip') }}</small></label>
                        <input type="text" class="form-control" id="zip" name="zip" placeholder="{{ __('common.Zip') }}"
                            value="{{ $location->zip }}" {{ $action }}>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="city"><small>{{ __('common.City') }}</small></label>
                        <input type="text" class="form-control" id="city" name="city"
                            placeholder="{{ __('common.City') }}" value="{{ $location->city }}" {{ $action }}>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="type"><small>{{ __('common.Type') }}</small></label>
                        <select class="form-control" id="type" name="type" @if($action==="readonly" ) disabled @endif
                            title="{{ __('common.Type') }}">
                            <option value="">{{ __('common.Select') }}</option>
                            @foreach($collection as $key => $value)
                            <option value="{{ $key }}" @if($location->type === $key) selected @endif>{{ $value }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-xl-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="active"><small>{{ __('common.Active') }}</small></label>
                        <select {{ $action }} class="form-control" id="active" name="active">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="1" {{ ($location->active == 1 ? 'selected':'') }}>{{ __('common.Active') }}
                            </option>
                            <option value="0" {{ ($location->active == 0 ? 'selected':'') }}>{{ __('common.Inactive') }}
                            </option>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="country"><small>{{ __('common.Country') }}</small></label>
                        <select class="form-control" id="country" name="country" @if($action==="readonly" ) disabled
                            @endif>
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="Switzerland" @if($location->country=="Switzerland") selected
                                @endif>Switzerland</option>
                            <option value="Germany" @if($location->country=="Germany") selected @endif>Germany</option>
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="email"><small>{{ __('common.Email') }}</small></label>
                        <input type="text" class="form-control" id="email" name="email"
                            placeholder="{{ __('common.Email') }}" value="{{ $location->email }}" {{ $action }}>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="phone"><small>{{ __('common.Phone') }}</small></label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            placeholder="{{ __('common.Phone') }}" value="{{ $location->phone }}" {{ $action }}>
                    </div>


                    <div class="form-group col-md-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="url"><small>{{ __('common.Website') }}</small></label>
                        <input type="text" class="form-control" id="url" name="url"
                            placeholder="{{ __('common.Website') }}" value="{{ $location->url }}" {{ $action }}>
                    </div>

                    @if($action === "edit")
                    <div class="form-group col-md-2">
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

                    <div class="form-group col-md-12">
                        <label class="text-muted mb-0 font-size-sm"
                            for="description"><small>{{ __('common.Description') }}</small></label>
                        <textarea {{ $action }} rows="5"
                            class="form-control {{ @$errors->has('description') ? "is-invalid" : "" }}" id="description"
                            name="description"
                            placeholder="{{ __('common.Description') }}">{{ $location->description }}</textarea>
                    </div>
                </div>

            </div>
            <div class="block-content block-content-full text-right bg-light">
                <div class="d-none">
                    <img class="img-avatar" src="{{ url('/images/'.$location->image_url) }}">
                </div>

                <a class="btn btn-warning" href="{{ URL::previous() }}">
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

    <form action="{{action('LocationController@store')}}" enctype="multipart/form-data" method="post">
        @csrf
        <input name="_method" type="hidden" value="POST">
        <input type="hidden" id="locationable_type" name="locationable_type" value="{{ $locationable_type }}">

        <!-- Block Tabs With Options Default Style -->
        <div class="block block-rounded block-themed block-fx-pop">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ __('common.Location') }}</h3>
            </div>
            <div class="block-content pb-4">
                <h2 class="content-heading">{{ __('common.New') }}</h2>
                <div class="row">

                    <div class="form-group col-xl-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="locationable_type"><small>{{ __('common.Name') }}</small></label>
                        <select class="form-control form-control" id="locationable_id" name="locationable_id"
                            title="{{ __('common.Name') }}">
                            <option value="">{{ __('common.Select') }}</option>
                            @foreach($types as $type)
                            <option value="{{ $type->id }}" {{ ($locationable_id == $type->id ? 'selected':'') }}>
                                {{ $type->name }} {{ $type->last_name }} {{ $type->first_name }} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="street"><small>{{ __('common.Street') }}</small></label>
                        <input type="text" class="form-control" id="street" name="street"
                            placeholder="{{ __('common.Street') }}" value="{{ $location->street }}" {{ $action }}>
                    </div>

                    <div class="form-group col-xl-1">
                        <label class="text-muted mb-0 font-size-sm"
                            for="street_number"><small>{{ __('common.Number') }}</small></label>
                        <input type="text" class="form-control" id="street_number" name="street_number"
                            placeholder="{{ __('common.Number') }}" value="{{ $location->street_number }}"
                            {{ $action }}>
                    </div>

                    <div class="form-group col-xl-1">
                        <label class="text-muted mb-0 font-size-sm"
                            for="zip"><small>{{ __('common.Zip') }}</small></label>
                        <input type="text" class="form-control" id="zip" name="zip" placeholder="{{ __('common.Zip') }}"
                            value="{{ $location->zip }}" {{ $action }}>
                    </div>

                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="city"><small>{{ __('common.City') }}</small></label>
                        <input type="text" class="form-control" id="city" name="city"
                            placeholder="{{ __('common.City') }}" value="{{ $location->city }}" {{ $action }}>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="type"><small>{{ __('common.Type') }}</small></label>
                        <select class="form-control" id="type" name="type" @if($action==="readonly" ) disabled @endif
                            title="{{ __('common.Type') }}">
                            <option value="">{{ __('common.Select') }}</option>
                            @foreach($collection as $key => $value)
                            <option value="{{ $key }}" @if($location->type === $key) selected @endif>{{ $value }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-xl-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="country"><small>{{ __('common.Country') }}</small></label>
                        <select class="form-control" id="country" name="country" @if($action==="readonly" ) disabled
                            @endif>
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="Switzerland" @if($location->country=="Switzerland") selected
                                @endif>Switzerland</option>
                            <option value="Germany" @if($location->country=="Germany") selected @endif>Germany</option>
                        </select>
                    </div>

                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="email"><small>{{ __('common.Email') }}</small></label>
                        <input type="text" class="form-control" id="email" name="email"
                            placeholder="{{ __('common.Email') }}" value="{{ $location->email }}" {{ $action }}>
                    </div>

                    <div class="form-group col-xl-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="phone"><small>{{ __('common.Phone') }}</small></label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            placeholder="{{ __('common.Phone') }}" value="{{ $location->phone }}" {{ $action }}>
                    </div>


                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="url"><small>{{ __('common.Website') }}</small></label>
                        <input type="text" class="form-control" id="url" name="url"
                            placeholder="{{ __('common.Website') }}" value="{{ $location->url }}" {{ $action }}>
                    </div>

                    <div class="form-group col-xl-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="active"><small>{{ __('common.Active') }}</small></label>
                        <select {{ $action }} class="form-control" id="active" name="active">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="1" {{ (old('active') == 1 ? 'selected':'') }}>{{ __('common.Active') }}
                            </option>
                            <option value="0" {{ (old('active') == 0 ? 'selected':'') }}>{{ __('common.Inactive') }}
                            </option>
                        </select>
                    </div>

                    @if($action === "edit")
                    <div class="col-xl-3 custom-file">
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

                    <div class="form-group col-xl-12">
                        <label class="text-muted mb-0 font-size-sm"
                            for="description"><small>{{ __('common.Description') }}</small></label>
                        <textarea {{ $action }} rows="5"
                            class="form-control {{ @$errors->has('description') ? "is-invalid" : "" }}" id="description"
                            name="description"
                            placeholder="{{ __('common.Description') }}">{{ $location->description }}</textarea>
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

    @if (@$locations)
    <!-- Table Sections (.js-table-sections class is initialized in Helpers.tableToolsSections()) -->
    <div class="block block-rounded block-fx-pop block-themed">

        <div class="block-header block-header-default bg-primary-darker">
            <h3 class="block-title">{{ __('common.Locations') }}</h3>
            <div class="block-options pr-2">
                <form action="{{action('LocationController@index')}}" method="post">

                    <!-- Laravel CONTENT -->
                    @include('include.pagination')
                    <!-- Laravel CONTENT END -->

                </form>
            </div>
        </div>

        <div class="block-content">
            <!--
                Separate your table content with multiple tbody sections. Add one row and add the class .js-table-sections-header to a
                tbody section to make it clickable. It will then toggle the next tbody section which can have multiple rows. Eg:

                <tbody class="js-table-sections-header">One row</tbody>
                <tbody>Multiple rows</tbody>
                <tbody class="js-table-sections-header">One row</tbody>
                <tbody>Multiple rows</tbody>
                <tbody class="js-table-sections-header">One row</tbody>
                <tbody>Multiple rows</tbody>

                You can also add the class .show in your tbody.js-table-sections-header to make the next tbody section visible by default
                -->


            <table class="js-table-sections table table-hover table-vcenter">
                <thead>
                    <tr>
                        <th style="border-top: none;"></th>
                        <th style="border-top: none;">
                            @sortablelink('name', __('common.Name'))
                        </th>

                        <th style="border-top: none;" class="d-none d-sm-table-cell">
                            @sortablelink('street', __('common.Street'))
                        </th>

                        <th style="border-top: none;" class="d-none d-sm-table-cell">
                            @sortablelink('zip', __('common.Zip'))
                        </th>
                        <th style="border-top: none;" class="d-none d-sm-table-cell">
                            @sortablelink('city', __('common.City'))
                        </th>
                        <th style="border-top: none;" class="d-none d-sm-table-cell">
                            @sortablelink('updated_at', __('common.Updated'))
                        </th>
                        <th style="border-top: none;" class="text-right d-none d-sm-table-cell">
                            @can('create locations')
                            <a class="btn btn-dark" href="{{action('LocationController@create')}}">
                                <i class="si si-plus"></i>
                            </a>
                            @endcan
                        </th>
                    </tr>
                </thead>
                @csrf

                @foreach($locations as $location)
                <tbody class="js-table-sections-header">
                    <tr>
                        <td class="text-center">
                            <i class="fa fa-angle-right text-muted"></i>
                        </td>
                        <td>
                            <div class="py-1">
                                <a href="{{action('LocationController@show', $location->id)}}">{{ $location->street }}
                                    {{ $location->street_number }} {{ $location->city }}</a>
                            </div>
                        </td>

                        <td class="d-none d-sm-table-cell">
                            <div class="py-1">
                                {{ $location->street }} {{ $location->street_number }}
                            </div>
                        </td>
                        <td class="d-none d-sm-table-cell">
                            <div class="py-1">
                                {{ $location->zip }}
                            </div>
                        </td>
                        <td class="d-none d-sm-table-cell">
                            <div class="py-1">
                                {{ $location->city }}
                            </div>
                        </td>
                        <td class="d-none d-sm-table-cell">
                            <div class="py-1">
                                {{ Carbon::parse($location->created_at)->format('d.m.Y H:i')}}
                            </div>
                        </td>



                        <td class="d-none d-sm-table-cell text-right">
                            @can('update locations')
                            <a href="{{action('LocationController@edit', $location->id)}}" class="btn btn-primary">
                                <i class="nav-main-link-icon si si-pencil"></i>
                            </a>
                            @endcan

                            @can('delete locations')
                            <form action="{{action('LocationController@destroy', $location->id)}}" method="post"
                                class="d-inline">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">

                                <button type="submit" class="btn btn-danger">
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
                        <td colspan="7">
                            <h5>{{ __('common.Location') }}</h5>
                            <ul>
                                <li>{{ __('common.Phone') }}: {{ $location->phone }}</li>
                                <li>{{ __('common.Email') }}: {{ $location->email }}</li>
                                <li>{{ __('common.Website') }}: {{ $location->url }}</li>
                                <li>{{ __('common.Image') }}: {{ $location->picture }}</li>
                            </ul>

                            <em class="text-muted">{{ __('common.DateUpdated') }}:
                                {{ Carbon::parse($location->created_at)->format('d.m.Y H:i')}}</em>
                        </td>


                    </tr>

                </tbody>
                @endforeach
            </table>

        </div>

        @if ($locations->total() > $locations->perPage())
        <div
            class="block-content block-content-full block-content-sm bg-body-light d-flex justify-content-center align-content-center">
            {!! $locations->appends(\Request::except('page'))->render() !!}
        </div>
        @endif
    </div>
    @endif

    <!-- END Table Sections -->
</div>
<!-- END Page Content -->


@endsection