@extends('layouts.app')

@section('content')


<!-- Page Content -->
<div class="content">

    @if(($action == 'readonly' || $action == 'edit') && $post)

        <div class="block block-rounded block-fx-pop block-themed">
            <div class="block-header block-header-default bg-primary-darker ">
                <h3 class="block-title">{{ $post->title }}</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"><i class="si si-size-fullscreen"></i></button>
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                        <i class="si si-refresh"></i>
                    </button>
                </div>
            </div>
            <div class="block-content">
                <table class="table table-borderless">
                    
                    <tbody>
                        <tr class="table-active">
                            <td class="d-none d-sm-table-cell"></td>
                            <td class="font-size-sm text-muted">
                                <a href="{{ action('PersonController@show', $post->user->person_id) }}">{{ $post->user->description }}</a> <em>{{ Carbon::parse($post->updated_at)->diffForHumans() }}</em>
                            </td>
                            <td class="text-right">
                                <a class="" href="{{ action('PostController@show', $post->id) }}">
                                    <i class="fa fa-reply mr-1"></i> {{ __('common.Reply') }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="d-none d-sm-table-cell text-center" style="width: 140px;">
                                <p>
                                    <a href="{{ action('PersonController@show', $post->user->person_id) }}">
                                        <img class="img-avatar" src="{{ $post->user->person->picture }}" alt="{{ $post->user->person->last_name }}">
                                    </a>
                                </p>
                                <p class="font-size-sm">{{ $allposts->where('user_id', $post->user_id)->count() }} {{ __('common.Posts') }}</p>
                            </td>
                            <td colspan="2">
                                {!! $post->summary !!}
                                <p></p>
                                {!! $post->content !!}
                                <hr>
                                <p class="font-size-sm text-muted">
                                    {{ $post->user->description }}
                                    <br>
                                    <em>{{ Carbon::parse($post->publsh_date)->formatLocalized('%A, %d. %B %Y') }}</em>

                                </p>
                            </td>
                        </tr> 
                    </tbody>

                    @foreach ($related_posts as $post)
                    <tbody>
                            <tr class="table-active">
                                <td class="d-none d-sm-table-cell"></td>
                                <td class="font-size-sm text-muted">
                                    <a href="{{ action('PersonController@show', $post->user->person_id) }}">{{ $post->user->description }}</a> <em>{{ Carbon::parse($post->updated_at)->diffForHumans() }}</em>
                                </td>
                                <td class="text-right">
                                    <a class="" href="{{ action('PostController@show', $post->id) }}">
                                        <i class="fa fa-reply mr-1"></i> {{ __('common.Reply') }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="d-none d-sm-table-cell text-center" style="width: 140px;">
                                    <p>
                                        <a href="{{ action('PersonController@show', $post->user->person_id) }}">
                                            <img class="img-avatar" src="{{ $post->user->person->picture }}" alt="{{ $post->user->person->last_name }}">
                                        </a>
                                    </p>
                                    <p class="font-size-sm">{{ $allposts->where('user_id', $post->user_id)->count() }} {{ __('common.Posts') }}</p>
                                </td>
                                <td colspan="2">
                                    {!! $post->summary !!}
                                    <p></p>
                                    {!! $post->content !!}
                                    <hr>
                                    <p class="font-size-sm text-muted">
                                     {{ $post->user->description }}
                                        <br>
                                        <em>{{ Carbon::parse($post->publsh_date)->formatLocalized('%A, %d. %B %Y') }}</em>
                                        
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                        
                    @endforeach

                    <tbody>
                        <tr class="table-active" id="forum-reply-form">
                            <td class="d-none d-sm-table-cell"></td>
                            <td class="font-size-sm text-muted" colspan="2">
                                <a href="{{ action('PersonController@show', $post->user->person_id) }}">{{ Auth()->user()->description }}</a> {{ Carbon::now()->diffForHumans() }}
                            </td>
                        </tr>
                        <tr>
                            <td class="d-none d-sm-table-cell text-center">
                                <p>
                                    <a href="{{ action('PersonController@show', $post->user->person_id) }}">
                                        <img class="img-avatar" src="{{ Auth()->user()->person->picture }}" alt="{{ Auth()->user()->person->last_name }}">
                                    </a>
                                </p>
                                <p class="font-size-sm">{{ $allposts->where('user_id', $post->user_id)->count() }} {{ __('common.Posts') }}</p>
                            </td>
                            <td colspan="2">
                                <form action="{{action('PostController@reply', $post->id)}}" enctype="multipart/form-data" method="post">
                                    @csrf
                        
                                    <input type="hidden" name="title" value="{{ $post->title }}">
                                    <input type="hidden" name="client_id" value="{{ Auth()->user()->client_id }}">
                                    <input type="hidden" name="user_id" value="{{ Auth()->user()->id }}">
                                    <input type="hidden" name="parent_id" value="{{ $post->id }}">
                                    <input type="hidden" name="belongs_to" value="{{ $post->belongs_to }}">

                                    <input name="_method" type="hidden" value="POST">                                    
                                    <div class="form-group">
                                        <textarea id="content" name="content" class="js-summernote"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-reply mr-1"></i> {{ __('common.Reply') }}
                                        </button>

                                        <a class="btn btn-info" href="{{ action('PostController@index') }}">
                                            <i class="fa fa-list mr-1"></i> {{ __('common.Posts') }}
                                        </a>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    @endif

    @if (@$posts)

    <div class="block block-rounded block-themed">
        <div class="block-header block-header-default bg-primary-darker">
            <h3 class="block-title">{{ __('common.Posts') }}</h3>
            <div class="block-options">
                <button type="button" class="btn-block-option mr-2">
                    <i class="fa fa-plus mr-1"></i> {{ __('common.Add') }}
                </button>
                <button type="button" class="btn-block-option" data-toggle="block-option"
                    data-action="fullscreen_toggle"><i class="si si-size-fullscreen"></i></button>
                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle"
                    data-action-mode="demo">
                    <i class="si si-refresh"></i>
                </button>
            </div>
        </div>
        <div class="block-content">
            <!-- Topics -->
            <table class="table table-striped table-borderless table-vcenter">
                <thead class="thead-light">
                    <tr>
                        <th colspan="2">{{ __('common.Welcome') }}</th>
                        <th class="d-none d-md-table-cell text-center" style="width: 100px;">{{ __('common.Replies') }}</th>
                        <th class="d-none d-md-table-cell text-center" style="width: 100px;">{{ __('common.Views') }}</th>
                        <th class="d-none d-md-table-cell" style="width: 200px;">{{ __('common.LastPost') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                    <tr>
                        
                        <td class="text-center" style="width: 40px;">
                                @if($post->highlight)
                            <i class="fa fa-thumbtack text-xwork"></i>
                            @endif
                        </td>
                        
                        <td>
                            <a class="font-w600" href="#">{{ $post->title }}</a>
                            <div class="font-size-sm text-muted mt-1">
                                <a href="#">{{ $post->user->description }}</a> {{ __('common.on') }} <em>{{ Carbon::parse($post->publish_date)->format('d.m.Y') }}</em>
                            </div>
                        </td>
                        <td class="d-none d-md-table-cell text-center">
                            <a class="font-w600" href="javascript:void(0)">{{ $post->where('parent_id', $post->id)->count() }}</a>
                        </td>
                        <td class="d-none d-md-table-cell text-center">
                            <a class="font-w600" href="javascript:void(0)">{{ $post->views }}</a>
                        </td>
                        <td class="d-none d-md-table-cell">
                            <span class="font-size-sm">{{ __('common.by') }} <a href="{{ action('PersonController@show', $post->user->person_id) }}">{{ $post->user->description }}</a><br> {{ __('common.on') }}
                                <em>{{ Carbon::parse($post->publish_date)->format('d.m.Y') }}</em></span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- END Topics -->

        </div>


        @if ($posts->total() > $posts->perPage())
        <div
            class="block-content block-content-full block-content-sm bg-body-light d-flex justify-content-center align-content-center">
            {!! $posts->appends(\Request::except('page'))->render() !!}
        </div>
        @endif
    </div>

    @endif

    <!-- END Table Sections -->
</div>
<!-- END Page Content -->


@endsection