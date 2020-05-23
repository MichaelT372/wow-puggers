<template>
  <transition
    enter-active-class="enter-active"
    leave-active-class="leave-active"
    @before-enter="beforeEnter"
    @enter="enter"
    @after-enter="afterEnter"
    @before-leave="beforeLeave"
    @leave="leave"
    @after-leave="afterLeave"
  >
    <slot></slot>
  </transition>
</template>

<script>
  export default {
    name: "TransitionSlideToggle",
    props: {
      speed: {
        type: Number,
        default: 300
      }
    },
    computed: {
      transitionDuration () {
        return (this.speed / 1000).toString() + 's';
      }
    },
    methods: {
      /**
       * @param {HTMLElement} element
       */
      beforeEnter(element) {
        requestAnimationFrame(() => {
          if (!element.style.height) {
            element.style.height = '0px';
          }
          element.style.display = null;
          element.style.transitionDuration = this.transitionDuration;
        });
      },
      /**
       * @param {HTMLElement} element
       */
      enter(element) {
        requestAnimationFrame(() => {
          requestAnimationFrame(() => {
            element.style.height = `${element.scrollHeight}px`;
          });
        });
      },
      /**
       * @param {HTMLElement} element
       */
      afterEnter(element) {
        element.style.height = null;
      },
      /**
       * @param {HTMLElement} element
       */
      beforeLeave(element) {
        requestAnimationFrame(() => {
          if (!element.style.height) {
            element.style.height = `${element.offsetHeight}px`;
          }
        });
      },
      /**
       * @param {HTMLElement} element
       */
      leave(element) {
        requestAnimationFrame(() => {
          requestAnimationFrame(() => {
            element.style.height = '0px';
          });
        });
      },
      /**
       * @param {HTMLElement} element
       */
      afterLeave(element) {
        element.style.height = null;
      },
    },
  }
</script>

<style scoped>
  .enter-active,
  .leave-active {
    overflow: hidden;
    transition: height linear;
  }
</style>
