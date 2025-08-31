<?php // app/Views/partials/cart-modal.php ?>
<div id="cartModal" class="cart-modal" style="display:none;">
  <div class="cart-content">
    <span class="close" aria-label="Fechar">×</span>
    <h2>🛒 Seu Carrinho</h2>

    <div id="cartItems"><p>Carregando...</p></div>

    <h3 style="margin-top:12px;">Total: R$ <span id="cartTotal">0,00</span></h3>

    <div style="display:flex; gap:10px; margin-top:12px;">
      <a class="btn" href="<?= BASE_URL ?>router.php?page=checkout">Finalizar Compra</a>
      <button type="button" class="btn" id="closeCartBtn" style="background:#777;">Fechar</button>
    </div>
  </div>
</div>
