// Load fonts
import '@fortawesome/fontawesome-free/css/all.css'
import '@mdi/font/css/materialdesignicons.css'

// load vuetify
window.Vuetify = require('vuetify');

// default styles
import 'vuetify/dist/vuetify.min.css'

// set custom options (colors and icons)
import colors from 'vuetify/es5/util/colors';
window.Opts = {
    theme: {
        themes: {
            light: {
                primary: '#b01c1c',
                primaryLight: colors.green.lighten2,
                accent: colors.purple.base,
                error: colors.red.base,
                errorLight: colors.red.lighten2,
                info: colors.lightBlue.base,
                secondary: '#4a5967',
                success: colors.lightGreen.base,
                warning: colors.amber.base,
                inner: colors.grey.lighten2,
            },
            dark: {
                primary: colors.green.base,
                primaryLight: colors.green.lighten2,
                accent: colors.purple.base,
                error: colors.red.base,
                errorLight: colors.red.lighten2,
                info: colors.lightBlue.base,
                secondary: colors.indigo.base,
                success: colors.lightGreen.base,
                warning: colors.amber.base,
                inner: colors.grey.lighten2,
            }
        },
    },
    icons: {
        iconfont: 'mdi', //'md' // || 'mdi' || 'fa' || 'fa4'
        values: {
            // font-awesome
            'font-awesome' : 'fas fa-copyright',

            // material-icons
            'copyright' : 'pin_drop',

            /** USAGE //////////////////////////////////////////////////////////////////

            <v-icon v-text="'$vuetify.icons.font-awesome'"></v-icon>
            <v-icon>$vuetify.icons.copyright</v-icon>
            <v-icon>copyright</v-icon>

            */
        },
    }
}

// tell vue to use vuetify
Vue.use(Vuetify);

// Apply styling
//import 'vuetify/src/stylus/app.styl';

// Custom styling
import '../css/app.css';

