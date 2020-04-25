<template>
  <div class="modal fade" id="createRaid" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Create a Raid</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
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
              <textarea v-model="raid.description" class="form-control" id="description" required></textarea>
              <small class="form-text text-muted">
                Introduce your raid here and specify any sign up requirements.
              </small>
            </div>
            <div class="form-group">
              <label for="loot-rules">Loot rules:</label>
              <textarea v-model="raid.loot_rules" class="form-control" id="loot-rules" required></textarea>
              <small class="form-text text-muted">
                Describe your loot rules in detail. You won't be able to edit these after you have created your raid.
              </small>
            </div>
            <div v-if="raid.location !== 'Other'" id="soft-reserves-group" class="form-group">
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
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" @click="submit">Create raid</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: "CreateRaidModal",

    data() {
      return {
        raid: {},
        startDate: null,
        startTime: null
      }
    },

    computed: {
      raidData() {
        return {
          ...this.raid,
          start_at: this.startDate + ' ' + this.startTime,
          soft_reserves: this.raid.location === 'Other' ? false : this.raid.soft_reserves
        }
      }
    },

    methods: {
      submit() {
        const isValid = this.$refs.form.reportValidity();
        if (isValid) {
          axios.post('/raids/create', this.raidData)
            .then(res => {
              window.location = `/raids/${res.data.data.id}`;
            })
            .catch(err => {
              console.log(err)
            });
        }
      }
    }
  }
</script>

<style scoped>

</style>
