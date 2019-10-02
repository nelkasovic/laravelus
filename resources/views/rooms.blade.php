@extends('layouts.app')

@section('content')

<!-- Page Content -->
<div class="content">

    <!-- If edit or create -->
    @if (@$room)

    {{-- We are here only if variable is available --}}

    @if (@$action === 'edit' || @$action === 'readonly')

    <form action="{{action('RoomController@update', $id)}}" enctype="multipart/form-data" method="post">
        @csrf

        <input name="_method" type="hidden" value="PATCH">

        <!-- Block Tabs With Options Default Style -->
        <div class="block block-rounded block-themed block-fx-pop">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ $room->name }}</h3>
            </div>
            <div class="block-content pb-4">
                <h2 class="content-heading">{{ __('common.Edit') }}</h2>

                <div class="row">

                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="name"><small>{{ __('common.Name') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('name') ? "is-invalid" : "" }}" id="name" name="name"
                            placeholder="{{ __('common.Name') }}" value="{{ $room->name }}">
                    </div>

                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="building"><small>{{ __('common.Building') }}</small></label>
                        <input {{ $action }} type="text"
                            class="form-control {{ @$errors->has('building') ? "is-invalid" : "" }}" id="building"
                            name="building" placeholder="{{ __('common.Building') }}" value="{{ $room->building }}">
                    </div>

                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="active"><small>{{ __('common.Active') }}</small></label>
                        <select {{ $action }} class="form-control" id="active" name="active">
                            <option value="">{{ __('common.Select') }}</option>
                            <option value="0" {{ $room->active == '1' ? 'selected':'' }}>{{ __('common.Active') }}
                            </option>
                            <option value="1" {{ $room->active != '1' ? 'selected':'' }}>{{ __('common.Inactive') }}
                            </option>
                        </select>
                    </div>

                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="email"><small>{{ __('common.Email') }}</small></label>
                        <input type="text" class="form-control" id="email" name="email"
                            placeholder="{{ __('common.Email') }}" value="{{ $room->email }}" {{ $action }}>
                    </div>

                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="phone"><small>{{ __('common.Phone') }}</small></label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            placeholder="{{ __('common.Phone') }}" value="{{ $room->phone }}" {{ $action }}>
                    </div>


                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="url"><small>{{ __('common.Website') }}</small></label>
                        <input type="text" class="form-control" id="url" name="url"
                            placeholder="{{ __('common.Website') }}" value="{{ $room->url }}" {{ $action }}>
                    </div>

                    @if($action === "edit")
                    <div class="form-group col-xl-3">
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

                    <div class="form-group col-xl-12">
                        <label class="text-muted mb-0 font-size-sm"
                            for="description"><small>{{ __('common.Description') }}</small></label>
                        <textarea {{ $action }} rows="5"
                            class="form-control {{ @$errors->has('description') ? "is-invalid" : "" }}" id="description"
                            name="description"
                            placeholder="{{ __('common.Description') }}">{{ $room->description }}</textarea>
                    </div>
                </div>

            </div>
            <div class="block-content block-content-full text-right bg-light">
                <div class="d-none">
                    <img class="img-avatar" src="{{ url('/images/'.$room->image_url) }}">
                </div>

                <a class="btn btn-warning" href="{{action('RoomController@index')}}">
                    <i class="si si-action-undo mr-1"></i>
                    {{ __('common.Close') }}
                </a>


                <a class="btn btn-info" href="{{action('ExclusionController@room', $room->id)}}">
                    <i class="si si-calculator mr-1"></i>
                    {{ __('common.Exclusions') }} {{ __('common.add') }}
                </a>

                @if (@$action === 'edit' || $action == 'readonly')
                <a class="btn btn-info" href="{{action('LocationController@room', $room->id)}}">
                    <i class="si si-location-pin mr-1"></i>
                    {{ __('common.Location') }} <span class="text-lowercase">{{ __('common.Add') }}</span>
                </a>

                <button type="submit" class="btn btn-primary">
                    <i class="si si-fire mr-1"></i>
                    {{ __('common.Save') }}
                </button>
                @endif
            </div>
        </div>
    </form>


    @if (@$exclusions && $exclusions->count())

    <!-- Exclusions -->
    @include('include.exclusions')
    <!-- Exclusions END -->

    @endif


    @if (@$room->locations->count() > 0)
    <!-- Table Sections (.js-table-sections class is initialized in Helpers.tableToolsSections()) -->

    <div class="block block-rounded block-themed block-fx-pop animated fadeIn">

        <div class="block-header block-header-default">
            <h3 class="block-title">{{ __('common.Locations') }}
                @if ($room)
                {{__('common.From')}} {{ @$room->name }}
                @endif
            </h3>
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
                            <a class="btn btn-dark btn-sm" href="{{ action('LocationController@room', $room->id) }}">
                                <i class="si si-plus"></i>
                            </a>
                        </th>
                    </tr>
                </thead>
                @csrf
                @foreach($room->locations as $location)
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
                                @if($location->type === 'private')
                                <button class="btn btn-sm btn-light"><i
                                        class="icon si si-cursor mr-2"></i>{{ __('common.Private') }}</button>
                                @elseif($location->type === 'business')
                                <button class="btn btn-sm btn-light"><i
                                        class="icon si si-cursor mr-2"></i>{{ __('common.Business') }}</button>
                                @else
                                <button class="btn btn-sm btn-light"><i
                                        class="icon si si-cursor mr-2"></i>{{ __('common.Address') }}</button>
                                @endif

                            </div>
                        </td>
                        <td class="d-none d-sm-table-cell text-right">

                            <a href="{{ action('LocationController@default', $location->id) }}"
                                class="btn btn-sm btn-{{$location->default === 0 ? 'light' : 'success'}}"><i
                                    class="icon si si-heart mr-2"></i>{{ __('common.Default') }}</a>

                            @if ($location->id)
                            <form
                                action="{{ action('LocationController@room', [$location->id, $location->locationable_id]) }}"
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
    @endif

    <!-- END Block Tabs With Options Default Style -->
    @elseif (@$action === 'create')

    <form action="{{action('RoomController@store')}}" enctype="multipart/form-data" method="post">
        @csrf
        <input name="_method" type="hidden" value="POST">

        <!-- Block Tabs With Options Default Style -->
        <div class="block block-rounded block-themed">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ __('common.Room') }}</h3>
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
                            placeholder="{{ __('common.Email') }}" value="{{ $room->email }}" {{ $action }}>
                    </div>

                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="phone"><small>{{ __('common.Phone') }}</small></label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            placeholder="{{ __('common.Phone') }}" value="{{ $room->phone }}" {{ $action }}>
                    </div>


                    <div class="form-group col-xl-3">
                        <label class="text-muted mb-0 font-size-sm"
                            for="url"><small>{{ __('common.Website') }}</small></label>
                        <input type="text" class="form-control" id="url" name="url"
                            placeholder="{{ __('common.Website') }}" value="{{ $room->url }}" {{ $action }}>
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
                            placeholder="{{ __('common.Description') }}">{{ $room->description }}</textarea>
                    </div>
                </div>

            </div>
            <div class="block-content block-content-full text-right bg-light">
                <a class="btn btn-warning" href="{{action('RoomController@index')}}">
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

    @if (@$rooms)
    <!-- Table Sections (.js-table-sections class is initialized in Helpers.tableToolsSections()) -->
    <div class="block block-rounded block-fx-pop block-themed">

        <div class="block-header block-header-default bg-primary-darker">
            <h3 class="block-title">{{ __('common.Rooms') }}</h3>
            <div class="block-options">
                <div class="btn-group">
                    @can('read rooms')
                    <a class="btn btn-light btn-sm" href="javascript:void(0)" onclick="getRooms();">
                        <i class="si si-share-alt mr-1"></i> {{ __('common.Rooms') }} XHR</span>
                    </a>
                    <a class="btn btn-light btn-sm" href="{{action('ExportController@rooms')}}">
                        <i class="si si-share-alt mr-1"></i> {{ __('common.Excel') }}</span>
                    </a>
                    @endcan
                    @can('create rooms')
                    <a class="btn btn-primary btn-sm" href="{{action('RoomController@create')}}">
                        <i class="si si-plus mr-1"></i> {{ __('common.Room') }} <span
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
                    <form action="{{action('RoomController@index')}}" method="post">
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
                            @sortablelink('building', __('common.Building'))
                        </th>
                        <th class="d-none d-xl-table-cell">
                            @sortablelink('street', __('common.Street'))
                        </th>

                        <th class="d-none d-xl-table-cell">
                            @sortablelink('zip', __('common.Zip'))
                        </th>
                        <th class="d-none d-xl-table-cell">
                            @sortablelink('city', __('common.City'))
                        </th>
                        <th class="d-none d-md-table-cell">
                            @sortablelink('updated_at', __('common.Updated'))
                        </th>
                        <th class="text-right d-none d-sm-table-cell">

                        </th>
                    </tr>
                </thead>
                @csrf

                @foreach($rooms as $room)
                <tbody class="js-table-sections-header">
                    <tr>
                        <td class="text-center">
                            <i class="fa fa-angle-right text-muted"></i>
                        </td>
                        <td>
                            <div class="py-1">
                                <a href="{{action('RoomController@show', $room->id)}}">{{ $room->name }} </a>
                            </div>
                        </td>

                        <td class="d-none d-xl-table-cell">
                            <div class="py-1">
                                {{ $room->building }}
                            </div>
                        </td>
                        <td class="d-none d-xl-table-cell">
                            <div class="py-1">
                                {{ $room->street }} {{ $room->street_number }}
                            </div>
                        </td>
                        <td class="d-none d-xl-table-cell">
                            <div class="py-1">
                                {{ $room->zip }}
                            </div>
                        </td>
                        <td class="d-none d-xl-table-cell">
                            <div class="py-1">
                                {{ $room->city }}
                            </div>
                        </td>
                        <td class="d-none d-md-table-cell">
                            <div class="py-1">
                                {{ Carbon::parse($room->created_at)->format('d.m.Y H:i')}}
                            </div>
                        </td>
                        <td class="text-right d-none d-sm-table-cell">

                            @can('vote rooms')
                            <div class="btn-group">
                                <a href="{{action('RoomController@downvote', $room->id)}}" class="btn btn-sm btn-light">
                                    <i class="nav-main-link-icon si si-dislike mr-2"></i> {{ $room->downVotesCount() }}
                                </a>
                                <a href="{{action('RoomController@upvote', $room->id)}}" class="btn btn-sm btn-light">
                                    <i class="nav-main-link-icon si si-like mr-2"></i> {{ $room->upVotesCount() }}
                                </a>
                            </div>
                            @endcan

                            @can('create exclusions')
                            <a href="{{action('ExclusionController@room', $room->id)}}" class="btn btn-warning btn-sm"
                                title="{{ __('common.Exclusions') }} {{ __('common.add') }}">
                                <i class="nav-main-link-icon si si-calculator"></i>
                            </a>
                            @endcan

                            @can('update rooms')
                            <a href="{{action('RoomController@edit', $room->id)}}"
                                class="btn btn-sm btn-primary d-none d-md-inline-block">
                                <i class="nav-main-link-icon si si-pencil"></i>
                            </a>
                            @endcan

                            @can('delete rooms')
                            <form action="{{action('RoomController@destroy', $room->id)}}" method="post"
                                class="d-none d-md-inline-block">
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
                            <p>{{ $room->description }}</p>
                            <ul>
                                <li>{{ __('common.Phone') }}: {{ $room->phone }}</li>
                                <li>{{ __('common.Email') }}: {{ $room->email }}</li>
                                <li>{{ __('common.Website') }}: {{ $room->url }}</li>
                                <li>{{ __('common.Image') }}: {{ $room->picture }}</li>
                            </ul>
                            @if($room->assets()->count() > 0)
                            <h4>{{ __('common.Assets') }}</h4>
                            <ol>
                                @foreach($room->assets as $asset)
                                <li>{{ $asset->name }}</li>
                                @endforeach
                            </ol>
                            @endif
                            <em class="text-muted">{{ __('common.DateUpdated') }}:
                                {{ Carbon::parse($room->created_at)->format('d.m.Y H:i')}}</em>
                        </td>


                    </tr>

                </tbody>
                @endforeach
            </table>

        </div>

        @if ($rooms->total() > $rooms->perPage())
        <div
            class="block-content block-content-full block-content-sm bg-body-light d-flex justify-content-center align-content-center">
            {!! $rooms->appends(\Request::except('page'))->render() !!}
        </div>
        @endif
    </div>
    @endif

    <!-- END Table Sections -->
</div>
<!-- END Page Content -->


@endsection