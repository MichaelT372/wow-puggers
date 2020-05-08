<template>
  <modal-component
    :show="showDeleteModal"
    @dismiss="cancelDelete"
  >
    <div class="delete-raid">
      <div class="container">
        <div class="row mb-2">
          <div class="col">
            <h3>Are you sure you want to delete this raid?</h3>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <button
              class="btn btn-danger"
              @click="deleteRaid"
              :disabled="submitting"
            >
              <span v-if="submitting">
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Deleting...
              </span>
                    <span v-else>
                Delete
              </span>
            </button>
            <button
              class="btn btn-secondary"
              @click="cancelDelete">No
            </button>
          </div>
        </div>
      </div>
    </div>
  </modal-component>
</template>

<script>
  export default {
    name: "DeleteRaidModal",
    data() {
      return {
        submitting: false
      }
    },
    computed: {
      showDeleteModal() {
        return this.$store.state.showDeleteRaidModal;
      },
    },
    methods: {
      deleteRaid() {
        this.submitting = true;
        this.$store.dispatch('deleteRaid').then(() => {
          this.submitting = false;
        });
      },
      cancelDelete() {
        this.$store.commit('showDeleteRaidModal', false);
        this.$store.commit('setRaidToDelete', null);
      }
    }
  }
</script>

<style lang="scss" scoped>
  .delete-raid {
    color: #000;
    text-align: center;
    button {
      min-width: 100px;
      margin: 0 10px;
    }
  }
</style>
