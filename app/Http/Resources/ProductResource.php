<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => (int) $this->id,
            'nombre' => $this->name,
            'precio' => (float) $this->price,
        ];
    }
}
