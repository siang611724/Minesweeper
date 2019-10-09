<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MemberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'email'=> $this->email,
            'coins'=> $this->coins,
            'created_at'=> (string)$this->created_at,
            'updated_at'=> (string)$this->updated_at,
            'coins'=> $this->coins,
        ];
    }
}
