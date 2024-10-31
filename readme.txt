=== Name Support ===
Contributors: mitchoyoshitaka
Author: mitcho (Michael Yoshitaka Erlewine)
Author URI: http://mitcho.com/
Plugin URI: http://mitcho.com/code/
Donate link: http://tinyurl.com/donatetomitcho
Tags: infrastructure, name, person, people, CPT, custom post type, post type
Requires at least: 3.2
Tested up to: 3.3
Stable tag: 0.1

Infrastructure plugin which adds UI support for custom post types with names instead of titles, e.g. "person" custom post types.

== Description ==

If you need to implement a custom post type for human beings, where in lieu of a title you need a *name*, this plugin will add the proper UI. See screenshots for an example.

= Usage =

When creating your custom post type, just make sure you specify `name` as one of the post type's features. (As of version 0.1, the `title` feature, quite counterintuitively, is also required as in the example below.)

`
register_post_type( 'people', array(
	'label' => 'People',
	'supports' => array( 'title', 'name', ... )
	...
) );
`

Name Support also gives you the template tags `the_name()` and `get_the_name()` which prints or returns the name in "[First Name] [Last Name]" format.

Development of this plugin was supported by the [Arts at MIT](http://arts.mit.edu/) and Music & Theater Arts at MIT.

== Screenshots ==

1. An example of the name entry UI which replaces the regular title entry UI.

== Changelog ==

= 0.1 =
* Initial upload
