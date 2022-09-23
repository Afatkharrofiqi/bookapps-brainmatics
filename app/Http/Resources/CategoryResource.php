<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'category_id' => $this->id,
            'name' => $this->name,
            'user' => 'Achmad'
        ];
    }

    public function  with($request)
    {
        return [
            'status' => 200,
            'message' => 'Data retrieved successfully'
        ];
    }
}
