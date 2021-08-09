<template>
  <b-row class="justify-content-lg pb-4">
    <b-col cols="9">
      <b-card
        header="Activity Details"
        header-bg-variant="dark"
        header-text-variant="white"
        align="center"
        class="shadow rounded"
      >
        <b-card-body>
          <div class="form-group">
            <div class="row justify-content-center">
              <div class="col-4 text-left">
                <label for="act_name"><b>Activity Name: </b></label>
              </div>
              <div class="col-8">
                <label class="form-control shadow-sm rounded">{{
                  form.act_name
                }}</label>
              </div>
            </div>
            <div class="row justify-content-center pt-3 pb-3">
              <div class="col-4 text-left">
                <label for="act_desc"><b>Activity Description: </b></label>
              </div>
              <div class="col-8">
                <b-form-textarea
                  v-model="form.act_desc"
                  rows="2"
                  max-rows="6"
                  readonly
                ></b-form-textarea>
              </div>
            </div>
          </div>

          <!-- Activity difficulty -->
          <div class="form-group">
            <div class="row justify-content-center pt-3">
              <div class="col-4 text-left">
                <label for="act_difficulty"><b>Activity Difficulty: </b></label>
              </div>
              <div class="col-8">
                <label class="form-control shadow-sm rounded">{{
                  form.act_difficulty
                }}</label>
              </div>
            </div>
          </div>

          <!-- Activity question -->
          <div class="form-group">
            <div class="row justify-content-center pt-3">
              <div class="col-4 text-left">
                <label for="correct_answer"><b>Activity Question: </b></label>
              </div>
              <div class="col-8">
                <b-form-input
                  v-model="form.act_question"
                  readonly
                ></b-form-input>
              </div>
            </div>
          </div>

          <!-- Activity Correct answers -->
          <div class="form-group">
            <div class="row justify-content-center pt-3">
              <div class="col-4 text-left">
                <label for="correct_answer"
                  ><b>Activity Correct Answer(s): </b></label
                >
              </div>
              <div class="col-8">
                <b-form-textarea
                  v-model="form.correct_answer"
                  rows="2"
                  max-rows="6"
                  readonly
                ></b-form-textarea>
              </div>
            </div>
          </div>

          <!-- Activity images -->
          <div class="form-group">
            <div class="row justify-content-center pt-3">
              <div class="col-4 text-left">
                <label for="correct_answer"><b>image(s): </b></label>
              </div>
              <div class="col-8">
                <b-img
                  :src="
                    '/Activities/P' +
                    this.activity.program_id +
                    'L' +
                    this.activity.lesson_id +
                    'A' +
                    this.activity.act_id +
                    '/images/' +
                    form.act_images
                  "
                  draggable="true"
                  ondragstart="drag(event)"
                  width="200"
                  fluid
                  center
                >
                </b-img>
              </div>
            </div>
          </div>

          <!-- Activity number of keystrokes needed -->
          <div class="form-group">
            <div class="row justify-content-center pt-3">
              <div class="col-4 text-left">
                <label for="correct_answer"
                  ><b>Minimum keystrokes needed for activity: </b></label
                >
              </div>
              <div class="col-8">
                <b-input
                  v-model="newform.act_min_keystrokes"
                  readonly
                ></b-input>
              </div>
            </div>
          </div>

          <div class="form-group">
            <a
              :href="'/home/lesson/' + activity.lesson_id"
              class="btn btn-info float-left"
            >
              <b-icon icon="back" font-scale="1"></b-icon>
              Back
            </a>
            <div v-if="user.user_role == 'Validator'">
              <div v-if="this.form.validated == false">
                <b-button
                  @click="validation()"
                  class="btn btn-success float-right"
                  type="submit"
                >
                  <b-icon
                    icon="check-circle-fill"
                    font-scale="1"
                    variant="light"
                  ></b-icon>
                  Validate
                </b-button>
              </div>
              <div v-else></div>
            </div>
            <div v-else>
              <b-button
                v-b-modal.updateActivity-modal
                class="btn btn-success float-right"
                type="submit"
              >
                <b-icon icon="arrow-repeat" font-scale="1"></b-icon>
                Update
              </b-button>
            </div>
          </div>
        </b-card-body>
      </b-card>
    </b-col>
    <!-- MODAL TO UPDATE An Activity -->
    <b-modal
      id="updateActivity-modal"
      ref="updateActivity-modal"
      title="Update Activity Details"
      header-bg-variant="dark"
      header-text-variant="white"
      body-bg-variant="dark"
      body-text-variant="white"
      align="center"
      size="lg"
      centered
      hide-footer
    >
      <form @submit.prevent="updateForm" enctype="multipart/form-data">
        <div class="form-group">
          <div class="row justify-content-center">
            <div class="col-4 text-left">
              <label for="Unit"><b>Activity Name: </b></label>
            </div>
            <div class="col-8">
              <b-input
                class="form-control shadow-sm rounded"
                name="act_name"
                v-model="newform.act_name"
                :class="{ 'is-invalid': newform.errors.has('act_name') }"
                required
              />
              <has-error :newform="newform" field="act_name"></has-error>
            </div>
          </div>
          <div class="row justify-content-center pt-3 pb-3">
            <div class="col-4 text-left">
              <label for="act_desc"><b>Activity Description: </b></label>
            </div>
            <div class="col-8">
              <b-form-textarea
                v-model="newform.act_desc"
                placeholder="Enter description..."
                rows="2"
                max-rows="6"
                :class="{ 'is-invalid': newform.errors.has('act_desc') }"
                required
              ></b-form-textarea>
              <has-error :newform="newform" field="act_desc"></has-error>
            </div>
          </div>
        </div>
        <!-- Activity difficulty -->
        <div class="form-group">
          <div class="row justify-content-center pt-3">
            <div class="col-4 text-left">
              <label for="act_difficulty"><b>Activity Difficulty: </b></label>
            </div>
            <div class="col-8 text-left">
              <div
                class="form-check form-check-inline"
                :class="{ 'is-invalid': newform.errors.has('act_difficulty') }"
              >
                <input
                  class="form-check-input"
                  type="radio"
                  name="act_difficulty"
                  value="Advanced"
                  v-model="newform.act_difficulty"
                />
                <label class="form-check-label" for="act_difficulty"
                  >Advanced</label
                >
              </div>
              <div class="form-check form-check-inline">
                <input
                  class="form-check-input"
                  type="radio"
                  name="act_difficulty"
                  value="Intermediet"
                  v-model="newform.act_difficulty"
                />
                <label class="form-check-label" for="act_difficulty"
                  >Intermediet</label
                >
              </div>
              <div class="form-check form-check-inline">
                <input
                  class="form-check-input"
                  type="radio"
                  name="act_difficulty"
                  value="Easy"
                  v-model="newform.act_difficulty"
                />
                <label class="form-check-label" for="act_difficulty"
                  >Easy</label
                >
              </div>
              <has-error :newform="newform" field="act_difficulty"></has-error>
            </div>
          </div>
        </div>
        <!-- Activity Correct answers -->
        <div class="form-group">
          <div class="row justify-content-center pt-3">
            <div class="col-4 text-left">
              <label for="correct_answer"
                ><b>Activity correct_answer(s): </b></label
              >
            </div>
            <div class="col-8">
              <b-form-textarea
                v-model="newform.correct_answer"
                rows="2"
                max-rows="6"
                :class="{ 'is-invalid': newform.errors.has('correct_answer') }"
              ></b-form-textarea>
              <has-error :newform="newform" field="correct_answer"></has-error>
            </div>
          </div>
        </div>
        <!-- Activity question  -->
        <div class="form-group">
          <div class="row justify-content-center pt-3">
            <div class="col-4 text-left">
              <label for="act_question"><b> Activity question: </b></label>
            </div>
            <div class="col-8">
              <b-form-textarea
                v-model="newform.act_question"
                rows="2"
                max-rows="3"
                :class="{ 'is-invalid': newform.errors.has('act_question') }"
              ></b-form-textarea>
              <has-error :newform="newform" field="act_question"></has-error>
            </div>
          </div>
        </div>
        <!-- Minimum keystrokes needed for activity -->
        <div class="form-group">
          <div class="row justify-content-center pt-3">
            <div class="col-4 text-left">
              <label for="act_min_keystrokes	"
                ><b>Minimum keystrokes needed for activity: </b></label
              >
            </div>
            <div class="col-8">
              <b-input
                v-model="newform.act_min_keystrokes"
                type="number"
                :class="{
                  'is-invalid': newform.errors.has('act_min_keystrokes'),
                }"
              ></b-input>
              <has-error
                :newform="newform"
                field="act_min_keystrokes"
              ></has-error>
            </div>
          </div>
        </div>

        <!-- MODAL BUTTONS -->
        <div class="form-group">
          <b-button variant="info" @click="hideModal">
            <b-icon icon="fullscreen-exit" font-scale="1"></b-icon>
            Cancel
          </b-button>
          <button class="btn btn-danger" type="reset">
            <b-icon icon="arrow-clockwise" font-scale="1"></b-icon>
            Reset
          </button>
          <button class="btn btn-success" type="submit">
            <b-icon icon="check" font-scale="1"></b-icon>
            Submit
          </button>
        </div>
      </form>
    </b-modal>

    <b-col cols="3">
      <b-card
        v-for="info in stats"
        :key="info.id"
        :header="info.title"
        header-bg-variant="dark"
        header-text-variant="white"
        align="center"
        class="shadow rounded"
        style="margin: 0.5rem"
      >
        <div v-if="info.title == 'Validation'">
          <b-card-text style="font-size: 1rem" v-if="info.stat == true">
            <b-icon
              icon="check-circle-fill"
              font-scale="3"
              variant="success"
            ></b-icon
          ></b-card-text>

          <b-card-text style="font-size: 1rem" v-else
            ><img
              src="https://img.icons8.com/ios-filled/50/ff0000/circled-x.png"
          /></b-card-text>
        </div>
        <div v-else-if="info.title == 'Created By'">
          <b-card-text style="font-size: 1rem"> {{ info.stat }}</b-card-text>
          <div class="stats-line-black"></div>
          <b-card-text class="text-center">
            <strong
              ><h5>{{ user.user_role }}</h5></strong
            ></b-card-text
          >
        </div>
        <div v-else>
          <b-card-text style="font-size: 1rem"> {{ info.stat }}</b-card-text>
          <div class="stats-line-black"></div>
          <b-card-text class="text-center"
            ><strong> {{ lesson.les_name }}</strong></b-card-text
          >
        </div>
      </b-card>
    </b-col>
  </b-row>
