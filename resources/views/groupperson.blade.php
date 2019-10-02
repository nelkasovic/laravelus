@extends('layouts.app')

@section('content')

<!-- Page Content -->
<div class="content">
    <div class="block block-rounded block-themed block-fx-pop">
        <div class="block-header block-header-default bg-gd-aqua">
            <h3 class="block-title">@if($study_persons) {{ $study_persons->count() }} /
                {{ $current_study->persons->count() }} {{ __('common.Persons') }} {{ __('common.In') }}
                {{ $current_study->groups->count() }} {{ __('common.Groups') }} {{ __('common.assigned') }}
                {{ __('common.In') }} {{ $current_study->name }} @else {{ __('common.Select') }} @endif</h3>
        </div>
        <div class="block-content pb-4">
            <form action="{{ action('GroupPersonController@index') }}" method="POST">
                <div class="row">
                    <div class="col-md-4">
                        <input name="_method" type="hidden" value="POST">
                        @csrf
                        <label class="text-muted mb-0 font-size-sm"
                            for="course_id"><small>{{ __('common.Study') }}</small></label>
                        <select class="form-control form-control" id="sid" name="sid" title="{{ __('common.Study') }}"
                            onchange="this.form.submit()">
                            <option value="">{{ __('common.Select') }}</option>
                            @foreach($studies as $study)
                            <option value="{{ $study->id }}" {{ ($sid == $study->id ? 'selected':'') }}>
                                {{ $study->alias }} | {{ $study->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{--
                    <div class="col-md-3">
                        <label class="text-muted mb-0 font-size-sm" for="course_id"><small>{{ __('common.Course') }}</small></label>
                    <select class="form-control form-control" id="cid" name="cid" title="{{ __('common.Course') }}"
                        onchange="this.form.submit()" @if(@!$sid || @$courses->count() == 0) disabled @endif>
                        <option value="">{{ __('common.Select') }}</option>
                        @if($sid)
                        @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ ($cid == $course->id ? 'selected':'') }}>
                            {{ $course->alias }} | {{ $course->name }}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                --}}
                <div class="col-md-4">
                    <label class="text-muted mb-0 font-size-sm"
                        for="gid"><small>{{ __('common.Group') }}</small></label>
                    <select class="form-control form-control" id="gid" name="gid" title="{{ __('common.Group') }}"
                        onchange="this.form.submit()" @if(@!$sid || @$groups->count() == 0) disabled @endif>
                        <option value="">{{ __('common.Select') }}</option>
                        @if($sid && $groups)
                        @foreach($groups as $group)
                        <option value="{{ $group->id }}" {{ (@$gid == $group->id ? 'selected':'') }}>{{ $group->name }}
                        </option>
                        @endforeach
                        @endif
                    </select>
                </div>

                <div class="col-md-4">
            </form>
            @if(@$gid)
            <form action="{{ action('GroupPersonController@attach', [$gid, $sid]) }}" method="POST">
                <input name="_method" type="hidden" value="POST">
                @csrf
                @endif
                <label class="text-muted mb-0 font-size-sm"
                    for="course_id"><small>{{ __('common.Person') }}</small></label>
                <select class="form-control form-control" id="pid" name="pid" title="{{ __('common.Person') }}"
                    @if(@!$sid || @!$gid || $persons->count() == 0 ) disabled @endif>
                    @if($persons && $sid && $gid)
                    @foreach($persons as $person)
                    <option value="{{ $person->id }}">{{ $person->last_name }} {{ $person->first_name }}</option>
                    @endforeach
                    @else
                    <option value="">{{ __('common.Select') }}</option>
                    @endif

                </select>

        </div>
    </div>

</div>

<div class="block-content block-content-full text-right bg-light">
    <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-3">
            <a class="btn btn-warning btn-block" href="{{ action('GroupPersonController@index')}}">
                <i class="si si-action-undo mr-1"></i>
                {{ __('common.Reset') }}
            </a>
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary btn-block" {{ (@$sid  ? '':'disabled') }}>
                <i class="si si-fire mr-1"></i>
                {{ __('common.Add') }}

            </button>
            </form>
        </div>
    </div>
