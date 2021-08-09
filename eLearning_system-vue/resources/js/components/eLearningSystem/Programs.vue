<template>
  <div class="container-fluid">
    <div class="row justify-content-lg-center pt-2">
      <div v-for="card in cards" :key="card.prog_id">
        <div
          class="card m-3"
          style="width: 16rem"
          v-if="card.validated == true"
        >
          <!-- Randomly pic a color for the card header every time -->
          <span class="hide">
            {{
              (temp =
                "background-color:" +
                ["#9198e5", "#e66465", "#3f87a6"][
                  Math.floor(
                    Math.random() * ["#9198e5", "#e66465", "#3f87b6"].length
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
            <div class="title-header">{{ card.prog_type }}</div>

            <hr />
            <h6>
              {{ card.prog_desc }}
            </h6>
            <a
              class="btn btn-outline-dark"
              :href="'/eLearning/program/' + card.prog_id"
              >View program</a
            >
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.title-header {
  font-size: 18px;
  font-weight: 700;
  color: #283f50;
}

.title {
  font-size: 14px;
  font-weight: 500;
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

  props: ["prog"],
  data() {
    return {
      cards: this.prog,
    };
  },
};
</script>
