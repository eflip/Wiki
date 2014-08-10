<?php

include 'model/wiki.orm.php';

echo $this->lf->mvc('wiki', $_app['ini']);
/*$page = wiki_orm::getpage($_app['ini']);

echo '<h2>'.$page['title'].'</h2>';
echo $page['content'];*/

?>