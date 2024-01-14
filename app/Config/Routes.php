<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();
$this->auth = ['filter' => 'auth'];
$this->noauth = ['filter' => 'noauth'];
$this->cekprofil = ['filter' => 'checkprofile'];
/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setTranslateURIDashes(false);
$routes->setAutoRoute(true);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Welcome::index');
$routes->add('login', 'Login::index', $this->noauth);
$routes->add('login/(:any)', 'Login::index/$1', $this->noauth);
$routes->add('register', 'Login::registerUser', $this->noauth);
$routes->add('register/(:any)', 'Login::registerUser/$1', $this->noauth);
$routes->add('registerprocess', 'Login::processRegister', $this->noauth);
$routes->add('authlogin', 'Login::authLogin', $this->noauth);
$routes->add('logout', 'Login::logout');
$routes->add('forgotpassword', 'Login::forgotPass');
$routes->add('sendforgot', 'Login::sendForgot');
$routes->add('resetpassword/(:any)', 'Login::resetView/$1');
$routes->add('processreset', 'Login::resetPass');

$routes->add('welcome', 'Welcome::index');
$routes->add('beranda', 'Beranda::index', $this->cekprofil);

$routes->add('akun', 'akun::index');
$routes->add('akun', 'akun2::index');

//Kampus
$routes->add('kampus', 'Administrator\Kampus::index', $this->cekprofil);
$routes->add('kampus/table', 'Administrator\Kampus::datatable', $this->cekprofil);
$routes->add('kampus/form', 'Administrator\Kampus::forms', $this->cekprofil);
$routes->add('kampus/form/(:any)', 'Administrator\Kampus::forms/$1', $this->cekprofil);
$routes->add('kampus/form_prodi/(:any)', 'Administrator\Kampus::form_prodi/$1', $this->cekprofil);
$routes->add('kampus/create', 'Administrator\Kampus::addData', $this->cekprofil);
$routes->add('kampus/update', 'Administrator\Kampus::editData', $this->cekprofil);
$routes->add('kampus/delete', 'Administrator\Kampus::deleteData', $this->cekprofil);
$routes->add('kampus/accessing', 'Administrator\Kampus::processAccess', $this->cekprofil);
$routes->add('kampus/getkampus', 'Administrator\Kampus::getKampus', $this->auth);
$routes->add('kampus/loadprodi', 'Administrator\Kampus::loadProdi', $this->auth);

//Prodi
$routes->add('prodi', 'Administrator\Prodi::index', $this->cekprofil);
$routes->add('prodi/table', 'Administrator\Prodi::datatable', $this->cekprofil);
$routes->add('prodi/form', 'Administrator\Prodi::forms', $this->cekprofil);
$routes->add('prodi/form/(:any)', 'Administrator\Prodi::forms/$1', $this->cekprofil);
$routes->add('prodi/create', 'Administrator\Prodi::addData', $this->cekprofil);
$routes->add('prodi/update', 'Administrator\Prodi::editData', $this->cekprofil);
$routes->add('prodi/delete', 'Administrator\Prodi::deleteData', $this->cekprofil);
$routes->add('prodi/getprodi', 'Administrator\Prodi::getProdi', $this->auth);
$routes->add('prodi/getallprodi', 'Administrator\Prodi::getAllProdi', $this->auth);

//User
$routes->add('user', 'Administrator\User::index', $this->cekprofil);
$routes->add('user/table', 'Administrator\User::datatable', $this->cekprofil);
$routes->add('user/form', 'Administrator\User::forms', $this->cekprofil);
$routes->add('user/form/(:any)', 'Administrator\User::forms/$1', $this->cekprofil);
$routes->add('user/create', 'Administrator\User::addData', $this->cekprofil);
$routes->add('user/update', 'Administrator\User::editData', $this->cekprofil);
$routes->add('user/delete', 'Administrator\User::deleteData', $this->cekprofil);

//Topic
$routes->add('topic', 'Administrator\Topic::index', $this->cekprofil);
$routes->add('topic/table', 'Administrator\Topic::datatable', $this->cekprofil);
$routes->add('topic/form/(:any)', 'Administrator\Topic::forms/$1', $this->cekprofil);
$routes->add('topic/form/(:any)/(:any)', 'Administrator\Topic::forms/$1/$2', $this->cekprofil);
$routes->add('topic/create', 'Administrator\Topic::addData', $this->cekprofil);
$routes->add('topic/update', 'Administrator\Topic::editData', $this->cekprofil);
$routes->add('topic/delete', 'Administrator\Topic::deleteData', $this->cekprofil);
$routes->add('topic/getmaster', 'Administrator\Topic::getMaster', $this->auth);
$routes->add('topic/getsub', 'Administrator\Topic::getSub', $this->auth);
$routes->add('topic/getmaster/(:any)', 'Administrator\Topic::getMaster/$1', $this->auth);

//Profile
$routes->add('profile', 'profile\Profile::index', $this->auth);
$routes->add('editprofile', 'profile\Profile::processEdit', $this->auth);

//Konsultasi
$routes->add('konsultasi', 'Konsultasi::index', $this->cekprofil);
$routes->add('konsultasi/dospem', 'Konsultasi::loadDospem', $this->cekprofil);
$routes->add('konsultasi/form', 'Konsultasi::formKonsul', $this->cekprofil);
$routes->add('konsultasi/add', 'Konsultasi::processAdd', $this->cekprofil);
$routes->add('konsultasi/form-schedule/(:any)', 'Konsultasi::form_schedule/$1', $this->cekprofil);
$routes->add('konsultasi/form-reject/(:any)', 'Konsultasi::form_reject/$1', $this->cekprofil);
$routes->add('konsultasi/add-jadwal', 'Konsultasi::addJadwal', $this->cekprofil);
$routes->add('konsultasi/reject-jadwal', 'Konsultasi::rejectJadwal', $this->cekprofil);
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
