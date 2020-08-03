<?php

namespace App\Http\Controllers;

use App\Model\PinCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PinCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pins = PinCategory::all();
        return response()->json(['success', $pins], 200);
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
        $input = $request->all();


        DB::table('pin_categories')->insert([
            'category_name' => $input['category_name'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()

        ]);
        return response()->json('Category Created Successfully', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\PinCategory  $pinCategory
     * @return \Illuminate\Http\Response
     */
    public function show(PinCategory $pinCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\PinCategory  $pinCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(PinCategory $pinCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\PinCategory  $pinCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PinCategory $pinCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\PinCategory  $pinCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(PinCategory $pinCategory)
    {
        //
    }
}
