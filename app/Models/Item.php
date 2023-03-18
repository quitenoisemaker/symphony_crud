<?php

namespace App\Models;

use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'description'
    ];

    public function storeItem($request)
    {
        $this->name = $request->name;
        $this->description = $request->description;
        $this->image = $request->file('image')->store('itemPhoto', 'public');
        $this->save();
    }


    public function searchItemWithEtherNameOrDescription($request)
    {
        $noOfRecords = 10;
        $searchItem = $request->search_item;
        $query = self::select('id', 'name', 'description', 'image');

        if ($searchItem) {
            $query = $query->where('name', 'LIKE', '%' . $searchItem . '%')
                ->orWhere('description', 'LIKE', '%' . $searchItem . '%');
        }

        $query = $query->orderBy('id', 'desc')
            ->paginate($noOfRecords);

        $queryData = [];

        foreach ($query as $singleData) {
            $queryData[] = array(
                'id' => $singleData->id,
                'name' => $singleData->name,
                'description' => $singleData->description,
                'image' => URL::asset('storage/' . $singleData->image),
                'editLink' => route('item.edit', ['id' => $singleData->id]),
                'deleteLink' => url('item/delete', $singleData->id),
            );
        }

        $response = [
            'success' => true,
            'totalRecords' => $query->total(),
            'data' => $queryData
        ];

        return $response;
    }
}
