<template>
    <card-component :title="pageTitle">
        <router-link :to="{ name:'admin.users.index' }" type="button" class="btn btn-primary">Back</router-link>
        <router-link v-if="$route.params && $route.name == 'admin.users.show'" :to="{ name:'admin.users.edit', params:{user_id: $route.params.user_id} }" type="button" class="btn btn-warning">Edit</router-link>
        <br><br>
        <div v-for="formError in formErrors" class="alert alert-danger">
            {{ formError }}
        </div>
        <div v-for="formMessage in formMessages" class="alert alert-success">
            {{ formMessage }}
        </div>
        <form role="form">
            <div class="form-group">
                <label>Name</label>
                <input type="text" v-model="user.name" :readonly="$route.name == 'admin.users.show'" class="form-control">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" v-model="user.email" :readonly="$route.name == 'admin.users.show'" class="form-control">
            </div>
            <div class="form-group" :hidden="$route.name == 'admin.users.show'">
                <label>Password</label>
                <input type="password" v-model="user.password" :readonly="$route.name == 'admin.users.show'" class="form-control">
                <p class="help-block" v-if="$route.name == 'admin.users.edit'">Keep empty to prevent changing password</p>
            </div>
            <div class="form-group" v-if="$route.name == 'admin.users.show'">
                <label>Created at</label>
                <input type="email" v-model="user.created_at" disabled="disabled" class="form-control">
            </div>
            <div class="form-group" v-if="$route.name == 'admin.users.show'">
                <label>Last update</label>
                <input type="email" v-model="user.last_update" disabled="disabled" class="form-control">
            </div>
            <button v-if="$route.name != 'admin.users.show'" type="button" class="btn btn-default" @click.prevent="submit" :disabled="loading">Submit</button>
        </form>
    </card-component>
</template>

<script>
    export default {
        data() {
            return {
                user: {
                    name: "",
                    email: "",
                    password: "",
                    created_at: "",
                    last_update: ""
                },
                pageTitle: "Create user",
                formErrors: {},
                formMessages: [],
                loading: true
            }
        },
        mounted() {
            if(this.$route.name == "admin.users.edit") {
                this.pageTitle = "Edit user";
                this.load();
            } else if(this.$route.name == "admin.users.show") {
                this.pageTitle = "Show user";
                this.load();
            } else {
                this.loading= false;
            }
            document.title = "CRUD Example - "+this.pageTitle;
        },
        methods: {
            load() {
                var self = this;
                axios.get("/admin/users/"+ this.$route.params.user_id)
                .then(function(res){
                    self.user = res.data;
                    self.loading = false;
                })
                .catch(function(error){
                    alert("OOPS... something went wrong!");
                });
            },
            submit() {
                var self = this;
                this.loading = true;
                this.formErrors = {};
                var errorHandler = function(error){
                    if(error.response && error.response.status == 422) {
                        var formErrors = {};
                        for(var i in error.response.data.errors)
                            formErrors[i] = error.response.data.errors[i][0];
                        self.formErrors = formErrors;
                    } else {
                        alert("OOPS... something went wrong!");
                    }
                    self.loading = false;
                };
                if(this.$route.name == "admin.users.create") {
                    axios.post("/admin/users", this.user)
                    .then(function(res){
                        self.formMessages = ["New user added successfully."];
                        setTimeout(function(){
                            self.$router.push({name: "admin.users.index"});
                        }, 2000);
                    })
                    .catch(errorHandler);
                } else if(this.$route.name == "admin.users.edit") {
                    axios.put("/admin/users/"+this.$route.params.user_id, this.user)
                    .then(function(res){
                        self.formMessages = ["The user updated successfully."];
                        setTimeout(function(){
                            self.$router.push({name: "admin.users.index"});
                        }, 2000);
                    })
                    .catch(errorHandler);
                }

            }
        },
    }
</script>
