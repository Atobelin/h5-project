<?php

$code = $_GET['code'] ?? '';

function postCurl($url,$data,$type) {
    if($type == 'json'){
        $data = json_encode($data);//对数组进行json编码
        $header= array("Content-type: application/json;charset=UTF-8","Accept: application/json","Cache-Control: no-cache", "Pragma: no-cache");
    }
    $curl = curl_init();
    curl_setopt($curl,CURLOPT_URL,$url);
    curl_setopt($curl,CURLOPT_POST,1);
    curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
    curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,false);
    if(!empty($data)){
        curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
    }
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($curl,CURLOPT_HTTPHEADER,$header);
    $res = curl_exec($curl);
    if(curl_errno($curl)){
        return curl_error($curl);
    }
    curl_close($curl);
    return $res;
}

$locl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
if (empty($code)) {
    $res = postCurl('http://api.hongyu.ren/wechat/code', array('url'=>$locl), 'json');
    $resarr = json_decode($res, true);
    header('location:'.$resarr['data']['url']);
} else {
    $res = postCurl('http://api.hongyu.ren/wechat/auth', array('code'=>$code), 'json');
    $resarr = json_decode($res, true);
    if ($resarr['status'] == 100) {
        $userinfo = $resarr['data']['userinfo'];
    } else {
        header('location:'.$locl);
    }
}

?>

<!DOCTYPE html>
<html lang="zh-cn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="UTF-8">
    <title>中关村创客节</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <!-- 公共样式 -->
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <!-- 独立样式 -->
</head>

<body>
<!-- 公共JS -->
<script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/layer/3.1.0/layer.js"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
<script src="js/share.js"></script>

<script>
    (function(doc, win, undefined) {
        var docEl = doc.documentElement,
            resizeEvt = 'orientationchange' in win ? 'orientationchange' : 'resize',
            recalc = function() {
                var clientWidth = docEl.clientWidth;
                if (clientWidth === undefined) return;
                docEl.style.fontSize = 100 * (clientWidth / 640) + 'px';
            };
        if (doc.addEventListener === undefined) return;
        win.addEventListener(resizeEvt, recalc, false);
        doc.addEventListener('DOMContentLoaded', recalc, false)
    })(document, window);
</script>
<div class="page page-1" >
    <!-- 公共 -->
    <img src="imgs/logo.png" alt="" class="logo">
    <img src="imgs/down-text.png" alt="" class="down-text">
    <img src="imgs/down-line.png" alt="" class="down-line">
    <!-- 独立 -->
    <img src="imgs/page-1-logo-1.png" alt="" class="page-1-logo-1">
    <img src="imgs/page-1-logo-2.png" alt="" class="page-1-logo-2">
    <img src="imgs/page-1-star-1.png" alt="" class="page-1-star-1">
    <img src="imgs/page-1-star-2.png" alt="" class="page-1-star-2">
    <img src="imgs/page-1-text-1.png" alt="" class="page-1-text-1 animated bounceInDown">
    <img src="imgs/page-1-text-2.png" alt="" class="page-1-text-2 animated bounceInDown">
    <img src="imgs/page-1-text-line.png" alt="" class="page-1-text-line">
    <img src="imgs/page-1-text-bg.png" alt="" class="page-1-text-bg">
    <div class="welcome js-welcome">欢迎你</div>
    <div class="button js-go-page-2">
        <div class="button-box">
            <img src="imgs/page-1-button-bg.png" alt="" class="button-bg">
            <div class="text">开启</div>
        </div>
    </div>
    <div class="detail js-go-detail">查看详情</div>
    <!-- 详情 -->
    <img src="imgs/page-1-detail.png" alt="" class="detail-text js-detail-text">
    <div class="button js-go-page-1 button-detail">
        <div class="button-box">
            <img src="imgs/page-1-button-bg.png" alt="" class="button-bg">
            <div class="text">返回首页</div>
        </div>
    </div>
