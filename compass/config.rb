project_path=File.expand_path("..",File.dirname(__FILE__))
# Compass configuration file.

# We also support plugins and frameworks, please read the docs http://docs.mixture.io/preprocessors#compass
# Require any additional compass plugins here.
require "breakpoint"
require "susy"

# Important! change the paths below to match your project setup
css_dir = "public_html/public/styles" # update to the path of your css files.
sass_dir = "public_html/public/styles/sass" # update to the path of your sass files.
images_dir = "public_html/public/images" # update to the path of your image files.
javascripts_dir = "public_html/public/scripts" # update to the path of your script files.

line_comments = false # if debugging (or using Mixture chrome extension - set this to true)
cache = true
