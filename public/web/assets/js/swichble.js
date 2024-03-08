
(function (o) {
    if (typeof define === 'function') {
        define(['jquery'], function () {
            return o;
        })
    } else {
        window.switchable = o;
    }
})(function () {
    var Switchable,
        defaults;
    defaults = {
        type: ''
        , effect: 'slide'
        , showNav: true
        , showPage: true
        , callback: {
            loaded: function () { }
            , start: function () { }
            , complete: function () { }
        }
        , animateSpeed: 500
        , interval: 2000
        , restartDelay: 2000
        , pauseOnHover: true
        , loadImg: true
        , autoPlay: true
        , transformFix: true
        , switchNavEvent: 'click'
        , switchMainClass: 'switch_main'
        , switchItemClass: 'switch_item'
        , pageClass: 'switch_page'
        , pageItemClass: 'switch_page_item'
        , navClass: 'switch_nav'
        , navItemClass: 'switch_nav_item'
        , navCurrentClass: 'switch_nav_item_current'
        , mixClass: 'item'

    };
    Switchable = function (opts) {
        return new Switchable.fn.init(opts);
    }
    Switchable.fn = Switchable.prototype = {
        init: function (opts) {
            var _this = this,
                opts = this.opts = $.extend(true, {}, defaults, opts),
                $element = this.$element = opts.$element;
            if (this.opts.type == 'imgScroll') {
                this.scrollMix();
            }
            this.items = $element.find('.' + opts.switchItemClass);
            this.total = this.items.length;
            this.buildHtml();
            //this.transformFix = this.getTransformFix();
            this.width = $element.width();
            this.current = 0;

            this.bindEvent();
        }

        //Â´Â´Â½Â¨Â»Ã¹Â±Â¾ÂµÃ„html
        , buildHtml: function () {
            var html = '';
            if (this.opts.showNav) {
                for (var i = 0; i < this.total; i++) {
                    html += '<a class="' + this.opts.navItemClass + '" href="javascript:;">' + (i + 1) + '</a>';
                }
                html = '<div class="' + this.opts.navClass + '">' + html + '</div>';
                this.opts.$element.append(html);
            }

            if (this.opts.showPage) {
                this.opts.$element.append('<div class="' + this.opts.pageClass + '">\
		                            <a href="javascript:;" class="prev"></a><a href="javascript:;" class="next"></a>\
	                            </div>');
            }
            this.nav = this.opts.$element.find('.' + this.opts.navItemClass);
            this.main = this.opts.$element.find('.' + this.opts.switchMainClass);
            this.effectInit();
            this.opts.callback.loaded();
        }

        //Â¸Ã·Ã–Ã–ÃÂ§Â¹Ã»Â³ÃµÃŠÂ¼Â»Â¯
        , effectInit: function () {
            var _this = this;
            if (this.opts.loadImg) {
                this.items.eq(0).find('img').attr('src', function () {
                    return $(this).attr('data-src');
                });
            }
            this.items.eq(0).show();
            this.nav.eq(0).addClass(this.opts.navCurrentClass);
            if (this.opts.autoPlay) {
                this.play();
            }

        }

        //Â°Ã³Â¶Â¨ÃŠÃ‚Â¼Ã¾
        , bindEvent: function () {
            var _this = this;
            if (this.opts.showNav) {
                this.opts.$element.on(this.opts.switchNavEvent, '.' + this.opts.navItemClass, function () {
                    _this.moveTo($(this).index());
                });
            }
            if (this.opts.showPage) {
                this.opts.$element.on('click', '.' + this.opts.pageClass + ' .next', function () {
                    _this.next();
                });
                this.opts.$element.on('click', '.' + this.opts.pageClass + ' .prev', function () {
                    _this.prev();
                });
            }
            if (this.opts.pauseOnHover) {
                this.opts.$element.on('mouseenter', function () {
                    _this.stop();
                }).on('mouseleave', function () {
                    if (_this.opts.restartDelay) {
                        _this.restartDelay = setTimeout(function () {
                            _this.play();
                        }, _this.opts.restartDelay);
                    } else {
                        _this.play();
                    }
                });
            }
        }

        //Ã’Ã†Ã–ÃÃ„Â³Ã’Â»Ã–Â¡
        , moveTo: function (n) {
            this.slide(n);
        }

        //Â²Â¥Â·Ã…interval
        , play: function () {
            var _this = this;
            if (!this.playInterval) {
                this.playInterval = setInterval(function () {
                    if (_this.opts.effect in _this) {
                        _this[_this.opts.effect]('next');
                    }
                }, this.opts.interval);
            }
        }

        //ÃÂ£Ã–Â¹
        , stop: function () {
            if (this.playInterval) {
                clearInterval(this.playInterval);
                this.playInterval = null;
            }
        }

        //slideÃ‡ÃÂ»Â»ÃŠÂµÃÃ–
        , slide: function (n) {
            var _this = this,
                $element = this.$element,
                next,
                $next,
                imgs,
                direction;
            if (!this.animating && n != this.current) {
                this.animating = true;
                if (typeof n === 'number') {
                    direction = n > this.current ? -1 : 1;
                } else if (n === 'next') {
                    n = this.current + 1;
                    direction = -1;
                } else if (n === 'prev') {
                    n = this.current - 1;
                    direction = 1;
                }

                n = n >= this.total ? 0 : n;
                n = n === -1 ? this.total - 1 : n;
                $next = this.items.eq(n);
                this.opts.callback.start(n);
                this.nav.removeClass(this.opts.navCurrentClass);
                this.nav.eq(n).addClass(this.opts.navCurrentClass);
                imgs = $next.find('img');
                imgs.each(function () {
                    var e = $(this);
                    if (!e.attr('src')) {
                        e.attr('src', e.attr('data-src'));
                    }
                });


                $next.css({
                    left: -this.width * direction
                }).show();


                this.main.stop(true).animate({
                    left: this.width * direction
                }, this.opts.animateSpeed, function () {
                    _this.main.css({
                        left: 0
                    });
                    $next.css({
                        left: 0
                    });
                    _this.items.eq(_this.current).css({
                        left: 0
                    }).hide();
                    _this.animating = false;
                    _this.current = n;
                    _this.opts.callback.complete(n);
                });

            }
        }

        //fadeÃ‡ÃÂ»Â»ÃŠÂµÃÃ–
        , fade: function (n) {
            var _this = this,
                $element = this.$element,
                next,
                $next,
                imgs,
                direction;
            if (!this.animating && n != this.current) {
                this.animating = true;
                if (typeof n === 'number') {
                    direction = n > this.current ? -1 : 1;
                } else if (n === 'next') {
                    n = this.current + 1;
                    direction = -1;
                } else if (n === 'prev') {
                    n = this.current - 1;
                    direction = 1;
                }

                n = n >= this.total ? 0 : n;
                n = n === -1 ? this.total - 1 : n;
                $next = this.items.eq(n);
                this.opts.callback.start(n);
                this.nav.removeClass(this.opts.navCurrentClass);
                this.nav.eq(n).addClass(this.opts.navCurrentClass);

                imgs = $next.find('img');
                imgs.each(function () {
                    var e = $(this);
                    if (!e.attr('src')) {
                        e.attr('src', e.attr('data-src'));
                    }
                });
                $next.css({
                    zIndex: this.total
                });
                this.items.stop().eq(this.current).fadeOut(this.opts.animateSpeed);
                $next.stop().fadeIn(this.opts.animateSpeed, function () {
                    _this.animating = false;
                    _this.current = n;
                    _this.opts.callback.complete(n);
                });
            }
        }

        //ÃÂ¼Ã†Â¬Â¹Ã¶Â¶Â¯Â£Â¬ÃŽÂ´ÃŠÂµÃÃ–Ã•Ã¦Ã•Ã½Ã’Ã¢Ã’Ã¥Ã‰ÃÂµÃ„ÃŽÃžÂ·Ã¬Â¹Ã¶Â¶Â¯Â£Â¬Ã–Â»ÃŠÃ‡Â°Ã¼Ã—Â°Ã—Ã©ÂºÃÃÃ‹itemÃ’Ã”Â»ÃƒÂµÃ†ÃÃŽÃŠÂ½Ã‡ÃÂ»Â»Â£Â¬Â¼Â´Â¹Ã¶Â¶Â¯ÂµÂ¥ÃŽÂ»Ã–Â»Ã„ÃœÃ’Ã”Â¿Ã‰ÃŠÃ“Â·Â¶ÃŽÂ§
        , imgScroll: function () {
            this[_this.opts.effect]('next');
        }

        //ÃÂ¼Ã†Â¬Â¹Ã¶Â¶Â¯ÃÃ®Ã„Â¿ÂµÃ„Ã—Ã©ÂºÃ
        , scrollMix: function () {
            var _this = this,
                items = this.opts.$element.find('.' + this.opts.mixClass),
                i = 0, e, num, mixNum;
            num = this.opts.$element.width() / items.outerWidth(true);
            num = Math.round(num);
            //Â¸Â´Ã–Ã†Â´Ã•Ã•Ã»
            mixNum = num - items.length % num;
            if (mixNum !== num) {
                items.filter(':last').after(items.slice(0, mixNum).clone());
                items = this.opts.$element.find('.' + this.opts.mixClass);
            }
            while ((e = items.slice(i, i + num)).length > 0) {
                e.wrapAll('<div class="switch_item" style="width:' + this.opts.$element.width() + 0 + 'px"></div>');//trace ÃƒÂ»Ã“ÃÃ—Ã¶Â¾Â«ÃˆÂ·ÂµÃ„Â¼Ã†Ã‹Ã£
                i = i + 3;
            }
        }

        , next: function () {
            this[this.opts.effect]('next');
        }
        , prev: function () {
            this[this.opts.effect]('prev');
        }

        //ÃŽÂ´ÃŠÂµÃÃ–CSS3Ã‡ÃÂ»Â»
        , getTransformFix: function () {
            var body, i, style, transition, fix;
            body = document.body || document.documentElement;
            style = body.style;
            transition = "Transition";
            fix = ["Moz", "Webkit", "Khtml", "O", "ms"];
            i = 0;
            while (i < fix.length) {
                if (typeof style[fix[i] + transition] === "string") {
                    return fix[i];
                }
                i++;
            }
            return false;
        }
    };
    Switchable.fn.init.prototype = Switchable.prototype;
    return Switchable;
}());