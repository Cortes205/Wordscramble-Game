<?php
/**
 * Resource class to format any given notification object
 * 
 * @author      Alan Cortes
 * @version     1.0.0
 */

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
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
            "type" => $this->type,
            "header" => $this->header,
            "body" => $this->body,
            "isHidden" => $this->hidden === 1,
            "createdAt" => (new \DateTime($this->created_at))->format("Y-m-d H:i:s"),
        ];
    }
}
