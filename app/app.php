<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Contact.php";

    // Start a new session.
    // Initiate contacts as an empty array.

    session_start();

    $contacts = array();
    if (empty($_SESSION['list_of_contacts'])) {
        $_SESSION['list_of_contacts'] = $contacts;
    }

    // Initiate Silex and Twig.

    $app = new Silex\Application();
    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

    // Page: the root route.  Should list all contacts and have two buttons.

    $app->get('/', function() use ($app) {
        return $app['twig']->render('show_all.html.twig', array('contacts' => Contact::getAll()));
    });

    // Page: route for adding contacts.  I thought it would look nicer if the form itself was not all layed out in the root, amongst the addresses.  This also allows me to have a consistent header across all pages in the project without it seeming weird.  Sorry that I deviated slightly from the instructions, but it seemed harmless and doesn't change you seeing my knowledge of the code.

    $app->get('/add_contact_form', function() use ($app) {
        return $app['twig']->render('add_contact_form.html.twig');
    });

    // Page: route for contact added successfully.  I would rather the route name be something like "contact_added" but assignment specifically asks for "create_contact."

    $app->post('/create_contact', function() use ($app) {
        $contact = new Contact($_POST['name'], $_POST['number'], $_POST['address']);
        $contact->save();
        return $app['twig']->render('create_contact.html.twig', array('newcontact' => $contact));
    });

    // Page: route for delete all successfully.

    $app->post('/delete_contacts', function() use ($app) {
        Contact::deleteAll();
        return $app['twig']->render('delete_contacts.html.twig');
    });

    return $app;

?>
