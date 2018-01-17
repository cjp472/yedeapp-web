<script type="text/javascript"  src="{{ asset('js/mditor.min.js') }}"></script>
<script>
    var $editor = $('.create-reply .editor');
    var $jumper = $('#jump_to_editor');
    var $header = $('.topic-header');
    var $btnReply = $('.reply-button');
    var $btnSubmit = $('.create-reply').find('button.btn');
    var $btnAtUser = $('.at-user');

    var $buttonsAddFavorite = $('.favorite-add');

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
    
    FavoriteAddButtons.prototype = new ButtonsHandler();
    FavoriteAddButtons.prototype.constructor = FavoriteAddButtons;
    
    var fabtns = new FavoriteAddButtons($buttonsAddFavorite);
    fabtns.init();

    $(document).ready(function(){
        // Init prev and next buttons' popover
        $('[data-toggle="popover"]').popover();
    
        $buttonsAddFavorite.click(function() {
            fabtns.toggle();
        });
    
        $(window).on('beforeunload', function(){
            if (fabtns.isChanged()) {
                $.get(TOPIC_API);
            }
        });
    
        // Make topic-header show and hide
        $(window).scroll(function(){
            if ($(this).scrollTop() > 60) {
                $header.show();
            } else {
                $header.hide();
            }
        });

        // Only subscriber can leave messages
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

        // Reply submit
        $btnSubmit.click(function() {
            $(this).parent('form').submit();
            $(this).attr('disabled','disabled').siblings('.editor').off('keydown');
        });

        // Call author reply editor
        $btnReply.click(function() {
            var $insertedEditor = $(this).parents('.media-body').find('.inserted-editor');
            var isReplying = $(this).data('isReplying');

            if (isReplying) {
                $insertedEditor.find('.create-reply').remove();
                $(this).children('span').text('回复');
                $(this).data('isReplying', false);
            } else {
                var $cloneEditor = $('#reply-editor').children('.create-reply').clone({'withDataAndEvents':true});
                var $cloneEditorForm = $cloneEditor.find('form');
    
                var id = $(this).attr('data');
                var $inputParentId = $('<input type="hidden" name="parent_id" value="' + parseInt(id) + '">');
                $inputParentId.appendTo($cloneEditorForm);
    
                $cloneEditor.appendTo($insertedEditor);      
                $(this).children('span').text('取消回复');
                $(this).data('isReplying', true);
            }
        });

        //at a user
        $btnAtUser.click(function() {
            var name = $(this).attr('data');
            var atOne = '@' + name + ' ';
            var text = $editor.text() + atOne;

            $editor.text(text);
            $editor.focus();
        });
    });
    </script>
    <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"1","bdMiniList":["tqq","tieba","qzone","fbook","twi"],"bdPic":"","bdStyle":"0","bdSize":"24"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>