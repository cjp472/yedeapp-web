<script>
    var $editor = $('.create-reply .editor');
    var $jumper = $('#jump_to_editor');
    var $header = $('.topic-header');
    var $btnReply = $('.reply-button');
    var $btnSubmit = $('.create-reply').find('button.btn');
        
    var $buttonsAddFavorite = $('.favorite-add');
    {{--
    // var $buttonsVoteComment = $('.comment-vote');
    --}}
    
    var USERID = '{{ Auth::id() }}';
    var TOPIC_VOTES = '{!! $topic->votes !!}';
    var TOPIC_API = "{{ route('topic.vote', $topic) }}";
    
    function ButtonsHandler() {
        this.userId = USERID;
    
        this.setText = function(btn, text) {
            btn.children('span').text(text);
        };
    
        this.setIcon = function(btn, oldIcon, newIcon) {
            btn.children('i').removeClass(oldIcon).addClass(newIcon);
        };
    
        this.setStyle = function(btn, oldStyle, newStyle) {
            btn.removeClass(oldStyle).addClass(newStyle);
        };
    
        this.isVoted = function(data) {
            if (data) {
                var votes = JSON.parse(data);
                for (var i = 0; i < votes.length; i++) {
                    var vote = votes[i];
                    if (vote.user_id == this.userId) {
                        return true;
                    }
                }
            }
            return false;
        }
    
    }
    
    function FavoriteAddButtons(buttons) {
        this.buttons = buttons;
        this.state = false;
        this.initState = false;
        
        this.setAdded = function() {
            this.setStyle(buttons, 'btn-selected', 'btn-selected');
            this.setIcon(buttons, 'glyphicon-heart-empty', 'glyphicon-heart');
            this.setText(buttons, '已收藏');
        }
    
        this.setNotAdd = function() {
            this.setStyle(buttons, 'btn-selected', '');
            this.setIcon(buttons, 'glyphicon-heart-empty', 'glyphicon-heart-empty');
            this.setText(buttons, '收藏');
        }
    
        this.toggle = function() {
            if (this.state == 'added') {
                this.setNotAdd();
                this.state = 'noadd';
            } else {
                this.setAdded();
                this.state = 'added';
            }
        };
    
        this.init = function() {
            if (this.isVoted(TOPIC_VOTES)) {
                this.state = this.initState = 'added';
                this.setAdded();
            } else {
                this.state = this.initState = 'noadd';
                this.setNotAdd();
            }
        };
    
        this.isChanged = function() {
            return this.initState != this.state;
        }
    }
    
    {{--
    // function CommentVoteButtons(buttons) {
    //     this.buttons = buttons;
    //     this.state = [];
    //     this.initState = [];
    //     this.star = [];
    
    //     this.setVoteUp = function(btn, star) {
    //         this.setStyle(btn, 'btn-selected', 'btn-selected');
    //         this.setIcon(btn, 'glyphicon-thumbs-up', 'glyphicon-heart');
    //         this.setText(btn, star);
    //     }
    
    //     this.setVoteDown = function(btn, star) {
    //         this.setStyle(btn, 'btn-selected', '');
    //         this.setIcon(btn, 'glyphicon-thumbs-up', 'glyphicon-thumbs-up');
    //         this.setText(btn, star);
    //     }
    
    //     this.toggle = function(btn) {
    //         var key = btn.attr('data-key');
    //         var star = parseInt(this.star[key]);
    
    //         if (this.state[key] == 'up') {
    //             this.star[key] = star - 1;
    //             this.setVoteDown(btn, this.star[key]);
    //             this.state[key] = 'down';
    //         } else {
    //             this.star[key] = star + 1;
    //             this.setVoteUp(btn, this.star[key]);
    //             this.state[key] = 'up';
    //         }
    //     };
    
    //     this.init = function() {
    //         var that = this;
    //         this.buttons.each(function() {
    //             var btn = $(this),
    //                 key = btn.attr('data-key'),
    //                 data = btn.attr('data-vote'),
    //                 star = btn.attr('data-star');
    
    //             // Keep the star number whatever the state is.
    //             that.star[key] = star;
    
    //             if (that.isVoted(data)) {
    //                 that.state[key] = that.initState[key] = 'up';
    //                 that.setVoteUp(btn);
    //             } else {
    //                 that.state[key] = that.initState[key] = 'down';
    //                 that.setVoteDown(btn);
    //             }
    //         });
    //     };
    
    //     // When the btn has been changed, return it's state 'up' or 'down'.
    //     this.isChanged = function(btn) {
    //         var key = btn.attr('data-key');
    //         if (this.initState[key] != this.state[key]) {
    //             return this.state[key];
    //         } else {
    //             return false;
    //         }
    //     }
    // }
    
    // CommentVoteButtons.prototype = new ButtonsHandler();
    // CommentVoteButtons.prototype.constructor = CommentVoteButtons;
    // var cvbtns = new CommentVoteButtons($buttonsVoteComment);
    // cvbtns.init();
    --}}
    
    FavoriteAddButtons.prototype = new ButtonsHandler();
    FavoriteAddButtons.prototype.constructor = FavoriteAddButtons;
    
    var fabtns = new FavoriteAddButtons($buttonsAddFavorite);
    fabtns.init();
    
    $(document).ready(function(){
        // Init bootstrap popover
        $('[data-toggle="popover"]').popover();
        // Only subscriber can leave message
        if ($editor.length <= 0) {
            $jumper.popover();
        }
    
        // Jump to comment editor
        $jumper.click(function(){
            $editor.focus();
        })
    
        // Ctrl + Enter submit
        $editor.keydown(function(event) {
            if (event.ctrlKey && event.keyCode == 13) {
                $(this).parent('form').submit();
                // Prevent to submit multi times
                $(this).off('keydown').siblings('button.btn').attr('disabled','disabled');
            }
        });

        $btnSubmit.click(function() {
            $(this).parent('form').submit();
            $(this).attr('disabled','disabled').siblings('.editor').off('keydown');
        });

        // Reply button
        $btnReply.click(function() {
            var $cloneEditor = $('#reply-editor').children('.create-reply').clone({'withDataAndEvents':true});
            var $cloneEditorForm = $cloneEditor.find('form');

            var id = $(this).attr('data');
            var $inputParentId = $('<input type="hidden" name="parent_id" value="' + parseInt(id) + '">');
            $inputParentId.appendTo($cloneEditorForm);

            var $insertedEditor = $(this).parents('.media-body').find('.inserted-editor');
            $cloneEditor.appendTo($insertedEditor);
        });
    
        $buttonsAddFavorite.click(function() {
            fabtns.toggle();
        });
    
        {{--  
        //$buttonsVoteComment.click(function() {
        //cvbtns.toggle($(this));
        });  --}}
    
        $(window).on('beforeunload', function(){
            if (fabtns.isChanged()) {
                $.get(TOPIC_API);
            }
    
            {{--
            // $buttonsVoteComment.each(function() {
            //     var btn = $(this);
            //     var act, api;
    
            //     if (act = cvbtns.isChanged(btn)) {
            //         api = btn.attr('data-uri') + '/' + act + '?s=' + Math.random();
            //         $.get(api);
            //     }
            // });
            --}}
        });
    
        // Make topic-header show and hide
        $(window).scroll(function(){
            if ($(this).scrollTop() > 60) {
                $header.show();
            } else {
                $header.hide();
            }
        });
    });
    </script>
    <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"1","bdMiniList":["tqq","tieba","qzone","fbook","twi"],"bdPic":"","bdStyle":"0","bdSize":"24"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>