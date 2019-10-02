@include('emails.style')
<p>{{ __('common.GoodDay') }}</p>
<p>{{ __('common.StatusChangeDescription') }}</p>
<p></p>
<ul>
    <li>{{ __('common.Event') }}: {{ $event->name }} </li>
    <li>{{ __('common.Study') }}: {{ $event->study->name }} </li>
    <li>{{ __('common.Course') }}: {{ $event->course->name }} </li>
    <li>{{ __('common.Group') }}: {{ $event->groups()->pluck('name')->first() }} </li>
    <li>{{ __('common.Person') }}: {{ $person->last_name }} {{ $person->first_name }} </li>
    <li>{{ __('common.Status') }}: {{ $status }} {{ __('common.on') }} {{ $date }} {{ __('common.at') }} {{ $time }}
    </li>
</ul>
<p></p>
<p>{{ __('common.AssignmentSheetAttached') }}</p>
<p></p>
<p>{{ __('common.ThankYou') }}</p>
<p>
    <a href="https://drehbu.ch/" target="_blank" title="{{ __('common.GoToPortal') }}">{{ __('common.GoToPortal') }}</a>
</p>