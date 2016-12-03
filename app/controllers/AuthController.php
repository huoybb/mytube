<?php

class AuthController extends ControllerBase
{

    public function registerAction()
    {
        if($this->request->isPost()){
            $data = $this->request->getPost();
            if(!$this->isTwoPasswordSame($data)){
                $this->flash->error('两次密码输入不一致');
                return $this->redirectBack();
            }
            if(Users::IsUserExisted($data['email'])){
                $this->flash->error('用户已经存在，请登录或者选用别的邮箱注册');
                return $this->redirectBack();
            }
            $data['password'] = $this->security->hash($data['password']);
            Users::saveNew($data);
            $this->flash->notice('成功注册为用户，请登录');
            return $this->redirect(['for'=>'login']);
        }
    }
    public function loginAction()
    {
        if($this->auth->isLogin()) return $this->redirect(['for'=>'home']);
        if($this->request->isPost()){
            $data = $this->request->getPost();
            $user = Users::findByEmail($data['email']);
            if(!$this->security->checkHash($data['password'],$user->password)){
                $this->flash->error('密码不对！');
                return $this->redirectBack();
            }
            $this->flash->success("欢迎{$user->name}回来！");
            $this->auth->login($user);
            return $this->redirect(['for'=>'home']);
        }
    }
    public function logoutAction()
    {
        $this->auth->logout();
        return $this->redirect(['for'=>'login']);
    }
    public function latestCommentsAction()
    {
        $this->view->comments = Comments::findByUser($this->auth->user());
    }




    private function isTwoPasswordSame($data)
    {
        return $data['password'] == $data['repeatPassword'];
    }

}

