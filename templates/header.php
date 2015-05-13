<!DOCTYPE html>

<html>

    <head>

        <link href="/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="/css/bootstrap-theme.min.css" rel="stylesheet"/>
        <link href="/css/styles.css" rel="stylesheet"/>

        <?php if (isset($title)): ?>
            <title>*dTrade* <?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>*dTrade*</title>
        <?php endif ?>

        <script src="/js/jquery-1.11.1.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/scripts.js"></script>

    </head>

    <body>

        <div class="container">

            <div id="top">
                <a href="/">*dTrade*</a>
           </div>

            <div id="middle">
            <?php if(!empty($_SESSION['id']))
                {
                    require("links.php");
                }
            ?>
