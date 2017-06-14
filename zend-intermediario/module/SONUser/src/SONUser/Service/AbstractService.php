<?php

namespace SONUser\Service;

use Doctrine\ORM\EntityManager;
use Zend\Hydrator\ClassMethods;

/**
 * Class AbstractService
 * @package SONUser\Service
 */
abstract class AbstractService implements ServiceInterface
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var
     */
    protected $entity;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
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

        return $entity;
    }

    /**
     * @param array $data
     * @return bool|\Doctrine\Common\Proxy\Proxy|null|object
     * @throws \Doctrine\ORM\ORMException
     */
    public function update(array $data)
    {
        $entity = $this->entityManager->getReference($this->entity, $data['id']);
        (new ClassMethods())->hydrate($data, $entity);

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $entity;
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Doctrine\ORM\ORMException
     */
    public function delete($id)
    {
        $entity = $this->entityManager->getReference($this->entity, $id);
        if ($entity) {
            $this->entityManager->remove($entity);
            $this->entityManager->flush();
            return $id;
        }
    }
}
