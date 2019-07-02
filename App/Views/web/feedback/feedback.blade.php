@extends('web.feedback.base')

@section('feedback')
<form>
	<div class="form-group row">
		<label class="col-md-3 float-lg-right">标题<span class="red"> *</span></label>
		<input type="text" class="form-control col-md-8 col-sm-10 col-10" name="title" placeholder="">
	</div>
	<div class="form-group row">
		<label class="col-md-3 float-lg-right">详细<span class="red"> *</span></label>
		<textarea class="form-control col-md-8 col-sm-10 col-10" rows="10" name="detail"></textarea>
	</div>
	<div class="form-group row">
		<label class="col-md-3 float-lg-right">验证码<span class="red"> *</span></label>
		<input type="text" class="form-control col-md-3 col-sm-5 col-5" name="verify">
		<img style="margin-left: 20px;" src="" alt="" id="verify" onclick="code();">
	</div>
	<div class="form-group">
		<div class="btn btn-primary offset-md-3 ajaxpost"
			ajaxurl="/feedback/add"
			ajaxdata="func"
			datafun="form_verify"
			ajax-callback="form_callback"
			>
			提 交
		</div>
		<input type="reset" class="btn btn-default" value="重 置">
	</div>
</form>
@endsection

@section('javascript')
<script type="text/javascript">
	code();
	function code() {
		$('#verify').attr('src','/verify?t='+Date.parse(new Date()));
	}


	function form_verify(obj)
	{
		let title = $("input[name='title']").val()
		let detail = $("textarea[name='detail']").val()
		let verify = $("input[name='verify']").val()
		if(title && detail && verify){
			return {title:title,detail:detail,verify:verify};
		}
		layer.closeAll();
		layer.alert("请填写完整信息");
		return false;
	}

	function form_callback(obj,data)
	{
		if(data.code == 0) {
			let url = window.location.host;
			url += '/reply/'+data.data.hash;
			layer.alert('请记住该链接地址[ ' + url + ' ]，已便查看回复信息', {
			  icon: 1
			  ,closeBtn: 0
			},function(){
				window.location.href = "/reply/" + data.data.hash;
			});

		} else {
			layer.msg(data.msg);
			code();
		}
	}

</script>
@endsection