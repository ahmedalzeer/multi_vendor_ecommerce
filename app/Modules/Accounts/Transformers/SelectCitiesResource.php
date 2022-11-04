<?php


namespace App\Modules\Accounts\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;


class SelectCitiesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'text' => $this->name,
        ];
    }

}
