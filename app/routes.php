<?php

use Symfony\Component\HttpFoundation\Request;

use datatransfer\manage\User;
use datatransfer\Manage\Addredrequest;
use datatransfer\Form\Type\UserType;
use datatransfer\Form\Type\AddREDType;



// Home page
$app->get('/', function () use ($app) {
    $manufacturers = $app['dao.manufacturer']->findAll();
    $plugs = $app['dao.plug']->findAll();
	$softwares = $app['dao.software']->findAll();
	$volumes = $app['dao.volume']->findAll();
   
    return $app['twig']->render('index.html.twig', array('manufacturers' => $manufacturers, 'plugs' => $plugs, 'softwares' => $softwares, 'volumes' => $volumes));
})->bind('home');



// Cameras search
$app->get('/DAO/cameras/{idmanufacturer}', function ($idmanufacturer) use ($app) {
$cameras = $app['dao.camera']->findAllByManufacturer($idmanufacturer);
return $app['twig']->render('renderlist.html.twig', array('elements' => $cameras));
})->bind('camera');

// Cameras search API
$app->get('/API/cameras/{idmanufacturer}', function ($idmanufacturer) use ($app) {
$cameras = $app['dao.camera']->findAllByManufacturer($idmanufacturer);
// Convert an array of objects ($articles) into an array of associative arrays ($responseData)
    $responseData = array();
    foreach ($cameras as $camera) {
        $responseData[] = array(
            'id' => $camera->getId(),
            'title' => $camera->getTitle()
            );
    }
    // Create and return a JSON response
    return $app->json($responseData);
})->bind('api_camera');

// Medias search
$app->get('/DAO/medias/{idcamera}', function ($idcamera) use ($app) {
$medias = $app['dao.media']->findAllByCamera($idcamera);
return $app['twig']->render('renderlist.html.twig', array('elements' => $medias));
})->bind('media');

// Codecs search
$app->get('/DAO/codecs/{idcamera}/{idmedia}', function ($idcamera,$idmedia) use ($app) {
$codecs = $app['dao.codec']->findAllByCameraMedia($idcamera,$idmedia);
return $app['twig']->render('renderlist.html.twig', array('elements' => $codecs));
})->bind('codec');

// Resolutions search
$app->get('/DAO/resolutions/{idcamera}/{idmedia}/{idcodec}', function ($idcamera,$idmedia,$idcodec) use ($app) {
$resolutions = $app['dao.resolution']->findAllByCameraMediaCodec($idcamera,$idmedia,$idcodec);
return $app['twig']->render('renderlist.html.twig', array('elements' => $resolutions));
})->bind('resolution');

// Frame rates search
$app->get('/DAO/framerates/{idcamera}/{idmedia}/{idcodec}/{idresolution}', function ($idcamera,$idmedia,$idcodec,$idresolution) use ($app) {
$framerates = $app['dao.framerate']->findAllByCameraMediaCodecResolution($idcamera,$idmedia,$idcodec,$idresolution);
return $app['twig']->render('renderlist.html.twig', array('elements' => $framerates));
})->bind('framerate');

// Cards search
$app->get('/DAO/cards/{idmedia}', function ($idmedia) use ($app) {
$cards = $app['dao.card']->findAllByMedia($idmedia);
return $app['twig']->render('renderlist.html.twig', array('elements' => $cards));
})->bind('card');

// Sampling search
$app->get('/DAO/sampling/{idcamera}/{idmedia}/{idcodec}/{idresolution}', function ($idcamera,$idmedia,$idcodec,$idresolution) use ($app) {
$sampling = $app['dao.sampling']->findAllByCameraMediaCodecResolution($idcamera,$idmedia,$idcodec,$idresolution);
return $app['twig']->render('renderbits.html.twig', array('elements' => $sampling));
})->bind('sampling');

// Format bitrate search
$app->get('/DAO/formatbitrate/{idcamera}/{idmedia}/{idcodec}/{idresolution}', function ($idcamera,$idmedia,$idcodec,$idresolution) use ($app) {
$formatbitrate = $app['dao.formatbitrate']->findAllByCameraMediaCodecResolution($idcamera,$idmedia,$idcodec,$idresolution);
return $app['twig']->render('rendertitle.html.twig', array('elements' => $formatbitrate));
})->bind('formatbitrate');

// Card writebitrate search
$app->get('/DAO/cardwritebitrate/{idcard}', function ($idcard) use ($app) {
$card = $app['dao.card']->findTheCardInfo($idcard);
return $app['twig']->render('renderwritebitrate.html.twig', array('elements' => $card));
})->bind('cardwritebitrate');

