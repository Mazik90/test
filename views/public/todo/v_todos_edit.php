<?php $values = json_decode($todo->values) ?>
<section class="todoapp">
    <header class="header">
        <h1>todos</h1>
        <input class="new-todo" placeholder="What needs to be done?" autofocus>
    </header>
    <!-- This section should be hidden by default and shown when there are todos -->
    <section class="main" style="display: none;">
        <input class="toggle-all" type="checkbox">
        <label for="toggle-all">Mark all as complete</label>
        <ul class="todo-list">
            <!-- These are here just to show the structure of the list items -->
            <!-- List items should get the class `editing` when editing and `completed` when marked as completed -->
            <?php foreach ($values as $item): ?>
                <li <?php echo $item->checked === true ? 'class="completed"' : null; ?>>
                    <div class="view">
                        <input class="toggle" type="checkbox" <?php echo $item->checked === true ? 'checked' : null; ?>>
                        <label><?php echo $item->value; ?></label>
                        <button class="destroy"></button>
                    </div>
                    <input class="edit" value="<?php echo $item->value; ?>">
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
    <!-- This footer should hidden by default and shown when there are todos -->
    <footer class="footer" <?php echo empty($values) ? 'style="display: none;"' : null; ?>>
        <!-- This should be `0 items left` by default -->
        <span class="todo-count"><strong></strong> item left</span>
        <!-- Remove this if you don't implement routing -->
        <ul class="filters">
            <li>
                <a href="#/">All</a>
            </li>
            <li>
                <a href="#/active">Active</a>
            </li>
            <li>
                <a href="#/completed">Completed</a>
            </li>
        </ul>
        <!-- Hidden if no completed items are left ↓ -->
        <button class="clear-completed">Clear completed</button>
    </footer>
    <input type="hidden" id="current-todo" value="<?php echo $todo->id; ?>">
</section>
<footer class="info">
    <p>Double-click to edit a todo</p>
    <!-- Remove the below line ↓ -->
    <p>Template by <a href="http://sindresorhus.com">Sindre Sorhus</a></p>
    <!-- Change this out with your name and url ↓ -->
    <p>Created by <a href="http://todomvc.com">you</a></p>
    <p>Part of <a href="http://todomvc.com">TodoMVC</a></p>
</footer>