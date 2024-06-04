<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Live Chat</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            display: flex;
            height: 100vh;
        }
        .users-list {
            width: 30%;
            border-right: 1px solid #ddd;
            overflow-y: auto;
            background: #fff;
        }
        .users-list ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .users-list li {
            padding: 15px;
            cursor: pointer;
            border-bottom: 1px solid #ddd;
        }
        .users-list li:hover {
            background-color: #f1f1f1;
            color:#000;
        }
        .chat-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: #fff;
        }
        .chat-header {
            padding: 15px;
            border-bottom: 1px solid #ddd;
            background: #f1f1f1;
        }
        .chat-messages {
            flex: 1;
            padding: 15px;
            overflow-y: auto;
        }
        .chat-message {
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 10px;
            max-width: 60%;
        }
        .message-sent {
            background: #dcf8c6;
            align-self: flex-end;
        }
        .message-received {
            background: #fff;
            border: 1px solid #ddd;
            align-self: flex-start;
        }
        .chat-input {
            display: flex;
            padding: 15px;
            border-top: 1px solid #ddd;
            background: #f1f1f1;
        }
        .chat-input textarea {
            flex: 1;
            resize: none;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            margin-right: 10px;
        }
        .chat-input button {
            padding: 10px 15px;
            border: none;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="users-list">
            <ul>
                <li>Select a user to start chatting</li>
                @foreach($users as $user)
                    <li data-id="{{ $user->id }}">{{ $user->{'name_' . app()->getLocale()}  }}</li>
                @endforeach
            </ul>
        </div>
        <div class="chat-container">
            <div class="chat-header">
                <h3 id="chatWith">Chat</h3>
            </div>
            <div class="chat-messages" id="messages"></div>
            <div class="chat-input">
                <textarea id="message" placeholder="Enter your message"></textarea>
                <button id="send">Send</button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    <script>
     $(document).ready(function() {
    

            let toUserId = '';
            let userName = '';

            $('.users-list li').click(function() {
                toUserId = $(this).data('id');
                userName = $(this).text();
                $('#chatWith').text('Chat with ' + userName);
                fetchMessages(toUserId);
            });

            function fetchMessages(userId) {
                $.get('/messages/' + userId, function(data) {
                    $('#messages').html('');
                    data.forEach(function(chat) {
                        $('#messages').append(
                            `<div class="chat-message ${chat.from_user_id == {{ Auth::id() }} ? 'message-sent' : 'message-received'}">
                                <strong>${chat.from_user_id == {{ Auth::id() }} ? 'You' : userName}:</strong> ${chat.message}
                            </div>`
                        );
                    });
                });
            }

            Echo.private('chat.' + {{ Auth::id() }})
                .listen('MessageSent', (e) => {
                    if (e.chat.from_user_id == toUserId) {
                        $('#messages').append(
                            `<div class="chat-message message-received">
                                <strong>${userName}:</strong> ${e.chat.message}
                            </div>`
                        );
                    }
                });

            $('#send').click(function() {
                const message = $('#message').val();
                if (message.trim() !== '' && toUserId !== '') {
                    $.post('/messages', { to_user_id: toUserId, message: message }, function(response) {
                        $('#message').val('');
                        $('#messages').append(
                            `<div class="chat-message message-sent">
                                <strong>You:</strong> ${response.message.message}
                            </div>`
                        );
                    });
                }
            });
        });
    </script>
</body>
</html>
