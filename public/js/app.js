/* LA MAISON — interactions du site */

// Signale que le JS est actif (active les apparitions au défilement en CSS)
document.documentElement.classList.add('js');

document.addEventListener('DOMContentLoaded', function () {
  // Apparitions au défilement
  var revealEls = document.querySelectorAll('.reveal');
  if (revealEls.length && 'IntersectionObserver' in window) {
    var io = new IntersectionObserver(function (entries, obs) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          obs.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -8% 0px' });
    revealEls.forEach(function (el) { io.observe(el); });
  } else {
    revealEls.forEach(function (el) { el.classList.add('is-visible'); });
  }

  // Menu mobile
  var burger = document.querySelector('.burger');
  var mobileMenu = document.querySelector('.mobile-menu');
  var mobileMenuBackdrop = document.querySelector('.mobile-menu-backdrop');
  var mobileMenuClose = document.querySelectorAll('[data-mobile-menu-close]');
  if (burger && mobileMenu) {
    function setMobileMenu(open) {
      mobileMenu.classList.toggle('is-open', open);
      if (mobileMenuBackdrop) mobileMenuBackdrop.classList.toggle('is-open', open);
      mobileMenu.setAttribute('aria-hidden', String(!open));
      burger.setAttribute('aria-expanded', String(open));
      document.body.classList.toggle('menu-open', open);
    }

    burger.addEventListener('click', function () {
      setMobileMenu(!mobileMenu.classList.contains('is-open'));
    });
    mobileMenuClose.forEach(function (button) {
      button.addEventListener('click', function () { setMobileMenu(false); });
    });
    mobileMenu.querySelectorAll('a').forEach(function (link) {
      link.addEventListener('click', function () { setMobileMenu(false); });
    });
    document.addEventListener('keydown', function (event) {
      if (event.key === 'Escape') setMobileMenu(false);
    });
  }

  // Sélection de coloris (fiche produit)
  document.querySelectorAll('.swatch').forEach(function (sw) {
    sw.addEventListener('click', function () {
      sw.closest('.swatches').querySelectorAll('.swatch').forEach(function (s) {
        s.classList.remove('selected');
      });
      sw.classList.add('selected');
      var input = document.getElementById('color-input');
      if (input) input.value = sw.dataset.color || '';
    });
  });

  // Galerie : clic sur une vignette
  document.querySelectorAll('.gallery .thumbs .ph').forEach(function (thumb) {
    thumb.addEventListener('click', function () {
      var main = document.querySelector('.gallery .main-ph');
      if (main) main.textContent = thumb.textContent;
    });
  });

  // Visualiseur 360°
  var spin = document.getElementById('spin');
  if (spin) initSpin360(spin);
});

/* Visualiseur 360° : rotation d'une séquence d'images au glisser */
function initSpin360(el) {
  var img = el.querySelector('.spin360-img');
  var path = el.dataset.path;
  var slug = el.dataset.slug;
  var frames = parseInt(el.dataset.frames, 10) || 1;
  var index = 0, dragging = false, startX = 0, startIndex = 0, autoTimer = null;
  var sensitivity = 8; // pixels par vue

  function pad(n) { return (n < 10 ? '0' : '') + n; }
  function urlFor(s, i) { return path + '/' + s + '/frame-' + pad(i + 1) + '.svg'; }

  function preload(s) {
    for (var i = 0; i < frames; i++) { var im = new Image(); im.src = urlFor(s, i); }
  }
  function show(i) {
    index = ((i % frames) + frames) % frames;
    img.src = urlFor(slug, index);
  }
  function loadSet(newSlug, newFrames) {
    stopAuto();
    slug = newSlug;
    frames = newFrames || frames;
    preload(slug);
    show(0);
  }

  preload(slug);

  // Glisser (souris + tactile via Pointer Events)
  el.addEventListener('pointerdown', function (e) {
    dragging = true; startX = e.clientX; startIndex = index;
    el.classList.add('dragging', 'touched');
    if (el.setPointerCapture) el.setPointerCapture(e.pointerId);
    stopAuto();
  });
  el.addEventListener('pointermove', function (e) {
    if (!dragging) return;
    var steps = Math.round((e.clientX - startX) / sensitivity);
    show(startIndex - steps);
  });
  function endDrag() { dragging = false; el.classList.remove('dragging'); }
  el.addEventListener('pointerup', endDrag);
  el.addEventListener('pointercancel', endDrag);

  // Contrôles
  var playBtn = el.querySelector('[data-spin="play"]');
  function setPlayIcon(name) {
    var ic = playBtn.querySelector('.material-symbols-outlined');
    if (ic) ic.textContent = name;
  }
  function startAuto() {
    if (autoTimer) return;
    autoTimer = setInterval(function () { show(index + 1); }, 90);
    el.classList.add('touched');
    setPlayIcon('pause');
  }
  function stopAuto() {
    if (autoTimer) { clearInterval(autoTimer); autoTimer = null; }
    setPlayIcon('play_arrow');
  }
  el.querySelector('[data-spin="prev"]').addEventListener('click', function () { stopAuto(); show(index - 1); });
  el.querySelector('[data-spin="next"]').addEventListener('click', function () { stopAuto(); show(index + 1); });
  playBtn.addEventListener('click', function () { autoTimer ? stopAuto() : startAuto(); });

  // Sélecteur de pièces
  document.querySelectorAll('.v360-item').forEach(function (btn) {
    btn.addEventListener('click', function () {
      document.querySelectorAll('.v360-item').forEach(function (b) { b.classList.remove('active'); });
      btn.classList.add('active');
      loadSet(btn.dataset.slug, parseInt(btn.dataset.frames, 10));
    });
  });
}
