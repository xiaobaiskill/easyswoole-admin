@extends('layouts.admin')

@section('body')
<div class="layui-card">
    @yield('body-title')
    <div class="layui-card-body">
        <div class="layui-container">
            <div class="layui-row">
                <div class="layui-col-md9">
                    <form class="layui-form" action="" lay-filter="form">
                        <div class="layui-form-item">
                            <label class="layui-form-label">组名</label>
                            <div class="layui-input-block">
                                <input type="text" name="name" required  lay-verify="required" placeholder="请输入名称" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">描述</label>
                            <div class="layui-input-block">
                                <input type="text" name="detail" required lay-verify="required" placeholder="请输入组的描述" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">上级组</label>
                            <div class="layui-input-block">
                                <select name="pid">
                                    <option value="">请选择上级组</option>
                                    @foreach($role_data as $k=>$v)
                                        <option value="{{$v['id']}}">{{$v['name']}}</option>
                                    @endforeach
                                </select>
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
