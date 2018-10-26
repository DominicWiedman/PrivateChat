<?php

namespace App\Http\Resources;

use App\Models\Session;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'online' => false,
            'session' => $this->session_details($this->id),
        ];
    }

    private function session_details($id)
    {
        $session = Session::all()->whereIn('user1_id', [Auth::id(), $id])->whereIn('user2_id', [Auth::id(),$id])->first();
        return new SessionResource($session);
    }
}