// Card readbitrate search
$app->get('/DAO/cardreadbitrate/{idcard}', function ($idcard) use ($app) {
$card = $app['dao.card']->findTheCardInfo($idcard);
return $app['twig']->render('renderreadbitrate.html.twig', array('elements' => $card));
})->bind('cardreadbitrate');

// Card capacity search
$app->get('/DAO/cardcapacity/{idcard}', function ($idcard) use ($app) {
$card = $app['dao.card']->findTheCardInfo($idcard);
return $app['twig']->render('rendercapacity.html.twig', array('elements' => $card));
})->bind('cardcapacity');

// Control search
$app->get('/DAO/control/{idsoftware}', function ($idsoftware) use ($app) {
$control = $app['dao.control']->findAllBySoftware($idsoftware);
return $app['twig']->render('renderlistcoefficient.html.twig', array('elements' => $control));
})->bind('control');

// Checksource search
$app->get('/DAO/checksource/{idsoftware}', function ($idsoftware) use ($app) {
$software = $app['dao.software']->findTheSoftwareInfo($idsoftware);
return $app['twig']->render('renderchecksource.html.twig', array('elements' => $software));
})->bind('checksource');

// Plug bitrate search
$app->get('/DAO/plugbitrate/{idplug}', function ($idplug) use ($app) {
$plug = $app['dao.plug']->findThePlugInfo($idplug);
return $app['twig']->render('renderbitrate.html.twig', array('elements' => $plug));
})->bind('plugbitrate');

// Volume writebitrate search
$app->get('/DAO/volumewritebitrate/{idvolume}', function ($idvolume) use ($app) {
$volume = $app['dao.volume']->findTheVolumeInfo($idvolume);
return $app['twig']->render('renderwritebitrate.html.twig', array('elements' => $volume));
})->bind('volumewritebitrate');

// Volume readbitrate search
$app->get('/DAO/volumereadbitrate/{idvolume}', function ($idvolume) use ($app) {
$volume = $app['dao.volume']->findTheVolumeInfo($idvolume);
return $app['twig']->render('renderreadbitrate.html.twig', array('elements' => $volume));
})->bind('volumereadbitrate');


// Login form
$app->get('/login', function(Request $request) use ($app) {
    return $app['twig']->render('login.html.twig', array(
        'error'         => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
    ));
})->bind('login');
// Admin home page
$app->match('/admin', function(Request $request) use ($app) {
    $users = $app['dao.user']->findAll();
    
        
    $addREDrequest = new Addredrequest();
    $addREDForm = $app['form.factory']->create(new addREDType(), $addREDrequest); //, $article
    $addREDForm->handleRequest($request);
    if ($addREDForm->isSubmitted() && $addREDForm->isValid()) {
        $idresmin=$addREDrequest->getIdresmin();
        $idresmax=$addREDrequest->getIdresmax();
        $bits=$addREDrequest->getBits();
        $idformatstart=$addREDrequest->getIdformatstart();
        $camera=$addREDrequest->getCamera();
        $bitratemaxcam=$addREDrequest->getBitratemaxcam();
        $media1=$addREDrequest->getMedia1();
        $media2=$addREDrequest->getMedia2();
        $media3=$addREDrequest->getMedia3();
        $media4=$addREDrequest->getMedia4();
        $media5=$addREDrequest->getMedia5();
        $source=$addREDrequest->getSourceinfo();
        
        $idres=$idresmin;
        for ($idres = $idresmin; $idres <= $idresmax; $idres++) {
   		 	$resolution=$app['dao.resolution']->find($idres);
   		 	$resdetail=$resolution->getDetail();
   		 	$exploderesdetail=explode("*",$resdetail);
   		 	$reswidth=$exploderesdetail[0];
   		 	$resheight=$exploderesdetail[1];
   		 	$codeccompression=2;
   		 	
   		 	for($idcod=22;$idcod<42;$idcod++){
   		 		$calculdudebit=($reswidth*$resheight)*24*$bits/1024/1024/1.1/$codeccompression;
   		 		$codeccompression=$codeccompression+1;
   		 		$idformatstart=$idformatstart+1;
   		 		
   		 		if($calculdudebit<=$bitratemaxcam){
   		 			$addREDrequest->setIdformat($idformatstart);
   		 			$addREDrequest->setIdcodec($idcod);
   		 			$addREDrequest->setIdresolution($idres);
   		 			$addREDrequest->setIdframerate(24);
   		 			$addREDrequest->setSampling($bits);
   		 			$addREDrequest->setBitrate($calculdudebit);
   		 			$addREDrequest->setBitratemax(0);
   		 			$addREDrequest->setSource($source);
   		 			$app['dao.addREDrequest']->addFormat($addREDrequest);
   		 			
   		 			$addREDrequest->setIdcamera($camera);
   		 			$addREDrequest->setIdmedia($media1);
   		 			$app['dao.addREDrequest']->addCameramediaformat($addREDrequest);
   		 			
   		 			if($media2){
   		 				$addREDrequest->setIdcamera($camera);
   		 				$addREDrequest->setIdmedia($media2);
   		 				$app['dao.addREDrequest']->addCameramediaformat($addREDrequest);
   		 			}
   		 			
   		 			if($media3){
   		 				$addREDrequest->setIdcamera($camera);
   		 				$addREDrequest->setIdmedia($media3);
   		 				$app['dao.addREDrequest']->addCameramediaformat($addREDrequest);
   		 			}
   		 			
   		 			if($media4){
   		 				$addREDrequest->setIdcamera($camera);
   		 				$addREDrequest->setIdmedia($media4);
   		 				$app['dao.addREDrequest']->addCameramediaformat($addREDrequest);
   		 			}
   		 			
   		 			if($media5){
   		 				$addREDrequest->setIdcamera($camera);
   		 				$addREDrequest->setIdmedia($media5);
   		 				$app['dao.addREDrequest']->addCameramediaformat($addREDrequest);
   		 			}
   		 		}
   		 	}
		}
        
        $messagedisplay='idresmin:'.$idresmin.' '.'idresmax:'.$idresmax.' '.'bits:'.$bits.' '.'idformatstart:'.$idformatstart.' '.'camera:'.$camera.' '.'bitratemaxcam:'.$bitratemaxcam.' '.'media1:'.$media1.' '.'media2:'.$media2.' '.'media3:'.$media3.' '.'media4:'.$media4.' '.'media5:'.$media5.' '.'source:'.$source.' ';
       
        $app['session']->getFlashBag()->add('success', $messagedisplay);
    }
    
    return $app['twig']->render('admin.html.twig', array(
        'users' => $users,
        'addRED' => 'New redformats',
        'addREDForm' => $addREDForm->createView()));
    


})->bind('admin');

