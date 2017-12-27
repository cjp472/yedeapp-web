@extends('layout.app')

@section('content')
<div class="row login-panel">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation"><a href="#weixin" aria-controls="weixin" role="tab" data-toggle="tab">微信登录</a></li>
                    <li role="presentation" class="active"><a href="#account" aria-controls="account" role="tab" data-toggle="tab">帐号登录</a></li>
                </ul>
                <div class="tab-content">
                    {{--微信登录--}}
                    <div role="tabpanel" class="tab-pane" id="weixin">
                        <div data-v-2c6958ee="" data-v-56ed70ea="" class="wxLogin"><div data-v-2c6958ee=""><div data-v-2c6958ee="" id="login_container"><iframe src="https://open.weixin.qq.com/connect/qrconnect?appid=wxd3ab22331c3b1470&amp;scope=snsapi_login&amp;redirect_uri=https://admin.xiaoe-tech.com/codeinfo?version_type=undefined&amp;state=&amp;login_type=jssdk&amp;self_redirect=default&amp;style=black&amp;href=https://admin.xiaoe-tech.com/css/admin/wechatCodeNewLogin.css" frameborder="0" scrolling="no" width="300px" height="400px"></iframe></div> <p data-v-2c6958ee="" class="wxTip">请使用微信扫描二维码登录<br data-v-2c6958ee="">“小鹅通管理台”</p></div> <div data-v-2c6958ee="" class="wxLoginFaild" style="display: none;"><img data-v-2c6958ee="" src="/images/alert/blue_info_prompt.svg" alt=""> <p data-v-2c6958ee="" title="">提示</p> <p data-v-2c6958ee="" class="cont">该微信号暂未绑定小鹅通账号</p> <button data-v-2c6958ee="" class="btn blue">立即注册</button></div></div>
                    </div>
                    {{--帐号登录--}}
                    <div role="tabpanel" class="tab-pane active" id="account">
                        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            {{--邮箱--}}
                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-3 control-label">邮　箱</label>
                                <div class="col-md-7">
                                    <input id="email" type="email" placeholder="请输入邮箱" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            {{--密码--}}
                            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-3 control-label">密　码</label>
                                <div class="col-md-7">
                                    <input id="password" type="password" placeholder="请输入密码" class="form-control" name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            {{--验证码--}}
                            <div class="form-group {{ $errors->has('captcha') ? ' has-error' : '' }}">
                                <label for="captcha" class="col-md-3 control-label">验证码</label>
                                <div class="col-md-7">
                                    <input id="captcha" class="form-control" name="captcha" placeholder="请输入图片验证码">
                                    <img class="captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片刷新验证码">
                                    @if ($errors->has('captcha'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('captcha') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            {{--记住我--}}
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> 下次自动登录</label>
                                    </div>
                                </div>
                            </div>
                            {{--登陆按钮--}}
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-3">
                                    <button type="submit" class="btn btn-primary btn-wider-look">登录</button>
                                    <a class="btn btn-link" href="{{ route('password.request') }}">忘记密码？</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
