<?php namespace Controllers;

use Models\Brokers\SignUpBroker;
use Models\Classes\FormValidator;
use Models\Classes\Logger;
use Models\Classes\User;
use Zephyrus\Network\Response;
use Zephyrus\Application\Flash;
use Zephyrus\Application\Form;
use Zephyrus\Application\Session;
use Zephyrus\Security\Cryptography;

class SignUpController extends BaseController
{
    private const emptyArray = [ 'firstname' => '', 'lastname' => '', 'username' => '', 'phone' => '', 'email' => '' ];

    public function initializeRoutes()
    {
        $this->get("/Connexion/Register", "index");
        $this->post("/Connexion/Register", "insert");
    }

    public function index(): Response
    {
        if ($this->isLogged()) {
            return $this->redirect("/General/Main");
        }
        return $this->render("/connexion/sign-up", [
            'currentPage' => "Sign up",
            'values' => self::emptyArray,
        ]);
    }

    public function insert(): Response
    {
        $form = $this->buildForm();
        $validator = new FormValidator($form);
        $validator->validateSignUpRules();
        if (!$form->verify()) {
            Flash::error($form->getErrorMessages());
            return $this->redirect("/Connexion/Register");
        } else {
            $user = $this->createUser($form);
            $this->setUserSessionInformation($user);
            Logger::logUser($user->username);
            return $this->redirect("/General/Main");
        }
    }

    private function createUser(Form $form): User
    {
        $broker = new SignUpBroker();
        $user = $this->setUserValues($form);
        $broker->insert($user);
        $this->setUserSessionInformation($user);
        Flash::success("Your account was created successfully!");
        return $user;
    }

    private function setUserValues(Form $form): User
    {
        $user = new User();
        $user->username = $form->getValue("username");
        $user->firstname = $form->getValue("firstname");
        $user->lastname = $form->getValue("lastname");
        $user->phone = $form->getValue("phone");
        $user->email = $form->getValue("email");
        $user->secret = Cryptography::randomString(64);
        Session::getInstance()->set("secret", Cryptography::encrypt($form->getValue("password"), $user->secret));
        $user->password = Cryptography::hashPassword($form->getValue("password"));
        return $user;
    }
}
