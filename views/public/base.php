<header>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="container">
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo \System\Helpers\URL::site('create'); ?>">add todo</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="<?php echo \System\Helpers\URL::site('auth/logout'); ?>"><i class="glyphicon glyphicon-off"></i> Exit</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<section id="content">
    <?php echo isset($content) ? $content : null; ?>
</section>