@extends('layouts.app')

@section('content')

<!-- Page Content -->
<div class="content">
    <div class="row">
        <div class="col-md-6">
            <!-- Block Tabs With Options Default Style -->
            <div class="block block-rounded block-themed block-fx-pop">
                <div class="block-header block-header-default bg-gd-aqua">
                    <h3 class="block-title">{{ __('common.Rooms') }} </h3>

                </div>
                <form action="{{ action('RoomAssetController@index') }}" method="post">
                    <input name="_method" type="hidden" value="GET">
                    @csrf
                    <div class="block-content pb-4">
                        <select class="form-control form-control" id="rid" name="rid" title="{{ __('common.Room') }}"
                            onchange="this.form.submit()">
                            <option value="">{{ __('common.Room') }}</option>
                            @foreach($rooms as $room)
                            <option value="{{ $room->id }}" {{ (@$rid == $room->id ? 'selected':'') }}>{{ $room->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="block-content block-content-full text-right bg-light">
                        <div class="row">
                            <div class="col-md-6">

                            </div>
                            <div class="col-md-6">
                                <a class="btn btn-warning btn-block" href="{{ action('RoomAssetController@index' )}}">
                                    <i class="si si-action-undo mr-1"></i>
                                    {{ __('common.Reset') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>


        </div>

        <div class="col-md-6">
            <!-- Block Tabs With Options Default Style -->
            <div class="block block-rounded block-themed block-fx-pop">
                <div class="block-header block-header-default bg-gd-aqua">
                    <h3 class="block-title">{{ __('common.Assets') }} </h3>

                </div>
                <form action="{{ action('RoomAssetController@attach', $rid) }}" method="POST">
                    <input name="_method" type="hidden" value="GET">

                    @csrf
                    <div class="block-content pb-4">


                        <select class="form-control form-control" id="aid" name="aid" title="{{ __('common.Assets') }}"
                            @if(@!$rid) disabled @endif>
                            <option value="">{{ __('common.Assets') }}</option>
                            @foreach($assets as $asset)
                            <option value="{{ $asset->id }}" {{ (@$selected_asset == $asset->id ? 'selected':'') }}>
                                {{ $asset->name }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="block-content block-content-full text-right bg-light">
                        <div class="row">
                            <div class="col-md-6">

                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary btn-block"
                                    {{ (@$rid > 0 ? '':'disabled') }}>
                                    <i class="si si-fire mr-1"></i>
                                    {{ __('common.Add') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">
            @if (@$room_assets->count() > 0 && $current_room)
            <!-- Table Sections (.js-table-sections class is initialized in Helpers.tableToolsSections()) -->

            <div class="block block-rounded block-themed block-fx-pop animated fadeIn">

                <div class="block-header block-header-default">
                    <h3 class="block-title">{{ __('common.Assets') }}
                        @if ($current_room)
                        {{__('common.From')}} {{ @$current_room->name }} {{ @$current_room->last_name }} |
                        {{ $current_room->street }} {{ $current_room->street_number }} {{ $current_room->zip }}
                        {{ $current_room->city }} | <a class="text-white"
                            href="mailto:{{ $current_room->email }}?subject=Ein Lehrgang wurde zugewiesen">{{ $current_room->email }}</a>
                        | <a class="text-white" href="mailto:{{ $current_room->url }}">{{ $current_room->url }}</a>
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



                                <th style="border-top: none;" class="text-right">

                                </th>
                            </tr>
                        </thead>
                        @csrf
                        @foreach($room_assets as $asset)
                        <tbody class="js-table-sections-header">
                            <tr>
                                <td class="text-center">
                                    <i class="fa fa-angle-right text-muted"></i>
                                </td>
                                <td class="font-w600">
                                    <div class="py-1">
                                        {{ $asset->name }}
                                    </div>
                                </td>

                                <td class="d-none d-sm-table-cell text-right">

                                    @can('update rooms')
                                    @if ($asset->id)

                                    <form action="{{ action('RoomAssetController@detach', [$rid, $asset->id]) }}"
                                        method="POST">
                                        <input name="_method" type="hidden" value="GET">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            title="{{__('common.Delete')}}">
                                            <i class="nav-main-link-icon si si-trash"></i>
                                        </button>
                                    </form>
                                    @endif
                                    @endcan

                                </td>
                            </tr>
                        </tbody>
                        <tbody class="font-size-sm">
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="10">
                                    <p>
                                        {{ __('common.Description') }}: {{ $asset->description }}<br>

                                    </p>

                                    <p>
                                        <em
                                            class="text-muted">{{ Carbon::parse($asset->updated_at)->format('d.m.Y H:i')}}</em>
                                    </p>
                                </td>

                            </tr>

                        </tbody>
                        @endforeach
                    </table>

                </div>

                @if ($room_assets->total() > $room_assets->perPage())
                <div
                    class="block-content block-content-full block-content-sm bg-body-light d-flex justify-content-center align-content-center">
                    {!! $room_assets->appends(\Request::except('page'))->render() !!}
                </div>
                @endif
            </div>
            @endif
        </div>
    </div>
    <!-- END Table Sections -->
</div>
<!-- END Page Content -->



<!-- Modal -->
<div class="modal fade" id="person-edit-modal" tabindex="-1" role="dialog" aria-labelledby="person-edit-modal"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Modal Title</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">

                </div>
                <div class="block-content block-content-full text-right bg-light">
                    <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Done</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Modal -->



@endsection