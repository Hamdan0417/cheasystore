(function () {
  if (typeof window === 'undefined') return;
  if (typeof cheasyWeb3Checkout === 'undefined') return;

  document.addEventListener('cheasy:initCryptoCheckout', (event) => {
    console.info('Init crypto checkout', event.detail);
  });

  document.addEventListener('DOMContentLoaded', () => {
    const checkoutWidget = document.querySelector('.cheasy-web3-widget');
    if (!checkoutWidget) return;

    checkoutWidget.addEventListener('click', async () => {
      try {
        const response = await fetch(cheasyWeb3Checkout.endpoint, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-WP-Nonce': cheasyWeb3Checkout.nonce,
          },
          body: JSON.stringify({
            order_id: checkoutWidget.dataset.orderId,
            tx_hash: '0xPLACEHOLDER',
          }),
        });
        const data = await response.json();
        console.info('Transaction stored', data);
      } catch (error) {
        console.error('Failed to store transaction', error);
      }
    });
  });
})();
