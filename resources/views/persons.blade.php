@extends('layouts.app')

@section('content')
<!-- Hero -->
@if (@$person && $action != 'create')
<div class="bg-image" style="background-image: url('/media/photos/photo17@2x.jpg');">
    <div class="bg-black-25">
        <div class="content content-full">
            <div class="py-5 text-center">
                <a class="img-link img-avatar img-avatar96 img-avatar-thumb"
                    href="{{ action('PersonController@show', $person->id) }}"
                    style="background-image: url(/images/{{ $person->picture }}); background-size: cover;">
                    &nbsp;
                </a>
                <h1 class="font-w700 my-2 text-white">{{ $person->first_name }} {{ $person->last_name }}</h1>
                <h2 class="h4 font-w700 text-white-75">
                    {{ $person->title }} <a class="text-primary-lighter" href="javascript:void(0)">@
                        {{ $person->company_name }}</a>
                </h2>
                <button type="button" class="btn btn-hero-primary">
                    <i class="fa fa-fw fa-user-plus mr-1"></i> {{ __('common.Follow') }}
                </button>
                <button type="button" class="btn btn-hero-dark">
                    <i class="fa fa-fw fa-envelope mr-1"></i> {{ __('common.Contact') }}
                </button>

            </div>
        </div>
    </div>
</div>
@endif

<!-- END Hero -->

