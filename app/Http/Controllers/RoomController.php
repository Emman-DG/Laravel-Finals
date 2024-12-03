<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $rooms = Room::query()
            ->when($search, function ($query, $search) {
                $query->where('room_number', 'like', "%$search%")
                    ->orWhere('room_type', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%")
                    ->orWhere('capacity', 'like', "%$search%")
                    ->orWhere('price_per_night', 'like', "%$search%");

                // Handle "Available" and "Not Available" keywords
                if (strtolower($search) === 'available') {
                    $query->orWhere('availability_status', 1);
                } elseif (strtolower($search) === 'not available') {
                    $query->orWhere('availability_status', 0);
                }
            })
            ->get();

        return view('hotelrooms', compact('rooms', 'search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_number' => 'required|integer',
            'room_type' => 'required|string',
            'description' => 'required|string',
            'capacity' => 'required|integer',
            'price_per_night' => 'required|numeric',
            'availability_status' => 'required|boolean',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        $imagePath = $request->file('image')->store('room_images', 'public');

        // Create room
        Room::create([
            'room_number' => $request->room_number,
            'room_type' => $request->room_type,
            'description' => $request->description,
            'capacity' => $request->capacity,
            'price_per_night' => $request->price_per_night,
            'availability_status' => $request->availability_status,
            'image_path' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Room added successfully!');
    }
}
