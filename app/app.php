<?php

use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;


// Register global error and exception handlers
ErrorHandler::register();
ExceptionHandler::register();

// Register service providers.

$app->register(new Silex\Provider\DoctrineServiceProvider());

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));





$app['twig'] = $app->share($app->extend('twig', function(Twig_Environment $twig, $app) {
    $twig->addExtension(new Twig_Extensions_Extension_Text());
    return $twig;
    }));

$app->register(new Silex\Provider\ValidatorServiceProvider());

$app->register(new Silex\Provider\FormServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider());
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\SecurityServiceProvider(), array(
    'security.firewalls' => array(
        'secured' => array(
            'pattern' => '^/',
            'anonymous' => true,
            'logout' => true,
            'form' => array('login_path' => '/login', 'check_path' => '/login_check'),
            'users' => $app->share(function () use ($app) {
                return new datatransfer\DAOmanage\UserDAO($app['dbs']['manage']);
            }),
        ),
    ),
    'security.role_hierarchy' => array(
        'ROLE_ADMIN' => array('ROLE_USER'),
    ),
    'security.access_rules' => array(
        array('^/admin', 'ROLE_ADMIN'),
    ),
));


$app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => __DIR__.'/../var/logs/datatransfer.log',
    'monolog.name' => 'datatransfer',
    'monolog.level' => $app['monolog.level']
));
$app->register(new Silex\Provider\ServiceControllerServiceProvider());
if (isset($app['debug']) && $app['debug']) {
    $app->register(new Silex\Provider\HttpFragmentServiceProvider());
    $app->register(new Silex\Provider\WebProfilerServiceProvider(), array(
        'profiler.cache_dir' => __DIR__.'/../var/cache/profiler'
    ));
}

//Register error handler	
$app->error(function (\Exception $e, $code) use ($app) {
    switch ($code) {
        case 403:
            $message = 'Access denied.';
            break;
        case 404:
            $message = 'The requested resource could not be found.';
            break;
        default:
            $message = "Something went wrong.";
    }
    return $app['twig']->render('error.html.twig', array('message' => $message));
});


// Register services.

$app['dao.manufacturer'] = $app->share(function ($app) {
    return new datatransfer\DAO\ManufacturerDAO($app['db']);
});

$app['dao.plug'] = $app->share(function ($app) {
    return new datatransfer\DAO\PlugDAO($app['db']);
});

$app['dao.software'] = $app->share(function ($app) {
    return new datatransfer\DAO\SoftwareDAO($app['db']);
});

$app['dao.volume'] = $app->share(function ($app) {
    return new datatransfer\DAO\VolumeDAO($app['db']);
});

$app['dao.camera'] = $app->share(function ($app) {
	$cameraDAO = new datatransfer\DAO\CameraDAO($app['db']);
	$cameraDAO->setManufacturerDAO($app['dao.manufacturer']);
    return $cameraDAO;
});

$app['dao.media'] = $app->share(function ($app) {
	$mediaDAO = new datatransfer\DAO\MediaDAO($app['db']);
	$mediaDAO->setCameraDAO($app['dao.camera']);
    return $mediaDAO;
});

$app['dao.codec'] = $app->share(function ($app) {
	$codecDAO = new datatransfer\DAO\CodecDAO($app['db']);
	$codecDAO->setMediaDAO($app['dao.media']);
	$codecDAO->setCameraDAO($app['dao.camera']);
    return $codecDAO;
});

$app['dao.resolution'] = $app->share(function ($app) {
	$resolutionDAO = new datatransfer\DAO\ResolutionDAO($app['db']);
	$resolutionDAO->setMediaDAO($app['dao.media']);
	$resolutionDAO->setCameraDAO($app['dao.camera']);
	$resolutionDAO->setCodecDAO($app['dao.codec']);
    return $resolutionDAO;
});

$app['dao.framerate'] = $app->share(function ($app) {
	$framerateDAO = new datatransfer\DAO\FramerateDAO($app['db']);
	$framerateDAO->setMediaDAO($app['dao.media']);
	$framerateDAO->setCameraDAO($app['dao.camera']);
	$framerateDAO->setCodecDAO($app['dao.codec']);
	$framerateDAO->setResolutionDAO($app['dao.resolution']);
    return $framerateDAO;
});

$app['dao.card'] = $app->share(function ($app) {
	$cardDAO = new datatransfer\DAO\CardDAO($app['db']);
	$cardDAO->setMediaDAO($app['dao.media']);
    return $cardDAO;
});

$app['dao.sampling'] = $app->share(function ($app) {
	$samplingDAO = new datatransfer\DAO\SamplingDAO($app['db']);
	$samplingDAO->setMediaDAO($app['dao.media']);
	$samplingDAO->setCameraDAO($app['dao.camera']);
	$samplingDAO->setCodecDAO($app['dao.codec']);
	$samplingDAO->setResolutionDAO($app['dao.resolution']);
    return $samplingDAO;
});

$app['dao.formatbitrate'] = $app->share(function ($app) {
	$formatbitrateDAO = new datatransfer\DAO\FormatbitrateDAO($app['db']);
	$formatbitrateDAO->setMediaDAO($app['dao.media']);
	$formatbitrateDAO->setCameraDAO($app['dao.camera']);
	$formatbitrateDAO->setCodecDAO($app['dao.codec']);
	$formatbitrateDAO->setResolutionDAO($app['dao.resolution']);
    return $formatbitrateDAO;
});

$app['dao.control'] = $app->share(function ($app) {
	$controlDAO = new datatransfer\DAO\ControlDAO($app['db']);
	$controlDAO->setSoftwareDAO($app['dao.software']);
    return $controlDAO;
});

$app['dao.volume'] = $app->share(function ($app) {
	$volumeDAO = new datatransfer\DAO\VolumeDAO($app['db']);
    return $volumeDAO;
});


// Register services. Manage
$app['dao.user'] = $app->share(function ($app) {
    return new datatransfer\DAOmanage\UserDAO($app['dbs']['manage']);
});

$app['dao.addREDrequest'] = $app->share(function ($app) {
    return new datatransfer\DAOmanage\addREDrequestDAO($app['db']);
});



