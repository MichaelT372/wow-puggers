<template>
  <div>
    <div class="list-header">
      <wow-icon :type="titleIcon" v-if="titleIcon" :size="20"></wow-icon>
      <h6 :style="{color: titleColor}">
        {{ title }}
        <span v-if="showCount">({{ players.length }})</span>
      </h6>
    </div>

    <player-list-item
      v-for="player in players"
      :key="player.id"
      :player="player"
      :show-douse="showDouse"
      :can-edit="true"
    ></player-list-item>
  </div>
</template>

<script>
  import WowIcon from "./WowIcon";
  import PlayerListItem from "./PlayerListItem";

  export default {
    name: "PlayersList",
    components: { PlayerListItem, WowIcon },
    props: {
      title: {
        required: true,
        type: String
      },
      titleColor: {
        type: String,
        default: '#ffffff'
      },
      titleIcon: {
        type: String,
        default: ''
      },
      showCount: {
        type: Boolean,
        default: true
      },
      players: {
        required: true,
        type: Array,
        default: () => []
      },
      showDouse: {
        type: Boolean,
        default: false,
      },
      canEdit: {
        type: Boolean,
        default: true
      },
      classIcon: {
        type: Boolean,
        default: false
      }
    },
  }
</script>

<style lang="scss" scoped>
  .list-header {
    display: flex;
    align-items: center;
    padding-left: 2px;
    margin-bottom: 8px;
    h6 {
      font-weight: bold;
      margin: 0 0 0 7px;
    }
  }
</style>
