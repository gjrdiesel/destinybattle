<template>
    <div class="panel panel-default">
        <div class="panel-body">

            <h2 style="margin:0" v-if="gamertag.length == 0">Enter your gamertag</h2>
            <h4 style="margin:0" v-if="gamertag.length > 0">Searching for "{{ gamertag }}"</h4>

                <input type="text" name="gamertag" class="form-control" value="" title="" required="required"
                       v-model="gamertag" debounce="500">

                <div class="radio">
                    <label>
                        <input type="radio" value="1" checked="checked" v-model="console">
                        Xbox
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" value="2" v-model="console">
                        Playstation
                    </label>
                </div>

            <div v-for="character in output.display.characters">
                <character-card :character="character"></character-card>
            </div>

            <crucible :stats="output.pvpstats"></crucible>
        </div>
    </div>
</template>

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
              this.$http.get('/api/search/' + this.console + '/' + this.gamertag)
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