</template>

<style scoped>
.styled-button {
  margin: 5px 10%;
  width: 15%;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}

.styled-table thead tr {
  background-color: #2b7a78;
  color: #ffffff;
  text-align: center;
  min-width: 2000px;
}

.workd {
  overflow: auto;
  width: 60px;
}

.stats-line-black {
  margin: 0 auto;
  width: 100px;
  height: 2px;
  background-color: rgb(14, 0, 0);
}
</style>

<script>
export default {
  mounted() {
    console.log("Component mounted.");
  },
  props: ["activity", "user", "lesson"],
  data() {
    return {
      activity: this.activity,
      user: this.user,
      lesson: this.lesson,
      type: ["activity"],

      form: new Form({
        act_name: this.activity.act_name,
        act_desc: this.activity.act_desc,
        correct_answer: this.activity.correct_answer,
        act_difficulty: this.activity.act_difficulty,
        act_question: this.activity.act_question,
        act_script: this.activity.act_script,
        act_images: this.activity.act_images,
        act_min_keystrokes: this.activity.act_min_keystrokes,
        validated: this.activity.validated,
      }),
      stats: [
        { title: "Validation", stat: this.activity.validated },
        { title: "Created By", stat: this.user.fullname },
        { title: "Lesson", stat: this.activity.lesson_id },
      ],
      newform: new Form({
        act_name: this.activity.act_name,
        act_desc: this.activity.act_desc,
        correct_answer: this.activity.correct_answer,
        act_difficulty: this.activity.act_difficulty,
        act_question: this.activity.act_question,
        act_script: this.activity.act_script,
        act_images: this.activity.act_images,
        act_min_keystrokes: this.activity.act_min_keystrokes,
        validated: this.activity.validated,
      }),
    };
  },
  methods: {
    hideModal() {
      this.$refs["updateActivity-modal"].hide();
    },
    // updating Activity
    updateForm() {
      this.newform
        .post("/home/activity/" + this.activity.act_id, this.newform)
        .then((res) => {
          //Perform Success Action
          Vue.swal({
            icon: "success",
            text: "activity updated successfully!!!",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "ok",
          }).then((result) => {
            if (result.isConfirmed) {
              window.location = "/home/activity/" + this.activity.act_id;
            }
          });
        })
        .catch((error) => {
          // error.response.status Check status code
          alert(error);

          Vue.swal({
            icon: "error",
            title: "Oops...",
            text: "Something went wrong!",
          });
        })
        .finally(() => {
          //Perform action in always
        });
    },
    // sends post request to validate the activity
    validation() {
      axios
        .post("/home/program/validate/" + this.activity.act_id, this.type)
        .then((res) => {
          //Perform Success Action
          Vue.swal({
            icon: "success",
            text: "Program validated successfully!!!",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "ok",
          }).then((result) => {
            if (result.isConfirmed) {
              window.location = "/home/activity/" + this.activity.act_id;
            }
          });
        })
        .catch((error) => {
          // error.response.status Check status code
        })
        .finally(() => {
          //Perform action in always
        });
    },
  },
};
</script>
