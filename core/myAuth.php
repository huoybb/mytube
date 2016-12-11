<?php
namespace core;
use Phalcon\Di;
use Users;

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/6/26
 * Time: 23:14
 */
class myAuth implements \Phalcon\Di\InjectionAwareInterface
{
    /**
     * @var Di
     */
    protected $di;
    /**
     * @var \Phalcon\Session\Adapter\Files
     */
    protected $session;
    /**
     * @var \Phalcon\Http\Response\Cookies
     */
    protected $cookies;
    /**
     * @var Users;
     */
    protected $user;

    /**
     * myAuth constructor.
     * @param $di
     */
    public function init()
    {
        $this->session = $this->di->get('session');
        $this->cookies = $this->di->get('cookies');
        if($this->session->has('auth')){
            $this->loginByUserId($this->session->get('auth'));
        }else{
            if($this->cookies->has('auth')){
                $this->loginByUserId($this->cookies->get('auth')->getValue());
            }
        }
        return $this;
    }

    /**
     * @param Users $user
     * @return $this
     */
    public function login(Users $user)
    {
        $this->user = $user;
        $this->registerSession($user,true);
        return $this;
    }
    public function isLogin()
    {
        return $this->user <> null;
    }

    public function logout()
    {
        $this->user = null;
        $this->distroySession();
        return $this;
    }

    /**
     * @return Users
     */
    public function user()
    {
        return $this->user;
    }

    private function registerSession(Users $user,$remember_me=false)
    {
        $this->session->set('auth',$user->id);
        if($remember_me) $this->cookies->set('auth',$user->id,time() + 15 * 86400);
    }

    public function loginByUserId($user_id,$remember_me = false)
    {
        $user = Users::findFirst($user_id);
        if($user) {
            $this->user = $user;
            $this->registerSession($user,$remember_me);
        }
        return $this;
    }

    private function distroySession()
    {
        if($this->cookies->has('auth')) $this->cookies->get('auth')->delete();
        if($this->session->has('auth')) $this->session->remove('auth');
    }

    /**
     * Sets the dependency injector
     *
     * @param mixed $dependencyInjector
     */
    public function setDI(\Phalcon\DiInterface $dependencyInjector)
    {
        $this->di = $dependencyInjector;
        return $this;
    }

    /**
     * Returns the internal dependency injector
     *
     * @return \Phalcon\DiInterface
     */
    public function getDI()
    {
        return $this->di;
    }

    /**
     * 登录的前提下，判断是否拥有某对象
     * @param myModel $object
     * @return bool
     */
    public function owns(myModel $object)
    {
        return $object->user_id == $this->user()->id;
    }

    public function isAdmin()
    {
        return $this->user()->id == 1;
    }

}