<form action="/PiePHP/user/registerView" method="post">
    <div class="container">
        <div class="form-group">
            <label for="email"><b>Email</b></label>
            <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password"><b>Password</b></label>
            <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password" required>
        </div>
        <div class="form-group">
            <label for="firstname"><b>First Name</b></label>
            <input type="text" class="form-control" id="firstname" placeholder="Enter First Name" name="firstname" required>
        </div>
        <div class="form-group">
            <label for="lastname"><b>Last Name</b></label>
            <input type="text" class="form-control" id="lastname" placeholder="Enter Last Name" name="lastname" required>
        </div>
        <div class="form-group">
            <label for="birthdate"><b>Birthdate</b></label>
            <input type="date" class="form-control" id="birthdate" name="birthdate" required>
        </div>
        <div class="form-group">
            <label for="address"><b>Address</b></label>
            <input type="text" class="form-control" id="address" placeholder="Enter Address" name="address" required>
        </div>
        <div class="form-group">
            <label for="zipcode"><b>Zipcode</b></label>
            <input type="text" class="form-control" id="zipcode" placeholder="Enter Zipcode" name="zipcode" required>
        </div>
        <div class="form-group">
            <label for="city"><b>City</b></label>
            <input type="text" class="form-control" id="city" placeholder="Enter City" name="city" required>
        </div>
        <div class="form-group">
            <label for="country"><b>Country</b></label>
            <input type="text" class="form-control" id="country" placeholder="Enter Country" name="country" required>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
        <a href="/PiePHP/user/login" class="btn btn-secondary">Déjà inscrit ? Se connecter</a>
    </div>
</form>