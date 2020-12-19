import Vue from 'vue';
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
import '@mdi/font/css/materialdesignicons.css';

Vue.use(Vuetify)



export default new Vuetify({
    theme: {
        themes: {
            light: {
                primary: "07506e",
                // secondary: "07506e",
                secondary: "171b34",
                accent: "3D87E4"
            }
        }
    }
});