// Add a user
$app->match('/admin/user/add', function(Request $request) use ($app) {
    $user = new User();
    $userForm = $app['form.factory']->create(new UserType(), $user);
    $userForm->handleRequest($request);
    if ($userForm->isSubmitted() && $userForm->isValid()) {
        // generate a random salt value
        $salt = substr(md5(time()), 0, 23);
        $user->setSalt($salt);
        $plainPassword = $user->getPassword();
        // find the default encoder
        $encoder = $app['security.encoder.digest'];
        // compute the encoded password
        $password = $encoder->encodePassword($plainPassword, $user->getSalt());
        $user->setPassword($password); 
        $app['dao.user']->save($user);
        $app['session']->getFlashBag()->add('success', 'The user was successfully created.');
    }
    return $app['twig']->render('user_form.html.twig', array(
        'title' => 'New user',
        'userForm' => $userForm->createView()));
})->bind('admin_user_add');

// Edit an existing user
$app->match('/admin/user/{id}/edit', function($id, Request $request) use ($app) {
    $user = $app['dao.user']->find($id);
    $userForm = $app['form.factory']->create(new UserType(), $user);
    $userForm->handleRequest($request);
    if ($userForm->isSubmitted() && $userForm->isValid()) {
        $plainPassword = $user->getPassword();
        // find the encoder for the user
        $encoder = $app['security.encoder_factory']->getEncoder($user);
        // compute the encoded password
        $password = $encoder->encodePassword($plainPassword, $user->getSalt());
        $user->setPassword($password); 
        $app['dao.user']->save($user);
        $app['session']->getFlashBag()->add('success', 'The user was succesfully updated.');
    }
    return $app['twig']->render('user_form.html.twig', array(
        'title' => 'Edit user',
        'userForm' => $userForm->createView()));
})->bind('admin_user_edit');

// Remove a user
$app->get('/admin/user/{id}/delete', function($id, Request $request) use ($app) {
    // Delete the user
    $app['dao.user']->delete($id);
    $app['session']->getFlashBag()->add('success', 'The user was succesfully removed.');
    // Redirect to admin home page
    return $app->redirect($app['url_generator']->generate('admin'));
})->bind('admin_user_delete');

// temp demo for split interactive video -- to delete
$app->get('/demo', function () use ($app) {

    return $app['twig']->render('demo.html.twig');
})->bind('demo');
