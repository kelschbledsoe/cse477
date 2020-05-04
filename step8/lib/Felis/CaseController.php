<?php
namespace Felis;
class CaseController{
    public function __construct(Site $site, $post){
        $root = $site->getRoot();
        $cases = new Cases($site);
        $client = $cases->get($post['id']);
        $client->setNumber($post['number']);
        $client->setSummary($post['summary']);
        $client->setStatus($post['status']);
        $client->setAgent($post['agent']);

        if($cases->update($client)){
            $this->redirect = "$root/cases.php";
        }
        else{
            $this->redirect = "$root/case.php?id=".$post['id']."";
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