@extends('layouts.app')

@section('content')

<!-- Page Content -->
<div class="content">

    @if (@$grade)

    {{-- We are here only if variable is available --}}

    @if (@$action === 'edit' || @$action === 'readonly')

    <form action="{{action('GradeController@update', $id)}}" enctype="multipart/form-data" method="post">
        @csrf

        <input name="_method" type="hidden" value="PATCH">

        <!-- Block Tabs With Options Default Style -->
        <div class="block block-rounded block-fx-pop block-themed">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ __('common.Grade') }} | {{ $grade->person->first_name }}
                    {{ $grade->person->last_name }} | {{ $grade->event->name }} | {{ $grade->event->course->name }}</h3>
            </div>
            <div class="block-content pb-4">
                <h2 class="content-heading">{{ __('common.Edit') }}</h2>

                <div class="row">

                    <div class="form-group col-xl-2 col-lg-6">
                        <label class="text-muted mb-0 font-size-sm"
                            for="person_id"><small>{{ __('common.Student') }}</small></label>
                        <select class="form-control" id="person_id" name="person_id" title="{{ __('common.Student') }}"
                            disabled>
                            <option value="">{{ __('common.Select') }}</option>
                            @foreach($students as $student)
                            <option value="{{ $student->id }}"
                                {{ ($grade->person_id == $student->id ? 'selected':'') }}>{{ $student->first_name }}
                                {{ $student->last_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-xl-2 col-lg-6">
                        <label class="text-muted mb-0 font-size-sm"
                            for="event_id"><small>{{ __('common.Event') }}</small></label>
                        <select class="form-control" id="event_id" name="event_id" title="{{ __('common.Event') }}"
                            disabled>
                            <option value="">{{ __('common.Select') }}</option>
                            @foreach($events as $event)
                            <option value="{{ $event->id }}" {{ ($grade->event_id == $event->id ? 'selected':'') }}>
                                {{ $event->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-xl-2 col-lg-6">
                        <label class="text-muted mb-0 font-size-sm"
                            for="passed"><small>{{ __('common.Passed') }}</small></label>
                        <select {{ $action }} class="form-control" id="passed" name="passed">
                            <option value="" {{ $grade->passed == '' ? 'selected':'' }}>{{ __('common.Select') }}
                            </option>
                            <option value="1" {{ $grade->passed == 1 ? 'selected':'' }}>{{ __('common.Yes') }}</option>
                            <option value="0" {{ $grade->passed == 0 ? 'selected':'' }}>{{ __('common.No') }}</option>
                        </select>
                    </div>

                    <div class="form-group col-xl-2 col-lg-6">
                        <label class="text-muted mb-0 font-size-sm"
                            for="grade"><small>{{ __('common.Grade') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('grade') ? "is-invalid" : "" }}" id="grade"
                            name="grade" placeholder="{{ __('common.Grade') }}" value="{{ $grade->grade }}">
                    </div>


                    <div class="form-group col-xl-2 col-lg-6">
                        <label class="text-muted mb-0 font-size-sm"
                            for="ects"><small>{{ __('common.ECTS') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('ects') ? "is-invalid" : "" }}" id="ects" name="ects"
                            placeholder="{{ __('common.ECTS') }}" value="{{ $grade->ects }}">
                    </div>

                    <div class="form-group col-xl-2 col-lg-6">
                        <label class="text-muted mb-0 font-size-sm"
                            for="points"><small>{{ __('common.Points') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('points') ? "is-invalid" : "" }}" id="points"
                            name="points" placeholder="{{ __('common.Points') }}" value="{{ $grade->points }}">
                    </div>

                    <div class="form-group col-xl-12">
                        <label class="text-muted mb-0 font-size-sm"
                            for="description"><small>{{ __('common.Description') }}</small></label>
                        <textarea {{ $action }} rows="5"
                            class="form-control {{ @$errors->has('description') ? "is-invalid" : "" }}" id="description"
                            name="description"
                            placeholder="{{ __('common.Description') }}">{{ $grade->description }}</textarea>
                    </div>
                </div>
            </div>

            <div class="block-content block-content-full text-right bg-light">
                @can('delete grades')
                <a class="btn btn-danger" href="{{ action('GradeController@destroy', $id) }}">
                    <i class="si si-trash mr-1"></i>
                    {{ __('common.Delete') }}
                </a>
                @endcan


                <a class="btn btn-warning" href="{{ action('GradeController@index') }}">
                    <i class="si si-action-undo mr-1"></i>
                    {{ __('common.Close') }}
                </a>
                @if (@$action === 'edit')
                <button type="submit" class="btn btn-primary">
                    <i class="si si-fire mr-1"></i>
                    {{ __('common.Save') }}
                </button>
                @endif
            </div>
        </div>
    </form>

    @elseif (@$action === 'create')


    <form action="{{action('GradeController@store')}}" enctype="multipart/form-data" method="post">
        @csrf
        <input name="_method" type="hidden" value="POST">

        <!-- Block Tabs With Options Default Style -->
        <div class="block block-rounded block-fx-pop block-themed">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ __('common.Grade') }}</h3>
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

            <div class="block-content pb-4">
                <h2 class="content-heading">{{ __('common.New') }}</h2>

                <div class="row">

                    <div class="form-group col-xl-2 col-lg-6">
                        <label class="text-muted mb-0 font-size-sm"
                            for="person_id"><small>{{ __('common.Student') }}</small></label>
                        <select class="form-control" id="person_id" name="person_id" title="{{ __('common.Student') }}">
                            <option value="">{{ __('common.Select') }}</option>
                            @foreach($students as $student)
                            <option value="{{ $student->id }}"
                                {{ (old('person_id') == $student->id || @$pid == $student->id ? 'selected':'') }}>
                                {{ $student->first_name }} {{ $student->last_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-xl-2 col-lg-6">
                        <label class="text-muted mb-0 font-size-sm"
                            for="event_id"><small>{{ __('common.Event') }}</small></label>
                        <select class="form-control" id="event_id" name="event_id" title="{{ __('common.Event') }}">
                            <option value="">{{ __('common.Select') }}</option>
                            @foreach($events as $event)
                            <option value="{{ $event->id }}"
                                {{ (old('event_id') == $event->id || @$eid == $event->id ? 'selected':'') }}>
                                {{ $event->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-xl-2 col-lg-6">
                        <label class="text-muted mb-0 font-size-sm"
                            for="passed"><small>{{ __('common.Passed') }}</small></label>
                        <select {{ $action }} class="form-control" id="passed" name="passed">
                            <option value="" {{ old('passed') == '' ? 'selected':'' }}>{{ __('common.Select') }}
                            </option>
                            <option value="1" {{ old('passed') == 1 ? 'selected':'' }}>{{ __('common.Yes') }}</option>
                            <option value="0" {{ old('passed') == 0 ? 'selected':'' }}>{{ __('common.No') }}</option>
                        </select>
                    </div>

                    <div class="form-group col-xl-2 col-lg-6">
                        <label class="text-muted mb-0 font-size-sm"
                            for="grade"><small>{{ __('common.Grade') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('grade') ? "is-invalid" : "" }}" id="grade"
                            name="grade" placeholder="{{ __('common.Grade') }}" value="{{ old('grade') }}">
                    </div>


                    <div class="form-group col-xl-2 col-lg-6">
                        <label class="text-muted mb-0 font-size-sm"
                            for="ects"><small>{{ __('common.ECTS') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('ects') ? "is-invalid" : "" }}" id="ects" name="ects"
                            placeholder="{{ __('common.ECTS') }}" value="{{ old('ects') }}">
                    </div>

                    <div class="form-group col-xl-2 col-lg-6">
                        <label class="text-muted mb-0 font-size-sm"
                            for="points"><small>{{ __('common.Points') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('points') ? "is-invalid" : "" }}" id="points"
                            name="points" placeholder="{{ __('common.Points') }}" value="{{ old('points') }}">
                    </div>

                    <div class="form-group col-xl-12">
                        <label class="text-muted mb-0 font-size-sm"
                            for="description"><small>{{ __('common.Description') }}</small></label>
                        <textarea {{ $action }} rows="5"
                            class="form-control {{ @$errors->has('description') ? "is-invalid" : "" }}" id="description"
                            name="description"
                            placeholder="{{ __('common.Description') }}">{{ old('points') }}</textarea>
                    </div>

                </div>

            </div>
            <div class="block-content block-content-full text-right bg-light">


                <a class="btn btn-warning" href="{{ URL::previous() }}">
                    <i class="si si-action-undo mr-1"></i>
                    {{ __('common.Close') }}
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="si si-fire mr-1"></i>
                    {{ __('common.Save') }}
                </button>
            </div>
        </div>
    </form>


    @endif
    @endif

    @if (@$grades)
    <!-- Table Sections (.js-table-sections class is initialized in Helpers.tableToolsSections()) -->
    <div class="block block-rounded block-themed block-fx-pop">

        <div class="block-header block-header-default bg-primary-darker">
            <h3 class="block-title">{{ __('common.Grades') }}</h3>
            <div class="block-options">
                <div class="btn-group">
                    @can('read grades')
                    <a class="btn btn-light btn-sm" href="javascript:void(0)" onclick="getGrades();">
                        <i class="si si-share-alt mr-1"></i> {{ __('common.Grades') }} XHR</span>
                    </a>
                    <a class="btn btn-light btn-sm" href="{{action('ExportController@grades')}}">
                        <i class="si si-share-alt mr-1"></i> {{ __('common.Excel') }}</span>
                    </a>
                    @endcan
                    @can('create grades')
                    <a class="btn btn-primary btn-sm" href="{{action('GradeController@create')}}">
                        <i class="si si-user mr-1"></i> {{ __('common.Grade') }} <span
                            class="text-lowercase">{{ __('common.Add') }}</span>
                    </a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="block-content">
            <form action="{{action('GradeController@index')}}" method="post">
                @csrf
                <div class="row mb-4">
                    <div class="col-xl-5">
                        <div class="form-group">
                            <select class="form-control" id="study_id" name="study_id" title="{{ __('common.Study') }}"
                                onchange="this.form.submit()">
                                <option value="">{{ __('common.Study') }}</option>
                                @foreach($studies as $study)
                                <option value="{{ $study->id }}" {{ ($study_id == $study->id ? 'selected':'') }}>
                                    {{ $study->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-5">
                        <div class="form-group">
                            <select class="form-control" id="event_id" name="event_id" title="{{ __('common.Event') }}"
                                onchange="this.form.submit()" @if($study_id) data-study="{{ $study_id }}" @else disabled
                                @endif>
                                <option value="">{{ __('common.Event') }}</option>
                                @foreach($events as $event)
                                <option value="{{ $event->id }}" {{ ($event_id == $event->id ? 'selected':'') }}>
                                    {{ Carbon::parse($event->start_date)->format('d.m.Y') }} |
                                    {{ $event->course->alias }} | {{ $event->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
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
                            @sortablelink('person_id', __('common.Person'))
                        </th>
                        <th class="d-none d-xl-table-cell">
                            @sortablelink('event_id', __('common.Event'))
                        </th>
                        <th class="d-none d-xl-table-cell">
                            @sortablelink('user_id', __('common.Teacher'))
                        </th>
                        <th class="d-none d-lg-table-cell">
                            @sortablelink('passed', __('common.Passed'))
                        </th>
                        <th class="d-none d-lg-table-cell">
                            @sortablelink('grade', __('common.Grade'))
                        </th>
                        <th class="d-none d-xl-table-cell text-right">
                            @sortablelink('updated_at', __('common.DateUpdated'))
                        </th>

                        <th class="text-right d-none d-sm-table-cell">

                        </th>
                    </tr>
                </thead>
                @csrf

                @foreach($grades as $grade)
                <tbody class="js-table-sections-header">
                    <tr>
                        <td class="text-center">
                            <i class="fa fa-angle-right text-muted"></i>
                        </td>
                        <td>
                            <div class="py-1 text-capitalize">
                                <a href="{{action('GradeController@show', $grade->id)}}">{{ $grade->person->first_name }}
                                    {{ $grade->person->last_name }}</a>
                            </div>
                        </td>

                        <td class="d-none d-xl-table-cell">
                            <div class="py-1">
                                <a
                                    href="{{action('EventController@show', $grade->event_id)}}">{{ $grade->event->name }}</a>
                            </div>
                        </td>
                        <td class="d-none d-xl-table-cell">
                            <div class="py-1">
                                <a href="{{action('PersonController@show', $grade->user->person_id)}}">{{ $grade->user->person->first_name }}
                                    {{ $grade->user->person->last_name }}</a>
                            </div>
                        </td>
                        <td class="d-none d-lg-table-cell">
                            <div class="py-1">
                                @if($grade->passed)
                                <i class="si si-like text-success"></i>
                                @else
                                <i class="si si-dislike text-danger"></i>
                                @endif
                            </div>
                        </td>
                        <td class="d-none d-lg-table-cell">
                            <div class="py-1">
                                <a href="#"
                                    class="btn @if($grade->grade < 3) btn-danger @elseif($grade->grade < 4 && $grade->grade > 3) btn-warning @else btn-info @endif btn-sm"
                                    title="{{ $grade->description }}">
                                    {{ $grade->grade }}
                                </a>
                            </div>
                        </td>
                        <td class="d-none d-xl-table-cell text-right">
                            <div class="py-1">
                                {{ Carbon::parse($grade->updated_at)->format('d.m.Y H:i')}}
                            </div>
                        </td>

                        <td class="d-none d-sm-table-cell text-right">
                            @can('update grades')
                            <a href="{{action('GradeController@edit', $grade->id)}}" class="btn btn-sm btn-primary">
                                <i class="nav-main-link-icon si si-pencil"></i>
                            </a>
                            @endcan

                            @can('delete grades')
                            <form action="{{action('GradeController@destroy', $grade->id)}}" method="post"
                                class="d-inline">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">

                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="nav-main-link-icon si si-trash"></i>
                                </button>
                            </form>
                            @endcan
                        </td>
                    </tr>
                </tbody>
                <tbody class="font-size-sm">
                    <tr>
                        <td class="text-center"></td>
                        <td colspan="10">
                            <h4>{{ __('common.Description') }}</h4>
                            <p>{{ $grade->description }}
                                <em class="text-muted">{{ Carbon::parse($grade->updated_at)->format('d.m.Y H:i')}}</em>
                        </td>
                    </tr>
                </tbody>
                @endforeach
            </table>

        </div>

        @if ($grades->total() > $grades->perPage())
        <div
            class="block-content block-content-full block-content-sm bg-body-light d-flex justify-content-center align-content-center">
            {!! $grades->appends(\Request::except('page'))->render() !!}
        </div>
        @endif
    </div>
    @endif

    <!-- END Table Sections -->
</div>
<!-- END Page Content -->


@endsection