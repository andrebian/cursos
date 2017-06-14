<?php

namespace SONUser\Form;

use Zend\InputFilter\InputFilter;

/**
 * Class UserFilter
 * @package SONUser\Form
 */
class UserFilter extends InputFilter
{
    public function __construct()
    {
        $this->add([
            'name' => 'name',
            'required' => true,
            'filters' => [
                [
                    'name' => 'StripTags',
                ],
                [
                    'name' => 'StringTrim',
                ]
            ],
            'validators' => [
                [
                    'name' => 'NotEmpty',
                    'options' => [
                        'isEmpty' => 'Não pode estar em branco'
                    ]
                ]
            ]
        ]);

        $this->add([
            'name' => 'email',
            'required' => true,
            'filters' => [
                [
                    'name' => 'StripTags',
                ],
                [
                    'name' => 'StringTrim',
                ]
            ],
            'validators' => [
                [
                    'name' => 'EmailAddress',
                    'options' => [
                        'useDomainCheck' => false
                    ]
                ]
            ]
        ]);

        $this->add([
            'name' => 'password',
            'required' => true,
            'filters' => [
                [
                    'name' => 'StripTags',
                ],
                [
                    'name' => 'StringTrim',
                ]
            ],
            'validators' => [
                [
                    'name' => 'NotEmpty',
                    'options' => [
                        'isEmpty' => 'Não pode estar em branco'
                    ]
                ]
            ]
        ]);

        $this->add([
            'name' => 'password_confirmation',
            'required' => true,
            'filters' => [
                [
                    'name' => 'StripTags',
                ],
                [
                    'name' => 'StringTrim',
                ]
            ],
            'validators' => [
                [
                    'name' => 'NotEmpty',
                    'options' => [
                        'isEmpty' => 'Não pode estar em branco'
                    ]
                ],
                [
                    'name' => 'Identical',
                    'options' => [
                        'token' => 'password'
                    ]
                ]
            ]
        ]);
    }
}
