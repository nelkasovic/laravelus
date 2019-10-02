<div class="block block-rounded block-fx-pop block-themed animated fadeIn block-mode-hidden">

    <div class="block-header block-header-default bg-gd-sun">
        <h3 class="block-title">{{ $exclusions->count() }} {{ __('common.Exclusions') }} </h3>
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
        <form action="{{action('ExclusionController@index')}}" method="post">

        </form>
        <table class="js-table-sections table table-hover table-vcenter">
            <thead>
                <tr>
                    <th style="border-top: none;"></th>
                    <th style="border-top: none;">
                        @sortablelink('name', __('common.Name'))
                    </th>
                    <th style="border-top: none;">
                        @sortablelink('exclusionable_type', __('common.Type'))
                    </th>
                    <th style="border-top: none;" class="d-none d-xl-table-cell">
                        @sortablelink('start_date', __('common.StartDate'))
                    </th>
                    <th style="border-top: none;" class="d-none d-xl-table-cell">
                        @sortablelink('end_date', __('common.EndDate'))
                    </th>

                    <th style="border-top: none;" class="d-none d-xl-table-cell">
                        @sortablelink('updated_at', __('common.Updated'))
                    </th>
                    <th style="border-top: none;" class="text-right d-none d-sm-table-cell">

                    </th>
                </tr>
            </thead>
            @csrf

            @foreach($exclusions as $exclusion)
            <tbody class="js-table-sections-header">
                <tr>
                    <td class="text-center">
                        <i class="fa fa-angle-right text-muted"></i>
                    </td>
                    <td>
                        <div class="py-1">
                            <a href="{{action('ExclusionController@show', $exclusion->id)}}">{{ $exclusion->name }} </a>
                        </div>
                    </td>
                    <td class="d-none d-xl-table-cell">
                        <div class="py-1">
                            {{ $exclusion->exclusionable_type }}
                        </div>
                    </td>
                    <td class="d-none d-xl-table-cell">
                        <div class="py-1">
                            {{ Carbon::parse($exclusion->start_date)->format('d.m.Y')}}
                        </div>
                    </td>
                    <td class="d-none d-xl-table-cell">
                        <div class="py-1">
                            {{ Carbon::parse($exclusion->end_date)->format('d.m.Y')}}
                        </div>
                    </td>


                    <td class="d-none d-xl-table-cell">
                        <div class="py-1">
                            {{ Carbon::parse($exclusion->updated_at)->format('d.m.Y H:i')}}
                        </div>
                    </td>

                    <td class="d-none d-sm-table-cell text-right">

                        <a href="{{action('ExclusionController@edit', $exclusion->id)}}" class="btn btn-sm btn-primary">
                            <i class="nav-main-link-icon si si-pencil"></i>
                        </a>

                        <form action="{{action('ExclusionController@destroy', $exclusion->id)}}" method="post"
                            class="d-inline">
                            @csrf
                            <input name="_method" type="hidden" value="DELETE">

                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="nav-main-link-icon si si-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            </tbody>
            <tbody class="font-size-sm">
                <tr>
                    <td class="text-center"></td>
                    <td colspan="7">
                        <p>{{ $exclusion->description }}</p>

                        <em class="text-muted">{{ __('common.DateUpdated') }}: {{
                            Carbon::parse($exclusion->created_at)->format('d.m.Y H:i')}}</em>
                    </td>


                </tr>

            </tbody>
            @endforeach
        </table>

    </div>

</div>