<template>
  <div class="container">
    <!-- Card statistics -->
    <b-card-group deck>
      <b-card
        v-for="(s, index) in statName"
        :key="s.id"
        border-variant="dark"
        bg-variant="dark"
        text-variant="white"
        class="panel"
        style="max-height: 7rem"
      >
        <b-card-text class="text-center stat">{{ stats[index] }} </b-card-text>
        <div class="stats-line-black"></div>
        <b-card-text class="text-center small">{{ s }}</b-card-text>
      </b-card>
    </b-card-group>
    <div class="text-center pt-3">
      <a href="/program-spec" class="btn btn-info"
        ><b-icon icon="eye-fill" aria-hidden="true"></b-icon> view programs</a
      >
    </div>
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
    this.getStats();
  },
  props: [],
  data() {
    return {
      statName: [
        "Active Users",
        "Active Students",
        "Programs",
        "Validated Programs",
      ],
      stats: {},
    };
  },
  methods: {
    // method that gets all the statistics using GET request
    getStats() {
      axios
        .get("/dashboard/stats")
        .then((data) => {
          this.stats = data.data;
        })
        .catch((error) => {
          Vue.swal({
            icon: "error",
            title: "Oops...",
            text: error,
          });
        });
    },
  },
};
</script>
