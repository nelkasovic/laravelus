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
                <form action="{{ action('CourseSkillController@index') }}" method="post">
                    <input name="_method" type="hidden" value="GET">
                    @csrf
                    <div class="block-content pb-4">
                        <select class="form-control form-control" id="cid" name="cid" title="{{ __('common.Course') }}"
                            onchange="this.form.submit()">
                            @if(@$courses)
                            <option value="">{{ __('common.Course') }}</option>
                            @foreach($courses as $course)
                            <option value="{{ $course->id }}" {{ (@$cid == $course->id ? 'selected':'') }}>
                                {{ $course->alias }} | {{ $course->name }} </option>
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
                                <a class="btn btn-warning btn-block" href="{{ action('CourseSkillController@index' )}}">
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
                    <h3 class="block-title">{{ __('common.Skills') }} </h3>

                </div>
                <form action="{{ action('CourseSkillController@attach', $cid) }}" method="POST">
                    <input name="_method" type="hidden" value="GET">

                    @csrf
                    <div class="block-content pb-4">
                        <select class="form-control form-control" id="sid" name="sid" title="{{ __('common.Skills') }}"
                            @if(@$cid) @else disabled @endif>
                            @if(@$skills)
                            @foreach($skills as $skill)
                            <option value="{{ $skill->id }}" {{ (@$selected_skill == $skill->id ? 'selected':'') }}>
                                {{ $skill->name }}</option>
                            @endforeach
                            @else
                            <option value="">{{ __('common.Skill') }}</option>
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

    @if(@$course_skills && @$current_course)
    <div class="row">

        <div class="col-md-12">
            @if (@$course_skills->count())
            <div class="block block-rounded block-fx-pop block-themed animated fadeIn">

                <div class="block-header block-header-default">
                    <h3 class="block-title">{{ __('common.Skills') }}
                        @if ($current_course)
                        {{__('common.From')}} {{ @$current_course->name }}
                        @endif
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
                        @foreach($course_skills as $skill)
                        <tbody class="js-table-sections-header">
                            <tr>
                                <td class="text-center">
                                    <i class="fa fa-angle-right text-muted"></i>
                                </td>
                                <td class="font-w600">
                                    <div class="py-1">
                                        {{ $skill->name }}
                                    </div>
                                </td>

                                <td class="d-none d-sm-table-cell text-right">
                                    @can('update courses')
                                    @if ($skill->id)

                                    <form action="{{ action('CourseSkillController@detach', [$cid, $skill->id]) }}"
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
                                        {{ __('common.Phone') }}: {{ $skill->description }}<br>

                                    </p>

                                    <p>
                                        <em
                                            class="text-muted">{{ Carbon::parse($skill->updated_at)->format('d.m.Y H:i')}}</em>
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

</div>
<!-- END Page Content -->



@endsection