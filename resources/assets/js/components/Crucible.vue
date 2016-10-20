<template>
    <div>
        <h2>Crucible Stats</h2>
        <ul>
            <li>Kills: {{ stats.kills.basic.displayValue }}</li>
            <li>Deaths: {{ stats.deaths.basic.displayValue }}</li>
            <li>Kill/Death Ratio: {{ stats.killsDeathsRatio.basic.displayValue }}%</li>
        </ul>
    </div>
</template>
<style>
</style>
<script>
    export default{
        props: ['stats'],
        data(){
            return{}
        }
    }
</script>
