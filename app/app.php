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

    $app->post("/stylists", function() use ($app)
	{
		$stylist = new Stylist($_POST['name']);
		$stylist->save();
		return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll(), 'navbar' => true));
	});

    $app->post("/stylists", function() use ($app)
	{
		$stylist = new Stylist($_POST['name']);
		$stylist->save();
		return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll(), 'navbar' => true));
	});

	$app->get("/stylists/{id}/edit_form", function($id) use ($app)
	{
		$current_stylist = Stylist::find($id);
		$stylists = Stylist::getAll();
		return $app['twig']->render('index.html.twig', array('current_stylist' => $current_stylist, 'stylists' => $stylists, 'form' => true, 'navbar' => true));
	});

	$app->patch("/stylists/updated", function() use ($app)
	{
		$stylist_to_edit = Stylist::find($_POST['current_stylistId']);
		$stylist_to_edit->update($_POST['name']);
		return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll(), 'navbar' => true));
	});

	$app->delete("/stylists/{id}/delete", function($id) use ($app)
	{
		$stylist = Stylist::find($id);
		$stylist->delete();
		return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll(), 'form' => false, 'navbar' => true));
	});

    return $app;
 ?>
