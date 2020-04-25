<template>
    <div class="modal-overlay"
         :class="{'show': show}">
      <div class="modal-main">
        <slot></slot>
      </div>
    </div>
</template>

<script>
  export default {
    name: "ModalComponent",
    props: {
      show: {
        type: Boolean,
        default: false
      }
    }
  }
</script>

<style scoped lang="scss">
  .modal-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.3);
    opacity: 0;
    display: none;
    transition: 0.3s linear opacity;
  }

  .modal-overlay.show {
    display: block;
    opacity: 1;
  }

  .modal-main {
    margin: 50px auto;
    background: #ffffff;
    width: 600px;
    max-width: 100%;
    padding: 15px;
  }
</style>
