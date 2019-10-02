<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'Das :attribute muss akzeptiert werden.',
    'active_url'           => 'Das :attribute ist keine gültige URL.',
    'after'                => 'Das :attribute muss ein Datum sein später als :date.',
    'after_or_equal'       => 'Das :attribute muss ein Datum sein später oder gleich :date.',
    'alpha'                => 'Das :attribute darf nur Buchstaben enthalten.',
    'alpha_dash'           => 'Das :attribute darf nur Buchstaben, Ziffern, Bindestriche and Unterstriche enthalten.',
    'alpha_num'            => 'Das :attribute darf nur Buchstaben und Ziffern enthalten.',
    'array'                => 'Das :attribute muss vom Typ Array sein.',
    'before'               => 'Das :attribute muss ein Datum sein vor :date.',
    'before_or_equal'      => 'Das :attribute muss ein Datum sein vor oder gleich :date.',
    'between'              => [
        'numeric' => 'Das :attribute muss zwischen :min und :max sein.',
        'file'    => 'Das :attribute muss zwischen :min und :max kilobytes.',
        'string'  => 'Das :attribute muss zwischen :min und :max Zeichen.',
        'array'   => 'Das :attribute muss zwischen :min und :max Objekte enthalten.',
    ],
    'boolean'              => 'Das :attribute Feld muss wahr oder falsch sein (true/false).',
    'confirmed'            => 'Das :attribute stimmt nicht mit der Bestätigung überein.',
    'date'                 => 'Das :attribute ist kein gültiges Datum.',
    'date_format'          => 'Das :attribute hat kein gültiges Format :format.',
    'different'            => 'Das :attribute und :other dürfen nicht identisch sein.',
    'digits'               => 'Das :attribute muss :digits sein.',
    'digits_between'       => 'Das :attribute muss zwischen :min und :max liegen.',
    'dimensions'           => 'Das :attribute hat ungültige Dimensionen.',
    'distinct'             => 'Das :attribute enthält doppelte Werte.',
    'email'                => 'Das :attribute ist keine gültige Email Adresse.',
    'exists'               => 'Das gewählte :attribute ist ungültig.',
    'file'                 => 'Das :attribute muss eine Datei sein.',
    'filled'               => 'Das :attribute muss einen Wert enthalten.',
    'gt'                   => [
        'numeric' => 'Das :attribute must be greater than :value.',
        'file'    => 'Das :attribute must be greater than :value kilobytes.',
        'string'  => 'Das :attribute must be greater than :value characters.',
        'array'   => 'Das :attribute must have more than :value items.',
    ],
    'gte'                  => [
        'numeric' => 'Das :attribute must be greater than or equal :value.',
        'file'    => 'Das :attribute must be greater than or equal :value kilobytes.',
        'string'  => 'Das :attribute must be greater than or equal :value characters.',
        'array'   => 'Das :attribute must have :value items or more.',
    ],
    'image'                => 'Das :attribute must be an image.',
    'in'                   => 'The selected :attribute is invalid.',
    'in_array'             => 'Das :attribute field does not exist in :other.',
    'integer'              => 'Das :attribute must be an integer.',
    'ip'                   => 'Das :attribute must be a valid IP address.',
    'ipv4'                 => 'Das :attribute must be a valid IPv4 address.',
    'ipv6'                 => 'Das :attribute must be a valid IPv6 address.',
    'json'                 => 'Das :attribute must be a valid JSON string.',
    'lt'                   => [
        'numeric' => 'Das :attribute must be less than :value.',
        'file'    => 'Das :attribute must be less than :value kilobytes.',
        'string'  => 'Das :attribute must be less than :value characters.',
        'array'   => 'Das :attribute must have less than :value items.',
    ],
    'lte'                  => [
        'numeric' => 'Das :attribute must be less than or equal :value.',
        'file'    => 'Das :attribute must be less than or equal :value kilobytes.',
        'string'  => 'Das :attribute must be less than or equal :value characters.',
        'array'   => 'Das :attribute must not have more than :value items.',
    ],
    'max'                  => [
        'numeric' => 'Das :attribute may not be greater than :max.',
        'file'    => 'Das :attribute may not be greater than :max kilobytes.',
        'string'  => 'Das :attribute may not be greater than :max characters.',
        'array'   => 'Das :attribute may not have more than :max items.',
    ],
    'mimes'                => 'Das :attribute must be a file of type: :values.',
    'mimetypes'            => 'Das :attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => 'Das :attribute must be at least :min.',
        'file'    => 'Das :attribute must be at least :min kilobytes.',
        'string'  => 'Das :attribute must be at least :min characters.',
        'array'   => 'Das :attribute must have at least :min items.',
    ],
    'not_in'               => 'The selected :attribute is invalid.',
    'not_regex'            => 'Das :attribute format is invalid.',
    'numeric'              => 'Das :attribute must be a number.',
    'present'              => 'Das :attribute field must be present.',
    'regex'                => 'Das :attribute format is invalid.',
    'required'             => 'Feld :attribute ist erforderlich.',
    'required_if'          => 'Feld :attribute ist erforderlich, wenn :other ist :value.',
    'required_unless'      => 'Das :attribute ist erforderlich unless :other ist in :values.',
    'required_with'        => 'Das :attribute ist erforderlich, wenn :values ist vorhanden.',
    'required_with_all'    => 'Das :attribute ist erforderlich, wenn :values ist vorhanden.',
    'required_without'     => 'Das :attribute ist erforderlich, wenn :values is nicht vorhanden.',
    'required_without_all' => 'Das :attribute ist erforderlich, wenn keine der :values vorhanden sind.',
    'same'                 => 'Felder :attribute und :other müssen übereinstimmen.',
    'size'                 => [
        'numeric' => 'Das :attribute must be :size.',
        'file'    => 'Das :attribute must be :size kilobytes.',
        'string'  => 'Das :attribute must be :size characters.',
        'array'   => 'Das :attribute must contain :size items.',
    ],
    'string'               => 'Das :attribute must be a string.',
    'timezone'             => 'Das :attribute must be a valid zone.',
    'unique'               => 'Das :attribute has already been taken.',
    'uploaded'             => 'Das :attribute failed to upload.',
    'url'                  => 'Das :attribute format is invalid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'salutation' => '«Anrede»',
        'alias' => '«Alias»',
        'days' => '«Tage»',
        'day' => '«Tag»',
        'start_time' => '«Beginnt um»',
        'end_time' => '«Endet um»',
        'start_date' => '«Beginnt am»',
        'end_date' => '«Endet am»',
        'name' => '«Name»',
        'description' => '«Beschreibung»',
        'course_id' => '«Kurs/Modul»',
        'study_id' => '«Lehrgang»',
        'client_id' => '«Person»',
        'type_id' => '«Kategorie»',
        'person_id' => '«Person»',
        'user_id' => '«Benutzer»',
        'email' => '«Email»',
        'color' => '«Farbe»',
        'active' => '«Aktiv»',
        'street' => '«Strasse»',
        'street_number' => '«Strassennummer»',
        'zip' => '«PLZ»',
        'city' => '«Ort»',
        'locationable_type' => '«Name»',
        'locationable_id' => '«ID»',
        'period_id' => '«Periode»',
        'room_id' => '«Raum»',
        'group_id' => '«Gruppe»',
    ],

];
