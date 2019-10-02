@extends('layouts.app')

@section('content')

<!-- Page Content -->
<div class="content">

    <!-- If edit or create -->
    @if (@$exclusion)

    <form action="{{action('ExclusionController@store')}}" enctype="multipart/form-data" method="post">
        @csrf
        <input name="_method" type="hidden" value="POST">

        <!-- Block Tabs With Options Default Style -->
        <div class="block block-rounded block-themed block-fx-pop">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ __('common.Exclusion') }} {{ $person->last_name }} {{ $person->first_name }}
                </h3>
            </div>
            <div class="block-content pb-4">
                <h2 class="content-heading">{{ __('common.New') }}</h2>
                <div class="row">

                    <input type="hidden" name="exclusionable_type" value="{{ $exclusionable_type}}">
                    <input type="hidden" name="exclusionable_id" value="{{ $exclusionable_id}}">

                    <div class="form-group col-xl-4">
                        <label class="text-muted mb-0 font-size-sm"
                            for="name"><small>{{ __('common.Name') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('name') ? "is-invalid" : "" }}" id="name" name="name"
                            placeholder="{{ __('common.Name') }}" value="{{ $exclusion->name }}">
                    </div>

                    <div class="form-group col-xl-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="active"><small>{{ __('common.Active') }}</small></label>
                        <select {{ $action }} class="form-control" id="active" name="active">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="1" {{ (old('active') == '1' ? 'selected':'') }}>{{ __('common.Active') }}
                            </option>
                            <option value="0" {{ (old('active') == '0' ? 'selected':'') }}>{{ __('common.Inactive') }}
                            </option>
                        </select>
                    </div>


                    <div class="form-group col-xl-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="frequency"><small>{{ __('common.Frequency') }}</small></label>
                        <select {{ $action }} class="form-control" id="frequency" name="frequency">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="monthly" {{ (old('monthly') == '1' ? 'selected':'') }}>
                                {{ __('common.Monthly') }}</option>
                            <option value="annually" {{ (old('monthly') == '0' ? 'selected':'') }}>
                                {{ __('common.Annually') }}</option>
                        </select>
                    </div>

                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="daterange"><small>{{ __('common.DateRange') }}</small></label>
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
                        <label class="text-muted mb-0 font-size-sm"
                            for="color"><small>{{ __('common.Color') }}</small></label>
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
                        <label class="text-muted mb-0 font-size-sm"
                            for="description"><small>{{ __('common.Description') }}</small></label>
                        <textarea rows="5" class="form-control {{ @$errors->has('description') ? "is-invalid" : "" }}"
                            id="description" name="description"
                            placeholder="{{ __('common.Description') }}">{{ old('description') }}</textarea>
                    </div>

                </div>


            </div>
            <div class="block-content block-content-full text-right bg-light">


                <a class="btn btn-warning" href="{{action('PeriodController@show', $exclusionable_id)}}">
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

</div>
<!-- END Page Content -->

@endsection