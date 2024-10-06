<?php $message = getFlashMessage(); ?>

<?php if (!empty($message['message'])) { ?>
<div class="customAlert absolute <?= $message['status'] ?>"><?= $message['message'] ?></div>
<?php } ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php getTitle() ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="<?= $css ?>app.css">
    <link rel="stylesheet" href="<?= $css ?>main.css">
    <link rel="stylesheet" href="<?= $css ?>auth.css">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script defer src="<?= $js ?>script.js" type="text/javascript"></script>
    <script defer src="<?= $js ?>ajax.js" type="text/javascript"></script>
</head>

<body>

    <div class="container">