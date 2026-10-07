<!DOCTYPE html>
<html>
<head><title>Course Details</title></head>
<body>
    <h1>Course Details</h1>
    @if(session('success')) <p style="color: green;">{{ session('success') }}</p> @endif
    <p><strong>ID:</strong> {{ $course->id }}</p>
    <p><strong>Name:</strong> {{ $course->name }}</p>
    <p><strong>Description:</strong> {{ $course->description }}</p>
    <p><strong>Duration:</strong> {{ $course->duration }} weeks</p>
    <p><strong>Fee:</strong> ${{ number_format($course->fee, 2) }}</p>
    <p><strong>Difficulty:</strong> {{ $course->difficulty }}</p>
    <p><strong>Status:</strong> {{ $course->is_active ? 'Active' : 'Inactive' }}</p>
    <a href="/courses/{{ $course->id }}/edit">Edit Course</a><br><br>
    <a href="/courses">Back to Courses</a>
</body>
</html>