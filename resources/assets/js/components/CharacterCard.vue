<template>
    <div id="card" :style="{ 'background-image': 'url(' + getEmblemBg() + ')' }">
        <div class="row">
            <div class="col-md-3">
                <img v-bind:src="getEmblem()">
            </div>
            <div class="col-md-3">
                <h4>{{ getClass() }}</h4>
                <h6>{{ getRaceAndGender() }}</h6>
            </div>
            <div class="col-md-3 col-md-offset-3">
                <h3>{{ character.characterLevel }}</h3>
                <div><span class="diamond"></span>{{ character.characterBase.powerLevel }}</div>
            </div>
        </div>
    </div>
</template>
<style>
    #card {
        background: black;
        color: white;
        background-size: cover;
        width: 100%;
    }
    .diamond {
        color: yellow;
        font-size: 12px;
    }
    .diamond:before {
        content: '♦ ';
    }
    h3 {
        margin: 0;
        margin-top: 10px;
    }
</style>
<script>
    export default {
        props: ['character'],
        methods: {
            getEmblem(){
                return 'http://www.bungie.net/' + this.character.emblemPath;
            },
            getEmblemBg(){
                return 'http://www.bungie.net/' + this.character.backgroundPath;
            },
            getClass(){
                var classHashes = {
                    3655393761: 'Titan',
                    671679327: 'Hunter',
                    2271682572: 'Warlock'
                };
                return classHashes[this.character.characterBase.classHash];
            },
            getRaceAndGender(){
                //character.characterBase.raceHash
                //character.characterBase.genderHash
                var genders = {
                    3111576190: 'Male',
                    2204441813: 'Female'
                };
                var races = {
                    898834093: 'Exo',
                    3887404748: 'Human',
                    2803282938: 'Awoken'
                };

                return races[this.character.characterBase.raceHash] + ' ' + genders[this.character.characterBase.genderHash];
            }
        }
    }
</script>