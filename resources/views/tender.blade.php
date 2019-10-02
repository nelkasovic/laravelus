@extends('layouts.app')

@section('content')

<!-- Page Content -->
<div class="content">
    @can('update events')
    @if (@$assigned->count() > 0)
    <div class="row">
        <div class="col-md-12">
            <!-- Table Sections (.js-table-sections class is initialized in Helpers.tableToolsSections()) -->
            <div class="block block-rounded block-themed block-fx-pop">

                <div class="block-header bg-gd-aqua block-header-default">
                    <h3 class="block-title">
                        {{ __('common.Assigned')}}
                    </h3>
                    <div class="block-options pr-2 d-none d-sm-block">

                    </div>
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
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>

                <div class="block-content">
                    <form action="{{action('EventController@tender')}}" method="post">
                        <div class="row mb-4">
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <select class="form-control" id="course_id" name="course_id"
                                        title="{{ __('common.Course') }}" onchange="this.form.submit()">
                                        <option value="">{{ __('common.Course') }}</option>
                                        @if($courses)
                                        @if($courses->count())
                                        @foreach($courses as $course)
                                        <option value="{{ $course->id }}"
                                            {{ ($selected_course == $course->id ? 'selected':'') }}>{{ $course->alias }}
                                            | {{ $course->name }}</option>
                                        @endforeach
                                        @endif
                                        @endif
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
                                    @sortablelink('start_date', __('common.StartDate'))
                                </th>
                                <th class="d-none d-xl-table-cell">
                                    @sortablelink('end_date', __('common.EndDate'))
                                </th>
                                <th class="d-none d-sm-table-cell">
                                    @sortablelink('person_id', __('common.Person'))
                                </th>
                                <th class="d-none d-sm-table-cell">
                                </th>
                            </tr>
                        </thead>
                        @csrf

                        @foreach($assigned as $event)
                        @foreach($event->assigned() as $assignment)
                        <tbody class="js-table-sections-header">
                            <tr>
                                <td class="text-center">
                                    <i class="fa fa-angle-right text-muted"></i>
                                </td>
                                <td>
                                    <div class="py-1">
                                        <a href="{{action('EventController@show', $event->id)}}">{{ $event->alias }}
                                        </a>
                                    </div>
                                </td>

                                <td class="d-none d-xl-table-cell">
                                    <div class="py-1">
                                        {{ Carbon::parse($event->start_date)->format('D, d.m.Y')}}
                                    </div>
                                </td>
                                <td class="d-none d-xl-table-cell">
                                    <div class="py-1">
                                        {{ Carbon::parse($event->end_date)->format('D, d.m.Y')}}
                                    </div>
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    <div class="py-1">
                                        <span class="@if($assignment->pivot->confirmed == 1) text-success @endif">
                                            <i class="nav-main-link-icon si si-user mr-1 d-none d-sm-inline-block"></i>
                                            {{ $assignment->first_name }} {{ $assignment->last_name }}
                                            @if(!$assignment->pivot->confirmed)
                                            <small>({{__('common.NotConfirmed')}})</small>
                                            @endif
                                        </span>
                                    </div>
                                </td>
                                <td class="d-none d-sm-table-cell text-right">
                                    @if($assignment->pivot->file_id)
                                    
                                    <a href="{{action('EventController@download', $assignment->pivot->file_id)}}"
                                        class="btn btn-primary" title="{{ __('common.AssignmentSheet')}}">
                                        <i
                                            class="nav-main-link-icon si si-printer mr-1"></i>{{ __('common.AssignmentSheet') }}
                                    </a>
                                    
                                    @endif

                                    @if(!$assignment->pivot->confirmed)
                                    <a href="{{action('EventController@reassign', [$assignment->id, $event->id])}}"
                                        class="btn btn-danger" title="{{ __('common.Remove')}}">
                                        <i class="nav-main-link-icon si si-trash mr-1"></i> {{ __('common.Remove') }}
                                    </a>
                                    @endif

                                    @can('confirm events')

                                    @if($assignment->locations()->count() > 0)

                                    <a href="{{action('EventController@confirm', [$assignment->id, $event->id])}}"
                                        class="btn @if($assignment->pivot->confirmed == 1) btn-warning @else btn-success @endif"
                                        title="{{ __('common.UndoConfirm')}}">
                                        @if($assignment->pivot->confirmed == 1)
                                        <i class="nav-main-link-icon si si-action-undo mr-1"></i>
                                        {{ __('common.UndoConfirm') }}
                                        @else
                                        <i class="nav-main-link-icon si si-action-redo mr-1"></i>
                                        {{ __('common.Confirm') }}
                                        @endif
                                    </a>
                                    @else
                                    <a href="{{ action('LocationController@person', $assignment->id) }}"
                                        class="btn btn-warning">
                                        <i class="nav-main-link-icon si si-energy mr-1"></i>
                                        {{ __('common.MissingAddress') }} - {{ __('common.Add') }}
                                    </a>
                                    @endif

                                    @endcan
                                </td>
                            </tr>
                        </tbody>
                        <tbody class="font-size-sm">
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="5">
                                    <h4>{{ $event->course->name }} /
                                        {{ Carbon::parse($event->start_date)->format('D, d.m.Y')}} -
                                        {{ Carbon::parse($event->end_date)->format('D, d.m.Y')}}</h4>
                                    <p>{{ $event->description }}</p>
                                    <h4>{{ __('common.Occurrences')}}</h4>
                                    <p>
                                        @foreach($event->occurrences as $occurrence)
                                        {{ Carbon::parse($occurrence->date)->format('D, d.m.Y')}},
                                        {{ Carbon::parse($occurrence->start_time)->format('H:i')}} -
                                        {{ Carbon::parse($occurrence->end_time)->format('H:i')}}<br />
                                        @endforeach
                                    </p>
                                    <ul>
                                        @foreach ($event->activities as $activity)
                                        <li>{{ __('dynamic.'.$activity->description) }} {{ __('common.through') }} {{ Auth()->user()->client->users()->whereId($activity->causer_id)->pluck('name')->first() }}</li> 
                                        @endforeach
                                    </ul>
                                </td>

                            </tr>

                        </tbody>
                        @endforeach
                        @endforeach
                    </table>

                </div>

                @if ($assigned->total() > $assigned->perPage())
                <div
                    class="block-content block-content-full block-content-sm bg-body-light d-flex justify-content-center align-content-center">
                    {!! $assigned->setPageName('assigned')->appends(\Request::except('assigned'))->render() !!}
                </div>
                @endif
            </div>
        </div>
    </div>
    @endif

    <div class="row">
        <!-- Applied Section -->
        @if (@$applied->count() > 0)
        <div class="@if ($matching->count() > 0) col-xl-6 @else col-lg-12 @endif col-md-12">
            <!-- Table Sections (.js-table-sections class is initialized in Helpers.tableToolsSections()) -->
            <div class="block block-rounded block-themed block-fx-pop">

                <div class="block-header bg-gd-primary block-header-default">
                    <h3 class="block-title">
                        {{ __('common.Applied')}}
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
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>

                <div class="block-content">
                    <table class="js-table-sections table table-hover table-vcenter">
                        <thead>
                            <tr>
                                <th style="border-top: none;"></th>
                                <th style="border-top: none;">
                                    @sortablelink('name', __('common.Name'))
                                </th>
                                <th style="border-top: none;" class="d-none d-sm-table-cell">
                                    @sortablelink('start_date', __('common.StartDate'))
                                </th>


                                <th style="border-top: none;" class="d-none d-sm-table-cell"></th>
                            </tr>
                        </thead>
                        @csrf

                        @foreach($applied as $event)

                        <tbody class="js-table-sections-header">
                            <tr>
                                <td class="text-center">
                                    <i class="fa fa-angle-right text-muted"></i>
                                </td>
                                <td>
                                    <div class="py-1">
                                        <a href="{{action('EventController@show', $event->id)}}">{{ $event->alias }}
                                        </a>
                                    </div>
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    <div class="py-1">
                                        {{ Carbon::parse($event->start_date)->formatLocalized('%A %d %B %Y')}}
                                    </div>
                                </td>

                                <td class="d-none d-sm-table-cell text-right">

                                    @can('confirm events')
                                    <span class="btn btn-light">
                                        <i
                                            class="nav-main-link-icon si si-user mr-2"></i>{{ $event->applied()->count() }}
                                    </span>
                                    @endcan


                                </td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="5">
                                    @can('confirm events')



                                    <table class="table table-vcenter table-borderless">

                                        @foreach($event->applied() as $candidate)
                                        <tbody>
                                            <tr>
                                                <td class="pl-0 font-w600">{{ $candidate->first_name }} {{ $candidate->last_name }}</td>
                                                <td class="text-right pr-0">
                                                    <div class="btn-group">
                                                        <a href="{{action('EventController@reassign', [$candidate->id, $event->id])}}"
                                                            class="btn btn-sm btn-success"
                                                            title="{{ __('common.Reassign')}}">
                                                            <i class="nav-main-link-icon si si-check mr-1"></i>
                                                            {{ __('common.Accept') }}
                                                        </a>
                                                        <a href="{{action('EventController@decline', [$event->id, $candidate->id])}}"
                                                            class="btn btn-danger btn-sm"
                                                            title="{{ __('common.Decline')}}">
                                                            <i class="nav-main-link-icon si si-dislike mr-1"></i>
                                                            {{ __('common.Decline') }}
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                        @endforeach
                                    </table>
                                    <hr>

                                    @endcan
                                    
                                    <div class="font-size-sm">
                                        <p class="font-w600">{{ Carbon::parse($event->start_date)->format('D, d.m.Y')}} -
                                            {{ Carbon::parse($event->end_date)->format('D, d.m.Y')}}, {{ $event->course->name }}</p>
                                        <h4>{{ __('common.Occurrences')}}</h4>
                                        <p>
                                            @foreach($event->occurrences as $occurrence)
                                            {{ Carbon::parse($occurrence->date)->format('D, d.m.Y')}},
                                            {{ Carbon::parse($occurrence->start_time)->format('H:i')}} -
                                            {{ Carbon::parse($occurrence->end_time)->format('H:i')}}<br />
                                            @endforeach
                                        </p>

                                        <ul>
                                            @foreach ($event->activities as $activity)
                                            <li>{{ __('dynamic.'.$activity->description) }} {{ __('common.through') }} {{ Auth()->user()->client->users()->whereId($activity->causer_id)->pluck('name')->first() }}</li> 
                                            @endforeach
                                        </ul>
                                    </div>
                                </td>

                            </tr>

                        </tbody>
                        @endforeach

                    </table>

                </div>
                @if ($applied->total() > $applied->perPage())
                <div
                    class="block-content block-content-full block-content-sm bg-body-light d-flex justify-content-center align-content-center">
                    {!! $applied->setPageName('applied')->appends(\Request::except('applied'))->render() !!}
                </div>
                @endif
            </div>
        </div>
        @endif
        <!-- END Applied Section -->

        <!-- Matching Section -->
        @if (@$matching->count() > 0)
        <div class="@if ($applied->count() > 0) col-xl-6 @else col-lg-12 @endif col-md-12">
            <!-- Table Sections (.js-table-sections class is initialized in Helpers.tableToolsSections()) -->
            <div class="block block-rounded block-themed block-fx-pop">

                <div class="block-header bg-gd-primary block-header-default">
                    <h3 class="block-title">
                        {{ __('common.Open')}}
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
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>

                <div class="block-content">

                    <table class="js-table-sections table table-hover table-vcenter">
                        <thead>
                            <tr>
                                <th style="border-top: none;"></th>
                                <th style="border-top: none;">
                                    @sortablelink('name', __('common.Name'))
                                </th>
                                <th style="border-top: none;" class="d-none d-sm-table-cell">
                                    @sortablelink('start_date', __('common.StartDate'))
                                </th>

                                <th style="border-top: none;" class="d-none d-sm-table-cell"></th>
                            </tr>
                        </thead>
                        @csrf

                        @foreach($matching as $event)

                        <tbody class="js-table-sections-header">
                            <tr>
                                <td class="text-center">
                                    <i class="fa fa-angle-right text-muted"></i>
                                </td>
                                <td>
                                    <div class="py-1">
                                        <a href="{{action('EventController@show', $event->id)}}">{{ $event->alias }}
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <div class="py-1 d-none d-sm-table-cell">
                                        {{ Carbon::parse($event->start_date)->format('D, d.m.Y')}}
                                    </div>
                                </td>


                                <td class="d-none d-sm-table-cell text-right">

                                    <a href="{{action('EventController@show', $event->id)}}" class="btn btn-primary"
                                        title="{{ __('common.Event')}}">
                                        <i class="nav-main-link-icon si si-calendar mr-1"></i> {{ __('common.Event') }}
                                    </a>


                                </td>
                            </tr>
                        </tbody>
                        <tbody class="font-size-sm">
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="5">
                                    <h4>{{ $event->name }}</h4>
                                    <h4>{{ Carbon::parse($event->start_date)->format('D, d.m.Y')}} -
                                        {{ Carbon::parse($event->end_date)->format('D, d.m.Y')}}</h4>
                                    <p>{{ $event->description }}</p>
                                    <h4>{{ __('common.Occurrences')}}</h4>
                                    <p>
                                        @foreach($event->occurrences as $occurrence)
                                        {{ Carbon::parse($occurrence->date)->format('D, d.m.Y')}},
                                        {{ Carbon::parse($occurrence->start_time)->format('H:i')}} -
                                        {{ Carbon::parse($occurrence->end_time)->format('H:i')}}<br />
                                        @endforeach
                                    </p>

                                    <ul>
                                        @foreach ($event->activities as $activity)
                                        <li>{{ __('dynamic.'.$activity->description) }} {{ __('common.through') }} {{ Auth()->user()->client->users()->whereId($activity->causer_id)->pluck('name')->first() }}</li> 
                                        @endforeach
                                    </ul>
                                </td>

                            </tr>

                        </tbody>
                        @endforeach

                    </table>

                </div>
                @if ($matching->total() > $matching->perPage())
                <div
                    class="block-content block-content-full block-content-sm bg-body-light d-flex justify-content-center align-content-center">
                    {!! $matching->setPageName('matching')->appends(\Request::except('matching'))->render() !!}
                </div>
                @endif

            </div>
        </div>
        @endif
        <!-- END Matching Section -->

    </div>
    @endcan
</div>
<!-- END Page Content -->

@endsection