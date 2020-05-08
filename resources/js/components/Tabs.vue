<template>
  <div class="wp-tabs">
    <div class="wp-tabs__header" ref="header">
      <div class="wp-tabs__header-slider" :style="sliderStyles"></div>
      <div
        ref="headerItems"
        v-for="tab in tabs"
        :class="{
          'wp-tabs__header-item': true,
          'wp-tabs__header-item--active': tab.active
        }"
        @click="setActiveTab($event, tab.name)"
      >
        <span>{{ tab.name }}</span>
      </div>
    </div>
    <div class="wp-tabs__body">
      <slot></slot>
    </div>
  </div>
</template>

<script>
  export default {
    name: "Tabs",
    data() {
      return {
        activeTab: null,
        tabs: [],
        sliderStyles: {
          width: null,
          left: null
        }
      }
    },
    methods: {
      setActiveTab(e, tabName) {
        this.tabs.forEach((t) => t.active = t.name === tabName);
        let el = e.target;
        if (! el.classList.contains('wp-tabs__header-item')) {
          el = el.parentNode;
        }
        this.setSliderStyles(el.offsetLeft, el.clientWidth);
      },
      setSliderStyles(left, width) {
        this.sliderStyles.left = left + 'px';
        this.sliderStyles.width = width + 'px';
      }
    },
    mounted() {
      this.tabs = this.$children;
      this.activeTab = this.tabs.findIndex(t => t.selected);
      //Default to the first one if no 'selected' prop on any tab
      if (this.activeTab === -1) {
        this.activeTab = 0;
        this.tabs[0].active = true;
      }
      this.$nextTick(() => {
        const activeHeaderItem = this.$refs.headerItems[this.activeTab];
        this.setSliderStyles(activeHeaderItem.offsetLeft, activeHeaderItem.clientWidth);
      })
    },
  }
</script>

<style lang="scss" scoped>
  .wp-tabs {
    display: flex;
    flex-direction: column;
    width: 100%;
  }

  .wp-tabs__header {
    display: flex;
    flex-flow: row nowrap;
    position: relative;
    border-bottom: 2px solid rgba(255,255,255,0.3);
  }

  .wp-tabs__header-item {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 15px;
    text-transform: uppercase;
    font-size: 16px;
    cursor: pointer;
    color: rgba(255,255,255,0.3);
    transition: color .2s ease;
  }

  .wp-tabs__header-item:hover {
    color: #ffffff;
  }

  .wp-tabs__header-item--active {
    color: #ffffff;
  }

  .wp-tabs__header-slider {
    position: absolute;
    background-color: #ffffff;
    transition: left .3s ease;
    height: 2px;
    bottom: -2px;
  }

  .wp-tabs__body {
    padding-top: 20px;
  }
</style>
