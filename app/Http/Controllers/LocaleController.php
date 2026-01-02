<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocaleController extends Controller
{
    public function setLocale(string $lang): RedirectResponse
    {
        Session::put('locale', $lang);
        App::setLocale($lang);
        return back();
    }
}
