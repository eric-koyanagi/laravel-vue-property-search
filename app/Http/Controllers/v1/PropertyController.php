<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Services\DatafinitiService;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function getProperties(Request $request, DatafinitiService $datafinityApi): array
    {
        return $datafinityApi->addressSearch(
            address: $request->get('address'),
            city: $request->get('city'),
            province: $request->get('province'),
            postal: $request->get('postal'),
        );
    }
}
