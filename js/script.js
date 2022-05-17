document.addEventListener("DOMContentLoaded", function() {
	const searchBtn = document.querySelector('.search-nav__button');
	if( searchBtn ) {
		const searchBox = document.querySelector('.search-box');
		searchBtn.addEventListener('click', function(event) {
			if( searchBox.classList.contains('search-box--open') ) {
				searchBox.classList.remove('search-box--open');
			} else {
				searchBox.classList.add('search-box--open');
			}
		});

		if( document.body.classList.contains('search') ) searchBox.classList.add('search-box--open');
	}

	const blogNext = document.querySelector('.blog__navi > .next');
	const blogPrev = document.querySelector('.blog__navi > .prev');
	const blogContainer = document.querySelector('.blog__list');
	const blogContent = document.querySelector('.blog__content');

	if( blogContent ) {
		
		let page = blogContainer.getAttribute('data-current');
		const max_page = blogContainer.getAttribute('data-max');

		function myFetch() {
			blogContainer.classList.add('blog__content--loading');
			return fetch.apply(this, arguments);
		}

		if( blogNext ) {
			blogNext.addEventListener('click', function(event) {
				event.preventDefault();

				const myData = {
					'action': 'loadmore',
					'dir': 'next',
					'query': nearshoring_params.query, // that's how we get params from wp_localize_script() function
					'page' : page,
					'max_page': max_page,
				}
				const params = new URLSearchParams(myData);

				myFetch(nearshoring_params.ajaxurl, {
					method: 'POST',
					body: params,
				}).then(response => response.text()).then(data => {

					let e = document.createElement('div');
					e.innerHTML = data;
					const newPosts = e.querySelectorAll('article');
					const newCount = newPosts.length;
					e.remove();

					blogContainer.setAttribute('data-current', ++page);

					if( newCount > 0 ) {
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
					if( page >= max_page ) {
						blogNext.classList.add('disabled');
						blogNext.disabled = true;
					}

					

				})
				.catch((error) => {
					console.error('Error:', error);
				});
			});
		}

		if( blogPrev) {
			blogPrev.addEventListener('click', function(event) {
				event.preventDefault();

				const myData = {
					'action': 'loadmore',
					'dir': 'prev',
					'query': nearshoring_params.query, // that's how we get params from wp_localize_script() function
					'page' : page,
					'max_page': max_page,
				}

				const params = new URLSearchParams(myData);

				myFetch(nearshoring_params.ajaxurl, {
					method: 'POST',
					body: params,
				})
				.then(response => response.text())
				.then(data => {

					let e = document.createElement('div');
					e.innerHTML = data;
					const newPosts = e.querySelectorAll('article');
					const newCount = newPosts.length;
					e.remove();

					blogContainer.setAttribute('data-current', --page);

					if( newCount > 0 ) {

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
					if( page <= 1 ) {
						blogPrev.classList.add('disabled');
						blogPrev.disabled = true;
					}

				})
				.catch((error) => {
					console.error('Error:', error);
				});
			});
		}
	}

	//brand mask
	const mask = document.querySelector('.brand__mask');
	const show = document.querySelector('.show-brand');

	if( mask && show ) {

		let effect = 0;
		let scrollpos = window.scrollY;
		const header = document.body;
		const breakpoint = 1;

		const place = document.querySelector('.header__brand');
		const logo = document.querySelector('.brand__logo');

		const set_logo_position = function() {
			const rect = place.getBoundingClientRect();
			logo.style.top = rect.top + 'px';
			logo.style.left = rect.left + 'px';
		}

		const triggerAnimation = function() {
			header.classList.add("brand-effect");
			set_logo_position();
			setTimeout(function(){
				header.classList.remove("show-brand");
				header.classList.remove("brand-effect");
				logo.removeAttribute('style');
				effect = 1;
				document.cookie = "nearshoring_effect=1; expires=0; path=/";
			}, 1010);
		}

		window.addEventListener('scroll', function() {
			scrollpos = window.scrollY;

			if (scrollpos >= breakpoint) {
				if( !effect ) {
					triggerAnimation();
				}
			}
		});

		mask.addEventListener('click', function() {
			if( !effect ) {
				triggerAnimation();
			}
		});

	}

	const menuMobile = function() {
		const mobileBtn = document.querySelector('.hamburger');
		if( mobileBtn ) {
			const menu = document.querySelector('.nav-menu__container');

			mobileBtn.addEventListener('click', function(event) {
				event.preventDefault();
				this.classList.toggle('hamburger--active');
				document.body.classList.toggle('menu-mobile');
				menu.classList.toggle('nav-menu__container--mobile');
				menu.classList.toggle('animate__animated');
				menu.classList.toggle('animate__bounceInDown');
			});

			const onHashClick = function() {
				mobileBtn.classList.remove('hamburger--active');
				document.body.classList.remove('menu-mobile');
				menu.classList.remove('nav-menu__container--mobile');
				menu.classList.remove('animate__animated');
				menu.classList.remove('animate__bounceInDown');
			}

			menu.querySelectorAll('a[href^="#"]').forEach(input => input.addEventListener('click', onHashClick));
		}
	}
	menuMobile();

	const introMoreBtn = document.querySelector('.intro .intro__readmore');
	const introFull = document.querySelector('.intro .intro__fulltext');

	if( introMoreBtn && introFull ) {
		const label = introMoreBtn.querySelector('.intro .readmore__label');
		introMoreBtn.addEventListener('click', function(event) {
			event.preventDefault();
			const lbl = label.innerHTML;
			const nlbl = this.getAttribute('data-label');

			if( this.classList.contains('readmore--active') ) {
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
		const blogTitles = document.querySelectorAll('.blog__list .post .post__title');
		if( blogTitles ) {
			let height = 0;
			function getHeight(element, index, array) {
				element.style.minHeight = '';
				const iheight = element.offsetHeight;
				if(iheight > height) height = iheight;
			}
			function setHeight(element, index, array) {
				element.style.minHeight = height + 'px';
			}
			blogTitles.forEach(getHeight);
			blogTitles.forEach(setHeight);
		}
	}
	bitTitles();
	window.onresize = bitTitles;

	function newsletterCheckAll() {
		const last = document.querySelector('.page-template-default .wpcf7-checkbox .wpcf7-list-item.last input');
		if( last ) {
			last.addEventListener('change', function() {
				const checkboxes = document.querySelectorAll('.page-template-default .wpcf7-checkbox .wpcf7-list-item:not(.last) input');
				for(const ch of checkboxes) {
					const selected = ch.checked;
					ch.checked = !selected;
				}
			});
		}
	}
	newsletterCheckAll();


	function resizeHeadings() {
		const headings = jQuery('.content h1, .content h2, .content h3');
		const mq = window.matchMedia( "(max-width: 480px)" );
		if (mq.matches) {
			headings.each(function() {
				resizeFont(jQuery(this));
			})
		}
	}
	resizeHeadings();

	function resizeFont(el) {
		if( ! el.hasClass('resize-font')) el.addClass('resize-font');
		el.css('font-size','');
		var str = el.text();

		str.split(' ').map(function(word) {
			var newSize = 0;
			var s = jQuery('<span>'+ word +'</span>');
			s.css({
				position : 'absolute',
				left : -9999,
				top : -9999,
				// ensure that the span has same font properties as the element
				'font-family' : el.css('font-family'),
				'font-size' : el.css('font-size'),
				'font-weight' : el.css('font-weight'),
				'font-style' : el.css('font-style')
			});
			jQuery('body').append(s);

			var space = 10; //added because of google font and differences between real size and s.width

			if(s.width()+space > (el.width())) {
				while(s.width()+space > el.width()) {
					s.css('font-size', 0.9 * parseInt(s.css('font-size')));
					if(parseInt(s.css('font-size')) <= 20) break;
				}
				var size = parseInt(s.css('font-size'));
				if( newSize < size ) newSize = size;
			}

			if(newSize > 0) el.css('font-size', newSize);
			
			s.remove();
		});

		
	}

});