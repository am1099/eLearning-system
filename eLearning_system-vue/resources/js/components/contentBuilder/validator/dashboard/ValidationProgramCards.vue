<template>
  <div class="container-fluid">
    <ul class="nav nav-tabs">
      <li class="active">
        <b-link
          class="nav-link btn-outline-primary"
          data-toggle="tab"
          href="#incomplete"
          v-model="cards"
          >Programs - Validation needed
        </b-link>
      </li>
      <div class="mr-auto">
        <li>
          <a
            class="nav-link btn-outline-success"
            data-toggle="tab"
            href="#syllabus"
            >Programs - Validated
          </a>
        </li>
      </div>
    </ul>

    <div class="tab-content pt-2">
      <div id="incomplete" class="tab-pane fade in active">
        <div class="card-deck">
          <div class="d-flex flex-row flex-nowrap overflow-auto scrollingCard">
            <b-icon
              icon="x-circle-fill"
              font-scale="3"
              variant="danger"
            ></b-icon>
            <div v-for="card in cards" :key="card">
              <div
                class="card card-block mb-3"
                style="min-width: 16rem"
                v-if="card.validated == false"
              >
                <span class="hide">
                  {{
                    (temp =
                      "background-color:" +
                      ["#9198e5", "#e66465", "#3f87a6"][
                        Math.floor(
                          Math.random() *
                            ["#9198e5", "#e66465", "#3f87b6"].length
                        )
                      ])
                  }}
                </span>

                <div class="card-header text-white text-center" :style="temp">
                  <strong class="text-left"
                    >{{ card.prog_name }} -
                    <small>{{ card.prog_difficulty }} </small></strong
                  >
                </div>

                <div class="card-body text-black text-center">
                  <button
                    type="button"
                    style="max-width: 8rem"
                    class="btn btn-outline-dark text-center m-2"
                    data-toggle="collapse"
                    data-target="#c1"
                  >
                    View stats
                  </button>
                  <div id="c1" class="collapse">
                    <hr />
                    <div class="title-header">{{ card.prog_type }}</div>

                    <hr />
                    <p class="desc">
                      {{ card.prog_desc }}
                    </p>
                    <!-- <p class="card-text">{{ card.prog_id }}</p> -->
                    <a
                      class="btn btn-outline-dark"
                      :href="'/home/program/' + card.prog_id"
                      >View program</a
                    >
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- validated programs -->
    <div class="tab-content pt-2">
      <div id="syllabus" class="tab-pane fade in active">
        <div class="card-deck">
          <div class="d-flex flex-row flex-nowrap overflow-auto scrollingCard">
            <b-icon
              icon="check-circle-fill"
              font-scale="3"
              variant="success"
            ></b-icon>
            <div v-for="card in cards" :key="card">
              <div
                class="card card-block mb-3"
                style="min-width: 16rem"
                v-if="card.validated == true"
              >
                <span class="hide">
                  {{
                    (temp =
                      "background-color:" +
                      ["#9198e5", "#e66465", "#3f87a6"][
                        Math.floor(
                          Math.random() *
                            ["#9198e5", "#e66465", "#3f87b6"].length
                        )
                      ])
                  }}
                </span>

                <div class="card-header text-white text-center" :style="temp">
                  <strong class="text-left"
                    >{{ card.prog_name }} -
                    <small>{{ card.prog_difficulty }} </small></strong
                  >
                </div>

                <div class="card-body text-black text-center">
                  <button
                    type="button"
                    style="max-width: 8rem"
                    class="btn btn-outline-dark text-center m-2"
                    data-toggle="collapse"
                    data-target="#c1"
                  >
                    View stats
                  </button>
                  <div id="c1" class="collapse">
                    <hr />
                    <div class="title-header">{{ card.prog_type }}</div>

                    <hr />
                    <p class="desc">
                      {{ card.prog_desc }}
                    </p>
                    <!-- <p class="card-text">{{ card.prog_id }}</p> -->
                    <a
                      class="btn btn-outline-dark"
                      :href="'/home/program/' + card.prog_id"
                      >View program</a
                    >
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.number {
  font-weight: 600;
  font-size: 20px;
  /* color: #6944ff; */
  color: #324e63;
}
.title-header {
  font-size: 18px;
  font-weight: 700;
  color: #283f50;
}

.title {
  font-size: 14px;
  font-weight: 500;
}

.desc {
  font-size: 16px;
  font-weight: 500;
  color: black;
  margin-top: 10px;
  /* background-color: #dfdede3f; */
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}

#pos_right {
  position: absolute;
  right: 10%;
}

.scrollingCard {
  overflow-x: hidden;
}

span.hide {
  visibility: hidden;
  display: none;
}
</style>

<script>
export default {
  mounted() {
    console.log("Component mounted.");
  },

  props: ["user", "prog"],
  data() {
    return {
      cards: this.prog,
    };
  },
  methods: {
    deleteProgram(id) {
      Vue.swal({
        title: "Are you sure you want to delete this program?",
        confirmButtonColor: "#B61D1D",
        denyButtonColor: "#0F9B92",
        showDenyButton: true,
        confirmButtonText: `Delete`,
        denyButtonText: `Cancel`,
      }).then((result) => {
        if (result.isConfirmed) {
          Vue.swal({
            icon: "success",
            text: "Program deleted successfully!!!",
          });
          axios
            .delete("/home/" + id)
            .then((res) => {
              //Perform Success Action
              window.location = "/home";
            })
            .catch((error) => {
              // error.response.status Check status code
              Vue.swal({
                icon: "error",
                title: "Oops...",
                text: "Something went wrong!",
              });
            });
        } else if (result.isDenied) {
          Vue.swal({
            icon: "warning",
            text: "Program was not deleted",
          });
        }
      });
    },
  },

};
</script>
