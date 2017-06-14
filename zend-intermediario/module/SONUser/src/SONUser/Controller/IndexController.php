<?php

namespace SONUser\Controller;

use SONUser\Form\User as FormUser;
use SONUser\Service\User as UserService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Class IndexController
 * @package SONUser\Controller
 */
class IndexController extends AbstractActionController
{
    public function registerAction()
    {
        $form = new FormUser();
        $request = $this->getRequest();
        $errorMessages = [];

        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {

                /** @var UserService $userService */
                $userService = $this->serviceLocator->get('SONUser\Service\User');

                $flashMessageNamespace = 'error';
                $flashMessage = 'Não foi possível inserir';

                if ($userService->insert($request->getPost()->toArray())) {
                    $flashMessageNamespace = 'success';
                    $flashMessage = 'Usuário registrado com sucesso';
                }
                $this->flashMessenger()->setNamespace($flashMessageNamespace)->addMessage($flashMessage);
                return $this->redirect()->toRoute('sonuser-register');
            } else {
                $errorMessages = $form->getMessages();
            }
        }

        return new ViewModel([
            'form' => $form,
            'errorMessages' => $errorMessages
        ]);
    }

    public function activateAction()
    {
        $response = [];
        $activationKey = $this->params()->fromRoute('key');
        /** @var UserService $userService */
        $userService = $this->serviceLocator->get(UserService::class);

        $user = $userService->activate($activationKey);

        if ($user) {
            $response = [
                'user' => $user
            ];
        }

        return new ViewModel($response);
    }
}
