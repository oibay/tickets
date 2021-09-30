<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{

    public function postTicket(Request $request)
    {
        Ticket::create([
            'status' => $request->status,
            'user_id' => $request->user_id,
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'location' => $request->location,
            'it_id' => $request->it_id,
        ]);
    }
}
