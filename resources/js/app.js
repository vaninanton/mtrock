import "flowbite";
import { createApp } from 'vue'
import Cart from './components/Cart.vue'

let jsFilterForm = document.querySelector("#js-filter-form");
if (jsFilterForm) {
    jsFilterForm.addEventListener("submit", function (e) {
        e.preventDefault();
        let formData = new FormData(e.target);
        let data = [...formData.entries()];

        let query = [];
        data.forEach((element) => {
            if (element[1] !== "") {
                query.push(element);
            }
        });

        const asString = new URLSearchParams(query).toString();
        window.location.search = asString;
    });
}

createApp(Cart).mount("#cart")

// import './bootstrap';

// import Alpine from 'alpinejs';

// window.Alpine = Alpine;

// Alpine.start();
