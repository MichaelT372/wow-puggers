<template>
  <modal-component
    :show="showModal"
    :with-footer="true"
    @dismiss="closeModal"
    size="large"
  >
    <template v-slot:header>
      <h5 class="modal-title">Edit raid</h5>
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
          Editing...
        </span>
        <span v-else>
          Edit raid
        </span>
      </button>
    </template>
  </modal-component>
</template>

<script>
  import ModalComponent from "./ModalComponent";

  export default {
    name: "EditRaidModal",
    components: {ModalComponent},
    data() {
      return {
        raid: {},
        raidId: null,
        startDate: null,
        startTime: null,
        submitting: false
      }
    },

    computed: {
      raidData() {
        return {
          id: this.raid.id,
          description: this.raid.description,
          faction: this.raid.faction,
          location: this.raid.location,
          start_at: this.startDate + ' ' + this.startTime,
          soft_reserves: this.useSoftReserves ? this.raid.soft_reserves : false
        }
      },
      showModal() {
        return this.$store.state.showEditRaidModal;
      },
      useSoftReserves() {
        const softReserveRaids = ["Molten Core", "Blackwing Lair", "Zul'Gurub"];
        return softReserveRaids.includes(this.raid.location) || !this.raid.location;
      }
    },

    methods: {
      closeModal() {
        this.$store.commit('showEditRaidModal', false);
      },
      submit() {
        const isValid = this.$refs.form.reportValidity();
        if (isValid) {
          this.submitting = true;
          this.$store.dispatch('updateRaid', this.raidData)
            .then(() => {
              this.submitting = false;
            });
        }
      }
    },

    created() {
      //when raidToEdit is updated in the store, we create a clone of it here for editing
      this.unwatch = this.$store.watch((state) => state.raidToEdit, (value) => {
        this.raid = JSON.parse(JSON.stringify(value));
        let startTime = moment.utc(this.raid.start_at);
        this.startDate = startTime.format('YYYY-MM-DD');
        this.startTime = startTime.format('HH:mm');
      })
    },

    beforeDestroy() {
      this.unwatch();
    },
  }
</script>

<style scoped>

</style>
