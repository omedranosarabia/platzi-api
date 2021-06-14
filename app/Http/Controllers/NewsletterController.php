<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class NewsletterController extends Controller
{
    public function send()
    {
        // Se invoca el comando de artisan que se escribe en la consola.
        Artisan::call('send:reminder');
        
        return response()->json([
            'data' => 'Todo OK'
        ]);
    }
}
