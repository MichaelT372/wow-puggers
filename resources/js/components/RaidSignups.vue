<template>
  <div class="raid-signups">

    <div class="btn-group pb-4" role="group">
      <button type="button" class="btn btn-primary" @click="view = 'signups'">
        Signups
      </button>
      <button type="button" class="btn btn-primary" @click="view = 'soft_reserves'">
        Soft reserves
      </button>
    </div>

    <div class="signups-layout" v-if="view === 'signups'">
      <div class="row">
        <div class="col-12">
          <ul class="list-inline">
            <li class="list-inline-item">Tanks {{ tanks.length }}</li>
            <li class="list-inline-item">Healers {{ healers.length }}</li>
            <li class="list-inline-item">Melee DPS {{ meleeDps.length }}</li>
            <li class="list-inline-item">Ranged DPS {{ rangedDps.length }}</li>
            <li class="list-inline-item" v-if="location === 'Molten Core'">Douses {{ douses.length }}</li>
          </ul>
        </div>
      </div>

      <div class="row">
        <div class="col-3">
          <signup-class-list-header
            type="warrior"
            :count="warriors.length"
          />

          <signup-class-list
            type="warrior"
            :players="warriors"
            :location="location"
          />
        </div>

        <div class="col-3">
          <signup-class-list-header
            type="rogue"
            :count="rogues.length"
          />

          <signup-class-list
            type="rogue"
            :players="rogues"
            :location="location"
          />
        </div>

        <div class="col-3">
          <signup-class-list-header
            type="mage"
            :count="mages.length"
          />

          <signup-class-list
            type="mage"
            :players="mages"
            :location="location"
          />
        </div>

        <div class="col-md-3">
          <signup-class-list-header
            type="hunter"
            :count="hunters.length"
          />

          <signup-class-list
            type="hunter"
            :players="hunters"
            :location="location"
          />
        </div>
      </div>

      <div class="row">
        <div class="col-3">
          <signup-class-list-header
            type="warlock"
            :count="warlocks.length"
          />

          <signup-class-list
            type="warlock"
            :players="warlocks"
            :location="location"
          />
        </div>

        <div class="col-3">
          <signup-class-list-header
            type="druid"
            :count="druids.length"
          />

          <signup-class-list
            type="druid"
            :players="druids"
            :location="location"
          />
        </div>

        <div class="col-3">
          <signup-class-list-header
            type="priest"
            :count="priests.length"
          />

          <signup-class-list
            type="priest"
            :players="priests"
            :location="location"
          />
        </div>

        <div class="col-md-3" v-if="faction === 'Alliance'">
          <signup-class-list-header
            type="paladin"
            :count="paladins.length"
          />

          <signup-class-list
            type="paladin"
            :players="paladins"
            :location="location"
          />
        </div>

        <div class="col-md-3" v-if="faction === 'Horde'">
          <signup-class-list-header
            type="shaman"
            :count="shamans.length"
          />

          <signup-class-list
            type="shaman"
            :players="shamans"
            :location="location"
          />
        </div>
      </div>
    </div>

    <div class="soft-reserves-layout" v-if="view === 'soft_reserves'">
      <div class="row">
        <div class="col-md-3" v-for="(players, item) in softReserves">
          <h6><b>{{ item }}</b></h6>
          <ul class="list-unstyled">
            <signup-class-list
              :players="players"
              :location="location"
              :class-icon="true"
            />
          </ul>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
  import SignupClassList from "./SignupClassList";
  import WowIcon from "./WowIcon";
  import SignupClassListHeader from "./SignupClassListHeader";

  export default {
    name: "RaidSignups",
    components: {SignupClassListHeader, SignupClassList, WowIcon},

    props: {
      allSignups: {
        required: true,
        type: Array
      },
      faction: {
        required: true,
        type: String
      },
      location: {
        required: true,
        type: String
      }
    },

    data() {
      return {
        view: 'signups',
        tankSpecs: ['Protection', 'Feral (Tank)'],
        healerSpecs: ['Holy', 'Restoration', 'Discipline'],
        meleeDpsSpecs: ['Arms', 'Fury', 'Enhancement', 'Retribution', 'Assassination', 'Combat', 'Subtlety', 'Feral (DPS)'],
        rangedDpsSpecs: ['Arcane', 'Fire', 'Frost', 'Survival', 'Beast Mastery', 'Marksmanship', 'Affliction', 'Demonology', 'Destruction', 'Shadow', 'Balance']
      }
    },

    computed: {
      signups() {
        return this.allSignups.filter(s => {
          return this.faction === 'Horde' ? s.class !== 'Paladin' : s.class !== 'Shaman';
        }).sort((a, b) => b.confirmed - a.confirmed);
      },
      warriors() {
        return this.signups.filter(s => s.class === 'Warrior')
      },
      paladins() {
        return this.signups.filter(s => s.class === 'Paladin');
      },
      shamans() {
        return this.signups.filter(s => s.class === 'Shaman');
      },
      mages() {
        return this.signups.filter(s => s.class === 'Mage');
      },
      rogues() {
        return this.signups.filter(s => s.class === 'Rogue');
      },
      hunters() {
        return this.signups.filter(s => s.class === 'Hunter');
      },
      warlocks() {
        return this.signups.filter(s => s.class === 'Warlock');
      },
      druids() {
        return this.signups.filter(s => s.class === 'Druid');
      },
      priests() {
        return this.signups.filter(s => s.class === 'Priest');
      },
      tanks() {
        return this.signups.filter(s => this.tankSpecs.includes(s.spec));
      },
      healers() {
        return this.signups.filter(s => this.healerSpecs.includes(s.spec));
      },
      meleeDps() {
        return this.signups.filter(s => this.meleeDpsSpecs.includes(s.spec))
      },
      rangedDps() {
        return this.signups.filter(s => this.rangedDpsSpecs.includes(s.spec))
      },
      dps() {
        return [
          ...this.meleeDps,
          ...this.rangedDps
        ]
      },
      softReserves() {
        let softReserves = {};

        this.signups.forEach(s => {
          if (!softReserves[s.soft_reserve]) {
            softReserves[s.soft_reserve] = [];
          }

          softReserves[s.soft_reserve].push(s);
        });

        return softReserves;
      },
      douses() {
        return this.signups.filter(s => s.douse);
      }
    },
  }
</script>

<style scoped>

</style>
