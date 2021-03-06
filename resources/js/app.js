import { createApp } from 'vue';

import App from './App.vue';
import router from './routers/router.js'
import store from './store'

const app = createApp(App);
app.use(router);
app.use(store);

router.isReady().then(() => app.mount('#app'))



