@extends('layouts.app')

@section('content')

<!-- Page Content -->
<div class="content">

    <!-- If edit or create -->
    @if (@$period)

    {{-- We are here only if variable is available --}}

    @if (@$action === 'edit' || @$action === 'readonly')

    <form action="{{action('PeriodController@update', $id)}}" enctype="multipart/form-data" method="post">
        @csrf

        <input name="_method" type="hidden" value="PATCH">

        <!-- Block Tabs With Options Default Style -->
        <div class="block block-rounded block-themed block-fx-pop">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ $period->name }}</h3>
            </div>
            <div class="block-content pb-4">
                <h2 class="content-heading">{{ __('common.Edit') }}</h2>

                <div class="row">

                    <div class="form-group col-xl-4">
                        <label class="text-muted mb-0 font-size-sm" for="name"><small>{{ __('common.Name')
                                }}</small></label>
                        <input {{ $action }} type="text" class="form-control {{ @$errors->has('name') ? " is-invalid"
                            : "" }}" id="name" name="name" placeholder="{{ __('common.Name') }}"
                            value="{{ $period->name }}">
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
                                value="{{ $period->start_date ? Carbon::parse($period->start_date)->format('d.m.Y') : '' }}">
                            <div class="input-group-prepend input-group-append">
                                <span class="input-group-text font-w600">
                                    <i class="fa fa-fw fa-arrow-right"></i>
                                </span>
                            </div>
                            <input {{ $action }} type="text" class="form-control text-left" id="end_date"
                                name="end_date" placeholder="{{ __('common.Date') }} {{ __('common.To') }}"
                                data-week-start="1" data-autoclose="true" data-today-highlight="true"
                                value="{{ $period->end_date ? Carbon::parse($period->end_date)->format('d.m.Y') : '' }}">
                        </div>
                    </div>

                    <div class="form-group col-xl-2">
                        <label class="text-muted mb-0 font-size-sm" for="active"><small>{{ __('common.Active')
                                }}</small></label>
                        <select {{ $action }} class="form-control" id="active" name="active">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="1" {{ $period->active == 1 ? 'selected':'' }}>{{ __('common.Active') }}
                            </option>
                            <option value="0" {{ $period->active != 1 ? 'selected':'' }}>{{ __('common.Inactive') }}
                            </option>
                        </select>
                    </div>

                    <div class="form-group col-xl-2">
                        <label class="text-muted mb-0 font-size-sm" for="color"><small>{{ __('common.Color')
                                }}</small></label>
                        <div class="js-colorpicker input-group" data-format="hex">
                            <input {{ $action }} type="text" class="form-control" id="color" name="color"
                                value="{{ $period->color }}">
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
                        <textarea {{ $action }} class="form-control {{ @$errors->has('description') ? " is-invalid" : ""
                            }}" id="description" name="description" rows="5"
                            placeholder="{{ __('common.Description') }}">{{ $period->description }}</textarea>
                    </div>
                </div>

            </div>
            <div class="block-content block-content-full text-right bg-light">

                <div class="row">
                    <div class="col-xl-12 text-right">

                        <a class="btn btn-warning" href="{{action('PeriodController@index')}}">
                            <i class="si si-action-undo mr-1"></i>
                            {{ __('common.Close') }}
                        </a>


                        @can('create exclusions')
                        <a class="btn btn-primary" href="{{action('ExclusionController@period', $period->id)}}">
                            <i class="si si-plus mr-1"></i> {{ __('common.Exclusion') }} <span class="text-lowercase">
                                {{ __('common.Add') }}</span>
                        </a>
                        @endcan

                        @if (@$action === 'edit')
                        <button type="submit" class="btn btn-primary">
                            <i class="si si-fire mr-1"></i>
                            {{ __('common.Save') }}
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>



    @if (@$exclusions && $exclusions->count())

    <!-- Exclusions -->
    @include('include.exclusions')
    <!-- Exclusions END -->

    @endif

    <!-- END Block Tabs With Options Default Style -->
    @elseif (@$action === 'create')

    <form action="{{action('PeriodController@store')}}" enctype="multipart/form-data" method="post">
        @csrf
        <input name="_method" type="hidden" value="POST">

        <!-- Block Tabs With Options Default Style -->
        <div class="block block-rounded block-themed">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ __('common.Period') }}</h3>
            </div>
            <div class="block-content pb-4">
                <h2 class="content-heading">{{ __('common.New') }}</h2>
                <div class="row">

                    <div class="form-group col-xl-4">
                        <label class="text-muted mb-0 font-size-sm" for="name"><small>{{ __('common.Name')
                                }}</small></label>
                        <input {{ $action }} type="text" class="form-control {{ @$errors->has('name') ? " is-invalid"
                            : "" }}" id="name" name="name" placeholder="{{ __('common.Name') }}"
                            value="{{ old('name') }}">
                    </div>

                    <div class="form-group col-xl-4">
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
                                value="{{ (old('end_date')) ? old('end_date') : Carbon::now()->addYears(1)->format('d.m.Y') }}">
                        </div>
                    </div>

                    <div class="col-xl-2">
                        <label class="text-muted mb-0 font-size-sm" for="color"><small>{{ __('common.Color')
                                }}</small></label>
                        <div class="js-colorpicker input-group" data-format="hex">
                            <input {{ $action }} type="text" class="form-control" id="color" name="color"
                                value="{{ old('color') }}">
                            <div class="input-group-append">
                                <span class="input-group-text colorpicker-input-addon">
                                    <i></i>
                                </span>
                            </div>
                        </div>
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


                    <div class="form-group col-xl-12">
                        <label class="text-muted mb-0 font-size-sm" for="description"><small>{{ __('common.Description')
                                }}</small></label>
                        <textarea class="form-control {{ @$errors->has('description') ? " is-invalid" : "" }}"
                            id="description" rows="5" name="description"
                            placeholder="{{ __('common.Description') }}">{{ old('description') }}</textarea>
                    </div>

                </div>


            </div>
            <div class="block-content block-content-full text-right bg-light">


                <a class="btn btn-warning" href="{{action('PeriodController@index')}}">
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

    @if (@$periods)
    <!-- Table Sections (.js-table-sections class is initialized in Helpers.tableToolsSections()) -->
    <div class="block block-rounded block-fx-pop block-themed">

        <div class="block-header block-header-default bg-primary-darker">
            <h3 class="block-title">{{ __('common.Periods') }}</h3>
            <div class="block-options">
                <div class="btn-group">
                    @can('read periods')
                    <a class="btn btn-light btn-sm" href="javascript:void(0)" onclick="getPeriods();">
                        <i class="si si-share-alt mr-1"></i> {{ __('common.Periods') }} XHR</span>
                    </a>
                    <a class="btn btn-light btn-sm" href="{{action('ExportController@periods')}}">
                        <i class="si si-share-alt mr-1"></i> {{ __('common.Excel') }}</span>
                    </a>
                    @endcan
                    @can('create periods')
                    <a class="btn btn-primary btn-sm" href="{{action('PeriodController@create')}}">
                        <i class="si si-plus mr-1"></i> {{ __('common.Period') }} <span class="text-lowercase">{{
                            __('common.Add') }}</span>
                    </a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="block-content">
            <div class="row mb-4">
                <div class="col-xl-10"></div>
                <div class="col-xl-2">
                    <form action="{{action('PeriodController@index')}}" method="post">
                        <!-- Pagination -->
                        @include('include.pagination')
                        <!-- Pagination END -->
                    </form>
                </div>
            </div>
            <table class="js-table-sections table table-hover table-vcenter">
                <thead>
                    <tr>
                        <th style="border-top: none;"></th>
                        <th style="border-top: none;">
                            @sortablelink('name', __('common.Name'))
                        </th>

                        <th style="border-top: none;" class="d-none d-xl-table-cell">
                            @sortablelink('start_date', __('common.StartDate'))
                        </th>

                        <th style="border-top: none;" class="d-none d-xl-table-cell">
                            @sortablelink('end_date', __('common.EndDate'))
                        </th>

                        <th style="border-top: none;" class="d-none d-xl-table-cell">
                            @sortablelink('updated_at', __('common.Updated'))
                        </th>
                        <th style="border-top: none;" class="text-right d-none d-sm-table-cell">

                        </th>
                    </tr>
                </thead>
                @csrf

                @foreach($periods as $period)
                <tbody class="js-table-sections-header">
                    <tr>
                        <td class="text-center">
                            <i class="fa fa-angle-right text-muted"></i>
                        </td>
                        <td>
                            <div class="py-1">
                                <a href="{{action('PeriodController@show', $period->id)}}">{{ $period->name }} </a>
                            </div>
                        </td>

                        <td class="d-none d-xl-table-cell">
                            <div class="py-1">
                                {{ Carbon::parse($period->start_date)->format('d.m.Y')}}
                            </div>
                        </td>


                        <td class="d-none d-xl-table-cell">
                            <div class="py-1">
                                {{ Carbon::parse($period->end_date)->format('d.m.Y')}}
                            </div>
                        </td>


                        <td class="d-none d-xl-table-cell">
                            <div class="py-1">
                                {{ Carbon::parse($period->updated_at)->format('d.m.Y H:i')}}
                            </div>
                        </td>

                        <td class="d-none d-sm-table-cell text-right">


                            @if($period->active)
                            <a href="{{action('PeriodController@disable', $period->id)}}" class="btn btn-sm btn-success"
                                title="{{ __('common.ClickToChange') }}">
                                <i class="nav-main-link-icon si si-lock mr-1"></i>{{ __('common.Enabled') }}
                            </a>
                            @else
                            <a href="{{action('PeriodController@enable', $period->id)}}" class="btn btn-sm btn-dark"
                                title="{{ __('common.ClickToChange') }}">
                                <i class="nav-main-link-icon si si-lock-open mr-1"></i>{{ __('common.Disabled') }}
                            </a>
                            @endif


                            <div class="dropdown d-inline-block">
                                <button type="button" class="btn btn-info btn-sm dropdown-toggle"
                                    id="dropdown-default-primary" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="si si-docs mr-1"></i>{{ __('common.Exclusions') }} {{ __('common.copy') }}
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdown-default-primary"
                                    x-placement="bottom-start"
                                    style="position: absolute; transform: translate3d(0px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">
                                    @foreach($periods as $copy)
                                    @if($copy->id != $period->id)
                                    <a class="dropdown-item"
                                        href="{{action('PeriodController@copy', [$copy->id, $period->id])}}">
                                        <i class="si si-calendar mr-1"></i> {{ $copy->name }}
                                    </a>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                            @can('update exclusions')
                            <a href="{{action('PeriodController@global', $period->id)}}"
                                class="btn btn-sm @if($period->global) btn-primary @else btn-light @endif">
                                <i class="nav-main-link-icon si si-energy mr-1"></i>{{ __('common.Global') }}
                            </a>
                            @endcan

                            @can('create exclusions')
                            <a href="{{action('ExclusionController@period', $period->id)}}"
                                class="btn btn-warning btn-sm"
                                title="{{ __('common.Exclusions') }} {{ __('common.add') }}">
                                <i class="nav-main-link-icon si si-calculator"></i>
                            </a>
                            @endcan

                            @can('update periods')
                            <a href="{{action('PeriodController@edit', $period->id)}}" class="btn btn-sm btn-primary">
                                <i class="nav-main-link-icon si si-pencil"></i>
                            </a>
                            @endcan

                            @can('delete periods')
                            <form action="{{action('PeriodController@destroy', $period->id)}}" method="post"
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
                            <p>{{ $period->description }}</p>

                            <em class="text-muted">{{ __('common.DateUpdated') }}: {{
                                Carbon::parse($period->created_at)->format('d.m.Y H:i')}}</em>
                        </td>


                    </tr>

                </tbody>
                @endforeach
            </table>

        </div>

        @if ($periods->total() > $periods->perPage())
        <div
            class="block-content block-content-full block-content-sm bg-body-light d-flex justify-content-center align-content-center">
            {!! $periods->appends(\Request::except('page'))->render() !!}
        </div>
        @endif
    </div>
    @endif

    <!-- END Table Sections -->
</div>
<!-- END Page Content -->


@endsection