<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hotel Reservation System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<x-app-layout>
<body>
    <div class="container my-5">
        <div class="row">
            <!-- Rooms Section -->
            <div class="col-md-8">
                <h2 class="mb-4">Rooms</h2>
                <!-- Search Form -->
                <form action="{{ url('/') }}" method="GET" class="mb-4 d-flex">
                    <input type="text" name="search" class="form-control me-2" placeholder="Search rooms..." value="{{ $search ?? '' }}">
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>

                <!-- Rooms Table -->
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Room Number</th>
                            <th>Room Type</th>
                            <th>Description</th>
                            <th>Capacity</th>
                            <th>Price per Night</th>
                            <th>Availability</th>
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
                                <img src="{{ asset('storage/' . $room->image_path) }}" alt="Room Image" class="img-thumbnail" style="width: 100px;">
                                @else
                                <span class="text-muted">No Image</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">No rooms found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Add Room Section -->
            <div class="col-md-4">
                <h2 class="mb-4">Add Room</h2>
                <form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data" class="border p-4 shadow rounded">
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
                    <button type="submit" class="btn btn-success w-100">Add Room</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</x-app-layout>
