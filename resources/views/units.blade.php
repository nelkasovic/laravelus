@extends('layouts.app')

@section('content')

<!-- Page Content -->
<div class="content">

    <!-- If edit or create -->
    @if (@$unit)

    {{-- We are here only if variable is available --}}

    @if (@$action === 'edit' || @$action === 'readonly')

    <form action="{{action('UnitController@update', $id)}}" enctype="multipart/form-data" method="post">
        @csrf

        <input name="_method" type="hidden" value="PATCH">

        <!-- Block Tabs With Options Default Style -->
        <div class="block block-rounded block-themed">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ $unit->name }}</h3>
            </div>
            <div class="block-content pb-4">
                <h2 class="content-heading">{{ __('common.Edit') }}</h2>

                <div class="row">

                    <div class="form-group col-xl-4">
                        <label class="text-muted mb-0 font-size-sm"
                            for="name"><small>{{ __('common.Name') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('name') ? "is-invalid" : "" }}" id="name" name="name"
                            placeholder="{{ __('common.Name') }}" value="{{ $unit->name }}">
                    </div>

                    <div class="col-lg-4">
                        <label class="text-muted mb-0 font-size-sm"
                            for="event_id"><small>{{ __('common.Topic') }}</small></label>
                        <select class="form-control" id="event_id" name="event_id" title="{{ __('common.Topic') }}">
                            <option value="">{{ __('common.Select') }}</option>
                            @foreach($topics as $topic)
                            <option value="{{ $topic->id }}"
                                {{ ($unit->topics->first()->id == $topic->id ? 'selected':'') }}>{{ $topic->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-4">
                        <label class="text-muted mb-0 font-size-sm"
                            for="topic_id"><small>{{ __('common.Event') }}</small></label>
                        <select class="form-control" id="topic_id" name="topic_id" title="{{ __('common.Event') }}">
                            <option value="">{{ __('common.Select') }}</option>
                            @foreach($events as $event)
                            <option value="{{ $event->id }}" {{ ($unit->event_id == $event->id ? 'selected':'') }}>
                                {{ $event->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="color"><small>{{ __('common.Color') }}</small></label>
                        <div class="js-colorpicker input-group" data-format="hex">
                            <input {{ $action }} type="text" class="form-control" id="color" name="color"
                                value="{{ $event->color }}">
                            <div class="input-group-append">
                                <span class="input-group-text colorpicker-input-addon">
                                    <i></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-xl-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="task"><small>{{ __('common.Task') }}</small></label>
                        <select {{ $action }} class="form-control" id="task" name="task">
                            <option value="0" {{ $unit->task == 0 ? 'selected':'' }}>{{ __('common.Input') }}</option>
                            <option value="1" {{ $unit->task == 1 ? 'selected':'' }}>{{ __('common.Task') }}</option>
                        </select>
                    </div>

                    <div class="form-group col-xl-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="active"><small>{{ __('common.Active') }}</small></label>
                        <select {{ $action }} class="form-control" id="active" name="active">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="0" {{ $unit->active == '1' ? 'selected':'' }}>{{ __('common.Active') }}
                            </option>
                            <option value="1" {{ $unit->active != '1' ? 'selected':'' }}>{{ __('common.Inactive') }}
                            </option>
                        </select>
                    </div>

                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="start_date"><small>{{ __('common.StartDate') }}</small></label>
                        <input type="text" class="form-control" id="start_date" name="start_date"
                            placeholder="{{ __('common.StartDate') }}" value="{{ $unit->start_date }}" {{ $action }}>
                    </div>

                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="end_date"><small>{{ __('common.EndDate') }}</small></label>
                        <input type="text" class="form-control" id="end_date" name="end_date"
                            placeholder="{{ __('common.EndDate') }}" value="{{ $unit->end_date }}" {{ $action }}>
                    </div>

                    <div class="form-group col-xl-12">
                        <label class="text-muted mb-0 font-size-sm"
                            for="description"><small>{{ __('common.Description') }}</small></label>
                        <textarea {{ $action }} rows="5"
                            class="form-control {{ @$errors->has('description') ? "is-invalid" : "" }}" id="description"
                            name="description"
                            placeholder="{{ __('common.Description') }}">{{ $unit->description }}</textarea>
                    </div>
                </div>

            </div>
            <div class="block-content block-content-full text-right bg-light">
                <a class="btn btn-warning" href="{{ URL::previous() }}">
                    <i class="si si-action-undo mr-1"></i>
                    {{ __('common.Close') }}
                </a>

                <a class="btn btn-info" href="{{action('UnitController@method', [$unit->id, 0])}}">
                    <i class="si si-location-pin mr-1"></i>
                    {{ __('common.Method') }} <span class="text-lowercase">{{ __('common.Add') }}</span>
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


    @if (@$unit->methods->count() > 0)
    <!-- Table Sections (.js-table-sections class is initialized in Helpers.tableToolsSections()) -->

    <div class="block block-rounded animated fadeIn">

        <div class="block-header block-header-default">
            <h3 class="block-title">{{ __('common.Methods') }}
                @if ($unit)
                {{__('common.From')}} {{ @$unit->name }}
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

                        <th style="border-top: none;" class="d-none d-lg-table-cell">
                            @sortablelink('time', __('common.Time'))
                        </th>

                        <th style="border-top: none;" class="d-none d-lg-table-cell">
                            @sortablelink('updated_at', __('common.DateUpdated'))
                        </th>

                        <th style="border-top: none;" class="text-right d-none d-sm-table-cell">
                            <a class="btn btn-dark btn-sm" href="{{ action('MethodController@create') }}">
                                <i class="si si-plus"></i>
                            </a>
                        </th>
                    </tr>
                </thead>
                @csrf
                @foreach($unit->methods as $method)
                <tbody class="js-table-sections-header">
                    <tr>
                        <td class="text-center">
                            <i class="fa fa-angle-right text-muted"></i>
                        </td>

                        <td>
                            <div class="py-1">
                                <a href="#">{{ $method->name }}</a>
                            </div>
                        </td>
                        <td class="d-none d-lg-table-cell">
                            <div class="py-1">
                                <a href="#">{{ $method->time }}</a>
                            </div>
                        </td>

                        <td class="d-none d-lg-table-cell">
                            <div class="py-1">
                                {{ Carbon::parse($method->updated_at)->format('d.m.Y H:i')}}
                            </div>
                        </td>



                        <td class="d-none d-sm-table-cell text-right">

                            @if ($method->id)
                            @can('update methods')
                            <form action="{{ action('MethodController@edit', $method->id) }}" method="POST"
                                class="d-inline-block">
                                <input name="_method" type="hidden" value="GET">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm" title="{{__('common.Edit')}}">
                                    <i class="nav-main-link-icon si si-pencil"></i>
                                </button>
                            </form>
                            @endcan

                            @can('delete methods')
                            <form action="{{ action('MethodController@destroy', $method->id) }}" method="POST"
                                class="d-inline-block">
                                <input name="_method" type="hidden" value="DELETE">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm" title="{{__('common.Delete')}}">
                                    <i class="nav-main-link-icon si si-trash"></i>
                                </button>
                            </form>
                            @endcan
                            @endif

                        </td>
                    </tr>
                </tbody>
                <tbody class="font-size-sm">
                    <tr>
                        <td class="text-center"></td>
                        <td colspan="10">

                            <h4>{{ __('common.Description') }}</h4>
                            <p>{{ $method->description }}</p>

                            <h4>{{ __('common.Approach') }}</h4>
                            <p>{{ $method->approach }}</p>

                            <h4>{{ __('common.Effect') }}</h4>
                            <p>{{ $method->effect }}</p>

                        </td>

                    </tr>

                </tbody>
                @endforeach
            </table>

        </div>


    </div>
    @endif

    <!-- END Block Tabs With Options Default Style -->
    @elseif (@$action === 'create')

    <form action="{{action('UnitController@store')}}" enctype="multipart/form-data" method="post">
        @csrf
        <input name="_method" type="hidden" value="POST">

        <!-- Block Tabs With Options Default Style -->
        <div class="block block-rounded block-themed">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ __('common.Unit') }}</h3>
            </div>
            <div class="block-content pb-4">
                <h2 class="content-heading">{{ __('common.New') }}</h2>
                <div class="row">

                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="name"><small>{{ __('common.Name') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('name') ? "is-invalid" : "" }}" id="name" name="name"
                            placeholder="{{ __('common.Name') }}" value="{{ old('name') }}">
                    </div>

                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="building"><small>{{ __('common.Building') }}</small></label>
                        <input type="text" class="form-control {{ @$errors->has('building') ? "is-invalid" : "" }}"
                            id="building" name="building" placeholder="{{ __('common.Building') }}"
                            value="{{ old('building') }}">
                    </div>

                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="active"><small>{{ __('common.Active') }}</small></label>
                        <select {{ $action }} class="form-control" id="active" name="active">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="0" {{ (old('active') == '' ? 'selected':'') }}>{{ __('common.Active') }}
                            </option>
                            <option value="1" {{ (old('active') == 1 ? 'selected':'') }}>{{ __('common.Inactive') }}
                            </option>
                        </select>
                    </div>


                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="email"><small>{{ __('common.Email') }}</small></label>
                        <input type="text" class="form-control" id="email" name="email"
                            placeholder="{{ __('common.Email') }}" value="{{ $unit->email }}" {{ $action }}>
                    </div>

                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="phone"><small>{{ __('common.Phone') }}</small></label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            placeholder="{{ __('common.Phone') }}" value="{{ $unit->phone }}" {{ $action }}>
                    </div>


                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="url"><small>{{ __('common.Website') }}</small></label>
                        <input type="text" class="form-control" id="url" name="url"
                            placeholder="{{ __('common.Website') }}" value="{{ $unit->url }}" {{ $action }}>
                    </div>

                    @if($action === "edit")
                    <div class="col-xl-3 custom-file">
                        <label class="text-muted mb-0 font-size-sm" for="picture"><small>{{ __('common.Image') }}
                            </small></label>
                        <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                        <input type="file" class="custom-file-input js-custom-file-input-enabled"
                            data-toggle="custom-file-input" id="picture" name="picture"
                            placeholder="{{ __('common.Image') }}" {{ $action }}>
                        <label class="custom-file-label" for="picture"
                            style="margin-left: 14px; margin-right: 14px; top: 24px; ">{{ __('common.Choose') }}</label>
                    </div>
                    @endif

                    <div class="form-group col-md-12">
                        <label class="text-muted mb-0 font-size-sm"
                            for="description"><small>{{ __('common.Description') }}</small></label>
                        <textarea {{ $action }} rows="5"
                            class="form-control {{ @$errors->has('description') ? "is-invalid" : "" }}" id="description"
                            name="description"
                            placeholder="{{ __('common.Description') }}">{{ $unit->description }}</textarea>
                    </div>
                </div>

            </div>
            <div class="block-content block-content-full text-right bg-light">

                <a class="btn btn-warning" href="{{action('UnitController@index')}}">
                    <i class="si si-action-undo mr-1"></i>
                    {{ __('common.Close') }}
                </a>

                <a class="btn btn-info" href="{{action('UnitController@method', $unit->id)}}">
                    <i class="si si-location-pin mr-1"></i>
                    {{ __('common.Location') }} <span class="text-lowercase">{{ __('common.Add') }}</span>
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

    @if (@$units)
    <!-- Table Sections (.js-table-sections class is initialized in Helpers.tableToolsSections()) -->
    <div class="block block-rounded block-fx-pop block-themed">

        <div class="block-header block-header-default bg-primary-darker">
            <h3 class="block-title">{{ __('common.Units') }}</h3>
            <div class="block-options pr-2">
                <form action="{{action('UnitController@index')}}" method="post">

                    <!-- Laravel CONTENT -->
                    @include('include.pagination')
                    <!-- Laravel CONTENT END -->

                </form>
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

                        <th style="border-top: none;" class="d-none d-xl-table-cell">
                            {{ __('common.Event') }}
                        </th>

                        <th style="border-top: none;" class="d-none d-xl-table-cell">
                            {{ __('common.Topic') }}
                        </th>

                        <th style="border-top: none;" class="d-none d-xl-table-cell">
                            {{ __('common.Type') }}
                        </th>

                        <th style="border-top: none;" class="text-right d-none d-sm-table-cell">
                            <a class="btn btn-dark" href="{{action('UnitController@create')}}">
                                <i class="si si-plus"></i>
                            </a>
                        </th>
                    </tr>
                </thead>
                @csrf

                @foreach($units as $unit)
                <tbody class="js-table-sections-header">
                    <tr>
                        <td class="text-center">
                            <i class="fa fa-angle-right text-muted"></i>
                        </td>
                        <td>
                            <div class="py-1">
                                <a href="{{action('UnitController@show', $unit->id)}}">{{ $unit->name }} </a>
                            </div>
                        </td>

                        <td class="d-none d-xl-table-cell">
                            <div class="py-1">
                                {{ $unit->event->name }}
                            </div>
                        </td>
                        <td class="d-none d-xl-table-cell">
                            <div class="py-1">
                                {{ $unit->topics->first()->name }}
                            </div>
                        </td>
                        <td class="d-none d-xl-table-cell">
                            <div class="py-1">
                                {{ $unit->task }}
                            </div>
                        </td>

                        <td class="text-right d-none d-sm-table-cell">
                            @can('vote units')
                            <a href="{{action('UnitController@downvote', $unit->id)}}" class="btn btn-light">
                                <i class="nav-main-link-icon si si-dislike mr-2"></i> {{ $unit->downVotesCount() }}
                            </a>
                            <a href="{{action('UnitController@upvote', $unit->id)}}" class="btn btn-light">
                                <i class="nav-main-link-icon si si-like mr-2"></i> {{ $unit->upVotesCount() }}
                            </a>
                            @endcan

                            @can('update units')
                            <a href="{{action('UnitController@edit', $unit->id)}}"
                                class="btn btn-primary d-none d-md-inline-block">
                                <i class="nav-main-link-icon si si-pencil"></i>
                            </a>
                            @endcan
                            @can('delete units')
                            <form action="{{action('UnitController@destroy', $unit->id)}}" method="post"
                                class="d-none d-md-inline-block">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">

                                <button type="submit" class="btn btn-danger">
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
                        <td colspan="7">
                            <p>{{ $unit->description }}</p>
                            <ul>
                                <li>{{ __('common.Phone') }}: {{ $unit->phone }}</li>
                                <li>{{ __('common.Email') }}: {{ $unit->email }}</li>
                                <li>{{ __('common.Website') }}: {{ $unit->url }}</li>
                                <li>{{ __('common.Image') }}: {{ $unit->picture }}</li>
                            </ul>

                            <em class="text-muted">{{ __('common.DateUpdated') }}:
                                {{ Carbon::parse($unit->created_at)->format('d.m.Y H:i')}}</em>
                        </td>


                    </tr>

                </tbody>
                @endforeach
            </table>

        </div>

        @if ($units->total() > $units->perPage())
        <div
            class="block-content block-content-full block-content-sm bg-body-light d-flex justify-content-center align-content-center">
            {!! $units->appends(\Request::except('page'))->render() !!}
        </div>
        @endif
    </div>
    @endif

    <!-- END Table Sections -->
</div>
<!-- END Page Content -->


@endsection