<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item_Categories as ItemCat;

class ItemCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home() {
        
    }
    public function index()
    {   
        $categories = ItemCat::orderBy('created_at','desc')->get();
        $encrypted_ids = array();

        for ($i = 0; $i < count($categories); $i++ ){
            $encrypted_ids[$i] = encrypt($categories[$i]->id);
        }

        $data['data'] = $categories;
        $data['encrypted_ids'] = $encrypted_ids;
    
        return $data;
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new ItemCat();
        $category->itemCategory = ucwords($request->itemCategory);
        $category->itemCatCode = strtoupper($request->itemCatCode);
        $category->categoryDesc = ucfirst($request->categoryDesc);
        $category->status = $request->status;

        $category->save();

        return $category;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $decrypted_id = decrypt($id);

        $data['categoryData'] = $categoryData = ItemCat::where('id', $decrypted_id)->get();
        $data['title'] = 'LaraVue POS';
        return view('pages.Modules.Master_files.item-category-view')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $decrypted_id = decrypt($id);

        $data['categoryData'] = $categoryData = ItemCat::where('id', $decrypted_id)->get();
        $data['title'] = 'LaraVue POS';
        return view('pages.Modules.Master_files.item-category-edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
