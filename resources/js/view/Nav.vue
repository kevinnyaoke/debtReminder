<template>
<div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
        <div class="sidebar-heading">Debt Payment Reminder </div>
        <div class="list-group list-group-flush">

            <router-link class="list-group-item list-group-item-action bg-light" :to="{name:'/home'}">Dashboard</router-link>
            <router-link class="list-group-item list-group-item-action bg-light" :to="{name:'addclient'}">Add Clients</router-link>
            <router-link class="list-group-item list-group-item-action bg-light" :to="{name:'viewclients'}">Registered Clients</router-link>
            <!-- <a href="#" class="list-group-item list-group-item-action bg-light">Overview</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">Events</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">Profile</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">Status</a> -->
        </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <button class="btn btn-primary " id="menu-toggle">Menu</button>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <!-- <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li> -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="name" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
{{ name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Profile</a>
                            <a class="dropdown-item" href="#" v-on:click="logout()">Logout</a>
                            <router-link class="dropdown-item" :to="{name:'changepass'}">Change password</router-link>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container-fluid">
            <router-view></router-view>
        </div>
    </div>
    <!-- /#page-content-wrapper -->

</div>
</template>

<script>
export default {
    data() {
        return {
         name:'',
        }
    },
    created(){
        this.name=localStorage.getItem("name");
    },
    methods: {
        logout() {
                localStorage.removeItem('token');
                 this.$router.push({name: "login" });
        },

    },
    // mounted() {

    //     const token = 'Bearer  ' + localStorage.getItem('token');
    //     let uri = 'api/auth/user';
    //     axios.get(uri, {
    //         headers: {
    //             Authorization: token
    //         }
    //     }).then(response => {
    //         $('#name').text(response.data.name);

    //     })
    // }
}
</script>

<style>

</style>
