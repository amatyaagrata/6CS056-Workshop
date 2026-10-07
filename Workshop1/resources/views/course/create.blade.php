<!DOCTYPE html>
<html>
<head><title>Create Course</title></head>
<body>
    <h1>Create Course</h1>
    @if($errors->any())
        <div style="color: red;">
            <ul>@foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
        </div>
    @endif
    <form action="/courses" method="POST">
        @csrf
        <div><label>Course Name</label><br><input type="text" name="name" value="{{ old('name') }}"></div><br>
        <div><label>Description</label><br><textarea name="description">{{ old('description') }}</textarea></div><br>
        <div><label>Duration (Weeks)</label><br><input type="number" name="duration" value="{{ old('duration') }}"></div><br>
        <div><label>Course Fee</label><br><input type="number" step="0.01" name="fee" value="{{ old('fee') }}"></div><br>
        <div>
            <label>Difficulty</label><br>
            <select name="difficulty">
                <option value="">Select Difficulty</option>
                <option value="Easy" {{ old('difficulty') == 'Easy' ? 'selected' : '' }}>Easy</option>
                <option value="Medium" {{ old('difficulty') == 'Medium' ? 'selected' : '' }}>Medium</option>
                <option value="Hard" {{ old('difficulty') == 'Hard' ? 'selected' : '' }}>Hard</option>
            </select>
        </div><br>
        <div><label><input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}> Is Active</label></div><br>
        <button type="submit">Create Course</button>
    </form>
    <br><a href="/courses">Back to Courses</a>
</body>
</html>