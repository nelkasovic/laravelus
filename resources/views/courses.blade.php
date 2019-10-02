@extends('layouts.app')

@section('content')

<!-- Page Content -->
<div class="content">

    <!-- If edit or create or password -->
    @if (@$course)

    {{-- We are here only if variable course is available --}}

    @if (@$action === 'edit' || @$action === 'readonly')

    <form action="{{action('CourseController@update', $id)}}" enctype="multipart/form-data" method="post">
        @csrf

        <input name="_method" type="hidden" value="PATCH">

        <!-- Block Tabs With Options Default Style -->
        <div
            class="block block-rounded block-fx-shadow block-themed @if($action == 'readonly') block-mode-hidden @endif">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ $course->number }} | {{ $course->name }} ({{ $course->alias }})</h3>
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

                    <div class="form-group col-xl-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="number"><small>{{ __('common.Number') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('number') ? "is-invalid" : "" }}" id="number"
                            name="number" placeholder="{{ __('common.Number') }}" value="{{ $course->number }}">
                    </div>

                    <div class="form-group col-xl-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="alias"><small>{{ __('common.Alias') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('alias') ? "is-invalid" : "" }}" id="alias"
                            name="alias" placeholder="{{ __('common.Alias') }}" value="{{ $course->alias }}">
                    </div>

                    <div class="form-group col-xl-4">
                        <label class="text-muted mb-0 font-size-sm"
                            for="name"><small>{{ __('common.Name') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('name') ? "is-invalid" : "" }}" id="name" name="name"
                            placeholder="{{ __('common.Name') }}" value="{{ $course->name }}">
                    </div>

                    <div class="form-group col-xl-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="active"><small>{{ __('common.Active') }}</small></label>
                        <select {{ $action }} class="form-control" id="active" name="active">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="0" {{ ($course->active == '' ? 'selected':'') }}>{{ __('common.Inactive') }}
                            </option>
                            <option value="1" {{ ($course->active == 1 ? 'selected':'') }}>{{ __('common.Active') }}
                            </option>
                        </select>
                    </div>

                    <div class="form-group col-xl-2">
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

                    <div class="form-group col-xl-12">
                        <label class="text-muted mb-0 font-size-sm"
                            for="description"><small>{{ __('common.Description') }}</small></label>
                        <textarea {{ $action }} rows="4"
                            class="form-control {{ @$errors->has('description') ? "is-invalid" : "" }}" id="description"
                            name="description"
                            placeholder="{{ __('common.Description') }}">{{ $course->description }}</textarea>
                    </div>
                </div>

            </div>
            <div class="block-content block-content-full text-right bg-light">

                <a class="btn btn-warning" href="{{action('CourseController@index')}}">
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

    @if(@$skills)
    @if (@$action == 'edit' || @$action == 'readonly')
    <div class="block block-rounded block-fx-shadow block-mode-hidden">
        <div class="block-header block-header-default">
            <h3 class="block-title">{{ __('common.Skills') }} </h3>
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
                        <th style="width: 30px; border-top: none;"></th>
                        <th style="border-top: none;">{{ __('common.Name') }}</th>
                        <th style="border-top: none;" class="text-right d-none d-xl-table-cell">
                            {{ __('common.DateUpdated') }}</th>
                        <th class="text-right" style="border-top: none;">
                            @can('create courses')
                            <a class="btn btn-dark" href="{{action('SkillController@create', $course->id)}}">
                                <i class="si si-plus"></i>
                            </a>
                            @endcan
                        </th>
                    </tr>
                </thead>
                @foreach($skills as $skill)
                <tbody class="js-table-sections-header">
                    <tr>
                        <td class="text-center">
                            <i class="fa fa-angle-right text-muted"></i>
                        </td>
                        <td>
                            <div class="py-1">
                                <a href="#">{{ $skill->name }}</a>
                            </div>
                        </td>
                        <td class="d-none d-xl-table-cell text-right">
                            <div class="py-1">
                                {{ Carbon::parse($skill->updated_at)->format('d.m.Y H:i')}}
                            </div>
                        </td>

                        <td class="d-none d-sm-table-cell text-right">
                            @can('update skills')
                            <a href="{{ action('SkillController@edit', [$skill->id]) }}" class="btn btn-primary btn-sm">
                                <i class="nav-main-link-icon si si-pencil"></i>
                            </a>
                            @endcan

                            @can('delete skills')
                            <form action="{{ action('SkillController@destroy', $skill['id']) }}" method="post"
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
                        <td colspan="15">
                            {{ $skill->description }}
                        </td>
                </tbody>
                @endforeach

            </table>
        </div>
    </div>
    @endif
    @endif

    @if(@$objectives)
    @if (@$action == 'edit' || @$action == 'readonly')
    <div class="block block-rounded block-fx-shadow block-mode-hidden">
        <div class="block-header block-header-default">
            <h3 class="block-title">{{ __('common.Objectives') }} </h3>
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
                        <th style="border-top: none;" class="text-right d-none d-sm-table-cell">
                            {{ __('common.DateUpdated') }}</th>
                        <th class="text-right" style="border-top: none;">


                            @can('create objectives')
                            <a class="btn btn-dark btn-sm" href="{{action('ObjectiveController@create', $course->id)}}">
                                <i class="si si-plus"></i>
                            </a>
                            @endcan
                        </th>
                    </tr>
                </thead>
                @foreach($objectives as $objective)
                <tbody class="js-table-sections-header">
                    <tr>
                        <td class="text-center">
                            <i class="fa fa-angle-right text-muted"></i>
                        </td>
                        <td>
                            <div class="py-1">
                                <a href="#">{{ $objective->name }}</a>
                            </div>
                        </td>
                        <td class="d-none d-sm-table-cell text-right">
                            <div class="py-1">
                                {{ Carbon::parse($objective->updated_at)->format('d.m.Y H:i')}}
                            </div>
                        </td>

                        <td class="d-none d-sm-table-cell text-right">
                            @can('update objectives')
                            <a href="{{ action('ObjectiveController@edit', [$objective->id]) }}"
                                class="btn btn-primary btn-sm">
                                <i class="nav-main-link-icon si si-pencil"></i>
                            </a>
                            @endcan

                            @can('delete objectives')
                            <form action="{{ action('ObjectiveController@destroy', $objective['id']) }}" method="post"
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
                        <td colspan="15">
                            {{ $objective->description }}
                        </td>
                </tbody>
                @endforeach

            </table>
        </div>
    </div>
    @endif
    @endif


    @if(@$events)
    @if (@$action == 'edit' || @$action == 'readonly')
    <div class="block block-rounded block-fx-shadow">
        <div class="block-header block-header-default">
            <h3 class="block-title">{{ __('common.Events') }} </h3>
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
                        <th style="border-top: none;" class="text-right d-none d-sm-table-cell">
                            {{ __('common.DateUpdated') }}</th>
                        <th class="text-right" style="border-top: none;">
                            @can('create events')
                            <a class="btn btn-dark btn-sm" href="{{action('EventController@create', $course->id)}}">
                                <i class="si si-plus"></i>
                            </a>
                            @endcan
                        </th>
                    </tr>
                </thead>
                @foreach($events as $event)
                <tbody class="js-table-sections-header">
                    <tr>
                        <td class="text-center">
                            <i class="fa fa-angle-right text-muted"></i>
                        </td>
                        <td>
                            <div class="py-1">
                                <a href="#">{{ $event->name }}</a>
                            </div>
                        </td>
                        <td class="d-none d-sm-table-cell text-right">
                            <div class="py-1">
                                {{ Carbon::parse($event->updated_at)->format('d.m.Y H:i')}}
                            </div>
                        </td>

                        <td class="d-none d-sm-table-cell text-right">
                            @can('update events')
                            <a href="{{ action('EventController@edit', [$event->id]) }}" class="btn btn-primary btn-sm">
                                <i class="nav-main-link-icon si si-pencil"></i>
                            </a>
                            @endcan

                            @can('delete events')
                            <form action="{{ action('EventController@destroy', $event['id']) }}" method="post"
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
                        <td colspan="15">
                            {{ $event->description }}
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

    <form action="{{action('CourseController@store')}}" enctype="multipart/form-data" method="post">
        @csrf
        <input name="_method" type="hidden" value="POST">

        <!-- Block Tabs With Options Default Style -->
        <div class="block block-rounded block-fx-shadow">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ __('common.Courses') }}</h3>
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

                    <div class="form-group col-md-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="number"><small>{{ __('common.Number') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('number') ? "is-invalid" : "" }}" id="number"
                            name="number" placeholder="{{ __('common.Number') }}" value="{{ old('number') }}">
                    </div>

                    <div class="form-group col-md-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="alias"><small>{{ __('common.Alias') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('alias') ? "is-invalid" : "" }}" id="alias"
                            name="alias" placeholder="{{ __('common.Alias') }}" value="{{ old('alias') }}">
                    </div>

                    <div class="form-group col-xl-4">
                        <label class="text-muted mb-0 font-size-sm"
                            for="name"><small>{{ __('common.Name') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('name') ? "is-invalid" : "" }}" id="name" name="name"
                            placeholder="{{ __('common.Name') }}" value="{{ old('name') }}">
                    </div>


                    <div class="form-group col-xl-2">
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

                    <div class="col-xl-2">
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


                    <div class="form-group col-xl-12">
                        <label class="text-muted mb-0 font-size-sm"
                            for="description"><small>{{ __('common.Description') }}</small></label>
                        <textarea {{ $action }} rows="4"
                            class="form-control {{ @$errors->has('description') ? "is-invalid" : "" }}" id="description"
                            name="description"
                            placeholder="{{ __('common.Description') }}">{{ old('description') }}</textarea>
                    </div>

                </div>

            </div>
            <div class="block-content block-content-full text-right bg-light">

                <a class="btn btn-warning" href="{{action('CourseController@index')}}">
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

    @if(@$action != 'readonly' && @$action != 'edit')
    <div class="block block-rounded block-fx-pop block-themed">

        <div class="block-header block-header-default bg-primary-darker">
            <h3 class="block-title">{{ __('common.Courses') }}</h3>
            <div class="block-options">
                <div class="btn-group">
                    @can('read courses')
                    <a class="btn btn-light btn-sm" href="javascript:void(0)" onclick="getCourses();">
                        <i class="si si-share-alt mr-1"></i> {{ __('common.Courses') }} XHR</span>
                    </a>
                    <a class="btn btn-light btn-sm" href="{{action('ExportController@courses')}}">
                        <i class="si si-share-alt mr-1"></i> {{ __('common.Excel') }}</span>
                    </a>
                    @endcan

                    @can('create courses')
                    <a class="btn btn-primary btn-sm" href="{{action('SkillController@create')}}">
                        <i class="si si-plus mr-1"></i> {{ __('common.Course') }} <span
                            class="text-lowercase">{{ __('common.Add') }}</span>
                    </a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="block-content">
            <form action="{{action('CourseController@index')}}" method="post">
                <div class="row mb-4">
                    <div class="col-xl-3">
                        <div class="form-group">
                            <select class="form-control" id="period_id" name="period_id"
                                title="{{ __('common.Period') }}" onchange="this.form.submit()">
                                <option value="">{{ __('common.Periods') }} </option>
                                @if(@$periods)
                                @foreach(@$periods as $period)
                                <option value="{{ $period->id }}"
                                    {{ (@$selected_period == $period->id ? 'selected':'') }}>{{ $period->name }}
                                </option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <select class="form-control" id="study_id" name="study_id" title="{{ __('common.Study') }}"
                                @if(@$selected_period && @$studies->count()) @else disabled @endif
                                onchange="this.form.submit()">
                                <option value="">{{ __('common.Studies') }} </option>
                                @if(@$studies->count() && @$selected_period)
                                @foreach($studies as $study)
                                <option value="{{ $study->id }}" {{ (@$selected_study == $study->id ? 'selected':'') }}>
                                    {{ $study->name }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <select class="form-control" id="person_id" name="person_id"
                                title="{{ __('common.Person') }}" @if(@$selected_period && @$selected_study &&
                                @$persons->count()) @else disabled @endif onchange="this.form.submit()">
                                <option value="">{{ __('common.Persons') }} </option>
                                @if(@$selected_period && @$selected_study)
                                @foreach($persons as $person)
                                <option value="{{ $person->id }}"
                                    {{ (@$selected_person == $person->id ? 'selected':'') }}>{{ $person->last_name }}
                                    {{ $person->first_name }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3 d-none d-md-block">
                        <!-- Pagination -->
                        @include('include.pagination')
                        <!-- Pagination END -->
                    </div>
                </div>
            </form>
            @if(@$courses)
            @if(@$courses->count())
            <table class="js-table-sections table table-hover table-vcenter">
                <thead>
                    <tr>
                        <th></th>
                        <th>
                            @sortablelink('number', __('common.Number'))
                        </th>
                        <th>
                            @sortablelink('name', __('common.Name'))
                        </th>

                        <th class="d-none d-xl-table-cell">
                            @sortablelink('updated_at', __('common.DateUpdated'))
                        </th>

                        <th class="text-right d-none d-sm-table-cell">

                        </th>
                    </tr>
                </thead>
                @csrf

                @foreach($courses as $course)
                <tbody class="js-table-sections-header">
                    <tr>
                        <td class="text-center">
                            <i class="fa fa-angle-right text-muted"></i>
                        </td>
                        <td>
                            <div class="py-1">
                                <a href="{{action('CourseController@show', $course->id)}}">{{ $course->number }} </a>
                            </div>
                        </td>

                        <td>
                            <div class="py-1">
                                <a href="{{action('CourseController@show', $course->id)}}">{{ $course->name }} </a>
                            </div>
                        </td>
                        <td class="d-none d-xl-table-cell">
                            <div class="py-1">
                                {{ Carbon::parse($course->updated_at)->format('d.m.Y H:i')}}
                            </div>
                        </td>


                        <td class="d-none d-sm-table-cell text-right">
                            {{-- Check if the person is skilled for a course and show a badge, or not --}}
                            @if(in_array($course->id, $my_courses))
                            <form action="{{action('CourseController@show', $course->id)}}" method="post"
                                class="d-inline">
                                @csrf
                                <input name="_method" type="hidden" value="GET">

                                <button type="submit" class="btn btn-sm btn-success"
                                    title="{{ __('common.QualifiedDescription') }}">
                                    <i class="nav-main-link-icon si si-badge"></i>
                                </button>
                            </form>
                            @else
                            <form action="{{action('CourseController@show', $course->id)}}" method="post"
                                class="d-inline">
                                @csrf
                                <input name="_method" type="hidden" value="GET">

                                <button type="submit" class="btn btn-sm btn-light">
                                    <i class="nav-main-link-icon si si-user-unfollow"></i>
                                </button>
                            </form>
                            @endif
                            @can('update events')
                            <a href="{{action('CourseController@edit', $course->id)}}" class="btn btn-sm btn-primary">
                                <i class="nav-main-link-icon si si-pencil"></i>
                            </a>
                            @endcan

                            @can('delete courses')
                            <form action="{{action('CourseController@destroy', $course->id)}}" method="post"
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
                        <td colspan="4">
                            <p>{{ $course->description }}</p>
                            <p><a href="{{ $course->url }}" target="_blank">{{ $course->url }}</a></p>
                            <em class="text-muted">{{ Carbon::parse($course->updated_at)->format('d.m.Y H:i')}}</em>
                        </td>
                    </tr>
                </tbody>
                @endforeach
            </table>
            @endif
            @endif
        </div>
        @if(@$courses)
        @if ($courses->total() > $courses->perPage())
        <div
            class="block-content block-content-full block-content-sm bg-body-light d-flex justify-content-center align-content-center">
            {!! $courses->appends(\Request::except('page'))->render() !!}
        </div>
        @endif
        @endif
    </div>
    @endif

    <!-- END Table Sections -->
</div>
<!-- END Page Content -->


@endsection