module.exports = function(grunt) {

  grunt.initConfig({

    watch: {
      options: {
        // https://www.npmjs.com/package/grunt-contrib-watch#optionsspawn
        spawn: false
      },
      scripts: {
        files: [
          'php-bin/resources/assets/scss/**',
          'php-bin/resources/assets/js/**'
        ],
        tasks: [
          'sass:build',
          'concat:dist'
        ]
      }
    },

    // Concatenate JS files.
    concat: {
      options: {
        separator: '\n\n /**********************************************/ \n\n',
      },
      dist: {
        // Try to play nicely with Gov BC Standards:
        // http://www2.gov.bc.ca/gov/content/governments/services-for-government/policies-procedures/web-content-development-guides/developers-guide/css-elements
        src: [
          // jQuery
          'php-bin/resources/assets/js/vendor/jquery.1.11.1.min.js', 
          // Bootstrap JS
          'php-bin/resources/assets/js/vendor/bootstrap.js',
          // Helper functions
          'php-bin/resources/assets/js/functions.js',
          // Toggle the menu open and closed.
          'php-bin/resources/assets/js/menu_controls.js',
          // Smooth scrolling to anchors on the page.
          'php-bin/resources/assets/js/smooth_scroll.js',
          // Tableau related things.
          'php-bin/resources/assets/js/resize_tableau.js',
          // Google Analytics
          'php-bin/resources/assets/js/google_analytics.js',
          //enrolment app js
          //'php-bin/resources/assets/js/d3.v4.min.js',
          //'php-bin/resources/assets/js/leaflet.js',
          //'php-bin/resources/assets/js/vendor/popper.min.js',
          //'php-bin/resources/assets/js/d3_js/demographics.js',
          //'php-bin/resources/assets/js/d3_js/enrolment_model.js',
          //'php-bin/resources/assets/js/d3_js/migration_interactive_map.js',
          //'php-bin/resources/assets/js/d3_js/migration_overview.js',
          //'php-bin/resources/assets/js/d3_js/retention.js',
          //'php-bin/resources/assets/js/d3_js/transition.js'

        ],
        dest: 'www/js/bundle.js',
      }
    },
    
    // Compile SASS files.
    sass: {   
      // Production instructions                      
      dist: {                       
        options: {
          style: 'compressed',
          lineNumbers: false,
          sourcemap: 'none'
        },
        files: {
          'www/css/style.css': 'php-bin/resources/assets/scss/main.scss' // 'destination': 'source'
        }
      },
      // Development instructions
      build: {
        options: {
          style: 'expanded',
          lineNumbers: true,
          sourcemap: 'none'
        },
        files: {
          'www/css/style.css': 'php-bin/resources/assets/scss/main.scss' // 'destination': 'source'
        }
      }
    }

  }); // grunt.initConfig()

  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-sass');

  grunt.registerTask('default', ['concat:dist', 'sass:dist']);

}; // wrapper function
