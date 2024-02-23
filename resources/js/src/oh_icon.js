import { OhVueIcon, addIcons } from "oh-vue-icons";
import {
  MdCategoryOutlined,
  MdSpacedashboard,
  MdScoreboard,
  MdNewspaper,
  MdTour,
  MdSports,
  MdEmojipeople,
  MdVerifieduser,
  MdAltroute,
  MdMenuopen,
  MdTablerows,
  MdSearch,
} from "oh-vue-icons/icons";

addIcons(
  MdSpacedashboard, // Dashboars
  MdScoreboard, // Point
  MdSports, // Pertandingan
  MdEmojipeople, // player
  MdNewspaper, // berita
  MdTour, // Kompetisi
  MdCategoryOutlined, // Kategori Kompetisi
  MdVerifieduser, // admin
  MdAltroute, // role
  MdTablerows, // cat berita
  MdMenuopen, // menu
  MdSearch,// search
);

// register components
const registerIcon = (app) => {
  app.component('v-icon', OhVueIcon);
}

export default registerIcon