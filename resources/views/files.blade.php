@extends('layouts.app')

@section('content')

<!-- Page Content -->
<div class="content">

    <!-- If edit or create or password -->
    @if (@$file)

    {{-- We are here only if variable file is available --}}

    @if (@$action === 'edit' || @$action === 'readonly')

    <form action="{{action('FileController@update', $id)}}" enctype="multipart/form-data" method="post">
        @csrf

        <input name="_method" type="hidden" value="PATCH">

        <!-- Block Tabs With Options Default Style -->
        <div class="block block-rounded block-themed block-fx-pop">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ $file->name }}</h3>
            </div>
            <div class="block-content pb-4">
                <h2 class="content-heading">{{ __('common.Edit') }}</h2>
                <div class="row">

                    <div class="form-group col-md-2">
                        <label class="text-muted mb-0 font-size-sm" for="type_item_id"><small>{{ __('common.Category')
                                }}</small></label>
                        <select {{ $action }} @if($action=='readonly' ) disabled @endif class="form-control"
                            id="type_item_id" name="type_item_id" title="{{ __('common.Category') }}">
                            <option value="">{{ __('common.Select') }}</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == old('type_item_id') ? 'selected':''
                                }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label class="text-muted mb-0 font-size-sm" for="name"><small>{{ __('common.Name')
                                }}</small></label>
                        <input {{ $action }} type="text" class="form-control {{ @$errors->has('name') ? " is-invalid"
                            : "" }}" id="name" name="name" placeholder="{{ __('common.Name') }}"
                            value="{{ $file->name }}">
                    </div>

                    <div class="form-group col-md-4">
                        <label class="text-muted mb-0 font-size-sm" for="name"><small>{{ __('common.Path')
                                }}</small></label>
                        <input {{ $action }} type="text" class="form-control {{ @$errors->has('path') ? " is-invalid"
                            : "" }}" id="path" name="path" placeholder="{{ __('common.Path') }}"
                            value="{{ $file->path }}">
                    </div>


                    <div class="form-group col-md-3">
                        <label class="text-muted mb-0 font-size-sm" for="active"><small>{{ __('common.Active')
                                }}</small></label>
                        <select {{ $action }} class="form-control" id="active" name="active">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="" {{ ($file->active == '' ? 'selected':'') }}>{{ __('common.Inactive') }}
                            </option>
                            <option value="1" {{ ($file->active == 1 ? 'selected':'') }}>{{ __('common.Active') }}
                            </option>
                        </select>
                    </div>

                    <div class="form-group col-md-12">
                        <label class="text-muted mb-0 font-size-sm" for="email"><small>{{ __('common.Description')
                                }}</small></label>
                        <textarea {{ $action }} rows="5" class="js-summernote {{ @$errors->has('description') ? "
                            is-invalid" : "" }}" id="description" name="description"
                            placeholder="{{ __('common.Description') }}">{{ $file->description }}</textarea>
                    </div>

                </div>
            </div>
            <div class="block-content block-content-full text-right bg-light">
                @if(Storage::disk('data')->exists(Auth()->user()->client->id . '/' . Auth()->user()->id . '/' .
                $file->path))
                <a href="{{action('FileController@download', $file->id)}}" class="btn btn-dark">
                    <i class="nav-main-link-icon si si-cloud-download mr-2"></i>{{ __('common.Download') }}
                </a>
                @endif
                <a class="btn btn-warning" href="{{action('FileController@index')}}">
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

    <form action="{{ action('FileController@store') }}" enctype="multipart/form-data" method="post">
        @csrf

        <input name="_method" type="hidden" value="POST">

        <!-- Block Tabs With Options Default Style -->
        <div class="block block-rounded block-themed block-fx-pop">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ __('common.New') }}
                </h3>
            </div>
            <div class="block-content pb-4">
                <h2 class="content-heading">{{ __('common.Edit') }}</h2>
                <div class="row">


                    <div class="col-xl-3">
                        <div class="form-group">
                            <label class="text-muted mb-0 font-size-sm"
                                for="import"><small>{{ __('common.ForImport') }}</small></label>
                            <select {{ $action }} class="form-control" id="import" name="import">
                                <option value="">{{ __('common.Select') }}</option>
                                <option value="0" {{ ($file->import == 0 ? 'selected':'') }}>{{ __('common.No') }}
                                </option>
                                <option value="1" {{ ($file->import == 1 ? 'selected':'') }}>{{ __('common.Yes') }}
                                </option>
                                <option value="2" {{ ($file->import == 2 ? 'selected':'') }}>
                                    {{ __('common.ImportDone') }}
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="text-muted mb-0 font-size-sm" for="valid_from"><small>{{
                                    __('common.DateRange') }}</small></label>
                            <div class="input-daterange input-group" data-date-format="dd.mm.yyyy" data-week-start="1"
                                data-autoclose="true" data-today-highlight="true">
                                <input {{ $action }} @if($action=='readonly' ) disabled @endif type="text"
                                    class="form-control text-left" id="valid_from" name="valid_from"
                                    data-date-default-date="now"
                                    placeholder="{{ __('common.Date') }} {{ __('common.From') }}" data-week-start="1"
                                    data-autoclose="true" data-today-highlight="true"
                                    value="{{ Carbon::parse($file->valid_from)->format('d.m.Y') }}">
                                <div class="input-group-prepend input-group-append">
                                    <span class="input-group-text">
                                        <i class="fa fa-fw fa-arrow-right"></i>
                                    </span>
                                </div>
                                <input {{ $action }} @if($action=='readonly' ) disabled @endif type="text"
                                    class="form-control text-left" id="valid_to" name="valid_to"
                                    placeholder="{{ __('common.Date') }} {{ __('common.To') }}" data-week-start="1"
                                    data-autoclose="true" data-today-highlight="true"
                                    value="{{ Carbon::parse($file->valid_to)->format('d.m.Y') }}">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="text-muted mb-0 font-size-sm" for="color"><small>{{ __('common.Color')
                                    }}</small></label>
                            <div class="js-colorpicker input-group" data-format="hex">
                                <input {{ $action }} type="text" class="form-control" id="color" name="color"
                                    value="{{ $file->color }}">
                                <div class="input-group-append">
                                    <span class="input-group-text colorpicker-input-addon">
                                        <i></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-12">
                        <div class="form-group">
                            <label class="text-muted mb-0 font-size-sm" for="email"><small>{{ __('common.Description')
                                    }}</small></label>
                            <textarea {{ $action }} rows="5" class="form-control {{ @$errors->has('description') ? "
                                is-invalid" : "" }}" id="description" name="description"
                                placeholder="{{ __('common.Description') }}">{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <div class="col-xl-12 overflow-hidden">
                        <!--
                        <form action="/index.php" class="dropzone" id="fileupload" style="width: 100%; height: 50px;">
                        @csrf
                        
                        <div class="fallback">
                            <input type="file" name="file" multiple class="w-100" />
                        </div>
                        </form>
                        -->
                        <div class="form-group">
                            <input type="file" id="file" name="file" class="w-100">
                        </div>
                    </div>
                </div>
            </div>
            <div class="block-content block-content-full text-right bg-light">
                @can('read files')
                @if(@$action != 'create')
                <a href="{{action('FileController@download', $file->id)}}" class="btn btn-dark">
                    <i class="nav-main-link-icon si si-cloud-download mr-2"></i>{{ __('common.Download') }}
                </a>
                @endif
                @endcan
                <a class="btn btn-warning" href="{{action('FileController@index')}}">
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

    @if (@$files)
    <!-- Table Sections (.js-table-sections class is initialized in Helpers.tableToolsSections()) -->
    <div class="block block-rounded block-themed block-fx-pop">

        <div class="block-header block-header-default bg-primary-darker">
            <h3 class="block-title">{{ __('common.Files') }} ({{ $files->count() }} / {{ $files->total() }})</h3>
            <div class="block-options">

                <div class="btn-group">
                    @can('read files')
                    <a class="btn btn-light btn-sm" href="javascript:void(0)" onclick="getFiles();">
                        <i class="si si-share-alt mr-1"></i> {{ __('common.Files') }} XHR</span>
                    </a>
                    <a class="btn btn-light btn-sm" href="{{action('ExportController@files')}}">
                        <i class="si si-share-alt mr-1"></i> {{ __('common.Excel') }}</span>
                    </a>
                    @endcan

                    @can('create files')
                    <a class="btn btn-primary btn-sm" href="{{action('FileController@create')}}">
                        <i class="si si-plus mr-1"></i> {{ __('common.File') }} <span class="text-lowercase">{{
                            __('common.Add') }}</span>
                    </a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="block-content">

            <div class="row mb-4">
                <div class="col-xl-10"></div>
                <div class="col-xl-2 text-right">
                    <form action="{{action('FileController@index')}}" method="post" class="d-inline-block">
                        <!-- Pagination -->
                        @include('include.pagination')
                        <!-- Pagination END -->
                    </form>
                </div>
            </div>
            <!--
            <form action="{{ action('FileController@downloadMany') }}" enctype="multipart/form-data" method="post">
                @csrf
                <input name="_method" type="hidden" value="POST">
                -->

            <table class="js-table-checkable table table-hover table-vcenter">
                <thead>
                    <tr>
                        <th style="width: 10px;" class="text-left">
                            <div class="custom-control custom-checkbox custom-control-primary d-inline-block">
                                <input type="checkbox" class="custom-control-input" id="check-all" name="check-all">
                                <label class="custom-control-label" for="check-all"></label>
                            </div>
                        </th>
                        <th>
                            @sortablelink('name', __('common.Filename'))
                        </th>
                        <th class="d-none d-sm-table-cell">
                            @sortablelink('import', __('common.ForImport'))
                        </th>
                        <th class="d-none d-sm-table-cell">
                            @sortablelink('user_id', __('common.Owner'))
                        </th>
                        <th class="d-none d-md-table-cell">
                            @sortablelink('updated_at', __('common.DateUpdated'))
                        </th>

                        <th class="text-right d-none d-sm-table-cell">
                            <button class="btn btn-dark btn-sm" type="submit">
                                <i class="si si-cloud-download"></i>
                            </button>

                        </th>
                    </tr>
                </thead>
                @csrf

                @foreach($files as $file)
                <tbody>
                    <tr>
                        <td class="text-left">
                            <div class="custom-control custom-checkbox custom-control-primary d-inline-block">
                                <input type="checkbox" class="custom-control-input" id="file_{{ $loop->count }}"
                                    name="files[]" value="{{ $file->id }}">
                                <label class="custom-control-label" for="file_{{ $loop->count }}"></label>
                            </div>
                        </td>
                        <td>
                            <div class="py-1">
                                <a href="{{action('FileController@download', $file->id)}}">{{ $file->name }} </a>
                            </div>
                        </td>
                        <th class="d-none d-sm-table-cell">
                            <div class="py-1">
                                @if($file->import == 1) {{ __('common.Yes') }}
                                @elseif($file->import == 2) {{ __('common.ImportDone') }}
                                @else {{ __('common.No') }}
                                @endif
                            </div>
                            </td>

                        <td class="d-none d-sm-table-cell">
                            <div class="py-1">
                                <a href="{{action('PersonController@show', $file->user->person->id)}}">
                                    {{ $file->user->person->first_name . ' ' . $file->user->person->last_name }}
                                </a>
                            </div>
                        </td>
                        <td class="d-none d-md-table-cell">
                            <div class="py-1">
                                {{ Carbon::parse($file->updated_at)->format('d.m.Y H:i')}}
                            </div>
                        </td>


                        <td class="d-none d-sm-table-cell text-right">
                            @can('read files')
                            <a href="{{action('FileController@download', $file->id)}}" class="btn btn-sm btn-dark">
                                <i class="nav-main-link-icon si si-cloud-download"></i>
                            </a>
                            @endcan

                            @can('update files')
                            <a href="{{action('FileController@edit', $file->id)}}" class="btn btn-sm btn-primary">
                                <i class="nav-main-link-icon si si-pencil"></i>
                            </a>
                            @endcan

                            @can('delete files')
                            <form action="{{action('FileController@destroy', $file->id)}}" method="post"
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

                @endforeach
            </table>
            <!--
            </form>
            -->
        </div>

        @if ($files->total() > $files->perPage())
        <div
            class="block-content block-content-full block-content-sm bg-body-light d-flex justify-content-center align-content-center">
            {!! $files->appends(\Request::except('page'))->render() !!}
        </div>
        @endif
    </div>
    @endif

    <!-- END Table Sections -->
</div>
<!-- END Page Content -->


@endsection