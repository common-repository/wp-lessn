=== Plugin Name ===
Contributors: jayrobinson
Donate link: http://jayrobinson.org
Tags: short url, lessn
Requires at least: 2.8
Tested up to: 2.8
Stable tag: trunk

Use your self-hosted Lessn install to create short URLs for published posts.

== Description ==

The WP Lessn Plugin for WordPress uses Shaun Inman's Lessn to create a short URL for each new post you publish. The Lessn'd link is attached to the post meta data. You can insert the Lessn'd link into your blog post using short tags or into your theme template with some some PHP.

Lessn, according to Shaun Inman, is "an extremely simple, personal url shortener written in PHP with MySQL and mod_rewrite." If you are unfamiliar with Lessn, then this plugin will have little value to you until you read about it, download it, and install it on your own server. Lessn is free.

WP Lessn was written by Jay Robinson. Please thank Shaun Inman for being awesome, not me. But [email me](mailto:jay@jayrobinson.org) for support, not him.

== Installation ==

This section describes how to install the plugin and get it working.

1. Open 'wp-lessn.zip' file to reveal 'wp-lessn' directory.
2. Upload 'wp-lessn' directory to '/wp-content/plugins/' directory.
3. Activate the plugin through the 'Plugins' menu in WordPress.
4. Go to the 'WP Lessn' submenu underneath the 'Plugins' menu; store your Lessn domain, and your Lessn API key (found on your Lessn domain).
5. You may now publish any post to generate the Lessn'd URL. It will show up on the post page as a custom field, with the name 'wp_lessnd_url'.

== Frequently Asked Questions ==

= What is Lessn? =

Lessn is a free, self-hosted URL shortener that you download and upload to your own server. It was created by Shaun Inman. Read more about [Lessn](http://jwr.cc/x/2n) on Shaun Inman's blog.

= Is Lessn free? =

Yes.

= Do I have to have Lessn installed for this to work? =

Yes. You must have Lessn installed to get any use out of this plugin.

= Does Lessn have to be installed on the same domain as my WordPress installation for WP Lessn to work? =

No. WP Lessn allows you to specify any domain as your Lessn domain. For instance, I use [JayRobinson.org](http://jayrobinson.org) for my blog, but use my short domain, [http://jwr.cc](http://jwr.cc), for Lessn. Lessn's API key allows us to generate the short URL.

= What is your name? =

My name is still [Jay Robinson](http://jayrobinson.org).


== Screenshots ==

1. This screenshot shows the WP Lessn Admin screen.

== Changelog ==

= 1.0 =
* Initial release.