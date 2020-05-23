<template>
  <modal-component
    :show="show"
    @dismiss="cancelDelete"
  >
    <div class="delete-raid">
      <div class="container">
        <div class="row mb-2">
          <div class="col">
            <h3>Are you sure you want to delete {{ signup.character_name }} from this raid?</h3>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <button
              class="btn btn-danger"
              @click="deleteSignup"
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
              @click="cancelDelete">Cancel
            </button>
          </div>
        </div>
      </div>
    </div>
  </modal-component>
</template>

<script>
  export default {
    name: "DeleteSignupModal",
    data() {
      return {
        submitting: false
      }
    },
    computed: {
      show() {
        return this.$store.state.showDeleteSignupModal;
      },
      signup() {
        return this.$store.state.signupToDelete;
      }
    },
    methods: {
      deleteSignup() {
        this.submitting = true;
        this.$store.dispatch('deleteRaider').then(() => {
          this.submitting = false;
        });
      },
      cancelDelete() {
        this.$store.commit('showDeleteSignupModal', false);
        this.$store.commit('setSignupToDelete', {});
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
