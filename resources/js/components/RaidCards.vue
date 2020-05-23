<template>
    <transition-group name="card" tag="div" class="row"
      @before-enter="beforeEnter"
      @enter="enter"
      @leave="leave"
    >
      <div class="col-lg-4 col-md-6 col-12 mb-4 raid-card-col"
           v-if="raids.length > 0"
           v-for="(raid, index) in raids"
           :key="raid.id"
           :data-index="index">
        <a :href="'/raids/' + raid.id">
          <div class="raid-card" :style="{'background-image': bgImage(raid.location)}">
            <div class="raid-card-header">
              <div class="faction">
                <wow-icon
                  :type="raid.faction"
                  :size="35"
                ></wow-icon>
              </div>
              <div class="raid-controls">
                <div class="edit-icon" @click.prevent="editRaid(raid.id)">
                  <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8">
                    <path d="M6 0l-1 1 2 2 1-1-2-2zm-2 2l-4 4v2h2l4-4-2-2z" />
                  </svg>
                </div>
                <div class="delete-icon" @click.prevent="confirmDeleteRaid(raid.id)">
                  <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8">
                    <path d="M3 0c-.55 0-1 .45-1 1h-1c-.55 0-1 .45-1 1h7c0-.55-.45-1-1-1h-1c0-.55-.45-1-1-1h-1zm-2 3v4.81c0 .11.08.19.19.19h4.63c.11 0 .19-.08.19-.19v-4.81h-1v3.5c0 .28-.22.5-.5.5s-.5-.22-.5-.5v-3.5h-1v3.5c0 .28-.22.5-.5.5s-.5-.22-.5-.5v-3.5h-1z" />
                  </svg>
                </div>
              </div>
            </div>
            <div class="raid-card-text">
              <h5 class="raid-card-title">
                {{ raid.location }}
              </h5>
              <div class="raid-card-item">
                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8">
                  <path
                    d="M4 0c-2.2 0-4 1.8-4 4s1.8 4 4 4 4-1.8 4-4-1.8-4-4-4zm0 1c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm-.5 1v2.22l.16.13.5.5.34.38.72-.72-.38-.34-.34-.34v-1.81h-1z"/>
                </svg>
                {{ formatDate(raid.start_at) }}
              </div>
              <div class="raid-card-item">
                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8">
                  <path
                    d="M5.5 0c-.51 0-.95.35-1.22.88.45.54.72 1.28.72 2.13 0 .29-.03.55-.09.81.19.11.38.19.59.19.83 0 1.5-.9 1.5-2s-.67-2-1.5-2zm-3 1c-.83 0-1.5.9-1.5 2s.67 2 1.5 2 1.5-.9 1.5-2-.67-2-1.5-2zm4.75 3.16c-.43.51-1.02.82-1.69.84.27.38.44.84.44 1.34v.66h2v-1.66c0-.52-.31-.97-.75-1.19zm-6.5 1c-.44.22-.75.67-.75 1.19v1.66h5v-1.66c0-.52-.31-.97-.75-1.19-.45.53-1.06.84-1.75.84s-1.3-.32-1.75-.84z"
                  />
                </svg>
                {{ raid.raiders_count }}
              </div>
            </div>
          </div>
        </a>
      </div>
    </transition-group>
</template>

<script>
  export default {
    name: "RaidCards",
    computed: {
      raids() {
        return this.$store.state.raids;
      }
    },
    methods: {
      bgImage(location) {
        if (location === 'Molten Core') {
          return 'url(/images/molten-core.jpg)';
        } else if (location === 'Blackwing Lair') {
          return 'url(/images/blackwing-lair.jpg)';
        } else if (location === "Zul'Gurub") {
          return 'url(/images/zul-gurub.jpg)';
        } else if (location === "Onyxia") {
          return 'url(/images/onyxia.jpg)';
        } else {
          return 'url(/images/molten-core.jpg)';
        }
      },
      confirmDeleteRaid(id) {
        this.$store.commit('showDeleteRaidModal', true);
        this.$store.commit('setRaidToDelete', id);
      },
      editRaid(id) {
        this.$store.commit('showEditRaidModal', true)
        this.$store.commit('setRaidToEdit', id);
      },
      formatDate(date) {
        return moment.utc(date).format('HH:mm - dddd Do MMMM YYYY');
      },
      beforeEnter(el) {
        el.style.opacity = '0';
      },
      enter(el, done) {
        const delay = el.dataset.index * 100;
        setTimeout(() => {
          el.style.opacity = '1';
          done();
        }, delay)
      },
      leave(el, done) {
        const delay = el.dataset.index * 100;
        setTimeout(() => {
          el.style.opacity = '0';
          done();
        }, delay)
      }
    }
  }
</script>

<style lang="scss" scoped>
  .raid-card-col a:hover {
    text-decoration: none;
  }

  .raid-card-col {
    transition: opacity .25s linear;
  }

  .raid-card {
    position: relative;
    width: 100%;
    height: 250px;
    background-size: cover;
    border-radius: 5px;
    color: white;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  .raid-card-header {
    padding: 8px;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
  }

  .raid-controls {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    svg {
      fill: #ffffff;
      margin-left: 10px;
      height: 18px;
      width: 18px;
      transition: 0.1s linear;
    }
  }

  .edit-icon svg:hover {
    fill: #17a2b8;
  }

  .delete-icon svg:hover {
    fill: #e3342f;
  }

  .raid-card-text {
    background-color: rgba(0,0,0,0.8);
    padding: 13px 10px 10px;
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
  }

  .raid-card-title {
    font-weight: bold;
  }

  .raid-card-item {
    display: flex;
    align-items: center;
    margin-bottom: 3px;
    font-size: 13px;

    svg {
      fill: #ffffff;
      margin-right: 10px;
      height: 14px;
      width: 14px;
    }
  }
</style>
