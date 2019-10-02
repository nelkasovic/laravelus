<h2>{{ __('common.Participants') }}</h2>
<p>Zum aktuellen Zeitpunkt werden folgende Teilnehmende am Kurs teilnehmen. Die Präsenzkontrolle kann direkt im Qlick!
    online erfasst werden werden.</p>

<table class="styled">
    <thead>
        <tr>
            <th>{{ __('common.FirstName') }}</th>
            <th>{{ __('common.LastName') }}</th>
            <th>{{ __('common.Company') }}</th>
            <th>{{ __('common.Email') }}</th>
            <th>{{ __('common.Phone') }}</th>
            <th>{{ __('common.City') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($participants as $student)
        <tr>
            <td>{{ $student->first_name }}</td>
            <td>{{ $student->last_name }}</td>
            <td>{{ $student->company_name }}</td>
            <td>{{ $student->email }}</td>
            <td>{{ $student->phone }}</td>
            <td>
                {{ $student->locations()->pluck('city')->first() }}
            </td>
        </tr>
        @endforeach
    </tbody>

</table>