<template>
  <div>
    <h6 :style="{color: titleColor}">
      <wow-icon :type="titleIcon" v-if="titleIcon"></wow-icon>
      <b style="margin-left: 3px;">
        {{ title }}
        <span v-if="showCount">({{ players.length }})</span>
      </b>
    </h6>

    <ul class="list-unstyled">
      <li v-for="player in players" :key="player.id" class="player-list-item">
        <div class="player-info">
          <wow-icon
            v-if="classIcon"
            :type="player.class"
            :size="15"
          ></wow-icon>

          <wow-icon
            :type="`${player.class}-${player.spec}`"
            :size="15"
          ></wow-icon>

          <span
            class="player-name"
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

        <div class="manage-controls" v-if="canEdit">
          <svg v-if="player.confirmed" xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8">
            <path d="M0 0v4h1v-4h-1zm2 0v4c.28 0 .53.09.72.28.19.19 1.15 2.12 1.28 2.38.13.26.39.39.66.31.26-.08.4-.36.31-.63-.08-.26-.47-1.59-.47-1.84s.22-.5.5-.5h1.5c.28 0 .5-.22.5-.5s-1.03-3.19-1.03-3.19c-.08-.18-.26-.31-.47-.31h-3.5z" />
          </svg>

          <svg v-else xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8">
            <path d="M4.47 0c-.19.02-.37.15-.47.34-.13.26-1.09 2.19-1.28 2.38-.19.19-.44.28-.72.28v4h3.5c.21 0 .39-.13.47-.31 0 0 1.03-2.91 1.03-3.19 0-.28-.22-.5-.5-.5h-1.5c-.28 0-.5-.25-.5-.5s.39-1.58.47-1.84c.08-.26-.05-.54-.31-.63-.07-.02-.12-.04-.19-.03zm-4.47 3v4h1v-4h-1z"
            />
          </svg>

          <div class="dropdown">
            <svg data-toggle="dropdown" xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8">
              <path d="M0 0v2h2v-2h-2zm3 0v2h2v-2h-2zm3 0v2h2v-2h-2z" transform="translate(0 3)" />
            </svg>
            <div class="dropdown-menu">
              <div class="dropdown-item">Edit</div>
              <div class="dropdown-item">Delete</div>
            </div>
          </div>
        </div>
      </li>
    </ul>

  </div>
</template>

<script>
  import WowIcon from "./WowIcon";

  export default {
    name: "PlayersList",
    components: { WowIcon },
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
        type: Array
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

<style scoped>
  .player-list-item {
    padding: 5px 10px;
    margin: 5px 0;
    background-color: rgba(0,0,0,0.3);
    display: flex;
    justify-content: space-between;
  }

  .manage-controls {
    display: flex;
    align-items: center;
    width: 40px;
    justify-content: space-between;
  }

  .manage-controls svg {
    fill: #fff;
    width: 15px;
    height: 15px;
    cursor: pointer;
  }

  .player-name {
    margin: 0 3px;
  }
</style>
