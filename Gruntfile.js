module.exports = function(grunt) {
var pngquant = require('imagemin-pngquant');
var mozjpeg  = require('imagemin-mozjpeg');
var gifsicle = require('imagemin-gifsicle');
var jpegtran = require('imagemin-jpegtran');
var svgo = require('imagemin-svgo');
	
var path = require('path'),
		SOURCE_DIR = '',
		BUILD_DIR = '../weld_ed_build/',
		IMAGE_BUILD_DIR = '../weld_ed_build/images/',
		mediaConfig = {},
		mediaBuilds = ['audiovideo', 'grid', 'models', 'views'];
  // Project configuration.
  grunt.initConfig({
	pkg: grunt.file.readJSON('package.json'),

		/**
		 * Sass
		 */
		sass: {
		  dev: {
		    options: {
		      style: 'expanded',
		      sourcemap: 'none',
		    },
		    files: {
		      'compiled/style_readable.css': 'scss/style.scss'
		    }
		  },
		  dist: {
		    options: {
		      style: 'compressed',
		      sourcemap: 'none',
		    },
		    files: {
		      'compiled/style.css': 'scss/style.scss'
		    }
		  }
		},
			/**
		*concat
		This plugin allows the merging files. In this code is a example of merging two different Javascript files or css. In this case it is being used to add custom banners to the css files
		*/
		concat: {
			working:{
				options: {
     banner: '/*!Theme Name: <%= pkg.name %>_v<%= pkg.version %>*/',
    },
				src:['style.css'],
					dest:'../weld_ed_build/style.css'
			},
			build:{
				options: {
     banner: '/*!Theme Name: <%= pkg.name %>_working*/',
    },
				src:['style.css'],
				dest:	'style.css'
		}
			
		},
		/**
		*CSSmin
		*/
		cssmin: {
			my_target:{
				files:[{
					expand:true,
					cwd: 'compiled/',
					src: ['style.css'],
					dest:'compiled/',
					ext:'.css'
				}]
			}
		},
		/**
		*uglify
		*/
		uglify:{
			options:{
				manage:false,
				preserveComments:'all'	
			},
			my_target:{
				files: [{
					'js/main.js':['js/input.js','js/input3.js']
				}]
			}
		},
		/**
		*Autoprefixer
		*/
		autoprefixer:{
				options:{
					browsers:['last 4 versions']
				},
				multiple_files:{
					expand:true,
					flatten:true,
					src:'compiled/style.css',
					dest:''	
				}

		},
		/**
		*Uncss
		*/
		
		/**
		/***
		*Image Min
		*/
	
		imagemin: {                          // Task 
		   build_output: {                         // Another target 
			  options: {                       // Target options
				optimizationLevel: 7,
				svgoPlugins: [{ removeViewBox: false }],
          		progressive: true,
				  interlaced: true,
          		use: [pngquant(), mozjpeg(), jpegtran(), gifsicle(),svgo()]
			  },
			  files: [{
				expand: true,                  // Enable dynamic expansion 
				cwd: 'images/',                   // Src matches are relative to this path 
				src: ['**/*.{png,jpg,gif,svg}'],   // Actual patterns to match 
				dest: IMAGE_BUILD_DIR              // Destination path prefix 
			  }]
			},
			 working: {                         // Another target 
			  options: {                       // Target options
				optimizationLevel: 7,
				svgoPlugins: [{ removeViewBox: false }],
          		progressive: true,
				  interlaced: true,
          		use: [pngquant(), mozjpeg(), jpegtran(), gifsicle(),svgo()]
			  },
			  files: [{
				expand: true,                  // Enable dynamic expansion 
				cwd: 'images/',                   // Src matches are relative to this path 
				src: ['**/*.{png,jpg,gif,svg}'],   // Actual patterns to match 
				dest: 'dist/'              // Destination path prefix 
			  }]
			}
		  },
		  /*
		  *copy
		  */
	copy: {
			  maincss: {
					files: [{
						expand: true,
						cwd:SOURCE_DIR,
						src: 'style.css',
						dest: BUILD_DIR
					}],
			  },
			  php: {
					files: [{
						expand: true,
						cwd:SOURCE_DIR,
						src: '**/*.php',
						dest: BUILD_DIR
					}],
			  },
			 screenshot: {
					files: [{
						expand: true,
						cwd:SOURCE_DIR,
						src: '*.png',
						dest: BUILD_DIR
					}],
			  }, 
		},	  
		/*
		*Watch
		*/
	watch: {
		php: {
			files: ['**/*.php'],
			tasks: ['copy:php']
			},
		css: {
				files: '**/*.scss',
				tasks: ['sass','cssmin','autoprefixer','concat']
			},	
		lr: {
			livereload: true,
			files: ['**/*.scss'],
			files: ['**/*.php'],
			},
		}
	});
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
  	// Load the plugin that provides the "uglify" task.
  	grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-autoprefixer');	
	grunt.loadNpmTasks('grunt-uncss');
	grunt.loadNpmTasks('grunt-newer');
	grunt.loadNpmTasks('grunt-contrib-imagemin');
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.registerTask('imagepng', ['imagemin:png']); // only .png files
	grunt.registerTask('imagejpg', ['imagemin:jpg']);// only .jpg files
  
  // Default task(s).
  grunt.registerTask('default', ['watch']);
};