<?php

namespace App\Controllers\Pub\Ajax;

use App\Models\Todo;

class TodoController extends BaseAjaxController
{
    /** @var \App\Models\Todo */
    private $todo;

    public function __construct()
    {
        parent::__construct();

        $this->todo = new Todo();
    }

    public function delete()
    {
        $this->todo->delete($this->user->id, $_POST['id']);
        return json_encode(true);
    }

    public function update()
    {
        $this->todo->updateValue($this->user->id, $_POST['id'], $_POST['value']);
        return json_encode(true);
    }
}