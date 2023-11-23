<form action="/PiePHP/user/loginView" method="post">
    <div class="container">
        <div class="form-group">
            <label for="email"><b>Email</b></label>
            <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password"><b>Password</b></label>
            <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
        <a href="/PiePHP/user/register" class="btn btn-secondary">Inscrivez-vous</a>
    </div>
</form>