</div>

</div>


<div class="row">
    <div class="col-md-12">
        @if (@$group_persons)
        <!-- Table Sections (.js-table-sections class is initialized in Helpers.tableToolsSections()) -->

        <div class="block block-rounded block-themed block-fx-pop animated fadeIn">

            <div class="block-header block-header-default bg-primary-darker">
                <h3 class="block-title">
                    @if($current_group)
                    @if ($current_group) {{ $current_group->persons->count() }} {{ __('common.Persons') }}
                    {{ __('common.In') }} {{ $current_group->name }}
                    @endif
                    @elseif($group_persons)
                    {{ $group_persons->count() }} {{ __('common.Persons') }} {{ __('common.In') }}
                    {{ $current_study->name }}
                    @endif
                </h3>
                <div class="block-options">
                    <div class="btn-group">
                        @if(@$current_group->events)
                        @foreach($current_group->events as $event)
                        <a href="#" class="btn btn-sm btn-primary">
                            <i class="icon si si-action-redo mr-2"></i>{{ $event->alias }}
                        </a>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <div class="block-content">

                <table class="js-table-sections table table-hover table-vcenter">
                    <thead>
                        <tr>
                            <th style="width: 30px; border-top: none;"></th>

                            <th style="border-top: none;">
                                @sortablelink('last_name', __('common.LastName'))
                            </th>

                            <th style="border-top: none;">
                                @sortablelink('first_name', __('common.FirstName'))
                            </th>
                            <th style="border-top: none;" class="d-none d-xl-table-cell">
                                @sortablelink('title', __('common.Title'))
                            </th>
                            <th style="border-top: none;" class="d-none d-xl-table-cell">
                                @sortablelink('company_name', __('common.Company'))
                            </th>
                            <th style="border-top: none;" class="d-none d-xl-table-cell">
                                @sortablelink('email', __('common.Email'))
                            </th>
                            <th style="border-top: none;" class="d-none d-xl-table-cell">
                                @sortablelink('phone', __('common.Phone'))
                            </th>
                            <th style="border-top: none;" class="d-none d-xl-table-cell" class="text-right">

                            </th>
                        </tr>
                    </thead>
                    @csrf
                    @foreach($group_persons as $person)
                    <tbody class="js-table-sections-header">
                        <tr>
                            <td class="text-center">
                                <i class="fa fa-angle-right text-muted"></i>
                            </td>
                            <td>
                                <div class="py-1">
                                    <a href="{{ action('PersonController@show', $person->id) }}"
                                        title="{{ $person->last_name }} {{ $person->first_name }}">
                                        {{ $person->last_name }}
                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class="py-1">
                                    <a href="{{ action('PersonController@show', $person->id) }}"
                                        title="{{ $person->last_name }} {{ $person->first_name }}">
                                        {{ $person->first_name }}
                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class="py-1 d-none d-xl-table-cell">
                                    {{ $person->title }}
                                </div>
                            </td>
                            <td>
                                <div class="py-1 d-none d-xl-table-cell">
                                    {{ $person->company_name }}
                                </div>
                            </td>
                            <td>
                                <div class="py-1 d-none d-xl-table-cell">
                                    {{ $person->email }}
                                </div>
                            </td>
                            <td>
                                <div class="py-1 d-none d-xl-table-cell">
                                    {{ $person->phone }}
                                </div>
                            </td>
                            <td class="d-none d-sm-table-cell text-right">
                                @can('update groups')
                                <form action="{{ action('GroupPersonController@detach', [$gid, $sid, $person->id]) }}"
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
                                @endcan
                            </td>
                        </tr>
                    </tbody>
                    <tbody class="font-size-sm">
                        <tr>
                            <td class="text-center"></td>
                            <td colspan="10">
                                @if($current_group)
                                <h3>{{ $current_group->study->name }}</h3>
                                <p>{{ $current_group->description }}</p>

                                <p>
                                    <em
                                        class="text-muted">{{ Carbon::parse($current_group->updated_at)->format('d.m.Y H:i')}}</em>
                                </p>
                                @endif
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