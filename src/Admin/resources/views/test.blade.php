<html>
<head>
    <meta charset="utf-8">
</head>
<body>

</body>
<script>
    var socket = new WebSocket('ws://serviko.loc/socket/request?token=1|WTbVIW1ajPq88v0sSms28shcIoI5pglFV8FOSiBc');
    socket.onmessage = function(event) {
        console.log(JSON.parse(event.data), typeof event.data)
    };
</script>
</html>
