@extends('layouts.app')

@section('content')

<!-- Page Content -->
<div class="row no-gutters flex-md-10-auto">
    <div class="col-xl-12 bg-body-dark">
        <div class="content">
            <div class="block block-fx-pop">
                <div class="block-content block-content-full">
                    <!-- Calendar Container -->
                    <!-- <div class="js-calendar p-xl-4"></div> -->
                    {!! $calendar->calendar() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->

@endsection