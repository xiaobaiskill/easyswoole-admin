@extends('layouts.app')

@section('title',$title)

@section('stylesheet')
<style>
	.body-border{
		margin-top:10px;
		padding: 10px;
	    border: 1px solid #dcdcdc;
	    border-radius: 5px;
	}
	.feedback {
		background-color: #ffede3;
	    font-size: 14px;
	    padding: 11px 25px;
	    line-height: 28px;
	    color: #ea5404;
	}
	.container-content {
		padding: 10px 0px;
	}
	.red {
		color: red;
	}
	.mt15 {
		margin-top: 15px;
	}
</style>
@endsection


@section('body')
	<div class="container">
		<div class="container-content">
			<div class="img-fluid img-thumbnail" style="margin-bottom: 10px;">
				<img src="/img/feedback.jpg" width="100%" alt="宝贵建议">
			</div>

			<div class="feedback">
				<div>若您在东方财富网遇到不便，或者希望我们能为您做出更多的功能及改进，欢迎随时提出宝贵意见或建议。我们将根据您的需求，不断完善。</div>
				<div>非常感谢您对东方财富网的支持和关注，您的意见与建议是推动我们工作不断前进的动力。希望我们做的每一份努力都能够为您带来更好的服务。</div>
			</div>

			<div class="body-border">
				@yield('feedback')
			</div>
		</div>
	</div>

@endsection