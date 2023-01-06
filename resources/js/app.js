import 'flowbite';
import omitBy from 'lodash/omitBy';
import isEmpty from 'lodash/isEmpty';


let jsFilterForm = document.getElementById('js-filter-form');
jsFilterForm.addEventListener('submit', function (e) {
    e.preventDefault();
    let formData = new FormData(e.target);
    let data = [...formData.entries()];

    let query = [];
    data.forEach(element => {
        if (element[1] !== '') {
            query.push(element);
        }
    });

    const asString = new URLSearchParams(query).toString();
    window.location.search = asString;
});

// import './bootstrap';

// import Alpine from 'alpinejs';

// window.Alpine = Alpine;

// Alpine.start();
