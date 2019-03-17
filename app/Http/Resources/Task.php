<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Task extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       // return parent::toArray($request);
        
        return [
            'id' => $this->id,
            'cat' => $this->cat,
            'name' => $this->name
        ];
    }
    
    public function with($request){
        return[
          'version' => '1.0.0',
          'author_url' => url('https://www.yorgv.be')
        ];
    }
}
