<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatMessage;

class ChatController extends Controller
{
    public function index()
    {
        $messages = ChatMessage::latest()->take(20)->get()->reverse(); // mostrar últimos 20 mensajes
        return view('chat', compact('messages'));
    }

   public function send(Request $request)
{
    $request->validate([
        'message' => 'required|string|max:1000'
    ]);

    $userMessage = $request->input('message');
    $botResponse = $this->getBotResponse($userMessage);

    $chat = ChatMessage::create([
        'user' => 'usuario',
        'message' => $userMessage,
        'response' => $botResponse
    ]);

    return response()->json([
        'message' => $chat->message,
        'response' => $chat->response
    ]);
}


 private function getBotResponse($message)
{
    $msg = strtolower($message);

    if (str_contains($msg, 'ansiedad')) {
        return 'Recuerda respirar profundo. Si sientes ansiedad con frecuencia, hablar con un profesional puede ayudarte.';
    }

    if (str_contains($msg, 'estres') || str_contains($msg, 'estrés')) {
        return 'El estrés es común en nuestra rutina. ¿Has probado técnicas de relajación o mindfulness?';
    }

    if (str_contains($msg, 'triste')) {
        return 'Lamento que te sientas así. Hablar con alguien de confianza puede ayudarte a liberar esa carga.';
    }

    if (str_contains($msg, 'hola') || str_contains($msg, 'buenas')) {
        return 'Hola 😊 ¿En qué te gustaría conversar hoy? Estoy aquí para escucharte.';
    }

    if (str_contains($msg, 'ayuda')) {
        return 'Estoy aquí para ayudarte. Cuéntame más sobre cómo te sientes.';
    }

    if (str_contains($msg, 'cansado') || str_contains($msg, 'agotado')) {
        return 'El cansancio puede afectar mucho nuestro ánimo. ¿Has descansado bien últimamente?';
    }

    if (str_contains($msg, 'dormir') || str_contains($msg, 'sueño') || str_contains($msg, 'no puedo dormir')) {
        return 'El sueño es vital para la salud mental. ¿Tienes problemas para dormir?';
    }

    if (str_contains($msg, 'loco') || str_contains($msg, 'loca')) {
        return 'A veces todos nos sentimos un poco perdidos, pero hablarlo ayuda mucho. ¿Quieres contarme qué pasa?';
    }

    if (str_contains($msg, 'solo') || str_contains($msg, 'sola')) {
        return 'Sentirse solo puede ser muy duro, pero aquí estoy para escucharte siempre que quieras.';
    }

    if (str_contains($msg, 'pastillas')) {
        return 'No soy médico, pero siempre es bueno consultar con un profesional antes de tomar medicamentos. ¿Quieres que hablemos sobre cómo te sientes?';
    }

    if (str_contains($msg, 'consejo') || str_contains($msg, 'sentirme bien')) {
        return 'Un buen consejo es cuidar tu respiración y darte momentos para ti. También es muy importante hablar con alguien de confianza.';
    }

    if (str_contains($msg, 'gracias') || str_contains($msg, 'mejor') || str_contains($msg, 'chao')) {
        return 'Me alegra poder ayudarte. Recuerda que aquí estaré cuando me necesites. ¡Cuídate mucho!';
    }

    // Respuesta aleatoria si no coincide con ninguna palabra clave
    $respuestasGenericas = [
        'Gracias por compartirlo conmigo. ¿Quieres contarme un poco más?',
        'Estoy escuchando. ¿Cómo te ha ido últimamente?',
        'Tus emociones son válidas. Puedes contarme lo que desees.',
        'Hablemos más sobre eso, si te sientes cómodo.',
        'Recuerda que no estás solo/a. Estoy aquí para acompañarte.'
    ];

    return $respuestasGenericas[array_rand($respuestasGenericas)];
}

public function limpiar()
{
    ChatMessage::truncate(); // elimina todos los mensajes
    return response()->json(['success' => true]);
}



}
