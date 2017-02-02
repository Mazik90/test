<?php

namespace App\Models;

use System\Facades\DB;

class Todo
{
    public function getTodos($userId, $todoId = null){
        $queryString = 'select * from todos where user_id = :user_id';

        $parameters = [
            'user_id' => (int)$userId,
        ];

        if ($todoId !== null) {
            $queryString .= ' and id = :todo_id';
            $parameters['todo_id'] = (int)$todoId;
        }

        return DB::select($queryString, $parameters);
    }

    public function addTodo($userId)
    {
        $lastTodo = DB::select('select count(*) as count from todos');
        $time = time();

        DB::insert('insert into todos (`name`, user_id, `values`, created_at, updated_at) values (:name, :user_id, :values, :created_at, :updated_at)', [
            'name'       => 'todo №' . ($lastTodo[0]->count + 1),
            'user_id'    => (int)$userId,
            'values'     => '[]',
            'created_at' => $time,
            'updated_at' => $time,
        ]);
    }

    public function delete($userId, $todoId)
    {
        DB::delete('delete from todos where user_id = :user_id and id = :todo_id', [
            'user_id' => (int)$userId,
            'todo_id' => (int)$todoId,
        ]);
    }

    public function updateValue($userId, $todoId, $value)
    {
        DB::update('update todos set `values` = :value where user_id = :user_id and id = :todo_id', [
            'value'   => strip_tags($value),
            'user_id' => (int)$userId,
            'todo_id' => (int)$todoId,
        ]);
    }
}