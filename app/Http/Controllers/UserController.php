<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Queue;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('user_id',Auth::id())->orderBy('id','DESC')->get();
        return view('users.index',[
            'tickets' => $tickets
        ]);
    }

    public function addNewRequest()
    {
        $user = User::where('role','user')->get();

        return view('users.add-new-request',[
            'user' => $user,
        ]);
    }

    public function createTicket(Request $request)
    {
        $create = Ticket::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::id(),
            'location_id' => Auth::user()->location_id,
            'it_id' => 0,
        ]);

        $queue = Queue::create([
            'event_id' => $create->id,
            'queue' => $queueCount = Queue::count() + 1
        ]);
        $message = "<p>Здравствуйте ".Auth::user()->name."</p>
            Заявка № <span>" . $create->id . "</span>
            <br/>
            <p>Тема: " . $create->title . "</p>
			<p>Описание: " . $create->description . "</p>
			<p>Ваша очередь:".$queue->queue."</p>
            <p>Статус: <span style='color:red;font-size:20px;font-weight:bold;'>Ожидает</span></p>
            <br>
            <i>Это письмо отправлено <b>роботом</b>
            и отвечать на него не нужно!</i>";


        sendEmail($create->title,$message,Auth::user()->email);
        return showMessage($create,'добавлено');
    }

}
