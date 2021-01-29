<?php

require __DIR__ . '/altoRooter/AltoRouter.php';

/**
 * This can be useful if you're using PHP's built-in web server, to serve files like images or css
 * @link https://secure.php.net/manual/en/features.commandline.webserver.php
 */
// pas commenté de base
// if (file_exists($_SERVER['SCRIPT_FILENAME']) && pathinfo($_SERVER['SCRIPT_FILENAME'], PATHINFO_EXTENSION) !== 'php') {
//     return;
// }

//connection bdd
//

$router = new AltoRouter();
$router->setBasePath('/Clay/apiRest');
$router->map('GET|POST', '/', 'home#index', 'home'); // Page d'accueil


$router->map('GET', '/entraineurs/', 'GetEntraineurs#show', 'GetEntraineurs_show'); // Listes de la table entraineurs
$router->map('GET', '/joueurs.php/', 'GetJoueurs#show', 'GetJoueurs_show'); // Listes de la table Joueurs

$router->map('GET', '/entraineurs/[i:id]', 'GetByEntraineurs#show', 'GetByEntraineurs_show'); // Listes de la table entraineurs
$router->map('GET', '/joueurs.php/[i:id]', 'GetByidJoueurs#show', 'GetByidJoueurs_show'); // Listes de la table Joueurs

// $router->map('POST', '/entraineurs/[i:id]/[delete|update:action]', 'usersController#doAction', 'users_do');
$router->map('POST', '/entraineurs/[i:id]', 'usersController#doAction', 'users_do');


$router->map('GET', '/entraineurs/ ', ['c' => 'userProduits', 'a' => 'ListAction']);

// match current request
$match = $router->match();
?>
<h1>AltoRouter</h1>

<h3>Current request: </h3>
<pre>
    Target: <?php var_dump($match['target']); ?>
    Params: <?php var_dump($match['params']); ?>
    Name:   <?php var_dump($match['name']); ?>
</pre>

<h3>Try these requests: </h3>
<p><a href="<?php echo $router->generate('home'); ?>">GET <?php echo $router->generate('home'); ?></a></p>

<p><a href="<?php echo $router->generate('GetEntraineurs_show'); ?>">GET <?php echo $router->generate('GetEntraineurs_show'); ?></a></p>
<p><a href="<?php echo $router->generate('GetByEntraineurs_show',['id'=>2]); ?>">GET <?php echo $router->generate('GetByEntraineurs_show',['id'=>2]); ?></a></p>

<p><a href="<?php echo $router->generate('GetJoueurs_show'); ?>">GET <?php echo $router->generate('GetJoueurs_show'); ?></a></p>
<p><a href="<?php echo $router->generate('GetByidJoueurs_show',['id' => 1]); ?>">GET <?php echo $router->generate('GetByidJoueurs_show',['id' => 1]); ?></a></p>


<!-- <form action="<?php// echo $router->generate('users_do', ['id' => 10, 'action' => 'delete']); ?>" method="post"><button type="submit"> -->
        <?php //echo $router->generate('users_do', ['id' => 10, 'action' => 'delete']); ?></button></form>

<form action="<?php echo $router->generate('users_do', ['id' => 2]); ?>" method="post"><button type="submit">
        <?php echo $router->generate('users_do', ['id' => 2]); ?></button></form>