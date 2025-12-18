<!-- resources/views/auth/login.blade.php -->
<form method="POST" action="{{ route('login') }}">
    @csrf
    
    <!-- Role Selection -->
    <div>
        <label>Login As</label>
        <select name="role" required>
            <option value="">Select Role</option>
            <option value="admin">Admin</option>
            <option value="teacher">Teacher</option>
            <option value="student">Student</option>
        </select>
    </div>

    <!-- Email -->
    <div>
        <label>Email</label>
        <input type="email" name="email" required>
    </div>

    <!-- Password -->
    <div>
        <label>Password</label>
        <input type="password" name="password" required>
    </div>

    <button type="submit">Log In</button>
</form>