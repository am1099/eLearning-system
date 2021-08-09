<template>
  <div class="container-fluid">
    <div class="row">
      <!-- PROGRAM NAVIGATION SECTION  -->
      <div class="col border-right">
        <!-- Displaying program name and program hierachy below -->
        <h2 class="text-center">
          <strong style="color: #0f5298">{{ program[0].prog_name }}</strong>
          <hr />
        </h2>
        <b-tabs
          content-class="mt-3"
          align="left"
          active-nav-item-class="font-weight-bold text-info"
        >
          <div v-for="mod in module" :key="mod.mod_id">
            <b-tab :title="mod.mod_name" active>
              <div
                class="accordion"
                role="tablist"
                v-for="u in units"
                :key="u.unit_id"
              >
                <!--     Units list for each module        -->
                <div v-if="u.module_id == mod.mod_id">
                  <b-card no-body class="mb-1">
                    <b-card-header header-tag="header" class="p-1" role="tab">
                      <b-button
                        block
                        v-b-toggle:href="'accordion-' + u.unit_id"
                        style="background-color: #3c99dc"
                      >
                        <p class="text-left">
                          <strong
                            >Unit - {{ u.unit_id }}
                            <b-icon
                              icon="arrow-bar-right"
                              aria-hidden="true"
                            ></b-icon
                          ></strong>

                          {{ u.unit_name }}
                        </p>
                      </b-button>
                    </b-card-header>
                    <b-collapse
                      :id="'accordion-' + u.unit_id"
                      visible
                      accordion="my-accordion"
                      role="tabpanel"
                    >
                      <b-card-body>
                        <!--     LESSONS list for each unit        -->
                        <div
                          v-for="l in lessons"
                          :key="l.les_id"
                          class="justify-content-left accordion1"
                          role="tablist"
                        >
                          <div class="accordion-1" role="tablist">
                            <div v-if="u.unit_id == l.unit_id">
                              <b-button
                                class="mb-1"
                                block
                                v-b-toggle:href="'accordion-1-' + l.les_id"
                                style="
                                  background-color: #ffffff;
                                  color: #0f5298;
                                "
                              >
                                <p class="text-left mb-1" id="p_lesson_font">
                                  <strong
                                    >Lesson - {{ l.les_id }}
                                    <b-icon
                                      icon="arrow-bar-right"
                                      aria-hidden="true"
                                    ></b-icon
                                  ></strong>
                                  {{ l.les_name }}
                                </p>
                              </b-button>
                            </div>
                            <b-collapse
                              :id="'accordion-1-' + l.les_id"
                              accordion="lesson-accordion"
                              role="tabpanel"
                            >
                              <!--     ACTIVITIES list for each lesson        -->

                              <ul v-for="a in activities" :key="a.act_id">
                                <div v-if="l.les_id == a.lesson_id">
                                  <li>
                                    <p class="text-left" id="p_lesson_font">
                                      <strong
                                        >Activity - {{ a.act_id }}
                                        <b-icon
                                          icon="arrow-bar-right"
                                          aria-hidden="true"
                                        ></b-icon
                                      ></strong>
                                      <b-button
                                        @click="activityId(a.act_id)"
                                        :id="a.act_id"
                                      >
                                        {{ a.act_name }}
                                      </b-button>
                                    </p>
                                  </li>
                                </div>
                              </ul>
                            </b-collapse>
                          </div>
                        </div>
                      </b-card-body>
                    </b-collapse>
                  </b-card>
                </div>
              </div>
            </b-tab>
          </div>
        </b-tabs>
      </div>

      <!-- ACTIVITY SECTION  -->
      <div class="col-7 border-right">
        <!-- ACTIVITY LABELS -->
        <div>
          <b-row class="justify-content-center pt-2">
            <b-card
              style="width: 8rem; height: 6.5rem"
              class="text-center mr-2"
              id="activityVariables"
              header="SCORE"
              header-bg-variant="info"
              header-text-variant="white"
              header-class="h-size"
            >
              <b-card-text class="pb-4"
                ><h5 id="activityScore">0</h5></b-card-text
              >
            </b-card>

            <b-card
              style="width: 8rem; height: 6.5rem"
              class="text-center mr-2"
              header="TRIES"
              header-bg-variant="warning"
              header-text-variant="white"
              header-class="h-size"
            >
              <b-card-text class="pb-4"
                ><h5 id="activityTries">0</h5></b-card-text
              >
            </b-card>

            <b-card
              style="width: 8rem; height: 6.5rem"
              class="text-center mr-2"
              id="activityVariables"
              header="TIMER"
              header-bg-variant="danger"
              header-text-variant="white"
              header-class="h-size"
            >
              <!-- Start timer when activity begins -->
              <b-card-text v-if="activeActivity == true" class="pb-4"
                ><h5>
                  <!-- Component imported in order to display timer countDown -->
                  <vac ref="timer" :end-time="new Date().getTime() + 600000">
                    <template v-slot:process="{ timeObj }">
                      <h5 id="timerLeft">{{ `${timeObj.m}:${timeObj.s}` }}</h5>
                    </template>
                    <template v-slot:finish>
                      <span>Time is up!!</span>
                    </template>
                  </vac>
                </h5></b-card-text
              >
            </b-card>

            <b-card
              style="width: 12rem; height: 6.5rem"
              class="text-center mr-2"
              id="activityVariables"
              header="Concentration Level %"
              header-bg-variant="dark"
              header-text-variant="white"
              header-class="h-size"
            >
              <b-card-text id="concentrationLevel" class="pb-4"
                ><h5></h5
              ></b-card-text>
            </b-card>

            <b-card
              style="max-width: 12rem; height: 6.5rem"
              class="text-center mr-2"
              id="activityVariables"
              header="Keystroke Rate"
              header-bg-variant="success"
              header-text-variant="white"
              header-class="h-size"
            >
              <b-card-text id="concentrationKeystrokeLevel" class="pb-4"
                ><h5>75%</h5></b-card-text
              >
            </b-card>
          </b-row>
        </div>
        <!-- ACTIVTY BELOW -->
        <div v-on:click="strokeCount += 1" class="Activity">
          <!-- Check if activity 1 or 2 have been clicked on -->
          <div v-if="activeActivity == true">
            <div v-if="this.currentActivity == this.activities[0].act_id - 1">
              <activity-one
                ref="act0"
                :activity="this.activities[this.currentActivity]"
                :id="this.currentActivity"
              ></activity-one>
            </div>
            <div
              v-else-if="this.currentActivity == this.activities[1].act_id - 1"
            >
              <activity-one
                ref="act1"
                :activity="this.activities[this.currentActivity]"
              ></activity-one>
            </div>
          </div>
        </div>

        <!-- Activity buttons at the bottom -->
        <div v-if="activeActivity == true">
          <b-row class="mb-5">
            <b-col lg="6" class="text-left pb-2"
              ><b-button
                variant="info"
                @click="
                  nextActivity = false;
                  activityId(currentActivity);
                "
                >Previous Activity</b-button
              ></b-col
            >
            <b-col lg="6" class="text-right pb-2"
              ><b-button
                variant="info"
                @click="
                  nextActivity = true;
                  activityId(currentActivity);
                "
                >Next Activity</b-button
              ></b-col
            >
          </b-row>
        </div>
      </div>

      <!-- AI CONCENTRATION ASSESSMENT SECTION  -->
      <div class="col">
        <!-- USER ASSESMENT -->
        <div class="shadow">
          <h2 class="text-center pt-2">
            <strong style="color: #0f5298">Assessment</strong>
          </h2>

          <div id="detection"></div>
          <video id="video" width="360" height="270" autoplay muted></video>
          <h6 class="text-left underline pt-3 pl-2">
            <strong class="assessment_headings">Status: </strong>
            <label style="font-size: 1.1rem" id="expressionStatus"></label>
          </h6>

          <h6 class="text-left underline pt-3 pl-2">
            <strong class="assessment_headings">Detection Rate: </strong>
            <label style="font-size: 1.1rem" id="detectionRate"
              >2 Seconds per detection</label
            >
          </h6>

          <h6 class="text-center underlineCon pt-3 pl-2 pb-2">
            <label class="conLevel" id="concentrationLevel1"></label>

            <strong class="assessment_headings"
              >Session Concentration Level
            </strong>
          </h6>
        </div>
        <!-- KEYSTROKE ASSESMENT -->
        <div class="shadow mb-4">
          <h2 class="text-center pt-4">
            <strong style="color: #0f5298">Keystroke Assessment</strong>
          </h2>
          <h6 class="text-left underline pl-2 pt-2">
            <strong class="assessment_headings">Keystrokes: </strong>
            <label style="font-size: 1.1rem">{{ strokeCount }}</label>
          </h6>

          <h6 class="text-left underline pt-3 pl-2">
            <strong class="assessment_headings">Keystroke Rate: </strong>
            <label style="font-size: 1.1rem" id="keystrokeRate">
              ({{ strokeCount }}/10) -> 70%
            </label>
          </h6>

          <h6 class="text-center underlineCon pt-3 pl-2 pb-2">
            <label class="conLevel" id="concentrationLevel">%75</label>

            <strong class="assessment_headings"
              >Keystroke Concentration Level
            </strong>
          </h6>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.h-size {
  padding: 0.1rem;
}

