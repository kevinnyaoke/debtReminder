// IndexComponent.vue

<template>
<div>
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
         <h1>Registered Clients</h1>
    <div class="row">
        <div class="col-md-10"></div>
    </div><br />

    <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Balance</th>

            </tr>
        </thead>
        <tbody>
            <tr v-for="(user,index) in data" :key="user.id">
                <td>{{ index+1 }}</td>
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td>{{ user.phone }}</td>
                <td>{{ user.balance }}</td>

                <td>
                    <router-link :to="{name: 'editclient', params: { id: user.id }}" class="btn btn-primary">Edit</router-link>
                </td>
                <td><button class="btn btn-danger" @click.prevent="deleteclient(user.id)">Delete</button></td>
                <td><button class="btn btn-success" @click.prevent="sms(user.id)">Send Reminder</button></td>

            </tr>
        </tbody>
    </table>
    </div>
    <div class="col-sm-2"></div>

</div>
</template>

<script>
export default {
    data() {
        return {
            data: []
        }
    },
    created() {
        this.loaddata();
    },
    methods: {
        deleteclient(id) {
            const token = 'Bearer  ' + localStorage.getItem('token');
            let uri = `api/auth/client/delete/${id}`;
            this.axios.delete(uri,  { headers: { Authorization: token } }).then(response => {
                this.data.splice(this.data, 1);
                 this.$notify({group: 'foo',text: response.data.message,type:'success',title: 'Success!'})
               this.loaddata();
            });
        },
        sms(id){
            const token = 'Bearer  ' + localStorage.getItem('token');
           let uri =`api/auth/remind/${id}`;
              this.axios.get(uri, { headers: { Authorization: token } }).then(response => {

             this.$notify({group: 'foo',text: response.data.message,type:'success',title: 'Success!'})

            });
        },
        loaddata(){
             const token = 'Bearer  ' + localStorage.getItem('token');
        let uri = 'api/auth/allclients';
        this.axios.get(uri,  { headers: { Authorization: token } }).then(response => {
            this.data = response.data.list;

        }).catch(error=>{
         if (error.response.status === 401) {
         this.$router.push({name: 'login'});
        clearSession();
        }else{
        this.$notify({group: 'foo', text:'We are not able to complete your request', type:'error', title: 'Error'});
         }
        });
        }
    }
}
</script>
