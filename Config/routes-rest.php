<?php
if (!defined('ID_RULE')) {
    define('ID_RULE', '[0-9]+');
}

// My Articles
Router::connect('/my/articles', array('controller' => 'my_articles', 'action' => 'index',  '[method]' => 'GET'));
Router::connect('/my/articles', array('controller' => 'my_articles', 'action' => 'add',    '[method]' => 'POST'));
Router::connect('/my/articles/:article_id', array('controller' => 'my_articles', 'action' => 'view', '[method]' => 'GET'),  array('article_id' => ID_RULE));
Router::connect('/my/articles/:article_id', array('controller' => 'my_articles', 'action' => 'edit', '[method]' => 'PUT'),  array('article_id' => ID_RULE));
Router::connect('/my/articles/:article_id', array('controller' => 'my_articles', 'action' => 'edit', '[method]' => 'POST'), array('article_id' => ID_RULE));
Router::connect('/my/articles/:article_id', array('controller' => 'my_articles', 'action' => 'delete', '[method]' => 'DELETE'), array('article_id' => ID_RULE));

// My Photos
Router::connect('/my/photos', array('controller' => 'my_photos', 'action' => 'index',  '[method]' => 'GET'));
Router::connect('/my/photos', array('controller' => 'my_photos', 'action' => 'add',    '[method]' => 'POST'));
Router::connect('/my/photos/:photo_id', array('controller' => 'my_photos', 'action' => 'view', '[method]' => 'GET'),  array('photo_id' => ID_RULE));
Router::connect('/my/photos/:photo_id', array('controller' => 'my_photos', 'action' => 'edit', '[method]' => 'PUT'),  array('photo_id' => ID_RULE));
Router::connect('/my/photos/:photo_id', array('controller' => 'my_photos', 'action' => 'edit', '[method]' => 'POST'), array('photo_id' => ID_RULE));
Router::connect('/my/photos/:photo_id', array('controller' => 'my_photos', 'action' => 'delete', '[method]' => 'DELETE'), array('photo_id' => ID_RULE));

// My Book Spine
Router::connect('/my/books/:book_id/spine', array('controller' => 'my_books', 'action' => 'spine_index',  '[method]' => 'GET'),    array('book_id' => ID_RULE));
Router::connect('/my/books/:book_id/spine', array('controller' => 'my_books', 'action' => 'spine_add',    '[method]' => 'POST'),   array('book_id' => ID_RULE));
Router::connect('/my/books/:book_id/spine/:spine_id', array('controller' => 'my_books', 'action' => 'spine_delete', '[method]' => 'DELETE'), array('spine_id' => ID_RULE, 'book_id' => ID_RULE));
Router::connect('/my/books/:book_id/spine_order_update', array('controller' => 'my_books', 'action' => 'spine_order_update',    '[method]' => 'POST'),   array('book_id' => ID_RULE));

