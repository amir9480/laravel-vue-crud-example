// Vue routes
export default [
    { path: '/admin', component: require("./components/DashboardComponent.vue"), name: 'admin.dashboard'},
    { path: '/admin/users', component: require("./components/crud/users/ListComponent.vue"), name: 'admin.users.index'},
    { path: '/admin/users/create', component: require("./components/crud/users/FormComponent.vue"), name: 'admin.users.create'},
    { path: '/admin/users/:user_id', component: require("./components/crud/users/FormComponent.vue"), name: 'admin.users.show', props: true},
    { path: '/admin/users/:user_id/edit', component: require("./components/crud/users/FormComponent.vue"), name: 'admin.users.edit', props: true}
];

