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
                            <v-card-title>Sign up</v-card-title>

                            <v-divider></v-divider>

                            <v-card-text>
                                <v-form
                                        ref="form"
                                        v-model="valid"
                                        lazy-validation
                                >
                                    <v-row>
                                        <v-col cols="12" sm="12">
                                            <v-text-field
                                                prepend-icon="person"
                                                label="Username"
                                                v-model="username"
                                                :rules="[
                                                    rules.required,
                                                    () => this.username && this.username.length <= 20 || 'Max 20 characters'
                                                ]"
                                            ></v-text-field>
                                        </v-col>

                                        <v-col cols="12" sm="12">
                                            <v-text-field
                                                prepend-icon="lock"
                                                label="Password"
                                                v-model="passwordInput"
                                                :append-icon="showPassword ? 'visibility' : 'visibility_off'"
                                                :rules="[
                                                    () => !!this.passwordInput || 'Required.',
                                                    () => this.passwordInput && this.passwordInput.length >= 7 || 'Min 7 characters'
                                                ]"
                                                :type="showPassword ? 'text' : 'password'"
                                                name="input-10-2"
                                                @click:append="showPassword = !showPassword"
                                                autocomplete="new-password"
                                            ></v-text-field>
                                        </v-col>

                                        <v-col cols="12" sm="12">
                                            <v-text-field
                                                prepend-icon="lock"
                                                label="Confirm Password"
                                                v-model="passwordConfirm"
                                                :append-icon="showPassword ? 'visibility' : 'visibility_off'"
                                                :rules="[
                                                    () => !!this.passwordConfirm || 'Required.',
                                                    () => this.passwordConfirm && this.passwordConfirm.length >= 7 || 'Min 7 characters',
                                                    this.passwordInput !== this.passwordConfirm ? 'Password must match' : true
                                                ]"
                                                :type="showPassword ? 'text' : 'password'"
                                                name="input-10-2"
                                                @click:append="showPassword = !showPassword"
                                                autocomplete="new-password"
                                            ></v-text-field>
                                        </v-col>

                                        <v-col cols="12" sm="2">
                                            <v-autocomplete
                                                ref="title"
                                                v-model="title"
                                                :rules="[() => !!title || 'This field is required']"
                                                :items="titles"
                                                label="Title"
                                                placeholder="Select..."
                                                required
                                            ></v-autocomplete>
                                        </v-col>
                                        <v-col cols="12" sm="5">
                                            <v-text-field
                                                label="First Name"
                                                v-model="first_name"
                                                :rules="[rules.required]"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="5">
                                            <v-text-field
                                                label="Last Name"
                                                v-model="last_name"
                                                :rules="[rules.required]"
                                            ></v-text-field>
                                        </v-col>

                                        <v-col cols="12" sm="6">
                                            <v-text-field
                                                label="Email"
                                                v-model="email"
                                                :rules="[rules.required, rules.email]"
                                            ></v-text-field>
                                        </v-col>

                                        <v-col cols="12" sm="6">
                                            <v-text-field
                                                label="Mobile"
                                                v-model="mobile"
                                                :rules="[rules.required, rules.phone]"
                                            ></v-text-field>
                                        </v-col>

                                    </v-row>
                                </v-form>
                            </v-card-text>
                            <v-divider></v-divider>
                            <v-card-actions>
                                    <router-link to="login">
                                        <v-btn text>Cancel</v-btn>
                                    </router-link>
                                <div class="flex-grow-1"></div>
                                <v-btn
                                    :disabled="!valid"
                                    color="primary"
                                    text
                                    @click="register"
                                >
                                    Submit
                                </v-btn>
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

        data: () => ({
            titles: ['Mr', 'Miss', 'Mrs', 'Ms', 'Dr', 'Prof'],
            username        : null,
            title           : null,
            first_name      : null,
            last_name       : null,
            email           : null,
            mobile          : null,
            showPassword    : false,
            passwordInput   : '',
            passwordConfirm : '',

            valid: true,
            errorMessages: '',
            formHasErrors: false,

            rules: {
                required: v => !!v || 'Required.',
                // min: v => v && v.length >= 7 || 'Min 8 characters',
                email: value => {
                    const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                    return pattern.test(value) || 'Invalid e-mail.'
                },
                phone: value => {
                    const pattern = /^\D?(\d*)$/
                    return pattern.test(value) || 'Invalid phone number.'
                },
            },
        }),

        computed: {
            userCredentials: function () {
                return {
                    username: this.username,
                    email: this.email,
                    password: this.passwordInput,
                    title: this.title,
                    first_name: this.first_name,
                    last_name: this.last_name,
                    mobile: this.mobile,
                };
            }
        },

        methods: {
            register() {
                // If passed front-end validation
                if (this.$refs.form.validate()) {
                    // Send to register API
                    this.$store.dispatch('users/register', this.userCredentials)
                        .then(response => {
                            console.log({
                                response
                            });
                            // Redirect  back to login page
                            // all other error (including connection error)
                            this.$store.dispatch('snackbar/showSnackSuccess', "Account created!");
                            this.$router.push({ name: 'login' })
                        })
                        .catch( error => {
                            if(error.response && error.response.status == '422'){
                                // validation error
                                this.$store.dispatch('snackbar/showSnackError', error.response.data.error);
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

    a{
        text-decoration: none;
    }
</style>