@extends('layouts.app')

@section('content')


<!-- Page Content -->
<div class="content">

    <!-- If edit or create -->
    @if (@$asset)

    {{-- We are here only if variable is available --}}

    @if (@$action === 'edit' || @$action === 'readonly')

    <form action="{{action('AssetController@update', $id)}}" enctype="multipart/form-data" method="post">
        @csrf

        <input name="_method" type="hidden" value="PATCH">

        <!-- Block Tabs With Options Default Style -->
        <div class="block block-rounded block-themed">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ $asset->name }}</h3>
            </div>
            <div class="block-content pb-4">
                <h2 class="content-heading">{{ __('common.Edit') }}</h2>

                <div class="row">

                    <div class="form-group col-md-4">
                        <label class="text-muted mb-0 font-size-sm"
                            for="name"><small>{{ __('common.Category') }}</small></label>
                        <select class="form-control" id="category_id" name="category_id"
                            title="{{ __('common.Category') }}">
                            <option value="">{{ __('common.Select') }}</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ ($asset->category_id == $category->id ? 'selected':'') }}>{{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="text-muted mb-0 font-size-sm"
                            for="name"><small>{{ __('common.Name') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('name') ? "is-invalid" : "" }}" id="name" name="name"
                            placeholder="{{ __('common.Name') }}" value="{{ $asset->name }}">
                    </div>

                    <div class="form-group col-md-4">
                        <label class="text-muted mb-0 font-size-sm"
                            for="serial_number"><small>{{ __('common.SerialNumber') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('serial_number') ? "is-invalid" : "" }}"
                            id="serial_number" name="serial_number" placeholder="{{ __('common.SerialNumber') }}"
                            value="{{ $asset->serial_number }}">
                    </div>

                    <div class="form-group col-md-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="active"><small>{{ __('common.Active') }}</small></label>
                        <select {{ $action }} class="form-control" id="active" name="active">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="1" {{ $asset->active == 1 ? 'selected':'' }}>{{ __('common.Active') }}
                            </option>
                            <option value="0" {{ $asset->active != 1 ? 'selected':'' }}>{{ __('common.Inactive') }}
                            </option>
                        </select>
                    </div>

                    <div class="form-group col-lg-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="color"><small>{{ __('common.Color') }}</small></label>
                        <div class="js-colorpicker input-group" data-format="hex">
                            <input {{ $action }} type="text" class="form-control" id="color" name="color"
                                value="{{ $asset->color }}">
                            <div class="input-group-append">
                                <span class="input-group-text colorpicker-input-addon">
                                    <i></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <label class="text-muted mb-0 font-size-sm"
                            for="daterange"><small>{{ __('common.DateRange') }}</small></label>
                        <div class="input-daterange input-group" data-date-format="dd.mm.yyyy" data-week-start="1"
                            data-autoclose="true" data-today-highlight="true">
                            <input {{ $action }} type="text" class="form-control text-left" id="valid_from"
                                name="valid_from" data-date-default-date="now"
                                placeholder="{{ __('common.Date') }} {{ __('common.From') }}" data-week-start="1"
                                data-autoclose="true" data-today-highlight="true"
                                value="{{ $asset->valid_from ? Carbon::parse($asset->valid_from)->format('d.m.Y') : '' }}">
                            <div class="input-group-prepend input-group-append">
                                <span class="input-group-text font-w600">
                                    <i class="fa fa-fw fa-arrow-right"></i>
                                </span>
                            </div>
                            <input {{ $action }} type="text" class="form-control text-left" id="valid_to"
                                name="valid_to" placeholder="{{ __('common.Date') }} {{ __('common.To') }}"
                                data-week-start="1" data-autoclose="true" data-today-highlight="true"
                                value="{{ $asset->valid_to ? Carbon::parse($asset->valid_to)->format('d.m.Y') : '' }}">
                        </div>
                    </div>

                    @if($action === "edit")
                    <div class="form-group col-md-4">
                        <label class="text-muted mb-0 font-size-sm" for="picture"><small>{{ __('common.Image') }}
                            </small></label>
                        <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                        <input {{ $action }} type="file" class="custom-file-input js-custom-file-input-enabled"
                            data-toggle="custom-file-input" id="picture" name="picture"
                            placeholder="{{ __('common.Image') }}" {{ $action }}>
                        <label class="custom-file-label" for="picture"
                            style="margin-left: 14px; margin-right: 14px; top: 24px; ">{{ __('common.Choose') }}</label>
                    </div>
                    @endif

                    <div class="form-group col-md-12">
                        <label class="text-muted mb-0 font-size-sm"
                            for="description"><small>{{ __('common.Description') }}</small></label>
                        <textarea {{ $action }}
                            class="form-control {{ @$errors->has('description') ? "is-invalid" : "" }}" id="description"
                            name="description"
                            placeholder="{{ __('common.Description') }}">{{ $asset->description }}</textarea>
                    </div>
                </div>

            </div>
            <div class="block-content block-content-full text-right bg-light">
                <div class="d-none">
                    <img class="img-avatar" src="{{ url('/images/'.$asset->image_url) }}">
                </div>

                <a class="btn btn-warning" href="{{action('AssetController@index')}}">
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

    <form action="{{action('AssetController@store')}}" enctype="multipart/form-data" method="post">
        @csrf
        <input name="_method" type="hidden" value="POST">

        <!-- Block Tabs With Options Default Style -->
        <div class="block block-rounded block-themed">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ __('common.Asset') }}</h3>
            </div>
            <div class="block-content pb-4">
                <h2 class="content-heading">{{ __('common.New') }}</h2>
                <div class="row">

                    <div class="col-md-4">
                        <label class="text-muted mb-0 font-size-sm"
                            for="name"><small>{{ __('common.Category') }}</small></label>
                        <select class="form-control" id="category_id" name="category_id"
                            title="{{ __('common.Category') }}">
                            <option value="">{{ __('common.Select') }}</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ (old('category_id') == $category->id ? 'selected':'') }}>{{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label class="text-muted mb-0 font-size-sm"
                            for="name"><small>{{ __('common.Name') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('name') ? "is-invalid" : "" }}" id="name" name="name"
                            placeholder="{{ __('common.Name') }}" value="{{ $asset->name }}">
                    </div>

                    <div class="form-group col-md-4">
                        <label class="text-muted mb-0 font-size-sm"
                            for="serial_number"><small>{{ __('common.SerialNumber') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('serial_number') ? "is-invalid" : "" }}"
                            id="serial_number" name="serial_number" placeholder="{{ __('common.SerialNumber') }}"
                            value="{{ old('serial_number') }}">
                    </div>


                    <div class="form-group col-md-4">
                        <label class="text-muted mb-0 font-size-sm"
                            for="active"><small>{{ __('common.Active') }}</small></label>
                        <select {{ $action }} class="form-control" id="active" name="active">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="1" {{ (old('active') == '1' ? 'selected':'') }}>{{ __('common.Active') }}
                            </option>
                            <option value="0" {{ (old('active') == '0' ? 'selected':'') }}>{{ __('common.Inactive') }}
                            </option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="text-muted mb-0 font-size-sm"
                            for="daterange"><small>{{ __('common.DateRange') }}</small></label>
                        <div class="input-daterange input-group" data-date-format="dd.mm.yyyy" data-week-start="1"
                            data-autoclose="true" data-today-highlight="true">
                            <input type="text" class="form-control text-left" id="valid_from" name="valid_from"
                                data-date-default-date="now"
                                placeholder="{{ __('common.Date') }} {{ __('common.From') }}" data-week-start="1"
                                data-autoclose="true" data-today-highlight="true"
                                value="{{ (old('valid_from')) ? old('valid_from') : Carbon::now()->format('d.m.Y') }}">
                            <div class="input-group-prepend input-group-append">
                                <span class="input-group-text font-w600">
                                    <i class="fa fa-fw fa-arrow-right"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control text-left" id="valid_to" name="valid_to"
                                placeholder="{{ __('common.Date') }} {{ __('common.To') }}" data-week-start="1"
                                data-autoclose="true" data-today-highlight="true"
                                value="{{ (old('valid_to')) ? old('valid_to') : Carbon::now()->addYears(5)->format('d.m.Y') }}">
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="color"><small>{{ __('common.Color') }}</small></label>
                        <div class="js-colorpicker input-group" data-format="hex">
                            <input {{ $action }} type="text" class="form-control" id="color" name="color"
                                value="{{ $asset->color }}">
                            <div class="input-group-append">
                                <span class="input-group-text colorpicker-input-addon">
                                    <i></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <label class="text-muted mb-0 font-size-sm"
                            for="description"><small>{{ __('common.Description') }}</small></label>
                        <textarea class="form-control {{ @$errors->has('description') ? "is-invalid" : "" }}"
                            id="description" name="description"
                            placeholder="{{ __('common.Description') }}">{{ old('description') }}</textarea>
                    </div>

                </div>


            </div>
            <div class="block-content block-content-full text-right bg-light">


                <a class="btn btn-warning" href="{{action('AssetController@index')}}">
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

    @if (@$assets)
    <!-- Table Sections (.js-table-sections class is initialized in Helpers.tableToolsSections()) -->
    <div class="block block-rounded block-fx-pop block-themed">

        <div class="block-header block-header-default bg-primary-darker">
            <h3 class="block-title">{{ __('common.Assets') }}</h3>
            <div class="block-options">
                <div class="btn-group">
                    @can('read assets')
                    <a class="btn btn-light btn-sm" href="javascript:void(0)" onclick="getAssets();">
                        <i class="si si-share-alt mr-1"></i> {{ __('common.Assets') }} XHR</span>
                    </a>
                    <a class="btn btn-light btn-sm" href="{{action('ExportController@assets')}}">
                        <i class="si si-share-alt mr-1"></i> {{ __('common.Excel') }}</span>
                    </a>
                    @endcan
                    @can('create assets')
                    <a class="btn btn-primary btn-sm" href="{{action('AssetController@create')}}">
                        <i class="si si-plus mr-1"></i> {{ __('common.Asset') }} <span
                            class="text-lowercase">{{ __('common.Add') }}</span>
                    </a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="block-content">
            <div class="row mb-4">
                <div class="col-xl-10"></div>
                <div class="col-xl-2">
                    <form action="{{action('AssetController@index')}}" method="post">
                        <!-- Pagination -->
                        @include('include.pagination')
                        <!-- Pagination END -->
                    </form>
                </div>
            </div>
            <table class="js-table-sections table table-hover table-vcenter">
                <thead>
                    <tr>
                        <th style="border-top: none;"></th>
                        <th style="border-top: none;">
                            @sortablelink('name', __('common.Name'))
                        </th>

                        <th style="border-top: none;" class="d-none d-lg-table-cell">
                            @sortablelink('serial_number', __('common.SerialNumber'))
                        </th>

                        <th style="border-top: none;" class="d-none d-lg-table-cell">
                            @sortablelink('category_id', __('common.Type'))
                        </th>

                        <th style="border-top: none;" class="d-none d-xl-table-cell">
                            @sortablelink('updated_at', __('common.Updated'))
                        </th>
                        <th style="border-top: none;" class="text-right d-none d-sm-table-cell">

                        </th>
                    </tr>
                </thead>
                @csrf

                @foreach($assets as $asset)
                <tbody class="js-table-sections-header">
                    <tr>
                        <td class="text-center">
                            <i class="fa fa-angle-right text-muted"></i>
                        </td>
                        <td>
                            <div class="py-1">
                                <a href="{{action('AssetController@show', $asset->id)}}">{{ $asset->name }} </a>
                            </div>
                        </td>
                        <td class="d-none d-lg-table-cell">
                            <div class="py-1">
                                {{ $asset->serial_number }}
                            </div>
                        </td>
                        <td class="d-none d-lg-table-cell">
                            <div class="py-1">
                                {{ $asset->category->name }}
                            </div>
                        </td>

                        <td class="d-none d-xl-table-cell">
                            <div class="py-1">
                                {{ Carbon::parse($asset->updated_at)->format('d.m.Y H:i')}}
                            </div>
                        </td>

                        <td class="d-none d-sm-table-cell text-right">
                            @can('vote assets')
                            <div class="btn-group">
                                <a href="{{action('AssetController@downvote', $asset->id)}}"
                                    class="btn btn-sm btn-light">
                                    <i class="nav-main-link-icon si si-dislike mr-2"></i> {{ $asset->downVotesCount() }}
                                </a>
                                <a href="{{action('AssetController@upvote', $asset->id)}}" class="btn btn-sm btn-light">
                                    <i class="nav-main-link-icon si si-like mr-2"></i> {{ $asset->upVotesCount() }}
                                </a>
                            </div>
                            @endcan

                            @can('update assets')
                            <a href="{{action('AssetController@edit', $asset->id)}}" class="btn btn-sm btn-primary">
                                <i class="nav-main-link-icon si si-pencil"></i>
                            </a>
                            @endcan

                            @can('delete assets')
                            <form action="{{action('AssetController@destroy', $asset->id)}}" method="post"
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
                        <td colspan="7">
                            <p>{{ $asset->description }}</p>

                            <em class="text-muted">{{ __('common.DateUpdated') }}:
                                {{ Carbon::parse($asset->created_at)->format('d.m.Y H:i')}}</em>
                        </td>


                    </tr>

                </tbody>
                @endforeach
            </table>

        </div>

        @if ($assets->total() > $assets->perPage())
        <div
            class="block-content block-content-full block-content-sm bg-body-light d-flex justify-content-center align-content-center">
            {!! $assets->appends(\Request::except('page'))->render() !!}
        </div>
        @endif
    </div>
    @endif

    <!-- END Table Sections -->
</div>
<!-- END Page Content -->


@endsection