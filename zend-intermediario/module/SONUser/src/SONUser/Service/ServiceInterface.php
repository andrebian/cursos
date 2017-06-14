<?php

namespace SONUser\Service;

/**
 * Class ServiceInterface
 * @package SONUser\Service
 */
interface ServiceInterface
{
    /**
     * @param array $data
     * @return mixed
     */
    public function insert(array $data);

    /**
     * @param array $data
     * @return mixed
     */
    public function update(array $data);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);
}
