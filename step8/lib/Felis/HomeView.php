<?php

namespace Felis;

/**
 * View class uses by index.html (home page)
 */
class HomeView  extends View {
    /**
     * Constructor
     * Sets the page title and any other settings.
     */
    public function __construct() {
        $this->setTitle("Felis Investigations");

        $this->addLink("login.php", "Log in");
    }

    /**
     * Add content to the header
     * @return string Any additional comment to put in the header
     */
    protected function headerAdditional() {
        return <<<HTML
<p>Welcome to Felis Investigations!</p>
<p>Domestic, divorce, and carousing investigations conducted without publicity. People and cats shadowed
    and investigated by expert inspectors. Katnapped kittons located. Missing cats and witnesses located.
    Accidents, furniture damage, losses by theft, blackmail, and murder investigations.</p>
<p><a href="">Learn more</a></p>
HTML;
    }

    public function testimonials(){
        $html = '';
        if(sizeof($this->leftTestimonials) != 0){
            $html = <<<HTML
<section class = "testimonials">
<h2>TESTIMONIALS</h2>
<div class = "left">
HTML;
            foreach($this->leftTestimonials as $left){
                $html .= $left;
            }
            $html .= "</div>";
            if(sizeof($this->rightTestimonials)!= 0){
                $html .= "<div class = \"right\">";
                foreach($this->rightTestimonials as $right){
                    $html .= $right;
                }
                $html .= "</div>";
            }
            $html .= <<<HTML
</section>
HTML;

        }
    return $html;
    }

    public function addTestimonial($message, $author){
        if(sizeof($this->leftTestimonials) == 0){
            $target =& $this->leftTestimonials;
        }
        else if(sizeof($this->rightTestimonials) == 0){
            $target =& $this->rightTestimonials;
        }
        else if(sizeof($this->leftTestimonials)%2 != 0){
            $target =& $this->leftTestimonials;
        }
        else if(sizeof($this->rightTestimonials)%2 != 0){
            $target =& $this->rightTestimonials;
        }
        else{
            $target =& $this->leftTestimonials;
        }
        $target[]="
        <blockquote>
        <p> ". $message ."</p>
        <cite> ". $author ."</cite>
        </blockquote>
        ";
    }

    private $rightTestimonials;
    private $leftTestimonials;
}