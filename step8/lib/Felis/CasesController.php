<?php


namespace Felis;


class CasesController
{
    public function __construct(Site $site, $post){
        $root = $site->getRoot();
        //$id = strip_tags($post['id']);
        if(isset($post['add'])){
            $this->redirect = "$root/newcase.php";
        }
        else if(isset($post["delete"])){
            $this->redirect = "$root/deletecase.php?id=".$post['user']."";
        }
        else{
            $this->redirect = "$root/cases.php";
        }
    }

    /**
     * @return string
     */
    public function getRedirect()
    {
        return $this->redirect;
    }

    /**
     * @param string $redirect
     */
    public function setRedirect($redirect)
    {
        $this->redirect = $redirect;
    }


    private $redirect;
}