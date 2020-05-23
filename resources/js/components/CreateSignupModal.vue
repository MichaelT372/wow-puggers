<template>
  <modal-component
    :show="showModal"
    :with-footer="true"
    @dismiss="closeModal"
  >
    <template v-slot:header>
      <h5 class="modal-title">Sign up for {{ raid.location }}</h5>
    </template>
    <form ref="form">
      <div class="form-group">
        <label for="character-name">Name: *</label>
        <input v-model="signup.character_name" class="form-control" type="text" id="character-name" required>
      </div>
      <div class="form-group">
        <label for="class">Class: *</label>
        <select v-model="signup.class" class="form-control" id="class" required>
          <option v-for="name in classNames" :key="name" :value="name">
            {{ name }}
          </option>
        </select>
      </div>
      <div class="form-group">
        <label for="spec">Specialisation: *</label>
        <select v-model="signup.spec" class="form-control" id="spec" required>
          <option v-for="spec in classSpecs" :key="spec" :value="spec">
            {{ spec }}
          </option>
        </select>
      </div>
      <div class="form-group" v-if="raid.soft_reserves">
        <label for="spec">Soft reserve: *</label>
        <select v-model="signup.soft_reserve" class="form-control" id="soft-reserve" required>
          <option v-for="item in softReserveItems" :key="item.item_id" :value="item.item_name">
            {{ item.item_name }}
          </option>
        </select>
      </div>
      <div class="form-group" v-if="raid.location === 'Molten Core'">
        <div class="form-check">
          <input v-model="signup.douse" class="form-check-input" name="douse" type="checkbox" value="true" id="douse">
          <label class="form-check-label" for="douse">
            Can you douse a rune?
          </label>
        </div>
      </div>
      <div class="form-group">
        <label for="note">Note:</label>
        <textarea v-model="signup.note" class="form-control" id="note" rows="3"></textarea>
        <small class="form-text text-muted">
          Write any additional information to go along with your signup here.
        </small>
      </div>
    </form>
    <template v-slot:footer>
      <button type="button" class="btn btn-secondary" @click="closeModal">Close</button>
      <button
        type="button"
        class="btn btn-primary"
        @click="submit"
        :disabled="submitting"
      >
        <span v-if="submitting">
          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
          Signing up...
        </span>
        <span v-else>
          Sign up
        </span>
      </button>
    </template>
  </modal-component>
</template>

<script>
  import classes from '../data/classes'
  import items from '../data/items'

  export default {
    name: "CreateSignupModal",

    data() {
      return {
        signup: {
          class: null,
          spec: null,
          douse: false
        },
        submitting: false,
        classes,
        items
      }
    },

    computed: {
      raid() {
        return this.$store.state.raid;
      },
      showModal() {
        return this.$store.state.showCreateSignupModal;
      },
      classNames() {
        return this.classes.map(c => c.class)
                .filter(n => this.raid.faction === 'Horde' ? n !== 'Paladin' : n !== 'Shaman');
      },
      classSpecs() {
        const selectedClass = this.classes.find(c => c.class === this.signup.class);
        if (selectedClass) {
          return selectedClass.specialisations.map(s => s.name);
        }
        return [];
      },
      softReserveItems() {
        if (this.raid.location === 'Other') {
          return [];
        }
        return this.items[this.raid.location];
      }
    },

    watch: {
      'signup.class'(val) {
        this.signup.spec = null
      }
    },

    methods: {
      submit() {
        const isValid = this.$refs.form.reportValidity();
        if (isValid) {
          this.submitting = true;
          this.$store.dispatch('createRaider', this.signup)
            .then(() => {
              this.submitting = false;
              this.signup = {
                class: null,
                spec: null,
                douse: false
              };
            });
        }
      },
      closeModal() {
        this.$store.commit('showCreateSignupModal', false);
      }
    }
  }
</script>

<style scoped>

</style>
