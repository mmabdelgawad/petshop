<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'category_uuid' => $this->category_uuid,
            'title' => $this->title,
            'uuid' => $this->uuid,
            'price' => $this->price,
            'description' => $this->description,
            'metadata' => json_decode($this->metadata, true),
            'created_at' => Carbon::create($this->created_at)->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::create($this->updated_at)->format('Y-m-d H:i:s'),
            'deleted_at' => $this->deleted_at ? Carbon::create($this->deleted_at)->format('Y-m-d H:i:s') : $this->deleted_at,
            'category' => CategoryResource::make($this->category),
            'brand' => BrandResource::make($this->brand),
        ];
    }
}
