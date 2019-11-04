<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index() {
         $data['title'] = 'LaraVue POS';
        return view('pages.Modules.Item_purchases.item-list')->with($data);
    }
}
