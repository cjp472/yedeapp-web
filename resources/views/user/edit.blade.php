@extends('layout.app')

@section('title', '编辑个人资料' . ' - '. config('app.name'))

@section('content')

<div class="row">
    <div class="panel panel-default col-md-10 col-md-offset-1">
        <div class="panel-heading">
            <h4>
                <i class="glyphicon glyphicon-edit"></i> 编辑个人资料
            </h4>
        </div>

        @include('common.error')

        <div class="panel-body">

            <form class="form-horizontal" action="{{ route('user.update', $user->id) }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label class="col-sm-2" for="name_field">用户名</label>
                    <div class="col-sm-7"><input class="form-control" type="text" name="name" id="name_field" value="{{ old('name', $user->name ) }}" /></div>
                    <div class="col-sm-3 input-tips">可使用中英文</div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2" for="email_field">邮　箱</label>
                    <div class="col-sm-7"><input class="form-control" type="text" name="email" id="email_field" value="{{ old('email', $user->email ) }}" /></div>
                    <div class="col-sm-3 input-tips">邮箱可用于登陆</div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2" for="phone_field">手　机</label>
                    <div class="col-sm-7"><input class="form-control" type="text" name="phone" id="phone_field" value="{{ old('phone', $user->phone ) }}" /></div>
                    <div class="col-sm-3 input-tips">手机号可用于登陆</div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2" for="introduction_field">个人简介</label>
                    <div class="col-sm-7"><textarea name="introduction" id="introduction_field" class="form-control" rows="3">{{ old('introduction', $user->introduction ) }}</textarea></div>
                    <div class="col-sm-3 input-tips">一句话介绍自己</div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 avatar-label" for="avatar_field">头　像</label>
                    <div class="col-sm-7">
                        <input type="file" name="avatar" id="avatar_field">
                        @if($user->avatar)
                            <label for="avatar_field"><img class="img-thumbnail img-responsive" src="{{ $user->avatar }}" width="200" /></label>
                        @endif
                    </div>
                    <div class="col-sm-3 input-tips">请上传小于 1M 的图片</div>
                </div>
                <hr>
                <div class="form-group">
                    <div class="col-sm-7 col-sm-offset-2">
                        <button type="submit" class="btn btn-primary btn-wider-look">保存</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@stop