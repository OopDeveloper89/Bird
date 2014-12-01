<?php

namespace Bird\Login\Service;
use Bird\Dao\Pdo\UserDao;
use Bird\Entity\User;

/**
 * Service to login.
 *
 * @author kemal
 */
class LoginService {

    /**
     * @param $email
     * @param $password
     *
     * @return User|NULL
     */
    public function loginByEmailAndPassword($email, $password) {
        $dao = new UserDao();
        $user = $dao->findByEmail($email);
        if ($user instanceof User) {
            echo password_hash('test', PASSWORD_DEFAULT);
            echo $user->getPassword();
            if (password_verify($password, $user->getPassword())) {
                return $user;
            }
        }
        return null;
    }

    public function save(User $user) {
        $dao = new UserDao();
        $dao->save($user);
        echo 'saved!';
    }

} 