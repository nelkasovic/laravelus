@extends('layouts.app')

@section('content')

<!-- Page Content -->
<div class="content">

    <!-- If edit or create or password -->
    @if (@$method)

    {{-- We are here only if variable method is available --}}

    @if (@$action === 'edit' || @$action === 'readonly')

    <form action="{{action('MethodController@update', $id)}}" enctype="multipart/form-data" method="post">
        @csrf

        <input name="_method" type="hidden" value="PATCH">

        <!-- Block Tabs With Options Default Style -->
        <div class="block block-rounded block-fx-pop block-themed">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ $method->name }}</h3>
            </div>
            <div class="block-content pb-4">
                <h2 class="content-heading">{{ __('common.Edit') }}</h2>
                <div class="row">

                    <div class="form-group col-lg-4">
                        <label class="text-muted mb-0 font-size-sm"
                            for="name"><small>{{ __('common.Name') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('name') ? " is-invalid" : "" }}" id="name" name="name"
                            placeholder="{{ __('common.Name') }}" value="{{ $method->name }}">
                    </div>

                    <div class="form-group col-lg-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="time"><small>{{ __('common.Time')}}</small></label>
                        <input {{ $action }} type="number"
                            class="form-control {{ @$errors->has('time') ? " is-invalid" : "" }}" id="time" name="time"
                            placeholder="{{ __('common.Time') }}" value="{{ $method->time }}">
                    </div>

                    <div class="form-group col-lg-6">
                        <label class="text-muted mb-0 font-size-sm"
                            for="url"><small>{{ __('common.URL') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('url') ? " is-invalid" : "" }}" id="url" name="url"
                            placeholder="{{ __('common.URL') }}" value="{{ $method->url }}">
                    </div>

                    <div class="form-group col-lg-4">
                        <label class="text-muted mb-0 font-size-sm"
                            for="active"><small>{{ __('common.Active') }}</small></label>
                        <select {{ $action }} class="form-control" id="active" name="active">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="0" {{ ($method->active != 1 ? 'selected':'') }}>{{ __('common.Inactive') }}
                            </option>
                            <option value="1" {{ ($method->active == 1 ? 'selected':'') }}>{{ __('common.Active') }}
                            </option>
                        </select>
                    </div>

                    <div class="col-lg-4">
                        <label class="text-muted mb-0 font-size-sm"
                            for="color"><small>{{ __('common.Color') }}</small></label>
                        <div class="js-colorpicker input-group" data-format="hex">
                            <input {{ $action }} type="text" class="form-control" id="color" name="color"
                                value="{{ $method->color }}">
                            <div class="input-group-append">
                                <span class="input-group-text colorpicker-input-addon">
                                    <i></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <label class="text-muted mb-0 font-size-sm" for="image_url"><small>{{ __('common.Image') }}
                            </small></label>
                        <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                        <input {{ $action }} type="file"
                            class="custom-file-input js-custom-file-input-enabled {{ @$errors->has('image_url') ? " is-invalid" : "" }}"
                            data-toggle="custom-file-input" id="image_url" name="image_url"
                            placeholder="{{ __('common.Image') }}">
                        <label {{ $action }} class="custom-file-label" for="image_url"
                            style="margin-left: 14px; margin-right: 14px; top: 24px; ">{{ __('common.Choose') }}</label>
                    </div>

                    <div class="form-group col-lg-12">
                        <label class="text-muted mb-0 font-size-sm"
                            for="description"><small>{{ __('common.Description') }}</small></label>
                        <textarea {{ $action }} rows="3"
                            class="form-control {{ @$errors->has('description') ? " is-invalid" : "" }}"
                            id="description" name="description"
                            placeholder="{{ __('common.Description') }}">{{ $method->description }}</textarea>
                    </div>

                    <div class="form-group col-lg-12">
                        <label class="text-muted mb-0 font-size-sm"
                            for="approach"><small>{{ __('common.Approach') }}</small></label>
                        <textarea {{ $action }} rows="3"
                            class="form-control {{ @$errors->has('approach') ? " is-invalid" : "" }}" id="approach"
                            name="approach" placeholder="{{ __('common.Approach') }}">{{ $method->approach }}</textarea>
                    </div>

                    <div class="form-group col-lg-12">
                        <label class="text-muted mb-0 font-size-sm"
                            for="effect"><small>{{ __('common.Effect') }}</small></label>
                        <textarea {{ $action }} rows="3"
                            class="form-control {{ @$errors->has('effect') ? " is-invalid" : "" }}" id="effect"
                            name="effect" placeholder="{{ __('common.Effect') }}">{{ $method->effect }}</textarea>
                    </div>


                </div>

            </div>
            <div class="block-content block-content-full text-right bg-light">

                <a class="btn btn-warning" href="{{action('MethodController@index')}}">
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

    <form action="{{action('MethodController@store')}}" enctype="multipart/form-data" method="post">
        @csrf
        <input name="_method" type="hidden" value="POST">

        <!-- Block Tabs With Options Default Style -->
        <div class="block block-rounded block-fx-pop block-themed block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ __('common.Method') }}</h3>
            </div>
            <div class="block-content pb-4">
                <h2 class="content-heading">{{ __('common.New') }}</h2>
                <div class="row">

                    <div class="form-group col-lg-4">
                        <label class="text-muted mb-0 font-size-sm"
                            for="name"><small>{{ __('common.Name')}}</small></label>
                        <input {{ $action }} type="text" class="form-control {{ @$errors->has('name') ? " is-invalid"
                            : "" }}" id="name" name="name" placeholder="{{ __('common.Name') }}"
                            value="{{ old('name') }}">
                    </div>

                    <div class="form-group col-lg-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="time"><small>{{ __('common.Time')}}</small></label>
                        <input {{ $action }} type="number" class="form-control {{ @$errors->has('time') ? " is-invalid"
                            : "" }}" id="time" name="time" placeholder="{{ __('common.Time') }}"
                            value="{{ old('time') }}">
                    </div>

                    <div class="form-group col-lg-6">
                        <label class="text-muted mb-0 font-size-sm"
                            for="url"><small>{{ __('common.URL')}}</small></label>
                        <input {{ $action }} type="text" class="form-control {{ @$errors->has('url') ? " is-invalid"
                            : "" }}" id="url" name="url" placeholder="{{ __('common.URL') }}" value="{{ old('url') }}">
                    </div>

                    <div class="form-group col-lg-4">
                        <label class="text-muted mb-0 font-size-sm"
                            for="active"><small>{{ __('common.Active')}}</small></label>
                        <select {{ $action }} class="form-control" id="active" name="active">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="0" {{ (old('active') !=1 ? 'selected' :'') }}>{{ __('common.Inactive') }}
                            </option>
                            <option value="1" {{ (old('active')==1 ? 'selected' :'') }}>{{ __('common.Active') }}
                            </option>
                        </select>
                    </div>

                    <div class="col-lg-4">
                        <label class="text-muted mb-0 font-size-sm"
                            for="color"><small>{{ __('common.Color')}}</small></label>
                        <div class="js-colorpicker input-group" data-format="hex">
                            <input {{ $action }} type="text" class="form-control" id="color" name="color"
                                value="{{ old('color') }}">
                            <div class="input-group-append">
                                <span class="input-group-text colorpicker-input-addon">
                                    <i></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <label class="text-muted mb-0 font-size-sm" for="image_url"><small>{{ __('common.Image') }}
                            </small></label>
                        <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                        <input {{ $action }} type="file" class="custom-file-input js-custom-file-input-enabled {{ @$errors->has('image_url') ? "
                            is-invalid" : "" }}" data-toggle="custom-file-input" id="image_url" name="image_url"
                            placeholder="{{ __('common.Image') }}">
                        <label {{ $action }} class="custom-file-label" for="image_url"
                            style="margin-left: 14px; margin-right: 14px; top: 24px; ">{{ __('common.Choose') }}</label>
                    </div>

                    <div class="form-group col-lg-12">
                        <label class="text-muted mb-0 font-size-sm"
                            for="description"><small>{{ __('common.Description')}}</small></label>
                        <textarea {{ $action }} rows="3" class="form-control {{ @$errors->has('description') ? "
                            is-invalid" : "" }}" id="description" name="description"
                            placeholder="{{ __('common.Description') }}">{{ old('description') }}</textarea>
                    </div>

                    <div class="form-group col-lg-12">
                        <label class="text-muted mb-0 font-size-sm"
                            for="approach"><small>{{ __('common.Approach')}}</small></label>
                        <textarea {{ $action }} rows="3" class="form-control {{ @$errors->has('approach') ? "
                            is-invalid" : "" }}" id="approach" name="approach"
                            placeholder="{{ __('common.Approach') }}">{{ old('approach') }}</textarea>
                    </div>

                    <div class="form-group col-lg-12">
                        <label class="text-muted mb-0 font-size-sm"
                            for="effect"><small>{{ __('common.Effect')}}</small></label>
                        <textarea {{ $action }} rows="3" class="form-control {{ @$errors->has('effect') ? " is-invalid"
                            : "" }}" id="effect" name="effect"
                            placeholder="{{ __('common.Effect') }}">{{ old('effect') }}</textarea>
                    </div>


                </div>

            </div>
            <div class="block-content block-content-full text-right bg-light">

                <a class="btn btn-warning" href="{{action('MethodController@index')}}">
                    <i class="si si-action-undo mr-1"></i>
                    {{ __('common.Close') }}
                </a>
                @if (@$action === 'edit' || $action === 'create')
                <button type="submit" class="btn btn-primary">
                    <i class="si si-fire mr-1"></i>
                    {{ __('common.Save') }}
                </button>
                @endif
            </div>
        </div>
    </form>


    @endif
    @endif

    @if (@$methods)
    <div class="block block-rounded block-fx-pop block-themed">

        <div class="block-header block-header-default bg-primary-darker">
            <h3 class="block-title">{{ __('common.Methods') }}</h3>
            <div class="block-options">

                <div class="btn-group">
                    @can('read methods')
                    <a class="btn btn-light btn-sm" href="javascript:void(0)" onclick="getMethods();">
                        <i class="si si-share-alt mr-1"></i> {{ __('common.Methods') }} XHR</span>
                    </a>
                    <a class="btn btn-light btn-sm" href="{{action('ExportController@methods')}}">
                        <i class="si si-share-alt mr-1"></i> {{ __('common.Excel') }}</span>
                    </a>
                    @endcan
                    @can('create methods')
                    <a class="btn btn-primary btn-sm" href="{{action('MethodController@create')}}">
                        <i class="si si-plus mr-1"></i> {{ __('common.Method') }} <span class="text-lowercase">{{
                            __('common.Add') }}</span>
                    </a>
                    @endcan
                </div>

            </div>
        </div>

        <div class="block-content">
            <div class="row mb-4">
                <div class="col-xl-10"></div>
                <div class="col-xl-2">
                    <form action="{{action('MethodController@index')}}" method="post">
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

                        <th class="d-none d-md-table-cell">
                            @sortablelink('description', __('common.Time'))
                        </th>
                        <th class="d-none d-md-table-cell">
                            @sortablelink('updated_at', __('common.DateUpdated'))
                        </th>

                        <th class="text-right">

                        </th>
                    </tr>
                </thead>
                @csrf

                @foreach($methods as $method)
                <tbody class="js-table-sections-header">
                    <tr>
                        <td class="text-center">
                            <i class="fa fa-angle-right text-muted"></i>
                        </td>
                        <td>
                            <div class="py-1">
                                <a href="{{action('MethodController@show', $method->id)}}">{{ $method->name }} </a>
                            </div>
                        </td>

                        <td class="d-none d-md-table-cell">
                            <div class="py-1">
                                {{ $method->time }}
                            </div>
                        </td>
                        <td class="d-none d-md-table-cell">
                            <div class="py-1">
                                {{ Carbon::parse($method->updated_at)->format('d.m.Y H:i')}}
                            </div>
                        </td>

                        <td class="text-right">
                            <div class="btn-group">
                                <a href="{{action('MethodController@downvote', $method->id)}}"
                                    class="btn btn-sm btn-light">
                                    <i class="nav-main-link-icon si si-dislike mr-2"></i> {{ $method->downVotesCount()}}
                                </a>
                                <a href="{{action('MethodController@upvote', $method->id)}}"
                                    class="btn btn-sm btn-light">
                                    <i class="nav-main-link-icon si si-like mr-2"></i> {{ $method->upVotesCount() }}
                                </a>
                            </div>
                            @can('update methods')
                            <a href="{{action('MethodController@edit', $method->id)}}"
                                class="btn btn-sm btn-primary d-none d-sm-inline-block">
                                <i class="nav-main-link-icon si si-pencil"></i>
                            </a>
                            @endcan
                            @can('delete methods')
                            <form action="{{action('MethodController@destroy', $method->id)}}" method="post"
                                class="d-none d-sm-inline-block">
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
                        <td colspan="6">
                            <h4>{{ __('common.Description') }}</h4>
                            <p>{{ $method->description }}</p>
                            <h4>{{ __('common.Effect') }}</h4>
                            <p>{{ $method->effect }}</p>
                            <h4>{{ __('common.Approach') }}</h4>
                            <p>{{ $method->approach }}</p>
                            <p><a href="{{ $method->url }}" target="_blank">{{ $method->url }}</a></p>
                        </td>


                    </tr>

                </tbody>
                @endforeach
            </table>

        </div>

        @if ($methods->total() > $methods->perPage())
        <div
            class="block-content block-content-full block-content-sm bg-body-light d-flex justify-content-center align-content-center">
            {!! $methods->appends(\Request::except('page'))->render() !!}
        </div>
        @endif
    </div>
    @endif

    <!-- END Table Sections -->
</div>
<!-- END Page Content -->


@endsection