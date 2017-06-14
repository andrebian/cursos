<?php

use App\Entity\Post;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response;

$map->get('posts.list', '/posts', function ($request, $response) use ($view, $entityManager) {

    $repository = $entityManager->getRepository(Post::class);
    $posts = $repository->findAll();

    return $view->render($response, 'posts/list.phtml', [
        'posts' => $posts
    ]);
});

$map->get('posts.create', '/posts/create', function ($request, $response) use ($view) {
    return $view->render($response, 'posts/create.phtml');
});

$map->post('posts.store', '/posts/store', function (ServerRequestInterface $request) use ($view, $entityManager, $generator) {
    $data = $request->getParsedBody();
    $post = new Post();
    $post->setTitle($data['title'])->setContent($data['content']);

    $entityManager->persist($post);
    $entityManager->flush();

    $uri = $generator->generate('posts.list');
    return new Response\RedirectResponse($uri);
});

$map->get('posts.edit', '/posts/{id}/edit', function (ServerRequestInterface $request, $response) use ($view, $entityManager) {
    $id = (int)$request->getAttribute('id', 0);
    $post = $entityManager->find(Post::class, $id);
    return $view->render($response, 'posts/edit.phtml', [
        'post' => $post
    ]);
});

$map->post('posts.update', '/posts/{id}/update', function (ServerRequestInterface $request) use ($view, $entityManager, $generator) {

    $id = (int)$request->getAttribute('id', 0);
    $post = $entityManager->find(Post::class, $id);

    $data = $request->getParsedBody();
    $post->setTitle($data['title'])->setContent($data['content']);

    $entityManager->flush();

    $uri = $generator->generate('posts.list');
    return new Response\RedirectResponse($uri);
});

$map->get('posts.remove', '/posts/{id}/remove', function (ServerRequestInterface $request) use ($view, $entityManager, $generator) {

    $id = (int)$request->getAttribute('id', 0);
    $post = $entityManager->find(Post::class, $id);

    $entityManager->remove($post);
    $entityManager->flush();

    $uri = $generator->generate('posts.list');
    return new Response\RedirectResponse($uri);
});