@extends('layouts.app')

@section('content')

<!-- Page Content -->
<div class="content">
    <div class="row">
        <div class="col-md-6">
            <!-- Block Tabs With Options Default Style -->
            <div class="block block-rounded block-themed block-fx-pop">
                <div class="block-header block-header-default bg-gd-aqua">
                    <h3 class="block-title">{{ __('common.Events') }} </h3>

                </div>
                <form action="{{ action('EventPersonController@index') }}" method="POST">
                    <input name="_method" type="hidden" value="GET">
                    @csrf
                    <div class="block-content pb-4">

                        <select class="form-control form-control" id="eid" name="eid" title="{{ __('common.Event') }}"
                            onchange="this.form.submit()">
                            <option value="">{{ __('common.Event') }}</option>
                            @foreach($events as $event)
                            <option value="{{ $event->id }}" {{ ($eid == $event->id ? 'selected':'') }}>
                                {{ Carbon::parse($event->start_date)->format('d.m.Y') }} | {{ $event->course->alias }} |
                                {{ $event->name }}</option>
                            @endforeach
                        </select>


                    </div>
                    <div class="block-content block-content-full text-right bg-light">
                        <div class="row">
                            <div class="col-md-6">

                            </div>
                            <div class="col-md-6">
                                <a class="btn btn-warning btn-block" href="{{ action('EventPersonController@index' )}}">
                                    <i class="si si-action-undo mr-1"></i>
                                    {{ __('common.Reset') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-6">
            <!-- Block Tabs With Options Default Style -->
            <div class="block block-rounded block-themed block-fx-pop">
                <div class="block-header block-header-default bg-gd-aqua">
                    <h3 class="block-title">{{ __('common.Persons') }} </h3>

                </div>
                <form action="{{ action('EventPersonController@attach', $eid) }}" method="POST">
                    <input name="_method" type="hidden" value="GET">
                    @csrf
                    <div class="block-content pb-4">

                        <select class="form-control form-control" id="pid" name="pid" title="{{ __('common.Person') }}"
                            @if(@$eid) @else disabled @endif>
                            <option value="">{{ __('common.Person') }}</option>
                            @if(@$eid && $persons)
                            @foreach($persons as $person)
                            <option value="{{ $person->id }}">{{ $person->last_name }} {{ $person->first_name }}
                            </option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="block-content block-content-full text-right bg-light">
                        <div class="row">
                            <div class="col-md-6">

                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary btn-block"
                                    {{ (old('eid') || @$eid ? '':'disabled') }}>
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
            @if (@$event_persons->count() > 0 && $current_event)
            <!-- Table Sections (.js-table-sections class is initialized in Helpers.tableToolsSections()) -->

            <div class="block block-rounded block-themed animated fadeIn">

                <div class="block-header block-header-default">
                    <h3 class="block-title">{{ __('common.Persons') }}
                        @if ($current_event)
                        | {{ @$current_event->name }} | {{ Carbon::parse($current_event->start_date)->format('d.m.Y')}}
                        - {{ Carbon::parse($current_event->end_date)->format('d.m.Y')}}
                        @endif
                    </h3>
                </div>

                <div class="block-content">
                    <!--
                        Separate your table content with multiple tbody sections. Add one row and add the class .js-table-sections-header to a
                        tbody section to make it clickable. It will then toggle the next tbody section which can have multiple rows. Eg:

                        <tbody class="js-table-sections-header">One row</tbody>
                        <tbody>Multiple rows</tbody>
                        <tbody class="js-table-sections-header">One row</tbody>
                        <tbody>Multiple rows</tbody>
                        <tbody class="js-table-sections-header">One row</tbody>
                        <tbody>Multiple rows</tbody>

                        You can also add the class .show in your tbody.js-table-sections-header to make the next tbody section visible by default
                        -->


                    <table class="js-table-sections table table-hover table-vcenter">
                        <thead>
                            <tr>
                                <th style="width: 30px; border-top: none;"></th>
                                <th style="border-top: none;">
                                    @sortablelink('name', __('common.Name'))
                                </th>



                                <th style="border-top: none;" class="text-right">

                                </th>
                            </tr>
                        </thead>
                        @csrf
                        @foreach($event_persons as $person)
                        <tbody class="js-table-sections-header">
                            <tr>
                                <td class="text-center">
                                    <i class="fa fa-angle-right text-muted"></i>
                                </td>
                                <td class="font-w600">
                                    <div class="py-1">
                                        {{ $person->first_name }} {{ $person->last_name }}
                                    </div>
                                </td>


                                <td class="d-none d-sm-table-cell text-right">
                                    @can('update events')
                                    @if ($person->id)
                                    <form action="{{ action('EventPersonController@detach', [$eid, $person->id]) }}"
                                        method="POST">
                                        <input name="_method" type="hidden" value="GET">
                                        @csrf
                                        <button type="submit" class="btn btn-danger" title="{{__('common.Delete')}}">
                                            <i class="nav-main-link-icon si si-trash"></i>
                                        </button>
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
                                    <p>
                                        {{ __('common.Phone') }}: {{ $event->description }}<br>

                                    </p>

                                    <p>
                                        <em
                                            class="text-muted">{{ Carbon::parse($person->updated_at)->format('d.m.Y H:i')}}</em>
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