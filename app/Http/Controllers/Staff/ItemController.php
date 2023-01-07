<?php

namespace App\Http\Controllers\Staff;

use App\Models\Staff\Item;
use App\Models\Staff\Colour;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Http\Resources\Staff\ItemResource;
use App\Http\Resources\Staff\ColourResource;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item = Item::with('colours.sizes', 'categories', 'ratings')->get();
        return ItemResource::collection($item);
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
     * @param  \App\Http\Requests\StoreItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreItemRequest $request)
    {
        $item = Item::create([
            'i_code' => $request->i_code,
            'i_name' => $request->i_name,
            'i_price' => $request->i_price,
            'description' => $request->description,
            'model' => $request->model,
            'category' => $request->category,
            'brand' => $request->brand
        ]);
        $item->categories()->sync($request->category_id); //the value will be available in select option element
        $item->tags()->sync($tag_id);
        return new ItemResource($item);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Staff\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return new ItemResource($item->load('colours.sizes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Staff\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateItemRequest  $request
     * @param  \App\Models\Staff\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        $item->update([
            'i_code' => $request->input('i_code'),
            'i_name' => $request->input('i_name'),
            'i_price' => $request->input('i_price'),
            'description' => $request->input('description'),
            'model' => $request->input('model'),
            'category' => $request->input('category'),
            'brand' => $request->input('brand')
        ]);
        $item->categories()->sync($request->category_id); //the value will be available in select option element
        $item->tags()->sync($tag_id);
        return new ItemResource($item);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Staff\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }
}