.shadow {
  box-shadow: 5px 10px 18px #888888;
}

.conLevel {
  display: block;
  font-size: 1.3rem;
  color: #344f64;
}

.assessment_headings {
  color: #343a40;
  font-size: 1.2rem;
}

.underline:before {
  content: "";
  position: absolute;
  left: 0;
  display: inline-block;
  height: 1.1em;
  width: 70%;
  border-bottom: 2px solid;
  color: rgb(153, 152, 152);
  margin-top: 10px;
  margin-left: 1rem;
  opacity: 10%;
}

.underlineCon:after {
  content: "";
  position: center;
  left: 0;
  display: inline-block;
  height: 0.5em;
  width: 70%;
  border-bottom: 2px solid;
  color: #66d3fa;
  margin-top: 5px;
  margin-left: 1rem;
  opacity: 0;
  -webkit-transition: opacity 0.35s, -webkit-transform 0.35s;
  transition: opacity 0.45s, transform 0.45s;
  -webkit-transform: scale(0, 1);
  transform: scale(0, 1);
}

.underline:after {
  content: "";
  position: absolute;
  left: 0;
  display: inline-block;
  height: 1.1em;
  width: 70%;
  border-bottom: 2px solid;
  color: #66d3fa;
  margin-top: 10px;
  margin-left: 1rem;
  opacity: 0;
  -webkit-transition: opacity 0.35s, -webkit-transform 0.35s;
  transition: opacity 0.45s, transform 0.45s;
  -webkit-transform: scale(0, 1);
  transform: scale(0, 1);
}

