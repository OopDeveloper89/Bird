<?php

namespace Bird\Login\Controller;
use Bird\Dao\Pdo\UserDao;
use Bird\Entity\User;
use Bird\Login\Service\LoginService;
use Symfony\Component\HttpFoundation\Response;


/**
 * @author kemal
 */
class LoginController {

    /**
     * @var LoginService
     */
    private $loginService;

    /**
     * Constructor.
     *
     * @author kemal
     */
    public function __construct() {
        $this->loginService = new LoginService();
    }

    /**
     * @param $email
     * @param $password
     * @return Response
     */
    public function loginAction($email, $password) {
        $this->loginService->loginByEmailAndPassword($email, $password);

        $dao = new UserDao();
        $user = $dao->findByEmail($email);

        if (! $user instanceof User) {
            return new Response('User not found!');
        }


    }
}