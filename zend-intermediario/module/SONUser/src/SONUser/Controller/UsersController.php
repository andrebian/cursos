<?php

namespace SONUser\Controller;

use SONUser\Entity\EntityInterface;
use SONUser\Entity\User as UserEntity;
use SONUser\Form\User as UserForm;
use SONUser\Service\ServiceInterface;
use SONUser\Service\User as UserService;
use Zend\View\Model\ViewModel;

/**
 * Class UsersController
 * @package SONUser\Controller
 */
class UsersController extends CrudController
{
    public function __construct()
    {
        $this->entity = UserEntity::class;
        $this->form = UserForm::class;
        $this->service = UserService::class;
        $this->controller = 'sonusercontrollerusers';
        $this->route = 'sonuser-admin';
    }

    /**
     * @return \Zend\Http\Response
     */
    public function editAction()
    {
        $id = $this->params()->fromRoute('id');
        $form = new $this->form();
        $request = $this->getRequest();

        /** @var EntityInterface $entity */
        $entity = $this->getEntityManager()->find($this->entity, $id);
        if ($entity) {
            $array = $entity->toArray();
            unset($array['password']);
            $form->setData($array);
        }

        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                /** @var ServiceInterface $service */
                $service = $this->serviceLocator->get($this->service);
                $data = $request->getPost()->toArray();
                if (isset($data['password']) && empty($data['password'])) {
                    unset($data['password']);
                }
                $service->update($data);
                return $this->redirect()->toRoute($this->route, ['controller' => $this->controller]);
            }
        }

        return new ViewModel([
            'form' => $form,
            'id' => $id
        ]);
    }
}
