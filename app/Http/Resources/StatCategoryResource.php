<?php
/**
 * Resource class to format any given StatCategory object
 * 
 * @author      Alan Cortes
 * @version     1.0.0
 */

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StatCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "stats" => StatResource::collection($this->whenLoaded("stats")),
            "userStats" => StatResource::collection($this->whenLoaded("userStats")),
            "latest" => StatResource::make($this->whenLoaded("latestUserStat")),
        ];
    }
}
