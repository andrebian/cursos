<?php

namespace SONUser\Form;

use Zend\Form\Element\Csrf;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Password;
use Zend\Form\Element\Text;
use Zend\Form\Form;

/**
 * Class User
 * @package SONUser\Form
 */
class User extends Form
{
    public function __construct($name = 'user', $options = [])
    {
        parent::__construct($name);

        $this->setAttribute('method', 'POST');
        $this->setAttribute('role', 'form');
        $this->setInputFilter(new UserFilter());

        $id = new Hidden('id');
        $this->add($id);

        $name = new Text('name');
        $name->setLabel('Nome: ')->setAttribute('placeholder', 'Entre com o nome')
            ->setAttribute('class', 'form-control');
        $this->add($name);

        $email = new Text('email');
        $email->setLabel('Email: ')->setAttribute('placeholder', 'Entre com o email')
            ->setAttribute('class', 'form-control');
        $this->add($email);

        $password = new Password('password');
        $password->setLabel('Password: ')->setAttribute('placeholder', 'Entre com a senha')
            ->setAttribute('class', 'form-control');
        $this->add($password);

        $passwordConfirm = new Password('password_confirmation');
        $passwordConfirm->setLabel('Confirme a senha: ')->setAttribute('placeholder', 'Confirme a senha')
            ->setAttribute('class', 'form-control');
        $this->add($passwordConfirm);

        $csrf = new Csrf('security');
        $this->add($csrf);

        $this->add([
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => [
                'value' => 'Salvar',
                'class' => 'btn btn-success'
            ]
        ]);
    }
}
