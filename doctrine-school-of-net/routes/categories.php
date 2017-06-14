<?php

use App\Entity\Category;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response;

$map->get('categories.list', '/categories', function ($request, $response) use ($view, $entityManager) {

    $repository = $entityManager->getRepository(Category::class);
    $categories = $repository->findAll();

    return $view->render($response, 'categories/list.phtml', [
        'categories' => $categories
    ]);
});

$map->get('categories.create', '/categories/create', function ($request, $response) use ($view) {
    return $view->render($response, 'categories/create.phtml');
});

$map->post('categories.store', '/categories/store', function (ServerRequestInterface $request) use ($view, $entityManager, $generator) {
    $data = $request->getParsedBody();
    $category = new Category();
    $category->setName($data['name']);

    $entityManager->persist($category);
    $entityManager->flush();

    $uri = $generator->generate('categories.list');
    return new Response\RedirectResponse($uri);
});

$map->get('categories.edit', '/categories/{id}/edit', function (ServerRequestInterface $request, $response) use ($view, $entityManager) {
    $id = (int)$request->getAttribute('id', 0);
    $category = $entityManager->find(Category::class, $id);
    return $view->render($response, 'categories/edit.phtml', [
        'category' => $category
    ]);
});

$map->post('categories.update', '/categories/{id}/update', function (ServerRequestInterface $request) use ($view, $entityManager, $generator) {

    $id = (int)$request->getAttribute('id', 0);
    $category = $entityManager->find(Category::class, $id);

    $data = $request->getParsedBody();
    $category->setName($data['name']);

    $entityManager->flush();

    $uri = $generator->generate('categories.list');
    return new Response\RedirectResponse($uri);
});

$map->get('categories.remove', '/categories/{id}/remove', function (ServerRequestInterface $request) use ($view, $entityManager, $generator) {

    $id = (int)$request->getAttribute('id', 0);
    $category = $entityManager->find(Category::class, $id);

    $entityManager->remove($category);
    $entityManager->flush();

    $uri = $generator->generate('categories.list');
    return new Response\RedirectResponse($uri);
});
