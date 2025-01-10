<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
             'title' => $this->title,
             'description' => $this->description,
             'author' => new UserResource($this->whenLoaded('author')),
             'translations' => BookTranslationResource::collection($this->whenLoaded('translations')),
             'images' => AttachmentResource::collection($this->whenLoaded('images')),
        ];
    }
}
