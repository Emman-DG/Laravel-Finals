<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all(); // Retrieve all rooms from the database
        return view('welcome', compact('rooms')); // Pass the rooms to the view
    }
}
