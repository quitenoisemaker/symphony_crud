<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public function storeItem($request)
    {
        $this->name = $request->name;
        $this->description = $request->description;
        $this->image = $request->file('image')->store('itemPhoto', 'public');
        $this->save();
    }
}
