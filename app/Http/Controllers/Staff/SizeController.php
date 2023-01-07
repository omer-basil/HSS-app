<?php

namespace App\Http\Controllers\Staff;

use App\Models\Staff\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\Staff\SizeResource;
use App\Http\Requests\Staff\StoreSizeRequest;
use App\Http\Requests\Staff\UpdateSizeRequest;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SizeResource::collection(Size::get());
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
     * @param  \App\Http\Requests\StoreSizeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSizeRequest $request)
    {
        $size = Size::create([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'colour_id' => $request->colour_id
        ]);

        return "quantity added to the stock successfully!";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Staff\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function show(Size $size)
    {
        return new SizeResource($size);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Staff\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function edit(Size $size)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSizeRequest  $request
     * @param  \App\Models\Staff\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSizeRequest $request, Size $size)
    {
        DB::table('sizes')->where([['id', $size->id], ['colour_id', $request->colour_id]])->increment('quantity', $request->input('quantity'));

        return "Stock has been updated successfully!";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Staff\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function destroy(Size $size, Request $request)
    {
        DB::table('sizes')->where([['id', $size->id], ['colour_id', $request->colour_id]])->decrement('quantity', $request->input('quantity'));

        return "Stock has been updated successfully!";
    }
}
