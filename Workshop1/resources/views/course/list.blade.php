<!DOCTYPE html>
<html>
<head><title>Courses</title></head>
<body>
    <h1>Courses</h1>
    @if(session('success')) <p style="color: green;">{{ session('success') }}</p> @endif
    <a href="/courses/create">Create Course</a> | <a href="/students">Manage Students</a><br><br>
    <table border="1" cellpadding="10">
        <thead>
            <tr><th>ID</th><th>Name</th><th>Duration (Weeks)</th><th>Fee</th><th>Difficulty</th><th>Active</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @forelse($courses as $course)
            <tr>
                <td>{{ $course->id }}</td>
                <td>{{ $course->name }}</td>
                <td>{{ $course->duration }}</td>
                <td>${{ number_format($course->fee, 2) }}</td>
                <td>{{ $course->difficulty }}</td>
                <td>{{ $course->is_active ? 'Yes' : 'No' }}</td>
                <td>
                    <a href="/courses/{{ $course->id }}">View</a>
                    <a href="/courses/{{ $course->id }}/edit">Edit</a>
                    <form action="/courses/{{ $course->id }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="7">No courses found.</td></tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>