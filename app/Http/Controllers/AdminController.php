<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'access:admin']);
    }

    public function index()
    {
        return view('admin.index');
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
    public function addNewUser()
    {
        $location = Location::all();
        return view('admin.add-new-user',[
            'location' => $location
        ]);
    }

    public function addNewLocation()
    {
        return view('admin.add-new-location');
    }

    public function createLocation(Request $request)
    {
        return showMessage(Location::create(['title' => $request->title]));
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

        return showMessage($create);
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

        return showMessage($create);
    }




}
