import {createApp} from 'vue'
import Unicon from 'vue-unicons'
import { uniTrashAlt, uniEditAlt, uniEye, uniUser, uniPlus} from 'vue-unicons/dist/icons'

// import VueTelInput from 'vue-tel-input'
// import 'vue-tel-input/dist/vue-tel-input.css'

import Home from "./views/main/Home";
import TheHeader from "./components/TheHeader";
import Login from "./views/auth/Login";
import Register from "./views/auth/Register";
import ConfirmRegister from "./views/auth/ConfirmRegister";
import ForgotPassword from "./views/auth/ForgotPassword";
import ResetPassword from "./views/auth/ResetPassword";
import SelectPost from "./views/main/SelectPost";
import AddCar from "./views/main/AddCar";
import Monitoring from "./views/monitoring/Monitoring";
import MonitoringResult from "./views/monitoring/MonitoringResult";

import HomeAdmin from "./views/admin/HomeAdmin";
import TheHeaderAdmin from "./components/admin/TheHeaderAdmin";
import PostsAdmin from "./views/admin/posts/PostsAdmin";
import CreatePostAdmin from "./views/admin/posts/CreatePostAdmin";
import EditPostAdmin from "./views/admin/posts/EditPostAdmin";

import UsersAdmin from "./views/admin/users/UsersAdmin";
import EditUserAdmin from "./views/admin/users/EditUserAdmin";

import DailySummaryEdit from "./views/summary/DailySummaryEdit";

import Chevrons from "./views/chevrons/Chevrons";
import Orders from "./views/chevrons/Orders";


// const VueTelInputOptions = {
//   mode: "national",
//   onlyCountries: ["UA"],
//   defaultCountry: "UA",
//   inputOptions: {
//     placeholder: "Введіть телефон у форматі \"0501234567\"",
//     styleClasses: {
//       'border-radius': '20px',
//     }
//   },
//   styleClasses: "rounded-none"
//
// }

Unicon.add([uniTrashAlt, uniEditAlt, uniEye, uniUser, uniPlus])

const app = createApp({
  components:{
    'home': Home,
    'the-header': TheHeader,
    'login': Login,
    'register': Register,
    'confirm-register': ConfirmRegister,
    'forgot-password': ForgotPassword,
    'reset-password': ResetPassword,
    'select-post': SelectPost,
    'add-car': AddCar,
    'monitoring': Monitoring,
    'monitoring-result': MonitoringResult,

    'home-admin': HomeAdmin,
    'the-header-admin': TheHeaderAdmin,
    'posts-admin': PostsAdmin,
    'create-post-admin': CreatePostAdmin,
    'edit-post-admin': EditPostAdmin,

    'users-admin': UsersAdmin,
    'edit-user-admin': EditUserAdmin,

    'daily-summary-edit': DailySummaryEdit,

    'chevrons': Chevrons,
    'orders': Orders,

  }
});


app
  .use(Unicon)
  // .use(VueTelInput, VueTelInputOptions)
  .mount('#app');

require('./bootstrap');

// import Alpine from 'alpinejs';
//
// window.Alpine = Alpine;
//
// Alpine.start();
