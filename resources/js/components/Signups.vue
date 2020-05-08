<template>
  <div class="signups-layout">
    <div class="row">
      <div class="col-12">
        <ul class="list-inline">
          <li class="list-inline-item">
            Tanks: {{ signupsByRole.tanks.length }}
          </li>
          <li class="list-inline-item">
            Healers: {{ signupsByRole.healers.length }}
          </li>
          <li class="list-inline-item">
            Melee DPS: {{ signupsByRole.meleeDps.length }}
          </li>
          <li class="list-inline-item">
            Ranged DPS: {{ signupsByRole.rangedDps.length }}
          </li>
          <li class="list-inline-item" v-if="raid.location === 'Molten Core'">
            Douses {{ douses.length }}
          </li>
        </ul>
      </div>
    </div>

    <div class="row">
      <div class="col-3 mb-2">
        <players-list
          title="Warriors"
          :title-color="colors.warrior"
          title-icon="warrior"
          :players="warriors"
          :show-douse="douse"
        />
      </div>
      <div class="col-3 mb-2">
        <players-list
          title="Rogues"
          :title-color="colors.rogue"
          title-icon="rogue"
          :players="rogues"
          :show-douse="douse"
        />
      </div>
      <div class="col-3 mb-2">
        <players-list
          title="Mages"
          :title-color="colors.mage"
          title-icon="mage"
          :players="mages"
          :show-douse="douse"
        />
      </div>
      <div class="col-md-3 mb-2">
        <players-list
          title="Hunters"
          :title-color="colors.hunter"
          title-icon="hunter"
          :players="hunters"
          :show-douse="douse"
        />
      </div>
    </div>

    <div class="row">
      <div class="col-3 mb-2">
        <players-list
          title="Warlocks"
          :title-color="colors.warlock"
          title-icon="warlock"
          :players="warlocks"
          :show-douse="douse"
        />
      </div>
      <div class="col-3 mb-2">
        <players-list
          title="Druids"
          :title-color="colors.druid"
          title-icon="druid"
          :players="druids"
          :show-douse="douse"
        />
      </div>
      <div class="col-3 mb-2">
        <players-list
          title="Priests"
          :title-color="colors.priest"
          title-icon="priest"
          :players="priests"
          :show-douse="douse"
        />
      </div>
      <div class="col-md-3 mb-2" v-if="raid.faction === 'Alliance'">
        <players-list
          title="Paladins"
          :title-color="colors.paladin"
          title-icon="paladin"
          :players="paladins"
          :show-douse="douse"
        />
      </div>
      <div class="col-md-3 mb-2" v-if="raid.faction === 'Horde'">
        <players-list
          title="Shamans"
          :title-color="colors.shaman"
          title-icon="shaman"
          :players="shamans"
          :show-douse="douse"
        />
      </div>
    </div>
  </div>
</template>

<script>
  import { mapState, mapGetters } from 'vuex'
  import PlayersList from "./PlayersList";

  export default {
    name: "Signups",
    components: { PlayersList },
    computed: {
      ...mapState({
        raid: 'raid',
        signups: 'signups',
        colors: 'colors'
      }),
      ...mapGetters({
        signupsByClass: 'signupsByClass',
        signupsByRole: 'signupsByRole',
        douses: 'douses'
      }),
      warriors() {
        return this.signupsByClass.Warrior || [];
      },
      rogues() {
        return this.signupsByClass.Rogue || [];
      },
      mages() {
        return this.signupsByClass.Mage || [];
      },
      hunters() {
        return this.signupsByClass.Hunter || [];
      },
      warlocks() {
        return this.signupsByClass.Warlock || [];
      },
      druids() {
        return this.signupsByClass.Druid || [];
      },
      priests() {
        return this.signupsByClass.Priest || [];
      },
      paladins() {
        return this.signupsByClass.Paladin || [];
      },
      shamans() {
        return this.signupsByClass.Shaman || [];
      },
      douse() {
        return this.raid.location === 'Molten Core';
      }
    },
  }
</script>

<style scoped>

</style>
