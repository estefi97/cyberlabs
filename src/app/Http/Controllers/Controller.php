<?php

namespace App\Http\Controllers;

use App\Singleton\WhiteDocumentSingleton;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        WhiteDocumentSingleton::getInstance();
        WhiteDocumentSingleton::getInstance();
        $this->messages = WhiteDocumentSingleton::$message;
    }

    public function setLanguage ($language) {
    	if(array_key_exists( $language, config('languages'))) {
    		session()->put('applocale', $language);
	    }
	    return back();
    }
}
