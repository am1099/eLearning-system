<template>
  <b-row class="justify-content-lg pb-4">
    <b-col cols="9">
      <b-card
        header="Module Details"
        header-bg-variant="dark"
        header-text-variant="white"
        align="center"
        class="shadow rounded"
      >
        <b-card-body>
          <div class="form-group">
            <div class="row justify-content-center">
              <div class="col-4 text-left">
                <label for="mod_name"><b>Module Name: </b></label>
              </div>
              <div class="col-8">
                <label class="form-control shadow-sm rounded">{{
                  form.mod_name
                }}</label>
              </div>
            </div>
            <div class="row justify-content-center pt-3 pb-3">
              <div class="col-4 text-left">
                <label for="mod_desc"><b>Module Description: </b></label>
              </div>
              <div class="col-8">
                <b-form-textarea
                  v-model="form.mod_desc"
                  rows="2"
                  max-rows="6"
                  readonly
                ></b-form-textarea>
              </div>
            </div>
          </div>

          <!-- Module difficulty -->
          <div class="form-group">
            <div class="row justify-content-center pt-3">
              <div class="col-4 text-left">
                <label for="mod_difficulty"><b>Module Difficulty: </b></label>
              </div>
              <div class="col-8">
                <label class="form-control shadow-sm rounded">{{
                  form.mod_difficulty
                }}</label>
              </div>
            </div>
          </div>
          <div class="form-group">
            <a
              :href="'/home/program/' + module.program_id"
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
                  type="submit">
                  <b-icon
                    icon="check-circle-fill"
                    font-scale="1"
                    variant="light"
                  ></b-icon>Validate
                </b-button>
              </div>
              <div v-else></div>
            </div>
            <div v-else>
              <b-button
                v-b-modal.updateModule-modal
                class="btn btn-success float-right"
                type="submit">
                <b-icon icon="arrow-repeat" font-scale="1"></b-icon>Update
              </b-button>
            </div>
          </div>
        </b-card-body>
      </b-card>
    </b-col>
    <!-- MODAL TO UPDATE A MODULE -->
    <b-modal
      id="updateModule-modal"
      ref="updateModule-modal"
      title="Update Module Details"
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
              <label for="Module"><b>Module Name: </b></label>
            </div>
            <div class="col-8">
              <b-input
                type="text"
                class="form-control shadow-sm rounded"
                name="mod_name"
                v-model="newform.mod_name"
                :class="{ 'is-invalid': newform.errors.has('mod_name') }"
                required
              />
              <has-error :form="newform" field="mod_name"></has-error>
            </div>
          </div>
          <div class="row justify-content-center pt-3 pb-3">
            <div class="col-4 text-left">
              <label for="mod_desc"><b>Module Description: </b></label>
            </div>
            <div class="col-8">
              <b-form-textarea
                v-model="newform.mod_desc"
                placeholder="Enter something..."
                rows="2"
                max-rows="6"
                :class="{ 'is-invalid': newform.errors.has('mod_desc') }"
                required
              ></b-form-textarea>
              <has-error :form="newform" field="mod_desc"></has-error>
            </div>
          </div>
        </div>
        <!-- Module difficulty -->
        <div class="form-group">
          <div class="row justify-content-center pt-3">
            <div class="col-4 text-left">
              <label for="mod_difficulty"><b>Module Difficulty: </b></label>
            </div>
            <div class="col-8 text-left">
              <div
                class="form-check form-check-inline"
                :class="{ 'is-invalid': newform.errors.has('mod_name') }"
              >
                <input
                  class="form-check-input"
                  type="radio"
                  name="mod_difficulty"
                  value="Advanced"
                  v-model="newform.mod_difficulty"
                />
                <label class="form-check-label" for="mod_difficulty"
                  >Advanced</label
                >
              </div>
              <div class="form-check form-check-inline">
                <input
                  class="form-check-input"
                  type="radio"
                  name="mod_difficulty"
                  value="Intermediet"
                  v-model="newform.mod_difficulty"
                />
                <label class="form-check-label" for="mod_difficulty"
                  >Intermediet</label
                >
              </div>
              <div class="form-check form-check-inline">
                <input
                  class="form-check-input"
                  type="radio"
                  name="mod_difficulty"
                  value="Easy"
                  v-model="newform.mod_difficulty"
                />
                <label class="form-check-label" for="mod_difficulty"
                  >Easy</label
                >
              </div>
              <has-error :form="newform" field="mod_difficulty"></has-error>
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
      <!-- Dynamic cards which will display validation of module and which user created the module -->
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
            ><img src="https://img.icons8.com/ios-filled/50/ff0000/circled-x.png"/></b-card-text>
        </div>
        <div v-else-if="info.title == 'Created By'">
          <b-card-text style="font-size: 1rem"> {{ info.stat }}</b-card-text>
          <div class="stats-line-black"></div>
          <b-card-text class="text-center">
            <strong><h5>{{ user.user_role }}</h5></strong></b-card-text>
        </div>
        <div v-else>
          <b-card-text style="font-size: 1rem"> {{ info.stat }}</b-card-text>
          <div class="stats-line-black"></div>
          <b-card-text class="text-center"><strong> {{ program.prog_name }}</strong></b-card-text>
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
  props: ["module", "user", "program"],
  data() {
    return {
      module: this.module,
      type: ["module"],
      stats: [
        { title: "Validation", stat: this.module.validated },
        { title: "Created By", stat: this.user.fullname },
        { title: "Program", stat: this.module.program_id },
      ],
      form: new Form({
        mod_name: this.module.mod_name,
        mod_desc: this.module.mod_desc,
        mod_difficulty: this.module.mod_difficulty,
        validated: this.module.validated,
      }),
      newform: new Form({
        mod_name: this.module.mod_name,
        mod_desc: this.module.mod_desc,
        mod_difficulty: this.module.mod_difficulty,
        validated: this.module.validated,
      }),
    };
  },
  methods: {
    hideModal() {
      this.$refs["updateModule-modal"].hide();
    },
    // updating moduel
    updateForm() {
      this.newform
        .post("/home/module/" + this.module.mod_id, this.newform)
        .then((res) => {
          //Perform Success Action
          Vue.swal({
            icon: "success",
            text: "Module updated successfully!!!",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "ok",
          }).then((result) => {
            if (result.isConfirmed) {
              window.location = "/home/module/" + this.module.mod_id;
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
        // sends post request to validate the module
    validation() {
      axios
        .post("/home/program/validate/" + this.module.mod_id, this.type)
        .then((res) => {
          //Perform Success Action
          Vue.swal({
            icon: "success",
            text: "Program validated successfully!!!",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "ok",
          }).then((result) => {
            if (result.isConfirmed) {
              window.location = "/home/module/" + this.module.mod_id;
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
    created() {
    },
  },
};
</script>
