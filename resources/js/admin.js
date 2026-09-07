import 'bootstrap/dist/js/bootstrap.bundle.min.js';

document.addEventListener('DOMContentLoaded', function () {
	const toggle = document.querySelector('.admin-menu-toggle');
	const sidebar = document.querySelector('.sidebar');
	const closeButtons = document.querySelectorAll('[data-admin-menu-close]');

	if (!toggle || !sidebar) return;

	function setMenu(open) {
		sidebar.classList.toggle('is-open', open);
		document.body.classList.toggle('admin-menu-open', open);
		toggle.setAttribute('aria-expanded', String(open));
	}

	toggle.addEventListener('click', function () {
		setMenu(!sidebar.classList.contains('is-open'));
	});

	closeButtons.forEach(function (button) {
		button.addEventListener('click', function () { setMenu(false); });
	});

	sidebar.querySelectorAll('a').forEach(function (link) {
		link.addEventListener('click', function () { setMenu(false); });
	});

	document.addEventListener('keydown', function (event) {
		if (event.key === 'Escape') setMenu(false);
	});
});
