<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hotel Reservation System</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div class="container">
        <h1>Rooms</h1>

        <!-- Search Form -->
        <form action="{{ url('/') }}" method="GET" class="mb-3">
            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Search for rooms, e.g., 'Available', 'Not Available'..."
                value="{{ $search ?? '' }}">
            <button type="submit" class="btn btn-primary mt-2">Search</button>
        </form>

        <!-- Rooms Table -->
        <table class="table">
            <thead>
                <tr>
                    <th>Room Number</th>
                    <th>Room Type</th>
                    <th>Description</th>
                    <th>Capacity</th>
                    <th>Price per Night</th>
                    <th>Availability Status</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rooms as $room)
                <tr>
                    <td>{{ $room->room_number }}</td>
                    <td>{{ $room->room_type }}</td>
                    <td>{{ $room->description }}</td>
                    <td>{{ $room->capacity }}</td>
                    <td>${{ number_format($room->price_per_night, 2) }}</td>
                    <td>{{ $room->availability_status ? 'Available' : 'Not Available' }}</td>
                    <td>
                        @if ($room->image_path)
                        <img src="{{ asset('storage/' . $room->image_path) }}" alt="Room Image" style="width: 100px; height: auto;">
                        @else
                        No image
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">No rooms found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <h1>Add Room</h1>
        <form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="room_number" class="form-label">Room Number</label>
                <input type="number" name="room_number" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="room_type" class="form-label">Room Type</label>
                <input type="text" name="room_type" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="capacity" class="form-label">Capacity</label>
                <input type="number" name="capacity" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="price_per_night" class="form-label">Price per Night</label>
                <input type="number" step="0.01" name="price_per_night" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="availability_status" class="form-label">Availability</label>
                <select name="availability_status" class="form-control" required>
                    <option value="1">Available</option>
                    <option value="0">Not Available</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Room Image</label>
                <input type="file" name="image" class="form-control" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Room</button>
        </form>
    </div>
</body>

</html>