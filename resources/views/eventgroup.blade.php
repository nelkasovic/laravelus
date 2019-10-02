@extends('layouts.app')

@section('content')

<!-- Page Content -->
<div class="content">
    <div class="row">
        <div class="col-md-4">
            <div class="block block-rounded block-themed">
                <div class="block-header block-header-default bg-gd-aqua">
                    <h3 class="block-title">{{ __('common.Studies') }} </h3>
                </div>
                <div class="block-content pb-4">
                    <form action="{{ action('EventGroupController@index') }}" method="POST">
                        <input name="_method" type="hidden" value="POST">
                        @csrf
                        <select class="form-control form-control" id="sid" name="sid" title="{{ __('common.Study') }}"
                            onchange="this.form.submit()">
                            <option value="">{{ __('common.Study') }}</option>
                            @foreach($studies as $study)
                            <option value="{{ $study->id }}" {{ ($sid == $study->id ? 'selected':'') }}>
                                {{ $study->alias }} | {{ $study->name }}</option>
                            @endforeach
                        </select>
                </div>
                <div class="block-content block-content-full text-right bg-light">
                    <div class="row">
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-6">
                            <a class="btn btn-warning btn-block" href="{{ action('EventGroupController@index')}}">
                                <i class="si si-action-undo mr-1"></i>
                                {{ __('common.Reset') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="block block-rounded block-themed">
                <div class="block-header block-header-default bg-gd-aqua">
                    <h3 class="block-title">{{ __('common.Events') }} </h3>
                </div>
                <div class="block-content pb-4">
                    <select class="form-control form-control" id="eid" name="eid" title="{{ __('common.Event') }}"
                        onchange="this.form.submit()" @if(@!$sid || @$events->count() == 0) disabled @endif>
                        <option value="">{{ __('common.Event') }}</option>
                        @if($sid)
                        @foreach($events as $event)
                        <option value="{{ $event->id }}" {{ ($eid == $event->id ? 'selected':'') }}>{{ $event->alias }}
                            | {{ $event->name }} | {{ Carbon::parse($event->start_date)->format('d.m.Y') }}</option>
                        @endforeach
                        @endif
                    </select>
                    </form>
                </div>
                <div class="block-content block-content-full text-right bg-light">
                    <div class="row">
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-6">
                            <a class="btn btn-warning btn-block" href="{{ action('EventGroupController@index')}}">
                                <i class="si si-action-undo mr-1"></i>
                                {{ __('common.Reset') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Block Tabs With Options Default Style -->
            <div class="block block-rounded block-themed">
                <div class="block-header block-header-default bg-gd-aqua">
                    <h3 class="block-title">{{ __('common.Groups') }} </h3>
                </div>
                @if(@$eid)
                <form action="{{ action('EventGroupController@attach', [$sid, $eid]) }}" method="POST">
                    <input name="_method" type="hidden" value="POST">
                    @csrf
                    @endif
                    <div class="block-content pb-4">

                        <select class="form-control form-control" id="gid" name="gid" title="{{ __('common.Group') }}"
                            @if(@$sid && @$eid && $groups->count() > 0) data-study="{{$sid}}" data-event="{{$eid}}"
                            @else disabled @endif>

                            @if($groups)
                            <option value="">{{ __('common.Group') }}</option>
                            @foreach($groups as $group)
                            <option value="{{ $group->id }}">{{ $group->alias }}</option>
                            @endforeach
                            @else
                            @endif
                        </select>


                    </div>
                    <div class="block-content block-content-full text-right bg-light">
                        <div class="row">
                            <div class="col-md-6">

                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary btn-block"
                                    {{ (old('eid') || @$eid ||  @$sid  ? '':'disabled') }}>
                                    <i class="si si-fire mr-1"></i>
                                    {{ __('common.Add') }}

                                </button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @if (@$event_groups && $current_event)
            <!-- Table Sections (.js-table-sections class is initialized in Helpers.tableToolsSections()) -->

            <div class="block block-rounded block-themed animated fadeIn">

                <div class="block-header block-header-default">
                    <h3 class="block-title">
                        @if ($current_event) {{ $current_event->groups->count() }} {{ __('common.Groups') }} |
                        {{ __('common.Course') }} {{ $current_event->course->alias }} |
                        {{ $current_event->course->name }} | {{ __('common.Number') }}
                        {{ $current_event->course->number }}
                        @endif
                    </h3>
                </div>

                <div class="block-content">

                    <table class="js-table-sections table table-hover table-vcenter">
                        <thead>
                            <tr>
                                <th style="width: 30px; border-top: none;"></th>

                                <th style="border-top: none;">
                                    @sortablelink('alias', __('common.Alias'))
                                </th>
                                <th style="border-top: none;">
                                    @sortablelink('name', __('common.Name'))
                                </th>

                                <th style="border-top: none;" class="text-right">

                                </th>
                            </tr>
                        </thead>
                        @csrf
                        @foreach($event_groups as $group)
                        <tbody class="js-table-sections-header">
                            <tr>
                                <td class="text-center">
                                    <i class="fa fa-angle-right text-muted"></i>
                                </td>
                                <td>
                                    <div class="py-1">
                                        <a href="#">{{ $group->alias }}</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="py-1">
                                        <a href="#">{{ $group->name }}</a>
                                    </div>
                                </td>


                                <td class="d-none d-sm-table-cell text-right">
                                    @can('update events')
                                    @if ($current_event->id)
                                    <form action="{{ action('EventGroupController@detach', [$sid, $eid, $group->id]) }}"
                                        method="POST">
                                        <input name="_method" type="hidden" value="POST">
                                        @csrf
                                        <a>
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                title="{{__('common.Delete')}}">
                                                <i class="nav-main-link-icon si si-trash"></i>
                                            </button>
                                        </a>
                                    </form>
                                    @endif
                                    @endcan
                                </td>
                            </tr>
                        </tbody>
                        <tbody class="font-size-sm">
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="10">
                                    <h3>{{ $group->study->name }}</h3>
                                    <p>{{ $group->description }}</p>

                                    <ul>
                                        @foreach($group->persons as $person)
                                        <li>{{ $person->last_name }} {{ $person->first_name }}</li>
                                        @endforeach
                                    </ul>
                                    <p>
                                        <em
                                            class="text-muted">{{ Carbon::parse($group->updated_at)->format('d.m.Y H:i')}}</em>
                                    </p>
                                </td>

                            </tr>

                        </tbody>
                        @endforeach
                    </table>

                </div>


            </div>
            @endif
        </div>
    </div>
    <!-- END Table Sections -->
</div>
<!-- END Page Content -->

@endsection