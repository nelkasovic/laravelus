@extends('layouts.app')

@section('content')

<!-- Page Content -->
<div class="content">

    <form action="{{action('SettingController@sync')}}" enctype="multipart/form-data" method="post">
        @csrf
        <input name="_method" type="hidden" value="POST">
        <div class="block block-rounded block-themed block-fx-pop">

            <ul class="nav nav-tabs nav-tabs-block js-tabs" data-toggle="tabs" role="tablist">
                @hasrole('client')
                <li class="nav-item">
                    <a class="nav-link active" href="#settings-home"><i class="si si-settings mr-2"></i>
                        {{ __('common.Theme') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#settings-application"><i
                            class="si si-fire mr-2"></i>{{ __('common.Application') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#settings-notification"><i
                            class="si si-envelope mr-2"></i>{{ __('common.Notifications') }}</a>
                </li>
                @endhasrole
                <li class="nav-item">
                    <a class="nav-link" href="#settings-personal"><i
                            class="si si-user mr-2"></i>{{ __('common.PersonalSettings') }}</a>
                </li>

            </ul>
            <div class="block-content tab-content">
                @hasrole('client')
                <div class="tab-pane @hasrole('client') active @endhasrole" id="settings-home" role="tabpanel">
                    <table class="js-table-checkable table table-hover table-vcenter">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 70px;">
                                    <div class="custom-control custom-checkbox custom-control-primary d-inline-block">
                                        <input type="checkbox" class="custom-control-input" id="check-all-main"
                                            name="check-all-main">
                                        <label class="custom-control-label" for="check-all-main"></label>
                                    </div>
                                </th>
                                <th>{{ __('common.Settings') }}</th>
                            </tr>
                        </thead>
                        @foreach ($client_settings['theme_settings'] as $key => $value)
                        @if(!is_array(Auth()->user()->client->getMeta($key)))
                        <tbody>
                            <tr>
                                <td class="text-center">
                                    <div class="custom-control custom-checkbox custom-control-primary d-inline-block">
                                        <input type="checkbox" class="custom-control-input" id="{{ $key }}"
                                            name="client_settings[{{ $key }}]"
                                            @if(Auth()->user()->client->getMeta($key))
                                        checked @endif>
                                        <label class="custom-control-label" for="{{ $key }}"></label>
                                    </div>
                                </td>
                                <td>
                                    <p class="font-w600 mb-1">
                                        {{ __('dynamic.'.$key) }}
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                        @endif
                        @endforeach
                        <tbody>
                            <tr>
                                <td class="text-center">

                                </td>
                                <td>
                                    <p class="font-w600 mb-2">
                                        {{ __('dynamic.custom_theme') }}
                                    </p>

                                    <select class="form-control" name="client_settings[custom_theme]" id="custom_theme">
                                        @foreach ($themes as $key => $value)
                                        <option value="{{ $value }}" @if(Auth()->user()->client->getMeta('custom_theme')
                                            == $value) selected @endif>{{ __('dynamic.'.$value) }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
                <div class="tab-pane" id="settings-notification" role="tabpanel">
                    <table class="js-table-checkable table table-hover table-vcenter">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 70px;">
                                    <div class="custom-control custom-checkbox custom-control-primary d-inline-block">
                                        <input type="checkbox" class="custom-control-input" id="check-all-notification"
                                            name="check-all-notification">
                                        <label class="custom-control-label" for="check-all-notification"></label>
                                    </div>
                                </th>
                                <th>{{ __('common.Settings') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        @foreach ($client_settings['notification_settings'] as $key => $value)
                        @if(!is_array(Auth()->user()->client->getMeta($key)))
                        <tbody>
                            <tr>
                                <td class="text-center">
                                    <div class="custom-control custom-checkbox custom-control-primary d-inline-block">
                                        <input type="checkbox" class="custom-control-input" id="{{ $key }}"
                                            name="client_settings[{{ $key }}]"
                                            @if(Auth()->user()->client->getMeta($key))
                                        checked @endif>
                                        <label class="custom-control-label" for="{{ $key }}"></label>
                                    </div>
                                </td>
                                <td>
                                    <p class="font-w600 mb-1">
                                        {{ __('dynamic.'.$key) }}
                                    </p>
                                </td>
                                <td>

                                </td>
                            </tr>
                        </tbody>
                        @endif
                        @endforeach
                    </table>
                </div>
                <div class="tab-pane" id="settings-application" role="tabpanel">
                    <table class="js-table-checkable table table-hover table-vcenter">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 70px;">
                                    <div class="custom-control custom-checkbox custom-control-primary d-inline-block">
                                        <input type="checkbox" class="custom-control-input" id="check-all-application"
                                            name="check-all-application">
                                        <label class="custom-control-label" for="check-all-application"></label>
                                    </div>
                                </th>
                                <th>{{ __('common.Settings') }}</th>
                            </tr>
                        </thead>
                        @foreach ($client_settings['app_settings'] as $key => $value)
                        @if(!is_array(Auth()->user()->client->getMeta($key)))
                        <tbody>
                            <tr>
                                <td class="text-center">
                                    <div class="custom-control custom-checkbox custom-control-primary d-inline-block">
                                        <input type="checkbox" class="custom-control-input" id="{{ $key }}"
                                            name="client_settings[{{ $key }}]"
                                            @if(Auth()->user()->client->getMeta($key))
                                        checked @endif>
                                        <label class="custom-control-label" for="{{ $key }}"></label>
                                    </div>
                                </td>
                                <td>
                                    <p class="font-w600 mb-1">
                                        {{ __('dynamic.'.$key) }}
                                    </p>
                                </td>

                            </tr>
                        </tbody>
                        @endif
                        @endforeach
                        <tbody>
                            <tr>
                                <td class="text-center">

                                </td>
                                <td>
                                    <p class="font-w600 mb-2">
                                        {{ __('dynamic.initial_password') }}
                                    </p>

                                    <input type="text" @if(Auth()->user()->client->getMeta('initial_password'))
                                    value="{{ Auth()->user()->client->getMeta('initial_password') }}"
                                    @endif
                                    name="client_settings[initial_password]" id="initial_password" class="form-control"
                                    placeholder="{{ __('common.Password') }}">
                                </td>

                            </tr>
                        </tbody>
                    </table>
                </div>
                @endhasrole
                <div class="tab-pane" id="settings-personal" role="tabpanel">
                    <table class="js-table-checkable table table-hover table-vcenter">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 70px;">
                                    <div class="custom-control custom-checkbox custom-control-primary d-inline-block">
                                        <input type="checkbox" class="custom-control-input" id="check-all-personal"
                                            name="check-all-personal">
                                        <label class="custom-control-label" for="check-all-personal"></label>
                                    </div>
                                </th>
                                <th>{{ __('common.PersonalSettings') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        @foreach ($user_settings['notification_settings'] as $key => $value)
                        @if(!is_array(Auth()->user()->getMeta($key)))
                        <tbody>
                            <tr>
                                <td class="text-center">
                                    <div class="custom-control custom-checkbox custom-control-primary d-inline-block">
                                        <input type="checkbox" class="custom-control-input" id="{{ $key }}"
                                            name="user_settings[{{ $key }}]" @if(Auth()->user()->getMeta($key))
                                        checked @endif>
                                        <label class="custom-control-label" for="{{ $key }}"></label>
                                    </div>
                                </td>
                                <td>
                                    <p class="font-w600 mb-1">
                                        {{ __('dynamic.'.$key) }}
                                    </p>
                                </td>
                                <td>

                                </td>
                            </tr>
                        </tbody>
                        @endif
                        @endforeach
                        @foreach ($user_settings['dashboard_widget_settings'] as $key => $value)
                        @if(!is_array(Auth()->user()->getMeta($key)))
                        <tbody>
                            <tr>
                                <td class="text-center">
                                    <div class="custom-control custom-checkbox custom-control-primary d-inline-block">
                                        <input type="checkbox" class="custom-control-input" id="{{ $key }}"
                                            name="user_settings[{{ $key }}]" @if(Auth()->user()->getMeta($key))
                                        checked @endif>
                                        <label class="custom-control-label" for="{{ $key }}"></label>
                                    </div>
                                </td>
                                <td>
                                    <p class="font-w600 mb-1">
                                        {{ __('dynamic.'.$key) }}
                                    </p>
                                </td>
                                <td>

                                </td>
                            </tr>
                        </tbody>
                        @endif
                        @endforeach
                    </table>
                </div>
            </div>

            <div class="block-content block-content-full text-right bg-light">
                <div class="row">
                    <div class="col-lg-4">

                    </div>
                    <div class="col-lg-8 text-right">
                        <a class="btn btn-danger" href="{{action('SettingController@defaults')}}">
                            <i class="si si-action-undo mr-1"></i>
                            {{ __('common.Reset') }}
                        </a>
                        <a class="btn btn-warning" href="{{action('SettingController@index')}}">
                            <i class="si si-action-undo mr-1"></i>
                            {{ __('common.Close') }}
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="si si-fire mr-1"></i>
                            {{ __('common.Save') }}
                        </button>
                    </div>
                </div>

            </div>

        </div>
    </form>


    <!-- END Table Sections -->
</div>
<!-- END Page Content -->


@endsection