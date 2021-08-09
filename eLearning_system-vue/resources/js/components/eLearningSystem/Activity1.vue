<template>
  <div class="container-fluid" :style="'background-color:' + bgColorSelected">
    <b-row class="mb-1 border-bottom" style="background-color: #d5f3fe">
      <!-- Activity display -->
      <div class="col-8 mt-2">
        <b-row>
          <h3 class="ml-2">
            {{
              this.$parent.activities[this.$parent.currentActivity].act_question
            }}
          </h3>
          <b-icon
            class="rounded ml-2 pb-2"
            font-scale="3"
            variant="warning"
            @click="playSound()"
            icon="volume-up-fill"
            aria-hidden="true"
          ></b-icon>
        </b-row>
      </div>
      <div class="col-4 text-right mt-2">
        <b-button ref="buttonCol" id="popover-color" variant="primary"
          >Color</b-button
        >
        <b-popover
          target="popover-color"
          triggers="click"
          :show.sync="popoverShow"
          placement="auto"
          container="my-container"
          ref="popover"
        >
          <template #title>
            <b-button @click="onClose" class="close" aria-label="Close">
              <span class="d-inline-block" aria-hidden="true">&times;</span>
            </b-button>
            Color Scheme
          </template>

          <div>
            <label><strong>Activity Background: </strong></label>
            <input
              v-b-tooltip.hover
              title="Background color of the entire activity"
              type="color"
              v-model="bgColorSelected"
              value="#ffffff"
            /><br />
            <label><strong>Box Color:</strong></label>
            <input
              v-b-tooltip.hover
              title="Background color of Answer boxes"
              type="color"
              v-model="divBgColorSelected"
              value="#ffffff"
            />
            <br />
            <label><strong>Text Color: </strong></label>
            <input
              v-b-tooltip.hover
              title="Background color of Text/Number"
              type="color"
              v-model="TNColorSelected"
              value="#ffffff"
            />
          </div>
        </b-popover>

        <b-button variant="primary"
          ><b-icon
            @click="playSound()"
            variant="light"
            font-scale="1.5"
            icon="question-octagon-fill"
          ></b-icon
        ></b-button>
        <b-button
          variant="primary"
          v-b-popover.hover.bottom="{
            variant: 'light',
            content: this.$parent.activities[this.$parent.currentActivity]
              .act_desc,
          }"
          title="Activity Description"
          >Support</b-button
        >
      </div>
    </b-row>

    <b-row class="mb-4">
      <!-- IMAGE THAT WILL BE ON TOP -->
      <div
        class="images justify-content-center"
        id="originalZone"
        ondrop="drop(event)"
        ondragover="allowDrop(event)"
      >
        <b-img
          :id="'exI' + selectedImage[1]"
          :src="selectedImage[0]"
          draggable="true"
          ondragstart="drag(event)"
          width="200"
          fluid
          center
        >
        </b-img>
      </div>
    </b-row>

    <b-row class="justify-content-center">
      <!-- BOX 1 - POSSIBLE ANSWER -->
      <div
        class="mr-4"
        id="boxOne-outer"
        :style="'background-color:' + divBgColorSelected"
      >
        <svg
          version="1.2"
          baseProfile="tiny-ps"
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 200 200"
          width="200"
          height="200"
          id="ex1"
        >
          <!-- <defs>
              <image
                width="472"
                height="500"
                id="img1"
                href="/images/apple1.png"
                draggable="true"
                ondragstart="drag(event)"
              />
            </defs> 

            <use
              id="ex1I"
              href="#img1"
              style="display: block"
              transform="matrix(0.318,0,0,0.3,25,25)"
            /> -->
          <path
            id="exT1"
            style="display: block"
            :fill="TNColorSelected"
            aria-label="ONE"
            d="M37.46 72.41Q27.8 72.41 22.08 79.62Q16.41 86.82 16.41 99.26Q16.41 111.65 22.08 118.86Q27.8 126.07 37.46 126.07Q47.13 126.07 52.76 118.86Q58.43 111.65 58.43 99.26Q58.43 86.82 52.76 79.62Q47.13 72.41 37.46 72.41ZM37.46 65.2Q51.26 65.2 59.52 74.48Q67.79 83.7 67.79 99.26Q67.79 114.77 59.52 124.05Q51.26 133.27 37.46 133.27Q23.62 133.27 15.32 124.05Q7.05 114.82 7.05 99.26Q7.05 83.7 15.32 74.48Q23.62 65.2 37.46 65.2ZM81.67 132L81.67 66.39L93.63 66.39L122.72 121.28L122.72 66.39L131.33 66.39L131.33 132L119.38 132L90.29 77.11L90.29 132L81.67 132ZM149 132L149 66.39L190.48 66.39L190.48 73.86L157.87 73.86L157.87 93.28L189.12 93.28L189.12 100.75L157.87 100.75L157.87 124.53L191.27 124.53L191.27 132L149 132Z"
          />
          <path
            id="exN1"
            style="display: none"
            fill="#000000"
            aria-label="1"
            d="M80.16 133L80.16 125.53L94.66 125.53L94.66 75.48L78.89 78.64L78.89 70.55L94.58 67.39L103.45 67.39L103.45 125.53L117.96 125.53L117.96 133L80.16 133Z"
          />
        </svg>

        <div
          id="boxOne-inner"
          ondrop="drop(event)"
          ondragover="allowDrop(event)"
        ></div>
      </div>
      <!-- BOX 2 - POSSIBLE ANSWER -->
      <div
        class="mr-4"
        id="boxTwo-outer"
        :style="'background-color:' + divBgColorSelected"
      >
        <svg
          version="1.2"
          baseProfile="tiny-ps"
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 200 200"
          width="200"
          height="200"
          id="ex2"
        >
          <path
            id="exT2"
            :fill="TNColorSelected"
            aria-label="TWO"
            style="display: block"
            d="M6.77 79.32L6.77 72.68L56.1 72.68L56.1 79.32L35.4 79.32L35.4 131L27.47 131L27.47 79.32L6.77 79.32ZM73.13 131L58.52 72.68L66.49 72.68L78.76 121.98L90.98 72.68L99.85 72.68L112.12 121.98L124.34 72.68L132.35 72.68L117.7 131L107.78 131L95.48 80.38L83.05 131L73.13 131ZM166.49 78.03Q157.9 78.03 152.82 84.44Q147.78 90.84 147.78 101.9Q147.78 112.91 152.82 119.32Q157.9 125.73 166.49 125.73Q175.09 125.73 180.09 119.32Q185.13 112.91 185.13 101.9Q185.13 90.84 180.09 84.44Q175.09 78.03 166.49 78.03ZM166.49 71.63Q178.76 71.63 186.1 79.87Q193.45 88.07 193.45 101.9Q193.45 115.69 186.1 123.93Q178.76 132.13 166.49 132.13Q154.19 132.13 146.8 123.93Q139.46 115.73 139.46 101.9Q139.46 88.07 146.8 79.87Q154.19 71.63 166.49 71.63Z"
          />
          <path
            id="exN2"
            fill="#000000"
            aria-label="2"
            style="display: none"
            d="M91.35 123.36L118.89 123.36L118.89 130L81.86 130L81.86 123.36Q86.35 118.71 94.09 110.9Q101.86 103.05 103.85 100.78Q107.64 96.52 109.13 93.59Q110.65 90.63 110.65 87.77Q110.65 83.13 107.37 80.2Q104.13 77.27 98.89 77.27Q95.18 77.27 91.04 78.55Q86.94 79.84 82.25 82.46L82.25 74.49Q87.02 72.58 91.16 71.6Q95.3 70.63 98.73 70.63Q107.8 70.63 113.19 75.16Q118.58 79.69 118.58 87.27Q118.58 90.86 117.21 94.1Q115.88 97.3 112.33 101.68Q111.35 102.81 106.12 108.24Q100.88 113.63 91.35 123.36Z"
          />
        </svg>
        <div
          id="boxTwo-inner"
          ondrop="drop(event)"
          ondragover="allowDrop(event)"
        ></div>
      </div>
      <!-- BOX 3 - POSSIBLE ANSWER -->
      <div
        class="mr-4"
        id="boxThree-outer"
        :style="'background-color:' + divBgColorSelected"
      >
        <svg
          version="1.2"
          baseProfile="tiny-ps"
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 200 200"
          width="200"
          height="200"
          id="ex3"
        >
          <path
            id="exT3"
            :fill="TNColorSelected"
            aria-label="THREE"
            style="display: block"
            d="M0.82 83.24L0.82 78.26L37.83 78.26L37.83 83.24L22.3 83.24L22.3 122L16.35 122L16.35 83.24L0.82 83.24ZM43.54 122L43.54 78.26L49.46 78.26L49.46 96.19L70.96 96.19L70.96 78.26L76.88 78.26L76.88 122L70.96 122L70.96 101.17L49.46 101.17L49.46 122L43.54 122ZM109.4 101.49Q111.3 102.14 113.09 104.25Q114.91 106.36 116.72 110.05L122.73 122L116.37 122L110.78 110.78Q108.61 106.38 106.56 104.95Q104.54 103.51 101.02 103.51L94.57 103.51L94.57 122L88.66 122L88.66 78.26L102.02 78.26Q109.52 78.26 113.21 81.39Q116.9 84.53 116.9 90.86Q116.9 94.99 114.96 97.71Q113.06 100.44 109.4 101.49ZM102.02 83.12L94.57 83.12L94.57 98.65L102.02 98.65Q106.29 98.65 108.46 96.69Q110.66 94.7 110.66 90.86Q110.66 87.02 108.46 85.09Q106.29 83.12 102.02 83.12ZM130.35 122L130.35 78.26L158 78.26L158 83.24L136.26 83.24L136.26 96.19L157.09 96.19L157.09 101.17L136.26 101.17L136.26 117.02L158.53 117.02L158.53 122L130.35 122ZM168.26 122L168.26 78.26L195.91 78.26L195.91 83.24L174.17 83.24L174.17 96.19L195 96.19L195 101.17L174.17 101.17L174.17 117.02L196.44 117.02L196.44 122L168.26 122Z"
          />
          <path
            id="exN3"
            fill="#000000"
            aria-label="3"
            style="display: none"
            d="M108.46 98.55Q114.13 99.77 117.29 103.59Q120.49 107.42 120.49 113.05Q120.49 121.68 114.55 126.41Q108.62 131.13 97.68 131.13Q94.01 131.13 90.1 130.43Q86.23 129.69 82.09 128.24L82.09 120.63Q85.38 122.54 89.28 123.52Q93.19 124.49 97.45 124.49Q104.87 124.49 108.73 121.56Q112.64 118.63 112.64 113.05Q112.64 107.89 109.01 105Q105.41 102.07 98.97 102.07L92.17 102.07L92.17 95.59L99.28 95.59Q105.1 95.59 108.19 93.28Q111.27 90.94 111.27 86.56Q111.27 82.07 108.07 79.69Q104.91 77.27 98.97 77.27Q95.73 77.27 92.02 77.97Q88.3 78.67 83.85 80.16L83.85 73.13Q88.34 71.88 92.25 71.25Q96.2 70.63 99.67 70.63Q108.66 70.63 113.89 74.73Q119.13 78.79 119.13 85.74Q119.13 90.59 116.35 93.95Q113.58 97.27 108.46 98.55Z"
          />
        </svg>
        <div
          id="boxThree-inner"
          ondrop="drop(event)"
          ondragover="allowDrop(event)"
        ></div>
      </div>
    </b-row>
    <b-row class="justify-content-center pt-2">
      <b-button
        class="mb-3"
        variant="success"
        size="lg"
        type="submit"
        @click="rightAnswerCheck()"
        >Submit</b-button
      >
    </b-row>
  </div>
