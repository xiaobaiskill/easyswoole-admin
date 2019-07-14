@extends('layouts.admin')

@section('body-title','修改密码')

@section('body')
<div class="layui-card">
    <div class="layui-card-header">@yield('body-title')</div>
    <div class="layui-card-body">
        <div class="layui-container">
            <div class="layui-row">
                <div class="layui-col-md10">
                    <form class="layui-form" action="" lay-filter="form">
                        <div class="layui-form-item">
                            <label class="layui-form-label">当前密码</label>
                            <div class="layui-input-block">
                                <input type="password" name="old_pwd" required lay-verify="required|pwd" placeholder="请输入密码" autocomplete="off" class="layui-input">
                            </div>
                        </div>

                        <div class="layui-form-item">
                            <label class="layui-form-label">新密码</label>
                            <div class="layui-input-block">
                                <input type="password" name="pwd" required lay-verify="required|pwd" placeholder="请输入密码" autocomplete="off" class="layui-input">
                            </div>
                        </div>

                        <div class="layui-form-item">
                            <label class="layui-form-label">确认密码</label>
                            <div class="layui-input-block">
                                <input type="password" name="verify_pwd" required  lay-verify="required|verify_pwd" placeholder="请输入密码" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-input-block">
                                <button class="layui-btn" lay-submit lay-filter="submit">确认修改</button>
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

@section('javascriptFooter')
<script>
layui.use('form', function(){
    var form = layui.form, $ = layui.jquery,form_field;


    function callback(data)
    {
        if(data.code != 0) {
            layer.msg(data.msg);
        } else {
            layer.msg('添加成功',{time:1000},function(){
                location.href = '/auth';
            });

        }
    }
    form.verify({
        pwd: [
            /^[\S]{6,12}$/
            ,'密码必须6到15位，且不能出现空格'
        ],
        verify_pwd:function(value, item){
            var pwd = $("input[name='pwd']").val();
            if(pwd !== value) {
                return '两次输入的密码不一致';
            }
        }
    });

    //监听提交
    form.on('submit(submit)', function(data){
        form_field = data;
        delete data.field.verify_pwd;
        post('/auth/pwd',data.field,callback);
        return false;
    });
});
</script>
@endsection