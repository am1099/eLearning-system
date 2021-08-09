<template>
  <div class="container">
    <b-card-group deck>
      <b-card
        v-for="(value, index) in stats"
        :key="value.id"
        border-variant="dark"
        bg-variant="dark"
        text-variant="white"
        class="panel"
        style="max-height: 7rem"
      >
          <b-card-text class="text-center stat">{{ value }} </b-card-text>
          <div class="stats-line-black"></div>
          <b-card-text class="text-center" style="font-size: 1rem; font-weight: bold">{{
            statName[index]
          }}</b-card-text>
      </b-card>
    </b-card-group>
  </div>
</template>

<style scoped>
.container {
  margin: 0 auto;
}

.small {
  font-size: 18px;
  font-weight: bold;
}

.stat {
  font-size: 28px;
  font-weight: bold;
  text-transform: uppercase;
}

.stats-line-black {
  margin: 0 auto;
  width: 100px;
  height: 2px;
  background-color: #fff;
}

.panel {
  border: 1px solid #141414;
  border-radius: 7px;
  padding: 2px;
}
</style>

<script>
export default {
  mounted() {
    console.log("Component mounted.");
  },
  props: ["stats"],
  data() {
    return {
      stats: this.stats,
      statName: ["Programs Validated", "Modules Validated", "Units Validated", "Lessons Validated", "Activities Validated"],
    };
  },

};
</script>
