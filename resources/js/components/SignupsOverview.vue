<template>
  <div>
    <div>
      <div class="totals">
        <span style="margin-right: 15px;">Confirmed: {{ confirmedSignups.length }}</span>
        <span>Signups: {{ signups.length }}</span>
      </div>
    </div>
    <div class="signups-overview">
      <div class="signup-overview__item">
        <div class="icon">
          <wow-icon type="tank" :size="35"/>
        </div>
        <div class="signup-overview__counts">
          <span>Confirmed: {{ confirmedTanks.length }}</span>
          <span>Signups: {{ signupsByRole.tanks.length }}</span>
        </div>
      </div>
      <div class="signup-overview__item">
        <div class="icon">
          <wow-icon type="healer" :size="35"/>
        </div>
        <div class="signup-overview__counts">
          <span>Confirmed: {{ confirmedHealers.length }}</span>
          <span>Signups: {{ signupsByRole.healers.length }}</span>
        </div>
      </div>
      <div class="signup-overview__item">
        <div class="icon">
          <wow-icon type="melee" :size="35"/>
        </div>
        <div class="signup-overview__counts">
          <span>Confirmed: {{ confirmedMelee.length }}</span>
          <span>Signups: {{ signupsByRole.meleeDps.length }}</span>
        </div>
      </div>
      <div class="signup-overview__item">
        <div class="icon">
          <wow-icon type="ranged" :size="35"/>
        </div>
        <div class="signup-overview__counts">
          <span>Confirmed: {{ confirmedRanged.length }}</span>
          <span>Signups: {{ signupsByRole.rangedDps.length }}</span>
        </div>
      </div>
      <div class="signup-overview__item" v-if="raid.location === 'Molten Core'">
        <div class="icon">
          <wow-icon type="aqual-quintessence" :size="30"/>
        </div>
        <div class="signup-overview__counts">
          <span>Confirmed: {{ confirmedDouses.length }}</span>
          <span>Signups: {{ douses.length }}</span>
        </div>
      </div>
  </div>

  </div>
</template>

<script>
  import { mapGetters, mapState } from 'vuex';
  import WowIcon from "./WowIcon";

  export default {
    name: "SignupsOverview",
    components: {WowIcon},
    computed: {
      ...mapState({
        raid: 'raid',
        signups: 'signups'
      }),
      ...mapGetters({
        signupsByRole: 'signupsByRole',
        douses: 'douses'
      }),
      confirmedSignups() {
        return this.signups.filter(s => s.confirmed);
      },
      confirmedTanks() {
        return this.signupsByRole.tanks.filter(s => s.confirmed);
      },
      confirmedHealers() {
        return this.signupsByRole.healers.filter(s => s.confirmed);
      },
      confirmedMelee() {
        return this.signupsByRole.meleeDps.filter(s => s.confirmed);
      },
      confirmedRanged() {
        return this.signupsByRole.rangedDps.filter(s => s.confirmed);
      },
      confirmedDouses() {
        return this.douses.filter(s => s.confirmed);
      }
    }
  }
</script>

<style lang="scss" scoped>
  .signups-overview {
    display: flex;
    flex-flow: row wrap;
    margin: 0 -5px;
  }

  .signup-overview__item {
    background-color: rgba(0, 0, 0, 0.3);
    border: 1px solid rgba(0, 0, 0, 0.6);
    border-radius: 4px;
    padding: 5px 10px;
    margin: 5px;
    display: flex;
    align-items: center;
  }

  .totals {
    margin-bottom: 10px;
    font-weight: 600;
    font-size: 20px;
  }

  .icon {
    margin-right: 7px;
  }

  .signup-overview__counts {
    display: flex;
    flex-direction: column;
  }
</style>
