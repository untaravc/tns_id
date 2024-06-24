import { OhVueIcon, addIcons } from "oh-vue-icons";
import {
  BiColumnsGap,
  BiCursor,
  BiVectorPen,
  BiPeople,
  BiNewspaper,
  BiBookmarkStar,
  BiArchive,
  BiShieldCheck,
  BiBezier2,
  BiMenuButtonWide,
  BiSearch,
  BiGear,
  BiX
} from "oh-vue-icons/icons/bi";

addIcons(
  BiColumnsGap, // Dashboars
  BiCursor, // Point
  BiVectorPen, // Pertandingan
  BiPeople, // player
  BiNewspaper, // berita
  BiBookmarkStar, // Kompetisi
  BiArchive, // Kategori
  BiShieldCheck, // admin
  BiBezier2, // role
  BiMenuButtonWide, // menu
  BiSearch,// search
  BiGear,// settings
  BiX,
);

// register components
const registerIcon = (app) => {
  app.component('v-icon', OhVueIcon);
}

export default registerIcon