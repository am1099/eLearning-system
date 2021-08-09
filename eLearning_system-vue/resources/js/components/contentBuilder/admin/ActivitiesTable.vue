<template>
  <b-row class="justify-content-lg-center pb-4">
    <b-button
      v-b-modal.createActivity-modal
      class="styled-button mr-auto"
      pill
      href="#"
      variant="dark"
      ><b-icon icon="plus-circle-fill" aria-hidden="true"></b-icon> New
      Activity</b-button
    >
    <!-- MODAL TO ADD NEW Activity -->
    <b-modal
      id="createActivity-modal"
      ref="createActivity-modal"
      title="New Activity Details"
      header-bg-variant="dark"
      header-text-variant="white"
      body-bg-variant="dark"
      body-text-variant="white"
      align="center"
      size="lg"
      centered
      hide-footer
    >
      <form @submit.prevent="submitForm" enctype="multipart/form-data">
        <div class="form-group">
          <div class="row justify-content-center">
            <div class="col-4 text-left">
              <label for="Unit"><b>Activity Name: </b></label>
            </div>
            <div class="col-8">
              <b-input
                class="form-control shadow-sm rounded"
                name="act_name"
                v-model="form.act_name"
                :class="{ 'is-invalid': form.errors.has('act_name') }"
                required
              />
              <has-error :form="form" field="act_name"></has-error>
            </div>
          </div>
          <div class="row justify-content-center pt-3 pb-3">
            <div class="col-4 text-left">
              <label for="act_desc"><b>Activity Description: </b></label>
            </div>
            <div class="col-8">
              <b-form-textarea
                v-model="form.act_desc"
                placeholder="Enter description..."
                rows="2"
                max-rows="6"
                :class="{ 'is-invalid': form.errors.has('act_desc') }"
                required
              ></b-form-textarea>
              <has-error :form="form" field="act_desc"></has-error>
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
                :class="{ 'is-invalid': form.errors.has('act_difficulty') }"
              >
                <input
                  class="form-check-input"
                  type="radio"
                  name="act_difficulty"
                  value="Advanced"
                  v-model="form.act_difficulty"
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
                  v-model="form.act_difficulty"
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
                  v-model="form.act_difficulty"
                />
                <label class="form-check-label" for="act_difficulty"
                  >Easy</label
                >
              </div>
              <has-error :form="form" field="act_difficulty"></has-error>
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
                v-model="form.correct_answer"
                rows="2"
                max-rows="6"
                :class="{ 'is-invalid': form.errors.has('correct_answer') }"
              ></b-form-textarea>
              <has-error :form="form" field="correct_answer"></has-error>
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
                v-model="form.act_question"
                rows="2"
                max-rows="3"
                :class="{ 'is-invalid': form.errors.has('act_question') }"
              ></b-form-textarea>
              <has-error :form="form" field="act_question"></has-error>
            </div>
          </div>
        </div>
        <!-- Activity source code upload -->
        <div class="form-group">
          <div class="row justify-content-center pt-3">
            <div class="col-4 text-left">
              <label for="source_code"><b>Activity source code: </b></label>
            </div>
            <div class="col-8">
              <input
                ref="script"
                @change="filesSelected"
                name="file"
                type="file"
                accept=".js, .vue"
                multiple
              />
              <p>{{ form.act_script }}</p>
            </div>
          </div>
        </div>
        <!-- Activity image uploads -->
        <div class="form-group">
          <div class="row justify-content-center pt-3">
            <div class="col-4 text-left">
              <label for="act_images	"><b>Activity image(s): </b></label>
            </div>
            <div class="col-8">
              <input
                ref="photo"
                @change="imageFilesSelected"
                name="file"
                type="file"
                accept="image/*"
                multiple
              />
              <p>{{ form.act_images }}</p>
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
                v-model="form.act_min_keystrokes"
                type="number"
                :class="{ 'is-invalid': form.errors.has('act_min_keystrokes') }"
              ></b-input>
              <has-error :form="form" field="act_min_keystrokes"></has-error>
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

    <!-- LIST OF ALL Activities FOR A CERTAIN PROGRAM -->
    <table class="styled-table mb-5">
      <thead>
        <tr style="text-align: center">
          <th rowspan="1">Activity</th>
          <th rowspan="2">Activity name</th>
          <th rowspan="2">Activity description</th>
          <th rowspan="2">Activity difficulty</th>
          <th rowspan="2">Correct Answer(s)</th>
          <th rowspan="2">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(a, index) in activity" :key="a.act_id">
          <th class="text-center">{{ index + 1 }}</th>
          <td>{{ a.act_name }}</td>
          <td>{{ a.act_desc }}</td>
          <td>{{ a.act_difficulty }}</td>
          <td>{{ a.correct_answer }}</td>
          <td>
            <div style="overflow: auto; text-align: center">
              <a
                class="btn btn-outline-success"
                :href="'/home/activity/' + a.act_id"
                ><b-icon icon="eye-fill" aria-hidden="true"></b-icon
              ></a>
              <a
                class="btn btn-outline-danger"
                v-on:click="deleteActivity(a, a.act_id)"
                ><b-icon icon="trash-fill" aria-hidden="true"></b-icon
              ></a>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </b-row>
