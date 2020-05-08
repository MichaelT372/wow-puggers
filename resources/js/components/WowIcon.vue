<template>
  <img :src="icon.src" :alt="icon.alt" :height="size" :width="size">
</template>

<script>
  export default {
    name: "WowIcon",

    props: {
      type: {
        required: true,
        type: String,
      },
      size: {
        type: Number,
        default: 20
      }
    },

    data() {
      return {
        icons: [
          {
            type: 'warrior',
            src: require('../../images/warrior.png'),
            alt: 'warrior icon'
          },
          {
            type: 'warrior-arms',
            src: require('../../images/warrior-arms.png'),
            alt: 'warrior arms icon'
          },
          {
            type: 'warrior-fury',
            src: require('../../images/warrior-fury.png'),
            alt: 'warrior fury icon'
          },
          {
            type: 'warrior-protection',
            src: require('../../images/warrior-protection.png'),
            alt: 'warrior protection icon'
          },
          {
            type: 'rogue',
            src: require('../../images/rogue.png'),
            alt: 'rogue icon'
          },
          {
            type: 'rogue-assassination',
            src: require('../../images/rogue-assassination.png'),
            alt: 'rogue assassination icon'
          },
          {
            type: 'rogue-combat',
            src: require('../../images/rogue-combat.png'),
            alt: 'rogue combat icon'
          },
          {
            type: 'rogue-subtlety',
            src: require('../../images/rogue-subtlety.png'),
            alt: 'rogue subtlety icon'
          },
          {
            type: 'mage',
            src: require('../../images/mage.png'),
            alt: 'mage icon'
          },
          {
            type: 'mage-arcane',
            src: require('../../images/mage-arcane.png'),
            alt: 'arcane icon'
          },
          {
            type: 'mage-fire',
            src: require('../../images/mage-fire.png'),
            alt: 'fire icon'
          },
          {
            type: 'mage-frost',
            src: require('../../images/mage-frost.png'),
            alt: 'frost icon'
          },
          {
            type: 'hunter',
            src: require('../../images/hunter.png'),
            alt: 'hunter icon'
          },
          {
            type: 'hunter-beast mastery',
            src: require('../../images/hunter-beast-mastery.png'),
            alt: 'bm icon'
          },
          {
            type: 'hunter-marksmanship',
            src: require('../../images/hunter-marksmanship.png'),
            alt: 'mm icon'
          },
          {
            type: 'hunter-survival',
            src: require('../../images/hunter-survival.png'),
            alt: 'survival icon'
          },
          {
            type: 'warlock',
            src: require('../../images/warlock.png'),
            alt: 'warlock icon'
          },
          {
            type: 'warlock-affliction',
            src: require('../../images/warlock-affliction.png'),
            alt: 'affliction icon'
          },
          {
            type: 'warlock-demonology',
            src: require('../../images/warlock-demonology.png'),
            alt: 'demonology icon'
          },
          {
            type: 'warlock-destruction',
            src: require('../../images/warlock-destruction.png'),
            alt: 'destruction icon'
          },
          {
            type: 'druid',
            src: require('../../images/druid.png'),
            alt: 'druid icon'
          },
          {
            type: 'druid-balance',
            src: require('../../images/druid-balance.png'),
            alt: 'balance icon'
          },
          {
            type: 'druid-feral (tank)',
            src: require('../../images/druid-feral-tank.png'),
            alt: 'feral-tank icon'
          },
          {
            type: 'druid-feral (dps)',
            src: require('../../images/druid-feral-dps.png'),
            alt: 'feral-dps icon'
          },
          {
            type: 'druid-restoration',
            src: require('../../images/druid-restoration.png'),
            alt: 'restoration icon'
          },
          {
            type: 'priest',
            src: require('../../images/priest.png'),
            alt: 'priest icon'
          },
          {
            type: 'priest-discipline',
            src: require('../../images/priest-discipline.png'),
            alt: 'discipline icon'
          },
          {
            type: 'priest-holy',
            src: require('../../images/priest-holy.png'),
            alt: 'priest holy icon'
          },
          {
            type: 'priest-shadow',
            src: require('../../images/priest-shadow.png'),
            alt: 'priest shadow icon'
          },
          {
            type: 'paladin',
            src: require('../../images/paladin.png'),
            alt: 'paladin icon'
          },
          {
            type: 'paladin-holy',
            src: require('../../images/paladin-holy.png'),
            alt: 'paladin holy icon'
          },
          {
            type: 'paladin-protection',
            src: require('../../images/paladin-protection.png'),
            alt: 'paladin protection icon'
          },
          {
            type: 'paladin-retribution',
            src: require('../../images/paladin-retribution.png'),
            alt: 'paladin retribution icon'
          },
          {
            type: 'shaman',
            src: require('../../images/shaman.png'),
            alt: 'shaman icon'
          },
          {
            type: 'shaman-elemental',
            src: require('../../images/shaman-elemental.png'),
            alt: 'elemental icon'
          },
          {
            type: 'shaman-enhancement',
            src: require('../../images/shaman-enhancement.png'),
            alt: 'enhancement icon'
          },
          {
            type: 'shaman-restoration',
            src: require('../../images/shaman-restoration.png'),
            alt: 'shaman restoration icon'
          },
          {
            type: 'shaman-restoration',
            src: require('../../images/shaman-restoration.png'),
            alt: 'shaman restoration icon'
          },
          {
            type: 'aqual-quintessence',
            src: require('../../images/INV_Potion_76.png'),
            alt: 'aqual quintessence'
          },
          {
            type: 'alliance',
            src: require('../../images/alliance.png'),
            alt: 'alliance'
          },
          {
            type: 'horde',
            src: require('../../images/horde.png'),
            alt: 'horde'
          }
        ]
      }
    },

    computed: {
      icon() {
        return this.icons.find(i => i.type === this.type.toLowerCase());
      }
    }
  }
</script>

<style scoped>

</style>
