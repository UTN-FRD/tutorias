'use strict';

module.exports = function(grunt) {
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');

  grunt.file.setBase('app/webroot/');

  grunt.initConfig({
    watch: {
      /* Tareas a ejecutarse automáticamente cuando un archivo LESS es modificado. */
      less: {
        files: 'less/**/*.less',
        tasks: [
          'less:dev'
        ]
      },

      /* Tareas a ejecutarse automáticamente cuando un archivo JS es modificado. */
      js: {
        files: 'js/**/*.js',
        tasks: [
          'copy:js',
          'uglify:dev',
          'jshint'
        ]
      }
    },

    less: {
      /* Compila LESS a CSS y lo copia a 'dist/css/'. */
      prod: {
        options: {
          paths: 'less/tutorias'
        },

        files: [
          {
            expand: true,
            cwd: 'less/',
            src: '*.less',
            dest: 'dist/css/',
            ext: '.css'
          }
        ]
      },

      /* Compila LESS a CSS, agrega source maps y lo copia a 'dist/css/'. */
      dev: {
        options: {
          paths: 'less/tutorias',
          sourceMap: true,
          sourceMapBasepath: function() {
            this.sourceMapURL = this.sourceMapFilename.substr(this.sourceMapFilename.lastIndexOf('/') + 1);
          }
        },

        files: [
          {
            expand: true,
            cwd: 'less/',
            src: '*.less',
            dest: 'dist/css/',
            ext: '.css'
          }
        ]
      }
    },

    copy: {
      /* Copia las fuentes descargadas con npm a 'dist/fonts/'. */
      fonts: {
        files: [
          {
            nonull: true,
            expand: true,
            flatten: true,
            filter: 'isFile',
            cwd: '../../node_modules/',
            src: [
              'bootstrap/dist/fonts/*'
            ],
            dest: 'dist/fonts/'
          }
        ]
      },

      /* Copia las librerías JS descargadas con npm a 'dist/js/'. */
      libjs: {
        files: [
          {
            nonull: true,
            expand: true,
            flatten: true,
            filter: 'isFile',
            cwd: '../../node_modules/',
            src: [
              'autosize/dist/autosize.js',
              'bootstrap/dist/js/bootstrap.js',
              'bootstrap-daterangepicker/daterangepicker.js',
              'bootstrap-toggle/js/bootstrap-toggle.js',
              'footable/compiled/footable.core.js',
              'jquery/dist/jquery.js',
              'jquery-form/jquery.form.js',
              'jquery-validation/dist/jquery.validate.js',
              'moment/moment.js'
            ],
            dest: 'dist/js/'
          }
        ]
      },

      /* Copia los archivos JS propios a 'dist/js/'. */
      js: {
        files: [
          {
            nonull: true,
            expand: true,
            flatten: true,
            filter: 'isFile',
            cwd: 'js/',
            src: '**/*.js',
            dest: 'dist/js/'
          }
        ]
      },

      /* Copia los archivos CSS propios a 'dist/css/'. */
      css: {
        files: [
          {
            nonull: true,
            expand: true,
            flatten: true,
            filter: 'isFile',
            cwd: '../../node_modules/',
            src: [
              'bootstrap/dist/css/bootstrap.css',
              'bootstrap-daterangepicker/daterangepicker.css',
              'bootstrap-toggle/css/bootstrap-toggle.css',
              'footable/compiled/footable.core.bootstrap.css'
            ],
            dest: 'dist/css/'
          }
        ]
      }
    },

    clean: {
      /* Elimina los archivos CSS. */
      css: {
        src: 'dist/css/*'
      },

      /* Elimina los archivos JS. */
      js: {
        src: 'dist/js/*'
      },

      /* Elimina las fuentes. */
      fonts: {
        src: 'dist/fonts/*'
      }
    },

    cssmin: {
      /* Minifica los archivos CSS, eliminando los comentarios especiales. */
      prod: {
        options: {
          keepSpecialComments: 0
        },
        files: [
          {
            expand: true,
            src: [
              'dist/css/*.css'
            ],
            dest: ''
          }
        ]
      }
    },

    uglify: {
      /* Comprime y minifica los archivos JS. */
      prod: {
        files: [
          {
            expand: true,
            src: [
              'dist/js/*.js'
            ],
            dest: ''
          }
        ]
      },

      /* Comprime los archivos JS, pero no los minifica. */
      dev: {
        options: {
          beautify: true
        },
        files: [
          {
            expand: true,
            src: [
              'dist/js/*.js'
            ],
            dest: ''
          }
        ]
      }
    },

    /* Analiza los archivos JS por si hay errores. */
    jshint: {
      options: {
        curly: true
      },
      uses_defaults: ['js/**/*.js']
    }
  });

  /* Tarea para el ambiente de desarrollo. */
  grunt.registerTask('dev', 'Development Mode.', [
    'clean',
    'copy',
    'less:dev',
    'uglify:dev',
    'jshint',
    'watch'
  ]);

  /* Tarea para el ambiente de producción. */
  grunt.registerTask('prod', 'Production Mode.', [
    'clean',
    'copy',
    'less:prod',
    'cssmin',
    'uglify:prod'
  ]);

  /* Tarea por defecto. */
  grunt.registerTask('default', 'Alias for "Production Mode" and default task.', [
    'prod'
  ]);
};
