<template>
  <b-row class="justify-content-lg-center pb-4">
    <b-button
      v-b-modal.createModule-modal
      class="styled-button mr-auto"
      pill
      href="#"
      variant="dark"
      ><b-icon icon="plus-circle-fill" aria-hidden="true"></b-icon> New
      Module</b-button
    >
    <!-- MODAL TO ADD NEW Module -->
    <b-modal
      id="createModule-modal"
      ref="createModule-modal"
      title="New Module Details"
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
              <label for="mod_name"><b>Module Name: </b></label>
            </div>
            <div class="col-8 text-left">
              <input
                class="form-control shadow-sm rounded"
                name="mod_name"
                placeholder="Enter Module name"
                v-model="form.mod_name"
                :class="{ 'is-invalid': form.errors.has('mod_name') }"
                required
              />
              <has-error :form="form" field="mod_name"></has-error>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-4 text-left">
              <label for="mod_desc"><b>Module Description: </b></label>
            </div>
            <div class="col-8 text-left">
              <b-form-textarea
                class="form-control shadow-sm rounded"
                name="mod_desc"
                placeholder="Enter Module description"
                v-model="form.mod_desc"
                rows="3"
                max-rows="6"
                :class="{ 'is-invalid': form.errors.has('mod_desc') }"
                required
              ></b-form-textarea>
              <has-error :form="form" field="mod_desc"></has-error>
            </div>
          </div>
        </div>

        <!-- Module difficulty -->
        <div class="form-group">
          <div class="row">
            <div class="col-4 text-left">
              <label for="mod_difficulty"><b>Module Difficulty: </b></label>
            </div>
            <div class="col-8">
              <div
                class="form-check form-check-inline"
                :class="{ 'is-invalid': form.errors.has('mod_difficulty') }"
              >
                <input
                  class="form-check-input"
                  type="radio"
                  name="mod_difficulty"
                  value="Advanced"
                  v-model="form.mod_difficulty"
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
                  v-model="form.mod_difficulty"
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
                  v-model="form.mod_difficulty"
                />
                <label class="form-check-label" for="mod_difficulty"
                  >Easy</label
                >
              </div>

              <has-error :form="form" field="mod_difficulty"></has-error>
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
          <th rowspan="1">Modules</th>
          <th rowspan="2">Module name</th>
          <th rowspan="2">Module description</th>
          <th rowspan="2">Module difficulty</th>
          <th rowspan="2">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(m, index) in modules" :key="m.mod_id">
          <th class="text-center">{{ index + 1 }}</th>
          <td>{{ m.mod_name }}</td>
          <td>{{ m.mod_desc }}</td>
          <td>{{ m.mod_difficulty }}</td>
          <td>
            <div style="overflow: auto; text-align: center">
              <a
                class="btn btn-outline-success"
                :href="'/home/module/' + m.mod_id"
                ><b-icon icon="eye-fill" aria-hidden="true"></b-icon
              ></a>

              <a
                class="btn btn-outline-danger"
                v-on:click="deleteModule(m, m.mod_id)"
                href="#"
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
  props: ["modules", "program"],
  data() {
    return {
      modules: this.modules,
      form: new Form({
        mod_name: "",
        mod_desc: "",
        mod_difficulty: "",
        validated: false,
      }),
    };
  },
  methods: {
    hideModal() {
      this.$refs["createModule-modal"].hide();
    },
    // Submits new module form
    submitForm() {
      this.form
        .post("/home/program/newModule/" + this.program.prog_id, this.form)
        .then((res) => {
          //Perform Success Action
          Vue.swal({
            icon: "success",
            text: "Module submitted successfully!!!",
          });
          window.location = "/home/program/" + this.program.prog_id;
        })
        .catch((error) => {
          // error.response.status Check status code
          Vue.swal({
            icon: "error",
            title: "Oops...",
            text: "Something went wrong!",
          });
        });
    },
    // deletes module by id
    deleteModule(module, id) {
      Vue.swal({
        icon: "warning",
        title: "Are you sure you want to delete this module?",
        confirmButtonColor: "#B61D1D",
        denyButtonColor: "#0F9B92",
        showDenyButton: true,
        confirmButtonText: `Delete`,
        denyButtonText: `Cancel`,
      }).then((result) => {
        if (result.isConfirmed) {
          Vue.swal({
            icon: "success",
            text: "module deleted successfully!!!",
          });
          axios
            .delete("/home/module/" + id)
            .then((res) => {
              //Perform Success Action
              window.location = "/home/program/" + module.program_id;
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
            text: "module was not deleted",
          });
        }
      });
    },
  },
};
</script>
