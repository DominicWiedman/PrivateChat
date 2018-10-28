<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Session extends Model
{
    protected $guarded = [];

    public function chats()
    {
        return $this->hasManyThrough(Chat::class, Message::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function deleteChats()
    {
        $this->chats()->where('user_id', Auth::id())->delete();
    }

    public function deleteMessages()
    {
        $this->messages()->delete();
    }

    public function block()
    {
        $this->block = true;
        $this->blocked_by = Auth::id();
        $this->save();
    }

    public function unblock()
    {
        $this->block = false;
        $this->blocked_by = null;
        $this->save();
    }
}
