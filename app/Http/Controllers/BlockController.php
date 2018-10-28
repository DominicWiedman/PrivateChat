<?php

namespace App\Http\Controllers;

use App\Events\BlockEvent;
use App\Models\Session;

class BlockController extends Controller
{
    public function block(Session $session)
    {
        $session->block();
        broadcast(new BlockEvent($session->id, true));
        return response(null,200);
    }

    public function unblock(Session $session)
    {
        $session->unblock();
        broadcast(new BlockEvent($session->id, false));
        return response(null,200);
    }
}
