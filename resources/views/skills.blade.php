@extends('layouts.app')

@section('content')

<!-- Page Content -->
<div class="content">

    @if (@$skill)

    {{-- We are here only if variable is available --}}

    @if (@$action === 'edit' || @$action === 'readonly')

    <form action="{{action('SkillController@update', $id)}}" enctype="multipart/form-data" method="post">
        @csrf

        <input name="_method" type="hidden" value="PATCH">

        <!-- Block Tabs With Options Default Style -->
        <div class="block block-rounded block-themed block-fx-pop">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ $skill->name }}</h3>
            </div>
            <div class="block-content pb-4">
                <h2 class="content-heading">{{ __('common.Edit') }}</h2>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label class="text-muted mb-0 font-size-sm"
                            for="name"><small>{{ __('common.Name') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('name') ? "is-invalid" : "" }}" id="name" name="name"
                            placeholder="{{ __('common.Name') }}" value="{{ $skill->name }}">
                    </div>

                    <div class="form-group col-md-4">
                        <label class="text-muted mb-0 font-size-sm"
                            for="institution"><small>{{ __('common.Institution') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('institution') ? "is-invalid" : "" }}" id="institution"
                            name="institution" placeholder="{{ __('common.Institution') }}"
                            value="{{ $skill->institution }}">
                    </div>

                    <div class="form-group col-md-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="surcharge"><small>{{ __('common.Surcharge') }}</small></label>
                        <input type="number" class="form-control" id="surcharge" name="surcharge"
                            placeholder="{{ __('common.Surcharge') }}" value="{{ $skill->surcharge }}" {{ $action }}>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="active"><small>{{ __('common.Active') }}</small></label>
                        <select {{ $action }} class="form-control" id="active" name="active">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="1" {{ $skill->active == '1' ? 'selected':'' }}>{{ __('common.Active') }}
                            </option>
                            <option value="0" {{ $skill->active != '1' ? 'selected':'' }}>{{ __('common.Inactive') }}
                            </option>
                        </select>
                    </div>

                    <div class="form-group col-md-12">
                        <label class="text-muted mb-0 font-size-sm"
                            for="description"><small>{{ __('common.Description') }}</small></label>
                        <textarea {{ $action }} rows="5"
                            class="form-control {{ @$errors->has('description') ? "is-invalid" : "" }}" id="description"
                            name="description"
                            placeholder="{{ __('common.Description') }}">{{ $skill->description }}</textarea>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="text-muted mb-0 font-size-sm"
                            for="url"><small>{{ __('common.Url') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('url') ? "is-invalid" : "" }}" id="url" name="url"
                            placeholder="{{ __('common.Url') }}" value="{{ $skill->url }}">
                    </div>


                    @if($action === "edit")
                    <div class="form-group col-md-6 custom-file">
                        <label class="text-muted mb-0 font-size-sm" for="image_url"><small>{{ __('common.Image') }}
                            </small></label>
                        <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                        <input type="file" class="custom-file-input js-custom-file-input-enabled"
                            data-toggle="custom-file-input" id="image_url" name="image_url"
                            placeholder="{{ __('common.Image') }}" {{ $action }}>
                        <label class="custom-file-label" for="image_url"
                            style="margin-left: 14px; margin-right: 14px; top: 24px; ">{{ __('common.Choose') }}</label>
                    </div>
                    @endif
                </div>
            </div>

            <div class="block-content block-content-full text-right bg-light">

                <a class="btn btn-warning" href="{{action('SkillController@index')}}">
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

    <form action="{{action('SkillController@store')}}" enctype="multipart/form-data" method="post">
        @csrf
        <input name="_method" type="hidden" value="POST">

        <!-- Block Tabs With Options Default Style -->
        <div class="block block-rounded block-themed block-fx-pop">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ __('common.Skills') }}</h3>
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

                    <div class="form-group col-md-4">
                        <label class="text-muted mb-0 font-size-sm"
                            for="name"><small>{{ __('common.Name') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('name') ? "is-invalid" : "" }}" id="name" name="name"
                            placeholder="{{ __('common.Name') }}" value="{{ old('name') }}">
                    </div>


                    <div class="form-group col-md-4">
                        <label class="text-muted mb-0 font-size-sm"
                            for="institution"><small>{{ __('common.Institution') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('institution') ? "is-invalid" : "" }}" id="institution"
                            name="institution" placeholder="{{ __('common.Institution') }}"
                            value="{{ old('institution') }}">
                    </div>

                    <div class="form-group col-md-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="surcharge"><small>{{ __('common.Surcharge') }}</small></label>
                        <input {{ $action }} type="number"
                            class="form-control {{ @$errors->has('surcharge') ? "is-invalid" : "" }}" id="surcharge"
                            name="surcharge" placeholder="{{ __('common.Surcharge') }}" value="{{ old('surcharge') }}">
                    </div>

                    <div class="form-group col-md-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="active"><small>{{ __('common.Active') }}</small></label>
                        <select {{ $action }} class="form-control" id="active" name="active">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="0" {{ (old('active') == 0 ? 'selected':'') }}>{{ __('common.Inactive') }}
                            </option>
                            <option value="1" {{ (old('active') == 1 || old('active') == '' ? 'selected':'') }}>
                                {{ __('common.Active') }}</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="text-muted mb-0 font-size-sm"
                            for="url"><small>{{ __('common.URL') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('url') ? "is-invalid" : "" }}" id="url" name="url"
                            placeholder="{{ __('common.URL') }}" value="{{ old('url') }}">
                    </div>


                    <div class="col-md-6 custom-file">
                        <label class="text-muted mb-0 font-size-sm" for="image_url"><small>{{ __('common.Image') }}
                            </small></label>
                        <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                        <input {{ $action }} type="file"
                            class="custom-file-input js-custom-file-input-enabled {{ @$errors->has('image_url') ? "is-invalid" : "" }}"
                            data-toggle="custom-file-input" id="image_url" name="image_url"
                            placeholder="{{ __('common.Image') }}">
                        <label class="custom-file-label" for="image_url"
                            style="margin-left: 14px; margin-right: 14px; top: 24px; ">{{ __('common.Choose') }}</label>
                    </div>

                    <div class="form-group col-md-12">
                        <label class="text-muted mb-0 font-size-sm"
                            for="description"><small>{{ __('common.Description') }}</small></label>
                        <textarea rows="3" {{ $action }}
                            class="form-control {{ @$errors->has('description') ? "is-invalid" : "" }}" id="description"
                            name="description"
                            placeholder="{{ __('common.Description') }}">{{ old('description') }}</textarea>
                    </div>

                </div>

            </div>
            <div class="block-content block-content-full text-right bg-light">


                <a class="btn btn-warning" href="{{action('SkillController@index')}}">
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

    @if (@$skills)
    <!-- Table Sections (.js-table-sections class is initialized in Helpers.tableToolsSections()) -->
    <div class="block block-rounded block-themed block-fx-pop">

        <div class="block-header block-header-default bg-primary-darker">
            <h3 class="block-title">{{ __('common.Skills') }}</h3>
            <div class="block-options">
                <div class="btn-group">
                    @can('read skills')
                    <a class="btn btn-light btn-sm" href="javascript:void(0)" onclick="getSkills();">
                        <i class="si si-share-alt mr-1"></i> {{ __('common.Skills') }} XHR</span>
                    </a>
                    <a class="btn btn-light btn-sm" href="{{action('ExportController@skills')}}">
                        <i class="si si-share-alt mr-1"></i> {{ __('common.Excel') }}</span>
                    </a>
                    @endcan

                    @can('create skills')
                    <a class="btn btn-primary btn-sm" href="{{action('SkillController@create')}}">
                        <i class="si si-magic-wand mr-1"></i> {{ __('common.Skill') }} <span
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
                    <form action="{{action('SkillController@index')}}" method="post">
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

                        <th class="text-right d-none d-lg-table-cell">
                            @sortablelink('institution', __('common.Surcharge'))
                        </th>
                        <th class="d-none d-xl-table-cell">
                            @sortablelink('updated_at', __('common.DateUpdated'))
                        </th>

                        <th class="text-right d-none d-sm-table-cell">

                        </th>
                    </tr>
                </thead>
                @csrf

                @foreach($skills as $skill)
                <tbody class="js-table-sections-header">
                    <tr>
                        <td class="text-center">
                            <i class="fa fa-angle-right text-muted"></i>
                        </td>
                        <td>
                            <div class="py-1">
                                <a href="{{action('SkillController@show', $skill->id)}}">{{ $skill->name }} </a>
                            </div>
                        </td>

                        <td class="d-none d-lg-table-cell">

                            <div class="py-1 text-right">
                                {{ $skill->surcharge }}
                            </div>
                        </td>
                        <td class="d-none d-xl-table-cell">
                            <div class="py-1">
                                {{ Carbon::parse($skill->updated_at)->format('d.m.Y H:i')}}
                            </div>
                        </td>


                        <td class="d-none d-sm-table-cell text-right">
                            @can('update skills')
                            <a href="{{action('SkillController@edit', $skill->id)}}" class="btn btn-primary btn-sm">
                                <i class="nav-main-link-icon si si-pencil"></i>
                            </a>
                            @endcan

                            @can('delete skills')
                            <form action="{{action('SkillController@destroy', $skill->id)}}" method="post"
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
                        <td colspan="4">
                            <p>{{ $skill->description }}</p>
                            <p><a href="{{ $skill->url }}" target="_blank">{{ $skill->url }}</a></p>
                            <em class="text-muted">{{ Carbon::parse($skill->updated_at)->format('d.m.Y H:i')}}</em>
                        </td>
                    </tr>
                </tbody>
                @endforeach
            </table>

        </div>

        @if ($skills->total() > $skills->perPage())
        <div
            class="block-content block-content-full block-content-sm bg-body-light d-flex justify-content-center align-content-center">
            {!! $skills->appends(\Request::except('page'))->render() !!}
        </div>
        @endif
    </div>
    @endif

    <!-- END Table Sections -->
</div>
<!-- END Page Content -->


@endsection