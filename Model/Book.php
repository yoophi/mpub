<?php
App::uses('AppModel', 'Model');
/**
 * @property BookSpine $BookSpine
 */
class Book extends AppModel {

    public $actsAs = array('Containable');
    public $belongsTo = array('Author' => array('className' => 'User', 'foreignKey' => 'user_id'));
    public $hasMany = array('Article', 'BookToc');

    public function getBookInfo($book_id) {
        if (empty($book_id)) {
            return false;
        }

//        $this->unbindModel(array('hasMany' => array('BookSpine')));
//
//        $conditions = array('Book.id' => $book_id);
//        //$fields = array('Book.*', 'User.id', 'User.username', 'User.email');
//        // $this->bindModel(array('belongsTo' => array('User')));
//
//        $book_info = $this->find('first', compact('conditions', 'fields'));
//        $book_info = Set::flatten($book_info);

        $conditions = array("Book.id" => $book_id);
        $contain = array('Author');
        $res = $this->find('first', compact('fields', 'conditions', 'contain'));
        $book_info = Set::flatten($res);

        return $book_info;
    }

//    public function getBookToc($book_id) {
//        App::uses('Toc', 'Model');
//        $Toc = new Toc;
//
//        $tocs = $Toc->getBookTocThreaded($book_id);
//        return $tocs;
//    }

    public function getToc($book_id = null ) {
        if (empty($book_id) && !empty($this->id)) {
            $book_id = $this->id;
        }

        if (empty($book_id)) {
            throw new NotFoundException(__('Invalid book'));
        }

        $fields = array('toc_json');
        $data = $this->read($fields, $book_id);
        if (empty($data[$this->alias]['toc_json'])) {
            return false;
        } 

        $toc = json_decode($data[$this->alias]['toc_json'], true);
        return $toc;
    }

    public function getSpine($book_id = null) {
        $conditions = array('Article.book_id' => $book_id);
        return $this->Article->find('all', compact('conditions'));
    }

    public function addSpine($book_id, $article_id) {
        return false;
    }
}
?>
