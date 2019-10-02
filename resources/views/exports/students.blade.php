<h1>{{ __('common.Students') }}</h1>
<p>Nisi elit tempor occaecat pariatur ullamco qui laborum ea irure anim proident nulla. Id eu dolore et esse ex aliqua
    velit laboris.</p>
<table>
    <thead>
        <tr>
            <th style="width: 20px; font-weight: bold;">Vorname</th>
            <th style="width: 20px; font-weight: bold;">Nachname</th>
            <th style="width: 30px;">Email</th>
            <th style="width: 30px;">Strasse</th>
            <th style="width: 10px;">PLZ</th>
            <th style="width: 20px;">Ort</th>
        </tr>
    </thead>
    <tbody>
        @foreach($students as $student)
        <tr>
            <td>{{ $student->first_name }}</td>
            <td>{{ $student->last_name }}</td>
            <td>{{ $student->email }}</td>
            <td>{{ $student->locations->where('default', 1)->pluck('street')->first() }}</td>
            <td>{{ $student->locations->where('default', 1)->pluck('zip')->first() }}</td>
            <td>{{ $student->locations->where('default', 1)->pluck('city')->first() }}</td>
        </tr>
        @endforeach
    </tbody>
</table>