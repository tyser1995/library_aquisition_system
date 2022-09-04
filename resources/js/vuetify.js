import Vue from "vue";
import Vuetify from "vuetify";

Vue.use(Vuetify);
export default new Vuetify({
    // icons: {
    //     // iconfont: 'mdiSvg', // 'mdi' || 'mdiSvg' || 'md' || 'fa' || 'fa4' || 'faSvg'
    //     // iconfont: 'md',
    //     // iconfont: 'fa',
    //     iconfont: "mdi", // default
    //     values: {
    //         product: "mdi-dropbox",
    //         support: "mdi-lifebuoy",
    //         steam: "mdi-steam-box",
    //         pc: "mdi-desktop-classic",
    //         xbox: "mdi-xbox",
    //         playstation: "mdi-playstation",
    //         switch: "mdi-nintendo-switch",
    //     },
    // },
    theme: {
        dark: false,
        light: true,
        root: false,
        default: "light",
        disable: false,
        themes: {
            light: {
                primary: "#1976D2",
                secondary: "#424242",
                accent: "#82B1FF",
                error: "#FF5252",
                info: "#2196F3",
                success: "#4CAF50",
                warning: "#FB8C00",
            },
            dark: {
                primary: "#2196F3",
                secondary: "#424242",
                accent: "#FF4081",
                error: "#FF5252",
                info: "#2196F3",
                success: "#4CAF50",
                warning: "#FB8C00",
            },
        },
    },
});
