<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemCategoriesController extends Controller
{
    public function index() {
         $data['title'] = 'LaraVue POS';
        return view('pages.Modules.Master_files.item-category')->with($data);
    }
}
