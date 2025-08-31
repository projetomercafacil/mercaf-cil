<div id="paymentModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Pagamento</h2>

    <form id="paymentForm">
      <div class="form-group">
        <label for="paymentMethod">Método de pagamento:</label>
        <select id="paymentMethod" name="paymentMethod">
          <option value="pix">Pix</option>
          <option value="debito">Cartão de Débito</option>
          <option value="credito">Cartão de Crédito</option>
        </select>
      </div>

      <div id="cardFields" style="display: none;">
        <div class="form-group">
          <label for="cardNumber">Número do cartão</label>
          <input type="text" id="cardNumber" placeholder="0000 0000 0000 0000">
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="validade">Validade</label>
            <input type="month" id="validade">
          </div>
          <div class="form-group">
            <label for="cvv">CVV</label>
            <input type="text" id="cvv" placeholder="123">
          </div>
        </div>
      </div>

      <button type="submit" class="btn-pay">Pagar</button>
    </form>
  </div>
</div>


<style>
/* Modal */
.modal {
  display: none;
  position: fixed;
  z-index: 10;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background: rgba(0,0,0,0.6);
  justify-content: center;
  align-items: center;
}

.modal-content {
  background: #fff;
  border-radius: 12px;
  padding: 25px;
  width: 350px;
  max-width: 90%;
  box-shadow: 0 5px 20px rgba(0,0,0,0.2);
  animation: fadeIn 0.3s ease-in-out;
}

.modal-content h2 {
  margin-bottom: 15px;
  font-size: 20px;
  font-weight: bold;
  text-align: center;
}

.close {
  float: right;
  font-size: 22px;
  cursor: pointer;
  color: #c00;
}

/* Form */
.form-group {
  display: flex;
  flex-direction: column;
  margin-bottom: 15px;
}

.form-row {
  display: flex;
  gap: 10px;
}

.form-group label {
  font-size: 14px;
  margin-bottom: 5px;
}

.form-group input,
.form-group select {
  padding: 10px;
  border-radius: 8px;
  border: 1px solid #ccc;
  font-size: 14px;
  width: 100%;
  box-sizing: border-box;
}

.btn-pay {
  width: 100%;
  padding: 12px;
  border: none;
  border-radius: 8px;
  background: #d32f2f;
  color: white;
  font-weight: bold;
  font-size: 16px;
  cursor: pointer;
  transition: 0.2s;
}

.btn-pay:hover {
  background: #b71c1c;
}

/* Animação */
@keyframes fadeIn {
  from { opacity: 0; transform: scale(0.9); }
  to { opacity: 1; transform: scale(1); }
}

</style>

<script>

document.addEventListener("DOMContentLoaded", function() {
  const modal = document.getElementById("paymentModal");
  const btnFinalizar = document.getElementById("btnFinalizar");
  const spanClose = document.querySelector(".close");
  const paymentMethod = document.getElementById("paymentMethod");
  const cardFields = document.getElementById("cardFields");

  // Abrir modal ao clicar em Finalizar Compra
  btnFinalizar.addEventListener("click", function(e) {
    e.preventDefault();
    modal.style.display = "flex";
  });

  // Fechar modal ao clicar no X
  spanClose.addEventListener("click", function() {
    modal.style.display = "none";
  });

  // Fechar modal ao clicar fora
  window.addEventListener("click", function(event) {
    if (event.target === modal) {
      modal.style.display = "none";
    }
  });

  // Mostrar/esconder campos do cartão
  paymentMethod.addEventListener("change", function() {
    if (this.value === "pix") {
      cardFields.style.display = "none";
    } else {
      cardFields.style.display = "block";
    }
  });

  // Exemplo: mensagem de sucesso fictícia
  document.getElementById("paymentForm").addEventListener("submit", function(e) {
    e.preventDefault();
    alert("Pagamento realizado com sucesso!");
    modal.style.display = "none";
  });
});
</script>