</template>

<style scoped>
.images {
  position: relative;
  /* height: 15em; */
  margin: 0 auto;
  overflow: hidden;
  width: 200px;
}

#dropZone,
#originalZone {
  display: flex;
  flex-flow: row nowrap;
  /* justify-content: space-between; */
  height: 200px;
  width: 200px;
  margin-bottom: 20px;
  margin-top: 20px;
  /* border: 1px solid #0000ff; */
}
#boxOne-outer,
#boxTwo-outer,
#boxThree-outer {
  display: flex;
  flex-flow: column nowrap;
  justify-content: center;
  align-items: center;
  height: 250px;
  width: 200px;
  border: 1px solid #aaaaaa;
  border-radius: 10px;
  padding: 1rem;
}

#boxOne-inner,
#boxTwo-inner,
#boxThree-inner {
  display: flex;
  flex-flow: column nowrap;
  justify-content: center;
  align-items: center;
  height: 150px;
  width: 150px;
  border: 1px solid #aaaaaa;
  border-radius: 10px;
  padding: 1rem;
}
</style>

<script>
export default {
  mounted() {
    console.log("Component mounted. hnaa");
    document.getElementById("exI" + this.selectedImage[1]).style.cursor =
      "pointer";

    this.runMethods();
  },

  props: ["activity", "id"],
  data() {
    return {
      bgColorSelected: "#EDD1B0",
      divBgColorSelected: "#EDD1B0",
      TNColorSelected: "#000000",
      exercise1Success: false,
      exercise2Success: false,
      exercise3Success: false,
      score: 0,
      tries: 0,
      timer: 0,
      popoverShow: false,

      images: [
        ["/images/apple1.png", 1],
        ["/images/apple2.png", 2],
        ["/images/apple3.png", 3],
      ],
      selectedImage: "",
    };
  },

  methods: {
    onClose() {
      this.popoverShow = false;
    },
    // Function that checks for correct and incorrect answers as well as when teh activity will finish
    rightAnswerCheck() {
      console.log(this.$parent.currentActivity);

      // divs of the possible answers
      const box1Outer = document.getElementById("boxOne-outer");
      const box1Inner = document.getElementById("boxOne-inner");
      const box2Outer = document.getElementById("boxTwo-outer");
      const box2Inner = document.getElementById("boxTwo-inner");
      const box3Outer = document.getElementById("boxThree-outer");
      const box3Inner = document.getElementById("boxThree-inner");

      var answer = document.getElementById("exI" + this.selectedImage[1]);
      // get SVG element by id then access its content
      var a = document.getElementById("ex" + this.selectedImage[1]);
      var rightAnswer1 = a.getElementById("exT" + this.selectedImage[1]);
      var rightAnswer2 = a.getElementById("exN" + this.selectedImage[1]);

      // return image to original zone
      var originalZone = document.getElementById("originalZone");
      var image = document.getElementById("exI" + this.selectedImage[1]);

      console.log(rightAnswer1);

      // Checking if the answer is in box 1
      if (
        box1Inner.contains(answer) &&
        (box1Outer.contains(rightAnswer1) || box1Outer.contains(rightAnswer2))
      ) {
        // swal pop if correct
        Vue.swal({
          icon: "success",
          title: "Well done! That's correct!",
          showConfirmButton: false,
          timer: 1500,
        });

        this.activity1Success = true;
        this.score += 20;
        this.tries++;
        // if score greater than 100 then max limit is 100
        if (this.score >= 100) {
          this.score = 100;
          document.getElementById("activityScore").innerHTML = this.score;
          Vue.swal({
            icon: "success",
            title: "Well done! You've completed this exercise!",
            showConfirmButton: false,
            timer: 3000,
          });
          this.storeActivityProgress();
          this.score = 0;
          this.tries = 0;
          this.$parent.currentActivity++;
          //   window.location.href = "/eLearning/home";
        } else if (this.tries == 15) {
          Vue.swal({
            icon: "info",
            title:
              "You have reached the limit of number of tries. You've completed this exercise!",
            showConfirmButton: false,
            timer: 3000,
          });
          this.storeActivityProgress();
          this.score = 0;
          this.tries = 0;
          this.$parent.currentActivity++;
        }

        document.getElementById("activityScore").innerHTML = this.score;
        document.getElementById("activityTries").innerHTML = this.tries;
        // after submitted asnwer randomise the image on top and the position of the svgs
        this.selectRandomImage();
        this.randomDivPosition();
        originalZone.appendChild(image);
        // Checking if the answer is in box 2
      } else if (
        box2Inner.contains(answer) &&
        (box2Outer.contains(rightAnswer1) || box2Outer.contains(rightAnswer2))
      ) {
        // swal pop if correct
        Vue.swal({
          icon: "success",
          title: "Well done! That's correct!",
          showConfirmButton: false,
          timer: 1500,
        });

        this.exercise1Success = true;
        this.score += 20;
        this.tries++;

        if (this.score >= 100) {
          this.score = 100;
          document.getElementById("activityScore").innerHTML = this.score;
          Vue.swal({
            icon: "success",
            title: "Well done! You've completed this exercise!",
            showConfirmButton: false,
            timer: 3000,
          });
          this.storeActivityProgress();
          this.score = 0;
          this.tries = 0;
        } else if (this.tries == 15) {
          Vue.swal({
            icon: "info",
            title:
              "You have reached the limit of number of tries. You've completed this exercise!",
            showConfirmButton: false,
            timer: 3000,
          });
          this.storeActivityProgress();
          this.score = 0;
          this.tries = 0;
          this.$parent.currentActivity++;
        }
        document.getElementById("activityScore").innerHTML = this.score;
        document.getElementById("activityTries").innerHTML = this.tries;

        this.selectRandomImage();
        this.randomDivPosition();
        originalZone.appendChild(image);
        // Checking if the answer is in box 3
      } else if (
        box3Inner.contains(answer) &&
        (box3Outer.contains(rightAnswer1) || box3Outer.contains(rightAnswer2))
      ) {
        // swal pop if correct
        Vue.swal({
          icon: "success",
          title: "Well done! That's correct!",
          showConfirmButton: false,
          timer: 1500,
        });

        this.activity1Success = true;
        this.score += 20;
        this.tries++;

        if (this.score >= 100) {
          this.score = 100;
          document.getElementById("activityScore").innerHTML = this.score;
          Vue.swal({
            icon: "success",
            title: "Well done! You've completed this exercise!",
            showConfirmButton: false,
            timer: 3000,
          });
          this.storeActivityProgress();
          this.score = 0;
          this.tries = 0;
        } else if (this.tries == 15) {
          Vue.swal({
            icon: "info",
            title:
              "You have reached the limit of number of tries. You've completed this exercise!",
            showConfirmButton: false,
            timer: 3000,
          });
          this.storeActivityProgress();
          this.score = 0;
          this.tries = 0;
          this.$parent.currentActivity++;
        }
        document.getElementById("activityScore").innerHTML = this.score;
        document.getElementById("activityTries").innerHTML = this.tries;

        this.selectRandomImage();
        this.randomDivPosition();
        originalZone.appendChild(image);
      } else {
        // swal pop if not correct
        Vue.swal({
          icon: "error",
          title: "Oops! That's incorrect! try again",
          showConfirmButton: false,
          timer: 1500,
        });
        this.tries++;
        this.score -= 5;
        if (this.score < 0) {
          this.score = 0;
        }
        document.getElementById("activityScore").innerHTML = this.score;
        document.getElementById("activityTries").innerHTML = this.tries;

        this.selectRandomImage();
        this.randomDivPosition();
        originalZone.appendChild(image);
      }
    },

    // This function will know if activity one or activity 2 will be played.
    activityDisplayed() {
      if (this.$parent.activities[this.$parent.currentActivity].act_id == 1) {
        // SVG EX3
        document.getElementById("exT1").style.display = "block";
        document.getElementById("exN1").style.display = "none";
        // SVG EX3
        document.getElementById("exT2").style.display = "block";
        document.getElementById("exN2").style.display = "none";
        // SVG EX3
        document.getElementById("exT3").style.display = "block";
        document.getElementById("exN3").style.display = "none";
      } else if (
        this.$parent.activities[this.$parent.currentActivity].act_id == 2
      ) {
        // SVG EX3
        document.getElementById("exT1").style.display = "none";
        document.getElementById("exN1").style.display = "block";
        // SVG EX3
        document.getElementById("exT2").style.display = "none";
        document.getElementById("exN2").style.display = "block";
        // SVG EX3
        document.getElementById("exT3").style.display = "none";
        document.getElementById("exN3").style.display = "block";
      }
    },

    //Runs all the methods to operate the activity
    runMethods(id) {
      this.score = 0;
      this.tries = 0;
      document.getElementById("activityScore").innerHTML = this.score;
      document.getElementById("activityTries").innerHTML = this.tries;
      this.activityDisplayed();
      this.selectRandomImage();
      this.randomDivPosition();
      this.countDown();
      this.changeActivityBg();
    },

    // stroes the users progress of the activity when completed.
    storeActivityProgress() {
      var concentration = parseFloat(
        document.getElementById("concentrationLevel").innerHTML
      );
      var data = {
        score: this.score,
        tries: this.tries,
        time_to_complete: this.timer,
        keystrokes: this.$parent.strokeCount,
        conc_level: concentration,
      };

      axios
        .post("/eLearning/activityDetails/" + this.activity.act_id, data)
        .then((res) => {})
        .catch((error) => {
          // error.response.status Check status code
          Vue.swal({
            icon: "error",
            title: "Oops...",
            text: error,
          });
        });
    },

    // function to randamise div position everytime
    randomDivPosition() {
      // get element of all three boxes where possible answers are
      const box1Outer = document.getElementById("boxOne-outer");
      const box2Outer = document.getElementById("boxTwo-outer");
      const box3Outer = document.getElementById("boxThree-outer");
      // get svg element of all possible answers
      const svg1 = document.getElementById("ex" + this.images[0][1]);
      const svg2 = document.getElementById("ex" + this.images[1][1]);
      const svg3 = document.getElementById("ex" + this.images[2][1]);

      let svgList = [svg1, svg2, svg3];
      // shuffle list so it is displayed randomly and add them to the box elements
      svgList = svgList.sort(() => Math.random() - 0.5);
      box1Outer.appendChild(svgList[0]);
      box2Outer.appendChild(svgList[1]);
      box3Outer.appendChild(svgList[2]);
    },
    playSound() {
      // Variable for speech to audio using a web api
      var msg = new SpeechSynthesisUtterance();
      var activeActivity = this.$parent.activities[
        this.$parent.currentActivity
      ];
      msg.text = activeActivity.act_question;

      window.speechSynthesis.speak(msg);
      console.log(msg);
      console.log(this.$parent.currentActivity);
    },
    // selects random image to go on the top of the activity
    selectRandomImage() {
      const index = Math.floor(Math.random() * this.images.length);
      this.selectedImage = this.images[index];
    },
    // allows the user to change the background of activity
    changeActivityBg() {
      document.getElementById(
        "activity-color"
      ).style.background = this.bgColorSelected;
    },
  },
};
</script>
