<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index() {
        $data['title'] = 'LaraVue POS';
        return view('pages.index')->with($data);
    }

}
