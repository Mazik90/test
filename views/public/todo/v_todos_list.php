<div class="container-fluid">
    <div class="row">
        <div class="container">
            <table class="table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>create</th>
                    <th>update</th>
                    <th>action</th>
                </tr>
                </thead>
                <tbody>
                <?php if (!empty($todos)): ?>
                    <?php foreach ($todos as $todo): ?>
                        <tr>
                            <td><?php echo $todo->name; ?></td>
                            <td><?php echo date('d-m-Y H:i:s', $todo->created_at); ?></td>
                            <td><?php echo date('d-m-Y H:i:s', $todo->updated_at); ?></td>
                            <td>
                                <button data-id="<?php echo $todo->id; ?>" type="button" class="btn btn-primary delete">delete</button>
                                <a href="<?php echo \System\Helpers\URL::site('edit') . '?todo=' . $todo->id; ?>" class="btn btn-primary">edit</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">no data</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>