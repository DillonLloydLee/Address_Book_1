<?php
            //REMEMBER TO REPLACE ALL INSTANCES OF XXXX!!!

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/   XXXX  ";

    // Start a new session.
    // Initiate a new "list" array.

    session_start();

    if (empty($_SESSION['list_of_XXXX'])) {
        $_SESSION['list_of_XXXX'] = $cars;
    }

    // Initiate Silex and Twig.

    $app = new Silex\Application();
    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

    

?>
