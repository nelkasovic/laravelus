@extends('layouts.app')

@section('content')

<!-- Page Content -->
<div class="content">

    <!-- If edit or create -->
    @if (@$group)

    {{-- We are here only if variable is available --}}

    @if (@$action === 'edit' || @$action === 'readonly')

    <form action="{{action('GroupController@update', $id)}}" enctype="multipart/form-data" method="post">
        @csrf

        <input name="_method" type="hidden" value="PATCH">

        <!-- Block Tabs With Options Default Style -->
        <div class="block block-rounded block-themed block-fx-pop">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ $group->name }}</h3>
            </div>
            <div class="block-content pb-4">
                <div class="row">

                    <div class="form-group col-xl-6">
                        <label class="text-muted mb-0 font-size-sm"
                            for="study_id"><small>{{ __('common.Study') }}</small></label>
                        <select {{ $action }} class="form-control" id="study_id" name="study_id"
                            title="{{ __('common.Study') }}">
                            <option value="">{{ __('common.Select') }}</option>
                            @foreach(@$studies as $study)
                            <option value="{{ $study->id }}" @if($study->id == $group->study_id) selected
                                @endif>{{ $study->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-xl-6">
                        <label class="text-muted mb-0 font-size-sm"
                            for="alias"><small>{{ __('common.Alias') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('alias') ? "is-invalid" : "" }}" id="alias"
                            name="alias" placeholder="{{ __('common.Alias') }}" value="{{ $group->alias }}">
                    </div>

                    <div class="form-group col-xl-4">
                        <label class="text-muted mb-0 font-size-sm"
                            for="name"><small>{{ __('common.Name') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('name') ? "is-invalid" : "" }}" id="name" name="name"
                            placeholder="{{ __('common.Name') }}" value="{{ $group->name }}">
                    </div>


                    <div class="form-group col-xl-4">
                        <label class="text-muted mb-0 font-size-sm"
                            for="active"><small>{{ __('common.Active') }}</small></label>
                        <select {{ $action }} class="form-control" id="active" name="active">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="1" {{ $group->active == 1 ? 'selected':'' }}>{{ __('common.Active') }}
                            </option>
                            <option value="0" {{ $group->active != 1 ? 'selected':'' }}>{{ __('common.Inactive') }}
                            </option>
                        </select>
                    </div>

                    <div class="form-group col-xl-4">
                        <label class="text-muted mb-0 font-size-sm"
                            for="color"><small>{{ __('common.Color') }}</small></label>
                        <div class="js-colorpicker input-group" data-format="hex">
                            <input {{ $action }} type="text" class="form-control" id="color" name="color"
                                value="{{ $group->color }}">
                            <div class="input-group-append">
                                <span class="input-group-text colorpicker-input-addon">
                                    <i></i>
                                </span>
                            </div>
                        </div>
                    </div>


                    <div class="form-group col-xl-12">
                        <label class="text-muted mb-0 font-size-sm"
                            for="description"><small>{{ __('common.Description') }}</small></label>
                        <textarea rows="5" {{ $action }}
                            class="form-control {{ @$errors->has('description') ? "is-invalid" : "" }}" id="description"
                            name="description"
                            placeholder="{{ __('common.Description') }}">{{ $group->description }}</textarea>
                    </div>
                </div>
            </div>
            <div class="block-content block-content-full text-right bg-light">

                <a class="btn btn-warning" href="{{action('GroupController@index')}}">
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
    <form action="{{action('GroupController@store')}}" enctype="multipart/form-data" method="post">
        @csrf
        <input name="_method" type="hidden" value="POST">

        <div class="block block-rounded block-themed block-fx-pop">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ __('common.Group') }}
                    @if(@$current_study)
                    | {{ @$current_study->groups->count() }} {{ __('common.Groups') }} <span
                        class="text-lowercase">{{ __('common.Created') }} </span>
                    @endif
                </h3>

            </div>
            <div class="block-content pb-4">
                <div class="row">
                    <div class="form-group col-xl-4">
                        <label class="text-muted mb-0 font-size-sm"
                            for="study_id"><small>{{ __('common.Study') }}</small></label>
                        <select {{ $action }} class="form-control" id="study_id" name="study_id"
                            title="{{ __('common.Study') }}">
                            <option value="">{{ __('common.Select') }}</option>
                            @foreach(@$studies as $study)
                            <option value="{{ $study->id }}" @if($study->id == old('study_id') || $study->id ==
                                @$study_id) selected @endif>{{ $study->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-xl-4">
                        <label class="text-muted mb-0 font-size-sm"
                            for="alias"><small>{{ __('common.Alias') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('alias') ? "is-invalid" : "" }}" id="alias"
                            name="alias" placeholder="{{ __('common.Alias') }}" value="{{ @$name }}">
                    </div>

                    <div class="form-group col-xl-4">
                        <label class="text-muted mb-0 font-size-sm"
                            for="name"><small>{{ __('common.Name') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('name') ? "is-invalid" : "" }}" id="name" name="name"
                            placeholder="{{ __('common.Name') }}" value="{{ @$name }}">
                    </div>

                    <div class="form-group col-xl-4">
                        <label class="text-muted mb-0 font-size-sm"
                            for="count"><small>{{ __('common.Count') }}</small></label>
                        <input {{ $action }} type="number" steps="1"
                            class="form-control {{ @$errors->has('count') ? "is-invalid" : "" }}" id="count"
                            name="count" placeholder="{{ __('common.Count') }}" value="{{ @$count }}"
                            data-count="{{ @$count }}">
                    </div>

                    <div class="form-group col-xl-4">
                        <label class="text-muted mb-0 font-size-sm"
                            for="active"><small>{{ __('common.Active') }}</small></label>
                        <select {{ $action }} class="form-control" id="active" name="active">
                            <option value="" {{ old('active') == '' ? 'selected':'' }}>{{ __('common.Select') }}
                            </option>
                            <option value="1" {{ old('active') == 1 ? 'selected':'' }}>{{ __('common.Active') }}
                            </option>
                            <option value="0" {{ old('active') == 0 ? 'selected':'' }}>{{ __('common.Inactive') }}
                            </option>
                        </select>
                    </div>

                    <div class="form-group col-xl-4">
                        <label class="text-muted mb-0 font-size-sm"
                            for="color"><small>{{ __('common.Color') }}</small></label>
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


                    <div class="form-group col-md-12">
                        <label class="text-muted mb-0 font-size-sm"
                            for="description"><small>{{ __('common.Description') }}</small></label>
                        <textarea rows="5" {{ $action }}
                            class="form-control {{ @$errors->has('description') ? "is-invalid" : "" }}" id="description"
                            name="description"
                            placeholder="{{ __('common.Description') }}">{{ old('description') }}</textarea>
                    </div>
                </div>
            </div>
            <div class="block-content block-content-full text-right bg-light">
                <a class="btn btn-warning" href="{{action('GroupController@index')}}">
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

    @if(@$current_study)
    @if (@$current_study->groups->count())
    <!-- Table Sections (.js-table-sections class is initialized in Helpers.tableToolsSections()) -->
    <div class="block block-rounded block-fx-pop">

        <div class="block-header block-header-default">
            <h3 class="block-title">{{ __('common.Groups') }}</h3>
        </div>

        <div class="block-content">

            <table class="js-table-sections table table-hover table-vcenter">
                <thead>
                    <tr>
                        <th style="border-top: none;"></th>
                        <th style="border-top: none;">
                            @sortablelink('name', __('common.Name'))
                        </th>

                        <th style="border-top: none;" class="d-none d-lg-table-cell">
                            @sortablelink('alias', __('common.Alias'))
                        </th>

                        <th style="border-top: none;" class="d-none d-xl-table-cell">
                            @sortablelink('updated_at', __('common.Updated'))
                        </th>

                    </tr>
                </thead>
                @csrf

                @foreach($current_study->groups as $group)
                <tbody class="js-table-sections-header">
                    <tr>
                        <td class="text-center">
                            <i class="fa fa-angle-right text-muted"></i>
                        </td>
                        <td>
                            <div class="py-1">
                                <a href="{{action('GroupController@show', $group->id)}}">{{ $group->name }} </a>
                            </div>
                        </td>
                        <td class="d-none d-lg-table-cell">
                            <div class="py-1">
                                {{ $group->alias }}
                            </div>
                        </td>


                        <td class="d-none d-xl-table-cell">
                            <div class="py-1">
                                {{ Carbon::parse($group->updated_at)->format('d.m.Y H:i')}}
                            </div>
                        </td>

                        <td class="d-none d-sm-table-cell text-right">
                            <a href="{{action('GroupController@edit', $group->id)}}" class="btn btn-primary btn-sm">
                                <i class="nav-main-link-icon si si-pencil"></i>
                            </a>

                            <form action="{{action('GroupController@destroy', $group->id)}}" method="post"
                                class="d-inline">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">

                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="nav-main-link-icon si si-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                </tbody>
                <tbody class="font-size-sm">
                    <tr>
                        <td class="text-center"></td>
                        <td colspan="7">
                            <p>{{ $group->description }}</p>

                            <em class="text-muted">{{ __('common.DateUpdated') }}:
                                {{ Carbon::parse($group->created_at)->format('d.m.Y H:i')}}</em>
                        </td>


                    </tr>

                </tbody>
                @endforeach
            </table>

        </div>


    </div>
    @endif
    @endif

    @endif
    @endif
    @if(@$action != 'readonly' && @$action != 'edit' && @$action != 'create')
    <div class="block block-rounded block-fx-pop block-themed">

        <div class="block-header block-header-default bg-primary-darker">
            <h3 class="block-title">{{ __('common.Groups') }}</h3>
            <div class="block-options">
                <div class="btn-group">
                    @can('read groups')
                    <a class="btn btn-light btn-sm" href="javascript:void(0)" onclick="getGroups();">
                        <i class="si si-share-alt mr-1"></i> {{ __('common.Groups') }} XHR</span>
                    </a>
                    <a class="btn btn-light btn-sm" href="{{action('ExportController@groups')}}">
                        <i class="si si-share-alt mr-1"></i> {{ __('common.Excel') }}</span>
                    </a>
                    @endcan
                    @can('create groups')
                    <a class="btn btn-primary btn-sm" href="{{action('GroupController@create')}}">
                        <i class="si si-users mr-1"></i> {{ __('common.Group') }} <span
                            class="text-lowercase">{{ __('common.Add') }}</span>
                    </a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="block-content">

            <form action="{{action('GroupController@index')}}" method="post">
                @csrf
                <div class="row mb-4">
                    <div class="col-xl-4">
                        <div class="form-group">
                            <select class="form-control" id="period_id" name="period_id"
                                title="{{ __('common.Period') }}" onchange="this.form.submit()">
                                <option value="">{{ __('common.Periods') }} </option>
                                @if($periods)
                                @foreach($periods as $period)
                                <option value="{{ $period->id }}" {{ (@$period_id == $period->id ? 'selected':'') }}>
                                    {{ $period->name }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-4 d-none d-xl-block">
                        <div class="form-group">
                            <select class="form-control" id="study_id" name="study_id" title="{{ __('common.Study') }}"
                                @if(@!$period_id || !$studies->count()) disabled @endif onchange="this.form.submit()">
                                <option value="">{{ __('common.Select') }}</option>
                                @if(@$studies && @$period_id)
                                @foreach($studies as $study)
                                <option value="{{ $study->id }}" {{ (@$study_id == $study->id ? 'selected':'') }}>
                                    {{ $study->number }} {{ $study->name }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <!--
                {{--
                <div class="col-xl-3 d-none d-xl-block">
                    <select class="form-control" id="course_id" name="course_id" title="{{ __('common.Course') }}"  @if(@!$study_id || !$courses->count()) disabled @endif onchange="this.form.submit()">
                        <option value="">{{ __('common.Select') }}</option>
                        @if(@$courses && @$study_id)
                        @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ (@$course_id == $course->id ? 'selected':'') }}>{{ $course->number }} {{ $course->name }}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                --}}
                -->
                    <div class="col-xl-3"></div>
                    <div class="col-xl-1 text-right">

                        <!-- Laravel CONTENT -->
                        @include('include.pagination')
                        <!-- Laravel CONTENT END -->

                    </div>
                </div>
            </form>
            @if(@$groups)
            @if (@$groups->count())
            <table class="js-table-sections table table-hover table-vcenter">
                <thead>
                    <tr>
                        <th></th>
                        <th>
                            @sortablelink('name', __('common.Name'))
                        </th>


                        <th class="d-none d-lg-table-cell">
                            @sortablelink('alias', __('common.Alias'))
                        </th>


                        <th class="d-none d-lg-table-cell text-center">
                            {{ __('common.Persons') }}
                        </th>

                        <th class="d-none d-xl-table-cell">
                            @sortablelink('updated_at', __('common.Updated'))
                        </th>
                        <th class="text-right d-none d-sm-table-cell">

                        </th>
                    </tr>
                </thead>
                @csrf

                @foreach($groups as $group)
                <tbody class="js-table-sections-header">
                    <tr>
                        <td class="text-center">
                            <i class="fa fa-angle-right text-muted"></i>
                        </td>
                        <td>
                            <div class="py-1">
                                <a href="{{action('GroupController@show', $group->id)}}">{{ $group->name }} </a>
                            </div>
                        </td>


                        <td class="d-none d-lg-table-cell">
                            <div class="py-1">
                                {{ $group->alias }}
                            </div>
                        </td>

                        <td class="d-none d-lg-table-cell text-center">
                            <div class="py-1">
                                {{ $group->persons->count() }}
                            </div>
                        </td>

                        <td class="d-none d-xl-table-cell">
                            <div class="py-1">
                                {{ Carbon::parse($group->updated_at)->format('d.m.Y H:i')}}
                            </div>
                        </td>

                        <td class="d-none d-sm-table-cell text-right">
                            <a href="{{action('GroupPersonController@index', [$group->id, $group->study_id])}}"
                                class="btn btn-info btn-sm">
                                <i class="nav-main-link-icon si si-users mr-2"></i>{{ $group->persons->count() }}
                            </a>

                            @can('edit groups')
                            <a href="{{action('GroupController@edit', $group->id)}}" class="btn btn-primary btn-sm">
                                <i class="nav-main-link-icon si si-pencil"></i>
                            </a>
                            @endcan

                            @can('delete groups')
                            <form action="{{action('GroupController@destroy', $group->id)}}" method="post"
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
                        <td colspan="7">
                            <p>{{ $group->description }}</p>

                            <em class="text-muted">{{ __('common.DateUpdated') }}:
                                {{ Carbon::parse($group->created_at)->format('d.m.Y H:i')}}</em>
                        </td>


                    </tr>

                </tbody>
                @endforeach
            </table>
            @endif
            @endif
        </div>

        @if (@$groups)
        @if ($groups->total() > $groups->perPage())
        <div
            class="block-content block-content-full block-content-sm bg-body-light d-flex justify-content-center align-content-center">
            {!! $groups->appends(\Request::except('page'))->render() !!}
        </div>
        @endif
        @endif
    </div>
    @endif


    <!-- END Table Sections -->
</div>
<!-- END Page Content -->


@endsection