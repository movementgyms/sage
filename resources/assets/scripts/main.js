// import external dependencies
import 'jquery';
import 'uikit/dist/js/uikit';

// Import everything from autoload
import './autoload/**/*'

// import local dependencies
import Router from './util/Router';
import common from './routes/common';
import home from './routes/home';
import aboutUs from './routes/about';
import templateInstructors from './routes/template-instructors';
import templateLocationFinder from './routes/template-location-finder';
import templateMemberships from './routes/template-memberships';
import templateYouBelongHere from './routes/template-you-belong-here';

/** Populate Router instance with DOM routes */
const routes = new Router({
  // All pages
  common,
  // Home page
  home,
  // About Us page, note the change from about-us to aboutUs.
  aboutUs,
  // Instructors template
  templateInstructors,
  // Location finder template
  templateLocationFinder,
  // Memberships
  templateMemberships,
  // You Belong Here
  templateYouBelongHere,
});

// Load Events
jQuery(document).ready(() => routes.loadEvents());
