<template>
  <div id="app">
    <div class="col-12 mx-auto">
      <div class="heading">
        <h1>
          Cruds
          <button class="btn btn-primary" @click="create()">Add</button>
        </h1>
      </div>
      <crud-component
        v-for="crud in cruds"
        v-bind="crud"
        :key="crud.id"
        @update="update"
        @delete="del"
        @setActive="setActive"
        @attack="attack"
      ></crud-component>
    </div>
  </div>
</template>
<script>
function Crud({ id, color, name, description, hp, currentHp, atk, def }) {
  this.id = id;
  this.color = color;
  this.name = name;
  this.description = description;
  this.hp = hp;
  this.currentHp = currentHp;
  this.atk = atk;
  this.def = def;
} //end Crud

import CrudComponent from "./Crud.vue";

export default {
  data() {
    return {
      cruds: [],
      activeCrud: "",
      mute: false
    };
  },
  methods: {
    create() {
      this.mute = true;
      window.axios.get("/api/cruds/create").then(({ data }) => {
        this.cruds.push(new Crud(data));
        this.mute = false;
      });
    },
    read() {
      this.mute = true;
      window.axios.get("/api/cruds").then(({ data }) => {
        data.forEach(crud => {
          this.cruds.push(new Crud(crud));
        });
        this.mute = false;
      });
    },
    update(id, color, hp) {
      this.mute = true;
      window.axios.put(`/api/cruds/${id}`, { color, hp }).then(() => {
        this.cruds.find(crud => crud.id === id).color = color;
        this.cruds.find(crud => crud.id === id).currentHp = hp;
        this.mute = false;
      });
    },
    del(id, newactive = "") {
      this.mute = true;

      window.axios.delete(`/api/cruds/${id}`).then(() => {
        let index = this.cruds.findIndex(crud => crud.id === id);
        this.cruds.splice(index, 1);

        if (this.activeCrud === id) this.setActive(newactive);

        this.mute = false;
      }); //end axios call
    }, //end del
    setActive(id) {
      console.log(`crud ${id} is being set to active`);
      this.activeCrud = id;
    }, //end setActive
    attack(target) {
      //the attacking crud goes first
      //damage is calculated with the following formula
      //damage = (target defense / active crud attack) * active crud attack
      let defender = this.cruds.filter(crud => {
        return crud.id === target;
      }); //end defender assign
      defender = defender[0];

      let attacker = this.cruds.filter(crud => {
        return crud.id === this.activeCrud;
      }); //end attacker assign
      attacker = attacker[0];

      //attack the defending crud
      let damage = Math.ceil((attacker.atk / defender.def) * attacker.atk);

      if (defender.currentHp - damage <= 0) {
        defender.currentHp = 0;
        this.del(defender.id);
        this.update(attacker.id, attacker.color, attacker.currentHp);
      } else defender.currentHp -= damage;

      //the defending crud gets a counter attack
      damage = Math.ceil((defender.atk / attacker.def) * defender.atk);

      if (attacker.currentHp - damage <= 0) {
        attacker.currentHp = 0;
        this.del(attacker.id, defender.id);
        this.update(defender.id, defender.color, defender.currentHp);
      } else attacker.currentHp -= damage;

      for (var i = 0; i < this.cruds.length; ++i) {
        if (this.cruds[i].id === target) this.cruds[i] = defender;

        if (this.cruds[i].id == this.activeCrud) this.cruds[i] = attacker;
      } //end for
    } //end attack
  },
  watch: {
    mute(val) {
      document.getElementById("mute").className = val ? "on" : "";
    }
  },
  components: {
    CrudComponent
  },
  created() {
    this.read();
  }
};
</script>
<style>
#app {
  margin-left: 1em;
}

.heading h1 {
  margin-bottom: 0;
}
</style>
