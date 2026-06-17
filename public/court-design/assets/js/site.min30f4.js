/*CourtBuilder 1.0.0 compiled on 2016-04-03*/ ! function(e) {
    e.fn.customScrollbar = function(i, t) {
        var o = {
                skin: void 0,
                hScroll: !0,
                vScroll: !0,
                updateOnWindowResize: !1,
                animationSpeed: 300,
                onCustomScroll: void 0,
                swipeSpeed: 1,
                wheelSpeed: 40,
                fixedThumbWidth: void 0,
                fixedThumbHeight: void 0
            },
            s = function(i, t) {
                this.$element = e(i), this.options = t, this.addScrollableClass(), this.addSkinClass(), this.addScrollBarComponents(), this.options.vScroll && (this.vScrollbar = new n(this, new r)), this.options.hScroll && (this.hScrollbar = new n(this, new l)), this.$element.data("scrollable", this), this.initKeyboardScrolling(), this.bindEvents()
            };
        s.prototype = {
            addScrollableClass: function() {
                this.$element.hasClass("scrollable") || (this.scrollableAdded = !0, this.$element.addClass("scrollable"))
            },
            removeScrollableClass: function() {
                this.scrollableAdded && this.$element.removeClass("scrollable")
            },
            addSkinClass: function() {
                "string" != typeof this.options.skin || this.$element.hasClass(this.options.skin) || (this.skinClassAdded = !0, this.$element.addClass(this.options.skin))
            },
            removeSkinClass: function() {
                this.skinClassAdded && this.$element.removeClass(this.options.skin)
            },
            addScrollBarComponents: function() {
                this.assignViewPort(), 0 == this.$viewPort.length && (this.$element.wrapInner('<div class="viewport" />'), this.assignViewPort(), this.viewPortAdded = !0), this.assignOverview(), 0 == this.$overview.length && (this.$viewPort.wrapInner('<div class="overview" />'), this.assignOverview(), this.overviewAdded = !0), this.addScrollBar("vertical", "prepend"), this.addScrollBar("horizontal", "append")
            },
            removeScrollbarComponents: function() {
                this.removeScrollbar("vertical"), this.removeScrollbar("horizontal"), this.overviewAdded && this.$element.unwrap(), this.viewPortAdded && this.$element.unwrap()
            },
            removeScrollbar: function(e) {
                this[e + "ScrollbarAdded"] && this.$element.find(".scroll-bar." + e).remove()
            },
            assignViewPort: function() {
                this.$viewPort = this.$element.find(".viewport")
            },
            assignOverview: function() {
                this.$overview = this.$viewPort.find(".overview")
            },
            addScrollBar: function(e, i) {
                0 == this.$element.find(".scroll-bar." + e).length && (this.$element[i]("<div class='scroll-bar " + e + "'><div class='thumb'></div></div>"), this[e + "ScrollbarAdded"] = !0)
            },
            resize: function(e) {
                this.vScrollbar && this.vScrollbar.resize(e), this.hScrollbar && this.hScrollbar.resize(e)
            },
            scrollTo: function(e) {
                this.vScrollbar && this.vScrollbar.scrollToElement(e), this.hScrollbar && this.hScrollbar.scrollToElement(e)
            },
            scrollToXY: function(e, i) {
                this.scrollToX(e), this.scrollToY(i)
            },
            scrollToX: function(e) {
                this.hScrollbar && this.hScrollbar.scrollOverviewTo(e, !0)
            },
            scrollToY: function(e) {
                this.vScrollbar && this.vScrollbar.scrollOverviewTo(e, !0)
            },
            remove: function() {
                this.removeScrollableClass(), this.removeSkinClass(), this.removeScrollbarComponents(), this.$element.data("scrollable", null), this.removeKeyboardScrolling(), this.vScrollbar && this.vScrollbar.remove(), this.hScrollbar && this.hScrollbar.remove()
            },
            setAnimationSpeed: function(e) {
                this.options.animationSpeed = e
            },
            isInside: function(i, t) {
                var o = e(i),
                    s = e(t),
                    n = o.offset(),
                    l = s.offset();
                return n.top >= l.top && n.left >= l.left && n.top + o.height() <= l.top + s.height() && n.left + o.width() <= l.left + s.width()
            },
            initKeyboardScrolling: function() {
                var e = this;
                this.elementKeydown = function(i) {
                    document.activeElement === e.$element[0] && (e.vScrollbar && e.vScrollbar.keyScroll(i), e.hScrollbar && e.hScrollbar.keyScroll(i))
                }, this.$element.attr("tabindex", "-1").keydown(this.elementKeydown)
            },
            removeKeyboardScrolling: function() {
                this.$element.removeAttr("tabindex").unbind("keydown", this.elementKeydown)
            },
            bindEvents: function() {
                this.options.onCustomScroll && this.$element.on("customScroll", this.options.onCustomScroll)
            }
        };
        var n = function(e, i) {
            this.scrollable = e, this.sizing = i, this.$scrollBar = this.sizing.scrollBar(this.scrollable.$element), this.$thumb = this.$scrollBar.find(".thumb"), this.setScrollPosition(0, 0), this.resize(), this.initMouseMoveScrolling(), this.initMouseWheelScrolling(), this.initTouchScrolling(), this.initMouseClickScrolling(), this.initWindowResize()
        };
        n.prototype = {
            resize: function(e) {
                this.scrollable.$viewPort.height(this.scrollable.$element.height()), this.sizing.size(this.scrollable.$viewPort, this.sizing.size(this.scrollable.$element)), this.viewPortSize = this.sizing.size(this.scrollable.$viewPort), this.overviewSize = this.sizing.size(this.scrollable.$overview), this.ratio = this.viewPortSize / this.overviewSize, this.sizing.size(this.$scrollBar, this.viewPortSize), this.thumbSize = this.calculateThumbSize(), this.sizing.size(this.$thumb, this.thumbSize), this.maxThumbPosition = this.calculateMaxThumbPosition(), this.maxOverviewPosition = this.calculateMaxOverviewPosition(), this.enabled = this.overviewSize > this.viewPortSize, void 0 === this.scrollPercent && (this.scrollPercent = 0), this.enabled ? this.rescroll(e) : this.setScrollPosition(0, 0), this.$scrollBar.toggle(this.enabled)
            },
            calculateThumbSize: function() {
                var i, e = this.sizing.fixedThumbSize(this.scrollable.options);
                return i = e ? e : this.ratio * this.viewPortSize, Math.max(i, this.sizing.minSize(this.$thumb))
            },
            initMouseMoveScrolling: function() {
                var i = this;
                this.$thumb.mousedown(function(e) {
                    i.enabled && i.startMouseMoveScrolling(e)
                }), this.documentMouseup = function(e) {
                    i.stopMouseMoveScrolling(e)
                }, e(document).mouseup(this.documentMouseup), this.documentMousemove = function(e) {
                    i.mouseMoveScroll(e)
                }, e(document).mousemove(this.documentMousemove), this.$thumb.click(function(e) {
                    e.stopPropagation()
                })
            },
            removeMouseMoveScrolling: function() {
                this.$thumb.unbind(), e(document).unbind("mouseup", this.documentMouseup), e(document).unbind("mousemove", this.documentMousemove)
            },
            initMouseWheelScrolling: function() {
                var e = this;
                this.scrollable.$element.mousewheel(function(i, t, o, s) {
                    e.enabled && e.mouseWheelScroll(o, s) && (i.stopPropagation(), i.preventDefault())
                })
            },
            removeMouseWheelScrolling: function() {
                this.scrollable.$element.unbind("mousewheel")
            },
            initTouchScrolling: function() {
                if (document.addEventListener) {
                    var e = this;
                    this.elementTouchstart = function(i) {
                        e.enabled && e.startTouchScrolling(i)
                    }, this.scrollable.$element[0].addEventListener("touchstart", this.elementTouchstart), this.documentTouchmove = function(i) {
                        e.touchScroll(i)
                    }, document.addEventListener("touchmove", this.documentTouchmove), this.elementTouchend = function(i) {
                        e.stopTouchScrolling(i)
                    }, this.scrollable.$element[0].addEventListener("touchend", this.elementTouchend)
                }
            },
            removeTouchScrolling: function() {
                document.addEventListener && (this.scrollable.$element[0].removeEventListener("touchstart", this.elementTouchstart), document.removeEventListener("touchmove", this.documentTouchmove), this.scrollable.$element[0].removeEventListener("touchend", this.elementTouchend))
            },
            initMouseClickScrolling: function() {
                var e = this;
                this.scrollBarClick = function(i) {
                    e.mouseClickScroll(i)
                }, this.$scrollBar.click(this.scrollBarClick)
            },
            removeMouseClickScrolling: function() {
                this.$scrollBar.unbind("click", this.scrollBarClick)
            },
            initWindowResize: function() {
                if (this.scrollable.options.updateOnWindowResize) {
                    var i = this;
                    this.windowResize = function() {
                        i.resize()
                    }, e(window).resize(this.windowResize)
                }
            },
            removeWindowResize: function() {
                e(window).unbind("resize", this.windowResize)
            },
            isKeyScrolling: function(e) {
                return null != this.keyScrollDelta(e)
            },
            keyScrollDelta: function(e) {
                for (var i in this.sizing.scrollingKeys)
                    if (i == e) return this.sizing.scrollingKeys[e](this.viewPortSize);
                return null
            },
            startMouseMoveScrolling: function(i) {
                this.mouseMoveScrolling = !0, e("html").addClass("not-selectable"), this.setUnselectable(e("html"), "on"), this.setScrollEvent(i)
            },
            stopMouseMoveScrolling: function(i) {
                this.mouseMoveScrolling = !1, e("html").removeClass("not-selectable"), this.setUnselectable(e("html"), null)
            },
            setUnselectable: function(e, i) {
                e.attr("unselectable") != i && (e.attr("unselectable", i), e.find(":not(input)").attr("unselectable", i))
            },
            mouseMoveScroll: function(e) {
                if (this.mouseMoveScrolling) {
                    var i = this.sizing.mouseDelta(this.scrollEvent, e);
                    this.scrollThumbBy(i), this.setScrollEvent(e)
                }
            },
            startTouchScrolling: function(e) {
                e.touches && 1 == e.touches.length && (this.setScrollEvent(e.touches[0]), this.touchScrolling = !0, e.stopPropagation())
            },
            touchScroll: function(e) {
                if (this.touchScrolling && e.touches && 1 == e.touches.length) {
                    var i = -this.sizing.mouseDelta(this.scrollEvent, e.touches[0]) * this.scrollable.options.swipeSpeed,
                        t = this.scrollOverviewBy(i);
                    t && (e.stopPropagation(), e.preventDefault(), this.setScrollEvent(e.touches[0]))
                }
            },
            stopTouchScrolling: function(e) {
                this.touchScrolling = !1, e.stopPropagation()
            },
            mouseWheelScroll: function(e, i) {
                var t = -this.sizing.wheelDelta(e, i) * this.scrollable.options.wheelSpeed;
                return 0 != t ? this.scrollOverviewBy(t) : void 0
            },
            mouseClickScroll: function(e) {
                var i = this.viewPortSize - 20;
                e["page" + this.sizing.scrollAxis()] < this.$thumb.offset()[this.sizing.offsetComponent()] && (i = -i), this.scrollOverviewBy(i)
            },
            keyScroll: function(e) {
                var i = e.which;
                this.enabled && this.isKeyScrolling(i) && this.scrollOverviewBy(this.keyScrollDelta(i)) && e.preventDefault()
            },
            scrollThumbBy: function(e) {
                var i = this.thumbPosition();
                i += e, i = this.positionOrMax(i, this.maxThumbPosition);
                var t = this.scrollPercent;
                this.scrollPercent = i / this.maxThumbPosition;
                var o = i * this.maxOverviewPosition / this.maxThumbPosition;
                return this.setScrollPosition(o, i), t != this.scrollPercent ? (this.triggerCustomScroll(t), !0) : !1
            },
            thumbPosition: function() {
                return this.$thumb.position()[this.sizing.offsetComponent()]
            },
            scrollOverviewBy: function(e) {
                var i = this.overviewPosition() + e;
                return this.scrollOverviewTo(i, !1)
            },
            overviewPosition: function() {
                return -this.scrollable.$overview.position()[this.sizing.offsetComponent()]
            },
            scrollOverviewTo: function(e, i) {
                e = this.positionOrMax(e, this.maxOverviewPosition);
                var t = this.scrollPercent;
                this.scrollPercent = e / this.maxOverviewPosition;
                var o = this.scrollPercent * this.maxThumbPosition;
                return i ? this.setScrollPositionWithAnimation(e, o) : this.setScrollPosition(e, o), t != this.scrollPercent ? (this.triggerCustomScroll(t), !0) : !1
            },
            positionOrMax: function(e, i) {
                return 0 > e ? 0 : e > i ? i : e
            },
            triggerCustomScroll: function(e) {
                this.scrollable.$element.trigger("customScroll", {
                    scrollAxis: this.sizing.scrollAxis(),
                    direction: this.sizing.scrollDirection(e, this.scrollPercent),
                    scrollPercent: 100 * this.scrollPercent
                })
            },
            rescroll: function(e) {
                if (e) {
                    var i = this.positionOrMax(this.overviewPosition(), this.maxOverviewPosition);
                    this.scrollPercent = i / this.maxOverviewPosition;
                    var t = this.scrollPercent * this.maxThumbPosition;
                    this.setScrollPosition(i, t)
                } else {
                    var t = this.scrollPercent * this.maxThumbPosition,
                        i = this.scrollPercent * this.maxOverviewPosition;
                    this.setScrollPosition(i, t)
                }
            },
            setScrollPosition: function(e, i) {
                this.$thumb.css(this.sizing.offsetComponent(), i + "px"), this.scrollable.$overview.css(this.sizing.offsetComponent(), -e + "px")
            },
            setScrollPositionWithAnimation: function(e, i) {
                var t = {},
                    o = {};
                t[this.sizing.offsetComponent()] = i + "px", this.$thumb.animate(t, this.scrollable.options.animationSpeed), o[this.sizing.offsetComponent()] = -e + "px", this.scrollable.$overview.animate(o, this.scrollable.options.animationSpeed)
            },
            calculateMaxThumbPosition: function() {
                return this.sizing.size(this.$scrollBar) - this.thumbSize
            },
            calculateMaxOverviewPosition: function() {
                return this.sizing.size(this.scrollable.$overview) - this.sizing.size(this.scrollable.$viewPort)
            },
            setScrollEvent: function(e) {
                var i = "page" + this.sizing.scrollAxis();
                this.scrollEvent && this.scrollEvent[i] == e[i] || (this.scrollEvent = {
                    pageX: e.pageX,
                    pageY: e.pageY
                })
            },
            scrollToElement: function(i) {
                var t = e(i);
                if (this.sizing.isInside(t, this.scrollable.$overview) && !this.sizing.isInside(t, this.scrollable.$viewPort)) {
                    var o = t.offset(),
                        s = this.scrollable.$overview.offset();
                    this.scrollable.$viewPort.offset();
                    this.scrollOverviewTo(o[this.sizing.offsetComponent()] - s[this.sizing.offsetComponent()], !0)
                }
            },
            remove: function() {
                this.removeMouseMoveScrolling(), this.removeMouseWheelScrolling(), this.removeTouchScrolling(), this.removeMouseClickScrolling(), this.removeWindowResize()
            }
        };
        var l = function() {};
        l.prototype = {
            size: function(e, i) {
                return i ? e.width(i) : e.width()
            },
            minSize: function(e) {
                return parseInt(e.css("min-width")) || 0
            },
            fixedThumbSize: function(e) {
                return e.fixedThumbWidth
            },
            scrollBar: function(e) {
                return e.find(".scroll-bar.horizontal")
            },
            mouseDelta: function(e, i) {
                return i.pageX - e.pageX
            },
            offsetComponent: function() {
                return "left"
            },
            wheelDelta: function(e, i) {
                return e
            },
            scrollAxis: function() {
                return "X"
            },
            scrollDirection: function(e, i) {
                return i > e ? "right" : "left"
            },
            scrollingKeys: {
                37: function(e) {
                    return -10
                },
                39: function(e) {
                    return 10
                }
            },
            isInside: function(i, t) {
                var o = e(i),
                    s = e(t),
                    n = o.offset(),
                    l = s.offset();
                return n.left >= l.left && n.left + o.width() <= l.left + s.width()
            }
        };
        var r = function() {};
        return r.prototype = {
            size: function(e, i) {
                return i ? e.height(i) : e.height()
            },
            minSize: function(e) {
                return parseInt(e.css("min-height")) || 0
            },
            fixedThumbSize: function(e) {
                return e.fixedThumbHeight
            },
            scrollBar: function(e) {
                return e.find(".scroll-bar.vertical")
            },
            mouseDelta: function(e, i) {
                return i.pageY - e.pageY
            },
            offsetComponent: function() {
                return "top"
            },
            wheelDelta: function(e, i) {
                return i
            },
            scrollAxis: function() {
                return "Y"
            },
            scrollDirection: function(e, i) {
                return i > e ? "down" : "up"
            },
            scrollingKeys: {
                38: function(e) {
                    return -10
                },
                40: function(e) {
                    return 10
                },
                33: function(e) {
                    return -(e - 20)
                },
                34: function(e) {
                    return e - 20
                }
            },
            isInside: function(i, t) {
                var o = e(i),
                    s = e(t),
                    n = o.offset(),
                    l = s.offset();
                return n.top >= l.top && n.top + o.height() <= l.top + s.height()
            }
        }, this.each(function() {
            if (void 0 == i && (i = o), "string" == typeof i) {
                var n = e(this).data("scrollable");
                n && n[i](t)
            } else {
                if ("object" != typeof i) throw "Invalid type of options";
                i = e.extend(o, i), new s(e(this), i)
            }
        })
    }
}(jQuery),
function(e) {
    function o(i) {
        var t = i || window.event,
            o = [].slice.call(arguments, 1),
            s = 0,
            l = 0,
            r = 0;
        return i = e.event.fix(t), i.type = "mousewheel", t.wheelDelta && (s = t.wheelDelta / 120), t.detail && (s = -t.detail / 3), r = s, void 0 !== t.axis && t.axis === t.HORIZONTAL_AXIS && (r = 0, l = s), void 0 !== t.wheelDeltaY && (r = t.wheelDeltaY / 120), void 0 !== t.wheelDeltaX && (l = t.wheelDeltaX / 120), o.unshift(i, s, l, r), (e.event.dispatch || e.event.handle).apply(this, o)
    }
    var i = ["DOMMouseScroll", "mousewheel"];
    if (e.event.fixHooks)
        for (var t = i.length; t;) e.event.fixHooks[i[--t]] = e.event.mouseHooks;
    e.event.special.mousewheel = {
        setup: function() {
            if (this.addEventListener)
                for (var e = i.length; e;) this.addEventListener(i[--e], o, !1);
            else this.onmousewheel = o
        },
        teardown: function() {
            if (this.removeEventListener)
                for (var e = i.length; e;) this.removeEventListener(i[--e], o, !1);
            else this.onmousewheel = null
        }
    }, e.fn.extend({
        mousewheel: function(e) {
            return e ? this.bind("mousewheel", e) : this.trigger("mousewheel")
        },
        unmousewheel: function(e) {
            return this.unbind("mousewheel", e)
        }
    })
}(jQuery), jQuery.easing.jswing = jQuery.easing.swing, jQuery.extend(jQuery.easing, {
        def: "easeOutQuad",
        swing: function(x, t, b, c, d) {
            return jQuery.easing[jQuery.easing.def](x, t, b, c, d)
        },
        easeInQuad: function(x, t, b, c, d) {
            return c * (t /= d) * t + b
        },
        easeOutQuad: function(x, t, b, c, d) {
            return -c * (t /= d) * (t - 2) + b
        },
        easeInOutQuad: function(x, t, b, c, d) {
            return (t /= d / 2) < 1 ? c / 2 * t * t + b : -c / 2 * (--t * (t - 2) - 1) + b
        },
        easeInCubic: function(x, t, b, c, d) {
            return c * (t /= d) * t * t + b
        },
        easeOutCubic: function(x, t, b, c, d) {
            return c * ((t = t / d - 1) * t * t + 1) + b
        },
        easeInOutCubic: function(x, t, b, c, d) {
            return (t /= d / 2) < 1 ? c / 2 * t * t * t + b : c / 2 * ((t -= 2) * t * t + 2) + b
        },
        easeInQuart: function(x, t, b, c, d) {
            return c * (t /= d) * t * t * t + b
        },
        easeOutQuart: function(x, t, b, c, d) {
            return -c * ((t = t / d - 1) * t * t * t - 1) + b
        },
        easeInOutQuart: function(x, t, b, c, d) {
            return (t /= d / 2) < 1 ? c / 2 * t * t * t * t + b : -c / 2 * ((t -= 2) * t * t * t - 2) + b
        },
        easeInQuint: function(x, t, b, c, d) {
            return c * (t /= d) * t * t * t * t + b
        },
        easeOutQuint: function(x, t, b, c, d) {
            return c * ((t = t / d - 1) * t * t * t * t + 1) + b
        },
        easeInOutQuint: function(x, t, b, c, d) {
            return (t /= d / 2) < 1 ? c / 2 * t * t * t * t * t + b : c / 2 * ((t -= 2) * t * t * t * t + 2) + b
        },
        easeInSine: function(x, t, b, c, d) {
            return -c * Math.cos(t / d * (Math.PI / 2)) + c + b
        },
        easeOutSine: function(x, t, b, c, d) {
            return c * Math.sin(t / d * (Math.PI / 2)) + b
        },
        easeInOutSine: function(x, t, b, c, d) {
            return -c / 2 * (Math.cos(Math.PI * t / d) - 1) + b
        },
        easeInExpo: function(x, t, b, c, d) {
            return 0 == t ? b : c * Math.pow(2, 10 * (t / d - 1)) + b
        },
        easeOutExpo: function(x, t, b, c, d) {
            return t == d ? b + c : c * (-Math.pow(2, -10 * t / d) + 1) + b
        },
        easeInOutExpo: function(x, t, b, c, d) {
            return 0 == t ? b : t == d ? b + c : (t /= d / 2) < 1 ? c / 2 * Math.pow(2, 10 * (t - 1)) + b : c / 2 * (-Math.pow(2, -10 * --t) + 2) + b
        },
        easeInCirc: function(x, t, b, c, d) {
            return -c * (Math.sqrt(1 - (t /= d) * t) - 1) + b
        },
        easeOutCirc: function(x, t, b, c, d) {
            return c * Math.sqrt(1 - (t = t / d - 1) * t) + b
        },
        easeInOutCirc: function(x, t, b, c, d) {
            return (t /= d / 2) < 1 ? -c / 2 * (Math.sqrt(1 - t * t) - 1) + b : c / 2 * (Math.sqrt(1 - (t -= 2) * t) + 1) + b
        },
        easeInElastic: function(x, t, b, c, d) {
            var s = 1.70158,
                p = 0,
                a = c;
            if (0 == t) return b;
            if (1 == (t /= d)) return b + c;
            if (p || (p = .3 * d), a < Math.abs(c)) {
                a = c;
                var s = p / 4
            } else var s = p / (2 * Math.PI) * Math.asin(c / a);
            return -(a * Math.pow(2, 10 * (t -= 1)) * Math.sin((t * d - s) * (2 * Math.PI) / p)) + b
        },
        easeOutElastic: function(x, t, b, c, d) {
            var s = 1.70158,
                p = 0,
                a = c;
            if (0 == t) return b;
            if (1 == (t /= d)) return b + c;
            if (p || (p = .3 * d), a < Math.abs(c)) {
                a = c;
                var s = p / 4
            } else var s = p / (2 * Math.PI) * Math.asin(c / a);
            return a * Math.pow(2, -10 * t) * Math.sin((t * d - s) * (2 * Math.PI) / p) + c + b
        },
        easeInOutElastic: function(x, t, b, c, d) {
            var s = 1.70158,
                p = 0,
                a = c;
            if (0 == t) return b;
            if (2 == (t /= d / 2)) return b + c;
            if (p || (p = d * (.3 * 1.5)), a < Math.abs(c)) {
                a = c;
                var s = p / 4
            } else var s = p / (2 * Math.PI) * Math.asin(c / a);
            return 1 > t ? -.5 * (a * Math.pow(2, 10 * (t -= 1)) * Math.sin((t * d - s) * (2 * Math.PI) / p)) + b : a * Math.pow(2, -10 * (t -= 1)) * Math.sin((t * d - s) * (2 * Math.PI) / p) * .5 + c + b
        },
        easeInBack: function(x, t, b, c, d, s) {
            return void 0 == s && (s = 1.70158), c * (t /= d) * t * ((s + 1) * t - s) + b
        },
        easeOutBack: function(x, t, b, c, d, s) {
            return void 0 == s && (s = 1.70158), c * ((t = t / d - 1) * t * ((s + 1) * t + s) + 1) + b
        },
        easeInOutBack: function(x, t, b, c, d, s) {
            return void 0 == s && (s = 1.70158), (t /= d / 2) < 1 ? c / 2 * (t * t * (((s *= 1.525) + 1) * t - s)) + b : c / 2 * ((t -= 2) * t * (((s *= 1.525) + 1) * t + s) + 2) + b
        },
        easeInBounce: function(x, t, b, c, d) {
            return c - jQuery.easing.easeOutBounce(x, d - t, 0, c, d) + b
        },
        easeOutBounce: function(x, t, b, c, d) {
            return (t /= d) < 1 / 2.75 ? c * (7.5625 * t * t) + b : 2 / 2.75 > t ? c * (7.5625 * (t -= 1.5 / 2.75) * t + .75) + b : 2.5 / 2.75 > t ? c * (7.5625 * (t -= 2.25 / 2.75) * t + .9375) + b : c * (7.5625 * (t -= 2.625 / 2.75) * t + .984375) + b
        },
        easeInOutBounce: function(x, t, b, c, d) {
            return d / 2 > t ? .5 * jQuery.easing.easeInBounce(x, 2 * t, 0, c, d) + b : .5 * jQuery.easing.easeOutBounce(x, 2 * t - d, 0, c, d) + .5 * c + b
        }
    }),
    function($) {
        var resizeTimeoutInstance, elems = $([]),
            resizeInProgress = !1,
            resizeTimeout = 300,
            resizeEvents = {
                setup: function() {
                    elems = elems.add(this), 1 === elems.length && $(window).bind("resize.resizeEvent", onResize)
                },
                teardown: function() {
                    elems = elems.not(this), 0 === elems.length && $(window).unbind("resize.resizeEvent", onResize)
                }
            };
        $.event.special.resizeStart = resizeEvents, $.event.special.resizeEnd = resizeEvents;
        var onResize = function(event) {
                var elem = $(event.target);
                clearTimeout(resizeTimeoutInstance), resizeInProgress || resizeStart(elem), resizeTimeoutInstance = setTimeout(function() {
                    resizeEnd(elem)
                }, resizeTimeout)
            },
            resizeStart = function(elem) {
                resizeInProgress = !0, elem.trigger("resizeStart")
            },
            resizeEnd = function(elem) {
                resizeInProgress = !1, elem.trigger("resizeEnd")
            }
    }(jQuery),
    function(global, factory) {
        "function" == typeof define && define.amd ? define(["jquery", "./pointertouch"], function(jQuery) {
            return factory(global, jQuery)
        }) : "object" == typeof exports ? factory(global, require("jquery"), require("./pointertouch")) : factory(global, global.jQuery)
    }("undefined" != typeof window ? window : this, function(window, $) {
        "use strict";

        function matrixEquals(first, second) {
            for (var i = first.length; --i;)
                if (+first[i] !== +second[i]) return !1;
            return !0
        }

        function createResetOptions(opts) {
            var options = {
                range: !0,
                animate: !0
            };
            return "boolean" == typeof opts ? options.animate = opts : $.extend(options, opts), options
        }

        function Matrix(a, b, c, d, e, f, g, h, i) {
            "array" === $.type(a) ? this.elements = [+a[0], +a[2], +a[4], +a[1], +a[3], +a[5], 0, 0, 1] : this.elements = [a, b, c, d, e, f, g || 0, h || 0, i || 1]
        }

        function Vector(x, y, z) {
            this.elements = [x, y, z]
        }

        function Panzoom(elem, options) {
            if (!(this instanceof Panzoom)) return new Panzoom(elem, options);
            1 !== elem.nodeType && $.error("Panzoom called on non-Element node"), $.contains(document, elem) || $.error("Panzoom element must be attached to the document");
            var d = $.data(elem, datakey);
            if (d) return d;
            this.options = options = $.extend({}, Panzoom.defaults, options), this.elem = elem;
            var $elem = this.$elem = $(elem);
            this.$set = options.$set && options.$set.length ? options.$set : $elem, this.$doc = $(elem.ownerDocument || document), this.$parent = $elem.parent(), this.isSVG = rsvg.test(elem.namespaceURI) && "svg" !== elem.nodeName.toLowerCase(), this.panning = !1, this._buildTransform(), this._transform = !this.isSVG && $.cssProps.transform.replace(rupper, "-$1").toLowerCase(), this._buildTransition(), this.resetDimensions();
            var $empty = $(),
                self = this;
            $.each(["$zoomIn", "$zoomOut", "$zoomRange", "$reset"], function(i, name) {
                self[name] = options[name] || $empty
            }), this.enable(), $.data(elem, datakey, this)
        }
        var document = window.document,
            datakey = "__pz__",
            slice = Array.prototype.slice,
            pointerEvents = !!window.PointerEvent,
            supportsInputEvent = function() {
                var input = document.createElement("input");
                return input.setAttribute("oninput", "return"), "function" == typeof input.oninput
            }(),
            rupper = /([A-Z])/g,
            rsvg = /^http:[\w\.\/]+svg$/,
            rinline = /^inline/,
            floating = "(\\-?[\\d\\.e]+)",
            commaSpace = "\\,?\\s*",
            rmatrix = new RegExp("^matrix\\(" + floating + commaSpace + floating + commaSpace + floating + commaSpace + floating + commaSpace + floating + commaSpace + floating + "\\)$");
        return Matrix.prototype = {
            x: function(matrix) {
                var isVector = matrix instanceof Vector,
                    a = this.elements,
                    b = matrix.elements;
                return isVector && 3 === b.length ? new Vector(a[0] * b[0] + a[1] * b[1] + a[2] * b[2], a[3] * b[0] + a[4] * b[1] + a[5] * b[2], a[6] * b[0] + a[7] * b[1] + a[8] * b[2]) : b.length === a.length ? new Matrix(a[0] * b[0] + a[1] * b[3] + a[2] * b[6], a[0] * b[1] + a[1] * b[4] + a[2] * b[7], a[0] * b[2] + a[1] * b[5] + a[2] * b[8], a[3] * b[0] + a[4] * b[3] + a[5] * b[6], a[3] * b[1] + a[4] * b[4] + a[5] * b[7], a[3] * b[2] + a[4] * b[5] + a[5] * b[8], a[6] * b[0] + a[7] * b[3] + a[8] * b[6], a[6] * b[1] + a[7] * b[4] + a[8] * b[7], a[6] * b[2] + a[7] * b[5] + a[8] * b[8]) : !1
            },
            inverse: function() {
                var d = 1 / this.determinant(),
                    a = this.elements;
                return new Matrix(d * (a[8] * a[4] - a[7] * a[5]), d * -(a[8] * a[1] - a[7] * a[2]), d * (a[5] * a[1] - a[4] * a[2]), d * -(a[8] * a[3] - a[6] * a[5]), d * (a[8] * a[0] - a[6] * a[2]), d * -(a[5] * a[0] - a[3] * a[2]), d * (a[7] * a[3] - a[6] * a[4]), d * -(a[7] * a[0] - a[6] * a[1]), d * (a[4] * a[0] - a[3] * a[1]))
            },
            determinant: function() {
                var a = this.elements;
                return a[0] * (a[8] * a[4] - a[7] * a[5]) - a[3] * (a[8] * a[1] - a[7] * a[2]) + a[6] * (a[5] * a[1] - a[4] * a[2])
            }
        }, Vector.prototype.e = Matrix.prototype.e = function(i) {
            return this.elements[i]
        }, Panzoom.rmatrix = rmatrix, Panzoom.events = $.pointertouch, Panzoom.defaults = {
            eventNamespace: ".panzoom",
            transition: !0,
            cursor: "move",
            disablePan: !1,
            disableZoom: !1,
            increment: .3,
            minScale: .4,
            maxScale: 5,
            rangeStep: .05,
            duration: 200,
            easing: "ease-in-out",
            contain: !1
        }, Panzoom.prototype = {
            constructor: Panzoom,
            instance: function() {
                return this
            },
            enable: function() {
                this._initStyle(), this._bind(), this.disabled = !1
            },
            disable: function() {
                this.disabled = !0, this._resetStyle(), this._unbind()
            },
            isDisabled: function() {
                return this.disabled
            },
            destroy: function() {
                this.disable(), $.removeData(this.elem, datakey)
            },
            resetDimensions: function() {
                var $parent = this.$parent;
                this.container = {
                    width: $parent.innerWidth(),
                    height: $parent.innerHeight()
                };
                var dims, po = $parent.offset(),
                    elem = this.elem,
                    $elem = this.$elem;
                this.isSVG ? (dims = elem.getBoundingClientRect(), dims = {
                    left: dims.left - po.left,
                    top: dims.top - po.top,
                    width: dims.width,
                    height: dims.height,
                    margin: {
                        left: 0,
                        top: 0
                    }
                }) : dims = {
                    left: $.css(elem, "left", !0) || 0,
                    top: $.css(elem, "top", !0) || 0,
                    width: $elem.innerWidth(),
                    height: $elem.innerHeight(),
                    margin: {
                        top: $.css(elem, "marginTop", !0) || 0,
                        left: $.css(elem, "marginLeft", !0) || 0
                    }
                }, dims.widthBorder = $.css(elem, "borderLeftWidth", !0) + $.css(elem, "borderRightWidth", !0) || 0, dims.heightBorder = $.css(elem, "borderTopWidth", !0) + $.css(elem, "borderBottomWidth", !0) || 0, this.dimensions = dims
            },
            reset: function(options) {
                options = createResetOptions(options);
                var matrix = this.setMatrix(this._origTransform, options);
                options.silent || this._trigger("reset", matrix)
            },
            resetZoom: function(options) {
                options = createResetOptions(options);
                var origMatrix = this.getMatrix(this._origTransform);
                options.dValue = origMatrix[3], this.zoom(origMatrix[0], options)
            },
            resetPan: function(options) {
                var origMatrix = this.getMatrix(this._origTransform);
                this.pan(origMatrix[4], origMatrix[5], createResetOptions(options))
            },
            setTransform: function(transform) {
                for (var method = this.isSVG ? "attr" : "style", $set = this.$set, i = $set.length; i--;) $[method]($set[i], "transform", transform)
            },
            getTransform: function(transform) {
                var $set = this.$set,
                    transformElem = $set[0];
                return transform ? this.setTransform(transform) : transform = $[this.isSVG ? "attr" : "style"](transformElem, "transform"), "none" === transform || rmatrix.test(transform) || this.setTransform(transform = $.css(transformElem, "transform")), transform || "none"
            },
            getMatrix: function(transform) {
                var matrix = rmatrix.exec(transform || this.getTransform());
                return matrix && matrix.shift(), matrix || [1, 0, 0, 1, 0, 0]
            },
            setMatrix: function(matrix, options) {
                if (!this.disabled) {
                    options || (options = {}), "string" == typeof matrix && (matrix = this.getMatrix(matrix));
                    var dims, container, marginW, marginH, diffW, diffH, left, top, width, height, scale = +matrix[0],
                        $parent = this.$parent,
                        contain = "undefined" != typeof options.contain ? options.contain : this.options.contain;
                    return contain && (dims = this._checkDims(), container = this.container, width = dims.width + dims.widthBorder, height = dims.height + dims.heightBorder, marginW = (width * Math.abs(scale) - container.width) / 2, marginH = (height * Math.abs(scale) - container.height) / 2, left = dims.left + dims.margin.left, top = dims.top + dims.margin.top, "invert" === contain ? (diffW = width > container.width ? width - container.width : 0, diffH = height > container.height ? height - container.height : 0, marginW += (container.width - width) / 2, marginH += (container.height - height) / 2, matrix[4] = Math.max(Math.min(matrix[4], marginW - left), -marginW - left - diffW), matrix[5] = Math.max(Math.min(matrix[5], marginH - top), -marginH - top - diffH + dims.heightBorder)) : (marginH += dims.heightBorder / 2, diffW = container.width > width ? container.width - width : 0, diffH = container.height > height ? container.height - height : 0, "center" === $parent.css("textAlign") && rinline.test($.css(this.elem, "display")) ? diffW = 0 : marginW = marginH = 0, matrix[4] = Math.min(Math.max(matrix[4], marginW - left), -marginW - left + diffW), matrix[5] = Math.min(Math.max(matrix[5], marginH - top), -marginH - top + diffH))), "skip" !== options.animate && this.transition(!options.animate), options.range && this.$zoomRange.val(scale), this.setTransform("matrix(" + matrix.join(",") + ")"), options.silent || this._trigger("change", matrix), matrix
                }
            },
            isPanning: function() {
                return this.panning
            },
            transition: function(off) {
                if (this._transition)
                    for (var transition = off || !this.options.transition ? "none" : this._transition, $set = this.$set, i = $set.length; i--;) $.style($set[i], "transition") !== transition && $.style($set[i], "transition", transition)
            },
            pan: function(x, y, options) {
                if (!this.options.disablePan) {
                    options || (options = {});
                    var matrix = options.matrix;
                    matrix || (matrix = this.getMatrix()), options.relative && (x += +matrix[4], y += +matrix[5]), matrix[4] = x, matrix[5] = y, this.setMatrix(matrix, options), options.silent || this._trigger("pan", matrix[4], matrix[5])
                }
            },
            zoom: function(scale, opts) {
                "object" == typeof scale ? (opts = scale, scale = null) : opts || (opts = {});
                var options = $.extend({}, this.options, opts);
                if (!options.disableZoom) {
                    var animate = !1,
                        matrix = options.matrix || this.getMatrix();
                    "number" != typeof scale && (scale = +matrix[0] + options.increment * (scale ? -1 : 1), animate = !0), scale > options.maxScale ? scale = options.maxScale : scale < options.minScale && (scale = options.minScale);
                    var focal = options.focal;
                    if (focal && !options.disablePan) {
                        var dims = this._checkDims(),
                            clientX = focal.clientX,
                            clientY = focal.clientY;
                        this.isSVG || (clientX -= (dims.width + dims.widthBorder) / 2, clientY -= (dims.height + dims.heightBorder) / 2);
                        var clientV = new Vector(clientX, clientY, 1),
                            surfaceM = new Matrix(matrix),
                            o = this.parentOffset || this.$parent.offset(),
                            offsetM = new Matrix(1, 0, o.left - this.$doc.scrollLeft(), 0, 1, o.top - this.$doc.scrollTop()),
                            surfaceV = surfaceM.inverse().x(offsetM.inverse().x(clientV)),
                            scaleBy = scale / matrix[0];
                        surfaceM = surfaceM.x(new Matrix([scaleBy, 0, 0, scaleBy, 0, 0])), clientV = offsetM.x(surfaceM.x(surfaceV)), matrix[4] = +matrix[4] + (clientX - clientV.e(0)), matrix[5] = +matrix[5] + (clientY - clientV.e(1))
                    }
                    matrix[0] = scale, matrix[3] = "number" == typeof options.dValue ? options.dValue : scale, this.setMatrix(matrix, {
                        animate: "boolean" == typeof options.animate ? options.animate : animate,
                        range: !options.noSetRange
                    }), options.silent || this._trigger("zoom", matrix[0], options)
                }
            },
            option: function(key, value) {
                var options;
                if (!key) return $.extend({}, this.options);
                if ("string" == typeof key) {
                    if (1 === arguments.length) return void 0 !== this.options[key] ? this.options[key] : null;
                    options = {}, options[key] = value
                } else options = key;
                this._setOptions(options)
            },
            _setOptions: function(options) {
                $.each(options, $.proxy(function(key, value) {
                    switch (key) {
                        case "disablePan":
                            this._resetStyle();
                        case "$zoomIn":
                        case "$zoomOut":
                        case "$zoomRange":
                        case "$reset":
                        case "disableZoom":
                        case "onStart":
                        case "onChange":
                        case "onZoom":
                        case "onPan":
                        case "onEnd":
                        case "onReset":
                        case "eventNamespace":
                            this._unbind()
                    }
                    switch (this.options[key] = value, key) {
                        case "disablePan":
                            this._initStyle();
                        case "$zoomIn":
                        case "$zoomOut":
                        case "$zoomRange":
                        case "$reset":
                            this[key] = value;
                        case "disableZoom":
                        case "onStart":
                        case "onChange":
                        case "onZoom":
                        case "onPan":
                        case "onEnd":
                        case "onReset":
                        case "eventNamespace":
                            this._bind();
                            break;
                        case "cursor":
                            $.style(this.elem, "cursor", value);
                            break;
                        case "minScale":
                            this.$zoomRange.attr("min", value);
                            break;
                        case "maxScale":
                            this.$zoomRange.attr("max", value);
                            break;
                        case "rangeStep":
                            this.$zoomRange.attr("step", value);
                            break;
                        case "startTransform":
                            this._buildTransform();
                            break;
                        case "duration":
                        case "easing":
                            this._buildTransition();
                        case "transition":
                            this.transition();
                            break;
                        case "$set":
                            value instanceof $ && value.length && (this.$set = value, this._initStyle(), this._buildTransform())
                    }
                }, this))
            },
            _initStyle: function() {
                var styles = {
                    "backface-visibility": "hidden",
                    "transform-origin": this.isSVG ? "0 0" : "50% 50%"
                };
                this.options.disablePan || (styles.cursor = this.options.cursor), this.$set.css(styles);
                var $parent = this.$parent;
                $parent.length && !$.nodeName($parent[0], "body") && (styles = {
                    overflow: "hidden"
                }, "static" === $parent.css("position") && (styles.position = "relative"), $parent.css(styles))
            },
            _resetStyle: function() {
                this.$elem.css({
                    cursor: "",
                    transition: ""
                }), this.$parent.css({
                    overflow: "",
                    position: ""
                })
            },
            _bind: function() {
                var self = this,
                    options = this.options,
                    ns = options.eventNamespace,
                    str_start = pointerEvents ? "pointerdown" + ns : "touchstart" + ns + " mousedown" + ns,
                    str_click = pointerEvents ? "pointerup" + ns : "touchend" + ns + " click" + ns,
                    events = {},
                    $reset = this.$reset,
                    $zoomRange = this.$zoomRange;
                if ($.each(["Start", "Change", "Zoom", "Pan", "End", "Reset"], function() {
                        var m = options["on" + this];
                        $.isFunction(m) && (events["panzoom" + this.toLowerCase() + ns] = m)
                    }), options.disablePan && options.disableZoom || (events[str_start] = function(e) {
                        var touches;
                        ("touchstart" === e.type ? !(touches = e.touches) || (1 !== touches.length || options.disablePan) && 2 !== touches.length : options.disablePan || 1 !== e.which) || (e.preventDefault(), e.stopPropagation(), self._startMove(e, touches))
                    }), this.$elem.on(events), $reset.length && $reset.on(str_click, function(e) {
                        e.preventDefault(), self.reset()
                    }), $zoomRange.length && $zoomRange.attr({
                        step: options.rangeStep === Panzoom.defaults.rangeStep && $zoomRange.attr("step") || options.rangeStep,
                        min: options.minScale,
                        max: options.maxScale
                    }).prop({
                        value: this.getMatrix()[0]
                    }), !options.disableZoom) {
                    var $zoomIn = this.$zoomIn,
                        $zoomOut = this.$zoomOut;
                    $zoomIn.length && $zoomOut.length && ($zoomIn.on(str_click, function(e) {
                        e.preventDefault(), self.zoom()
                    }), $zoomOut.on(str_click, function(e) {
                        e.preventDefault(), self.zoom(!0)
                    })), $zoomRange.length && (events = {}, events[(pointerEvents ? "pointerdown" : "mousedown") + ns] = function() {
                        self.transition(!0)
                    }, events[(supportsInputEvent ? "input" : "change") + ns] = function() {
                        self.zoom(+this.value, {
                            noSetRange: !0
                        })
                    }, $zoomRange.on(events))
                }
            },
            _unbind: function() {
                this.$elem.add(this.$zoomIn).add(this.$zoomOut).add(this.$reset).off(this.options.eventNamespace)
            },
            _buildTransform: function() {
                return this._origTransform = this.getTransform(this.options.startTransform)
            },
            _buildTransition: function() {
                if (this._transform) {
                    var options = this.options;
                    this._transition = this._transform + " " + options.duration + "ms " + options.easing
                }
            },
            _checkDims: function() {
                var dims = this.dimensions;
                return dims.width && dims.height || this.resetDimensions(), this.dimensions
            },
            _getDistance: function(touches) {
                var touch1 = touches[0],
                    touch2 = touches[1];
                return Math.sqrt(Math.pow(Math.abs(touch2.clientX - touch1.clientX), 2) + Math.pow(Math.abs(touch2.clientY - touch1.clientY), 2))
            },
            _getMiddle: function(touches) {
                var touch1 = touches[0],
                    touch2 = touches[1];
                return {
                    clientX: (touch2.clientX - touch1.clientX) / 2 + touch1.clientX,
                    clientY: (touch2.clientY - touch1.clientY) / 2 + touch1.clientY
                }
            },
            _trigger: function(event) {
                "string" == typeof event && (event = "panzoom" + event), this.$elem.triggerHandler(event, [this].concat(slice.call(arguments, 1)))
            },
            _startMove: function(event, touches) {
                var move, moveEvent, endEvent, startDistance, startScale, startMiddle, startPageX, startPageY, self = this,
                    options = this.options,
                    ns = options.eventNamespace,
                    matrix = this.getMatrix(),
                    original = matrix.slice(0),
                    origPageX = +original[4],
                    origPageY = +original[5],
                    panOptions = {
                        matrix: matrix,
                        animate: "skip"
                    };
                pointerEvents ? (moveEvent = "pointermove", endEvent = "pointerup") : "touchstart" === event.type ? (moveEvent = "touchmove", endEvent = "touchend") : (moveEvent = "mousemove", endEvent = "mouseup"), moveEvent += ns, endEvent += ns, this.transition(!0), this.panning = !0, this._trigger("start", event, touches), touches && 2 === touches.length ? (startDistance = this._getDistance(touches), startScale = +matrix[0], startMiddle = this._getMiddle(touches), move = function(e) {
                    e.preventDefault();
                    var middle = self._getMiddle(touches = e.touches),
                        diff = self._getDistance(touches) - startDistance;
                    self.zoom(diff * (options.increment / 100) + startScale, {
                        focal: middle,
                        matrix: matrix,
                        animate: !1
                    }), self.pan(+matrix[4] + middle.clientX - startMiddle.clientX, +matrix[5] + middle.clientY - startMiddle.clientY, panOptions), startMiddle = middle
                }) : (startPageX = event.pageX, startPageY = event.pageY, move = function(e) {
                    e.preventDefault(), self.pan(origPageX + e.pageX - startPageX, origPageY + e.pageY - startPageY, panOptions)
                }), $(document).off(ns).on(moveEvent, move).on(endEvent, function(e) {
                    e.preventDefault(), $(this).off(ns), self.panning = !1, e.type = "panzoomend", self._trigger(e, matrix, !matrixEquals(matrix, original))
                })
            }
        }, $.Panzoom = Panzoom, $.fn.panzoom = function(options) {
            var instance, args, m, ret;
            return "string" == typeof options ? (ret = [], args = slice.call(arguments, 1), this.each(function() {
                instance = $.data(this, datakey), instance ? "_" !== options.charAt(0) && "function" == typeof(m = instance[options]) && void 0 !== (m = m.apply(instance, args)) && ret.push(m) : ret.push(void 0)
            }), ret.length ? 1 === ret.length ? ret[0] : ret : this) : this.each(function() {
                new Panzoom(this, options)
            })
        }, Panzoom
    }),
    function(window, document, undefined) {
        ! function(factory) {
            "use strict";
            "function" == typeof define && define.amd ? define(["jquery"], factory) : jQuery && !jQuery.fn.qtip && factory(jQuery)
        }(function($) {
            "use strict";

            function QTip(target, options, id, attr) {
                this.id = id, this.target = target, this.tooltip = NULL, this.elements = {
                    target: target
                }, this._id = NAMESPACE + "-" + id, this.timers = {
                    img: {}
                }, this.options = options, this.plugins = {}, this.cache = {
                    event: {},
                    target: $(),
                    disabled: FALSE,
                    attr: attr,
                    onTooltip: FALSE,
                    lastClass: ""
                }, this.rendered = this.destroyed = this.disabled = this.waiting = this.hiddenDuringWait = this.positioning = this.triggering = FALSE
            }

            function invalidOpt(a) {
                return a === NULL || "object" !== $.type(a)
            }

            function invalidContent(c) {
                return !($.isFunction(c) || c && c.attr || c.length || "object" === $.type(c) && (c.jquery || c.then))
            }

            function sanitizeOptions(opts) {
                var content, text, ajax, once;
                return invalidOpt(opts) ? FALSE : (invalidOpt(opts.metadata) && (opts.metadata = {
                    type: opts.metadata
                }), "content" in opts && (content = opts.content, invalidOpt(content) || content.jquery || content.done ? content = opts.content = {
                    text: text = invalidContent(content) ? FALSE : content
                } : text = content.text, "ajax" in content && (ajax = content.ajax, once = ajax && ajax.once !== FALSE, delete content.ajax, content.text = function(event, api) {
                    var loading = text || $(this).attr(api.options.content.attr) || "Loading...",
                        deferred = $.ajax($.extend({}, ajax, {
                            context: api
                        })).then(ajax.success, NULL, ajax.error).then(function(content) {
                            return content && once && api.set("content.text", content), content
                        }, function(xhr, status, error) {
                            api.destroyed || 0 === xhr.status || api.set("content.text", status + ": " + error)
                        });
                    return once ? loading : (api.set("content.text", loading), deferred)
                }), "title" in content && ($.isPlainObject(content.title) && (content.button = content.title.button, content.title = content.title.text), invalidContent(content.title || FALSE) && (content.title = FALSE))), "position" in opts && invalidOpt(opts.position) && (opts.position = {
                    my: opts.position,
                    at: opts.position
                }), "show" in opts && invalidOpt(opts.show) && (opts.show = opts.show.jquery ? {
                    target: opts.show
                } : opts.show === TRUE ? {
                    ready: TRUE
                } : {
                    event: opts.show
                }), "hide" in opts && invalidOpt(opts.hide) && (opts.hide = opts.hide.jquery ? {
                    target: opts.hide
                } : {
                    event: opts.hide
                }), "style" in opts && invalidOpt(opts.style) && (opts.style = {
                    classes: opts.style
                }), $.each(PLUGINS, function() {
                    this.sanitize && this.sanitize(opts)
                }), opts)
            }

            function convertNotation(options, notation) {
                for (var obj, i = 0, option = options, levels = notation.split("."); option = option[levels[i++]];) i < levels.length && (obj = option);
                return [obj || options, levels.pop()]
            }

            function setCallback(notation, args) {
                var category, rule, match;
                for (category in this.checks)
                    for (rule in this.checks[category])(match = new RegExp(rule, "i").exec(notation)) && (args.push(match), ("builtin" === category || this.plugins[category]) && this.checks[category][rule].apply(this.plugins[category] || this, args))
            }

            function createWidgetClass(cls) {
                return WIDGET.concat("").join(cls ? "-" + cls + " " : " ")
            }

            function delay(callback, duration) {
                return duration > 0 ? setTimeout($.proxy(callback, this), duration) : void callback.call(this)
            }

            function showMethod(event) {
                this.tooltip.hasClass(CLASS_DISABLED) || (clearTimeout(this.timers.show), clearTimeout(this.timers.hide), this.timers.show = delay.call(this, function() {
                    this.toggle(TRUE, event)
                }, this.options.show.delay))
            }

            function hideMethod(event) {
                if (!this.tooltip.hasClass(CLASS_DISABLED) && !this.destroyed) {
                    var relatedTarget = $(event.relatedTarget),
                        ontoTooltip = relatedTarget.closest(SELECTOR)[0] === this.tooltip[0],
                        ontoTarget = relatedTarget[0] === this.options.show.target[0];
                    if (clearTimeout(this.timers.show), clearTimeout(this.timers.hide), this !== relatedTarget[0] && "mouse" === this.options.position.target && ontoTooltip || this.options.hide.fixed && /mouse(out|leave|move)/.test(event.type) && (ontoTooltip || ontoTarget)) try {
                        event.preventDefault(), event.stopImmediatePropagation()
                    } catch (e) {} else this.timers.hide = delay.call(this, function() {
                        this.toggle(FALSE, event)
                    }, this.options.hide.delay, this)
                }
            }

            function inactiveMethod(event) {
                !this.tooltip.hasClass(CLASS_DISABLED) && this.options.hide.inactive && (clearTimeout(this.timers.inactive), this.timers.inactive = delay.call(this, function() {
                    this.hide(event)
                }, this.options.hide.inactive))
            }

            function repositionMethod(event) {
                this.rendered && this.tooltip[0].offsetWidth > 0 && this.reposition(event)
            }

            function delegate(selector, events, method) {
                $(document.body).delegate(selector, (events.split ? events : events.join("." + NAMESPACE + " ")) + "." + NAMESPACE, function() {
                    var api = QTIP.api[$.attr(this, ATTR_ID)];
                    api && !api.disabled && method.apply(api, arguments)
                })
            }

            function init(elem, id, opts) {
                var obj, posOptions, attr, config, title, docBody = $(document.body),
                    newTarget = elem[0] === document ? docBody : elem,
                    metadata = elem.metadata ? elem.metadata(opts.metadata) : NULL,
                    metadata5 = "html5" === opts.metadata.type && metadata ? metadata[opts.metadata.name] : NULL,
                    html5 = elem.data(opts.metadata.name || "qtipopts");
                try {
                    html5 = "string" == typeof html5 ? $.parseJSON(html5) : html5
                } catch (e) {}
                if (config = $.extend(TRUE, {}, QTIP.defaults, opts, "object" == typeof html5 ? sanitizeOptions(html5) : NULL, sanitizeOptions(metadata5 || metadata)), posOptions = config.position, config.id = id, "boolean" == typeof config.content.text) {
                    if (attr = elem.attr(config.content.attr), config.content.attr === FALSE || !attr) return FALSE;
                    config.content.text = attr
                }
                if (posOptions.container.length || (posOptions.container = docBody), posOptions.target === FALSE && (posOptions.target = newTarget), config.show.target === FALSE && (config.show.target = newTarget), config.show.solo === TRUE && (config.show.solo = posOptions.container.closest("body")), config.hide.target === FALSE && (config.hide.target = newTarget), config.position.viewport === TRUE && (config.position.viewport = posOptions.container), posOptions.container = posOptions.container.eq(0), posOptions.at = new CORNER(posOptions.at, TRUE), posOptions.my = new CORNER(posOptions.my), elem.data(NAMESPACE))
                    if (config.overwrite) elem.qtip("destroy", !0);
                    else if (config.overwrite === FALSE) return FALSE;
                return elem.attr(ATTR_HAS, id), config.suppress && (title = elem.attr("title")) && elem.removeAttr("title").attr(oldtitle, title).attr("title", ""), obj = new QTip(elem, config, id, !!attr), elem.data(NAMESPACE, obj), obj
            }

            function camel(s) {
                return s.charAt(0).toUpperCase() + s.slice(1)
            }

            function vendorCss(elem, prop) {
                var cur, val, ucProp = prop.charAt(0).toUpperCase() + prop.slice(1),
                    props = (prop + " " + cssPrefixes.join(ucProp + " ") + ucProp).split(" "),
                    i = 0;
                if (cssProps[prop]) return elem.css(cssProps[prop]);
                for (; cur = props[i++];)
                    if ((val = elem.css(cur)) !== undefined) return cssProps[prop] = cur, val
            }

            function intCss(elem, prop) {
                return Math.ceil(parseFloat(vendorCss(elem, prop)))
            }

            function Tip(qtip, options) {
                this._ns = "tip", this.options = options, this.offset = options.offset, this.size = [options.width, options.height], this.init(this.qtip = qtip)
            }

            function Modal(api, options) {
                this.options = options, this._ns = "-modal", this.init(this.qtip = api)
            }
            var QTIP, PROTOTYPE, CORNER, CHECKS, trackingBound, TRUE = !0,
                FALSE = !1,
                NULL = null,
                X = "x",
                Y = "y",
                WIDTH = "width",
                HEIGHT = "height",
                TOP = "top",
                LEFT = "left",
                BOTTOM = "bottom",
                RIGHT = "right",
                CENTER = "center",
                FLIPINVERT = "flipinvert",
                SHIFT = "shift",
                PLUGINS = {},
                NAMESPACE = "qtip",
                ATTR_HAS = "data-hasqtip",
                ATTR_ID = "data-qtip-id",
                WIDGET = ["ui-widget", "ui-tooltip"],
                SELECTOR = "." + NAMESPACE,
                INACTIVE_EVENTS = "click dblclick mousedown mouseup mousemove mouseleave mouseenter".split(" "),
                CLASS_FIXED = NAMESPACE + "-fixed",
                CLASS_DEFAULT = NAMESPACE + "-default",
                CLASS_FOCUS = NAMESPACE + "-focus",
                CLASS_HOVER = NAMESPACE + "-hover",
                CLASS_DISABLED = NAMESPACE + "-disabled",
                replaceSuffix = "_replacedByqTip",
                oldtitle = "oldtitle",
                BROWSER = {
                    ie: function() {
                        for (var v = 4, i = document.createElement("div");
                            (i.innerHTML = "<!--[if gt IE " + v + "]><i></i><![endif]-->") && i.getElementsByTagName("i")[0]; v += 1);
                        return v > 4 ? v : NaN
                    }(),
                    iOS: parseFloat(("" + (/CPU.*OS ([0-9_]{1,5})|(CPU like).*AppleWebKit.*Mobile/i.exec(navigator.userAgent) || [0, ""])[1]).replace("undefined", "3_2").replace("_", ".").replace("_", "")) || FALSE
                };
            PROTOTYPE = QTip.prototype, PROTOTYPE._when = function(deferreds) {
                return $.when.apply($, deferreds)
            }, PROTOTYPE.render = function(show) {
                if (this.rendered || this.destroyed) return this;
                var tooltip, self = this,
                    options = this.options,
                    cache = this.cache,
                    elements = this.elements,
                    text = options.content.text,
                    title = options.content.title,
                    button = options.content.button,
                    posOptions = options.position,
                    deferreds = ("." + this._id + " ", []);
                return $.attr(this.target[0], "aria-describedby", this._id), cache.posClass = this._createPosClass((this.position = {
                    my: posOptions.my,
                    at: posOptions.at
                }).my), this.tooltip = elements.tooltip = tooltip = $("<div/>", {
                    id: this._id,
                    "class": [NAMESPACE, CLASS_DEFAULT, options.style.classes, cache.posClass].join(" "),
                    width: options.style.width || "",
                    height: options.style.height || "",
                    tracking: "mouse" === posOptions.target && posOptions.adjust.mouse,
                    role: "alert",
                    "aria-live": "polite",
                    "aria-atomic": FALSE,
                    "aria-describedby": this._id + "-content",
                    "aria-hidden": TRUE
                }).toggleClass(CLASS_DISABLED, this.disabled).attr(ATTR_ID, this.id).data(NAMESPACE, this).appendTo(posOptions.container).append(elements.content = $("<div />", {
                    "class": NAMESPACE + "-content",
                    id: this._id + "-content",
                    "aria-atomic": TRUE
                })), this.rendered = -1, this.positioning = TRUE, title && (this._createTitle(), $.isFunction(title) || deferreds.push(this._updateTitle(title, FALSE))), button && this._createButton(), $.isFunction(text) || deferreds.push(this._updateContent(text, FALSE)), this.rendered = TRUE, this._setWidget(), $.each(PLUGINS, function(name) {
                    var instance;
                    "render" === this.initialize && (instance = this(self)) && (self.plugins[name] = instance)
                }), this._unassignEvents(), this._assignEvents(), this._when(deferreds).then(function() {
                    self._trigger("render"), self.positioning = FALSE, self.hiddenDuringWait || !options.show.ready && !show || self.toggle(TRUE, cache.event, FALSE), self.hiddenDuringWait = FALSE
                }), QTIP.api[this.id] = this, this
            }, PROTOTYPE.destroy = function(immediate) {
                function process() {
                    if (!this.destroyed) {
                        this.destroyed = TRUE;
                        var timer, target = this.target,
                            title = target.attr(oldtitle);
                        this.rendered && this.tooltip.stop(1, 0).find("*").remove().end().remove(), $.each(this.plugins, function(name) {
                            this.destroy && this.destroy()
                        });
                        for (timer in this.timers) clearTimeout(this.timers[timer]);
                        target.removeData(NAMESPACE).removeAttr(ATTR_ID).removeAttr(ATTR_HAS).removeAttr("aria-describedby"), this.options.suppress && title && target.attr("title", title).removeAttr(oldtitle), this._unassignEvents(), this.options = this.elements = this.cache = this.timers = this.plugins = this.mouse = NULL, delete QTIP.api[this.id]
                    }
                }
                return this.destroyed ? this.target : (immediate === TRUE && "hide" !== this.triggering || !this.rendered ? process.call(this) : (this.tooltip.one("tooltiphidden", $.proxy(process, this)), !this.triggering && this.hide()), this.target)
            }, CHECKS = PROTOTYPE.checks = {
                builtin: {
                    "^id$": function(obj, o, v, prev) {
                        var id = v === TRUE ? QTIP.nextid : v,
                            new_id = NAMESPACE + "-" + id;
                        id !== FALSE && id.length > 0 && !$("#" + new_id).length ? (this._id = new_id, this.rendered && (this.tooltip[0].id = this._id, this.elements.content[0].id = this._id + "-content", this.elements.title[0].id = this._id + "-title")) : obj[o] = prev
                    },
                    "^prerender": function(obj, o, v) {
                        v && !this.rendered && this.render(this.options.show.ready)
                    },
                    "^content.text$": function(obj, o, v) {
                        this._updateContent(v)
                    },
                    "^content.attr$": function(obj, o, v, prev) {
                        this.options.content.text === this.target.attr(prev) && this._updateContent(this.target.attr(v))
                    },
                    "^content.title$": function(obj, o, v) {
                        return v ? (v && !this.elements.title && this._createTitle(), void this._updateTitle(v)) : this._removeTitle()
                    },
                    "^content.button$": function(obj, o, v) {
                        this._updateButton(v)
                    },
                    "^content.title.(text|button)$": function(obj, o, v) {
                        this.set("content." + o, v)
                    },
                    "^position.(my|at)$": function(obj, o, v) {
                        "string" == typeof v && (this.position[o] = obj[o] = new CORNER(v, "at" === o))
                    },
                    "^position.container$": function(obj, o, v) {
                        this.rendered && this.tooltip.appendTo(v)
                    },
                    "^show.ready$": function(obj, o, v) {
                        v && (!this.rendered && this.render(TRUE) || this.toggle(TRUE))
                    },
                    "^style.classes$": function(obj, o, v, p) {
                        this.rendered && this.tooltip.removeClass(p).addClass(v)
                    },
                    "^style.(width|height)": function(obj, o, v) {
                        this.rendered && this.tooltip.css(o, v)
                    },
                    "^style.widget|content.title": function() {
                        this.rendered && this._setWidget()
                    },
                    "^style.def": function(obj, o, v) {
                        this.rendered && this.tooltip.toggleClass(CLASS_DEFAULT, !!v)
                    },
                    "^events.(render|show|move|hide|focus|blur)$": function(obj, o, v) {
                        this.rendered && this.tooltip[($.isFunction(v) ? "" : "un") + "bind"]("tooltip" + o, v)
                    },
                    "^(show|hide|position).(event|target|fixed|inactive|leave|distance|viewport|adjust)": function() {
                        if (this.rendered) {
                            var posOptions = this.options.position;
                            this.tooltip.attr("tracking", "mouse" === posOptions.target && posOptions.adjust.mouse), this._unassignEvents(), this._assignEvents()
                        }
                    }
                }
            }, PROTOTYPE.get = function(notation) {
                if (this.destroyed) return this;
                var o = convertNotation(this.options, notation.toLowerCase()),
                    result = o[0][o[1]];
                return result.precedance ? result.string() : result
            };
            var rmove = /^position\.(my|at|adjust|target|container|viewport)|style|content|show\.ready/i,
                rrender = /^prerender|show\.ready/i;
            PROTOTYPE.set = function(option, value) {
                if (this.destroyed) return this;
                var name, rendered = this.rendered,
                    reposition = FALSE,
                    options = this.options;
                this.checks;
                return "string" == typeof option ? (name = option, option = {}, option[name] = value) : option = $.extend({}, option), $.each(option, function(notation, value) {
                    if (rendered && rrender.test(notation)) return void delete option[notation];
                    var previous, obj = convertNotation(options, notation.toLowerCase());
                    previous = obj[0][obj[1]], obj[0][obj[1]] = value && value.nodeType ? $(value) : value, reposition = rmove.test(notation) || reposition, option[notation] = [obj[0], obj[1], value, previous]
                }), sanitizeOptions(options), this.positioning = TRUE, $.each(option, $.proxy(setCallback, this)), this.positioning = FALSE, this.rendered && this.tooltip[0].offsetWidth > 0 && reposition && this.reposition("mouse" === options.position.target ? NULL : this.cache.event), this
            }, PROTOTYPE._update = function(content, element, reposition) {
                var self = this,
                    cache = this.cache;
                return this.rendered && content ? ($.isFunction(content) && (content = content.call(this.elements.target, cache.event, this) || ""), $.isFunction(content.then) ? (cache.waiting = TRUE, content.then(function(c) {
                    return cache.waiting = FALSE, self._update(c, element)
                }, NULL, function(e) {
                    return self._update(e, element)
                })) : content === FALSE || !content && "" !== content ? FALSE : (content.jquery && content.length > 0 ? element.empty().append(content.css({
                    display: "block",
                    visibility: "visible"
                })) : element.html(content), this._waitForContent(element).then(function(images) {
                    self.rendered && self.tooltip[0].offsetWidth > 0 && self.reposition(cache.event, !images.length)
                }))) : FALSE
            }, PROTOTYPE._waitForContent = function(element) {
                var cache = this.cache;
                return cache.waiting = TRUE, ($.fn.imagesLoaded ? element.imagesLoaded() : $.Deferred().resolve([])).done(function() {
                    cache.waiting = FALSE
                }).promise()
            }, PROTOTYPE._updateContent = function(content, reposition) {
                this._update(content, this.elements.content, reposition)
            }, PROTOTYPE._updateTitle = function(content, reposition) {
                this._update(content, this.elements.title, reposition) === FALSE && this._removeTitle(FALSE)
            }, PROTOTYPE._createTitle = function() {
                var elements = this.elements,
                    id = this._id + "-title";
                elements.titlebar && this._removeTitle(), elements.titlebar = $("<div />", {
                    "class": NAMESPACE + "-titlebar " + (this.options.style.widget ? createWidgetClass("header") : "")
                }).append(elements.title = $("<div />", {
                    id: id,
                    "class": NAMESPACE + "-title",
                    "aria-atomic": TRUE
                })).insertBefore(elements.content).delegate(".qtip-close", "mousedown keydown mouseup keyup mouseout", function(event) {
                    $(this).toggleClass("ui-state-active ui-state-focus", "down" === event.type.substr(-4))
                }).delegate(".qtip-close", "mouseover mouseout", function(event) {
                    $(this).toggleClass("ui-state-hover", "mouseover" === event.type)
                }), this.options.content.button && this._createButton()
            }, PROTOTYPE._removeTitle = function(reposition) {
                var elements = this.elements;
                elements.title && (elements.titlebar.remove(), elements.titlebar = elements.title = elements.button = NULL, reposition !== FALSE && this.reposition())
            }, PROTOTYPE._createPosClass = function(my) {
                return NAMESPACE + "-pos-" + (my || this.options.position.my).abbrev()
            }, PROTOTYPE.reposition = function(event, effect) {
                if (!this.rendered || this.positioning || this.destroyed) return this;
                this.positioning = TRUE;
                var pluginCalculations, offset, adjusted, newClass, cache = this.cache,
                    tooltip = this.tooltip,
                    posOptions = this.options.position,
                    target = posOptions.target,
                    my = posOptions.my,
                    at = posOptions.at,
                    viewport = posOptions.viewport,
                    container = posOptions.container,
                    adjust = posOptions.adjust,
                    method = adjust.method.split(" "),
                    tooltipWidth = tooltip.outerWidth(FALSE),
                    tooltipHeight = tooltip.outerHeight(FALSE),
                    targetWidth = 0,
                    targetHeight = 0,
                    type = tooltip.css("position"),
                    position = {
                        left: 0,
                        top: 0
                    },
                    visible = tooltip[0].offsetWidth > 0,
                    isScroll = event && "scroll" === event.type,
                    win = $(window),
                    doc = container[0].ownerDocument,
                    mouse = this.mouse;
                if ($.isArray(target) && 2 === target.length) at = {
                    x: LEFT,
                    y: TOP
                }, position = {
                    left: target[0],
                    top: target[1]
                };
                else if ("mouse" === target) at = {
                    x: LEFT,
                    y: TOP
                }, (!adjust.mouse || this.options.hide.distance) && cache.origin && cache.origin.pageX ? event = cache.origin : !event || event && ("resize" === event.type || "scroll" === event.type) ? event = cache.event : mouse && mouse.pageX && (event = mouse), "static" !== type && (position = container.offset()), doc.body.offsetWidth !== (window.innerWidth || doc.documentElement.clientWidth) && (offset = $(document.body).offset()), position = {
                    left: event.pageX - position.left + (offset && offset.left || 0),
                    top: event.pageY - position.top + (offset && offset.top || 0)
                }, adjust.mouse && isScroll && mouse && (position.left -= (mouse.scrollX || 0) - win.scrollLeft(), position.top -= (mouse.scrollY || 0) - win.scrollTop());
                else {
                    if ("event" === target ? event && event.target && "scroll" !== event.type && "resize" !== event.type ? cache.target = $(event.target) : event.target || (cache.target = this.elements.target) : "event" !== target && (cache.target = $(target.jquery ? target : this.elements.target)), target = cache.target, target = $(target).eq(0), 0 === target.length) return this;
                    target[0] === document || target[0] === window ? (targetWidth = BROWSER.iOS ? window.innerWidth : target.width(), targetHeight = BROWSER.iOS ? window.innerHeight : target.height(), target[0] === window && (position = {
                        top: (viewport || target).scrollTop(),
                        left: (viewport || target).scrollLeft()
                    })) : PLUGINS.imagemap && target.is("area") ? pluginCalculations = PLUGINS.imagemap(this, target, at, PLUGINS.viewport ? method : FALSE) : PLUGINS.svg && target && target[0].ownerSVGElement ? pluginCalculations = PLUGINS.svg(this, target, at, PLUGINS.viewport ? method : FALSE) : (targetWidth = target.outerWidth(FALSE), targetHeight = target.outerHeight(FALSE), position = target.offset()), pluginCalculations && (targetWidth = pluginCalculations.width, targetHeight = pluginCalculations.height, offset = pluginCalculations.offset, position = pluginCalculations.position), position = this.reposition.offset(target, position, container), (BROWSER.iOS > 3.1 && BROWSER.iOS < 4.1 || BROWSER.iOS >= 4.3 && BROWSER.iOS < 4.33 || !BROWSER.iOS && "fixed" === type) && (position.left -= win.scrollLeft(), position.top -= win.scrollTop()), (!pluginCalculations || pluginCalculations && pluginCalculations.adjustable !== FALSE) && (position.left += at.x === RIGHT ? targetWidth : at.x === CENTER ? targetWidth / 2 : 0, position.top += at.y === BOTTOM ? targetHeight : at.y === CENTER ? targetHeight / 2 : 0)
                }
                return position.left += adjust.x + (my.x === RIGHT ? -tooltipWidth : my.x === CENTER ? -tooltipWidth / 2 : 0), position.top += adjust.y + (my.y === BOTTOM ? -tooltipHeight : my.y === CENTER ? -tooltipHeight / 2 : 0), PLUGINS.viewport ? (adjusted = position.adjusted = PLUGINS.viewport(this, position, posOptions, targetWidth, targetHeight, tooltipWidth, tooltipHeight), offset && adjusted.left && (position.left += offset.left), offset && adjusted.top && (position.top += offset.top), adjusted.my && (this.position.my = adjusted.my)) : position.adjusted = {
                    left: 0,
                    top: 0
                }, cache.posClass !== (newClass = this._createPosClass(this.position.my)) && tooltip.removeClass(cache.posClass).addClass(cache.posClass = newClass), this._trigger("move", [position, viewport.elem || viewport], event) ? (delete position.adjusted, effect === FALSE || !visible || isNaN(position.left) || isNaN(position.top) || "mouse" === target || !$.isFunction(posOptions.effect) ? tooltip.css(position) : $.isFunction(posOptions.effect) && (posOptions.effect.call(tooltip, this, $.extend({}, position)), tooltip.queue(function(next) {
                    $(this).css({
                        opacity: "",
                        height: ""
                    }), BROWSER.ie && this.style.removeAttribute("filter"), next()
                })), this.positioning = FALSE, this) : this
            }, PROTOTYPE.reposition.offset = function(elem, pos, container) {
                function scroll(e, i) {
                    pos.left += i * e.scrollLeft(), pos.top += i * e.scrollTop()
                }
                if (!container[0]) return pos;
                var scrolled, position, parentOffset, overflow, ownerDocument = $(elem[0].ownerDocument),
                    quirks = !!BROWSER.ie && "CSS1Compat" !== document.compatMode,
                    parent = container[0];
                do "static" !== (position = $.css(parent, "position")) && ("fixed" === position ? (parentOffset = parent.getBoundingClientRect(), scroll(ownerDocument, -1)) : (parentOffset = $(parent).position(), parentOffset.left += parseFloat($.css(parent, "borderLeftWidth")) || 0, parentOffset.top += parseFloat($.css(parent, "borderTopWidth")) || 0), pos.left -= parentOffset.left + (parseFloat($.css(parent, "marginLeft")) || 0), pos.top -= parentOffset.top + (parseFloat($.css(parent, "marginTop")) || 0), scrolled || "hidden" === (overflow = $.css(parent, "overflow")) || "visible" === overflow || (scrolled = $(parent))); while (parent = parent.offsetParent);
                return scrolled && (scrolled[0] !== ownerDocument[0] || quirks) && scroll(scrolled, 1), pos
            };
            var C = (CORNER = PROTOTYPE.reposition.Corner = function(corner, forceY) {
                corner = ("" + corner).replace(/([A-Z])/, " $1").replace(/middle/gi, CENTER).toLowerCase(), this.x = (corner.match(/left|right/i) || corner.match(/center/) || ["inherit"])[0].toLowerCase(), this.y = (corner.match(/top|bottom|center/i) || ["inherit"])[0].toLowerCase(), this.forceY = !!forceY;
                var f = corner.charAt(0);
                this.precedance = "t" === f || "b" === f ? Y : X
            }).prototype;
            C.invert = function(z, center) {
                this[z] = this[z] === LEFT ? RIGHT : this[z] === RIGHT ? LEFT : center || this[z]
            }, C.string = function(join) {
                var x = this.x,
                    y = this.y,
                    result = x !== y ? "center" === x || "center" !== y && (this.precedance === Y || this.forceY) ? [y, x] : [x, y] : [x];
                return join !== !1 ? result.join(" ") : result
            }, C.abbrev = function() {
                var result = this.string(!1);
                return result[0].charAt(0) + (result[1] && result[1].charAt(0) || "")
            }, C.clone = function() {
                return new CORNER(this.string(), this.forceY)
            }, PROTOTYPE.toggle = function(state, event) {
                var cache = this.cache,
                    options = this.options,
                    tooltip = this.tooltip;
                if (event) {
                    if (/over|enter/.test(event.type) && cache.event && /out|leave/.test(cache.event.type) && options.show.target.add(event.target).length === options.show.target.length && tooltip.has(event.relatedTarget).length) return this;
                    cache.event = $.event.fix(event)
                }
                if (this.waiting && !state && (this.hiddenDuringWait = TRUE), !this.rendered) return state ? this.render(1) : this;
                if (this.destroyed || this.disabled) return this;
                var identicalState, allow, after, type = state ? "show" : "hide",
                    opts = this.options[type],
                    posOptions = (this.options[state ? "hide" : "show"], this.options.position),
                    contentOptions = this.options.content,
                    width = this.tooltip.css("width"),
                    visible = this.tooltip.is(":visible"),
                    animate = state || 1 === opts.target.length,
                    sameTarget = !event || opts.target.length < 2 || cache.target[0] === event.target;
                return (typeof state).search("boolean|number") && (state = !visible), identicalState = !tooltip.is(":animated") && visible === state && sameTarget, allow = identicalState ? NULL : !!this._trigger(type, [90]), this.destroyed ? this : (allow !== FALSE && state && this.focus(event), !allow || identicalState ? this : ($.attr(tooltip[0], "aria-hidden", !state), state ? (this.mouse && (cache.origin = $.event.fix(this.mouse)), $.isFunction(contentOptions.text) && this._updateContent(contentOptions.text, FALSE), $.isFunction(contentOptions.title) && this._updateTitle(contentOptions.title, FALSE), !trackingBound && "mouse" === posOptions.target && posOptions.adjust.mouse && ($(document).bind("mousemove." + NAMESPACE, this._storeMouse), trackingBound = TRUE), width || tooltip.css("width", tooltip.outerWidth(FALSE)), this.reposition(event, arguments[2]), width || tooltip.css("width", ""), opts.solo && ("string" == typeof opts.solo ? $(opts.solo) : $(SELECTOR, opts.solo)).not(tooltip).not(opts.target).qtip("hide", $.Event("tooltipsolo"))) : (clearTimeout(this.timers.show), delete cache.origin, trackingBound && !$(SELECTOR + '[tracking="true"]:visible', opts.solo).not(tooltip).length && ($(document).unbind("mousemove." + NAMESPACE), trackingBound = FALSE), this.blur(event)), after = $.proxy(function() {
                    state ? (BROWSER.ie && tooltip[0].style.removeAttribute("filter"), tooltip.css("overflow", ""), "string" == typeof opts.autofocus && $(this.options.show.autofocus, tooltip).focus(), this.options.show.target.trigger("qtip-" + this.id + "-inactive")) : tooltip.css({
                        display: "",
                        visibility: "",
                        opacity: "",
                        left: "",
                        top: ""
                    }), this._trigger(state ? "visible" : "hidden")
                }, this), opts.effect === FALSE || animate === FALSE ? (tooltip[type](), after()) : $.isFunction(opts.effect) ? (tooltip.stop(1, 1), opts.effect.call(tooltip, this), tooltip.queue("fx", function(n) {
                    after(), n()
                })) : tooltip.fadeTo(90, state ? 1 : 0, after), state && opts.target.trigger("qtip-" + this.id + "-inactive"), this))
            }, PROTOTYPE.show = function(event) {
                return this.toggle(TRUE, event)
            }, PROTOTYPE.hide = function(event) {
                return this.toggle(FALSE, event)
            }, PROTOTYPE.focus = function(event) {
                if (!this.rendered || this.destroyed) return this;
                var qtips = $(SELECTOR),
                    tooltip = this.tooltip,
                    curIndex = parseInt(tooltip[0].style.zIndex, 10),
                    newIndex = QTIP.zindex + qtips.length;
                return tooltip.hasClass(CLASS_FOCUS) || this._trigger("focus", [newIndex], event) && (curIndex !== newIndex && (qtips.each(function() {
                    this.style.zIndex > curIndex && (this.style.zIndex = this.style.zIndex - 1)
                }), qtips.filter("." + CLASS_FOCUS).qtip("blur", event)), tooltip.addClass(CLASS_FOCUS)[0].style.zIndex = newIndex), this
            }, PROTOTYPE.blur = function(event) {
                return !this.rendered || this.destroyed ? this : (this.tooltip.removeClass(CLASS_FOCUS), this._trigger("blur", [this.tooltip.css("zIndex")], event), this)
            }, PROTOTYPE.disable = function(state) {
                return this.destroyed ? this : ("toggle" === state ? state = !(this.rendered ? this.tooltip.hasClass(CLASS_DISABLED) : this.disabled) : "boolean" != typeof state && (state = TRUE), this.rendered && this.tooltip.toggleClass(CLASS_DISABLED, state).attr("aria-disabled", state), this.disabled = !!state, this)
            }, PROTOTYPE.enable = function() {
                return this.disable(FALSE)
            }, PROTOTYPE._createButton = function() {
                var self = this,
                    elements = this.elements,
                    tooltip = elements.tooltip,
                    button = this.options.content.button,
                    isString = "string" == typeof button,
                    close = isString ? button : "Close tooltip";
                elements.button && elements.button.remove(), button.jquery ? elements.button = button : elements.button = $("<a />", {
                    "class": "qtip-close " + (this.options.style.widget ? "" : NAMESPACE + "-icon"),
                    title: close,
                    "aria-label": close
                }).prepend($("<span />", {
                    "class": "ui-icon ui-icon-close",
                    html: "&times;"
                })), elements.button.appendTo(elements.titlebar || tooltip).attr("role", "button").click(function(event) {
                    return tooltip.hasClass(CLASS_DISABLED) || self.hide(event), FALSE
                })
            }, PROTOTYPE._updateButton = function(button) {
                if (!this.rendered) return FALSE;
                var elem = this.elements.button;
                button ? this._createButton() : elem.remove()
            }, PROTOTYPE._setWidget = function() {
                var on = this.options.style.widget,
                    elements = this.elements,
                    tooltip = elements.tooltip,
                    disabled = tooltip.hasClass(CLASS_DISABLED);
                tooltip.removeClass(CLASS_DISABLED), CLASS_DISABLED = on ? "ui-state-disabled" : "qtip-disabled", tooltip.toggleClass(CLASS_DISABLED, disabled), tooltip.toggleClass("ui-helper-reset " + createWidgetClass(), on).toggleClass(CLASS_DEFAULT, this.options.style.def && !on), elements.content && elements.content.toggleClass(createWidgetClass("content"), on), elements.titlebar && elements.titlebar.toggleClass(createWidgetClass("header"), on), elements.button && elements.button.toggleClass(NAMESPACE + "-icon", !on)
            }, PROTOTYPE._storeMouse = function(event) {
                return (this.mouse = $.event.fix(event)).type = "mousemove", this
            }, PROTOTYPE._bind = function(targets, events, method, suffix, context) {
                if (targets && method && events.length) {
                    var ns = "." + this._id + (suffix ? "-" + suffix : "");
                    return $(targets).bind((events.split ? events : events.join(ns + " ")) + ns, $.proxy(method, context || this)), this
                }
            }, PROTOTYPE._unbind = function(targets, suffix) {
                return targets && $(targets).unbind("." + this._id + (suffix ? "-" + suffix : "")), this
            }, PROTOTYPE._trigger = function(type, args, event) {
                var callback = $.Event("tooltip" + type);
                return callback.originalEvent = event && $.extend({}, event) || this.cache.event || NULL, this.triggering = type, this.tooltip.trigger(callback, [this].concat(args || [])), this.triggering = FALSE, !callback.isDefaultPrevented()
            }, PROTOTYPE._bindEvents = function(showEvents, hideEvents, showTargets, hideTargets, showMethod, hideMethod) {
                var similarTargets = showTargets.filter(hideTargets).add(hideTargets.filter(showTargets)),
                    toggleEvents = [];
                similarTargets.length && ($.each(hideEvents, function(i, type) {
                    var showIndex = $.inArray(type, showEvents);
                    showIndex > -1 && toggleEvents.push(showEvents.splice(showIndex, 1)[0])
                }), toggleEvents.length && (this._bind(similarTargets, toggleEvents, function(event) {
                    var state = this.rendered ? this.tooltip[0].offsetWidth > 0 : !1;
                    (state ? hideMethod : showMethod).call(this, event)
                }), showTargets = showTargets.not(similarTargets), hideTargets = hideTargets.not(similarTargets))), this._bind(showTargets, showEvents, showMethod), this._bind(hideTargets, hideEvents, hideMethod)
            }, PROTOTYPE._assignInitialEvents = function(event) {
                function hoverIntent(event) {
                    return this.disabled || this.destroyed ? FALSE : (this.cache.event = event && $.event.fix(event), this.cache.target = event && $(event.target), clearTimeout(this.timers.show), void(this.timers.show = delay.call(this, function() {
                        this.render("object" == typeof event || options.show.ready)
                    }, options.prerender ? 0 : options.show.delay)))
                }
                var options = this.options,
                    showTarget = options.show.target,
                    hideTarget = options.hide.target,
                    showEvents = options.show.event ? $.trim("" + options.show.event).split(" ") : [],
                    hideEvents = options.hide.event ? $.trim("" + options.hide.event).split(" ") : [];
                this._bind(this.elements.target, ["remove", "removeqtip"], function(event) {
                    this.destroy(!0)
                }, "destroy"), /mouse(over|enter)/i.test(options.show.event) && !/mouse(out|leave)/i.test(options.hide.event) && hideEvents.push("mouseleave"), this._bind(showTarget, "mousemove", function(event) {
                    this._storeMouse(event), this.cache.onTarget = TRUE
                }), this._bindEvents(showEvents, hideEvents, showTarget, hideTarget, hoverIntent, function() {
                    return this.timers ? void clearTimeout(this.timers.show) : FALSE
                }), (options.show.ready || options.prerender) && hoverIntent.call(this, event)
            }, PROTOTYPE._assignEvents = function() {
                var self = this,
                    options = this.options,
                    posOptions = options.position,
                    tooltip = this.tooltip,
                    showTarget = options.show.target,
                    hideTarget = options.hide.target,
                    containerTarget = posOptions.container,
                    viewportTarget = posOptions.viewport,
                    documentTarget = $(document),
                    windowTarget = ($(document.body), $(window)),
                    showEvents = options.show.event ? $.trim("" + options.show.event).split(" ") : [],
                    hideEvents = options.hide.event ? $.trim("" + options.hide.event).split(" ") : [];
                $.each(options.events, function(name, callback) {
                    self._bind(tooltip, "toggle" === name ? ["tooltipshow", "tooltiphide"] : ["tooltip" + name], callback, null, tooltip)
                }), /mouse(out|leave)/i.test(options.hide.event) && "window" === options.hide.leave && this._bind(documentTarget, ["mouseout", "blur"], function(event) {
                    /select|option/.test(event.target.nodeName) || event.relatedTarget || this.hide(event)
                }), options.hide.fixed ? hideTarget = hideTarget.add(tooltip.addClass(CLASS_FIXED)) : /mouse(over|enter)/i.test(options.show.event) && this._bind(hideTarget, "mouseleave", function() {
                    clearTimeout(this.timers.show)
                }), ("" + options.hide.event).indexOf("unfocus") > -1 && this._bind(containerTarget.closest("html"), ["mousedown", "touchstart"], function(event) {
                    var elem = $(event.target),
                        enabled = this.rendered && !this.tooltip.hasClass(CLASS_DISABLED) && this.tooltip[0].offsetWidth > 0,
                        isAncestor = elem.parents(SELECTOR).filter(this.tooltip[0]).length > 0;
                    elem[0] === this.target[0] || elem[0] === this.tooltip[0] || isAncestor || this.target.has(elem[0]).length || !enabled || this.hide(event)
                }), "number" == typeof options.hide.inactive && (this._bind(showTarget, "qtip-" + this.id + "-inactive", inactiveMethod, "inactive"), this._bind(hideTarget.add(tooltip), QTIP.inactiveEvents, inactiveMethod)), this._bindEvents(showEvents, hideEvents, showTarget, hideTarget, showMethod, hideMethod), this._bind(showTarget.add(tooltip), "mousemove", function(event) {
                    if ("number" == typeof options.hide.distance) {
                        var origin = this.cache.origin || {},
                            limit = this.options.hide.distance,
                            abs = Math.abs;
                        (abs(event.pageX - origin.pageX) >= limit || abs(event.pageY - origin.pageY) >= limit) && this.hide(event)
                    }
                    this._storeMouse(event)
                }), "mouse" === posOptions.target && posOptions.adjust.mouse && (options.hide.event && this._bind(showTarget, ["mouseenter", "mouseleave"], function(event) {
                    return this.cache ? void(this.cache.onTarget = "mouseenter" === event.type) : FALSE
                }), this._bind(documentTarget, "mousemove", function(event) {
                    this.rendered && this.cache.onTarget && !this.tooltip.hasClass(CLASS_DISABLED) && this.tooltip[0].offsetWidth > 0 && this.reposition(event)
                })), (posOptions.adjust.resize || viewportTarget.length) && this._bind($.event.special.resize ? viewportTarget : windowTarget, "resize", repositionMethod), posOptions.adjust.scroll && this._bind(windowTarget.add(posOptions.container), "scroll", repositionMethod)
            }, PROTOTYPE._unassignEvents = function() {
                var options = this.options,
                    showTargets = options.show.target,
                    hideTargets = options.hide.target,
                    targets = $.grep([this.elements.target[0], this.rendered && this.tooltip[0], options.position.container[0], options.position.viewport[0], options.position.container.closest("html")[0], window, document], function(i) {
                        return "object" == typeof i
                    });
                showTargets && showTargets.toArray && (targets = targets.concat(showTargets.toArray())), hideTargets && hideTargets.toArray && (targets = targets.concat(hideTargets.toArray())), this._unbind(targets)._unbind(targets, "destroy")._unbind(targets, "inactive")
            }, $(function() {
                delegate(SELECTOR, ["mouseenter", "mouseleave"], function(event) {
                    var state = "mouseenter" === event.type,
                        tooltip = $(event.currentTarget),
                        target = $(event.relatedTarget || event.target),
                        options = this.options;
                    state ? (this.focus(event), tooltip.hasClass(CLASS_FIXED) && !tooltip.hasClass(CLASS_DISABLED) && clearTimeout(this.timers.hide)) : "mouse" === options.position.target && options.position.adjust.mouse && options.hide.event && options.show.target && !target.closest(options.show.target[0]).length && this.hide(event), tooltip.toggleClass(CLASS_HOVER, state)
                }), delegate("[" + ATTR_ID + "]", INACTIVE_EVENTS, inactiveMethod)
            }), QTIP = $.fn.qtip = function(options, notation, newValue) {
                var command = ("" + options).toLowerCase(),
                    returned = NULL,
                    args = $.makeArray(arguments).slice(1),
                    event = args[args.length - 1],
                    opts = this[0] ? $.data(this[0], NAMESPACE) : NULL;
                return !arguments.length && opts || "api" === command ? opts : "string" == typeof options ? (this.each(function() {
                    var api = $.data(this, NAMESPACE);
                    if (!api) return TRUE;
                    if (event && event.timeStamp && (api.cache.event = event), !notation || "option" !== command && "options" !== command) api[command] && api[command].apply(api, args);
                    else {
                        if (newValue === undefined && !$.isPlainObject(notation)) return returned = api.get(notation), FALSE;
                        api.set(notation, newValue)
                    }
                }), returned !== NULL ? returned : this) : "object" != typeof options && arguments.length ? void 0 : (opts = sanitizeOptions($.extend(TRUE, {}, options)), this.each(function(i) {
                    var api, id;
                    return id = $.isArray(opts.id) ? opts.id[i] : opts.id, id = !id || id === FALSE || id.length < 1 || QTIP.api[id] ? QTIP.nextid++ : id, api = init($(this), id, opts), api === FALSE ? TRUE : (QTIP.api[id] = api, $.each(PLUGINS, function() {
                        "initialize" === this.initialize && this(api)
                    }), void api._assignInitialEvents(event))
                }))
            }, $.qtip = QTip, QTIP.api = {}, $.each({
                attr: function(attr, val) {
                    if (this.length) {
                        var self = this[0],
                            title = "title",
                            api = $.data(self, "qtip");
                        if (attr === title && api && "object" == typeof api && api.options.suppress) return arguments.length < 2 ? $.attr(self, oldtitle) : (api && api.options.content.attr === title && api.cache.attr && api.set("content.text", val), this.attr(oldtitle, val))
                    }
                    return $.fn["attr" + replaceSuffix].apply(this, arguments)
                },
                clone: function(keepData) {
                    var elems = ($([]), $.fn["clone" + replaceSuffix].apply(this, arguments));
                    return keepData || elems.filter("[" + oldtitle + "]").attr("title", function() {
                        return $.attr(this, oldtitle)
                    }).removeAttr(oldtitle), elems
                }
            }, function(name, func) {
                if (!func || $.fn[name + replaceSuffix]) return TRUE;
                var old = $.fn[name + replaceSuffix] = $.fn[name];
                $.fn[name] = function() {
                    return func.apply(this, arguments) || old.apply(this, arguments)
                }
            }), $.ui || ($["cleanData" + replaceSuffix] = $.cleanData, $.cleanData = function(elems) {
                for (var elem, i = 0;
                    (elem = $(elems[i])).length; i++)
                    if (elem.attr(ATTR_HAS)) try {
                        elem.triggerHandler("removeqtip")
                    } catch (e) {}
                    $["cleanData" + replaceSuffix].apply(this, arguments)
            }), QTIP.version = "2.2.1", QTIP.nextid = 0, QTIP.inactiveEvents = INACTIVE_EVENTS, QTIP.zindex = 15e3, QTIP.defaults = {
                prerender: FALSE,
                id: FALSE,
                overwrite: TRUE,
                suppress: TRUE,
                content: {
                    text: TRUE,
                    attr: "title",
                    title: FALSE,
                    button: FALSE
                },
                position: {
                    my: "top left",
                    at: "bottom right",
                    target: FALSE,
                    container: FALSE,
                    viewport: FALSE,
                    adjust: {
                        x: 0,
                        y: 0,
                        mouse: TRUE,
                        scroll: TRUE,
                        resize: TRUE,
                        method: "flipinvert flipinvert"
                    },
                    effect: function(api, pos, viewport) {
                        $(this).animate(pos, {
                            duration: 200,
                            queue: FALSE
                        })
                    }
                },
                show: {
                    target: FALSE,
                    event: "mouseenter",
                    effect: TRUE,
                    delay: 90,
                    solo: FALSE,
                    ready: FALSE,
                    autofocus: FALSE
                },
                hide: {
                    target: FALSE,
                    event: "mouseleave",
                    effect: TRUE,
                    delay: 0,
                    fixed: FALSE,
                    inactive: FALSE,
                    leave: "window",
                    distance: FALSE
                },
                style: {
                    classes: "",
                    widget: FALSE,
                    width: FALSE,
                    height: FALSE,
                    def: TRUE
                },
                events: {
                    render: NULL,
                    move: NULL,
                    show: NULL,
                    hide: NULL,
                    toggle: NULL,
                    visible: NULL,
                    hidden: NULL,
                    focus: NULL,
                    blur: NULL
                }
            };
            var TIP, MARGIN = "margin",
                BORDER = "border",
                COLOR = "color",
                BG_COLOR = "background-color",
                TRANSPARENT = "transparent",
                IMPORTANT = " !important",
                HASCANVAS = !!document.createElement("canvas").getContext,
                INVALID = /rgba?\(0, 0, 0(, 0)?\)|transparent|#123456/i,
                cssProps = {},
                cssPrefixes = ["Webkit", "O", "Moz", "ms"];
            if (HASCANVAS) var PIXEL_RATIO = window.devicePixelRatio || 1,
                BACKING_STORE_RATIO = function() {
                    var context = document.createElement("canvas").getContext("2d");
                    return context.backingStorePixelRatio || context.webkitBackingStorePixelRatio || context.mozBackingStorePixelRatio || context.msBackingStorePixelRatio || context.oBackingStorePixelRatio || 1
                }(),
                SCALE = PIXEL_RATIO / BACKING_STORE_RATIO;
            else var createVML = function(tag, props, style) {
                return "<qtipvml:" + tag + ' xmlns="urn:schemas-microsoft.com:vml" class="qtip-vml" ' + (props || "") + ' style="behavior: url(#default#VML); ' + (style || "") + '" />'
            };
            $.extend(Tip.prototype, {
                init: function(qtip) {
                    var context, tip;
                    tip = this.element = qtip.elements.tip = $("<div />", {
                        "class": NAMESPACE + "-tip"
                    }).prependTo(qtip.tooltip), HASCANVAS ? (context = $("<canvas />").appendTo(this.element)[0].getContext("2d"), context.lineJoin = "miter", context.miterLimit = 1e5, context.save()) : (context = createVML("shape", 'coordorigin="0,0"', "position:absolute;"), this.element.html(context + context), qtip._bind($("*", tip).add(tip), ["click", "mousedown"], function(event) {
                        event.stopPropagation()
                    }, this._ns)), qtip._bind(qtip.tooltip, "tooltipmove", this.reposition, this._ns, this), this.create()
                },
                _swapDimensions: function() {
                    this.size[0] = this.options.height, this.size[1] = this.options.width
                },
                _resetDimensions: function() {
                    this.size[0] = this.options.width, this.size[1] = this.options.height
                },
                _useTitle: function(corner) {
                    var titlebar = this.qtip.elements.titlebar;
                    return titlebar && (corner.y === TOP || corner.y === CENTER && this.element.position().top + this.size[1] / 2 + this.options.offset < titlebar.outerHeight(TRUE))
                },
                _parseCorner: function(corner) {
                    var my = this.qtip.options.position.my;
                    return corner === FALSE || my === FALSE ? corner = FALSE : corner === TRUE ? corner = new CORNER(my.string()) : corner.string || (corner = new CORNER(corner), corner.fixed = TRUE), corner
                },
                _parseWidth: function(corner, side, use) {
                    var elements = this.qtip.elements,
                        prop = BORDER + camel(side) + "Width";
                    return (use ? intCss(use, prop) : intCss(elements.content, prop) || intCss(this._useTitle(corner) && elements.titlebar || elements.content, prop) || intCss(elements.tooltip, prop)) || 0
                },
                _parseRadius: function(corner) {
                    var elements = this.qtip.elements,
                        prop = BORDER + camel(corner.y) + camel(corner.x) + "Radius";
                    return BROWSER.ie < 9 ? 0 : intCss(this._useTitle(corner) && elements.titlebar || elements.content, prop) || intCss(elements.tooltip, prop) || 0
                },
                _invalidColour: function(elem, prop, compare) {
                    var val = elem.css(prop);
                    return !val || compare && val === elem.css(compare) || INVALID.test(val) ? FALSE : val
                },
                _parseColours: function(corner) {
                    var elements = this.qtip.elements,
                        tip = this.element.css("cssText", ""),
                        borderSide = BORDER + camel(corner[corner.precedance]) + camel(COLOR),
                        colorElem = this._useTitle(corner) && elements.titlebar || elements.content,
                        css = this._invalidColour,
                        color = [];
                    return color[0] = css(tip, BG_COLOR) || css(colorElem, BG_COLOR) || css(elements.content, BG_COLOR) || css(elements.tooltip, BG_COLOR) || tip.css(BG_COLOR), color[1] = css(tip, borderSide, COLOR) || css(colorElem, borderSide, COLOR) || css(elements.content, borderSide, COLOR) || css(elements.tooltip, borderSide, COLOR) || elements.tooltip.css(borderSide), $("*", tip).add(tip).css("cssText", BG_COLOR + ":" + TRANSPARENT + IMPORTANT + ";" + BORDER + ":0" + IMPORTANT + ";"), color
                },
                _calculateSize: function(corner) {
                    var bigHyp, ratio, result, y = corner.precedance === Y,
                        width = this.options.width,
                        height = this.options.height,
                        isCenter = "c" === corner.abbrev(),
                        base = (y ? width : height) * (isCenter ? .5 : 1),
                        pow = Math.pow,
                        round = Math.round,
                        smallHyp = Math.sqrt(pow(base, 2) + pow(height, 2)),
                        hyp = [this.border / base * smallHyp, this.border / height * smallHyp];
                    return hyp[2] = Math.sqrt(pow(hyp[0], 2) - pow(this.border, 2)), hyp[3] = Math.sqrt(pow(hyp[1], 2) - pow(this.border, 2)), bigHyp = smallHyp + hyp[2] + hyp[3] + (isCenter ? 0 : hyp[0]), ratio = bigHyp / smallHyp, result = [round(ratio * width), round(ratio * height)], y ? result : result.reverse()
                },
                _calculateTip: function(corner, size, scale) {
                    scale = scale || 1, size = size || this.size;
                    var width = size[0] * scale,
                        height = size[1] * scale,
                        width2 = Math.ceil(width / 2),
                        height2 = Math.ceil(height / 2),
                        tips = {
                            br: [0, 0, width, height, width, 0],
                            bl: [0, 0, width, 0, 0, height],
                            tr: [0, height, width, 0, width, height],
                            tl: [0, 0, 0, height, width, height],
                            tc: [0, height, width2, 0, width, height],
                            bc: [0, 0, width, 0, width2, height],
                            rc: [0, 0, width, height2, 0, height],
                            lc: [width, 0, width, height, 0, height2]
                        };
                    return tips.lt = tips.br, tips.rt = tips.bl, tips.lb = tips.tr, tips.rb = tips.tl, tips[corner.abbrev()]
                },
                _drawCoords: function(context, coords) {
                    context.beginPath(), context.moveTo(coords[0], coords[1]), context.lineTo(coords[2], coords[3]), context.lineTo(coords[4], coords[5]), context.closePath()
                },
                create: function() {
                    var c = this.corner = (HASCANVAS || BROWSER.ie) && this._parseCorner(this.options.corner);
                    return (this.enabled = !!this.corner && "c" !== this.corner.abbrev()) && (this.qtip.cache.corner = c.clone(), this.update()), this.element.toggle(this.enabled), this.corner
                },
                update: function(corner, position) {
                    if (!this.enabled) return this;
                    var color, precedance, context, coords, bigCoords, translate, newSize, border, elements = this.qtip.elements,
                        tip = this.element,
                        inner = tip.children(),
                        options = this.options,
                        curSize = this.size,
                        mimic = options.mimic,
                        round = Math.round;
                    corner || (corner = this.qtip.cache.corner || this.corner), mimic === FALSE ? mimic = corner : (mimic = new CORNER(mimic), mimic.precedance = corner.precedance, "inherit" === mimic.x ? mimic.x = corner.x : "inherit" === mimic.y ? mimic.y = corner.y : mimic.x === mimic.y && (mimic[corner.precedance] = corner[corner.precedance])), precedance = mimic.precedance, corner.precedance === X ? this._swapDimensions() : this._resetDimensions(), color = this.color = this._parseColours(corner), color[1] !== TRANSPARENT ? (border = this.border = this._parseWidth(corner, corner[corner.precedance]), options.border && 1 > border && !INVALID.test(color[1]) && (color[0] = color[1]), this.border = border = options.border !== TRUE ? options.border : border) : this.border = border = 0, newSize = this.size = this._calculateSize(corner), tip.css({
                        width: newSize[0],
                        height: newSize[1],
                        lineHeight: newSize[1] + "px"
                    }), translate = corner.precedance === Y ? [round(mimic.x === LEFT ? border : mimic.x === RIGHT ? newSize[0] - curSize[0] - border : (newSize[0] - curSize[0]) / 2), round(mimic.y === TOP ? newSize[1] - curSize[1] : 0)] : [round(mimic.x === LEFT ? newSize[0] - curSize[0] : 0), round(mimic.y === TOP ? border : mimic.y === BOTTOM ? newSize[1] - curSize[1] - border : (newSize[1] - curSize[1]) / 2)], HASCANVAS ? (context = inner[0].getContext("2d"), context.restore(), context.save(), context.clearRect(0, 0, 6e3, 6e3), coords = this._calculateTip(mimic, curSize, SCALE), bigCoords = this._calculateTip(mimic, this.size, SCALE), inner.attr(WIDTH, newSize[0] * SCALE).attr(HEIGHT, newSize[1] * SCALE), inner.css(WIDTH, newSize[0]).css(HEIGHT, newSize[1]), this._drawCoords(context, bigCoords), context.fillStyle = color[1], context.fill(), context.translate(translate[0] * SCALE, translate[1] * SCALE), this._drawCoords(context, coords), context.fillStyle = color[0], context.fill()) : (coords = this._calculateTip(mimic), coords = "m" + coords[0] + "," + coords[1] + " l" + coords[2] + "," + coords[3] + " " + coords[4] + "," + coords[5] + " xe", translate[2] = border && /^(r|b)/i.test(corner.string()) ? 8 === BROWSER.ie ? 2 : 1 : 0, inner.css({
                        coordsize: newSize[0] + border + " " + (newSize[1] + border),
                        antialias: "" + (mimic.string().indexOf(CENTER) > -1),
                        left: translate[0] - translate[2] * Number(precedance === X),
                        top: translate[1] - translate[2] * Number(precedance === Y),
                        width: newSize[0] + border,
                        height: newSize[1] + border
                    }).each(function(i) {
                        var $this = $(this);
                        $this[$this.prop ? "prop" : "attr"]({
                            coordsize: newSize[0] + border + " " + (newSize[1] + border),
                            path: coords,
                            fillcolor: color[0],
                            filled: !!i,
                            stroked: !i
                        }).toggle(!(!border && !i)), !i && $this.html(createVML("stroke", 'weight="' + 2 * border + 'px" color="' + color[1] + '" miterlimit="1000" joinstyle="miter"'))
                    })), window.opera && setTimeout(function() {
                        elements.tip.css({
                            display: "inline-block",
                            visibility: "visible"
                        })
                    }, 1), position !== FALSE && this.calculate(corner, newSize)
                },
                calculate: function(corner, size) {
                    if (!this.enabled) return FALSE;
                    var precedance, corners, self = this,
                        elements = this.qtip.elements,
                        tip = this.element,
                        userOffset = this.options.offset,
                        position = (elements.tooltip.hasClass("ui-widget"), {});
                    return corner = corner || this.corner, precedance = corner.precedance, size = size || this._calculateSize(corner), corners = [corner.x, corner.y], precedance === X && corners.reverse(), $.each(corners, function(i, side) {
                        var b, bc, br;
                        side === CENTER ? (b = precedance === Y ? LEFT : TOP, position[b] = "50%", position[MARGIN + "-" + b] = -Math.round(size[precedance === Y ? 0 : 1] / 2) + userOffset) : (b = self._parseWidth(corner, side, elements.tooltip), bc = self._parseWidth(corner, side, elements.content), br = self._parseRadius(corner), position[side] = Math.max(-self.border, i ? bc : userOffset + (br > b ? br : -b)))
                    }), position[corner[precedance]] -= size[precedance === X ? 0 : 1], tip.css({
                        margin: "",
                        top: "",
                        bottom: "",
                        left: "",
                        right: ""
                    }).css(position), position
                },
                reposition: function(event, api, pos, viewport) {
                    function shiftflip(direction, precedance, popposite, side, opposite) {
                        direction === SHIFT && newCorner.precedance === precedance && adjust[side] && newCorner[popposite] !== CENTER ? newCorner.precedance = newCorner.precedance === X ? Y : X : direction !== SHIFT && adjust[side] && (newCorner[precedance] = newCorner[precedance] === CENTER ? adjust[side] > 0 ? side : opposite : newCorner[precedance] === side ? opposite : side)
                    }

                    function shiftonly(xy, side, opposite) {
                        newCorner[xy] === CENTER ? css[MARGIN + "-" + side] = shift[xy] = offset[MARGIN + "-" + side] - adjust[side] : (props = offset[opposite] !== undefined ? [adjust[side], -offset[side]] : [-adjust[side], offset[side]], (shift[xy] = Math.max(props[0], props[1])) > props[0] && (pos[side] -= adjust[side], shift[side] = FALSE), css[offset[opposite] !== undefined ? opposite : side] = shift[xy])
                    }
                    if (this.enabled) {
                        var offset, props, cache = api.cache,
                            newCorner = this.corner.clone(),
                            adjust = pos.adjusted,
                            method = api.options.position.adjust.method.split(" "),
                            horizontal = method[0],
                            vertical = method[1] || method[0],
                            shift = {
                                left: FALSE,
                                top: FALSE,
                                x: 0,
                                y: 0
                            },
                            css = {};
                        this.corner.fixed !== TRUE && (shiftflip(horizontal, X, Y, LEFT, RIGHT), shiftflip(vertical, Y, X, TOP, BOTTOM), newCorner.string() === cache.corner.string() && cache.cornerTop === adjust.top && cache.cornerLeft === adjust.left || this.update(newCorner, FALSE)), offset = this.calculate(newCorner), offset.right !== undefined && (offset.left = -offset.right), offset.bottom !== undefined && (offset.top = -offset.bottom), offset.user = this.offset, (shift.left = horizontal === SHIFT && !!adjust.left) && shiftonly(X, LEFT, RIGHT), (shift.top = vertical === SHIFT && !!adjust.top) && shiftonly(Y, TOP, BOTTOM), this.element.css(css).toggle(!(shift.x && shift.y || newCorner.x === CENTER && shift.y || newCorner.y === CENTER && shift.x)), pos.left -= offset.left.charAt ? offset.user : horizontal !== SHIFT || shift.top || !shift.left && !shift.top ? offset.left + this.border : 0, pos.top -= offset.top.charAt ? offset.user : vertical !== SHIFT || shift.left || !shift.left && !shift.top ? offset.top + this.border : 0, cache.cornerLeft = adjust.left, cache.cornerTop = adjust.top, cache.corner = newCorner.clone()
                    }
                },
                destroy: function() {
                    this.qtip._unbind(this.qtip.tooltip, this._ns), this.qtip.elements.tip && this.qtip.elements.tip.find("*").remove().end().remove()
                }
            }), TIP = PLUGINS.tip = function(api) {
                return new Tip(api, api.options.style.tip)
            }, TIP.initialize = "render", TIP.sanitize = function(options) {
                if (options.style && "tip" in options.style) {
                    var opts = options.style.tip;
                    "object" != typeof opts && (opts = options.style.tip = {
                        corner: opts
                    }), /string|boolean/i.test(typeof opts.corner) || (opts.corner = TRUE)
                }
            }, CHECKS.tip = {
                "^position.my|style.tip.(corner|mimic|border)$": function() {
                    this.create(), this.qtip.reposition()
                },
                "^style.tip.(height|width)$": function(obj) {
                    this.size = [obj.width, obj.height], this.update(), this.qtip.reposition()
                },
                "^content.title|style.(classes|widget)$": function() {
                    this.update()
                }
            }, $.extend(TRUE, QTIP.defaults, {
                style: {
                    tip: {
                        corner: TRUE,
                        mimic: FALSE,
                        width: 6,
                        height: 6,
                        border: TRUE,
                        offset: 0
                    }
                }
            }), PLUGINS.viewport = function(api, position, posOptions, targetWidth, targetHeight, elemWidth, elemHeight) {
                function calculate(side, otherSide, type, adjust, side1, side2, lengthName, targetLength, elemLength) {
                    var initialPos = position[side1],
                        mySide = my[side],
                        atSide = at[side],
                        isShift = type === SHIFT,
                        myLength = mySide === side1 ? elemLength : mySide === side2 ? -elemLength : -elemLength / 2,
                        atLength = atSide === side1 ? targetLength : atSide === side2 ? -targetLength : -targetLength / 2,
                        sideOffset = viewportScroll[side1] + viewportOffset[side1] - (containerStatic ? 0 : containerOffset[side1]),
                        overflow1 = sideOffset - initialPos,
                        overflow2 = initialPos + elemLength - (lengthName === WIDTH ? viewportWidth : viewportHeight) - sideOffset,
                        offset = myLength - (my.precedance === side || mySide === my[otherSide] ? atLength : 0) - (atSide === CENTER ? targetLength / 2 : 0);
                    return isShift ? (offset = (mySide === side1 ? 1 : -1) * myLength, position[side1] += overflow1 > 0 ? overflow1 : overflow2 > 0 ? -overflow2 : 0, position[side1] = Math.max(-containerOffset[side1] + viewportOffset[side1], initialPos - offset, Math.min(Math.max(-containerOffset[side1] + viewportOffset[side1] + (lengthName === WIDTH ? viewportWidth : viewportHeight), initialPos + offset), position[side1], "center" === mySide ? initialPos - myLength : 1e9))) : (adjust *= type === FLIPINVERT ? 2 : 0, overflow1 > 0 && (mySide !== side1 || overflow2 > 0) ? (position[side1] -= offset + adjust, newMy.invert(side, side1)) : overflow2 > 0 && (mySide !== side2 || overflow1 > 0) && (position[side1] -= (mySide === CENTER ? -offset : offset) + adjust, newMy.invert(side, side2)), position[side1] < viewportScroll && -position[side1] > overflow2 && (position[side1] = initialPos, newMy = my.clone())), position[side1] - initialPos
                }
                var fixed, newMy, containerOffset, containerStatic, viewportWidth, viewportHeight, viewportScroll, viewportOffset, target = posOptions.target,
                    tooltip = api.elements.tooltip,
                    my = posOptions.my,
                    at = posOptions.at,
                    adjust = posOptions.adjust,
                    method = adjust.method.split(" "),
                    methodX = method[0],
                    methodY = method[1] || method[0],
                    viewport = posOptions.viewport,
                    container = posOptions.container,
                    adjusted = (api.cache, {
                        left: 0,
                        top: 0
                    });
                return viewport.jquery && target[0] !== window && target[0] !== document.body && "none" !== adjust.method ? (containerOffset = container.offset() || adjusted, containerStatic = "static" === container.css("position"), fixed = "fixed" === tooltip.css("position"), viewportWidth = viewport[0] === window ? viewport.width() : viewport.outerWidth(FALSE), viewportHeight = viewport[0] === window ? viewport.height() : viewport.outerHeight(FALSE), viewportScroll = {
                    left: fixed ? 0 : viewport.scrollLeft(),
                    top: fixed ? 0 : viewport.scrollTop()
                }, viewportOffset = viewport.offset() || adjusted, "shift" === methodX && "shift" === methodY || (newMy = my.clone()), adjusted = {
                    left: "none" !== methodX ? calculate(X, Y, methodX, adjust.x, LEFT, RIGHT, WIDTH, targetWidth, elemWidth) : 0,
                    top: "none" !== methodY ? calculate(Y, X, methodY, adjust.y, TOP, BOTTOM, HEIGHT, targetHeight, elemHeight) : 0,
                    my: newMy
                }) : adjusted
            };
            var MODAL, OVERLAY, MODALCLASS = "qtip-modal",
                MODALSELECTOR = "." + MODALCLASS;
            OVERLAY = function() {
                function focusable(element) {
                    if ($.expr[":"].focusable) return $.expr[":"].focusable;
                    var map, mapName, img, isTabIndexNotNaN = !isNaN($.attr(element, "tabindex")),
                        nodeName = element.nodeName && element.nodeName.toLowerCase();
                    return "area" === nodeName ? (map = element.parentNode, mapName = map.name, element.href && mapName && "map" === map.nodeName.toLowerCase() ? (img = $("img[usemap=#" + mapName + "]")[0], !!img && img.is(":visible")) : !1) : /input|select|textarea|button|object/.test(nodeName) ? !element.disabled : "a" === nodeName ? element.href || isTabIndexNotNaN : isTabIndexNotNaN
                }

                function focusInputs(blurElems) {
                    focusableElems.length < 1 && blurElems.length ? blurElems.not("body").blur() : focusableElems.first().focus()
                }

                function stealFocus(event) {
                    if (elem.is(":visible")) {
                        var targetOnTop, target = $(event.target),
                            tooltip = current.tooltip,
                            container = target.closest(SELECTOR);
                        targetOnTop = container.length < 1 ? FALSE : parseInt(container[0].style.zIndex, 10) > parseInt(tooltip[0].style.zIndex, 10), targetOnTop || target.closest(SELECTOR)[0] === tooltip[0] || focusInputs(target), onLast = event.target === focusableElems[focusableElems.length - 1]
                    }
                }
                var current, onLast, prevState, elem, self = this,
                    focusableElems = {};
                $.extend(self, {
                    init: function() {
                        return elem = self.elem = $("<div />", {
                            id: "qtip-overlay",
                            html: "<div></div>",
                            mousedown: function() {
                                return FALSE
                            }
                        }).hide(), $(document.body).bind("focusin" + MODALSELECTOR, stealFocus), $(document).bind("keydown" + MODALSELECTOR, function(event) {
                            current && current.options.show.modal.escape && 27 === event.keyCode && current.hide(event)
                        }), elem.bind("click" + MODALSELECTOR, function(event) {
                            current && current.options.show.modal.blur && current.hide(event)
                        }), self
                    },
                    update: function(api) {
                        current = api, focusableElems = api.options.show.modal.stealfocus !== FALSE ? api.tooltip.find("*").filter(function() {
                            return focusable(this)
                        }) : []
                    },
                    toggle: function(api, state, duration) {
                        var tooltip = ($(document.body), api.tooltip),
                            options = api.options.show.modal,
                            effect = options.effect,
                            type = state ? "show" : "hide",
                            visible = elem.is(":visible"),
                            visibleModals = $(MODALSELECTOR).filter(":visible:not(:animated)").not(tooltip);
                        return self.update(api), state && options.stealfocus !== FALSE && focusInputs($(":focus")), elem.toggleClass("blurs", options.blur), state && elem.appendTo(document.body), elem.is(":animated") && visible === state && prevState !== FALSE || !state && visibleModals.length ? self : (elem.stop(TRUE, FALSE), $.isFunction(effect) ? effect.call(elem, state) : effect === FALSE ? elem[type]() : elem.fadeTo(parseInt(duration, 10) || 90, state ? 1 : 0, function() {
                            state || elem.hide()
                        }), state || elem.queue(function(next) {
                            elem.css({
                                left: "",
                                top: ""
                            }), $(MODALSELECTOR).length || elem.detach(), next()
                        }), prevState = state, current.destroyed && (current = NULL), self)
                    }
                }), self.init()
            }, OVERLAY = new OVERLAY, $.extend(Modal.prototype, {
                init: function(qtip) {
                    var tooltip = qtip.tooltip;
                    return this.options.on ? (qtip.elements.overlay = OVERLAY.elem, tooltip.addClass(MODALCLASS).css("z-index", QTIP.modal_zindex + $(MODALSELECTOR).length), qtip._bind(tooltip, ["tooltipshow", "tooltiphide"], function(event, api, duration) {
                        var oEvent = event.originalEvent;
                        if (event.target === tooltip[0])
                            if (oEvent && "tooltiphide" === event.type && /mouse(leave|enter)/.test(oEvent.type) && $(oEvent.relatedTarget).closest(OVERLAY.elem[0]).length) try {
                                event.preventDefault()
                            } catch (e) {} else(!oEvent || oEvent && "tooltipsolo" !== oEvent.type) && this.toggle(event, "tooltipshow" === event.type, duration)
                    }, this._ns, this), qtip._bind(tooltip, "tooltipfocus", function(event, api) {
                        if (!event.isDefaultPrevented() && event.target === tooltip[0]) {
                            var qtips = $(MODALSELECTOR),
                                newIndex = QTIP.modal_zindex + qtips.length,
                                curIndex = parseInt(tooltip[0].style.zIndex, 10);
                            OVERLAY.elem[0].style.zIndex = newIndex - 1, qtips.each(function() {
                                this.style.zIndex > curIndex && (this.style.zIndex -= 1)
                            }), qtips.filter("." + CLASS_FOCUS).qtip("blur", event.originalEvent), tooltip.addClass(CLASS_FOCUS)[0].style.zIndex = newIndex, OVERLAY.update(api);
                            try {
                                event.preventDefault()
                            } catch (e) {}
                        }
                    }, this._ns, this), void qtip._bind(tooltip, "tooltiphide", function(event) {
                        event.target === tooltip[0] && $(MODALSELECTOR).filter(":visible").not(tooltip).last().qtip("focus", event)
                    }, this._ns, this)) : this
                },
                toggle: function(event, state, duration) {
                    return event && event.isDefaultPrevented() ? this : void OVERLAY.toggle(this.qtip, !!state, duration)
                },
                destroy: function() {
                    this.qtip.tooltip.removeClass(MODALCLASS), this.qtip._unbind(this.qtip.tooltip, this._ns), OVERLAY.toggle(this.qtip, FALSE), delete this.qtip.elements.overlay
                }
            }), MODAL = PLUGINS.modal = function(api) {
                return new Modal(api, api.options.show.modal)
            }, MODAL.sanitize = function(opts) {
                opts.show && ("object" != typeof opts.show.modal ? opts.show.modal = {
                    on: !!opts.show.modal
                } : "undefined" == typeof opts.show.modal.on && (opts.show.modal.on = TRUE))
            }, QTIP.modal_zindex = QTIP.zindex - 200, MODAL.initialize = "render", CHECKS.modal = {
                "^show.modal.(on|blur)$": function() {
                    this.destroy(), this.init(), this.qtip.elems.overlay.toggle(this.qtip.tooltip[0].offsetWidth > 0)
                }
            }, $.extend(TRUE, QTIP.defaults, {
                show: {
                    modal: {
                        on: FALSE,
                        effect: TRUE,
                        blur: TRUE,
                        stealfocus: TRUE,
                        escape: TRUE
                    }
                }
            })
        })
    }(window, document),
    function(window, doc) {
        function prefixStyle(style) {
            return "" === vendor ? style : (style = style.charAt(0).toUpperCase() + style.substr(1), vendor + style)
        }
        var m = Math,
            dummyStyle = doc.createElement("div").style,
            vendor = function() {
                for (var t, vendors = "t,webkitT,MozT,msT,OT".split(","), i = 0, l = vendors.length; l > i; i++)
                    if (t = vendors[i] + "ransform", t in dummyStyle) return vendors[i].substr(0, vendors[i].length - 1);
                return !1
            }(),
            cssVendor = vendor ? "-" + vendor.toLowerCase() + "-" : "",
            transform = prefixStyle("transform"),
            transitionProperty = prefixStyle("transitionProperty"),
            transitionDuration = prefixStyle("transitionDuration"),
            transformOrigin = prefixStyle("transformOrigin"),
            transitionTimingFunction = prefixStyle("transitionTimingFunction"),
            transitionDelay = prefixStyle("transitionDelay"),
            isAndroid = /android/gi.test(navigator.appVersion),
            isIDevice = /iphone|ipad/gi.test(navigator.appVersion),
            isTouchPad = /hp-tablet/gi.test(navigator.appVersion),
            has3d = prefixStyle("perspective") in dummyStyle,
            hasTouch = "ontouchstart" in window && !isTouchPad,
            hasTransform = vendor !== !1,
            hasTransitionEnd = prefixStyle("transition") in dummyStyle,
            RESIZE_EV = "onorientationchange" in window ? "orientationchange" : "resize",
            START_EV = hasTouch ? "touchstart" : "mousedown",
            MOVE_EV = hasTouch ? "touchmove" : "mousemove",
            END_EV = hasTouch ? "touchend" : "mouseup",
            CANCEL_EV = hasTouch ? "touchcancel" : "mouseup",
            TRNEND_EV = function() {
                if (vendor === !1) return !1;
                var transitionEnd = {
                    "": "transitionend",
                    webkit: "webkitTransitionEnd",
                    Moz: "transitionend",
                    O: "otransitionend",
                    ms: "MSTransitionEnd"
                };
                return transitionEnd[vendor]
            }(),
            nextFrame = function() {
                return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame || function(callback) {
                    return setTimeout(callback, 1)
                }
            }(),
            cancelFrame = function() {
                return window.cancelRequestAnimationFrame || window.webkitCancelAnimationFrame || window.webkitCancelRequestAnimationFrame || window.mozCancelRequestAnimationFrame || window.oCancelRequestAnimationFrame || window.msCancelRequestAnimationFrame || clearTimeout
            }(),
            translateZ = has3d ? " translateZ(0)" : "",
            iScroll = function(el, options) {
                var i, that = this;
                that.wrapper = "object" == typeof el ? el : doc.getElementById(el), that.wrapper.style.overflow = "hidden", that.scroller = that.wrapper.children[0], that.options = {
                    hScroll: !0,
                    vScroll: !0,
                    x: 0,
                    y: 0,
                    bounce: !0,
                    bounceLock: !1,
                    momentum: !0,
                    lockDirection: !0,
                    useTransform: !0,
                    useTransition: !1,
                    topOffset: 0,
                    checkDOMChanges: !1,
                    handleClick: !0,
                    hScrollbar: !0,
                    vScrollbar: !0,
                    fixedScrollbar: isAndroid,
                    hideScrollbar: isIDevice,
                    fadeScrollbar: isIDevice && has3d,
                    scrollbarClass: "",
                    zoom: !1,
                    zoomMin: 1,
                    zoomMax: 4,
                    doubleTapZoom: 2,
                    wheelAction: "scroll",
                    snap: !1,
                    snapThreshold: 1,
                    onRefresh: null,
                    onBeforeScrollStart: function(e) {
                        e.preventDefault()
                    },
                    onScrollStart: null,
                    onBeforeScrollMove: null,
                    onScrollMove: null,
                    onBeforeScrollEnd: null,
                    onScrollEnd: null,
                    onTouchEnd: null,
                    onDestroy: null,
                    onZoomStart: null,
                    onZoom: null,
                    onZoomEnd: null
                };
                for (i in options) that.options[i] = options[i];
                that.x = that.options.x, that.y = that.options.y, that.options.useTransform = hasTransform && that.options.useTransform, that.options.hScrollbar = that.options.hScroll && that.options.hScrollbar, that.options.vScrollbar = that.options.vScroll && that.options.vScrollbar, that.options.zoom = that.options.useTransform && that.options.zoom, that.options.useTransition = hasTransitionEnd && that.options.useTransition, that.options.zoom && isAndroid && (translateZ = ""), that.scroller.style[transitionProperty] = that.options.useTransform ? cssVendor + "transform" : "top left", that.scroller.style[transitionDuration] = "0", that.scroller.style[transformOrigin] = "0 0", that.options.useTransition && (that.scroller.style[transitionTimingFunction] = "cubic-bezier(0.33,0.66,0.66,1)"), that.options.useTransform ? that.scroller.style[transform] = "translate(" + that.x + "px," + that.y + "px)" + translateZ : that.scroller.style.cssText += ";position:absolute;top:" + that.y + "px;left:" + that.x + "px", that.options.useTransition && (that.options.fixedScrollbar = !0), that.refresh(), that._bind(RESIZE_EV, window), that._bind(START_EV), hasTouch || "none" != that.options.wheelAction && (that._bind("DOMMouseScroll"), that._bind("mousewheel")), that.options.checkDOMChanges && (that.checkDOMTime = setInterval(function() {
                    that._checkDOMChanges()
                }, 500))
            };
        iScroll.prototype = {
            enabled: !0,
            x: 0,
            y: 0,
            steps: [],
            scale: 1,
            currPageX: 0,
            currPageY: 0,
            pagesX: [],
            pagesY: [],
            aniTime: null,
            wheelZoomCount: 0,
            handleEvent: function(e) {
                var that = this;
                switch (e.type) {
                    case START_EV:
                        if (!hasTouch && 0 !== e.button) return;
                        that._start(e);
                        break;
                    case MOVE_EV:
                        that._move(e);
                        break;
                    case END_EV:
                    case CANCEL_EV:
                        that._end(e);
                        break;
                    case RESIZE_EV:
                        that._resize();
                        break;
                    case "DOMMouseScroll":
                    case "mousewheel":
                        that._wheel(e);
                        break;
                    case TRNEND_EV:
                        that._transitionEnd(e)
                }
            },
            _checkDOMChanges: function() {
                this.moved || this.zoomed || this.animating || this.scrollerW == this.scroller.offsetWidth * this.scale && this.scrollerH == this.scroller.offsetHeight * this.scale || this.refresh()
            },
            _scrollbar: function(dir) {
                var bar, that = this;
                return that[dir + "Scrollbar"] ? (that[dir + "ScrollbarWrapper"] || (bar = doc.createElement("div"), that.options.scrollbarClass ? bar.className = that.options.scrollbarClass + dir.toUpperCase() : bar.style.cssText = "position:absolute;z-index:100;" + ("h" == dir ? "height:7px;bottom:1px;left:2px;right:" + (that.vScrollbar ? "7" : "2") + "px" : "width:7px;bottom:" + (that.hScrollbar ? "7" : "2") + "px;top:2px;right:1px"), bar.style.cssText += ";pointer-events:none;" + cssVendor + "transition-property:opacity;" + cssVendor + "transition-duration:" + (that.options.fadeScrollbar ? "350ms" : "0") + ";overflow:hidden;opacity:" + (that.options.hideScrollbar ? "0" : "1"), that.wrapper.appendChild(bar), that[dir + "ScrollbarWrapper"] = bar, bar = doc.createElement("div"), that.options.scrollbarClass || (bar.style.cssText = "position:absolute;z-index:100;background:rgba(0,0,0,0.5);border:1px solid rgba(255,255,255,0.9);" + cssVendor + "background-clip:padding-box;" + cssVendor + "box-sizing:border-box;" + ("h" == dir ? "height:100%" : "width:100%") + ";" + cssVendor + "border-radius:3px;border-radius:3px"), bar.style.cssText += ";pointer-events:none;" + cssVendor + "transition-property:" + cssVendor + "transform;" + cssVendor + "transition-timing-function:cubic-bezier(0.33,0.66,0.66,1);" + cssVendor + "transition-duration:0;" + cssVendor + "transform: translate(0,0)" + translateZ, that.options.useTransition && (bar.style.cssText += ";" + cssVendor + "transition-timing-function:cubic-bezier(0.33,0.66,0.66,1)"), that[dir + "ScrollbarWrapper"].appendChild(bar), that[dir + "ScrollbarIndicator"] = bar), "h" == dir ? (that.hScrollbarSize = that.hScrollbarWrapper.clientWidth,
                    that.hScrollbarIndicatorSize = m.max(m.round(that.hScrollbarSize * that.hScrollbarSize / that.scrollerW), 8), that.hScrollbarIndicator.style.width = that.hScrollbarIndicatorSize + "px", that.hScrollbarMaxScroll = that.hScrollbarSize - that.hScrollbarIndicatorSize, that.hScrollbarProp = that.hScrollbarMaxScroll / that.maxScrollX) : (that.vScrollbarSize = that.vScrollbarWrapper.clientHeight, that.vScrollbarIndicatorSize = m.max(m.round(that.vScrollbarSize * that.vScrollbarSize / that.scrollerH), 8), that.vScrollbarIndicator.style.height = that.vScrollbarIndicatorSize + "px", that.vScrollbarMaxScroll = that.vScrollbarSize - that.vScrollbarIndicatorSize, that.vScrollbarProp = that.vScrollbarMaxScroll / that.maxScrollY), void that._scrollbarPos(dir, !0)) : void(that[dir + "ScrollbarWrapper"] && (hasTransform && (that[dir + "ScrollbarIndicator"].style[transform] = ""), that[dir + "ScrollbarWrapper"].parentNode.removeChild(that[dir + "ScrollbarWrapper"]), that[dir + "ScrollbarWrapper"] = null, that[dir + "ScrollbarIndicator"] = null))
            },
            _resize: function() {
                var that = this;
                setTimeout(function() {
                    that.refresh()
                }, isAndroid ? 200 : 0)
            },
            _pos: function(x, y) {
                this.zoomed || (x = this.hScroll ? x : 0, y = this.vScroll ? y : 0, this.options.useTransform ? this.scroller.style[transform] = "translate(" + x + "px," + y + "px) scale(" + this.scale + ")" + translateZ : (x = m.round(x), y = m.round(y), this.scroller.style.left = x + "px", this.scroller.style.top = y + "px"), this.x = x, this.y = y, this._scrollbarPos("h"), this._scrollbarPos("v"))
            },
            _scrollbarPos: function(dir, hidden) {
                var size, that = this,
                    pos = "h" == dir ? that.x : that.y;
                that[dir + "Scrollbar"] && (pos = that[dir + "ScrollbarProp"] * pos, 0 > pos ? (that.options.fixedScrollbar || (size = that[dir + "ScrollbarIndicatorSize"] + m.round(3 * pos), 8 > size && (size = 8), that[dir + "ScrollbarIndicator"].style["h" == dir ? "width" : "height"] = size + "px"), pos = 0) : pos > that[dir + "ScrollbarMaxScroll"] && (that.options.fixedScrollbar ? pos = that[dir + "ScrollbarMaxScroll"] : (size = that[dir + "ScrollbarIndicatorSize"] - m.round(3 * (pos - that[dir + "ScrollbarMaxScroll"])), 8 > size && (size = 8), that[dir + "ScrollbarIndicator"].style["h" == dir ? "width" : "height"] = size + "px", pos = that[dir + "ScrollbarMaxScroll"] + (that[dir + "ScrollbarIndicatorSize"] - size))), that[dir + "ScrollbarWrapper"].style[transitionDelay] = "0", that[dir + "ScrollbarWrapper"].style.opacity = hidden && that.options.hideScrollbar ? "0" : "1", that[dir + "ScrollbarIndicator"].style[transform] = "translate(" + ("h" == dir ? pos + "px,0)" : "0," + pos + "px)") + translateZ)
            },
            _start: function(e) {
                var matrix, x, y, c1, c2, that = this,
                    point = hasTouch ? e.touches[0] : e;
                that.enabled && (that.options.onBeforeScrollStart && that.options.onBeforeScrollStart.call(that, e), (that.options.useTransition || that.options.zoom) && that._transitionTime(0), that.moved = !1, that.animating = !1, that.zoomed = !1, that.distX = 0, that.distY = 0, that.absDistX = 0, that.absDistY = 0, that.dirX = 0, that.dirY = 0, that.options.zoom && hasTouch && e.touches.length > 1 && (c1 = m.abs(e.touches[0].pageX - e.touches[1].pageX), c2 = m.abs(e.touches[0].pageY - e.touches[1].pageY), that.touchesDistStart = m.sqrt(c1 * c1 + c2 * c2), that.originX = m.abs(e.touches[0].pageX + e.touches[1].pageX - 2 * that.wrapperOffsetLeft) / 2 - that.x, that.originY = m.abs(e.touches[0].pageY + e.touches[1].pageY - 2 * that.wrapperOffsetTop) / 2 - that.y, that.options.onZoomStart && that.options.onZoomStart.call(that, e)), that.options.momentum && (that.options.useTransform ? (matrix = getComputedStyle(that.scroller, null)[transform].replace(/[^0-9\-.,]/g, "").split(","), x = +(matrix[12] || matrix[4]), y = +(matrix[13] || matrix[5])) : (x = +getComputedStyle(that.scroller, null).left.replace(/[^0-9-]/g, ""), y = +getComputedStyle(that.scroller, null).top.replace(/[^0-9-]/g, "")), x == that.x && y == that.y || (that.options.useTransition ? that._unbind(TRNEND_EV) : cancelFrame(that.aniTime), that.steps = [], that._pos(x, y), that.options.onScrollEnd && that.options.onScrollEnd.call(that))), that.absStartX = that.x, that.absStartY = that.y, that.startX = that.x, that.startY = that.y, that.pointX = point.pageX, that.pointY = point.pageY, that.startTime = e.timeStamp || Date.now(), that.options.onScrollStart && that.options.onScrollStart.call(that, e), that._bind(MOVE_EV, window), that._bind(END_EV, window), that._bind(CANCEL_EV, window))
            },
            _move: function(e) {
                var c1, c2, scale, that = this,
                    point = hasTouch ? e.touches[0] : e,
                    deltaX = point.pageX - that.pointX,
                    deltaY = point.pageY - that.pointY,
                    newX = that.x + deltaX,
                    newY = that.y + deltaY,
                    timestamp = e.timeStamp || Date.now();
                return that.options.onBeforeScrollMove && that.options.onBeforeScrollMove.call(that, e), that.options.zoom && hasTouch && e.touches.length > 1 ? (c1 = m.abs(e.touches[0].pageX - e.touches[1].pageX), c2 = m.abs(e.touches[0].pageY - e.touches[1].pageY), that.touchesDist = m.sqrt(c1 * c1 + c2 * c2), that.zoomed = !0, scale = 1 / that.touchesDistStart * that.touchesDist * this.scale, scale < that.options.zoomMin ? scale = .5 * that.options.zoomMin * Math.pow(2, scale / that.options.zoomMin) : scale > that.options.zoomMax && (scale = 2 * that.options.zoomMax * Math.pow(.5, that.options.zoomMax / scale)), that.lastScale = scale / this.scale, newX = this.originX - this.originX * that.lastScale + this.x, newY = this.originY - this.originY * that.lastScale + this.y, this.scroller.style[transform] = "translate(" + newX + "px," + newY + "px) scale(" + scale + ")" + translateZ, void(that.options.onZoom && that.options.onZoom.call(that, e))) : (that.pointX = point.pageX, that.pointY = point.pageY, (newX > 0 || newX < that.maxScrollX) && (newX = that.options.bounce ? that.x + deltaX / 2 : newX >= 0 || that.maxScrollX >= 0 ? 0 : that.maxScrollX), (newY > that.minScrollY || newY < that.maxScrollY) && (newY = that.options.bounce ? that.y + deltaY / 2 : newY >= that.minScrollY || that.maxScrollY >= 0 ? that.minScrollY : that.maxScrollY), that.distX += deltaX, that.distY += deltaY, that.absDistX = m.abs(that.distX), that.absDistY = m.abs(that.distY), void(that.absDistX < 6 && that.absDistY < 6 || (that.options.lockDirection && (that.absDistX > that.absDistY + 5 ? (newY = that.y, deltaY = 0) : that.absDistY > that.absDistX + 5 && (newX = that.x, deltaX = 0)), that.moved = !0, that._pos(newX, newY), that.dirX = deltaX > 0 ? -1 : 0 > deltaX ? 1 : 0, that.dirY = deltaY > 0 ? -1 : 0 > deltaY ? 1 : 0, timestamp - that.startTime > 300 && (that.startTime = timestamp, that.startX = that.x, that.startY = that.y), that.options.onScrollMove && that.options.onScrollMove.call(that, e))))
            },
            _end: function(e) {
                if (!hasTouch || 0 === e.touches.length) {
                    var target, ev, distX, distY, newDuration, snap, scale, that = this,
                        point = hasTouch ? e.changedTouches[0] : e,
                        momentumX = {
                            dist: 0,
                            time: 0
                        },
                        momentumY = {
                            dist: 0,
                            time: 0
                        },
                        duration = (e.timeStamp || Date.now()) - that.startTime,
                        newPosX = that.x,
                        newPosY = that.y;
                    if (that._unbind(MOVE_EV, window), that._unbind(END_EV, window), that._unbind(CANCEL_EV, window), that.options.onBeforeScrollEnd && that.options.onBeforeScrollEnd.call(that, e), that.zoomed) return scale = that.scale * that.lastScale, scale = Math.max(that.options.zoomMin, scale), scale = Math.min(that.options.zoomMax, scale), that.lastScale = scale / that.scale, that.scale = scale, that.x = that.originX - that.originX * that.lastScale + that.x, that.y = that.originY - that.originY * that.lastScale + that.y, that.scroller.style[transitionDuration] = "200ms", that.scroller.style[transform] = "translate(" + that.x + "px," + that.y + "px) scale(" + that.scale + ")" + translateZ, that.zoomed = !1, that.refresh(), void(that.options.onZoomEnd && that.options.onZoomEnd.call(that, e));
                    if (!that.moved) return hasTouch && (that.doubleTapTimer && that.options.zoom ? (clearTimeout(that.doubleTapTimer), that.doubleTapTimer = null, that.options.onZoomStart && that.options.onZoomStart.call(that, e), that.zoom(that.pointX, that.pointY, 1 == that.scale ? that.options.doubleTapZoom : 1), that.options.onZoomEnd && setTimeout(function() {
                        that.options.onZoomEnd.call(that, e)
                    }, 200)) : this.options.handleClick && (that.doubleTapTimer = setTimeout(function() {
                        for (that.doubleTapTimer = null, target = point.target; 1 != target.nodeType;) target = target.parentNode;
                        "SELECT" != target.tagName && "INPUT" != target.tagName && "TEXTAREA" != target.tagName && (ev = doc.createEvent("MouseEvents"), ev.initMouseEvent("click", !0, !0, e.view, 1, point.screenX, point.screenY, point.clientX, point.clientY, e.ctrlKey, e.altKey, e.shiftKey, e.metaKey, 0, null), ev._fake = !0, target.dispatchEvent(ev))
                    }, that.options.zoom ? 250 : 0))), that._resetPos(400), void(that.options.onTouchEnd && that.options.onTouchEnd.call(that, e));
                    if (300 > duration && that.options.momentum && (momentumX = newPosX ? that._momentum(newPosX - that.startX, duration, -that.x, that.scrollerW - that.wrapperW + that.x, that.options.bounce ? that.wrapperW : 0) : momentumX, momentumY = newPosY ? that._momentum(newPosY - that.startY, duration, -that.y, that.maxScrollY < 0 ? that.scrollerH - that.wrapperH + that.y - that.minScrollY : 0, that.options.bounce ? that.wrapperH : 0) : momentumY, newPosX = that.x + momentumX.dist, newPosY = that.y + momentumY.dist, (that.x > 0 && newPosX > 0 || that.x < that.maxScrollX && newPosX < that.maxScrollX) && (momentumX = {
                            dist: 0,
                            time: 0
                        }), (that.y > that.minScrollY && newPosY > that.minScrollY || that.y < that.maxScrollY && newPosY < that.maxScrollY) && (momentumY = {
                            dist: 0,
                            time: 0
                        })), momentumX.dist || momentumY.dist) return newDuration = m.max(m.max(momentumX.time, momentumY.time), 10), that.options.snap && (distX = newPosX - that.absStartX, distY = newPosY - that.absStartY, m.abs(distX) < that.options.snapThreshold && m.abs(distY) < that.options.snapThreshold ? that.scrollTo(that.absStartX, that.absStartY, 200) : (snap = that._snap(newPosX, newPosY), newPosX = snap.x, newPosY = snap.y, newDuration = m.max(snap.time, newDuration))), that.scrollTo(m.round(newPosX), m.round(newPosY), newDuration), void(that.options.onTouchEnd && that.options.onTouchEnd.call(that, e));
                    if (that.options.snap) return distX = newPosX - that.absStartX, distY = newPosY - that.absStartY, m.abs(distX) < that.options.snapThreshold && m.abs(distY) < that.options.snapThreshold ? that.scrollTo(that.absStartX, that.absStartY, 200) : (snap = that._snap(that.x, that.y), snap.x == that.x && snap.y == that.y || that.scrollTo(snap.x, snap.y, snap.time)), void(that.options.onTouchEnd && that.options.onTouchEnd.call(that, e));
                    that._resetPos(200), that.options.onTouchEnd && that.options.onTouchEnd.call(that, e)
                }
            },
            _resetPos: function(time) {
                var that = this,
                    resetX = that.x >= 0 ? 0 : that.x < that.maxScrollX ? that.maxScrollX : that.x,
                    resetY = that.y >= that.minScrollY || that.maxScrollY > 0 ? that.minScrollY : that.y < that.maxScrollY ? that.maxScrollY : that.y;
                return resetX == that.x && resetY == that.y ? (that.moved && (that.moved = !1, that.options.onScrollEnd && that.options.onScrollEnd.call(that)), that.hScrollbar && that.options.hideScrollbar && ("webkit" == vendor && (that.hScrollbarWrapper.style[transitionDelay] = "300ms"), that.hScrollbarWrapper.style.opacity = "0"), void(that.vScrollbar && that.options.hideScrollbar && ("webkit" == vendor && (that.vScrollbarWrapper.style[transitionDelay] = "300ms"), that.vScrollbarWrapper.style.opacity = "0"))) : void that.scrollTo(resetX, resetY, time || 0)
            },
            _wheel: function(e) {
                var wheelDeltaX, wheelDeltaY, deltaX, deltaY, deltaScale, that = this;
                if ("wheelDeltaX" in e) wheelDeltaX = e.wheelDeltaX / 12, wheelDeltaY = e.wheelDeltaY / 12;
                else if ("wheelDelta" in e) wheelDeltaX = wheelDeltaY = e.wheelDelta / 12;
                else {
                    if (!("detail" in e)) return;
                    wheelDeltaX = wheelDeltaY = 3 * -e.detail
                }
                return "zoom" == that.options.wheelAction ? (deltaScale = that.scale * Math.pow(2, 1 / 3 * (wheelDeltaY ? wheelDeltaY / Math.abs(wheelDeltaY) : 0)), deltaScale < that.options.zoomMin && (deltaScale = that.options.zoomMin), deltaScale > that.options.zoomMax && (deltaScale = that.options.zoomMax), void(deltaScale != that.scale && (!that.wheelZoomCount && that.options.onZoomStart && that.options.onZoomStart.call(that, e), that.wheelZoomCount++, that.zoom(e.pageX, e.pageY, deltaScale, 400), setTimeout(function() {
                    that.wheelZoomCount--, !that.wheelZoomCount && that.options.onZoomEnd && that.options.onZoomEnd.call(that, e)
                }, 400)))) : (deltaX = that.x + wheelDeltaX, deltaY = that.y + wheelDeltaY, deltaX > 0 ? deltaX = 0 : deltaX < that.maxScrollX && (deltaX = that.maxScrollX), deltaY > that.minScrollY ? deltaY = that.minScrollY : deltaY < that.maxScrollY && (deltaY = that.maxScrollY), void(that.maxScrollY < 0 && that.scrollTo(deltaX, deltaY, 0)))
            },
            _transitionEnd: function(e) {
                var that = this;
                e.target == that.scroller && (that._unbind(TRNEND_EV), that._startAni())
            },
            _startAni: function() {
                var step, easeOut, animate, that = this,
                    startX = that.x,
                    startY = that.y,
                    startTime = Date.now();
                if (!that.animating) {
                    if (!that.steps.length) return void that._resetPos(400);
                    if (step = that.steps.shift(), step.x == startX && step.y == startY && (step.time = 0), that.animating = !0, that.moved = !0, that.options.useTransition) return that._transitionTime(step.time), that._pos(step.x, step.y), that.animating = !1, void(step.time ? that._bind(TRNEND_EV) : that._resetPos(0));
                    animate = function() {
                        var newX, newY, now = Date.now();
                        return now >= startTime + step.time ? (that._pos(step.x, step.y), that.animating = !1, that.options.onAnimationEnd && that.options.onAnimationEnd.call(that), void that._startAni()) : (now = (now - startTime) / step.time - 1, easeOut = m.sqrt(1 - now * now), newX = (step.x - startX) * easeOut + startX, newY = (step.y - startY) * easeOut + startY, that._pos(newX, newY), void(that.animating && (that.aniTime = nextFrame(animate))))
                    }, animate()
                }
            },
            _transitionTime: function(time) {
                time += "ms", this.scroller.style[transitionDuration] = time, this.hScrollbar && (this.hScrollbarIndicator.style[transitionDuration] = time), this.vScrollbar && (this.vScrollbarIndicator.style[transitionDuration] = time)
            },
            _momentum: function(dist, time, maxDistUpper, maxDistLower, size) {
                var deceleration = 6e-4,
                    speed = m.abs(dist) / time,
                    newDist = speed * speed / (2 * deceleration),
                    newTime = 0,
                    outsideDist = 0;
                return dist > 0 && newDist > maxDistUpper ? (outsideDist = size / (6 / (newDist / speed * deceleration)), maxDistUpper += outsideDist, speed = speed * maxDistUpper / newDist, newDist = maxDistUpper) : 0 > dist && newDist > maxDistLower && (outsideDist = size / (6 / (newDist / speed * deceleration)), maxDistLower += outsideDist, speed = speed * maxDistLower / newDist, newDist = maxDistLower), newDist *= 0 > dist ? -1 : 1, newTime = speed / deceleration, {
                    dist: newDist,
                    time: m.round(newTime)
                }
            },
            _offset: function(el) {
                for (var left = -el.offsetLeft, top = -el.offsetTop; el = el.offsetParent;) left -= el.offsetLeft, top -= el.offsetTop;
                return el != this.wrapper && (left *= this.scale, top *= this.scale), {
                    left: left,
                    top: top
                }
            },
            _snap: function(x, y) {
                var i, l, page, time, sizeX, sizeY, that = this;
                for (page = that.pagesX.length - 1, i = 0, l = that.pagesX.length; l > i; i++)
                    if (x >= that.pagesX[i]) {
                        page = i;
                        break
                    }
                for (page == that.currPageX && page > 0 && that.dirX < 0 && page--, x = that.pagesX[page], sizeX = m.abs(x - that.pagesX[that.currPageX]), sizeX = sizeX ? m.abs(that.x - x) / sizeX * 500 : 0, that.currPageX = page, page = that.pagesY.length - 1, i = 0; page > i; i++)
                    if (y >= that.pagesY[i]) {
                        page = i;
                        break
                    }
                return page == that.currPageY && page > 0 && that.dirY < 0 && page--, y = that.pagesY[page], sizeY = m.abs(y - that.pagesY[that.currPageY]), sizeY = sizeY ? m.abs(that.y - y) / sizeY * 500 : 0, that.currPageY = page, time = m.round(m.max(sizeX, sizeY)) || 200, {
                    x: x,
                    y: y,
                    time: time
                }
            },
            _bind: function(type, el, bubble) {
                (el || this.scroller).addEventListener(type, this, !!bubble)
            },
            _unbind: function(type, el, bubble) {
                (el || this.scroller).removeEventListener(type, this, !!bubble)
            },
            destroy: function() {
                var that = this;
                that.scroller.style[transform] = "", that.hScrollbar = !1, that.vScrollbar = !1, that._scrollbar("h"), that._scrollbar("v"), that._unbind(RESIZE_EV, window), that._unbind(START_EV), that._unbind(MOVE_EV, window), that._unbind(END_EV, window), that._unbind(CANCEL_EV, window), that.options.hasTouch || (that._unbind("DOMMouseScroll"), that._unbind("mousewheel")), that.options.useTransition && that._unbind(TRNEND_EV), that.options.checkDOMChanges && clearInterval(that.checkDOMTime), that.options.onDestroy && that.options.onDestroy.call(that)
            },
            refresh: function() {
                var offset, i, l, els, that = this,
                    pos = 0,
                    page = 0;
                if (that.scale < that.options.zoomMin && (that.scale = that.options.zoomMin), that.wrapperW = that.wrapper.clientWidth || 1, that.wrapperH = that.wrapper.clientHeight || 1, that.minScrollY = -that.options.topOffset || 0, that.scrollerW = m.round(that.scroller.offsetWidth * that.scale), that.scrollerH = m.round((that.scroller.offsetHeight + that.minScrollY) * that.scale), that.maxScrollX = that.wrapperW - that.scrollerW, that.maxScrollY = that.wrapperH - that.scrollerH + that.minScrollY, that.dirX = 0, that.dirY = 0, that.options.onRefresh && that.options.onRefresh.call(that), that.hScroll = that.options.hScroll && that.maxScrollX < 0, that.vScroll = that.options.vScroll && (!that.options.bounceLock && !that.hScroll || that.scrollerH > that.wrapperH), that.hScrollbar = that.hScroll && that.options.hScrollbar, that.vScrollbar = that.vScroll && that.options.vScrollbar && that.scrollerH > that.wrapperH, offset = that._offset(that.wrapper), that.wrapperOffsetLeft = -offset.left, that.wrapperOffsetTop = -offset.top, "string" == typeof that.options.snap)
                    for (that.pagesX = [], that.pagesY = [], els = that.scroller.querySelectorAll(that.options.snap), i = 0, l = els.length; l > i; i++) pos = that._offset(els[i]), pos.left += that.wrapperOffsetLeft, pos.top += that.wrapperOffsetTop, that.pagesX[i] = pos.left < that.maxScrollX ? that.maxScrollX : pos.left * that.scale, that.pagesY[i] = pos.top < that.maxScrollY ? that.maxScrollY : pos.top * that.scale;
                else if (that.options.snap) {
                    for (that.pagesX = []; pos >= that.maxScrollX;) that.pagesX[page] = pos, pos -= that.wrapperW, page++;
                    for (that.maxScrollX % that.wrapperW && (that.pagesX[that.pagesX.length] = that.maxScrollX - that.pagesX[that.pagesX.length - 1] + that.pagesX[that.pagesX.length - 1]), pos = 0, page = 0, that.pagesY = []; pos >= that.maxScrollY;) that.pagesY[page] = pos, pos -= that.wrapperH, page++;
                    that.maxScrollY % that.wrapperH && (that.pagesY[that.pagesY.length] = that.maxScrollY - that.pagesY[that.pagesY.length - 1] + that.pagesY[that.pagesY.length - 1])
                }
                that._scrollbar("h"), that._scrollbar("v"), that.zoomed || (that.scroller.style[transitionDuration] = "0", that._resetPos(400))
            },
            scrollTo: function(x, y, time, relative) {
                var i, l, that = this,
                    step = x;
                for (that.stop(), step.length || (step = [{
                        x: x,
                        y: y,
                        time: time,
                        relative: relative
                    }]), i = 0, l = step.length; l > i; i++) step[i].relative && (step[i].x = that.x - step[i].x, step[i].y = that.y - step[i].y), that.steps.push({
                    x: step[i].x,
                    y: step[i].y,
                    time: step[i].time || 0
                });
                that._startAni()
            },
            scrollToElement: function(el, time) {
                var pos, that = this;
                el = el.nodeType ? el : that.scroller.querySelector(el), el && (pos = that._offset(el), pos.left += that.wrapperOffsetLeft, pos.top += that.wrapperOffsetTop, pos.left = pos.left > 0 ? 0 : pos.left < that.maxScrollX ? that.maxScrollX : pos.left, pos.top = pos.top > that.minScrollY ? that.minScrollY : pos.top < that.maxScrollY ? that.maxScrollY : pos.top, time = void 0 === time ? m.max(2 * m.abs(pos.left), 2 * m.abs(pos.top)) : time, that.scrollTo(pos.left, pos.top, time))
            },
            scrollToPage: function(pageX, pageY, time) {
                var x, y, that = this;
                time = void 0 === time ? 400 : time, that.options.onScrollStart && that.options.onScrollStart.call(that), that.options.snap ? (pageX = "next" == pageX ? that.currPageX + 1 : "prev" == pageX ? that.currPageX - 1 : pageX, pageY = "next" == pageY ? that.currPageY + 1 : "prev" == pageY ? that.currPageY - 1 : pageY, pageX = 0 > pageX ? 0 : pageX > that.pagesX.length - 1 ? that.pagesX.length - 1 : pageX, pageY = 0 > pageY ? 0 : pageY > that.pagesY.length - 1 ? that.pagesY.length - 1 : pageY, that.currPageX = pageX, that.currPageY = pageY, x = that.pagesX[pageX], y = that.pagesY[pageY]) : (x = -that.wrapperW * pageX, y = -that.wrapperH * pageY, x < that.maxScrollX && (x = that.maxScrollX), y < that.maxScrollY && (y = that.maxScrollY)), that.scrollTo(x, y, time)
            },
            disable: function() {
                this.stop(), this._resetPos(0), this.enabled = !1, this._unbind(MOVE_EV, window), this._unbind(END_EV, window), this._unbind(CANCEL_EV, window)
            },
            enable: function() {
                this.enabled = !0
            },
            stop: function() {
                this.options.useTransition ? this._unbind(TRNEND_EV) : cancelFrame(this.aniTime), this.steps = [], this.moved = !1, this.animating = !1
            },
            zoom: function(x, y, scale, time) {
                var that = this,
                    relScale = scale / that.scale;
                that.options.useTransform && (that.zoomed = !0, time = void 0 === time ? 200 : time, x = x - that.wrapperOffsetLeft - that.x, y = y - that.wrapperOffsetTop - that.y, that.x = x - x * relScale + that.x, that.y = y - y * relScale + that.y, that.scale = scale, that.refresh(), that.x = that.x > 0 ? 0 : that.x < that.maxScrollX ? that.maxScrollX : that.x, that.y = that.y > that.minScrollY ? that.minScrollY : that.y < that.maxScrollY ? that.maxScrollY : that.y, that.scroller.style[transitionDuration] = time + "ms", that.scroller.style[transform] = "translate(" + that.x + "px," + that.y + "px) scale(" + scale + ")" + translateZ, that.zoomed = !1)
            },
            isReady: function() {
                return !this.moved && !this.zoomed && !this.animating
            }
        }, dummyStyle = null, "undefined" != typeof exports ? exports.iScroll = iScroll : window.iScroll = iScroll
    }(window, document),
    function(global, factory) {
        "function" == typeof define && define.amd ? define(["jquery"], function(jQuery) {
            return factory(global, jQuery)
        }) : "object" == typeof exports ? factory(global, require("jquery")) : factory(global, global.jQuery)
    }("undefined" != typeof window ? window : this, function(window, $) {
        "use strict";
        var list = "over out down up move enter leave cancel".split(" "),
            hook = $.extend({}, $.event.mouseHooks),
            events = {};
        if (window.PointerEvent) $.each(list, function(i, name) {
            $.event.fixHooks[events[name] = "pointer" + name] = hook
        });
        else {
            var mouseProps = hook.props;
            hook.props = mouseProps.concat(["touches", "changedTouches", "targetTouches", "altKey", "ctrlKey", "metaKey", "shiftKey"]), hook.filter = function(event, originalEvent) {
                var touch, i = mouseProps.length;
                if (!originalEvent.pageX && originalEvent.touches && (touch = originalEvent.touches[0]))
                    for (; i--;) event[mouseProps[i]] = touch[mouseProps[i]];
                return event
            }, $.each(list, function(i, name) {
                if (2 > i) events[name] = "mouse" + name;
                else {
                    var touch = "touch" + ("down" === name ? "start" : "up" === name ? "end" : name);
                    $.event.fixHooks[touch] = hook, events[name] = touch + " mouse" + name
                }
            })
        }
        return $.pointertouch = events, events
    });
var libFuncName = null;
if ("undefined" == typeof jQuery && "undefined" == typeof Zepto && "function" == typeof $) libFuncName = $;
else if ("function" == typeof jQuery) libFuncName = jQuery;
else {
    if ("function" != typeof Zepto) throw new TypeError;
    libFuncName = Zepto
}! function($, window, document, undefined) {
    "use strict";
    $("head").append('<meta class="foundation-mq-small">'), $("head").append('<meta class="foundation-mq-medium">'), $("head").append('<meta class="foundation-mq-large">'), window.matchMedia = window.matchMedia || function(doc, undefined) {
        var bool, docElem = doc.documentElement,
            refNode = docElem.firstElementChild || docElem.firstChild,
            fakeBody = doc.createElement("body"),
            div = doc.createElement("div");
        return div.id = "mq-test-1", div.style.cssText = "position:absolute;top:-100em", fakeBody.style.background = "none", fakeBody.appendChild(div),
            function(q) {
                return div.innerHTML = '&shy;<style media="' + q + '"> #mq-test-1 { width: 42px; }</style>', docElem.insertBefore(fakeBody, refNode), bool = 42 === div.offsetWidth, docElem.removeChild(fakeBody), {
                    matches: bool,
                    media: q
                }
            }
    }(document), Array.prototype.filter || (Array.prototype.filter = function(fun) {
        if (null == this) throw new TypeError;
        var t = Object(this),
            len = t.length >>> 0;
        if ("function" == typeof fun) {
            for (var res = [], thisp = arguments[1], i = 0; len > i; i++)
                if (i in t) {
                    var val = t[i];
                    fun && fun.call(thisp, val, i, t) && res.push(val)
                }
            return res
        }
    }), Function.prototype.bind || (Function.prototype.bind = function(oThis) {
        if ("function" != typeof this) throw new TypeError("Function.prototype.bind - what is trying to be bound is not callable");
        var aArgs = Array.prototype.slice.call(arguments, 1),
            fToBind = this,
            fNOP = function() {},
            fBound = function() {
                return fToBind.apply(this instanceof fNOP && oThis ? this : oThis, aArgs.concat(Array.prototype.slice.call(arguments)))
            };
        return fNOP.prototype = this.prototype, fBound.prototype = new fNOP, fBound
    }), Array.prototype.indexOf || (Array.prototype.indexOf = function(searchElement) {
        if (null == this) throw new TypeError;
        var t = Object(this),
            len = t.length >>> 0;
        if (0 === len) return -1;
        var n = 0;
        if (arguments.length > 1 && (n = Number(arguments[1]), n != n ? n = 0 : 0 != n && n != 1 / 0 && n != -(1 / 0) && (n = (n > 0 || -1) * Math.floor(Math.abs(n)))), n >= len) return -1;
        for (var k = n >= 0 ? n : Math.max(len - Math.abs(n), 0); len > k; k++)
            if (k in t && t[k] === searchElement) return k;
        return -1
    }), $.fn.stop = $.fn.stop || function() {
        return this
    }, window.Foundation = {
        name: "Foundation",
        version: "4.3.2",
        cache: {},
        media_queries: {
            small: $(".foundation-mq-small").css("font-family").replace(/\'/g, ""),
            medium: $(".foundation-mq-medium").css("font-family").replace(/\'/g, ""),
            large: $(".foundation-mq-large").css("font-family").replace(/\'/g, "")
        },
        stylesheet: $("<style></style>").appendTo("head")[0].sheet,
        init: function(scope, libraries, method, options, response, nc) {
            var library_arr, args = [scope, method, options, response],
                responses = [],
                nc = nc || !1;
            if (nc && (this.nc = nc), this.rtl = /rtl/i.test($("html").attr("dir")), this.scope = scope || this.scope, libraries && "string" == typeof libraries && !/reflow/i.test(libraries)) {
                if (/off/i.test(libraries)) return this.off();
                if (library_arr = libraries.split(" "), library_arr.length > 0)
                    for (var i = library_arr.length - 1; i >= 0; i--) responses.push(this.init_lib(library_arr[i], args))
            } else {
                /reflow/i.test(libraries) && (args[1] = "reflow");
                for (var lib in this.libs) responses.push(this.init_lib(lib, args))
            }
            return "function" == typeof libraries && args.unshift(libraries), this.response_obj(responses, args)
        },
        response_obj: function(response_arr, args) {
            for (var i = 0, len = args.length; len > i; i++)
                if ("function" == typeof args[i]) return args[i]({
                    errors: response_arr.filter(function(s) {
                        return "string" == typeof s ? s : void 0
                    })
                });
            return response_arr
        },
        init_lib: function(lib, args) {
            return this.trap(function() {
                return this.libs.hasOwnProperty(lib) ? (this.patch(this.libs[lib]), this.libs[lib].init.apply(this.libs[lib], args)) : function() {}
            }.bind(this), lib)
        },
        trap: function(fun, lib) {
            if (!this.nc) try {
                return fun()
            } catch (e) {
                return this.error({
                    name: lib,
                    message: "could not be initialized",
                    more: e.name + " " + e.message
                })
            }
            return fun()
        },
        patch: function(lib) {
            this.fix_outer(lib), lib.scope = this.scope, lib.rtl = this.rtl
        },
        inherit: function(scope, methods) {
            for (var methods_arr = methods.split(" "), i = methods_arr.length - 1; i >= 0; i--) this.lib_methods.hasOwnProperty(methods_arr[i]) && (this.libs[scope.name][methods_arr[i]] = this.lib_methods[methods_arr[i]])
        },
        random_str: function(length) {
            var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz".split("");
            length || (length = Math.floor(Math.random() * chars.length));
            for (var str = "", i = 0; length > i; i++) str += chars[Math.floor(Math.random() * chars.length)];
            return str
        },
        libs: {},
        lib_methods: {
            set_data: function(node, data) {
                var id = [this.name, +new Date, Foundation.random_str(5)].join("-");
                return Foundation.cache[id] = data, node.attr("data-" + this.name + "-id", id), data
            },
            get_data: function(node) {
                return Foundation.cache[node.attr("data-" + this.name + "-id")]
            },
            remove_data: function(node) {
                node ? (delete Foundation.cache[node.attr("data-" + this.name + "-id")], node.attr("data-" + this.name + "-id", "")) : $("[data-" + this.name + "-id]").each(function() {
                    delete Foundation.cache[$(this).attr("data-" + this.name + "-id")], $(this).attr("data-" + this.name + "-id", "")
                })
            },
            throttle: function(fun, delay) {
                var timer = null;
                return function() {
                    var context = this,
                        args = arguments;
                    clearTimeout(timer), timer = setTimeout(function() {
                        fun.apply(context, args)
                    }, delay)
                }
            },
            data_options: function(el) {
                function isNumber(o) {
                    return !isNaN(o - 0) && null !== o && "" !== o && o !== !1 && o !== !0
                }

                function trim(str) {
                    return "string" == typeof str ? $.trim(str) : str
                }
                var ii, p, opts = {},
                    opts_arr = (el.attr("data-options") || ":").split(";"),
                    opts_len = opts_arr.length;
                for (ii = opts_len - 1; ii >= 0; ii--) p = opts_arr[ii].split(":"), /true/i.test(p[1]) && (p[1] = !0), /false/i.test(p[1]) && (p[1] = !1), isNumber(p[1]) && (p[1] = parseInt(p[1], 10)), 2 === p.length && p[0].length > 0 && (opts[trim(p[0])] = trim(p[1]));
                return opts
            },
            delay: function(fun, delay) {
                return setTimeout(fun, delay)
            },
            scrollTo: function(el, to, duration) {
                if (!(0 > duration)) {
                    var difference = to - $(window).scrollTop(),
                        perTick = difference / duration * 10;
                    this.scrollToTimerCache = setTimeout(function() {
                        isNaN(parseInt(perTick, 10)) || (window.scrollTo(0, $(window).scrollTop() + perTick), this.scrollTo(el, to, duration - 10))
                    }.bind(this), 10)
                }
            },
            scrollLeft: function(el) {
                return el.length ? "scrollLeft" in el[0] ? el[0].scrollLeft : el[0].pageXOffset : void 0
            },
            empty: function(obj) {
                if (obj.length && obj.length > 0) return !1;
                if (obj.length && 0 === obj.length) return !0;
                for (var key in obj)
                    if (hasOwnProperty.call(obj, key)) return !1;
                return !0
            },
            addCustomRule: function(rule, media) {
                if (media === undefined) Foundation.stylesheet.insertRule(rule, Foundation.stylesheet.cssRules.length);
                else {
                    var query = Foundation.media_queries[media];
                    query !== undefined && Foundation.stylesheet.insertRule("@media " + Foundation.media_queries[media] + "{ " + rule + " }")
                }
            }
        },
        fix_outer: function(lib) {
            lib.outerHeight = function(el, bool) {
                return "function" == typeof Zepto ? el.height() : "undefined" != typeof bool ? el.outerHeight(bool) : el.outerHeight()
            }, lib.outerWidth = function(el, bool) {
                return "function" == typeof Zepto ? el.width() : "undefined" != typeof bool ? el.outerWidth(bool) : el.outerWidth()
            }
        },
        error: function(error) {
            return error.name + " " + error.message + "; " + error.more
        },
        off: function() {
            return $(this.scope).off(".fndtn"), $(window).off(".fndtn"), !0
        },
        zj: $
    }, $.fn.foundation = function() {
        var args = Array.prototype.slice.call(arguments, 0);
        return this.each(function() {
            return Foundation.init.apply(Foundation, [this].concat(args)), this
        })
    }
}(libFuncName, this, this.document),
function($, window, document, undefined) {
    "use strict";
    Foundation.libs.abide = {
        name: "abide",
        version: "4.3.2",
        settings: {
            live_validate: !0,
            focus_on_invalid: !0,
            timeout: 1e3,
            patterns: {
                alpha: /[a-zA-Z]+/,
                alpha_numeric: /[a-zA-Z0-9]+/,
                integer: /-?\d+/,
                number: /-?(?:\d+|\d{1,3}(?:,\d{3})+)?(?:\.\d+)?/,
                password: /(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/,
                card: /^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35\d{3})\d{11})$/,
                cvv: /^([0-9]){3,4}$/,
                email: /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,
                url: /(https?|ftp|file|ssh):\/\/(((([a-zA-Z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-zA-Z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-zA-Z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-zA-Z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-zA-Z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-zA-Z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-zA-Z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-zA-Z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-zA-Z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-zA-Z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-zA-Z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-zA-Z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-zA-Z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?/,
                domain: /^([a-zA-Z0-9]([a-zA-Z0-9\-]{0,61}[a-zA-Z0-9])?\.)+[a-zA-Z]{2,6}$/,
                datetime: /([0-2][0-9]{3})\-([0-1][0-9])\-([0-3][0-9])T([0-5][0-9])\:([0-5][0-9])\:([0-5][0-9])(Z|([\-\+]([0-1][0-9])\:00))/,
                date: /(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))/,
                time: /(0[0-9]|1[0-9]|2[0-3])(:[0-5][0-9]){2}/,
                dateISO: /\d{4}[\/\-]\d{1,2}[\/\-]\d{1,2}/,
                month_day_year: /(0[1-9]|1[012])[- \/.](0[1-9]|[12][0-9]|3[01])[- \/.](19|20)\d\d/,
                color: /^#?([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$/
            }
        },
        timer: null,
        init: function(scope, method, options) {
            return "object" == typeof method && $.extend(!0, this.settings, method), "string" == typeof method ? this[method].call(this, options) : void(this.settings.init || this.events())
        },
        events: function() {
            var self = this,
                forms = $("form[data-abide]", this.scope).attr("novalidate", "novalidate");
            forms.on("submit validate", function(e) {
                return self.validate($(this).find("input, textarea, select").get(), e)
            }), this.settings.init = !0, this.settings.live_validate && forms.find("input, textarea, select").on("blur change", function(e) {
                self.validate([this], e)
            }).on("keydown", function(e) {
                clearTimeout(self.timer), self.timer = setTimeout(function() {
                    self.validate([this], e)
                }.bind(this), self.settings.timeout)
            })
        },
        validate: function(els, e) {
            for (var validations = this.parse_patterns(els), validation_count = validations.length, form = $(els[0]).closest("form"), i = 0; validation_count > i; i++)
                if (!validations[i] && /submit/.test(e.type)) return this.settings.focus_on_invalid && els[i].focus(), form.trigger("invalid"), $(els[i]).closest("form").attr("data-invalid", ""), !1;
            return /submit/.test(e.type) && form.trigger("valid"), form.removeAttr("data-invalid"), !0
        },
        parse_patterns: function(els) {
            for (var count = els.length, el_patterns = [], i = count - 1; i >= 0; i--) el_patterns.push(this.pattern(els[i]));
            return this.check_validation_and_apply_styles(el_patterns)
        },
        pattern: function(el) {
            var type = el.getAttribute("type"),
                required = "string" == typeof el.getAttribute("required");
            if (this.settings.patterns.hasOwnProperty(type)) return [el, this.settings.patterns[type], required];
            var pattern = el.getAttribute("pattern") || "";
            return this.settings.patterns.hasOwnProperty(pattern) && pattern.length > 0 ? [el, this.settings.patterns[pattern], required] : pattern.length > 0 ? [el, new RegExp(pattern), required] : (pattern = /.*/, [el, pattern, required])
        },
        check_validation_and_apply_styles: function(el_patterns) {
            for (var count = el_patterns.length, validations = [], i = count - 1; i >= 0; i--) {
                var el = el_patterns[i][0],
                    required = el_patterns[i][2],
                    value = el.value,
                    is_radio = "radio" === el.type,
                    valid_length = required ? el.value.length > 0 : !0;
                is_radio && required ? validations.push(this.valid_radio(el, required)) : el_patterns[i][1].test(value) && valid_length || !required && el.value.length < 1 ? ($(el).removeAttr("data-invalid").parent().removeClass("error"), validations.push(!0)) : ($(el).attr("data-invalid", "").parent().addClass("error"), validations.push(!1))
            }
            return validations
        },
        valid_radio: function(el, required) {
            for (var name = el.getAttribute("name"), group = document.getElementsByName(name), count = group.length, valid = !1, i = 0; count > i; i++) group[i].checked && (valid = !0);
            for (var i = 0; count > i; i++) valid ? $(group[i]).removeAttr("data-invalid").parent().removeClass("error") : $(group[i]).attr("data-invalid", "").parent().addClass("error");
            return valid
        }
    }
}(Foundation.zj, this, this.document),
function($, window, document, undefined) {
    "use strict";
    Foundation.libs.alerts = {
        name: "alerts",
        version: "4.3.2",
        settings: {
            animation: "fadeOut",
            speed: 300,
            callback: function() {}
        },
        init: function(scope, method, options) {
            return this.scope = scope || this.scope, Foundation.inherit(this, "data_options"), "object" == typeof method && $.extend(!0, this.settings, method), "string" != typeof method ? (this.settings.init || this.events(), this.settings.init) : this[method].call(this, options)
        },
        events: function() {
            var self = this;
            $(this.scope).on("click.fndtn.alerts", "[data-alert] a.close", function(e) {
                var alertBox = $(this).closest("[data-alert]"),
                    settings = $.extend({}, self.settings, self.data_options(alertBox));
                e.preventDefault(), alertBox[settings.animation](settings.speed, function() {
                    $(this).remove(), settings.callback()
                })
            }), this.settings.init = !0
        },
        off: function() {
            $(this.scope).off(".fndtn.alerts")
        },
        reflow: function() {}
    }
}(Foundation.zj, this, this.document),
function($, window, document, undefined) {
    "use strict";
    Foundation.libs.clearing = {
        name: "clearing",
        version: "4.3.2",
        settings: {
            templates: {
                viewing: '<a href="#" class="clearing-close">&times;</a><div class="visible-img" style="display: none"><img src="//:0"><p class="clearing-caption"></p><a href="#" class="clearing-main-prev"><span></span></a><a href="#" class="clearing-main-next"><span></span></a></div>'
            },
            close_selectors: ".clearing-close",
            init: !1,
            locked: !1
        },
        init: function(scope, method, options) {
            var self = this;
            return Foundation.inherit(this, "set_data get_data remove_data throttle data_options"), "object" == typeof method && (options = $.extend(!0, this.settings, method)), "string" != typeof method ? ($(this.scope).find("ul[data-clearing]").each(function() {
                var $el = $(this),
                    options = options || {},
                    lis = $el.find("li"),
                    settings = self.get_data($el);
                !settings && lis.length > 0 && (options.$parent = $el.parent(), self.set_data($el, $.extend({}, self.settings, options, self.data_options($el))), self.assemble($el.find("li")), self.settings.init || self.events().swipe_events())
            }), this.settings.init) : this[method].call(this, options)
        },
        events: function() {
            var self = this;
            return $(this.scope).on("click.fndtn.clearing", "ul[data-clearing] li", function(e, current, target) {
                var current = current || $(this),
                    target = target || current,
                    next = current.next("li"),
                    settings = self.get_data(current.parent()),
                    image = $(e.target);
                e.preventDefault(), settings || self.init(), target.hasClass("visible") && current[0] === target[0] && next.length > 0 && self.is_open(current) && (target = next, image = target.find("img")), self.open(image, current, target), self.update_paddles(target)
            }).on("click.fndtn.clearing", ".clearing-main-next", function(e) {
                this.nav(e, "next")
            }.bind(this)).on("click.fndtn.clearing", ".clearing-main-prev", function(e) {
                this.nav(e, "prev")
            }.bind(this)).on("click.fndtn.clearing", this.settings.close_selectors, function(e) {
                Foundation.libs.clearing.close(e, this)
            }).on("keydown.fndtn.clearing", function(e) {
                this.keydown(e)
            }.bind(this)), $(window).on("resize.fndtn.clearing", function() {
                this.resize()
            }.bind(this)), this.settings.init = !0, this
        },
        swipe_events: function() {
            var self = this;
            $(this.scope).on("touchstart.fndtn.clearing", ".visible-img", function(e) {
                e.touches || (e = e.originalEvent);
                var data = {
                    start_page_x: e.touches[0].pageX,
                    start_page_y: e.touches[0].pageY,
                    start_time: (new Date).getTime(),
                    delta_x: 0,
                    is_scrolling: undefined
                };
                $(this).data("swipe-transition", data), e.stopPropagation()
            }).on("touchmove.fndtn.clearing", ".visible-img", function(e) {
                if (e.touches || (e = e.originalEvent), !(e.touches.length > 1 || e.scale && 1 !== e.scale)) {
                    var data = $(this).data("swipe-transition");
                    if ("undefined" == typeof data && (data = {}), data.delta_x = e.touches[0].pageX - data.start_page_x, "undefined" == typeof data.is_scrolling && (data.is_scrolling = !!(data.is_scrolling || Math.abs(data.delta_x) < Math.abs(e.touches[0].pageY - data.start_page_y))), !data.is_scrolling && !data.active) {
                        e.preventDefault();
                        var direction = data.delta_x < 0 ? "next" : "prev";
                        data.active = !0, self.nav(e, direction)
                    }
                }
            }).on("touchend.fndtn.clearing", ".visible-img", function(e) {
                $(this).data("swipe-transition", {}), e.stopPropagation()
            })
        },
        assemble: function($li) {
            var $el = $li.parent();
            $el.after('<div id="foundationClearingHolder"></div>');
            var holder = $("#foundationClearingHolder"),
                settings = this.get_data($el),
                grid = $el.detach(),
                data = {
                    grid: '<div class="carousel">' + this.outerHTML(grid[0]) + "</div>",
                    viewing: settings.templates.viewing
                },
                wrapper = '<div class="clearing-assembled"><div>' + data.viewing + data.grid + "</div></div>";
            return holder.after(wrapper).remove()
        },
        open: function($image, current, target) {
            var root = target.closest(".clearing-assembled"),
                container = root.find("div").first(),
                visible_image = container.find(".visible-img"),
                image = visible_image.find("img").not($image);
            this.locked() || (image.attr("src", this.load($image)).css("visibility", "hidden"), this.loaded(image, function() {
                image.css("visibility", "visible"), root.addClass("clearing-blackout"), container.addClass("clearing-container"), visible_image.show(), this.fix_height(target).caption(visible_image.find(".clearing-caption"), $image).center(image).shift(current, target, function() {
                    target.siblings().removeClass("visible"), target.addClass("visible")
                })
            }.bind(this)))
        },
        close: function(e, el) {
            e.preventDefault();
            var container, visible_image, root = function(target) {
                return /blackout/.test(target.selector) ? target : target.closest(".clearing-blackout")
            }($(el));
            return el === e.target && root && (container = root.find("div").first(), visible_image = container.find(".visible-img"), this.settings.prev_index = 0, root.find("ul[data-clearing]").attr("style", "").closest(".clearing-blackout").removeClass("clearing-blackout"), container.removeClass("clearing-container"), visible_image.hide()), !1
        },
        is_open: function(current) {
            return current.parent().prop("style").length > 0
        },
        keydown: function(e) {
            var clearing = $(".clearing-blackout").find("ul[data-clearing]");
            39 === e.which && this.go(clearing, "next"), 37 === e.which && this.go(clearing, "prev"), 27 === e.which && $("a.clearing-close").trigger("click")
        },
        nav: function(e, direction) {
            var clearing = $(".clearing-blackout").find("ul[data-clearing]");
            e.preventDefault(), this.go(clearing, direction)
        },
        resize: function() {
            var image = $(".clearing-blackout .visible-img").find("img");
            image.length && this.center(image)
        },
        fix_height: function(target) {
            var lis = target.parent().children(),
                self = this;
            return lis.each(function() {
                var li = $(this),
                    image = li.find("img");
                li.height() > self.outerHeight(image) && li.addClass("fix-height")
            }).closest("ul").width(100 * lis.length + "%"), this
        },
        update_paddles: function(target) {
            var visible_image = target.closest(".carousel").siblings(".visible-img");
            target.next().length > 0 ? visible_image.find(".clearing-main-next").removeClass("disabled") : visible_image.find(".clearing-main-next").addClass("disabled"), target.prev().length > 0 ? visible_image.find(".clearing-main-prev").removeClass("disabled") : visible_image.find(".clearing-main-prev").addClass("disabled")
        },
        center: function(target) {
            return this.rtl ? target.css({
                marginRight: -(this.outerWidth(target) / 2),
                marginTop: -(this.outerHeight(target) / 2)
            }) : target.css({
                marginLeft: -(this.outerWidth(target) / 2),
                marginTop: -(this.outerHeight(target) / 2)
            }), this
        },
        load: function($image) {
            if ("A" === $image[0].nodeName) var href = $image.attr("href");
            else var href = $image.parent().attr("href");
            return this.preload($image), href ? href : $image.attr("src")
        },
        preload: function($image) {
            this.img($image.closest("li").next()).img($image.closest("li").prev())
        },
        loaded: function(image, callback) {
            function loaded() {
                callback()
            }

            function bindLoad() {
                if (this.one("load", loaded), /MSIE (\d+\.\d+);/.test(navigator.userAgent)) {
                    var src = this.attr("src"),
                        param = src.match(/\?/) ? "&" : "?";
                    param += "random=" + (new Date).getTime(), this.attr("src", src + param)
                }
            }
            return image.attr("src") ? void(image[0].complete || 4 === image[0].readyState ? loaded() : bindLoad.call(image)) : void loaded()
        },
        img: function(img) {
            if (img.length) {
                var new_img = new Image,
                    new_a = img.find("a");
                new_a.length ? new_img.src = new_a.attr("href") : new_img.src = img.find("img").attr("src")
            }
            return this
        },
        caption: function(container, $image) {
            var caption = $image.data("caption");
            return caption ? container.html(caption).show() : container.text("").hide(), this
        },
        go: function($ul, direction) {
            var current = $ul.find(".visible"),
                target = current[direction]();
            target.length && target.find("img").trigger("click", [current, target])
        },
        shift: function(current, target, callback) {
            var skip_shift, clearing = target.parent(),
                old_index = this.settings.prev_index || target.index(),
                direction = this.direction(clearing, current, target),
                left = parseInt(clearing.css("left"), 10),
                width = this.outerWidth(target);
            target.index() === old_index || /skip/.test(direction) ? /skip/.test(direction) && (skip_shift = target.index() - this.settings.up_count, this.lock(), skip_shift > 0 ? clearing.animate({
                left: -(skip_shift * width)
            }, 300, this.unlock()) : clearing.animate({
                left: 0
            }, 300, this.unlock())) : /left/.test(direction) ? (this.lock(), clearing.animate({
                left: left + width
            }, 300, this.unlock())) : /right/.test(direction) && (this.lock(), clearing.animate({
                left: left - width
            }, 300, this.unlock())), callback()
        },
        direction: function($el, current, target) {
            var response, lis = $el.find("li"),
                li_width = this.outerWidth(lis) + this.outerWidth(lis) / 4,
                up_count = Math.floor(this.outerWidth($(".clearing-container")) / li_width) - 1,
                target_index = lis.index(target);
            return this.settings.up_count = up_count, response = this.adjacent(this.settings.prev_index, target_index) ? target_index > up_count && target_index > this.settings.prev_index ? "right" : target_index > up_count - 1 && target_index <= this.settings.prev_index ? "left" : !1 : "skip", this.settings.prev_index = target_index, response
        },
        adjacent: function(current_index, target_index) {
            for (var i = target_index + 1; i >= target_index - 1; i--)
                if (i === current_index) return !0;
            return !1
        },
        lock: function() {
            this.settings.locked = !0
        },
        unlock: function() {
            this.settings.locked = !1
        },
        locked: function() {
            return this.settings.locked
        },
        outerHTML: function(el) {
            return el.outerHTML || (new XMLSerializer).serializeToString(el)
        },
        off: function() {
            $(this.scope).off(".fndtn.clearing"), $(window).off(".fndtn.clearing"), this.remove_data(), this.settings.init = !1
        },
        reflow: function() {
            this.init()
        }
    }
}(Foundation.zj, this, this.document),
function($, document, undefined) {
    function raw(s) {
        return s
    }

    function decoded(s) {
        return decodeURIComponent(s.replace(pluses, " "))
    }
    var pluses = /\+/g,
        config = $.cookie = function(key, value, options) {
            if (value !== undefined) {
                if (options = $.extend({}, config.defaults, options), null === value && (options.expires = -1), "number" == typeof options.expires) {
                    var days = options.expires,
                        t = options.expires = new Date;
                    t.setDate(t.getDate() + days)
                }
                return value = config.json ? JSON.stringify(value) : String(value), document.cookie = [encodeURIComponent(key), "=", config.raw ? value : encodeURIComponent(value), options.expires ? "; expires=" + options.expires.toUTCString() : "", options.path ? "; path=" + options.path : "", options.domain ? "; domain=" + options.domain : "", options.secure ? "; secure" : ""].join("")
            }
            for (var decode = config.raw ? raw : decoded, cookies = document.cookie.split("; "), i = 0, l = cookies.length; l > i; i++) {
                var parts = cookies[i].split("=");
                if (decode(parts.shift()) === key) {
                    var cookie = decode(parts.join("="));
                    return config.json ? JSON.parse(cookie) : cookie
                }
            }
            return null
        };
    config.defaults = {}, $.removeCookie = function(key, options) {
        return null !== $.cookie(key) ? ($.cookie(key, null, options), !0) : !1
    }
}(Foundation.zj, document),
function($, window, document, undefined) {
    "use strict";
    Foundation.libs.dropdown = {
        name: "dropdown",
        version: "4.3.2",
        settings: {
            activeClass: "open",
            is_hover: !1,
            opened: function() {},
            closed: function() {}
        },
        init: function(scope, method, options) {
            return this.scope = scope || this.scope, Foundation.inherit(this, "throttle scrollLeft data_options"), "object" == typeof method && $.extend(!0, this.settings, method), "string" != typeof method ? (this.settings.init || this.events(), this.settings.init) : this[method].call(this, options)
        },
        events: function() {
            var self = this;
            $(this.scope).on("click.fndtn.dropdown", "[data-dropdown]", function(e) {
                var settings = $.extend({}, self.settings, self.data_options($(this)));
                e.preventDefault(), settings.is_hover || self.toggle($(this))
            }).on("mouseenter", "[data-dropdown]", function(e) {
                var settings = $.extend({}, self.settings, self.data_options($(this)));
                settings.is_hover && self.toggle($(this))
            }).on("mouseleave", "[data-dropdown-content]", function(e) {
                var target = $('[data-dropdown="' + $(this).attr("id") + '"]'),
                    settings = $.extend({}, self.settings, self.data_options(target));
                settings.is_hover && self.close.call(self, $(this))
            }).on("opened.fndtn.dropdown", "[data-dropdown-content]", this.settings.opened).on("closed.fndtn.dropdown", "[data-dropdown-content]", this.settings.closed), $(document).on("click.fndtn.dropdown", function(e) {
                var parent = $(e.target).closest("[data-dropdown-content]");
                if (!$(e.target).data("dropdown") && !$(e.target).parent().data("dropdown")) return !$(e.target).data("revealId") && parent.length > 0 && ($(e.target).is("[data-dropdown-content]") || $.contains(parent.first()[0], e.target)) ? void e.stopPropagation() : void self.close.call(self, $("[data-dropdown-content]"))
            }), $(window).on("resize.fndtn.dropdown", self.throttle(function() {
                self.resize.call(self)
            }, 50)).trigger("resize"), this.settings.init = !0
        },
        close: function(dropdown) {
            var self = this;
            dropdown.each(function() {
                $(this).hasClass(self.settings.activeClass) && ($(this).css(Foundation.rtl ? "right" : "left", "-99999px").removeClass(self.settings.activeClass), $(this).trigger("closed"))
            })
        },
        open: function(dropdown, target) {
            this.css(dropdown.addClass(this.settings.activeClass), target), dropdown.trigger("opened")
        },
        toggle: function(target) {
            var dropdown = $("#" + target.data("dropdown"));
            0 !== dropdown.length && (this.close.call(this, $("[data-dropdown-content]").not(dropdown)), dropdown.hasClass(this.settings.activeClass) ? this.close.call(this, dropdown) : (this.close.call(this, $("[data-dropdown-content]")), this.open.call(this, dropdown, target)))
        },
        resize: function() {
            var dropdown = $("[data-dropdown-content].open"),
                target = $("[data-dropdown='" + dropdown.attr("id") + "']");
            dropdown.length && target.length && this.css(dropdown, target)
        },
        css: function(dropdown, target) {
            var offset_parent = dropdown.offsetParent(),
                position = target.offset();
            if (position.top -= offset_parent.offset().top, position.left -= offset_parent.offset().left, this.small()) dropdown.css({
                position: "absolute",
                width: "95%",
                "max-width": "none",
                top: position.top + this.outerHeight(target)
            }), dropdown.css(Foundation.rtl ? "right" : "left", "2.5%");
            else {
                if (!Foundation.rtl && $(window).width() > this.outerWidth(dropdown) + target.offset().left && !this.data_options(target).align_right) {
                    var left = position.left;
                    dropdown.hasClass("right") && dropdown.removeClass("right")
                } else {
                    dropdown.hasClass("right") || dropdown.addClass("right");
                    var left = position.left - (this.outerWidth(dropdown) - this.outerWidth(target))
                }
                dropdown.attr("style", "").css({
                    position: "absolute",
                    top: position.top + this.outerHeight(target),
                    left: left
                })
            }
            return dropdown
        },
        small: function() {
            return $(window).width() < 768 || $("html").hasClass("lt-ie9")
        },
        off: function() {
            $(this.scope).off(".fndtn.dropdown"), $("html, body").off(".fndtn.dropdown"), $(window).off(".fndtn.dropdown"), $("[data-dropdown-content]").off(".fndtn.dropdown"), this.settings.init = !1
        },
        reflow: function() {}
    }
}(Foundation.zj, this, this.document),
function($, window, document, undefined) {
    "use strict";
    Foundation.libs.forms = {
        name: "forms",
        version: "4.3.2",
        cache: {},
        settings: {
            disable_class: "no-custom",
            last_combo: null
        },
        init: function(scope, method, options) {
            return "object" == typeof method && $.extend(!0, this.settings, method), "string" != typeof method ? (this.settings.init || this.events(), this.assemble(), this.settings.init) : this[method].call(this, options)
        },
        assemble: function() {
            var forms = this;
            $('form.custom input[type="radio"],[type="checkbox"]', $(this.scope)).not('[data-customforms="disabled"]').not("." + this.settings.disable_class).each(function(idx, sel) {
                forms.set_custom_markup(sel)
            }).change(function() {
                forms.set_custom_markup(this)
            }), $("form.custom select", $(this.scope)).not('[data-customforms="disabled"]').not("." + this.settings.disable_class).not("[multiple=multiple]").each(this.append_custom_select)
        },
        events: function() {
            var self = this;
            $(this.scope).on("click.fndtn.forms", "form.custom span.custom.checkbox", function(e) {
                e.preventDefault(), e.stopPropagation(), self.toggle_checkbox($(this))
            }).on("click.fndtn.forms", "form.custom span.custom.radio", function(e) {
                e.preventDefault(), e.stopPropagation(), self.toggle_radio($(this))
            }).on("change.fndtn.forms", "form.custom select", function(e, force_refresh) {
                $(this).is('[data-customforms="disabled"]') || self.refresh_custom_select($(this), force_refresh)
            }).on("click.fndtn.forms", "form.custom label", function(e) {
                if ($(e.target).is("label")) {
                    var $customCheckbox, $customRadio, $associatedElement = $("#" + self.escape($(this).attr("for"))).not('[data-customforms="disabled"]');
                    0 !== $associatedElement.length && ("checkbox" === $associatedElement.attr("type") ? (e.preventDefault(), $customCheckbox = $(this).find("span.custom.checkbox"), 0 === $customCheckbox.length && ($customCheckbox = $associatedElement.add(this).siblings("span.custom.checkbox").first()), self.toggle_checkbox($customCheckbox)) : "radio" === $associatedElement.attr("type") && (e.preventDefault(), $customRadio = $(this).find("span.custom.radio"), 0 === $customRadio.length && ($customRadio = $associatedElement.add(this).siblings("span.custom.radio").first()), self.toggle_radio($customRadio)))
                }
            }).on("mousedown.fndtn.forms", "form.custom div.custom.dropdown", function() {
                return !1
            }).on("click.fndtn.forms", "form.custom div.custom.dropdown a.current, form.custom div.custom.dropdown a.selector", function(e) {
                var $this = $(this),
                    $dropdown = $this.closest("div.custom.dropdown"),
                    $select = getFirstPrevSibling($dropdown, "select");
                return $dropdown.hasClass("open") || $(self.scope).trigger("click"), e.preventDefault(), !1 === $select.is(":disabled") ? ($dropdown.toggleClass("open"), $dropdown.hasClass("open") ? $(self.scope).on("click.fndtn.forms.customdropdown", function() {
                    $dropdown.removeClass("open"), $(self.scope).off(".fndtn.forms.customdropdown")
                }) : $(self.scope).on(".fndtn.forms.customdropdown"), !1) : void 0
            }).on("click.fndtn.forms touchend.fndtn.forms", "form.custom div.custom.dropdown li", function(e) {
                var $this = $(this),
                    $customDropdown = $this.closest("div.custom.dropdown"),
                    $select = getFirstPrevSibling($customDropdown, "select"),
                    selectedIndex = 0;
                if (e.preventDefault(), e.stopPropagation(), !$(this).hasClass("disabled")) {
                    $("div.dropdown").not($customDropdown).removeClass("open");
                    var $oldThis = $this.closest("ul").find("li.selected");
                    if ($oldThis.removeClass("selected"), $this.addClass("selected"), $customDropdown.removeClass("open").find("a.current").text($this.text()), $this.closest("ul").find("li").each(function(index) {
                            $this[0] === this && (selectedIndex = index)
                        }), $select[0].selectedIndex = selectedIndex, $select.data("prevalue", $oldThis.html()), "undefined" != typeof document.createEvent) {
                        var event = document.createEvent("HTMLEvents");
                        event.initEvent("change", !0, !0), $select[0].dispatchEvent(event)
                    } else $select[0].fireEvent("onchange")
                }
            }), $(window).on("keydown", function(e) {
                var self = (document.activeElement, Foundation.libs.forms),
                    dropdown = $(".custom.dropdown"),
                    select = getFirstPrevSibling(dropdown, "select"),
                    inputs = $("input,select,textarea,button");
                if (dropdown.length > 0 && dropdown.hasClass("open")) {
                    if (e.preventDefault(), 9 === e.which && ($(inputs[$(inputs).index(select) + 1]).focus(), dropdown.removeClass("open")), 13 === e.which && dropdown.find("li.selected").trigger("click"), 27 === e.which && dropdown.removeClass("open"), e.which >= 65 && e.which <= 90) {
                        var next = self.go_to(dropdown, e.which),
                            current = dropdown.find("li.selected");
                        next && (current.removeClass("selected"), self.scrollTo(next.addClass("selected"), 300))
                    }
                    if (38 === e.which) {
                        var current = dropdown.find("li.selected"),
                            prev = current.prev(":not(.disabled)");
                        prev.length > 0 && (prev.parent()[0].scrollTop = prev.parent().scrollTop() - self.outerHeight(prev), current.removeClass("selected"), prev.addClass("selected"))
                    } else if (40 === e.which) {
                        var current = dropdown.find("li.selected"),
                            next = current.next(":not(.disabled)");
                        next.length > 0 && (next.parent()[0].scrollTop = next.parent().scrollTop() + self.outerHeight(next), current.removeClass("selected"), next.addClass("selected"))
                    }
                }
            }), $(window).on("keyup", function(e) {
                var focus = document.activeElement,
                    dropdown = $(".custom.dropdown");
                focus === dropdown.find(".current")[0] && dropdown.find(".selector").focus().click()
            }), this.settings.init = !0
        },
        go_to: function(dropdown, character) {
            var lis = dropdown.find("li"),
                count = lis.length;
            if (count > 0)
                for (var i = 0; count > i; i++) {
                    var first_letter = lis.eq(i).text().charAt(0).toLowerCase();
                    if (first_letter === String.fromCharCode(character).toLowerCase()) return lis.eq(i)
                }
        },
        scrollTo: function(el, duration) {
            if (!(0 > duration)) {
                var parent = el.parent(),
                    li_height = this.outerHeight(el),
                    difference = li_height * el.index() - parent.scrollTop(),
                    perTick = difference / duration * 10;
                this.scrollToTimerCache = setTimeout(function() {
                    isNaN(parseInt(perTick, 10)) || (parent[0].scrollTop = parent.scrollTop() + perTick, this.scrollTo(el, duration - 10))
                }.bind(this), 10)
            }
        },
        set_custom_markup: function(sel) {
            var $this = $(sel),
                type = $this.attr("type"),
                $span = $this.next("span.custom." + type);
            $this.parent().hasClass("switch") || $this.addClass("hidden-field"), 0 === $span.length && ($span = $('<span class="custom ' + type + '"></span>').insertAfter($this)), $span.toggleClass("checked", $this.is(":checked")), $span.toggleClass("disabled", $this.is(":disabled"))
        },
        append_custom_select: function(idx, sel) {
            var $listItems, self = Foundation.libs.forms,
                $this = $(sel),
                $customSelect = $this.next("div.custom.dropdown"),
                $customList = $customSelect.find("ul"),
                $selector = ($customSelect.find(".current"), $customSelect.find(".selector")),
                $options = $this.find("option"),
                $selectedOption = $options.filter(":selected"),
                copyClasses = $this.attr("class") ? $this.attr("class").split(" ") : [],
                maxWidth = 0,
                liHtml = "",
                $currentSelect = !1;
            if (0 === $customSelect.length) {
                var customSelectSize = $this.hasClass("small") ? "small" : $this.hasClass("medium") ? "medium" : $this.hasClass("large") ? "large" : $this.hasClass("expand") ? "expand" : "";
                $customSelect = $('<div class="' + ["custom", "dropdown", customSelectSize].concat(copyClasses).filter(function(item, idx, arr) {
                    return "" === item ? !1 : arr.indexOf(item) === idx
                }).join(" ") + '"><a href="#" class="selector"></a><ul /></div>'), $selector = $customSelect.find(".selector"), $customList = $customSelect.find("ul"), liHtml = $options.map(function() {
                    var copyClasses = $(this).attr("class") ? $(this).attr("class") : "";
                    return "<li class='" + copyClasses + "'>" + $(this).html() + "</li>"
                }).get().join(""), $customList.append(liHtml), $currentSelect = $customSelect.prepend('<a href="#" class="current">' + ($selectedOption.html() || "") + "</a>").find(".current"), $this.after($customSelect).addClass("hidden-field")
            } else liHtml = $options.map(function() {
                return "<li>" + $(this).html() + "</li>"
            }).get().join(""), $customList.html("").append(liHtml);
            if (self.assign_id($this, $customSelect), $customSelect.toggleClass("disabled", $this.is(":disabled")), $listItems = $customList.find("li"), self.cache[$customSelect.data("id")] = $listItems.length, $options.each(function(index) {
                    this.selected && ($listItems.eq(index).addClass("selected"), $currentSelect && $currentSelect.html($(this).html())), $(this).is(":disabled") && $listItems.eq(index).addClass("disabled")
                }), !$customSelect.is(".small, .medium, .large, .expand")) {
                $customSelect.addClass("open");
                var self = Foundation.libs.forms;
                self.hidden_fix.adjust($customList), maxWidth = self.outerWidth($listItems) > maxWidth ? self.outerWidth($listItems) : maxWidth, Foundation.libs.forms.hidden_fix.reset(), $customSelect.removeClass("open")
            }
        },
        assign_id: function($select, $customSelect) {
            var id = [+new Date, Foundation.random_str(5)].join("-");
            $select.attr("data-id", id), $customSelect.attr("data-id", id)
        },
        refresh_custom_select: function($select, force_refresh) {
            var self = this,
                maxWidth = 0,
                $customSelect = $select.next(),
                $options = $select.find("option"),
                $customList = $customSelect.find("ul"),
                $listItems = $customSelect.find("li");
            if ($options.length !== this.cache[$customSelect.data("id")] || force_refresh) {
                $customList.html("");
                var customSelectHtml = "";
                $options.each(function() {
                    var $this = $(this),
                        thisHtml = $this.html(),
                        thisSelected = this.selected;
                    customSelectHtml += '<li class="' + (thisSelected ? " selected " : "") + ($this.is(":disabled") ? " disabled " : "") + '">' + thisHtml + "</li>", thisSelected && $customSelect.find(".current").html(thisHtml)
                }), $customList.html(customSelectHtml), $customSelect.removeAttr("style"), $customList.removeAttr("style"), $customSelect.find("li").each(function() {
                    $customSelect.addClass("open"), self.outerWidth($(this)) > maxWidth && (maxWidth = self.outerWidth($(this))), $customSelect.removeClass("open")
                }), $listItems = $customSelect.find("li"), this.cache[$customSelect.data("id")] = $listItems.length
            }
        },
        refresh_custom_selection: function($select) {
            var selectedValue = $("option:selected", $select).text();
            $("a.current", $select.next()).text(selectedValue)
        },
        toggle_checkbox: function($element) {
            var $input = $element.prev(),
                input = $input[0];
            !1 === $input.is(":disabled") && (input.checked = !input.checked, $element.toggleClass("checked"), $input.trigger("change"))
        },
        toggle_radio: function($element) {
            var $input = $element.prev(),
                $form = $input.closest("form.custom"),
                input = $input[0];
            !1 === $input.is(":disabled") && ($form.find('input[type="radio"][name="' + this.escape($input.attr("name")) + '"]').next().not($element).removeClass("checked"), $element.hasClass("checked") || $element.toggleClass("checked"), input.checked = $element.hasClass("checked"), $input.trigger("change"))
        },
        escape: function(text) {
            return text ? text.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, "\\$&") : ""
        },
        hidden_fix: {
            tmp: [],
            hidden: null,
            adjust: function($child) {
                var _self = this;
                _self.hidden = $child.parents(), _self.hidden = _self.hidden.add($child).filter(":hidden"), _self.hidden.each(function() {
                    var $elem = $(this);
                    _self.tmp.push($elem.attr("style")), $elem.css({
                        visibility: "hidden",
                        display: "block"
                    })
                })
            },
            reset: function() {
                var _self = this;
                _self.hidden.each(function(i) {
                    var $elem = $(this),
                        _tmp = _self.tmp[i];
                    _tmp === undefined ? $elem.removeAttr("style") : $elem.attr("style", _tmp)
                }), _self.tmp = [], _self.hidden = null
            }
        },
        off: function() {
            $(this.scope).off(".fndtn.forms")
        },
        reflow: function() {}
    };
    var getFirstPrevSibling = function($el, selector) {
        for (var $el = $el.prev(); $el.length;) {
            if ($el.is(selector)) return $el;
            $el = $el.prev()
        }
        return $()
    }
}(Foundation.zj, this, this.document),
function($, window, document, undefined) {
    "use strict";
    Foundation.libs.interchange = {
        name: "interchange",
        version: "4.2.4",
        cache: {},
        images_loaded: !1,
        settings: {
            load_attr: "interchange",
            named_queries: {
                "default": "only screen and (min-width: 1px)",
                small: "only screen and (min-width: 768px)",
                medium: "only screen and (min-width: 1280px)",
                large: "only screen and (min-width: 1440px)",
                landscape: "only screen and (orientation: landscape)",
                portrait: "only screen and (orientation: portrait)",
                retina: "only screen and (-webkit-min-device-pixel-ratio: 2),only screen and (min--moz-device-pixel-ratio: 2),only screen and (-o-min-device-pixel-ratio: 2/1),only screen and (min-device-pixel-ratio: 2),only screen and (min-resolution: 192dpi),only screen and (min-resolution: 2dppx)"
            },
            directives: {
                replace: function(el, path) {
                    if (/IMG/.test(el[0].nodeName)) {
                        var orig_path = el[0].src;
                        if (new RegExp(path, "i").test(orig_path)) return;
                        return el[0].src = path, el.trigger("replace", [el[0].src, orig_path])
                    }
                }
            }
        },
        init: function(scope, method, options) {
            return Foundation.inherit(this, "throttle"), "object" == typeof method && $.extend(!0, this.settings, method), this.events(), this.images(), "string" != typeof method ? this.settings.init : this[method].call(this, options)
        },
        events: function() {
            var self = this;
            $(window).on("resize.fndtn.interchange", self.throttle(function() {
                self.resize.call(self)
            }, 50))
        },
        resize: function() {
            var cache = this.cache;
            if (!this.images_loaded) return void setTimeout($.proxy(this.resize, this), 50);
            for (var uuid in cache)
                if (cache.hasOwnProperty(uuid)) {
                    var passed = this.results(uuid, cache[uuid]);
                    passed && this.settings.directives[passed.scenario[1]](passed.el, passed.scenario[0])
                }
        },
        results: function(uuid, scenarios) {
            var count = scenarios.length;
            if (count > 0)
                for (var el = $('[data-uuid="' + uuid + '"]'), i = count - 1; i >= 0; i--) {
                    var mq, rule = scenarios[i][2];
                    if (mq = this.settings.named_queries.hasOwnProperty(rule) ? matchMedia(this.settings.named_queries[rule]) : matchMedia(rule), mq.matches) return {
                        el: el,
                        scenario: scenarios[i]
                    }
                }
            return !1
        },
        images: function(force_update) {
            return "undefined" == typeof this.cached_images || force_update ? this.update_images() : this.cached_images
        },
        update_images: function() {
            var images = document.getElementsByTagName("img"),
                count = images.length,
                loaded_count = 0,
                data_attr = "data-" + this.settings.load_attr;
            this.cached_images = [], this.images_loaded = !1;
            for (var i = count - 1; i >= 0; i--) this.loaded($(images[i]), function(image) {
                if (loaded_count++, image) {
                    var str = image.getAttribute(data_attr) || "";
                    str.length > 0 && this.cached_images.push(image)
                }
                loaded_count === count && (this.images_loaded = !0, this.enhance())
            }.bind(this));
            return "deferred"
        },
        loaded: function(image, callback) {
            function loaded() {
                callback(image[0])
            }

            function bindLoad() {
                if (this.one("load", loaded), /MSIE (\d+\.\d+);/.test(navigator.userAgent)) {
                    var src = this.attr("src"),
                        param = src.match(/\?/) ? "&" : "?";
                    param += "random=" + (new Date).getTime(), this.attr("src", src + param)
                }
            }
            return image.attr("src") ? void(image[0].complete || 4 === image[0].readyState ? loaded() : bindLoad.call(image)) : void loaded()
        },
        enhance: function() {
            for (var count = this.images().length, i = count - 1; i >= 0; i--) this._object($(this.images()[i]));
            return $(window).trigger("resize")
        },
        parse_params: function(path, directive, mq) {
            return [this.trim(path), this.convert_directive(directive), this.trim(mq)]
        },
        convert_directive: function(directive) {
            var trimmed = this.trim(directive);
            return trimmed.length > 0 ? trimmed : "replace"
        },
        _object: function(el) {
            var raw_arr = this.parse_data_attr(el),
                scenarios = [],
                count = raw_arr.length;
            if (count > 0)
                for (var i = count - 1; i >= 0; i--) {
                    var split = raw_arr[i].split(/\((.*?)(\))$/);
                    if (split.length > 1) {
                        var cached_split = split[0].split(","),
                            params = this.parse_params(cached_split[0], cached_split[1], split[1]);
                        scenarios.push(params)
                    }
                }
            return this.store(el, scenarios)
        },
        uuid: function(separator) {
            function S4() {
                return (65536 * (1 + Math.random()) | 0).toString(16).substring(1)
            }
            var delim = separator || "-";
            return S4() + S4() + delim + S4() + delim + S4() + delim + S4() + delim + S4() + S4() + S4()
        },
        store: function(el, scenarios) {
            var uuid = this.uuid(),
                current_uuid = el.data("uuid");
            return current_uuid ? this.cache[current_uuid] : (el.attr("data-uuid", uuid), this.cache[uuid] = scenarios)
        },
        trim: function(str) {
            return "string" == typeof str ? $.trim(str) : str
        },
        parse_data_attr: function(el) {
            for (var raw = el.data(this.settings.load_attr).split(/\[(.*?)\]/), count = raw.length, output = [], i = count - 1; i >= 0; i--) raw[i].replace(/[\W\d]+/, "").length > 4 && output.push(raw[i]);
            return output
        },
        reflow: function() {
            this.images(!0)
        }
    }
}(Foundation.zj, this, this.document),
function($, window, document, undefined) {
    "use strict";
    var Modernizr = Modernizr || !1;
    Foundation.libs.joyride = {
        name: "joyride",
        version: "4.3.2",
        defaults: {
            expose: !1,
            modal: !1,
            tipLocation: "bottom",
            nubPosition: "auto",
            scrollSpeed: 300,
            timer: 0,
            startTimerOnClick: !0,
            startOffset: 0,
            nextButton: !0,
            tipAnimation: "fade",
            pauseAfter: [],
            exposed: [],
            tipAnimationFadeSpeed: 300,
            cookieMonster: !1,
            cookieName: "joyride",
            cookieDomain: !1,
            cookieExpires: 365,
            tipContainer: "body",
            postRideCallback: function() {},
            postStepCallback: function() {},
            preStepCallback: function() {},
            preRideCallback: function() {},
            postExposeCallback: function() {},
            template: {
                link: '<a href="#close" class="joyride-close-tip">&times;</a>',
                timer: '<div class="joyride-timer-indicator-wrap"><span class="joyride-timer-indicator"></span></div>',
                tip: '<div class="joyride-tip-guide"><span class="joyride-nub"></span></div>',
                wrapper: '<div class="joyride-content-wrapper"></div>',
                button: '<a href="#" class="small button joyride-next-tip"></a>',
                modal: '<div class="joyride-modal-bg"></div>',
                expose: '<div class="joyride-expose-wrapper"></div>',
                exposeCover: '<div class="joyride-expose-cover"></div>'
            },
            exposeAddClass: ""
        },
        settings: {},
        init: function(scope, method, options) {
            return this.scope = scope || this.scope, Foundation.inherit(this, "throttle data_options scrollTo scrollLeft delay"), "object" == typeof method ? $.extend(!0, this.settings, this.defaults, method) : $.extend(!0, this.settings, this.defaults, options), "string" != typeof method ? (this.settings.init || this.events(), this.settings.init) : this[method].call(this, options)
        },
        events: function() {
            var self = this;
            $(this.scope).on("click.joyride", ".joyride-next-tip, .joyride-modal-bg", function(e) {
                e.preventDefault(), this.settings.$li.next().length < 1 ? this.end() : this.settings.timer > 0 ? (clearTimeout(this.settings.automate), this.hide(), this.show(), this.startTimer()) : (this.hide(), this.show())
            }.bind(this)).on("click.joyride", ".joyride-close-tip", function(e) {
                e.preventDefault(), this.end()
            }.bind(this)), $(window).on("resize.fndtn.joyride", self.throttle(function() {
                if ($("[data-joyride]").length > 0 && self.settings.$next_tip) {
                    if (self.settings.exposed.length > 0) {
                        var $els = $(self.settings.exposed);
                        $els.each(function() {
                            var $this = $(this);
                            self.un_expose($this), self.expose($this)
                        })
                    }
                    self.is_phone() ? self.pos_phone() : self.pos_default(!1, !0)
                }
            }, 100)), this.settings.init = !0
        },
        start: function() {
            var self = this,
                $this = $(this.scope).find("[data-joyride]"),
                integer_settings = ["timer", "scrollSpeed", "startOffset", "tipAnimationFadeSpeed", "cookieExpires"],
                int_settings_count = integer_settings.length;
            this.settings.init || this.events(), this.settings.$content_el = $this, this.settings.$body = $(this.settings.tipContainer), this.settings.body_offset = $(this.settings.tipContainer).position(), this.settings.$tip_content = this.settings.$content_el.find("> li"), this.settings.paused = !1, this.settings.attempts = 0, this.settings.tipLocationPatterns = {
                top: ["bottom"],
                bottom: [],
                left: ["right", "top", "bottom"],
                right: ["left", "top", "bottom"]
            }, "function" != typeof $.cookie && (this.settings.cookieMonster = !1), (!this.settings.cookieMonster || this.settings.cookieMonster && null === $.cookie(this.settings.cookieName)) && (this.settings.$tip_content.each(function(index) {
                var $this = $(this);
                $.extend(!0, self.settings, self.data_options($this));
                for (var i = int_settings_count - 1; i >= 0; i--) self.settings[integer_settings[i]] = parseInt(self.settings[integer_settings[i]], 10);
                self.create({
                    $li: $this,
                    index: index
                })
            }), !this.settings.startTimerOnClick && this.settings.timer > 0 ? (this.show("init"), this.startTimer()) : this.show("init"))
        },
        resume: function() {
            this.set_li(), this.show()
        },
        tip_template: function(opts) {
            var $blank, content;
            return opts.tip_class = opts.tip_class || "", $blank = $(this.settings.template.tip).addClass(opts.tip_class), content = $.trim($(opts.li).html()) + this.button_text(opts.button_text) + this.settings.template.link + this.timer_instance(opts.index), $blank.append($(this.settings.template.wrapper)), $blank.first().attr("data-index", opts.index), $(".joyride-content-wrapper", $blank).append(content), $blank[0]
        },
        timer_instance: function(index) {
            var txt;
            return txt = 0 === index && this.settings.startTimerOnClick && this.settings.timer > 0 || 0 === this.settings.timer ? "" : this.outerHTML($(this.settings.template.timer)[0])
        },
        button_text: function(txt) {
            return this.settings.nextButton ? (txt = $.trim(txt) || "Next", txt = this.outerHTML($(this.settings.template.button).append(txt)[0])) : txt = "", txt
        },
        create: function(opts) {
            var buttonText = opts.$li.attr("data-button") || opts.$li.attr("data-text"),
                tipClass = opts.$li.attr("class"),
                $tip_content = $(this.tip_template({
                    tip_class: tipClass,
                    index: opts.index,
                    button_text: buttonText,
                    li: opts.$li
                }));
            $(this.settings.tipContainer).append($tip_content)
        },
        show: function(init) {
            var $timer = null;
            this.settings.$li === undefined || -1 === $.inArray(this.settings.$li.index(), this.settings.pauseAfter) ? (this.settings.paused ? this.settings.paused = !1 : this.set_li(init), this.settings.attempts = 0, this.settings.$li.length && this.settings.$target.length > 0 ? (init && (this.settings.preRideCallback(this.settings.$li.index(), this.settings.$next_tip), this.settings.modal && this.show_modal()), this.settings.preStepCallback(this.settings.$li.index(), this.settings.$next_tip), this.settings.modal && this.settings.expose && this.expose(), this.settings.tipSettings = $.extend(this.settings, this.data_options(this.settings.$li)), this.settings.timer = parseInt(this.settings.timer, 10), this.settings.tipSettings.tipLocationPattern = this.settings.tipLocationPatterns[this.settings.tipSettings.tipLocation], /body/i.test(this.settings.$target.selector) || this.scroll_to(), this.is_phone() ? this.pos_phone(!0) : this.pos_default(!0), $timer = this.settings.$next_tip.find(".joyride-timer-indicator"), /pop/i.test(this.settings.tipAnimation) ? ($timer.width(0), this.settings.timer > 0 ? (this.settings.$next_tip.show(), this.delay(function() {
                $timer.animate({
                    width: $timer.parent().width()
                }, this.settings.timer, "linear")
            }.bind(this), this.settings.tipAnimationFadeSpeed)) : this.settings.$next_tip.show()) : /fade/i.test(this.settings.tipAnimation) && ($timer.width(0), this.settings.timer > 0 ? (this.settings.$next_tip.fadeIn(this.settings.tipAnimationFadeSpeed).show(), this.delay(function() {
                $timer.animate({
                    width: $timer.parent().width()
                }, this.settings.timer, "linear")
            }.bind(this), this.settings.tipAnimationFadeSpeed)) : this.settings.$next_tip.fadeIn(this.settings.tipAnimationFadeSpeed)), this.settings.$current_tip = this.settings.$next_tip) : this.settings.$li && this.settings.$target.length < 1 ? this.show() : this.end()) : this.settings.paused = !0
        },
        is_phone: function() {
            return Modernizr ? Modernizr.mq("only screen and (max-width: 767px)") || $(".lt-ie9").length > 0 : $(window).width() < 767
        },
        hide: function() {
            this.settings.modal && this.settings.expose && this.un_expose(), this.settings.modal || $(".joyride-modal-bg").hide(), this.settings.$current_tip.css("visibility", "hidden"), setTimeout($.proxy(function() {
                this.hide(), this.css("visibility", "visible")
            }, this.settings.$current_tip), 0), this.settings.postStepCallback(this.settings.$li.index(), this.settings.$current_tip)
        },
        set_li: function(init) {
            init ? (this.settings.$li = this.settings.$tip_content.eq(this.settings.startOffset), this.set_next_tip(), this.settings.$current_tip = this.settings.$next_tip) : (this.settings.$li = this.settings.$li.next(), this.set_next_tip()), this.set_target()
        },
        set_next_tip: function() {
            this.settings.$next_tip = $(".joyride-tip-guide[data-index='" + this.settings.$li.index() + "']"), this.settings.$next_tip.data("closed", "")
        },
        set_target: function() {
            var cl = this.settings.$li.attr("data-class"),
                id = this.settings.$li.attr("data-id"),
                $sel = function() {
                    return id ? $(document.getElementById(id)) : cl ? $("." + cl).first() : $("body")
                };
            this.settings.$target = $sel()
        },
        scroll_to: function() {
            var window_half, tipOffset;
            window_half = $(window).height() / 2, tipOffset = Math.ceil(this.settings.$target.offset().top - window_half + this.outerHeight(this.settings.$next_tip)), tipOffset > 0 && this.scrollTo($("html, body"), tipOffset, this.settings.scrollSpeed)
        },
        paused: function() {
            return -1 === $.inArray(this.settings.$li.index() + 1, this.settings.pauseAfter)
        },
        restart: function() {
            this.hide(), this.settings.$li = undefined, this.show("init")
        },
        pos_default: function(init, resizing) {
            var $nub = (Math.ceil($(window).height() / 2), this.settings.$next_tip.offset(), this.settings.$next_tip.find(".joyride-nub")),
                nub_width = Math.ceil(this.outerWidth($nub) / 2),
                nub_height = Math.ceil(this.outerHeight($nub) / 2),
                toggle = init || !1;
            if (toggle && (this.settings.$next_tip.css("visibility", "hidden"), this.settings.$next_tip.show()), "undefined" == typeof resizing && (resizing = !1), /body/i.test(this.settings.$target.selector)) this.settings.$li.length && this.pos_modal($nub);
            else {
                if (this.bottom()) {
                    var leftOffset = this.settings.$target.offset().left;
                    Foundation.rtl && (leftOffset = this.settings.$target.offset().width - this.settings.$next_tip.width() + leftOffset), this.settings.$next_tip.css({
                        top: this.settings.$target.offset().top + nub_height + this.outerHeight(this.settings.$target),
                        left: leftOffset
                    }), this.nub_position($nub, this.settings.tipSettings.nubPosition, "top")
                } else if (this.top()) {
                    var leftOffset = this.settings.$target.offset().left;
                    Foundation.rtl && (leftOffset = this.settings.$target.offset().width - this.settings.$next_tip.width() + leftOffset), this.settings.$next_tip.css({
                        top: this.settings.$target.offset().top - this.outerHeight(this.settings.$next_tip) - nub_height,
                        left: leftOffset
                    }), this.nub_position($nub, this.settings.tipSettings.nubPosition, "bottom")
                } else this.right() ? (this.settings.$next_tip.css({
                    top: this.settings.$target.offset().top,
                    left: this.outerWidth(this.settings.$target) + this.settings.$target.offset().left + nub_width
                }), this.nub_position($nub, this.settings.tipSettings.nubPosition, "left")) : this.left() && (this.settings.$next_tip.css({
                    top: this.settings.$target.offset().top,
                    left: this.settings.$target.offset().left - this.outerWidth(this.settings.$next_tip) - nub_width
                }), this.nub_position($nub, this.settings.tipSettings.nubPosition, "right"));
                !this.visible(this.corners(this.settings.$next_tip)) && this.settings.attempts < this.settings.tipSettings.tipLocationPattern.length && ($nub.removeClass("bottom").removeClass("top").removeClass("right").removeClass("left"), this.settings.tipSettings.tipLocation = this.settings.tipSettings.tipLocationPattern[this.settings.attempts], this.settings.attempts++, this.pos_default())
            }
            toggle && (this.settings.$next_tip.hide(), this.settings.$next_tip.css("visibility", "visible"))
        },
        pos_phone: function(init) {
            var tip_height = this.outerHeight(this.settings.$next_tip),
                target_height = (this.settings.$next_tip.offset(), this.outerHeight(this.settings.$target)),
                $nub = $(".joyride-nub", this.settings.$next_tip),
                nub_height = Math.ceil(this.outerHeight($nub) / 2),
                toggle = init || !1;
            $nub.removeClass("bottom").removeClass("top").removeClass("right").removeClass("left"), toggle && (this.settings.$next_tip.css("visibility", "hidden"), this.settings.$next_tip.show()), /body/i.test(this.settings.$target.selector) ? this.settings.$li.length && this.pos_modal($nub) : this.top() ? (this.settings.$next_tip.offset({
                top: this.settings.$target.offset().top - tip_height - nub_height
            }), $nub.addClass("bottom")) : (this.settings.$next_tip.offset({
                top: this.settings.$target.offset().top + target_height + nub_height
            }), $nub.addClass("top")), toggle && (this.settings.$next_tip.hide(), this.settings.$next_tip.css("visibility", "visible"))
        },
        pos_modal: function($nub) {
            this.center(), $nub.hide(), this.show_modal()
        },
        show_modal: function() {
            if (!this.settings.$next_tip.data("closed")) {
                var joyridemodalbg = $(".joyride-modal-bg");
                joyridemodalbg.length < 1 && $("body").append(this.settings.template.modal).show(), /pop/i.test(this.settings.tipAnimation) ? joyridemodalbg.show() : joyridemodalbg.fadeIn(this.settings.tipAnimationFadeSpeed)
            }
        },
        expose: function() {
            var expose, exposeCover, el, origCSS, origClasses, randId = "expose-" + Math.floor(1e4 * Math.random());
            if (arguments.length > 0 && arguments[0] instanceof $) el = arguments[0];
            else {
                if (!this.settings.$target || /body/i.test(this.settings.$target.selector)) return !1;
                el = this.settings.$target
            }
            return el.length < 1 ? (window.console && console.error("element not valid", el), !1) : (expose = $(this.settings.template.expose), this.settings.$body.append(expose), expose.css({
                top: el.offset().top,
                left: el.offset().left,
                width: this.outerWidth(el, !0),
                height: this.outerHeight(el, !0)
            }), exposeCover = $(this.settings.template.exposeCover), origCSS = {
                zIndex: el.css("z-index"),
                position: el.css("position")
            }, origClasses = null == el.attr("class") ? "" : el.attr("class"), el.css("z-index", parseInt(expose.css("z-index")) + 1), "static" == origCSS.position && el.css("position", "relative"), el.data("expose-css", origCSS), el.data("orig-class", origClasses), el.attr("class", origClasses + " " + this.settings.exposeAddClass), exposeCover.css({
                top: el.offset().top,
                left: el.offset().left,
                width: this.outerWidth(el, !0),
                height: this.outerHeight(el, !0)
            }), this.settings.$body.append(exposeCover), expose.addClass(randId), exposeCover.addClass(randId), el.data("expose", randId), this.settings.postExposeCallback(this.settings.$li.index(), this.settings.$next_tip, el), void this.add_exposed(el))
        },
        un_expose: function() {
            var exposeId, el, expose, origCSS, origClasses, clearAll = !1;
            if (arguments.length > 0 && arguments[0] instanceof $) el = arguments[0];
            else {
                if (!this.settings.$target || /body/i.test(this.settings.$target.selector)) return !1;
                el = this.settings.$target
            }
            return el.length < 1 ? (window.console && console.error("element not valid", el), !1) : (exposeId = el.data("expose"), expose = $("." + exposeId), arguments.length > 1 && (clearAll = arguments[1]), clearAll === !0 ? $(".joyride-expose-wrapper,.joyride-expose-cover").remove() : expose.remove(), origCSS = el.data("expose-css"), "auto" == origCSS.zIndex ? el.css("z-index", "") : el.css("z-index", origCSS.zIndex), origCSS.position != el.css("position") && ("static" == origCSS.position ? el.css("position", "") : el.css("position", origCSS.position)), origClasses = el.data("orig-class"), el.attr("class", origClasses), el.removeData("orig-classes"), el.removeData("expose"), el.removeData("expose-z-index"), void this.remove_exposed(el))
        },
        add_exposed: function(el) {
            this.settings.exposed = this.settings.exposed || [], el instanceof $ || "object" == typeof el ? this.settings.exposed.push(el[0]) : "string" == typeof el && this.settings.exposed.push(el)
        },
        remove_exposed: function(el) {
            var search, count;
            el instanceof $ ? search = el[0] : "string" == typeof el && (search = el), this.settings.exposed = this.settings.exposed || [], count = this.settings.exposed.length;
            for (var i = 0; count > i; i++)
                if (this.settings.exposed[i] == search) return void this.settings.exposed.splice(i, 1)
        },
        center: function() {
            var $w = $(window);
            return this.settings.$next_tip.css({
                top: ($w.height() - this.outerHeight(this.settings.$next_tip)) / 2 + $w.scrollTop(),
                left: ($w.width() - this.outerWidth(this.settings.$next_tip)) / 2 + this.scrollLeft($w)
            }), !0
        },
        bottom: function() {
            return /bottom/i.test(this.settings.tipSettings.tipLocation)
        },
        top: function() {
            return /top/i.test(this.settings.tipSettings.tipLocation)
        },
        right: function() {
            return /right/i.test(this.settings.tipSettings.tipLocation)
        },
        left: function() {
            return /left/i.test(this.settings.tipSettings.tipLocation)
        },
        corners: function(el) {
            var w = $(window),
                window_half = w.height() / 2,
                tipOffset = Math.ceil(this.settings.$target.offset().top - window_half + this.settings.$next_tip.outerHeight()),
                right = w.width() + this.scrollLeft(w),
                offsetBottom = w.height() + tipOffset,
                bottom = w.height() + w.scrollTop(),
                top = w.scrollTop();
            return top > tipOffset && (top = 0 > tipOffset ? 0 : tipOffset), offsetBottom > bottom && (bottom = offsetBottom), [el.offset().top < top, right < el.offset().left + el.outerWidth(), bottom < el.offset().top + el.outerHeight(), this.scrollLeft(w) > el.offset().left]
        },
        visible: function(hidden_corners) {
            for (var i = hidden_corners.length; i--;)
                if (hidden_corners[i]) return !1;
            return !0
        },
        nub_position: function(nub, pos, def) {
            "auto" === pos ? nub.addClass(def) : nub.addClass(pos)
        },
        startTimer: function() {
            this.settings.$li.length ? this.settings.automate = setTimeout(function() {
                this.hide(), this.show(), this.startTimer()
            }.bind(this), this.settings.timer) : clearTimeout(this.settings.automate)
        },
        end: function() {
            this.settings.cookieMonster && $.cookie(this.settings.cookieName, "ridden", {
                expires: this.settings.cookieExpires,
                domain: this.settings.cookieDomain
            }), this.settings.timer > 0 && clearTimeout(this.settings.automate), this.settings.modal && this.settings.expose && this.un_expose(), this.settings.$next_tip.data("closed", !0), $(".joyride-modal-bg").hide(), this.settings.$current_tip.hide(), this.settings.postStepCallback(this.settings.$li.index(), this.settings.$current_tip), this.settings.postRideCallback(this.settings.$li.index(), this.settings.$current_tip), $(".joyride-tip-guide").remove()
        },
        outerHTML: function(el) {
            return el.outerHTML || (new XMLSerializer).serializeToString(el)
        },
        off: function() {
            $(this.scope).off(".joyride"), $(window).off(".joyride"), $(".joyride-close-tip, .joyride-next-tip, .joyride-modal-bg").off(".joyride"), $(".joyride-tip-guide, .joyride-modal-bg").remove(), clearTimeout(this.settings.automate), this.settings = {}
        },
        reflow: function() {}
    }
}(Foundation.zj, this, this.document),
function($, window, document, undefined) {
    "use strict";
    Foundation.libs.magellan = {
        name: "magellan",
        version: "4.3.2",
        settings: {
            activeClass: "active",
            threshold: 0
        },
        init: function(scope, method, options) {
            return this.scope = scope || this.scope, Foundation.inherit(this, "data_options"), "object" == typeof method && $.extend(!0, this.settings, method), "string" != typeof method ? (this.settings.init || (this.fixed_magellan = $("[data-magellan-expedition]"), this.set_threshold(), this.last_destination = $("[data-magellan-destination]").last(), this.events()), this.settings.init) : this[method].call(this, options)
        },
        events: function() {
            var self = this;
            $(this.scope).on("arrival.fndtn.magellan", "[data-magellan-arrival]", function(e) {
                var $destination = $(this),
                    $expedition = $destination.closest("[data-magellan-expedition]"),
                    activeClass = $expedition.attr("data-magellan-active-class") || self.settings.activeClass;
                $destination.closest("[data-magellan-expedition]").find("[data-magellan-arrival]").not($destination).removeClass(activeClass), $destination.addClass(activeClass)
            }), this.fixed_magellan.on("update-position.fndtn.magellan", function() {
                $(this)
            }).trigger("update-position"), $(window).on("resize.fndtn.magellan", function() {
                this.fixed_magellan.trigger("update-position")
            }.bind(this)).on("scroll.fndtn.magellan", function() {
                var windowScrollTop = $(window).scrollTop();
                self.fixed_magellan.each(function() {
                    var $expedition = $(this);
                    "undefined" == typeof $expedition.data("magellan-top-offset") && $expedition.data("magellan-top-offset", $expedition.offset().top), "undefined" == typeof $expedition.data("magellan-fixed-position") && $expedition.data("magellan-fixed-position", !1);
                    var fixed_position = windowScrollTop + self.settings.threshold > $expedition.data("magellan-top-offset"),
                        attr = $expedition.attr("data-magellan-top-offset");
                    $expedition.data("magellan-fixed-position") != fixed_position && ($expedition.data("magellan-fixed-position", fixed_position), fixed_position ? ($expedition.addClass("fixed"), $expedition.css({
                        position: "fixed",
                        top: 0
                    })) : ($expedition.removeClass("fixed"), $expedition.css({
                        position: "",
                        top: ""
                    })), fixed_position && "undefined" != typeof attr && 0 != attr && $expedition.css({
                        position: "fixed",
                        top: attr + "px"
                    }))
                })
            }), this.last_destination.length > 0 && $(window).on("scroll.fndtn.magellan", function(e) {
                var windowScrollTop = $(window).scrollTop(),
                    scrolltopPlusHeight = windowScrollTop + $(window).height(),
                    lastDestinationTop = Math.ceil(self.last_destination.offset().top);
                $("[data-magellan-destination]").each(function() {
                    var $destination = $(this),
                        destination_name = $destination.attr("data-magellan-destination"),
                        topOffset = $destination.offset().top - windowScrollTop;
                    topOffset <= self.settings.threshold && $("[data-magellan-arrival='" + destination_name + "']").trigger("arrival"), scrolltopPlusHeight >= $(self.scope).height() && lastDestinationTop > windowScrollTop && scrolltopPlusHeight > lastDestinationTop && $("[data-magellan-arrival]").last().trigger("arrival")
                })
            }), this.settings.init = !0
        },
        set_threshold: function() {
            "number" != typeof this.settings.threshold && (this.settings.threshold = this.fixed_magellan.length > 0 ? this.outerHeight(this.fixed_magellan, !0) : 0)
        },
        off: function() {
            $(this.scope).off(".fndtn.magellan"), $(window).off(".fndtn.magellan")
        },
        reflow: function() {}
    }
}(Foundation.zj, this, this.document),
function($, window, document, undefined) {
    "use strict";
    var noop = function() {},
        Orbit = function(el, settings) {
            if (el.hasClass(settings.slides_container_class)) return this;
            var container, number_container, bullets_container, timer_container, animate, timer, self = this,
                slides_container = el,
                idx = 0,
                locked = !1;
            slides_container.children().first().addClass(settings.active_slide_class), self.update_slide_number = function(index) {
                settings.slide_number && (number_container.find("span:first").text(parseInt(index) + 1), number_container.find("span:last").text(slides_container.children().length)), settings.bullets && (bullets_container.children().removeClass(settings.bullets_active_class), $(bullets_container.children().get(index)).addClass(settings.bullets_active_class))
            }, self.update_active_link = function(index) {
                var link = $('a[data-orbit-link="' + slides_container.children().eq(index).attr("data-orbit-slide") + '"]');
                link.parents("ul").find("[data-orbit-link]").removeClass(settings.bullets_active_class), link.addClass(settings.bullets_active_class)
            }, self.build_markup = function() {
                slides_container.wrap('<div class="' + settings.container_class + '"></div>'), container = slides_container.parent(), slides_container.addClass(settings.slides_container_class), settings.navigation_arrows && (container.append($('<a href="#"><span></span></a>').addClass(settings.prev_class)), container.append($('<a href="#"><span></span></a>').addClass(settings.next_class))), settings.timer && (timer_container = $("<div>").addClass(settings.timer_container_class), timer_container.append("<span>"), timer_container.append($("<div>").addClass(settings.timer_progress_class)), timer_container.addClass(settings.timer_paused_class), container.append(timer_container)), settings.slide_number && (number_container = $("<div>").addClass(settings.slide_number_class), number_container.append("<span></span> " + settings.slide_number_text + " <span></span>"), container.append(number_container)), settings.bullets && (bullets_container = $("<ol>").addClass(settings.bullets_container_class), container.append(bullets_container), slides_container.children().each(function(idx, el) {
                    var bullet = $("<li>").attr("data-orbit-slide", idx);
                    bullets_container.append(bullet)
                })), settings.stack_on_small && container.addClass(settings.stack_on_small_class), self.update_slide_number(0), self.update_active_link(0)
            }, self._goto = function(next_idx, start_timer) {
                if (next_idx === idx) return !1;
                "object" == typeof timer && timer.restart();
                var slides = slides_container.children(),
                    dir = "next";
                locked = !0, idx > next_idx && (dir = "prev"), next_idx >= slides.length ? next_idx = 0 : 0 > next_idx && (next_idx = slides.length - 1);
                var current = $(slides.get(idx)),
                    next = $(slides.get(next_idx));
                current.css("zIndex", 2), current.removeClass(settings.active_slide_class), next.css("zIndex", 4).addClass(settings.active_slide_class), slides_container.trigger("orbit:before-slide-change"), settings.before_slide_change(), self.update_active_link(next_idx);
                var callback = function() {
                    var unlock = function() {
                        idx = next_idx, locked = !1, start_timer === !0 && (timer = self.create_timer(), timer.start()), self.update_slide_number(idx), slides_container.trigger("orbit:after-slide-change", [{
                            slide_number: idx,
                            total_slides: slides.length
                        }]), settings.after_slide_change(idx, slides.length)
                    };
                    slides_container.height() != next.height() && settings.variable_height ? slides_container.animate({
                        height: next.height()
                    }, 250, "linear", unlock) : unlock()
                };
                if (1 === slides.length) return callback(), !1;
                var start_animation = function() {
                    "next" === dir && animate.next(current, next, callback), "prev" === dir && animate.prev(current, next, callback)
                };
                next.height() > slides_container.height() && settings.variable_height ? slides_container.animate({
                    height: next.height()
                }, 250, "linear", start_animation) : start_animation()
            }, self.next = function(e) {
                e.stopImmediatePropagation(), e.preventDefault(), self._goto(idx + 1)
            }, self.prev = function(e) {
                e.stopImmediatePropagation(), e.preventDefault(), self._goto(idx - 1)
            }, self.link_custom = function(e) {
                e.preventDefault();
                var link = $(this).attr("data-orbit-link");
                if ("string" == typeof link && "" != (link = $.trim(link))) {
                    var slide = container.find("[data-orbit-slide=" + link + "]"); - 1 != slide.index() && self._goto(slide.index())
                }
            }, self.link_bullet = function(e) {
                var index = $(this).attr("data-orbit-slide");
                "string" == typeof index && "" != (index = $.trim(index)) && self._goto(parseInt(index))
            }, self.timer_callback = function() {
                self._goto(idx + 1, !0)
            }, self.compute_dimensions = function() {
                var current = $(slides_container.children().get(idx)),
                    h = current.height();
                settings.variable_height || slides_container.children().each(function() {
                    $(this).height() > h && (h = $(this).height())
                }), slides_container.height(h)
            }, self.create_timer = function() {
                var t = new Timer(container.find("." + settings.timer_container_class), settings, self.timer_callback);
                return t
            }, self.stop_timer = function() {
                "object" == typeof timer && timer.stop()
            }, self.toggle_timer = function() {
                var t = container.find("." + settings.timer_container_class);
                t.hasClass(settings.timer_paused_class) ? ("undefined" == typeof timer && (timer = self.create_timer()), timer.start()) : "object" == typeof timer && timer.stop()
            }, self.init = function() {
                self.build_markup(), settings.timer && (timer = self.create_timer(), timer.start()), animate = new FadeAnimation(settings, slides_container), "slide" === settings.animation && (animate = new SlideAnimation(settings, slides_container)), container.on("click", "." + settings.next_class, self.next), container.on("click", "." + settings.prev_class, self.prev), container.on("click", "[data-orbit-slide]", self.link_bullet), container.on("click", self.toggle_timer), settings.swipe && container.on("touchstart.fndtn.orbit", function(e) {
                    e.touches || (e = e.originalEvent);
                    var data = {
                        start_page_x: e.touches[0].pageX,
                        start_page_y: e.touches[0].pageY,
                        start_time: (new Date).getTime(),
                        delta_x: 0,
                        is_scrolling: undefined
                    };
                    container.data("swipe-transition", data), e.stopPropagation()
                }).on("touchmove.fndtn.orbit", function(e) {
                    if (e.touches || (e = e.originalEvent), !(e.touches.length > 1 || e.scale && 1 !== e.scale)) {
                        var data = container.data("swipe-transition");
                        if ("undefined" == typeof data && (data = {}), data.delta_x = e.touches[0].pageX - data.start_page_x, "undefined" == typeof data.is_scrolling && (data.is_scrolling = !!(data.is_scrolling || Math.abs(data.delta_x) < Math.abs(e.touches[0].pageY - data.start_page_y))), !data.is_scrolling && !data.active) {
                            e.preventDefault();
                            var direction = data.delta_x < 0 ? idx + 1 : idx - 1;
                            data.active = !0, self._goto(direction)
                        }
                    }
                }).on("touchend.fndtn.orbit", function(e) {
                    container.data("swipe-transition", {}), e.stopPropagation()
                }), container.on("mouseenter.fndtn.orbit", function(e) {
                    settings.timer && settings.pause_on_hover && self.stop_timer()
                }).on("mouseleave.fndtn.orbit", function(e) {
                    settings.timer && settings.resume_on_mouseout && timer.start()
                }), $(document).on("click", "[data-orbit-link]", self.link_custom), $(window).on("resize", self.compute_dimensions), $(window).on("load", self.compute_dimensions), $(window).on("load", function() {
                    container.prev(".preloader").css("display", "none")
                }), slides_container.trigger("orbit:ready")
            }, self.init()
        },
        Timer = function(el, settings, callback) {
            var start, timeout, self = this,
                duration = settings.timer_speed,
                progress = el.find("." + settings.timer_progress_class),
                left = -1;
            this.update_progress = function(w) {
                var new_progress = progress.clone();
                new_progress.attr("style", ""), new_progress.css("width", w + "%"), progress.replaceWith(new_progress), progress = new_progress
            }, this.restart = function() {
                clearTimeout(timeout), el.addClass(settings.timer_paused_class), left = -1, self.update_progress(0)
            }, this.start = function() {
                return el.hasClass(settings.timer_paused_class) ? (left = -1 === left ? duration : left, el.removeClass(settings.timer_paused_class), start = (new Date).getTime(), progress.animate({
                    width: "100%"
                }, left, "linear"), timeout = setTimeout(function() {
                    self.restart(), callback()
                }, left), void el.trigger("orbit:timer-started")) : !0
            }, this.stop = function() {
                if (el.hasClass(settings.timer_paused_class)) return !0;
                clearTimeout(timeout), el.addClass(settings.timer_paused_class);
                var end = (new Date).getTime();
                left -= end - start;
                var w = 100 - left / duration * 100;
                self.update_progress(w), el.trigger("orbit:timer-stopped")
            }
        },
        SlideAnimation = function(settings, container) {
            var duration = settings.animation_speed,
                is_rtl = 1 === $("html[dir=rtl]").length,
                margin = is_rtl ? "marginRight" : "marginLeft",
                animMargin = {};
            animMargin[margin] = "0%", this.next = function(current, next, callback) {
                next.animate(animMargin, duration, "linear", function() {
                    current.css(margin, "100%"), callback()
                })
            }, this.prev = function(current, prev, callback) {
                prev.css(margin, "-100%"), prev.animate(animMargin, duration, "linear", function() {
                    current.css(margin, "100%"), callback()
                })
            }
        },
        FadeAnimation = function(settings, container) {
            var duration = settings.animation_speed;
            1 === $("html[dir=rtl]").length;
            this.next = function(current, next, callback) {
                next.css({
                    margin: "0%",
                    opacity: "0.01"
                }), next.animate({
                    opacity: "1"
                }, duration, "linear", function() {
                    current.css("margin", "100%"), callback()
                })
            }, this.prev = function(current, prev, callback) {
                prev.css({
                    margin: "0%",
                    opacity: "0.01"
                }), prev.animate({
                    opacity: "1"
                }, duration, "linear", function() {
                    current.css("margin", "100%"), callback()
                })
            }
        };
    Foundation.libs = Foundation.libs || {}, Foundation.libs.orbit = {
        name: "orbit",
        version: "4.3.2",
        settings: {
            animation: "slide",
            timer_speed: 1e4,
            pause_on_hover: !0,
            resume_on_mouseout: !1,
            animation_speed: 500,
            stack_on_small: !1,
            navigation_arrows: !0,
            slide_number: !0,
            slide_number_text: "of",
            container_class: "orbit-container",
            stack_on_small_class: "orbit-stack-on-small",
            next_class: "orbit-next",
            prev_class: "orbit-prev",
            timer_container_class: "orbit-timer",
            timer_paused_class: "paused",
            timer_progress_class: "orbit-progress",
            slides_container_class: "orbit-slides-container",
            bullets_container_class: "orbit-bullets",
            bullets_active_class: "active",
            slide_number_class: "orbit-slide-number",
            caption_class: "orbit-caption",
            active_slide_class: "active",
            orbit_transition_class: "orbit-transitioning",
            bullets: !0,
            timer: !0,
            variable_height: !1,
            swipe: !0,
            before_slide_change: noop,
            after_slide_change: noop
        },
        init: function(scope, method, options) {
            var self = this;
            if (Foundation.inherit(self, "data_options"), "object" == typeof method && $.extend(!0, self.settings, method), $(scope).is("[data-orbit]")) {
                var $el = $(scope),
                    opts = self.data_options($el);
                new Orbit($el, $.extend({}, self.settings, opts))
            }
            $("[data-orbit]", scope).each(function(idx, el) {
                var $el = $(el),
                    opts = self.data_options($el);
                new Orbit($el, $.extend({}, self.settings, opts))
            })
        }
    }
}(Foundation.zj, this, this.document),
function(global) {
    "use strict";

    function addEventListener(elem, event, fn) {
        return elem.addEventListener ? elem.addEventListener(event, fn, !1) : elem.attachEvent ? elem.attachEvent("on" + event, fn) : void 0
    }

    function inArray(arr, item) {
        var i, len;
        for (i = 0, len = arr.length; len > i; i++)
            if (arr[i] === item) return !0;
        return !1
    }

    function moveCaret(elem, index) {
        var range;
        elem.createTextRange ? (range = elem.createTextRange(), range.move("character", index), range.select()) : elem.selectionStart && (elem.focus(), elem.setSelectionRange(index, index))
    }

    function changeType(elem, type) {
        try {
            return elem.type = type, !0
        } catch (e) {
            return !1
        }
    }
    global.Placeholders = {
        Utils: {
            addEventListener: addEventListener,
            inArray: inArray,
            moveCaret: moveCaret,
            changeType: changeType
        }
    }
}(this),
function(global) {
    "use strict";

    function noop() {}

    function hidePlaceholder(elem) {
        var type;
        return elem.value === elem.getAttribute(ATTR_CURRENT_VAL) && "true" === elem.getAttribute(ATTR_ACTIVE) ? (elem.setAttribute(ATTR_ACTIVE, "false"), elem.value = "", elem.className = elem.className.replace(classNameRegExp, ""), type = elem.getAttribute(ATTR_INPUT_TYPE), type && (elem.type = type), !0) : !1
    }

    function showPlaceholder(elem) {
        var type, val = elem.getAttribute(ATTR_CURRENT_VAL);
        return "" === elem.value && val ? (elem.setAttribute(ATTR_ACTIVE, "true"), elem.value = val, elem.className += " " + placeholderClassName, type = elem.getAttribute(ATTR_INPUT_TYPE), type ? elem.type = "text" : "password" === elem.type && Utils.changeType(elem, "text") && elem.setAttribute(ATTR_INPUT_TYPE, "password"), !0) : !1
    }

    function handleElem(node, callback) {
        var handleInputs, handleTextareas, elem, len, i;
        if (node && node.getAttribute(ATTR_CURRENT_VAL)) callback(node);
        else
            for (handleInputs = node ? node.getElementsByTagName("input") : inputs, handleTextareas = node ? node.getElementsByTagName("textarea") : textareas, i = 0, len = handleInputs.length + handleTextareas.length; len > i; i++) elem = i < handleInputs.length ? handleInputs[i] : handleTextareas[i - handleInputs.length], callback(elem)
    }

    function disablePlaceholders(node) {
        handleElem(node, hidePlaceholder)
    }

    function enablePlaceholders(node) {
        handleElem(node, showPlaceholder)
    }

    function makeFocusHandler(elem) {
        return function() {
            hideOnInput && elem.value === elem.getAttribute(ATTR_CURRENT_VAL) && "true" === elem.getAttribute(ATTR_ACTIVE) ? Utils.moveCaret(elem, 0) : hidePlaceholder(elem)
        }
    }

    function makeBlurHandler(elem) {
        return function() {
            showPlaceholder(elem)
        }
    }

    function makeKeydownHandler(elem) {
        return function(e) {
            return keydownVal = elem.value, "true" === elem.getAttribute(ATTR_ACTIVE) && keydownVal === elem.getAttribute(ATTR_CURRENT_VAL) && Utils.inArray(badKeys, e.keyCode) ? (e.preventDefault && e.preventDefault(), !1) : void 0
        }
    }

    function makeKeyupHandler(elem) {
        return function() {
            var type;
            "true" === elem.getAttribute(ATTR_ACTIVE) && elem.value !== keydownVal && (elem.className = elem.className.replace(classNameRegExp, ""), elem.value = elem.value.replace(elem.getAttribute(ATTR_CURRENT_VAL), ""),
                elem.setAttribute(ATTR_ACTIVE, !1), type = elem.getAttribute(ATTR_INPUT_TYPE), type && (elem.type = type)), "" === elem.value && (elem.blur(), Utils.moveCaret(elem, 0))
        }
    }

    function makeClickHandler(elem) {
        return function() {
            elem === document.activeElement && elem.value === elem.getAttribute(ATTR_CURRENT_VAL) && "true" === elem.getAttribute(ATTR_ACTIVE) && Utils.moveCaret(elem, 0)
        }
    }

    function makeSubmitHandler(form) {
        return function() {
            disablePlaceholders(form)
        }
    }

    function newElement(elem) {
        elem.form && (form = elem.form, form.getAttribute(ATTR_FORM_HANDLED) || (Utils.addEventListener(form, "submit", makeSubmitHandler(form)), form.setAttribute(ATTR_FORM_HANDLED, "true"))), Utils.addEventListener(elem, "focus", makeFocusHandler(elem)), Utils.addEventListener(elem, "blur", makeBlurHandler(elem)), hideOnInput && (Utils.addEventListener(elem, "keydown", makeKeydownHandler(elem)), Utils.addEventListener(elem, "keyup", makeKeyupHandler(elem)), Utils.addEventListener(elem, "click", makeClickHandler(elem))), elem.setAttribute(ATTR_EVENTS_BOUND, "true"), elem.setAttribute(ATTR_CURRENT_VAL, placeholder), showPlaceholder(elem)
    }
    var inputs, textareas, hideOnInput, liveUpdates, keydownVal, styleElem, styleRules, placeholder, timer, form, elem, len, i, validTypes = ["text", "search", "url", "tel", "email", "password", "number", "textarea"],
        badKeys = [27, 33, 34, 35, 36, 37, 38, 39, 40, 8, 46],
        placeholderStyleColor = "#ccc",
        placeholderClassName = "placeholdersjs",
        classNameRegExp = new RegExp("(?:^|\\s)" + placeholderClassName + "(?!\\S)"),
        ATTR_CURRENT_VAL = "data-placeholder-value",
        ATTR_ACTIVE = "data-placeholder-active",
        ATTR_INPUT_TYPE = "data-placeholder-type",
        ATTR_FORM_HANDLED = "data-placeholder-submit",
        ATTR_EVENTS_BOUND = "data-placeholder-bound",
        ATTR_OPTION_FOCUS = "data-placeholder-focus",
        ATTR_OPTION_LIVE = "data-placeholder-live",
        test = document.createElement("input"),
        head = document.getElementsByTagName("head")[0],
        root = document.documentElement,
        Placeholders = global.Placeholders,
        Utils = Placeholders.Utils;
    if (Placeholders.nativeSupport = void 0 !== test.placeholder, !Placeholders.nativeSupport) {
        for (inputs = document.getElementsByTagName("input"), textareas = document.getElementsByTagName("textarea"), hideOnInput = "false" === root.getAttribute(ATTR_OPTION_FOCUS), liveUpdates = "false" !== root.getAttribute(ATTR_OPTION_LIVE), styleElem = document.createElement("style"), styleElem.type = "text/css", styleRules = document.createTextNode("." + placeholderClassName + " { color:" + placeholderStyleColor + "; }"), styleElem.styleSheet ? styleElem.styleSheet.cssText = styleRules.nodeValue : styleElem.appendChild(styleRules), head.insertBefore(styleElem, head.firstChild), i = 0, len = inputs.length + textareas.length; len > i; i++) elem = i < inputs.length ? inputs[i] : textareas[i - inputs.length], placeholder = elem.attributes.placeholder, placeholder && (placeholder = placeholder.nodeValue, placeholder && Utils.inArray(validTypes, elem.type) && newElement(elem));
        timer = setInterval(function() {
            for (i = 0, len = inputs.length + textareas.length; len > i; i++) elem = i < inputs.length ? inputs[i] : textareas[i - inputs.length], placeholder = elem.attributes.placeholder, placeholder && (placeholder = placeholder.nodeValue, placeholder && Utils.inArray(validTypes, elem.type) && (elem.getAttribute(ATTR_EVENTS_BOUND) || newElement(elem), (placeholder !== elem.getAttribute(ATTR_CURRENT_VAL) || "password" === elem.type && !elem.getAttribute(ATTR_INPUT_TYPE)) && ("password" === elem.type && !elem.getAttribute(ATTR_INPUT_TYPE) && Utils.changeType(elem, "text") && elem.setAttribute(ATTR_INPUT_TYPE, "password"), elem.value === elem.getAttribute(ATTR_CURRENT_VAL) && (elem.value = placeholder), elem.setAttribute(ATTR_CURRENT_VAL, placeholder))));
            liveUpdates || clearInterval(timer)
        }, 100)
    }
    Placeholders.disable = Placeholders.nativeSupport ? noop : disablePlaceholders, Placeholders.enable = Placeholders.nativeSupport ? noop : enablePlaceholders
}(this),
function($, window, document, undefined) {
    "use strict";
    Foundation.libs.reveal = {
        name: "reveal",
        version: "4.3.2",
        locked: !1,
        settings: {
            animation: "fadeAndPop",
            animationSpeed: 250,
            closeOnBackgroundClick: !0,
            closeOnEsc: !0,
            dismissModalClass: "close-reveal-modal",
            bgClass: "reveal-modal-bg",
            open: function() {},
            opened: function() {},
            close: function() {},
            closed: function() {},
            bg: $(".reveal-modal-bg"),
            css: {
                open: {
                    opacity: 0,
                    visibility: "visible",
                    display: "block"
                },
                close: {
                    opacity: 1,
                    visibility: "hidden",
                    display: "none"
                }
            }
        },
        init: function(scope, method, options) {
            return Foundation.inherit(this, "data_options delay"), "object" == typeof method ? $.extend(!0, this.settings, method) : "undefined" != typeof options && $.extend(!0, this.settings, options), "string" != typeof method ? (this.events(), this.settings.init) : this[method].call(this, options)
        },
        events: function() {
            var self = this;
            return $(this.scope).off(".fndtn.reveal").on("click.fndtn.reveal", "[data-reveal-id]", function(e) {
                if (e.preventDefault(), !self.locked) {
                    var element = $(this),
                        ajax = element.data("reveal-ajax");
                    if (self.locked = !0, "undefined" == typeof ajax) self.open.call(self, element);
                    else {
                        var url = ajax === !0 ? element.attr("href") : ajax;
                        self.open.call(self, element, {
                            url: url
                        })
                    }
                }
            }).on("click.fndtn.reveal touchend", this.close_targets(), function(e) {
                if (e.preventDefault(), !self.locked) {
                    var settings = $.extend({}, self.settings, self.data_options($(".reveal-modal.open"))),
                        bgClicked = $(e.target)[0] === $("." + settings.bgClass)[0];
                    if (bgClicked && !settings.closeOnBackgroundClick) return;
                    self.locked = !0, self.close.call(self, bgClicked ? $(".reveal-modal.open") : $(this).closest(".reveal-modal"))
                }
            }), $(this.scope).hasClass("reveal-modal") ? $(this.scope).on("open.fndtn.reveal", this.settings.open).on("opened.fndtn.reveal", this.settings.opened).on("opened.fndtn.reveal", this.open_video).on("close.fndtn.reveal", this.settings.close).on("closed.fndtn.reveal", this.settings.closed).on("closed.fndtn.reveal", this.close_video) : $(this.scope).on("open.fndtn.reveal", ".reveal-modal", this.settings.open).on("opened.fndtn.reveal", ".reveal-modal", this.settings.opened).on("opened.fndtn.reveal", ".reveal-modal", this.open_video).on("close.fndtn.reveal", ".reveal-modal", this.settings.close).on("closed.fndtn.reveal", ".reveal-modal", this.settings.closed).on("closed.fndtn.reveal", ".reveal-modal", this.close_video), $("body").bind("keyup.reveal", function(event) {
                var open_modal = $(".reveal-modal.open"),
                    settings = $.extend({}, self.settings, self.data_options(open_modal));
                27 === event.which && settings.closeOnEsc && open_modal.foundation("reveal", "close")
            }), !0
        },
        open: function(target, ajax_settings) {
            if (target)
                if ("undefined" != typeof target.selector) var modal = $("#" + target.data("reveal-id"));
                else {
                    var modal = $(this.scope);
                    ajax_settings = target
                } else var modal = $(this.scope);
            if (!modal.hasClass("open")) {
                var open_modal = $(".reveal-modal.open");
                if ("undefined" == typeof modal.data("css-top") && modal.data("css-top", parseInt(modal.css("top"), 10)).data("offset", this.cache_offset(modal)), modal.trigger("open"), open_modal.length < 1 && this.toggle_bg(), "undefined" != typeof ajax_settings && ajax_settings.url) {
                    var self = this,
                        old_success = "undefined" != typeof ajax_settings.success ? ajax_settings.success : null;
                    $.extend(ajax_settings, {
                        success: function(data, textStatus, jqXHR) {
                            $.isFunction(old_success) && old_success(data, textStatus, jqXHR), modal.html(data), $(modal).foundation("section", "reflow"), self.hide(open_modal, self.settings.css.close), self.show(modal, self.settings.css.open)
                        }
                    }), $.ajax(ajax_settings)
                } else this.hide(open_modal, this.settings.css.close), this.show(modal, this.settings.css.open)
            }
        },
        close: function(modal) {
            var modal = modal && modal.length ? modal : $(this.scope),
                open_modals = $(".reveal-modal.open");
            open_modals.length > 0 && (this.locked = !0, modal.trigger("close"), this.toggle_bg(), this.hide(open_modals, this.settings.css.close))
        },
        close_targets: function() {
            var base = "." + this.settings.dismissModalClass;
            return this.settings.closeOnBackgroundClick ? base + ", ." + this.settings.bgClass : base
        },
        toggle_bg: function() {
            0 === $("." + this.settings.bgClass).length && (this.settings.bg = $("<div />", {
                "class": this.settings.bgClass
            }).appendTo("body")), this.settings.bg.filter(":visible").length > 0 ? this.hide(this.settings.bg) : this.show(this.settings.bg)
        },
        show: function(el, css) {
            if (css) {
                if (0 === el.parent("body").length) {
                    var placeholder = el.wrap('<div style="display: none;" />').parent();
                    el.on("closed.fndtn.reveal.wrapped", function() {
                        el.detach().appendTo(placeholder), el.unwrap().unbind("closed.fndtn.reveal.wrapped")
                    }), el.detach().appendTo("body")
                }
                if (/pop/i.test(this.settings.animation)) {
                    css.top = $(window).scrollTop() - el.data("offset") + "px";
                    var end_css = {
                        top: $(window).scrollTop() + el.data("css-top") + "px",
                        opacity: 1
                    };
                    return this.delay(function() {
                        return el.css(css).animate(end_css, this.settings.animationSpeed, "linear", function() {
                            this.locked = !1, el.trigger("opened")
                        }.bind(this)).addClass("open")
                    }.bind(this), this.settings.animationSpeed / 2)
                }
                if (/fade/i.test(this.settings.animation)) {
                    var end_css = {
                        opacity: 1
                    };
                    return this.delay(function() {
                        return el.css(css).animate(end_css, this.settings.animationSpeed, "linear", function() {
                            this.locked = !1, el.trigger("opened")
                        }.bind(this)).addClass("open")
                    }.bind(this), this.settings.animationSpeed / 2)
                }
                return el.css(css).show().css({
                    opacity: 1
                }).addClass("open").trigger("opened")
            }
            return /fade/i.test(this.settings.animation) ? el.fadeIn(this.settings.animationSpeed / 2) : el.show()
        },
        hide: function(el, css) {
            if (css) {
                if (/pop/i.test(this.settings.animation)) {
                    var end_css = {
                        top: -$(window).scrollTop() - el.data("offset") + "px",
                        opacity: 0
                    };
                    return this.delay(function() {
                        return el.animate(end_css, this.settings.animationSpeed, "linear", function() {
                            this.locked = !1, el.css(css).trigger("closed")
                        }.bind(this)).removeClass("open")
                    }.bind(this), this.settings.animationSpeed / 2)
                }
                if (/fade/i.test(this.settings.animation)) {
                    var end_css = {
                        opacity: 0
                    };
                    return this.delay(function() {
                        return el.animate(end_css, this.settings.animationSpeed, "linear", function() {
                            this.locked = !1, el.css(css).trigger("closed")
                        }.bind(this)).removeClass("open")
                    }.bind(this), this.settings.animationSpeed / 2)
                }
                return el.hide().css(css).removeClass("open").trigger("closed")
            }
            return /fade/i.test(this.settings.animation) ? el.fadeOut(this.settings.animationSpeed / 2) : el.hide()
        },
        close_video: function(e) {
            var video = $(this).find(".flex-video"),
                iframe = video.find("iframe");
            iframe.length > 0 && (iframe.attr("data-src", iframe[0].src), iframe.attr("src", "about:blank"), video.hide())
        },
        open_video: function(e) {
            var video = $(this).find(".flex-video"),
                iframe = video.find("iframe");
            if (iframe.length > 0) {
                var data_src = iframe.attr("data-src");
                if ("string" == typeof data_src) iframe[0].src = iframe.attr("data-src");
                else {
                    var src = iframe[0].src;
                    iframe[0].src = undefined, iframe[0].src = src
                }
                video.show()
            }
        },
        cache_offset: function(modal) {
            var offset = modal.show().height() + parseInt(modal.css("top"), 10);
            return modal.hide(), offset
        },
        off: function() {
            $(this.scope).off(".fndtn.reveal")
        },
        reflow: function() {}
    }
}(Foundation.zj, this, this.document),
function($, window, document) {
    "use strict";
    Foundation.libs.section = {
        name: "section",
        version: "4.3.2",
        settings: {
            deep_linking: !1,
            small_breakpoint: 768,
            one_up: !0,
            multi_expand: !1,
            section_selector: "[data-section]",
            region_selector: "section, .section, [data-section-region]",
            title_selector: ".title, [data-section-title]",
            resized_data_attr: "data-section-resized",
            small_style_data_attr: "data-section-small-style",
            content_selector: ".content, [data-section-content]",
            nav_selector: '[data-section="vertical-nav"], [data-section="horizontal-nav"]',
            active_class: "active",
            callback: function() {}
        },
        init: function(scope, method, options) {
            var self = this;
            return Foundation.inherit(this, "throttle data_options position_right offset_right"), "object" == typeof method && $.extend(!0, self.settings, method), "string" != typeof method ? (this.events(), !0) : this[method].call(this, options)
        },
        events: function() {
            for (var self = this, click_title_selectors = [], section_selector = self.settings.section_selector, region_selectors = self.settings.region_selector.split(","), title_selectors = self.settings.title_selector.split(","), i = 0, len = region_selectors.length; len > i; i++)
                for (var region_selector = region_selectors[i], j = 0, len1 = title_selectors.length; len1 > j; j++) {
                    var title_selector = section_selector + ">" + region_selector + ">" + title_selectors[j];
                    click_title_selectors.push(title_selector + " a"), click_title_selectors.push(title_selector)
                }
            $(self.scope).on("click.fndtn.section", click_title_selectors.join(","), function(e) {
                var title = $(this).closest(self.settings.title_selector);
                self.close_navs(title), title.siblings(self.settings.content_selector).length > 0 && self.toggle_active.call(title[0], e)
            }), $(window).on("resize.fndtn.section", self.throttle(function() {
                self.resize()
            }, 30)).on("hashchange.fndtn.section", self.set_active_from_hash), $(document).on("click.fndtn.section", function(e) {
                e.isPropagationStopped && e.isPropagationStopped() || e.target !== document && self.close_navs($(e.target).closest(self.settings.title_selector))
            }), $(window).triggerHandler("resize.fndtn.section"), $(window).triggerHandler("hashchange.fndtn.section")
        },
        close_navs: function(except_nav_with_title) {
            var self = Foundation.libs.section,
                navsToClose = $(self.settings.nav_selector).filter(function() {
                    return !$.extend({}, self.settings, self.data_options($(this))).one_up
                });
            if (except_nav_with_title.length > 0) {
                var section = except_nav_with_title.parent().parent();
                (self.is_horizontal_nav(section) || self.is_vertical_nav(section)) && (navsToClose = navsToClose.filter(function() {
                    return this !== section[0]
                }))
            }
            navsToClose.children(self.settings.region_selector).removeClass(self.settings.active_class)
        },
        toggle_active: function(e) {
            var $this = $(this),
                self = Foundation.libs.section,
                region = $this.parent(),
                content = $this.siblings(self.settings.content_selector),
                section = region.parent(),
                settings = $.extend({}, self.settings, self.data_options(section)),
                prev_active_region = section.children(self.settings.region_selector).filter("." + self.settings.active_class);
            !settings.deep_linking && content.length > 0 && e.preventDefault(), e.stopPropagation(), region.hasClass(self.settings.active_class) ? (region.hasClass(self.settings.active_class) && self.is_accordion(section) || !settings.one_up && (self.small(section) || self.is_vertical_nav(section) || self.is_horizontal_nav(section) || self.is_accordion(section))) && (region.removeClass(self.settings.active_class), region.trigger("closed.fndtn.section")) : ((!self.is_accordion(section) || self.is_accordion(section) && !self.settings.multi_expand) && (prev_active_region.removeClass(self.settings.active_class), prev_active_region.trigger("closed.fndtn.section")), region.addClass(self.settings.active_class), self.resize(region.find(self.settings.section_selector).not("[" + self.settings.resized_data_attr + "]"), !0), region.trigger("opened.fndtn.section")), settings.callback(section)
        },
        check_resize_timer: null,
        resize: function(sections, ensure_has_active_region) {
            var self = Foundation.libs.section,
                section_container = $(self.settings.section_selector),
                is_small_window = self.small(section_container),
                should_be_resized = function(section, now_is_hidden) {
                    return !self.is_accordion(section) && !section.is("[" + self.settings.resized_data_attr + "]") && (!is_small_window || self.is_horizontal_tabs(section)) && now_is_hidden === ("none" === section.css("display") || !section.parent().is(":visible"))
                };
            sections = sections || $(self.settings.section_selector), clearTimeout(self.check_resize_timer), is_small_window || sections.removeAttr(self.settings.small_style_data_attr), sections.filter(function() {
                return should_be_resized($(this), !1)
            }).each(function() {
                var section = $(this),
                    regions = section.children(self.settings.region_selector),
                    titles = regions.children(self.settings.title_selector),
                    content = regions.children(self.settings.content_selector),
                    titles_max_height = 0;
                if (ensure_has_active_region && 0 == section.children(self.settings.region_selector).filter("." + self.settings.active_class).length) {
                    var settings = $.extend({}, self.settings, self.data_options(section));
                    settings.deep_linking || !settings.one_up && (self.is_horizontal_nav(section) || self.is_vertical_nav(section) || self.is_accordion(section)) || regions.filter(":visible").first().addClass(self.settings.active_class)
                }
                if (self.is_horizontal_tabs(section) || self.is_auto(section)) {
                    var titles_sum_width = 0;
                    titles.each(function() {
                        var title = $(this);
                        if (title.is(":visible")) {
                            title.css(self.rtl ? "right" : "left", titles_sum_width);
                            var title_h_border_width = parseInt(title.css("border-" + (self.rtl ? "left" : "right") + "-width"), 10);
                            "Nan" === title_h_border_width.toString() && (title_h_border_width = 0), titles_sum_width += self.outerWidth(title) - title_h_border_width, titles_max_height = Math.max(titles_max_height, self.outerHeight(title))
                        }
                    }), titles.css("height", titles_max_height), regions.each(function() {
                        var region = $(this),
                            region_content = region.children(self.settings.content_selector),
                            content_top_border_width = parseInt(region_content.css("border-top-width"), 10);
                        "Nan" === content_top_border_width.toString() && (content_top_border_width = 0), region.css("padding-top", titles_max_height - content_top_border_width)
                    }), section.css("min-height", titles_max_height)
                } else if (self.is_horizontal_nav(section)) {
                    var first = !0;
                    titles.each(function() {
                        titles_max_height = Math.max(titles_max_height, self.outerHeight($(this)))
                    }), regions.each(function() {
                        var region = $(this);
                        region.css("margin-left", "-" + (first ? section : region.children(self.settings.title_selector)).css("border-left-width")), first = !1
                    }), regions.css("margin-top", "-" + section.css("border-top-width")), titles.css("height", titles_max_height), content.css("top", titles_max_height), section.css("min-height", titles_max_height)
                } else if (self.is_vertical_tabs(section)) {
                    var titles_sum_height = 0;
                    titles.each(function() {
                        var title = $(this);
                        if (title.is(":visible")) {
                            title.css("top", titles_sum_height);
                            var title_top_border_width = parseInt(title.css("border-top-width"), 10);
                            "Nan" === title_top_border_width.toString() && (title_top_border_width = 0), titles_sum_height += self.outerHeight(title) - title_top_border_width
                        }
                    }), content.css("min-height", titles_sum_height + 1)
                } else if (self.is_vertical_nav(section)) {
                    var titles_max_width = 0,
                        first1 = !0;
                    titles.each(function() {
                        titles_max_width = Math.max(titles_max_width, self.outerWidth($(this)))
                    }), regions.each(function() {
                        var region = $(this);
                        region.css("margin-top", "-" + (first1 ? section : region.children(self.settings.title_selector)).css("border-top-width")), first1 = !1
                    }), titles.css("width", titles_max_width), content.css(self.rtl ? "right" : "left", titles_max_width), section.css("width", titles_max_width)
                }
                section.attr(self.settings.resized_data_attr, !0)
            }), $(self.settings.section_selector).filter(function() {
                return should_be_resized($(this), !0)
            }).length > 0 && (self.check_resize_timer = setTimeout(function() {
                self.resize(sections.filter(function() {
                    return should_be_resized($(this), !1)
                }), !0)
            }, 700)), is_small_window && sections.attr(self.settings.small_style_data_attr, !0)
        },
        is_vertical_nav: function(el) {
            return /vertical-nav/i.test(el.data("section"))
        },
        is_horizontal_nav: function(el) {
            return /horizontal-nav/i.test(el.data("section"))
        },
        is_accordion: function(el) {
            return /accordion/i.test(el.data("section"))
        },
        is_horizontal_tabs: function(el) {
            return /^tabs$/i.test(el.data("section"))
        },
        is_vertical_tabs: function(el) {
            return /vertical-tabs/i.test(el.data("section"))
        },
        is_auto: function(el) {
            var data_section = el.data("section");
            return "" === data_section || /auto/i.test(data_section)
        },
        set_active_from_hash: function() {
            var selectedSection, self = Foundation.libs.section,
                hash = window.location.hash.substring(1),
                sections = $(self.settings.section_selector);
            sections.each(function() {
                var section = $(this),
                    regions = section.children(self.settings.region_selector);
                return regions.each(function() {
                    var region = $(this),
                        data_slug = region.children(self.settings.content_selector).data("slug");
                    return new RegExp(data_slug, "i").test(hash) ? (selectedSection = section, !1) : void 0
                }), null != selectedSection ? !1 : void 0
            }), null != selectedSection && sections.each(function() {
                if (selectedSection == $(this)) {
                    var section = $(this),
                        settings = $.extend({}, self.settings, self.data_options(section)),
                        regions = section.children(self.settings.region_selector),
                        set_active_from_hash = settings.deep_linking && hash.length > 0,
                        selected = !1;
                    regions.each(function() {
                        var region = $(this);
                        if (selected) region.removeClass(self.settings.active_class);
                        else if (set_active_from_hash) {
                            var data_slug = region.children(self.settings.content_selector).data("slug");
                            data_slug && new RegExp(data_slug, "i").test(hash) ? (region.hasClass(self.settings.active_class) || region.addClass(self.settings.active_class), selected = !0) : region.removeClass(self.settings.active_class)
                        } else region.hasClass(self.settings.active_class) && (selected = !0)
                    }), selected || !settings.one_up && (self.is_horizontal_nav(section) || self.is_vertical_nav(section) || self.is_accordion(section)) || regions.filter(":visible").first().addClass(self.settings.active_class)
                }
            })
        },
        reflow: function() {
            var self = Foundation.libs.section;
            $(self.settings.section_selector).removeAttr(self.settings.resized_data_attr), self.throttle(function() {
                self.resize()
            }, 30)()
        },
        small: function(el) {
            var settings = $.extend({}, this.settings, this.data_options(el));
            return this.is_horizontal_tabs(el) ? !1 : el && this.is_accordion(el) ? !0 : $("html").hasClass("lt-ie9") ? !0 : $("html").hasClass("ie8compat") ? !0 : $(this.scope).width() < settings.small_breakpoint
        },
        off: function() {
            $(this.scope).off(".fndtn.section"), $(window).off(".fndtn.section"), $(document).off(".fndtn.section")
        }
    }, $.fn.reflow_section = function(ensure_has_active_region) {
        var section = this,
            self = Foundation.libs.section;
        return section.removeAttr(self.settings.resized_data_attr), self.throttle(function() {
            self.resize(section, ensure_has_active_region)
        }, 30)(), this
    }
}(Foundation.zj, window, document),
function($, window, document, undefined) {
    "use strict";
    Foundation.libs.tooltips = {
        name: "tooltips",
        version: "4.3.2",
        settings: {
            selector: ".has-tip",
            additionalInheritableClasses: [],
            tooltipClass: ".tooltip",
            touchCloseText: "tap to close",
            appendTo: "body",
            "disable-for-touch": !1,
            tipTemplate: function(selector, content) {
                return '<span data-selector="' + selector + '" class="' + Foundation.libs.tooltips.settings.tooltipClass.substring(1) + '">' + content + '<span class="nub"></span></span>'
            }
        },
        cache: {},
        init: function(scope, method, options) {
            Foundation.inherit(this, "data_options");
            var self = this;
            return "object" == typeof method ? $.extend(!0, this.settings, method) : "undefined" != typeof options && $.extend(!0, this.settings, options), "string" == typeof method ? this[method].call(this, options) : void(Modernizr.touch ? $(this.scope).on("click.fndtn.tooltip touchstart.fndtn.tooltip touchend.fndtn.tooltip", "[data-tooltip]", function(e) {
                var settings = $.extend({}, self.settings, self.data_options($(this)));
                settings["disable-for-touch"] || (e.preventDefault(), $(settings.tooltipClass).hide(), self.showOrCreateTip($(this)))
            }).on("click.fndtn.tooltip touchstart.fndtn.tooltip touchend.fndtn.tooltip", this.settings.tooltipClass, function(e) {
                e.preventDefault(), $(this).fadeOut(150)
            }) : $(this.scope).on("mouseenter.fndtn.tooltip mouseleave.fndtn.tooltip", "[data-tooltip]", function(e) {
                var $this = $(this);
                /enter|over/i.test(e.type) ? self.showOrCreateTip($this) : "mouseout" !== e.type && "mouseleave" !== e.type || self.hide($this)
            }))
        },
        showOrCreateTip: function($target) {
            var $tip = this.getTip($target);
            return $tip && $tip.length > 0 ? this.show($target) : this.create($target)
        },
        getTip: function($target) {
            var selector = this.selector($target),
                tip = null;
            return selector && (tip = $('span[data-selector="' + selector + '"]' + this.settings.tooltipClass)), "object" == typeof tip ? tip : !1
        },
        selector: function($target) {
            var id = $target.attr("id"),
                dataSelector = $target.attr("data-tooltip") || $target.attr("data-selector");
            return (id && id.length < 1 || !id) && "string" != typeof dataSelector && (dataSelector = "tooltip" + Math.random().toString(36).substring(7), $target.attr("data-selector", dataSelector)), id && id.length > 0 ? id : dataSelector
        },
        create: function($target) {
            var $tip = $(this.settings.tipTemplate(this.selector($target), $("<div></div>").html($target.attr("title")).html())),
                classes = this.inheritable_classes($target);
            $tip.addClass(classes).appendTo(this.settings.appendTo), Modernizr.touch && $tip.append('<span class="tap-to-close">' + this.settings.touchCloseText + "</span>"), $target.removeAttr("title").attr("title", ""), this.show($target)
        },
        reposition: function(target, tip, classes) {
            var width, nub, nubHeight, nubWidth, objPos;
            if (tip.css("visibility", "hidden").show(), width = target.data("width"), nub = tip.children(".nub"), nubHeight = this.outerHeight(nub), nubWidth = this.outerHeight(nub), objPos = function(obj, top, right, bottom, left, width) {
                    return obj.css({
                        top: top ? top : "auto",
                        bottom: bottom ? bottom : "auto",
                        left: left ? left : "auto",
                        right: right ? right : "auto",
                        width: width ? width : "auto"
                    }).end()
                }, objPos(tip, target.offset().top + this.outerHeight(target) + 10, "auto", "auto", target.offset().left, width), $(window).width() < 767) objPos(tip, target.offset().top + this.outerHeight(target) + 10, "auto", "auto", 12.5, $(this.scope).width()), tip.addClass("tip-override"), objPos(nub, -nubHeight, "auto", "auto", target.offset().left);
            else {
                var left = target.offset().left;
                Foundation.rtl && (left = target.offset().left + target.offset().width - this.outerWidth(tip)), objPos(tip, target.offset().top + this.outerHeight(target) + 10, "auto", "auto", left, width), tip.removeClass("tip-override"), classes && classes.indexOf("tip-top") > -1 ? objPos(tip, target.offset().top - this.outerHeight(tip), "auto", "auto", left, width).removeClass("tip-override") : classes && classes.indexOf("tip-left") > -1 ? objPos(tip, target.offset().top + this.outerHeight(target) / 2 - 2.5 * nubHeight, "auto", "auto", target.offset().left - this.outerWidth(tip) - nubHeight, width).removeClass("tip-override") : classes && classes.indexOf("tip-right") > -1 && objPos(tip, target.offset().top + this.outerHeight(target) / 2 - 2.5 * nubHeight, "auto", "auto", target.offset().left + this.outerWidth(target) + nubHeight, width).removeClass("tip-override")
            }
            tip.css("visibility", "visible").hide()
        },
        inheritable_classes: function(target) {
            var inheritables = ["tip-top", "tip-left", "tip-bottom", "tip-right", "noradius"].concat(this.settings.additionalInheritableClasses),
                classes = target.attr("class"),
                filtered = classes ? $.map(classes.split(" "), function(el, i) {
                    return -1 !== $.inArray(el, inheritables) ? el : void 0
                }).join(" ") : "";
            return $.trim(filtered)
        },
        show: function($target) {
            var $tip = this.getTip($target);
            this.reposition($target, $tip, $target.attr("class")), $tip.fadeIn(150)
        },
        hide: function($target) {
            var $tip = this.getTip($target);
            $tip.fadeOut(150)
        },
        reload: function() {
            var $self = $(this);
            return $self.data("fndtn-tooltips") ? $self.foundationTooltips("destroy").foundationTooltips("init") : $self.foundationTooltips("init")
        },
        off: function() {
            $(this.scope).off(".fndtn.tooltip"), $(this.settings.tooltipClass).each(function(i) {
                $("[data-tooltip]").get(i).attr("title", $(this).text())
            }).remove()
        },
        reflow: function() {}
    }
}(Foundation.zj, this, this.document),
function($, window, document, undefined) {
    "use strict";
    Foundation.libs.topbar = {
        name: "topbar",
        version: "4.3.2",
        settings: {
            index: 0,
            stickyClass: "sticky",
            custom_back_text: !0,
            back_text: "Back",
            is_hover: !0,
            mobile_show_parent_link: !1,
            scrolltop: !0,
            init: !1
        },
        init: function(section, method, options) {
            Foundation.inherit(this, "data_options addCustomRule");
            var self = this;
            return "object" == typeof method ? $.extend(!0, this.settings, method) : "undefined" != typeof options && $.extend(!0, this.settings, options), "string" != typeof method ? ($(".top-bar, [data-topbar]").each(function() {
                $.extend(!0, self.settings, self.data_options($(this))), self.settings.$w = $(window), self.settings.$topbar = $(this), self.settings.$section = self.settings.$topbar.find("section"), self.settings.$titlebar = self.settings.$topbar.children("ul").first(), self.settings.$topbar.data("index", 0);
                var topbarContainer = self.settings.$topbar.parent();
                topbarContainer.hasClass("fixed") || topbarContainer.hasClass(self.settings.stickyClass) ? (self.settings.$topbar.data("height", self.outerHeight(topbarContainer)), self.settings.$topbar.data("stickyoffset", topbarContainer.offset().top)) : self.settings.$topbar.data("height", self.outerHeight(self.settings.$topbar));
                var breakpoint = $("<div class='top-bar-js-breakpoint'/>").insertAfter(self.settings.$topbar);
                self.settings.breakPoint = breakpoint.width(), breakpoint.remove(), self.assemble(), self.settings.is_hover && self.settings.$topbar.find(".has-dropdown").addClass("not-click"), self.addCustomRule(".f-topbar-fixed { padding-top: " + self.settings.$topbar.data("height") + "px }"), self.settings.$topbar.parent().hasClass("fixed") && $("body").addClass("f-topbar-fixed")
            }), self.settings.init || this.events(), this.settings.init) : this[method].call(this, options)
        },
        toggle: function() {
            var self = this,
                topbar = $(".top-bar, [data-topbar]"),
                section = topbar.find("section, .section");
            self.breakpoint() && (self.rtl ? (section.css({
                right: "0%"
            }), section.find(">.name").css({
                right: "100%"
            })) : (section.css({
                left: "0%"
            }), section.find(">.name").css({
                left: "100%"
            })), section.find("li.moved").removeClass("moved"), topbar.data("index", 0), topbar.toggleClass("expanded").css("height", "")), self.settings.scrolltop ? topbar.hasClass("expanded") ? topbar.parent().hasClass("fixed") && (self.settings.scrolltop ? (topbar.parent().removeClass("fixed"), topbar.addClass("fixed"), $("body").removeClass("f-topbar-fixed"), window.scrollTo(0, 0)) : topbar.parent().removeClass("expanded")) : topbar.hasClass("fixed") && (topbar.parent().addClass("fixed"), topbar.removeClass("fixed"), $("body").addClass("f-topbar-fixed")) : (topbar.parent().hasClass(self.settings.stickyClass) && topbar.parent().addClass("fixed"), topbar.parent().hasClass("fixed") && (topbar.hasClass("expanded") ? (topbar.addClass("fixed"), topbar.parent().addClass("expanded")) : (topbar.removeClass("fixed"), topbar.parent().removeClass("expanded"), self.updateStickyPositioning())))
        },
        timer: null,
        events: function() {
            var self = this;
            $(this.scope).off(".fndtn.topbar").on("click.fndtn.topbar", ".top-bar .toggle-topbar, [data-topbar] .toggle-topbar", function(e) {
                e.preventDefault(), self.toggle()
            }).on("click.fndtn.topbar", ".top-bar li.has-dropdown", function(e) {
                var li = $(this),
                    target = $(e.target),
                    topbar = li.closest("[data-topbar], .top-bar");
                topbar.data("topbar");
                return target.data("revealId") ? void self.toggle() : void(self.breakpoint() || self.settings.is_hover && !Modernizr.touch || (e.stopImmediatePropagation(), "A" === target[0].nodeName && target.parent().hasClass("has-dropdown") && e.preventDefault(), li.hasClass("hover") ? (li.removeClass("hover").find("li").removeClass("hover"), li.parents("li.hover").removeClass("hover")) : li.addClass("hover")))
            }).on("click.fndtn.topbar", ".top-bar .has-dropdown>a, [data-topbar] .has-dropdown>a", function(e) {
                if (self.breakpoint() && $(window).width() != self.settings.breakPoint) {
                    e.preventDefault();
                    var $this = $(this),
                        topbar = $this.closest(".top-bar, [data-topbar]"),
                        section = topbar.find("section, .section"),
                        $selectedLi = ($this.next(".dropdown").outerHeight(), $this.closest("li"));
                    topbar.data("index", topbar.data("index") + 1), $selectedLi.addClass("moved"), self.rtl ? (section.css({
                        right: -(100 * topbar.data("index")) + "%"
                    }), section.find(">.name").css({
                        right: 100 * topbar.data("index") + "%"
                    })) : (section.css({
                        left: -(100 * topbar.data("index")) + "%"
                    }), section.find(">.name").css({
                        left: 100 * topbar.data("index") + "%"
                    })), topbar.css("height", self.outerHeight($this.siblings("ul"), !0) + self.settings.$topbar.data("height"))
                }
            }), $(window).on("resize.fndtn.topbar", function() {
                if ("undefined" != typeof self.settings.$topbar) {
                    var stickyOffset, stickyContainer = self.settings.$topbar.parent("." + this.settings.stickyClass);
                    if (!self.breakpoint()) {
                        var doToggle = self.settings.$topbar.hasClass("expanded");
                        $(".top-bar, [data-topbar]").css("height", "").removeClass("expanded").find("li").removeClass("hover"), doToggle && self.toggle()
                    }
                    stickyContainer.length > 0 && (stickyContainer.hasClass("fixed") ? (stickyContainer.removeClass("fixed"), stickyOffset = stickyContainer.offset().top, $(document.body).hasClass("f-topbar-fixed") && (stickyOffset -= self.settings.$topbar.data("height")), self.settings.$topbar.data("stickyoffset", stickyOffset), stickyContainer.addClass("fixed")) : (stickyOffset = stickyContainer.offset().top, self.settings.$topbar.data("stickyoffset", stickyOffset)))
                }
            }.bind(this)), $("body").on("click.fndtn.topbar", function(e) {
                var parent = $(e.target).closest("li").closest("li.hover");
                parent.length > 0 || $(".top-bar li, [data-topbar] li").removeClass("hover")
            }), $(this.scope).on("click.fndtn", ".top-bar .has-dropdown .back, [data-topbar] .has-dropdown .back", function(e) {
                e.preventDefault();
                var $this = $(this),
                    topbar = $this.closest(".top-bar, [data-topbar]"),
                    section = topbar.find("section, .section"),
                    $movedLi = $this.closest("li.moved"),
                    $previousLevelUl = $movedLi.parent();
                topbar.data("index", topbar.data("index") - 1), self.rtl ? (section.css({
                    right: -(100 * topbar.data("index")) + "%"
                }), section.find(">.name").css({
                    right: 100 * topbar.data("index") + "%"
                })) : (section.css({
                        left: -(100 * topbar.data("index")) + "%"
                    }),
                    section.find(">.name").css({
                        left: 100 * topbar.data("index") + "%"
                    })), 0 === topbar.data("index") ? topbar.css("height", "") : topbar.css("height", self.outerHeight($previousLevelUl, !0) + self.settings.$topbar.data("height")), setTimeout(function() {
                    $movedLi.removeClass("moved")
                }, 300)
            })
        },
        breakpoint: function() {
            return $(document).width() <= this.settings.breakPoint || $("html").hasClass("lt-ie9")
        },
        assemble: function() {
            var self = this;
            this.settings.$section.detach(), this.settings.$section.find(".has-dropdown>a").each(function() {
                var $link = $(this),
                    $dropdown = $link.siblings(".dropdown"),
                    url = $link.attr("href");
                if (self.settings.mobile_show_parent_link && url && url.length > 1) var $titleLi = $('<li class="title back js-generated"><h5><a href="#"></a></h5></li><li><a class="parent-link js-generated" href="' + url + '">' + $link.text() + "</a></li>");
                else var $titleLi = $('<li class="title back js-generated"><h5><a href="#"></a></h5></li>');
                1 == self.settings.custom_back_text ? $titleLi.find("h5>a").html(self.settings.back_text) : $titleLi.find("h5>a").html("&laquo; " + $link.html()), $dropdown.prepend($titleLi)
            }), this.settings.$section.appendTo(this.settings.$topbar), this.sticky()
        },
        height: function(ul) {
            var total = 0,
                self = this;
            return ul.find("> li").each(function() {
                total += self.outerHeight($(this), !0)
            }), total
        },
        sticky: function() {
            var $window = $(window),
                self = this;
            $window.scroll(function() {
                self.updateStickyPositioning()
            })
        },
        updateStickyPositioning: function() {
            var klass = "." + this.settings.stickyClass,
                $window = $(window);
            if ($(klass).length > 0) {
                var distance = this.settings.$topbar.data("stickyoffset");
                $(klass).hasClass("expanded") || ($window.scrollTop() > distance ? $(klass).hasClass("fixed") || ($(klass).addClass("fixed"), $("body").addClass("f-topbar-fixed")) : $window.scrollTop() <= distance && $(klass).hasClass("fixed") && ($(klass).removeClass("fixed"), $("body").removeClass("f-topbar-fixed")))
            }
        },
        off: function() {
            $(this.scope).off(".fndtn.topbar"), $(window).off(".fndtn.topbar")
        },
        reflow: function() {}
    }
}(Foundation.zj, this, this.document);
var DisplayHelper;
! function(DisplayHelper) {
    function getViewport() {
        var viewPortWidth, viewPortHeight;
        return "undefined" != typeof window.innerWidth ? (viewPortWidth = window.innerWidth, viewPortHeight = window.innerHeight) : "undefined" != typeof document.documentElement && "undefined" != typeof document.documentElement.clientWidth && 0 != document.documentElement.clientWidth ? (viewPortWidth = document.documentElement.clientWidth, viewPortHeight = document.documentElement.clientHeight) : (viewPortWidth = document.getElementsByTagName("body")[0].clientWidth, viewPortHeight = document.getElementsByTagName("body")[0].clientHeight), {
            width: viewPortWidth,
            height: viewPortHeight
        }
    }

    function getOrientationChangeEvent() {
        return "resize"
    }

    function getOrientation() {
        return jQuery(window).width() > jQuery(window).height() ? "landscape" : "portrait"
    }

    function getDimensions(element, display, type) {
        if (void 0 == display) var display = !0;
        if (void 0 == type) var type = "outer";
        var width, height, defaultCss = {
            width: element.css("width"),
            position: element.css("position"),
            top: element.css("top"),
            left: element.css("left")
        };
        return element.css({
            width: "auto",
            position: "fixed",
            top: -1e4,
            left: -1e4
        }), display && element.show(), "default" == type ? (width = element.width(), height = element.height()) : "outer" == type ? (width = element.outerWidth(), height = element.outerHeight()) : "outerTrue" == type && (width = element.outerWidth(!0), height = element.outerHeight(!0)), display && element.hide(), element.css(defaultCss), {
            width: width,
            height: height
        }
    }
    DisplayHelper.getViewport = getViewport, DisplayHelper.getOrientationChangeEvent = getOrientationChangeEvent, DisplayHelper.getOrientation = getOrientation, DisplayHelper.getDimensions = getDimensions
}(DisplayHelper || (DisplayHelper = {}));
var ObjectHelper;
! function(ObjectHelper) {
    function getObjectLength(object) {
        var i, count = 0;
        for (i in object) object.hasOwnProperty(i) && count++;
        return count
    }

    function mergeObject(obj1, obj2) {
        for (var p in obj2) try {
            obj2[p].constructor == Object ? obj1[p] = ObjectHelper.mergeObject(obj1[p], obj2[p]) : obj1[p] = obj2[p]
        } catch (e) {
            obj1[p] = obj2[p]
        }
        return obj1
    }

    function getNearestValues(array, value) {
        for (var lo = -1, hi = array.length; hi - lo > 1;) {
            var mid = Math.round((lo + hi) / 2);
            array[mid] <= value ? lo = mid : hi = mid
        }
        return array[lo] == value && (hi = lo), {
            higher: array[hi],
            lower: array[lo]
        }
    }
    ObjectHelper.getObjectLength = getObjectLength, ObjectHelper.mergeObject = mergeObject, ObjectHelper.getNearestValues = getNearestValues
}(ObjectHelper || (ObjectHelper = {}));
var BrowserHelper;
! function(BrowserHelper) {
    function getScrollableElement() {
        var isWebkit = jQuery.browser.webkit;
        return isWebkit ? "body" : "html"
    }

    function isCanvasSupport() {
        var elem = document.createElement("canvas");
        return !(!elem.getContext || !elem.getContext("2d"))
    }

    function isIE() {
        return !!jQuery.browser.msie
    }

    function isIE7() {
        return !(!this.isIE() || "7.0" != jQuery.browser.version)
    }
    BrowserHelper.getScrollableElement = getScrollableElement, BrowserHelper.isCanvasSupport = isCanvasSupport, BrowserHelper.isIE = isIE, BrowserHelper.isIE7 = isIE7
}(BrowserHelper || (BrowserHelper = {}));
var ElementHelper;
! function(ElementHelper) {
    function selectorsToElements(selectors) {
        var elementObject = {};
        for (var i in selectors) {
            var element = jQuery(selectors[i]);
            elementObject[i] = element
        }
        return elementObject
    }

    function updateElements(selectors) {
        return ElementHelper.selectorsToElements(selectors)
    }

    function getSelector(element) {
        var selector = element.parents().map(function() {
            return this.tagName
        }).get().reverse().join(" ");
        selector && (selector += " " + element[0].nodeName);
        var id = element.attr("id");
        id && (selector += "#" + id);
        var classNames = element.attr("class");
        return classNames && (selector += "." + jQuery.trim(classNames).replace(/\s/gi, ".")), selector
    }

    function isOuterClick(target, element) {
        var targetIsChildrenOfElement = -1 != target.parents().index(element),
            targetIsEqualWithElement = -1 != target.index(element);
        return !targetIsChildrenOfElement && !targetIsEqualWithElement
    }
    ElementHelper.selectorsToElements = selectorsToElements, ElementHelper.updateElements = updateElements, ElementHelper.getSelector = getSelector, ElementHelper.isOuterClick = isOuterClick
}(ElementHelper || (ElementHelper = {}));
var Config;
! function(Config) {
    function get(config) {
        return configs[config]
    }

    function set(config, value) {
        configs[config] = value
    }

    function replaceAll(config) {
        configs = config
    }
    var configs = {};
    Config.get = get, Config.set = set, Config.replaceAll = replaceAll
}(Config || (Config = {}));
var common;
! function(common) {
    var plugin;
    ! function(plugin) {
        var simplePagerPlugin;
        ! function(simplePagerPlugin) {
            var SimplePagerPlugin = function() {
                function SimplePagerPlugin(config) {
                    var _this = this;
                    this._defaultConfig = {
                        containerEl: jQuery("#scroll_container"),
                        scrollEl: jQuery("#scroll_elements"),
                        contentEl: jQuery("#scroll_elements img"),
                        pagerPrevEl: jQuery("#scroll_pager_left"),
                        pagerNextEl: jQuery("#scroll_pager_right"),
                        scrollAnimationDelay: 1,
                        axis: "x",
                        isContentFitToContainer: !0
                    }, this.position = 0, this._config = ObjectHelper.mergeObject(this._defaultConfig, config), this.containerEl = this._config.containerEl, this.scrollEl = this._config.scrollEl, this.contentEl = this._config.contentEl, this.pagerPrevEl = this._config.pagerPrevEl, this.pagerNextEl = this._config.pagerNextEl, this.scrollAnimationDelay = this._config.scrollAnimationDelay, this.axis = this._config.axis, this.isContentFitToContainer = this._config.isContentFitToContainer, this.allElement = this.contentEl.length, this.containerEl.addClass("page_first"), "x" == this.axis ? this._setScrollWidth() : this._setScrollHeight(), this.iScroll = new iScroll(this.containerEl[0], {
                        snap: !0,
                        snapThreshold: this.scrollAnimationDelay,
                        momentum: !1,
                        hScrollbar: !1,
                        vScrollbar: !1,
                        onScrollStart: function() {
                            _this.scrollEl.trigger(SimplePagerPlugin.ANIMATE_START)
                        },
                        onScrollEnd: function() {
                            _this.position = "x" == _this.axis ? _this.iScroll.currPageX : _this.iScroll.currPageY, _this.containerEl.removeClass("page_first"), _this.containerEl.removeClass("page_last"), 0 == _this.position ? _this.containerEl.addClass("page_first") : _this.position == _this.allElement - 1 && _this.containerEl.addClass("page_last"), _this.scrollEl.trigger(SimplePagerPlugin.ANIMATE_END)
                        }
                    }), this.pagerPrevEl.unbind("click.simplePagerPlugin").bind("click.simplePagerPlugin", function(e) {
                        _this._onPagerPrevClick(e)
                    }), this.pagerNextEl.unbind("click.simplePagerPlugin").bind("click.simplePagerPlugin", function(e) {
                        _this._onPagerNextClick(e)
                    }), jQuery(window).unbind("resize.simplePagerPlugin").bind("resize.simplePagerPlugin", function(e) {
                        _this._onWindowResize(e)
                    }), console.log("SimplePagerPlugin.ts init done.")
                }
                return SimplePagerPlugin.prototype._onWindowResize = function(e) {
                    this.containerEl.is(":visible") && ("x" == this.axis ? this._setScrollWidth() : this._setScrollHeight(), this.iScroll.refresh(), this.iScroll.scrollToPage(0, 0))
                }, SimplePagerPlugin.prototype._setScrollWidth = function() {
                    var scrollWidth;
                    this.isContentFitToContainer && this.contentEl.css({
                        width: this.containerEl.width()
                    }), scrollWidth = this.contentEl.length * this.contentEl.outerWidth(!0), this.scrollEl.width(scrollWidth), this.contentEl.show()
                }, SimplePagerPlugin.prototype._setScrollHeight = function() {
                    var scrollHeight;
                    this.isContentFitToContainer && this.contentEl.css({
                        height: this.containerEl.height()
                    }), scrollHeight = this.contentEl.length * this.contentEl.outerHeight(!0), this.scrollEl.height(scrollHeight), this.contentEl.show()
                }, SimplePagerPlugin.prototype._onPagerPrevClick = function(e) {
                    e.preventDefault(), "x" == this.axis ? this.iScroll.scrollToPage(this.position - 1, 0) : this.iScroll.scrollToPage(0, this.position - 1)
                }, SimplePagerPlugin.prototype._onPagerNextClick = function(e) {
                    e.preventDefault(), "x" == this.axis ? this.iScroll.scrollToPage(this.position + 1, 0) : this.iScroll.scrollToPage(0, this.position + 1)
                }, SimplePagerPlugin.ANIMATE_START = "animate_start", SimplePagerPlugin.ANIMATE_END = "animate_end", SimplePagerPlugin
            }();
            simplePagerPlugin.SimplePagerPlugin = SimplePagerPlugin
        }(simplePagerPlugin = plugin.simplePagerPlugin || (plugin.simplePagerPlugin = {}))
    }(plugin = common.plugin || (common.plugin = {}))
}(common || (common = {}));
var CB;
! function(CB) {
    var Base = function() {
        function Base(config) {
            this.instanceConfig = config
        }
        return Base.prototype.init = function() {
            this.setConfig(), this.setElements()
        }, Base.prototype.setConfig = function() {
            this.config = ObjectHelper.mergeObject(this.defaultConfig, this.instanceConfig)
        }, Base.prototype.setElements = function() {
            this.elements = ElementHelper.selectorsToElements(this.config.selectors)
        }, Base.prototype.unbind = function() {
            for (var i = 0; i < this.events.length; i++) {
                var event = this.events[i];
                0 != event.el.length && jQuery.isFunction(event.fn) && event.el.off(event.ev)
            }
        }, Base.prototype.bind = function() {
            for (var i = 0; i < this.events.length; i++) {
                var event = this.events[i];
                0 != event.el.length && jQuery.isFunction(event.fn) && event.el.on(event.ev, event.fn)
            }
        }, Base
    }();
    CB.Base = Base
}(CB || (CB = {}));
var __extends = this && this.__extends || function(d, b) {
        function __() {
            this.constructor = d
        }
        for (var p in b) b.hasOwnProperty(p) && (d[p] = b[p]);
        __.prototype = b.prototype, d.prototype = new __
    },
    CB;
! function(CB) {
    var controller;
    ! function(controller) {
        var CourtTypeController = function(_super) {
            function CourtTypeController(config) {
                _super.call(this, config), this.defaultConfig = {
                    settings: {
                        typeNameDataAttr: "data-type-name"
                    },
                    selectors: {
                        container: "#" + CB.Core.Pages.courtType.id,
                        pageContent: "#" + CB.Core.Pages.courtType.id + " .content",
                        courtTypeViewport: "#" + CB.Core.Pages.courtType.id + " .mobile .viewport",
                        courtTypeOverview: "#" + CB.Core.Pages.courtType.id + " .mobile .overview",
                        courtTypePagerLeft: "#" + CB.Core.Pages.courtType.id + " .mobile .pager_left",
                        courtTypePagerRight: "#" + CB.Core.Pages.courtType.id + " .mobile .pager_right",
                        courtTypeMobileItem: "#" + CB.Core.Pages.courtType.id + " .mobile a.court_type",
                        courtTypeItem: "#" + CB.Core.Pages.courtType.id + " a.court_type"
                    }
                }, this._waitingForResponse = !1
            }
            return __extends(CourtTypeController, _super), CourtTypeController.prototype.create = function() {
                var _this = this;
                this.init(), this.events = [{
                    el: this.elements.courtTypeItem,
                    ev: "click.onCourtTypeItemClick",
                    fn: function(e) {
                        _this._onCourtTypeItemClick(e)
                    }
                }, {
                    el: jQuery(window),
                    ev: "resize.onCourtTypeResize",
                    fn: function() {
                        _this._onCourtTypeResize()
                    }
                }], this.unbind(), this.bind(), this._typePagerPluginConfig = {
                    containerEl: this.elements.courtTypeViewport,
                    scrollEl: this.elements.courtTypeOverview,
                    contentEl: this.elements.courtTypeMobileItem,
                    pagerPrevEl: this.elements.courtTypePagerLeft,
                    pagerNextEl: this.elements.courtTypePagerRight
                }, this._typePagerPlugin = new common.plugin.simplePagerPlugin.SimplePagerPlugin(this._typePagerPluginConfig), CB.Core.setPagesHeight(jQuery("#" + CB.Core.Pages.courtType.id)), CB.Core.setContentCenter(jQuery("#" + CB.Core.Pages.courtType.id), this.elements.pageContent)
            }, CourtTypeController.prototype.destroy = function() {
                this.unbind()
            }, CourtTypeController.prototype._onCourtTypeResize = function() {
                CB.Core.setPagesHeight(jQuery("#" + CB.Core.Pages.courtType.id)), CB.Core.setContentCenter(jQuery("#" + CB.Core.Pages.courtType.id), this.elements.pageContent)
            }, CourtTypeController.prototype._onCourtTypeItemClick = function(e) {
                var _this = this;
                if (e.preventDefault(), !this._waitingForResponse) {
                    var el = jQuery(e.currentTarget),
                        href = el.attr("href");
                    CourtTypeController.SELECTED_TYPE = el.attr(this.config.settings.typeNameDataAttr), this._waitingForResponse = !0, jQuery.ajax({
                        url: href,
                        type: "POST",
                        failure: function(response) {
                            _this._waitingForResponse = !1, console.error(response)
                        },
                        success: function(response) {
                            _this._onCourtTypeItemAjaxSuccess(response)
                        }
                    })
                }
            }, CourtTypeController.prototype._onCourtTypeItemAjaxSuccess = function(response) {
                var _this = this,
                    block = (response.success, response.block);
                CB.Core.Navigation.appendPage(block), CB.Core.Navigation.setCurrentPage(CB.Core.Pages.courtSize, function() {
                    _this._waitingForResponse = !1
                })
            }, CourtTypeController.SELECTED_TYPE = "", CourtTypeController
        }(CB.Base);
        controller.CourtTypeController = CourtTypeController
    }(controller = CB.controller || (CB.controller = {}))
}(CB || (CB = {}));
var CB;
! function(CB) {
    var bootstrap;
    ! function(bootstrap) {
        var Bootstrap = function() {
            function Bootstrap() {
                Config.replaceAll(window.jsVars)
            }
            return Bootstrap
        }();
        bootstrap.Bootstrap = Bootstrap
    }(bootstrap = CB.bootstrap || (CB.bootstrap = {}))
}(CB || (CB = {}));
var CB;
! function(CB) {
    var controller;
    ! function(controller) {
        var CourtSizeController = function(_super) {
            function CourtSizeController(config) {
                _super.call(this, config), this.defaultConfig = {
                    settings: {
                        activeStepClass: "active",
                        activeSetupClass: "active",
                        inputWidthDataAttr: "data-width",
                        inputHeightDataAttr: "data-height",
                        inputSquareDataAttr: "data-square",
                        setupIdDataAttr: "data-value",
                        sizeIdDataAttr: "data-size-id",
                        editBtnTypeDataAttr: "data-edit-type",
                        submitBtnDisabledClass: "disabled",
                        dataStepNameAttr: "data-step-name",
                        dataPredefinedIdAttr: "data-court-type-size-id"
                    },
                    selectors: {
                        pageContent: "#" + CB.Core.Pages.courtSize.id + " > .content",
                        courtSizeStepContainer: "#" + CB.Core.Pages.courtSize.id + " .step_list",
                        courtSizeStepItem: "#" + CB.Core.Pages.courtSize.id + " .step_list .step",
                        courtSizeStepSubmitBtn: "#" + CB.Core.Pages.courtSize.id + " .send_button",
                        customSizeWidthInput: "#" + CB.Core.Pages.courtSize.id + " #custom_width",
                        customSizeHeightInput: "#" + CB.Core.Pages.courtSize.id + " #custom_height",
                        sizeIdInput: "#" + CB.Core.Pages.courtSize.id + " #sizeId",
                        setupIdInput: "#" + CB.Core.Pages.courtSize.id + " #setupId",
                        sizesSubmitBtn: "#" + CB.Core.Pages.courtSize.id + " .sizes .send_button",
                        sizeSelectRadios: "#" + CB.Core.Pages.courtSize.id + ' .sizes .select [name="size"]',
                        selectedSizeWidth: "#" + CB.Core.Pages.courtSize.id + " .sizes .selected .selected_size .width",
                        selectedSizeHeight: "#" + CB.Core.Pages.courtSize.id + " .sizes .selected .selected_size .height",
                        courtSizePredefinedSetupItems: "#" + CB.Core.Pages.courtSize.id + " .predefined_setup_items",
                        setupItem: "#" + CB.Core.Pages.courtSize.id + " .setup_item",
                        editBtn: "#" + CB.Core.Pages.courtSize.id + " .edit_btn",
                        courtSizePredefinedCourtViewport: "#" + CB.Core.Pages.courtSize.id + " .mobile .viewport",
                        courtSizePredefinedCourtOverview: "#" + CB.Core.Pages.courtSize.id + " .mobile .overview",
                        courtSizePredefinedCourtMobileItem: "#" + CB.Core.Pages.courtSize.id + " .mobile .setup_item",
                        courtSizePredefinedCourtPagerLeft: "#" + CB.Core.Pages.courtSize.id + " .mobile .pager_left",
                        courtSizePredefinedCourtPagerRight: "#" + CB.Core.Pages.courtSize.id + " .mobile .pager_right"
                    }
                }, this._currentStep = null, this._predefinedCourtPagerPlugins = {}
            }
            return __extends(CourtSizeController, _super), CourtSizeController.prototype.create = function() {
                var _this = this;
                this.init(), this.events = [{
                    el: this.elements.customSizeHeightInput.add(this.elements.customSizeWidthInput),
                    ev: "keydown.onCustomSizeInputKeydown",
                    fn: function(e) {
                        _this._onCustomSizeInputKeydown(e)
                    }
                }, {
                    el: this.elements.courtSizeStepSubmitBtn,
                    ev: "click.onCourtSizeStepSubmitBtnClick",
                    fn: function(e) {
                        _this._onCourtSizeStepSubmitBtnClick(e)
                    }
                }, {
                    el: this.elements.sizeSelectRadios,
                    ev: "change.onSizeSelectRadiosChange",
                    fn: function() {
                        _this._onSizeSelectRadiosChange()
                    }
                }, {
                    el: this.elements.setupItem,
                    ev: "click.onSetupItemClick",
                    fn: function(e) {
                        _this._onSetupItemClick(e)
                    }
                }, {
                    el: this.elements.editBtn,
                    ev: "click.onEditBtnClick",
                    fn: function(e) {
                        _this._onEditBtnClick(e)
                    }
                }, {
                    el: jQuery(window),
                    ev: "resize.onCourtSizeWindowResize",
                    fn: function() {
                        _this._onCourtSizeWindowResize()
                    }
                }], this.unbind(), this.bind(), this._setInitialStep()
            }, CourtSizeController.prototype.destroy = function() {
                this.unbind()
            }, CourtSizeController.prototype._onCourtSizeWindowResize = function() {
                var _this = this;
                this._setPredefinedSetupPagerPlugin(), this.elements.courtSizeStepItem.each(function(key, value) {
                    var el = jQuery(value);
                    el.is(":visible") ? _this._displayStep(el, "show") : _this._displayStep(el, "hide")
                }), CB.Core.setPagesHeight(jQuery("#" + CB.Core.Pages.courtSize.id)), CB.Core.setContentCenter(jQuery("#" + CB.Core.Pages.courtSize.id), this.elements.pageContent)
            }, CourtSizeController.prototype._onCustomSizeInputKeydown = function(e) {
                var _this = this;
                return -1 !== jQuery.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) || 65 == e.keyCode && e.ctrlKey === !0 || e.keyCode >= 35 && e.keyCode <= 39 ? void this._setSubmitBtnDisabled() : ((e.shiftKey || e.keyCode < 48 || e.keyCode > 57) && (e.keyCode < 96 || e.keyCode > 105) && 192 != e.keyCode && e.preventDefault(), void setTimeout(function() {
                    var width = _this.elements.customSizeWidthInput.val(),
                        height = _this.elements.customSizeHeightInput.val(),
                        hasWidth = "" != width,
                        hasHeight = "" != height;
                    if (0 != _this.elements.sizeSelectRadios.filter(":checked").length && _this.elements.sizeSelectRadios.filter(":checked").prop("checked", !1).trigger("change"), hasWidth && hasHeight) {
                        var closestPredefinedSizeValue = _this._getClosestPredefinedSize(width, height),
                            predefinedId = 1;
                        _this._setSizeIdInputValue(predefinedId, closestPredefinedSizeValue, width, height)
                    }
                    _this._setSubmitBtnDisabled()
                }, 5))
            }, CourtSizeController.prototype._getClosestPredefinedSize = function(width, height) {
                var _this = this,
                    closestElement = jQuery(this.elements.sizeSelectRadios[0]),
                    widthInt = parseInt(width, 10),
                    heightInt = parseInt(height, 10),
                    square = widthInt * heightInt,
                    sizesObj = {},
                    sizes = [];
                this.elements.sizeSelectRadios.each(function(key, value) {
                    var el = jQuery(value),
                        elSquare = el.attr(_this.config.settings.inputSquareDataAttr);
                    sizes.push(elSquare), sizesObj[elSquare] = el
                });
                var nearestValue = ObjectHelper.getNearestValues(sizes, square);
                return closestElement = void 0 == nearestValue.lower ? sizesObj[nearestValue.higher] : sizesObj[nearestValue.lower], closestElement.val()
            }, CourtSizeController.prototype._onSetupItemClick = function(e) {
                e.preventDefault();
                var el = jQuery(e.currentTarget);
                this._setActiveSetupItem(el.attr(this.config.settings.setupIdDataAttr))
            }, CourtSizeController.prototype._onSizeSelectRadiosChange = function() {
                var predefinedId, selectedValue, width, height, hasCheckedOption = !1,
                    selectedRadio = this.elements.sizeSelectRadios.filter(":checked");
                0 != selectedRadio.length && (hasCheckedOption = !0, selectedValue = selectedRadio.val(), predefinedId = selectedRadio.attr(this.config.settings.dataPredefinedIdAttr), width = selectedRadio.attr(this.config.settings.inputWidthDataAttr), height = selectedRadio.attr(this.config.settings.inputHeightDataAttr), this.elements.customSizeHeightInput.val(""), this.elements.customSizeWidthInput.val("")), hasCheckedOption && this._setSizeIdInputValue(predefinedId, selectedValue, width, height), this._setSubmitBtnDisabled()
            }, CourtSizeController.prototype._setSubmitBtnDisabled = function() {
                var hasCheckedOption = 0 != this.elements.sizeSelectRadios.filter(":checked").length,
                    hasCustomWidth = "" != this.elements.customSizeWidthInput.val(),
                    hasCustomHeight = "" != this.elements.customSizeHeightInput.val();
                hasCheckedOption || hasCustomHeight && hasCustomWidth ? this.elements.sizesSubmitBtn.removeClass(this.config.settings.submitBtnDisabledClass) : hasCheckedOption || hasCustomHeight && hasCustomWidth || this.elements.sizesSubmitBtn.hasClass(this.config.settings.submitBtnDisabledClass) || this.elements.sizesSubmitBtn.addClass(this.config.settings.submitBtnDisabledClass)
            }, CourtSizeController.prototype._onEditBtnClick = function(e) {
                var _this = this;
                e.preventDefault();
                var el = jQuery(e.currentTarget),
                    editType = el.attr(this.config.settings.editBtnTypeDataAttr);
                switch (editType) {
                    case "court_type":
                        CB.Core.Navigation.setCurrentPage(CB.Core.Pages.courtType, function() {
                            CB.Core.Navigation.removePage(CB.Core.Pages.courtSize.id), _this.destroy()
                        });
                        break;
                    case "court_size":
                        this._setCurrentStep(0)
                }
            }, CourtSizeController.prototype._setActiveSetupItem = function(setupId) {
                var _this = this;
                this.elements.setupItem.each(function(key, value) {
                    var el = jQuery(value);
                    el.attr(_this.config.settings.setupIdDataAttr) == setupId ? (el.hasClass(_this.config.settings.activeSetupClass) || el.addClass(_this.config.settings.activeSetupClass), _this.elements.setupIdInput.val(el.attr(_this.config.settings.setupIdDataAttr))) : el.removeClass(_this.config.settings.activeSetupClass)
                })
            }, CourtSizeController.prototype._setSetupBySize = function(size) {
                var _this = this,
                    isSetActive = !1;
                this.elements.courtSizePredefinedSetupItems.each(function(key, value) {
                    var el = jQuery(value),
                        sizeId = el.attr(_this.config.settings.dataPredefinedIdAttr);
                    sizeId == size ? (0 == isSetActive && (_this._setActiveSetupItem(jQuery(el.find(_this.elements.setupItem)[0]).attr(_this.config.settings.setupIdDataAttr)), isSetActive = !0), el.show()) : el.hide()
                })
            }, CourtSizeController.prototype._setSizeIdInputValue = function(predefinedId, value, width, height) {
                this.elements.selectedSizeWidth.text(width), this.elements.selectedSizeHeight.text(height);
                var realSelectedSize = this.elements.sizeSelectRadios.filter("[value=" + value + "]");
                CourtSizeController.SELECTED_SIZE = {
                    real: realSelectedSize.attr(this.config.settings.inputWidthDataAttr) + "x" + realSelectedSize.attr(this.config.settings.inputHeightDataAttr),
                    custom: width + "x" + height
                }, this.elements.sizeIdInput.val(value), this._setSetupBySize(predefinedId)
            }, CourtSizeController.prototype._onCourtSizeStepSubmitBtnClick = function(e) {
                var _this = this;
                e.preventDefault();
                var el = jQuery(e.currentTarget);
                if (!el.hasClass(this.config.settings.submitBtnDisabledClass)) {
                    var step = el.parents(this.config.selectors.courtSizeStepItem),
                        stepIndex = step.index(),
                        stepsLength = this.elements.courtSizeStepItem.length - 1;
                    stepIndex != stepsLength ? this._setCurrentStep(stepIndex + 1) : jQuery.ajax({
                        url: el.attr("href"),
                        data: {
                            sizeId: this.elements.sizeIdInput.val(),
                            setupId: this.elements.setupIdInput.val()
                        },
                        type: "POST",
                        failure: function(response) {
                            console.error(response)
                        },
                        success: function(response) {
                            _this._onCourtSizeAjaxSuccess(response)
                        }
                    })
                }
            }, CourtSizeController.prototype._onCourtSizeAjaxSuccess = function(response) {
                var predefinedItems = (response.success, response.predefinedItems),
                    block = response.block;
                CB.Core.Navigation.appendPage(block), CB.Core.Navigation.setCurrentPage(CB.Core.Pages.courtOptions, function() {
                    CB.Navigation.ControllerInstances[CB.Core.Pages.courtOptions.id].pageLoadCallback(predefinedItems)
                })
            }, CourtSizeController.prototype._setInitialStep = function() {
                this._setCurrentStep(0)
            }, CourtSizeController.prototype._setCurrentStep = function(index) {
                var _this = this,
                    stepEl = jQuery(this.elements.courtSizeStepItem[index]),
                    stepName = stepEl.attr(this.config.settings.dataStepNameAttr);
                if (0 != stepEl.length) {
                    var prevStepEl = jQuery(this.elements.courtSizeStepItem[index - 1]),
                        currentStepEl = jQuery(this.elements.courtSizeStepItem[index]);
                    switch (0 != prevStepEl.length && (prevStepEl.find(".select").hide(), prevStepEl.find(".selected").show()), currentStepEl.find(".selected").hide(), currentStepEl.find(".select").show(), this.elements.courtSizeStepItem.each(function(key, value) {
                        var el = jQuery(value);
                        index >= key ? _this._displayStep(el, "show") : _this._displayStep(el, "hide")
                    }), this.elements.courtSizeStepItem.removeClass(this.config.settings.activeStepClass), stepEl.addClass(this.config.settings.activeStepClass), this._currentStep = index, stepName) {
                        case "sizes":
                            break;
                        case "setup":
                            this._setPredefinedSetupPagerPlugin()
                    }
                }
                CB.Core.setPagesHeight(jQuery("#" + CB.Core.Pages.courtSize.id)), CB.Core.setContentCenter(jQuery("#" + CB.Core.Pages.courtSize.id), this.elements.pageContent), (DisplayHelper.getViewport().width < 768 || jQuery("html").hasClass("touch")) && setTimeout(function() {
                    jQuery(window).scrollTop(stepEl.offset().top)
                }, 20)
            }, CourtSizeController.prototype._displayStep = function(el, display) {
                var showType, windowWidth = DisplayHelper.getViewport().width;
                showType = 768 > windowWidth || jQuery("html").hasClass("touch") ? "block" : "table", "show" == display ? "block" == showType ? el.css("display", "block") : el.css("display", "table-cell") : el.css("display", "none")
            }, CourtSizeController.prototype._setPredefinedSetupPagerPlugin = function() {
                var _this = this,
                    width = DisplayHelper.getViewport().width;
                (768 > width || jQuery("html").hasClass("touch")) && this.elements.courtSizePredefinedSetupItems.each(function(key, value) {
                    var el = jQuery(value),
                        visible = el.is(":visible");
                    if (visible) {
                        var pluginConfig = {
                                containerEl: el.find(_this.elements.courtSizePredefinedCourtViewport),
                                scrollEl: el.find(_this.elements.courtSizePredefinedCourtOverview),
                                contentEl: el.find(_this.elements.courtSizePredefinedCourtMobileItem),
                                pagerPrevEl: el.find(_this.elements.courtSizePredefinedCourtPagerLeft),
                                pagerNextEl: el.find(_this.elements.courtSizePredefinedCourtPagerRight)
                            },
                            plugin = new common.plugin.simplePagerPlugin.SimplePagerPlugin(pluginConfig);
                        return void(void 0 == _this._predefinedCourtPagerPlugins[el.attr(_this.config.settings.sizeIdDataAttr)] && (_this._predefinedCourtPagerPlugins[el.attr(_this.config.settings.sizeIdDataAttr)] = plugin))
                    }
                })
            }, CourtSizeController.SELECTED_SIZE = {}, CourtSizeController
        }(CB.Base);
        controller.CourtSizeController = CourtSizeController
    }(controller = CB.controller || (CB.controller = {}))
}(CB || (CB = {}));
var TooltipPositionHelper;
! function(TooltipPositionHelper) {
    function positioning(config) {
        var left, newLeft, arrowLeft, fullContainer = config.elements.fullContainer,
            fullContainerLeft = fullContainer.offset().left,
            fullContainerWidth = fullContainer.width(),
            fullContainerRight = fullContainerWidth + fullContainerLeft,
            container = config.elements.container,
            containerWidth = getDimensions(container).width,
            relative = config.elements.relative,
            arrow = config.elements.arrow,
            arrowWidth = arrow.width(),
            defaultPos = config.settings.defaultHorizontalPosition,
            positionLeft = relative.offset().left - config.settings.arrowHorizontalOffset,
            positionCenter = relative.offset().left - containerWidth / 2 + relative.width() / 2,
            positionRight = relative.offset().left - containerWidth + config.settings.arrowHorizontalOffset,
            arrowPositionLeft = config.settings.arrowHorizontalOffset,
            arrowPositionCenter = containerWidth / 2 - arrowWidth / 2,
            arrowPositionRight = containerWidth - config.settings.arrowHorizontalOffset - arrowWidth,
            windowScrollTop = jQuery(window).scrollTop(),
            top = relative.offset().top + relative.height() + arrow.height() + config.settings.extraDistanceArrowTooltip - windowScrollTop;
        switch (defaultPos) {
            case "left":
                left = positionLeft, arrowLeft = arrowPositionLeft;
                break;
            case "center":
                left = positionCenter, arrowLeft = arrowPositionCenter;
                break;
            case "right":
                left = positionRight, arrowLeft = arrowPositionRight
        }
        fullContainerLeft > left ? (newLeft = fullContainerLeft + 5, left = newLeft) : fullContainerLeft > left + containerWidth / 2 && left + containerWidth / 2 > fullContainerRight ? (newLeft = fullContainerLeft - containerWidth / 2 + fullContainerWidth / 2, left = newLeft) : left + containerWidth > fullContainerRight && (newLeft = fullContainerRight - containerWidth - 5, left = newLeft);
        var relativeCenter = relative.offset().left + relative.width() / 2;
        arrowLeft = relativeCenter - left - arrow.width() / 2, container.css({
            position: "fixed",
            top: top,
            left: left
        }), arrow.css({
            left: arrowLeft
        })
    }

    function getDimensions(element) {
        var width, height, visible = element.is(":visible");
        return element.css({
            position: "fixed",
            top: -1e4,
            left: -1e4
        }), element.show(), width = element.outerWidth(!0), height = element.outerHeight(!0), visible || element.hide(), {
            width: width,
            height: height
        }
    }
    TooltipPositionHelper.positioning = positioning, TooltipPositionHelper.getDimensions = getDimensions
}(TooltipPositionHelper || (TooltipPositionHelper = {}));
var CB;
! function(CB) {
    var plugin;
    ! function(plugin) {
        var colorPickerPlugin;
        ! function(colorPickerPlugin) {
            var ColorPickerPlugin = function(_super) {
                function ColorPickerPlugin(config) {
                    _super.call(this, config), this.defaultConfig = {
                        settings: {
                            instancePrefix: "color_picker_instance",
                            displayDuration: 100,
                            activeColorPickerClass: "active",
                            disabledColorPickerClass: "disabled",
                            selectBtnDataColorSectionAttr: "data-color-section-content",
                            colorDataColorSectionAttr: "data-color-section",
                            activeSelectBtnClass: "active",
                            activeColorSectionClass: "active",
                            activeColorClass: "active",
                            dataColorIdAttr: "data-color-id"
                        },
                        elements: {
                            fullContainer: jQuery(".full_container"),
                            parent: jQuery(".color_picker_container_parent"),
                            container: jQuery(".color_picker_container"),
                            button: jQuery(".color_picker_container .button"),
                            content: jQuery(".color_picker_container .content"),
                            contentArrow: jQuery(".color_picker_container .content .arrow"),
                            close: jQuery(".color_picker_container .close"),
                            color: jQuery(".color_picker_container .colors .color_section"),
                            colorItem: jQuery(".color_picker_container .colors .color_item"),
                            selectBtn: jQuery(".color_picker_container .buttons a"),
                            colorsWrapper: jQuery(".color_picker_container .colors_wrapper")
                        }
                    }
                }
                return __extends(ColorPickerPlugin, _super), ColorPickerPlugin.prototype.create = function() {
                    var _this = this;
                    this.setConfig(), this.elements = this.config.elements, this.events = [{
                        el: this.elements.button,
                        ev: "click." + this.config.settings.instancePrefix,
                        fn: function(e) {
                            _this._onColorPickerBtnClick(e)
                        }
                    }, {
                        el: this.elements.close,
                        ev: "click." + this.config.settings.instancePrefix,
                        fn: function(e) {
                            _this._onColorPickerCloseClick(e)
                        }
                    }, {
                        el: this.elements.selectBtn,
                        ev: "click." + this.config.settings.instancePrefix,
                        fn: function(e) {
                            _this._onColorPickerSelectBtnClick(e)
                        }
                    }, {
                        el: this.elements.colorItem,
                        ev: "click." + this.config.settings.instancePrefix,
                        fn: function(e) {
                            _this._onColorItemClick(e)
                        }
                    }, {
                        el: jQuery(window),
                        ev: "resize." + this.config.settings.instancePrefix,
                        fn: function() {
                            _this._onWindowResize()
                        }
                    }, {
                        el: jQuery(window),
                        ev: "mousewheel." + this.config.settings.instancePrefix + " MozMousePixelScroll." + this.config.settings.instancePrefix,
                        fn: function() {
                            _this._onWindowMouseWheel()
                        }
                    }, {
                        el: jQuery(window),
                        ev: "scroll." + this.config.settings.instancePrefix + " touchmove." + this.config.settings.instancePrefix,
                        fn: function() {
                            _this._onWindowScroll()
                        }
                    }, {
                        el: jQuery(document),
                        ev: "click." + this.config.settings.instancePrefix,
                        fn: function(e) {
                            _this._onDocumentClick(e)
                        }
                    }], this.unbind(), this.bind()
                }, ColorPickerPlugin.prototype.destroy = function() {
                    this.unbind()
                }, ColorPickerPlugin.prototype._onDocumentClick = function(e) {
                    var isOuterClick = ElementHelper.isOuterClick(jQuery(e.target), this.elements.content);
                    isOuterClick && this.elements.content.is(":visible") && this.close()
                }, ColorPickerPlugin.prototype._onWindowMouseWheel = function() {
                    this._setOpenedTooltipPosition()
                }, ColorPickerPlugin.prototype._onWindowScroll = function() {
                    this._setOpenedTooltipPosition()
                }, ColorPickerPlugin.prototype._onWindowResize = function() {
                    this._setOpenedTooltipPosition()
                }, ColorPickerPlugin.prototype._setOpenedTooltipPosition = function() {
                    this.elements.container.hasClass(this.config.settings.activeColorPickerClass) && (this._setTooltipPosition(), this.elements.content.show())
                }, ColorPickerPlugin.prototype._setTooltipPosition = function() {
                    var tooltipPositionConfig = {
                        settings: {
                            defaultHorizontalPosition: "center",
                            arrowHorizontalOffset: 20,
                            extraDistanceArrowTooltip: 0
                        },
                        elements: {
                            fullContainer: this.elements.fullContainer,
                            relative: this.elements.button,
                            container: this.elements.content,
                            arrow: this.elements.contentArrow
                        }
                    };
                    TooltipPositionHelper.positioning(tooltipPositionConfig)
                }, ColorPickerPlugin.prototype._onColorItemClick = function(e) {
                    e.preventDefault(), e.stopPropagation();
                    var el = jQuery(e.currentTarget);
                    this.setActiveColor(el)
                }, ColorPickerPlugin.prototype.setActiveColor = function(colorEl, force) {
                    var colorSection = colorEl.parents(this.elements.color).filter("." + this.config.settings.activeColorSectionClass);
                    colorEl.hasClass(this.config.settings.activeColorClass) && force !== !0 || (colorSection.find(this.elements.colorItem).removeClass(this.config.settings.activeColorClass), colorEl.addClass(this.config.settings.activeColorClass), jQuery.isFunction(this.config.settings.colorPickCallback) && this.config.settings.colorPickCallback(colorEl))
                }, ColorPickerPlugin.prototype._onColorPickerSelectBtnClick = function(e) {
                    e.preventDefault(), e.stopPropagation();
                    var el = jQuery(e.currentTarget),
                        dataColorSectionAttr = el.attr(this.config.settings.selectBtnDataColorSectionAttr),
                        colorSection = this.elements.color.filter("[" + this.config.settings.colorDataColorSectionAttr + "=" + dataColorSectionAttr + "]");
                    this.showColorSection(colorSection)
                }, ColorPickerPlugin.prototype.showColorSection = function(colorSection) {
                    var _this = this,
                        visible = colorSection.is(":visible"),
                        showColorSectionAttr = colorSection.attr(this.config.settings.colorDataColorSectionAttr),
                        showBtn = this.elements.selectBtn.filter("[" + this.config.settings.selectBtnDataColorSectionAttr + "=" + showColorSectionAttr + "]");
                    this.elements.color.each(function(key, value) {
                        var el = jQuery(value),
                            colorSectionAttr = el.attr(_this.config.settings.colorDataColorSectionAttr),
                            btn = _this.elements.selectBtn.filter("[" + _this.config.settings.selectBtnDataColorSectionAttr + "=" + colorSectionAttr + "]");
                        colorSectionAttr != showColorSectionAttr && (el.removeClass(_this.config.settings.activeColorSectionClass), btn.removeClass(_this.config.settings.activeSelectBtnClass))
                    }), visible || (colorSection.hasClass(this.config.settings.activeColorSectionClass) || colorSection.addClass(this.config.settings.activeColorSectionClass), showBtn.hasClass(this.config.settings.activeSelectBtnClass) || showBtn.addClass(this.config.settings.activeSelectBtnClass), this._setCustomScrollbar())
                }, ColorPickerPlugin.prototype._onColorPickerCloseClick = function(e) {
                    e.preventDefault(), e.stopPropagation(), this.close()
                }, ColorPickerPlugin.prototype._onColorPickerBtnClick = function(e) {
                    e.preventDefault(), e.stopPropagation(), this.elements.button.hasClass(this.config.settings.disabledColorPickerClass) || (this.elements.content.is(":visible") ? this.close() : this.open())
                }, ColorPickerPlugin.prototype.open = function(param) {
                    var _this = this,
                        duration = void 0 != param && param.force ? 0 : this.config.settings.displayDuration;
                    jQuery.isFunction(this.config.settings.showStartCallback) && this.config.settings.showStartCallback(), this._setTooltipPosition(), this.elements.container.hasClass(this.config.settings.activeColorClass) || this.elements.container.addClass(this.config.settings.activeColorClass), this.elements.content.slideDown(duration, function() {
                        _this._setCustomScrollbar(), jQuery.isFunction(_this.config.settings.showEndCallback) && _this.config.settings.showEndCallback(), void 0 != param && jQuery.isFunction(param.callback) && param.callback()
                    })
                }, ColorPickerPlugin.prototype.close = function(param) {
                    var _this = this,
                        duration = void 0 != param && param.force ? 0 : this.config.settings.displayDuration;
                    jQuery.isFunction(this.config.settings.hideStartCallback) && this.config.settings.hideStartCallback(), this.elements.content.slideUp(duration, function() {
                        jQuery.isFunction(_this.config.settings.hideEndCallback) && _this.config.settings.hideEndCallback(), _this.elements.container.removeClass(_this.config.settings.activeColorClass), void 0 != param && jQuery.isFunction(param.callback) && param.callback()
                    })
                }, ColorPickerPlugin.prototype._setCustomScrollbar = function() {
                    this.elements.colorsWrapper.each(function(key, value) {
                        jQuery(value).customScrollbar({})
                    })
                }, ColorPickerPlugin
            }(CB.Base);
            colorPickerPlugin.ColorPickerPlugin = ColorPickerPlugin
        }(colorPickerPlugin = plugin.colorPickerPlugin || (plugin.colorPickerPlugin = {}))
    }(plugin = CB.plugin || (CB.plugin = {}))
}(CB || (CB = {}));
var CB;
! function(CB) {
    var component;
    ! function(component) {
        var courtOptionsComponent;
        ! function(courtOptionsComponent) {
            var ColorPickerControlComponent = function(_super) {
                function ColorPickerControlComponent(config) {
                    _super.call(this, config), this.defaultConfig = {
                        settings: {
                            highZIndexClass: "high_z_index",
                            colorPickers: {}
                        },
                        elements: {}
                    }, this.colorPickerInstances = {}
                }
                return __extends(ColorPickerControlComponent, _super), ColorPickerControlComponent.prototype.create = function() {
                    this.setConfig(), this.elements = this.config.elements, this.events = [], this._setColorPickerInstances(), this.unbind(), this.bind()
                }, ColorPickerControlComponent.prototype.destroy = function() {
                    this.unbind()
                }, ColorPickerControlComponent.prototype._setColorPickerInstances = function() {
                    var _this = this,
                        colorPickers = this.config.settings.colorPickers;
                    for (var i in colorPickers) {
                        var completedSettings = colorPickers[i].settings;
                        colorPickers[i].elements;
                        completedSettings.showStartCallback = function(config) {
                            return function() {
                                _this._onColorPickerShowStartCallback(config)
                            }
                        }(colorPickers[i]), completedSettings.showEndCallback = function(config) {
                            return function() {
                                _this._onColorPickerShowEndCallback(config)
                            }
                        }(colorPickers[i]), completedSettings.hideStartCallback = function(config) {
                            return function() {
                                _this._onColorPickerHideStartCallback(config)
                            }
                        }(colorPickers[i]), completedSettings.hideEndCallback = function(config) {
                            return function() {
                                _this._onColorPickerHideEndCallback(config)
                            }
                        }(colorPickers[i]), colorPickers[i].settings = completedSettings;
                        var instance = new CB.plugin.colorPickerPlugin.ColorPickerPlugin(colorPickers[i]);
                        this.colorPickerInstances[i] = instance, instance.create()
                    }
                }, ColorPickerControlComponent.prototype._onColorPickerShowStartCallback = function(config) {
                    this.closeAll(config.settings.instancePrefix);
                    var parent = config.elements.parent;
                    jQuery.isFunction(this.config.settings.colorPickerShowCallback) && this.config.settings.colorPickerShowCallback(), parent.hasClass(this.config.settings.highZIndexClass) || parent.addClass(this.config.settings.highZIndexClass)
                }, ColorPickerControlComponent.prototype._onColorPickerShowEndCallback = function(config) {}, ColorPickerControlComponent.prototype._onColorPickerHideStartCallback = function(config) {}, ColorPickerControlComponent.prototype._onColorPickerHideEndCallback = function(config) {
                    var parent = config.elements.parent;
                    parent.removeClass(this.config.settings.highZIndexClass)
                }, ColorPickerControlComponent.prototype.closeAll = function(exception) {
                    for (var i in this.colorPickerInstances) !this.colorPickerInstances[i].elements.content.is(":visible") || void 0 != exception && exception == this.colorPickerInstances[i].config.settings.instancePrefix || this.colorPickerInstances[i].close({
                        force: !0
                    })
                }, ColorPickerControlComponent
            }(CB.Base);
            courtOptionsComponent.ColorPickerControlComponent = ColorPickerControlComponent
        }(courtOptionsComponent = component.courtOptionsComponent || (component.courtOptionsComponent = {}))
    }(component = CB.component || (CB.component = {}))
}(CB || (CB = {}));
var CB;
! function(CB) {
    var plugin;
    ! function(plugin) {
        var dropdownPlugin;
        ! function(dropdownPlugin) {
            var DropdownPlugin = function(_super) {
                function DropdownPlugin(config) {
                    _super.call(this, config), this.defaultConfig = {
                        settings: {
                            instancePrefix: "dropdown_instance",
                            displayDuration: 100,
                            disabledClass: "disabled",
                            activeDropdownClass: "active",
                            hasTitleClass: "has_title",
                            noTitleClass: "no_title"
                        },
                        elements: {
                            fullContainer: jQuery(".full_container"),
                            parent: jQuery(".dropdown_container_parent"),
                            container: jQuery(".dropdown_container"),
                            button: jQuery(".dropdown_container .button"),
                            buttonArrow: jQuery(".dropdown_container .button .arrow"),
                            content: jQuery(".dropdown_container .content"),
                            contentArrow: jQuery(".dropdown_container .content .arrow"),
                            close: jQuery(".dropdown_container .close"),
                            item: jQuery(".dropdown_container .item_selector .item"),
                            itemCheckbox: jQuery(".dropdown_container .item_selector input[type=checkbox]")
                        }
                    }
                }
                return __extends(DropdownPlugin, _super), DropdownPlugin.prototype.create = function() {
                    var _this = this;
                    this.setConfig(), this.elements = this.config.elements, this.events = [{
                        el: this.elements.button,
                        ev: "click." + this.config.settings.instancePrefix,
                        fn: function(e) {
                            _this._onDropdownBtnClick(e)
                        }
                    }, {
                        el: this.elements.close,
                        ev: "click." + this.config.settings.instancePrefix,
                        fn: function(e) {
                            _this._onDropdownCloseClick(e)
                        }
                    }, {
                        el: this.elements.itemCheckbox,
                        ev: "change." + this.config.settings.instancePrefix,
                        fn: function(e, force, siblingCheck) {
                            _this._onItemCheckboxChange(e, force, siblingCheck)
                        }
                    }, {
                        el: jQuery(window),
                        ev: "resize." + this.config.settings.instancePrefix,
                        fn: function() {
                            _this._onWindowResize()
                        }
                    }, {
                        el: jQuery(window),
                        ev: "mousewheel." + this.config.settings.instancePrefix + " MozMousePixelScroll." + this.config.settings.instancePrefix,
                        fn: function() {
                            _this._onWindowMouseWheel()
                        }
                    }, {
                        el: jQuery(window),
                        ev: "scroll." + this.config.settings.instancePrefix + " touchmove." + this.config.settings.instancePrefix,
                        fn: function() {
                            _this._onWindowScroll()
                        }
                    }, {
                        el: jQuery(document),
                        ev: "click." + this.config.settings.instancePrefix,
                        fn: function(e) {
                            _this._onDocumentClick(e)
                        }
                    }], this.unbind(), this.bind()
                }, DropdownPlugin.prototype.destroy = function() {
                    this.unbind()
                }, DropdownPlugin.prototype._onDocumentClick = function(e) {
                    var isOuterClick = ElementHelper.isOuterClick(jQuery(e.target), this.elements.content);
                    isOuterClick && this.elements.content.is(":visible") && this.close()
                }, DropdownPlugin.prototype._onWindowMouseWheel = function() {
                    this._setOpenedTooltipPosition()
                }, DropdownPlugin.prototype._onWindowScroll = function() {
                    this._setOpenedTooltipPosition()
                }, DropdownPlugin.prototype._onWindowResize = function() {
                    this._setOpenedTooltipPosition()
                }, DropdownPlugin.prototype._setOpenedTooltipPosition = function() {
                    this.elements.container.hasClass(this.config.settings.activeDropdownClass) && (this._setTooltipPosition(), this.elements.content.show())
                }, DropdownPlugin.prototype._setTooltipPosition = function() {
                    var tooltipPositionConfig = {
                        settings: {
                            defaultHorizontalPosition: "center",
                            arrowHorizontalOffset: 20,
                            extraDistanceArrowTooltip: 6
                        },
                        elements: {
                            fullContainer: this.elements.fullContainer,
                            relative: this.elements.buttonArrow,
                            container: this.elements.content,
                            arrow: this.elements.contentArrow
                        }
                    };
                    TooltipPositionHelper.positioning(tooltipPositionConfig)
                }, DropdownPlugin.prototype._onItemCheckboxChange = function(e, force, siblingCheck) {
                    for (var pairElement, el = jQuery(e.currentTarget), item = el.parent(this.elements.item), hasTitle = item.hasClass(this.config.settings.hasTitleClass), classList = item[0].className.split(/\s+/), classes = hasTitle ? "." + this.config.settings.noTitleClass : "." + this.config.settings.hasTitleClass, sibling = el.siblings('input[type="checkbox"]'), i = 0; i < classList.length; i++) classList[i] != this.config.settings.hasTitleClass && classList[i] != this.config.settings.noTitleClass && "" != classList[i] && (classes += "." + classList[i]);
                    pairElement = this.elements.item.filter(classes), 0 != pairElement.length && (hasTitle ? force || (el.is(":checked") && (pairElement.find(this.elements.itemCheckbox).is(":checked") || (pairElement.find(this.elements.itemCheckbox).prop("checked", !0), pairElement.find(this.elements.itemCheckbox).trigger("change"))), 0 != sibling.length && (sibling.prop("checked", el.is(":checked")), sibling.trigger("change", [!0, !0]))) : (pairElement.find(this.elements.itemCheckbox).prop("checked", el.is(":checked")), pairElement.find(this.elements.itemCheckbox).trigger("change"))), jQuery.isFunction(this.config.settings.dropdownCheckCallback) && (force && !siblingCheck || this.config.settings.dropdownCheckCallback(el))
                }, DropdownPlugin.prototype._onDropdownCloseClick = function(e) {
                    e.preventDefault(), e.stopPropagation(), this.close()
                }, DropdownPlugin.prototype._onDropdownBtnClick = function(e) {
                    e.preventDefault(), e.stopPropagation(), this.elements.content.is(":visible") ? this.close() : this.open()
                }, DropdownPlugin.prototype.checkAll = function() {
                    this.elements.itemCheckbox.prop("checked", !0), this.elements.itemCheckbox.trigger("change")
                }, DropdownPlugin.prototype.unCheckAll = function() {
                    this.elements.itemCheckbox.prop("checked", !1), this.elements.itemCheckbox.trigger("change")
                }, DropdownPlugin.prototype.open = function(param) {
                    var _this = this;
                    if (!this.elements.content.is(":visible") && !this.elements.container.hasClass(this.config.settings.disabledClass)) {
                        var duration = void 0 != param && param.force ? 0 : this.config.settings.displayDuration;
                        jQuery.isFunction(this.config.settings.showStartCallback) && this.config.settings.showStartCallback(), this._setTooltipPosition(), this.elements.container.hasClass(this.config.settings.activeDropdownClass) || this.elements.container.addClass(this.config.settings.activeDropdownClass), this.elements.content.slideDown(duration, function() {
                            jQuery.isFunction(_this.config.settings.showEndCallback) && _this.config.settings.showEndCallback(), void 0 != param && jQuery.isFunction(param.callback) && param.callback()
                        })
                    }
                }, DropdownPlugin.prototype.close = function(param) {
                    var _this = this,
                        duration = void 0 != param && param.force ? 0 : this.config.settings.displayDuration;
                    jQuery.isFunction(this.config.settings.hideStartCallback) && this.config.settings.hideStartCallback(), this.elements.content.slideUp(duration, function() {
                        jQuery.isFunction(_this.config.settings.hideEndCallback) && _this.config.settings.hideEndCallback(), _this.elements.container.removeClass(_this.config.settings.activeDropdownClass), void 0 != param && jQuery.isFunction(param.callback) && param.callback()
                    })
                }, DropdownPlugin
            }(CB.Base);
            dropdownPlugin.DropdownPlugin = DropdownPlugin
        }(dropdownPlugin = plugin.dropdownPlugin || (plugin.dropdownPlugin = {}))
    }(plugin = CB.plugin || (CB.plugin = {}))
}(CB || (CB = {}));
var CB;
! function(CB) {
    var component;
    ! function(component) {
        var courtOptionsComponent;
        ! function(courtOptionsComponent) {
            var DropdownControlComponent = function(_super) {
                function DropdownControlComponent(config) {
                    _super.call(this, config), this.defaultConfig = {
                        settings: {
                            highZIndexClass: "high_z_index",
                            dropdowns: {}
                        },
                        elements: {}
                    }, this.dropdownInstances = {}
                }
                return __extends(DropdownControlComponent, _super), DropdownControlComponent.prototype.create = function() {
                    this.setConfig(), this.elements = this.config.elements, this.events = [], this._setDropdownInstances(), this.unbind(), this.bind()
                }, DropdownControlComponent.prototype.destroy = function() {
                    this.unbind()
                }, DropdownControlComponent.prototype._setDropdownInstances = function() {
                    var _this = this,
                        dropdowns = this.config.settings.dropdowns;
                    for (var i in dropdowns) {
                        var completedSettings = dropdowns[i].settings;
                        dropdowns[i].elements;
                        completedSettings.showStartCallback = function(config) {
                            return function() {
                                _this._onDropdownShowStartCallback(config)
                            }
                        }(dropdowns[i]), completedSettings.showEndCallback = function(config) {
                            return function() {
                                _this._onDropdownShowEndCallback(config)
                            }
                        }(dropdowns[i]), completedSettings.hideStartCallback = function(config) {
                            return function() {
                                _this._onDropdownHideStartCallback(config)
                            }
                        }(dropdowns[i]), completedSettings.hideEndCallback = function(config) {
                            return function() {
                                _this._onDropdownHideEndCallback(config)
                            }
                        }(dropdowns[i]), dropdowns[i].settings = completedSettings;
                        var instance = new CB.plugin.dropdownPlugin.DropdownPlugin(dropdowns[i]);
                        this.dropdownInstances[i] = instance, instance.create()
                    }
                }, DropdownControlComponent.prototype._onDropdownShowStartCallback = function(config) {
                    this.closeAll(config.settings.instancePrefix);
                    var parent = config.elements.parent;
                    jQuery.isFunction(this.config.settings.dropdownShowCallback) && this.config.settings.dropdownShowCallback(), parent.hasClass(this.config.settings.highZIndexClass) || parent.addClass(this.config.settings.highZIndexClass)
                }, DropdownControlComponent.prototype._onDropdownShowEndCallback = function(config) {}, DropdownControlComponent.prototype._onDropdownHideStartCallback = function(config) {}, DropdownControlComponent.prototype._onDropdownHideEndCallback = function(config) {
                    var parent = config.elements.parent;
                    parent.removeClass(this.config.settings.highZIndexClass), jQuery.isFunction(this.config.settings.dropdownHideCallback) && this.config.settings.dropdownHideCallback(parent)
                }, DropdownControlComponent.prototype.closeAll = function(exception) {
                    for (var i in this.dropdownInstances) !this.dropdownInstances[i].elements.content.is(":visible") || void 0 != exception && exception == this.dropdownInstances[i].config.settings.instancePrefix || this.dropdownInstances[i].close({
                        force: !0
                    })
                }, DropdownControlComponent
            }(CB.Base);
            courtOptionsComponent.DropdownControlComponent = DropdownControlComponent
        }(courtOptionsComponent = component.courtOptionsComponent || (component.courtOptionsComponent = {}))
    }(component = CB.component || (CB.component = {}))
}(CB || (CB = {}));
var CB;
! function(CB) {
    var plugin;
    ! function(plugin) {
        var overlayPlugin;
        ! function(overlayPlugin) {
            var OverlayPlugin = function() {
                function OverlayPlugin(config) {
                    this._defaultConfig = {
                        settings: {
                            windowOpenerDataID: "data-window-id",
                            windowOpenedCls: "opened"
                        },
                        selectors: {
                            overlayContainer: "#overlay",
                            overlayWindow: "#overlay .window",
                            windowOpener: ".window_open",
                            closeButton: "#overlay .close"
                        }
                    }, this._config = ObjectHelper.mergeObject(this._defaultConfig, config), this._selectors = this._config.selectors, this._settings = this._config.settings, this._elements = ElementHelper.selectorsToElements(this._selectors), this.bind()
                }
                return OverlayPlugin.prototype.rebind = function() {
                    this._elements = ElementHelper.updateElements(this._selectors), this.bind()
                }, OverlayPlugin.prototype.bind = function() {
                    var _this = this;
                    this._elements.windowOpener.off("click.windowOpenerClick").on("click.windowOpenerClick", function(e) {
                        _this._onWindowOpenerClick(e)
                    }), this._elements.overlayContainer.off("click.overlayClick").on("click.overlayClick", function(e) {
                        _this._onOverlayClick(e)
                    }), this._elements.overlayWindow.off("click.overlayWindowClick").on("click.overlayWindowClick", function(e) {
                        _this._onOverlayWindowClick(e)
                    }), this._elements.closeButton.off("click.closeButtonClick").on("click.closeButtonClick", function(e) {
                        _this._onCloseButtonClick(e)
                    }), jQuery(window).off("keyup.overlayKeyup").on("keyup.overlayKeyup", function(e) {
                        _this._onOverlayKeyup(e)
                    })
                }, OverlayPlugin.prototype._onCloseButtonClick = function(e) {
                    e.preventDefault(), this.hideAll()
                }, OverlayPlugin.prototype._onOverlayWindowClick = function(e) {
                    e.stopPropagation()
                }, OverlayPlugin.prototype._onOverlayKeyup = function(e) {
                    27 == e.keyCode && this.hideAll()
                }, OverlayPlugin.prototype._onOverlayClick = function(e) {
                    e.preventDefault(), this.hideAll()
                }, OverlayPlugin.prototype._onWindowOpenerClick = function(e) {
                    e.preventDefault();
                    var el = jQuery(e.currentTarget),
                        windowID = el.attr(this._settings.windowOpenerDataID);
                    this.open(windowID)
                }, OverlayPlugin.prototype.open = function(windowID) {
                    var windowEl = jQuery("#" + windowID),
                        isIsset = 0 != windowEl.length;
                    isIsset && this.show(windowEl)
                }, OverlayPlugin.prototype.show = function(windowEl) {
                    this.hideAll(), windowEl.addClass("opened"), jQuery("html").addClass("noscroll"), this._elements.overlayContainer.addClass("show"), jQuery(window).trigger(OverlayPlugin.EVENTS.showWindow, {
                        windowID: windowEl.attr("id")
                    })
                }, OverlayPlugin.prototype.hideAll = function() {
                    var _this = this;
                    this._elements.overlayWindow.each(function(key, value) {
                        var windowEl = jQuery(value);
                        _this.hide(windowEl)
                    })
                }, OverlayPlugin.prototype.hide = function(windowEl) {
                    windowEl.hasClass(this._settings.windowOpenedCls) && windowEl.removeClass(this._settings.windowOpenedCls), this._elements.overlayContainer.removeClass("show"), jQuery("html").removeClass("noscroll"), jQuery(window).trigger(OverlayPlugin.EVENTS.hideWindow, {
                        windowID: windowEl.attr("id")
                    })
                }, OverlayPlugin.EVENTS = {
                    showWindow: "showWindow",
                    hideWindow: "hideWindow"
                }, OverlayPlugin
            }();
            overlayPlugin.OverlayPlugin = OverlayPlugin
        }(overlayPlugin = plugin.overlayPlugin || (plugin.overlayPlugin = {}))
    }(plugin = CB.plugin || (CB.plugin = {}))
}(CB || (CB = {}));
var CB;
! function(CB) {
    var plugin;
    ! function(plugin) {
        var overlayPlugin;
        ! function(overlayPlugin) {
            var ShareOverlayPlugin = function(_super) {
                function ShareOverlayPlugin(config) {
                    _super.call(this, config), this.defaultConfig = {
                        settings: {
                            dataTitleAttr: "data-share-title",
                            dataSrcAttr: "data-src"
                        },
                        selectors: {
                            shareContainer: "#share",
                            shareTypes: "#share .share_types",
                            fbShare: "#share .facebook",
                            twitterShare: "#share .twitter",
                            pinterestShare: "#share .pinterest",
                            pinterestDefaultShare: "#share [data-pin-config]",
                            pinterestJs: "#share #pin_script"
                        }
                    }
                }
                return __extends(ShareOverlayPlugin, _super), ShareOverlayPlugin.prototype.create = function() {
                    var _this = this;
                    this.init(), this.events = [{
                        el: this.elements.fbShare,
                        ev: "click.onFbShareClick",
                        fn: function(e) {
                            _this._onFbShareClick(e)
                        }
                    }, {
                        el: this.elements.twitterShare,
                        ev: "click.onTwitterShareClick",
                        fn: function(e) {
                            _this._onTwitterShareClick(e)
                        }
                    }, {
                        el: this.elements.pinterestShare,
                        ev: "click.onPinterestShare",
                        fn: function(e) {
                            _this._onPinterestShare(e)
                        }
                    }, {
                        el: jQuery(window),
                        ev: overlayPlugin.OverlayPlugin.EVENTS.showWindow + ".sharePopup",
                        fn: function(e, data) {
                            _this._onShowWindow(data)
                        }
                    }], this.unbind(), this.bind()
                }, ShareOverlayPlugin.prototype.destroy = function() {
                    this.unbind()
                }, ShareOverlayPlugin.prototype._onShowWindow = function(data) {
                    var _this = this;
                    data.windowID == this.elements.shareContainer.attr("id") && (this.elements.shareTypes.hide(), null == CB.Navigation.ControllerInstances[CB.Core.Pages.courtOptions.id].shareableUrl ? (this.setElements(), this.elements.pinterestDefaultShare.remove(), this.elements.pinterestJs.removeAttr("src"), CB.Navigation.ControllerInstances[CB.Core.Pages.courtOptions.id].getShareableUrl(function() {
                        _this._showShareTypes()
                    })) : this._showShareTypes())
                }, ShareOverlayPlugin.prototype._showShareTypes = function() {
                    this.elements.fbShare.attr("href", this._setFBShareHref()), this.elements.twitterShare.attr("href", this._setTwitterShareHref()), this.elements.pinterestShare.attr("href", this._setPinterestDefaultShareHref()), void 0 == this.elements.pinterestJs.attr("src") && this.elements.pinterestJs.attr("src", this.elements.pinterestJs.attr(this.config.settings.dataSrcAttr)), this.elements.shareTypes.slideDown(200)
                }, ShareOverlayPlugin.prototype._createPinterestDefaultShareBtn = function() {
                    var pin = jQuery('<a class="pinterest_button" href="#"data-pin-do="buttonPin"data-pin-config="above"><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" /></a>');
                    this.elements.shareTypes.append(pin), this.setElements()
                }, ShareOverlayPlugin.prototype._setPinterestDefaultShareHref = function() {
                    return "http://www.pinterest.com/pin/create/button/?url=" + encodeURIComponent(window.location.href) + "&media=" + encodeURIComponent(window.location.origin + "/" + CB.Navigation.ControllerInstances[CB.Core.Pages.courtOptions.id].shareableUrl.jpg) + "&description=" + this.elements.pinterestShare.attr(this.config.settings.dataTitleAttr)
                }, ShareOverlayPlugin.prototype._setTwitterShareHref = function() {
                    var hashTag = "";
                    return "https://twitter.com/share?hashtags=" + hashTag + "&text=" + this.elements.twitterShare.attr(this.config.settings.dataTitleAttr) + "&url=" + encodeURIComponent(window.location.origin + "/" + CB.Navigation.ControllerInstances[CB.Core.Pages.courtOptions.id].shareableUrl.jpg)
                }, ShareOverlayPlugin.prototype._setFBShareHref = function() {
                    return "https://www.facebook.com/dialog/feed?app_id=" + window.facebookAppId + "&display=popup&link=" + encodeURIComponent(window.location.origin + "/" + CB.Navigation.ControllerInstances[CB.Core.Pages.courtOptions.id].shareableUrl.jpg) + "&caption=" + this.elements.fbShare.attr(this.config.settings.dataTitleAttr) + "&redirect_uri=" + encodeURIComponent(window.location.origin)
                }, ShareOverlayPlugin.prototype._onFbShareClick = function(e) {
                    e.preventDefault();
                    var el = jQuery(e.currentTarget),
                        href = el.attr("href");
                    this._showPopup(href)
                }, ShareOverlayPlugin.prototype._onTwitterShareClick = function(e) {
                    e.preventDefault();
                    var el = jQuery(e.currentTarget),
                        href = el.attr("href");
                    this._showPopup(href)
                }, ShareOverlayPlugin.prototype._onPinterestShare = function(e) {
                    e.preventDefault();
                    var el = jQuery(e.currentTarget),
                        href = el.attr("href");
                    this._showPopup(href)
                }, ShareOverlayPlugin.prototype._showPopup = function(url) {
                    var width = 575,
                        height = 400,
                        left = (jQuery(window).width() - width) / 2,
                        top = (jQuery(window).height() - height) / 2,
                        opts = "status=1,width=" + width + ",height=" + height + ",top=" + top + ",left=" + left;
                    window.open(url, "share", opts)
                }, ShareOverlayPlugin
            }(CB.Base);
            overlayPlugin.ShareOverlayPlugin = ShareOverlayPlugin
        }(overlayPlugin = plugin.overlayPlugin || (plugin.overlayPlugin = {}))
    }(plugin = CB.plugin || (CB.plugin = {}))
}(CB || (CB = {}));
var CB;
! function(CB) {
    var plugin;
    ! function(plugin) {
        var overlayPlugin;
        ! function(overlayPlugin) {
            var SaveAndDownloadOverlayPlugin = function(_super) {
                function SaveAndDownloadOverlayPlugin(config) {
                    _super.call(this, config), this.defaultConfig = {
                        settings: {
                            downloadBtnEnabledCls: "enabled",
                            dataRequiredAttr: "data-required"
                        },
                        selectors: {
                            saveAndDownloadContainer: "#save_and_download",
                            saveAndDownloadFormContainer: "#save_and_download .download_form",
                            saveAndDownloadForm: "#save_and_download form",
                            saveAndDownloadTypeWrapper: "#save_and_download .download_type",
                            saveAndDownloadAjaxMessage: "#save_and_download .ajax_message",
                            jpegDownloadBtn: "#save_and_download .jpeg a",
                            pdfDownloadBtn: "#save_and_download .pdf a",
                            textInput: "#save_and_download input[type=text]"
                        }
                    }
                }
                return __extends(SaveAndDownloadOverlayPlugin, _super), SaveAndDownloadOverlayPlugin.prototype.create = function() {
                    var _this = this;
                    this.init(), this.events = [{
                        el: this.elements.textInput,
                        ev: "change.onTextInputChange, keyup.onTextInputKeyup",
                        fn: function(e) {
                            _this._onTextInputChange(e)
                        }
                    }, {
                        el: this.elements.jpegDownloadBtn,
                        ev: "click.onJpegDownloadBtnClick",
                        fn: function(e) {
                            _this._onJpegDownloadBtnClick(e)
                        }
                    }, {
                        el: this.elements.pdfDownloadBtn,
                        ev: "click.onPdfDownloadBtnClick",
                        fn: function(e) {
                            _this._onPdfDownloadBtnClick(e)
                        }
                    }, {
                        el: jQuery(window),
                        ev: overlayPlugin.OverlayPlugin.EVENTS.showWindow + ".saveAndDownloadPopup",
                        fn: function(e, data) {
                            _this._onShowWindow(data)
                        }
                    }], this.unbind(), this.bind(), this._setDownloadButtonStatus()
                }, SaveAndDownloadOverlayPlugin.prototype.destroy = function() {
                    this.unbind()
                }, SaveAndDownloadOverlayPlugin.prototype._onTextInputChange = function(e) {
                    this._setDownloadButtonStatus()
                }, SaveAndDownloadOverlayPlugin.prototype._setDownloadButtonStatus = function() {
                    var _this = this,
                        hasEmpty = !1;
                    this.elements.textInput.each(function(key, value) {
                        var el = jQuery(value),
                            val = el.val(),
                            required = void 0 != el.attr(_this.config.settings.dataRequiredAttr),
                            isEmpty = "" == val;
                        isEmpty && required && (hasEmpty = !0)
                    }), hasEmpty ? this.elements.jpegDownloadBtn.add(this.elements.pdfDownloadBtn).removeClass(this.config.settings.downloadBtnEnabledCls) : (this.elements.jpegDownloadBtn.hasClass(this.config.settings.downloadBtnEnabledCls) || this.elements.jpegDownloadBtn.addClass(this.config.settings.downloadBtnEnabledCls), this.elements.pdfDownloadBtn.hasClass(this.config.settings.downloadBtnEnabledCls) || this.elements.pdfDownloadBtn.addClass(this.config.settings.downloadBtnEnabledCls))
                }, SaveAndDownloadOverlayPlugin.prototype._onShowWindow = function(data) {
                    var _this = this;
                    data.windowID == this.elements.saveAndDownloadContainer.attr("id") && (this._resetForm(), this.elements.jpegDownloadBtn.hide(), this.elements.pdfDownloadBtn.hide(), null == CB.Navigation.ControllerInstances[CB.Core.Pages.courtOptions.id].shareableUrl ? CB.Navigation.ControllerInstances[CB.Core.Pages.courtOptions.id].getShareableUrl(function() {
                        _this._showDownloadButtons()
                    }) : this._showDownloadButtons())
                }, SaveAndDownloadOverlayPlugin.prototype._showDownloadButtons = function() {
                    this.elements.jpegDownloadBtn.show(), this.elements.pdfDownloadBtn.show()
                }, SaveAndDownloadOverlayPlugin.prototype._onJpegDownloadBtnClick = function(e) {
                    var _this = this;
                    if (e.preventDefault(), this.elements.jpegDownloadBtn.hasClass(this.config.settings.downloadBtnEnabledCls)) {
                        var iframe = jQuery("<iframe></iframe>");
                        iframe.hide(), iframe.attr("src", "/download").appendTo("body");
                        var formData = new FormData(this.elements.saveAndDownloadForm[0]);
                        jQuery.ajax({
                            url: this.elements.saveAndDownloadForm.attr("action"),
                            data: formData,
                            type: "POST",
                            dataType: "json",
                            processData: !1,
                            contentType: !1,
                            success: function(response) {
                                response.success ? (_this.elements.saveAndDownloadFormContainer.slideUp(), _this.elements.saveAndDownloadTypeWrapper.slideUp(), _this.elements.saveAndDownloadAjaxMessage.removeClass("error").addClass("success"), _this.elements.saveAndDownloadAjaxMessage.html("You have now saved and uploaded your court!")) : (_this.elements.saveAndDownloadAjaxMessage.removeClass("success").addClass("error"), void 0 != response.message && _this.elements.saveAndDownloadAjaxMessage.html(response.message))
                            }
                        })
                    }
                }, SaveAndDownloadOverlayPlugin.prototype._onPdfDownloadBtnClick = function(e) {
                    var _this = this;
                    if (e.preventDefault(), this.elements.pdfDownloadBtn.hasClass(this.config.settings.downloadBtnEnabledCls)) {
                        var iframe = jQuery("<iframe></iframe>");
                        iframe.hide(), iframe.attr("src", "/download-pdf").appendTo("body");
                        var formData = new FormData(this.elements.saveAndDownloadForm[0]);
                        jQuery.ajax({
                            url: this.elements.saveAndDownloadForm.attr("action"),
                            data: formData,
                            type: "POST",
                            dataType: "json",
                            processData: !1,
                            contentType: !1,
                            success: function(response) {
                                response.success ? (_this.elements.saveAndDownloadFormContainer.slideUp(), _this.elements.saveAndDownloadTypeWrapper.slideUp(), _this.elements.saveAndDownloadAjaxMessage.removeClass("error").addClass("success"), _this.elements.saveAndDownloadAjaxMessage.html("You have now saved and uploaded your court!")) : (_this.elements.saveAndDownloadAjaxMessage.removeClass("success").addClass("error"), void 0 != response.message && _this.elements.saveAndDownloadAjaxMessage.html(response.message))
                            }
                        })
                    }
                }, SaveAndDownloadOverlayPlugin.prototype._resetForm = function() {
                    this.elements.saveAndDownloadFormContainer.slideDown(), this.elements.saveAndDownloadTypeWrapper.slideDown(), this.elements.saveAndDownloadAjaxMessage.removeClass("success"), this.elements.saveAndDownloadAjaxMessage.html("")
                }, SaveAndDownloadOverlayPlugin
            }(CB.Base);
            overlayPlugin.SaveAndDownloadOverlayPlugin = SaveAndDownloadOverlayPlugin
        }(overlayPlugin = plugin.overlayPlugin || (plugin.overlayPlugin = {}))
    }(plugin = CB.plugin || (CB.plugin = {}))
}(CB || (CB = {}));
var CB;
! function(CB) {
    var plugin;
    ! function(plugin) {
        var overlayPlugin;
        ! function(overlayPlugin) {
            var GetQuoteOverlayPlugin = function(_super) {
                function GetQuoteOverlayPlugin(config) {
                    _super.call(this, config), this.defaultConfig = {
                        settings: {
                            submitEnabledCls: "enabled",
                            dataRequiredAttr: "data-required"
                        },
                        selectors: {
                            getQuoteContainer: "#get_quote",
                            getQuoteForm: "#get_quote form",
                            getQuoteFormContainer: "#get_quote .quote_form",
                            getQuoteFormAjaxMessage: "#get_quote .ajax_message",
                            getQuoteFormTextInput: "#get_quote form input[type=text]",
                            getQuoteFormSubmitBtn: "#get_quote form input[type=submit]"
                        }
                    }
                }
                return __extends(GetQuoteOverlayPlugin, _super), GetQuoteOverlayPlugin.prototype.create = function() {
                    var _this = this;
                    this.init(), this.events = [{
                        el: this.elements.getQuoteForm,
                        ev: "submit.onGetQuoteFormSubmit",
                        fn: function(e) {
                            _this._onGetQuoteFormSubmit(e)
                        }
                    }, {
                        el: this.elements.getQuoteFormTextInput,
                        ev: "change.onTextInputChange, keyup.onTextInputKeyup",
                        fn: function(e) {
                            _this._onTextInputChange(e)
                        }
                    }, {
                        el: jQuery(window),
                        ev: overlayPlugin.OverlayPlugin.EVENTS.showWindow + ".getQuotePopup",
                        fn: function(e, data) {
                            _this._onShowWindow(data)
                        }
                    }], this.unbind(), this.bind()
                }, GetQuoteOverlayPlugin.prototype.destroy = function() {
                    this.unbind()
                }, GetQuoteOverlayPlugin.prototype._onShowWindow = function(data) {
                    data.windowID == this.elements.getQuoteContainer.attr("id") && (this._resetForm(), null == CB.Navigation.ControllerInstances[CB.Core.Pages.courtOptions.id].shareableUrl && CB.Navigation.ControllerInstances[CB.Core.Pages.courtOptions.id].getShareableUrl())
                }, GetQuoteOverlayPlugin.prototype._onTextInputChange = function(e) {
                    this._setSubmitBtnStatus()
                }, GetQuoteOverlayPlugin.prototype._setSubmitBtnStatus = function() {
                    var _this = this,
                        hasEmpty = !1;
                    this.elements.getQuoteFormTextInput.each(function(key, value) {
                        var el = jQuery(value),
                            val = el.val(),
                            required = void 0 != el.attr(_this.config.settings.dataRequiredAttr),
                            isEmpty = "" == val;
                        isEmpty && required && (hasEmpty = !0)
                    }), hasEmpty ? this.elements.getQuoteFormSubmitBtn.removeClass(this.config.settings.submitEnabledCls) : this.elements.getQuoteFormSubmitBtn.hasClass(this.config.settings.submitEnabledCls) || this.elements.getQuoteFormSubmitBtn.addClass(this.config.settings.submitEnabledCls)
                }, GetQuoteOverlayPlugin.prototype._onGetQuoteFormSubmit = function(e) {
                    var _this = this;
                    if (e.preventDefault(), this.elements.getQuoteFormSubmitBtn.hasClass(this.config.settings.submitEnabledCls)) {
                        this.elements.getQuoteFormSubmitBtn.removeClass(this.config.settings.submitEnabledCls);
                        var formData = new FormData(this.elements.getQuoteForm[0]);
                        jQuery.ajax({
                            url: this.elements.getQuoteForm.attr("action"),
                            data: formData,
                            type: "POST",
                            dataType: "json",
                            processData: !1,
                            contentType: !1,
                            success: function(response) {
                                response.success ? (_this.elements.getQuoteFormContainer.slideUp(), _this.elements.getQuoteFormAjaxMessage.removeClass("error").addClass("success")) : (_this.elements.getQuoteFormAjaxMessage.removeClass("success").addClass("error"), _this.elements.getQuoteFormSubmitBtn.addClass(_this.config.settings.submitEnabledCls)),
                                    void 0 != response.message && _this.elements.getQuoteFormAjaxMessage.html(response.message)
                            }
                        })
                    }
                }, GetQuoteOverlayPlugin.prototype._resetForm = function() {
                    this.elements.getQuoteFormContainer.slideDown(), this.elements.getQuoteFormAjaxMessage.removeClass("error").removeClass("success"), this.elements.getQuoteFormAjaxMessage.html("")
                }, GetQuoteOverlayPlugin
            }(CB.Base);
            overlayPlugin.GetQuoteOverlayPlugin = GetQuoteOverlayPlugin
        }(overlayPlugin = plugin.overlayPlugin || (plugin.overlayPlugin = {}))
    }(plugin = CB.plugin || (CB.plugin = {}))
}(CB || (CB = {}));
var CB;
! function(CB) {
    var plugin;
    ! function(plugin) {
        var overlayPlugin;
        ! function(overlayPlugin) {
            var EmailOverlayPlugin = function(_super) {
                function EmailOverlayPlugin(config) {
                    _super.call(this, config), this.defaultConfig = {
                        settings: {
                            submitEnabledCls: "enabled",
                            dataRequiredAttr: "data-required"
                        },
                        selectors: {
                            emailContainer: "#email",
                            emailForm: "#email form",
                            emailFormContainer: "#email .email_form",
                            emailFormAjaxMessage: "#email .ajax_message",
                            emailFormTextInput: "#email form input[type=text]",
                            emailFormSubmitBtn: "#email form input[type=submit]"
                        }
                    }
                }
                return __extends(EmailOverlayPlugin, _super), EmailOverlayPlugin.prototype.create = function() {
                    var _this = this;
                    this.init(), this.events = [{
                        el: this.elements.emailForm,
                        ev: "submit.onEmailFormSubmit",
                        fn: function(e) {
                            _this._onEmailFormSubmit(e)
                        }
                    }, {
                        el: this.elements.emailFormTextInput,
                        ev: "change.onTextInputChange, keyup.onTextInputKeyup",
                        fn: function(e) {
                            _this._onTextInputChange(e)
                        }
                    }, {
                        el: jQuery(window),
                        ev: overlayPlugin.OverlayPlugin.EVENTS.showWindow + ".emailPopup",
                        fn: function(e, data) {
                            _this._onShowWindow(data)
                        }
                    }], this.unbind(), this.bind(), this._setSubmitBtnStatus()
                }, EmailOverlayPlugin.prototype._onShowWindow = function(data) {
                    data.windowID == this.elements.emailContainer.attr("id") && (this._resetForm(), null == CB.Navigation.ControllerInstances[CB.Core.Pages.courtOptions.id].shareableUrl && CB.Navigation.ControllerInstances[CB.Core.Pages.courtOptions.id].getShareableUrl())
                }, EmailOverlayPlugin.prototype._onTextInputChange = function(e) {
                    this._setSubmitBtnStatus()
                }, EmailOverlayPlugin.prototype._setSubmitBtnStatus = function() {
                    var _this = this,
                        hasEmpty = !1;
                    this.elements.emailFormTextInput.each(function(key, value) {
                        var el = jQuery(value),
                            val = el.val(),
                            required = void 0 != el.attr(_this.config.settings.dataRequiredAttr),
                            isEmpty = "" == val;
                        isEmpty && required && (hasEmpty = !0)
                    }), hasEmpty ? this.elements.emailFormSubmitBtn.removeClass(this.config.settings.submitEnabledCls) : this.elements.emailFormSubmitBtn.hasClass(this.config.settings.submitEnabledCls) || this.elements.emailFormSubmitBtn.addClass(this.config.settings.submitEnabledCls)
                }, EmailOverlayPlugin.prototype.destroy = function() {
                    this.unbind()
                }, EmailOverlayPlugin.prototype._onEmailFormSubmit = function(e) {
                    var _this = this;
                    if (e.preventDefault(), this.elements.emailFormSubmitBtn.hasClass(this.config.settings.submitEnabledCls)) {
                        var formData = new FormData(this.elements.emailForm[0]);
                        jQuery.ajax({
                            url: this.elements.emailForm.attr("action"),
                            data: formData,
                            type: "POST",
                            dataType: "json",
                            processData: !1,
                            contentType: !1,
                            success: function(response) {
                                response.success ? (_this.elements.emailFormContainer.slideUp(), _this.elements.emailFormAjaxMessage.removeClass("error").addClass("success")) : _this.elements.emailFormAjaxMessage.removeClass("success").addClass("error"), void 0 != response.message && _this.elements.emailFormAjaxMessage.html(response.message)
                            }
                        })
                    }
                }, EmailOverlayPlugin.prototype._resetForm = function() {
                    this.elements.emailFormContainer.slideDown(), this.elements.emailFormAjaxMessage.removeClass("error").removeClass("success"), this.elements.emailFormAjaxMessage.html("")
                }, EmailOverlayPlugin
            }(CB.Base);
            overlayPlugin.EmailOverlayPlugin = EmailOverlayPlugin
        }(overlayPlugin = plugin.overlayPlugin || (plugin.overlayPlugin = {}))
    }(plugin = CB.plugin || (CB.plugin = {}))
}(CB || (CB = {}));
var CB;
! function(CB) {
    var controller;
    ! function(controller) {
        var CourtOptionsController = function(_super) {
            function CourtOptionsController(config) {
                _super.call(this, config), this.defaultConfig = {
                    settings: {
                        colorPickerInstancePrefix: "color_picker_",
                        dropdownInstancePrefix: "dropdown_",
                        selectBtnDataColorSectionAttr: "data-color-section-content",
                        colorDataColorSectionAttr: "data-color-section",
                        disabledColorPickerClass: "disabled",
                        activeSelectBtnClass: "active",
                        activeColorSectionClass: "active",
                        activeColorClass: "active",
                        dataColorIdAttr: "data-color-id",
                        dataOptionIdAttr: "data-option-id",
                        dataColorTypeAttr: "data-color-type",
                        dataImageIdAttr: "data-image-item-id",
                        dataImageColorAttr: "data-image-color-id",
                        courtImagesFullScreenClass: "full_screen"
                    },
                    selectors: {
                        header: "#header",
                        headerOrientation: "#header .orientation",
                        fullContainer: "#content",
                        tabsContainer: "#court_tab",
                        tabCourtType: "#court_tab .tab_court_type",
                        tabCourtSize: "#court_tab .tab_court_size",
                        courtOptionsContainer: "#" + CB.Core.Pages.courtOptions.id,
                        loader: "#" + CB.Core.Pages.courtOptions.id + " #loader",
                        settings: "#" + CB.Core.Pages.courtOptions.id + " .court_options_settings > div",
                        settingElements: "#" + CB.Core.Pages.courtOptions.id + " .court_options_settings > div > div > div",
                        checkbox: "#" + CB.Core.Pages.courtOptions.id + " .court_options_settings > div > div > div > input[type=checkbox]",
                        colorPicker: "#" + CB.Core.Pages.courtOptions.id + " .court_options_settings > div > div > div .color_picker",
                        colorPickerBtn: "#" + CB.Core.Pages.courtOptions.id + " .court_options_settings > div > div > div .color_picker .color_picker_btn",
                        colorPickerContent: "#" + CB.Core.Pages.courtOptions.id + " .court_options_settings > div > div > div .color_picker .color_picker_content",
                        colorPickerContentArrow: "#" + CB.Core.Pages.courtOptions.id + " .court_options_settings > div > div > div .color_picker .color_picker_content .arrow",
                        colorPickerClose: "#" + CB.Core.Pages.courtOptions.id + " .court_options_settings > div > div > div .color_picker .close",
                        colorPickerColor: "#" + CB.Core.Pages.courtOptions.id + " .court_options_settings > div > div > div .color_picker .colors .color_section ",
                        colorPickerColorItem: "#" + CB.Core.Pages.courtOptions.id + " .court_options_settings > div > div > div .color_picker .colors .color_item",
                        colorPickerSelectBtn: "#" + CB.Core.Pages.courtOptions.id + " .court_options_settings > div > div > div .color_picker .buttons a",
                        colorPickerColorsWrapper: "#" + CB.Core.Pages.courtOptions.id + " .court_options_settings > div > div > div .color_picker .colors_wrapper",
                        dropdown: "#" + CB.Core.Pages.courtOptions.id + " .court_options_settings > div > div > div .dropdown",
                        dropdownBtn: "#" + CB.Core.Pages.courtOptions.id + " .court_options_settings > div > div > div .dropdown .dropdown_btn",
                        dropdownBtnArrow: "#" + CB.Core.Pages.courtOptions.id + " .court_options_settings > div > div > div .dropdown .dropdown_btn .arrow",
                        dropdownContent: "#" + CB.Core.Pages.courtOptions.id + " .court_options_settings > div > div > div .dropdown .dropdown_content",
                        dropdownContentArrow: "#" + CB.Core.Pages.courtOptions.id + " .court_options_settings > div > div > div .dropdown .dropdown_content .arrow",
                        dropdownClose: "#" + CB.Core.Pages.courtOptions.id + " .court_options_settings > div > div > div .dropdown .close",
                        dropdownItem: "#" + CB.Core.Pages.courtOptions.id + " .court_options_settings > div > div > div .dropdown .dropdown_content .item_selector > label",
                        dropdownItemCheckbox: "#" + CB.Core.Pages.courtOptions.id + " .court_options_settings > div > div > div .dropdown .dropdown_content .item_selector input[type=checkbox]",
                        surfaceColorDropdownBtn: "#" + CB.Core.Pages.courtOptions.id + " .court_options_settings > div > div > .surface_color .dropdown .dropdown_btn",
                        borderColorDropdownBtn: "#" + CB.Core.Pages.courtOptions.id + " .court_options_settings > div > div > .border_color .dropdown .dropdown_btn",
                        courtImagesContainer: "#" + CB.Core.Pages.courtOptions.id + " #court_images",
                        courtImagesContent: "#" + CB.Core.Pages.courtOptions.id + " #court_images .images_container",
                        courtImages: "#" + CB.Core.Pages.courtOptions.id + " #court_images img",
                        predefinedSetup: "#" + CB.Core.Pages.courtOptions.id + " .predefined_setup",
                        predefinedSetupRadio: "#" + CB.Core.Pages.courtOptions.id + " .predefined_setup input[type=radio]",
                        footerContainer: "#" + CB.Core.Pages.courtOptions.id + " #footer"
                    }
                }, this._selectedItems = {}, this.currentImages = [], this.shareableUrl = null
            }
            return __extends(CourtOptionsController, _super), CourtOptionsController.prototype.create = function() {
                var _this = this;
                this.init(), this.events = [{
                    el: jQuery(window),
                    ev: "resize.onCourtOptionsWindowResize",
                    fn: function() {
                        _this._onCourtOptionsWindowResize()
                    }
                }, {
                    el: this.elements.checkbox,
                    ev: "change.onCheckboxChange",
                    fn: function(e, triggered) {
                        _this._onCheckboxChange(e, triggered)
                    }
                }, {
                    el: jQuery(window),
                    ev: "resize.onCourtOptionsWindowResize",
                    fn: function() {
                        _this._onWindowResize()
                    }
                }, {
                    el: jQuery(window),
                    ev: "orientationchange.onCourtOptionsWindowOrientationChange",
                    fn: function() {
                        _this._onWindowOrientationChange()
                    }
                }, {
                    el: jQuery(window),
                    ev: "mousewheel.onCourtOptionsWindowMouseWheel MozMousePixelScroll.onCourtOptionsWindowMouseWheel",
                    fn: function() {
                        _this._onWindowMouseWheel()
                    }
                }, {
                    el: jQuery(window),
                    ev: "scroll.onCourtOptionsWindowScroll touchmove.onCourtOptionsWindowTouchMove",
                    fn: function() {
                        _this._onWindowScroll()
                    }
                }, {
                    el: jQuery(window),
                    ev: "touchstart.onCourtOptionsWindowTouchStart",
                    fn: function() {
                        _this._onTouchStart()
                    }
                }, {
                    el: jQuery(window),
                    ev: "touchend.onCourtOptionsWindowTouchEnd",
                    fn: function() {
                        _this._onTouchEnd()
                    }
                }, {
                    el: this.elements.predefinedSetupRadio,
                    ev: "change.onPredefinedSetupRadioChange",
                    fn: function(e) {
                        _this._onPredefinedSetupRadioChange(e)
                    }
                }, {
                    el: this.elements.surfaceColorDropdownBtn,
                    ev: "click.onSurfaceColorDropdownBtn",
                    fn: function(e) {
                        _this._onSurfaceColorDropdownBtn(e)
                    }
                }, {
                    el: this.elements.borderColorDropdownBtn,
                    ev: "click.onBorderColorDropdownBtn",
                    fn: function(e) {
                        _this._onBorderColorDropdownBtn(e)
                    }
                }], CB.Core.overlayPlugin.rebind(), this.unbind(), this.bind(), void 0 == this._panZoom && (this.elements.courtImagesContent.panzoom({
                    startTransform: "scale(1)",
                    increment: .5,
                    minScale: 1,
                    maxScale: 3,
                    rangeStep: .5,
                    contain: "invert"
                }), this._panZoom = this.elements.courtImagesContent.data("__pz__")), this._setCourtImagesPosition(), this._courtOptions = window.courtOptionsConfig, this._courtOptions.items.shadow = {
                    9999: {
                        colorIndex: null,
                        name: "surface_shadow_shadow_surface",
                        zIndex: 35
                    }
                }, this._courtOptions.items.tennis[9998] = {
                    colorIndex: null,
                    name: "court-elements_pole_f",
                    zIndex: 43
                }, this._courtOptions.items.tennis[9997] = {
                    colorIndex: null,
                    name: "court-elements_pole_b",
                    zIndex: 43
                }, this._courtOptions.items.volleyball[9998] = {
                    colorIndex: null,
                    name: "court-elements_pole_f",
                    zIndex: 43
                }, this._courtOptions.items.volleyball[9997] = {
                    colorIndex: null,
                    name: "court-elements_pole_b",
                    zIndex: 43
                }, this._parseItems(), this._selectedItems.shadow = this._courtOptions.items.shadow, this._selectedItems.shadow[9999].active = !0, void 0 != this._selectedItems.tennis && (this._selectedItems.tennis[9998] = {}, this._selectedItems.tennis[9998].active = !1, this._selectedItems.tennis[9997] = {}, this._selectedItems.tennis[9997].active = !1), void 0 != this._selectedItems.volleyball && (this._selectedItems.volleyball[9997] = {}, this._selectedItems.volleyball[9997].active = !1, this._selectedItems.volleyball[9998] = {}, this._selectedItems.volleyball[9998].active = !1), CB.Core.setPagesHeight(jQuery("#" + CB.Core.Pages.courtOptions.id)), jQuery(window).scrollTop(0), this.shareOverlayPlugin = new CB.plugin.overlayPlugin.ShareOverlayPlugin, this.shareOverlayPlugin.create(), this.saveAndDownloadOverlayPlugin = new CB.plugin.overlayPlugin.SaveAndDownloadOverlayPlugin, this.saveAndDownloadOverlayPlugin.create(), this.getQuoteOverlayPlugin = new CB.plugin.overlayPlugin.GetQuoteOverlayPlugin, this.getQuoteOverlayPlugin.create(), this.emailOverlayPlugin = new CB.plugin.overlayPlugin.EmailOverlayPlugin, this.emailOverlayPlugin.create()
            }, CourtOptionsController.prototype.destroy = function() {
                this.unbind()
            }, CourtOptionsController.prototype._onSurfaceColorDropdownBtn = function(e) {
                this._toggleColorPicker(jQuery(e.currentTarget).parents(this.config.selectors.settingElements).attr(this.config.settings.dataOptionIdAttr))
            }, CourtOptionsController.prototype._onBorderColorDropdownBtn = function(e) {
                this._toggleColorPicker(jQuery(e.currentTarget).parents(this.config.selectors.settingElements).attr(this.config.settings.dataOptionIdAttr))
            }, CourtOptionsController.prototype._toggleColorPicker = function(optionID) {
                var instance = this.colorPickerControlComponent.colorPickerInstances[optionID];
                instance.elements.container.hasClass(instance.config.settings.activeColorClass) ? instance.close() : instance.open()
            }, CourtOptionsController.prototype._onPredefinedSetupRadioChange = function(e) {
                var _this = this;
                this.elements.predefinedSetupRadio.each(function(key, value) {
                    var el = jQuery(value),
                        checked = el.is(":checked");
                    return checked ? void(void 0 != _this._selectedPredefinedSetupValue && _this._selectedPredefinedSetupValue == el.val() || _this._changePredefinedSetup(el.val())) : void 0
                })
            }, CourtOptionsController.prototype._changePredefinedSetup = function(predefinedId) {
                var _this = this;
                jQuery.ajax({
                    url: " /get-predefined-items/" + predefinedId,
                    type: "POST",
                    failure: function(response) {
                        console.error(response)
                    },
                    success: function(response) {
                        response.success && void 0 != response.items && (_this._selectedPredefinedSetupValue = predefinedId, _this._clear(), _this._setPredefinedItems(response.items))
                    }
                })
            }, CourtOptionsController.prototype._clear = function() {
                this.elements.checkbox.each(function(key, value) {
                    var el = jQuery(value),
                        isChecked = el.is(":checked");
                    isChecked && (el.prop("checked", !1), el.trigger("change"))
                })
            }, CourtOptionsController.prototype._onTouchStart = function() {
                var _this = this;
                this._setCourtImagesPositionTimer = setInterval(function() {
                    _this._setCourtImagesPosition()
                }, 2)
            }, CourtOptionsController.prototype._onTouchEnd = function() {
                clearInterval(this._setCourtImagesPositionTimer)
            }, CourtOptionsController.prototype._onWindowMouseWheel = function() {
                this._setCourtImagesPosition()
            }, CourtOptionsController.prototype._onWindowScroll = function() {
                this._setCourtImagesPosition()
            }, CourtOptionsController.prototype._onWindowResize = function() {
                this._setCourtImagesPosition()
            }, CourtOptionsController.prototype._onWindowOrientationChange = function() {
                this._setCourtImagesPosition()
            }, CourtOptionsController.prototype._setCourtImagesPosition = function() {
                var isMobile = DisplayHelper.getViewport().width < 1024,
                    isTouchDevice = jQuery("html").hasClass("own-touch-device"),
                    isFullscreen = "landscape" == DisplayHelper.getOrientation();
                if (isMobile)
                    if (this.elements.courtImagesContainer.css({
                            height: ""
                        }), this.elements.headerOrientation.show(), isFullscreen && isTouchDevice) this.elements.header.addClass(this.config.settings.courtImagesFullScreenClass), this.elements.courtImagesContainer.addClass(this.config.settings.courtImagesFullScreenClass), this.elements.tabsContainer.addClass(this.config.settings.courtImagesFullScreenClass), jQuery(window).scrollTop(0), CB.Core.setNoScroll(!0), this.elements.courtImagesContainer.css({
                        top: 0
                    }), this._panZoom.enable();
                    else {
                        this.elements.header.removeClass(this.config.settings.courtImagesFullScreenClass), this.elements.courtImagesContainer.removeClass(this.config.settings.courtImagesFullScreenClass), this.elements.tabsContainer.removeClass(this.config.settings.courtImagesFullScreenClass), CB.Core.setNoScroll(!1);
                        var previewHeight = this.elements.courtImagesContainer.height(),
                            courtTabTop = this.elements.tabsContainer.offset().top + this.elements.tabsContainer.outerHeight(!0) + 10,
                            windowScrollTop = jQuery(window).scrollTop(),
                            currentContainerTop = parseInt(this.elements.courtImagesContainer.css("top"), 10),
                            courtImagesContainerTop = courtTabTop - windowScrollTop > 0 ? courtTabTop - windowScrollTop + 20 : 0;
                        this.elements.courtOptionsContainer.css({
                            paddingTop: previewHeight
                        }), currentContainerTop != courtImagesContainerTop && this.elements.courtImagesContainer.css({
                            top: courtImagesContainerTop
                        }), this._panZoom.reset(), this._panZoom.disable()
                    } else {
                    this.elements.headerOrientation.hide(), this.elements.header.removeClass(this.config.settings.courtImagesFullScreenClass), this.elements.courtImagesContainer.removeClass(this.config.settings.courtImagesFullScreenClass), CB.Core.setNoScroll(!1), this.elements.courtOptionsContainer.css({
                        paddingTop: 0
                    });
                    var courtImagesContainerTop = this.elements.courtImagesContainer.offset().top,
                        windowHeight = DisplayHelper.getViewport().height,
                        footerHeight = this.elements.footerContainer.outerHeight(!0),
                        courtImagesContainerHeight = windowHeight - courtImagesContainerTop - footerHeight;
                    this.elements.courtImagesContainer.css({
                        height: courtImagesContainerHeight,
                        top: 0
                    }), this._panZoom.reset(), this._panZoom.disable()
                }
            }, CourtOptionsController.prototype.pageLoadCallback = function(predefinedItems) {
                this._setColorPickerInstances(), this._setDropdownInstances(), this._setPredefinedItems(predefinedItems)
            }, CourtOptionsController.prototype._setPredefinedItems = function(predefinedItems) {
                for (var i = 0; i < predefinedItems.length; i++) {
                    var item = predefinedItems[i],
                        itemId = item.id;
                    if (void 0 != itemId) {
                        var checkbox = this.elements.dropdownItemCheckbox.filter("[value=" + itemId + "]");
                        0 != checkbox.length && (checkbox.prop("checked", !0), checkbox.trigger("change"))
                    }
                }
            }, CourtOptionsController.prototype._onCourtOptionsWindowResize = function() {
                var imageSize = this._getImageSize().size;
                imageSize != this._currentSize && (this.elements.courtImages.remove(), this.setElements(), this._getImages()), CB.Core.setPagesHeight(jQuery("#" + CB.Core.Pages.courtOptions.id))
            }, CourtOptionsController.prototype._setColorPickerInstances = function() {
                var colorPickerControlConfig, _this = this,
                    colorPickers = [];
                this.elements.colorPicker.each(function(key, value) {
                    var el = jQuery(value),
                        colorPickerParent = el.parent(_this.elements.settingElements),
                        optionId = colorPickerParent.attr(_this.config.settings.dataOptionIdAttr),
                        instanceName = _this.config.settings.colorPickerInstancePrefix + optionId;
                    colorPickers[optionId] = {
                        settings: {
                            instancePrefix: instanceName,
                            displayDuration: 100,
                            activeColorPickerClass: "active",
                            disabledColorPickerClass: _this.config.settings.disabledColorPickerClass,
                            selectBtnDataColorSectionAttr: _this.config.settings.selectBtnDataColorSectionAttr,
                            colorDataColorSectionAttr: _this.config.settings.colorDataColorSectionAttr,
                            activeSelectBtnClass: _this.config.settings.activeSelectBtnClass,
                            activeColorSectionClass: _this.config.settings.activeColorSectionClass,
                            activeColorClass: _this.config.settings.activeColorClass,
                            dataColorIdAttr: _this.config.settings.dataColorIdAttr,
                            colorPickCallback: function(colorEl) {
                                _this._onColorPickCallback(colorEl)
                            }
                        },
                        elements: {
                            fullContainer: _this.elements.fullContainer,
                            parent: colorPickerParent,
                            container: el,
                            button: el.find(_this.elements.colorPickerBtn),
                            content: el.find(_this.elements.colorPickerContent),
                            contentArrow: el.find(_this.elements.colorPickerContentArrow),
                            close: el.find(_this.elements.colorPickerClose),
                            color: el.find(_this.elements.colorPickerColor),
                            colorItem: el.find(_this.elements.colorPickerColorItem),
                            selectBtn: el.find(_this.elements.colorPickerSelectBtn),
                            colorsWrapper: el.find(_this.elements.colorPickerColorsWrapper)
                        }
                    }
                }), colorPickerControlConfig = {
                    settings: {
                        highZIndexClass: "high_z_index",
                        colorPickers: colorPickers,
                        colorPickerShowCallback: function() {
                            _this._onColorPickerShowCallback()
                        }
                    }
                }, this.colorPickerControlComponent = new CB.component.courtOptionsComponent.ColorPickerControlComponent(colorPickerControlConfig), this.colorPickerControlComponent.create();
                for (var i in this._courtOptions.items) {
                    var itemGroup = this._courtOptions.items[i];
                    for (var j in itemGroup) {
                        var item = itemGroup[j];
                        if (void 0 != item.colorIndex && null != item.colorIndex) {
                            var colorType = -1 == item.name.search("lines_") ? "surfaces" : "lines",
                                colorParent = this.elements.settingElements.filter("[" + this.config.settings.dataOptionIdAttr + "=" + i + "]"),
                                colorSection = colorParent.find(this.elements.colorPickerColor).filter("[" + this.config.settings.colorDataColorSectionAttr + "=" + colorType + "]"),
                                colorEl = colorSection.find(this.elements.colorPickerColorItem).filter("[" + this.config.settings.dataColorIdAttr + "=" + item.colorIndex + "]");
                            colorEl.click()
                        }
                    }
                }
            }, CourtOptionsController.prototype._onColorPickCallback = function(colorEl) {
                var colorId = colorEl.attr(this.config.settings.dataColorIdAttr),
                    colorSection = colorEl.parents(this.config.selectors.colorPickerColor),
                    colorParent = colorSection.parents(this.config.selectors.settingElements);
                this._setItemColor(colorId, colorSection, colorParent)
            }, CourtOptionsController.prototype._onColorPickerShowCallback = function() {
                this.dropdownControlComponent.closeAll()
            }, CourtOptionsController.prototype._setDropdownInstances = function() {
                var dropdownControlConfig, _this = this,
                    dropdowns = {};
                this.elements.dropdown.each(function(key, value) {
                    var el = jQuery(value),
                        dropdownParent = el.parent(_this.elements.settingElements),
                        optionId = dropdownParent.attr(_this.config.settings.dataOptionIdAttr),
                        instanceName = _this.config.settings.dropdownInstancePrefix + optionId;
                    dropdowns[optionId] = {
                        settings: {
                            instancePrefix: instanceName,
                            displayDuration: 100,
                            activeDropdownClass: "active",
                            disabledClass: "disabled",
                            hasTitleClass: "has_title",
                            noTitleClass: "no_title",
                            dropdownCheckCallback: function(checkboxEl) {
                                _this._onDropdownCheckCallback(checkboxEl)
                            }
                        },
                        elements: {
                            fullContainer: _this.elements.fullContainer,
                            parent: dropdownParent,
                            container: el,
                            button: el.find(_this.elements.dropdownBtn),
                            buttonArrow: el.find(_this.elements.dropdownBtnArrow),
                            content: el.find(_this.elements.dropdownContent),
                            contentArrow: el.find(_this.elements.dropdownContentArrow),
                            close: el.find(_this.elements.dropdownClose),
                            item: el.find(_this.elements.dropdownItem),
                            itemCheckbox: el.find(_this.elements.dropdownItemCheckbox)
                        }
                    }
                }), dropdownControlConfig = {
                    settings: {
                        dropdowns: dropdowns,
                        highZIndexClass: "high_z_index",
                        dropdownShowCallback: function() {
                            _this._onDropdownShowCallback()
                        },
                        dropdownHideCallback: function(el) {
                            _this._onDropdownHideCallback(el)
                        }
                    }
                }, this.dropdownControlComponent = new CB.component.courtOptionsComponent.DropdownControlComponent(dropdownControlConfig), this.dropdownControlComponent.create();
                for (var i in this.dropdownControlComponent.dropdownInstances) {
                    var instance = this.dropdownControlComponent.dropdownInstances[i],
                        colorPickerButton = instance.elements.parent.find(this.elements.colorPickerBtn),
                        hasCheckedInOption = !1;
                    instance.elements.itemCheckbox.each(function(key, value) {
                        var checkboxEl = jQuery(value),
                            itemId = checkboxEl.val(),
                            itemChecked = checkboxEl.is(":checked"),
                            itemParent = checkboxEl.parents(_this.config.selectors.settingElements),
                            itemParentStr = itemParent.attr(_this.config.settings.dataOptionIdAttr);
                        itemChecked && (hasCheckedInOption = !0), _this._fillselectedItems(itemId, itemChecked, itemParentStr, !1)
                    }), hasCheckedInOption ? colorPickerButton.removeClass(this.config.settings.disabledColorPickerClass) : colorPickerButton.hasClass(this.config.settings.disabledColorPickerClass) || colorPickerButton.addClass(this.config.settings.disabledColorPickerClass)
                }
                this._getImages()
            }, CourtOptionsController.prototype._onCheckboxChange = function(e, triggered) {
                var el = jQuery(e.currentTarget),
                    checked = el.is(":checked"),
                    dropdownInstance = this.dropdownControlComponent.dropdownInstances[el.parent(this.elements.settingElements).attr(this.config.settings.dataOptionIdAttr)],
                    optionID = el.parent(this.elements.settingElements).attr(this.config.settings.dataOptionIdAttr),
                    openDropdown = !0;
                "basketball" != optionID && "hockey_futsal" != optionID && "tennis" != optionID && "volleyball" != optionID || (openDropdown = !1), checked ? triggered !== !0 && (openDropdown && dropdownInstance.open(), dropdownInstance.checkAll()) : triggered !== !0 && (dropdownInstance.close(), dropdownInstance.unCheckAll())
            }, CourtOptionsController.prototype._onDropdownShowCallback = function() {
                this.colorPickerControlComponent.closeAll()
            }, CourtOptionsController.prototype._onDropdownHideCallback = function(el) {
                var dropdownInstance = this.dropdownControlComponent.dropdownInstances[el.attr(this.config.settings.dataOptionIdAttr)],
                    dropdownCheckbox = dropdownInstance.elements.itemCheckbox,
                    checkbox = el.find(this.elements.checkbox),
                    checked = !1;
                dropdownCheckbox.each(function(key, value) {
                    var el = jQuery(value),
                        elChecked = el.is(":checked");
                    return elChecked ? void(checked = !0) : void 0
                }), checked || (checkbox.prop("checked", !1), checkbox.trigger("change", [!0]))
            }, CourtOptionsController.prototype._onDropdownCheckCallback = function(checkboxEl) {
                var _this = this,
                    itemId = checkboxEl.val(),
                    itemChecked = checkboxEl.is(":checked"),
                    itemParent = checkboxEl.parents(this.config.selectors.settingElements),
                    itemParentStr = itemParent.attr(this.config.settings.dataOptionIdAttr),
                    dropdownInstance = this.dropdownControlComponent.dropdownInstances[itemParent.attr(this.config.settings.dataOptionIdAttr)],
                    dropdownCheckbox = dropdownInstance.elements.itemCheckbox,
                    colorPickerButton = itemParent.find(this.elements.colorPickerBtn),
                    hasCheckedInOption = !1;
                if (dropdownCheckbox.each(function(key, value) {
                        var el = jQuery(value),
                            elChecked = el.is(":checked"),
                            dataColorType = el.attr(_this.config.settings.dataColorTypeAttr);
                        return elChecked && void 0 != dataColorType ? void(hasCheckedInOption = !0) : void 0
                    }), hasCheckedInOption ? colorPickerButton.removeClass(this.config.settings.disabledColorPickerClass) : colorPickerButton.hasClass(this.config.settings.disabledColorPickerClass) || colorPickerButton.addClass(this.config.settings.disabledColorPickerClass), itemChecked) itemParent.find(this.elements.checkbox).prop("checked", !0), itemParent.find(this.elements.checkbox).trigger("change", [!0]);
                else {
                    for (var image, colorId = void 0, i = 0; i < this.currentImages.length; i++) this.currentImages[i].itemId == itemId && (colorId = this.currentImages[i].colorId);
                    image = void 0 != colorId ? this.elements.courtImages.filter("[" + this.config.settings.dataImageIdAttr + '="' + itemId + '"][' + this.config.settings.dataImageColorAttr + '="' + colorId + '"]') : this.elements.courtImages.filter("[" + this.config.settings.dataImageIdAttr + '="' + itemId + '"]'), image.remove(), this.setElements()
                }
                switch (itemParentStr) {
                    case "light_system":
                        itemChecked && dropdownCheckbox.each(function(key, value) {
                            var dropdownCheckboxEl = jQuery(value);
                            dropdownCheckboxEl.val() != itemId && (dropdownCheckboxEl.prop("checked", !1), dropdownCheckboxEl.trigger("change"))
                        });
                        break;
                    case "basketball":
                        switch (CB.Core.Pages.courtSize.controller.SELECTED_SIZE.real) {
                            case "60x120":
                                var allChecked = !0,
                                    rightTopHoopId = 45,
                                    rightBottomHoopId = 46,
                                    centerLineId = 48,
                                    centerLineEl = dropdownCheckbox.filter("[value=" + centerLineId + "]");
                                0 != centerLineEl.length && (dropdownCheckbox.each(function(key, value) {
                                    var dropdownCheckboxEl = jQuery(value);
                                    dropdownCheckboxEl.is(":checked") || dropdownCheckboxEl.val() != rightTopHoopId && dropdownCheckboxEl.val() != rightBottomHoopId || (allChecked = !1)
                                }), centerLineEl.prop("checked", allChecked), centerLineEl.trigger("change", [!0]), this._fillselectedItems(centerLineId, allChecked, itemParentStr, !1), allChecked || this.elements.courtImages.filter("[" + this.config.settings.dataImageIdAttr + '="' + centerLineId + '"][' + this.config.settings.dataImageColorAttr + '="' + colorId + '"]').remove());
                                break;
                            case "52x86":
                            case "48x80":
                            case "36x66":
                                var allChecked = !0,
                                    leftHoopId = 22,
                                    rightHoopId = 23,
                                    centerLineId = 38,
                                    centerLineEl = dropdownCheckbox.filter("[value=" + centerLineId + "]");
                                0 != centerLineEl.length && (dropdownCheckbox.each(function(key, value) {
                                    var dropdownCheckboxEl = jQuery(value);
                                    dropdownCheckboxEl.is(":checked") || dropdownCheckboxEl.val() != leftHoopId && dropdownCheckboxEl.val() != rightHoopId || (allChecked = !1)
                                }), centerLineEl.prop("checked", allChecked), centerLineEl.trigger("change", [!0]), this._fillselectedItems(centerLineId, allChecked, itemParentStr, !1), allChecked || this.elements.courtImages.filter("[" + this.config.settings.dataImageIdAttr + '="' + centerLineId + '"][' + this.config.settings.dataImageColorAttr + '="' + colorId + '"]').remove())
                        }
                }
                this._setNet(), this._fillselectedItems(itemId, itemChecked, itemParentStr)
            }, CourtOptionsController.prototype._setNet = function() {
                var tennisNetId = 27,
                    tennisNetChecked = this.elements.dropdownItemCheckbox.filter("[value=" + tennisNetId + "]").is(":checked"),
                    volleyballNetId = 26,
                    volleyballNetChecked = this.elements.dropdownItemCheckbox.filter("[value=" + volleyballNetId + "]").is(":checked"),
                    netChecked = tennisNetChecked || volleyballNetChecked,
                    itemParent = "";
                if (tennisNetChecked && (itemParent = "tennis"), volleyballNetChecked && (itemParent = "volleyball"), netChecked) switch (CB.Core.Pages.courtSize.controller.SELECTED_SIZE.real) {
                    case "30x30":
                        var basketballHoopId = 35,
                            basketballHoopChecked = this.elements.dropdownItemCheckbox.filter("[value=" + basketballHoopId + "]").is(":checked"),
                            lightId = 53,
                            lightChecked = this.elements.dropdownItemCheckbox.filter("[value=" + lightId + "]").is(":checked");
                        basketballHoopChecked ? netChecked && (this._fillselectedItems(9997, !1, itemParent, !1), this.elements.courtImages.filter("[" + this.config.settings.dataImageIdAttr + '="9997"]').remove()) : netChecked && 0 == this.elements.courtImages.filter("[" + this.config.settings.dataImageIdAttr + '="9997"]').length && this._fillselectedItems(9997, !0, itemParent, !1), lightChecked ? netChecked && (this._fillselectedItems(9998, !1, itemParent, !1), this.elements.courtImages.filter("[" + this.config.settings.dataImageIdAttr + '="9998"]').remove()) : netChecked && 0 == this.elements.courtImages.filter("[" + this.config.settings.dataImageIdAttr + '="9998"]').length && this._fillselectedItems(9998, !0, itemParent, !1);
                        break;
                    case "30x50":
                    case "36x66":
                        var basketballHoopId = 21,
                            basketballHoopChecked = this.elements.dropdownItemCheckbox.filter("[value=" + basketballHoopId + "]").is(":checked"),
                            lightId = 54,
                            lightChecked = this.elements.dropdownItemCheckbox.filter("[value=" + lightId + "]").is(":checked");
                        basketballHoopChecked ? netChecked && (this._fillselectedItems(9997, !1, itemParent, !1), this.elements.courtImages.filter("[" + this.config.settings.dataImageIdAttr + '="9997"]').remove()) : netChecked && 0 == this.elements.courtImages.filter("[" + this.config.settings.dataImageIdAttr + '="9997"]').length && this._fillselectedItems(9997, !0, itemParent, !1), lightChecked ? netChecked && (this._fillselectedItems(9998, !1, itemParent, !1), this.elements.courtImages.filter("[" + this.config.settings.dataImageIdAttr + '="9998"]').remove()) : netChecked && 0 == this.elements.courtImages.filter("[" + this.config.settings.dataImageIdAttr + '="9998"]').length && this._fillselectedItems(9998, !0, itemParent, !1);
                        break;
                    case "48x80":
                    case "52x86":
                    case "60x120":
                        netChecked && 0 == this.elements.courtImages.filter("[" + this.config.settings.dataImageIdAttr + '="9997"]').length && this._fillselectedItems(9997, !0, itemParent, !1), netChecked && 0 == this.elements.courtImages.filter("[" + this.config.settings.dataImageIdAttr + '="9998"]').length && this._fillselectedItems(9998, !0, itemParent, !1);
                        break;
                    case "50x100":
                        var basketballHoopId = 21,
                            basketballHoopChecked = this.elements.dropdownItemCheckbox.filter("[value=" + basketballHoopId + "]").is(":checked");
                        basketballHoopChecked ? netChecked && (this._fillselectedItems(9997, !1, itemParent, !1), this.elements.courtImages.filter("[" + this.config.settings.dataImageIdAttr + '="9997"]').remove()) : netChecked && 0 == this.elements.courtImages.filter("[" + this.config.settings.dataImageIdAttr + '="9997"]').length && this._fillselectedItems(9997, !0, itemParent, !1), netChecked && 0 == this.elements.courtImages.filter("[" + this.config.settings.dataImageIdAttr + '="9998"]').length && this._fillselectedItems(9998, !0, itemParent, !1)
                } else void 0 != this._selectedItems.tennis && (this._fillselectedItems(9997, !1, "tennis", !1), this._fillselectedItems(9998, !1, "tennis", !1)), void 0 != this._selectedItems.volleyball && (this._fillselectedItems(9997, !1, "volleyball", !1), this._fillselectedItems(9998, !1, "volleyball", !1)), this.elements.courtImages.filter("[" + this.config.settings.dataImageIdAttr + '="9997"]').remove(), this.elements.courtImages.filter("[" + this.config.settings.dataImageIdAttr + '="9998"]').remove()
            }, CourtOptionsController.prototype._parseItems = function() {
                var _this = this;
                this.elements.settingElements.each(function(key, value) {
                    var el = jQuery(value),
                        option = el.attr(_this.config.settings.dataOptionIdAttr);
                    _this._selectedItems[option] = {}, el.find(_this.elements.dropdownItemCheckbox).each(function(itemKey, itemValue) {
                        var itemEl = jQuery(itemValue),
                            value = itemEl.val(),
                            checked = itemEl.is(":checked");
                        _this._selectedItems[option][value] = {
                            active: checked
                        }
                    })
                })
            }, CourtOptionsController.prototype._setItemColor = function(colorId, colorSection, colorParent, getImages) {
                var _this = this;
                void 0 === getImages && (getImages = !0);
                var colorSectionStr = colorSection.attr(this.config.settings.colorDataColorSectionAttr),
                    colorParentStr = colorParent.attr(this.config.settings.dataOptionIdAttr),
                    dropdownItems = colorParent.find(this.elements.dropdownItemCheckbox),
                    dropdownEl = dropdownItems.filter("[" + this.config.settings.dataColorTypeAttr + '="' + colorSectionStr + '"]');
                dropdownEl.each(function(key, value) {
                    var el = jQuery(value),
                        itemId = el.val();
                    el.attr(_this.config.settings.dataColorTypeAttr);
                    _this._selectedItems[colorParentStr][itemId].color = colorId, _this._selectedItems[colorParentStr][itemId].colorType = colorSectionStr;
                    var image = _this.elements.courtImages.filter("[" + _this.config.settings.dataImageIdAttr + '="' + itemId + '"][' + _this.config.settings.dataImageColorAttr + '!="' + colorId + '"]');
                    image.remove()
                }), getImages && this._getImages()
            }, CourtOptionsController.prototype._fillselectedItems = function(itemId, itemChecked, itemParentStr, getImages) {
                void 0 === getImages && (getImages = !0), this._selectedItems[itemParentStr][itemId].active = itemChecked, getImages && this._getImages()
            }, CourtOptionsController.prototype._getImageSize = function() {
                var necessarySize, necessaryFolder, containerWidth = this.elements.courtImagesContainer.width(),
                    length = ObjectHelper.getObjectLength(this._courtOptions.sizes),
                    count = 0,
                    isMobile = DisplayHelper.getViewport().width < 768,
                    isFullscreen = (jQuery("html").hasClass("own-touch-device"), "landscape" == DisplayHelper.getOrientation());
                for (var i in this._courtOptions.sizes) {
                    var size = parseInt(i, 10),
                        folder = this._courtOptions.sizes[i];
                    if (isMobile && isFullscreen) {
                        if (count == length - 1) {
                            necessarySize = size, necessaryFolder = folder;
                            break
                        }
                    } else if (size >= containerWidth || count == length - 1) {
                        necessarySize = size, necessaryFolder = folder;
                        break
                    }
                    count++
                }
                return {
                    folder: necessaryFolder,
                    size: necessarySize
                }
            }, CourtOptionsController.prototype._getImages = function() {
                var images = [],
                    folder = this._getImageSize().folder,
                    size = CB.Core.Pages.courtSize.controller.SELECTED_SIZE.real,
                    removeTennisNet = !1;
                this._currentSize = this._getImageSize().size;
                var tennisNetId = 27,
                    tennisNetInput = this.elements.dropdownItemCheckbox.filter("[value=" + tennisNetId + "]"),
                    tennisNetChecked = tennisNetInput.is(":checked"),
                    volleyballNetId = 26,
                    volleyballNetInput = this.elements.dropdownItemCheckbox.filter("[value=" + volleyballNetId + "]"),
                    volleyballNetChecked = volleyballNetInput.is(":checked");
                tennisNetChecked && volleyballNetChecked && (removeTennisNet = !0);
                for (var i in this._selectedItems) {
                    var items = this._selectedItems[i];
                    for (var j in items)
                        if (j == tennisNetId && removeTennisNet) this.elements.courtImages.filter("[" + this.config.settings.dataImageIdAttr + '="' + tennisNetId + '"]').remove();
                        else {
                            var item = items[j];
                            if (item.active) {
                                var url = folder + size + "_";
                                void 0 != item.colorType && (url += item.colorType + "_"), void 0 != item.color && (url += this._courtOptions.colors[item.color].paintCode + "_"), url += this._courtOptions.items[i][j].name, images.push({
                                    itemId: j,
                                    url: this._courtOptions.path + url + "." + this._courtOptions.extension,
                                    zIndex: this._courtOptions.items[i][j].zIndex,
                                    colorId: item.color
                                })
                            }
                        }
                }
                this._showLoader(), this.currentImages = images, this.shareableUrl = null, this._drawImages()
            }, CourtOptionsController.prototype._drawImages = function() {
                var _this = this,
                    allImage = this.currentImages.length,
                    loadedImage = 0;
                if (0 == allImage) return void this._imagesLoaded();
                for (var i = 0; allImage > i; i++) {
                    var sameImage, image = this.currentImages[i],
                        url = image.url.replace("#", "%23"),
                        zIndex = image.zIndex,
                        colorId = image.colorId,
                        itemId = image.itemId;
                    if (sameImage = void 0 != colorId ? this.elements.courtImages.filter("[" + this.config.settings.dataImageIdAttr + '="' + itemId + '"][' + this.config.settings.dataImageColorAttr + '="' + colorId + '"]') : this.elements.courtImages.filter("[" + this.config.settings.dataImageIdAttr + '="' + itemId + '"]'), 0 == sameImage.length) {
                        var img = new Image,
                            $img = jQuery(img);
                        img.src = url, $img.attr(this.config.settings.dataImageIdAttr, itemId), $img.attr(this.config.settings.dataImageColorAttr, colorId), $img.off("load.imageLoad error.imageError").on("load.imageLoad error.imageError", function(e) {
                            loadedImage++, loadedImage == allImage && _this._imagesLoaded()
                        }), $img.css({
                            zIndex: zIndex
                        }), $img.hide(), this.elements.courtImagesContent.append(img), this._showImage($img)
                    } else loadedImage++, loadedImage == allImage && this._imagesLoaded()
                }
                this.setElements()
            }, CourtOptionsController.prototype._showImage = function(img) {
                setTimeout(function() {
                    img.show()
                })
            }, CourtOptionsController.prototype._imagesLoaded = function() {
                this._hideLoader()
            }, CourtOptionsController.prototype._showLoader = function() {
                this.elements.loader.stop().fadeIn("fast")
            }, CourtOptionsController.prototype._hideLoader = function() {
                this.elements.loader.stop().fadeOut("fast")
            }, CourtOptionsController.prototype.getShareableUrl = function(callback) {
                var _this = this;
                jQuery.ajax({
                    url: "/get-user-shareable-url",
                    data: {
                        images: this.currentImages
                    },
                    type: "POST",
                    success: function(response) {
                        _this.shareableUrl = {
                            pdf: response.pdfUrl,
                            jpg: response.pictureUrl
                        }, jQuery.isFunction(callback) && callback()
                    }
                })
            }, CourtOptionsController
        }(CB.Base);
        controller.CourtOptionsController = CourtOptionsController
    }(controller = CB.controller || (CB.controller = {}))
}(CB || (CB = {}));
var CB;
! function(CB) {
    var Navigation = function(_super) {
        function Navigation() {
            var _this = this;
            _super.call(this), this.defaultConfig = {
                settings: {
                    tabsActiveCls: "active",
                    tabsDisabledCls: "disabled",
                    tabsDataPageAttr: "data-page-id",
                    slideDuration: 400,
                    slideEasing: "easeInOutCirc",
                    lastTabClass: "last_tab",
                    firstTabClass: "first_tab"
                },
                selectors: {
                    pages: "#pages",
                    tabsContainer: "#court_tab",
                    tabs: "#court_tab > span",
                    tabCourtTypeContainer: "#court_tab .tab_court_type",
                    tabCourtType: "#court_tab .tab_court_type .type",
                    tabCourtTypeDefault: "#court_tab .tab_court_type .default",
                    tabCourtTypeSelectedType: "#court_tab .tab_court_type .selected_type",
                    tabCourtTypeSelectedSize: "#court_tab .tab_court_type .selected_size",
                    tabCourtSizeContainer: "#court_tab .tab_court_size",
                    tabCourtSize: "#court_tab .tab_court_size .size",
                    tabCourtSizeDefault: "#court_tab .tab_court_size .default",
                    tabCourtSizeSelectedSize: "#court_tab .tab_court_size .selected_size",
                    tabCourtOptionsContainer: "#court_tab .tab_court_options",
                    backBtn: "#court_tab .back_btn",
                    goBackToCourtTypePopup: "#go_back_to_court_type",
                    goBackToCourtTypeArrow: "#go_back_to_court_type .arrow",
                    goBackOkBtn: "#go_back_to_court_type #go_back_ok",
                    goBackCancelBtn: "#go_back_to_court_type #go_back_cancel"
                }
            }, this.init(), this.events = [{
                el: jQuery(window),
                ev: "resize.onNavigationWindowResize",
                fn: function() {
                    _this._onWindowResizeEnd()
                }
            }, {
                el: this.elements.backBtn,
                ev: "click.onBackBtnClick",
                fn: function(e) {
                    _this._onBackBtnClick(e)
                }
            }, {
                el: this.elements.goBackOkBtn,
                ev: "click.onGoBackOkBtn",
                fn: function(e) {
                    _this._onGoBackOkBtnClick(e)
                }
            }, {
                el: this.elements.goBackCancelBtn,
                ev: "click.onGoBackCancelBtn",
                fn: function(e) {
                    _this._onGoBackCancelBtnClick(e)
                }
            }, {
                el: jQuery(window),
                ev: "orientationchange.onNavigationWindowOrientationChange",
                fn: function() {
                    _this._onWindowOrientationChange()
                }
            }, {
                el: jQuery(window),
                ev: "mousewheel.onNavigationWindowMouseWheel MozMousePixelScroll.onNavigationWindowMouseWheel",
                fn: function() {
                    _this._onWindowMouseWheel()
                }
            }, {
                el: jQuery(window),
                ev: "scroll.onNavigationWindowScroll touchmove.onNavigationWindowTouchMove",
                fn: function() {
                    _this._onWindowScroll()
                }
            }, {
                el: jQuery(document),
                ev: "click.onNavigationDocumentClick",
                fn: function(e) {
                    _this._onDocumentClick(e)
                }
            }], this.unbind(), this.bind(), this.setControllerInstances()
        }
        return __extends(Navigation, _super), Navigation.prototype.setControllerInstances = function() {
            for (var i in CB.Core.Pages) "function" == typeof CB.Core.Pages[i].controller && (Navigation.ControllerInstances[CB.Core.Pages[i].id] = new CB.Core.Pages[i].controller)
        }, Navigation.prototype._onWindowOrientationChange = function() {
            this._setGoBackToCourtTypePopupPosition()
        }, Navigation.prototype._onWindowMouseWheel = function() {
            this._setGoBackToCourtTypePopupPosition()
        }, Navigation.prototype._onWindowScroll = function() {
            this._setGoBackToCourtTypePopupPosition()
        }, Navigation.prototype._onWindowResizeEnd = function() {
            this._animateToPage(Navigation.CurrentPage, !0), this._setActiveTab(Navigation.CurrentPage.id), this._setGoBackToCourtTypePopupPosition()
        }, Navigation.prototype.setCurrentPage = function(page, callback) {
            this._animateToPage(page, !1, callback), this._setCurrentController(page), this._setActiveTab(page.id), this._setTabTitles(page.id), this._setDisabledTab()
        }, Navigation.prototype._animateToPage = function(page, force, callback) {
            var el = jQuery("#" + page.id);
            this.elements.pages.stop().animate({
                left: -el.position().left
            }, {
                duration: force ? 0 : this.config.settings.slideDuration,
                easing: this.config.settings.slideEasing,
                complete: function() {
                    jQuery.isFunction(callback) && callback()
                }
            })
        }, Navigation.prototype._setTabTitles = function(pageId) {
            switch (pageId) {
                case CB.Core.Pages.courtType.id:
                    this.elements.backBtn.hide(), this.elements.tabCourtTypeContainer.hide(), this.elements.tabCourtSizeContainer.hide(), this.elements.tabCourtOptionsContainer.hide(), this.elements.tabCourtTypeDefault.css("display", "inline-block");
                    break;
                case CB.Core.Pages.courtSize.id:
                    this.elements.backBtn.show(), this.setCourtTypeTitle(CB.controller.CourtTypeController.SELECTED_TYPE), this.elements.tabCourtSizeContainer.css("display", "inline-block");
                    break;
                case CB.Core.Pages.courtOptions.id:
                    this.elements.backBtn.show(), this.setCourtSizeTitle(CB.controller.CourtSizeController.SELECTED_SIZE.custom), this.elements.tabCourtTypeContainer.css("display", "inline-block"), this.elements.tabCourtTypeSelectedType.hide(), this.elements.tabCourtTypeSelectedSize.css("display", "inline-block"), this.elements.tabCourtTypeDefault.hide(), this.elements.tabCourtSizeDefault.hide(), this.elements.tabCourtSizeSelectedSize.css("display", "inline-block")
            }
        }, Navigation.prototype._setDisabledTab = function() {
            var activeIndex, _this = this,
                tabsLength = this.elements.tabs.length;
            this.elements.tabs.each(function(key, value) {
                var el = jQuery(value),
                    isActive = el.hasClass(_this.config.settings.tabsActiveCls),
                    isDisabled = el.hasClass(_this.config.settings.tabsDisabledCls);
                return isDisabled && el.removeClass(_this.config.settings.tabsDisabledCls), isActive ? void(activeIndex = el.index()) : void 0
            });
            for (var i = tabsLength - 1; i > activeIndex; --i) {
                var el = jQuery(this.elements.tabs[i]),
                    isDisabled = el.hasClass(this.config.settings.tabsDisabledCls);
                isDisabled || el.addClass(this.config.settings.tabsDisabledCls)
            }
        }, Navigation.prototype._setActiveTab = function(page) {
            var activeTab, _this = this,
                tabLength = this.elements.tabs.length,
                firstTab = !1,
                lastTab = !1;
            this.elements.tabs.each(function(key, value) {
                var el = jQuery(value),
                    dataPageId = el.attr(_this.config.settings.tabsDataPageAttr),
                    isActive = el.hasClass(_this.config.settings.tabsActiveCls);
                isActive && el.removeClass(_this.config.settings.tabsActiveCls), dataPageId == page && (el.addClass(_this.config.settings.tabsActiveCls), _this.elements.tabs.index(el) == tabLength - 1 && (lastTab = !0), 0 == _this.elements.tabs.index(el) && (firstTab = !0), activeTab = el)
            }), firstTab ? this.elements.tabsContainer.hasClass(this.config.settings.firstTabClass) || this.elements.tabsContainer.addClass(this.config.settings.firstTabClass) : this.elements.tabsContainer.removeClass(this.config.settings.firstTabClass), lastTab ? this.elements.tabsContainer.hasClass(this.config.settings.lastTabClass) || this.elements.tabsContainer.addClass(this.config.settings.lastTabClass) : this.elements.tabsContainer.removeClass(this.config.settings.lastTabClass)
        }, Navigation.prototype._setCurrentController = function(page) {
            Navigation.CurrentController = Navigation.ControllerInstances[page.id], Navigation.CurrentPage = page, void 0 != Navigation.CurrentController && Navigation.CurrentController.create()
        }, Navigation.prototype.appendPage = function(html) {
            this.elements.pages.append(html)
        }, Navigation.prototype.removePage = function(page) {
            jQuery("#" + page).remove()
        }, Navigation.prototype.setCourtTypeTitle = function(courtType) {
            this.elements.tabCourtType.text(courtType)
        }, Navigation.prototype.setCourtSizeTitle = function(courtSize) {
            this.elements.tabCourtSize.text(courtSize)
        }, Navigation.prototype._onBackBtnClick = function(e) {
            e.preventDefault(), e.stopPropagation(), this._goBackToCourtType()
        }, Navigation.prototype._onDocumentClick = function(e) {
            var isOuterClick = ElementHelper.isOuterClick(jQuery(e.target), this.elements.goBackToCourtTypePopup);
            isOuterClick && this.elements.goBackToCourtTypePopup.is(":visible") && this._hideGoBackCourtTypePopup()
        }, Navigation.prototype._onGoBackCancelBtnClick = function(e) {
            e.preventDefault(), e.stopPropagation(), this._hideGoBackCourtTypePopup()
        }, Navigation.prototype._onGoBackOkBtnClick = function(e) {
            e.preventDefault(), e.stopPropagation(), this._hideGoBackCourtTypePopup(), CB.Core.Navigation.setCurrentPage(CB.Core.Pages.courtType, function() {
                CB.Core.Navigation.removePage(CB.Core.Pages.courtSize.id), CB.Core.Navigation.removePage(CB.Core.Pages.courtOptions.id), Navigation.CurrentPage.id != CB.Core.Pages.courtSize.id && Navigation.CurrentPage.id != CB.Core.Pages.courtOptions.id || CB.Navigation.ControllerInstances[CB.Core.Pages.courtSize.id].destroy(), Navigation.CurrentPage.id == CB.Core.Pages.courtOptions.id && CB.Navigation.ControllerInstances[CB.Core.Pages.courtOptions.id].destroy()
            })
        }, Navigation.prototype._goBackToCourtType = function() {
            this.elements.goBackToCourtTypePopup.is(":visible") ? this._hideGoBackCourtTypePopup() : this._showGoBackCourtTypePopup()
        }, Navigation.prototype._showGoBackCourtTypePopup = function() {
            this.elements.goBackToCourtTypePopup.is(":visible") || (void 0 != CB.Navigation.ControllerInstances[CB.Core.Pages.courtOptions.id].dropdownControlComponent && CB.Navigation.ControllerInstances[CB.Core.Pages.courtOptions.id].dropdownControlComponent.closeAll(), this._setGoBackToCourtTypePopupPosition(), this.elements.tabsContainer.addClass("high_z_index"), this.elements.goBackToCourtTypePopup.slideDown(100))
        }, Navigation.prototype._hideGoBackCourtTypePopup = function() {
            var _this = this;
            this.elements.goBackToCourtTypePopup.slideUp(100, function() {
                _this.elements.tabsContainer.removeClass("high_z_index")
            })
        }, Navigation.prototype._setGoBackToCourtTypePopupPosition = function() {
            var tooltipPositionConfig = {
                settings: {
                    defaultHorizontalPosition: "left",
                    arrowHorizontalOffset: 20,
                    extraDistanceArrowTooltip: 6
                },
                elements: {
                    fullContainer: this.elements.tabsContainer,
                    relative: this.elements.backBtn,
                    container: this.elements.goBackToCourtTypePopup,
                    arrow: this.elements.goBackToCourtTypeArrow
                }
            };
            TooltipPositionHelper.positioning(tooltipPositionConfig)
        }, Navigation.ControllerInstances = {}, Navigation
    }(CB.Base);
    CB.Navigation = Navigation
}(CB || (CB = {}));
var CB;
! function(CB) {
    var Core = function() {
        function Core() {
            void 0 != window.orientation ? jQuery("html").addClass("own-touch-device") : jQuery("html").addClass("own-no-touch-device"), Core.Bootstrap = new CB.bootstrap.Bootstrap, Core.Navigation = new CB.Navigation, Core.Navigation.setCurrentPage(Core.Pages.courtType), Core.overlayPluginConfig = {}, Core.overlayPlugin = new CB.plugin.overlayPlugin.OverlayPlugin(Core.overlayPluginConfig), jQuery("html").hasClass("own-no-touch-device") && jQuery("[data-title]").qtip({
                content: {
                    attr: "data-title"
                },
                position: {
                    my: "bottom center",
                    at: "top center"
                },
                style: {
                    tip: {
                        corner: "bottom center",
                        width: 10,
                        height: 5
                    }
                }
            })
        }
        return Core.setNoScroll = function(type) {
            type ? jQuery("html").hasClass(Core.Styles.classes.noScroll) || jQuery("html").addClass(Core.Styles.classes.noScroll) : jQuery("html").removeClass(Core.Styles.classes.noScroll)
        }, Core.setContentCenter = function(container, content) {
            setTimeout(function() {
                var areaTop = container.offset().top,
                    windowHeight = DisplayHelper.getViewport().height,
                    areaHeight = windowHeight - areaTop,
                    contentDimensions = DisplayHelper.getDimensions(content, !1, "default"),
                    contentWidth = contentDimensions.width,
                    contentHeight = contentDimensions.height,
                    marginTop = areaHeight > contentHeight ? (areaHeight - contentHeight) / 2 : 0;
                content.css({
                    display: "block",
                    width: contentWidth,
                    marginTop: Math.floor(marginTop),
                    position: "relative"
                })
            }, 15)
        }, Core.setPagesHeight = function(content) {
            setTimeout(function() {
                var height = content.outerHeight(!0);
                jQuery("#pages").css("height", height)
            }, 100)
        }, Core.Pages = {
            courtType: {
                id: "page_court_type",
                controller: CB.controller.CourtTypeController
            },
            courtSize: {
                id: "page_court_size",
                controller: CB.controller.CourtSizeController
            },
            courtOptions: {
                id: "page_court_options",
                controller: CB.controller.CourtOptionsController
            }
        }, Core.Styles = {
            classes: {
                noScroll: "noscroll"
            }
        }, Core
    }();
    CB.Core = Core
}(CB || (CB = {})), jQuery.noConflict(), jQuery(document).ready(function() {
    jQuery(document).foundation(), jQuery(document).ajaxComplete(function() {
        jQuery(document).foundation()
    }), new CB.Core
});