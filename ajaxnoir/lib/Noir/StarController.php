<?php


namespace Noir;


class StarController extends Controller {
    /**
     * StarController constructor.
     * @param Site $site Site object
     * @param $user User object
     * @param array $post $_POST
     */
    public function __construct(Site $site, $user, $post) {
        parent::__construct($site);
        $this->id = $post['id'];
        $this->rating = $post['rating'];

        $movies = new Movies($site);
        if($movies->updateRating($user, $this->id, $this->rating)){
            $this->result = json_encode(['ok' => true]);
        }
        else{
            $this->result = json_encode(['ok' => false, 'message' => 'Failed to update database!']);
        }
    }
    private $id;
    private $rating;
}