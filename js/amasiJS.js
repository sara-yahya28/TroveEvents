      function addToCart(name, price) {
        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        cart.push({ name, price });
        let dateAdded = new Date().toLocaleString(); // حفظ الوقت والتاريخ
        cart.push({ name, price, dateAdded });
        localStorage.setItem("cart", JSON.stringify(cart));
        alert("تمت إضافة حجزك  !");
      }