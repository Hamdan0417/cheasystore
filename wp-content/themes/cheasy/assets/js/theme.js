(function () {
  const body = document.querySelector('body');

  document.querySelectorAll('.cheasy-mega__toggle').forEach((toggle) => {
    toggle.addEventListener('click', () => {
      const menu = toggle.closest('li').querySelector('.cheasy-mega');
      if (!menu) {
        return;
      }

      menu.classList.toggle('is-open');
    });
  });

  document.querySelectorAll('.cheasy-crypto-checkout').forEach((button) => {
    button.addEventListener('click', () => {
      body.dispatchEvent(new CustomEvent('cheasy:initCryptoCheckout', { detail: { source: 'product' } }));
    });
  });
})();
