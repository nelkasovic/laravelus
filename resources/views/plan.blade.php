@extends('layouts.app')

@section('content')
<!-- Page Content -->
<div class="content content-full">
    <div class="row">
        <!-- Exclusions -->
        @if(@$exclusions)
        @if(@$exclusions->count())
        <div class="col-xl-12">
            <!-- If a room has exclusions -->
            @include('include.exclusions')
            <!-- ENDIF -->
        </div>
        @endif
        @endif
        <!-- Plan parameters -->
        <div class="col-xl-12">
            <form action="{{action('EventController@propose')}}" method="post">
                @csrf
                <input name="_method" type="hidden" value="POST">
                <div
                    class="block block-rounded block-fx-pop block-themed animated fadeIn @if(@$suggestions) block-mode-hidden @endif">
                    <div class="block-header block-header-default bg-gd-aqua">
                        <h3 class="block-title">
                            @if(@$events)
                            {{ @$events->count()}} {{ __('common.Events') }} <span class="text-lowercase">{{
                                __('common.Planned') }} | {{ @$weekdays->planned }}
                                {{ __('common.Intended') }} </span>
                            @else
                            {{ __('common.Events') }}
                            @endif
                        </h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option"
                                data-action="fullscreen_toggle"></button>
                            <button type="button" class="btn-block-option" data-toggle="block-option"
                                data-action="pinned_toggle">
                                <i class="si si-pin"></i>
                            </button>
                            <button type="button" class="btn-block-option" data-toggle="block-option"
                                data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                            <button type="button" class="btn-block-option" data-toggle="block-option"
                                data-action="content_toggle"></button>
                            <button type="button" class="btn-block-option" data-toggle="block-option"
                                data-action="close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">

                        <div class="row">
                            <div class="col-xl-2">
                                <div class="form-group">
                                    <label class="text-muted mb-0 font-size-sm" for="study_id"><small>{{
                                            __('common.Period') }}</small></label>

                                    <select class="form-control" id="period_id" name="period_id"
                                        title="{{ __('common.Period') }}" onchange="this.form.submit()">
                                        <option value="">{{ __('common.Period') }} {{ __('common.Period') }}</option>
                                        @if(@$periods)
                                        @foreach(@$periods as $period)
                                        <option value="{{ $period->id }}" {{ (@$period_id==$period->id ? 'selected':'')
                                            }}>{{ $period->name }}
                                        </option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-5">
                                <div class="form-group">
                                    <label class="text-muted mb-0 font-size-sm" for="study_id"><small>{{
                                            __('common.Study') }}</small></label>

                                    <select class="form-control" id="study_id" name="study_id"
                                        title="{{ __('common.Study') }}" onchange="this.form.submit();" @if(
                                        @!$period_id || !@$studies->count()) disabled @endif>
                                        <option selected value="">{{ __('common.Select') }}</option>
                                        @if(@$period_id && $studies->count())
                                        @foreach($studies as $study)
                                        <option value="{{ $study->id }}" @if(@$study_id==$study->id) selected
                                            @endif>{{ $study->alias }} | {{ $study->number }} | {{ $study->name }}
                                        </option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-xl-5">
                                <div class="form-group">
                                    <label class="text-muted mb-0 font-size-sm" for="course_id"><small>{{
                                            __('common.Course') }}</small></label>
                                    <select class="form-control" id="course_id" name="course_id"
                                        title="{{ __('common.Course') }}" @if(@!$study_id || @!$period_id ||
                                        @!$courses->count()) disabled @endif onchange="this.form.submit();">
                                        <option selected value="">{{ __('common.Select') }}</option>
                                        @if(@$study_id && @$period_id && $courses->count())
                                        @foreach($courses as $course)
                                        <option value="{{ $course->id }}" @if(@$course_id==$course->id) selected
                                            @endif>{{ $course->number }} | {{ $course->name }} </option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-xl-2">
                                <div class="form-group">
                                    <label class="text-muted mb-0 font-size-sm" for="room_id"><small>{{
                                            __('common.Room') }}</small></label>
                                    <select class="form-control" id="room_id" name="room_id"
                                        title="{{ __('common.Room') }}" @if(@!$course_id || @!$period_id || @!$study_id)
                                        disabled @endif onchange="this.form.submit();">
                                        <option selected value="">{{ __('common.Select') }}</option>
                                        @if(@$study_id && @$period_id && @$course_id && @$rooms)
                                        @foreach(@$rooms as $room)
                                        <option value="{{ $room->id }}" @if(@$room_id==$room->id) selected
                                            @endif>{{ $room->name }} </option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="text-muted mb-0 font-size-sm" for="group_id"><small>{{
                                            __('common.Group') }}</small></label>
                                    <select @if(@!$course_id || @!$period_id || @!$study_id || @!$room_id) disabled
                                        @endif class="form-control" id="group_id" name="group_id"
                                        title="{{ __('common.Group') }}">
                                        <option value="all">{{ __('common.AllGroups') }}</option>
                                        @if(@$study_id && @$period_id && @$course_id && @$room_id && @$groups)
                                        @foreach($groups as $group)
                                        <option value="{{ $group->id }}" {{ (old('group_id')==$group->id || $group->id
                                            == @$group_id ? 'selected':'') }}>
                                            {{ $group->alias }} ({{ $group->persons->count() }})</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label class="text-muted mb-0 font-size-sm" for="repeats"><small>{{
                                            __('common.Occurrences') }}</small></label>
                                    <input type="number" steps="1" min="1" max="100" class="form-control" id="repeats"
                                        name="repeats" placeholder="{{ __('common.Count') }}"
                                        value="{{ (old('repeats')) ? old('repeats') : 5 }}">
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="text-muted mb-0 font-size-sm" for="daterange"><small>{{
                                            __('common.DateRange') }}</small></label>
                                    <div class="input-daterange input-group" data-date-format="dd.mm.yyyy"
                                        data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                        <input type="text" class="form-control text-left" id="start_date"
                                            name="start_date" data-date-default-date="now"
                                            placeholder="{{ __('common.Date') }} {{ __('common.From') }}"
                                            data-week-start="1" data-autoclose="true" data-today-highlight="true"
                                            value="{{ (@$next_date) ? Carbon::parse(@$next_date)->format('d.m.Y') : (old('start_date')) }}">
                                        <div class="input-group-prepend input-group-append">
                                            <span class="input-group-text font-w600">
                                                <i class="fa fa-fw fa-arrow-right"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control text-left" id="end_date" name="end_date"
                                            placeholder="{{ __('common.Date') }} {{ __('common.To') }}"
                                            data-week-start="1" data-autoclose="true" data-today-highlight="true"
                                            value="{{ (@$next_date) ? Carbon::parse(@$next_date)->addMonths(1)->format('d.m.Y') : (old('end_date')) }}">
                                    </div>
                                </div>
                            </div>

                            @if(@$period_id && @$study_id && @$course_id && @$room_id)
                            <div class="col-lg-12">
                                <hr>
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('common.Monday') }}</label>
                                            <div
                                                class="custom-control custom-checkbox custom-control-lg custom-control-light mb-2">
                                                <input type="radio" class="custom-control-input" name="days[monday]"
                                                    id="monday_no" @if(@$weekdays->monday == 0) checked @endif
                                                value="0">
                                                <label class="custom-control-label" for="monday_no">
                                                    {{ __('common.No') }}
                                                </label>
                                            </div>
                                            <div
                                                class="custom-control custom-checkbox custom-control-lg custom-control-warning mb-2">
                                                <input type="radio" class="custom-control-input" name="days[monday]"
                                                    id="monday_am" @if(@$weekdays->monday == 1) checked @endif
                                                value="1">
                                                <label class="custom-control-label" for="monday_am">
                                                    {{ __('common.AM') }}
                                                </label>
                                            </div>
                                            <div
                                                class="custom-control custom-checkbox custom-control-lg custom-control-info mb-2">
                                                <input type="radio" class="custom-control-input" name="days[monday]"
                                                    id="monday_pm" @if(@$weekdays->monday == 2) checked @endif
                                                value="2">
                                                <label class="custom-control-label" for="monday_pm">
                                                    {{ __('common.PM') }}
                                                </label>
                                            </div>
                                            <div
                                                class="custom-control custom-checkbox custom-control-lg custom-control-success mb-2">
                                                <input type="radio" class="custom-control-input" name="days[monday]"
                                                    id="monday_wd" @if(@$weekdays->monday == 3) checked @endif
                                                value="3">
                                                <label class="custom-control-label" for="monday_wd">
                                                    {{ __('common.WholeDay') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('common.Tuesday') }}</label>
                                            <div
                                                class="custom-control custom-checkbox custom-control-lg custom-control-light mb-2">
                                                <input type="radio" class="custom-control-input" name="days[tuesday]"
                                                    id="tuesday_no" @if(@$weekdays->tuesday == 0) checked @endif
                                                value="0">
                                                <label class="custom-control-label" for="tuesday_no">
                                                    {{ __('common.No') }}
                                                </label>
                                            </div>
                                            <div
                                                class="custom-control custom-checkbox custom-control-lg custom-control-warning mb-2">
                                                <input type="radio" class="custom-control-input" name="days[tuesday]"
                                                    id="tuesday_am" @if(@$weekdays->tuesday == 1) checked @endif
                                                value="1">
                                                <label class="custom-control-label" for="tuesday_am">
                                                    {{ __('common.AM') }}
                                                </label>
                                            </div>
                                            <div
                                                class="custom-control custom-checkbox custom-control-lg custom-control-info mb-2">
                                                <input type="radio" class="custom-control-input" name="days[tuesday]"
                                                    id="tuesday_pm" @if(@$weekdays->tuesday == 2) checked @endif
                                                value="2">
                                                <label class="custom-control-label" for="tuesday_pm">
                                                    {{ __('common.PM') }}
                                                </label>
                                            </div>
                                            <div
                                                class="custom-control custom-checkbox custom-control-lg custom-control-success mb-2">
                                                <input type="radio" class="custom-control-input" name="days[tuesday]"
                                                    id="tuesday_wd" @if(@$weekdays->tuesday == 3) checked @endif
                                                value="3">
                                                <label class="custom-control-label" for="tuesday_wd">
                                                    {{ __('common.WholeDay') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('common.Wednesday') }}</label>
                                            <div
                                                class="custom-control custom-checkbox custom-control-lg mb-2 custom-control-light">
                                                <input type="radio" class="custom-control-input" name="days[wednesday]"
                                                    id="wednesday_no" @if(@$weekdays->wednesday == 0) checked @endif
                                                value="0">
                                                <label class="custom-control-label" for="wednesday_no">
                                                    {{ __('common.No') }}
                                                </label>
                                            </div>
                                            <div
                                                class="custom-control custom-checkbox custom-control-lg custom-control-warning mb-2">
                                                <input type="radio" class="custom-control-input" name="days[wednesday]"
                                                    id="wednesday_am" @if(@$weekdays->wednesday == 1) checked @endif
                                                value="1">
                                                <label class="custom-control-label" for="wednesday_am">
                                                    {{ __('common.AM') }}
                                                </label>
                                            </div>
                                            <div
                                                class="custom-control custom-checkbox custom-control-lg custom-control-info mb-2">
                                                <input type="radio" class="custom-control-input" name="days[wednesday]"
                                                    id="wednesday_pm" @if(@$weekdays->wednesday == 2) checked @endif
                                                value="2">
                                                <label class="custom-control-label" for="wednesday_pm">
                                                    {{ __('common.PM') }}
                                                </label>
                                            </div>
                                            <div
                                                class="custom-control custom-checkbox custom-control-lg custom-control-success mb-2">
                                                <input type="radio" class="custom-control-input" name="days[wednesday]"
                                                    id="wednesday_wd" @if(@$weekdays->wednesday == 3) checked @endif
                                                value="3">
                                                <label class="custom-control-label" for="wednesday_wd">
                                                    {{ __('common.WholeDay') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('common.Thursday') }}</label>
                                            <div
                                                class="custom-control custom-checkbox custom-control-lg mb-2 custom-control-light">
                                                <input type="radio" class="custom-control-input" name="days[thursday]"
                                                    id="thursday_no" @if(@$weekdays->thursday == 0) checked @endif
                                                value="0">
                                                <label class="custom-control-label" for="thursday_no">
                                                    {{ __('common.No') }}
                                                </label>
                                            </div>
                                            <div
                                                class="custom-control custom-checkbox custom-control-lg custom-control-warning mb-2">
                                                <input type="radio" class="custom-control-input" name="days[thursday]"
                                                    id="thursday_am" @if(@$weekdays->thursday == 1) checked @endif
                                                value="1">
                                                <label class="custom-control-label" for="thursday_am">
                                                    {{ __('common.AM') }}
                                                </label>
                                            </div>
                                            <div
                                                class="custom-control custom-checkbox custom-control-lg custom-control-info mb-2">
                                                <input type="radio" class="custom-control-input" name="days[thursday]"
                                                    id="thursday_pm" @if(@$weekdays->thursday == 2) checked @endif
                                                value="2">
                                                <label class="custom-control-label" for="thursday_pm">
                                                    {{ __('common.PM') }}
                                                </label>
                                            </div>
                                            <div
                                                class="custom-control custom-checkbox custom-control-lg custom-control-success mb-2">
                                                <input type="radio" class="custom-control-input" name="days[thursday]"
                                                    id="thursday_wd" @if(@$weekdays->thursday == 3) checked @endif
                                                value="3">
                                                <label class="custom-control-label" for="thursday_wd">
                                                    {{ __('common.WholeDay') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('common.Friday') }}</label>
                                            <div
                                                class="custom-control custom-checkbox custom-control-lg mb-2 custom-control-light">
                                                <input type="radio" class="custom-control-input" name="days[friday]"
                                                    id="friday_no" @if(@$weekdays->friday == 0) checked @endif
                                                value="0">
                                                <label class="custom-control-label" for="friday_no">
                                                    {{ __('common.No') }}
                                                </label>
                                            </div>
                                            <div
                                                class="custom-control custom-checkbox custom-control-lg custom-control-warning mb-2">
                                                <input type="radio" class="custom-control-input" name="days[friday]"
                                                    id="friday_am" @if(@$weekdays->friday == 1) checked @endif
                                                value="1">
                                                <label class="custom-control-label" for="friday_am">
                                                    {{ __('common.AM') }}
                                                </label>
                                            </div>
                                            <div
                                                class="custom-control custom-checkbox custom-control-lg custom-control-info mb-2">
                                                <input type="radio" class="custom-control-input" name="days[friday]"
                                                    id="friday_pm" @if(@$weekdays->friday == 2) checked @endif
                                                value="2">
                                                <label class="custom-control-label" for="friday_pm">
                                                    {{ __('common.PM') }}
                                                </label>
                                            </div>
                                            <div
                                                class="custom-control custom-checkbox custom-control-lg custom-control-success mb-2">
                                                <input type="radio" class="custom-control-input" name="days[friday]"
                                                    id="friday_wd" @if(@$weekdays->friday == 3) checked @endif
                                                value="3">
                                                <label class="custom-control-label" for="friday_wd">
                                                    {{ __('common.WholeDay') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('common.Saturday') }}</label>
                                            <div
                                                class="custom-control custom-checkbox custom-control-lg mb-2 custom-control-light">
                                                <input type="radio" class="custom-control-input" name="days[saturday]"
                                                    id="saturday_no" @if(@$weekdays->saturday == 0) checked @endif
                                                value="0">
                                                <label class="custom-control-label" for="saturday_no">
                                                    {{ __('common.No') }}
                                                </label>
                                            </div>
                                            <div
                                                class="custom-control custom-checkbox custom-control-lg custom-control-warning mb-2">
                                                <input type="radio" class="custom-control-input" name="days[saturday]"
                                                    id="saturday_am" @if(@$weekdays->saturday == 1) checked @endif
                                                value="1">
                                                <label class="custom-control-label" for="saturday_am">
                                                    {{ __('common.AM') }}
                                                </label>
                                            </div>
                                            <div
                                                class="custom-control custom-checkbox custom-control-lg custom-control-info mb-2">
                                                <input type="radio" class="custom-control-input" name="days[saturday]"
                                                    id="saturday_pm" @if(@$weekdays->saturday == 2) checked @endif
                                                value="2">
                                                <label class="custom-control-label" for="saturday_pm">
                                                    {{ __('common.PM') }}
                                                </label>
                                            </div>
                                            <div
                                                class="custom-control custom-checkbox custom-control-lg custom-control-success mb-2">
                                                <input type="radio" class="custom-control-input" name="days[saturday]"
                                                    id="saturday_wd" @if(@$weekdays->saturday == 3) checked @endif
                                                value="3">
                                                <label class="custom-control-label" for="saturday_wd">
                                                    {{ __('common.WholeDay') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <label class="mb-2">{{ __('common.Sunday') }}</label>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <div
                                                class="custom-control custom-checkbox custom-control-lg mb-2 custom-control-light">
                                                <input type="radio" class="custom-control-input" name="days[sunday]"
                                                    id="sunday_no" @if(@$weekdays->sunday == 0) checked @endif
                                                value="0">
                                                <label class="custom-control-label" for="sunday_no">
                                                    {{ __('common.No') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <div
                                                class="custom-control custom-checkbox custom-control-lg custom-control-warning mb-2">
                                                <input type="radio" class="custom-control-input" name="days[sunday]"
                                                    id="sunday_am" @if(@$weekdays->sunday == 1) checked @endif
                                                value="1">
                                                <label class="custom-control-label" for="sunday_am">
                                                    {{ __('common.AM') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <div
                                                class="custom-control custom-checkbox custom-control-lg custom-control-info mb-2">
                                                <input type="radio" class="custom-control-input" name="days[sunday]"
                                                    id="sunday_pm" @if(@$weekdays->sunday == 2) checked @endif
                                                value="2">
                                                <label class="custom-control-label" for="sunday_pm">
                                                    {{ __('common.PM') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <div
                                                class="custom-control custom-checkbox custom-control-lg custom-control-success mb-2">
                                                <input type="radio" class="custom-control-input" name="days[sunday]"
                                                    id="sunday_wd" @if(@$weekdays->sunday == 3) checked @endif
                                                value="3">
                                                <label class="custom-control-label" for="sunday_wd">
                                                    {{ __('common.WholeDay') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <div
                                                class="custom-control custom-checkbox custom-control-inline custom-control-lg custom-control-success">
                                                <input type="checkbox" class="custom-control-input" id="free"
                                                    name="free" value="1" checked>
                                                <label class="custom-control-label" for="free"><span class="pl-2">{{
                                                        __('common.OnlyFreeBlocks') }}</span></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>

                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body-light text-right">
                        <div class="row">
                            <div class="col-lg-12 text-right">
                                <a class="btn btn-warning" href="{{action('EventController@plan')}}">
                                    <i class="fa fa-trash mr-2"></i>{{ __('common.Reset') }}
                                </a>

                                <button type="submit" class="btn btn-primary create-suggestions" @if(@$study_id &&
                                    @$course_id && @$room_id) data-study={{ $study_id }} @else disabled @endif>
                                    <i class="fa fa-check mr-2"></i>{{ __('common.CreateSuggestions') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        @if(@$suggestions)
        <!-- Plan suggestions -->
        <div class="col-xl-12">
            <!-- Main Content -->
            <div class="block block-rounded block-fx-pop block-themed animated fadeIn">
                <div class="block-header block-header-default">
                    <h3 class="block-title">
                        {{ (@$suggestions) ? @$suggestions->count() : '' }} {{ __('common.Suggestions') }}
                        @if(@$suggestions) {{ __('common.Between') }} {{ old('start_date') }} {{ __('common.And') }}
                        {{ old('end_date') }} @endif
                    </h3>

                    @if(!@$suggestions)
                    <div class="block-options">
                        <div class="block-options-item text-light">{{ __('common.SelectParameters') }} <span
                                class="text-lowercase">({{ __('common.Left') }})!</span></div>
                    </div>
                    @endif
                </div>
                <form action="{{action('EventController@accept')}}" method="post">
                    @csrf

                    <input name="_method" type="hidden" value="POST">
                    <input type="hidden" name="course_id" value="{{ old('course_id') }}">
                    <input type="hidden" name="room_id" value="{{ old('room_id') }}">
                    <input type="hidden" name="study_id" value="{{ old('study_id') }}">
                    <input type="hidden" name="period_id" value="{{ old('period_id') }}">
                    <input type="hidden" name="start_date" value="{{ old('start_date') }}">
                    <input type="hidden" name="end_date" value="{{ old('end_date') }}">
                    <input type="hidden" name="days[monday]" value="{{ $weekdays->monday }}">
                    <input type="hidden" name="days[tuesday]" value="{{ $weekdays->tuesday }}">
                    <input type="hidden" name="days[wednesday]" value="{{ $weekdays->wednesday }}">
                    <input type="hidden" name="days[thursday]" value="{{ $weekdays->thursday }}">
                    <input type="hidden" name="days[friday]" value="{{ $weekdays->friday }}">
                    <input type="hidden" name="days[saturday]" value="{{ $weekdays->saturday }}">
                    <input type="hidden" name="days[sunday]" value="{{ $weekdays->sunday }}">
                    <input type="hidden" name="free" value="{{ old('free') }}">
                    <input type="hidden" name="repeats" value="{{ old('repeats') }}">

                    <div class="block-content">

                        <div class="row">
                            <div class="col-lg-4">
                                    <label class="text-muted mb-0 font-size-sm" for="group_id"><small>{{
                                            __('common.Group') }}</small></label>
                                <select @if(@!$suggestions || @!$groups) disabled @endif class="form-control"
                                    id="group_id" name="group_id" title="{{ __('common.Group') }}">
                                    @if(@$suggestions && @$groups)
                                    @foreach($groups as $group)
                                    <option value="{{ $group->id }}" {{ (old('group_id')==$group->id || $group->id ==
                                        @$group_id ? 'selected':'') }}>
                                        {{ $group->alias }} ({{ $group->persons->count() }})</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="text-muted mb-0 font-size-sm" for="start_am"><small>
                                    {{ __('common.AM') }} <span class="text-lowercase">{{ __('common.StartTime') }}</small></label>
                                    <input @if(!@$suggestions) disabled @endif type="text"
                                        class="js-masked-time form-control" id="start_am" name="start_am"
                                        placeholder="{{ __('common.Time') }} (08:00)"
                                        value="{{ (old('start_am')) ? old('start_am') : '08:00' }}">
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="text-muted mb-0 font-size-sm" for="end_am"><small>
                                            {{ __('common.AM') }} <span class="text-lowercase">{{ __('common.EndTime') }}    
                                    </small></label>
                                    <input @if(!@$suggestions) disabled @endif type="text"
                                        class="js-masked-time form-control" id="end_am" name="end_am"
                                        placeholder="{{ __('common.Time') }} (12:00)"
                                        value="{{ (old('end_am')) ? old('end_am') : '12:00' }}">
                                </div>
                            </div>


                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="text-muted mb-0 font-size-sm" for="start_pm"><small>
                                            {{ __('common.PM') }} <span class="text-lowercase">{{ __('common.StartTime') }}    
                                    </small></label>
                                    <input @if(!@$suggestions) disabled @endif type="text"
                                        class="js-masked-time form-control" id="start_pm" name="start_pm"
                                        placeholder="{{ __('common.Time') }} (13:00)"
                                        value="{{ (old('start_pm')) ? old('start_pm') : '13:00' }}">
                                </div>
                            </div>


                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="text-muted mb-0 font-size-sm" for="end_pm"><small>
                                            {{ __('common.PM') }} <span class="text-lowercase">{{ __('common.EndTime') }}    
                                    </small></label>
                                    <input @if(!@$suggestions) disabled @endif type="text"
                                        class="js-masked-time form-control" id="end_pm" name="end_pm"
                                        placeholder="{{ __('common.Time') }} (16:30)"
                                        value="{{ (old('end_pm')) ? old('end_pm') : '16:30' }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--
                    <div class="block-content">

                        <div class="row">

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="text-muted mb-0 font-size-sm" for="name"><small>{{ __('common.Name')
                                            }}</small></label>
                    <input @if(!@$suggestions) disabled @endif type="text" class="form-control" id="name" name="name"
                        placeholder="{{ __('common.Name') }}" @if(@$name) value="{{$name}}" @endif>
            </div>
        </div>


        <div class="col-lg-4">
            <div class="form-group">
                <label class="text-muted mb-0 font-size-sm" for="alias"><small>{{ __('common.Alias')
                                            }}</small></label>
                <input @if(!@$suggestions) disabled @endif type="text" class="form-control" id="alias" name="alias"
                    placeholder="{{ __('common.Alias') }}" @if(@$alias) value="{{$alias}}" @endif>
            </div>
        </div>


        <div class="col-lg-3">
            <div class="form-group">
                <label class="text-muted mb-0 font-size-sm" for="start_time"><small>{{
                                            __('common.StartTime') }}</small></label>
                <input @if(!@$suggestions) disabled @endif type="text" class="js-masked-time form-control"
                    id="start_time" name="start_time" placeholder="{{ __('common.Time') }} (08:00)"
                    value="{{ (old('start_time')) ? old('start_time') : '08:30' }}">
            </div>
        </div>

        <div class="col-lg-3">
            <div class="form-group">
                <label class="text-muted mb-0 font-size-sm" for="end_time"><small>{{
                                            __('common.EndTime') }}</small></label>
                <input @if(!@$suggestions) disabled @endif type="text" class="js-masked-time form-control" id="end_time"
                    name="end_time" placeholder="{{ __('common.Time') }} (17:00)"
                    value="{{ (old('end_time')) ? old('end_time') : '16:30' }}">
            </div>
        </div>

        <div class="col-lg-2">
            <label class="text-muted mb-0 font-size-sm" for="color"><small>{{ __('common.Color')
                                        }}</small></label>
            <div class="js-colorpicker input-group" data-format="hex">
                <input @if(!@$suggestions) disabled @endif type="text" class="form-control" id="color" name="color"
                    value="#0665d0">
                <div class="input-group-append">
                    <span class="input-group-text colorpicker-input-addon">
                        <i></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label class="text-muted mb-0 font-size-sm" for="description"><small>{{
                                            __('common.Description') }}</small></label>
                <textarea @if(!@$suggestions) disabled @endif rows="2" class="form-control" id="description"
                    name="description"
                    placeholder="{{ __('common.Description') }}">@if(@$description) {{$description}} @endif</textarea>
            </div>
        </div>

    </div>
</div>
--}}

<div class="block-content">

    @if(@$suggestions)
    <table class="table table-hover table-vtop js-table-checkable">
        <thead>
            <tr>
                <th>
                    <div class="custom-control custom-checkbox custom-control-primary d-inline-block">
                        <input type="checkbox" class="custom-control-input" id="check-all" name="check-all" checked>
                        <label class="custom-control-label" for="check-all"></label>
                    </div>
                </th>
                <th>
                    @sortablelink('date', __('common.Date'))
                </th>

                <th class="d-none d-sm-table-cell">
                    {{ __('common.WeekDay') }}
                </th>
                <th>
                    {{ __('common.Occurrences') }}
                </th>
                <th class="text-right d-none d-sm-table-cell">

                </th>

            </tr>
        </thead>

        @foreach($suggestions as $suggestion)
        <tbody>
            <tr>
                <td>
                    {{-- dd($conflict, $exclusions) --}}
                    <div
                        class="custom-control custom-checkbox @if(@$suggestion['exclusion']) custom-control-danger @else custom-control-primary @endif d-inline-block">
                        <input type="checkbox" class="custom-control-input" id="row_{{ $suggestion['date'] }}"
                            name="suggestions[{{ $suggestion['date'] }}]" @if(@$suggestion['exclusion']) @else checked
                            @endif>
                        <label class="custom-control-label" for="row_{{ $suggestion['date'] }}"></label>
                    </div>
                </td>

                <td>
                    {{ Carbon::parse($suggestion['date'])->format('d.m.Y')}}
                </td>

                <td class="d-none d-sm-table-cell">
                    {{ Carbon::parse($suggestion['date'])->formatLocalized('%A')}}
                </td>
                <td>

                    @foreach($suggestion['occurrences'] as $occurrence)
                    <small>
                        <a target="_blank" href="{{ action('EventController@show', $occurrence['event']['id']) }}">
                            {{ Carbon::parse($occurrence['start_time'])->format('H:i') }} -
                            {{ Carbon::parse($occurrence['end_time'])->format('H:i') }} |
                            {{ $occurrence['event']['name'] }} | {{ $occurrence['room']['name'] }}
                        </a>
                        <br>
                    </small>
                    @endforeach
                </td>

                <td class="d-none d-sm-table-cell text-right">
                    <select class="form-control form-control-sm d-inline-block w-auto" id="rooms"
                        name="rooms[{{Carbon::parse($suggestion['date'])->format('Y-m-d')}}]"
                        title="{{ __('common.Room') }}">
                        @if(@$rooms)
                        @if(@$rooms->count())
                        @foreach(@$rooms as $room)
                        <option value="{{ $room->id }}" @if(@$room_id==$room->id) selected
                            @endif>{{ $room->name }} </option>
                        @endforeach
                        @endif
                        @endif
                    </select>
                    <select class="form-control form-control-sm d-inline-block w-auto" id="day_segment"
                        name="day_segment[{{Carbon::parse($suggestion['date'])->format('Y-m-d')}}]"
                        title="{{ __('common.Time') }}">
                        <option value="3" @if(@$suggestion['time']==3) selected @endif>{{ __('common.WholeDay') }}
                        </option>
                        <option value="1" @if(@$suggestion['time']==1) selected @endif>{{ __('common.AM') }}</option>
                        <option value="2" @if(@$suggestion['time']==2) selected @endif>{{ __('common.PM') }}</option>
                    </select>
                </td>
            </tr>
        </tbody>

        @endforeach
    </table>
    @endif
</div>
<div class="block-content block-content-full block-content-sm bg-body-light text-right">
    <div class="row">

        <div class="col-lg-12 text-right">
            <button type="submit" class="btn btn-success" @if(@!$suggestions) disabled @endif>
                <i class="fa fa-check mr-2"></i>{{ __('common.Event') }} {{ __('common.create') }}
            </button>
        </div>
    </div>
</div>
</form>
</div>
</div>
@endif
</div>

<div class="row">
    <div class="col-md-12">

        @if(@$events)
        @foreach($events as $event)
        <!-- Table Sections (.js-table-sections class is initialized in Helpers.tableToolsSections()) -->
        <div class="block block-rounded animated fadeIn block-fx-pop block-mode-hidden">

            <div class="block-header block-header-light">
                <h3 class="block-title">{{ __('common.Event') }} | {{ $event->name }} <span
                        class="d-none d-sm-inline-block"> | {{ Carbon::parse($event->start_date)->format('d.m.Y')}}
                        - {{ Carbon::parse($event->end_date)->format('d.m.Y')}}</span></h3>
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

            <div class="block-content">

                <h3>{{ __('common.Groups') }}</h3>
                @foreach ($event->groups as $group)
                <p>{{ $group->name }}</p>
                @endforeach
                <h3>{{ __('common.Occurrences') }}</h3>
                <table class="table table-hover table-vcenter">
                    <thead>
                        <tr>
                            <th style="border-top: none;">
                                {{ __('common.Day') }}
                            </th>
                            <th style="border-top: none;">
                                {{ __('common.Date') }}
                            </th>
                            <th style="border-top: none;">
                                {{ __('common.StartDate') }}
                            </th>
                            <th style="border-top: none;">
                                {{ __('common.EndDate') }}
                            </th>
                            <th style="border-top: none;" class="text-right d-none d-sm-table-cell">

                            </th>
                        </tr>
                    </thead>
                    @foreach($event->occurrences as $occurrence)
                    <tbody>
                        <tr>
                            <td>
                                {{ Carbon::parse($occurrence->date)->format('D.')}}
                            </td>
                            <td>
                                {{ Carbon::parse($occurrence->date)->format('d.m.Y')}}
                            </td>

                            <td>
                                {{ Carbon::parse($occurrence->start_time)->format('H:i')}}
                            </td>
                            <td>
                                {{ Carbon::parse($occurrence->end_time)->format('H:i')}}
                            </td>

                            <td class="d-none d-sm-table-cell text-right">
                                <a href="#" class="btn btn-primary btn-sm">
                                    <i class="nav-main-link-icon si si-pencil"></i>
                                </a>

                                <form action="{{ action('EventController@index', $course->id) }}" method="post"
                                    class="d-inline">
                                    @csrf
                                    <input name="_method" type="hidden" value="GET">
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="nav-main-link-icon si si-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    </tbody>

                    @endforeach
                </table>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>
</div>
<!-- END Page Content -->

@endsection