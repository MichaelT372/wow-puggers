import Vue from 'vue'
import Vuex from 'vuex'
import { groupBy } from 'lodash';

Vue.use(Vuex)

export default new Vuex.Store({
  strict: process.env.NODE_ENV !== 'production',

  state: {
    colors: {
      warrior: '#C79C6E',
      rogue: '#FFF569',
      mage: '#40C7EB',
      hunter: '#A9D271',
      warlock: '#8787ED',
      druid: '#FF7D0A',
      priest: '#FFFFFF',
      shaman: '#F58CBA',
      paladin: '#F58CBA'
    },
    tankSpecs: ['Protection', 'Feral (Tank)'],
    healerSpecs: ['Holy', 'Restoration', 'Discipline'],
    meleeDpsSpecs: ['Arms', 'Fury', 'Enhancement', 'Retribution', 'Assassination', 'Combat', 'Subtlety', 'Feral (DPS)'],
    rangedDpsSpecs: ['Arcane', 'Fire', 'Frost', 'Survival', 'Beast Mastery', 'Marksmanship', 'Affliction', 'Demonology', 'Destruction', 'Shadow', 'Balance'],
    items: [],
    raids: [],
    raid: {},
    signups: [],
    canEdit: false,
    showCreateRaidModal: false,
    showEditRaidModal: false,
    showDeleteRaidModal: false,
    raidToDelete: null,
    raidToEdit: {},
    showCreateSignupModal: false,
    showEditSignupModal: false,
    showDeleteSignupModal: false,
    signupToEdit: {},
    signupToDelete: {}
  },

  mutations: {
    canEdit(state, status) {
      state.canEdit = !!status;
    },
    setItems(state, items) {
      let allItems = [];
      for (let raid in items) {
        allItems.push(...items[raid]);
      }
      state.items = allItems;
    },
    setRaids(state, raids) {
      state.raids = raids;
    },
    addRaid(state, raid) {
      state.raids.unshift(raid);
    },
    updateRaid(state, raid) {
      const i = state.raids.findIndex(r => r.id === raid.id);
      Vue.set(state.raids, i, raid);
    },
    removeRaid(state, raidId) {
      state.raids = state.raids.filter(r => r.id !== raidId);
    },
    setRaidToEdit(state, raidId) {
      state.raidToEdit = state.raids.find(r => r.id === raidId);
    },
    updateRaidToEdit(state, raid) {
      state.raidToEdit = raid;
    },
    setRaidToDelete(state, raidId) {
      state.raidToDelete = raidId;
    },
    showCreateRaidModal(state, status) {
      state.showCreateRaidModal = status;
    },
    showEditRaidModal(state, status) {
      state.showEditRaidModal = status;
    },
    showDeleteRaidModal(state, status) {
      state.showDeleteRaidModal = status;
    },
    setRaid(state, raid) {
      state.raid = raid;
    },
    setSignups(state, signups) {
      state.signups = signups.filter(s => {
        return state.raid.faction === 'Horde' ? s.class !== 'Paladin' : s.class !== 'Shaman';
      }).sort((a, b) => b.confirmed - a.confirmed);
    },
    addSignup(state, signup) {
      state.signups.push(signup);
    },
    updateSignup(state, signup) {
      const i = state.signups.findIndex(s => s.id === signup.id);
      Vue.set(state.signups, i, signup);
    },
    deleteSignup(state, signupId) {
      state.signups = state.signups.filter(s => s.id !== signupId);
    },
    setSignupToEdit(state, player) {
      state.signupToEdit = player;
    },
    setSignupToDelete(state, player) {
      state.signupToDelete = player;
    },
    showCreateSignupModal(state, status) {
      state.showCreateSignupModal = status;
    },
    showEditSignupModal(state, status) {
      state.showEditSignupModal = status;
    },
    showDeleteSignupModal(state, status) {
      state.showDeleteSignupModal = status;
    },
  },

  actions: {
    createRaid({commit}, raid) {
      return axios.post('/raids/create', raid)
        .then(({data}) => {
          commit('addRaid', data.raid);
          commit('showCreateRaidModal', false);
        })
        .catch(err => {
          return err;
        });
    },
    updateRaid({commit, state}, raid) {
      return axios.put(`/raids/${raid.id}/update`, raid)
        .then(({data}) => {
          commit('showEditRaidModal', false);
          commit('updateRaid', data.raid);
        })
        .catch(err => {
          return err;
        });
    },
    deleteRaid({commit, state}) {
      return axios.delete(`/raids/${state.raidToDelete}/delete`)
        .then(() => {
          commit('removeRaid', state.raidToDelete);
          commit('showDeleteRaidModal', false);
          commit('setRaidToDelete', null);
        })
        .catch(() => {
          commit('showDeleteRaidModal', false);
          commit('setRaidToDelete', null);
        });
    },
    createRaider({commit, state}, signup) {
      return axios.post(`/raids/${state.raid.id}/signup`, signup)
        .then(({data}) => {
          commit('addSignup', data.signup);
          commit('showCreateSignupModal', false);
        })
        .catch(err => {
          return err;
        });
    },
    updateRaider({commit, state}, raider) {
      return axios.put(`/raider/${raider.id}`, raider)
        .then(({data}) => {
          commit('updateSignup', data.signup);
          commit('setSignups', state.signups);
        })
        .catch(err => {
          return err;
        });
    },
    deleteRaider({commit, state}) {
      return axios.delete(`/raider/${state.signupToDelete.id}`)
        .then(() => {
          commit('deleteSignup', state.signupToDelete.id);
          commit('showDeleteSignupModal', false);
          commit('setSignupToDelete', {});
        })
        .catch((err) => {
          return err;
        });
    },
  },

  getters: {
    douses: state => {
      return state.signups.filter(s => s.douse);
    },
    signupsByClass: state => {
      return groupBy(state.signups, 'class');
    },
    signupsByRole: state => {
      return {
        tanks: state.signups.filter(s => state.tankSpecs.includes(s.spec)),
        healers: state.signups.filter(s => state.healerSpecs.includes(s.spec)),
        meleeDps: state.signups.filter(s => state.meleeDpsSpecs.includes(s.spec)),
        rangedDps: state.signups.filter(s => state.rangedDpsSpecs.includes(s.spec)),
      }
    },
    signupsBySoftReserve: state => {
      return groupBy(state.signups, 'soft_reserve');
    },
    getItemId: state => (name) => {
      const item = state.items.find(i => i['item_name'].toLowerCase() === name.toLowerCase());
      return item.item_id || null;
    },
    getItemLink: state => (name) => {
      const item = state.items.find(i => i['item_name'].toLowerCase() === name.toLowerCase());
      return 'https://classic.wowhead.com/item='+item.item_id;
    },
  }
})
