<h2>Login</h2>

<form action="{{ url('/api/auth/login') }}" method="post">
    @csrf
    <label for="email">Email:</label>
    <input type="email" name="email" required><br>

    <label for="password">Password:</label>
    <input type="password" name="password" required><br>

    <button type="submit">Login</button>
</form>