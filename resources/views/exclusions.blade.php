@extends('layouts.app')

@section('content')


<!-- Page Content -->
<div class="content">

    <!-- If edit or create -->
    @if (@$exclusion)

    {{-- We are here only if variable is available --}}

    @if (@$action === 'edit' || @$action === 'readonly')

    <form action="{{action('ExclusionController@update', $id)}}" enctype="multipart/form-data" method="post">
        @csrf

        <input name="_method" type="hidden" value="PATCH">

        <!-- Block Tabs With Options Default Style -->
        <div class="block block-rounded block-themed">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ $exclusion->exclusionable->name }} {{ $exclusion->exclusionable->last_name }}
                    {{ $exclusion->exclusionable->first_name }} {{ $exclusion->name }} </h3>
            </div>
            <div class="block-content pb-4">
                <h2 class="content-heading">{{ __('common.Edit') }}</h2>

                <div class="row">
                    <div class="form-group col-xl-2">
                        <label class="text-muted mb-0 font-size-sm" for="name"><small>{{ __('common.Name')
                                }}</small></label>
                        <input {{ $action }} type="text" class="form-control {{ @$errors->has('name') ? " is-invalid"
                            : "" }}" id="name" name="name" placeholder="{{ __('common.Name') }}"
                            value="{{ $exclusion->name }}">
                    </div>

                    <div class="form-group col-xl-2">
                        <label class="text-muted mb-0 font-size-sm" for="active"><small>{{ __('common.Active')
                                }}</small></label>
                        <select {{ $action }} class="form-control" id="active" name="active">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="1" {{ $exclusion->active == 1 ? 'selected':'' }}>{{ __('common.Active') }}
                            </option>
                            <option value="0" {{ $exclusion->active != 1 ? 'selected':'' }}>{{ __('common.Inactive') }}
                            </option>
                        </select>
                    </div>

                    <div class="form-group col-lg-2">
                        <label class="text-muted mb-0 font-size-sm" for="color"><small>{{ __('common.Color')
                                }}</small></label>
                        <div class="js-colorpicker input-group" data-format="hex">
                            <input {{ $action }} type="text" class="form-control" id="color" name="color"
                                value="{{ $exclusion->color }}">
                            <div class="input-group-append">
                                <span class="input-group-text colorpicker-input-addon">
                                    <i></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-xl-4">
                        <label class="text-muted mb-0 font-size-sm" for="daterange"><small>{{ __('common.DateRange')
                                }}</small></label>
                        <div class="input-daterange input-group" data-date-format="dd.mm.yyyy" data-week-start="1"
                            data-autoclose="true" data-today-highlight="true">
                            <input {{ $action }} type="text" class="form-control text-left" id="start_date"
                                name="start_date" data-date-default-date="now"
                                placeholder="{{ __('common.Date') }} {{ __('common.From') }}" data-week-start="1"
                                data-autoclose="true" data-today-highlight="true"
                                value="{{ $exclusion->start_date ? Carbon::parse($exclusion->start_date)->format('d.m.Y') : '' }}">
                            <div class="input-group-prepend input-group-append">
                                <span class="input-group-text font-w600">
                                    <i class="fa fa-fw fa-arrow-right"></i>
                                </span>
                            </div>
                            <input {{ $action }} type="text" class="form-control text-left" id="end_date"
                                name="end_date" placeholder="{{ __('common.Date') }} {{ __('common.To') }}"
                                data-week-start="1" data-autoclose="true" data-today-highlight="true"
                                value="{{ $exclusion->end_date ? Carbon::parse($exclusion->end_date)->format('d.m.Y') : '' }}">
                        </div>
                    </div>

                    <div class="form-group col-xl-2">
                        <label class="text-muted mb-0 font-size-sm" for="frequency"><small>{{ __('common.Frequency')
                                }}</small></label>
                        <select {{ $action }} class="form-control" id="frequency" name="frequency">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="monthly" {{ (old('monthly')=='1' ? 'selected' :'') }}>{{ __('common.Monthly')
                                }}</option>
                            <option value="annually" {{ (old('monthly')=='0' ? 'selected' :'') }}>{{
                                __('common.Annually') }}</option>
                        </select>
                    </div>

                    <div class="form-group col-xl-12">
                        <label class="text-muted mb-0 font-size-sm" for="description"><small>{{ __('common.Description')
                                }}</small></label>
                        <textarea rows="5" {{ $action }} class="form-control {{ @$errors->has('description') ? "
                            is-invalid" : "" }}" id="description" name="description"
                            placeholder="{{ __('common.Description') }}">{{ $exclusion->description }}</textarea>
                    </div>
                </div>

            </div>
            <div class="block-content block-content-full text-right bg-light">
                <div class="d-none">
                    <img class="img-avatar" src="{{ url('/images/'.$exclusion->image_url) }}">
                </div>

                <a class="btn btn-warning" href="{{action('ExclusionController@index')}}">
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

    <!-- END Block Tabs With Options Default Style -->
    @elseif (@$action === 'create')

    <form action="{{action('ExclusionController@store')}}" enctype="multipart/form-data" method="post">
        @csrf
        <input name="_method" type="hidden" value="POST">

        <!-- Block Tabs With Options Default Style -->
        <div class="block block-rounded block-themed">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ __('common.Exclusion') }}</h3>
            </div>
            <div class="block-content pb-4">
                <h2 class="content-heading">{{ __('common.New') }}</h2>
                <div class="row">
                    <input type="hidden" name="exclusionable_type" value="{{ $type }}">
                    <div class="form-group col-xl-2">
                        <label class="text-muted mb-0 font-size-sm" for="name"><small>{{ __('common.Person')
                                }}</small></label>
                        <select class="form-control" id="exclusionable_id" name="exclusionable_id"
                            title="{{ __('common.Person') }}">
                            <option value="">{{ __('common.Select') }}</option>
                            @foreach($persons as $person)
                            <option value="{{ $person->id }}" @if(@$person->id == old('exclusionable_id') ||
                                $exclusionable_id == $person->id) selected data-selected="{{ old('exclusionable_id') }}"
                                @endif>{{ $person->last_name }} {{ $person->first_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-xl-2">
                        <label class="text-muted mb-0 font-size-sm" for="name"><small>{{ __('common.Name')
                                }}</small></label>
                        <input {{ $action }} type="text" class="form-control {{ @$errors->has('name') ? " is-invalid"
                            : "" }}" id="name" name="name" placeholder="{{ __('common.Name') }}"
                            value="{{ $exclusion->name }}">
                    </div>

                    <div class="form-group col-xl-2">
                        <label class="text-muted mb-0 font-size-sm" for="active"><small>{{ __('common.Active')
                                }}</small></label>
                        <select {{ $action }} class="form-control" id="active" name="active">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="1" {{ (old('active')=='1' ? 'selected' :'') }}>{{ __('common.Active') }}
                            </option>
                            <option value="0" {{ (old('active')=='0' ? 'selected' :'') }}>{{ __('common.Inactive') }}
                            </option>
                        </select>
                    </div>


                    <div class="form-group col-xl-2">
                        <label class="text-muted mb-0 font-size-sm" for="frequency"><small>{{ __('common.Frequency')
                                }}</small></label>
                        <select {{ $action }} class="form-control" id="frequency" name="frequency">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="monthly" {{ (old('monthly')=='1' ? 'selected' :'') }}>{{ __('common.Monthly')
                                }}</option>
                            <option value="annually" {{ (old('monthly')=='0' ? 'selected' :'') }}>{{
                                __('common.Annually') }}</option>
                        </select>
                    </div>

                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm" for="daterange"><small>{{ __('common.DateRange')
                                }}</small></label>
                        <div class="input-daterange input-group" data-date-format="dd.mm.yyyy" data-week-start="1"
                            data-autoclose="true" data-today-highlight="true">
                            <input type="text" class="form-control text-left" id="start_date" name="start_date"
                                data-date-default-date="now"
                                placeholder="{{ __('common.Date') }} {{ __('common.From') }}" data-week-start="1"
                                data-autoclose="true" data-today-highlight="true"
                                value="{{ (old('start_date')) ? old('start_date') : Carbon::now()->format('d.m.Y') }}">
                            <div class="input-group-prepend input-group-append">
                                <span class="input-group-text font-w600">
                                    <i class="fa fa-fw fa-arrow-right"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control text-left" id="end_date" name="end_date"
                                placeholder="{{ __('common.Date') }} {{ __('common.To') }}" data-week-start="1"
                                data-autoclose="true" data-today-highlight="true"
                                value="{{ (old('end_date')) ? old('end_date') : Carbon::now()->addYears(5)->format('d.m.Y') }}">
                        </div>
                    </div>

                    <div class="form-group col-lg-1">
                        <label class="text-muted mb-0 font-size-sm" for="color"><small>{{ __('common.Color')
                                }}</small></label>
                        <div class="js-colorpicker input-group" data-format="hex">
                            <input {{ $action }} type="text" class="form-control" id="color" name="color"
                                value="{{ $exclusion->color }}">
                            <div class="input-group-append">
                                <span class="input-group-text colorpicker-input-addon">
                                    <i></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-xl-12">
                        <label class="text-muted mb-0 font-size-sm" for="description"><small>{{ __('common.Description')
                                }}</small></label>
                        <textarea class="form-control {{ @$errors->has('description') ? " is-invalid" : "" }}"
                            id="description" name="description"
                            placeholder="{{ __('common.Description') }}">{{ old('description') }}</textarea>
                    </div>

                </div>


            </div>
            <div class="block-content block-content-full text-right bg-light">


                <a class="btn btn-warning" href="{{action('ExclusionController@index')}}">
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

    @if (@$exclusions)
    <div class="block block-rounded block-fx-pop block-themed">

        <div class="block-header block-header-default bg-primary-darker">
            <h3 class="block-title">{{ __('common.Exclusions') }}</h3>
            <div class="block-options">
                <div class="btn-group">
                    @can('read exclusions')
                    <a class="btn btn-light btn-sm" href="javascript:void(0)" onclick="getExclusions();">
                        <i class="si si-share-alt mr-1"></i> {{ __('common.Exclusions') }} XHR</span>
                    </a>
                    <a class="btn btn-light btn-sm" href="{{action('ExportController@exclusions')}}">
                        <i class="si si-share-alt mr-1"></i> {{ __('common.Excel') }}</span>
                    </a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="block-content">
            <form action="{{action('ExclusionController@index')}}" method="post">
                <div class="row mb-4">
                    <div class="col-xl-2">
                        <div class="form-group">
                            <select class="form-control" id="exclusionable_type" name="exclusionable_type"
                                title="{{ __('common.Type') }}" onchange="this.form.submit()">
                                <option value="">{{ __('common.Select') }}</option>
                                @foreach($types as $type)
                                <option value="{{ $type }}" @if(@$type==$selected_type) selected
                                    data-selected="{{ $selected_type }}" @endif>
                                    @if($type == 'App\Person') {{ __('common.Persons') }}
                                    @elseif ($type == 'App\Room') {{ __('common.Rooms') }}
                                    @elseif ($type == 'App\Period') {{ __('common.Periods') }}
                                    @endif
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-8"></div>

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
                            @sortablelink('name', __('common.Name'))
                        </th>
                        <th class="d-none d-xl-table-cell">
                            @sortablelink('exclusionable_type', __('common.Type'))
                        </th>
                        <th class="d-none d-xl-table-cell">
                            @sortablelink('start_date', __('common.StartDate'))
                        </th>
                        <th class="d-none d-xl-table-cell">
                            @sortablelink('end_date', __('common.EndDate'))
                        </th>

                        <th class="d-none d-xl-table-cell">
                            @sortablelink('updated_at', __('common.Updated'))
                        </th>
                        <th class="text-right d-none d-sm-table-cell">

                        </th>
                    </tr>
                </thead>
                @csrf

                @foreach($exclusions as $exclusion)
                <tbody class="js-table-sections-header">
                    <tr>
                        <td class="text-center">
                            <i class="fa fa-angle-right text-muted"></i>
                        </td>
                        <td>
                            <div class="py-1">
                                <a href="{{action('ExclusionController@show', $exclusion->id)}}">{{ $exclusion->name }}
                                </a>
                            </div>
                        </td>
                        <td class="d-none d-xl-table-cell">
                            <div class="py-1">
                                {{ $exclusion->exclusionable_type }}
                            </div>
                        </td>
                        <td class="d-none d-xl-table-cell">
                            <div class="py-1">
                                {{ Carbon::parse($exclusion->start_date)->format('d.m.Y')}}
                            </div>
                        </td>
                        <td class="d-none d-xl-table-cell">
                            <div class="py-1">
                                {{ Carbon::parse($exclusion->end_date)->format('d.m.Y')}}
                            </div>
                        </td>


                        <td class="d-none d-xl-table-cell">
                            <div class="py-1">
                                {{ Carbon::parse($exclusion->updated_at)->format('d.m.Y H:i')}}
                            </div>
                        </td>

                        <td class="d-none d-sm-table-cell text-right">
                            @can('edit exclusions')
                            <a href="{{action('ExclusionController@edit', $exclusion->id)}}"
                                class="btn btn-sm btn-primary">
                                <i class="nav-main-link-icon si si-pencil"></i>
                            </a>
                            @endcan

                            @can('delete exclusions')
                            <form action="{{action('ExclusionController@destroy', $exclusion->id)}}" method="post"
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
                        <td colspan="7">
                            <p>{{ $exclusion->description }}</p>

                            <em class="text-muted">{{ __('common.DateUpdated') }}:
                                {{ Carbon::parse($exclusion->created_at)->format('d.m.Y H:i')}}</em>
                        </td>
                    </tr>

                </tbody>
                @endforeach
            </table>

        </div>

        @if ($exclusions->total() > $exclusions->perPage())
        <div
            class="block-content block-content-full block-content-sm bg-body-light d-flex justify-content-center align-content-center">
            {!! $exclusions->appends(\Request::except('page'))->render() !!}
        </div>
        @endif
    </div>
    @endif

    <!-- END Table Sections -->
</div>
<!-- END Page Content -->


@endsection