<template>
    <div>
        <div class="col-md-4 col-md-offset-1">
            <search name="itz hydrogen 1"></search>
        </div>
        <div class="col-md-2 text-center">
            <h1>VS</h1>
            <div class="btn btn-danger form-control" @click="changePage('fight-page')">
                Fight!
            </div>
        </div>
        <div class="col-md-4">
            <search name="monzterxlv"></search>
        </div>
    </div>
</template>
<style>
</style>
<script>
    export default{
        methods: {
          changePage(page){
              app.currentView = page;
          }
        },
        data(){
            return {}
        }
    }
</script>