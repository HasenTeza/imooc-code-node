<?php
namespace app\index\controller;

use app\index\model\User;
use think\View;

class Index
{
    public function index()
    {
        return '<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="https://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="https://e.topthink.com/Public/static/client.js"></script><think id="ad_bd568ce7058a1091"></think>';
    }

    public function showForm(){
        $view=new View();
        $user = User::get(11);
        //todo 判断当前用户是否已经选择爱好
        $user_is_chose_hobby=$user->getAttr('hobby')?$user->getAttr('hobby'):null;
        $view->assign('hobby',$user_is_chose_hobby);
        return $view->fetch('/index/biaodan');
    }

    public function saveUser(){
        //todo 1.接收前端传来的数据
        $name=input('post.name');
        $age=input('post.age');
        $hobby=input('post.hobby');
        //todo 2.处理数据 经过处理后存到数据库
        //调用MODEL 进行数据库操作
        $user= new User();
        $user->name=$name;
        $user->age=$age;
        $user->hobby=$hobby;
        //接收存出结果赋值给result.后面用来判断是否存储成功
        $result_code=$user->save();
        //TODO 3.包装返回给前端的数组
        //TODO 3.1创建返回数组
        $result = array();
        //TODO 3.2 赋值返回数组
            if($result_code){
            $result_code=200;
            $result_msg='成功';
        }else{
            $result_code=400;
            $result_msg='失败';
        }
        $result['result_code']=$result_code;
        $result['result_msg']=$result_msg;
        //TODO 3.3返回数组
        //判断是否存储成功
        return $result;


    }

}