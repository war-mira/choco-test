<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ModelsController extends Controller
{


    public function requestUpdate(Request $request)
    {
        $m_type = $request->input('model_type');
    }
}
