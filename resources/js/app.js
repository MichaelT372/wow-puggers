try {
  window.Popper = require('popper.js').default;
  global.$ = global.jQuery = require('jquery');
  require('bootstrap');
} catch (e) {}
window.axios = require('axios');
window.Vue = require('vue');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

const app = new Vue({
    el: '#app',
});
