<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Republics extends JsonResource
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
            'id'=>$this->id,
            'name'=>$this->name,
            'description'=>$this->description,
            'city'=>$this->city,
            'district'=>$this->district,
            'address'=>$this->address,
            'user_id'=>$this->user_id,
        ];
    }
}
