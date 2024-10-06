<?php

namespace App\WhatsApp;
use Illuminate\Support\Facades\Http;
class EnviarMensaje
{
    protected $token;
    protected $url;
    public function __construct() {
        $this->token = env('WPP_TOKEN');
        $this->url = env('WPP_URL');
    }
    public function EnviarMensaje(){
        try{
            $payload = [
                'messaging_product' => 'whatsapp',
                'to' => '120363257633721791',
                'type' => 'template',
                "template" => [
                    "name" => "hello_world",
                    "language" => [
                        "code" => "en_US"
                    ]
                ]
            ];
            $message = Http::withToken($this->token)->post($this->url, $payload)->throw()->json();
            return response()->json([
                'success' => true,
                'data' => $message,
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
