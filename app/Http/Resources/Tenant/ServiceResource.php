<?php

namespace App\Http\Resources\Tenant;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $startedDateOfService = Carbon::parse($this->created_at);
        $exp_date =$this->service->duration;

        return [
            'id'=>$this->id,
            'name'=>$this->service->name,
            'expire_date'=>$startedDateOfService->addMonths($exp_date)->format('Y-m-d'),
            'stope after'=>$startedDateOfService->addMonths($exp_date)->diffInDays(now()) ,

        ];
    }
}
