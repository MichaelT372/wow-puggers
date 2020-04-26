<template>
  <div>
    <ul class="list-unstyled">
      <li v-for="player in players" :key="player.id">
        <wow-icon
          v-if="classIcon"
          :type="player.class"
          :size="15"
        ></wow-icon>

        <wow-icon
          :type="`${player.class}-${player.spec}`"
          :size="15"
        ></wow-icon>

        <span class="player-name" :class="[player.confirmed ? 'text-success' : 'text-danger']">
          {{ player.character_name }}
        </span>

        <wow-icon
          type="aqual-quintessence"
          v-if="player.douse && location === 'Molten Core'"
          :size="15"
        ></wow-icon>
      </li>
    </ul>

  </div>
</template>

<script>
  import WowIcon from "./WowIcon";

  export default {
    name: "SignupClassList",
    components: {WowIcon},

    props: {
      players: {
        required: true,
        type: Array
      },
      location: {
        type: String,
        default: ''
      },
      classIcon: {
        type: Boolean,
        default: false
      }
    },
  }
</script>

<style scoped>
  .player-name {
    margin: 0 3px;
  }
</style>
