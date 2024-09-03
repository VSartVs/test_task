<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeadResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'firstName'=>$this->first_name,
            'lastName'=>$this->last_name,
            'phone'=>$this->phone,
            'email'=>$this->email,
            'status'=>$this->status->title,
            'date'=>Carbon::parse($this->created_at)->format('d-m-Y H:i'),
            'message'=>$this->message,
        ];
    }
}
