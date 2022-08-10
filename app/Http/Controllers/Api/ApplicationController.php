<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ApplicationsCollection;
use App\Models\Application;

class ApplicationController extends Controller
{

    public function index()
    {
        return new ApplicationsCollection(
            Application::ofUser(auth()->user()->id)
                ->paginate()
                ->withQueryString()
        );
    }

}
