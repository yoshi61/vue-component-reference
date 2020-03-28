<template>
    <v-app>
        <v-navigation-drawer
            v-if="loggedIn"
            v-model="drawer"
            app
        >
            <v-list dense>
                <v-list-item @click="">
                    <v-list-item-action>
                        <v-icon>home</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>Home</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item @click="">
                    <v-list-item-action>
                        <v-icon>contact_mail</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>Contact</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>

        <v-content>
            <v-container
                fluid
                fill-height
            >
                <v-layout
                    align-center
                    justify-center
                >
                    <v-flex text-xs-center>
                        <router-view></router-view>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-content>
        <snackbar></snackbar>
    </v-app>
</template>

<script>
    import snackbar from './Snackbar';

    export default {
        name: "Master",

        components: {
            snackbar,
        },

        data: () => ({
            drawer: null
        }),

        computed: {
            loggedIn() {
                return this.$store.getters['users/loggedIn']
            }
        }
    }
</script>

<style scoped>

</style>
