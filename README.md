# podlove-punkto-theme
Wordpress theme based on good old 2013 for podcasts using podlove-publisher

This is a wordpress initially developed for the podcasts of the punkto
brand:

* [kern.punkto](https://kern.punkto.info)
* [movada-vid.punkto](https://movada-vid.punkto.info)

They are based on the 2013 theme of wordpress. The main modifications are the
way podcasts are presented in the blog.

## Features

Podcasts are displayed in a sensible manor with a focus to the podcast
metadata. Like title, subtitle, description, duration, guests, etc. The same
for search results.

Social media buttons and podlove subscribe button integrated in the header
line.

Extensive use of episode pictures. Maybe the theme would look strange for
podcasts that don't use them.


## Status & Restrictions

This project was started a back in 2015 in order to make a theme just exactly
for the two punkto podcasts, so the code base probably needs some cleanup.

It is assumed that the podcast uses the [Podlove publisher
plugin](https://podlove.org). All the podcast data displayed is taken from
there, so it won't work with other podcasting plugins.

The two punkto info podcasts are in Esperanto language. All the strings
displayed to the user are hardcoded in Esperanto.

The social media buttons and the subscribe button are hardcoded for
kern.punkto.

Probably more.

## Todo

Well, looking at at the last section it's obvious:

Cleanups

* An experienced wp-theme author could probably make the code more
  wordpressish

* cleanup css; up to now the original css from 2013 is still included. This
  needs to be consolidated.

* remove the punkto specifics (language, social media) and make that
  customizable.

* Whatever ...
