<?php
/**
 * Created by PhpStorm.
 * User: andrebian
 * Date: 7/5/16
 * Time: 21:38
 */

namespace SONUser\Service;

use Doctrine\ORM\EntityManager;
use SONBase\Mail\Mail;
use SONUser\Entity\User as UserEntity;
use Zend\Hydrator\ClassMethods;
use Zend\Mail\Transport\Smtp as SmtpTransport;

/**
 * Class User
 * @package SONUser\Service
 */
class User extends AbstractService
{
    private $transport;
    private $view;

    public function __construct(EntityManager $entityManager, SmtpTransport $transport, $view)
    {
        parent::__construct($entityManager);

        $this->entity = 'SONUser\Entity\User';
        $this->transport = $transport;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function insert(array $data)
    {
        $entity = new $this->entity($data);
        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        $dataEmail = [
            'nome' => $data['name'],
            'activationKey' => $entity->getActivationKey()
        ];

        if ($entity && 'cli-server' !== php_sapi_name()) {
            $mail = new Mail($this->transport, $this->view, 'add-user');

            $mail->setSubject('Confirmação de cadastro')
                ->setTo($data['email'])
                ->setData($dataEmail)
                ->prepare()->send();
        }

        return $entity;
    }

    /**
     * @param $key
     * @return null|UserEntity
     */
    public function activate($key)
    {
        $repository = $this->entityManager->getRepository(UserEntity::class);

        /** @var UserEntity $user */
        $user = $repository->findOneBy(['activationKey' => $key]);

        if ($user && !$user->isActive()) {
            $user->setActive(true);
            $this->entityManager->flush();
            return $user;
        }
        return null;
    }

    public function update(array $data)
    {
        if (empty($data['password'])) {
            unset($data['password']);
        }

        $entity = $this->entityManager->getReference($this->entity, $data['id']);
        (new ClassMethods())->hydrate($data, $entity);

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $entity;
    }
}
