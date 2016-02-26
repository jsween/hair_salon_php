<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Stylist.php";
    require_once __DIR__."/../src/Client.php";

    // use Symfony\Component\Debug\Debug;
    // Debug::enable();

    $server = 'mysql:host=localhost;dbname=hair_salon';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app = new Silex\Application();
    // $app['debug']=true;

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
	Request::enableHttpMethodParameterOverride();
    /* Homepage -- shows stylists */
    $app->get("/", function() use ($app)
	{
		return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll(), 'form' => false, 'navbar' => true));
	});

    $app->post("/stylist", function() use ($app)
	{
		$stylist = new Stylist($_POST['name']);
		$stylist->save();
		return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
	});

    return $app;
 ?>
