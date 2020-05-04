<?php


namespace Felis;


class DeleteCaseController
{
    public function __construct(Site $site, array $get, $post){
        $root = $site->getRoot();
        $id = $post['id'];
        if(isset($post["yes"])){
            $cases = new Cases($site);
            $cases->delete($id);
            // this should direct to cases but changed to test if post was correct
            $this->redirect = "$root/staff.php";
        }

        $this->redirect = "$root/cases.php";

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