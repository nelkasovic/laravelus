@extends('layouts.app')

@section('content')

<!-- Page Content -->
<div class="content">

    <!-- If edit or create or password -->
    @if (@$script)

    {{-- We are here only if variable typeitem is available --}}

    @if (@$action === 'edit' || @$action === 'readonly')


    <form action="{{action('ScriptController@update', $script->id)}}" enctype="multipart/form-data" method="post">
        @csrf
        <input name="_method" type="hidden" value="PATCH">

        <!-- Block Tabs With Options Default Style -->
        <div class="block block-rounded block-themed block-fx-pop @if($scripttopics) block-mode-hidden @endif">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ $script->name }}</h3>

                <a href="{{action('CourseController@show', $script->course->id)}}" class="btn btn-primary btn-sm">
                    <i class="nav-main-link-icon si si-action-redo mr-2"></i> {{ __('common.Course') }}
                    {{ $script->course->alias }}
                </a>
                &nbsp;
                <a href="{{action('EventController@show', $script->event->id)}}" class="btn btn-primary btn-sm">
                    <i class="nav-main-link-icon si si-action-redo mr-2"></i> {{ __('common.Event') }}
                    {{ $script->event->alias }}
                </a>

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
                <h2 class="content-heading">{{ __('common.Edit') }}</h2>
                <div class="row">

                    <div class="col-lg-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="study_id"><small>{{ __('common.Study') }}</small></label>
                        <select class="form-control" id="study_id" name="study_id" title="{{ __('common.Study') }}"
                            onchange="this.form.submit()">
                            <option value="">{{ __('common.Select') }}</option>
                            @foreach($studies as $study)
                            <option value="{{ $study->id }}" {{ (old('course_id') == $study->id ? 'selected':'') }}>
                                {{ $study->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="col-lg-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="course_id"><small>{{ __('common.Course') }}</small></label>
                        <select class="form-control" id="course_id" name="course_id" title="{{ __('common.Course') }}">
                            <option value="">{{ __('common.Select') }}</option>
                            @foreach($courses as $course)
                            <option value="{{ $course->id }}" {{ ($script->course_id == $course->id ? 'selected':'') }}>
                                {{ $course->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-lg-4">
                        <label class="text-muted mb-0 font-size-sm"
                            for="name"><small>{{ __('common.Name') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('name') ? "is-invalid" : "" }}" id="name" name="name"
                            placeholder="{{ __('common.Name') }}" value="{{ $script->name }}">
                    </div>

                    <div class="form-group col-lg-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="active"><small>{{ __('common.Active') }}</small></label>
                        <select {{ $action }} class="form-control" id="active" name="active">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="" {{ ($script->active == 0 ? 'selected':'') }}>{{ __('common.Inactive') }}
                            </option>
                            <option value="1" {{ ($script->active == 1 || $script->active == '' ? 'selected':'') }}>
                                {{ __('common.Active') }}</option>
                        </select>
                    </div>

                    <div class="form-group col-lg-12">
                        <label class="text-muted mb-0 font-size-sm"
                            for="description"><small>{{ __('common.Description') }}</small></label>
                        <textarea {{ $action }} rows="4"
                            class="form-control {{ @$errors->has('description') ? "is-invalid" : "" }}" id="description"
                            name="description"
                            placeholder="{{ __('common.Description') }}">{{ $script->description }}</textarea>
                    </div>

                </div>


            </div>
            <div class="block-content block-content-full text-right bg-light">


                <a class="btn btn-warning" href="{{action('ScriptController@index')}}">
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


    @if (@$scripttopics && $action === 'readonly')
    <!-- Table Sections (.js-table-sections class is initialized in Helpers.tableToolsSections()) -->
    @foreach($scripttopics as $topic)
    <div
        class="block block-rounded block-fx-pop @if($loop->iteration == 1 && $highlighted == 0) block-themed @endif @if($topic->pivot->highlight) block-themed @endif @if($topic->pivot->highlight == 0) block-mode-hidden @endif">

        <div class="block-header block-header-default @if($topic->pivot->highlight) bg-gd-aqua @endif">
            <h3 class="block-title">{{ $loop->iteration }}. {{ $topic->name }}</h3>
            <div class="btn-group">

                @can('highlight topics')
                <a href="{{action('ScriptController@topicHighlight', [$script->id, $topic->id])}}"
                    class="btn @if($topic->pivot->highlight) btn-dark @else btn-light @endif btn-sm">
                    <i class="nav-main-link-icon si si-star mr-2"></i> {{ __('common.Highlight') }}
                </a>
                @endcan

                @can('move topics')
                @if($loop->iteration > 1)
                <a href="{{action('ScriptController@topicUp', [$script->id, $topic->id])}}"
                    class="btn btn-light btn-sm">
                    <i class="nav-main-link-icon si si-arrow-up mr-2"></i> {{ __('common.MoveUp') }}
                </a>
                @endif

                <a href="{{action('ScriptController@topicDown', [$script->id, $topic->id])}}"
                    class="btn btn-light btn-sm">
                    <i class="nav-main-link-icon si si-arrow-down mr-2"></i> {{ __('common.MoveDown') }}
                </a>
                @endcan
            </div>

            <div class="block-options">
                <button type="button" class="btn-block-option" data-toggle="block-option"
                    data-action="fullscreen_toggle"></button>
                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="pinned_toggle">
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

        <div class="block-content">

            <p>{{ $topic->description }}</p>

            <table class="table table-vcenter js-table-sections table-hover">
                <thead>
                    <tr>
                        <th style="width: 30px; border-top: none;">#</th>
                        <th style="border-top: none;">{{ __('common.Name') }}</th>
                        <th style="border-top: none;">{{ __('common.Tools') }}</th>
                        <th style="border-top: none;">{{ __('common.Method') }}</th>
                        <th style="border-top: none;">{{ __('common.Duration') }}</th>
                        <th class="text-right" style="border-top: none;">
                            @can('update units')
                            <a class="btn btn-dark btn-sm"
                                href="{{action('ScriptController@unitReorder', $topic->id)}}">
                                <i class="si si-refresh"></i>
                            </a>
                            @endcan

                            @can('create units')
                            <a class="btn btn-dark btn-sm"
                                href="{{action('TopicController@create', $script->course->id)}}">
                                <i class="si si-plus"></i>
                            </a>
                            @endcan
                        </th>
                    </tr>
                </thead>

                @csrf

                @foreach($topic->units as $unit)

                <tbody class="js-table-sections-header">
                    <tr class="@if(@$unit->active == 0) text-warning @endif">
                        <td class="text-center">
                            {{ $unit->pivot->position }}.
                        </td>
                        <td>
                            <div class="py-1">
                                {{ $unit->name }} @if(@$unit->active == 0)
                                <a class="badge badge-dark" href="javascript:void(0)">{{ __('common.Duplicate') }}</a>
                                @endif
                            </div>
                        </td>

                        <td>
                            <div class="py-1">
                                {{ $unit->tools }}
                            </div>
                        </td>
                        <td>
                            <div class="py-1">
                                <button type="button"
                                    class="btn btn-sm btn-info d-none">{{ $unit->category->name }}</button>
                                @if(!$unit->methods->count())
                                <a href="{{ action('UnitController@method', [$unit->id, 1]) }}"
                                    class="btn btn-sm btn-secondary">
                                    <i class="icon si si-plus"></i>
                                </a>
                                @endif

                                @if(@$unit->task == 1)
                                <a href="{{ action('UnitController@task', $unit->id) }}"
                                    class="btn btn-sm btn-secondary">{{ __('common.Task') }}</a>
                                @else
                                <a href="{{ action('UnitController@task', $unit->id) }}"
                                    class="btn btn-sm btn-warning">{{ __('common.Input') }}</a>
                                @endif
                                @foreach ($unit->methods as $method)
                                <a href="{{ action('UnitController@method', [$unit->id, $method->id]) }}"
                                    class="btn btn-sm btn-primary" data-toggle="popover" data-placement="right"
                                    title="{{$method->name}}" data-html="true"
                                    data-content="<h6 class='mb-1'>{{ __('common.Description') }}</h6><p>{{$method->description}}</p><h6 class='mb-1'>{{ __('common.Approach') }}</h6><p>{{$method->approach}}</p><h6 class='mb-1'>{{ __('common.Effect') }}</h6><p>{{$method->effect}}</p>">{{ $method->name }}</a>
                                @endforeach

                            </div>
                        </td>
                        <td>
                            <div
                                class="py-1 @if(Carbon::parse($unit->start_date)->diffInMinutes(Carbon::parse($unit->end_date)) > 15 && !$unit->task) text-danger @endif">
                                {{ Carbon::parse($unit->start_date)->diffInMinutes(Carbon::parse($unit->end_date)) }}
                                Min.
                            </div>
                        </td>
                        <td class="d-none d-sm-table-cell text-right">

                            <div class="btn-group">

                                @can('vote units')
                                <a href="{{action('UnitController@upvote', $unit->id)}}" class="btn btn-light btn-sm"
                                    title="{{ __('common.VoteUp') }}">
                                    <i class="nav-main-link-icon si si-like mr-2"></i> {{ $unit->upVotesCount() }}
                                </a>

                                <a href="{{action('UnitController@downvote', $unit->id)}}" class="btn btn-light btn-sm"
                                    title="{{ __('common.VoteDown') }}">
                                    <i class="nav-main-link-icon si si-dislike mr-2"></i> {{ $unit->downVotesCount() }}
                                </a>
                                @endcan

                                @can('move units')
                                <a href="{{action('ScriptController@unitUp', [$topic->id, $unit->id])}}"
                                    class="btn btn-light btn-sm" title="{{ __('common.MoveUp') }}">
                                    <i class="nav-main-link-icon si si-arrow-up"></i>
                                </a>

                                <a href="{{action('ScriptController@unitDown', [$topic->id, $unit->id])}}"
                                    class="btn btn-light btn-sm" title="{{ __('common.MoveDown') }}">
                                    <i class="nav-main-link-icon si si-arrow-down"></i>
                                </a>
                                @endcan

                            </div>
                            @can('update units')
                            <a href="{{action('UnitController@replicate', [$topic->id, $unit->id])}}"
                                class="btn btn-sm btn-info" title="{{ __('common.Replicate') }}">
                                <i class="nav-main-link-icon si si-share-alt"></i>
                            </a>

                            <a href="{{ action('UnitController@edit', $unit->id) }}" class="btn btn-primary btn-sm"
                                title="{{ __('common.Edit') }}">
                                <i class="nav-main-link-icon si si-pencil"></i>
                            </a>
                            @endcan
                            @can('delete topics')
                            <form action="{{ action('TopicController@destroy', $topic['id']) }}" method="post"
                                class="d-inline" title="{{ __('common.Delete') }}">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-sm">
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
                        <td colspan="15">
                            <p>{{ $unit->description }}</p>
                            <h4>{{ __('common.Methods') }}</h4>
                            <ul>
                                @foreach ($unit->methods as $method)
                                <li class="mb-2"><strong>{{ $method->name }}</strong><br>{{ $method->description }}</li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                </tbody>

                @endforeach
            </table>
        </div>
    </div>
    @endforeach
    @endif

    <!-- END Block Tabs With Options Default Style -->
    @elseif (@$action === 'create')

    <form action="{{action('ScriptController@store')}}" enctype="multipart/form-data" method="post">
        @csrf
        <input name="_method" type="hidden" value="POST">

        <!-- Block Tabs With Options Default Style -->
        <div class="block block-rounded block-themed">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ __('common.Script') }}</h3>
            </div>
            <div class="block-content pb-4">
                <h2 class="content-heading">{{ __('common.New') }}</h2>
                <div class="row">

                    <div class="col-lg-5">
                        <label class="text-muted mb-0 font-size-sm"
                            for="course_id"><small>{{ __('common.Course') }}</small></label>
                        <select class="form-control" id="course_id" name="course_id" title="{{ __('common.Course') }}">
                            <option value="">{{ __('common.Select') }}</option>
                            @foreach($courses as $course)
                            <option value="{{ $course->id }}" {{ (old('course_id') == $course->id ? 'selected':'') }}>
                                {{ $course->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-lg-5">
                        <label class="text-muted mb-0 font-size-sm"
                            for="name"><small>{{ __('common.Name') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('name') ? "is-invalid" : "" }}" id="name" name="name"
                            placeholder="{{ __('common.Name') }}" value="{{ old('name') }}">
                    </div>

                    <div class="form-group col-lg-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="active"><small>{{ __('common.Active') }}</small></label>
                        <select {{ $action }} class="form-control" id="active" name="active">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="" {{ (old('active') == 0 ? 'selected':'') }}>{{ __('common.Inactive') }}
                            </option>
                            <option value="1" {{ (old('active') == 1 || old('active') == '' ? 'selected':'') }}>
                                {{ __('common.Active') }}</option>
                        </select>
                    </div>

                    <div class="form-group col-lg-12">
                        <label class="text-muted mb-0 font-size-sm"
                            for="description"><small>{{ __('common.Description') }}</small></label>
                        <textarea {{ $action }} rows="4"
                            class="form-control {{ @$errors->has('description') ? "is-invalid" : "" }}" id="description"
                            name="description"
                            placeholder="{{ __('common.Description') }}">{{ old('description') }}</textarea>
                    </div>

                </div>


            </div>
            <div class="block-content block-content-full text-right bg-light">


                <a class="btn btn-warning" href="{{action('ScriptController@index')}}">
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

    @if (@$scripts)
    <!-- Table Sections (.js-table-sections class is initialized in Helpers.tableToolsSections()) -->
    <div class="block block-rounded block-themed block-fx-pop">

        <div class="block-header block-header-default bg-primary-darker">
            <h3 class="block-title">{{ __('common.Users') }}</h3>
            <div class="block-options">
                <div class="btn-group">
                    @can('read scripts')
                    <a class="btn btn-light btn-sm" href="javascript:void(0)" onclick="getScripts();">
                        <i class="si si-share-alt mr-1"></i> {{ __('common.Scripts') }} XHR</span>
                    </a>
                    <a class="btn btn-light btn-sm" href="{{action('ExportController@scripts')}}">
                        <i class="si si-share-alt mr-1"></i> {{ __('common.Excel') }}</span>
                    </a>
                    @endcan

                    @can('create scripts')
                    <a class="btn btn-primary btn-sm" href="{{action('ScriptController@create')}}">
                        <i class="si si-user mr-1"></i> {{ __('common.Script') }} <span
                            class="text-lowercase">{{ __('common.Add') }}</span>
                    </a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="block-content">
            <div class="row mb-4">
                <div class="col-xl-10"></div>
                <div class="col-xl-2">
                    <form action="{{action('ScriptController@index')}}" method="post">
                        <!-- Pagination -->
                        @include('include.pagination')
                        <!-- Pagination END -->
                    </form>
                </div>
            </div>
            <table class="js-table-sections table table-hover table-vcenter">
                <thead>
                    <tr>
                        <th></th>
                        <th>
                            @sortablelink('name', __('common.Name'))
                        </th>

                        <th class="d-none d-xl-table-cell">
                            @sortablelink('course_id', __('common.Course'))
                        </th>
                        <th class="d-none d-xl-table-cell">
                            @sortablelink('updated_at', __('common.DateUpdated'))
                        </th>

                        <th class="d-none d-xl-table-cell">

                        </th>
                    </tr>
                </thead>
                @csrf

                @foreach($scripts as $script)
                <tbody class="js-table-sections-header">
                    <tr>
                        <td class="text-center">
                            <i class="fa fa-angle-right text-muted"></i>
                        </td>
                        <td>
                            <div class="py-1">
                                <a href="{{action('ScriptController@show', $script->id)}}">{{ $script->name }} </a>
                            </div>
                        </td>


                        <td class="d-none d-xl-table-cell">
                            <div class="py-1">
                                {{ $script->course->number }} {{ $script->course->alias }} {{ $script->course->name }}
                            </div>
                        </td>

                        <td class="d-none d-xl-table-cell">
                            <div class="py-1">
                                {{ Carbon::parse($script->updated_at)->format('d.m.Y H:i')}}
                            </div>
                        </td>

                        <td class="d-none d-md-table-cell text-right">
                            <a href="{{action('ScriptController@show', $script->id)}}" class="btn btn-dark btn-sm">
                                <i class="nav-main-link-icon si si-notebook"></i>
                            </a>

                            @can('update scripts')
                            <a href="{{action('ScriptController@edit', $script->id)}}" class="btn btn-primary btn-sm">
                                <i class="nav-main-link-icon si si-pencil"></i>
                            </a>
                            @endcan

                            @can('delete scripts')
                            <form action="{{action('ScriptController@destroy', $script->id)}}" method="post"
                                class="d-inline">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">

                                <button type="submit" class="btn btn-danger btn-sm">
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
                        <td>
                            <p>{{ $script->description }}</p>
                            <p>{{ __('common.Phone') }}: {{ $script->phone }}, {{ __('common.Mobile') }}:
                                {{ $script->mobile }}, {{ __('common.Fax') }}: {{ $script->fax }}</p>
                        </td>
                        <td>
                            <a href="{{ $script->website }}" target="_blank">{{ $script->website }}</a>
                        </td>
                        <td>
                        </td>
                        <td class="d-none d-sm-table-cell text-right" colspan="10">
                            <em class="text-muted">{{ Carbon::parse($script->updated_at)->format('d.m.Y H:i')}}</em>
                        </td>
                    </tr>

                </tbody>
                @endforeach
            </table>

        </div>

        @if ($scripts->total() > $scripts->perPage())
        <div
            class="block-content block-content-full block-content-sm bg-body-light d-flex justify-content-center align-content-center">
            {!! $scripts->appends(\Request::except('page'))->render() !!}
        </div>
        @endif
    </div>
    @endif

    <!-- END Table Sections -->
</div>
<!-- END Page Content -->


@endsection