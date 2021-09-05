<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class heyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getproduct(){
        $db_name = User::where('email',Auth::user()->email)->pluck('db_name');
        DB::connection('mysql')->statement(sprintf("use %s",$db_name[0]));
        $data = [];
        $categories = DB::select('select * from categories');
        $products =DB::select('select * from products');
        
        // get all categories id 
        $getCategories = [];
        foreach($categories as $category){
            foreach($category as $column => $value){
                if($column == 'id'){
                    // array_push($categories_id, $value);
                    $getCategories[$column] = $value;
                }
            }
        }
        // print_r($getCategories);

        // echo "<pre>";
        // print_r($products);
        foreach($products as $product){
            foreach($product as $column =>$value){
            
                if($column != 'id'){    
                    array_push($data, $value);
                }
            }
        }
        $finally = [];
        // foreach($data as $key){
        //     // echo gettype($key). "<br>";
        //     if(gettype($key) == gettype(3)){
        //         if($key in $categories_id){
        //             foreach($categories_id){

        //             }
        //         }
        //     }
        // }

        // echo gettype(3);
        return view('product',compact('products','categories'));

    }
    public function getcategory(){
        $db_name = User::where('email',Auth::user()->email)->pluck('db_name');
        DB::connection('mysql')->statement(sprintf("use %s",$db_name[0]));
        $category =DB::table('categories')->get('*');
        return view('category',compact('category'));
    }
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
