@extends('web.feedback.base')


@section('feedback')
	<div style="padding: 10px">
		<div class="context">
			<div class="media">
				<div class="media-body body-border">
					<h4 class="mt-0">{{$feedback['title']}}</h4>
					<p>{!! nl2br($feedback['detail']) !!}</p>
				</div>
			</div>

			@foreach($reply as $info)
				<div class="media">
					@if($info['sender'] == 1)
						<img class="mt15" src="/img/recv.png" width="60" alt="Generic placeholder image">
					@endif
					<div class="media-body body-border">
						<p>{!! nl2br($info['context']) !!}</p>
					</div>
					@if($info['sender'] == 0)
					<img class="mt15" src="/img/send.png" width="60" alt="Generic placeholder image">
					@endif
				</div>
			@endforeach
		</div>

		<div class="submit">
			<form style="margin-top: 50px;">
				<div class="form-group">
					<input type="hidden" name="fid" value="{{$feedback['id']}}">
					<textarea class="form-control" rows="3" name="context"></textarea>
				</div>
				<div>
					<div class="btn btn-primary offset-lg-10 offset-md-9 ajaxpost"
						ajaxurl="/reply/add"
						ajaxdata="func"
						datafun="validation"
						ajax-callback="form_callback"
						>
						提 交
					</div>
					<input type="reset" class="btn btn-default" value="重 置">
				</div>
			</form>
		</div>
	</div>
@endsection

@section('javascript')
<script type="text/javascript">
	function validation(obj)
	{
		let context = $("textarea[name='context']").val();
		if (context) {
			return {fid:$("input[name='fid']").val(),context:context};
		}

		layer.closeAll();
		layer.alert("请填写发送信息");
		return false;
	}
	function form_callback(obj,data)
	{
		if(data.code == 0) {
			let context = $("textarea[name='context']")
			let html = '';
			html += '<div class="media">';
			html +=	'<div class="media-body body-border">';
			html += '<p>' + context.val().replace(/\n/g,"<br>") + '</p>';
			html +=	'</div>';
			html += '<img class="mt15" src="/img/send.png" width="60" alt="Generic placeholder image">'
			html += '</div>'
			context.val('');
			$('.context').append(html);

		} else {
			layer.msg(data.msg);
		}
	}
</script>
@endsection