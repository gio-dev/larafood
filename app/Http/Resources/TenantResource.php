<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TenantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'name' => $this->name,
            'cnpj' => $this->cnpj,
            'uuid' => $this->uuid,
            'logo' => $this->logo ? url("storage/{$this->logo}") : '',
            'contact' => $this->email,
            'flag' => $this->url,
            'data_created' => Carbon::parse($this->created_at)->format('d/m/Y'),
        ];
    }
}
