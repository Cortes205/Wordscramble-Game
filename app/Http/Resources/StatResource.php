<?php
/**
 * Resource class to format any given stat resource
 * 
 * @author      Alan Cortes
 * @version     1.0.0
 */

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StatResource extends JsonResource
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
            "user" => $this->user->name,
            "info" => json_decode($this->info_json),
            "createdAt" => (new \DateTime($this->created_at))->format("m/d/Y H:i"),
        ];
    }
}
