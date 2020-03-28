<template>
    <v-navigation-drawer
            v-model="drawer"
            app
            class="secondary"
    >
        <div class="text-center primary">
            <v-icon size="50">account_circle</v-icon>

            <v-list-item
                class="primary white--text"
            >
                <v-list-item-content class="text-center">
                    <v-list-item-title class="title white--text">
                        {{ userInfo.name }}
                    </v-list-item-title>
                    <v-list-item-subtitle class="white--text">
                        {{ userInfo.email }}
                    </v-list-item-subtitle>
                </v-list-item-content>
            </v-list-item>
        </div>

        <v-divider></v-divider>

        <v-list
                dense
                nav
        >
            <v-list-item
                    v-for="item in items"
                    :key="item.title"
                    link
            >
                <v-list-item-icon>
                    <v-icon color="white">{{ item.icon }}</v-icon>
                </v-list-item-icon>

                <v-list-item-content>
                    <v-list-item-title class="white--text">{{ item.title }}</v-list-item-title>
                </v-list-item-content>
            </v-list-item>
        </v-list>

        <template v-slot:append>
            <v-list-item @click="">
                <v-list-item-action>
                    <v-icon class="white--text">help</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                    <v-list-item-title class="white--text">Help</v-list-item-title>
                </v-list-item-content>
            </v-list-item>
            <v-list-item @click="">
                <v-list-item-action>
                    <v-icon class="white--text">logout</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                    <v-list-item-title class="white--text">Logout</v-list-item-title>
                </v-list-item-content>
            </v-list-item>
        </template>
    </v-navigation-drawer>
</template>

<script>
    export default {
        name: "LeftNavigationDrawer",
        data: () => ({
            drawer: null,
            userInfo: {
                name: 'Hideki Yoshinaga',
                email: 'hyoshinaga@forerunner.com.au'
            },
            items: [
                {title: 'Dashboard', icon: 'dashboard', link: ''},
                {title: 'My Applications', icon: 'inbox', link: ''},
                {title: 'My Account', icon: 'account_box', link: ''},
            ],
            right: null,
        }),

    }
</script>

<style scoped>

</style>