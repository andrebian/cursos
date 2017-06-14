<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TaskController
 * @package AppBundle\Controller
 */
class TaskController extends Controller
{
    /**
     * @Route("/tasks/{name}")
     *
     * @param $name
     * @return Response
     */
    public function indexAction($name)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $tasks = $entityManager->getRepository(Task::class)->findAll();

        return $this->render(':task:index.html.twig', [
            'name' => $name,
            'tasks' => $tasks
        ]);
    }

    /**
     * @Route("/tasks.json")
     * @Method("get")
     */
    public function apiAction()
    {
        $tasks = [
            'Call Fabiane',
            'Follow up Gabriel',
            'Pay Hostgator'
        ];

        return new JsonResponse($tasks);
    }

    /**
     * @Route("/task/show/{id}", name="task-show")
     */
    public function showAction($id)
    {
        return $this->render(':task:show.html.twig');
    }

    /**
     * @Route("/task/create")
     * @return Response
     */
    public function newAction()
    {
        $task = new Task();
        $task->setName('My task #' . uniqid())->setFinished(true)->setDueDate(new DateTime());

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($task);
        $entityManager->flush();

        return new Response('<html><body>Task has been created</body></html>');
    }
}
