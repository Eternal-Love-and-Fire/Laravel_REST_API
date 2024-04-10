<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class TokenGenerationController extends BaseController
{
    public function __invoke()
    {
        $token = Str::random(40);
        $expiration = now()->addMinutes(40)->toDateTimeString();

        DB::table('tokens')->insert([
            'token' => $token,
            'expires_at' => $expiration,
            'used' => false,
        ]);

        return $this->sendResponse([
            'token' => $token,
            'expires_at' => $expiration,
        ], 'Token will be available for 40 minutes and can be used only once');
    }
}
