<h2>Login</h2>

<form action="{{ url('/api/auth/login') }}" method="post">
    @csrf
    <label for="username">Username:</label>
    <input type="text" name="username" required><br>

    <label for="password">Password:</label>
    <input type="password" name="password" required><br>

    <button type="submit">Login</button>
</form>
