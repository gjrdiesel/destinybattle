<template>
    <div class="character-box" :style="{ 'background-image': 'url(' + getEmblemBg() + ')' }">
        <div class="row">
            <div class="col-sm-3 col-md-3">
                <img v-bind:src="getEmblem()">
            </div>
            <div class="col-sm-4 col-md-4">
                <h3 class="character-class-name">{{ getClass() }}</h3>
                <h6 class="character-race-gender">{{ getRaceAndGender() }}</h6>
            </div>
            <div class="col-sm-5 col-md-5">
                <h3 class="character-card-level">{{ character.characterLevel }}</h3><br />
                <h4 class="character-card-light-level"><span class="diamond"></span>{{ character.characterBase.powerLevel }}</h4>
            </div>
        </div>
    </div>
</template>

<style>
    .character-box {
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
    .character-class-name {
        font-weight: bold;
    }

    .character-race-gender {
        font-weight: bolder;
    }

    .character-card-level {
        margin-right: 10%;
        padding-bottom: 5px;
        float: right;
    }

    .character-card-light-level {
        margin-right: -15%;
        color: yellow;
        float: right;
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