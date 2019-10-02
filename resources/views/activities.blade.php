@extends('layouts.app')

@section('content')

<!-- Page Content -->
<div class="content">

    @if (@$activities)
    <div class="block block-rounded block-themed block-fx-pop">

        <div class="block-header block-header-default bg-primary-darker">
            <h3 class="block-title">{{ __('common.Activities') }}</h3>
            <div class="block-options">

                <div class="btn-group">
                    @can('read activities')
                    <a class="btn btn-light btn-sm" href="javascript:void(0)" onclick="getActivities();">
                        <i class="si si-share-alt mr-1"></i> {{ __('common.Activities') }} XHR</span>
                    </a>
                    <a class="btn btn-light btn-sm" href="{{action('ExportController@activities')}}">
                        <i class="si si-share-alt mr-1"></i> {{ __('common.Excel') }}</span>
                    </a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="block-content">
            <form action="{{action('ActivityController@index')}}" method="post">
                @csrf
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="form-group">
                            <select class="form-control" id="module_id" name="module_id"
                                title="{{ __('common.Component') }}" onchange="this.form.submit()">
                                <option value="">{{ __('common.Select') }}</option>
                                @foreach($modules as $module)
                                <option value="{{ $module->id }}" {{ ($selected_module==$module->id ? 'selected':'') }}>{{
                                $module->model }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-2 text-right">
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
                            {{__('common.Component')}}
                        </th>

                        <th class="d-none d-md-table-cell">
                            {{__('common.Type')}}
                        </th>

                        <th class="text-right d-none d-lg-table-cell">
                            @sortablelink('updated_at', __('common.DateUpdated'))
                        </th>

                        <th class="text-right d-none d-sm-table-cell">

                        </th>
                    </tr>
                </thead>
                @csrf

                @foreach($activities as $activity)
                <tbody class="js-table-sections-header">
                    <tr>
                        <td class="text-center">
                            <i class="fa fa-angle-right text-muted"></i>
                        </td>

                        <td>
                            <div class="py-1">
                                {{ $activity->subject_type }}
                            </div>
                        </td>

                        <td class="d-none d-md-table-cell">
                            <div class="py-1">
                                {{ __('dynamic.'.$activity->description) }}
                            </div>
                        </td>
                        <td class="text-right d-none d-lg-table-cell">
                            <div class="py-1">
                                {{ Carbon::parse($activity->updated_at)->format('d.m.Y H:i')}}
                            </div>
                        </td>


                        <td class="d-none d-sm-table-cell text-right">
                            @can('delete activities')
                            <form action="{{action('ActivityController@destroy', $activity->id)}}" method="post"
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
                            @foreach ($activity->changes as $attribute)
                            <ul>
                                @foreach($attribute as $key => $value)
                                <li>{{ $key }}: {{ json_encode($value) }}</li>
                                @endforeach
                            </ul>
                            @endforeach
                        </td>
                        <td>

                        </td>
                        <td>
                        </td>
                        <td class="d-none d-sm-table-cell text-right" colspan="10">
                            <em class="text-muted">{{ Carbon::parse($activity->updated_at)->format('d.m.Y H:i')}}</em>
                        </td>
                    </tr>

                </tbody>
                @endforeach
            </table>

        </div>

        @if ($activities->total() > $activities->perPage())
        <div
            class="block-content block-content-full block-content-sm bg-body-light d-flex justify-content-center align-content-center">
            {!! $activities->appends(\Request::except('page'))->render() !!}
        </div>
        @endif
    </div>
    @endif

    <!-- END Table Sections -->
</div>
<!-- END Page Content -->


@endsection