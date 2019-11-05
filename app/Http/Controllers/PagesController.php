<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index() {
        $data['title'] = 'LaraVue POS';
        return view('pages.index')->with($data);
    }

    public function itemCategories() {
        $data['title'] = 'LaraVue POS';
        return view('pages.Modules.Master_files.item-category')->with($data);
    }

    public function item() {
        $data['title'] = 'LaraVue POS';
        return view('pages.Modules.Master_files.item-category')->with($data);
    
    }
    public function itemUmsr() {
        $data['title'] = 'LaraVue POS';
        return view('pages.Modules.Master_files.item-category')->with($data);
    }

}
