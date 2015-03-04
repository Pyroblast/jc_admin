<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function admin_login($name,$passwd){
    $passwd = md5($passwd);
    $admin_user = array('dianadmin'=>md5('dianabab'),'diangly'=>md5('dianbcbc'));
    if(isset($admin_user[$name]) && $admin_user[$name] == $passwd){
        $_SESSION["cai_admin"] = $name;
    }else{
        return "登陆失败。请检查用户名密码。";
    }
    return "";
}

function admin_logout(){
    session_start();
    $_SESSION["cai_admin"] = "";
}

function guess_result($guess_id,$is_win){
    if(empty($guess_id)){
        return array('status'=>-1,'msg'=>'竞猜id为空');
    }
    if(empty($is_win)){
        return array('status'=>-2,'msg'=>'竞猜结果获取失败');
    }
    $dsn = "mysql:host=192.168.0.180;dbname=cai_yxpopo";
    $db = new PDO($dsn, 'dian_user', 'dian~2011~2011@@', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"));

    $dhandle = $db->prepare("select * from guess where guess_id=:gid ");
    $dhandle->bindParam(':gid',$guess_id, PDO::PARAM_INT);
    $dhandle->execute();
    $guessRe = $dhandle->fetch();
    if(1 == $guessRe['back_re']){
        return array('status'=>-3,'msg'=>'用户积分操作失败');
    }
    if(empty($guessRe['win_odds']) || empty($guessRe['lose_odds']) || empty($guessRe['draw_odds'])){
        return array('status'=>-4,'msg'=>'赔率参数为空');
    }

    $is_succ = false;
    $rs = $db->query("SELECT * FROM cai_user_bet where guess_id='$guess_id'");
    $re_row = $rs->fetchALL(constant('PDO::FETCH_ASSOC'));
    if($re_row){
        foreach($re_row as $key=>$row){
            if(empty($row['user_id']) || empty($row['guess_id']) || empty($row['is_win']))
                continue;

            //胜负：1主胜，2主负，3平
            if(1 == $row['is_win'] && 1 == $is_win){
                //结算积分
                $score = $guessRe['win_odds'] * $row['bet_score'];

                $sql = "insert into cai_user_bet_score(user_id,guess_id,bet_id,score,create_time) values('{$row['user_id']}','{$row['guess_id']}','{$row['id']}','$score',now())";
            }elseif(2 == $row['is_win'] && 2 == $is_win){
                //结算积分
                $score = $guessRe['lose_odds'] * $row['bet_score'];

                $sql = "insert into cai_user_bet_score(user_id,guess_id,bet_id,score,create_time) values('{$row['user_id']}','{$row['guess_id']}','{$row['id']}','$score',now())";
            }elseif(3 == $row['is_win'] && 3 == $is_win){
                //结算积分
                $score = $guessRe['draw_odds'] * $row['bet_score'];

                $sql = "insert into cai_user_bet_score(user_id,guess_id,bet_id,score,create_time) values('{$row['user_id']}','{$row['guess_id']}','{$row['id']}','$score',now())";
            }else{
                //结算积分
                $score = 0;
                $u_score = 0 - $row['bet_score'];

                //负积分表(暂时只做记录)
                $sql = "insert into cai_user_bet_uscore(user_id,guess_id,bet_id,score,create_time) values('{$row['user_id']}','{$row['guess_id']}','{$row['id']}','$u_score',now())";
            }
            if($db->exec($sql)){
                user_score($row['user_id'],$score,$is_win);
                $is_succ = true;
            }
        }
        if($is_succ){
            $db->exec("update guess set back_re = '1' where guess_id = '$guess_id'");
            return array('status'=>1,'msg'=>'成功');
        }else{
            return array('status'=>-999,'msg'=>'数据库错误');
        }
    }
    return array('status'=>1,'msg'=>'成功,无结算用户');
}

function user_score($user_id,$score){
    $re_status = false;
    if(empty($score)){
        return $re_status;
    }

    $dsn = "mysql:host=192.168.0.180;dbname=cai_yxpopo";
    $db = new PDO($dsn, 'dian_user', 'dian~2011~2011@@', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"));
    $dhandle = $db->prepare("select * from cai_user where id=:uid ");
    $dhandle->bindParam(':uid',$user_id, PDO::PARAM_INT);
    $dhandle->execute();
    $userRe = $dhandle->fetch();
    if($userRe){
        $js_score = $userRe['score'] + $score;
        $res = $db->exec("update cai_user set score = '$js_score' where id = '$user_id'");
        if (1 == $res) {
            $re_status = true;
        }
    }
    return $re_status;
}