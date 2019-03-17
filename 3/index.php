<?php
require_once __DIR__ . '/autoload.php';

$user = new \lib\User('Ivan');

//user creates new article
$art = $user->createNewArticle('New article 1');
$art2 = $user->createNewArticle('New article 2');

//get the author of the article
echo 'author id = ' . $art->getAuthor() . '<Br>';

//get all the articles of the user
$allArticles = $user->getAllArticles();

//change the author of the article
echo $art->changeAuthor(2);
echo 'new author id = ' . $art->getAuthor() . '<Br>';



/**
 * Это решение можно дорабать и расширять далее. Но так как в задаче были четкие требования - выполнил только необходимую
 * функциональность, согласно принципу KISS.
 * Для статей можно при необходимости написать фабричный метод, если у нас появятся другие сущности, например
 * новости и пр.
 * Возможно функционал сохранения статей вынести в отдельный класс (ArticleStorage), где в констурторе указывать
 * новой статье автора и название. При этом подлючение к БД будем передавать через конструктор и помещать в
 * приватное свойство. Тем самым реализуя DI.
 * Для пользователей можно реализовать систему ролей. Например авторы могут создавать новые статьи. А гости только
 * получать их.
 *
 */
