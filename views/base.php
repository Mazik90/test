<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title ?></title>
    <?php if (isset($styles)): ?>
        <?php foreach ($styles as $style): ?>
            <link rel="stylesheet" href="<?php echo \System\Helpers\URL::asset($style) ?>">
        <?php endforeach; ?>
    <?php endif; ?>
</head>
<body>
<?php echo $content; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<?php if(isset($scripts)): ?>
    <?php foreach ($scripts as $script): ?>
        <script src="<?php echo \System\Helpers\URL::asset($script) ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>
</body>
</html>
