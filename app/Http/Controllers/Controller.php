<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    protected $languages;

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct()
{
    $this->languages = Language::all()->first();
    View::share('lang', $this->languages);
}
}
