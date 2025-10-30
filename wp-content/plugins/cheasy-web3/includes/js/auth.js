(function () {
  if (typeof window === 'undefined' || typeof cheasyWeb3Auth === 'undefined') return;

  const triggers = document.querySelectorAll('.cheasy-wallet-trigger');

  async function requestSession() {
    const response = await fetch(cheasyWeb3Auth.endpoint, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({})
    });

    return response.json();
  }

  triggers.forEach((button) => {
    button.addEventListener('click', async () => {
      button.disabled = true;
      try {
        const session = await requestSession();
        document.dispatchEvent(new CustomEvent('cheasy:web3:login', { detail: session }));
      } catch (error) {
        console.error('Wallet login failed', error);
      } finally {
        button.disabled = false;
      }
    });
  });
})();
