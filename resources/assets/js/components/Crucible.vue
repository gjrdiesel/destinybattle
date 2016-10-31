<template>
    <div>
        <h4>Crucible Summary</h4>

        <ul class="list-group">
            <li class="list-group-item crucible-list-group">
                <h5 class="crucible-result">{{ stats.kills.basic.displayValue }}</h5>
                <h5>Kills</h5>
            </li>
            <li class="list-group-item crucible-list-group">
                <h5 class="crucible-result">{{ stats.deaths.basic.displayValue }}</h5>
                <h5>Deaths</h5>
            </li>
            <li class="list-group-item crucible-list-group">
                <h5 class="crucible-result">{{ stats.killsDeathsRatio.basic.displayValue }}%</h5>
                <h5>K/D Ratio</h5>
            </li>
            <li class="list-group-item crucible-list-group">
                <h5 class="crucible-result">{{ stats.assists.basic.displayValue }}</h5>
                <h5>Assists</h5>
            </li>
            <li class="list-group-item crucible-list-group">
                <h5 class="crucible-result">{{ stats.winLossRatio.basic.displayValue }}%</h5>
                <h5>Win/Loss Ratio</h5>
            </li>
        </ul>
    </div>
</template>


<style>

    .list-group-item > .crucible-result {
        float: right;
    }

    .crucible-list-group {
        padding: 2px 15px !important;
    }

</style>


<script>
    export default{
        props: ['stats'],
        data(){
            return{}
        }
    }
</script>
