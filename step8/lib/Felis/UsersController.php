<?php


namespace Felis;


class UsersController {
    public function __construct(Site $site, User $user, array $post) {
        $root = $site->getRoot();
        $this->redirect = "$root/users.php";
        if(isset($post['add'])){
            $this->redirect = "$root/user.php";
        }
        else if(isset($post['edit']) && isset($post['user'])){
            $userid = $post['user'];
            $this->redirect = "$root/user.php?id=$userid";
        }
        else if (isset($post['delete']) && isset($post['user'])){
            $users = new Users($site);
            $users->delete($post['user']);
        }
    }

    /**
     * @return mixed
     */
    public function getRedirect() {
        return $this->redirect;
    }


    private $redirect;	///< Page we will redirect the user to.
}