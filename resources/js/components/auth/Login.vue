<template>
        <v-app>
            <v-content>
                <v-container fluid fill-height>
                    <v-layout align-center justify-center>
                        <v-flex xs12 sm8 md4>
                            <div class="logo">
                                <v-img
                                        src="/images/industry-leaders-logo.png"
                                        contain
                                        max-height="100"
                                ></v-img>
                            </div>

                            <v-card class="elevation-12">
                                <v-toolbar
                                        color="primary"
                                        height="10 px"
                                >
                                </v-toolbar>
                                <v-card-title>Login</v-card-title>
                                <v-divider></v-divider>
                                <v-card-text>
                                    <v-form
                                            ref="form"
                                            v-model="valid"
                                            lazy-validation
                                    >
                                        <v-text-field
                                                prepend-icon="person"
                                                name="username"
                                                label="Username"
                                                type="text"
                                                v-model="credentials.username"
                                                required
                                                :rules="nameRules"
                                                @keyup.enter="login"
                                        ></v-text-field>
                                        <v-text-field
                                                prepend-icon="lock"
                                                name="password"
                                                label="Password"
                                                type="password"
                                                v-model="credentials.password"
                                                required
                                                :rules="passwordRules"
                                                @keyup.enter="login"
                                        ></v-text-field>
                                    </v-form>
                                </v-card-text>
                                <v-card-actions>
                                    <v-checkbox v-model="remember_me" label="Remember me"></v-checkbox>
                                    <div class="flex-grow-1"></div>
                                    <v-btn
                                            color="primary"
                                            @click="login"
                                            :loading="loading"
                                            :disabled="loading || !valid"
                                    >
                                        Login
                                    </v-btn>
                                </v-card-actions>
                                <v-card-actions>
                                    <a><u>Forgot your password?</u></a>
                                    <div class="flex-grow-1"></div>
                                    <span>Don't have an account?</span>
                                    <router-link to="register">Sign Up</router-link>
                                </v-card-actions>
                            </v-card>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-content>
        </v-app>
</template>

<script>

    export default {
        name: 'login',
        data () {
            return {
                credentials: {
                    username: null,
                    password: null,
                },
                remember_me: true,

                loading: false,

                valid: true,
                nameRules: [
                    v => !!v || 'Username is required',
                ],
                passwordRules: [
                    v => !!v || 'Password is required',
                ],
            }
        },

        methods: {
            // Handles login through API
            login() {
                // If passed front-end validation
                if (this.$refs.form.validate()) {
                    this.loading = true;

                    this.$store.dispatch('users/retrieveToken', {
                        username: this.credentials.username,
                        password: this.credentials.password,
                    })
                        .then(response => {
                            console.log(response.data);
                            this.$router.push({ name: 'dashboard' })
                        })
                        .catch( error =>{
                            this.loading = false;

                            if(error.response && error.response.status == '422'){
                                // validation error
                                this.$store.dispatch('snackbar/showSnackError', error.response.data.error);
                            }
                            else if(error.response && error.response.status == '401'){
                                // validation error
                                this.$store.dispatch('snackbar/showSnackError', error.response.data);
                            }
                            else{
                                // all other error (including connection error)
                                this.$store.dispatch('snackbar/showSnackError', "Something went wrong, please try again later.");
                            }
                        });
                }

            }
        }
    }
</script>

<style scoped>
    .logo{
        margin-bottom: 10px;
    }
</style>
