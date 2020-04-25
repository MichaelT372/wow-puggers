<template>
  <div class="modal fade" id="signupRaid" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Sign up for {{ location }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form ref="form">
            <div class="form-group">
              <label for="character-name">Name: *</label>
              <input v-model="signup.character_name" class="form-control" type="text" id="character-name">
            </div>
            <div class="form-group">
              <label for="class">Class:</label>
              <select v-model="signup.class" class="form-control" id="class" required>
                <option v-for="name in classNames" :value="name">{{ name }}</option>
              </select>
            </div>
            <div class="form-group">
              <label for="spec">Specialisation:</label>
              <select v-model="signup.spec" class="form-control" id="spec" required>
                <option v-for="spec in classSpecs" :value="spec">{{ spec }}</option>
              </select>
            </div>
            <div class="form-group" v-if="softReserves">
              <label for="spec">Soft reserve:</label>
              <select v-model="signup.soft_reserve" class="form-control" id="soft-reserve" required>
                <option v-for="item in softReserveItems" :value="item">{{ item }}</option>
              </select>
            </div>
            <div class="form-group" v-if="location === 'Molten Core'">
              <div class="form-check">
                <input v-model="signup.douse" class="form-check-input" name="douse" type="checkbox" value="true" id="douse">
                <label class="form-check-label" for="douse">
                  Can you douse a rune?
                </label>
              </div>
            </div>
            <div class="form-group">
              <label for="note">Note:</label>
              <textarea v-model="signup.note" class="form-control" id="note"></textarea>
              <small class="form-text text-muted">
                Write any additional information to go along with your signup here.
              </small>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" @click="submit">Sign up</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import classes from '../data/classes'
  import items from '../data/items'

  export default {
    name: "RaidSignupModal",

    props: {
      location: {
        required: true,
        type: String
      },
      id: {
        required: true,
        type: Number
      },
      softReserves: {
        required: true,
        type: Boolean
      }
    },

    data() {
      return {
        signup: {
          class: null,
          spec: null,
          douse: false
        },
        classes,
        items
      }
    },

    computed: {
      classNames() {
        return this.classes.map(c => c.class);
      },
      classSpecs() {
        const selectedClass = this.classes.find(c => c.class === this.signup.class);
        if (selectedClass) {
          return selectedClass.specialisations.map(s => s.name);
        }
        return [];
      },
      softReserveItems() {
        if (this.location === 'Other') {
          return [];
        }
        return this.items[this.location];
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
          axios.post(`/raids/${this.id}/signup`, this.signup)
            .then(res => {
              window.location.reload();
            })
            .catch(err => {
              console.log(err);
            });
        }
      }
    }
  }
</script>

<style scoped>

</style>