</template>

<style scoped>
.styled-button {
  margin: 5px 2%;
  width: 15%;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}
.styled-table {
  border-collapse: collapse;
  margin: 5px 2%;
  font-size: 0.9em;
  font-family: sans-serif;
  width: 100%;
  min-width: 400px;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}

.styled-table thead tr {
  background-color: #2b7a78;
  color: #ffffff;
  text-align: center;
  min-width: 2000px;
}

.styled-table thead th {
  height: 50px;
}

.styled-table th,
.styled-table td {
  padding: 7px 10px;
}

.styled-table tbody tr,
th,
td {
  border-bottom: 1px solid #bff0e5;
  border-left: 1px solid #bff0e5;
  border-right: 1px solid #bff0e5;
}

.styled-table tbody tr:nth-of-type(even) {
  background-color: #f3f3f3;
}

.styled-table tbody tr:last-of-type {
  border-bottom: 3px solid #017c64;
}

.workd {
  overflow: auto;
  width: 60px;
}
.container {
  margin: 0 auto;
}

.small {
  font-size: 18px;
  font-weight: bold;
}

.stats-line-black {
  margin: 0 auto;
  width: 100px;
  height: 2px;
  background-color: #fff;
}
</style>

<script>
export default {
  mounted() {
    console.log("Component .");
    console.log(this.activity);
  },
  props: ["activities", "lesson"],
  data() {
    return {
      activity: this.activities,
      files: null,
      form: new Form({
        act_name: "",
        act_desc: "",
        act_difficulty: "",
        correct_answer: "",
        act_question: "",
        act_script: [],
        act_images: [],
        act_min_keystrokes: "",
        validated: false,
      }),
    };
  },
  methods: {
    hideModal() {
      this.$refs["createActivity-modal"].hide();
    },
    //gets the scripts submitted
    filesSelected(e) {
      this.form.act_script = this.$refs.script.files;
      console.log(this.form.act_script[0]);
    },
    // gets the images submitted
    imageFilesSelected(e) {
      this.form.act_images = this.$refs.photo.files;
      console.log(this.form.act_images);
    },
    submitForm() {
      let data = new FormData();

      // checking if images or scripts are empty
      if (this.form.act_script.length == 0) {
        this.form.act_script = "e";
      }
      if (this.form.act_images.length == 0) {
        this.form.act_images = "e";
      }

      // data to be sent to the controller
      data.append("act_name", this.form.act_name);
      data.append("act_desc", this.form.act_desc);
      data.append("act_difficulty", this.form.act_difficulty);
      data.append("correct_answer", this.form.correct_answer);
      data.append("act_question", this.form.act_question);
      data.append("act_script", this.form.act_script[0]);
      data.append("act_images", this.form.act_images[0]);
      data.append("act_min_keystrokes", this.form.act_min_keystrokes);
      data.append("validated", this.form.validated);

      axios
        .post("/home/lesson/newActivity/" + this.lesson.les_id, data, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((res) => {
          //Perform Success Action
          Vue.swal({
            icon: "success",
            text: "activity created successfully!!!",
          });
          // window.location = "/home/lesson/" + this.lesson.les_id;
        })
        .catch((error) => {
          // error.response.status Check status code
          Vue.swal({
            icon: "error",
            title: "Oops...",
            text: error,
          });
        })
        .finally(() => {
          //Perform action in always
        });
    },
    // delete activity by id
    deleteActivity(activity, id) {
      Vue.swal({
        icon: "warning",
        title: "Are you sure you want to delete this Activity?",
        confirmButtonColor: "#B61D1D",
        denyButtonColor: "#0F9B92",
        showDenyButton: true,
        confirmButtonText: `Delete`,
        denyButtonText: `Cancel`,
      }).then((result) => {
        if (result.isConfirmed) {
          Vue.swal({
            icon: "success",
            text: "Activity deleted successfully!!!",
          });
          axios
            .delete("/home/activity/" + id)
            .then((res) => {
              //Perform Success Action
              window.location = "/home/lesson/" + activity.lesson_id;
            })
            .catch((error) => {
              // error.response.status Check status code
              Vue.swal({
                icon: "error",
                title: "Oops...",
                text: error,
              });
            });
        } else if (result.isDenied) {
          Vue.swal({
            icon: "warning",
            text: "Activity was not deleted",
          });
        }
      });
    },
  },
};
</script>
