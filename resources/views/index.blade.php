<!doctype html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>钱进家项目组小工具</title>
	<link rel="stylesheet" type="text/css" href="{{asset("/adminTool/css/normalize.css")}}" />
	<link rel="stylesheet" type="text/css" href="{{asset("/adminTool/css/default.css")}}">
	<link rel="stylesheet" type="text/css" href="{{asset("/adminTool/css/styles.css")}}">
	<!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- 可选的 Bootstrap 主题文件（一般不用引入） -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<style>
		h2{
			margin-top: 0;
		}
		.default_main_div{
			width: 200px;
			height: 400px;
			background: #e2f0fb;
			margin-top: 35px;
		}
		.all_list_brands_title_details_btn{
			background-color: #4CAF50; /* Green */
			border: none;
			color: white;
			padding: 15px 32px;
			text-align: center;
			display: inline-block;
			font-size: 16px;
			margin-top: 30px;
		}
		a:hover{
			color: #e2f0fb;
		}
		.text_all{
			padding: 10px 10px;
			margin-top: 10px;
		}
	</style>
</head>
<body>
<div style="">
	<article class="htmleaf-container">
		<h1>钱进家项目组</h1>
		<h3>后端组小工具集</h3>
		<div class="demo">
		  <div class="demo__close-menu"></div>
		  <div class="demo__section demo__section-1" data-section="1">
		    <div class="demo__menu-btn"></div>
		    <h2 class="demo__section-heading">催收数据一键导出</h2>
			  <div class="default_main_div">
				  <a class="all_list_brands_title_details_btn" style="text-decoration: none;" href="{{asset("collection/export")}}">导出当日数据</a>
			  	  <div class="text_all">注：本工具用于导出催收需要的数据excel格式</div>
				  <div class="text_all">点击导出当日催收数据,请于每日定时扣款脚本执行后导出。</div>
			  </div>

		  </div>
		  <div class="demo__section demo__section-2 active" data-section="2">
		    <div class="demo__menu-btn"></div>
		    <h2 class="demo__section-heading">线下还款SQL一键生成</h2>

		  </div>
		  <div class="demo__section demo__section-3 inactive" data-section="3">
		    <div class="demo__menu-btn"></div>
		    <h2 class="demo__section-heading">敬请期待</h2>
		  </div>
		  <div class="demo__section demo__section-4 inactive" data-section="4">
		    <div class="demo__menu-btn"></div>
		    <h2 class="demo__section-heading">敬请期待</h2>
		  </div>
		</div>

	</article>
</div>

	<script src='{{asset("/adminTool/js/stopExecutionOnTimeout.js?t=1")}}'></script>
	<script src="http://www.jq22.com/jquery/2.1.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="{{asset('/adminTool/js/jquery-2.1.1.min.js')}}"><\/script>')</script>
<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script type="text/javascript">
	$(document).ready(function () {

	    var $demo = $('.demo');

        $demo.addClass('menu-active');
	    var numOfSections = $('.demo__section').length;
	    $(document).on('click', '.demo__menu-btn', function () {
	        $demo.addClass('menu-active');
	    });
	    $(document).on('click', '.demo__close-menu', function () {
	        $demo.removeClass('menu-active');
	    });
	    $(document).on('click', '.demo.menu-active .demo__section', function () {
	        var $section = $(this);
	        var index = +$section.data('section');
	        $('.demo__section.active').removeClass('active');
	        $('.demo__section.inactive').removeClass('inactive');
	        $section.addClass('active');
	        $demo.removeClass('menu-active');
	        for (var i = index + 1; i <= numOfSections; i++) {
	            if (window.CP.shouldStopExecution(1)) {
	                break;
	            }
	            $('.demo__section[data-section=' + i + ']').addClass('inactive');
	        }
	        window.CP.exitedLoop(1);
	    });
	});
	</script>
</body>
</html>