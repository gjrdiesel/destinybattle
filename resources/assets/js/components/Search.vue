<template>
    <div class="panel panel-default stats-panel">
        <div class="panel-body">

            <h5 class="search-for" v-if="gamertag.length == 0">Enter your gamertag</h5>
            <h5 class="search-for" v-if="gamertag.length > 0">Searching for: &nbsp;<b>{{ gamertag }}</b></h5>

                <input type="text" name="gamertag" class="form-control search-for-input" value="" title="" required="required"
                       v-model="gamertag" debounce="500">

                <div class="radio">
                    <label class="search-for-label">
                        <input type="radio" value="1" checked="checked" v-model="console">
                        Xbox
                    </label>
                </div>
                <div class="radio">
                    <label class="search-for-label">
                        <input type="radio" value="2" v-model="console">
                        Playstation
                    </label>
                </div>

            <!-- loop through all your charcters, and display the character card here -->
            <div v-for="character in output.display.characters" class="character-container">
                <character-card :character="character"></character-card>
            </div>

            <!-- Display your Crucible (PVP) stats here -->
            <div class="crucible-container">
                <crucible :stats="output.pvpstats"></crucible>
            </div>

        </div>
    </div>
</template>

<style>

    .stats-panel {
        -webkit-border-radius: 0;
        -moz-border-radius: 0;
        border-radius: 0;
        border-color: transparent;
        box-shadow: none;
    }

    .search-for {
        margin: 0;
        padding-bottom: 10px;
    }

    .search-for-label {
        font-size: 14px;
    }

    .search-for-input {
        -webkit-border-radius: 0;
        -moz-border-radius: 0;
        border-radius: 0;
        box-shadow: none;
        font-weight: bold;
    }

    .character-container {
        margin-bottom: 5px;
    }

    .crucible-container {
        padding-top: 15px;;
    }

</style>


<script>
    import CharacterCard from "./CharacterCard.vue";
    import Crucible from "./Crucible.vue";
    export default {
        props: ['name'],
        ready(){
            this.gamertag = this.name;
        },
        watch: {
            gamertag(){
                this.searchForPlayerByName()
            },
            console(){
                this.searchForPlayerByName()
            }
        },
        methods: {
          searchForPlayerByName(){
              this.$http.get('/destinybattle/public/api/search/' + this.console + '/' + this.gamertag)
                      .then(function (result)
                      {
                          this.output = result.data;
                      })
          }
        },
        data(){
            return {
                gamertag: '',
                console: 0,
                output: '',
                name: '',
            };
        },
        components: {
            CharacterCard, Crucible
        }
    }
</script>