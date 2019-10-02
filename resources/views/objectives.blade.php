@extends('layouts.app')

@section('content')

<!-- Page Content -->
<div class="content">

    <!-- If edit or create or password -->
    @if (@$objective)

    {{-- We are here only if variable typeitem is available --}}

    @if (@$action === 'edit' || @$action === 'readonly')

    <form action="{{action('ObjectiveController@update', $id)}}" enctype="multipart/form-data" method="post">
        @csrf

        <input name="_method" type="hidden" value="PATCH">

        <!-- Block Tabs With Options Default Style -->
        <div class="block block-rounded block-themed">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ $objective->name }}</h3>
            </div>
            <div class="block-content pb-4">
                <h2 class="content-heading">{{ __('common.Edit') }}</h2>
                <div class="row">
                    <div class="form-group col-md-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="role"><small>{{ __('common.Role') }}</small></label>
                        <select {{ $action }} class="form-control" id="role" name="role">
                            <option value="">{{ __('common.Select') }}</option>

                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="name"><small>{{ __('common.Name') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('name') ? "is-invalid" : "" }}" id="name" name="name"
                            placeholder="{{ __('common.Name') }}" value="{{ $objective->name }}">
                    </div>


                    <div class="form-group col-md-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="active"><small>{{ __('common.Active') }}</small></label>
                        <select {{ $action }} class="form-control" id="active" name="active">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="" {{ ($objective->active == '' ? 'selected':'') }}>
                                {{ __('common.Inactive') }}</option>
                            <option value="1" {{ ($objective->active == 1 ? 'selected':'') }}>{{ __('common.Active') }}
                            </option>
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="email"><small>{{ __('common.Email') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('email') ? "is-invalid" : "" }}" id="email"
                            name="email" placeholder="{{ __('common.Email') }}" value="{{ $objective->email  }}">
                    </div>
                </div>
                <h2 class="content-heading">{{ __('common.General') }}</h2>
                <div class="row">


                    <div class="form-group col-md-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="street"><small>{{ __('common.Street') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('street') ? "is-invalid" : "" }}" id="street"
                            name="street" placeholder="{{ __('common.Street') }}" value="{{ $objective->street }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="street_number"><small>{{ __('common.Number') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('street_number') ? "is-invalid" : "" }}"
                            id="street_number" name="street_number" placeholder="{{ __('common.Number') }}"
                            value="{{ $objective->street_number }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="zip"><small>{{ __('common.Zip') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('zip') ? "is-invalid" : "" }}" id="zip" name="zip"
                            placeholder="{{ __('common.Zip') }}" value="{{ $objective->zip }}">
                    </div>


                    <div class="form-group col-md-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="country"><small>{{ __('common.Country') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('country') ? "is-invalid" : "" }}" id="country"
                            name="country" placeholder="{{ __('common.Country') }}" value="{{ $objective->country }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="phone"><small>{{ __('common.Phone') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('phone') ? "is-invalid" : "" }}" id="phone"
                            name="phone" placeholder="{{ __('common.Phone') }}" value="{{ $objective->phone }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="mobile"><small>{{ __('common.Mobile') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('mobile') ? "is-invalid" : "" }}" id="mobile"
                            name="mobile" placeholder="{{ __('common.Mobile') }}" value="{{ $objective->mobile }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="fax"><small>{{ __('common.Fax') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('fax') ? "is-invalid" : "" }}" id="fax" name="fax"
                            placeholder="{{ __('common.Fax') }}" value="{{ $objective->fax }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="website"><small>{{ __('common.Website') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('website') ? "is-invalid" : "" }}" id="website"
                            name="website" placeholder="{{ __('common.Website') }}" value="{{ $objective->website }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label class="text-muted mb-0 font-size-sm"
                            for="description"><small>{{ __('common.Description') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('description') ? "is-invalid" : "" }}" id="description"
                            name="description" placeholder="{{ __('common.Description') }}"
                            value="{{ $objective->description }}">
                    </div>


                    <div class="col-md-6 custom-file">
                        <label class="text-muted mb-0 font-size-sm" for="image_url"><small>{{ __('common.Image') }}
                            </small></label>
                        <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                        <input {{ $action }} type="file"
                            class="custom-file-input js-custom-file-input-enabled {{ @$errors->has('image_url') ? "is-invalid" : "" }}"
                            data-toggle="custom-file-input" id="image_url" name="image_url"
                            placeholder="{{ __('common.Image') }}">
                        <label {{ $action }} class="custom-file-label" for="image_url"
                            style="margin-left: 14px; margin-right: 14px; top: 24px; ">{{ __('common.Choose') }}</label>
                    </div>
                </div>

            </div>
            <div class="block-content block-content-full text-right bg-light">
                <div class="d-none">
                    <img class="img-avatar" src="{{ url('/images/'.$objective->image_url) }}">
                </div>

                <a class="btn btn-warning" href="{{action('ObjectiveController@index')}}">
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

    <form action="{{action('ObjectiveController@store')}}" enctype="multipart/form-data" method="post">
        @csrf
        <input name="_method" type="hidden" value="POST">

        <!-- Block Tabs With Options Default Style -->
        <div class="block block-rounded block-themed">
            <div class="block-header block-header-default">
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

                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="name"><small>{{ __('common.Name') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('name') ? "is-invalid" : "" }}" id="name" name="name"
                            placeholder="{{ __('common.Name') }}" value="{{ old('name') }}">
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

                <h2 class="content-heading">{{ __('common.General') }}</h2>

                <div class="row">

                    <div class="form-group col-md-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="street"><small>{{ __('common.Street') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('street') ? "is-invalid" : "" }}" id="street"
                            name="street" placeholder="{{ __('common.Street') }}" value="{{ old('street') }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="street_number"><small>{{ __('common.Number') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('street_number') ? "is-invalid" : "" }}"
                            id="street_number" name="street_number" placeholder="{{ __('common.Number') }}"
                            value="{{ old('street_number') }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="zip"><small>{{ __('common.Zip') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('zip') ? "is-invalid" : "" }}" id="zip" name="zip"
                            placeholder="{{ __('common.Zip') }}" value="{{ old('zip') }}">
                    </div>


                    <div class="form-group col-md-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="country"><small>{{ __('common.Country') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('country') ? "is-invalid" : "" }}" id="country"
                            name="country" placeholder="{{ __('common.Country') }}" value="{{ old('country') }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="mobile"><small>{{ __('common.Mobile') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('mobile') ? "is-invalid" : "" }}" id="mobile"
                            name="mobile" placeholder="{{ __('common.Mobile') }}" value="{{ old('mobile') }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="fax"><small>{{ __('common.Fax') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('fax') ? "is-invalid" : "" }}" id="fax" name="fax"
                            placeholder="{{ __('common.Fax') }}" value="{{ old('fax') }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="model"><small>{{ __('common.Model') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('model') ? "is-invalid" : "" }}" id="model"
                            name="model" placeholder="{{ __('common.Model') }}" value="{{ old('model') }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="website"><small>{{ __('common.Website') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('website') ? "is-invalid" : "" }}" id="website"
                            name="website" placeholder="{{ __('common.Website') }}" value="{{ old('website') }}">
                    </div>


                    <div class="form-group col-md-6">
                        <label class="text-muted mb-0 font-size-sm"
                            for="description"><small>{{ __('common.Description') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('description') ? "is-invalid" : "" }}" id="description"
                            name="description" placeholder="{{ __('common.Description') }}"
                            value="{{ old('description') }}">
                    </div>

                    <div class="col-md-6 custom-file">
                        <label class="text-muted mb-0 font-size-sm" for="image_url"><small>{{ __('common.Image') }}
                            </small></label>
                        <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                        <input {{ $action }} type="file"
                            class="custom-file-input js-custom-file-input-enabled {{ @$errors->has('image_url') ? "is-invalid" : "" }}"
                            data-toggle="custom-file-input" id="image_url" name="image_url"
                            placeholder="{{ __('common.Image') }}">
                        <label class="custom-file-label" for="image_url"
                            style="margin-left: 14px; margin-right: 14px; top: 24px; ">{{ __('common.Choose') }}</label>
                    </div>
                </div>

            </div>
            <div class="block-content block-content-full text-right bg-light">


                <a class="btn btn-warning" href="{{action('ObjectiveController@index')}}">
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

    @if (@$objectives)
    <!-- Table Sections (.js-table-sections class is initialized in Helpers.tableToolsSections()) -->
    <div class="block block-rounded block-themed block-fx-pop">

        <div class="block-header block-header-default bg-primary-darker">
            <h3 class="block-title">{{ __('common.Users') }}</h3>
            <div class="block-options">
                <div class="btn-group">
                    @can('read objectives')
                    <a class="btn btn-light btn-sm" href="javascript:void(0)" onclick="getObjectives();">
                        <i class="si si-share-alt mr-1"></i> {{ __('common.Objectives') }} XHR</span>
                    </a>
                    <a class="btn btn-light btn-sm" href="{{action('ExportController@objectives')}}">
                        <i class="si si-share-alt mr-1"></i> {{ __('common.Excel') }}</span>
                    </a>
                    @endcan

                    @can('create objectives')
                    <a class="btn btn-primary btn-sm" href="{{action('ObjectiveController@create')}}">
                        <i class="si si-user mr-1"></i> {{ __('common.Objective') }} <span
                            class="text-lowercase">{{ __('common.Add') }}</span>
                    </a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="block-content">
            <form action="{{action('ObjectiveController@index')}}" method="post">
                <div class="row mb-4">
                    <div class="col-xl-4">
                        <div class="form-group">
                            <select class="form-control" id="course_id" name="course_id"
                                title="{{ __('common.Course') }}" onchange="this.form.submit()">
                                <option value="">{{ __('common.Select') }}</option>
                                @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ ($selected == $course->id ? 'selected':'') }}>
                                    {{ $course->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-6"></div>
                    <div class="col-xl-2">
                        <!-- Pagination -->
                        @include('include.pagination')
                        <!-- Pagination END -->
                    </div>
                </div>
            </form>
            <table class="js-table-sections table table-hover table-vcenter">
                <thead>
                    <tr>
                        <th></th>
                        <th>
                            @sortablelink('name', __('common.Name'))
                        </th>

                        <th class="d-none d-sm-table-cell text-right">
                            @sortablelink('updated_at', __('common.DateUpdated'))
                        </th>

                        <th class="text-right d-none d-sm-table-cell">

                        </th>
                    </tr>
                </thead>
                @csrf

                @foreach($objectives as $objective)
                <tbody class="js-table-sections-header">
                    <tr>
                        <td class="text-center">
                            <i class="fa fa-angle-right text-muted"></i>
                        </td>
                        <td>
                            <div class="py-1">
                                <a href="{{action('ObjectiveController@show', $objective->id)}}">{{ $objective->name }}
                                </a>
                            </div>
                        </td>

                        <td class="d-none d-sm-table-cell text-right">
                            <div class="py-1">
                                {{ Carbon::parse($objective->updated_at)->format('d.m.Y H:i')}}
                            </div>
                        </td>


                        <td class="d-none d-sm-table-cell text-right">
                            @can('update objectives')
                            <a href="{{action('ObjectiveController@edit', $objective->id)}}"
                                class="btn btn-primary btn-sm">
                                <i class="nav-main-link-icon si si-pencil"></i>
                            </a>
                            @endcan

                            @can('delete objectives')
                            <form action="{{action('ObjectiveController@destroy', $objective->id)}}" method="post"
                                class="d-inline">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">

                                <button type="submit" class="btn btn-danger btn-sm">
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
                            <p>{{ $objective->description }}</p>
                            <p><a href="{{ $objective->website }}" target="_blank">{{ $objective->website }}</a></p>
                            <em class="text-muted">{{ Carbon::parse($objective->updated_at)->format('d.m.Y H:i')}}</em>
                        </td>

                    </tr>

                </tbody>
                @endforeach
            </table>

        </div>

        @if ($objectives->total() > $objectives->perPage())
        <div
            class="block-content block-content-full block-content-sm bg-body-light d-flex justify-content-center align-content-center">
            {!! $objectives->appends(\Request::except('page'))->render() !!}
        </div>
        @endif
    </div>
    @endif

    <!-- END Table Sections -->
</div>
<!-- END Page Content -->


@endsection