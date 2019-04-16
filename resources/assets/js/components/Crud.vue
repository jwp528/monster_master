<template>
    <div class="crud d-block d-md-flex">
        <div class="col-md-6 col-sm-12">
            <p><b>HP</b> {{currentHp}}/{{hp}}</p>
            <div class="progress mb-3">
              <div :class="['progress-bar', 'bg-'+healthStatus]" role="progressbar" :style="{width: hpPercent+'%'}" :aria-valuenow="hpPercent" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <img class="mb-3" :src="image"/>
            <p>Stats:</p>
            <b>Atk: {{atk}}</b> | <b>Def: {{def}}</b>
        </div>
        <div class="col-md-6 col-sm-12">
            <h3>Name: {{ name | properCase }}</h3>
            <p>Quote:</p>
            <blockquote>{{description}}</blockquote>
            <select class="form-control mb-3" @change="update">
                <option
                        v-for="col in [ 'red', 'blue', 'green' ]"
                        :value="col"
                        :key="col"
                        :selected="col === color ? 'selected' : ''"
                >{{ col | properCase }}</option>

            </select>
            <button class="btn btn-success mb-5" @click="activate" v-show="!isActive">Make Active</button>
            <button class="btn btn-warning mb-5" @click="attack" v-show="!isActive && this.$parent.activeCrud !== ''">Attack!</button>
            <button class="btn btn-success mb-5" @click="heal" v-show="isActive && this.currentHp < this.hp">Heal</button>
            <button class="btn btn-danger mb-5" @click="del">Delete</button>
        </div>
    </div>
</template>
<script>
  export default {
    computed: {
      image() {
        return `/images/${this.color}.png`;
      },

      hpPercent(){
        return (this.currentHp / this.hp) * 100;
      },

      healthStatus(){
        if(this.hpPercent > 50)
          return 'success';

        if(this.hpPercent <=50 && this.hpPercent > 15)
          return 'warning';

        if(this.hpPercent <= 15)
          return 'danger';
      },//end healthStatus

      isActive(){
        let pd = this.$parent.activeCrud;
        if(pd === "")
          return false;

        return pd === this.id;
      },
    },
    // watch:{
    //   isActive(){

    //   },//end isActive
    // },
    methods: {
      update(val) {
        this.$emit('update', this.id, val.target.selectedOptions[0].value, this.currentHp);
      },
      del() {
        this.$emit('delete', this.id);
      },
      attack(){
          this.$emit("attack", this.id);
      },
      activate(){
        this.$emit("setActive", this.id);
      },
      heal(){
        //completely heals the current monster(must be the active monster)
        this.$emit("update", this.id, this.color, this.hp);
      },//end heal
    },
    props: ['id', 'color', 'name', 'description', 'hp', 'currentHp', 'atk', 'def'],
    filters: {
      properCase(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
      }
    }
  }
</script>
<style>
    .crud {
        display: flex;
        margin: 1em 1em 1em 0;
        border: 1px solid #d1d1d1;
        padding: 1em;
        background-color: white;
    }

    .crud img {
        height: 140px;
    }

    .col-2 {
        margin-left: 1em;
    }

    .col-2 > h3 {
        margin: 0.5em 0;
    }
</style>
