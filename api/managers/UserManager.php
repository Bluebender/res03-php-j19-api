<?php

class UserManager extends AbstractManager {

    public function getAllUsers() : array
    {
        $query = $this->db->prepare('SELECT * FROM users');
        $query->execute();
        $loadedUsers = $query->fetchAll(PDO::FETCH_ASSOC);
        
        $loadedUsersObject=[];
        foreach ($loadedUsers as $loadedUser){
            $loadedUserObject = new User ($loadedUser["id"], $loadedUser["username"],$loadedUser["first_name"], $loadedUser["last_name"], $loadedUser["email"]);
            // $loadedUserObject->setId($loadedUser["id"]);
            $loadedUsersObject[] = $loadedUserObject;
        }
        return $loadedUsersObject;
    }

    public function getUserById(int $id) : User
    {
        $query= $this->db->prepare("SELECT * FROM users WHERE id=:value");
        $parameters=['value' => $id];
        $query->execute($parameters);
        $loadedUser = $query->fetch(PDO::FETCH_ASSOC);

        $loadedUserObject=new User ($loadedUser["id"], $loadedUser["username"],$loadedUser["first_name"], $loadedUser["last_name"], $loadedUser["email"]);

        return $loadedUserObject;
    }

    public function createUser(User $user) : User
    {
        $query = $this->db->prepare('INSERT INTO users VALUES (null, :value1, :value2, :value3, :value4)');
        $parameters = [
        'value1' => $user -> getUsername(),
        'value2' => $user -> getFirstName(),
        'value3' => $user -> getLastName(),
        'value4' => $user -> getEmail()
        ];
        $query->execute($parameters);

        $query= $this->db->prepare("SELECT * FROM users WHERE email=:value");
        $parameters=['value' => $user -> getEmail()];
        $query->execute($parameters);
        $loadedSavedUser = $query->fetch(PDO::FETCH_ASSOC);

        $loadedSavedUserObject=new User ($loadedSavedUser["id"], $loadedSavedUser["username"],$loadedSavedUser["first_name"], $loadedSavedUser["last_name"], $loadedSavedUser["email"]);

        return $loadedSavedUserObject;
    }

    public function updateUser(User $user) : User
    {
        $query= $this->db->prepare("UPDATE users SET username=:value2, first_name=:value3, last_name=:value4, email=:value5 WHERE id=:value1");
        $parameters = [
        'value1' => $user -> getId(),
        'value2' => $user -> getUsername(),
        'value3' => $user -> getFirstName(),
        'value4' => $user -> getLastName(),
        'value5' => $user -> getEmail()
        ];
        $query->execute($parameters);

        $query= $this->db->prepare("SELECT * FROM users WHERE email=:value");
        $parameters=['value' => $user -> getEmail()];
        $query->execute($parameters);
        $loadedUpdatedUser = $query->fetch(PDO::FETCH_ASSOC);

        $loadedUpdatedUserObject=new User ($loadedUpdatedUser["id"], $loadedUpdatedUser["username"],$loadedUpdatedUser["first_name"], $loadedUpdatedUser["last_name"], $loadedUpdatedUser["email"]);

        return $loadedUpdatedUserObject;
    }

    public function deleteUser(User $user) : array
    {
        $query= $this->db->prepare("DELETE FROM users WHERE id=:value");
        $parameters = [
        'value' => $user -> getId(),
        ];
        $query->execute($parameters);

        return $this->getAllUsers();
    }
}