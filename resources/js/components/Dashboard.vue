<template>
    <v-app>
        <left-navigation-drawer></left-navigation-drawer>

        <!-- Sizes your content based upon application components -->
        <v-content>

            <!-- Provides the application the proper gutter -->
            <v-container fluid
                fill-height
            >
                XXXX
            </v-container>
        </v-content>
    </v-app>
</template>

<script>
    import leftNavigationDrawer from './layouts/LeftNavigationDrawer';

    export default {
        name:'dashboard',
        components: {
            leftNavigationDrawer,
        },

        data: () => ({
            drawer: null
        }),

    }
</script>
