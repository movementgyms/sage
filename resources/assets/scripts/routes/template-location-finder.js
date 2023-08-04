import { Loader } from '@googlemaps/js-api-loader';
import svgMapMarkerUnselected from '../../images/icon-map-marker-unselected.svg';
import svgMapMarkerSelected from '../../images/icon-map-marker-selected.svg';

/* eslint-disable */
const map_styles = [
  {
    'featureType': 'all',
    'elementType': 'geometry',
    'stylers': [{
      'color': '#cccccc'
    }, {
      'visibility': 'on'
    }]
  },
  {
    'featureType': 'administrative.land_parcel',
    'stylers': [
      {
        'color': '#e4e4e4'
      },
      {
        'visibility': 'off'
      }
    ]
  },
  {
    'featureType': 'administrative.locality',
    'stylers': [
      {
        'visibility': 'off'
      }
    ]
  },
  {
    'featureType': 'administrative.neighborhood',
    'stylers': [
      {
        'visibility': 'off'
      }
    ]
  },
  {
    "featureType": "administrative.country",
    "elementType": "geometry.stroke",
    "stylers": [
      {
        "color": "#929292"
      }
    ]
  },
  {
    "featureType": "administrative.province",
    "elementType": "geometry.stroke",
    "stylers": [
      {
        "color": "#929292"
      }
    ]
  },
  {
    'featureType': 'landscape',
    'stylers': [
      {
        'color': '#cccccc'
      }
    ]
  },
  {
    'featureType': 'landscape.natural.terrain',
    'stylers': [
      {
        'color': '#e4e4e4'
      }
    ]
  },
  {
    'featureType': 'poi',
    'stylers': [
      {
        'visibility': 'off'
      }
    ]
  },
  {
    'featureType': 'poi.business',
    'stylers': [
      {
        'visibility': 'off'
      }
    ]
  },
  {
    'featureType': 'poi.park',
    'elementType': 'geometry.fill',
    'stylers': [
      {
        'color': '#cccccc'
      }
    ]
  },
  {
    'featureType': 'road',
    'stylers': [
      {
        'color': '#e4e4e4'
      }
    ]
  },
  {
    'featureType': 'road',
    'elementType': 'labels',
    'stylers': [
      {
        'visibility': 'off'
      }
    ]
  },
  {
    'featureType': 'road',
    'elementType': 'labels.icon',
    'stylers': [
      {
        'visibility': 'off'
      }
    ]
  },
  {
    'featureType': 'road.arterial',
    'stylers': [
      {
        'visibility': 'off'
      }
    ]
  },
  {
    'featureType': 'road.highway',
    'elementType': 'labels',
    'stylers': [
      {
        'visibility': 'off'
      }
    ]
  },
  {
    'featureType': 'road.local',
    'stylers': [
      {
        'visibility': 'off'
      }
    ]
  },
  {
    'featureType': 'transit',
    'stylers': [
      {
        'visibility': 'off'
      }
    ]
  },
  {
    'featureType': 'water',
    'elementType': 'geometry.fill',
    'stylers': [
      {
        'color': '#009ca6'
      }
    ]
  },
  {
    'featureType': 'water',
    'elementType': 'labels.text',
    'stylers': [
      {
        'visibility': 'off'
      }
    ]
  }
];
/* eslint-enable */

const map_options = {
  styles: map_styles,
  zoom: $(document).width() >= 1200 ? 5 : 4,
  center: {
    lat: 37.0902,
    lng: -95.7129,
  },
  streetViewControl: false,
  mapTypeControl: false,
}

export default {
  init() {
    /** GOOGLE MAPS */
    const loader = new Loader({
      apiKey: window.google_maps_api_key,
      version: 'weekly',
    });

    const markers = [];
    const infoWindows = {};

    loader
      .load()
      .then(() => {
          const google = window.google;
          const map = new google.maps.Map(document.getElementById('location-map'), map_options);

          const map_marker_unselected = {
            url: svgMapMarkerUnselected,
            scaledSize: new google.maps.Size(35, 35),
          };

          const map_marker_selected = {
            url: svgMapMarkerSelected,
            scaledSize: new google.maps.Size(35, 35),
          };

          window.gym_locations.map((gym) => {
            if (gym.address && gym.address.street_address) {
              const marker = new google.maps.Marker({
                position: new google.maps.LatLng(gym.address.street_address.lat, gym.address.street_address.lng),
                map,
                icon: map_marker_unselected,
                title: gym.location_name,
                region: gym.region,
              });

              const infoWindow = new google.maps.InfoWindow({
                content: gym.location_name,
              });
              infoWindows[gym.location_name] = infoWindow;

              marker.addListener('click', () => {
                markers.forEach((current_marker) => {
                  current_marker.isActive = false;
                  current_marker.setIcon(map_marker_unselected);
                  current_marker.setZIndex(1);
                  infoWindows[current_marker.title].close(map, current_marker);
                });

                marker.isActive = true;
                marker.setIcon(map_marker_selected);
                marker.setZIndex(2);
                infoWindow.open(map, marker);
                this.scrollToGym(gym.blog_id);
              });

              marker.addListener('mouseover', () => {
                infoWindow.open(map, marker);
                marker.setZIndex(3);
              });

              marker.addListener('mouseout', () => {
                if (!marker.isActive) {
                  marker.setZIndex(1);
                  infoWindow.close(map, marker);
                } else {
                  marker.setZIndex(2);
                }
              });

              markers.push(marker);
            }
          });

          /** LOCATION SELECTOR */
          $(document).on('change', '.location-list__region-select', function() {
            const region = $(this).val();

            if (region === '') {
              $('.location-list__item').show();
            } else {
              const selected_location_class = 'location-list__region__' + region;
              $('.location-list__item').hide();
              $(`.location-list__item.${selected_location_class}`).fadeIn('slow');
            }

            markers.forEach((current_marker) => {
              if (region === '' || region === current_marker.region) {
                current_marker.setMap(map);
              } else {
                current_marker.setMap(null);
              }
            });
          });
        });
      /** END GOOGLE MAPS */
  },
  scrollToGym(blog_id) {
    let admin_bar_height = $('#wpadminbar').length > 0 ? $('#wpadminbar').outerHeight() : 0;

    $('html, body').animate(
      {
        scrollTop: $('#location-list__' +blog_id).offset().top - 85 - ( admin_bar_height ),
      },
      1000
    );
  },
  finalize() {
  },
};
