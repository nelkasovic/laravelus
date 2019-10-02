<table class="styled">
    <tr>
        <td width="25%">{{ __('common.Institution') }}</td>
        <td>{{ $client->name }}</td>
    </tr>
    <tr>
        <td width="25%">{{ __('common.Study') }}</td>
        <td>{{ $event->study->alias }} | {{ $event->study->name }}</td>
    </tr>
    <tr>
        <td width="25%">{{ __('common.Course') }}</td>
        <td>{{ $event->course->alias }} | {{ $event->course->number }} | {{ $event->course->name }}</td>
    </tr>
    <tr>
        <td>{{ __('common.Duration') }}</td>
        <td>{{ Carbon::parse($event->start_date)->format('d.m.Y H:i')}} -
            {{ Carbon::parse($event->end_date)->format('d.m.Y H:i')}}</td>
    </tr>
    <tr>
        <td>{{ __('common.Room') }}</td>
        <td>{{ $event->room->name }}@if($event->room->locations()->first()),
            {{ $event->room->locations()->first()->street }} @endif</td>
    </tr>
    <tr>
        <td>{{ __('common.Occurrences') }}</td>
        <td>{{ $dates }}</td>
    </tr>

</table>