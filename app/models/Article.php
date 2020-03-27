<?php

namespace Enway\App\Models;

use Enway\App\Core\Model;

class Article extends Model {


    public function findBySlug($slug) {
        return $this->findFirst(array(
            'conditions' => [
                'slug' => $slug
            ]
        ));
    }
}
