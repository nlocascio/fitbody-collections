<!DOCTYPE html>
<head>
    <title>Pusher Test</title>
    <script src="https://js.pusher.com/2.2/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.log = function(message) {
            if (window.console && window.console.log) {
                window.console.log(message);
            }
        };

        var pusher = new Pusher('66e4d463903ea22a972b', {
            encrypted: true
        });

        var channel = pusher.subscribe('customerAction');
        channel.bind('my_event', function(data) {
            alert(data.message);
        });
    </script>
</head>
