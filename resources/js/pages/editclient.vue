// Edit

<template>
<div>
    Example
<div class="row">
  <div class="col-sm-2"></div>
  <div class="col-sm-8">
       <h1>Edit Client</h1>
    <form @submit.prevent="updateClient">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Name:</label>
                    <input type="text" class="form-control" v-model="info.name">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Idno:</label>
                    <input type="text" class="form-control" v-model="info.idno">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Email:</label>
                    <input type="text" class="form-control" v-model="info.email">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" class="form-control" v-model="info.phone">
                </div>
            </div>
        </div>
         <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Amount</label>
                    <input type="text" class="form-control" v-model="info.balance">
                </div>
            </div>
        </div>
        <br />
        <div class="form-group">
            <button class="btn btn-primary">Update</button>
        </div>
    </form>
  </div>
  <div class="col-sm-2"></div>
</div>

</div>
</template>

<script>
     export default {

      data() {
        return {
          info: {}
        }
      },
      created() {
           const token = 'Bearer  ' + localStorage.getItem('token');
        let uri = `api/auth/client/edit/${this.$route.params.id}`;
        this.axios.get(uri,  { headers: { Authorization: token } }).then((response) => {

            this.info = response.data.client;
            // console.log(response.data.student);

        }).catch(error=>{
                if (error.response.status === 401) {
                this.$router.push({name: 'login'});
                clearSession();
                }else{
                this.$notify({group: 'foo', text:'We are not able to complete your request', type:'error', title: 'Error'});
                }
        });

      },
      methods: {
        updateClient() {
             const token = 'Bearer  ' + localStorage.getItem('token');
          let uri = `api/auth/client/update/${this.$route.params.id}`;
          this.axios.put(uri, this.info,  { headers: { Authorization: token } }).then((response) => {
                this.$notify({group: 'foo',text: response.data.message,type:'success',title: 'Success!'})
                this.$router.push({name:'viewclients'});
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
