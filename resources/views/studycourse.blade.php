@extends('layouts.app')

@section('content')

<!-- Page Content -->
<div class="content">
    <div class="row">
        <div class="col-md-6">
            <!-- Block Tabs With Options Default Style -->
            <div class="block block-rounded block-themed block-fx-pop">
                <div class="block-header block-header-default bg-gd-aqua">
                    <h3 class="block-title">{{ __('common.Studies') }} </h3>

                </div>
                <form action="{{ action('StudyCourseController@index') }}" method="POST">
                    <input name="_method" type="hidden" value="POST">
                    @csrf
                    <div class="block-content pb-4">
                        <select class="form-control form-control" id="sid" name="sid" title="{{ __('common.Study') }}"
                            onchange="this.form.submit()">
                            <option value="">{{ __('common.Study') }}</option>
                            @foreach($studies as $study)
                            <option value="{{ $study->id }}" {{ ($sid == $study->id ? 'selected':'') }}>
                                {{ $study->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="block-content block-content-full text-right bg-light">
                        <div class="row">
                            <div class="col-md-6">

                            </div>
                            <div class="col-md-6">
                                <a class="btn btn-warning btn-block" href="{{ action('StudyCourseController@index')}}">
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
                    <h3 class="block-title">{{ __('common.Courses') }} </h3>

                </div>
                <form action="{{ action('StudyCourseController@attach', $sid) }}" method="POST">
                    <input name="_method" type="hidden" value="POST">
                    @csrf
                    <div class="block-content pb-4">
                        <select class="form-control form-control" id="cid" name="cid" title="{{ __('common.Course') }}"
                            @if(@!$sid) disabled @endif>
                            <option value="">{{ __('common.Course') }}</option>
                            @foreach($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->alias }} | {{ $course->name }}</option>
                            @endforeach
                        </select>


                    </div>
                    <div class="block-content block-content-full text-right bg-light">
                        <div class="row">
                            <div class="col-md-6">

                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary btn-block"
                                    {{ (old('sid') || @$sid ? '':'disabled') }}>
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

    @if(@$study_courses && $current_study)
    <div class="row">
        <div class="col-md-12">
            @if (@$study_courses->count())
            <!-- Table Sections (.js-table-sections class is initialized in Helpers.tableToolsSections()) -->

            <div class="block block-rounded block-themed block-fx-pop animated fadeIn">

                <div class="block-header block-header-default">
                    <h3 class="block-title">{{ __('common.Courses') }}
                        @if ($current_study)
                        {{__('common.From')}} {{ @$current_study->name }}
                        @endif
                    </h3>
                </div>

                <div class="block-content">

                    <table class="js-table-sections table table-hover table-vcenter">
                        <thead>
                            <tr>
                                <th style="width: 30px; border-top: none;"></th>
                                <th style="border-top: none;">
                                    @sortablelink('number', __('common.Number'))
                                </th>
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
                        @foreach($study_courses as $course)
                        <tbody class="js-table-sections-header">
                            <tr>
                                <td class="text-center">
                                    <i class="fa fa-angle-right text-muted"></i>
                                </td>
                                <td class="font-w600">
                                    <div class="py-1">
                                        <a href="#">{{ $course->number }}</a>
                                    </div>
                                </td>
                                <td class="font-w600">
                                    <div class="py-1">
                                        <a href="#">{{ $course->alias }}</a>
                                    </div>
                                </td>
                                <td class="font-w600">
                                    <div class="py-1">
                                        <a href="#">{{ $course->name }}</a>
                                    </div>
                                </td>


                                <td class="d-none d-sm-table-cell text-right">

                                    @can('update studies')
                                    @if ($study->id)
                                    <form action="{{ action('StudyCourseController@detach', [$sid, $course->id]) }}"
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
                                    <p>
                                        {{ __('common.Phone') }}: {{ $course->description }}<br>

                                    </p>

                                    <p>
                                        <em
                                            class="text-muted">{{ Carbon::parse($course->updated_at)->format('d.m.Y H:i')}}</em>
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