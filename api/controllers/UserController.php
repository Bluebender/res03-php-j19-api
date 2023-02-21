<?php

class UserController extends AbstractController {
    private UserManager $um;

    public function __construct()
    {
        $this->um = new UserManager();
    }

    public function getUsers()
    {
        // get all the users from the manager
        $users = $this->um->getAllUsers();
        $usersArray=[];
        foreach ($users as $user){
            $userArray=$user->toArray();
            $usersArray[]=$userArray;
        }
        // render
        $this->render($usersArray);
    }

    public function getUser(string $get)
    {
        // get the user from the manager
        $id=intval($get);
        $user = $this->um->getUserById($id);
        // either by email or by id

        // render
        $this->render($user);

    }

    public function createUser(array $post)
    {
        // create the user in the manager

        // render the created user
    }

    public function updateUser(array $post)
    {
        // update the user in the manager

        // render the updated user
    }

    public function deleteUser(array $post)
    {
        // delete the user in the manager

        // render the list of all users
    }
}