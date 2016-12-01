<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Phalcon PHP Framework</title>
        <link rel="stylesheet" href="/css/app.css">
        <style type="text/css">
            pre {
                white-space: pre-wrap;       /* css-3 */
            }
        </style>
    </head>
    <body>
    {% include "layouts/header.volt" %}
        <div class="container">
            {{ content() }}
        </div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="/js/jquery-2.1.4.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="/js/bootstrap.min.js"></script>
    </body>
</html>
