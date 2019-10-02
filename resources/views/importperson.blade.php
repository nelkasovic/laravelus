@extends('layouts.app')

@section('content')


<!-- Page Content -->
<div class="content">


    @if(@$action == 'create')
    @if(@$module)
    <form action="{{action('ImportController@start')}}" data-module="{{ @$module }}" enctype="multipart/form-data"
        method="post">
        @else
        <form action="{{action('ImportController@persons')}}" data-module="{{ @$module }}" enctype="multipart/form-data"
            method="post">
            @endif
            @csrf
            <input name="_method" type="hidden" value="GET">

            <!-- Block Tabs With Options Default Style -->
            <div class="block block-rounded block-fx-pop block-themed">
                <div class="block-header block-header-default">
                    <h3 class="block-title">{{ __('common.Import') }}</h3>
                </div>
                <div class="block-content pb-4">
                    <h2 class="content-heading">{{ __('common.New') }}</h2>
                    <div class="row">

                        <div class="form-group col-xl-4">
                            <label class="text-muted mb-0 font-size-sm"
                                for="module"><small>{{ __('common.Module') }}</small></label>
                            <select class="form-control" id="module" name="module" onchange="this.form.submit()">
                                <option value="">{{ __('common.Select') }}</option>
                                <option value="Person" @if(@$module=='Person' ) selected @endif>
                                    {{ __('common.Persons') }}</option>
                            </select>
                        </div>


                        <div class="form-group col-xl-4">
                            <label class="text-muted mb-0 font-size-sm"
                                for="file_id"><small>{{ __('common.File') }}</small></label>
                            <select class="form-control" id="file_id" name="file_id" @if(@$module) @else disabled
                                @endif>
                                <option value="">{{ __('common.File') }}</option>
                                @if(@$files)
                                @foreach($files as $file)
                                <option value="{{ $file->id }}" @if(@$file_id==$file->id) selected
                                    @endif>{{ $file->name }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="form-group col-xl-4">
                            <label class="text-muted mb-0 font-size-sm"
                                for="name"><small>{{ __('common.Name') }}</small></label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="{{ __('common.Name') }}" value="{{ @$name }}" @if(@$module) @else disabled
                                @endif>
                        </div>
                        @if(@$studies)
                        @if(@$studies->count())
                        <div class="col-xl-4">
                            <div class="form-group">
                                <label class="text-muted mb-0 font-size-sm"
                                    for="study_id"><small>{{ __('common.Study') }}</small></label>
                                <select class="form-control" id="study_id" name="study_id" @if(@$module) @else disabled
                                    @endif>
                                    <option value="">{{ __('common.Study') }}</option>
                                    @foreach($studies as $study)
                                    <option value="{{ $study->id }}" @if(@$study_id==$study->id) selected
                                        @endif>{{ $study->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endif
                        @endif
                        <div class="form-group col-xl-4">
                            <label class="text-muted mb-0 font-size-sm"
                                for="start"><small>{{ __('common.StartRow') }}</small></label>
                            <input type="text" class="form-control" id="start" name="start"
                                placeholder="{{ __('common.StartRow') }}" value="{{ @$start }}" @if(@$module) @else
                                disabled @endif>
                        </div>
                        <div class="form-group col-xl-4">
                            <label class="text-muted mb-0 font-size-sm"
                                for="count"><small>{{ __('common.RowsToImport') }}</small></label>
                            <input type="text" class="form-control" id="count" name="count"
                                placeholder="{{ __('common.RowsToImport') }}" value="{{ @$count }}" @if(@$module) @else
                                disabled @endif>
                        </div>
                    </div>
                </div>
                <div class="block-content block-content-full text-right bg-light">
                    <div class="row">
                        <div class="col-xl-8"></div>
                        <div class="col-xl-2">
                            <a class="btn btn-warning btn-block" href="{{action('ImportController@index')}}">
                                <i class="si si-action-undo mr-1"></i>
                                {{ __('common.Close') }}
                            </a>
                        </div>
                        <div class="col-xl-2">
                            <button type="submit" class="btn btn-primary btn-block" @if(@$module && @$files->count())
                                @else disabled @endif>
                                <i class="si si-fire mr-1"></i>
                                {{ __('common.Import') }}
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </form>
        @endif
        @if (@$imports)
        <!-- Table Sections (.js-table-sections class is initialized in Helpers.tableToolsSections()) -->
        <div class="block block-rounded block-fx-pop block-themed">

            <div class="block-header block-header-default bg-primary-darker">
                <h3 class="block-title">{{ __('common.Import') }}</h3>
                <div class="block-options">
                    <div class="btn-group">
                        @can('create imports')
                        <a class="btn btn-primary btn-sm" href="{{action('ImportController@persons')}}">
                            <i class="si si-plus mr-1"></i> {{ __('common.Persons') }} <span
                                class="text-lowercase">{{ __('common.Import') }}</span>
                        </a>
                        @endcan
                    </div>
                </div>
            </div>

            <div class="block-content">
                <div class="row mb-4">
                    <div class="col-xl-10"></div>
                    <div class="col-xl-2">
                        <form action="{{action('ImportController@index')}}" method="post">
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

                            <th class="d-none d-xl-table-cell">
                                @sortablelink('file', __('common.File'))
                            </th>

                            <th class="d-none d-xl-table-cell">
                                @sortablelink('records', __('common.Records'))
                            </th>

                            <th class="d-none d-xl-table-cell">
                                @sortablelink('component_id', __('common.Component'))
                            </th>

                            <th class="d-none d-xl-table-cell">
                                @sortablelink('updated_at', __('common.Updated'))
                            </th>

                            <th class="text-right d-none d-sm-table-cell">

                            </th>
                        </tr>
                    </thead>
                    @csrf

                    @foreach($imports as $import)
                    <tbody class="js-table-sections-header">
                        <tr>
                            <td class="text-center">
                                <i class="fa fa-angle-right text-muted"></i>
                            </td>

                            <td class="d-none d-xl-table-cell">
                                <div class="py-1">
                                    {{ $import->name }}
                                </div>
                            </td>
                            <td class="d-none d-xl-table-cell">
                                <div class="py-1">
                                    {{ $import->file }}
                                </div>
                            </td>
                            <td class="d-none d-xl-table-cell">
                                <div class="py-1">
                                    {{ $import->records }}
                                </div>
                            </td>
                            <td class="d-none d-xl-table-cell">
                                <div class="py-1">
                                    {{ App\Component::findOrFail($import->component_id)->name }}
                                </div>
                            </td>

                            <td class="d-none d-xl-table-cell">
                                <div class="py-1">
                                    {{ Carbon::parse($import->updated_at)->format('d.m.Y H:i')}}
                                </div>
                            </td>

                            <td class="d-none d-sm-table-cell text-right">
                                @can('delete imports')
                                <form action="{{action('ImportController@destroy', $import->id)}}" method="post"
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
                                <p>{{ $import->description }}</p>
                                <ul>
                                    @foreach ($import->persons as $person)
                                    <li>{{ $person->last_name }} {{ $person->first_name }}</li>
                                    @endforeach
                                </ul>

                                <em class="text-muted">{{ __('common.DateUpdated') }}:
                                    {{ Carbon::parse($import->created_at)->format('d.m.Y H:i')}}</em>
                            </td>


                        </tr>

                    </tbody>
                    @endforeach
                </table>

            </div>

            @if ($imports->total() > $imports->perPage())
            <div
                class="block-content block-content-full block-content-sm bg-body-light d-flex justify-content-center align-content-center">
                {!! $imports->appends(\Request::except('page'))->render() !!}
            </div>
            @endif
        </div>
        @endif

</div>
<!-- END Page Content -->


@endsection