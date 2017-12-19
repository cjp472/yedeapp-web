@extends('layouts.app')

@section('title', $topic->title . ' - ' . config('app.name'))

@section('content')

<div class="row topic-detail">
    <div class="col-md-12">

        <div class="head clearfix">
            <h1 class="pull-left">测试如何开始编写测试如何开始编</h1>
            <div class="pull-right favorite"><a href="" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-heart"></i> 收藏</a></div>
        </div>

        <div class="body">
            <div class="content">{{ $topic->body }}</div>
        </div>

        <div class="sns-share">
            <div class="sns-component">分享：这里是分享图片</div>
            <div class="favorite"><a href="" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-heart"></i> 收藏</a></div>
        </div>

        <div class="prev-and-next clearfix">
            <a href="" class="btn btn-default pull-left prev"><i class="glyphicon glyphicon-chevron-left"></i> 上一节</a>
            <a href="" class="btn btn-default pull-right next">下一节 <i class="glyphicon glyphicon-chevron-right"></i></a>
        </div>

    </div>
</div>

<div class="row topic-comments">
    <div class="col-md-12">
    
        <div class="head clearfix">
            <div class="heading pull-left">留言精选</div>
            <div class="pull-right"><a href=""><i class="glyphicon glyphicon-pencil"></i> 写留言</a></div>
        </div>

        <div class="body">
            <ul class="media-list comments">

                <li class="media comment">
                    <div class="media-left">
                        <a href="#">
                            <img class="media-object" width="50px" src="https://fsdhubcdn.phphub.org/uploads/avatars/2285_1500347608.jpeg?imageView2/1/w/200/h/200&e=1513587239&token=2vxC9mwLd9SS1hS_uqfK99SsyG2qVm-BWFXuVl96:4g841JMBKbZRuraaklAThfL4LTI=">
                        </a>
                    </div>
                    <div class="media-body">
                        <div class="media-heading">
                            <span class="author">aaron</span>
                            <a class="pull-right" href=""><i class="glyphicon glyphicon-thumbs-up"></i> 10</a>
                        </div>
                        <div class="comment-content">这里是我写得一个篇重复的不停重复的留言，这里是我写得一个篇重复的不停重复的留言这里是我写得一个篇重复的不停重复的留言，这里是我写得一个篇重复的不停重复的留言，这里是我写得一个篇重复的不停重复的留言这里是我写得一个篇重复的不停重复的留言这里是我写得一个篇重复的不停重复的留言这里是我写得一个篇重复的不停重复的留言，这里是我写得一个篇重复的不停重复的留言。</div>
                        <div class="comment-date">6天前</div>

                        <div class="media reply">
                            <div class="media-body">
                                <div class="media-heading">
                                    <span class="author"><i class="vline"></i>作者回复</span>
                                    <a class="pull-right" href=""><i class="glyphicon glyphicon-thumbs-up"></i> 220</a>
                                </div>
                                <div class="comment-content">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</div>
                                <div class="comment-date">2天前</div>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="media comment">
                    <div class="media-left">
                        <a href="#">
                            <img class="media-object" width="50px" src="https://fsdhubcdn.phphub.org/uploads/avatars/2285_1500347608.jpeg?imageView2/1/w/200/h/200&e=1513587239&token=2vxC9mwLd9SS1hS_uqfK99SsyG2qVm-BWFXuVl96:4g841JMBKbZRuraaklAThfL4LTI=">
                        </a>
                    </div>
                    <div class="media-body">
                        <div class="media-heading">
                            <span class="author">aaron</span>
                            <a class="pull-right" href=""><i class="glyphicon glyphicon-thumbs-up"></i> 10</a>
                        </div>
                        <div class="comment-content">这里是我写得一个篇重复的不停重复的留言，这里是我写得一个篇重复的不停重复的留言这里是我写得一个篇重复的不停重复的留言，这里是我写得一个篇重复的不停重复的留言，这里是我写得一个篇重复的不停重复的留言这里是我写得一个篇重复的不停重复的留言这里是我写得一个篇重复的不停重复的留言这里是我写得一个篇重复的不停重复的留言，这里是我写得一个篇重复的不停重复的留言。</div>
                        <div class="comment-date">6天前</div>
                    </div>
                </li>

                <li class="media comment">
                    <div class="media-left">
                        <a href="#">
                            <img class="media-object" width="50px" src="https://fsdhubcdn.phphub.org/uploads/avatars/2285_1500347608.jpeg?imageView2/1/w/200/h/200&e=1513587239&token=2vxC9mwLd9SS1hS_uqfK99SsyG2qVm-BWFXuVl96:4g841JMBKbZRuraaklAThfL4LTI=">
                        </a>
                    </div>
                    <div class="media-body">
                        <div class="media-heading">
                            <span class="author">aaron</span>
                            <a class="pull-right" href=""><i class="glyphicon glyphicon-thumbs-up"></i> 10</a>
                        </div>
                        <div class="comment-content">这里是我写得一个篇重复的不停重复的留言，这里是我写得一个篇重复的不停重复的留言这里是我写得一个篇重复的不停重复的留言，这里是我写得一个篇重复的不停重复的留言，这里是我写得一个篇重复的不停重复的留言这里是我写得一个篇重复的不停重复的留言这里是我写得一个篇重复的不停重复的留言这里是我写得一个篇重复的不停重复的留言，这里是我写得一个篇重复的不停重复的留言。</div>
                        <div class="comment-date">6天前</div>

                        <div class="media reply">
                            <div class="media-body">
                                <div class="media-heading">
                                    <span class="author"><i class="vline"></i>作者回复</span>
                                    <a class="pull-right" href=""><i class="glyphicon glyphicon-thumbs-up"></i> 220</a>
                                </div>
                                <div class="comment-content">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</div>
                                <div class="comment-date">2天前</div>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="media write">
                    <div class="media-left">
                        <a href="#">
                            <img class="media-object" width="50px" src="https://fsdhubcdn.phphub.org/uploads/avatars/2285_1500347608.jpeg?imageView2/1/w/200/h/200&e=1513587239&token=2vxC9mwLd9SS1hS_uqfK99SsyG2qVm-BWFXuVl96:4g841JMBKbZRuraaklAThfL4LTI=">
                        </a>
                    </div>
                    <div class="media-body">
                        <textarea class="editor" placeholder="请不要发表不友善和负能量言论"></textarea>
                        <button class="btn btn-primary" type="submit">　　提交　　</button>
                    </div>
                </li>

            </ul>
        </div>

    </div>
</div>

@stop
