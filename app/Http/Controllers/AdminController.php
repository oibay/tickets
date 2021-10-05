<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Queue;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'access:admin']);
    }

    public function index()
    {
        $tickets = Ticket::whereIn('status',['wait','inprogress'])->get();
        return view('admin.index',[
            'tickets' => $tickets
        ]);
    }

    public function addNewRequest()
    {
        $user = User::where('role','user')->get();
        $location = Location::all();
        return view('admin.add-new-request',[
            'user' => $user,
            'location' => $location
        ]);
    }

    public function users()
    {
        $users = User::where('role','user')->get();

        return view('admin.users',[
            'users' => $users
        ]);
    }

    public function location()
    {
        $location = Location::all();

        return view('admin.location',[
            'location' => $location
        ]);
    }
    public function addNewUser()
    {
        $location = Location::all();
        return view('admin.add-new-user',[
            'location' => $location
        ]);
    }

    public function showEditUser($id)
    {
        $user = User::findOrfail($id);
        $location = Location::all();
        return view('admin.edit-new-user',[
            'user' => $user,
            'location' => $location
        ]);
    }

    public function addNewLocation()
    {
        return view('admin.add-new-location');
    }

    public function createLocation(Request $request)
    {
        return showMessage(Location::create(['title' => $request->title]),'добавлено');
    }

    public function createUser(Request $request)
    {

        $create = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'location_id' => $request->location,
            'role' => $request->role,
            'password_text' => $request->password
        ]);

        return showMessage($create,'добавлено');
    }

    public function createTicket(Request $request)
    {
        $create = Ticket::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id,
            'priority' => $request->priority,
            'location_id' => $request->location,
            'it_id' => Auth::id(),
        ]);

        $queue = Queue::create([
            'event_id' => $create->id,
            'queue' => $queueCount = Queue::count() + 1
        ]);

        return showMessage($create,'добавлено');
    }

    public function changeStatusTicket(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->status = $request->status;
        if ($ticket->save()) {
            if ($request->status == 'done') {
                $queue = Queue::where('event_id',$ticket->id)->delete();
            }

            $count = 1;
            foreach(Queue::get() as $item) {
                DB::table('queues')->where('id',$item->id)->update(['queue' => $count++]);
            }

        }

        return showMessage(true, 'обновлено');
    }

    public function changePriority(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->priority = $request->priority;

        return showMessage($ticket->save(), 'обновлено');
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->location_id = $request->location;
        $user->password = Hash::make($request->password);
        $user->password_text = $request->password;
        $user->role = $request->role;

        return showMessage($user->save(), 'обновлено');
    }

    private function inProgress(Ticket $ticket)
    {
        $userName = $ticket->user['name'];
        $message = "<p>Здравствуйте ".$userName."</p>
            Заявка № <span>" . $create->id . "</span>
            <br/>
            <p>Тема: " . $create->title . "</p>
			<p>Описание: " . $create->description . "</p>
			<p>Ваша очередь:".$queue->queue."</p>
            <p>Статус: <span style='color:green;font-size:20px;font-weight:bold;'>Ожидает</span></p>
            <br>
            <i>Это письмо отправлено <b>роботом</b>
            и отвечать на него не нужно!</i>";


        //sendEmail($create->title,$message);
    }



}
