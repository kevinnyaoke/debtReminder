<template>
  <div class="container">
      <br><br><br>
  <center>
          <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h1 class="text-center login-title">Sign in</h1>
            <div class="account-wall">
                <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                    alt="">
                <form class="form-signin">
                <input type="text" class="form-control" placeholder="Email" required autofocus v-model="info.email"><br>
                <input type="password" class="form-control" placeholder="Password" required v-model="info.password"><br><br>
                <button  class="btn btn-lg btn-primary btn-block submitbtn" type="submit" @click.prevent="login">
                    Sign in</button>
                <label class="checkbox pull-left">
                    <input type="checkbox" value="remember-me">
                    Remember me
                </label>
                <!-- <a class="pull-right need-help" >Forgot password</a><span class="clearfix"></span> -->
                <router-link class="pull-right need-help" :to="{name:'resetpass'}">Forgot password</router-link>


                </form>
            </div>
            <!-- <a href="#" class="text-center new-account">Create an account </a> -->

        </div>
    </div>
  </center>
</div>
</template>

<script>
export default {
    data(){
         return{
             info:{}
         }
    }, methods: {
        login() {
            loadbutton();
            let uri = "api/auth/login";
            this.axios.post(uri, this.info).then(response => {
                stopbutton();
                    if (response.data.status) {
                        localStorage.setItem("token", response.data.access_token);
                           localStorage.setItem("name", response.data.user.name);
                              localStorage.setItem("email", response.data.user.email);
                              this.$notify({group: 'foo',text: response.data.message,type:'success',title: 'Success!'})
                         this.$router.push({name: "home" });
                    } else {
                       this.$notify({group: 'foo',text: response.data.message,type:'error',title: 'eroor'})
                    }
                }).catch(error => {
                       stopbutton();
                    // alert("Incorrect username or password");
                });
        }
    }
}
</script>

<style>

</style>
