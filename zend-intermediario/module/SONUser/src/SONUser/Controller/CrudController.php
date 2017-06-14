<?php

namespace SONUser\Controller;

use Doctrine\ORM\EntityManager;
use SONUser\Entity\EntityInterface;
use SONUser\Service\ServiceInterface;
use Zend\Form\Form;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Paginator\Paginator;
use Zend\View\Model\ViewModel;

/**
 * Class CrudController
 * @package SONUser\Controller
 */
abstract class CrudController extends AbstractActionController
{

    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var ServiceInterface
     */
    protected $service;

    /**
     * @var EntityInterface
     */
    protected $entity;

    /**
     * @var Form
     */
    protected $form;

    /**
     * @var string
     */
    protected $route;

    /**
     * @var string
     */
    protected $controller;

    /**
     * @return ViewModel
     */
    public function indexAction()
    {
        $list = $this->getEntityManager()->getRepository($this->entity)->findAll();
        $page = $this->params()->fromRoute('page', 1);

        $paginator = new Paginator(new ArrayAdapter($list));
        $paginator->setCurrentPageNumber($page);
        $paginator->setDefaultItemCountPerPage(30);

        return new ViewModel([
            'data' => $paginator,
            'page' => $page
        ]);
    }

    /**
     * @return \Zend\Http\Response
     */
    public function newAction()
    {
        $form = new $this->form();
        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $service = $this->serviceLocator->get($this->service);
                $service->insert($request->getPost()->toArray());
                return $this->redirect()->toRoute($this->route, ['controller' => $this->controller]);
            }
        }

        return new ViewModel([
            'form' => $form
        ]);
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
            $form->setData($entity->toArray());
        }

        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                /** @var ServiceInterface $service */
                $service = $this->serviceLocator->get($this->service);
                $service->update($request->getPost()->toArray());
                return $this->redirect()->toRoute($this->route, ['controller' => $this->controller]);
            }
        }

        return new ViewModel([
            'form' => $form
        ]);
    }

    /**
     * @return \Zend\Http\Response
     */
    public function deleteAction()
    {
        /** @var ServiceInterface $service */
        $service = $this->serviceLocator->get($this->service);
        if ($service->delete($this->params()->fromRoute('id', 0))) {
            return $this->redirect()->toRoute($this->route, ['controller' => $this->controller]);
        }
    }

    /**
     * @return array|EntityManager|object
     */
    protected function getEntityManager()
    {
        if (null === $this->entityManager) {
            $this->entityManager = $this->serviceLocator->get(EntityManager::class);
        }
        return $this->entityManager;
    }
}
