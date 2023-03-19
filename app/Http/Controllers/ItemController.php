<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateItemRequest;

class ItemController extends Controller
{

    protected $item;

    public function __construct(Item $item)
    {
        $this->middleware('auth');

        $this->item = $item;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request)
    {
        //
        $this->item->storeItem($request);
        return redirect('/home');
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
        $getItem = Item::findOrFail($id);

        return view('items.edit', compact('getItem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateItemRequest $request, $id)
    {
        //
        $getItem = Item::findOrFail($id);

        $validatedData = $request->validated();
        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('itemPhoto', 'public');
        }

        $getItem->update($validatedData);

        return redirect('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $getItem = Item::findOrFail($id);

        Storage::disk('public')->delete($getItem->image);
        $getItem->delete();

        return back();
    }

    public function searchItem(Request $request)
    {
        $getResult = $this->item->searchItemWithEtherNameOrDescription($request);

        return $getResult;
    }
}
