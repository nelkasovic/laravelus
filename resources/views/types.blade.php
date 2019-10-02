@extends('layouts.app')

@section('content')

<!-- Page Content -->
<div class="content">

    <!-- If edit or create or password -->
    @if (@$type)

    {{-- We are here only if variable appmodule is available --}}

    @if (@$action === 'edit' || @$action === 'readonly')

    <form action="{{action('TypeController@update', $id)}}" enctype="multipart/form-data" method="post">
        @csrf

        <input name="_method" type="hidden" value="PATCH">

        <!-- Block Tabs With Options Default Style -->
        <div class="block block-rounded block-themed block-mode-hidden">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ $type->name }}</h3>
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
                <h2 class="content-heading">{{ __('common.Edit') }}</h2>
                <div class="row">

                    <div class="form-group col-md-4">
                        <label class="text-muted mb-0 font-size-sm"
                            for="typeable_id"><small>{{ __('common.AppModules') }}</small></label>
                        <select @if($action==='readonly' ) disabled @endif
                            class="form-control {{ @$errors->has('typeable_id') ? "is-invalid" : "" }}" id="typeable_id"
                            name="typeable_id" title="{{ __('common.AppModules') }}">
                            <option value="">{{ __('common.Select') }}</option>
                            @foreach($appmodules as $appmodule)
                            <option value="{{ $appmodule->id }}"
                                {{ ($appmodule->id == $type->typeable_id ? 'selected':'') }}>
                                {{ __('common.'.$appmodule->name) }}
                            </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group col-md-4">
                        <label class="text-muted mb-0 font-size-sm"
                            for="name"><small>{{ __('common.Name') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('name') ? "is-invalid" : "" }}" id="name" name="name"
                            placeholder="{{ __('common.Name') }}" value="{{ $type->name }}">
                    </div>

                    <div class="form-group col-md-4">
                        <label class="text-muted mb-0 font-size-sm"
                            for="author"><small>{{ __('common.Author') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('author') ? "is-invalid" : "" }}" id="author"
                            name="author" placeholder="{{ __('common.Author') }}" value="{{ $type->author }}">
                    </div>


                    <div class="form-group col-md-8">
                        <label class="text-muted mb-0 font-size-sm"
                            for="description"><small>{{ __('common.Description') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('description') ? "is-invalid" : "" }}" id="description"
                            name="description" placeholder="{{ __('common.Description') }}"
                            value="{{ $type->description }}">
                    </div>

                    <div class="form-group col-md-4">
                        <label class="text-muted mb-0 font-size-sm"
                            for="active"><small>{{ __('common.Active') }}</small></label>
                        <select {{ $action }} class="form-control" id="active" name="active">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="0" {{ ($type->active == '' ? 'selected':'') }}>{{ __('common.Inactive') }}
                            </option>
                            <option value="1" {{ ($type->active == 1 ? 'selected':'') }}>{{ __('common.Active') }}
                            </option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="text-muted mb-0 font-size-sm"
                            for="url"><small>{{ __('common.URL') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('url') ? "is-invalid" : "" }}" id="url" name="url"
                            placeholder="{{ __('common.URL') }}" value="{{ $type->url }}">
                    </div>


                    <div class="col-md-6 custom-file">
                        <label class="text-muted mb-0 font-size-sm" for="image_url"><small>{{ __('common.Image') }}
                            </small></label>
                        <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                        <input {{ $action }} @if($action==='readonly' ) disabled @endif type="file"
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
                    <img class="img-avatar" src="{{ url('/images/'.$type->image_url) }}">
                </div>

                <a class="btn btn-warning" href="{{action('TypeController@index')}}">
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

    @if(@$categories)
    @if (@$action == 'edit' || @$action == 'readonly')
    <div class="block block-rounded block-themed">
        <div class="block-header block-header-default">
            <h3 class="block-title">{{ __('common.Components') }} </h3>
            <div class="block-options">
                <button type="button" class="btn-block-option" data-toggle="block-option"
                    data-action="fullscreen_toggle"></button>
                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="pinned_toggle">
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
        <div class="block-content">

            <table class="table table-vcenter js-table-sections table-hover">
                <thead>
                    <tr>
                        <th style="width: 30px; border-top: none;">#</th>
                        <th style="border-top: none;">{{ __('common.Name') }}</th>
                        <th style="border-top: none;">{{ __('common.Active') }}</th>
                        <th class="text-right" style="border-top: none;">
                            <a class="btn btn-dark" href="{{action('CategoryController@create', $type->id)}}">
                                <i class="si si-plus"></i>
                            </a>
                        </th>
                    </tr>
                </thead>
                @foreach($categories as $category)
                <tbody class="js-table-sections-header">
                    <tr>
                        <td class="text-center">
                            <i class="fa fa-angle-right text-muted"></i>
                        </td>
                        <td>
                            <div class="py-1">
                                <a href="{{action('CategoryController@show', $category->id)}}">{{ $category->name }}</a>
                            </div>
                        </td>

                        <td>
                            <div class="py-1">
                                {{ $category->active }}
                            </div>
                        </td>
                        <td class="d-none d-sm-table-cell text-right">
                            @can('update categories')
                            <a href="{{action('CategoryController@edit', $category->id)}}" class="btn btn-primary">
                                <i class="nav-main-link-icon si si-pencil"></i>
                            </a>
                            @endcan

                            @can('delete categories')
                            <form action="{{ action('CategoryController@destroy', $category->id) }}" method="post"
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
                        <td colspan="15">
                            {{ $category->description }}
                        </td>
                </tbody>
                @endforeach

            </table>
        </div>
    </div>
    @endif
    @endif
    <!-- END Block Tabs With Options Default Style -->
    @elseif (@$action === 'create')

    <form action="{{action('TypeController@store')}}" enctype="multipart/form-data" method="post">
        @csrf
        <input name="_method" type="hidden" value="POST">

        <!-- Block Tabs With Options Default Style -->
        <div class="block block-rounded block-themed">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ __('common.Types') }}</h3>
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

                    <div class="form-group col-md-4">
                        <label class="text-muted mb-0 font-size-sm"
                            for="typeable_id"><small>{{ __('common.AppModules') }}</small></label>
                        <select class="form-control {{ @$errors->has('typeable_id') ? "is-invalid" : "" }}"
                            id="typeable_id" name="typeable_id" title="{{ __('common.AppModules') }}">
                            <option value="">{{ __('common.Select') }}</option>
                            @foreach($appmodules as $appmodule)
                            <option value="{{ $appmodule->id }}"
                                {{ ($appmodule->id == old('typeable_id') ? 'selected':'') }}>
                                {{ __('common.'.$appmodule->name) }} ({{$appmodule->name}})
                            </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group col-md-4">
                        <label class="text-muted mb-0 font-size-sm"
                            for="name"><small>{{ __('common.Name') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('name') ? "is-invalid" : "" }}" id="name" name="name"
                            placeholder="{{ __('common.Name') }}" value="{{ old('name') }}">
                    </div>


                    <div class="form-group col-md-4">
                        <label class="text-muted mb-0 font-size-sm"
                            for="author"><small>{{ __('common.Author') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('author') ? "is-invalid" : "" }}" id="author"
                            name="author" placeholder="{{ __('common.Author') }}" value="{{ old('author') }}">
                    </div>

                    <div class="form-group col-md-8">
                        <label class="text-muted mb-0 font-size-sm"
                            for="description"><small>{{ __('common.Description') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('description') ? "is-invalid" : "" }}" id="description"
                            name="description" placeholder="{{ __('common.Description') }}"
                            value="{{ old('description') }}">
                    </div>


                    <div class="form-group col-md-4">
                        <label class="text-muted mb-0 font-size-sm"
                            for="active"><small>{{ __('common.Active') }}</small></label>
                        <select {{ $action }} class="form-control" id="active" name="active">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="0" {{ (old('active') == '' ? 'selected':'') }}>{{ __('common.Inactive') }}
                            </option>
                            <option value="1" {{ (old('active') == 1 ? 'selected':'') }}>{{ __('common.Active') }}
                            </option>
                        </select>
                    </div>


                    <div class="form-group col-md-6">
                        <label class="text-muted mb-0 font-size-sm"
                            for="url"><small>{{ __('common.URL') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('url') ? "is-invalid" : "" }}" id="url" name="url"
                            placeholder="{{ __('common.URL') }}" value="{{ old('url') }}">
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


                <a class="btn btn-warning" href="{{action('TypeController@index')}}">
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

    @if (@$types)
    <div class="block block-rounded block-themed">

        <div class="block-header block-header-default bg-primary-darker">
            <h3 class="block-title">{{ __('common.Types') }}</h3>
            <div class="block-options">
                @can('create types')
                <a class="btn btn-primary btn-sm" href="{{action('TypeController@create')}}">
                    <i class="si si-plus mr-1"></i> {{ __('common.Type') }} <span
                        class="text-lowercase">{{ __('common.Add') }}</span>
                </a>
                @endcan
            </div>
        </div>

        <div class="block-content">
            <div class="row mb-4">
                <div class="col-xl-10"></div>
                <div class="col-xl-2">
                    <form action="{{action('TypeController@index')}}" method="post">
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
                        <th>
                            @sortablelink('author', __('common.Module'))
                        </th>
                        <th>
                            @sortablelink('author', __('common.Author'))
                        </th>
                        <th>
                            @sortablelink('updated_at', __('common.DateUpdated'))
                        </th>

                        <th class="text-right">

                        </th>
                    </tr>
                </thead>
                @csrf

                @foreach($types as $type)
                <tbody class="js-table-sections-header">
                    <tr>
                        <td class="text-center">
                            <i class="fa fa-angle-right text-muted"></i>
                        </td>
                        <td>
                            <div class="py-1">
                                <a href="{{action('TypeController@show', $type->id)}}">{{ $type->name }} </a>
                            </div>
                        </td>
                        <td>

                            <div class="py-1">
                                {{ __('common.'.$type->typeable->name) }}
                            </div>
                        </td>
                        <td>

                            <div class="py-1">
                                {{ $type->author }}
                            </div>
                        </td>
                        <td>
                            <div class="py-1">
                                {{ Carbon::parse($type->updated_at)->format('d.m.Y H:i')}}
                            </div>
                        </td>


                        <td class="d-none d-sm-table-cell text-right">
                            @can('update types')
                            <a href="{{action('TypeController@edit', $type->id)}}" class="btn btn-sm btn-primary">
                                <i class="nav-main-link-icon si si-pencil"></i>
                            </a>
                            @endcan

                            @can('delete types')
                            <form action="{{action('TypeController@destroy', $type->id)}}" method="post"
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
                        <td colspan="6">
                            <p>{{ $type->description }}</p>
                            <p><a href="{{ $type->url }}" target="_blank">{{ $type->url }}</a></p>
                            <em class="text-muted">{{ Carbon::parse($type->updated_at)->format('d.m.Y H:i')}}</em>
                        </td>
                    </tr>
                </tbody>
                @endforeach
            </table>

        </div>

        @if ($types->total() > $types->perPage())
        <div
            class="block-content block-content-full block-content-sm bg-body-light d-flex justify-content-center align-content-center">
            {!! $types->appends(\Request::except('page'))->render() !!}
        </div>
        @endif
    </div>
    @endif

    <!-- END Table Sections -->
</div>
<!-- END Page Content -->


@endsection