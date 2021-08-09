<template>
  <b-row class="justify-content-lg pb-4">
    <b-col cols="9">
      <b-card
        header="Program Details"
        header-bg-variant="dark"
        header-text-variant="white"
        align="center"
        class="shadow rounded"
      >
        <b-card-body>
          <div class="form-group">
            <div class="row justify-content-center">
              <div class="col-4 text-left">
                <label for="prog_name"><b>Program Name: </b></label>
              </div>
              <div class="col-8">
                <label class="form-control shadow-sm rounded">{{
                  form.prog_name
                }}</label>
              </div>
            </div>
            <div class="row justify-content-center pt-3 pb-3">
              <div class="col-4 text-left">
                <label for="prog_desc"><b>Program Description: </b></label>
              </div>
              <div class="col-8">
                <b-form-textarea
                  v-model="form.prog_desc"
                  rows="2"
                  max-rows="6"
                  readonly
                ></b-form-textarea>
              </div>
            </div>
          </div>
          <!-- Program type -->
          <div class="form-group">
            <div class="row justify-content-center">
              <div class="col-4 text-left">
                <label for="prog_type"><b>Program Type: </b></label>
              </div>
              <div class="col-8">
                <label class="form-control shadow-sm rounded">{{
                  form.prog_type
                }}</label>
              </div>
            </div>
          </div>
          <!-- Program difficulty -->
          <div class="form-group">
            <div class="row justify-content-center pt-3">
              <div class="col-4 text-left">
                <label for="prog_difficulty"><b>Program Difficulty: </b></label>
              </div>
              <div class="col-8">
                <label class="form-control shadow-sm rounded">{{
                  form.prog_difficulty
                }}</label>
              </div>
            </div>
          </div>
          <div class="form-group">
            <a href="/home" class="btn btn-info float-left">
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
    <!-- MODAL TO UPDATE A PROGRAM -->
    <b-modal
      id="updateProgram-modal"
      ref="updateProgram-modal"
      title="Update Program Details"
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
              <label for="prog_name"><b>Program Name: </b></label>
            </div>
            <div class="col-8">
              <b-input
                type="text"
                class="form-control shadow-sm rounded"
                name="prog_name"
                v-model="newform.prog_name"
                :class="{ 'is-invalid': newform.errors.has('prog_name') }"
                required
              />
              <has-error :form="newform" field="prog_name"></has-error>
            </div>
          </div>
          <div class="row justify-content-center pt-3 pb-3">
            <div class="col-4 text-left">
              <label for="prog_desc"><b>Program Description: </b></label>
            </div>
            <div class="col-8">
              <b-form-textarea
                type="prog_desc"
                v-model="newform.prog_desc"
                placeholder="Enter something..."
                rows="2"
                max-rows="6"
                :class="{ 'is-invalid': newform.errors.has('prog_desc') }"
                required
              ></b-form-textarea>
              <has-error :form="newform" field="prog_desc"></has-error>
            </div>
          </div>
        </div>
        <!-- Program type -->
        <div class="form-group">
          <div class="row justify-content-center pt-3 pb-3">
            <div class="col-4 text-left">
              <label for="prog_type"><b>Program Type: </b></label>
            </div>
            <div class="col-8 text-left">
              <div
                class="form-check form-check-inline"
                :class="{ 'is-invalid': newform.errors.has('prog_type') }"
              >
                <input
                  class="form-check-input"
                  type="radio"
                  name="prog_type"
                  value="Dyslexia"
                  v-model="newform.prog_type"
                />
              </div>
              <label class="form-check-label" for="prog_type">Dyslexia</label>
              <div class="form-check form-check-inline">
                <input
                  class="form-check-input"
                  type="radio"
                  name="prog_type"
                  value="Downsyndrome"
                  v-model="newform.prog_type"
                />
                <label class="form-check-label" for="prog_type"
                  >Downsyndrome</label
                >
              </div>
              <div class="form-check form-check-inline">
                <input
                  class="form-check-input"
                  type="radio"
                  name="prog_type"
                  value="Autism"
                  v-model="newform.prog_type"
                />
                <label class="form-check-label" for="prog_type">Autism</label>
              </div>
              <has-error :form="newform" field="prog_type"></has-error>
            </div>
          </div>
        </div>
        <!-- Program difficulty -->
        <div class="form-group">
          <div class="row justify-content-center pt-3">
            <div class="col-4 text-left">
              <label for="prog_difficulty"><b>Program Difficulty: </b></label>
            </div>
            <div class="col-8 text-left">
              <div
                class="form-check form-check-inline"
                :class="{ 'is-invalid': newform.errors.has('prog_difficulty') }"
              >
                <input
                  class="form-check-input"
                  type="radio"
                  name="prog_difficulty"
                  id="prog_difficulty-advanced"
                  value="Primary"
                  v-model="newform.prog_difficulty"
                />
                <label class="form-check-label" for="prog_difficulty"
                  >Primary</label
                >
              </div>
              <div class="form-check form-check-inline">
                <input
                  class="form-check-input"
                  type="radio"
                  name="prog_difficulty"
                  id="prog_difficulty-intermediet"
                  value="Elementary"
                  v-model="newform.prog_difficulty"
                />
                <label class="form-check-label" for="prog_difficulty"
                  >Elementary</label
                >
              </div>
              <div class="form-check form-check-inline">
                <input
                  class="form-check-input"
                  type="radio"
                  name="prog_difficulty"
                  id="prog_difficulty-easy"
                  value="Kindergarten"
                  v-model="newform.prog_difficulty"
                />
                <label class="form-check-label" for="prog_difficulty"
                  >Kindergarten</label
                >
              </div>
              <has-error :form="newform" field="prog_difficulty"></has-error>
            </div>
          </div>
        </div>
        <div class="form-group">
          <b-button variant="info" @click="hideModal" style="float: left">
            <b-icon icon="fullscreen-exit" font-scale="1"></b-icon>
            Cancel
          </b-button>

          <button class="btn btn-success float-right" type="submit">
            <b-icon icon="arrow-repeat" font-scale="1"></b-icon>
            Submit
          </button>
        </div>
        <b-icon
          class="pb-2"
          icon="three-dots"
          animation="cylon"
          font-scale="4"
        ></b-icon>
      </form>
    </b-modal>
    <b-col cols="3">
      <!-- Dynamic cards which will display validation of program and which user created the program -->
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
    console.log("Component mounted1.");
    console.log(this.type);
  },
  props: ["program", "user"],
  data() {
    return {
      program: this.program,
      stats: [
        { title: "Validation", stat: this.program.validated },
        { title: "Created By", stat: this.user.fullname },
      ],
      type: ["program"],
      form: {
        prog_name: this.program.prog_name,
        prog_desc: this.program.prog_desc,
        prog_type: this.program.prog_type,
        prog_difficulty: this.program.prog_difficulty,
        validated: this.program.validated,
      },
      newform: new Form({
        prog_name: this.program.prog_name,
        prog_desc: this.program.prog_desc,
        prog_type: this.program.prog_type,
        prog_difficulty: this.program.prog_difficulty,
        validated: this.program.validated,
      }),
    };
  },
  methods: {
    hideModal() {
      this.$refs["updateProgram-modal"].hide();
    },
    // updating program
    updateForm() {
      this.newform
        .post("/home/program/" + this.program.prog_id, this.newform)
        .then((res) => {
          //Perform Success Action
          Vue.swal({
            icon: "success",
            text: "Program updated successfully!!!",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "ok",
          }).then((result) => {
            if (result.isConfirmed) {
              window.location = "/home/program/" + this.program.prog_id;
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
    // sends post request to validate the program
    validation() {
      axios
        .post("/home/program/validate/" + this.program.prog_id, this.type)
        .then((res) => {
          //Perform Success Action
          Vue.swal({
            icon: "success",
            text: "Program validated successfully!!!",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "ok",
          }).then((result) => {
            if (result.isConfirmed) {
              window.location = "/home/program/" + this.program.prog_id;
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
