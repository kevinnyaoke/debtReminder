<template>
<div class="container"><br><br><br><br><br><br>

     <div class="row">
  <div class="col-sm-2"></div>
  <div class="col-sm-8">
          <h1>Enter your phone number to get reset code</h1>
    <form @submit.prevent="reset">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Phone:</label>
                    <input type="text" class="form-control" v-model="info.phone">
                </div>
            </div>
        </div>

        <br />
        <div class="form-group">
            <button class="btn btn-primary submitbtn">Submit</button>
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
 methods: {
        reset() {
         loadbutton();
            let uri = 'api/auth/resetpass';
            this.axios.post(uri, this.info).then((response) => {
                if (response.data.status) {
                   this.$notify({group: 'foo',text: response.data.message,type:'success',title: 'Success!'})
                   stopbutton();
                }
            }).catch(error=>{
          this.$notify({group: 'foo', text:'We are not able to complete your request', type:'error', title: 'Error'});
          stopbutton();

        });
        }
    }


}
</script>
