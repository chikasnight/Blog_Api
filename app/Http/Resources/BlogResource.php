<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
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
            'id' => $this->id,
            'posts'=> $this->posts,
            'comments' => $this->comments,
            'create_dates'=>[
                'created_at_human'=>$this->created_at->differentumans(),
                'created_at' =>$this->created_at, 
            ],

            'update_dates'=>[
                'updated_at_human'=>$this->updated_at->differentumans(),
                'updated_at' =>$this->updated_at, 
            ]

        ];
    }
}
