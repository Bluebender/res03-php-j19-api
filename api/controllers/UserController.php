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
        $allUsers = $this->um->getAllUsers();
        $allUsersArray=[];
        foreach ($allUsers as $user){
            $userArray=$user->toArray();
            $allUsersArray[]=$userArray;
        }
        // render
        $this->render($allUsersArray);
    }

    public function getUser(string $get)
    {
        // get the user from the manager
        $id=intval($get);
        $user = $this->um->getUserById($id);
        $userArray=$user->toArray();
        // either by email or by id

        // render
        $this->render($userArray);
    }

    public function createUser(array $post)
    {
        // create the user in the manager
        $UserToCreate=new User (null, $post[1], $post[2], $post[3], $post[4], $post[5]);
        $userCreated = $this->um->createUser($UserToCreate);
        $userCreatedArray=$userCreated->toArray();

        // render the created user
        $this->render($userCreatedArray);
    }

    public function updateUser(array $post)
    {
        // update the user in the manager
        $UserToUpdate=new User ($post[0], $post[1], $post[2], $post[3], $post[4], $post[5]);
        $userUpdated = $this->um->updateUser($UserToUpdate);
        $userUpdatedArray=$userUpdated->toArray();

        // render the updated user
        $this->render($userUpdatedArray);
    }

    public function deleteUser(array $post)
    {
        // delete the user in the manager
        $UserToDelete=new User ($post[0], $post[1], $post[2], $post[3], $post[4], $post[5]);
        $NewUserTab = $this->um->updateUser($UserToDelete);
        $NewUserTabArray=$NewUserTab->toArray();

        // render the list of all users
        $this->render($NewUserTabArray);
    }
}