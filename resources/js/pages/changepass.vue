<template>
<div>
    <h1>Change Password</h1>
    <form @submit.prevent="changepass">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Enter old password:</label>
                    <input type="password" class="form-control" v-model="info.oldpass">
                </div>
            </div>
        </div>
                <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Enter new password:</label>
                    <input type="password" class="form-control" v-model="info.newpass">
                </div>
            </div>
        </div>
                <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Confirm new password:</label>
                    <input type="password" class="form-control" v-model="info.c_newpass">
                </div>
            </div>
        </div>

        <br />
        <div class="form-group">
            <button class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
</template>

<script>
export default {
    data() {
        return {
            info: {}
        }
    },
 methods: {
        changepass() {
             const token = 'Bearer  ' + localStorage.getItem('token');
            let uri = 'api/auth/changepass';
            this.axios.post(uri, { headers: { Authorization: token } }, this.info).then((response) => {
                if (response.data.status) {
                   this.$notify({group: 'foo',text: response.data.message,type:'success',title: 'Success!'})
                    this.$router.push({name: 'viewuser'});
                }
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
