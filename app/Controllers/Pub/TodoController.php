<?php

namespace App\Controllers\Pub;

use App\Models\Todo;
use System\View;

class TodoController extends BaseController
{
    public function index()
    {
        return $this->view->set([
            'title' => 'Todos list',
            'content' => $contentView = View::factory('public/base')->set([
                'content' =>  View::factory('public/todo/v_todos_list')->set([
                    'todos' => (new Todo())->getTodos($this->user->id),
                ]),
            ]),
        ]);
    }

    public function create()
    {
        (new Todo())->addTodo($this->user->id);
        header('Location: /');
    }

    public function edit()
    {
        $this->styles[] = 'assets/public/css/todo.css';

        if (!array_key_exists('todo', $_GET)) {
            header('Location: /');
        }

        $todo = (new Todo())->getTodos($this->user->id, $_GET['todo']);
        if (empty($todo)) {
            header('Location: /');
        }

        return $this->view->set([
            'title'   => 'Todos edit',
            'styles' => $this->styles,
            'content' => View::factory('public/todo/v_todos_edit')->set([
                'todo' => $todo[0],
            ]),
        ]);
    }
}