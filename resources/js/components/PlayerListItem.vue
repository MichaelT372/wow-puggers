<template>
  <div class="player-info">
    <div class="player-info-top" @click.self="expand = !expand">
      <div class="left" @click="expand = !expand">
        <wow-icon
          v-if="classIcon"
          :type="player.class"
          :size="20"
        ></wow-icon>
        <wow-icon
          :type="`${player.class}-${player.spec}`"
          :size="20"
        ></wow-icon>
        <span
          class="player-name"
          :class="[player.confirmed ? 'text-success' : 'text-danger']"
        >{{ player.character_name }}</span>
        <wow-icon
          type="aqual-quintessence"
          v-if="player.douse && showDouse"
          :size="15"
        ></wow-icon>
      </div>

      <div class="right" v-if="canEdit">
        <div class="toggle-approved" @click="toggleApproved">
          <svg class="icon-unapprove" v-if="player.confirmed" xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8">
            <path d="M0 0v4h1v-4h-1zm2 0v4c.28 0 .53.09.72.28.19.19 1.15 2.12 1.28 2.38.13.26.39.39.66.31.26-.08.4-.36.31-.63-.08-.26-.47-1.59-.47-1.84s.22-.5.5-.5h1.5c.28 0 .5-.22.5-.5s-1.03-3.19-1.03-3.19c-.08-.18-.26-.31-.47-.31h-3.5z" />
          </svg>
          <svg class="icon-approve" v-else xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8">
            <path d="M4.47 0c-.19.02-.37.15-.47.34-.13.26-1.09 2.19-1.28 2.38-.19.19-.44.28-.72.28v4h3.5c.21 0 .39-.13.47-.31 0 0 1.03-2.91 1.03-3.19 0-.28-.22-.5-.5-.5h-1.5c-.28 0-.5-.25-.5-.5s.39-1.58.47-1.84c.08-.26-.05-.54-.31-.63-.07-.02-.12-.04-.19-.03zm-4.47 3v4h1v-4h-1z"
            />
          </svg>
        </div>

        <div class="dropdown">
          <svg class="icon-dropdown" data-toggle="dropdown" xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8">
            <path d="M0 0v1h8v-1h-8zm0 2.97v1h8v-1h-8zm0 3v1h8v-1h-8z" transform="translate(0 1)" />
          </svg>
          <div class="dropdown-menu">
            <div class="dropdown-item" @click="editPlayer">
              Edit
            </div>
            <div class="dropdown-item" @click="deletePlayer">
              Delete
            </div>
          </div>
        </div>
      </div>
    </div>
    <transition-slide-toggle :speed="150">
      <div class="player-info-expanded" v-show="expand">
        <div v-if="player.note">
          <h6><b>Note</b></h6>
          <p style="margin-bottom:0;">{{ player.note }}</p>
        </div>
        <div v-if="player.soft_reserve && raid.soft_reserves">
          <h6 style="margin-top: 16px;"><b>Soft reserve</b></h6>
          <p style="margin-bottom:0;">
            <a class="text-white" :href="getItemLink(player.soft_reserve)" target="_blank">
              {{ player.soft_reserve }}
            </a>
          </p>
        </div>
      </div>
    </transition-slide-toggle>
  </div>
</template>

<script>
  import { mapState, mapGetters } from 'vuex';
  import WowIcon from "./WowIcon";
  import TransitionSlideToggle from "./TransitionSlideToggle";

  export default {
    name: "PlayerListItem",
    components: {TransitionSlideToggle, WowIcon},
    props: {
      player: {
        required: true,
        type: Object
      },
      classIcon: {
        type: Boolean,
        default: false
      },
      showDouse: {
        type: Boolean,
        default: false
      }
    },
    data() {
      return {
        expand: false
      }
    },
    computed: {
      ...mapState({
        'canEdit': 'canEdit',
        'raid': 'raid'
      }),
      ...mapGetters({
        getItemLink: 'getItemLink'
      })
    },
    methods: {
      toggleApproved() {
        this.$store.dispatch('updateRaider', {
          id: this.player.id,
          confirmed: !this.player.confirmed
        });
      },
      editPlayer() {
        this.$store.commit('setSignupToEdit', this.player);
        this.$store.commit('showEditSignupModal', true);
      },
      deletePlayer() {
        this.$store.commit('setSignupToDelete', this.player);
        this.$store.commit('showDeleteSignupModal', true);
      }
    }
  }
</script>

<style lang="scss" scoped>
  .player-info {
    display: flex;
    flex-direction: column;
    margin: 3px 0;
  }

  .player-info-top {
    padding: 5px 10px;
    background-color: rgba(0,0,0,0.3);
    border: 1px solid rgba(0,0,0,0.6);
    display: flex;
    justify-content: space-between;
    align-items: center;
    cursor: pointer;
  }

  .player-info-expanded {
    padding: 10px;
    background-color: rgba(0,0,0,0.3);
    border: 1px solid rgba(0,0,0,0.6);
    border-top: none;
  }

  .left {
    display: flex;
    align-items: center;
  }

  .right {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .right svg {
    fill: #fff;
    width: 18px;
    height: 18px;
    cursor: pointer;
    transition: .2s ease;
  }

  .right .toggle-approved svg {
    width: 20px;
    height: 20px;
  }

  .toggle-approved {
    margin-right: 10px;
  }

  .icon-approve:hover {
    fill: #38c172;
  }

  .icon-unapprove:hover {
    fill: #e3342f;
  }

  .icon-dropdown {
    position: relative;
    top: -2px;
  }

  .icon-dropdown:hover {
    fill: #17a2b8;
  }

  .player-name {
    margin: 0 6px;
  }

  .dropdown-item:hover {
    color: #fff;
    text-decoration: none;
    background-color: #3490dc;
  }
</style>
