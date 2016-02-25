<?php
App::uses('AppModel', 'Model');
/**
 * Created by JetBrains PhpStorm.
 * User: yoophi
 * Date: 13. 1. 14.
 * Time: PM 2:55
 * To change this template use File | Settings | File Templates.
 */
class BookToc extends AppModel
{
    public $actsAs = array('Tree' => array('scope' => 'Book'));
    public $belongsTo = array('Book');

}
