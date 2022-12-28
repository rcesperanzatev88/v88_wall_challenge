<html>
    <head>
        <title>Dashboard</title>
        <link rel = "stylesheet" href = "<?= base_url() ?>assets/css/messages.css">
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script src = "<?= base_url() ?>assets/javascripts/messages.js"></script>
    </head>
    <body>
        <header>
            <span> THE WALL </span><span class = "user_name">JAYJAY</span><span class ="logout">Logout</span>
        </header>
        <section>
            <form id = "form_message" action = "post_message" method = "post">
                <div class = "error"></div>
                <h2>Message</h2>
                <textarea class = "message" name = "message"></textarea>
                <input type = "submit" value = "Post">
            </form>
            <div id = "container"><?= $messages ?><div>
        </section>
    </body>
</html>