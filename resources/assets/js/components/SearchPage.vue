
<template>
    <div>
        <!--<div class="col-md-12 text-center">-->
            <!--<h1>VS</h1><br />-->
            <!--&lt;!&ndash;<div class="btn btn-danger" @click="changePage('fight-page')">&ndash;&gt;-->
                <!--&lt;!&ndash;Fight!&ndash;&gt;-->
            <!--&lt;!&ndash;</div>&ndash;&gt;-->
        <!--</div>-->
        <div class="col-md-12 no-padding stats-container">
            <div class="col-md-6">
                <search name="itz"></search>
            </div>
            <div class="col-md-6">
                <search name="monzterxlv"></search>
            </div>
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