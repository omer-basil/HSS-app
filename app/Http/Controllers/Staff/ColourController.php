<?php

namespace App\Http\Controllers\Staff;

use App\Models\Staff\Item;
use App\Models\Staff\Size;
use App\Models\Staff\Colour;
use Illuminate\Support\Facades\DB;
use App\Http\Services\StockService;
use App\Http\Controllers\Controller;
use App\Http\Resources\Staff\ColourResource;
use App\Http\Requests\Staff\StoreStockRequest;
use App\Http\Requests\Staff\StoreColourRequest;
use App\Http\Requests\Staff\UpdateColourRequest;

class ColourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ColourResource::collection(Colour::with('sizes')->get());
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
     * @param  \App\Http\Requests\StoreColourRequest  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Item $item, StoreStockRequest $request, Colour $colour)
    {

        DB::transaction(function () use ($request, $item) {
            
            $imageName = time() . '-' . $request->name . '-' . 
            $request->image->extension();
            $request->image->move(public_path('images'), $imageName);

            $colour = Colour::create([
                'name' => $request->name,
                'image' => $request->imageName,
            ]);

            $item->colours()->attach($colour);
            
            $size = Size::create([
                'name' => $request->name,
                'quantity' => $request->quantity,
                'colour_id' => $request->colour_id,
            ]);
        });
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Staff\Colour  $colour
     * @return \Illuminate\Http\Response
     */
    public function show(Colour $colour)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Staff\Colour  $colour
     * @return \Illuminate\Http\Response
     */
    public function edit(Colour $colour)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateColourRequest  $request
     * @param  \App\Models\Staff\Colour  $colour
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateColourRequest $request, Colour $colour)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Staff\Colour  $colour
     * @return \Illuminate\Http\Response
     */
    public function destroy(Colour $colour)
    {
        //
    }
}
