<template>
    <div class="modal is-active">
        <div class="modal-background" @click="$emit('close')"></div>
        <div class="modal-card login-modal-content">
            <section class="modal-card-body">
                <div class="container is-light">
                    <div class="columns">
                        <div class="column">
                            <p class="control">
                                <div class="notification is-light">
                                    <h1 class="title">Welcome to Booknshelf 👋</h1>
                                    <h2 class="subtitle">Log in to save books and create bookshelves.</h2>
                                </div>
                            </p>
                            <p class="control">
                                <a class="button is-large goodreads-button" :href="goodreadsAuth">
                                    <span class="icon">
                                        <i class="icon-light"><span style="font-family:helvetica;">g</span></i>
                                    </span>
                                    <span><strong>Login with Goodreads</strong></span>
                                </a>
                            </p>
                            <p class="control">
                                <a class="button is-large fb-button" :href="facebookAuth">
                                 <span class="icon">
                                   <i class="fa fa-facebook"></i>
                                 </span>
                                    <span><strong>Continue with Facebook</strong></span>
                                </a>
                            </p>
                            <p class="control">
                                <a class="button is-large twt-button" :href="twitterAuth">
                                     <span class="icon">
                                       <i class="fa fa-twitter"></i>
                                     </span>
                                    <span><strong>Continue with Twitter</strong></span>
                                </a>
                            </p>
                            <p class="subtitle">
                                We'll never post to Twitter or Facebook without your permission.
                            </p>
                            <form  v-on:submit.prevent>
                                <label class="label bigger-font-label">What's your name?</label>
                                <p class="control">
                                    <input class="input is-large" type="text" name="name"
                                           v-model="form.name" placeholder="e.g. Jon Snow"
                                           :class="{'is-danger': form.errors.has('name')}"
                                    >
                                    <span class="help is-danger" v-show="form.errors.has('name')">
                                        {{ form.errors.get('name') }}
                                    </span>
                                </p>

                                <label class="label bigger-font-label">Choose an easy remembered username</label>
                                <p class="control">
                                    <input class="input is-large" type="text" name="username"
                                           v-model="form.username" placeholder="e.g. I chose 'tigran' which is my name"
                                           :class="{'is-danger': form.errors.has('username')}"
                                    >
                                    <span class="help is-danger" v-show="form.errors.has('username')">
                                        {{ form.errors.get('username') }}
                                    </span>
                                </p>

                                <label class="label bigger-font-label">Choose a strong password</label>
                                <p class="control">
                                    <input class="input is-large" type="password" name="password"
                                           v-model="form.password" placeholder="at least 6 characters"
                                           :class="{'is-danger': form.errors.has('password')}"
                                    >
                                    <span class="help is-danger" v-show="form.errors.has('password')">
                                        {{ form.errors.get('password') }}
                                    </span>
                                </p>

                                <div class="control">
                                    <p class="control">
                                        <button type="submit"
                                                class="button is-large is-primary is-outlined full-width-button"
                                                @click.prevent="register"
                                                :disabled="form.busy">
                                            <strong>JOIN</strong>
                                        </button>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </section>
        </div>
        <button class="modal-close" @click="$emit('close')"></button>
    </div>
</template>

<style lang="css">
</style>

<script>
    export default {
        props: ['show'],

        data() {
            return {
                plaseLoginModal: false,
                form: new AppForm({
                    name: '',
                    username: '',
                    password: '',
                })
            }
        },

        methods: {
            register() {
                App.post('/register', this.form)
                    .then(response => {
                        console.log(response);
                        window.location = '/welcome';
                    });
            },

            close: function () {
                this.form.errors.forget();
                this.form.name = '';
                this.form.username = '';
                this.form.password = '';
            },
        },

        computed: {
            facebookAuth: function() {
                return '/auth/facebook';
            },
            twitterAuth: function() {
                return '/auth/twitter'
            },
            goodreadsAuth: function() {
                return '/auth/goodreads'
            }
        }
    }
</script>

<style lang="css">

</style>
