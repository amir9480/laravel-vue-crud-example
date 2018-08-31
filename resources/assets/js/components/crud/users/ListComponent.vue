<template>
    <card-component title="Users List">
        <router-link :to="{ name:'admin.users.create' }" type="button" class="btn btn-success">Create</router-link>
        <br><br>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created at</th>
                        <th>Last update</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="users === null">
                        <td colspan="6">
                            <h2>Loading...</h2>
                        </td>
                    </tr>
                    <tr v-else-if="users.data.length > 0" v-for="user in users.data">
                        <td>{{ user.id }}</td>
                        <td>{{ user.name }}</td>
                        <td>{{ user.email }}</td>
                        <td>{{ user.created_at }}</td>
                        <td>{{ user.last_update }}</td>
                        <td>
                            <router-link type="button" class="btn btn-success btn-circle" :to="{name:'admin.users.show', params:{user_id:user.id}}"><i class="fa fa-eye"></i></router-link>
                            <router-link type="button" class="btn btn-warning btn-circle" :to="{name:'admin.users.edit', params:{user_id:user.id}}"><i class="fa fa-cut"></i></router-link>
                            <button type="button" class="btn btn-danger btn-circle" @click.prevent="deleteUser(user)"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr v-else>
                        <td colspan="6">
                            <h3>No Users Exists</h3>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <ul v-if="users != null" class="pagination">
            <li v-for="page in users.last_page" :class="{active : users.current_page == page}"><router-link :to="{ name:'admin.users.index', query: { page } }">{{ page }}</router-link></li>
        </ul>
    </card-component>
</template>

<script>
    export default {
        data() {
            return {
                users: null
            }
        },
        mounted() {
            document.title = "CRUD Example - Users";
            this.loadUsers();
        },
        watch: {
            '$route.query'(newValue, oldValue) {
                this.loadUsers();
            }
        },
        methods: {
            loadUsers() {
                var self = this;
                this.users = null;
                axios.get("/admin/users?page="+(this.$route.query.page ? this.$route.query.page : 1))
                .then(function(res){
                    self.users = res.data;
                })
                .catch(function(error) {
                    alert("OOPS... something went wrong!");
                });
            },
            deleteUser(user) {
                if(confirm("Are you sure you want delete user '"+user.name+"'?")) {
                    var self = this;
                    axios.delete("/admin/users/"+user.id).then(function(res){
                        alert("The user deleted successfully!");
                    })
                    .catch(function(error) {
                        alert("OOPS... something went wrong!");
                    }).then(function(){
                        self.loadUsers();
                    });
                }
            }
        },
    }
</script>
