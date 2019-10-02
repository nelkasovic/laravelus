<h2>{{ __('common.Skills') }} & {{ __('common.Salary') }}</h2>
<p>Aufgrund der uns bekannten Qualifikationen ergibt sich die folgende Honorarrechnung. Wir bitten Sie, uns allfällige
    Unstimmigkeiten frühzeitig zu melden. Wenn Sie in der Zwischenzeit weitere Qualifikationen und Skills vorweisen
    können, bitten wir Sie ebenfalls um einen Bescheid.</p>
<br />
<table class="styled page-break">
    <thead>
        <tr>
            <th>{{ __('common.Skill') }}</th>
            <th>{{ __('common.Institution') }}</th>
            <th>{{ __('common.DateUpdated') }}</th>
            <th class="text-right">{{ __('common.Surcharge') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($person->skills as $skill)
        <tr>
            <td>{{ $skill->name }}</td>
            <td>{{ $skill->institution }}</td>
            <td>{{ Carbon::parse($skill->updated_at)->format('d.m.Y') }}</td>
            <td class="text-right">{{ $skill->surcharge }}</td>
        </tr>
        @endforeach
    </tbody>
    <tbody class="border-top">
        <tr>
            <th>{{ __('common.Amount') }}</th>
            <th colspan="4" class="text-right">{{ number_format($person->skills->sum('surcharge'), 2, '.', '`') }}</th>
        </tr>
    </tbody>
</table>