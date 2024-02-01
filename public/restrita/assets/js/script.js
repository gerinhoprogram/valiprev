Tooltip = function(e) {
        var o = e.theme || "tc",
            s = e.delay || 0,
            a = e.distance || 10;
        document.body.addEventListener("click", function(e) {
            if (e.target.hasAttribute("data-tooltip")) {
                var t = document.createElement("div");
                t.className = "b-tooltip b-tooltip-" + o, t.innerHTML = e.target.getAttribute("data-tooltip"), document.body.appendChild(t);
                var i = e.target.getAttribute("data-position") || "center top",
                    n = i.split(" ")[0];
                posVertical = i.split(" ")[1],
                    function(e, t, i, n) {
                        var o, s, r = e.getBoundingClientRect();
                        switch (i) {
                            case "left":
                                o = parseInt(r.left) - a - t.offsetWidth, parseInt(r.left) - t.offsetWidth < 0 && (o = a);
                                break;
                            case "right":
                                o = r.right + a - 40, parseInt(r.right) + t.offsetWidth > document.documentElement.clientWidth && (o = document.documentElement.clientWidth - t.offsetWidth - a - 40);
                                break;
                            default:
                            case "center":
                                o = parseInt(r.left) + (e.offsetWidth - t.offsetWidth) / 2
                        }
                        switch (n) {
                            case "center":
                                s = (parseInt(r.top) + parseInt(r.bottom)) / 2 - t.offsetHeight / 2;
                                break;
                            case "bottom":
                                s = parseInt(r.bottom) + a;
                                break;
                            default:
                            case "top":
                                s = parseInt(r.top) - t.offsetHeight - a
                        }
                        o = o < 0 ? parseInt(r.left) : o, s = s < 0 ? parseInt(r.bottom) + a : s, t.style.left = o + "px", t.style.top = s + pageYOffset + "px"
                    }(e.target, t, n, posVertical), e.target.hasAttribute("data-tooltip") && setTimeout(function() {
                        var t;
                        (t = document.querySelector(".b-tooltip")).style.opacity = 1,
                            function e() {
                                (t.style.opacity -= .1) < 0 ? t.style.display = "none" : requestAnimationFrame(e)
                            }(), setTimeout(function() { document.body.removeChild(document.querySelector(".b-tooltip")) }, s)
                    }, s)
            }
        })
    },
    function(p) {
        if (!p.hasInitialised) {
            var d = {
                escapeRegExp: function(e) { return e.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&") },
                hasClass: function(e, t) { var i = " "; return 1 === e.nodeType && 0 <= (i + e.className + i).replace(/[\n\t]/g, i).indexOf(i + t + i) },
                addClass: function(e, t) { e.className += " " + t },
                removeClass: function(e, t) {
                    var i = new RegExp("\\b" + this.escapeRegExp(t) + "\\b");
                    e.className = e.className.replace(i, "")
                },
                interpolateString: function(e, t) { return e.replace(/{{([a-z][a-z0-9\-_]*)}}/gi, function(e) { return t(arguments[1]) || "" }) },
                getCookie: function(e) { var t = ("; " + document.cookie).split("; " + e + "="); return 2 != t.length ? void 0 : t.pop().split(";").shift() },
                setCookie: function(e, t, i, n, o) {
                    var s = new Date;
                    s.setDate(s.getDate() + (i || 365));
                    var r = [e + "=" + t, "expires=" + s.toUTCString(), "path=" + (o || "/")];
                    n && r.push("domain=" + n), document.cookie = r.join(";")
                },
                deepExtend: function(e, t) { for (var i in t) t.hasOwnProperty(i) && (i in e && this.isPlainObject(e[i]) && this.isPlainObject(t[i]) ? this.deepExtend(e[i], t[i]) : e[i] = t[i]); return e },
                throttle: function(e, t) { var i = !1; return function() { i || (e.apply(this, arguments), i = !0, setTimeout(function() { i = !1 }, t)) } },
                hash: function(e) { var t, i, n = 0; if (0 === e.length) return n; for (t = 0, i = e.length; t < i; ++t) n = (n << 5) - n + e.charCodeAt(t), n |= 0; return n },
                normaliseHex: function(e) { return "#" == e[0] && (e = e.substr(1)), 3 == e.length && (e = e[0] + e[0] + e[1] + e[1] + e[2] + e[2]), e },
                getContrast: function(e) { return e = this.normaliseHex(e), 128 <= (299 * parseInt(e.substr(0, 2), 16) + 587 * parseInt(e.substr(2, 2), 16) + 114 * parseInt(e.substr(4, 2), 16)) / 1e3 ? "#000" : "#fff" },
                getLuminance: function(e) {
                    var t = parseInt(this.normaliseHex(e), 16),
                        i = 38 + (t >> 16),
                        n = 38 + (t >> 8 & 255),
                        o = 38 + (255 & t);
                    return "#" + (16777216 + 65536 * (i < 255 ? i < 1 ? 0 : i : 255) + 256 * (n < 255 ? n < 1 ? 0 : n : 255) + (o < 255 ? o < 1 ? 0 : o : 255)).toString(16).slice(1)
                },
                isMobile: function() { return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) },
                isPlainObject: function(e) { return "object" == typeof e && null !== e && e.constructor == Object }
            };
            p.status = { deny: "deny", allow: "allow", dismiss: "dismiss" }, p.transitionEnd = function() {
                var e = document.createElement("div"),
                    t = { t: "transitionend", OT: "oTransitionEnd", msT: "MSTransitionEnd", MozT: "transitionend", WebkitT: "webkitTransitionEnd" };
                for (var i in t)
                    if (t.hasOwnProperty(i) && void 0 !== e.style[i + "ransition"]) return t[i];
                return ""
            }(), p.hasTransition = !!p.transitionEnd;
            var l = Object.keys(p.status).map(d.escapeRegExp);
            p.customStyles = {}, p.Popup = function() {
                function e() { this.initialise.apply(this, arguments) }

                function i(e) { this.openingTimeout = null, d.removeClass(e, "cc-invisible") }

                function n(e) { e.style.display = "none", e.removeEventListener(p.transitionEnd, this.afterTransition), this.afterTransition = null }

                function o() {
                    var e = this.options.position.split("-"),
                        t = [];
                    return e.forEach(function(e) { t.push("cc-" + e) }), t
                }

                function s() {
                    var e = this.options,
                        t = "top" == e.position || "bottom" == e.position ? "banner" : "floating";
                    d.isMobile() && (t = "floating");
                    var i = ["cc-" + t, "cc-type-" + e.type, "cc-theme-" + e.theme];
                    return e.static && i.push("cc-static"), i.push.apply(i, o.call(this)),
                        function(e) {
                            var t = d.hash(JSON.stringify(e)),
                                i = "cc-color-override-" + t,
                                n = d.isPlainObject(e);
                            return this.customStyleSelector = n ? i : null, n && function(e, t, i) {
                                if (p.customStyles[e]) return ++p.customStyles[e].references;
                                var n = {},
                                    o = t.popup,
                                    s = t.button,
                                    r = t.highlight;
                                o && (o.text = o.text ? o.text : d.getContrast(o.background), o.link = o.link ? o.link : o.text, n[i + ".cc-window"] = ["color: " + o.text, "background-color: " + o.background], n[i + ".cc-revoke"] = ["color: " + o.text, "background-color: " + o.background], n[i + " .cc-link," + i + " .cc-link:active," + i + " .cc-link:visited"] = ["color: " + o.link], s && (s.text = s.text ? s.text : d.getContrast(s.background), s.border = s.border ? s.border : "transparent", n[i + " .cc-btn"] = ["color: " + s.text, "border-color: " + s.border, "background-color: " + s.background], "transparent" != s.background && (n[i + " .cc-btn:hover, " + i + " .cc-btn:focus"] = ["background-color: " + (a = s.background, "000000" == (a = d.normaliseHex(a)) ? "#222" : d.getLuminance(a))]), r ? (r.text = r.text ? r.text : d.getContrast(r.background), r.border = r.border ? r.border : "transparent", n[i + " .cc-highlight .cc-btn:first-child"] = ["color: " + r.text, "border-color: " + r.border, "background-color: " + r.background]) : n[i + " .cc-highlight .cc-btn:first-child"] = ["color: " + o.text]));
                                var a;
                                var c = document.createElement("style");
                                document.head.appendChild(c), p.customStyles[e] = { references: 1, element: c.sheet };
                                var l = -1;
                                for (var u in n) n.hasOwnProperty(u) && c.sheet.insertRule(u + "{" + n[u].join(";") + "}", ++l)
                            }(t, e, "." + i), n
                        }.call(this, this.options.palette), this.customStyleSelector && i.push(this.customStyleSelector), i
                }

                function r(e) {
                    var t = this.options,
                        i = document.createElement("div"),
                        n = t.container && 1 === t.container.nodeType ? t.container : document.body;
                    i.innerHTML = e;
                    var o = i.children[0];
                    return o.style.display = "none", d.hasClass(o, "cc-window") && p.hasTransition && d.addClass(o, "cc-invisible"), this.onButtonClick = function(e) {
                        var t = e.target;
                        if (d.hasClass(t, "cc-btn")) {
                            var i = t.className.match(new RegExp("\\bcc-(" + l.join("|") + ")\\b")),
                                n = i && i[1] || !1;
                            n && (this.setStatus(n), this.close(!0))
                        }
                        d.hasClass(t, "cc-close") && (this.setStatus(p.status.dismiss), this.close(!0)), d.hasClass(t, "cc-revoke") && this.revokeChoice()
                    }.bind(this), o.addEventListener("click", this.onButtonClick), t.autoAttach && (n.firstChild ? n.insertBefore(o, n.firstChild) : n.appendChild(o)), o
                }

                function a(e, t) { for (var i = 0, n = e.length; i < n; ++i) { var o = e[i]; if (o instanceof RegExp && o.test(t) || "string" == typeof o && o.length && o === t) return !0 } return !1 }
                var c = { enabled: !0, container: null, cookie: { name: "cookieconsent_status", path: "/", domain: "", expiryDays: 365 }, onPopupOpen: function() {}, onPopupClose: function() {}, onInitialise: function(e) {}, onStatusRead: function(e, t) {}, onRevokeChoice: function() {}, content: { header: "Cookies used on the website!", message: "This website uses cookies to ensure you get the best experience on our website.", dismiss: "Got it!", allow: "Allow cookies", deny: "Decline", link: "Learn more", href: "http://cookiesandyou.com", close: "&#x274c;" }, elements: { header: '<span class="cc-header">{{header}}</span>&nbsp;', message: '<span id="cookieconsent:desc" class="cc-message">{{message}}</span>', messagelink: '<span id="cookieconsent:desc" class="cc-message">{{message}} <a aria-label="learn more about cookies" role=button tabindex="0" class="cc-link" href="{{href}}" target="_blank">{{link}}</a></span>', dismiss: '<a aria-label="dismiss cookie message" role=button tabindex="0" class="cc-btn cc-dismiss">{{dismiss}}</a>', allow: '<a aria-label="allow cookies" role=button tabindex="0"  class="cc-btn cc-allow">{{allow}}</a>', deny: '<a aria-label="deny cookies" role=button tabindex="0" class="cc-btn cc-deny">{{deny}}</a>', link: '<a aria-label="learn more about cookies" role=button tabindex="0" class="cc-link" href="{{href}}" target="_blank">{{link}}</a>', close: '<span aria-label="dismiss cookie message" role=button tabindex="0" class="cc-close">{{close}}</span>' }, window: '<div role="dialog" aria-live="polite" aria-label="cookieconsent" aria-describedby="cookieconsent:desc" class="cc-window {{classes}}">\x3c!--googleoff: all--\x3e{{children}}\x3c!--googleon: all--\x3e</div>', revokeBtn: '<div class="cc-revoke {{classes}}">Cookie Policy</div>', compliance: { info: '<div class="cc-compliance">{{dismiss}}</div>', "opt-in": '<div class="cc-compliance cc-highlight">{{dismiss}}{{allow}}</div>', "opt-out": '<div class="cc-compliance cc-highlight">{{deny}}{{dismiss}}</div>' }, type: "info", layouts: { basic: "{{messagelink}}{{compliance}}", "basic-close": "{{messagelink}}{{compliance}}{{close}}", "basic-header": "{{header}}{{message}}{{link}}{{compliance}}" }, layout: "basic", position: "bottom", theme: "block", static: !1, palette: null, revokable: !1, animateRevokable: !0, showLink: !0, dismissOnScroll: !1, dismissOnTimeout: !1, autoOpen: !0, autoAttach: !0, whitelistPage: [], blacklistPage: [], overrideHTML: null };
                return e.prototype.initialise = function(e) {
                    this.options && this.destroy(), d.deepExtend(this.options = {}, c), d.isPlainObject(e) && d.deepExtend(this.options, e),
                        function() {
                            var e = this.options.onInitialise.bind(this);
                            if (!window.navigator.cookieEnabled) return e(p.status.deny), !0;
                            if (window.CookiesOK || window.navigator.CookiesOK) return e(p.status.allow), !0;
                            var t = Object.keys(p.status),
                                i = this.getStatus(),
                                n = 0 <= t.indexOf(i);
                            return n && e(i), n
                        }.call(this) && (this.options.enabled = !1), a(this.options.blacklistPage, location.pathname) && (this.options.enabled = !1), a(this.options.whitelistPage, location.pathname) && (this.options.enabled = !0);
                    var t = this.options.window.replace("{{classes}}", s.call(this).join(" ")).replace("{{children}}", function() {
                            var t = {},
                                i = this.options;
                            i.showLink || (i.elements.link = "", i.elements.messagelink = i.elements.message), Object.keys(i.elements).forEach(function(e) { t[e] = d.interpolateString(i.elements[e], function(e) { var t = i.content[e]; return e && "string" == typeof t && t.length ? t : "" }) });
                            var e = i.compliance[i.type];
                            e || (e = i.compliance.info), t.compliance = d.interpolateString(e, function(e) { return t[e] });
                            var n = i.layouts[i.layout];
                            return n || (n = i.layouts.basic), d.interpolateString(n, function(e) { return t[e] })
                        }.call(this)),
                        i = this.options.overrideHTML;
                    if ("string" == typeof i && i.length && (t = i), this.options.static) {
                        var n = r.call(this, '<div class="cc-grower">' + t + "</div>");
                        n.style.display = "", this.element = n.firstChild, this.element.style.display = "none", d.addClass(this.element, "cc-invisible")
                    } else this.element = r.call(this, t);
                    (function() {
                        var t = this.setStatus.bind(this),
                            e = this.options.dismissOnTimeout;
                        "number" == typeof e && 0 <= e && (this.dismissTimeout = window.setTimeout(function() { t(p.status.dismiss) }, Math.floor(e)));
                        var i = this.options.dismissOnScroll;
                        if ("number" == typeof i && 0 <= i) {
                            var n = function(e) { window.pageYOffset > Math.floor(i) && (t(p.status.dismiss), window.removeEventListener("scroll", n), this.onWindowScroll = null) };
                            this.onWindowScroll = n, window.addEventListener("scroll", n)
                        }
                    }).call(this),
                        function() {
                            if ("info" != this.options.type && (this.options.revokable = !0), d.isMobile() && (this.options.animateRevokable = !1), this.options.revokable) {
                                var e = o.call(this);
                                this.options.animateRevokable && e.push("cc-animate"), this.customStyleSelector && e.push(this.customStyleSelector);
                                var t = this.options.revokeBtn.replace("{{classes}}", e.join(" "));
                                this.revokeBtn = r.call(this, t);
                                var n = this.revokeBtn;
                                if (this.options.animateRevokable) {
                                    var i = d.throttle(function(e) {
                                        var t = !1,
                                            i = window.innerHeight - 20;
                                        d.hasClass(n, "cc-top") && e.clientY < 20 && (t = !0), d.hasClass(n, "cc-bottom") && e.clientY > i && (t = !0), t ? d.hasClass(n, "cc-active") || d.addClass(n, "cc-active") : d.hasClass(n, "cc-active") && d.removeClass(n, "cc-active")
                                    }, 200);
                                    this.onMouseMove = i, window.addEventListener("mousemove", i)
                                }
                            }
                        }.call(this), this.options.autoOpen && this.autoOpen()
                }, e.prototype.destroy = function() {
                    this.onButtonClick && this.element && (this.element.removeEventListener("click", this.onButtonClick), this.onButtonClick = null), this.dismissTimeout && (clearTimeout(this.dismissTimeout), this.dismissTimeout = null), this.onWindowScroll && (window.removeEventListener("scroll", this.onWindowScroll), this.onWindowScroll = null), this.onMouseMove && (window.removeEventListener("mousemove", this.onMouseMove), this.onMouseMove = null), this.element && this.element.parentNode && this.element.parentNode.removeChild(this.element), this.element = null, this.revokeBtn && this.revokeBtn.parentNode && this.revokeBtn.parentNode.removeChild(this.revokeBtn), this.revokeBtn = null,
                        function(e) {
                            if (d.isPlainObject(e)) {
                                var t = d.hash(JSON.stringify(e)),
                                    i = p.customStyles[t];
                                if (i && !--i.references) {
                                    var n = i.element.ownerNode;
                                    n && n.parentNode && n.parentNode.removeChild(n), p.customStyles[t] = null
                                }
                            }
                        }(this.options.palette), this.options = null
                }, e.prototype.open = function(e) { if (this.element) return this.isOpen() || (p.hasTransition ? this.fadeIn() : this.element.style.display = "", this.options.revokable && this.toggleRevokeButton(), this.options.onPopupOpen.call(this)), this }, e.prototype.close = function(e) { if (this.element) return this.isOpen() && (p.hasTransition ? this.fadeOut() : this.element.style.display = "none", e && this.options.revokable && this.toggleRevokeButton(!0), this.options.onPopupClose.call(this)), this }, e.prototype.fadeIn = function() {
                    var e = this.element;
                    if (p.hasTransition && e && (this.afterTransition && n.call(this, e), d.hasClass(e, "cc-invisible"))) {
                        if (e.style.display = "", this.options.static) {
                            var t = this.element.clientHeight;
                            this.element.parentNode.style.maxHeight = t + "px"
                        }
                        this.openingTimeout = setTimeout(i.bind(this, e), 20)
                    }
                }, e.prototype.fadeOut = function() {
                    var e = this.element;
                    p.hasTransition && e && (this.openingTimeout && (clearTimeout(this.openingTimeout), i.bind(this, e)), d.hasClass(e, "cc-invisible") || (this.options.static && (this.element.parentNode.style.maxHeight = ""), this.afterTransition = n.bind(this, e), e.addEventListener(p.transitionEnd, this.afterTransition), d.addClass(e, "cc-invisible")))
                }, e.prototype.isOpen = function() { return this.element && "" == this.element.style.display && (!p.hasTransition || !d.hasClass(this.element, "cc-invisible")) }, e.prototype.toggleRevokeButton = function(e) { this.revokeBtn && (this.revokeBtn.style.display = e ? "" : "none") }, e.prototype.revokeChoice = function(e) { this.options.enabled = !0, this.clearStatus(), this.options.onRevokeChoice.call(this), e || this.autoOpen() }, e.prototype.hasAnswered = function(e) { return 0 <= Object.keys(p.status).indexOf(this.getStatus()) }, e.prototype.hasConsented = function(e) { var t = this.getStatus(); return t == p.status.allow || t == p.status.dismiss }, e.prototype.autoOpen = function(e) {!this.hasAnswered() && this.options.enabled && this.open() }, e.prototype.setStatus = function(e) {
                    var t = this.options.cookie,
                        i = d.getCookie(t.name),
                        n = 0 <= Object.keys(p.status).indexOf(i);
                    0 <= Object.keys(p.status).indexOf(e) ? (d.setCookie(t.name, e, t.expiryDays, t.domain, t.path), this.options.onStatusOnload.call(this, e, n)) : this.clearStatus()
                }, e.prototype.getStatus = function() { return d.getCookie(this.options.cookie.name) }, e.prototype.clearStatus = function() {
                    var e = this.options.cookie;
                    d.setCookie(e.name, "", -1, e.domain, e.path)
                }, e
            }(), p.Location = function() {
                function e(e) { d.deepExtend(this.options = {}, i), d.isPlainObject(e) && d.deepExtend(this.options, e), this.currentServiceIndex = -1 }

                function t(e, t, i) {
                    var n, o = document.createElement("script");
                    o.type = "text/" + (e.type || "javascript"), o.src = e.src || e, o.async = !1, o.onreadystateonload = o.onload = function() {
                        var e = o.readyState;
                        clearTimeout(n), t.done || e && !/loaded|complete/.test(e) || (t.done = !0, t(), o.onreadystateonload = o.onload = null)
                    }, document.body.appendChild(o), n = setTimeout(function() { t.done = !0, t(), o.onreadystateonload = o.onload = null }, i)
                }

                function s(e, t, i, n, o) {
                    var s = new(window.XMLHttpRequest || window.ActiveXObject)("MSXML2.XMLHTTP.3.0");
                    if (s.open(n ? "POST" : "GET", e, 1), s.setRequestHeader("X-Requested-With", "XMLHttpRequest"), s.setRequestHeader("Content-type", "application/x-www-form-urlencoded"), Array.isArray(o))
                        for (var r = 0, a = o.length; r < a; ++r) {
                            var c = o[r].split(":", 2);
                            s.setRequestHeader(c[0].replace(/^\s+|\s+$/g, ""), c[1].replace(/^\s+|\s+$/g, ""))
                        }
                    "function" == typeof t && (s.onreadystateonload = function() { 3 < s.readyState && t(s) }), s.send(n)
                }

                function n(e) { return new Error("Error [" + (e.code || "UNKNOWN") + "]: " + e.error) }
                var i = { timeout: 5e3, services: ["freegeoip", "ipinfo", "maxmind"], serviceDefinitions: { freegeoip: function() { return { url: "//freegeoip.net/json/?callback={callback}", isScript: !0, callback: function(e, t) { try { var i = JSON.parse(t); return i.error ? n(i) : { code: i.country_code } } catch (e) { return n({ error: "Invalid response (" + e + ")" }) } } } }, ipinfo: function() { return { url: "//ipinfo.io", headers: ["Accept: application/json"], callback: function(e, t) { try { var i = JSON.parse(t); return i.error ? n(i) : { code: i.country } } catch (e) { return n({ error: "Invalid response (" + e + ")" }) } } } }, ipinfodb: function(e) { return { url: "//api.ipinfodb.com/v3/ip-country/?key={api_key}&format=json&callback={callback}", isScript: !0, callback: function(e, t) { try { var i = JSON.parse(t); return "ERROR" == i.statusCode ? n({ error: i.statusMessage }) : { code: i.countryCode } } catch (e) { return n({ error: "Invalid response (" + e + ")" }) } } } }, maxmind: function() { return { url: "//js.maxmind.com/js/apis/geoip2/v2.1/geoip2.js", isScript: !0, callback: function(t) { return window.geoip2 ? void geoip2.country(function(e) { try { t({ code: e.country.iso_code }) } catch (e) { t(n(e)) } }, function(e) { t(n(e)) }) : void t(new Error("Unexpected response format. The downloaded script should have exported `geoip2` to the global scope")) } } } } };
                return e.prototype.getNextService = function() { for (var e; e = this.getServiceByIdx(++this.currentServiceIndex), this.currentServiceIndex < this.options.services.length && !e;); return e }, e.prototype.getServiceByIdx = function(e) { var t = this.options.services[e]; if ("function" != typeof t) return "string" == typeof t ? this.options.serviceDefinitions[t]() : d.isPlainObject(t) ? this.options.serviceDefinitions[t.name](t) : null; var i = t(); return i.name && d.deepExtend(i, this.options.serviceDefinitions[i.name](i)), i }, e.prototype.locate = function(e, t) { var i = this.getNextService(); return i ? (this.callbackComplete = e, this.callbackError = t, void this.runService(i, this.runNextServiceOnError.bind(this))) : void t(new Error("No services to run")) }, e.prototype.setupUrl = function(n) { var o = this.getCurrentServiceOpts(); return n.url.replace(/\{(.*?)\}/g, function(e, t) { if ("callback" === t) { var i = "callback" + Date.now(); return window[i] = function(e) { n.__JSONP_DATA = JSON.stringify(e) }, i } if (t in o.interpolateUrl) return o.interpolateUrl[t] }) }, e.prototype.runService = function(i, n) {
                    var o = this;
                    i && i.url && i.callback && (i.isScript ? t : s)(this.setupUrl(i), function(e) {
                        var t = e ? e.responseText : "";
                        i.__JSONP_DATA && (t = i.__JSONP_DATA, delete i.__JSONP_DATA), o.runServiceCallback.call(o, n, i, t)
                    }, this.options.timeout, i.data, i.headers)
                }, e.prototype.runServiceCallback = function(t, e, i) {
                    var n = this,
                        o = e.callback(function(e) { o || n.onServiceResult.call(n, t, e) }, i);
                    o && this.onServiceResult.call(this, t, o)
                }, e.prototype.onServiceResult = function(e, t) { t instanceof Error || t && t.error ? e.call(this, t, null) : e.call(this, null, t) }, e.prototype.runNextServiceOnError = function(e, t) {
                    if (e) {
                        this.logError(e);
                        var i = this.getNextService();
                        i ? this.runService(i, this.runNextServiceOnError.bind(this)) : this.completeService.call(this, this.callbackError, new Error("All services failed"))
                    } else this.completeService.call(this, this.callbackComplete, t)
                }, e.prototype.getCurrentServiceOpts = function() { var e = this.options.services[this.currentServiceIndex]; return "string" == typeof e ? { name: e } : "function" == typeof e ? e() : d.isPlainObject(e) ? e : {} }, e.prototype.completeService = function(e, t) { this.currentServiceIndex = -1, e && e(t) }, e.prototype.logError = function(e) {
                    var t = this.currentServiceIndex,
                        i = this.getServiceByIdx(t);
                    console.error("The service[" + t + "] (" + i.url + ") responded with the following error", e)
                }, e
            }(), p.Law = function() {
                function e(e) { this.initialise.apply(this, arguments) }
                var t = { regionalLaw: !0, hasLaw: ["AT", "BE", "BG", "HR", "CZ", "CY", "DK", "EE", "FI", "FR", "DE", "EL", "HU", "IE", "IT", "LV", "LT", "LU", "MT", "NL", "PL", "PT", "SK", "SI", "ES", "SE", "GB", "UK"], revokable: ["HR", "CY", "DK", "EE", "FR", "DE", "LV", "LT", "NL", "PT", "ES"], explicitAction: ["HR", "IT", "ES"] };
                return e.prototype.initialise = function(e) { d.deepExtend(this.options = {}, t), d.isPlainObject(e) && d.deepExtend(this.options, e) }, e.prototype.get = function(e) { var t = this.options; return { hasLaw: 0 <= t.hasLaw.indexOf(e), revokable: 0 <= t.revokable.indexOf(e), explicitAction: 0 <= t.explicitAction.indexOf(e) } }, e.prototype.applyLaw = function(e, t) { var i = this.get(t); return i.hasLaw || (e.enabled = !1), this.options.regionalLaw && (i.revokable && (e.revokable = !0), i.explicitAction && (e.dismissOnScroll = !1, e.dismissOnTimeout = !1)), e }, e
            }(), p.initialise = function(t, i, n) {
                var o = new p.Law(t.law);
                i || (i = function() {}), n || (n = function() {}), p.getCountryCode(t, function(e) { delete t.law, delete t.location, e.code && (t = o.applyLaw(t, e.code)), i(new p.Popup(t)) }, function(e) { delete t.law, delete t.location, n(e, new p.Popup(t)) })
            }, p.getCountryCode = function(e, t, i) { e.law && e.law.countryCode ? t({ code: e.law.countryCode }) : e.location ? new p.Location(e.location).locate(function(e) { t(e || {}) }, i) : t({}) }, p.utils = d, p.hasInitialised = !0, window.cookieconsent = p
        }
    }(window.cookieconsent || {}),
    function s(r, a, c) {
        function l(t, e) {
            if (!a[t]) {
                if (!r[t]) { var i = "function" == typeof require && require; if (!e && i) return i(t, !0); if (u) return u(t, !0); var n = new Error("Cannot find module '" + t + "'"); throw n.code = "MODULE_NOT_FOUND", n }
                var o = a[t] = { exports: {} };
                r[t][0].call(o.exports, function(e) { return l(r[t][1][e] || e) }, o, o.exports, s, r, a, c)
            }
            return a[t].exports
        }
        for (var u = "function" == typeof require && require, e = 0; e < c.length; e++) l(c[e]);
        return l
    }({
        1: [function(e, t, i) {
            "use strict";
            var n = e("./utils/clear");
            document.querySelector("#header-list-language button").addEventListener("click", function() { document.querySelector("#header-list-language .dropdown-menu").classList.toggle("show") });
            var o = document.getElementById("textarea-input"),
                s = document.getElementById("trigger-input-clear"),
                r = document.getElementById("count-chars"),
                a = document.getElementById("count-words"),
                c = 0,
                l = 0;

            function u() {
                var e = o.value.match(/\w+/gi);
                e = e ? e.length : 0, a.innerHTML = e, l = e
            }

            function p() {
                var e = o.value.length;
                r.innerHTML = e, c = e
            }
            o.addEventListener("input", function() { o.value, p(), u(), 0 < c ? s.classList.remove("d-none") : s.classList.add("d-none") }), document.getElementById("calc-speechtime").addEventListener("click", function() {
                var e = document.querySelector(".type-options input[type=radio]:checked").value,
                    t = parseInt(document.querySelector(".rythm-options input[type=radio]:checked").value);
                "locution" == e && (t += 45);
                var i = parseInt(l) / t,
                    n = Math.floor(i),
                    o = n + "min " + Math.floor(60 * (i - n)) + "sec";
                document.getElementById("speech-time-result").innerHTML = o
            }), document.getElementById("trigger-input-clear").addEventListener("click", function() { n(o), p(), u() })
        }, { "./utils/clear": 2 }],
        2: [function(e, t, i) {
            "use strict";
            t.exports = function(e) { e.select(), e.value = "" }
        }, {}]
    }, {}, [1]);