.underline:hover:after {
  color: #0f5298;
  opacity: 1;
  -webkit-transform: scale(1);
  transform: scale(1);
}

.underlineCon:hover:after {
  color: #0f5298;
  opacity: 1;
  -webkit-transform: scale(1);
  transform: scale(1);
}

canvas {
  margin: 0;
  padding: 0;
}

#video {
  margin: 0;
  padding: 0;
  padding-top: 0.1rem;
}

.Activity {
  border: 1px solid #0c476e;
  width: 100%;
  margin: 5px;
}

p,
hr {
  margin: 0;
  padding: 0;
}

/* #divider {
  background-color: #fff;
  height: 0.1em;
  width: 100%;
} */

#activityVariables {
  font-size: 1.1rem;
  font-weight: bolder;
  border-radius: 5px;
}

#p_lesson_font {
  font-size: 0.9em;
}
.number {
  font-weight: 600;
  font-size: 20px;
  color: #324e63;
}
.title-header {
  font-size: 18px;
  font-weight: 700;
  color: #283f50;
}

.title {
  font-size: 14px;
  font-weight: 500;
}

span.hide {
  visibility: hidden;
  display: none;
}
</style>


<script>
export default {
  mounted() {
    console.log("Component mounted.");
  },

  props: ["program", "modules", "units", "lessons", "activities"],
  data() {
    return {
      time: "00:00",
      program: this.program,
      module: this.modules,
      unit: this.units,
      lesson: this.lessons,
      activities: this.activities,
      currentActivity: -1,
      activeActivity: false,
      strokeCount: 0,
      nextActivity: false,
    };
  },

  methods: {
    activityId(id) {
      if (this.nextActivity) {
        this.currentActivity = id + 1;
      } else {
        this.currentActivity = id - 1;
      }

      // making sure activity selected is only between available activities
      if (this.currentActivity < 0) {
        //play the last activity if user clicks on previous activity and is on the first activity
        this.currentActivity = this.activities.length - 1;
      } else if (this.currentActivity > this.activities.length - 1) {
        //play the first activity if the user is on the last one
        this.currentActivity = 0;
      }
      // Set to true so activity can be displayed and timer can begin
      this.activeActivity = true;
      Vue.swal({
        icon: "info",
        text: "Are you ready to start this Activity!",
        confirmButtonColor: "#3085d6",
        confirmButtonText: "yes",
      }).then((result) => {
        if (result.isConfirmed) {
          // Run functions from child component to begin activity
          this.$refs["act" + this.currentActivity].runMethods();
        }
      });
    },
  },
};
</script>
