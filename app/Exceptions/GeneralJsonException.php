<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GeneralJsonException extends Exception
{
    // Used to Report about the Exception to user;
    // Mostly used to send exceptions to users via Email;
    public function report() {
        //..
    }

    public function render(Request $request) {
        return new JsonResponse([
            'errors' => [
                'message' => $this->getMessage(),
            ]
        ], $this->code);
    }
}