</div>
<div class="page page-2" style="display: none;">
    <!-- 公共 -->
    <img src="imgs/logo.png" alt="" class="logo">
    <img src="imgs/down-text.png" alt="" class="down-text">
    <img src="imgs/down-line.png" alt="" class="down-line">
    <!-- 独立 -->
    <p class="page-2-title">请填写您的信息</p>
    <div class="information">
        <div class="list">
            <span class="list-left">姓&nbsp;&nbsp;&nbsp;名:</span>
            <input type="text" class="js-name-input">
        </div>
        <div class="list">
            <span class="list-left">手机号:</span>
            <input type="text" class="js-tel-input">
        </div>
        <div class="list">
            <span class="list-left">公&nbsp;&nbsp;&nbsp;司:</span>
            <input type="text" class="js-company-input">
        </div>
        <div class="list">
            <span class="list-left">职&nbsp;&nbsp;&nbsp;务:</span>
            <input type="text" class="js-job-input">
        </div>
    </div>
    <div class="textarea-box">
        <p>你认为“创客”有什么样的特质?</p>
        <textarea placeholder="一句话描述......" class="js-dictation-input"></textarea>
    </div>
    <div class="button">
        <div class="button-box js-submit">
            <img src="imgs/page-1-button-bg.png" alt="" class="button-bg">
            <div class="text">提交资料</div>
        </div>
    </div>
    <!-- 弹出框-->
    <div class="tan-box" style="display: none;">
        <div class="tan-text-box">
            <img src="imgs/tan-box-bg.png" alt="">
            <div class="text-box">
                <div>
                    <p class="p-1">恭喜你</p>
                    <p class="p-2">资料提交成功</p>
                    <p class="p-3">正在生产您的专属邀请函</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="page page-3" style="display: none;">
    <!-- <canvas width="640" height="1136"></canvas> -->
    <img id="createImg" src="" />
    <!-- 公共 -->
    <img src="imgs/logo.png" alt="" class="logo">
    <img src="imgs/down-text.png" alt="" class="down-text">
    <img src="imgs/down-line.png" alt="" class="down-line">
    <!-- 独立	 -->
    <p class="page-3-title">诚挚恭迎您的到来</p>
    <div class="photo-box">
        <img src="imgs/page3-box.png" alt="" class="page3-box">
        <img src="imgs/people.png" alt="" class="photo" id="phone">
    </div>
    <div class="name-box">
				<span class="name">
					<span>
					<span id="name"></span>
					<img src="imgs/page-3-icon-2.png" alt="" class="icon-left icon">
					<img src="imgs/page-3-icon-2.png" alt="" class="icon-right icon">
					</span>
				</span>
    </div>
    <img src="imgs/page-3-icon-1.png" alt="" class="icon-1">
    <p class="time-place">时 间：2018 / 11 / 24</p>
    <p class="time-place">地 点：北京市中关村创客小镇</p>
    <p class="save">长按保存邀请函</p>
