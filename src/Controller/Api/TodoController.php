<?php

namespace App\Controller\Api;

use App\Repository\TodoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class TodoController extends AbstractController
{
    #[Route('/todos', name: 'todo_list')]
    public function list(TodoRepository $todoRepository): iterable
    {
        return $todoRepository->findAll();
    }
}
