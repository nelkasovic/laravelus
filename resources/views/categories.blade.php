@extends('layouts.app')

@section('content')

<!-- Page Content -->
<div class="content">

    <!-- If edit or create or password -->
    @if (@$category)

    {{-- We are here only if variable is available --}}

    @if (@$action === 'edit' || @$action === 'readonly')

    <form action="{{action('CategoryController@update', $id)}}" enctype="multipart/form-data" method="post">
        @csrf

        <input name="_method" type="hidden" value="PATCH">

        <!-- Block Tabs With Options Default Style -->
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ $category->name }}</h3>
            </div>
            <div class="block-content pb-4">
                <h2 class="content-heading">{{ __('common.Edit') }}</h2>
                <div class="row">

                    <div class="form-group col-md-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="type_id"><small>{{ __('common.Type') }}</small></label>
                        <select {{ $action }} class="form-control" id="type_id" name="type_id"
                            title="{{ __('common.Type') }}">
                            <option value="">{{ __('common.Select') }}</option>
                            @foreach ($types as $type)
                            <option value="{{ $type->id }}" @if($type->id == old('type_id') || $type->id == $type_id)
                                selected @endif>{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="name"><small>{{ __('common.Name') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('name') ? "is-invalid" : "" }}" id="name" name="name"
                            placeholder="{{ __('common.Name') }}" value="{{ $category->name }}">
                    </div>

                    <div class="form-group col-md-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="active"><small>{{ __('common.Active') }}</small></label>
                        <select {{ $action }} class="form-control" id="active" name="active">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="0" {{ ($category->active == 0 ? 'selected':'') }}>{{ __('common.Inactive') }}
                            </option>
                            <option value="1" {{ ($category->active == 1 ? 'selected':'') }}>{{ __('common.Active') }}
                            </option>
                        </select>
                    </div>


                    <div class="form-group col-md-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="url"><small>{{ __('common.URL') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('url') ? "is-invalid" : "" }}" id="url" name="url"
                            placeholder="{{ __('common.URL') }}" value="{{ $category->url }}">
                    </div>

                    <div class="form-group col-md-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="color"><small>{{ __('common.Color') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('color') ? "is-invalid" : "" }}" id="color"
                            name="color" placeholder="{{ __('common.Color') }}" value="{{ $category->color }}">
                    </div>

                    <div class="form-group col-md-12">
                        <label class="text-muted mb-0 font-size-sm"
                            for="description"><small>{{ __('common.Description') }}</small></label>
                        <textarea {{ $action }} rows="4"
                            class="form-control {{ @$errors->has('description') ? "is-invalid" : "" }}" id="description"
                            name="description"
                            placeholder="{{ __('common.Description') }}">{{ $category->description }}</textarea>
                    </div>

                </div>

            </div>
            <div class="block-content block-content-full text-right bg-light">


                <a class="btn btn-warning" href="{{action('TypeController@show', $type_id)}}">
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

    <form action="{{action('CategoryController@store')}}" enctype="multipart/form-data" method="post">
        @csrf
        <input name="_method" type="hidden" value="POST">

        <!-- Block Tabs With Options Default Style -->
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ __('common.Type') }}</h3>
            </div>
            <div class="block-content pb-4">
                <h2 class="content-heading">{{ __('common.New') }}</h2>
                <div class="row">

                    <div class="form-group col-md-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="type_id"><small>{{ __('common.Type') }}</small></label>
                        <select {{ $action }} class="form-control" id="type_id" name="type_id"
                            title="{{ __('common.Type') }}">
                            <option value="">{{ __('common.Select') }}</option>
                            @foreach ($types as $type)
                            <option value="{{ $type->id }}" @if($type->id == old('type_id') || $type->id == $type_id)
                                selected @endif>{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="name"><small>{{ __('common.Name') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('name') ? "is-invalid" : "" }}" id="name" name="name"
                            placeholder="{{ __('common.Name') }}" value="{{ old('name') }}">
                    </div>

                    <div class="form-group col-md-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="active"><small>{{ __('common.Active') }}</small></label>
                        <select {{ $action }} class="form-control" id="active" name="active">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="0" {{ (old('active') == 0 ? 'selected':'') }}>{{ __('common.Inactive') }}
                            </option>
                            <option value="1" {{ (old('active') == 1 ? 'selected':'') }}>{{ __('common.Active') }}
                            </option>
                        </select>
                    </div>


                    <div class="form-group col-md-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="url"><small>{{ __('common.URL') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('url') ? "is-invalid" : "" }}" id="url" name="url"
                            placeholder="{{ __('common.URL') }}" value="{{ old('url') }}">
                    </div>

                    <div class="form-group col-md-2">
                        <label class="text-muted mb-0 font-size-sm"
                            for="color"><small>{{ __('common.Color') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('color') ? "is-invalid" : "" }}" id="color"
                            name="color" placeholder="{{ __('common.Color') }}" value="{{ old('color') }}">
                    </div>

                    <div class="form-group col-md-12">
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


                <a class="btn btn-warning" href="{{action('TypeController@show', $type_id)}}">
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

    @if (@$categories)
    <!-- Table Sections (.js-table-sections class is initialized in Helpers.tableToolsSections()) -->
    <div class="block block-rounded block-bordered">

        <div class="block-header block-header-default">
            <h3 class="block-title">{{ __('common.Users') }}</h3>
            <div class="block-options pr-2">
                <form action="{{action('CategoryController@index')}}" method="post">

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

                        <th style="border-top: none;">
                            @sortablelink('model', __('common.Model'))
                        </th>
                        <th style="border-top: none;">
                            @sortablelink('updated_at', __('common.DateUpdated'))
                        </th>

                        <th style="border-top: none;" class="text-right">
                            <a class="btn btn-dark" href="{{action('CategoryController@create')}}">
                                <i class="si si-plus"></i>
                            </a>
                        </th>
                    </tr>
                </thead>
                @csrf

                @foreach($categories as $category)
                <tbody class="js-table-sections-header">
                    <tr>
                        <td class="text-center">
                            <i class="fa fa-angle-right text-muted"></i>
                        </td>
                        <td class="font-w600">
                            <div class="py-1">
                                <a href="{{action('CategoryController@show', $category->id)}}">{{ $category->name }}
                                </a>
                            </div>
                        </td>

                        <td>

                            <div class="py-1">
                                {{ $category->email }}
                            </div>
                        </td>
                        <td>
                            <div class="py-1">
                                {{ Carbon::parse($category->updated_at)->format('d.m.Y H:i')}}
                            </div>
                        </td>


                        <td class="d-none d-sm-table-cell text-right">
                            @can('update categories')
                            <a href="{{action('CategoryController@edit', $category->id)}}" class="btn btn-primary">
                                <i class="nav-main-link-icon si si-pencil"></i>
                            </a>
                            @endcan

                            @can('delete categories')
                            <form action="{{action('CategoryController@destroy', $category->id)}}" method="post"
                                class="d-inline">
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
                        <td class="font-w600">
                            <p>{{ $category->description }}</p>
                            <p>{{ __('common.Phone') }}: {{ $category->phone }}, {{ __('common.Mobile') }}:
                                {{ $category->mobile }}, {{ __('common.Fax') }}: {{ $category->fax }}</p>
                        </td>
                        <td>
                            <a href="{{ $category->website }}" target="_blank">{{ $category->website }}</a>
                        </td>
                        <td>
                        </td>
                        <td class="d-none d-sm-table-cell text-right" colspan="10">
                            <em class="text-muted">{{ Carbon::parse($category->updated_at)->format('d.m.Y H:i')}}</em>
                        </td>
                    </tr>

                </tbody>
                @endforeach
            </table>

        </div>

        @if ($categories->total() > $categories->perPage())
        <div
            class="block-content block-content-full block-content-sm bg-body-light d-flex justify-content-center align-content-center">
            {!! $categories->appends(\Request::except('page'))->render() !!}
        </div>
        @endif
    </div>
    @endif

    <!-- END Table Sections -->
</div>
<!-- END Page Content -->


@endsection