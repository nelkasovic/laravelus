@extends('layouts.app')

@section('content')

<!-- Page Content -->
<div class="content">

    <!-- If edit or create -->
    @if (@$study)

    {{-- We are here only if variable is available --}}

    @if (@$action === 'edit' || @$action === 'readonly')

    @if (@$action === 'edit')
    <form action="{{action('StudyController@update', $id)}}" enctype="multipart/form-data" method="post">
        @csrf

        <input name="_method" type="hidden" value="PATCH">
        @endif
        <!-- Block Tabs With Options Default Style -->
        <div class="block block-rounded block-themed block-fx-pop @if(@$action != 'edit') block-mode-hidden @endif">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ $study->name }} | {{ $study->groups->count() }} {{ __('common.Groups') }} |
                    {{ $study->students->count() }} {{ __('common.Persons') }} |
                    {{ $study->students()->doesNtHave('groups')->count() }} {{ __('common.Persons') }}
                    {{ __('common.unassigned') }} </h3>

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

                    <div class="col-xl-3">

                        <label class="text-muted mb-0 font-size-sm"
                            for="period_id"><small>{{ __('common.Period') }}</small></label>
                        <select class="form-control" id="period_id" name="period_id" title="{{ __('common.Period') }}">
                            <option value="">{{ __('common.Period') }} {{ __('common.select') }}</option>
                            @foreach($periods as $period)
                            <option value="{{ $period->id }}" {{ (@$study->period_id == $period->id ? 'selected':'') }}>
                                {{ $period->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="name"><small>{{ __('common.Name') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('name') ? "is-invalid" : "" }}" id="name" name="name"
                            placeholder="{{ __('common.Name') }}" value="{{ $study->name }}">
                    </div>

                    <div class="form-group col-xl-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="alias"><small>{{ __('common.Alias') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('alias') ? "is-invalid" : "" }}" id="alias"
                            name="alias" placeholder="{{ __('common.Alias') }}" value="{{ $study->alias }}">
                    </div>

                    <div class="form-group col-xl-2">
                        <label class="text-muted mb-0 font-size-sm" for="group_size"><small>{{ __('common.GroupSize') }}
                            </small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('group_size') ? "is-invalid" : "" }}" id="group_size"
                            name="group_size" placeholder="{{ __('common.GroupSize') }}"
                            value="{{ $study->group_size }}">
                    </div>


                    <div class="form-group col-xl-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="groups_planned"><small>{{ __('common.Groups') }}
                                ({{ __('common.planned') }})</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('groups_planned') ? "is-invalid" : "" }}"
                            id="groups_planned" name="groups_planned" placeholder="{{ __('common.Groups') }}"
                            value="{{ $study->groups_planned }}">
                    </div>


                    <div class="form-group col-xl-4">
                        <label class="text-muted mb-0 font-size-sm"
                            for="active"><small>{{ __('common.Active') }}</small></label>
                        <select {{ $action }} class="form-control" id="active" name="active">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="1" {{ $study->active == '1' ? 'selected':'' }}>{{ __('common.Active') }}
                            </option>
                            <option value="0" {{ $study->active == '0' ? 'selected':'' }}>{{ __('common.Inactive') }}
                            </option>
                        </select>
                    </div>

                    <div class="form-group col-xl-4">
                        <label class="text-muted mb-0 font-size-sm"
                            for="color"><small>{{ __('common.Color') }}</small></label>
                        <div class="js-colorpicker input-group" data-format="hex">
                            <input {{ $action }} type="text" class="form-control" id="color" name="color"
                                value="{{ $study->color }}">
                            <div class="input-group-append">
                                <span class="input-group-text colorpicker-input-addon">
                                    <i></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-xl-4">
                        <div class="form-group">
                            <label class="text-muted mb-0 font-size-sm"
                                for="start_date"><small>{{ __('common.DateRange') }}</small></label>
                            <div class="input-daterange input-group" data-date-format="dd.mm.yyyy" data-week-start="1"
                                data-autoclose="true" data-today-highlight="true">
                                <input {{ $action }} type="text" class="form-control text-left" id="start_date"
                                    name="start_date" data-date-default-date="now"
                                    placeholder="{{ __('common.Date') }} {{ __('common.From') }}" data-week-start="1"
                                    data-autoclose="true" data-today-highlight="true"
                                    value="{{ (old('start_date')) ? old('start_date') : Carbon::now()->format('d.m.Y') }}">
                                <div class="input-group-prepend input-group-append">
                                    <span class="input-group-text">
                                        <i class="fa fa-fw fa-arrow-right"></i>
                                    </span>
                                </div>
                                <input {{ $action }} type="text" class="form-control text-left" id="end_date"
                                    name="end_date" placeholder="{{ __('common.Date') }} {{ __('common.To') }}"
                                    data-week-start="1" data-autoclose="true" data-today-highlight="true"
                                    value="{{ (old('end_date')) ? old('end_date') : Carbon::now()->addWeeks(5)->format('d.m.Y') }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-xl-12">
                        <label class="text-muted mb-0 font-size-sm"
                            for="description"><small>{{ __('common.Description') }}</small></label>
                        <textarea {{ $action }} rows="5"
                            class="form-control {{ @$errors->has('description') ? "is-invalid" : "" }}" id="description"
                            name="description"
                            placeholder="{{ __('common.Description') }}">{{ $study->description }}</textarea>
                    </div>
                </div>

            </div>
            <div class="block-content block-content-full text-right bg-light">

                <div class="row">
                    <div class="col-xl-6 text-left">
                        @if($action == 'readonly')
                        <form action="{{action('StudyController@weekdays', $study->id)}}" enctype="multipart/form-data"
                            method="post" class="d-inline">
                            @csrf

                            <input name="_method" type="hidden" value="PATCH">
                            <a>
                                <button type="submit" name="weekday[monday]" value="{{ $study->monday }}"
                                    class="btn @if($study->monday == 0) btn-light @elseif($study->monday == 1) btn-warning @elseif($study->monday == 2) btn-info @else btn-success @endif" 
                                    title="{{ __('common.WeekdayAllowed') }}">
                                    {{ __('common.Monday') }}
                                </button>
                                <button type="submit" name="weekday[tuesday]" value="{{ $study->tuesday }}"
                                    class="btn @if($study->tuesday == 0) btn-light @elseif($study->tuesday == 1) btn-warning @elseif($study->tuesday == 2) btn-info @else btn-success @endif"
                                    title="{{ __('common.WeekdayAllowed') }}">
                                    {{ __('common.Tuesday') }}
                                </button>
                                <button type="submit" name="weekday[wednesday]" value="{{ $study->wednesday }}"
                                    class="btn @if($study->wednesday == 0) btn-light @elseif($study->wednesday == 1) btn-warning @elseif($study->wednesday == 2) btn-info @else btn-success @endif"
                                    title="{{ __('common.WeekdayAllowed') }}">
                                    {{ __('common.Wednesday') }}
                                </button>
                                <button type="submit" name="weekday[thursday]" value="{{ $study->thursday }}"
                                    class="btn @if($study->thursday == 0) btn-light @elseif($study->thursday == 1) btn-warning @elseif($study->thursday == 2) btn-info @else btn-success @endif"
                                    title="{{ __('common.WeekdayAllowed') }}">
                                    {{ __('common.Thursday') }}
                                </button>
                                <button type="submit" name="weekday[friday]" value="{{ $study->friday }}"
                                    class="btn @if($study->friday == 0) btn-light @elseif($study->friday == 1) btn-warning @elseif($study->friday == 2) btn-info @else btn-success @endif"
                                    title="{{ __('common.WeekdayAllowed') }}">
                                    {{ __('common.Friday') }}
                                </button>
                                <button type="submit" name="weekday[saturday]" value="{{ $study->saturday }}"
                                    class="btn @if($study->saturday == 0) btn-light @elseif($study->saturday == 1) btn-warning @elseif($study->saturday == 2) btn-info @else btn-success @endif"
                                    title="{{ __('common.WeekdayAllowed') }}">
                                    {{ __('common.Saturday') }}
                                </button>
                                <button type="submit" name="weekday[sunday]" value="{{ $study->sunday }}"
                                    class="btn @if($study->sunday == 0) btn-light @elseif($study->sunday == 1) btn-warning @elseif($study->sunday == 2) btn-info @else btn-success @endif"
                                    title="{{ __('common.WeekdayAllowed') }}">
                                    {{ __('common.Sunday') }}
                                </button>
                            </a>
                        </form>
                        <a class="btn btn-warning" href="{{action('StudyController@weekdays', [$study->id, 1])}}"
                            title="{{ __('common.WeekdaysReset') }}">
                            <i class="icon si si-energy"></i>
                        </a>
                        @endif
                    </div>

                    <div class="col-xl-6">
                        @if($study->groups_planned > 0 && $study->courses->count() > 0)
                        <a class="btn btn-primary" href="{{action('StudyController@groups', $study->id)}}">
                            <i class="si si-users mr-1"></i>
                            {{ __('common.Groups') }} {{ __('common.create') }}
                        </a>
                        @endif
                        <a class="btn btn-warning" href="{{action('StudyController@index')}}">
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
            </div>
        </div>
        @if (@$action === 'edit')
    </form>
    @endif

    @if (@$courses)
    <!-- Table Sections (.js-table-sections class is initialized in Helpers.tableToolsSections()) -->
    <div class="block block-rounded block-fx-pop block-themed">

        <div class="block-header block-header-default bg-primary-darker">
            <h3 class="block-title">{{ __('common.Courses') }}</h3>
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
            <table class="js-table-sections table table-hover table-vcenter">
                <thead>
                    <tr>
                        <th></th>
                        <th class="d-none d-xl-table-cell">
                            @sortablelink('number', __('common.Number'))
                        </th>
                        <th>
                            @sortablelink('name', __('common.Name'))
                        </th>
                        <th class="d-none d-xl-table-cell text-center">
                            {{ __('common.Events') }}
                        </th>
                        <th class="d-none d-xl-table-cell text-center">
                            {{ __('common.Persons') }}
                        </th>
                        <th class="d-none d-xl-table-cell text-center">

                        </th>

                        <th class="text-right d-none d-sm-table-cell">
                            @can('create courses')
                            <a class="btn btn-dark btn-sm" href="{{action('CourseController@create')}}">
                                <i class="si si-plus"></i>
                            </a>
                            @endcan
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

                        <td class="d-none d-xl-table-cell">
                            <div class="py-1">
                                {{ $course->number }}
                            </div>
                        </td>

                        <td>
                            <div class="py-1">
                                <a href="{{action('CourseController@show', $course->id)}}">{{ $course->name }} </a>
                            </div>
                        </td>

                        <td class="d-none d-xl-table-cell">
                            <div class="py-1 text-center">
                                {{ $study->events()->where('course_id', $course->id)->count() }}
                            </div>
                        </td>

                        <td class="d-none d-xl-table-cell">
                            <div class="py-1 text-center">
                                {{ $study->students()->whereHas('groups', function($q) use ($course) { $q->whereHas('events', function($e) use ($course) { $e->where('course_id', $course->id); }); })->count() }}
                            </div>
                        </td>

                        <td>
                            @can('update studies')
                            <div class="py-1 text-center">
                                <a href="{{action('StudyController@less', [$study->id, $course->id])}}"
                                    class="btn btn-sm btn-light">
                                    <i class="icon si si-arrow-down"></i>
                                </a>
                                <a class="btn btn-sm btn-light">{{ $course->pivot->planned }} </a>
                                <a href="{{action('StudyController@more', [$study->id, $course->id])}}"
                                    class="btn btn-sm btn-light">
                                    <i class="icon si si-arrow-up"></i>
                                </a>

                                @if($action == 'readonly')
                                <form action="{{action('StudyController@coursedays', [$study->id, $course->id])}}"
                                    enctype="multipart/form-data" method="post" class="d-inline">
                                    @csrf

                                    <input name="_method" type="hidden" value="PATCH">
                                    <a>
                                        <button type="submit" name="weekday[monday]" value="{{ $course->pivot->monday }}"
                                            class="btn btn-sm @if($course->pivot->monday == 0) btn-light @elseif($course->pivot->monday == 1) btn-warning @elseif($course->pivot->monday == 2) btn-info @else btn-success @endif"
                                            title="{{ __('common.WeekdayAllowed') }}">
                                            {{ __('common.MondayShort') }}.
                                        </button>
                                        <button type="submit" name="weekday[tuesday]" value="{{ $course->pivot->tuesday }}"
                                            class="btn btn-sm @if($course->pivot->tuesday == 0) btn-light @elseif($course->pivot->tuesday == 1) btn-warning @elseif($course->pivot->tuesday == 2) btn-info @else btn-success @endif"
                                            title="{{ __('common.WeekdayAllowed') }}">
                                            {{ __('common.TuesdayShort') }}.
                                        </button>
                                        <button type="submit" name="weekday[wednesday]" value="{{ $course->pivot->wednesday }}"
                                            class="btn btn-sm @if($course->pivot->wednesday == 0) btn-light @elseif($course->pivot->wednesday == 1) btn-warning @elseif($course->pivot->wednesday == 2) btn-info @else btn-success @endif"
                                            title="{{ __('common.WeekdayAllowed') }}">
                                            {{ __('common.WednesdayShort') }}.
                                        </button>
                                        <button type="submit" name="weekday[thursday]" value="{{ $course->pivot->thursday }}"
                                            class="btn btn-sm @if($course->pivot->thursday == 0) btn-light @elseif($course->pivot->thursday == 1) btn-warning @elseif($course->pivot->thursday == 2) btn-info @else btn-success @endif"
                                            title="{{ __('common.WeekdayAllowed') }}">
                                            {{ __('common.ThursdayShort') }}.
                                        </button>
                                        <button type="submit" name="weekday[friday]" value="{{ $course->pivot->friday }}"
                                            class="btn btn-sm @if($course->pivot->friday == 0) btn-light @elseif($course->pivot->friday == 1) btn-warning @elseif($course->pivot->friday == 2) btn-info @else btn-success @endif"
                                            title="{{ __('common.WeekdayAllowed') }}">
                                            {{ __('common.FridayShort') }}.
                                        </button>
                                        <button type="submit" name="weekday[saturday]" value="{{ $course->pivot->saturday }}"
                                            class="btn btn-sm @if($course->pivot->saturday == 0) btn-light @elseif($course->pivot->saturday == 1) btn-warning @elseif($course->pivot->saturday == 2) btn-info @else btn-success @endif"
                                            title="{{ __('common.WeekdayAllowed') }}">
                                            {{ __('common.SaturdayShort') }}.
                                        </button>
                                        <button type="submit" name="weekday[sunday]" value="{{ $course->pivot->sunday }}"
                                            class="btn btn-sm @if($course->pivot->sunday == 0) btn-light @elseif($course->pivot->sunday == 1) btn-warning @elseif($course->pivot->sunday == 2) btn-info @else btn-success @endif"
                                            title="{{ __('common.WeekdayAllowed') }}">
                                            {{ __('common.SundayShort') }}.
                                        </button>
                                    </a>
                                </form>
                                <a class="btn btn-warning btn-sm"
                                    href="{{action('StudyController@coursedays', [$study->id, $course->id, 1])}}"
                                    title="{{ __('common.WeekdaysReset') }}">
                                    <i class="icon si si-energy"></i>
                                </a>
                                @endif
                            </div>
                            @endcan
                        </td>



                        <td class="d-none d-sm-table-cell text-right">

                            @can('update courses')
                            <a href="{{action('CourseController@edit', $course->id)}}" class="btn btn-primary btn-sm"
                                title="{{ __('common.Edit') }}">
                                <i class="nav-main-link-icon si si-pencil"></i>
                            </a>
                            @endcan

                            @can('update studies')
                            <form action="{{action('StudyCourseController@detach', [$study->id, $course->id])}}" method="post"
                                class="d-inline">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">

                                <button type="submit" class="btn btn-danger btn-sm" title="{{ __('common.Delete') }}">
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
                        <td colspan="5">
                            <p>{{ $course->description }}</p>
                            <p><a href="{{ $course->url }}" target="_blank">{{ $course->url }}</a></p>
                            @if(@$course->groups)
                            <h3>{{ __('common.Groups') }}</h3>
                            <ul>
                                @foreach($course->groups as $group)
                                <li>{{ $group->name }}</li>
                                @endforeach
                            </ul>
                            @endif
                            <em class="text-muted">{{ Carbon::parse($course->updated_at)->format('d.m.Y H:i')}}</em>
                        </td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
        @if ($courses->total() > $courses->perPage())
        <div
            class="block-content block-content-full block-content-sm bg-body-light d-flex justify-content-center align-content-center">
            {!! $courses->setPageName('studycourses')->appends(\Request::except('studycourses'))->render() !!}
        </div>
        @endif
    </div>
    @endif

    <!-- END Block Tabs With Options Default Style -->
    @elseif (@$action === 'create')

    <form action="{{action('StudyController@store')}}" enctype="multipart/form-data" method="post">
        @csrf
        <input name="_method" type="hidden" value="POST">

        <!-- Block Tabs With Options Default Style -->
        <div class="block block-rounded block-themed block-fx-pop">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ __('common.Study') }}</h3>
            </div>
            <div class="block-content pb-4">
                <h2 class="content-heading">{{ __('common.New') }}</h2>
                <div class="row">


                    <div class="col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="period_id"><small>{{ __('common.Period') }}</small></label>
                        <select class="form-control" id="period_id" name="period_id" title="{{ __('common.Period') }}">
                            <option value="">{{ __('common.Period') }} {{ __('common.select') }}</option>
                            @foreach($periods as $period)
                            <option value="{{ $period->id }}" {{ (old('period_id') == $period->id ? 'selected':'') }}>
                                {{ $period->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="name"><small>{{ __('common.Name') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('name') ? "is-invalid" : "" }}" id="name" name="name"
                            placeholder="{{ __('common.Name') }}" value="{{ old('name') }}">
                    </div>

                    <div class="form-group col-xl-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="alias"><small>{{ __('common.Alias') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('alias') ? "is-invalid" : "" }}" id="alias"
                            name="alias" placeholder="{{ __('common.Alias') }}" value="{{ old('alias') }}">
                    </div>


                    <div class="form-group col-xl-2">
                        <label class="text-muted mb-0 font-size-sm" for="group_size"><small>{{ __('common.GroupSize') }}
                            </small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('group_size') ? "is-invalid" : "" }}" id="group_size"
                            name="group_size" placeholder="{{ __('common.GroupSize') }}"
                            value="{{ old('group_size') }}">
                    </div>


                    <div class="form-group col-xl-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="groups_planned"><small>{{ __('common.Groups') }} </small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('groups_planned') ? "is-invalid" : "" }}"
                            id="groups_planned" name="groups_planned" placeholder="{{ __('common.Groups') }}"
                            value="{{ old('groups_planned') }}">
                    </div>

                    <div class="form-group col-xl-4">
                        <label class="text-muted mb-0 font-size-sm"
                            for="active"><small>{{ __('common.Active') }}</small></label>
                        <select {{ $action }} class="form-control" id="active" name="active">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="0" {{ (old('active') == 0 ? 'selected':'') }}>{{ __('common.Inactive') }}
                            </option>
                            <option value="1" {{ (old('active') == 1 ? 'selected':'') }}>{{ __('common.Active') }}
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


                    <div class="form-group col-xl-4">
                        <div class="form-group">
                            <label class="text-muted mb-0 font-size-sm"
                                for="start_date"><small>{{ __('common.DateRange') }}</small></label>
                            <div class="input-daterange input-group" data-date-format="dd.mm.yyyy" data-week-start="1"
                                data-autoclose="true" data-today-highlight="true">
                                <input {{ $action }} @if($action=='readonly' ) disabled @endif type="text"
                                    class="form-control text-left" id="start_date" name="start_date"
                                    data-date-default-date="now"
                                    placeholder="{{ __('common.Date') }} {{ __('common.From') }}" data-week-start="1"
                                    data-autoclose="true" data-today-highlight="true" value="{{ old('start_date') }}">
                                <div class="input-group-prepend input-group-append">
                                    <span class="input-group-text">
                                        <i class="fa fa-fw fa-arrow-right"></i>
                                    </span>
                                </div>
                                <input {{ $action }} @if($action=='readonly' ) disabled @endif type="text"
                                    class="form-control text-left" id="end_date" name="end_date"
                                    placeholder="{{ __('common.Date') }} {{ __('common.To') }}" data-week-start="1"
                                    data-autoclose="true" data-today-highlight="true" value="{{ old('end_date') }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-xl-12">
                        <label class="text-muted mb-0 font-size-sm"
                            for="description"><small>{{ __('common.Description') }}</small></label>
                        <textarea {{ $action }} rows="5"
                            class="form-control {{ @$errors->has('description') ? "is-invalid" : "" }}" id="description"
                            name="description"
                            placeholder="{{ __('common.Description') }}">{{ old('description') }}</textarea>
                    </div>
                </div>

            </div>
            <div class="block-content block-content-full text-right bg-light">
                <a class="btn btn-warning" href="{{action('StudyController@index')}}" title="{{ __('common.Close') }}">
                    <i class="si si-action-undo mr-1"></i>
                    {{ __('common.Close') }}
                </a>
                <button type="submit" class="btn btn-primary" title="{{ __('common.Overview') }}">
                    <i class="si si-fire mr-1"></i>
                    {{ __('common.Save') }}
                </button>
            </div>
        </div>
    </form>


    @endif
    @endif

    @if (@$studies)
    <!-- Active studies -->
    <div class="block block-rounded block-fx-pop block-themed">

        <div class="block-header block-header-default bg-primary-darker">
            <h3 class="block-title">{{ __('common.Studies') }}</h3>
            <div class="block-options">
                <div class="btn-group">
                    @can('read studies')
                    <a class="btn btn-light btn-sm" href="javascript:void(0)" onclick="getStudies();">
                        <i class="si si-share-alt mr-1"></i> {{ __('common.Studies') }} XHR</span>
                    </a>
                    <a class="btn btn-light btn-sm" href="{{action('ExportController@studies')}}">
                        <i class="si si-share-alt mr-1"></i> {{ __('common.Excel') }}</span>
                    </a>
                    @endcan
                    @can('create studies')
                    <a class="btn btn-primary btn-sm" href="{{action('StudyController@create')}}">
                        <i class="si si-plus mr-1"></i> {{ __('common.Study') }} <span
                            class="text-lowercase">{{ __('common.Add') }}</span>
                    </a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="block-content">
            <form action="{{action('StudyController@index')}}" method="post">
                <div class="row mb-4">
                    <div class="col-xl-4">
                        <div class="form-group">
                            <select class="form-control" id="period_id" name="period_id"
                                title="{{ __('common.Period') }}" onchange="this.form.submit()">
                                <option value="">{{ __('common.Period') }} {{ __('common.select') }}</option>
                                @foreach($periods as $period)
                                <option value="{{ $period->id }}" {{ (@$period_id == $period->id ? 'selected':'') }}>
                                    {{ $period->name }}</option>
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
                        <th class="d-none d-xl-table-cell">
                            @sortablelink('url', __('common.URL'))
                        </th>
                        <th class="d-none d-xl-table-cell text-center">
                            @sortablelink('group_size', __('common.GroupSize'))
                        </th>
                        <th class="d-none d-xl-table-cell text-center">
                            {{ __('common.Groups') }}
                        </th>
                        <th class="d-none d-xl-table-cell text-center">
                            {{ __('common.Persons') }}
                        </th>
                        <th class="d-none d-xl-table-cell text-center">
                            {{ __('common.Assigned') }}
                        </th>
                        <th class="text-right d-none d-sm-table-cell">

                        </th>
                    </tr>
                </thead>
                @csrf

                @foreach($studies as $study)
                <tbody class="js-table-sections-header">
                    <tr>
                        <td class="text-center">
                            <i class="fa fa-angle-right text-muted"></i>
                        </td>
                        <td>
                            <div class="py-1">
                                <a href="{{action('StudyController@show', $study->id)}}">{{ $study->name }} </a>
                            </div>
                        </td>

                        <td>
                            <div class="py-1">
                                <a href="{{ $study->url }}" target="_blank" title="{{ $study->url }}"
                                    class="btn btn-sm btn-light">
                                    <i class="si si-link"></i>
                                </a>
                            </div>
                        </td>
                        <td class="d-none d-xl-table-cell text-center">
                            <div class="py-1">
                                {{ $study->group_size }}
                            </div>
                        </td>
                        <td class="d-none d-xl-table-cell text-center">
                            <div class="py-1">
                                {{ $study->groups->count() }}
                            </div>
                        </td>
                        <td class="d-none d-xl-table-cell text-center">
                            <div class="py-1">
                                {{ $study->students->count() }}
                            </div>
                        </td>
                        <td class="d-none d-xl-table-cell text-center">
                            <div class="py-1">
                                @if($study->students()->whereHas('groups')->count() < $study->students->count())
                                    <a href="/groups/persons" class="btn btn-danger btn-sm">
                                        <i
                                            class="si si-users mr-1"></i>{{ $study->students()->whereHas('groups')->count() }}
                                    </a>
                                    @else
                                    <a href="/groups/persons"
                                        class="btn btn-success btn-sm">{{ $study->students()->whereHas('groups')->count() }}</a>
                                    @endif
                            </div>
                        </td>



                        <td class="d-none d-sm-table-cell text-right">
                            @can('update studies')
                            @if($study->groups->count())
                            <a href="{{action('StudyController@persons', [$study->id])}}" class="btn btn-info btn-sm"
                                title="{{ __('common.Persons') }} {{ __('common.create') }}">
                                <i class="nav-main-link-icon si si-users mr-1"></i> {{ __('common.Persons') }}
                                {{ __('common.assign') }}
                            </a>
                            @endif

                            @if($study->students->count())
                            <a href="{{action('StudyController@groups', [$study->id])}}" class="btn btn-info btn-sm"
                                title="{{ __('common.Groups') }} {{ __('common.create') }}">
                                <i class="nav-main-link-icon si si-users mr-1"></i> {{ __('common.Groups') }}
                                {{ __('common.create') }}
                            </a>
                            @endif

                            <a href="{{action('StudyController@status', $study->id)}}" class="btn btn-sm btn-warning"
                                title="{{ __('common.Disable') }}">
                                <i class="nav-main-link-icon si si-ban"></i>
                            </a>

                            <a href="{{action('StudyController@replicate', $study->id)}}" class="btn btn-sm btn-dark"
                                title="{{ __('common.CreateCopy') }}">
                                <i class="nav-main-link-icon si si-docs"></i>
                            </a>

                            <a href="{{action('StudyController@edit', $study->id)}}" class="btn btn-sm btn-primary"
                                title="{{ __('common.Edit') }}">
                                <i class="nav-main-link-icon si si-pencil"></i>
                            </a>
                            @endcan

                            @can('delete studies')
                            <form action="{{action('StudyController@destroy', $study->id)}}" method="post"
                                class="d-inline">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">

                                <button type="submit" class="btn btn-sm btn-danger" title="{{ __('common.Delete') }}">
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
                            <h3>{{ $study->description }}</h3>
                            <p>{{ $study->description }}</p>
                            <p>{{ __('common.StartDate') }} {{ Carbon::parse($study->start_date)->format('d.m.Y')}}.
                                {{ __('common.EndDate') }} {{ Carbon::parse($study->end_date)->format('d.m.Y')}}</p>

                            @if($study->groups()->count() > 0)
                            <h4>{{ __('common.Groups') }}</h4>
                            <ul>
                                @foreach($study->groups as $group)
                                <li>{{ $group->alias }} ({{ $group->persons->count() }} {{ __('common.Persons') }})</li>
                                @endforeach

                            </ul>
                            @endif

                            @if($study->courses()->count() > 0)
                            <h4>{{ __('common.Courses') }}</h4>
                            <ul>
                                @foreach($study->courses as $course)
                                <li>{{ $course->number }} | {{ $course->name }} | {{ $course->alias }}</li>
                                @endforeach

                            </ul>
                            @endif
                            <em class="text-muted">{{ __('common.DateUpdated') }}:
                                {{ Carbon::parse($study->updated_at)->format('d.m.Y H:i')}}</em>
                        </td>


                    </tr>

                </tbody>
                @endforeach
            </table>

        </div>

        @if ($studies->total() > $studies->perPage())
        <div
            class="block-content block-content-full block-content-sm bg-body-light d-flex justify-content-center align-content-center">
            {!! $studies->setPageName('active')->appends(\Request::except('assigned'))->render() !!}
        </div>
        @endif
    </div>
    <!-- END Active studies-->
    @endif

    @if (@$inactive)
    <!-- Active studies -->
    <div class="block block-rounded block-fx-pop block-mode-hidden">

        <div class="block-header block-header-default">
            <h3 class="block-title">{{ __('common.Studies') }} <span
                    class="text-lowercase">{{ __('common.Inactive') }}</span></h3>
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
            <div class="row mb-4">
                <div class="col-xl-10"></div>
                <div class="col-xl-2">
                    <form action="{{action('StudyController@index')}}" method="post">
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
                            @sortablelink('url', __('common.URL'))
                        </th>
                        <th class="d-none d-xl-table-cell">
                            @sortablelink('group_size', __('common.GroupSize'))
                        </th>
                        <th class="d-none d-xl-table-cell">
                            @sortablelink('groups_planned', __('common.Groups'))
                        </th>
                        <th class="d-none d-xl-table-cell">
                            @sortablelink('start_date', __('common.StartDate'))
                        </th>
                        <th class="d-none d-xl-table-cell">
                            @sortablelink('end_date', __('common.EndDate'))
                        </th>
                        <th class="d-none d-xl-table-cell">
                            @sortablelink('updated_at', __('common.Updated'))
                        </th>
                        <th class="text-right d-none d-sm-table-cell">
                            @can('create studies')
                            <a class="btn btn-dark btn-sm" href="{{action('StudyController@create')}}">
                                <i class="si si-plus"></i>
                            </a>
                            @endcan
                        </th>
                    </tr>
                </thead>
                @csrf

                @foreach($inactive as $study)
                <tbody class="js-table-sections-header">
                    <tr>
                        <td class="text-center">
                            <i class="fa fa-angle-right text-muted"></i>
                        </td>
                        <td>
                            <div class="py-1">
                                <a href="{{action('StudyController@show', $study->id)}}">{{ $study->name }} </a>
                            </div>
                        </td>

                        <td class="d-none d-xl-table-cell">
                            <div class="py-1">
                                <a href="{{ $study->url }}" target="_blank" title="{{ $study->url }}"
                                    class="btn btn-sm btn-light">
                                    <i class="si si-link"></i>
                                </a>
                            </div>
                        </td>
                        <td class="d-none d-xl-table-cell">
                            <div class="py-1">
                                {{ $study->group_size }}
                            </div>
                        </td>
                        <td class="d-none d-xl-table-cell">
                            <div class="py-1">
                                {{ $study->groups_planned }}
                            </div>
                        </td>
                        <td class="d-none d-xl-table-cell">
                            <div class="py-1">
                                {{ Carbon::parse($study->start_date)->format('d.m.Y H:i')}}
                            </div>
                        </td>
                        <td class="d-none d-xl-table-cell">
                            <div class="py-1">
                                {{ Carbon::parse($study->end_date)->format('d.m.Y H:i')}}
                            </div>
                        </td>

                        <td class="d-none d-xl-table-cell">
                            <div class="py-1">
                                {{ Carbon::parse($study->created_at)->format('d.m.Y H:i')}}
                            </div>
                        </td>

                        <td class="d-none d-sm-table-cell text-right">

                            @can('update studies')
                            <a href="{{action('StudyController@status', $study->id)}}" class="btn btn-success btn-sm"
                                title="{{ __('common.Enable') }}">
                                <i class="nav-main-link-icon si si-check"></i>
                            </a>

                            <a href="{{action('StudyController@replicate', $study->id)}}" class="btn btn-dark btn-sm"
                                title="{{ __('common.Replicate') }}">
                                <i class="nav-main-link-icon si si-docs"></i>
                            </a>

                            <a href="{{action('StudyController@edit', $study->id)}}" class="btn btn-primary btn-sm"
                                title="{{ __('common.Edit') }}">
                                <i class="nav-main-link-icon si si-pencil"></i>
                            </a>
                            @endcan

                            @can('delete studies')
                            <form action="{{action('StudyController@destroy', $study->id)}}" method="post"
                                class="d-inline">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">

                                <button type="submit" class="btn btn-danger btn-sm" title="{{ __('common.Delete') }}">
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
                            <p>{{ $study->description }}</p>

                            @if($study->courses()->count() > 0)
                            <h4>{{ __('common.Courses') }}</h4>
                            <ul>
                                @foreach($study->courses as $course)
                                <li>{{ $course->number }} | {{ $course->name }} | {{ $course->alias }}</li>
                                @endforeach
                            </ul>
                            @endif
                            <em class="text-muted">{{ __('common.DateUpdated') }}:
                                {{ Carbon::parse($study->created_at)->format('d.m.Y H:i')}}</em>
                        </td>


                    </tr>

                </tbody>
                @endforeach
            </table>

        </div>

        @if ($inactive->total() > $inactive->perPage())
        <div
            class="block-content block-content-full block-content-sm bg-body-light d-flex justify-content-center align-content-center">
            {!! $inactive->setPageName('inactive')->appends(\Request::except('assigned'))->render() !!}
        </div>
        @endif
    </div>
    <!-- END Active studies-->
    @endif
</div>
<!-- END Page Content -->


@endsection