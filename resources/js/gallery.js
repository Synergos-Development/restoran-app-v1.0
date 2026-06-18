document.addEventListener('DOMContentLoaded', () => {
  const items = Array.from(document.querySelectorAll('[data-gallery]'));
  if (!items.length) return;
  const modal = document.getElementById('lightbox-modal');
  const modalImg = modal.querySelector('img');
  let current = 0;
  const imgs = items.map(i => i.dataset.src || (i.querySelector('img') && i.querySelector('img').src));

  items.forEach((el, idx) => {
    el.style.cursor = 'zoom-in';
    el.addEventListener('click', (e) => { e.preventDefault(); open(idx); });
  });

  function open(i) {
    current = i;
    modal.classList.remove('hidden');
    modal.setAttribute('aria-hidden', 'false');
    modalImg.src = imgs[i];
    document.body.classList.add('overflow-hidden');
  }

  function close() {
    modal.classList.add('hidden');
    modal.setAttribute('aria-hidden', 'true');
    modalImg.src = '';
    document.body.classList.remove('overflow-hidden');
  }

  function next() {
    current = (current + 1) % imgs.length; modalImg.src = imgs[current];
  }
  function prev() {
    current = (current - 1 + imgs.length) % imgs.length; modalImg.src = imgs[current];
  }

  modal.addEventListener('click', (e) => {
    if (e.target.id === 'lightbox-modal' || e.target.dataset.action === 'close') close();
  });

  const btnNext = modal.querySelector('[data-action="next"]');
  const btnPrev = modal.querySelector('[data-action="prev"]');
  btnNext.addEventListener('click', (e) => { e.stopPropagation(); next(); });
  btnPrev.addEventListener('click', (e) => { e.stopPropagation(); prev(); });

  document.addEventListener('keydown', (e) => {
    if (modal.classList.contains('hidden')) return;
    if (e.key === 'Escape') close();
    if (e.key === 'ArrowRight') next();
    if (e.key === 'ArrowLeft') prev();
  });
});