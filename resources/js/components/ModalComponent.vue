<template>
  <div>
    <transition name="modal-fade">
      <div class="modal" v-if="show">
        <div class="modal-dialog" :class="{'modal-lg': size === 'large'}" role="dialog">
          <div class="modal-content">
            <div class="modal-header">
              <slot name="header"></slot>
              <button type="button" class="close" @click="$emit('dismiss')">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <slot></slot>
            </div>
            <div class="modal-footer" v-if="withFooter">
              <slot name="footer"></slot>
            </div>
          </div>
        </div>
      </div>
    </transition>
    <div class="modal-backdrop fade show" v-if="show"></div>
  </div>
</template>

<script>
  export default {
    name: "ModalComponent",
    props: {
      show: {
        type: Boolean,
        default: false
      },
      withFooter: {
        type: Boolean,
        default: false
      },
      size: {
        type: String,
        default: 'regular'
      }
    },
    watch: {
      show(value) {
        if (value) {
          document.body.style.overflow = 'hidden';
        } else {
          setTimeout(() => document.body.style.overflow = '', 300);
        }
      }
    }
  }
</script>

<style scoped lang="scss">
  .modal {
    display: block;
    padding-right: 17px;
    overflow-x: hidden;
    overflow-y: auto;
  }

  .modal-fade-enter,
  .modal-fade-leave-active {
    opacity: 0;
    transform: translate(0, -50px);
  }

  .modal-fade-enter-active,
  .modal-fade-leave-active {
    transition: all .3s ease
  }
</style>
