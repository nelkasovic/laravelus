@extends('layouts.app')

@section('content')

<!-- Page Content -->
<div class="content">

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
                    
                    <table class="js-table-sections table table-hover table-vcenter">
                        <thead>
                            <tr>
                                <th style="border-top: none;"></th>
                                <th class="" style="border-top: none;" style="border-top: none;">
                                    @sortablelink('name', __('common.Name'))
                                </th>
                                <th class="d-none d-xl-table-cell" style="border-top: none;">
                                    @sortablelink('start_date', __('common.StartDate'))
                                </th>
                                <th class="d-none d-xl-table-cell" style="border-top: none;">
                                    @sortablelink('end_date', __('common.EndDate'))
                                </th>
                                <th class="d-none d-xl-table-cell" style="border-top: none;">
                                    {{ __('common.Status') }}
                                </th>

                                <th class="d-none d-sm-table-cell" style="border-top: none;">
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
                                        <a href="{{action('EventController@show', $event->id)}}">
                                            {{ $event->alias }}
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
                                <td class="d-none d-xl-table-cell">
                                        @if(!$assignment->pivot->confirmed && !$assignment->pivot->completed)
                                            {{__('common.InProcess')}}
                                        @elseif($assignment->pivot->confirmed && !$assignment->pivot->completed)
                                            {{ __('common.Confirmed') }}
                                        @elseif($assignment->pivot->completed)
                                            {{ __('common.Completed') }}
                                        @endif
                                </td>
    
                                <td class="d-none d-sm-table-cell text-right">
                                    @if($assignment->pivot->confirmed && !$assignment->pivot->completed)
                                        <a href="{{action('EventController@complete', [$event->id, $assignment->id, 1])}}"
                                            class="btn btn-light" title="{{ __('common.DoComplete')}}">
                                            <i class="si si-key mr-1"></i>{{ __('common.DoComplete') }}
                                        </a>
                                    @elseif($assignment->pivot->completed)
                                        <a href="{{action('EventController@complete', [$event->id, $assignment->id, 0])}}"
                                            class="btn btn-light" title="{{ __('common.DoOpen')}}">
                                            <i class="si si-key mr-1"></i>{{ __('common.DoOpen') }}
                                        </a>
                                    @endif

                                    @if($assignment->pivot->file_id)
                                    @if($assignment->id === Auth()->user()->person_id)
                                    <a href="{{action('EventController@download', $assignment->pivot->file_id)}}"
                                        class="btn btn-primary" title="{{ __('common.AssignmentSheet')}}">
                                        <i class="si si-printer mr-1"></i>{{ __('common.AssignmentSheet') }}
                                    </a>
                                    @endif
                                    @endif

                                    @if(!$assignment->pivot->confirmed)
                                    <a href="{{action('EventController@show', $event->id)}}"
                                        class="btn btn-info" title="{{ __('common.Event')}}">
                                        <i class="si si-calendar mr-1"></i> {{ __('common.Event') }}
                                    </a>
                                    @endif

                                  
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
                                </td>

                            </tr>

                        </tbody>
                        @endforeach
                        @endforeach
                    </table>

                </div>

              
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

                                    <a href="{{action('EventController@decline', $event->id)}}" class="btn btn-warning"
                                        title="{{ __('common.Decline')}}">
                                        <i class="si si-dislike mr-1"></i> {{ __('common.Decline') }}
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
                                </td>

                            </tr>

                        </tbody>
                        @endforeach

                    </table>

                </div>
             
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

                                    <a href="{{action('EventController@apply', $event->id)}}" class="btn btn-primary"
                                        title="{{ __('common.Apply')}}">
                                        <i class="si si-like mr-1"></i> {{ __('common.Apply') }}
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
                                </td>

                            </tr>

                        </tbody>
                        @endforeach

                    </table>

                </div>
              
            </div>
        </div>
        @endif
        <!-- END Matching Section -->

    </div>
</div>
<!-- END Page Content -->

@endsection