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

    'accepted'             => 'O :attribute precisa ser aceito.',
    'active_url'           => 'O :attribute não é um indentificador de URL válido.',
    'after'                => 'O :attribute precisa ser posterior :date.',
    'after_or_equal'       => 'O :attribute precisa ser posterior ou igual a :date.',
    'alpha'                => 'O :attribute pode conter somente letras.',
    'alpha_dash'           => 'O :attribute pode conter somente letras, numeros, e traços.',
    'alpha_num'            => 'O :attribute pode conter somente letras, numeros.',
    'array'                => 'O :attribute precisa ser um array.',
    'before'               => 'O :attribute precisa ser uma data antes de :date.',
    'before_or_equal'      => 'TO :attribute precisa ser uma data antes ou igual a :date.',
    'between'              => [
        'numeric' => 'O :attribute precisa estar entre :min e :max.',
        'file'    => 'O :attribute precisa estar entre :min e :max kilobytes.',
        'string'  => 'O :attribute precisa estar entre :min e :max carácteres.',
        'array'   => 'O :attribute precisa ter entre :min e :max items.',
    ],
    'boolean'              => 'O :attribute campo precisa ser verdadeiro ou falso.',
    'confirmed'            => 'O :attribute não corresponde a confirmação.',
    'date'                 => 'O :attribute não é uma data válida.',
    'date_format'          => 'O :attribute não corresponde ao formato :format.',
    'different'            => 'O :attribute e :other precisam ser diferentes.',
    'digits'               => 'O :attribute precisa ser :digits digitos.',
    'digits_between'       => 'O :attribute precisa entre  :min e :max digitos.',
    'dimensions'           => 'O :attribute tem dimensões de imagem inválidos.',
    'distinct'             => 'O campo :attribute tem um valor duplicado.',
    'email'                => 'O :attribute precisa ser um endereço de email válido.',
    'exists'               => 'O :attribute selecionado está inválido.',
    'file'                 => 'O :attribute precisa ser um arquivo.',
    'filled'               => 'O :attribute campo precisa ter um valor.',
    'image'                => 'O :attribute precisa ser uma imagem.',
    'in'                   => 'O :attribute selecionado está inválido.',
    'in_array'             => 'O :attribute não existe em :other.',
    'integer'              => 'O :attribute precisa ser um inteiro.',
    'ip'                   => 'O :attribute preisa ser um endereço de IP válido.',
    'ipv4'                 => 'O :attribute preisa ser um endereço de IPv4 válido.',
    'ipv6'                 => 'O :attribute preisa ser um endereço de IPv6 válido.',
    'json'                 => 'O :attribute preisa ser um texto JSON.',
    'max'                  => [
        'numeric' => 'O :attribute não pode ser maior que :max.',
        'file'    => 'O :attribute não pode ser maior que :max kilobytes.',
        'string'  => 'O :attribute não pode ser maior que :max carácteers.',
        'array'   => 'O :attribute não pode ter mais do que :max items.',
    ],
    'mimes'                => 'O :attribute precisa ser um aqruivo ou tipo: :values.',
    'mimetypes'            => 'O :attribute precisa ser um aqruivo ou tipo: :values.',
    'min'                  => [
        'numeric' => 'O :attribute precisa ser pelo menos :min.',
        'file'    => 'O :attribute precisa ser pelo menos :min kilobytes.',
        'string'  => 'O :attribute precisa ser pelo menos :min characters.',
        'array'   => 'O :attribute precisa ter pelo menos :min items.',
    ],
    'not_in'               => 'O :attribute selecionado é inválido.',
    'numeric'              => 'O :attribute precisa ser um número.',
    'present'              => 'O :attribute precisa estar presente.',
    'regex'                => 'O :attribute formato está inválido.',
    'required'             => 'O campo :attribute é obrigatório.',
    'required_if'          => 'O campo :attribute é obrigatótio quando :other é :value.',
    'required_unless'      => 'O campo :attribute é obrigatóriomenos que :other está em :values.',
    'required_with'        => 'O campo :attribute é obrigatório quando :values estão presente.',
    'required_with_all'    => 'O campo :attribute é obrigatório quando :values estão presente.',
    'required_without'     => 'O campo :attribute é obrigatório quando :values não estão presente.',
    'required_without_all' => 'O campo :attribute é obrigatório quando nenhum dos :values estão presentes.',
    'same'                 => 'O :attribute and :other must match.',
    'size'                 => [
        'numeric' => 'O :attribute precisa ser :size.',
        'file'    => 'O :attribute precisa ser :size kilobytes.',
        'string'  => 'O :attribute precisa ser :size carácteres.',
        'array'   => 'O :attribute precisa conter :size items.',
    ],
    'string'               => 'O :attribute precisa ser uma string.',
    'timezone'             => 'O :attribute precisa ser um valid zone.',
    'unique'               => 'O :attribute já possui na base,valor precisa ser único.',
    'uploaded'             => 'O :attribute falhou ao carregar.',
    'url'                  => 'O :attribute formato está inválido.',

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
        ]
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
    ],

];
