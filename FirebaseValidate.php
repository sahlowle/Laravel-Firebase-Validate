<?php

use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| Validate By Firebase
|--------------------------------------------------------------------------
*/
function validateByFirebase($code,$verification_id)
{
    $url = 'https://www.googleapis.com/identitytoolkit/v3/relyingparty/verifyPhoneNumber?key=XXXXXXXXXXX';
        
    $response = Http::post($url,[
        'code' => $code,
        'sessionInfo' => $verification_id,
    ]);
    
    if ($response->successful()) {
        $data = (object)[
            'successful' => $response->successful(),
            'status' => $response->status(),
            'error' => "success validated",
        ];
    }
    else {
        $data = (object)[
            'successful' => $response->successful(),
            'status' => $response->status(),
            'error' => $response->object()->error->message
        ];
    }

    return $data;
}