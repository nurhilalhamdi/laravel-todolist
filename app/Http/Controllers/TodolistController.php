<?php

namespace App\Http\Controllers;

use App\Services\TodolistService;
use Illuminate\Http\Request;

class TodolistController extends Controller
{

    private TodolistService $todolistService;

    public function __construct(TodolistService $todolistService)
    {
        $this->todolistService = $todolistService;
    }

    public function todoList(Request $request)
    {
        $todolist = $this->todolistService->getTodo();
        return response()->view("todolist.todolist", [
            "title" => "Todolist",
            "todolist" => $todolist
        ]);
    }

    public function addTodo(Request $request)
    {
        $todo = $request->input("todo");

        if (empty($todo)) {
            $todolist = $this->todolistService->getTodo();

            return response()->view("todolist.todolist", [
                "title" => "Todolist",
                "todolist" => $todolist,
                "error" => "Todo is required",
            ]);
        }

        $this->todolistService->saveTodo(uniqid(), $todo);

        return redirect()->action([TodolistController::class, 'todolist']);
    }

    public function removeTodo(Request $request, string $todoId)
    {
        $this->todolistService->removeTodo($todoId);
        return redirect()->action([TodolistController::class, 'todolist']);
    }

    public function editTodo(Request $request, string $todoId)
    {
        $todo = $request->input('todo_edit');
        // Check if $todo is null before calling the service method
        if ($todo !== null) {
            $this->todolistService->editTodo($todoId, $todo);
        }
        return redirect()->action([TodolistController::class, 'todolist']);
    }
}
