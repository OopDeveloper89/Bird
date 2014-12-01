<?php

namespace Bird\Dao\Pdo;
use Bird\Entity\User;

/**
 * Class UserDao
 * @package Bird\Dao\Pdo
 */
class UserDao extends AbstractDao {

    /**
     * Finds entity by id.
     *
     * @author kemal
     * @param int $id
     * @return User|NULL
     */
    public function findById($id) {
        $stmt = $this->getConnection()->prepare('
                          SELECT  `id`,
                                  `email`,
                                  `password`,
                                  `register_date` as `registerDate`
                          FROM `users`
                          WHERE `id` = :id');
        $stmt->bindValue(':id', $id);
        $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Bird\Entity\User');
        $all = $stmt->fetchAll();
        return $all[0];
    }

    /**
     * Finds entity by email.
     *
     * @author kemal
     * @param string $email
     * @return User|NULL
     */
    public function findByEmail($email) {
        $stmt = $this->getConnection()->prepare('
                          SELECT  `id`,
                                  `email`,
                                  `password`,
                                  `register_date` as `registerDate`
                          FROM `users`
                          WHERE `email` LIKE :email');
        $stmt->bindParam(':email', $email);
        $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Bird\Entity\User');
        $stmt->execute();
        $all = $stmt->fetchAll();
        return $all[0];
    }

    /**
     * @author kemal
     * @param User $user
     * @return void
     */
    public function save(User $user) {
        if (empty($user->getId())) {
            $this->insert($user);
        } else {
            $this->update($user);
        }
    }

    /**
     * @author kemal
     * @param User $user
     * @return void
     */
    private function insert(User $user) {
        $stmt = $this->getConnection()->prepare('
            INSERT INTO `users`
            (`email`, `password`, `register_date`)
            VALUES
            (:email, :password, :register_date)
        ');
        $stmt->bindParam(':email', $user->getEmail());
        $stmt->bindParam(':password', $user->getPassword());
        $stmt->bindParam(':register_date', $user->getRegisterDate());
        $stmt->execute();
    }

    /**
     * @author kemal
     * @param User $user
     * @return void
     */
    private function update(User $user) {
        $stmt = $this->getConnection()->prepare('
            UPDATE `users`
            SET `email` = :email,
                `password` = :password,
                `register_date` = :registerDate
            WHERE `id` = :id
        ');
        $stmt->bindParam(':email', $user->getEmail());
        $stmt->bindParam(':password', $user->getPassword());
        $stmt->bindParam(':registerDate', $user->getRegisterDate());
        $stmt->bindParam(':id', $user->getId());
        $stmt->execute();
    }
}