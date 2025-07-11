<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Chat de Salud Mental</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style>
        body { font-family: Arial, sans-serif; background: #f2f2f2; padding: 20px; }
        #chat-box {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 15px;
            border-radius: 10px;
            height: 400px;
            overflow-y: auto;
            border: 1px solid #ccc;
        }
        .message {
            max-width: 70%;
            margin-bottom: 12px;
            padding: 10px 15px;
            border-radius: 15px;
            clear: both;
            opacity: 0;
            animation: fadeIn 0.4s ease forwards;
            font-size: 14px;
            line-height: 1.4;
        }
        @keyframes fadeIn {
            to { opacity: 1; }
        }
        .user {
            background-color: #cce5ff;
            color: #004085;
            float: right;
            text-align: right;
            border-bottom-right-radius: 0;
        }
        .bot {
            background-color: #d4edda;
            color: #155724;
            float: left;
            text-align: left;
            border-bottom-left-radius: 0;
        }
        form {
            max-width: 600px;
            margin: 20px auto;
            display: flex;
            gap: 10px;
        }
        input[type="text"] {
            flex: 1;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
        }
        button {
            padding: 10px 20px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        #typing-indicator {
            max-width: 600px;
            margin: 5px auto;
            font-style: italic;
            color: #666;
            display: none;
        }
    </style>
</head>
<body>

<h2 style="text-align: center;">Chat de Atención Psicológica</h2>

<div id="chat-box">
    @foreach ($messages as $msg)
        <div class="message user"><strong>Tú:</strong><br> {{ $msg->message }}</div>
        <div class="message bot"><strong>🧘‍♀️ SanaConYess:</strong><br> {{ $msg->response }}</div>
    @endforeach
</div>

<div id="typing-indicator">🧘‍♀️ SanaConYess está escribiendo...</div>

<form id="chat-form">
    <input type="text" id="message" name="message" placeholder="Escribe tu mensaje..." required autocomplete="off" />
    <button type="submit">Enviar</button>
    <button type="button" id="clear-btn" style="background-color: #dc3545;">🧹 Limpiar chat</button>
</form>



<audio id="send-sound" src="https://cdn.pixabay.com/download/audio/2022/03/15/audio_4692739262.mp3?filename=click-124467.mp3"></audio>
<audio id="receive-sound" src="https://cdn.pixabay.com/download/audio/2022/03/15/audio_4b9d1d878e.mp3?filename=notification-124472.mp3"></audio>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
     const sendSound = document.getElementById('send-sound');
    const receiveSound = document.getElementById('receive-sound');

    // Enviar mensaje
    $('#chat-form').on('submit', function(e) {
        e.preventDefault();

        let message = $('#message').val().trim();
        if (message === '') return;

        // Mostrar mensaje del usuario
        $('#chat-box').append(`
            <div class="message user"><strong>Tú:</strong><br> ${message}</div>
        `);
        scrollToBottom();
        $('#message').val('');
        sendSound.play();

        // Mostrar "escribiendo..."
        $('#typing-indicator').fadeIn();

        $.ajax({
            url: '{{ route("chat.send") }}',
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                message: message
            },
            success: function(response) {
                $('#typing-indicator').fadeOut();

                $('#chat-box').append(`
                    <div class="message bot"><strong>🧘‍♀️ SanaConYess:</strong><br> ${response.response}</div>
                `);
                scrollToBottom();
                receiveSound.play();
            },
            error: function() {
                $('#typing-indicator').fadeOut();
                alert('Error al enviar el mensaje.');
            }
        });
    });

    // Botón limpiar chat
    $('#clear-btn').on('click', function() {
        if (confirm("¿Estás seguro de que deseas borrar todo el chat?")) {
            $.post("{{ route('chat.limpiar') }}", {
                _token: $('meta[name="csrf-token"]').attr('content')
            }, function() {
                // Limpiar visualmente el chat y recargar
                $('#chat-box').empty();
                $('#message').val('');
                alert("El chat ha sido limpiado.");
                location.reload(); // o eliminar esta línea si no deseas recargar
            });
        }
    });

    // Mantener el scroll al final
    function scrollToBottom() {
        let chatBox = $('#chat-box');
        chatBox.scrollTop(chatBox[0].scrollHeight);
    }

    // Al cargar la página, bajar al final
    $(document).ready(function() {
        scrollToBottom();
    });
</script>

</body>
</html>
