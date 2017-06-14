<?php

namespace SONUser\Entity;

use Zend\Hydrator\ClassMethods;

/**
 * Class BaseEntity
 * @package SONUser\Entity
 */
class BaseEntity implements EntityInterface
{
    public function toArray()
    {
        $hydrator = new ClassMethods(false);
        return $hydrator->extract($this);
    }
}
