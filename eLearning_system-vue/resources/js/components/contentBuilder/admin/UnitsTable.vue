<template>
  <b-row class="justify-content-lg-center pb-4">
    <b-button
      v-b-modal.createUnit-modal
      class="styled-button mr-auto"
      pill
      href="#"
      variant="dark"
      ><b-icon icon="plus-circle-fill" aria-hidden="true"></b-icon> New
      Unit</b-button
    >
    <!-- MODAL TO ADD NEW Module -->
    <b-modal
      id="createUnit-modal"
      ref="createUnit-modal"
      title="New Unit Details"
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
              <label for="unit_name"><b>Unit Name: </b></label>
            </div>
            <div class="col-8 text-left">
              <input
                class="form-control shadow-sm rounded"
                name="unit_name"
                placeholder="Enter Unit name"
                v-model="form.unit_name"
                :class="{ 'is-invalid': form.errors.has('unit_name') }"
                required
              />
              <has-error :form="form" field="unit_name"></has-error>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-4 text-left">
              <label for="unit_desc"><b>Unit Description: </b></label>
            </div>
            <div class="col-8 text-left">
              <b-form-textarea
                class="form-control shadow-sm rounded"
                name="unit_desc"
                placeholder="Enter Unit description"
                v-model="form.unit_desc"
                rows="3"
                max-rows="6"
                :class="{ 'is-invalid': form.errors.has('unit_desc') }"
                required
              ></b-form-textarea>
              <has-error :form="newform" field="unit_desc"></has-error>
            </div>
          </div>
        </div>

        <!-- Unit difficulty -->
        <div class="form-group">
          <div class="row">
            <div class="col-4 text-left">
              <label for="unit_difficulty"><b>Unit Difficulty: </b></label>
            </div>
            <div class="col-8">
              <div
                class="form-check form-check-inline"
                :class="{ 'is-invalid': form.errors.has('unit_difficulty') }"
              >
                <input
                  class="form-check-input"
                  type="radio"
                  name="unit_difficulty"
                  value="Advanced"
                  v-model="form.unit_difficulty"
                />
                <label class="form-check-label" for="unit_difficulty"
                  >Advanced</label
                >
              </div>
              <div class="form-check form-check-inline">
                <input
                  class="form-check-input"
                  type="radio"
                  name="unit_difficulty"
                  value="Intermediet"
                  v-model="form.unit_difficulty"
                />
                <label class="form-check-label" for="unit_difficulty"
                  >Intermediet</label
                >
              </div>
              <div class="form-check form-check-inline">
                <input
                  class="form-check-input"
                  type="radio"
                  name="unit_difficulty"
                  value="Easy"
                  v-model="form.unit_difficulty"
                />
                <label class="form-check-label" for="unit_difficulty"
                  >Easy</label
                >
              </div>
              <has-error :form="form" field="unit_difficulty"></has-error>
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
          <th rowspan="1">Unit</th>
          <th rowspan="2">Unit name</th>
          <th rowspan="2">Unit description</th>
          <th rowspan="2">Unit difficulty</th>
          <th rowspan="2">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(u, index) in unit" :key="u.unit_id">
          <th class="text-center">{{ index + 1 }}</th>
          <td>{{ u.unit_name }}</td>
          <td>{{ u.unit_desc }}</td>
          <td>{{ u.unit_difficulty }}</td>
          <td>
            <div style="overflow: auto; text-align: center">
              <a
                class="btn btn-outline-success"
                :href="'/home/unit/' + u.unit_id"
                ><b-icon icon="eye-fill" aria-hidden="true"></b-icon
              ></a>
              <a
                class="btn btn-outline-danger"
                v-on:click="deleteUnit(u, u.unit_id)"
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
  props: ["units", "module"],
  data() {
    return {
      unit: this.units,
      form: new Form({
        unit_name: "",
        unit_desc: "",
        unit_difficulty: "",
        validated: false
      }),
    };
  },
  methods: {
    hideModal() {
      this.$refs["createUnit-modal"].hide();
    },
    // submits new unit form
    submitForm() {
      this.form
        .post("/home/module/newUnit/" + this.module.mod_id, this.form)
        .then((res) => {
          //Perform Success Action
          Vue.swal({
            icon: "success",
            text: "Unit created successfully!!!",
          });
          window.location = "/home/module/" + this.module.mod_id;
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
    // deletes unit by id
    deleteUnit(unit, id) {
      Vue.swal({
        icon: "warning",
        title: "Are you sure you want to delete this Unit?",
        confirmButtonColor: "#B61D1D",
        denyButtonColor: "#0F9B92",
        showDenyButton: true,
        confirmButtonText: `Delete`,
        denyButtonText: `Cancel`,
      }).then((result) => {
        if (result.isConfirmed) {
          Vue.swal({
            icon: "success",
            text: "Unit deleted successfully!!!",
          });
          axios
            .delete("/home/unit/" + id)
            .then((res) => {
              //Perform Success Action
              window.location = "/home/module/" + unit.module_id;
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
            text: "Unit was not deleted",
          });
        }
      });
    },
  },
};
</script>
