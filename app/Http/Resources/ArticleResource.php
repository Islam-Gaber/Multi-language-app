<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use App\Http\Resources\mainResource;


class ArticleResource extends mainResource
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
            'id'                        => $this->id,
            'title'                     => $this->getTranslation('title', $this->lang),
            'slug'                      => $this->getTranslation('slug', $this->lang),
            'body'                      => $this->getTranslation('body', $this->lang),

            'created_at'                => Carbon::parse($this->created_at)->setTimezone(config('time.zone'))->format(config('time.format')),
            'updated_at'                => Carbon::parse($this->updated_at)->setTimezone(config('time.zone'))->format(config('time.format'))
        ];
    }
}
