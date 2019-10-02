@extends('layouts.app')

@section('content')


<!-- Page Content -->
<div class="content">
    <div class="row">
        <div class="col-md-4">
            <!-- Block Tabs With Options Default Style -->
            <div class="block block-rounded block-themed block-fx-pop">
                <div class="block-header block-header-default bg-gd-aqua">
                    <h3 class="block-title">{{ __('common.Persons') }} </h3>

                </div>
                <form action="{{ action('PersonSkillController@index') }}" method="post">
                    <input name="_method" type="hidden" value="GET">
                    @csrf
                    <div class="block-content pb-4">
                        <select class="form-control form-control" id="pid" name="pid" title="{{ __('common.Person') }}"
                            onchange="this.form.submit()">
                            <option value="">{{ __('common.Person') }}</option>
                            @if(@$persons)
                            @foreach($persons as $person)
                            <option value="{{ $person->id }}" {{ (@$pid == $person->id ? 'selected':'') }}>
                                {{ $person->last_name }} {{ $person->first_name }} </option>
                            @endforeach

                            @endif
                        </select>
                    </div>
                    <div class="block-content block-content-full text-right bg-light">
                        <div class="row">
                            <div class="col-md-6">

                            </div>
                            <div class="col-md-6">
                                <a class="btn btn-warning btn-block" href="{{ action('PersonSkillController@index' )}}">
                                    <i class="si si-action-undo mr-1"></i>
                                    {{ __('common.Reset') }}
                                </a>
                            </div>
                        </div>
                    </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Block Tabs With Options Default Style -->
            <div class="block block-rounded block-themed block-fx-pop">
                <div class="block-header block-header-default bg-gd-aqua">
                    <h3 class="block-title">{{ __('common.Courses') }} </h3>

                </div>

                <div class="block-content pb-4">
                    <select class="form-control form-control" id="cid" name="cid" title="{{ __('common.Course') }}"
                        onchange="this.form.submit()" @if(@!$pid) disabled @endif>
                        <option value="">{{ __('common.Course') }}</option>
                        @if(@$courses && @$pid)
                        @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ (@$cid == $course->id ? 'selected':'') }}>
                            {{ $course->alias }} | {{ $course->name }} </option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <div class="block-content block-content-full text-right bg-light">
                    <div class="row">
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-6">
                            <a class="btn btn-warning btn-block" href="{{ action('PersonSkillController@index' )}}">
                                <i class="si si-action-undo mr-1"></i>
                                {{ __('common.Reset') }}
                            </a>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Block Tabs With Options Default Style -->
            <div class="block block-rounded block-themed block-fx-pop">
                <div class="block-header block-header-default bg-gd-aqua">
                    <h3 class="block-title">{{ __('common.Skills') }} </h3>

                </div>
                <form action="{{ action('PersonSkillController@attach', [$pid, $cid]) }}" method="POST">
                    <input name="_method" type="hidden" value="GET">

                    @csrf
                    <div class="block-content pb-4">


                        <select class="form-control form-control" id="sid" name="sid" title="{{ __('common.Skills') }}"
                            @if(@!$pid || @$skills->count() == 0) disabled @endif>
                            @if($skills)
                            @foreach($skills as $skill)
                            <option value="{{ $skill->id }}" {{ (@$selected_skill == $skill->id ? 'selected':'') }}>
                                {{ $skill->name }} | Zuschlag {{ $skill->surcharge }}</option>
                            @endforeach
                            @else
                            <option value="">{{ __('common.Select') }}</option>
                            @endif
                        </select>

                    </div>
                    <div class="block-content block-content-full text-right bg-light">
                        <div class="row">
                            <div class="col-md-6">

                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary btn-block"
                                    {{ (@$pid > 0 ? '':'disabled') }}>
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
            @if (@$person_skills && $person)
            <!-- Table Sections (.js-table-sections class is initialized in Helpers.tableToolsSections()) -->

            <div class="block block-rounded block-themed block-fx-pop animated fadeIn">

                <div class="block-header block-header-default">
                    <h3 class="block-title">{{ __('common.Skills') }}
                        @if ($person)
                        {{__('common.From')}} {{ @$person->first_name }} {{ @$person->last_name }} | <a
                            class="text-white"
                            href="mailto:{{ $person->email }}?subject=Ein Lehrgang wurde zugewiesen">{{ $person->email }}</a>
                        | {{ $person->mobile }} | <a class="text-white"
                            href="mailto:{{ $person->url }}">{{ $person->urls }}</a>
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
                                <th style="border-top: none;" class="d-none d-xl-table-cell">
                                    @sortablelink('institution', __('common.Institution'))
                                </th>
                                <th style="border-top: none;" class="d-none d-xl-table-cell text-right">
                                    @sortablelink('surcharge', __('common.Surcharge'))
                                </th>
                                <th style="border-top: none;" class="d-none d-xl-table-cell text-right">
                                    @sortablelink('updated_at', __('common.DateUpdated'))
                                </th>
                                <th style="border-top: none;" class="text-right">

                                </th>
                            </tr>
                        </thead>
                        @csrf
                        @foreach($person_skills as $skill)
                        <tbody class="js-table-sections-header">
                            <tr>
                                <td class="text-center">
                                    <i class="fa fa-angle-right text-muted"></i>
                                </td>
                                <td>
                                    <div class="py-1">
                                        {{ $skill->name }}
                                    </div>
                                </td>
                                <td class="d-none d-xl-table-cell">
                                    <div class="py-1">
                                        {{ $skill->institution }}
                                    </div>
                                </td>
                                <td class="d-none d-xl-table-cell text-right">
                                    <div class="py-1">
                                        CHF {{ $skill->surcharge }}
                                    </div>
                                </td>

                                <td class="d-none d-lg-table-cell text-right">
                                    <div class="py-1">
                                        {{ Carbon::parse($skill->updated_at)->format('d.m.Y H:i')}}
                                    </div>
                                </td>


                                <td class="d-none d-sm-table-cell text-right">
                                    @can('update persons')
                                    @if ($skill->id)

                                    <form
                                        action="{{ action('PersonSkillController@detach', [$pid, $skill->id, $cid]) }}"
                                        method="POST">
                                        <input name="_method" type="hidden" value="GET">
                                        @csrf
                                        <button type="submit" class="btn btn-danger" title="{{__('common.Delete')}}">
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
                                        {{ $skill->description }}<br>
                                    </p>

                                    <p>
                                        <em
                                            class="text-muted">{{ Carbon::parse($skill->updated_at)->format('d.m.Y H:i')}}</em>
                                    </p>
                                </td>

                            </tr>

                        </tbody>
                        @endforeach
                        <tfoot class="bg-light">
                            <tr>
                                <td class="text-center"></td>
                                <td>
                                    {{ __('common.TotalAmount') }}
                                </td>
                                <td></td>
                                <td class="text-right">CHF {{ @$surcharge }}</td>
                                <td></td>
                                <td class="text-right"></td>
                            </tr>
                        </tfoot>
                    </table>

                </div>


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