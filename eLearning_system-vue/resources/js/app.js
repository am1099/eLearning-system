import Vue from 'vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import VueSweetalert2 from 'vue-sweetalert2'
import 'sweetalert2/dist/sweetalert2.min.css'

import vueAwesomeCountdown from 'vue-awesome-countdown'

Vue.use(vueAwesomeCountdown, 'vac')


// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import { Form, HasError, AlertError } from 'vform'

//Importing google charts fromimport Vue from 'vue'
import VueGoogleCharts from 'vue-google-charts'

Vue.use(VueGoogleCharts)


// For error handling with laravel validation
window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)
// SweetAlert2
Vue.use(VueSweetalert2)

require('./bootstrap');

window.Vue = require('vue').default;



// --------------------------------------- ADMIN ---------------------------------------
// Dashboard
Vue.component('systemstat-cards', require('./components/contentBuilder/admin/dashboard/SystemStatCards.vue').default);
Vue.component('users-table', require('./components/contentBuilder/admin/dashboard/UsersTable.vue').default);
// Program specification
Vue.component('program-cards', require('./components/contentBuilder/admin/programSpecs/ProgramCards.vue').default);
Vue.component('stat-cards', require('./components/contentBuilder/admin/programSpecs/StatCards.vue').default);
Vue.component('validation-progress', require('./components/contentBuilder/admin/programSpecs/ValidationProgress.vue').default);
// Creating new program component
Vue.component('program-form', require('./components/contentBuilder/admin/form.vue').default);
// Program view components
Vue.component('view-program', require('./components/contentBuilder/admin/ViewProgram.vue').default);
Vue.component('modules-table', require('./components/contentBuilder/admin/ModulesTable.vue').default);
// Module view components
Vue.component('view-module', require('./components/contentBuilder/admin/ViewModule.vue').default);
Vue.component('units-table', require('./components/contentBuilder/admin/UnitsTable.vue').default);
// Unit view components
Vue.component('view-unit', require('./components/contentBuilder/admin/ViewUnit.vue').default);
Vue.component('lessons-table', require('./components/contentBuilder/admin/LessonsTable.vue').default);
// Lesson view components
Vue.component('view-lesson', require('./components/contentBuilder/admin/ViewLesson.vue').default);
Vue.component('activities-table', require('./components/contentBuilder/admin/ActivitiesTable.vue').default);
// Activity view components
Vue.component('view-activity', require('./components/contentBuilder/admin/ViewActivity.vue').default);

// --------------------------------------- Validator ---------------------------------------
// Dashboard - showing validated and non validated programs
Vue.component('valprogram-cards', require('./components/contentBuilder/validator/dashboard/ValidationProgramCards.vue').default);
// Dashboard - showing validation progress for programs, modules, units, lessons and activities
Vue.component('valstat-cards', require('./components/contentBuilder/validator/dashboard/ValidationStatCards.vue').default);


// --------------------------------------- eLearning ---------------------------------------
// Home page
Vue.component('card-programs', require('./components/eLearningSystem/Programs.vue').default);
// Program page
Vue.component('display-program', require('./components/eLearningSystem/DisplayProgram.vue').default);
// Student dahsboard page
Vue.component('student-dashboard', require('./components/eLearningSystem/student/StudentDashboard.vue').default);
// Activity 1 component
Vue.component('activity-one', require('./components/eLearningSystem/Activity1.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
