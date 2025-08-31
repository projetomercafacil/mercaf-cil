document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("cartModal");
    const closeBtn = document.querySelector(".close");

    // abrir modal
    document.querySelectorAll(".open-cart").forEach(btn => {
        btn.addEventListener("click", function () {
            fetchCart();
            modal.style.display = "flex";
        });
    });

    // fechar modal
    closeBtn.onclick = () => modal.style.display = "none";
    window.onclick = (e) => { if (e.target === modal) modal.style.display = "none"; };

    // carregar itens do carrinho via AJAX
    function fetchCart() {
        fetch(BASE_URL + "/router.php?page=cart&ajax=1")
            .then(res => res.json())
            .then(data => {
                let html = "";
                let total = 0;
                data.items.forEach(item => {
                    total += item.subtotal;
                    html += `
                        <div class="cart-item">
                            <strong>${item.name}</strong> - R$ ${item.price.toFixed(2)} x ${item.quantity} 
                            = R$ ${item.subtotal.toFixed(2)}
                            <a href="#" class="remove" data-id="${item.id}">❌</a>
                        </div>`;
                });
                document.getElementById("cartItems").innerHTML = html || "<p>Carrinho vazio.</p>";
                document.getElementById("cartTotal").textContent = total.toFixed(2);

                // remover item
                document.querySelectorAll(".remove").forEach(btn => {
                    btn.addEventListener("click", function (e) {
                        e.preventDefault();
                        removeFromCart(this.dataset.id);
                    });
                });
            });
    }

    // remover produto
    function removeFromCart(id) {
        fetch(BASE_URL + "/router.php?page=remove_from_cart&id=" + id + "&ajax=1")
            .then(() => fetchCart());
    }

    // adicionar produto
    document.querySelectorAll(".add-to-cart").forEach(btn => {
        btn.addEventListener("click", function () {
            const id = this.dataset.id;
            fetch(BASE_URL + "/router.php?page=add_to_cart&id=" + id + "&ajax=1")
                .then(() => {
                    fetchCart();
                    alert("✅ Item adicionado ao carrinho!");
                });
        });
    });
});
