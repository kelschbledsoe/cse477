<?php


namespace Felis;


class PasswordValidateView extends View
{
    const INVALID_VALIDATOR = 1;
    const INVALID_EMAIL = 2;
    const EMAIL_DOES_NOT_MATCH = 3;
    const PASSWORD_DOES_NOT_MATCH = 4;
    const PASSWORD_TOO_SHORT = 5;
    public function __construct($site, $get){
        $this->setTitle("Felis Password Entry");
        $this->site = $site;
        $this->get = $get;
        $this->validator = strip_tags($get['v']);

        if(isset($get['e'])){
            $this->error = strip_tags($get['e']);
        }
    }

    public function present(){
        $html = <<<HTML
<form action="post/password-validate.php" method="post">
<fieldset>
<legend>Change Password</legend>
<input type="hidden" name="validator" value="$this->validator">
<p><label for="email">Email</label><br>
<input type="email" name="email" id="email" placeholder="Email"></p>
<p><label for="password">Password:</label><br>
<input type="password" name="password" id="password" placeholder="password"></p>
<p><label for="password2">Password (again):</label><br>
<input type="password" name="password2" id="password2" placeholder="password"></p>
HTML;
    if($this->error == self::INVALID_VALIDATOR){
        $html .= '<p class="msg">Invalid or unavailable validator.</p>';
    }
    else if($this->error == self::INVALID_EMAIL){
        $html .= '<p class="msg">Email address is not for a valid user.</p>';
    }
    else if($this->error == self::EMAIL_DOES_NOT_MATCH){
        $html .= '<p class="msg">Email address does not match validator.</p>';
    }
    else if($this->error == self::PASSWORD_DOES_NOT_MATCH){
        $html .= '<p class="msg">Passwords did not match.</p>';
    }
    else if($this->error == self::PASSWORD_TOO_SHORT){
        $html .= '<p class="msg">Password too short.</p>';
    }

$html .= <<<HTML
<p>
<button name="ok" value="ok">OK</button>
<button name="cancel" value="cancel">Cancel</button>
</p>
</fieldset>
</form>
HTML;
    return $html;
    }

    private $site;
    private $get;
    private $validator;
    private $error;
}