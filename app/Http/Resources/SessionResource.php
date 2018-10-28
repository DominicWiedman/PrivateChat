<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class SessionResource extends JsonResource
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
            'id' => $this->id,
            'open' => false,
            'users' => [$this->user1_id, $this->user2_id],
            'unreadCount' => $this->chats->where('read_at', null)->where('type', 0)->where('user_id', '!=', Auth::id())->count(),
            'block' => !!$this->block,
            'blocked_by' => $this->blocked_by,
        ];
    }
}
