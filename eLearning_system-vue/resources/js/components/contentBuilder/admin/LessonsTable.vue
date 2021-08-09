<template>
  <b-row class="justify-content-lg-center pb-4">
    <b-button
      v-b-modal.createLesson-modal
      class="styled-button mr-auto"
      pill
      href="#"
      variant="dark"
      ><b-icon icon="plus-circle-fill" aria-hidden="true"></b-icon> New
      Lesson</b-button
    >
    <!-- MODAL TO ADD NEW Lesson -->
    <b-modal
      id="createLesson-modal"
      ref="createLesson-modal"
      title="New Lesson Details"
      header-bg-variant="dark"
      header-text-variant="white"
      body-bg-variant="dark"
      body-text-variant="white"
      align="center"
      size="lg"
      centered
      hide-footer
    >
      <form @submit.prevent="submitForm">
        <div class="form-group">
          <div class="row">
            <div class="col-4 text-left">
              <label for="les_name"><b>Lesson Name: </b></label>
            </div>
            <div class="col-8 text-left">
              <input
                class="form-control shadow-sm rounded"
                name="les_name"
                placeholder="Enter lesson name"
                v-model="form.les_name"
                :class="{ 'is-invalid': form.errors.has('les_name') }"
                required
              />
              <has-error :form="form" field="les_name"></has-error>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-4 text-left">
              <label for="les_desc"><b>Lesson Description: </b></label>
            </div>
            <div class="col-8 text-left">
              <b-form-textarea
                class="form-control shadow-sm rounded"
                name="les_desc"
                placeholder="Enter Lesson description"
                v-model="form.les_desc"
                rows="3"
                max-rows="6"
                :class="{ 'is-invalid': form.errors.has('les_desc') }"
                required
              ></b-form-textarea>
              <has-error :form="form" field="les_desc"></has-error>
            </div>
          </div>
        </div>

        <!-- Lesson difficulty -->
        <div class="form-group">
          <div class="row">
            <div class="col-4 text-left">
              <label for="les_difficulty"><b>Lesson Difficulty: </b></label>
            </div>
            <div class="col-8">
              <div
                class="form-check form-check-inline"
                :class="{ 'is-invalid': form.errors.has('les_difficulty') }"
              >
                <input
                  class="form-check-input"
                  type="radio"
                  name="les_difficulty"
                  value="Advanced"
                  v-model="form.les_difficulty"
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
                  v-model="form.les_difficulty"
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
                  v-model="form.les_difficulty"
                />
                <label class="form-check-label" for="les_difficulty"
                  >Easy</label
                >
              </div>
              <has-error :form="form" field="les_difficulty"></has-error>
            </div>
          </div>
        </div>
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

    <!-- LIST OF ALL MODULES FOR A CERTAIN PROGRAM -->
    <table class="styled-table mb-5">
      <thead>
        <tr style="text-align: center">
          <th rowspan="1">Lesson</th>
          <th rowspan="2">Lesson name</th>
          <th rowspan="2">Lesson description</th>
          <th rowspan="2">Lesson difficulty</th>
          <th rowspan="2">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(l, index) in lesson" :key="l.les_id">
          <th class="text-center">{{ index + 1 }}</th>
          <td>{{ l.les_name }}</td>
          <td>{{ l.les_desc }}</td>
          <td>{{ l.les_difficulty }}</td>
          <td>
            <div style="overflow: auto; text-align: center">
              <a
                class="btn btn-outline-success"
                :href="'/home/lesson/' + l.les_id"
                ><b-icon icon="eye-fill" aria-hidden="true"></b-icon
              ></a>
              <a
                class="btn btn-outline-danger"
                v-on:click="deleteLesson(l, l.les_id)"
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
    console.log("Component mounted.");
  },
  props: ["lessons", "unit"],
  data() {
    return {
      lesson: this.lessons,
      form: new Form({
        les_name: "",
        les_desc: "",
        les_difficulty: "",
        validated: false
      }),
    };
  },
  methods: {
    hideModal() {
      this.$refs["createLesson-modal"].hide();
    },
    // submits new lesson form
    submitForm() {
      this.form
        .post("/home/unit/newLesson/" + this.unit.unit_id, this.form)
        .then((res) => {
          //Perform Success Action
          Vue.swal({
            icon: "success",
            text: "Lesson created successfully!!!",
          });
          window.location = "/home/unit/" + this.unit.unit_id;
        })
        .catch((error) => {
          // error.response.status Check status code
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
    // Deletes lesson by id
    deleteLesson(lesson, id) {
      Vue.swal({
        icon: "warning",
        title: "Are you sure you want to delete this Lesson?",
        confirmButtonColor: "#B61D1D",
        denyButtonColor: "#0F9B92",
        showDenyButton: true,
        confirmButtonText: `Delete`,
        denyButtonText: `Cancel`,
      }).then((result) => {
        if (result.isConfirmed) {
          Vue.swal({
            icon: "success",
            text: "Lesson deleted successfully!!!",
          });
          axios
            .delete("/home/lesson/" + id)
            .then((res) => {
              //Perform Success Action
              window.location = "/home/unit/" + lesson.unit_id;
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
            text: "Lesson was not deleted",
          });
        }
      });
    },
  },
};
</script>
