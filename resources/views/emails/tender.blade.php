<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
    xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="utf-8"> <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldn't be necessary -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting"> <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <meta name="format-detection" content="telephone=no,address=no,email=no,date=no,url=no">
    <!-- Tell iOS not to automatically link certain text strings. -->
    <title>{{ __('common.NewTender') }}!</title> <!-- The title tag shows in email notifications, like Android 4.4. -->
    @include('emails.style')
</head>
<!--
	The email background color (#222222) is defined in three places:
	1. body tag: for most email clients
	2. center tag: for Gmail and Inbox mobile apps and web versions of Gmail, GSuite, Inbox, Yahoo, AOL, Libero, Comcast, freenet, Mail.ru, Orange.fr
	3. mso conditional: For Windows 10 Mail
-->

<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #222222;">
    <center style="width: 100%; background-color: #222222;">
        <!--[if mso | IE]>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #222222;">
    <tr>
    <td>
    <![endif]-->

        <!-- Visually Hidden Preheader Text : BEGIN -->
        <div
            style="display: none; font-size: 1px; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
            {{ __('common.NewTendersDescription') }}
        </div>
        <!-- Visually Hidden Preheader Text : END -->

        <!-- Create white space after the desired preview text so email clients don’t pull other distracting text into the inbox preview. Extend as necessary. -->
        <!-- Preview Text Spacing Hack : BEGIN -->
        <div
            style="display: none; font-size: 1px; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
            &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
        </div>
        <!-- Preview Text Spacing Hack : END -->

        <!--
            Set the email width. Defined in two places:
            1. max-width for all clients except Desktop Windows Outlook, allowing the email to squish on narrow but never go wider than 600px.
            2. MSO tags for Desktop Windows Outlook enforce a 600px width.
        -->
        <div style="max-width: 600px; margin: 0 auto;" class="email-container">
            <!--[if mso]>
            <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="600">
            <tr>
            <td>
            <![endif]-->

            <!-- Email Body : BEGIN -->
            <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"
                style="margin: auto;">
                <!-- Email Header : BEGIN -->

                <tr>
                    <td style="padding: 20px 0; text-align: center">

                    </td>
                </tr>

                <!-- Email Header : END -->

                <!-- Hero Image, Flush : BEGIN -->
                <tr>
                    <td style="background-color: #ffffff;">
                        <img src="https://www.kbve.ch/images/grundbildung/organisation-1200x600.jpg" width="600"
                            height="" alt="alt_text" border="0"
                            style="width: 100%; max-width: 600px; height: auto; background: #dddddd; font-family: sans-serif; font-size: 15px; line-height: 15px; color: #555555; margin: auto; display: block;"
                            class="g-img">
                    </td>
                </tr>
                <!-- Hero Image, Flush : END -->

                <!-- 1 Column Text + Button : BEGIN -->
                <tr>
                    <td style="background-color: #ffffff;">
                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                            <tr>
                                <td
                                    style="padding: 20px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;">
                                    <h1
                                        style="margin: 0 0 10px 0; font-family: sans-serif; font-size: 25px; line-height: 30px; color: #333333; font-weight: normal;">
                                        {{ __('common.NewTender') }} {{ $event->course->alias }}</h1>
                                    <p style="margin: 0;">{{ __('common.NewTendersDescription') }}.</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 0 20px;">
                                    <!-- Button : BEGIN -->
                                    <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0"
                                        style="margin: auto;">
                                        <tr>
                                            <td class="button-td button-td-primary"
                                                style="border-radius: 4px; background: #0665d0;">
                                                <a class="button-a button-a-primary" href="https://drehbu.ch/"
                                                    style="background: #0665d0; border: 1px solid #0665d0; font-family: sans-serif; font-size: 15px;line-height: 15px; text-decoration: none; padding: 13px 17px; color: #ffffff; display: block; border-radius: 4px;">
                                                    {{ __('common.GoToPortal') }}
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- Button : END -->
                                    <br><br>
                                </td>
                            </tr>



                        </table>
                    </td>
                </tr>
                <!-- 1 Column Text + Button : END -->

                <!-- 2 Even Columns : BEGIN -->
                {{--
                <tr>
                    <td style="padding: 0 10px 40px 10px; background-color: #ffffff;">
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td valign="top" width="50%">
                                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                        <tr>
                                            <td style="text-align: center; padding: 0 10px;">
                                                <img src="https://via.placeholder.com/200" width="200" height=""
                                                    alt="alt_text" border="0"
                                                    style="width: 100%; max-width: 200px; background: #dddddd; font-family: sans-serif; font-size: 15px; line-height: 15px; color: #555555;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td
                                                style="text-align: left; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; padding: 10px 10px 0;">
                                                <p style="margin: 0;">Maecenas sed ante pellentesque, posuere leo id,
                                                    eleifend dolor.</p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td valign="top" width="50%">
                                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                        <tr>
                                            <td style="text-align: center; padding: 0 10px;">
                                                <img src="https://via.placeholder.com/200" width="200" height=""
                                                    alt="alt_text" border="0"
                                                    style="width: 100%; max-width: 200px; background: #dddddd; font-family: sans-serif; font-size: 15px; line-height: 15px; color: #555555;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td
                                                style="text-align: left; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; padding: 10px 10px 0;">
                                                <p style="margin: 0;">Maecenas sed ante pellentesque, posuere leo id,
                                                    eleifend dolor.</p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                --}}
                <!-- Two Even Columns : END -->

                <!-- Clear Spacer : BEGIN -->
                <tr>
                    <td aria-hidden="true" height="40" style="font-size: 0px; line-height: 0px;">
                        &nbsp;
                    </td>
                </tr>
                <!-- Clear Spacer : END -->

                <!-- 1 Column Text : BEGIN -->
                <tr>
                    <td style="background-color: #ffffff;">
                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                            <tr>
                                <td
                                    style="padding: 20px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;">
                                    <h1
                                        style="margin: 0 0 30px 0; font-family: sans-serif; font-size: 25px; line-height: 30px; color: #333333; font-weight: normal;">
                                        {{ $event->name }}</h1>
                                    <p style="margin: 0;">
                                        {{ $event->description }}
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td style="background-color: #ffffff;">
                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                            <tr>
                                <td
                                    style="padding: 20px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;">
                                    <h1
                                        style="margin: 0 0 30px 0; font-family: sans-serif; font-size: 25px; line-height: 30px; color: #333333; font-weight: normal;">
                                        {{ __('common.Occurrences') }}</h1>


                                    <ul style="padding: 0; margin: 0 0 10px 0; list-style-type: disc;">

                                        @foreach ($event->occurrences as $occurrence)
                                        <li style="margin:0 0 10px 30px;">
                                            {{ Carbon::parse($occurrence->date)->format('d.m.Y')}}
                                            {{ Carbon::parse($occurrence->start_time)->format('H:i')}} -
                                            {{ Carbon::parse($occurrence->end_time)->format('H:i')}}</li>
                                        @endforeach

                                    </ul>

                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- 1 Column Text : END -->

                <!-- 1 Column Text : BEGIN -->
                <tr>
                    <td style="background-color: #ffffff;">
                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                            <tr>
                                <td
                                    style="padding: 20px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;">
                                    <h1
                                        style="margin: 0 0 30px 0; font-family: sans-serif; font-size: 25px; line-height: 30px; color: #333333; font-weight: normal;">
                                        {{ __('common.Objectives') }}</h1>


                                    <ul style="padding: 0; margin: 0 0 10px 0; list-style-type: disc;">

                                        @foreach ($event->course->objectives as $objective)
                                        <li style="margin:0 0 10px 30px;">{{ $objective->name }}</li>
                                        @endforeach

                                    </ul>

                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- 1 Column Text : BEGIN -->
                <tr>
                    <td style="background-color: #ffffff;">
                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                            <tr>
                                <td
                                    style="padding: 20px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;">
                                    <h1
                                        style="margin: 0 0 30px 0; font-family: sans-serif; font-size: 25px; line-height: 30px; color: #333333; font-weight: normal;">
                                        {{ $event->groups()->first()->count() }} {{ __('common.Participants') }}
                                        {{ $event->groups()->first()->alias }}</h1>


                                    <ul style="padding: 0; margin: 0 0 10px 0; list-style-type: disc;">

                                        @foreach ($event->groups()->first()->students as $student)
                                        <li style="margin:0 0 10px 30px;">{{ $student->last_name }}
                                            {{ $student->first_name }}</li>
                                        @endforeach

                                    </ul>

                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>


            </table>
            <!-- Email Body : END -->

            <!-- Email Footer : BEGIN -->
            <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"
                style="margin: auto;">
                <tr>
                    <td
                        style="padding: 20px; font-family: sans-serif; font-size: 12px; line-height: 15px; text-align: center; color: #888888;">
                        {{--<webversion style="color: #cccccc; text-decoration: underline; font-weight: bold;">{{ __('common.GoToPortal') }}
                        </webversion>--}}

                        {{ $client->name }} {{ $client->extension }}<br><span class="unstyle-auto-detected-links">
                            {{ $client->locations()->pluck('street')->first()}}
                            {{ $client->locations()->pluck('street_number')->first()}}
                            {{ $client->locations()->pluck('zip')->first()}}
                            {{ $client->locations()->pluck('city')->first()}}
                            <br>{{ $client->phone }}</span>
                        <br><br>
                        {{-- <unsubscribe style="color: #888888; text-decoration: underline;">unsubscribe</unsubscribe> --}}
                    </td>
                </tr>
            </table>
            <!-- Email Footer : END -->

            <!--[if mso]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </div>

        <!-- Full Bleed Background Section : BEGIN -->
        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"
            style="background-color: #709f2b;">
            <tr>
                <td>
                    <div align="center" style="max-width: 600px; margin: auto;" class="email-container">
                        <!--[if mso]>
                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="600" align="center">
                        <tr>
                        <td>
                        <![endif]-->
                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                            <tr>
                                <td
                                    style="padding: 20px; text-align: left; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #ffffff;">
                                    <p style="margin: 0;">Diese Benachrichtigung wird automatisch versendet. Antworten
                                        Sie nicht darauf. Allfällige Unstimmigkeiten bitten wir Sie, uns zu melden. Sie
                                        erhalten die Benachrichtigung zu jeder Veranstaltung, die ausgeschrieben wird.
                                        Möchten Sie keine Benachrichtigungen erhalten? Geben Sie uns das bitte Bescheid.
                                    </p>
                                </td>
                            </tr>
                        </table>
                        <!--[if mso]>
                        </td>
                        </tr>
                        </table>
                        <![endif]-->
                    </div>
                </td>
            </tr>
        </table>
        <!-- Full Bleed Background Section : END -->

        <!--[if mso | IE]>
    </td>
    </tr>
    </table>
    <![endif]-->
    </center>
</body>

</html>