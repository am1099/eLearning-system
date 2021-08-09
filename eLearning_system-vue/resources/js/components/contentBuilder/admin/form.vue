<template>
  <b-row class="justify-content-lg-center pb-4">
    <b-card
      header="New Program Form"
      header-bg-variant="dark"
      header-text-variant="white"
      align="center"
      class="shadow rounded w-75"
    >
      <b-card-body>
        <form @submit.prevent="submitForm">
          <div class="form-group">
            <div class="row justify-content-center">
              <div class="col-4 text-left">
                <label for="prog_name"><b>Program Name: </b></label>
              </div>
              <div class="col-8">
                <input
                  class="form-control shadow-sm rounded"
                  name="prog_name"
                  placeholder="Enter program name"
                  v-model="form.prog_name"
                  :class="{ 'is-invalid': form.errors.has('prog_name') }"
                  required
                  autofocus
                />
                <has-error :form="form" field="prog_name"></has-error>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row justify-content-center pt-3 pb-3">
              <div class="col-4 text-left">
                <label for="prog_desc"><b>Program Description: </b></label>
              </div>
              <div class="col-8">
                <b-form-textarea
                  type="prog_desc"
                  class="form-control shadow-sm rounded"
                  name="prog_desc"
                  placeholder="Enter program description"
                  :class="{ 'is-invalid': form.errors.has('prog_desc') }"
                  v-model="form.prog_desc"
                  required
                  rows="2"
                  max-rows="6"
                ></b-form-textarea>
                <has-error :form="form" field="prog_desc"></has-error>
              </div>
            </div>
          </div>
          <!-- Program type -->
          <div class="form-group">
            <div class="row justify-content-center pt-3 pb-3">
              <div class="col-4 text-left">
                <label for="prog_type"><b>Program type: </b></label>
              </div>
              <div class="col-8 text-left">
                <div
                  class="form-check form-check-inline"
                  :class="{ 'is-invalid': form.errors.has('prog_type') }"
                >
                  <input
                    class="form-check-input"
                    type="radio"
                    name="prog_type"
                    id="prog_type-dyslexia"
                    value="Dyslexia"
                    v-model="form.prog_type"
                  />
                  <label class="form-check-label" for="prog_type"
                    >Dyslexia</label
                  >
                </div>
                <div class="form-check form-check-inline">
                  <input
                    class="form-check-input"
                    type="radio"
                    name="prog_type"
                    id="gender-downsyndrome"
                    value="Downsyndrome"
                    v-model="form.prog_type"
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
                    id="gender-autism"
                    value="Autism"
                    v-model="form.prog_type"
                  />
                  <label class="form-check-label" for="prog_type">Autism</label>
                </div>
                <has-error :form="form" field="prog_type"></has-error>
              </div>
            </div>
          </div>
          <!-- Program difficulty -->
          <div class="form-group">
            <div class="row justify-content-center pt-3 pb-3">
              <div class="col-4 text-left">
                <label for="prog_difficulty"><b>Program Level: </b></label>
              </div>
              <div class="col-8 text-left">
                <div
                  class="form-check form-check-inline"
                  :class="{ 'is-invalid': form.errors.has('prog_difficulty') }"
                >
                  <input
                    class="form-check-input"
                    type="radio"
                    name="prog_difficulty"
                    id="prog_difficulty-advanced"
                    value="Primary"
                    v-model="form.prog_difficulty"
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
                    v-model="form.prog_difficulty"
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
                    v-model="form.prog_difficulty"
                  />
                  <label class="form-check-label" for="prog_difficulty"
                    >Kindergarten</label
                  >
                </div>
                <has-error :form="form" field="prog_difficulty"></has-error>
              </div>
            </div>
          </div>

          <div class="form-group">
            <button class="btn btn-info">
              <b-icon icon="back" font-scale="1"></b-icon>
              Back
            </button>
            <button class="btn btn-danger" type="reset">
              <b-icon icon="trash-fill" font-scale="1"></b-icon>
              Reset
            </button>
            <button class="btn btn-success" type="submit">
              <b-icon icon="check" font-scale="1"></b-icon>
              Submit
            </button>
          </div>
        </form>
      </b-card-body>
    </b-card>
  </b-row>
</template>

<style scoped>
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
    console.log("Component mounted.");
  },
  data() {
    return {
      form: new Form({
        prog_name: "",
        prog_desc: "",
        prog_type: "",
        prog_difficulty: "",
        validated: false
      }),
    };
  },
  methods: {
    submitForm() {
      // alert(JSON.stringify(this.form))
      // console.warn("HII");
      this.form
        .post("/home/newProgram", this.form)
        .then((res) => {
          //Perform Success Action
          Vue.swal({
            icon: "success",
            text: "Program submitted successfully!!!",
          });
          window.location = "/home";
        })
        .catch((error) => {
          // error.response.status Check status code
          Vue.swal({
            icon: "error",
            title: "Oops...",
            text: 'Some fields are not valid',
          });
        })
        .finally(() => {
          //Perform action in always
        });
    },
  },
};
</script>
