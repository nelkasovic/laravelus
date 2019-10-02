@extends('layouts.app')

@section('content')


<!-- Page Content -->
<div class="content">
    <div class="row">
        <div class="col-md-6">
            <!-- Block Tabs With Options Default Style -->
            <div class="block block-rounded block-fx-pop block-themed">
                <div class="block-header block-header-default bg-gd-aqua">
                    <h3 class="block-title">{{ __('common.Courses') }} </h3>

                </div>
                <form action="{{ action('CourseObjectiveController@index') }}" method="POST">
                    <input name="_method" type="hidden" value="GET">
                    @csrf
                    <div class="block-content pb-4">

                        <select class="form-control form-control" id="cid" name="cid" title="{{ __('common.Course') }}"
                            onchange="this.form.submit()">
                            <option value="">{{ __('common.Course') }}</option>
                            @if(@$courses)
                            @foreach($courses as $course)
                            <option value="{{ $course->id }}" {{ (@$cid == $course->id ? 'selected':'') }}>
                                {{$course->alias}} | {{ $course->number}} | {{ $course->name }}</option>
                            @endforeach
                            @endif
                        </select>


                    </div>
                    <div class="block-content block-content-full text-right bg-light">
                        <div class="row">
                            <div class="col-md-6">

                            </div>
                            <div class="col-md-6">
                                <a class="btn btn-warning btn-block"
                                    href="{{ action('CourseObjectiveController@index' )}}">
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
            <div class="block block-rounded block-fx-pop block-themed">
                <div class="block-header block-header-default bg-gd-aqua">
                    <h3 class="block-title">{{ __('common.Objectives') }} </h3>

                </div>
                <form action="{{ action('CourseObjectiveController@attach', $cid) }}" method="post">
                    <input name="_method" type="hidden" value="GET">
                    @csrf
                    <div class="block-content pb-4">
                        <select class="form-control form-control" id="oid" name="oid"
                            title="{{ __('common.Objective') }}" @if(@!$cid) disabled @endif>
                            @if(@$cid)
                            @foreach($objectives as $objective)
                            <option value="{{ $objective->id }}" {{ (@$oid == $objective->id ? 'selected':'') }}>
                                {{ $objective->name }} </option>
                            @endforeach
                            @else
                            <option value="">{{ __('common.Objective') }}</option>
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

    @if(@$course_objectives && @$current_course)
    <div class="row">
        <div class="col-md-12">
            @if (@$course_objectives->count())
            <!-- Table Sections (.js-table-sections class is initialized in Helpers.tableToolsSections()) -->

            <div class="block block-rounded block-fx-pop block-themed animated fadeIn">

                <div class="block-header block-header-default">
                    <h3 class="block-title">{{ __('common.Objectives') }}
                        @if ($current_course)
                        | {{ @$current_course->name }}
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
                        @foreach($course_objectives as $objective)
                        <tbody class="js-table-sections-header">
                            <tr>
                                <td class="text-center">
                                    <i class="fa fa-angle-right text-muted"></i>
                                </td>
                                <td class="font-w600">
                                    <div class="py-1">
                                        <a href="#">{{ $objective->name }}</a>
                                    </div>
                                </td>


                                <td class="d-none d-sm-table-cell text-right">
                                    @can('delete objectives')
                                    @if ($objective->id)

                                    <form
                                        action="{{ action('CourseObjectiveController@detach', [$cid, $objective->id]) }}"
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
                                        {{ __('common.Phone') }}: {{ $objective->description }}<br>

                                    </p>

                                    <p>
                                        <em
                                            class="text-muted">{{ Carbon::parse($objective->updated_at)->format('d.m.Y H:i')}}</em>
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
    @endif
    <!-- END Table Sections -->
</div>
<!-- END Page Content -->


@endsection