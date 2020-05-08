<template>
  <modal-component
    :show="showModal"
    :with-footer="true"
    @dismiss="closeModal"
    size="large"
  >
    <template v-slot:header>
      <h5 class="modal-title">Create a Raid</h5>
    </template>
    <form ref="form">
      <div class="form-group">
        <label style="display: block">Faction</label>
        <div class="form-check form-check-inline">
          <input v-model="raid.faction" class="form-check-input" type="radio" name="faction" id="faction-alliance" value="Alliance" required>
          <label class="form-check-label" for="faction-alliance">Alliance</label>
        </div>
        <div class="form-check form-check-inline">
          <input v-model="raid.faction" class="form-check-input" type="radio" name="faction" id="faction-horde" value="Horde" required>
          <label class="form-check-label" for="faction-horde">Horde</label>
        </div>
      </div>
      <div class="form-group">
        <label for="location">Raid:</label>
        <select v-model="raid.location" class="form-control" id="location" required>
          <option value="Molten Core">Molten Core</option>
          <option value="Blackwing Lair">Blackwing Lair</option>
          <option value="Zul'Gurub">Zul'Gurub</option>
          <option value="Onyxia">Onyxia</option>
          <option value="Other">Other</option>
        </select>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-12">
            <label>Start time</label>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <input v-model="startDate" class="form-control" name="start-date" type="date" required>
          </div>
          <div class="col-6">
            <input v-model="startTime" class="form-control" name="start-time" type="time" required>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="description">Description:</label>
        <textarea rows="10" v-model="raid.description" class="form-control" id="description" required></textarea>
        <small class="form-text text-muted">
          Introduce your raid here and specify any sign up requirements.
        </small>
      </div>
      <div class="form-group">
        <label for="loot-rules">Loot rules:</label>
        <textarea rows="10" v-model="raid.loot_rules" class="form-control" id="loot-rules" required></textarea>
        <small class="form-text text-muted">
          Describe your loot rules in detail. You won't be able to edit these after you have created your raid.
        </small>
      </div>
      <div v-if="useSoftReserves" id="soft-reserves-group" class="form-group">
        <div class="form-check">
          <input v-model="raid.soft_reserves" class="form-check-input" name="soft-reserves" type="checkbox" value="true" id="soft-reserves">
          <label class="form-check-label" for="soft-reserves">
            Enable soft reserves
          </label>
        </div>
        <small class="form-text text-muted">
          If you enable soft reserves, raiders will be able to select any item that drops in the raid to soft reserve.
          If you have any restrictions on soft reserving items, please specify these in your loot rules.
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
          Creating...
        </span>
        <span v-else>
          Create raid
        </span>
      </button>
    </template>
  </modal-component>
</template>

<script>
  import ModalComponent from "./ModalComponent";
  export default {
    name: "CreateRaidModal",
    components: {ModalComponent},
    data() {
      return {
        raid: {},
        startDate: null,
        startTime: null,
        submitting: false
      }
    },

    computed: {
      raidData() {
        return {
          ...this.raid,
          start_at: this.startDate + ' ' + this.startTime,
          soft_reserves: this.useSoftReserves ? this.raid.soft_reserves : false
        }
      },
      showModal() {
        return this.$store.state.showCreateRaidModal;
      },
      useSoftReserves() {
        const softReserveRaids = ["Molten Core", "Blackwing Lair", "Zul'Gurub"];
        return softReserveRaids.includes(this.raid.location) || !this.raid.location;
      }
    },

    methods: {
      closeModal() {
        this.$store.commit('showCreateRaidModal', false);
      },
      submit() {
        const isValid = this.$refs.form.reportValidity();
        if (isValid) {
          this.submitting = true;
          this.$store.dispatch('createRaid', this.raidData)
            .then(() => {
              this.submitting = false;
              this.raid = {};
            });
        }
      }
    }
  }
</script>

<style scoped>

</style>