<!-- Page Content -->
<div class="content">

    <!-- If edit or create -->
    @if (@$person)

    {{-- We are here only if variable person is available --}}

    @if (@$action === 'edit' || @$action === 'readonly')

    <form action="{{action('PersonController@update', $id)}}" enctype="multipart/form-data" method="post">
        @csrf

        <input name="_method" type="hidden" value="PATCH">

        <!-- Block Tabs With Options Default Style -->
        <div class="block block-rounded block-themed block-fx-pop">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ $person->first_name }} {{ $person->last_name }} @if(\Session::has('approval') || !$person->approved) | {{ __('common.MissingDataForApproval') }} @endif
                </h3>
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
                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="salutation"><small>{{ __('common.Salutation') }}</small></label>
                        <select class="form-control" id="salutation" name="salutation" @if($action==="readonly" )
                            disabled @endif>
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="mr" @if($person->salutation=="mr") selected @endif>{{ __('common.Mr') }}
                            </option>
                            <option value="mrs" @if($person->salutation=="mrs") selected @endif>{{ __('common.Mrs') }}
                            </option>
                        </select>
                    </div>

                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="first_name"><small>{{ __('common.FirstName') }}</small></label>
                        <input type="text" class="form-control" id="first_name" name="first_name"
                            placeholder="{{ __('common.FirstName') }}" value="{{ $person->first_name }}" {{ $action }}>
                    </div>

                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="last_name"><small>{{ __('common.LastName') }}</small></label>
                        <input type="text" class="form-control" id="last_name" name="last_name"
                            placeholder="{{ __('common.FirstName') }}" value="{{ $person->last_name }}" {{ $action }}>
                    </div>

                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="company_name"><small>{{ __('common.Company') }}</small></label>
                        <input type="text" class="form-control" id="company_name" name="company_name"
                            placeholder="{{ __('common.Company') }}" value="{{ $person->company_name }}" {{ $action }}>
                    </div>


                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="title"><small>{{ __('common.Title') }}</small></label>
                        <input type="text" class="form-control" id="title" name="title"
                            placeholder="{{ __('common.Title') }}" value="{{ $person->title }}" {{ $action }}>
                    </div>

                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="email"><small>{{ __('common.Email') }}</small></label>
                        <input type="text" class="form-control" id="email" name="email"
                            placeholder="{{ __('common.Email') }}" value="{{ $person->email }}" {{ $action }}>
                    </div>

                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="phone"><small>{{ __('common.Phone') }}</small></label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            placeholder="{{ __('common.Phone') }}" value="{{ $person->phone }}" {{ $action }}>
                    </div>

                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="mobile"><small>{{ __('common.Mobile') }}</small></label>
                        <input type="text" class="form-control" id="mobile" name="mobile"
                            placeholder="{{ __('common.Mobile') }}" value="{{ $person->mobile }}" {{ $action }}>
                    </div>

                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="fax"><small>{{ __('common.Fax') }}</small></label>
                        <input type="text" class="form-control" id="fax" name="fax" placeholder="{{ __('common.Fax') }}"
                            value="{{ $person->fax }}" {{ $action }}>
                    </div>

                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="website"><small>{{ __('common.Website') }}</small></label>
                        <input type="text" class="form-control" id="website" name="website"
                            placeholder="{{ __('common.Website') }}" value="{{ $person->website }}" {{ $action }}>
                    </div>

                    <div class="form-group col-xl-6">
                        <label class="text-muted mb-0 font-size-sm"
                            for="study_id"><small>{{ __('common.Study') }}</small></label>
                        <select @if($action=='readonly' ) disabled @endif class="form-control" id="study_id"
                            name="study_id" title="{{ __('common.Study') }}">
                            <option value="">{{ __('common.Study') }} {{ __('common.select') }}</option>
                            @foreach($studies as $study)
                            <option value="{{ $study->id }}" {{ ($person->study_id == $study->id ? 'selected':'') }}>
                                {{ $study->name }}</option>
                            @endforeach
                        </select>
                    </div>



                    @if($action === "edit")
                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm" for="picture"><small>{{ __('common.Image') }}
                            </small></label>
                        <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                        <input type="file" class="custom-file-input" data-toggle="custom-file-input" id="picture"
                            name="picture" placeholder="{{ __('common.Image') }}" {{ $action }}>
                        <label class="custom-file-label" for="picture"
                            style="margin-left: 14px; margin-right: 14px; top: 24px; ">{{ __('common.Choose') }}</label>
                    </div>
                    @endif

                    <div class="form-group col-xl-12">
                        <label class="text-muted mb-0 font-size-sm"
                            for="notes"><small>{{ __('common.Notes') }}</small></label>
                        <textarea {{ $action }} rows="4"
                            class="form-control {{ @$errors->has('notes') ? "is-invalid" : "" }}" id="notes"
                            name="notes" placeholder="{{ __('common.Notes') }}">{{ $person->notes }}</textarea>
                    </div>
                </div>
            </div>
            <div class="block-content block-content-full text-right bg-light">

                <a class="btn btn-warning" href="{{action('PersonController@index')}}">
                    <i class="si si-action-undo mr-1"></i>
                    {{ __('common.Close') }}
                </a>

                <a class="btn btn-info" href="{{action('LocationController@person', $person->id)}}">
                    <i class="si si-location-pin mr-1"></i>
                    {{ __('common.Location') }} <span class="text-lowercase">{{ __('common.Add') }}</span>
                </a>

                @if (@$action === 'edit')
                <button type="submit" class="btn btn-primary">
                    <i class="si si-fire mr-1"></i>
                    {{ __('common.Save') }}
                </button>
                @endif
            </div>
        </div>
        <div class="block block-rounded block-themed block-mode-hidden block-fx-pop">
            <div class="block-header block-header-default bg-gd-aqua">
                <h3 class="block-title">{{ __('common.MetaFields') }} <span
                        class="badge badge-dark">{{ __('common.Optional') }}</span></h3>
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

                <div class="row">
                    <div class="form-group col-xl-1">
                        <label class="text-muted mb-0 font-size-sm"
                            for="title"><small>{{ __('common.Title') }}</small></label>
                        <input type="text" class="form-control {{ @$errors->has('title') ? "is-invalid" : "" }}"
                            id="title" name="meta[title]" placeholder="{{ __('common.Title') }}"
                            value="{{ $person->getMeta('title') }}" {{ $action }}>
                    </div>
                    <div class="form-group col-xl-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="civil_status"><small>{{ __('common.CivilStatus') }}</small></label>
                        <select class="form-control" id="civil_status" name="meta[civil_status]"
                            @if($action==="readonly" ) disabled @endif title="{{ __('common.CivilStatus') }}">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="single" @if($person->getMeta('civil_status') === "single") selected
                                @endif>{{ __('common.CivilStatusSingle')}}</option>
                            <option value="married" @if($person->getMeta('civil_status') === "married") selected
                                @endif>{{ __('common.CivilStatusMarried')}}</option>
                            <option value="divorced" @if($person->getMeta('civil_status') === "divorced") selected
                                @endif>{{ __('common.CivilStatusDivorced')}}</option>
                            <option value="separated" @if($person->getMeta('civil_status') === "separated") selected
                                @endif>{{ __('common.CivilStatusSeparated')}}</option>
                            <option value="partnership" @if($person->getMeta('civil_status') === "partnership") selected
                                @endif>{{ __('common.CivilStatusPartnership')}}</option>
                            <option value="other" @if($person->getMeta('civil_status') === "other") selected
                                @endif>{{ __('common.Other')}}</option>
                        </select>
                    </div>
                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="civil_status_other"><small>{{ __('common.CivilStatus') }}
                                {{ __('common.AdditionalField') }}</small></label>
                        <input type="text"
                            class="form-control {{ @$errors->has('civil_status_other') ? "is-invalid" : "" }}"
                            id="civil_status_other" name="meta[civil_status_other]"
                            placeholder="{{ __('common.CivilStatus') }} {{ __('common.AdditionalField') }}"
                            value="{{ $person->getMeta('civil_status_other') }}" {{ $action }}>
                    </div>
                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="partner_name"><small>{{ __('common.PartnerName') }}</small></label>
                        <input type="text" class="form-control {{ @$errors->has('partner_name') ? "is-invalid" : "" }}"
                            id="partner_name" name="meta[partner_name]" placeholder="{{ __('common.PartnerName') }}"
                            value="{{ $person->getMeta('partner_name') }}" {{ $action }}>
                    </div>
                    <div class="form-group col-xl-1">
                        <label class="text-muted mb-0 font-size-sm"
                            for="number_of_children"><small>{{ __('common.Children') }}</small></label>
                        <input type="number"
                            class="form-control {{ @$errors->has('number_of_children') ? "is-invalid" : "" }}"
                            id="number_of_children" name="meta[number_of_children]"
                            placeholder="{{ __('common.Count') }}" value="{{ $person->getMeta('number_of_children') }}"
                            {{ $action }}>
                    </div>
                    <div class="form-group col-xl-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="confession"><small>{{ __('common.Confession') }}</small></label>
                        <input type="text" class="form-control {{ @$errors->has('confession') ? "is-invalid" : "" }}"
                            id="confession" name="meta[confession]" placeholder="{{ __('common.Confession') }}"
                            value="{{ $person->getMeta('confession') }}" {{ $action }}>
                    </div>

                    <div class="form-group col-xl-2">
                        <label
                            class="@if($person->getMeta('highest_degree') == '') text-danger @else text-muted @endif mb-0 font-size-sm"
                            for="highest_degree"><small>{{ __('common.HighestDegree') }}</small></label>
                        <select class="form-control" id="highest_degree" name="meta[highest_degree]"
                            @if($action==="readonly" ) disabled @endif title="{{ __('common.HighestDegree') }}">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="EFZ" @if($person->getMeta('highest_degree') === "EFZ") selected
                                @endif>{{ __('common.DegreeEFZ') }}</option>
                            <option value="HF" @if($person->getMeta('highest_degree') === "HF") selected
                                @endif>{{ __('common.DegreeHF') }}</option>
                            <option value="FH" @if($person->getMeta('highest_degree') === "FH") selected
                                @endif>{{ __('common.DegreeFH') }}</option>
                            <option value="Diplom" @if($person->getMeta('highest_degree') === "Diplom") selected
                                @endif>{{ __('common.DegreeDipl') }}</option>
                            <option value="MAS" @if($person->getMeta('highest_degree') === "MAS") selected
                                @endif>{{ __('common.DegreeMAS') }}</option>
                            <option value="MSc" @if($person->getMeta('highest_degree') === "MSc") selected
                                @endif>{{ __('common.DegreeMSC') }}</option>
                            <option value="BSc" @if($person->getMeta('highest_degree') === "BSc") selected
                                @endif>{{ __('common.DegreeBSC') }}</option>
                            <option value="MBA" @if($person->getMeta('highest_degree') === "MBA") selected
                                @endif>{{ __('common.DegreeMBA') }}</option>
                            <option value="NDS" @if($person->getMeta('highest_degree') === "NDS") selected
                                @endif>{{ __('common.DegreeNDS') }}</option>
                            <option value="Uni" @if($person->getMeta('highest_degree') === "Uni") selected
                                @endif>{{ __('common.DegreeUni') }}</option>
                            <option value="DrPhil" @if($person->getMeta('highest_degree') === "Dr. phil.") selected
                                @endif>{{ __('common.DegreeDrPhil') }}</option>
                            <option value="PhD" @if($person->getMeta('highest_degree') === "PhD") selected
                                @endif>{{ __('common.DegreePhD') }}</option>
                            <option value="Prof" @if($person->getMeta('highest_degree') === "Prof") selected
                                @endif>{{ __('common.DegreeProf') }}</option>
                            <option value="other" @if($person->getMeta('highest_degree') === "other") selected
                                @endif>{{ __('common.Other') }}</option>
                        </select>
                    </div>

                    <div class="form-group col-xl-3">
                        <label
                            class="@if($person->getMeta('highest_degree') == '') text-danger @else text-muted @endif mb-0 font-size-sm"
                            for="highest_degree_other"><small>{{ __('common.HighestDegree') }}
                                {{ __('common.AdditionalField') }}</small></label>
                        <input type="text"
                            class="form-control {{ @$errors->has('highest_degree_other') ? "is-invalid" : "" }}"
                            id="highest_degree_other" name="meta[highest_degree_other]"
                            placeholder="{{ __('common.HighestDegree') }} {{ __('common.AdditionalField') }}"
                            value="{{ $person->getMeta('highest_degree_other') }}" {{ $action }}>
                    </div>

                    <div class="form-group col-xl-2">
                        <label
                            class="@if($person->getMeta('birthday') == '') text-danger @else text-muted @endif mb-0 font-size-sm"
                            for="birthday"><small>{{ __('common.Birthday') }}</small></label>
                        <input type="text" data-week-start="1" data-autoclose="true" data-today-highlight="true"
                            data-date-format="d.m.Y"
                            class="js-datepicker form-control js-datepicker-enabled {{ @$errors->has('birthday') ? "is-invalid" : "" }}"
                            id="birthday" name="meta[birthday]" placeholder="{{ __('common.Birthday') }}"
                            value="{{ $person->getMeta('birthday') }}" {{ $action }}>
                    </div>
                    <div class="form-group col-xl-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="nationality"><small>{{ __('common.Nationality') }}</small></label>
                        <input type="text" class="form-control {{ @$errors->has('nationality') ? "is-invalid" : "" }}"
                            id="nationality" name="meta[nationality]" placeholder="{{ __('common.Nationality') }}"
                            value="{{ $person->getMeta('nationality') }}" {{ $action }}>
                    </div>
                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="native_home_place"><small>{{ __('common.NativeHomePlace') }}</small></label>
                        <input type="text"
                            class="form-control {{ @$errors->has('native_home_place') ? "is-invalid" : "" }}"
                            id="native_home_place" name="meta[native_home_place]"
                            placeholder="{{ __('common.NativeHomePlace') }}"
                            value="{{ $person->getMeta('native_home_place') }}" {{ $action }}>
                    </div>

                    <div class="form-group col-xl-2">
                        <label
                            class="@if($person->getMeta('permit_type') == '') text-danger @else text-muted @endif mb-0 font-size-sm"
                            for="permit_type"><small>{{ __('common.PermitType') }}</small></label>
                        <select class="form-control" id="permit_type" name="meta[permit_type]" @if($action==="readonly"
                            ) disabled @endif title="{{ __('common.PermitType') }}">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="CH" @if($person->getMeta('permit_type') === "CH") selected
                                @endif>{{ __('common.PermitCH') }}</option>
                            <option value="EU" @if($person->getMeta('permit_type') === "EU") selected
                                @endif>{{ __('common.PermitEU') }}</option>
                            <option value="LEU" @if($person->getMeta('permit_type') === "LEU") selected
                                @endif>{{ __('common.PermitLEU') }}</option>
                            <option value="BEU" @if($person->getMeta('permit_type') === "BEU") selected
                                @endif>{{ __('common.PermitBEU') }}</option>
                            <option value="CEU" @if($person->getMeta('permit_type') === "CEU") selected
                                @endif>{{ __('common.PermitCEU') }}</option>
                            <option value="CiEU" @if($person->getMeta('permit_type') === "CiEU") selected
                                @endif>{{ __('common.PermitCiEU') }}</option>
                            <option value="GEU" @if($person->getMeta('permit_type') === "GEU") selected
                                @endif>{{ __('common.PermitGEU') }}</option>
                            <option value="G" @if($person->getMeta('permit_type') === "G") selected
                                @endif>{{ __('common.PermitG') }}</option>
                            <option value="N" @if($person->getMeta('permit_type') === "N") selected
                                @endif>{{ __('common.PermitN') }}</option>
                            <option value="S" @if($person->getMeta('permit_type') === "S") selected
                                @endif>{{ __('common.PermitS') }}</option>
                            <option value="other" @if($person->getMeta('permit_type') === "other") selected
                                @endif>{{ __('common.Other') }}</option>
                        </select>
                    </div>

                    <div class="form-group col-xl-3">
                        <label
                            class="@if($person->getMeta('permit_type') == '') text-danger @else text-muted @endif mb-0 font-size-sm"
                            for="permit_type_other"><small>{{ __('common.PermitType') }}
                                {{ __('common.AdditionalField') }}</small></label>
                        <input type="text"
                            class="form-control {{ @$errors->has('permit_type_other') ? "is-invalid" : "" }}"
                            id="permit_type_other" name="meta[permit_type_other]"
                            placeholder="{{ __('common.PermitType') }} {{ __('common.AdditionalField') }}"
                            value="{{ $person->getMeta('permit_type_other') }}" {{ $action }}>
                    </div>


                    <div class="form-group col-xl-2">
                        <label
                            class="@if($person->getMeta('didactic_skills') == '') text-danger @else text-muted @endif mb-0 font-size-sm"
                            for="didactic_skills"><small>{{ __('common.DidacticSkills') }}</small></label>
                        <select class="form-control" id="didactic_skills" name="meta[didactic_skills]"
                            @if($action==="readonly" ) disabled @endif title="{{ __('common.DidacticSkills') }}">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="SVEB1" @if($person->getMeta('didactic_skills') === "SVEB1") selected
                                @endif>{{ __('common.SVEB1') }}</option>
                            <option value="SVEB2" @if($person->getMeta('didactic_skills') === "SVEB2") selected
                                @endif>{{ __('common.SVEB2') }}</option>
                            <option value="SVEB3" @if($person->getMeta('didactic_skills') === "SVEB3") selected
                                @endif>{{ __('common.SVEB3') }}</option>
                            <option value="SVEB4" @if($person->getMeta('didactic_skills') === "SVEB4") selected
                                @endif>{{ __('common.SVEB4') }}</option>
                            <option value="SVEB5" @if($person->getMeta('didactic_skills') === "SVEB5") selected
                                @endif>{{ __('common.SVEB5') }}</option>
                            <option value="FA" @if($person->getMeta('didactic_skills') === "FA") selected
                                @endif>{{ __('common.FA') }} {{ __('common.Instructor') }}</option>
                            <option value="BP" @if($person->getMeta('didactic_skills') === "BP") selected
                                @endif>{{ __('common.BP') }}</option>
                            <option value="other" @if($person->getMeta('didactic_skills') === "other") selected
                                @endif>{{ __('common.Other') }}</option>
                        </select>
                    </div>

                    <div class="form-group col-xl-3">
                        <label
                            class="@if($person->getMeta('didactic_skills') == '') text-danger @else text-muted @endif mb-0 font-size-sm"
                            for="didactic_skills_other"><small>{{ __('common.DidacticSkills') }}
                                {{ __('common.AdditionalField') }}</small></label>
                        <input type="text"
                            class="form-control {{ @$errors->has('didactic_skills_other') ? "is-invalid" : "" }}"
                            id="didactic_skills_other" name="meta[didactic_skills_other]"
                            placeholder="{{ __('common.DidacticSkills') }} {{ __('common.AdditionalField') }}"
                            value="{{ $person->getMeta('didactic_skills_other') }}" {{ $action }}>
                    </div>

                    <div class="form-group col-xl-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="trainer_experience"><small>{{ __('common.TrainerExperience') }}</small></label>
                        <input type="text"
                            class="form-control {{ @$errors->has('trainer_experience') ? "is-invalid" : "" }}"
                            id="trainer_experience" name="meta[trainer_experience]"
                            placeholder="{{ __('common.TrainerExperience') }}"
                            value="{{ $person->getMeta('trainer_experience') }}" {{ $action }}>
                    </div>

                    <div class="form-group col-xl-4">
                        <label
                            class="@if($person->getMeta('source_tax_profile') == '') text-danger @else text-muted @endif mb-0 font-size-sm"
                            for="source_tax_profile"><small>{{ __('common.SourceTaxProfile') }}</small></label>
                        <select class="form-control" id="source_tax_profile" name="meta[source_tax_profile]"
                            @if($action==="readonly" ) disabled @endif title="{{ __('common.SourceTaxProfile') }}">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="A" @if($person->getMeta('source_tax_profile') === "A") selected
                                @endif>{{ __('common.SourceTaxProfileA')}}</option>
                            <option value="B" @if($person->getMeta('source_tax_profile') === "B") selected
                                @endif>{{ __('common.SourceTaxProfileB')}}</option>
                            <option value="C" @if($person->getMeta('source_tax_profile') === "C") selected
                                @endif>{{ __('common.SourceTaxProfileC')}}</option>
                            <option value="D" @if($person->getMeta('source_tax_profile') === "D") selected
                                @endif>{{ __('common.SourceTaxProfileD')}}</option>
                            <option value="E" @if($person->getMeta('source_tax_profile') === "E") selected
                                @endif>{{ __('common.SourceTaxProfileE')}}</option>
                            <option value="F" @if($person->getMeta('source_tax_profile') === "F") selected
                                @endif>{{ __('common.SourceTaxProfileF')}}</option>
                            <option value="H" @if($person->getMeta('source_tax_profile') === "H") selected
                                @endif>{{ __('common.SourceTaxProfileH')}}</option>
                            <option value="L" @if($person->getMeta('source_tax_profile') === "L") selected
                                @endif>{{ __('common.SourceTaxProfileL')}}</option>
                            <option value="M" @if($person->getMeta('source_tax_profile') === "M") selected
                                @endif>{{ __('common.SourceTaxProfileM')}}</option>
                            <option value="N" @if($person->getMeta('source_tax_profile') === "N") selected
                                @endif>{{ __('common.SourceTaxProfileN')}}</option>
                            <option value="O" @if($person->getMeta('source_tax_profile') === "O") selected
                                @endif>{{ __('common.SourceTaxProfileO')}}</option>
                            <option value="P" @if($person->getMeta('source_tax_profile') === "P") selected
                                @endif>{{ __('common.SourceTaxProfileP')}}</option>
                        </select>
                    </div>
                    <div class="form-group col-xl-3">
                        <label
                            class="@if($person->getMeta('ahv_number') == '') text-danger @else text-muted @endif mb-0 font-size-sm"
                            for="ahv_number"><small>{{ __('common.AHVNumber') }}</small></label>
                        <input type="text" class="form-control {{ @$errors->has('ahv_number') ? "is-invalid" : "" }}"
                            id="ahv_number" name="meta[ahv_number]" placeholder="{{ __('common.AHVNumber') }}"
                            value="{{ $person->getMeta('ahv_number') }}" {{ $action }}>
                    </div>


                    <div class="form-group col-xl-2">
                        <label
                            class="@if($person->getMeta('employment_status') == '') text-danger @else text-muted @endif mb-0 font-size-sm"
                            for="employment_status"><small>{{ __('common.EmploymentStatus') }}</small></label>
                        <select class="form-control" id="employment_status" name="meta[employment_status]"
                            @if($action==="readonly" ) disabled @endif title="{{ __('common.EmploymentStatus') }}">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="Person" @if($person->getMeta('employment_status') === "Person") selected
                                @endif>{{ __('common.Person')}}</option>
                            <option value="Company" @if($person->getMeta('employment_status') === "Company") selected
                                @endif>{{ __('common.Company')}}</option>
                            <option value="GmbH" @if($person->getMeta('employment_status') === "GmbH") selected
                                @endif>{{ __('common.GmbH')}}</option>
                            <option value="AG" @if($person->getMeta('employment_status') === "AG") selected
                                @endif>{{ __('common.AG')}}</option>
                            <option value="other" @if($person->getMeta('employment_status') === "other") selected
                                @endif>{{ __('common.Other')}}</option>
                        </select>
                    </div>
                    <div class="form-group col-xl-3">
                        <label
                            class="@if($person->getMeta('employment_status') == '') text-danger @else text-muted @endif mb-0 font-size-sm"
                            for="employment_status_other"><small>{{ __('common.EmploymentStatus') }}
                                {{ __('common.AdditionalField') }}</small></label>
                        <input type="text"
                            class="form-control {{ @$errors->has('employment_status_other') ? "is-invalid" : "" }}"
                            id="employment_status_other" name="meta[employment_status_other]"
                            placeholder="{{ __('common.EmploymentStatus') }} {{ __('common.AdditionalField') }}"
                            value="{{ $person->getMeta('employment_status_other') }}" {{ $action }}>
                    </div>

                    <div class="form-group col-xl-12">
                        <h2 class="content-heading mb-0">{{ __('common.Payment') }}</h2>
                    </div>
                    <div class="form-group col-xl-2">
                        <label
                            class="@if($person->getMeta('payment_type') == '') text-danger @else text-muted @endif mb-0 font-size-sm"
                            for="payment_type"><small>{{ __('common.PaymentType') }}</small></label>
                        <select class="form-control" id="payment_type" name="meta[payment_type]"
                            @if($action==="readonly" ) disabled @endif title="{{ __('common.PaymentType') }}">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="Bank" @if($person->getMeta('payment_type') === "Bank") selected
                                @endif>{{ __('common.Bank')}}</option>
                            <option value="Post" @if($person->getMeta('payment_type') === "Post") selected
                                @endif>{{ __('common.Post')}}</option>
                            <option value="Other" @if($person->getMeta('payment_type') === "Other") selected
                                @endif>{{ __('common.Other')}}</option>
                        </select>
                    </div>

                    <div class="form-group col-xl-3">
                        <label
                            class="@if($person->getMeta('payment_type') == '') text-danger @else text-muted @endif mb-0 font-size-sm"
                            for="payment_type_other"><small>{{ __('common.PaymentType') }}
                                {{ __('common.AdditionalField') }}</small></label>
                        <input type="text"
                            class="form-control {{ @$errors->has('payment_type_other') ? "is-invalid" : "" }}"
                            id="payment_type_other" name="meta[payment_type_other]"
                            placeholder="{{ __('common.PaymentType') }} {{ __('common.AdditionalField') }}"
                            value="{{ $person->getMeta('payment_type_other') }}" {{ $action }}>
                    </div>
                    <div class="form-group col-xl-3">
                        <label
                            class="@if($person->getMeta('bank_name') == '') text-danger @else text-muted @endif mb-0 font-size-sm"
                            for="bank_name"><small>{{ __('common.Name') }} {{ __('common.Bank') }}</small></label>
                        <input type="text" class="form-control {{ @$errors->has('bank_name') ? "is-invalid" : "" }}"
                            id="bank_name" name="meta[bank_name]"
                            placeholder="{{ __('common.Name') }} {{ __('common.Bank') }}"
                            value="{{ $person->getMeta('bank_name') }}" {{ $action }}>
                    </div>
                    <div class="form-group col-xl-4">
                        <label
                            class="@if($person->getMeta('bank_location') == '') text-danger @else text-muted @endif mb-0 font-size-sm"
                            for="bank_location"><small>{{ __('common.Location') }}</small></label>
                        <input type="text" class="form-control {{ @$errors->has('bank_location') ? "is-invalid" : "" }}"
                            id="bank_location" name="meta[bank_location]" placeholder="{{ __('common.Location') }}"
                            value="{{ $person->getMeta('bank_location') }}" {{ $action }}>
                    </div>
                    <div class="form-group col-xl-3">
                        <label
                            class="@if($person->getMeta('account_number') == '') text-danger @else text-muted @endif mb-0 font-size-sm"
                            for="account_number"><small>{{ __('common.AccountNumber') }}</small></label>
                        <input type="text"
                            class="form-control {{ @$errors->has('account_number') ? "is-invalid" : "" }}"
                            id="account_number" name="meta[account_number]"
                            placeholder="{{ __('common.AccountNumber') }}"
                            value="{{ $person->getMeta('account_number') }}" {{ $action }}>
                    </div>
                    <div class="form-group col-xl-3">
                        <label
                            class="@if($person->getMeta('iban') == '') text-danger @else text-muted @endif mb-0 font-size-sm"
                            for="iban"><small>{{ __('common.IBAN') }}</small></label>
                        <input type="text" class="form-control {{ @$errors->has('iban') ? "is-invalid" : "" }}"
                            id="iban" name="meta[iban]" placeholder="{{ __('common.IBAN') }}"
                            value="{{ $person->getMeta('iban') }}" {{ $action }}>
                    </div>
                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="swift"><small>{{ __('common.Swift') }}</small></label>
                        <input type="text" class="form-control {{ @$errors->has('swift') ? "is-invalid" : "" }}"
                            id="swift" name="meta[swift]" placeholder="{{ __('common.Swift') }}"
                            value="{{ $person->getMeta('swift') }}" {{ $action }}>
                    </div>
                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="clearing"><small>{{ __('common.Clearing') }}</small></label>
                        <input type="text" class="form-control {{ @$errors->has('clearing') ? "is-invalid" : "" }}"
                            id="clearing" name="meta[clearing]" placeholder="{{ __('common.Clearing') }}"
                            value="{{ $person->getMeta('clearing') }}" {{ $action }}>
                    </div>
                </div>

            </div>

        </div>
    </form>


    @if (@$person->locations->count() > 0)
    <!-- Locations -->
    <div class="block block-rounded block-themed block-fx-pop animated fadeIn block-mode-hidden">

        <div class="block-header block-header-default bg-gd-fruit">
            <h3 class="block-title">{{ __('common.Locations') }}
                @if ($person)
                {{__('common.From')}} {{ @$person->first_name }} {{ @$person->last_name }}
                ({{ $person->locations->count() }})
                @endif
            </h3>
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
            <table class="js-table-sections table table-hover table-vcenter">
                <thead>
                    <tr>
                        <th style="width: 30px; border-top: none;"></th>
                        <th style="border-top: none;">
                            @sortablelink('street', __('common.Street'))
                        </th>
                        <th style="border-top: none;">
                            @sortablelink('street_number', __('common.Number'))
                        </th>
                        <th style="border-top: none;" class="d-none d-lg-table-cell">
                            @sortablelink('zip', __('common.Zip'))
                        </th>
                        <th style="border-top: none;" class="d-none d-md-table-cell">
                            @sortablelink('city', __('common.City'))
                        </th>
                        <th style="border-top: none;" class="d-none d-lg-table-cell">
                            @sortablelink('country', __('common.Country'))
                        </th>
                        <th style="border-top: none;" class="d-none d-md-table-cell">
                            @sortablelink('type', __('common.Type'))
                        </th>

                        <th style="border-top: none;" class="text-right d-none d-sm-table-cell">
                            <a class="btn btn-dark btn-sm"
                                href="{{ action('LocationController@person', $person->id) }}">
                                <i class="si si-plus"></i>
                            </a>
                        </th>
                    </tr>
                </thead>
                @csrf
                @foreach($person->locations as $location)
                <tbody class="js-table-sections-header">
                    <tr>
                        <td class="text-center">
                            <i class="fa fa-angle-right text-muted"></i>
                        </td>

                        <td>
                            <div class="py-1">
                                <a href="#">{{ $location->street }}</a>
                            </div>
                        </td>
                        <td>
                            <div class="py-1">
                                <a href="#">{{ $location->street_number }}</a>
                            </div>
                        </td>
                        <td class="d-none d-lg-table-cell">
                            <div class="py-1">
                                <a href="#">{{ $location->zip }}</a>
                            </div>
                        </td>
                        <td class="d-none d-md-table-cell">
                            <div class="py-1">
                                <a href="#">{{ $location->city }}</a>
                            </div>
                        </td>
                        <td class="d-none d-lg-table-cell">
                            <div class="py-1">
                                <a href="#">{{ $location->country }}</a>
                            </div>
                        </td>
                        <td class="d-none d-md-table-cell">
                            <div class="py-1">
                                @if($location->type)
                                <button class="btn btn-sm btn-light"><i
                                        class="icon si si-cursor mr-2"></i>{{ __("dynamic.$location->type") }}</button>
                                @endif

                                @if($location->changed)
                                <a href="{{action('LocationController@person', [$location->id, $person->id])}}"
                                    class="btn btn-sm btn-warning" title="{{__('common.DataStatus')}}">
                                    <i class="nav-main-link-icon si si-tag mr-1"></i>
                                    {{__('common.Changed')}}
                                </a>
                                @endif
                            </div>
                        </td>
                        <td class="d-none d-sm-table-cell text-right">


                            <a href="{{ action('LocationController@default', $location->id) }}"
                                class="btn btn-sm btn-{{$location->default === 0 ? 'light' : 'success'}}"><i
                                    class="icon si si-heart mr-2"></i>{{ __('common.Default') }}</a>

                            @if ($location->id)
                            <form
                                action="{{ action('LocationController@person', [$location->id, $location->locationable_id]) }}"
                                method="POST" class="d-inline-block">
                                <input name="_method" type="hidden" value="GET">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm" title="{{__('common.Edit')}}">
                                    <i class="nav-main-link-icon si si-pencil"></i>
                                </button>
                            </form>

                            <form action="{{ action('LocationController@destroy', $location->id) }}" method="POST"
                                class="d-inline-block">
                                <input name="_method" type="hidden" value="DELETE">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm" title="{{__('common.Delete')}}">
                                    <i class="nav-main-link-icon si si-trash"></i>
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                </tbody>
                <tbody class="font-size-sm">
                    <tr>
                        <td class="text-center"></td>
                        <td colspan="10">
                            <p>{{ $location->description }}</p>
                            <h4>{{ __('common.Location') }}</h4>
                            <p>
                                {{ $location->street }} {{ $location->street_number }}<br>
                                {{ $location->zip }} {{ $location->city }}<br>
                                {{ $location->country }}<br>
                            </p>
                            <h4>{{ __('common.Contact') }}</h4>
                            <p>
                                {{ __('common.Email') }}: {{ $location->email }}<br>
                                {{ __('common.Phone') }}: {{ $location->phone }}<br>
                                {{ __('common.Mobile') }}: {{ $location->mobile }}<br>
                                {{ __('common.Fax') }}: {{ $location->fax }}<br>
                                {{ __('common.URL') }}: <a href="{{$location->url}}" target="_blank"
                                    title="{{$location->url}}">{{ $location->url }}</a><br>
                            </p>

                            <p>
                                <em
                                    class="text-muted">{{ Carbon::parse($location->updated_at)->format('d.m.Y H:i')}}</em>
                            </p>
                        </td>

                    </tr>

                </tbody>
                @endforeach
            </table>

        </div>


    </div>
    <!-- END Locations -->
    @endif

    @if (@$person->grades->count() > 0)
    <!-- Grades -->
    <div class="block block-rounded block-themed block-fx-pop block-mode-hidden">

        <div class="block-header block-header-default bg-primary">
            <h3 class="block-title">{{ __('common.Grades') }} ({{ $person->grades->count() }})</h3>
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

            <table class="js-table-sections table table-hover table-vcenter">
                <thead>
                    <tr>
                        <th style="border-top: none;"></th>
                        <th style="border-top: none;">
                            @sortablelink('person_id', __('common.Person'))
                        </th>
                        <th style="border-top: none;" class="d-none d-xl-table-cell">
                            @sortablelink('event_id', __('common.Event'))
                        </th>
                        <th style="border-top: none;" class="d-none d-xl-table-cell">
                            @sortablelink('user_id', __('common.Teacher'))
                        </th>
                        <th style="border-top: none;" class="d-none d-lg-table-cell">
                            @sortablelink('passed', __('common.Passed'))
                        </th>
                        <th style="border-top: none;" class="d-none d-lg-table-cell">
                            @sortablelink('grade', __('common.Grade'))
                        </th>
                        <th style="border-top: none;" class="d-none d-xl-table-cell text-right">
                            @sortablelink('updated_at', __('common.DateUpdated'))
                        </th>

                        <th style="border-top: none;" class="text-right d-none d-sm-table-cell">
                            @hasanyrole('admin|user')
                            <a class="btn btn-dark" href="{{action('GradeController@create')}}">
                                <i class="si si-plus"></i>
                            </a>
                            @endhasanyrole
                        </th>
                    </tr>
                </thead>
                @csrf

                @foreach($person->grades as $grade)
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

                            <a href="{{action('GradeController@edit', $grade->id)}}" class="btn btn-primary">
                                <i class="nav-main-link-icon si si-pencil"></i>
                            </a>

                            <form action="{{action('GradeController@destroy', $grade->id)}}" method="post"
                                class="d-inline">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">

                                <button type="submit" class="btn btn-danger">
                                    <i class="nav-main-link-icon si si-trash"></i>
                                </button>
                            </form>
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


    </div>
    <!-- END Grades -->
    @endif

    @if (@$person->skills->count() > 0)
    <!-- Skills -->
    <div class="block block-rounded block-themed animated block-fx-pop block-mode-hidden fadeIn">
        <div class="block-header block-header-default">
            <h3 class="block-title">
                {{ __('common.Skills') }} {{__('common.From')}} {{ @$person->first_name }} {{ @$person->last_name }}
                ({{ $person->skills->count() }})
            </h3>
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
                @foreach($person->skills as $skill)
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

                            @if ($skill->id)

                            <form action="{{ action('PersonSkillController@detach', [$person->id, $skill->id]) }}"
                                method="POST">
                                <input name="_method" type="hidden" value="GET">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm" title="{{__('common.Delete')}}">
                                    <i class="nav-main-link-icon si si-trash"></i>
                                </button>
                            </form>
                            @endif

                        </td>
                    </tr>
                </tbody>
                <tbody class="font-size-sm">
                    <tr>
                        <td class="text-center"></td>
                        <td colspan="10">
                            <p>
                                {{ __('common.Description') }}: {{ $skill->description }}<br>

                            </p>

                            <p>
                                <em class="text-muted">{{ Carbon::parse($skill->updated_at)->format('d.m.Y H:i')}}</em>
                            </p>
                        </td>

                    </tr>

                </tbody>
                @endforeach
            </table>
        </div>
    </div>
    <!-- END Skills -->
    @endif

    <!-- Person create section -->
    @elseif (@$action === 'create')

    <form action="{{action('PersonController@store')}}" enctype="multipart/form-data" method="post">
        @csrf
        <input name="_method" type="hidden" value="POST">

        <!-- Person create form fields -->
        <div class="block block-rounded block-themed block-fx-pop">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ __('common.Person') }}</h3>
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
                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="salutation"><small>{{ __('common.Salutation') }}</small></label>
                        <select class="form-control" id="salutation" name="salutation">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="mr" {{ (old('salutation') == 'mr' ? 'selected':'') }}>{{ __('common.Mr') }}
                            </option>
                            <option value="mrs" {{ (old('salutation') == 'mrs' ? 'selected':'') }}>
                                {{ __('common.Mrs') }}</option>
                        </select>
                    </div>

                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="first_name"><small>{{ __('common.FirstName') }}</small></label>
                        <input type="text" class="form-control {{ @$errors->has('first_name') ? "is-invalid" : "" }}"
                            id="first_name" name="first_name" placeholder="{{ __('common.FirstName') }}"
                            value="{{ old('first_name') }}">
                    </div>

                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="last_name"><small>{{ __('common.LastName') }}</small></label>
                        <input type="text" class="form-control {{ @$errors->has('last_name') ? "is-invalid" : "" }}"
                            id="last_name" name="last_name" placeholder="{{ __('common.LastName') }}"
                            value="{{ old('last_name') }}">
                    </div>

                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="company_name"><small>{{ __('common.Company') }}</small></label>
                        <input type="text" class="form-control" id="company_name" name="company_name"
                            placeholder="{{ __('common.Company') }}" value="{{ old('company_name') }}" {{ $action }}>
                    </div>


                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="title"><small>{{ __('common.Title') }}</small></label>
                        <input type="text" class="form-control" id="title" name="title"
                            placeholder="{{ __('common.Title') }}" value="{{ old('title') }}" {{ $action }}>
                    </div>

                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="email"><small>{{ __('common.Email') }}</small></label>
                        <input type="text" class="form-control {{ @$errors->has('email') ? "is-invalid" : "" }}"
                            id="email" name="email" placeholder="{{ __('common.Email') }}" value="{{ old('email') }}">
                    </div>


                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="phone"><small>{{ __('common.Phone') }}</small></label>
                        <input type="text" class="form-control {{ @$errors->has('phone') ? "is-invalid" : "" }}"
                            id="phone" name="phone" placeholder="{{ __('common.Phone') }}" value="{{ old('phone') }}">
                    </div>

                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="mobile"><small>{{ __('common.Mobile') }}</small></label>
                        <input type="text" class="form-control {{ @$errors->has('mobile') ? "is-invalid" : "" }}"
                            id="mobile" name="mobile" placeholder="{{ __('common.Mobile') }}"
                            value="{{ old('mobile') }}">
                    </div>

                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="fax"><small>{{ __('common.Fax') }}</small></label>
                        <input type="text" class="form-control {{ @$errors->has('fax') ? "is-invalid" : "" }}" id="fax"
                            name="fax" placeholder="{{ __('common.Fax') }}" value="{{ old('fax') }}">
                    </div>

                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="website"><small>{{ __('common.Website') }}</small></label>
                        <input type="text" class="form-control {{ @$errors->has('website') ? "is-invalid" : "" }}"
                            id="website" name="website" placeholder="{{ __('common.Website') }}"
                            value="{{ old('website') }}">
                    </div>

                    <div class="form-group col-xl-6">
                        <label class="text-muted mb-0 font-size-sm"
                            for="study_id"><small>{{ __('common.Study') }}</small></label>
                        <select @if($action=='readonly' ) disabled @endif class="form-control" id="study_id"
                            name="study_id" title="{{ __('common.Study') }}">
                            <option value="">{{ __('common.Study') }} {{ __('common.select') }}</option>
                            @foreach($studies as $study)
                            <option value="{{ $study->id }}" {{ (old('study_id') == $study->id ? 'selected':'') }}>
                                {{ $study->name }}</option>
                            @endforeach
                        </select>
                    </div>



                    @if($action === 'edit')
                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm" for="picture"><small>{{ __('common.Image') }}
                            </small></label>
                        <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                        <input type="file"
                            class="custom-file-input js-custom-file-input-enabled {{ @$errors->has('picture') ? "is-invalid" : "" }}"
                            data-toggle="custom-file-input" id="picture" name="picture"
                            placeholder="{{ __('common.Image') }}">
                        <label class="custom-file-label" for="picture"
                            style="margin-left: 14px; margin-right: 14px; top: 24px; ">{{ __('common.Choose') }}</label>
                    </div>
                    @endif


                    <div class="form-group col-xl-12">
                        <label class="text-muted mb-0 font-size-sm"
                            for="notes"><small>{{ __('common.Notes') }}</small></label>
                        <textarea {{ $action }} rows="4"
                            class="form-control {{ @$errors->has('notes') ? "is-invalid" : "" }}" id="notes"
                            name="notes" placeholder="{{ __('common.Notes') }}">{{ old('notes') }}</textarea>
                    </div>
                </div>
            </div>
            <div class="block-content block-content-full text-right bg-light">

                <a class="btn btn-warning" href="{{action('PersonController@index')}}">
                    <i class="si si-action-undo mr-1"></i>
                    {{ __('common.Close') }}
                </a>

                <button type="submit" class="btn btn-primary">
                    <i class="si si-fire mr-1"></i>
                    {{ __('common.Save') }}
                </button>
            </div>
        </div>

        <div class="block block-rounded block-themed block-mode-hidden">
            <div class="block-header block-header-default bg-gd-aqua">
                <h3 class="block-title">{{ __('common.MetaFields') }} <span
                        class="badge badge-dark">{{ __('common.Optional') }}</span></h3>
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

                <div class="row">
                    <div class="form-group col-xl-1">
                        <label class="text-muted mb-0 font-size-sm"
                            for="title"><small>{{ __('common.Title') }}</small></label>
                        <input type="text" class="form-control {{ @$errors->has('title') ? "is-invalid" : "" }}"
                            id="title" name="meta[title]" placeholder="{{ __('common.Title') }}"
                            value="{{ old('meta.meta.title') }}" {{ $action }}>
                    </div>
                    <div class="form-group col-xl-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="civil_status"><small>{{ __('common.CivilStatus') }}</small></label>
                        <select class="form-control" id="civil_status" name="meta[civil_status]"
                            @if($action==="readonly" ) disabled @endif title="{{ __('common.CivilStatus') }}">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="single" @if(old('meta.civil_status')==="single" ) selected @endif>
                                {{ __('common.CivilStatusSingle')}}</option>
                            <option value="married" @if(old('meta.civil_status')==="married" ) selected @endif>
                                {{ __('common.CivilStatusMarried')}}</option>
                            <option value="divorced" @if(old('meta.civil_status')==="divorced" ) selected @endif>
                                {{ __('common.CivilStatusDivorced')}}</option>
                            <option value="separated" @if(old('meta.civil_status')==="separated" ) selected @endif>
                                {{ __('common.CivilStatusSeparated')}}</option>
                            <option value="partnership" @if(old('meta.civil_status')==="partnership" ) selected @endif>
                                {{ __('common.CivilStatusPartnership')}}</option>
                            <option value="other" @if(old('meta.civil_status')==="other" ) selected @endif>
                                {{ __('common.Other')}}</option>
                        </select>
                    </div>
                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="civil_status_other"><small>{{ __('common.CivilStatus') }}
                                {{ __('common.AdditionalField') }}</small></label>
                        <input type="text"
                            class="form-control {{ @$errors->has('civil_status_other') ? "is-invalid" : "" }}"
                            id="civil_status_other" name="meta[civil_status_other]"
                            placeholder="{{ __('common.CivilStatus') }} {{ __('common.AdditionalField') }}"
                            value="{{ old('meta.civil_status_other') }}" {{ $action }}>
                    </div>
                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="partner_name"><small>{{ __('common.PartnerName') }}</small></label>
                        <input type="text" class="form-control {{ @$errors->has('partner_name') ? "is-invalid" : "" }}"
                            id="partner_name" name="meta[partner_name]" placeholder="{{ __('common.PartnerName') }}"
                            value="{{ old('meta.partner_name') }}" {{ $action }}>
                    </div>
                    <div class="form-group col-xl-1">
                        <label class="text-muted mb-0 font-size-sm"
                            for="number_of_children"><small>{{ __('common.Children') }}</small></label>
                        <input type="number"
                            class="form-control {{ @$errors->has('number_of_children') ? "is-invalid" : "" }}"
                            id="number_of_children" name="meta[number_of_children]"
                            placeholder="{{ __('common.Count') }}" value="{{ old('meta.number_of_children') }}"
                            {{ $action }}>
                    </div>
                    <div class="form-group col-xl-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="confession"><small>{{ __('common.Confession') }}</small></label>
                        <input type="text" class="form-control {{ @$errors->has('confession') ? "is-invalid" : "" }}"
                            id="confession" name="meta[confession]" placeholder="{{ __('common.Confession') }}"
                            value="{{ old('meta.confession') }}" {{ $action }}>
                    </div>

                    <div class="form-group col-xl-2">
                        <label
                            class="@if(old('meta.highest_degree') == '') text-danger @else text-muted @endif mb-0 font-size-sm"
                            for="highest_degree"><small>{{ __('common.HighestDegree') }}</small></label>
                        <select class="form-control" id="highest_degree" name="meta[highest_degree]"
                            @if($action==="readonly" ) disabled @endif title="{{ __('common.HighestDegree') }}">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="EFZ" @if(old('meta.highest_degree')==="EFZ" ) selected @endif>
                                {{ __('common.DegreeEFZ') }}</option>
                            <option value="HF" @if(old('meta.highest_degree')==="HF" ) selected @endif>
                                {{ __('common.DegreeHF') }}</option>
                            <option value="FH" @if(old('meta.highest_degree')==="FH" ) selected @endif>
                                {{ __('common.DegreeFH') }}</option>
                            <option value="Diplom" @if(old('meta.highest_degree')==="Diplom" ) selected @endif>
                                {{ __('common.DegreeDipl') }}</option>
                            <option value="MAS" @if(old('meta.highest_degree')==="MAS" ) selected @endif>
                                {{ __('common.DegreeMAS') }}</option>
                            <option value="MSc" @if(old('meta.highest_degree')==="MSc" ) selected @endif>
                                {{ __('common.DegreeMSC') }}</option>
                            <option value="BSc" @if(old('meta.highest_degree')==="BSc" ) selected @endif>
                                {{ __('common.DegreeBSC') }}</option>
                            <option value="MBA" @if(old('meta.highest_degree')==="MBA" ) selected @endif>
                                {{ __('common.DegreeMBA') }}</option>
                            <option value="NDS" @if(old('meta.highest_degree')==="NDS" ) selected @endif>
                                {{ __('common.DegreeNDS') }}</option>
                            <option value="Uni" @if(old('meta.highest_degree')==="Uni" ) selected @endif>
                                {{ __('common.DegreeUni') }}</option>
                            <option value="DrPhil" @if(old('meta.highest_degree')==="Dr. phil." ) selected @endif>
                                {{ __('common.DegreeDrPhil') }}</option>
                            <option value="PhD" @if(old('meta.highest_degree')==="PhD" ) selected @endif>
                                {{ __('common.DegreePhD') }}</option>
                            <option value="Prof" @if(old('meta.highest_degree')==="Prof" ) selected @endif>
                                {{ __('common.DegreeProf') }}</option>
                            <option value="other" @if(old('meta.highest_degree')==="other" ) selected @endif>
                                {{ __('common.Other') }}</option>
                        </select>
                    </div>

                    <div class="form-group col-xl-3">
                        <label
                            class="@if(old('meta.highest_degree') == '') text-danger @else text-muted @endif mb-0 font-size-sm"
                            for="highest_degree_other"><small>{{ __('common.HighestDegree') }}
                                {{ __('common.AdditionalField') }}</small></label>
                        <input type="text"
                            class="form-control {{ @$errors->has('highest_degree_other') ? "is-invalid" : "" }}"
                            id="highest_degree_other" name="meta[highest_degree_other]"
                            placeholder="{{ __('common.HighestDegree') }} {{ __('common.AdditionalField') }}"
                            value="{{ old('meta.highest_degree_other') }}" {{ $action }}>
                    </div>

                    <div class="form-group col-xl-2">
                        <label
                            class="@if(old('meta.birthday') == '') text-danger @else text-muted @endif mb-0 font-size-sm"
                            for="birthday"><small>{{ __('common.Birthday') }}</small></label>
                        <input type="text" data-week-start="1" data-autoclose="true" data-today-highlight="true"
                            data-date-format="d.m.Y"
                            class="js-datepicker form-control js-datepicker-enabled {{ @$errors->has('birthday') ? "is-invalid" : "" }}"
                            id="birthday" name="meta[birthday]" placeholder="{{ __('common.Birthday') }}"
                            value="{{ old('meta.birthday') }}" {{ $action }}>
                    </div>
                    <div class="form-group col-xl-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="nationality"><small>{{ __('common.Nationality') }}</small></label>
                        <input type="text" class="form-control {{ @$errors->has('nationality') ? "is-invalid" : "" }}"
                            id="nationality" name="meta[nationality]" placeholder="{{ __('common.Nationality') }}"
                            value="{{ old('meta.nationality') }}" {{ $action }}>
                    </div>
                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="native_home_place"><small>{{ __('common.NativeHomePlace') }}</small></label>
                        <input type="text"
                            class="form-control {{ @$errors->has('native_home_place') ? "is-invalid" : "" }}"
                            id="native_home_place" name="meta[native_home_place]"
                            placeholder="{{ __('common.NativeHomePlace') }}" value="{{ old('meta.native_home_place') }}"
                            {{ $action }}>
                    </div>

                    <div class="form-group col-xl-2">
                        <label
                            class="@if(old('meta.permit_type') == '') text-danger @else text-muted @endif mb-0 font-size-sm"
                            for="permit_type"><small>{{ __('common.PermitType') }}</small></label>
                        <select class="form-control" id="permit_type" name="meta[permit_type]" @if($action==="readonly"
                            ) disabled @endif title="{{ __('common.PermitType') }}">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="CH" @if(old('meta.permit_type')==="CH" ) selected @endif>
                                {{ __('common.PermitCH') }}</option>
                            <option value="EU" @if(old('meta.permit_type')==="EU" ) selected @endif>
                                {{ __('common.PermitEU') }}</option>
                            <option value="LEU" @if(old('meta.permit_type')==="LEU" ) selected @endif>
                                {{ __('common.PermitLEU') }}</option>
                            <option value="BEU" @if(old('meta.permit_type')==="BEU" ) selected @endif>
                                {{ __('common.PermitBEU') }}</option>
                            <option value="CEU" @if(old('meta.permit_type')==="CEU" ) selected @endif>
                                {{ __('common.PermitCEU') }}</option>
                            <option value="CiEU" @if(old('meta.permit_type')==="CiEU" ) selected @endif>
                                {{ __('common.PermitCiEU') }}</option>
                            <option value="GEU" @if(old('meta.permit_type')==="GEU" ) selected @endif>
                                {{ __('common.PermitGEU') }}</option>
                            <option value="G" @if(old('meta.permit_type')==="G" ) selected @endif>
                                {{ __('common.PermitG') }}</option>
                            <option value="N" @if(old('meta.permit_type')==="N" ) selected @endif>
                                {{ __('common.PermitN') }}</option>
                            <option value="S" @if(old('meta.permit_type')==="S" ) selected @endif>
                                {{ __('common.PermitS') }}</option>
                            <option value="other" @if(old('meta.permit_type')==="other" ) selected @endif>
                                {{ __('common.Other') }}</option>
                        </select>
                    </div>

                    <div class="form-group col-xl-3">
                        <label
                            class="@if(old('meta.permit_type') == '') text-danger @else text-muted @endif mb-0 font-size-sm"
                            for="permit_type_other"><small>{{ __('common.PermitType') }}
                                {{ __('common.AdditionalField') }}</small></label>
                        <input type="text"
                            class="form-control {{ @$errors->has('permit_type_other') ? "is-invalid" : "" }}"
                            id="permit_type_other" name="meta[permit_type_other]"
                            placeholder="{{ __('common.PermitType') }} {{ __('common.AdditionalField') }}"
                            value="{{ old('meta.permit_type_other') }}" {{ $action }}>
                    </div>


                    <div class="form-group col-xl-2">
                        <label
                            class="@if(old('meta.didactic_skills') == '') text-danger @else text-muted @endif mb-0 font-size-sm"
                            for="didactic_skills"><small>{{ __('common.DidacticSkills') }}</small></label>
                        <select class="form-control" id="didactic_skills" name="meta[didactic_skills]"
                            @if($action==="readonly" ) disabled @endif title="{{ __('common.DidacticSkills') }}">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="SVEB1" @if(old('meta.didactic_skills')==="SVEB1" ) selected @endif>
                                {{ __('common.SVEB1') }}</option>
                            <option value="SVEB2" @if(old('meta.didactic_skills')==="SVEB2" ) selected @endif>
                                {{ __('common.SVEB2') }}</option>
                            <option value="SVEB3" @if(old('meta.didactic_skills')==="SVEB3" ) selected @endif>
                                {{ __('common.SVEB3') }}</option>
                            <option value="SVEB4" @if(old('meta.didactic_skills')==="SVEB4" ) selected @endif>
                                {{ __('common.SVEB4') }}</option>
                            <option value="SVEB5" @if(old('meta.didactic_skills')==="SVEB5" ) selected @endif>
                                {{ __('common.SVEB5') }}</option>
                            <option value="FA" @if(old('meta.didactic_skills')==="FA" ) selected @endif>
                                {{ __('common.FA') }} {{ __('common.Instructor') }}</option>
                            <option value="BP" @if(old('meta.didactic_skills')==="BP" ) selected @endif>
                                {{ __('common.BP') }}</option>
                            <option value="other" @if(old('meta.didactic_skills')==="other" ) selected @endif>
                                {{ __('common.Other') }}</option>
                        </select>
                    </div>

                    <div class="form-group col-xl-3">
                        <label
                            class="@if(old('meta.didactic_skills') == '') text-danger @else text-muted @endif mb-0 font-size-sm"
                            for="didactic_skills_other"><small>{{ __('common.DidacticSkills') }}
                                {{ __('common.AdditionalField') }}</small></label>
                        <input type="text"
                            class="form-control {{ @$errors->has('didactic_skills_other') ? "is-invalid" : "" }}"
                            id="didactic_skills_other" name="meta[didactic_skills_other]"
                            placeholder="{{ __('common.DidacticSkills') }} {{ __('common.AdditionalField') }}"
                            value="{{ old('meta.didactic_skills_other') }}" {{ $action }}>
                    </div>

                    <div class="form-group col-xl-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="trainer_experience"><small>{{ __('common.TrainerExperience') }}</small></label>
                        <input type="text"
                            class="form-control {{ @$errors->has('trainer_experience') ? "is-invalid" : "" }}"
                            id="trainer_experience" name="meta[trainer_experience]"
                            placeholder="{{ __('common.TrainerExperience') }}"
                            value="{{ old('meta.trainer_experience') }}" {{ $action }}>
                    </div>

                    <div class="form-group col-xl-4">
                        <label
                            class="@if(old('meta.source_tax_profile') == '') text-danger @else text-muted @endif mb-0 font-size-sm"
                            for="source_tax_profile"><small>{{ __('common.SourceTaxProfile') }}</small></label>
                        <select class="form-control" id="source_tax_profile" name="meta[source_tax_profile]"
                            @if($action==="readonly" ) disabled @endif title="{{ __('common.SourceTaxProfile') }}">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="A" @if(old('meta.source_tax_profile')==="A" ) selected @endif>
                                {{ __('common.SourceTaxProfileA')}}</option>
                            <option value="B" @if(old('meta.source_tax_profile')==="B" ) selected @endif>
                                {{ __('common.SourceTaxProfileB')}}</option>
                            <option value="C" @if(old('meta.source_tax_profile')==="C" ) selected @endif>
                                {{ __('common.SourceTaxProfileC')}}</option>
                            <option value="D" @if(old('meta.source_tax_profile')==="D" ) selected @endif>
                                {{ __('common.SourceTaxProfileD')}}</option>
                            <option value="E" @if(old('meta.source_tax_profile')==="E" ) selected @endif>
                                {{ __('common.SourceTaxProfileE')}}</option>
                            <option value="F" @if(old('meta.source_tax_profile')==="F" ) selected @endif>
                                {{ __('common.SourceTaxProfileF')}}</option>
                            <option value="H" @if(old('meta.source_tax_profile')==="H" ) selected @endif>
                                {{ __('common.SourceTaxProfileH')}}</option>
                            <option value="L" @if(old('meta.source_tax_profile')==="L" ) selected @endif>
                                {{ __('common.SourceTaxProfileL')}}</option>
                            <option value="M" @if(old('meta.source_tax_profile')==="M" ) selected @endif>
                                {{ __('common.SourceTaxProfileM')}}</option>
                            <option value="N" @if(old('meta.source_tax_profile')==="N" ) selected @endif>
                                {{ __('common.SourceTaxProfileN')}}</option>
                            <option value="O" @if(old('meta.source_tax_profile')==="O" ) selected @endif>
                                {{ __('common.SourceTaxProfileO')}}</option>
                            <option value="P" @if(old('meta.source_tax_profile')==="P" ) selected @endif>
                                {{ __('common.SourceTaxProfileP')}}</option>
                        </select>
                    </div>
                    <div class="form-group col-xl-3">
                        <label
                            class="@if(old('meta.ahv_number') == '') text-danger @else text-muted @endif mb-0 font-size-sm"
                            for="ahv_number"><small>{{ __('common.AHVNumber') }}</small></label>
                        <input type="text" class="form-control {{ @$errors->has('ahv_number') ? "is-invalid" : "" }}"
                            id="ahv_number" name="meta[ahv_number]" placeholder="{{ __('common.AHVNumber') }}"
                            value="{{ old('meta.ahv_number') }}" {{ $action }}>
                    </div>


                    <div class="form-group col-xl-2">
                        <label
                            class="@if(old('meta.employment_status') == '') text-danger @else text-muted @endif mb-0 font-size-sm"
                            for="employment_status"><small>{{ __('common.EmploymentStatus') }}</small></label>
                        <select class="form-control" id="employment_status" name="meta[employment_status]"
                            @if($action==="readonly" ) disabled @endif title="{{ __('common.EmploymentStatus') }}">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="Person" @if(old('meta.employment_status')==="Person" ) selected @endif>
                                {{ __('common.Person')}}</option>
                            <option value="Company" @if(old('meta.employment_status')==="Company" ) selected @endif>
                                {{ __('common.Company')}}</option>
                            <option value="GmbH" @if(old('meta.employment_status')==="GmbH" ) selected @endif>
                                {{ __('common.GmbH')}}</option>
                            <option value="AG" @if(old('meta.employment_status')==="AG" ) selected @endif>
                                {{ __('common.AG')}}</option>
                            <option value="other" @if(old('meta.employment_status')==="other" ) selected @endif>
                                {{ __('common.Other')}}</option>
                        </select>
                    </div>
                    <div class="form-group col-xl-3">
                        <label
                            class="@if(old('meta.employment_status') == '') text-danger @else text-muted @endif mb-0 font-size-sm"
                            for="employment_status_other"><small>{{ __('common.EmploymentStatus') }}
                                {{ __('common.AdditionalField') }}</small></label>
                        <input type="text"
                            class="form-control {{ @$errors->has('employment_status_other') ? "is-invalid" : "" }}"
                            id="employment_status_other" name="meta[employment_status_other]"
                            placeholder="{{ __('common.EmploymentStatus') }} {{ __('common.AdditionalField') }}"
                            value="{{ old('meta.employment_status_other') }}" {{ $action }}>
                    </div>



                    <div class="form-group col-xl-12">
                        <h2 class="content-heading mb-0">{{ __('common.Payment') }}</h2>
                    </div>
                    <div class="form-group col-xl-2">
                        <label
                            class="@if(old('meta.payment_type') == '') text-danger @else text-muted @endif mb-0 font-size-sm"
                            for="payment_type"><small>{{ __('common.PaymentType') }}</small></label>
                        <select class="form-control" id="payment_type" name="meta[payment_type]"
                            @if($action==="readonly" ) disabled @endif title="{{ __('common.PaymentType') }}">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="Bank" @if(old('meta.payment_type')==="Bank" ) selected @endif>
                                {{ __('common.Bank')}}</option>
                            <option value="Post" @if(old('meta.payment_type')==="Post" ) selected @endif>
                                {{ __('common.Post')}}</option>
                            <option value="Other" @if(old('meta.payment_type')==="Other" ) selected @endif>
                                {{ __('common.Other')}}</option>
                        </select>
                    </div>

                    <div class="form-group col-xl-3">
                        <label
                            class="@if(old('meta.payment_type') == '') text-danger @else text-muted @endif mb-0 font-size-sm"
                            for="payment_type_other"><small>{{ __('common.PaymentType') }}
                                {{ __('common.AdditionalField') }}</small></label>
                        <input type="text"
                            class="form-control {{ @$errors->has('payment_type_other') ? "is-invalid" : "" }}"
                            id="payment_type_other" name="meta[payment_type_other]"
                            placeholder="{{ __('common.PaymentType') }} {{ __('common.AdditionalField') }}"
                            value="{{ old('meta.payment_type_other') }}" {{ $action }}>
                    </div>
                    <div class="form-group col-xl-3">
                        <label
                            class="@if(old('meta.bank_name') == '') text-danger @else text-muted @endif mb-0 font-size-sm"
                            for="bank_name"><small>{{ __('common.Name') }} {{ __('common.Bank') }}</small></label>
                        <input type="text" class="form-control {{ @$errors->has('bank_name') ? "is-invalid" : "" }}"
                            id="bank_name" name="meta[bank_name]"
                            placeholder="{{ __('common.Name') }} {{ __('common.Bank') }}"
                            value="{{ old('meta.bank_name') }}" {{ $action }}>
                    </div>
                    <div class="form-group col-xl-4">
                        <label
                            class="@if(old('meta.bank_location') == '') text-danger @else text-muted @endif mb-0 font-size-sm"
                            for="bank_location"><small>{{ __('common.Location') }}</small></label>
                        <input type="text" class="form-control {{ @$errors->has('bank_location') ? "is-invalid" : "" }}"
                            id="bank_location" name="meta[bank_location]" placeholder="{{ __('common.Location') }}"
                            value="{{ old('meta.bank_location') }}" {{ $action }}>
                    </div>
                    <div class="form-group col-xl-3">
                        <label
                            class="@if(old('meta.account_number') == '') text-danger @else text-muted @endif mb-0 font-size-sm"
                            for="account_number"><small>{{ __('common.AccountNumber') }}</small></label>
                        <input type="text"
                            class="form-control {{ @$errors->has('account_number') ? "is-invalid" : "" }}"
                            id="account_number" name="meta[account_number]"
                            placeholder="{{ __('common.AccountNumber') }}" value="{{ old('meta.account_number') }}"
                            {{ $action }}>
                    </div>
                    <div class="form-group col-xl-3">
                        <label class="@if(old('meta.iban') == '') text-danger @else text-muted @endif mb-0 font-size-sm"
                            for="iban"><small>{{ __('common.IBAN') }}</small></label>
                        <input type="text" class="form-control {{ @$errors->has('iban') ? "is-invalid" : "" }}"
                            id="iban" name="meta[iban]" placeholder="{{ __('common.IBAN') }}"
                            value="{{ old('meta.iban') }}" {{ $action }}>
                    </div>
                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="swift"><small>{{ __('common.Swift') }}</small></label>
                        <input type="text" class="form-control {{ @$errors->has('swift') ? "is-invalid" : "" }}"
                            id="swift" name="meta[swift]" placeholder="{{ __('common.Swift') }}"
                            value="{{ old('meta.swift') }}" {{ $action }}>
                    </div>
                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="clearing"><small>{{ __('common.Clearing') }}</small></label>
                        <input type="text" class="form-control {{ @$errors->has('clearing') ? "is-invalid" : "" }}"
                            id="clearing" name="meta[clearing]" placeholder="{{ __('common.Clearing') }}"
                            value="{{ old('meta.clearing') }}" {{ $action }}>
                    </div>
                </div>

            </div>

        </div>
    </form>

    @endif
    @endif


    @if (@$persons)
    <!-- Table Sections (.js-table-sections class is initialized in Helpers.tableToolsSections()) -->
    <div class="block block-rounded block-themed block-fx-pop">

        <div class="block-header block-header-default bg-primary-darker">
            <h3 class="block-title">{{ __('common.Persons') }}</h3>
            <div class="block-options">
                <div class="btn-group">

                    @can('read persons')
                    <a class="btn btn-light btn-sm" href="javascript:void(0)" onclick="getPersons();">
                        <i class="si si-share-alt mr-1"></i> {{ __('common.Persons') }} XHR</span>
                    </a>
                    <a class="btn btn-light btn-sm" href="{{action('ExportController@persons')}}">
                        <i class="si si-share-alt mr-1"></i> {{ __('common.Excel') }}</span>
                    </a>
                    @endcan
                    @can('create persons')
                    <a class="btn btn-primary btn-sm" href="{{action('PersonController@create')}}">
                        <i class="si si-user mr-1"></i> {{ __('common.Person') }} <span
                            class="text-lowercase">{{ __('common.Add') }}</span>
                    </a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="block-content">
            <form action="{{action('PersonController@index')}}" method="post">
                <div class="row mb-4">
                    <div class="col-xl-2">
                        <div class="form-group">
                            <select class="form-control" id="role" name="role" title="{{ __('common.Role') }}"
                                onchange="this.form.submit()">
                                <option value="">{{ __('common.Role') }}</option>
                                <option value="client" {{ (@$selected_role == 'client' ? 'selected':'') }}>
                                    {{ __('common.Client') }}</option>
                                <option value="manager" {{ (@$selected_role == 'manager' ? 'selected':'') }}>
                                    {{ __('common.Manager') }}</option>
                                <option value="teacher" {{ (@$selected_role == 'teacher' ? 'selected':'') }}>
                                    {{ __('common.Teacher') }}</option>
                                <option value="student" {{ (@$selected_role == 'student' ? 'selected':'') }}>
                                    {{ __('common.Student') }}</option>
                                <option value="viewer" {{ (@$selected_role == 'viewer' ? 'selected':'') }}>
                                    {{ __('common.Viewer') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <select class="form-control" id="import_id" name="import_id"
                                title="{{ __('common.Import') }}" onchange="this.form.submit()" @if(@!$imports ||
                                @$imports->count() == 0) disabled @endif>
                                <option value="">{{ __('common.Import') }}</option>
                                @foreach($imports as $import)
                                <option value="{{ $import->id }}" {{ (@$import_id == $import->id ? 'selected':'') }}>
                                    {{ $import->name }} {{ Carbon::parse($import->updated_at)->format('d.m.Y') }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-5"></div>
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
                        <th style="width: 30px;"></th>
                        <th>
                            @sortablelink('last_name', __('common.Name'))
                        </th>
                        <th style="width: 15%;" class="d-none d-lg-table-cell">
                            @sortablelink('email', __('common.Email'))
                        </th>
                        <th class="d-none d-xl-table-cell">
                            @sortablelink('Phone', __('common.Phone'))
                        </th>
                        <th class="d-none d-xl-table-cell">
                            @sortablelink('mobile', __('common.Mobile'))
                        </th>
                        <th class="d-none d-sm-table-cell">
                            {{ __('common.Data') }} ({{ __('common.Status') }})
                        </th>
                        <th class="d-none d-xl-table-cell">
                            @sortablelink('updated_at', __('common.DateUpdated'))
                        </th>

                        <th class="text-right d-none d-sm-table-cell">

                        </th>
                    </tr>
                </thead>
                @csrf
                @foreach($persons as $person)
                <tbody class="js-table-sections-header">
                    <tr>
                        <td class="text-center">
                            <div class="img-avatar img-avatar32"
                                style="background-image: @if($person->picture) url({{ $person->picture }}) @else url(/media/avatars/avatar1.jpg) @endif; background-size:cover;">
                                &nbsp;</div>
                        </td>
                        <td>
                            <div class="py-1">
                                <a href="{{action('PersonController@show', $person->id)}}">{{ $person->first_name }}
                                    {{ $person->last_name }}</a>
                            </div>
                        </td>
                        <td class="d-none d-lg-table-cell">
                            <div class="py-1">
                                {{ $person->email }}
                            </div>
                        </td>
                        <td class="d-none d-xl-table-cell">
                            <div class="py-1">
                                {{ $person->phone }}
                            </div>
                        </td>
                        <td class="d-none d-xl-table-cell">
                            <div class="py-1">
                                {{ $person->mobile }}
                            </div>
                        </td>
                        <td class="d-none d-sm-table-cell">
                            @if($person->locations->count() > 0 && $person->getAllMeta()->count() >= 13)
                            <a href="{{action('PersonController@edit', $person->id)}}" class="btn btn-sm btn-success"
                                title="{{__('common.DataStatus')}}">
                                <i class="nav-main-link-icon si si-emotsmile mr-1"></i>
                                {{__('common.Good')}}
                            </a>

                            @elseif($person->getAllMeta()->count() > 4 && $person->getAllMeta()->count() < 13) <a
                                href="{{action('PersonController@edit', $person->id)}}" class="btn btn-sm btn-info"
                                title="{{__('common.DataStatus')}}">
                                <i class="nav-main-link-icon si si-ghost mr-1"></i>
                                {{__('common.Incomplete')}}
                                </a>

                                @else
                                <a href="{{action('PersonController@edit', $person->id)}}"
                                    class="btn btn-sm btn-warning" title="{{__('common.DataStatus')}}">
                                    <i class="nav-main-link-icon si si-energy mr-1"></i>
                                    {{__('common.Critical')}}
                                </a>
                                @endif

                                @if($person->changed)
                                <a href="{{action('PersonController@edit', $person->id)}}"
                                    class="btn btn-sm btn-warning" title="{{__('common.DataStatus')}}">
                                    <i class="nav-main-link-icon si si-tag mr-1"></i>
                                    {{__('common.Changed')}}
                                </a>
                                @endif

                        </td>

                        <td class="d-none d-xl-table-cell">
                            <div class="py-1">
                                {{ Carbon::parse($person->updated_at)->format('d.m.Y H:i')}}
                            </div>
                        </td>


                        <td class="d-none d-sm-table-cell text-right">
                            @can('update persons')
                            @if(!App\User::where('person_id', $person->id)->pluck('id')->first())
                            <a href="{{action('PersonController@user', $person->id)}}" class="btn btn-info btn-sm">
                                <i class="nav-main-link-icon si si-user mr-1"></i> {{ __('common.User') }} <span
                                    class="text-lowercase">{{ __('common.Create') }}</span>
                            </a>
                            @else

                            @if(!$person->approved)
                            <a href="{{action('PersonController@approve', $person->id)}}" class="btn btn-success btn-sm"
                                title="{{ __('common.DataStatus') }} {{ __('common.Complete') }} / {{ __('common.Good') }}?">
                                <i class="nav-main-link-icon si si-check mr-1"></i> {{ __('common.DataCheckDone') }}
                            </a>
                            @else
                            <a href="{{action('PersonController@disapprove', $person->id)}}"
                                class="btn btn-light btn-sm"
                                title="{{ __('common.DataStatus') }} {{ __('common.Critical') }} / {{ __('common.Incomplete') }}?">
                                <i class="nav-main-link-icon si si-close mr-1"></i>
                                {{ __('common.RequestDataUpdate') }}?
                            </a>
                            @endif
                            @endif

                            <a href="{{action('ExclusionController@person', $person->id)}}"
                                class="btn btn-light btn-sm">
                                <i class="nav-main-link-icon si si-calculator"></i>
                            </a>
                            <a href="{{action('PersonController@edit', $person->id)}}" class="btn btn-primary btn-sm">
                                <i class="nav-main-link-icon si si-pencil"></i>
                            </a>
                            @endcan

                            @can('delete persons')
                            <form action="{{action('PersonController@destroy', $person->id)}}" method="post"
                                class="d-inline">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <!-- <button type="submit" class="btn btn-danger delete" data-entity="person" data-id="{{ $person->id }}" data-name="{{ $person->first_name }} {{ $person->last_name }}">-->
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
                        <td colspan="10">
                            @foreach ($person->locations as $location)
                            <h5 class="text-capitalize">{{ $location->type }}
                                {{ ($location->default === 1) ? (__('common.Default')) : '' }}</h5>
                            <p>
                                {{ $location->street }} {{ $location->street_number }}<br>
                                {{ $location->zip }} {{ $location->city }}<br>
                                {{ $location->country }}
                            </p>
                            @endforeach
                            <ul>
                                @foreach ($person->getAllMeta() as $key => $field)
                                <li>{{$field}}</li>
                                @endforeach
                            </ul>

                            <p>
                                <a href="{{ $person->website }}" target="_blank">{{ $person->website }}</a>
                            </p>
                            <p>
                                <em class="text-muted">{{ Carbon::parse($person->updated_at)->format('d.m.Y H:i')}}</em>
                            </p>
                        </td>

                    </tr>

                </tbody>
                @endforeach
            </table>

        </div>

        @if ($persons->total() > $persons->perPage())
        <div
            class="block-content block-content-full block-content-sm bg-body-light d-flex justify-content-center align-content-center">
            {!! $persons->appends(\Request::except('page'))->render() !!}
        </div>
        @endif
    </div>
    @endif

    <!-- END Table Sections -->
</div>
<!-- END Page Content -->


@endsection