<?php

require_once '../vendor/autoload.php';

require_once 'config/config.php';
require_once 'dao/ReviewDao.class.php';
require_once 'dao/MenuDao.class.php';
require_once 'dao/ContactDao.class.php';
require_once 'dao/UserDao.class.php';

Flight::register('review_dao', 'ReviewDao');
Flight::register('menu_dao', 'MenuDao');
Flight::register('contact_dao', 'ContactDao');
Flight::register('user_dao', 'UserDao');


Flight::route('GET /reviews', function(){
  $reviews = Flight::review_dao()->get_all();
  Flight::json($reviews);
});

Flight::route('GET /menus', function(){
  $menus = Flight::menu_dao()->get_menu();
  Flight::json($menus);
});

Flight::route('GET /review', function(){
  $id = Flight::request()->query['id'];
  $review = Flight::review_dao()->get_by_id($id);
  Flight::json($review);
});

Flight::route('POST /reviews', function(){
  $request = Flight::request()->data->getData();
  Flight::review_dao()->add($request);
  Flight::json('review has been added');
});

Flight::route('POST /contact', function(){
  $request = Flight::request()->data->getData();
  $userid = Flight::request()->query['id'];
  $request['userIdd'] = $userid;
  Flight::contact_dao()->add($request);
  Flight::json('Message has been sent');
});

Flight::route('POST /review', function(){
  $request = Flight::request()->data->getData();
  $id = $request['id'];
  Flight::review_dao()->update_review($request, $id);
  Flight::json('Updated');
});

Flight::route('DELETE /review/@id', function($id){
  Flight::review_dao()->delete_review($id);
});

Flight::route('POST /login', function(){
  $user = Flight::request()->data->getData();
  $db_user = Flight::user_dao()->get_user_by_email($user['email']);

  if ($db_user){
    if ($db_user['password'] == $user['password']){
      Flight::json($db_user);
    }else{
      Flight::halt(404, 'Password Incorrect');
    }
  }else{
    Flight::halt(404, 'User not found');
  }
});

Flight::route('POST /register', function(){
  $user = Flight::request()->data->getData();
  Flight::user_dao()->add($user);
});


Flight::start();
?>
