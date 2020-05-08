<template>
  <div v-show="active">
    <slot></slot>
  </div>
</template>

<script>
  export default {
    name: "Tab",
    props: {
      name: {
        required: true,
        type: String
      },
      selected: {
        default: false,
        type: Boolean
      }
    },
    data() {
      return {
        active: false
      }
    },
    mounted() {
      this.active = this.selected
    }
  }
</script>

<style scoped>
</style>
