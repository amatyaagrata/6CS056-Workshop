<!DOCTYPE html>
<html>
<head><title>Edit Student</title></head>
<body>
    <h1>Edit Student</h1>
    @if($errors->any())
        <div style="color: red;">
            <ul>@foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
        </div>
    @endif
    <form action="/students/{{ $student->id }}" method="POST">
        @csrf @method('PUT')
        <div><label>Name</label><br><input type="text" name="name" value="{{ old('name', $student->name) }}"></div><br>
        <div><label>Email</label><br><input type="email" name="email" value="{{ old('email', $student->email) }}"></div><br>
        <div><label>Phone</label><br><input type="text" name="phone" value="{{ old('phone', $student->phone) }}"></div><br>
        <div><label>Address</label><br><textarea name="address">{{ old('address', $student->address) }}</textarea></div><br>
        <div><label>Date of Birth</label><br><input type="date" name="date_of_birth" value="{{ old('date_of_birth', $student->date_of_birth) }}"></div><br>
        <button type="submit">Update Student</button>
    </form>
    <br><a href="/students">Back to Students</a>
</body>
</html>