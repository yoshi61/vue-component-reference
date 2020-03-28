<template>
    <div>
        <v-snackbar
                v-model="snackbar_data.snack"

                :top="y === 'top'"
                :bottom="y === 'bottom'"
                :left="x === 'left'"
                :right="x === 'right'"

                :multi-line="mode === 'multi-line'"

                :timeout="4000"
                :color="snackbar_data.snackColor"
        >
            <p class="ma-0" v-html="snackbar_data.snackText"></p>
            <v-btn text @click="snackbar_data.snack = false">Close</v-btn>
        </v-snackbar>
    </div>
</template>
<script>
    import { mapGetters } from 'vuex'

    export default {

        // TODO snack queue

        name: "Snackbar",

        data: () => ({
            y: 'bottom',
            x: 'right',
            mode: 'multi-line',
        }),

        computed: {
            ...mapGetters({
                snackbar_data: 'snackbar/getSnackbarData'
            })
        }
    }
</script>

<style scoped>
</style>
