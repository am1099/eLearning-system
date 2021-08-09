<template>
  <div class="container">
    <div class="column-30">
      <div class="card">
        <div class="card-header bg-light text-black">
          <strong>Validation progress: </strong>
        </div>
        <div class="card-body">
          <div class="text-center">
            <!-- Displays validation program of programs, modules, units, lessons, and activities-->
            <div v-for="(value, index) in programsValidated" :key="value.id">
              <div class="row">
                <div class="col-3 text-left">
                  <label for="disk_c">{{ statName[index] }}:</label>
                </div>
                <div class="col-9 text-left">
                  <b-progress
                    :value="value"
                    :max="value + programsUnvalidated[index]"
                    show-progress
                    animated
                  ></b-progress>
                  <br />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="column-70">
      <div class="card">
        <div class="card-header bg-light text-black">
          <strong>Notifications: </strong>
        </div>
        <div class="card-body li-n">
          <ul class="list-group list-group-flush">
            <li class="list-group-item li-n">
              Add a new module called numbers in program - PO1
            </li>
            <li class="list-group-item li-n">
              Program P342 has been full validated!!
            </li>
            <li class="list-group-item li-n">
              Unit-04 from module-02 is yet to be completed<span
                class="badge badge-pill badge-info pull-right ml-5"
              >
              </span>
            </li>
            <li class="list-group-item li-n">
              Lesson-14 from Unit-01 is yet to be completed<span
                class="badge badge-pill badge-info pull-right ml-5"
              >
              </span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
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
  background-color: #1f1f20;
  border: 1px solid #141414;
  border-radius: 7px;
  padding: 2px;
}

.column-30 {
  float: left;
  width: 30%;
  padding: 10px;
}

.column-70 {
  float: left;
  width: 70%;
  padding: 10px;
}
</style>

<script>
export default {
  mounted() {
    console.log("Component mounted.");
    this.getPrograms();
  },
  props: [""],
  data() {
    return {
      editmode: false,
      programsValidated: {},
      programsUnvalidated: {},
      statName: [
        "Programs",
        "Modules",
        "Units",
        "Lesssons",
        "Activities"
      ],
    };
  },
  methods: {
    // Gets programs, modules, units, lessons, and activities that are both validated and not validated
    getPrograms() {
      axios.get("/program-spec/validation").then((data) => {
        this.programsValidated = data.data[0];
        this.programsUnvalidated = data.data[1];
      });
    },
    calculate(index) {
      return this.programsUnvalidated[index];
    },
  },
};
</script>
