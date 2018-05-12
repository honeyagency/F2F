module.exports = function(grunt) {
    grunt.initConfig({
        conf: {
            js: 'static/**/*.js',
            sass: 'scss/**/*.scss',
            app: 'app',
            icons: 'static/icons',
            appIcons: 'app/icons/',
        },
        clean: {
            icons: {
                src: ["<%= conf.appIcons %>/*"]
            }
        },
        svgmin: {
            dist: {
                options: {
                    plugins: [{
                        removeXMLProcInst: false
                    }]
                },
                files: [{
                    expand: true,
                    cwd: '<%= conf.icons %>',
                    src: ['*.svg'],
                    dest: '<%= conf.icons %>/optimized'
                }]
            }
        },
        grunticon: {
            myIcons: {
                files: [{
                    expand: true,
                    cwd: '<%= conf.icons %>/optimized',
                    src: ['*.svg'],
                    dest: '<%= conf.icons %>/final'
                }],
                options: {
                    enhanceSVG: true,
                    pngpath: '<%= conf.appIcons %>',
                    compressPNG: true
                }
            }
        },
        copy: {
            icons: {
                expand: true,
                cwd: '<%= conf.icons %>/final/png',
                src: '**',
                dest: '<%= conf.appIcons %>',
                flatten: true,
                filter: 'isFile',
            },
        },
    });
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-svgmin');
    grunt.loadNpmTasks('grunt-grunticon');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.registerTask('default', ['svgmin', 'grunticon', 'clean', 'copy']);
}