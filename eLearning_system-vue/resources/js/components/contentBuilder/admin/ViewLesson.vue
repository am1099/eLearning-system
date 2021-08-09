<template>
  <b-row class="justify-content-lg pb-4">
    <b-col cols="9">
      <b-card
        header="Lesson Details"
        header-bg-variant="dark"
        header-text-variant="white"
        align="center"
        class="shadow rounded"
      >
        <!-- Lesson view card -->
        <b-card-body>
          <div class="form-group">
            <div class="row justify-content-center">
              <div class="col-4 text-left">
                <label for="les_name"><b>Lesson Name: </b></label>
              </div>
              <div class="col-8">
                <label class="form-control shadow-sm rounded">{{
                  form.les_name
                }}</label>
              </div>
            </div>
            <div class="row justify-content-center pt-3 pb-3">
              <div class="col-4 text-left">
                <label for="les_desc"><b>Lesson Description: </b></label>
              </div>
              <div class="col-8">
                <b-form-textarea
                  v-model="form.les_desc"
                  rows="2"
                  max-rows="6"
                  readonly
                ></b-form-textarea>
              </div>
            </div>
          </div>

          <!-- Lesson difficulty -->
          <div class="form-group">
            <div class="row justify-content-center pt-3">
              <div class="col-4 text-left">
                <label for="les_difficulty"><b>Lesson Difficulty: </b></label>
              </div>
              <div class="col-8">
                <label class="form-control shadow-sm rounded">{{
                  form.les_difficulty
                }}</label>
              </div>
            </div>
          </div>
          <div class="form-group">
            <a
              :href="'/home/program/' + lesson.unit_id"
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
                v-b-modal.updateProgram-modal
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
    <!-- MODAL TO UPDATE A LESSON -->
    <b-modal
      id="updateLesson-modal"
      ref="updateLesson-modal"
      title="Update Lesson Details"
      header-bg-variant="dark"
      header-text-variant="white"
      body-bg-variant="dark"
      body-text-variant="white"
      align="center"
      size="lg"
      centered
      hide-footer
    >
      <form @submit.prevent="updateForm">
        <div class="form-group">
          <div class="row justify-content-center">
            <div class="col-4 text-left">
              <label for="les_name"><b>Lesson Name: </b></label>
            </div>
            <div class="col-8">
              <b-input
                type="text"
                class="form-control shadow-sm rounded"
                name="les_name"
                v-model="newform.les_name"
                :class="{ 'is-invalid': newform.errors.has('les_name') }"
                required
              />
              <has-error :form="newform" field="les_name"></has-error>
            </div>
          </div>
          <div class="row justify-content-center pt-3 pb-3">
            <div class="col-4 text-left">
              <label for="les_desc"><b>Lesson Description: </b></label>
            </div>
            <div class="col-8">
              <b-form-textarea
                v-model="newform.les_desc"
                placeholder="Enter description..."
                rows="2"
                max-rows="6"
                :class="{ 'is-invalid': newform.errors.has('les_desc') }"
                required
              ></b-form-textarea>
              <has-error :form="newform" field="les_desc"></has-error>
            </div>
          </div>
        </div>
        <!-- Unit difficulty -->
        <div class="form-group">
          <div class="row justify-content-center pt-3">
            <div class="col-4 text-left">
              <label for="les_difficulty"><b>Lesson Difficulty: </b></label>
            </div>
            <div class="col-8 text-left">
              <div
                class="form-check form-check-inline"
                :class="{ 'is-invalid': newform.errors.has('les_difficulty') }"
              >
                <input
                  class="form-check-input"
                  type="radio"
                  name="les_difficulty"
                  value="Advanced"
                  v-model="newform.les_difficulty"
                />
                <label class="form-check-label" for="les_difficulty"
                  >Advanced</label
                >
              </div>
              <div class="form-check form-check-inline">
                <input
                  class="form-check-input"
                  type="radio"
                  name="les_difficulty"
                  value="Intermediet"
                  v-model="newform.les_difficulty"
                />
                <label class="form-check-label" for="les_difficulty"
                  >Intermediet</label
                >
              </div>
              <div class="form-check form-check-inline">
                <input
                  class="form-check-input"
                  type="radio"
                  name="les_difficulty"
                  value="Easy"
                  v-model="newform.les_difficulty"
                />
                <label class="form-check-label" for="les_difficulty"
                  >Easy</label
                >
              </div>
              <has-error :form="newform" field="les_difficulty"></has-error>
            </div>
          </div>
        </div>
      </form>
    </b-modal>

    <!-- 3 dynamic cards displaying data from a list -->
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
            ><strong> {{ unit.unit_name }}</strong></b-card-text
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
  props: ["lesson", "user", "unit"],
  data() {
    return {
      lesson: this.lesson,
      type: ["lesson"],

      stats: [
        { title: "Validation", stat: this.lesson.validated },
        { title: "Created By", stat: this.user.fullname },
        { title: "Unit", stat: this.lesson.unit_id },
      ],
      form: new Form({
        les_name: this.lesson.les_name,
        les_desc: this.lesson.les_desc,
        les_difficulty: this.lesson.les_difficulty,
        validated: this.lesson.validated,
      }),
      newform: new Form({
        les_name: this.lesson.les_name,
        les_desc: this.lesson.les_desc,
        les_difficulty: this.lesson.les_difficulty,
        validated: this.lesson.validated,
      }),
    };
  },
  methods: {
    hideModal() {
      this.$refs["updateLesson-modal"].hide();
    },
    // updating lesson
    updateForm() {
      this.newform
        .post("/home/lesson/" + this.lesson.les_id, this.newform)
        .then((res) => {
          //Perform Success Action
          Vue.swal({
            icon: "success",
            text: "Lesson updated successfully!!!",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "ok",
          }).then((result) => {
            if (result.isConfirmed) {
              window.location = "/home/lesson/" + this.lesson.les_id;
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
    // sends post request to validate the lesson

    validation() {
      axios
        .post("/home/program/validate/" + this.lesson.les_id, this.type)
        .then((res) => {
          //Perform Success Action
          Vue.swal({
            icon: "success",
            text: "Program validated successfully!!!",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "ok",
          }).then((result) => {
            if (result.isConfirmed) {
              window.location = "/home/lesson/" + this.lesson.les_id;
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
