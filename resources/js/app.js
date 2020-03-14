require('./bootstrap'); //import main library

require('bulma'); //import Bulma for CSS framework

window.Vue = require('vue'); //import Vue for JS framework

import home from './components/Home.vue'; //import & define

const app = new Vue({
	components: {
		home //register
	}
}).$mount('#app');