</div>
</body>
<script>
    var openid = "<?php echo $userinfo['openid'];?>";
    var headimg = "<?php echo $userinfo['headimgurl'];?>";
    $(".js-go-detail").click(function() {
        $(".js-welcome").fadeOut(0)
        $(".js-go-page-2").fadeOut(0)
        $(".js-go-detail").fadeOut(0)
        $(".js-detail-text").fadeIn(300)
        $(".js-go-page-1").fadeIn(300)
    });
    $(".js-go-page-1").click(function() {
        $(".js-go-page-1").fadeOut(0)
        $(".js-detail-text").fadeOut(0)
        $(".js-welcome").fadeIn(300)
        $(".js-go-page-2").fadeIn(300)
        $(".js-go-detail").fadeIn(300)
    });
    $(".js-go-page-2").click(function() {
        $(".page-1").fadeOut(0)
        $(".page-2").fadeIn(500)
    });
    function test(){
        $(".page-2").fadeOut(0)
        $(".page-3").fadeIn(500)
    }
    $(".js-submit").click(function () {
        var name = $(".js-name-input").val()
        var tel = $(".js-tel-input").val()
        var company = $(".js-company-input").val()
        var job = $(".js-job-input").val()
        var dictation = $(".js-dictation-input").val()
        if (name == '') {
            layer.msg('姓名不能为空！');
            $('.js-name-input').focus();
            return false;
        }
        if (tel == '') {
            layer.msg('手机号码不能为空！');
            $('.js-tel-input').focus();
            return false;
        }
        if (!(/^1\d{10}$/.test(tel))) {
            layer.msg('手机号码不合法！');
            $('.js-tel-input').focus();
            return false;
        }
        if (company == '') {
            layer.msg('公司不能为空！');
            $('.js-company-input').focus();
            return false;
        }
        if (job == '') {
            layer.msg('职务不能为空！');
            $('.js-job-input').focus();
            return false;
        }
        if (dictation == '') {
            layer.msg('您认为"创客有什么样的特质？"');
            $('.js-dictation-inputt').focus();
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'http://api.hongyu.ren/zgc/save',
            data: {
                duty : job,
                name : name,
                company : company,
                phone: tel,
                brife: dictation,
                openid: openid,
                headimg: headimg
            },
            dataType: 'json',
            success: function(data){
                if (data.status == 100) {
                    console.log(data.data);
                    $(".tan-box").fadeIn(500)
                    $("#createImg").attr("src", data.data.url)
                    $("#phone").attr("src", headimg)
                    var text_name = $(".js-name-input").val()
                    console.log(text_name);
                    $("#name").append(text_name)
                    // createimage()
                    setTimeout('test()',3000);
                }else{
                    layer.msg(data.data.err_msg);
                    console.log(data.data.err_msg);
                }
            },
            error: function(data){
                console.log('请求超时');
            }
        })
    })
    // 		function createimage () {
    // 			// 图片合成
    // 			var canvas = $(".page-3 canvas")[0]
    // 			var ctx = canvas.getContext("2d")
    // 			var imgbg = new Image()
    // 			imgbg.src = "imgs/canvasbg.jpg"
    // 			var avat = new Image()
    // 			avat.src = JSON.parse(sessionStorage.getItem('userInfo')).headimgurl + '?v=' + Math.random()
    // 			avat.crossOrigin = "*"
    // 			var avab = new Image()
    // 			avab.src = "imgs/avaborder.png"
    // 			// 画背景
    // 			imgbg.onload = function () {
    // 				ctx.drawImage(imgbg, 0, 0, 640, 1136)
    // 				if(avat.complete){
    // 					drawavat()
    // 				}else{
    // 					avat.onload = function () {
    // 						drawavat()
    // 					}
    // 				}
    // 			}
    // 			// 画头像
    // 			function drawavat() {
    // 				ctx.save()
    // 				ctx.beginPath()
    // 				ctx.arc(318, 449, 119, 0, Math.PI * 2, false)
    // 				ctx.clip()
    // 				ctx.drawImage(avat, 200, 331, 238, 238)
    // 				ctx.restore()
    // 				if(avab.complete){
    // 					drawavab()
    // 				}else{
    // 					avab.onload = function () {
    // 						drawavab()
    // 					}
    // 				}
    // 				drawtext()
    // 			}
    // 			// 画头像边框
    // 			function drawavab() {
    // 				ctx.drawImage(avab, 123, 290, 362, 326)
    // 			}
    // 			// 画昵称
    // 			function drawtext() {
    // 				ctx.fillStyle="#ffffff"
    // 				ctx.font="31px Arial"
    // 				ctx.textAlign="center"
    // 				ctx.fillText($(".js-name-input").val(),320,628)
    // 				alert(canvas.toDataURL())
    // 				$("#createImg").attr("src", canvas.toDataURL())
    // 			}
    // 		}
</script>
</html>
