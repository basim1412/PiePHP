<?php

namespace Controller;

use Core\Controller;
use Model\UserModel;
use Core\Request;

class UserController extends Controller
{
    protected $request;

    public function __construct()
    {
        $this->request = new Request();
    }

    public function registerAction()
    {
        $this->render('register');
    }
    public function loginAction()
    {
        $this->render('login');
    }

    public function indexAction()
    {
        $this->render('index');
    }

    public function logoutAction()
    {
        session_start();
        session_destroy();
        header('Location: /PiePHP/');
    }

    public function registerViewAction()
    {
        $email = $this->request->post('email');
        $password = $this->request->post('password');
        $firstname = $this->request->post('firstname');
        $lastname = $this->request->post('lastname');
        $birthdate = $this->request->post('birthdate');
        $address = $this->request->post('address');
        $zipcode = $this->request->post('zipcode');
        $city = $this->request->post('city');
        $country = $this->request->post('country');

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Erreur: l'adresse e-mail n'est pas valide.";
            return;
        }

        if (strlen($password) < 6) {
            echo "Erreur: le mot de passe doit comporter au moins 6 caractères.";
            return;
        }

        $userData = array(
            'email' => $email,
            'password' => $password,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'birthdate' => $birthdate,
            'address' => $address,
            'zipcode' => $zipcode,
            'city' => $city,
            'country' => $country
        );

        $userModel = new UserModel($userData);

        if (!$userModel->isEmailUnique(array('email' => $email))) {
            echo "Erreur: l'adresse e-mail est déjà utilisée.";
            return;
        }

        $userModel->save();
        header('Location: /PiePhp/user/login');
    }


    public function testAction()
    {
        $userModel = new UserModel((array('email' => "email", 'password' => "password")));

        var_dump($userModel->email);
    }


    public function loginViewAction()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $email = $this->request->post('email');
        $password = $this->request->post('password');

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Erreur: l'adresse e-mail est pas valide.";
            return;
        }

        if (empty($password)) {
            echo "Erreur: le mot de passe ne peut pas être vide.";
            return;
        }
        $userModel = new UserModel(array('email' => $email, 'password' => $password));
        $user = $userModel->Login();
        $id = $user['id'] ?? null;

        if ($id) {
            $_SESSION['id'] = $id;
            $_SESSION['email'] = $user['email'];
            $_SESSION['firstname'] = $user['firstname'];
            $_SESSION['lastname'] = $user['lastname'];
            $_SESSION['birthdate'] = $user['birthdate'];
            $_SESSION['address'] = $user['address'];
            $_SESSION['zipcode'] = $user['zipcode'];
            $_SESSION['city'] = $user['city'];
            $_SESSION['country'] = $user['country'];
            $_SESSION['password'] = $user['password'];

            header('Location: /PiePhp/user/');
        } else {
            echo "Erreur: échec de la connexion, vérifiez vos identifiants.";
        }
    }

    public function editProfileAction()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $userId = $_SESSION['id'];
        $user = new UserModel();
        $userData = $user->findAll(['id' => $userId]);
        if (is_array($userData) && count($userData) > 0) {
            $user = new UserModel(
                array(
                    'id' => $userData[0]['id']
                )
            );
            $data = [
                'email' => $this->request->post('email'),
                'firstname' => $this->request->post('firstname'),
                'lastname' => $this->request->post('lastname'),
                'birthdate' => $this->request->post('birthdate'),
                'address' => $this->request->post('address'),
                'zipcode' => $this->request->post('zipcode'),
                'city' => $this->request->post('city'),
                'country' => $this->request->post('country'),
                'password' => $this->request->post('password'),


            ];
            $_SESSION['email'] = $data['email'];
            $_SESSION['firstname'] = $data['firstname'];
            $_SESSION['lastname'] = $data['lastname'];
            $_SESSION['birthdate'] = $data['birthdate'];
            $_SESSION['address'] = $data['address'];
            $_SESSION['zipcode'] = $data['zipcode'];
            $_SESSION['city'] = $data['city'];
            $_SESSION['country'] = $data['country'];
            $_SESSION['password'] = $data['password'];

            $user->update($userId, $data);
            header('Location: /PiePhp/user/');
        }
    }

    public function deleteAction()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $userModel = new UserModel();
                $userModel->delete($_SESSION['id']);

        session_destroy();
        header('Location: /PiePHP');
        exit;
    }
}
