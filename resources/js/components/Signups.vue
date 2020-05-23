<template>
  <div class="signups-layout">
    <div class="raid-overview">
      <signups-overview></signups-overview>
    </div>

    <div class="row">
      <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
        <players-list
          title="Warriors"
          :title-color="colors.warrior"
          title-icon="warrior"
          :players="signupsByClass.Warrior"
          :show-douse="douse"
        />
      </div>
      <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
        <players-list
          title="Rogues"
          :title-color="colors.rogue"
          title-icon="rogue"
          :players="signupsByClass.Rogue"
          :show-douse="douse"
        />
      </div>
      <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
        <players-list
          title="Mages"
          :title-color="colors.mage"
          title-icon="mage"
          :players="signupsByClass.Mage"
          :show-douse="douse"
        />
      </div>
      <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
        <players-list
          title="Hunters"
          :title-color="colors.hunter"
          title-icon="hunter"
          :players="signupsByClass.Hunter"
          :show-douse="douse"
        />
      </div>
    </div>

    <div class="row">
      <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
        <players-list
          title="Warlocks"
          :title-color="colors.warlock"
          title-icon="warlock"
          :players="signupsByClass.Warlock"
          :show-douse="douse"
        />
      </div>
      <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
        <players-list
          title="Druids"
          :title-color="colors.druid"
          title-icon="druid"
          :players="signupsByClass.Druid"
          :show-douse="douse"
        />
      </div>
      <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
        <players-list
          title="Priests"
          :title-color="colors.priest"
          title-icon="priest"
          :players="signupsByClass.Priest"
          :show-douse="douse"
        />
      </div>
      <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4" v-if="raid.faction === 'Alliance'">
        <players-list
          title="Paladins"
          :title-color="colors.paladin"
          title-icon="paladin"
          :players="signupsByClass.Paladin"
          :show-douse="douse"
        />
      </div>
      <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4" v-if="raid.faction === 'Horde'">
        <players-list
          title="Shamans"
          :title-color="colors.shaman"
          title-icon="shaman"
          :players="signupsByClass.Shaman"
          :show-douse="douse"
        />
      </div>
    </div>
  </div>
</template>

<script>
  import { mapState, mapGetters } from 'vuex'
  import PlayersList from "./PlayersList";
  import SignupsOverview from "./SignupsOverview";

  export default {
    name: "Signups",
    components: {SignupsOverview, PlayersList},
    computed: {
      ...mapState({
        raid: 'raid',
        colors: 'colors'
      }),
      ...mapGetters({
        signupsByClass: 'signupsByClass'
      }),
      douse() {
        return this.raid.location === 'Molten Core';
      }
    },
  }
</script>

<style lang="scss" scoped>
 .raid-overview {
   display: flex;
   //justify-content: center;
   margin: 0 0 20px;
 }
</style>
