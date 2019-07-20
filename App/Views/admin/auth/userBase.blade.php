@extends('layouts.admin')

@section('body')
<div class="layui-card">
    @yield('body-title')
    <div class="layui-card-body">
        <div class="layui-container">
            <div class="layui-row">
                <div class="layui-col-md10">
                    <form class="layui-form" action="" lay-filter="form">
                        <div class="layui-form-item">
                            <label class="layui-form-label">登陆名</label>
                            <div class="layui-input-block">
                                <input type="text" name="uname" required  lay-verify="required" placeholder="请输入登陆名" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">密码</label>
                            <div class="layui-input-block">
                                <input type="text" name="pwd" required lay-verify="required|pwd" placeholder="请输入密码" autocomplete="off" class="layui-input">
                            </div>
                        </div>

                        <div class="layui-form-item">
                            <label class="layui-form-label">重复密码</label>
                            <div class="layui-input-block">
                                <input type="text" name="verify_pwd" required lay-verify="required|verify_pwd" placeholder="请输入密码" autocomplete="off" class="layui-input">
                            </div>
                        </div>

						<div class="layui-form-item">
							<label class="layui-form-label">所属组</label>
							<div class="layui-input-block">
								<select name="role_id">
									@foreach($role_data as $k=>$v)
										<option value="{{$v['id']}}">{{$v['name']}}</option>
									@endforeach
								</select>
							</div>
						</div>

                        <div class="layui-form-item">
                            <label class="layui-form-label">真实用户名</label>
                            <div class="layui-input-block">
                                <input type="text" name="display_name" required lay-verify="required" placeholder="请输入真实用户名" autocomplete="off" class="layui-input">
                            </div>
                        </div>

                        <div class="layui-form-item">
							<label class="layui-form-label">是否启动</label>
							<div class="layui-input-block">
								<input type="checkbox" name="status" lay-skin="switch" checked lay-text="是|否">
							</div>
						</div>

                        <div class="layui-form-item">
                            <div class="layui-input-block">
                                <button class="layui-btn" lay-submit lay-filter="submit">立即提交</button>
                                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection