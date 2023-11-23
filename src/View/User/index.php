<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
} ?>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h3>Profil</h3>
            @if (isset($_SESSION['id']))
            <p>Vous êtes connecté en tant que {{ $_SESSION['email'] }}</p>
            <?php
            $userModel = new \Model\UserModel();
            $user = $userModel->findAll(array('id' => $_SESSION['id']));
            ?>
            @if (!isset($_POST['edit']))
            <p>Prénom: {{ $_SESSION['firstname'] }}</p>
            <p>Nom: {{ $_SESSION['lastname'] }}</p>
            <p>Date de naissance: {{ $_SESSION['birthdate'] }}</p>
            <p>Adresse: {{ $_SESSION['address'] }}</p>
            <p>Code postal: {{ $_SESSION['zipcode'] }}</p>
            <p>Ville: {{ $_SESSION['city'] }}</p>
            <p>Pays: {{ $_SESSION['country'] }}</p>
            <form method="POST">
                <button type="submit" name="edit" class="btn btn-primary">Modifier</button>
            </form>
            @else
            <form method="POST" action="/PiePHP/user/editProfile">
                <label for="email">email:</label>
                <input type="text" name="email" value="{{ $_SESSION['email'] }}"><br>
                <label for="firstname">Prénom:</label>
                <input type="text" name="firstname" value="{{ $_SESSION['firstname'] }}"><br>
                <label for="lastname">Nom:</label>
                <input type="text" name="lastname" value="{{ $_SESSION['lastname'] }}"><br>
                <label for="birthdate">Date de naissance:</label>
                <input type="date" name="birthdate" value="{{ $_SESSION['birthdate'] }}"><br>
                <label for="address">Adresse:</label>
                <input type="text" name="address" value="{{ $_SESSION['address'] }}"><br>
                <label for="zipcode">Code postal:</label>
                <input type="text" name="zipcode" value="{{ $_SESSION['zipcode'] }}"><br>
                <label for="city">Ville:</label>
                <input type="text" name="city" value="{{ $_SESSION['city'] }}"><br>
                <label for="country">Pays:</label>
                <input type="text" name="country" value="{{ $_SESSION['country'] }}"><br>
                <label for="password">password:</label>
                <input type="password" name="password" value="{{ $_SESSION['password'] }}"><br>
                <p>password: {{ $_SESSION['password'] }}</p>
                <button type="submit" name="save" class="btn btn-primary">Enregistrer</button>
            </form>
            @endif
            <a href="/PiePHP/user/logout" class="btn btn-danger">Logout</a>
            <a href="/PiePHP/user/delete" class="btn btn-danger">Supprimer le compte</a>
            @else
            <p>Vous n'êtes pas connecté</p>
            <a href="/PiePHP/user/login" class="btn btn-primary">Login</a>
            @endif
        </div>
    </div>
</div>