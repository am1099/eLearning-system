<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 mt-3">
        <div class="card">
          <div class="card-header head-color bg-dark">
            <b-row>
              <!-- User management table -->
              <b-col cols="8">
                <div class="text-white font-weight-bold text-left">
                  <h3>User management</h3>
                </div>
              </b-col>
              <b-col>
                <div class="text-right">
                  <!-- Button to add new user -->
                  <button
                    type="button"
                    class="btn btn-light text-black rounded-left"
                    @click="newModal"
                  >
                    <b-icon
                      class="border-right border-dark"
                      icon="plus"
                      aria-hidden="true"
                    ></b-icon>
                    <strong> Add new user</strong>
                  </button>
                </div>
              </b-col>
            </b-row>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover">
              <tr class="col table-color text-center font-weight-bolder">
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>User Role</th>
                <th>Date Of Birth</th>
                <th>Actions</th>
              </tr>
              <!-- Display all users in database -->
              <tr
                v-for="user in users"
                :key="user.u_id"
                class="text-center font-italic"
              >
                <td>{{ user.u_id }}</td>
                <td>{{ user.fullname }}</td>
                <td>{{ user.email }}</td>
                <td>{{ user.user_role }}</td>
                <td>{{ user.date_of_birth }}</td>

                <td>
                  <button
                    type="button"
                    class="btn text-white"
                    style="background-color: #43a047"
                    @click="editModal(user, user.u_id)"
                  >
                    <b-icon icon="clipboard-data" aria-hidden="true"></b-icon>
                    Edit
                  </button>
                  <button
                    class="btn text-white"
                    style="background-color: #b71c1c"
                    @click="deleteUser(user.u_id)"
                  >
                    <b-icon icon="trash-fill" aria-hidden="true"></b-icon>
                    Delete
                  </button>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- create and edit modal form -->
    <div
      class="modal fade"
      id="addNew"
      tabindex="-1"
      role="dialog"
      aria-labelledby="addNewLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" v-show="!editmode" id="addNewLabel">
              Add New user
            </h5>
            <h5 class="modal-title" v-show="editmode" id="addNewLabel">
              Update user's data
            </h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form
            method="POST"
            @submit.prevent="editmode ? updateUser() : createUser()"
            autocomplete="off"
          >
            <div class="modal-body">
              <!-- <div class="form row mb-2">
                <div class="col-3">
                  <label class="col-form-label">id: </label>
                </div>
                <div class="col">
                  <input
                    v-model="form.id"
                    type="text"
                    name="id"
                    class="form-control"
                    readonly
                  />
                </div>
              </div> -->
              <div class="form row mb-2">
                <div class="col-3">
                  <label class="col-form-label">Full Name: </label>
                </div>
                <div class="col">
                  <input
                    v-model="form.fullname"
                    type="text"
                    name="fullname"
                    placeholder="Enter name"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('fullname') }"
                  />
                  <has-error :form="form" field="fullname"></has-error>
                </div>
              </div>

              <div class="form row mb-2">
                <div class="col-3">
                  <label class="col-form-label">Email:</label>
                </div>
                <div class="col">
                  <input
                    v-model="form.email"
                    type="email"
                    name="email"
                    placeholder="Enter email"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('email') }"
                  />
                  <has-error :form="form" field="email"></has-error>
                </div>
              </div>

              <div class="form row mb-2" v-if="editmode == false">
                <div class="col-3">
                  <label class="col-form-label">Password:</label>
                </div>
                <div class="col-9">
                  <input
                    type="password"
                    name="password"
                    placeholder="Enter password"
                    v-model="form.password"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('password') }"
                  />
                  <has-error :form="form" field="password"></has-error>
                </div>
              </div>

              <div class="form row mb-2">
                <div class="col-3">
                  <label class="col-form-label">User role:</label>
                </div>
                <div class="col">
                  <select
                    v-model="form.user_role"
                    class="form-control"
                    name="user_role"
                    id="user_role"
                    :class="{ 'is-invalid': form.errors.has('user_role') }"
                  >
                    <option value="" selected>Select role</option>
                    <option value="Academic_expert">Acadamic expert</option>
                    <option value="Activity_developer">
                      Activity developer
                    </option>
                    <option value="Validator">Validator</option>
                  </select>
                  <has-error :form="form" field="user_role"></has-error>
                </div>
              </div>

              <div class="form row mb-2">
                <div class="col-3">
                  <label class="col-form-label">Date Of Birth:</label>
                </div>
                <div class="col">
                  <input
                    v-model="form.date_of_birth"
                    type="date"
                    name="date_of_birth"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('date_of_birth') }"
                  />
                  <has-error :form="form" field="date_of_birth"></has-error>
                </div>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">
                Close
              </button>
              <button v-show="editmode" type="submit" class="btn btn-success">
                Update
              </button>
              <button
                v-show="!editmode"
                @click="createUser()"
                type="submit"
                class="btn text-white"
                style="background-color: #1e88e5"
              >
                Create
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    this.getUsers();
  },
  props: [],
  data() {
    return {
      editmode: false,
      users: {},
      form: new Form({
        id: "",
        fullname: "",
        email: "",
        date_of_birth: "",
        password: "",
        user_role: "",
      }),
    };
  },

  methods: {
    //Get all users from database using axios get request
    getUsers() {
      axios.get("/dashboard/getUsers").then((data) => {
        this.users = data.data;
        console.log(this.users);
      });
    },

    //create new user using axios post request
    createUser() {
      Vue.swal({
        title: "Are you sure?",
        text: "You want to create a new user !",
        showCancelButton: true,
        confirmButtonColor: "green",
        cancelButtonColor: "#d33",
        confirmButtonText: "Create user!",
      }).then((result) => {
        if (result.isConfirmed) {
          this.form
            .post("dashboard/addNewUser", this.form)
            .then((res) => {
              console.log(res);
              $("#addNew").modal("hide");
              Vue.swal({
                icon: "success",
                text: "User created successfully!!!",
              });

              window.location = "/home";
            })
            .catch(function (err) {
              console.log(err);
            });
        }
      });
    },
    //edit user modal
    editModal(user, id) {
      this.editmode = true;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.fill(user);
      this.form.id = id;

      console.log("id: ", user);
    },
    //update user using axios post request
    updateUser() {
      axios
        .post("/dashboard/updateUser/" + this.form.id, this.form)
        .then((res) => {
          // success
          $("#addNew").modal("hide");
          Vue.swal({
            icon: "success",
            text: "User updated successfully!!!",
          });
          console.log(res);
          window.location = "/home";
        })
        .catch(function (err) {
          window.alert(err);
        });
    },
    //delete user using axios delete request
    deleteUser(id) {
      Vue.swal({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        showCancelButton: true,
        confirmButtonColor: "red",
        cancelButtonColor: "grey",
        confirmButtonText: "Delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios.delete("/dashboard/deleteUsere/" + id).then((res) => {
            console.log(res);
            $("#addNew").modal("hide");
            Vue.swal({
              icon: "success",
              text: "User deleted successfully!!!",
            });

            window.location = "/home";
          });
        }
      });
    },

    // add user modal
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#addNew").modal("show");
    },
  },
};
</script>
