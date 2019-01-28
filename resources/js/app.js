
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#root',

    data: {
        showResults: false,
        showError: false,
        quoteSuccessful: '',
        loading: false,
        input: {
            customerName: {
                firstName: '',
                lastName: '',
            },
            companyNumber: '',
        },
        results: {},
    },

    methods: {
        getResults(e) {
            const { customerName, companyNumber} = this.input;

            this.loading = true
            this.showResults = false

            window.axios.post('/api/quote', {customerName, companyNumber})
            .then(res => {
                if(res.data.success){
                   return swal("Quote Successful", "Congratulations!", "success");
                }

                return swal("Quote Unsuccessful", "We won't be able to offer you insurance at this time", "warning")
            })
            .catch(err => {
                console.log(err);
                swal("Oops" , "Something went wrong" ,  "error");
            })

            e.preventDefault();

            this.loading = false
        },
    },
})

