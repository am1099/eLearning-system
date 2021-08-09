<template>
  <div class="container-fluid">
    <div class="row justify-content-lg-center mt-3">
      <h2>{{ user.fullname }}'s Statistics!</h2>
    </div>
    <hr />
    <div class="row justify-content-center pt-2">
      <div class="col-6" v-for="s in stats" :key="s.id">
        <div class="card card-stats mb-4" show-footer-line="true">
          <!----><!----><!---->
          <div class="card-body">
            <!----><!---->
            <div class="row">
              <div class="col">
                <h5 class="card-title text-uppercase text-muted mb-0">
                  {{ s[0] }}:
                </h5>
                <span class="h2 font-weight-bold mb-0">{{ s[1] }}</span>
              </div>
            </div>
          </div>
          <!----><!----><!----><!---->
        </div>
      </div>
    </div>
    <!-- this row contains two google charts with the settings set accordingly -->
    <b-row class="justify-content-lg-center mb-5">
      <GChart
        style="width: 50%; height: 30rem"
        type="ColumnChart"
        :data="chartData1"
        :options="chartOptions"
        :resizeDebounce="500"
      />
      <GChart
        style="width: 50%; height: 30rem"
        type="ColumnChart"
        :data="chartData2"
        :options="chartOptions"
        :resizeDebounce="500"
      />
    </b-row>
  </div>
</template>

<style scoped>
</style>

<script>
export default {
  mounted() {
    console.log("Component mounted.");
    this.getStats();
  },

  props: ["user"],
  data() {
    return {
      stats: "",
      chartData1: [["Type", "Statistics"]],
      chartData2: [["Type", "Statistics"]],
      chartOptions: {
        chart: {
          title: "Company Performance",
          subtitle: "Sales, Expenses, and Profit: 2014-2017",
        },
      },
    };
  },

  methods: {
    // gets stats from controller using get request
    getStats() {
      axios.get("/eLearning/dashboard/stats/" + this.user.u_id).then((data) => {
        this.stats = data.data;
        console.log("list", this.stats[0]);
        this.fillChart();
      });
    },

    // used to fill fynamic data into google charts
    fillChart() {
      var name = [];
      var data = [];
      var tempData = [];
      for (var i = 0; i < this.stats.length - 2; i++) {
        var tempData = this.stats[i];

        this.chartData1.push(tempData);
      }

      for (var i = 3; i < this.stats.length; i++) {
        var tempData = this.stats[i];

        this.chartData2.push(tempData);
      }
      console.warn("here", data);
    },
  },
};
</script>
