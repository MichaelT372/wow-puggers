<template>
  <div class="soft-reserves-layout">
    <div class="form-group" style="width: 300px;">
      <label for="filter">Filter Item</label>
      <input id="filter" type="text" class="form-control" v-model="filter">
    </div>

    <div class="soft-reserve-row soft-reserve-row--header">
      <div class="item-col">
        Item Name
      </div>
      <div class="players-col">
          Players
      </div>
    </div>
    <div class="soft-reserve-row" v-for="item in softReservesKeys" :key="item">
      <div class="item-col">
        <span>{{ item }}</span>
      </div>
      <div class="players-col">
        <div class="player" v-for="player in signupsBySoftReserve[item]">
          <wow-icon
            :type="player.class"
            :size="15"
          ></wow-icon>

          <wow-icon
            :type="`${player.class}-${player.spec}`"
            :size="15"
          ></wow-icon>

          <span
            class="player_name"
            :class="[player.confirmed ? 'text-success' : 'text-danger']"
          >
            {{ player.character_name }}
          </span>

          <wow-icon
            type="aqual-quintessence"
            v-if="player.douse && showDouse"
            :size="15"
          ></wow-icon>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import { mapState, mapGetters } from 'vuex';
  import PlayersList from "./PlayersList";

  export default {
    name: "SoftReserves",
    components: {PlayersList},

    data() {
      return {
        filter: ''
      }
    },

    computed: {
      ...mapState({
        raid: 'raid',
      }),
      ...mapGetters({
        signupsBySoftReserve: 'signupsBySoftReserve',
      }),
      showDouse() {
        return this.raid.location === 'Molten Core';
      },
      softReservesKeys() {
        return Object.keys(this.signupsBySoftReserve)
          .sort()
          .filter(k => k.toLowerCase().trim().includes(this.filter.toLowerCase().trim()));
      }
    },
  }
</script>

<style lang="scss" scoped>
  .soft-reserves-layout {
    margin-bottom: 50px;
  }

  .soft-reserve-row {
    border: 1px solid rgba(255, 255, 255, 0.3);
    border-bottom: none;
    display: flex;
    flex-flow: row nowrap;
    > div {
      padding: 8px 10px;
    }
  }

  .soft-reserve-row:last-of-type {
    border: 1px solid rgba(255, 255, 255, 0.3);
  }

  .soft-reserve-row--header {
    font-weight: bold;
    font-size: 18px;
    cursor: pointer;
  }

  .soft-reserve-row:nth-of-type(odd) {
    background-color: rgba(0,0,0,0.3);
  }

  .soft-reserve-row:nth-of-type(even) {
    background-color: rgba(0,0,0,0.4);
  }

  .item-col {
    width: 200px;
    border-right: 1px solid rgba(255, 255, 255, 0.3);
    display: flex;
    align-items: center;
  }

  .players-col {
    display: flex;
    flex-flow: row wrap;
    align-items: flex-start;
  }

  .player {
    padding: 5px 12px;
    border-radius: 3px;
    margin: 0 8px 0 0;
    background-color: rgba(0,0,0,0.5);
  }

  .player_name {
    margin: 0 6px;
  }
</style>
