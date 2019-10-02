@extends('layouts.app')

@section('content')


<!-- Page Content -->
<div class="content">
    <div class="row">
        <div class="col-md-6">
            <!-- Block Tabs With Options Default Style -->
            <div class="block block-rounded block-themed block-fx-pop">
                <div class="block-header block-header-default bg-gd-aqua">
                    <h3 class="block-title">{{ __('common.Courses') }} </h3>

                </div>
                <form action="{{ action('CourseRoomController@index') }}" method="post">
                    <input name="_method" type="hidden" value="GET">
                    @csrf
                    <div class="block-content pb-4">
                        <select class="form-control form-control" id="cid" name="cid" title="{{ __('common.Course') }}"
                            onchange="this.form.submit()">
                            <option value="">{{ __('common.Course') }}</option>
                            @foreach($courses as $course)
                            <option value="{{ $course->id }}" {{ (@$cid == $course->id ? 'selected':'') }}>
                                {{ $course->alias }} | {{ $course->name }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="block-content block-content-full text-right bg-light">
                        <div class="row">
                            <div class="col-md-6">

                            </div>
                            <div class="col-md-6">
                                <a class="btn btn-warning btn-block" href="{{ action('CourseRoomController@index' )}}">
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
                    <h3 class="block-title">{{ __('common.Rooms') }} </h3>

                </div>
                <form action="{{ action('CourseRoomController@attach', $cid) }}" method="POST">
                    <input name="_method" type="hidden" value="GET">

                    @csrf
                    <div class="block-content pb-4">


                        <select class="form-control form-control" id="rid" name="rid" title="{{ __('common.Rooms') }}"
                            @if(@!$cid) disabled @endif>
                            <option value="">{{ __('common.Rooms') }}</option>
                            @if(@$rooms)
                            @foreach($rooms as $room)
                            <option value="{{ $room->id }}" {{ (@$selected_room == $room->id ? 'selected':'') }}>
                                {{ $room->name }}</option>
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
                                    {{ (@$cid > 0 ? '':'disabled') }}>
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

    @if(@$course_rooms && @$current_course)
    <div class="row">

        <div class="col-md-12">
            @if (@$course_rooms->count())
            <!-- Table Sections (.js-table-sections class is initialized in Helpers.tableToolsSections()) -->

            <div class="block block-rounded block-themed block-fx-pop animated fadeIn">

                <div class="block-header block-header-default">
                    <h3 class="block-title">{{ __('common.Rooms') }}

                        {{__('common.From')}} {{ @$current_course->name }}
                    </h3>
                </div>

                <div class="block-content">

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

                        @foreach(@$course_rooms as $room)
                        <tbody class="js-table-sections-header">
                            <tr>
                                <td class="text-center">
                                    <i class="fa fa-angle-right text-muted"></i>
                                </td>
                                <td class="font-w600">
                                    <div class="py-1">
                                        {{ $room->name }}
                                    </div>
                                </td>

                                <td class="d-none d-sm-table-cell text-right">
                                    @can('update rooms')
                                    @if ($room->id)

                                    <form action="{{ action('CourseRoomController@detach', [$cid, $room->id]) }}"
                                        method="POST">
                                        <input name="_method" type="hidden" value="GET">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            title="{{__('common.Delete')}}">
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
                                        {{ __('common.Description') }}: {{ $room->description }}<br>

                                    </p>

                                    <p>
                                        <em
                                            class="text-muted">{{ Carbon::parse($room->updated_at)->format('d.m.Y H:i')}}</em>
                                    </p>
                                </td>

                            </tr>

                        </tbody>
                        @endforeach
                    </table>

                </div>

                @if ($course_rooms->total() > $course_rooms->perPage())
                <div
                    class="block-content block-content-full block-content-sm bg-body-light d-flex justify-content-center align-content-center">
                    {!! $course_rooms->appends(\Request::except('page'))->render() !!}
                </div>
                @endif
            </div>
            @endif
        </div>
    </div>
    @endif
    <!-- END Table Sections -->
</div>
<!-- END Page Content -->


@endsection