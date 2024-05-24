// How to use
/************
ready(function() {
	mdlWin("[data-mdl-id]", {
		onOpen:function() {console.log('1')},
		onShow:function() {console.log('2')},
		onClose:function() {console.log('3')}
	})
});

or

ready(function() {
	mdlWin("[data-mdl-id]")
});
************/


// Document ready function
function ready(fn) {
	if (document.attachEvent ? document.readyState === "complete" : document.readyState !== "loading") {
		fn();
	} else {
		document.addEventListener('DOMContentLoaded', fn);
	}
}

// Closest by class
function closest(el, className) {
    while (!el.classList || !(el.classList.contains(className))) {
        el = el.parentNode;
        if (!el) return null
    }
    return el;
};

// Extend default values with user options
function extend( defaults, options ) {
    var extended = {};
    var prop;
    for (prop in defaults) {
        if (Object.prototype.hasOwnProperty.call(defaults, prop)) {
            extended[prop] = defaults[prop];
        }
    }
    for (prop in options) {
        if (Object.prototype.hasOwnProperty.call(options, prop)) {
            extended[prop] = options[prop];
        }
    }
    return extended;
};


// Find opening btns and associated windows
function mdlWin(btn, options) {
	mdlBtns = document.querySelectorAll(btn);

	mdlBtns.forEach(function(btn) {
		btn.addEventListener("click", function() {
			var win = document.getElementById(this.getAttribute("data-mdl-id"));

			if (!win) return;

			win.defaults = {
				onOpen: null,
				onShow: null,
				onClose: null
			};

			win.options = extend(win.defaults, options);

			mdlOpen(win, btn);
		});
	});
}


// Open window
function mdlOpen(win, btn) {
	if (typeof(win.options.onOpen) === 'function') {
		win.options.onOpen.apply(win);
	}

	win.classList.remove("hidden");
	document.body.classList.add("mdl-body-overflow");

	var closeBtns = win.querySelectorAll(".mdl-close");

	// Listeners functions
	function documentClickListener(el) {
		var closestEl = closest(el.target, 'mdl-window');

	    if (el.target === btn) return

	    if (!closestEl) {
			mdlClose();
		}
	}

	function documentEscListener(evt) {
		evt = evt || window.event;
	    if (evt.keyCode == 27) {
	       mdlClose();
	    }
	}

	function btnClickListener(el) {
		mdlClose();
	}


	// Add listeners
	document.addEventListener('click', documentClickListener);

	document.addEventListener("keydown", documentEscListener);

	closeBtns.forEach(function(closeBtn) {
		closeBtn.addEventListener("click", btnClickListener);
	});


	if (typeof(win.options.onShow) === 'function') {
		win.options.onShow.apply(win);
	}


	function mdlClose () {
		// Remove listeners
		document.removeEventListener('click', documentClickListener);
		document.removeEventListener('keydown', documentEscListener);
		closeBtns.forEach(function(closeBtn) {
			closeBtn.removeEventListener("click", btnClickListener);
		});

		win.classList.add("hidden");
		document.body.classList.remove("mdl-body-overflow");

		if (typeof(win.options.onClose) === 'function') {
			win.options.onClose.apply(win);
		}
	}
}


ready(function() {
	mdlWin("[data-mdl-id]");
});