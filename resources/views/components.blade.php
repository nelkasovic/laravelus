@extends('layouts.app')

@section('content')

<!-- Page Content -->
<div class="content">

    <!-- If edit or create or password -->
    @if (@$component)

    {{-- We are here only if variable is available --}}

    @if (@$action === 'edit' || @$action === 'readonly')

    <form action="{{action('ComponentController@update', $id)}}" enctype="multipart/form-data" method="post">
        @csrf

        <input name="_method" type="hidden" value="PATCH">

        <!-- Block Tabs With Options Default Style -->
        <div class="block block-rounded block-themed">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ $component->name }}</h3>
            </div>
            <div class="block-content pb-4">
                <h2 class="content-heading">{{ __('common.Edit') }}</h2>
                <div class="row">


                    <div class="form-group col-md-4">
                        <label class="text-muted mb-0 font-size-sm"
                            for="name"><small>{{ __('common.Name') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('name') ? "is-invalid" : "" }}" id="name" name="name"
                            placeholder="{{ __('common.Name') }}" value="{{ $component->name }}">
                    </div>

                    <div class="form-group col-md-4">
                        <label class="text-muted mb-0 font-size-sm"
                            for="model"><small>{{ __('common.Model') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('model') ? "is-invalid" : "" }}" id="model"
                            name="model" placeholder="{{ __('common.Model') }}" value="{{ $component->model  }}">
                    </div>

                    <div class="form-group col-md-4">
                        <label class="text-muted mb-0 font-size-sm"
                            for="published"><small>{{ __('common.Published') }}</small></label>
                        <select {{ $action }} class="form-control" id="published" name="published">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="0" {{ ($component->published == '' ? 'selected':'') }}>
                                {{ __('common.Unpublished') }}</option>
                            <option value="1" {{ ($component->published == 1 ? 'selected':'') }}>
                                {{ __('common.Published') }}</option>
                        </select>
                    </div>

                </div>


            </div>
            <div class="block-content block-content-full text-right bg-light">
                <div class="d-none">
                    <img class="img-avatar" src="{{ url('/images/'.$component->image_url) }}">
                </div>

                <a class="btn btn-warning" href="{{action('ComponentController@index')}}">
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

    <form action="{{action('ComponentController@store')}}" enctype="multipart/form-data" method="post">
        @csrf
        <input name="_method" type="hidden" value="POST">

        <!-- Block Tabs With Options Default Style -->
        <div class="block block-rounded block-themed">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ __('common.Components') }}</h3>
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
                            for="model"><small>{{ __('common.Model') }}</small></label>
                        <input type="text" class="form-control {{ @$errors->has('model') ? "is-invalid" : "" }}"
                            id="model" name="model" placeholder="{{ __('common.Model') }}" value="{{ old('model') }}">
                    </div>

                    <div class="form-group col-md-4">
                        <label class="text-muted mb-0 font-size-sm"
                            for="published"><small>{{ __('common.Published') }}</small></label>
                        <select {{ $action }} class="form-control" id="published" name="published">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="0" {{ (old('published') == '' ? 'selected':'') }}>
                                {{ __('common.Unpublished') }}</option>
                            <option value="1" {{ (old('published') == 1 ? 'selected':'') }}>{{ __('common.Published') }}
                            </option>
                        </select>
                    </div>

                </div>



            </div>
            <div class="block-content block-content-full text-right bg-light">


                <a class="btn btn-warning" href="{{action('ComponentController@index')}}">
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

    @if (@$components)
    <!-- Table Sections (.js-table-sections class is initialized in Helpers.tableToolsSections()) -->
    <div class="block block-rounded block-themed">

        <div class="block-header block-header-default bg-primary-darker">
            <h3 class="block-title">{{ __('common.Components') }}</h3>
            <div class="block-options">
                @can('create components')
                <a class="btn btn-primary btn-sm" href="{{action('ComponentController@create')}}">
                    <i class="si si-plus mr-1"></i> {{ __('common.Component') }} <span
                        class="text-lowercase">{{ __('common.Add') }}</span>
                </a>
                @endcan
            </div>
        </div>

        <div class="block-content">
            <div class="row mb-4">
                <div class="col-xl-10"></div>
                <div class="col-xl-2">
                    <form action="{{action('ComponentController@index')}}" method="post">
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

                        <th>
                            @sortablelink('model', __('common.Model'))
                        </th>
                        <th class="text-center">
                            @sortablelink('published', __('common.Published'))
                        </th>

                        <th>
                            @sortablelink('updated_at', __('common.DateUpdated'))
                        </th>

                        <th class="text-right">

                        </th>
                    </tr>
                </thead>
                @csrf

                @foreach($components as $component)
                <tbody class="js-table-sections-header">
                    <tr>
                        <td class="text-center">
                            <i class="fa fa-angle-right text-muted"></i>
                        </td>
                        <td>
                            <div class="py-1">
                                <a href="{{action('ComponentController@show', $component->id)}}">{{ $component->name }}
                                </a>
                            </div>
                        </td>

                        <td>
                            <div class="py-1">
                                {{ $component->model }}
                            </div>
                        </td>
                        <td>
                            <div class="py-1 text-center">
                                {{ $component->published }}
                            </div>
                        </td>
                        <td>
                            <div class="py-1">
                                {{ Carbon::parse($component->updated_at)->format('d.m.Y H:i')}}
                            </div>
                        </td>


                        <td class="d-none d-sm-table-cell text-right">
                            @can('update components')
                            <a href="{{action('ComponentController@edit', $component->id)}}"
                                class="btn btn-sm btn-primary">
                                <i class="nav-main-link-icon si si-pencil"></i>
                            </a>
                            @endcan

                            @can('delete components')
                            <form action="{{action('ComponentController@destroy', $component->id)}}" method="post"
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
                        <td>
                            <p>{{ $component->description }}</p>
                        </td>
                        <td></td>
                        <td>
                        </td>
                        <td class="d-none d-sm-table-cell text-right" colspan="10">
                            <em class="text-muted">{{ Carbon::parse($component->created_at)->format('d.m.Y H:i')}}</em>
                        </td>
                    </tr>

                </tbody>
                @endforeach
            </table>

        </div>

        @if ($components->total() > $components->perPage())
        <div
            class="block-content block-content-full block-content-sm bg-body-light d-flex justify-content-center align-content-center">
            {!! $components->appends(\Request::except('page'))->render() !!}
        </div>
        @endif
    </div>
    @endif

    <!-- END Table Sections -->
</div>
<!-- END Page Content -->


@endsection