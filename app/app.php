<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Stylist.php";
    require_once __DIR__."/../src/Client.php";

    use Symfony\Component\Debug\Debug;
    Debug::enable();

    $server = 'mysql:host=localhost;dbname=hair_salon';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app = new Silex\Application();
    // $app['debug'] = true;

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
	Request::enableHttpMethodParameterOverride();

    /* Homepage -- shows stylists */
    $app->get("/", function() use ($app)
	{
		return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll(), 'form' => false));
	});

    $app->get("/stylist/{id}", function($id) use ($app)
	{
		$stylist = Stylist::find($id);
		return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
	});

    $app->post("/stylists", function() use ($app)
	{
		$stylist = new Stylist($_POST['name']);
		$stylist->save();
		return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
	});

    $app->post("/stylists", function() use ($app)
	{
		$stylist = new Stylist($_POST['name']);
		$stylist->save();
		return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
	});

	$app->get("/stylists/{id}/edit_form", function($id) use ($app)
	{
		$current_stylist = Stylist::find($id);
		$stylists = Stylist::getAll();
		return $app['twig']->render('index.html.twig', array('current_stylist' => $current_stylist, 'stylists' => $stylists, 'form' => true));
	});

	$app->patch("/stylists/updated", function() use ($app)
	{
		$stylist_to_edit = Stylist::find($_POST['current_stylistId']);
		$stylist_to_edit->update($_POST['name']);
		return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
	});

	$app->delete("/stylists/{id}/delete", function($id) use ($app)
	{
		$stylist = Stylist::find($id);
		$stylist->delete();
		return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll(), 'form' => false));
	});

    $app->post("/clients", function() use ($app)
	{
		$client = new Client($_POST['name'], $_POST['stylist_id']);
		$client->save();
		$stylist = Stylist::find($_POST['stylist_id']);
		return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
	});

    $app->patch("/clients/updated", function() use ($app)
	{
		$client_to_edit = Client::find($_POST['current_clientId']);
		$client_to_edit->update($_POST['name']);
		return $app['twig']->render('index.html.twig', array('clients' => $client_to_edit));
	});

    $app->delete("/clients/{stylists_id}/{client_id}/delete", function($stylists_id, $client_id) use ($app)
	{
		$client = Client::find($client_id);
		$client->delete();
		$stylist = Stylist::find($stylists_id);
		return $app['twig']->render('stylist.html.twig', array('stylists' => $stylist, 'clients' => $stylist->getClients()));//add confirm page here
	});

    $app->get("/client/{sid}/{cid}/edit_form", function($sid, $cid) use ($app)
	{
		$current_client = Client::find($cid);
		$stylist = Stylist::find($sid);
		return $app['twig']->render('stylist.html.twig', array('current_client' => $current_client, 'stylist' => $stylist, 'clients' => $stylist->getClients()));
	});

    $app->get("/client/{id}", function($id) use ($app)
	{
		$current_client = Client::find($id);
		return $app['twig']->render('client.html.twig', array('current_client' => $current_client));
	});

    return $app;
 ?>
