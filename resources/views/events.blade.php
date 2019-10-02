@extends('layouts.app')

@section('content')

<!-- Page Content -->
<div class="content">

    <!-- If edit or create or password -->
    @if (@$event)

    {{-- We are here only if variable event is available --}}

    @if (@$action === 'edit' || @$action === 'readonly')

    <form action="{{action('EventController@update', $id)}}" enctype="multipart/form-data" method="post">
        @csrf

        <input name="_method" type="hidden" value="PATCH">

        <!-- Block Tabs With Options Default Style -->
        <div class="block block-rounded block-fx-pop @if($action == 'readonly') block-mode-hidden @endif block-themed">
            <div class="block-header block-header-default bg-default-darker">
                <h3 class="block-title">{{ $event->course->alias }} | {{ $event->course->number}} | {{ $event->name }}
                </h3>
                @if($event->script_id)
                <a class="btn btn-primary btn-sm" href="{{action('ScriptController@show', $event->script_id)}}">
                    <i class="si si-notebook mr-1"></i>
                    {{ __('common.Script') }}
                </a>
                @endif
                <div class="btn-group">
                    <a class="btn btn-primary btn-sm"
                        href="{{ action('EventController@createParticipantsSheet', $event->id) }}">
                        <i class="si si-users mr-1"></i>{{ __('common.Participants') }}
                    </a>
                </div>
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

                    <div class="form-group col-md-3">
                        <label class="text-muted mb-0 font-size-sm" for="course_id"><small>{{ __('common.Course')
                                }}</small></label>
                        <select {{ $action }} @if($action=='readonly' ) disabled @endif class="form-control"
                            id="course_id" name="course_id">
                            <option value="">{{ __('common.Select') }}</option>
                            @foreach ($courses as $course)
                            <option value="{{ $course->id }}" {{ $course->id == $event->course_id ? 'selected':'' }}>{{
                                $course->alias }} | {{ $course->number }} {{ $course->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label class="text-muted mb-0 font-size-sm" for="room"><small>{{ __('common.Room')
                                }}</small></label>
                        <select {{ $action }} @if($action=='readonly' ) disabled @endif class="form-control"
                            id="room_id" name="room_id">
                            <option value="">{{ __('common.Select') }}</option>
                            @foreach ($rooms as $room)
                            <option value="{{ $room->id }}" {{ $room->id == $event->room_id ? 'selected':'' }}>{{
                                $room->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label class="text-muted mb-0 font-size-sm" for="script"><small>{{ __('common.Script')
                                }}</small></label>
                        <select {{ $action }} @if($action=='readonly' ) disabled @endif class="form-control"
                            id="script_id" name="script_id">
                            <option value="">{{ __('common.Select') }}</option>
                            @if($event->scripts)
                            @foreach ($event->scripts as $script)
                            <option value="{{ $script->id }}" {{ $script->id == $event->script_id ? 'selected':'' }}>{{
                                $script->name }} {{$script->course->name}} </option>
                            @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label class="text-muted mb-0 font-size-sm" for="name"><small>{{ __('common.Name')
                                }}</small></label>
                        <input {{ $action }} type="text" class="form-control {{ @$errors->has('name') ? " is-invalid"
                            : "" }}" id="name" name="name" placeholder="{{ __('common.Name') }}"
                            value="{{ $event->name }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label class="text-muted mb-0 font-size-sm" for="alias"><small>{{ __('common.Alias')
                                }}</small></label>
                        <input {{ $action }} type="text" class="form-control {{ @$errors->has('alias') ? " is-invalid"
                            : "" }}" id="alias" name="alias" placeholder="{{ __('common.Alias') }}"
                            value="{{ $event->alias }}">
                    </div>


                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="text-muted mb-0 font-size-sm" for="start_date"><small>{{
                                    __('common.DateRange') }}</small></label>
                            <div class="input-daterange input-group" data-date-format="dd.mm.yyyy" data-week-start="1"
                                data-autoclose="true" data-today-highlight="true">
                                <input {{ $action }} @if($action=='readonly' ) disabled @endif type="text"
                                    class="form-control text-left" id="start_date" name="start_date"
                                    data-date-default-date="now"
                                    placeholder="{{ __('common.Date') }} {{ __('common.From') }}" data-week-start="1"
                                    data-autoclose="true" data-today-highlight="true"
                                    value="{{ Carbon::parse($event->start_date)->format('d.m.Y') }}">
                                <div class="input-group-prepend input-group-append">
                                    <span class="input-group-text">
                                        <i class="fa fa-fw fa-arrow-right"></i>
                                    </span>
                                </div>
                                <input {{ $action }} @if($action=='readonly' ) disabled @endif type="text"
                                    class="form-control text-left" id="end_date" name="end_date"
                                    placeholder="{{ __('common.Date') }} {{ __('common.To') }}" data-week-start="1"
                                    data-autoclose="true" data-today-highlight="true"
                                    value="{{ Carbon::parse($event->end_date)->format('d.m.Y') }}">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <label class="text-muted mb-0 font-size-sm" for="color"><small>{{ __('common.Color')
                                }}</small></label>
                        <div class="js-colorpicker input-group" data-format="hex">
                            <input {{ $action }} type="text" class="form-control" id="color" name="color"
                                value="{{ $event->color }}">
                            <div class="input-group-append">
                                <span class="input-group-text colorpicker-input-addon">
                                    <i></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-3">
                        <label class="text-muted mb-0 font-size-sm" for="active"><small>{{ __('common.Active')
                                }}</small></label>
                        <select {{ $action }} @if($action=='readonly' ) disabled @endif class="form-control" id="active"
                            name="active">
                            <option value="1" {{ ($event->active == 1 ? 'selected':'') }}>{{ __('common.Active') }}
                            </option>
                            <option value="0" {{ ($event->active == '0' ? 'selected':'') }}>{{ __('common.Inactive') }}
                            </option>
                        </select>
                    </div>

                    <div class="form-group col-md-12">
                        <label class="text-muted mb-0 font-size-sm" for="description"><small>{{ __('common.Description')
                                }}</small></label>
                        <textarea {{ $action }} class="form-control" id="description" name="description"
                            rows="4">{{ $event->description }}</textarea>
                    </div>

                </div>

            </div>
            <div class="block-content block-content-full text-right bg-light">
                <div class="d-none">
                    <img class="img-avatar" src="{{ url('/images/'.$event->image_url) }}">
                </div>

                <a class="btn btn-warning" href="{{action('EventController@index')}}">
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


    <form action="{{action('EventController@create')}}" enctype="multipart/form-data" method="post">
        @csrf
        <input name="_method" type="hidden" value="GET">

        <!-- Block Tabs With Options Default Style -->
        <div class="block block-rounded block-themed block-fx-shadow">
            <div class="block-header block-header-default bg-primary-dark">
                <h3 class="block-title">{{ __('common.Event') }}</h3>
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
                        <label class="text-muted mb-0 font-size-sm" for="study_id"><small>{{ __('common.Study')
                                }}</small></label>
                        <select {{ $action }} class="form-control" id="study_id" name="study_id"
                            title="{{ __('common.Study') }}" onchange="this.form.submit()">
                            <option value="">{{ __('common.Select') }}</option>
                            @foreach ($studies as $study)
                            <option value="{{ $study->id }}" {{ (old('study_id')==$study->id || @$study_id == $study->id
                                ? 'selected':'') }}>{{ $study->alias }} | {{ $study->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="text-muted mb-0 font-size-sm" for="course_id"><small>{{ __('common.Course')
                                }}</small></label>
                        <select {{ $action }} class="form-control" id="course_id" name="course_id"
                            title="{{ __('common.Course') }}" @if(@!$study_id || !$courses->count()) disabled @endif
                            onchange="this.form.submit()">
                            <option value="">{{ __('common.Select') }}</option>
                            @if(@$study_id || $courses->count())
                            @foreach ($courses as $course)
                            <option value="{{ $course->id }}" {{ (old('course_id')==$course->id || @$course_id ==
                                $course->id ? 'selected':'') }}>{{ $course->alias }} | {{ $course->number }} | {{
                                $course->name }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="text-muted mb-0 font-size-sm" for="room"><small>{{ __('common.Room')
                                }}</small></label>
                        <select {{ $action }} class="form-control" id="room_id" name="room_id"
                            title="{{ __('common.Room') }}" onchange="this.form.submit()">
                            <option value="">{{ __('common.Select') }}</option>
                            @foreach ($rooms as $room)
                            <option value="{{ $room->id }}" {{ (old('room_id')==$room->id || @$room_id == $room->id ?
                                'selected':'') }}>{{ $room->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="text-muted mb-0 font-size-sm" for="start_date"><small>{{
                                    __('common.DateRange') }}</small></label>
                            <div class="input-daterange input-group" data-date-format="dd.mm.yyyy" data-week-start="1"
                                data-autoclose="true" data-today-highlight="true">
                                <input type="text" class="form-control text-left" id="start_date" name="start_date"
                                    data-date-default-date="now"
                                    placeholder="{{ __('common.Date') }} {{ __('common.From') }}" data-week-start="1"
                                    data-autoclose="true" data-today-highlight="true"
                                    value="{{ (old('start_date')) ? old('start_date') : Carbon::now()->format('d.m.Y') }}">
                                <div class="input-group-prepend input-group-append">
                                    <span class="input-group-text">
                                        <i class="fa fa-fw fa-arrow-right"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control text-left" id="end_date" name="end_date"
                                    placeholder="{{ __('common.Date') }} {{ __('common.To') }}" data-week-start="1"
                                    data-autoclose="true" data-today-highlight="true"
                                    value="{{ (old('end_date')) ? old('end_date') : Carbon::now()->addWeeks(5)->format('d.m.Y') }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-lg-2">
                        <label class="text-muted mb-0 font-size-sm" for="start_date"><small>&nbsp;</small></label>
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="si si-fire mr-1"></i>
                            {{ __('common.CheckAvailability') }}
                        </button>
                    </div>
                    <div class="form-group col-md-2">
                        <label class="text-muted mb-0 font-size-sm" for="script"><small>{{ __('common.Script')
                                }}</small></label>
    </form>
    <form action="{{action('EventController@store')}}" enctype="multipart/form-data" method="post">
        @csrf
        <input name="_method" type="hidden" value="POST">
        <input name="course_id" type="hidden" value="{{ $course_id }}">
        <input name="study_id" type="hidden" value="{{ $study_id }}">
        <input name="room_id" type="hidden" value="{{ $room_id }}">
        <input name="start_date" type="hidden" value="{{ old('start_date') }}">
        <input name="end_date" type="hidden" value="{{ old('end_date') }}">

        <select {{ $action }} @if($action=='readonly' ) disabled @endif class="form-control" id="script_id"
            name="script_id">
            <option value="">{{ __('common.Select') }}</option>
            @if($event->scripts)
            @foreach ($event->scripts as $script)
            <option value="{{ $script->id }}" {{ (old('script_id')==$event->script_id) ? 'selected':'' }}>{{
                $script->name }} ({{$script->course->name}})</option>
            @endforeach
            @endif
        </select>
</div>

<div class="form-group col-md-3">
    <label class="text-muted mb-0 font-size-sm" for="name"><small>{{ __('common.Name') }}</small></label>
    <input {{ $action }} type="text" class="form-control {{ @$errors->has('name') ? " is-invalid" : "" }}" id="name"
        name="name" placeholder="{{ __('common.Name') }}" value="{{ old('name') }}">
</div>

<div class="form-group col-md-3">
    <label class="text-muted mb-0 font-size-sm" for="alias"><small>{{ __('common.Alias') }}</small></label>
    <input {{ $action }} type="text" class="form-control {{ @$errors->has('alias') ? " is-invalid" : "" }}" id="alias"
        name="alias" placeholder="{{ __('common.Alias') }}" value="{{ $event->alias }}">
</div>




<div class="col-lg-1">
    <label class="text-muted mb-0 font-size-sm" for="color"><small>{{ __('common.Color') }}</small></label>
    <div class="js-colorpicker input-group" data-format="hex">
        <input type="text" class="form-control" id="color" name="color" value="#0665d0">
        <div class="input-group-append">
            <span class="input-group-text colorpicker-input-addon">
                <i></i>
            </span>
        </div>
    </div>
</div>

<div class="form-group col-md-3">
    <label class="text-muted mb-0 font-size-sm" for="active"><small>{{ __('common.Active') }}</small></label>
    <select {{ $action }} class="form-control" id="active" name="active">
        <option value="1" {{ ($event->active == 1 ? 'selected':'') }}>{{ __('common.Active') }}</option>
        <option value="0" {{ ($event->active == '0' ? 'selected':'') }}>{{ __('common.Inactive') }}</option>
    </select>
</div>

<div class="form-group col-md-12">
    <label class="text-muted mb-0 font-size-sm" for="description"><small>{{ __('common.Description') }}</small></label>
    <textarea {{ $action }} class="form-control" id="description" name="description" rows="4"></textarea>
</div>

</div>

</div>
<div class="block-content block-content-full text-right bg-light">


    <a class="btn btn-warning" href="{{action('EventController@index')}}">
        <i class="si si-action-undo mr-1"></i>
        {{ __('common.Close') }}
    </a>
    <button type="submit" @if(@$conflict) disabled @endif class="btn btn-primary">
        <i class="si si-fire mr-1"></i>
        {{ __('common.Save') }}
    </button>
</div>
</div>
</form>

@if(@$conflict && @$msg)
<div class="block block-rounded block-themed block-fx-shadow">
    <div class="block-header block-header-default bg-danger">
        <h3 class="block-title">{{ $msg }} {{ __('common.DateRange') }}: {{ old('start_date') }} - {{ old('end_date') }}
        </h3>
    </div>
</div>
@endif

@if($exclusions)
@if($exclusions->count())
<!-- If a room has exclusions -->
@include('include.exclusions')
<!-- ENDIF -->
@endif
@endif

@endif
@endif


@if(@$event->course->objectives)
@if(@$action == 'readonly')
<div class="block block-rounded block-fx-pop block-mode-hidden">
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
                    <th style="border-top: none;">{{ __('common.Active') }}</th>
                    <th class="text-right" style="border-top: none;">
                        @can('create objectives')
                        <a class="btn btn-dark btn-sm"
                            href="{{action('ObjectiveController@create', $event->course->id)}}">
                            <i class="si si-plus"></i>
                        </a>
                        @endcan
                    </th>
                </tr>
            </thead>
            @foreach($event->course->objectives as $objective)
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

                    <td>
                        <div class="py-1">
                            {{ $objective->active }}
                        </div>
                    </td>
                    <td class="d-none d-sm-table-cell text-right">

                        @can('update objectives')
                        <a href="{{ route('objectives.edit', ['type' => $event->course->id, 'item' => $objective->id]) }}"
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


@if(@$event->occurrences)
@if (@$action == 'readonly')
<div class="block block-rounded block-fx-pop !@can('update occurrences') block-mode-hidden @endcan">
    <div class="block-header block-header-default">
        <h3 class="block-title">{{ __('common.Occurrences') }} </h3>
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
                    <th style="border-top: none;">{{ __('common.Date') }}</th>
                    <th style="border-top: none;">{{ __('common.Time') }}</th>
                    <th style="border-top: none;">{{ __('common.Room') }}</th>
                    <th class="text-right" style="border-top: none;">
                        @can('create occurrences')
                        <a class="btn btn-dark btn-sm" href="{{action('OccurrenceController@create', $event->id)}}">
                            <i class="si si-plus"></i>
                        </a>
                        @endcan
                    </th>
                </tr>
            </thead>
            @foreach($event->occurrences as $occurrence)
            <tbody class="js-table-sections-header">
                <tr>
                    <td class="text-center">
                        <i class="fa fa-angle-right text-muted"></i>
                    </td>
                    <td>
                        <div class="py-1">
                            {{ Carbon::parse($occurrence->date)->format('D, d.m.Y')}}
                        </div>
                    </td>

                    <td>
                        <div class="py-1">
                            {{ Carbon::parse($occurrence->start_time)->format('H:i')}} -
                            {{ Carbon::parse($occurrence->end_time)->format('H:i')}}
                        </div>
                    </td>

                    <td>
                        <div class="py-1">
                            {{ App\Room::findOrFail($occurrence->room_id)->name }}
                        </div>
                    </td>
                    <td class="d-none d-sm-table-cell text-right">


                        @can('update occurrences')
                        <a href="{{ action('OccurrenceController@edit', $occurrence->id) }}"
                            class="btn btn-primary btn-sm">
                            <i class="nav-main-link-icon si si-pencil"></i>
                        </a>
                        @endcan

                        @can('delete occurrences')
                        <form action="{{ action('OccurrenceController@destroy', $objective['id']) }}" method="post"
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

                        <p><em>{{ $occurrence->date }}</em></p>
                    </td>
            </tbody>
            @endforeach
        </table>
    </div>
</div>
@endif
@endif

@if(@$event->groups)
@if (@$action == 'readonly')
@foreach($event->groups as $group)
<div class="block block-rounded block-fx-pop">
    <div class="block-header block-header-default">
        <h3 class="block-title">{{ __('common.Group') }} {{ $group->alias }} | {{ $group->name }}</h3>

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
                    <th style="border-top: none;" class="d-none d-md-table-cell">{{ __('common.Company') }}</th>
                    <th style="border-top: none;" class="d-none d-md-table-cell">{{ __('common.DateUpdated') }}</th>
                    <th style="border-top: none;" class="d-none d-md-table-cell">{{ __('common.Grade') }}</th>
                    <th class="text-right d-none d-sm-table-cell" style="border-top: none;">

                    </th>
                </tr>
            </thead>
            @foreach(@$group->students as $student)
            <tbody class="js-table-sections-header">
                <tr>
                    <td class="text-center">
                        <i class="fa fa-angle-right text-muted"></i>
                    </td>
                    <td>
                        <div class="py-1">
                            <a href="#">{{ $student->first_name }} {{ $student->last_name }}</a>
                        </div>
                    </td>

                    <td class="d-none d-md-table-cell">
                        <div class="py-1">
                            {{ $student->company_name }}
                        </div>
                    </td>
                    <td class="d-none d-md-table-cell">
                        <div class="py-1">
                            {{ Carbon::parse($student->grades->where('event_id',
                            $event->id)->pluck('updated_at')->first())->format('D, d.m.Y')}}
                        </div>
                    </td>
                    <td class="d-none d-md-table-cell">
                        <div class="py-1">

                            @foreach($student->grades->where('event_id', $event->id) as $grade)
                            <a href="{{ action('GradeController@edit', $grade->id) }}"
                                class="btn @if($grade->grade <= 3) btn-danger @elseif($grade->grade <= 4) btn-info @else btn-success @endif btn-sm"
                                title="{{ $grade->description }}">
                                {{ $grade->grade }}
                            </a>
                            @endforeach

                        </div>
                    </td>
                    <td class="d-none d-sm-table-cell text-right">

                        <a href="{{ action('EventController@grade', [$event->id, $student->id]) }}"
                            class="btn btn-primary btn-sm" title="{{ __('common.Assessment')}}">
                            <i class="nav-main-link-icon si si-graduation mr-1"></i> {{ __('common.Assessment')}}
                        </a>


                    </td>
                </tr>
            </tbody>

            <tbody class="font-size-sm">
                @foreach($event->occurrences as $occurrence)
                <tr>
                    <td class="text-center"></td>
                    <td colspan="4">
                        {{ Carbon::parse($occurrence->date)->format('D, d.m.Y')}}
                    </td>
                    <td class="text-right">

                        <a href="{{ action('OccurrenceController@present', [$occurrence->id, $student->id]) }}"
                            class="btn @if($occurrence->present()->where('person_id', $student->id)->first()) btn-success @else btn-light @endif btn-sm"
                            title="{{ __('common.Present')}}">
                            <i class="nav-main-link-icon si si-login mr-1"></i> {{ __('common.Present')}}
                        </a>
                        <a href="{{ action('OccurrenceController@absent', [$occurrence->id, $student->id]) }}"
                            class="btn @if($occurrence->absent()->where('person_id', $student->id)->first()) btn-warning @else btn-light @endif btn-sm"
                            title="{{ __('common.Absent')}}">
                            <i class="nav-main-link-icon si si-logout mr-1"></i> {{ __('common.Absent')}}
                        </a>
                    </td>
                    @endforeach
            </tbody>
            @endforeach

        </table>

    </div>
</div>
@endforeach
@endif
@endif

@if(@$event->teachers)
@can('update events')
@if (@$action == 'readonly')
<div class="block block-rounded block-fx-pop">
    <div class="block-header block-header-default">
        <h3 class="block-title">{{ __('common.Manager') }} </h3>
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
                    <th style="border-top: none;" class="d-none d-md-table-cell">{{ __('common.Company') }}</th>
                    <th style="border-top: none;" class="d-none d-md-table-cell">{{ __('common.Status') }}</th>
                    <th class="text-right d-none d-sm-table-cell" style="border-top: none;">

                    </th>
                </tr>
            </thead>
            @foreach(@$event->teachers as $person)
            <tbody class="js-table-sections-header">
                <tr>
                    <td class="text-center">
                        <i class="fa fa-angle-right text-muted"></i>
                    </td>
                    <td>
                        <div class="py-1">
                            <a href="{{ action('PersonController@show', $person->id) }}">
                                {{ $person->first_name }} {{ $person->last_name }}
                                @if($person->locations->count() == 0)
                                <span class="badge badge-danger">
                                    {{ __('common.MissingAddress') }}
                                </span>
                                @endif
                            </a>
                        </div>
                    </td>

                    <td class="d-none d-md-table-cell">
                        <div class="py-1">
                            {{ $person->company_name }}
                        </div>
                    </td>
                    <td class="d-none d-md-table-cell">
                        <div class="py-1">
                            @if($person->pivot->confirmed > 0)
                            <button class="btn btn-success btn-sm">{{ __('common.Confirmed') }}</button>
                            @elseif($person->pivot->assigned > 0)
                            <button class="btn btn-info btn-sm">{{ __('common.Assigned') }}</button>
                            @elseif($person->pivot->applied > 0)
                            <button class="btn btn-primary btn-sm">{{ __('common.Applied') }}</button>
                            @elseif($person->pivot->applied < 0 ) <button class="btn btn-warning btn-sm">{{
                                __('common.Declined') }}</button>
                                @endif
                        </div>
                    </td>
                    <td class="d-none d-sm-table-cell text-right">
                        @if(($person->pivot->applied == 1 && $person->pivot->assigned != 1))
                        <a href="{{action('EventController@decline', [$event->id, $person->id])}}"
                            class="btn btn-warning btn-sm" title="{{ __('common.Decline')}}">
                            <i class="nav-main-link-icon si si-action-undo"></i>
                        </a>
                        <a href="{{action('EventController@assign', [$event->id, $person->id])}}"
                            class="btn btn-info btn-sm" title="{{ __('common.Assign')}}">
                            <i class="nav-main-link-icon si si-action-redo"></i>
                        </a>
                        @elseif(($person->pivot->applied < 1)) <a
                            href="{{action('EventController@apply', [$event->id, $person->id])}}"
                            class="btn btn-primary btn-sm" title="{{ __('common.Apply')}}">
                            <i class="nav-main-link-icon si si-action-redo"></i>
                            </a>
                            @elseif(($person->pivot->applied == 1 && $person->pivot->confirmed != 1))
                            <a href="{{action('EventController@reassign', [$person->id, $event->id])}}"
                                class="btn btn-primary btn-sm" title="{{ __('common.Unassign')}}">
                                <i class="nav-main-link-icon si si-action-undo"></i>
                            </a>
                            <a href="{{action('EventController@confirm', [$person->id, $event->id])}}"
                                class="btn btn-success btn-sm" title="{{ __('common.Confirm')}}">
                                <i class="nav-main-link-icon si si-action-redo"></i>
                            </a>
                            @elseif(($person->pivot->confirmed == 1))
                            <a href="{{action('EventController@confirm', [$person->id, $event->id])}}"
                                class="btn btn-danger btn-sm" title="{{ __('common.Unassign')}}">
                                <i class="nav-main-link-icon si si-action-undo"></i>
                            </a>
                            @endif

                    </td>
                </tr>
            </tbody>

            <tbody class="font-size-sm">
                <tr>
                    <td class="text-center"></td>
                    <td colspan="15">
                        {{ $person->description }}
                    </td>
            </tbody>
            @endforeach
        </table>
    </div>
</div>
@endif
@endcan
@endif


@if($action == 'index')
@if(@$current_event)
<div class="row">
    <div class="col-lg-9">
        @endif

        <!-- Table Sections (.js-table-sections class is initialized in Helpers.tableToolsSections()) -->
        <div class="block block-rounded block-fx-pop block-themed">

            <div class="block-header block-header-default bg-primary-darker">
                <h3 class="block-title">{{ __('common.Events') }}</h3>
                <div class="block-options">
                    <div class="btn-group">
                        @can('read events')
                        <a class="btn btn-light btn-sm" href="javascript:void(0)" onclick="getEvents();">
                            <i class="si si-share-alt mr-1"></i> {{ __('common.Events') }} XHR</span>
                        </a>
                        <a class="btn btn-light btn-sm" href="{{action('ExportController@events')}}">
                            <i class="si si-share-alt mr-1"></i> {{ __('common.Excel') }}</span>
                        </a>
                        @endcan
                        @can('create events')
                        <a class="btn btn-primary btn-sm" href="{{action('EventController@create')}}">
                            <i class="si si-user mr-1"></i> {{ __('common.Event') }} <span class="text-lowercase">{{
                                __('common.Add') }}</span>
                        </a>
                        @endcan
                    </div>
                </div>

            </div>

            <div class="block-content">
                <form action="{{action('EventController@index')}}" method="post">
                    <div class="row mb-4">
                        <div class="col-xl-2">
                            <div class="form-group">
                                <select class="form-control" id="period_id" name="period_id"
                                    title="{{ __('common.Period') }}" onchange="this.form.submit()">
                                    <option value="">{{ __('common.Period') }}</option>
                                    @if(@$periods)
                                    @foreach(@$periods as $period)
                                    <option value="{{ $period->id }}" {{ (@$selected_period==$period->id ? 'selected':'')
                                    }}>{{ $period->name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="form-group">
                                <select class="form-control" id="study_id" name="study_id"
                                    title="{{ __('common.Study') }}" @if(@!$selected_period || @!$studies->count())
                                    disabled @endif
                                    onchange="this.form.submit()">
                                    <option value="">{{ __('common.Study') }} </option>
                                    @if(@$selected_period)
                                    @foreach($studies as $study)
                                    <option value="{{ $study->id }}"
                                        {{ (@$selected_study==$study->id ? 'selected':'') }}>{{
                                    $study->name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-2">
                            <div class="form-group">
                                <select class="form-control" id="course_id" name="course_id"
                                    title="{{ __('common.Course') }}" @if(@!$selected_study) disabled @endif
                                    onchange="this.form.submit()">
                                    <option value="">{{ __('common.Course') }}</option>
                                    @if(@$selected_study)
                                    @foreach($courses as $course)
                                    <option value="{{ $course->id }}"
                                        {{ (@$selected_course==$course->id ? 'selected':'') }}>{{ $course->number }}
                                        {{ $course->name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-2">
                            <div class="form-group">
                                <select {{ $action }} class="form-control" id="status" name="status"
                                    title="{{ __('common.Status') }}" onchange="this.form.submit()">>
                                    <option value="">{{ __('common.Status') }}</option>
                                    <option value="applied" {{ (@$status== 'applied' ? 'selected':'') }}>
                                        {{ __('common.Applied') }}</option>
                                    <option value="assigned" {{ (@$status== 'assigned' ? 'selected':'') }}>
                                        {{ __('common.Assigned') }}</option>
                                    <option value="confirmed" {{ (@$status== 'confirmed' ? 'selected':'') }}>
                                        {{ __('common.Confirmed') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-2">
                            <div class="form-group">
                                <select {{ $action }} class="form-control" id="timeline" name="timeline"
                                    title="{{ __('common.Date') }}" onchange="this.form.submit()">>
                                    <option value="">{{ __('common.Date') }}</option>
                                    <option value="current" {{ (@$timeline == 'current' ? 'selected':'') }}>
                                        {{ __('common.Current') }}</option>
                                    <option value="done" {{ (@$timeline == 'done' ? 'selected':'') }}>
                                        {{ __('common.Done') }}</option>
                                    <option value="upcoming" {{ (@$timeline == 'upcoming' ? 'selected':'') }}>
                                        {{ __('common.Upcoming') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-1">
                            <!-- Pagination -->
                            @include('include.pagination')
                            <!-- Pagination END -->
                        </div>
                    </div>
                </form>
                @if($events)
                @if (@$events->count())
                <table class="js-table-sections table table-hover table-vcenter">
                    <thead>
                        <tr>
                            <th></th>
                            <th>
                                @sortablelink('name', __('common.Name'))
                            </th>
                            <th class="d-none d-xl-table-cell">
                                @sortablelink('room', __('common.Room'))
                            </th>
                            <th class="d-none d-xl-table-cell">
                                @sortablelink('start_date', __('common.StartDate'))
                            </th>
                            <th class="d-none d-xl-table-cell">
                                @sortablelink('end_date', __('common.EndDate'))
                            </th>
                            <th class="d-none d-xl-table-cell">
                                @sortablelink('person', __('common.Confirmed'))
                            </th>

                            <th class="text-right d-none d-md-table-cell">

                            </th>
                        </tr>
                    </thead>
                    @csrf

                    @foreach($events as $event)

                    <tbody class="js-table-sections-header">
                        <tr>
                            <td class="text-center">
                                <i class="fa fa-angle-right text-muted"></i>
                            </td>
                            <td>
                                <div class="py-1">
                                    <a href="{{action('EventController@show', $event->id)}}">{{ $event->alias }} </a>
                                </div>
                            </td>
                            <td class="d-none d-xl-table-cell">
                                <div class="py-1">
                                    {{ $event->room->name }}
                                </div>
                            </td>
                            <td class="d-none d-xl-table-cell">
                                <div class="py-1">
                                    {{ Carbon::parse($event->start_date)->formatLocalized('%d. %B %y')}}
                                </div>
                            </td>
                            <td class="d-none d-xl-table-cell">
                                <div class="py-1">
                                    {{ Carbon::parse($event->end_date)->formatLocalized('%d. %B %y')}}
                                </div>
                            </td>
                            <td class="d-none d-xl-table-cell">
                                <div class="py-1">
                                    @if($event->assigned()->count() > 0)
                                    @foreach($event->assigned() as $assigned)
                                    <a href="/persons/{{$assigned->id}}" title="{{ $assigned->first_name }}"
                                        target="_blank" class="btn btn-light btn-sm">
                                        <i class="si si-user mr-1"></i>
                                        {{ $assigned->first_name }} {{ $assigned->last_name }}
                                    </a>
                                    @endforeach
                                    @else
                                    <span class="btn btn-light btn-sm">
                                        <i class="si si-bell mr-1"></i>
                                        {{ __('common.No') }}
                                        </a>
                                        @endif
                                </div>
                            </td>


                            <td class="d-none d-md-table-cell text-right">
                                @can('read events')
                                <form action="{{action('EventController@index')}}" method="post" class="d-inline">
                                    @csrf
                                    <input name="_method" type="hidden" value="GET">
                                    <input name="current_course_id" type="hidden" value="{{$event->course->id}}">
                                    <input name="course_id" type="hidden" value="{{$event->course->id}}">
                                    <input name="event_id" type="hidden" value="{{$event->id}}">

                                    @if($event->assigned()->count() > 0)
                                    <button type="submit"
                                        class="btn btn-sm btn-{{ (@$event->assigned()->count() > 0) ? 'success' : 'light'}}">
                                        <i class="nav-main-link-icon si si-users mr-2"></i>
                                        {{ $event->persons->count()}}
                                    </button>
                                    @elseif($event->applied()->count() > 0)
                                    <button type="submit"
                                        class="btn btn-sm btn-{{ (@$event->applied()->count() > 0) ? 'warning' : 'light'}}">
                                        <i class="nav-main-link-icon si si-users mr-2"></i>
                                        {{ $event->persons->count()}}
                                    </button>
                                    @else
                                    <button type="submit" class="btn btn-sm btn-light">
                                        <i class="nav-main-link-icon si si-users mr-2"></i>
                                        {{ $event->persons->count()}}
                                    </button>
                                    @endif
                                </form>
                                @endcan

                                @can('update events')
                                <a href="{{action('EventController@edit', $event->id)}}" class="btn btn-primary btn-sm">
                                    <i class="nav-main-link-icon si si-pencil"></i>
                                </a>
                                @endcan

                                @can('delete events')
                                <form action="{{action('EventController@destroy', $event->id)}}" method="post"
                                    class="d-inline">
                                    @csrf
                                    <input name="_method" type="hidden" value="DELETE">

                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="nav-main-link-icon si si-trash"></i>
                                    </button>
                                </form>
                                @endcan

                                @if(@$event->script_id)
                                <a href="{{action('ScriptController@show', $event->script_id)}}"
                                    class="btn btn-dark btn-sm">
                                    <i class="nav-main-link-icon si si-notebook"></i>
                                </a>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                    <tbody class="font-size-sm">
                        <tr>
                            <td class="text-center"></td>
                            <td colspan="10">
                                <p>{{ $event->description }}</p>
                                <h4>{{ __('common.Persons')}}</h4>
                                <ul>
                                    @foreach($event->persons as $person)
                                    <li>{{ $person->last_name }} {{ $person->first_name }}</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>

                    </tbody>
                    @endforeach
                </table>
                @endif
                @endif

            </div>
            @if($events)
            @if ($events->total() > $events->perPage())
            <div
                class="block-content block-content-full block-content-sm bg-body-light d-flex justify-content-center align-content-center">
                {!! $events->appends(\Request::except('page'))->render() !!}
            </div>
            @endif
            @endif
        </div>



        @if(@$current_event)
    </div>
    <div class="col-lg-3">
        <form action="{{action('EventController@invite')}}" method="post">
            <input name="_method" type="hidden" value="POST">
            <input name="event_id" value="{{$current_event->id}}" type="hidden">

            @csrf
            <div class="block block-rounded block-fx-shadow block-themed">
                <div class="block-header bg-primary-darker">
                    <h3 class="block-title">{{ __('common.Invite') }}</h3>
                </div>
                <div class="block-content">
                    <!-- If you put a checkbox in thead section, it will automatically toggle all tbody section checkboxes -->
                    <table class="js-table-checkable table table-hover table-vcenter js-table-checkable-enabled">
                        <tbody>

                            @foreach($current_event->persons as $person)

                            @section('someSection')
                            @if ($person->events()->wherePivot('event_id', $current_event->id)->first()->pivot->assigned
                            == 1)
                            {{ $status = 'success' }}
                            @elseif ($person->events()->wherePivot('event_id',
                            $current_event->id)->first()->pivot->applied == 1)
                            {{ $status = 'warning' }}
                            @else
                            {{ $status = 'light' }}
                            @endif
                            @endsection

                            <tr>
                                <td>
                                    <div class="custom-control custom-checkbox custom-control-light d-inline-block">
                                        <input type="checkbox" disabled checked class="custom-control-input"
                                            id="invited_{{$person->id}}" name="invited_{{$person->id}}">
                                        <label class="custom-control-label text-muted pl-3"
                                            for="invited_{{$person->id}}" title="{{ __('common.Invited') }}">
                                            {{ $person->last_name }} {{ $person->first_name }}
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{action('EventController@assign', [$person->id, $current_event->id])}}"
                                        class="btn btn-sm btn-{{ ($status) ? $status : 'light' }} js-tooltip-enabled"
                                        data-toggle="tooltip" data-original-title="{{ __('common.Confirm') }}"
                                        title="{{ __('common.Confirm') }}">
                                        <i class="fa fa-check"></i>
                                    </a>
                                </td>

                            </tr>
                            @endforeach

                            @foreach($event_persons as $person)
                            <tr>
                                <td colspan="2">
                                    <div class="custom-control custom-checkbox custom-control-primary d-inline-block">
                                        <input type="checkbox" class="custom-control-input" id="person_{{$person->id}}"
                                            name="persons[]" value="{{$person->id}}" title="{{ __('common.Invite') }}">
                                        <label class="custom-control-label pl-3" for="person_{{$person->id}}"
                                            title="{{ __('common.Invite') }}">
                                            {{ $person->last_name }} {{ $person->first_name }}
                                        </label>
                                    </div>
                                </td>

                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

                <div class="block-content block-content-full block-content-sm bg-body-light pt-4 pb-4">
                    <button type="submit" class="btn btn-dark btn-block text-left">
                        <i class="nav-main-link-icon si si-check mr-2"></i>
                        {{ __('common.Persons') }} <span class="text-lowercase">{{ __('common.Invite') }}</span>
                    </button>

                    <a class="btn btn-warning btn-block mt-3 text-left" href="/events">
                        <i class="nav-main-link-icon si si-action-undo mr-2"></i>
                        {{ __('common.Cancel') }}
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

@endif
@endif
<!-- END Table Sections -->
</div>
<!-- END Page Content -->

@endsection