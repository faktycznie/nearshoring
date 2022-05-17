function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

document.addEventListener("DOMContentLoaded", function () {
  var searchBtn = document.querySelector('.search-nav__button');

  if (searchBtn) {
    var searchBox = document.querySelector('.search-box');
    searchBtn.addEventListener('click', function (event) {
      if (searchBox.classList.contains('search-box--open')) {
        searchBox.classList.remove('search-box--open');
      } else {
        searchBox.classList.add('search-box--open');
      }
    });
    if (document.body.classList.contains('search')) searchBox.classList.add('search-box--open');
  }

  var blogNext = document.querySelector('.blog__navi > .next');
  var blogPrev = document.querySelector('.blog__navi > .prev');
  var blogContainer = document.querySelector('.blog__list');
  var blogContent = document.querySelector('.blog__content');

  if (blogContent) {
    var myFetch = function myFetch() {
      blogContainer.classList.add('blog__content--loading');
      return fetch.apply(this, arguments);
    };

    var page = blogContainer.getAttribute('data-current');
    var max_page = blogContainer.getAttribute('data-max');

    if (blogNext) {
      blogNext.addEventListener('click', function (event) {
        event.preventDefault();
        var myData = {
          'action': 'loadmore',
          'dir': 'next',
          'query': nearshoring_params.query,
          // that's how we get params from wp_localize_script() function
          'page': page,
          'max_page': max_page
        };
        var params = new URLSearchParams(myData);
        myFetch(nearshoring_params.ajaxurl, {
          method: 'POST',
          body: params
        }).then(function (response) {
          return response.text();
        }).then(function (data) {
          var e = document.createElement('div');
          e.innerHTML = data;
          var newPosts = e.querySelectorAll('article');
          var newCount = newPosts.length;
          e.remove();
          blogContainer.setAttribute('data-current', ++page);

          if (newCount > 0) {
            // const posts = blogContainer.querySelectorAll('article');
            // for (let i = 0; i < newCount; i++) {
            // 	posts[i].remove();
            // }
            blogContainer.classList.remove('blog__content--loading');
            blogContainer.innerHTML = '';
            blogContainer.insertAdjacentHTML('beforeend', data);
          }

          blogPrev.classList.remove('disabled');
          blogPrev.disabled = false;

          if (page >= max_page) {
            blogNext.classList.add('disabled');
            blogNext.disabled = true;
          }
        })["catch"](function (error) {
          console.error('Error:', error);
        });
      });
    }

    if (blogPrev) {
      blogPrev.addEventListener('click', function (event) {
        event.preventDefault();
        var myData = {
          'action': 'loadmore',
          'dir': 'prev',
          'query': nearshoring_params.query,
          // that's how we get params from wp_localize_script() function
          'page': page,
          'max_page': max_page
        };
        var params = new URLSearchParams(myData);
        myFetch(nearshoring_params.ajaxurl, {
          method: 'POST',
          body: params
        }).then(function (response) {
          return response.text();
        }).then(function (data) {
          var e = document.createElement('div');
          e.innerHTML = data;
          var newPosts = e.querySelectorAll('article');
          var newCount = newPosts.length;
          e.remove();
          blogContainer.setAttribute('data-current', --page);

          if (newCount > 0) {
            // const posts = blogContainer.querySelectorAll('article');
            // for (let i = 0; i < newCount; i++) {
            // 	const n = 8 - i - 1;
            // 	if( posts[n] ) posts[n].remove();
            // }
            blogContainer.classList.remove('blog__content--loading');
            blogContainer.innerHTML = '';
            blogContainer.insertAdjacentHTML('afterbegin', data);
          }

          blogNext.classList.remove('disabled');
          blogNext.disabled = false;

          if (page <= 1) {
            blogPrev.classList.add('disabled');
            blogPrev.disabled = true;
          }
        })["catch"](function (error) {
          console.error('Error:', error);
        });
      });
    }
  } //brand mask


  var mask = document.querySelector('.brand__mask');
  var show = document.querySelector('.show-brand');

  if (mask && show) {
    var effect = 0;
    var scrollpos = window.scrollY;
    var header = document.body;
    var breakpoint = 1;
    var place = document.querySelector('.header__brand');
    var logo = document.querySelector('.brand__logo');

    var set_logo_position = function set_logo_position() {
      var rect = place.getBoundingClientRect();
      logo.style.top = rect.top + 'px';
      logo.style.left = rect.left + 'px';
    };

    var triggerAnimation = function triggerAnimation() {
      header.classList.add("brand-effect");
      set_logo_position();
      setTimeout(function () {
        header.classList.remove("show-brand");
        header.classList.remove("brand-effect");
        logo.removeAttribute('style');
        effect = 1;
        document.cookie = "nearshoring_effect=1; expires=0; path=/";
      }, 1010);
    };

    window.addEventListener('scroll', function () {
      scrollpos = window.scrollY;

      if (scrollpos >= breakpoint) {
        if (!effect) {
          triggerAnimation();
        }
      }
    });
    mask.addEventListener('click', function () {
      if (!effect) {
        triggerAnimation();
      }
    });
  }

  var menuMobile = function menuMobile() {
    var mobileBtn = document.querySelector('.hamburger');

    if (mobileBtn) {
      var menu = document.querySelector('.nav-menu__container');
      mobileBtn.addEventListener('click', function (event) {
        event.preventDefault();
        this.classList.toggle('hamburger--active');
        document.body.classList.toggle('menu-mobile');
        menu.classList.toggle('nav-menu__container--mobile');
        menu.classList.toggle('animate__animated');
        menu.classList.toggle('animate__bounceInDown');
      });

      var onHashClick = function onHashClick() {
        mobileBtn.classList.remove('hamburger--active');
        document.body.classList.remove('menu-mobile');
        menu.classList.remove('nav-menu__container--mobile');
        menu.classList.remove('animate__animated');
        menu.classList.remove('animate__bounceInDown');
      };

      menu.querySelectorAll('a[href^="#"]').forEach(function (input) {
        return input.addEventListener('click', onHashClick);
      });
    }
  };

  menuMobile();
  var introMoreBtn = document.querySelector('.intro .intro__readmore');
  var introFull = document.querySelector('.intro .intro__fulltext');

  if (introMoreBtn && introFull) {
    var label = introMoreBtn.querySelector('.intro .readmore__label');
    introMoreBtn.addEventListener('click', function (event) {
      event.preventDefault();
      var lbl = label.innerHTML;
      var nlbl = this.getAttribute('data-label');

      if (this.classList.contains('readmore--active')) {
        this.classList.remove('readmore--active');
        introFull.classList.remove('intro__fulltext--active');
        label.innerHTML = nlbl;
        this.setAttribute('data-label', lbl);
      } else {
        this.classList.add('readmore--active');
        introFull.classList.add('intro__fulltext--active');
        label.innerHTML = nlbl;
        this.setAttribute('data-label', lbl);
      }
    });
  }

  function bitTitles() {
    var blogTitles = document.querySelectorAll('.blog__list .post .post__title');

    if (blogTitles) {
      var getHeight = function getHeight(element, index, array) {
        element.style.minHeight = '';
        var iheight = element.offsetHeight;
        if (iheight > height) height = iheight;
      };

      var setHeight = function setHeight(element, index, array) {
        element.style.minHeight = height + 'px';
      };

      var height = 0;
      blogTitles.forEach(getHeight);
      blogTitles.forEach(setHeight);
    }
  }

  bitTitles();
  window.onresize = bitTitles;

  function newsletterCheckAll() {
    var last = document.querySelector('.page-template-default .wpcf7-checkbox .wpcf7-list-item.last');

    if (last) {
      last.addEventListener('click', function () {
        var checkboxes = document.querySelectorAll('.page-template-default .wpcf7-checkbox input');

        var _iterator = _createForOfIteratorHelper(checkboxes),
            _step;

        try {
          for (_iterator.s(); !(_step = _iterator.n()).done;) {
            var ch = _step.value;
            var selected = ch.checked;
            ch.checked = !ch.checked;
          }
        } catch (err) {
          _iterator.e(err);
        } finally {
          _iterator.f();
        }
      });
    }
  }

  newsletterCheckAll();

  function resizeHeadings() {
    var headings = jQuery('.content h1, .content h2, .content h3');
    var mq = window.matchMedia("(max-width: 480px)");

    if (mq.matches) {
      headings.each(function () {
        resizeFont(jQuery(this));
      });
    }
  }

  resizeHeadings();

  function resizeFont(el) {
    if (!el.hasClass('resize-font')) el.addClass('resize-font');
    el.css('font-size', '');
    var s = jQuery('<span>' + el.text() + '</span>');
    s.css({
      position: 'absolute',
      left: -9999,
      top: -9999,
      // ensure that the span has same font properties as the element
      'font-family': el.css('font-family'),
      'font-size': el.css('font-size'),
      'font-weight': el.css('font-weight'),
      'font-style': el.css('font-style')
    });
    jQuery('body').append(s);

    if (s.width() > el.width()) {
      while (s.width() > el.width()) {
        s.css('font-size', 0.95 * parseInt(s.css('font-size')));
        if (parseInt(s.css('font-size')) <= 20) break;
      }
    }

    el.css('font-size', parseInt(s.css('font-size'))); //remove the newly created span

    s.remove();
  }
});