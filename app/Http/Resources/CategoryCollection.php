<?php

namespace App\Http\Resources;

use App\Http\Resources\v2\CategoryOnlyIdResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function($item) use ($request){
            if ($request->name) {
                return new CategoryOnlyIdResource($item);
            } else {
                return new CategoryResource($item);
            }
        });
    }

    public function  with($request)
    {
        return [
            'status' => 200,
            'message' => 'Data retrieved successfully'
        ];
    }
}
