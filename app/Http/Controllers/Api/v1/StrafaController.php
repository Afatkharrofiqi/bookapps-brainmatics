<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\StrafaCollection;
use Illuminate\Http\Request;

class StrafaController extends Controller
{
    public function index(){
        $resp = 'data';// response dari strava
        $data = [
            'id' => 'idstrava',
            'name' => 'achmad',
            'data' => $resp
        ];
        return $this->response(200, $data);
    }
}
