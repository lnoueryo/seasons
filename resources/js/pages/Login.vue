<template>
    <div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Login</div>

                        <div class="card-body">
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" required autocomplete="email" autofocus v-model="auth.email">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password" v-model="auth.password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button class="btn btn-primary" @click="login">
                                        Login
                                    </button>
                                    <button class="btn btn-primary" @click="logout">
                                        Logout
                                    </button>
                                    <button class="btn btn-primary" @click="check">
                                        check
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            auth: {email: null, password: null}
        }
    },
    methods: {
        login(){
            this.$store.dispatch('login', this.auth)
        },
        logout(){
            axios.post('/logout').then(response => {
                this.$store.dispatch('logout');
            })
        },
        check(){
            axios.get('/api/check').then(response => {
                console.log(response)
            })
        },
    }
}
</script>