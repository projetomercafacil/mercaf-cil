<div id="paymentModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h3>Selecione o método de pagamento</h3>
    <form method="post" action="<?= BASE_URL ?>/router.php?page=checkout_process" id="paymentForm">
        <label>
            <input type="radio" name="payment_method" value="Pix" onclick="showPix()"> PIX
        </label><br>
        <label>
            <input type="radio" name="payment_method" value="Cartão de Crédito" onclick="hidePix()"> Cartão de Crédito
        </label><br>
        <label>
            <input type="radio" name="payment_method" value="Cartão de Débito" onclick="hidePix()"> Cartão de Débito
        </label><br><br>

        <!-- Área do PIX -->
        <div id="pixArea" style="display:none; margin-top:15px; text-align:center;">
            <p>Escaneie o QR Code para pagar:</p>
            <img id="pixQr" src="" alt="QR Code PIX" style="width:180px; height:180px; border:1px solid #ccc; border-radius:8px; padding:5px;">
            <p><small>Código copia e cola:</small></p>
            <textarea id="pixCode" readonly style="width:100%; height:60px; font-size:12px;"><?= uniqid("pix-") ?>-<?= rand(1000,9999) ?></textarea>
        </div>

        <button type="submit" class="btn" style="margin-top:15px;">Pagar</button>
    </form>
  </div>
</div>

<style>
/* Modal padrão */
.modal {
  display: none;
  position: fixed;
  z-index: 1000;
  left: 0; top: 0;
  width: 100%; height: 100%;
  overflow: auto;
  background: rgba(0,0,0,0.6);
  justify-content: center;
  align-items: center;
}
.modal-content {
  background: #fff;
  padding: 20px;
  border-radius: 12px;
  max-width: 400px;
  margin: auto;
  text-align: left;
  box-shadow: 0 4px 10px rgba(0,0,0,0.2);
}
.close {
  float: right;
  font-size: 22px;
  font-weight: bold;
  cursor: pointer;
}
.btn {
  display: block;
  width: 100%;
  padding: 10px;
  background: #2ecc71;
  color: white;
  border: none;
  border-radius: 6px;
  cursor: pointer;
}
.btn:hover {
  background: #27ae60;
}
</style>

<script>
// Função PIX: exibe área + gera QR Code
function showPix() {
    document.getElementById("pixArea").style.display = "block";
    const code = document.getElementById("pixCode").value;
    document.getElementById("pixQr").src =
      "https://chart.googleapis.com/chart?cht=qr&chs=180x180&chl=" + encodeURIComponent(code);
}
// Função esconder área PIX
function hidePix() {
    document.getElementById("pixArea").style.display = "none";
}

// Abrir modal
document.querySelectorAll(".open-payment").forEach(btn => {
    btn.addEventListener("click", function(e) {
        e.preventDefault();
        document.getElementById("paymentModal").style.display = "flex";
    });
});

// Fechar modal
document.querySelector(".close").addEventListener("click", function() {
    document.getElementById("paymentModal").style.display = "none";
});
window.addEventListener("click", function(e) {
    if (e.target == document.getElementById("paymentModal")) {
        document.getElementById("paymentModal").style.display = "none";
    }
});
</script>
