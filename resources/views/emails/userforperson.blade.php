@include('emails.style')

<p>{{ __('common.GoodDay') }}</p>
<p>{{ __('common.UserForPersonDescription') }}</p>
<p></p>
<ul>
    <li>{{ __('common.Person') }}: {{ $person->first_name }} {{ $person->last_name }}</li>
    <li>{{ __('common.Email') }}: {{ $person->email }} </li>
    <li>{{ __('common.Password') }}: {{ $client->getMeta('initial_password') }} </li>

    </li>
</ul>
<p></p>
<p>{{ __('common.UserForPersonFooter') }}</p>
<p>{{ __('common.PleaseChangePassword') }}</p>
<p></p>
<p>{{ __('common.ThankYou') }}</p>
<p>
    <a href="https://drehbu.ch/" target="_blank" title="{{ __('common.GoToPortal') }}">{{ __('common.GoToPortal') }}</a>
</p>