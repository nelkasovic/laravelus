<!DOCTYPE html>
<html>

<head>
    <title>{{ $event->title }}</title>
</head>

<body>
    @include('pdf.include.header')
    @include('pdf.include.footer')
    <main>
        <p class="space-2"></p>
        <p>{{ Carbon::now()->formatLocalized('%d. %B %Y')}}</p>
        <p>&nbsp;</p>
        <p>
            @if($person->salutation === 'mrs') Frau @elseif($person->salutation === 'mr') Herr @else @endif<br>
            {{ $person->first_name }} {{ $person->last_name }}<br>
            {{ $location->street }} {{ $location->street_number }}<br>
            {{ $location->zip }} {{ $location->city }}<br>
        </p>
        <p>&nbsp;</p>
        <h2>{{ $event->name }}</h2>
        <p>
            @if($person->salutation === 'mrs') Sehr geehrte Frau {{ $last_name }} @elseif($person->salutation === 'mr')
            Sehr geehrter Herr {{ $person->last_name }} @else Sehr geehrte Damen, sehr geehrte Herren @endif<br>
        </p>
        <p>Wir bedanken uns für Ihre Bereitschaft, bei <strong>{{ $client->name }}</strong> zu lehren. Gerne erteilen
            wir Ihnen den folgenden Lehrauftrag:</p>

        @include('pdf.include.eventmeta')

        <p> {{ $event->description }}</p>
        <p>Wir bitten Sie den Lehrauftrag zu prüfen und innert 7 Tagen unterzeichnet an uns zurück zu senden. Allfällige
            Änderungen bitten wir Sie uns baldmöglichst mitzuteilen.</p>
        <p>Besten Dank<br>
            Freundliche Grüsse</p>
        <p class="space-2"></p>

        <table class="page-break">
            <tr>
                <td class="vertical-bottom">{{ __('common.Name') }}<br></td>
                <td class="vertical-bottom">{{ __('common.Date') }}</td>
                <td class="vertical-bottom">{{ __('common.Signature') }}</td>
            </tr>

            <tr>
                <td class="h75px vertical-bottom border-bottom bold">{{ $client->name }}</td>
                <td class="vertical-bottom border-bottom">&raquo;</td>
                <td class="vertical-bottom border-bottom">&raquo;</td>
            </tr>
            <tr>
                <td class="h75px vertical-bottom border-bottom bold">{{ $person->first_name }} {{ $person->last_name }}
                </td>
                <td class="vertical-bottom border-bottom">&raquo;</td>
                <td class="vertical-bottom border-bottom">&raquo;</td>
            </tr>
        </table>

        @if($person->skills)
        @if($person->skills->count())
        @include('pdf.include.skills')
        @endif
        @endif

        @if($participants)
        @if($participants->count())
        @include('pdf.include.participants-light')
        @endif
        @endif

    </main>

</body>
</body>

</html>
@include('pdf.include.style')