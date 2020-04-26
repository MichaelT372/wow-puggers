<template>
  <h6 :class="style.text">
    <wow-icon :type="type"></wow-icon>
    <b style="margin-left: 3px;">{{ style.label }} ({{ count }})</b>
  </h6>
</template>

<script>
  export default {

    name: "SignupClassListHeader",
    props: {
      type: {
        required: true,
        type: String
      },
      count: {
        required: true,
        type: Number
      }
    },

    data() {
      return {
        styles: [
          {
            class: 'warrior',
            label: 'Warriors',
            text: 'text-warrior',
          },
          {
            class: 'rogue',
            label: 'Rogues',
            text: 'text-rogue',
          },
          {
            class: 'mage',
            label: 'Mages',
            text: 'text-mage',
          },
          {
            class: 'hunter',
            label: 'Hunters',
            text: 'text-hunter',
          },
          {
            class: 'warlock',
            label: 'Warlocks',
            text: 'text-warlock',
          },
          {
            class: 'druid',
            label: 'Druids',
            text: 'text-druid',
          },
          {
            class: 'priest',
            label: 'Priests',
            text: 'text-priest',
          },
          {
            class: 'paladin',
            label: 'Paladins',
            text: 'text-paladin',
          },
          {
            class: 'shaman',
            label: 'Shamans',
            text: 'text-shaman',
          },
        ]
      }
    },

    computed: {
      style() {
        return this.styles.find(s => s.class === this.type);
      }
    }
  }
</script>

<style scoped>

</style>
