<template>
<div>
<notifications position="top center" group="foo" />
        <Nav v-if="!$route.meta.hideNavigation"></Nav>
        <NoNav v-if="$route.meta.hideNavigation"></NoNav >


</div>
</template>

<script>
import Nav from '../view/Nav'
import NoNav from '../view/noNav'

export default {
    name:'App',
    components:{
        Nav,NoNav
    },

}
</script>

<style>

</style>
