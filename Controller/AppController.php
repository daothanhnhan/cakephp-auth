<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $components = array(
	   'Auth'=>array(
		 'userModel' => 'User',//sử dụng model User
		 'fields' => array('username' => 'username', 'password' => 'password'),//sử dụng 2 field "username","password" để so sánh xem có hợp lệ không
		 'loginAction' => array('admin'=>false, 'controller'=>'users', 'action'=>'login'),//Khi chưa đăng nhập sẽ tự chuyển tới
		 'loginRedirect' => array('admin'=>true, 'controller'=>'users', 'action'=>'index'),//Khi đăng nhập thành công
		 'authError' => 'Không thể truy cập',//báo lỗi
		 'authorize' => array('Controller'),
	   )
	   //ngay chổ admin có 2 giá trị true và false,
	 );
	 function beforeFilter(){
	   Security::setHash("md5");//mã hóa password là md5
	   $this->set('current_user', $this->Auth->user());//sau khi đăng nhập thành công biến current_user là thông tin user đăng nhập
	 }
	 function isAuthorized(){
	   return true;
	 }
}
